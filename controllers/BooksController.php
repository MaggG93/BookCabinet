<?php
include "../config/db.php";
include "../config/functions.php";

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$book_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$collection_id = isset($_GET['collection_id']) ? (int) $_GET['collection_id'] : 0;

// 🧹 Lógica de eliminación
if (isset($_GET['action']) && $_GET['action'] === 'delete' && $book_id > 0 && $collection_id > 0) {
    // Verificar que la colección pertenece al usuario
    $query = "SELECT * FROM collections WHERE id = :collection_id AND user_id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ':collection_id' => $collection_id,
        ':user_id' => $user_id
    ]);
    $collection = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$collection) {
        echo "No tienes permiso para modificar esta colección.";
        exit();
    }

    // Eliminar relación libro-colección
    $deleteRelation = "DELETE FROM collection_books WHERE book_id = :book_id AND collection_id = :collection_id";
    $stmt = $pdo->prepare($deleteRelation);
    $stmt->execute([
        ':book_id' => $book_id,
        ':collection_id' => $collection_id
    ]);

    // Comprobar si el usuario aún tiene el libro en otras colecciones
    $checkOtherCollections = "
        SELECT COUNT(*) FROM collection_books cb
        INNER JOIN collections c ON cb.collection_id = c.id
        WHERE cb.book_id = :book_id AND c.user_id = :user_id
    ";
    $stmt = $pdo->prepare($checkOtherCollections);
    $stmt->execute([
        ':book_id' => $book_id,
        ':user_id' => $user_id
    ]);

    $stillHasBook = $stmt->fetchColumn();

    if ($stillHasBook == 0) {
        // Eliminar detalles del usuario
        $deleteDetails = "DELETE FROM book_details WHERE book_id = :book_id AND user_id = :user_id";
        $stmt = $pdo->prepare($deleteDetails);
        $stmt->execute([
            ':book_id' => $book_id,
            ':user_id' => $user_id
        ]);
    }

    // Redirigir a la colección tras eliminar
    header("Location: dashboard.php?id=");
    exit();
}

// Validar ID
if ($book_id <= 0) {
    echo "ID de libro no válido.";
    exit();
}

// Obtener datos del libro
$query = "SELECT * FROM books WHERE id = :book_id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':book_id', $book_id, PDO::PARAM_INT);
$stmt->execute();
$book = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$book) {
    echo "Libro no encontrado.";
    exit();
}

// Obtener estado y puntuación del libro para el usuario (un solo query)
$queryStatus = "SELECT status, rating FROM book_details WHERE book_id = :book_id AND user_id = :user_id LIMIT 1";
$stmtStatus = $pdo->prepare($queryStatus);
$stmtStatus->bindParam(':book_id', $book_id, PDO::PARAM_INT);
$stmtStatus->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmtStatus->execute();
$statusRow = $stmtStatus->fetch(PDO::FETCH_ASSOC);
$status = $statusRow['status'] ?? null;
$rating = $statusRow['rating'] ?? null;

$paginaActual = basename($_SERVER['PHP_SELF']);
