<?php
include "../controllers/add-by-manual.php"; // Incluir la lógica del controlador
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
                            <a href="add-books.php">
                                <i class="fas fa-search"></i> Buscar Libro
                            </a>
                        </li>
                        <li>
                            <a href="add-books-manual.php" class="active">
                                <i class="fas fa-keyboard"></i> Agregar manualmente
                            </a>
                        </li>
                    </ul>
                </nav> <br>
                <hr>
                <br>

                <!-- HTML para agregar libros de forma manual -->

                <form action="" method="POST" enctype="multipart/form-data">

                    <!-- Selección de colección -->

                    <label for="collection_id">Selecciona una colección</label>
                    <select name="collection_id" id="collection_id" required>
                        <option value="">Seleccione una colección</option>
                        <?php foreach ($collections as $collection) : ?>
                            <option value="<?= $collection['id'] ?>"><?= $collection['title'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <small><em>Selecciona la colección a la que deseas agregar el libro.</em></small>

                    <!-- Título y autor -->

                    <label for="book_title">Título</label>
                    <input type="text" id="book_title" name="book_title" value="<?= $bookTitle ?? '' ?>" required placeholder="Título del libro">

                    <label for="book_author">Autor</label>
                    <input type="text" id="book_author" name="book_author" value="<?= $bookAuthor ?? '' ?>" placeholder="Nombre del autor/ra">

                    <!-- Fecha de publicación y categorías -->
                    <label for="book_publication_date">Fecha de publicación</label>
                    <input type="date" id="book_publication_date" name="book_publication_date" value="<?= $bookPublicationDate ?? '' ?>">

                    <label for="book_categories">Categoría</label>
                    <input type="text" id="book_categories" name="book_categories" value="<?= $bookCategories ?? '' ?>" placeholder="Ej. Terror, Fantasía, Ciencia ficción...">

                    <!-- Páginas, editorial e ISBN -->
                    <label for="book_pages">Número de páginas</label>
                    <input type="number" id="book_pages" name="book_pages" value="<?= $bookPages ?? '' ?>" placeholder="Ej. 320">

                    <label for="book_publisher">Editorial</label>
                    <input type="text" id="book_publisher" name="book_publisher" value="<?= $bookPublisher ?? '' ?>" placeholder="Nombre de la editorial">

                    <!-- ISBN y descripción -->
                    <label for="book_isbn">ISBN 13</label>
                    <input type="text" id="book_isbn" name="book_isbn" value="<?= $bookIsbn ?? '' ?>" maxlength="15" placeholder="ISBN del libro">
                    <small><em>Solo números. Máximo 13 dígitos.</em></small>

                    <label for="book_description">Descripción</label>
                    <textarea id="book_description" name="book_description" placeholder="Descripción del libro" maxlength="750"><?= $bookDescription ?? '' ?></textarea>

                    <!-- Imagen de portada -->
                    <label for="cover_image">Imagen de portada</label>
                    <input type="file" id="cover_image" name="cover_image" accept="image/*" required>

                    <small><em>Subir archivo jpeg y png. Máx. 2MB.</em></small>

                    <!-- Acción de agregar libro -->
                    <button type="submit" name="add_by_manual">Agregar</button>

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