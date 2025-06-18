<?php
// Incluir los archivos de configuración y funciones necesarias
include "../config/db.php";  // Conexión a la base de datos
include "../config/functions.php";  // Funciones personalizadas

// Obtener el nombre de la página actual para posibles redirecciones
$paginaActual = basename($_SERVER['PHP_SELF']);

// Iniciar sesión
session_start();

// Verificar si el usuario está logueado, si no redirigir a login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");  // Redirigir a la página de login si no está logueado
    exit();
}

$user_id = $_SESSION['user_id'];  // Obtener el ID del usuario logueado

// Inicializar variables para el éxito y el error de la creación de la colección
$collectionSuccess = false;
$collectionError = "";

// Obtener el nivel del usuario (por ejemplo, 'premium' o 'free')
$userLevel = getUserLevel($pdo, $user_id);

// Obtener el número de colecciones actuales del usuario
$currentCollections = getUserCollectionCount($pdo, $user_id);

// Establecer el límite de colecciones para los usuarios gratuitos
$maxCollections = 10;

// Procesar el formulario para agregar una nueva colección
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_collection'])) {

    // Verificar si el usuario free ha alcanzado el límite de colecciones
    if ($userLevel !== 'premium' && $currentCollections >= $maxCollections) {
        $collectionError = "Has alcanzado el número máximo de colecciones permitidas en tu plan gratuito.";
    } else {
        // Obtener los datos del formulario y sanitizarlos
        $title = htmlspecialchars(trim($_POST['title']));  // Título de la colección
        $description = htmlspecialchars(trim($_POST['description']));  // Descripción de la colección

        // Verificar la longitud de los campos y si están vacíos
        if (strlen($title) > 40) {
            $collectionError = "El título de la colección no puede tener más de 40 caracteres.";
        } elseif (strlen($description) > 250) {
            $collectionError = "La descripción no puede tener más de 250 caracteres.";
        } elseif (empty($title) || empty($description)) {
            $collectionError = "Todos los campos son obligatorios.";  // Mensaje de error si falta algún campo
        } else {
            // Verificar si ya existe una colección con el mismo título para este usuario
            $checkSql = "SELECT COUNT(*) FROM collections WHERE title = :title AND user_id = :user_id";
            $checkStmt = $pdo->prepare($checkSql);
            $checkStmt->execute(['title' => $title, 'user_id' => $user_id]);
            $exists = $checkStmt->fetchColumn();  // Comprobar si ya existe una colección con el mismo título

            // Si ya existe, mostrar un error
            if ($exists) {
                $collectionError = "Ya tienes una colección con ese título.";
            } else {
                // Insertar la nueva colección en la base de datos
                $sql = "INSERT INTO collections (title, description, user_id) VALUES (:title, :description, :user_id)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':title', $title);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':user_id', $user_id);

                try {
                    $stmt->execute();  // Ejecutar la inserción de la colección
                    header("Location: add-collections.php?success=1");  // Redirigir a la misma página con mensaje de éxito
                    exit();
                } catch (PDOException $e) {
                    // En caso de error al agregar la colección, mostrar un mensaje y loguear el error
                    error_log("Error al agregar colección: " . $e->getMessage());
                    $collectionError = "Hubo un problema al agregar la colección. Inténtalo más tarde.";
                }
            }
        }
    }
}
