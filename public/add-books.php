<?php
include "../controllers/add-by-isbn.php"; // Incluir la lógica del controlador
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookCabinet | Agregar Libros</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/add-books.css">
</head>

<body>
    <div class="dashboard-container">
        <?php include "sidebar.php"; ?> <!-- Incluir barra lateral -->

        <main class="main-content">
            <header>
                <h1>Agregar Libro</h1>

                <!-- Navegador para cambiar entre formularios -->
                <nav class="nav-tabs">
                    <ul>
                        <li>
                            <a href="add-books.php" class="active">
                                <i class="fas fa-search"></i> Buscar Libro
                            </a>
                        </li>
                        <li>
                            <a href="add-books-manual.php">
                                <i class="fas fa-keyboard"></i> Agregar manualmente
                            </a>
                        </li>
                    </ul>
                </nav>
                <br>
                <hr>
                <br>

                <!-- Formulario igual a "agregar colecciones" -->
                <form action="" method="POST">

                    <label for="collection_id">Selecciona una colección</label>
                    <select name="collection_id" id="collection_id" required>
                        <option value="">Seleccione una colección</option>
                        <?php foreach ($collections as $collection) : ?>
                            <option value="<?= $collection['id'] ?>"><?= $collection['title'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <small><em>Selecciona la colección a la que deseas agregar el libro.</em></small>

                    <label for="isbn">ISBN 13</label>
                    <input type="text" id="isbn" name="isbn" required maxlength="15" placeholder="ISBN del libro" value="<?= isset($isbn) ? htmlspecialchars($isbn) : '' ?>">
                    <small><em>Busca por ISBN. La búsqueda por ISBN añadirá un libro automáticamente.</em></small>

                    <button type="submit" name="add_by_isbn">Buscar</button>

                    <!-- Mostrar mensajes de error o éxito -->
                    <?php if ($bookSuccess): ?>
                        <div class="success"><?= $bookSuccess ?></div>
                    <?php endif; ?>
                    <?php if ($bookError): ?>
                        <div class="error"><?= $bookError ?></div>
                    <?php endif; ?>

                </form>
            </header>
        </main>
    </div>
</body>

</html>