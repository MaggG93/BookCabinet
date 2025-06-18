<?php
include "../config/db.php";

// Función para obtener el nivel de usuario (free o premium)
function getUserLevel($pdo, $user_id)
{
    $sql = "SELECT level FROM users WHERE id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_id' => $user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Retornar el nivel de usuario (free o premium)
    return $user ? $user['level'] : 'free';  // Default a 'free' si no se encuentra el usuario
}

// Función para obtener las colecciones del usuario
function get_user_collections($user_id)
{
    global $pdo;

    // Validar que user_id es un entero válido
    if (!is_int($user_id) || $user_id <= 0) {
        return []; // Retorna un array vacío si el ID no es válido
    }

    $stmt = $pdo->prepare("SELECT id, title FROM collections WHERE user_id = ?");
    $stmt->execute([$user_id]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Devuelve todas las colecciones del usuario
}

// Función para contar los libros en una colección
function getUserCollectionCount($pdo, $userId)
{
    $sql = "SELECT COUNT(*) FROM collections WHERE user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_id' => $userId]);
    return $stmt->fetchColumn();
}

// Función para obtener los libros de una colección
function get_books_by_collection($collection_id)
{
    global $pdo; // Usa la conexión PDO

    $query = "
        SELECT b.*
        FROM books b
        INNER JOIN collection_books cb ON b.id = cb.book_id
        WHERE cb.collection_id = :collection_id
    ";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':collection_id', $collection_id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Función para eliminar un libro de la colección
function remove_book_from_collection($book_id, $collection_id)
{
    global $pdo;

    $query = "DELETE FROM collection_books WHERE book_id = :book_id AND collection_id = :collection_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':book_id', $book_id, PDO::PARAM_INT);
    $stmt->bindParam(':collection_id', $collection_id, PDO::PARAM_INT);

    return $stmt->execute();
}
