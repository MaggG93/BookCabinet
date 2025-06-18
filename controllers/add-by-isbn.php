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

$isIsbnSearch = false; // Variable para mantener abierto el bloque de búsqueda por ISBN

// Función para agregar un libro a una colección
function addBookToCollection($pdo, $collectionId, $bookId)
{
    $sql = "INSERT INTO collection_books (collection_id, book_id) VALUES (:collection_id, :book_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':collection_id', $collectionId);
    $stmt->bindParam(':book_id', $bookId);
    $stmt->execute();
}

// Función para validar el formato del ISBN (13 dígitos)
function isValidISBN($isbn)
{
    return preg_match('/^\d{13}$/', $isbn);
}

// Procesar formulario cuando se envía
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_by_isbn'])) {
    $isbn = htmlspecialchars(trim($_POST['isbn']));  // Obtener y limpiar el ISBN del formulario
    $bookError = "";  // Reiniciar mensaje de error
    $isIsbnSearch = true; // Marcar que se ha realizado una búsqueda por ISBN

    // Validar el formato del ISBN
    if (!isValidISBN($isbn)) {
        $bookError = "Por favor, ingrese un ISBN válido de 13 dígitos.";  // Mensaje si el ISBN no es válido
    } else {
        // Obtener datos del libro desde la API de Google Books
        $url = "https://www.googleapis.com/books/v1/volumes?q=isbn:$isbn";
        $response = @file_get_contents($url); // Hacer la solicitud a Google Books API

        // Verificar si hubo un error al conectarse con el servicio de Google Books
        if ($response === FALSE) {
            $bookError = "Error al conectarse con el servicio de Google Books.";
        } else {
            $bookData = json_decode($response, true);  // Decodificar la respuesta JSON

            // Verificar si se encontró el libro con el ISBN
            if (isset($bookData['items'][0])) {
                $bookInfo = $bookData['items'][0]['volumeInfo']; // Extraer la información del libro

                // Obtener la información relevante del libro (con valores por defecto si no están disponibles)
                $bookTitle = $bookInfo['title'] ?? 'Título no disponible';
                $bookAuthor = implode(", ", $bookInfo['authors'] ?? ['Autor no disponible']);
                $bookPublisher = $bookInfo['publisher'] ?? 'Editorial no disponible';
                $bookPublicationDate = $bookInfo['publishedDate'] ?? 'Fecha no disponible';
                $bookDescription = $bookInfo['description'] ?? 'Descripción no disponible';
                $bookCategories = implode(", ", $bookInfo['categories'] ?? ['Categoría no disponible']);
                $bookPages = $bookInfo['pageCount'] ?? 0;
                $coverImage = $bookInfo['imageLinks']['thumbnail'] ?? './uploads/covers/default-cover.jpeg';

                // Obtener el ID de la colección seleccionada
                $collectionId = $_POST['collection_id'];

                // Verificar si el libro ya existe en la base de datos
                $sql = "SELECT id FROM books WHERE isbn_13 = :isbn";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':isbn', $isbn);
                $stmt->execute();
                $bookId = $stmt->fetchColumn();

                // Si el libro ya existe en la base de datos
                if ($bookId) {
                    // Verificar si el libro ya está en la colección
                    $sql = "SELECT COUNT(*) FROM collection_books WHERE collection_id = :collection_id AND book_id = :book_id";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':collection_id', $collectionId);
                    $stmt->bindParam(':book_id', $bookId);
                    $stmt->execute();
                    $existsInCollection = $stmt->fetchColumn();

                    // Si el libro ya está en la colección, mostrar un error
                    if ($existsInCollection) {
                        $bookError = "Este libro ya se encuentra en la colección seleccionada.";
                    } else {
                        // Si el libro no está en la colección, agregarlo
                        addBookToCollection($pdo, $collectionId, $bookId);
                        $bookSuccess = "Libro agregado con éxito a la colección.";
                    }
                } else {
                    // Si el libro no existe en la base de datos, insertarlo
                    $sql = "INSERT INTO books (title, author, publication_date, categories, pages, publisher, isbn_13, description, cover_image)
                            VALUES (:title, :author, :publication_date, :categories, :pages, :publisher, :isbn, :description, :cover_image)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':title', $bookTitle);
                    $stmt->bindParam(':author', $bookAuthor);
                    $stmt->bindParam(':publication_date', $bookPublicationDate);
                    $stmt->bindParam(':categories', $bookCategories);
                    $stmt->bindParam(':pages', $bookPages);
                    $stmt->bindParam(':publisher', $bookPublisher);
                    $stmt->bindParam(':isbn', $isbn);
                    $stmt->bindParam(':description', $bookDescription);
                    $stmt->bindParam(':cover_image', $coverImage);
                    $stmt->execute();

                    $bookId = $pdo->lastInsertId(); // Obtener el ID del nuevo libro insertado

                    // Agregar el libro a la colección
                    addBookToCollection($pdo, $collectionId, $bookId);
                    $bookSuccess = "Libro agregado con éxito a la colección.";
                }
            } else {
                // Si no se encontró el libro con el ISBN proporcionado
                $bookError = "No se encontró el libro con el ISBN proporcionado.";
            }
        }
    }
}
