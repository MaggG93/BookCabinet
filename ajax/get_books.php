<?php
// Establece el tipo de contenido de la respuesta como JSON
header('Content-Type: application/json');

// Se incluyen los archivos de configuración: conexión a la base de datos y funciones auxiliares
include "../config/db.php";        // Conexión PDO a la base de datos
include "../config/functions.php"; // Función para obtener los libros de una colección

// Obtiene el ID de la colección desde la URL, con un valor predeterminado de 0 si no se encuentra
$collection_id = isset($_GET['collection_id']) ? (int)$_GET['collection_id'] : 0;

// Verifica si el ID de la colección es válido (mayor que 0)
if ($collection_id > 0) {
    // Llama a la función para obtener los libros asociados a la colección
    $books = get_books_by_collection($collection_id);

    // Si se encontraron libros, los convierte en formato JSON y los muestra
    if (!empty($books)) {
        echo json_encode($books);
    } else {
        // Si no se encontraron libros, muestra un mensaje de error en formato JSON
        echo json_encode(["error" => "No se encontraron libros para la colección."]);
    }
} else {
    // Si el ID de la colección no es válido, muestra un mensaje de error en formato JSON
    echo json_encode(["error" => "ID de colección no válido"]);
}
