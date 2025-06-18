<?php
// Incluir archivos de configuración y funciones
include "../config/db.php";        // Conexión a la base de datos
include "../config/functions.php"; // Funciones adicionales

// Iniciar sesión
session_start();

// Obtener el nombre de la página actual para posibles redirecciones
$paginaActual = basename($_SERVER['PHP_SELF']);

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirigir al login si el usuario no está logueado
    exit();
}

// Obtener el ID del usuario logueado
$user_id = $_SESSION['user_id'];

// Obtener las colecciones del usuario
$collections = get_user_collections($user_id);

$bookSuccess = false;  // Variable para el mensaje de éxito
$bookError = "";       // Variable para el mensaje de error

// Función para agregar un libro a una colección
function addBookToCollection($pdo, $collectionId, $bookId)
{
    $sql = "INSERT INTO collection_books (collection_id, book_id) VALUES (:collection_id, :book_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':collection_id', $collectionId);
    $stmt->bindParam(':book_id', $bookId);
    $stmt->execute();
}

// Procesar formulario cuando se envía
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_by_manual'])) {
    // Obtener y sanitizar los datos del formulario
    $collectionId = htmlspecialchars($_POST['collection_id']);
    $bookTitle = htmlspecialchars(trim($_POST['book_title']));
    $bookAuthor = htmlspecialchars(trim($_POST['book_author']));
    $bookPublicationDate = htmlspecialchars($_POST['book_publication_date']);
    $bookCategories = htmlspecialchars(trim($_POST['book_categories']));
    $bookPages = htmlspecialchars($_POST['book_pages']);
    $bookPublisher = htmlspecialchars(trim($_POST['book_publisher']));
    $bookIsbn = htmlspecialchars(trim($_POST['book_isbn']));
    $bookDescription = htmlspecialchars(trim($_POST['book_description']));

    // Validar campos obligatorios
    if (empty($bookTitle) || empty($bookIsbn)) {
        $bookError = "El título y el ISBN son campos obligatorios.";
    }

    // Validar formato del ISBN (13 dígitos)
    if (!preg_match('/^\d{13}$/', $bookIsbn)) {
        $bookError = "El ISBN debe ser un número de 13 dígitos.";
    }

    // Verificar si el libro ya existe en la base de datos
    $sql = "SELECT id FROM books WHERE isbn_13 = :isbn";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':isbn', $bookIsbn);
    $stmt->execute();
    $bookId = $stmt->fetchColumn();

    if ($bookId) {
        // Verificar si el libro ya está en la colección del usuario
        $sql = "SELECT 1 FROM collection_books WHERE collection_id = :collection_id AND book_id = :book_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':collection_id', $collectionId);
        $stmt->bindParam(':book_id', $bookId);
        $stmt->execute();
        $isBookInCollection = $stmt->fetchColumn();

        if ($isBookInCollection) {
            $bookError = "El libro ya está en esta colección.";
        } else {
            // Si el libro no está en la colección, agregarlo
            addBookToCollection($pdo, $collectionId, $bookId);
            $bookSuccess = "Libro agregado a la colección con éxito.";
        }
    } else {
        // Si el libro no existe, insertarlo en la base de datos
        $coverImage = $_FILES['cover_image'];
        $coverImageName = basename($coverImage['name']);
        $coverImagePath = "./uploads/covers/" . $coverImageName;

        // Validar imagen (solo JPG y PNG, tamaño máximo 2MB)
        $allowedTypes = ['image/jpeg', 'image/png'];
        $maxSize = 2 * 1024 * 1024; // 2MB

        if (!in_array($coverImage['type'], $allowedTypes)) {
            $bookError = "El archivo no es una imagen válida. Solo se permiten imágenes JPEG y PNG.";
        } elseif ($coverImage['size'] > $maxSize) {
            $bookError = "El archivo es demasiado grande. El tamaño máximo permitido es 2MB.";
        } elseif (move_uploaded_file($coverImage['tmp_name'], $coverImagePath)) {
            // Si la imagen se carga correctamente, insertar el libro
            try {
                $sql = "INSERT INTO books (title, author, publication_date, categories, pages, publisher, isbn_13, description, cover_image)
                        VALUES (:title, :author, :publication_date, :categories, :pages, :publisher, :isbn, :description, :cover_image)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':title', $bookTitle);
                $stmt->bindParam(':author', $bookAuthor);
                $stmt->bindParam(':publication_date', $bookPublicationDate);
                $stmt->bindParam(':categories', $bookCategories);
                $stmt->bindParam(':pages', $bookPages);
                $stmt->bindParam(':publisher', $bookPublisher);
                $stmt->bindParam(':isbn', $bookIsbn);
                $stmt->bindParam(':description', $bookDescription);
                $stmt->bindParam(':cover_image', $coverImagePath);
                $stmt->execute();

                $bookId = $pdo->lastInsertId(); // Obtener el ID del libro insertado

                // Agregar el libro a la colección
                addBookToCollection($pdo, $collectionId, $bookId);
                $bookSuccess = "Libro agregado a la colección con éxito.";
            } catch (PDOException $e) {
                $bookError = "Error al agregar el libro: " . $e->getMessage();
            }
        } else {
            $bookError = "Error al cargar la imagen de portada.";
        }
    }
}
