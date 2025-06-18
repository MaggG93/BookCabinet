<?php
include "../config/db.php";
include "../config/functions.php";

// Obtener la página actual
$paginaActual = basename($_SERVER['PHP_SELF']);

// Iniciar sesión
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Obtener el ID del libro desde la URL
$book_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Validar ID
if ($book_id <= 0) {
    echo "ID de libro no válido.";
    exit();
}

// Obtener información básica del libro
$stmtBook = $pdo->prepare("SELECT * FROM books WHERE id = :book_id");
$stmtBook->execute([':book_id' => $book_id]);
$book = $stmtBook->fetch(PDO::FETCH_ASSOC);

if (!$book) {
    echo "El libro no existe.";
    exit();
}

// Obtener el collection_id desde la tabla intermedia collection_books
$stmtCollection = $pdo->prepare("SELECT collection_id FROM collection_books WHERE book_id = :book_id LIMIT 1");
$stmtCollection->execute([':book_id' => $book_id]);
$collection = $stmtCollection->fetch(PDO::FETCH_ASSOC);

if (!$collection) {
    echo "El libro no está asociado a ninguna colección.";
    exit();
}

$collection_id = $collection['collection_id'];  // Aquí obtenemos el collection_id

// Obtener los detalles del libro
$query = "SELECT * FROM book_details WHERE user_id = :user_id AND book_id = :book_id";
$stmt = $pdo->prepare($query);
$stmt->execute([
    ':user_id' => $user_id,
    ':book_id' => $book_id
]);
$bookDetails = $stmt->fetch(PDO::FETCH_ASSOC);

// Si no hay detalles previos, se puede insertar luego
if (!$bookDetails) {
    // Puedes crear un nuevo registro vacío si lo deseas, o mostrar un formulario vacío
    $bookDetails = [
        'rating' => 1,
        'review' => 'Escribe una reseña',
        'status' => 'not started',
        'copies' => 1,
    ];
}

// Procesar formulario si se envió
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rating = isset($_POST['rating']) ? (int) $_POST['rating'] : null;
    $review = trim($_POST['review'] ?? '');
    $status = $_POST['status'] ?? '';
    $copies = isset($_POST['copies']) ? (int) $_POST['copies'] : 1;

    // Verificar si existe entrada previa
    $stmtCheck = $pdo->prepare("SELECT id FROM book_details WHERE user_id = :user_id AND book_id = :book_id");
    $stmtCheck->execute([
        ':user_id' => $user_id,
        ':book_id' => $book_id
    ]);
    $exists = $stmtCheck->fetch();

    // Usar el collection_id obtenido de la tabla collection_books
    if ($exists) {
        // Actualizar
        $updateQuery = "UPDATE book_details SET rating = :rating, review = :review, status = :status, copies = :copies, collection_id = :collection_id, updated_at = NOW() WHERE user_id = :user_id AND book_id = :book_id";
    } else {
        // Insertar nuevo
        $updateQuery = "INSERT INTO book_details (user_id, book_id, rating, review, status, copies, collection_id, created_at, updated_at) VALUES (:user_id, :book_id, :rating, :review, :status, :copies, :collection_id, NOW(), NOW())";
    }

    $stmtUpdate = $pdo->prepare($updateQuery);
    $stmtUpdate->execute([
        ':user_id' => $user_id,
        ':book_id' => $book_id,
        ':rating' => $rating,
        ':review' => $review,
        ':status' => $status,
        ':copies' => $copies,
        ':collection_id' => $collection_id  // Usar el collection_id obtenido de la tabla collection_books
    ]);

    header("Location: book.php?id=" . $book_id . "&collection_id=" . $collection_id);
    exit();
}
