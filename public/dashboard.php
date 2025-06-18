<?php
include "../config/db.php";
include "../config/functions.php";

// Obtener la página actual
$paginaActual = basename($_SERVER['PHP_SELF']);

// Iniciar sesión
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    // Redirigir al login si no está logueado
    header("Location: login.php");
    exit();
}

// Obtener el ID del usuario conectado
$user_id = $_SESSION['user_id'];

// Obtener las colecciones del usuario
$collections = get_user_collections($user_id); // Función que obtiene las colecciones del usuario
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookCabinet | Biblioteca</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/dashboard.css">
</head>

<body>
    <div class="dashboard-container">
        <!-- Sidebar de navegación -->
        <?php include "sidebar.php"; ?>

        <!-- Contenido principal -->
        <main class="main-content">
            <header>
                <h1>Mi Biblioteca</h1>
                <hr><br>
                <!-- Dropdown de colecciones -->

                <select id="collectionDropdown" class="collection-dropdown" style="margin-right: 10px">
                    <?php
                    if (!empty($collections)) {
                        $first = true; // Variable para marcar la primera iteración
                        foreach ($collections as $collection) {
                            $selected = $first ? "selected" : ""; // Selecciona solo la primera opción
                            echo "<option value='{$collection['id']}' $selected>{$collection['title']}</option>";
                            $first = false; // Después de la primera iteración, desactivamos esta selección
                        }
                    } else {
                        echo "<option value='' selected>No tienes colecciones</option>";
                    }
                    ?>
                </select>

                <input type="text" id="searchInput" placeholder="Buscar por título o autor..." class="book-search-input">

            </header>

            <div id="booksContainer"></div> <!-- Aquí se mostrarán los libros -->

        </main>
    </div>

    <script src="./js/dashboard.js"></script>
</body>

</html>