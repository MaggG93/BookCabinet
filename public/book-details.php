<?php
include "../controllers/edit-details.php"; // Incluir el controlador
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>BookCabinet | <?php echo htmlspecialchars($book['title']); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/book-details.css">
</head>

<body>

    <div class="dashboard-container">

        <!-- Sidebar de navegación -->
        <?php include "sidebar.php"; ?>

        <main class="main-content">
            <header>
                <h1><?php echo htmlspecialchars($book['title']); ?></h1>

                <!-- Navegador para cambiar entre formularios -->
                <nav class="nav-tabs">
                    <ul>
                        <li>
                            <a href="book.php?id=<?php echo $book_id; ?>&collection_id=<?php echo $collection_id; ?>"
                                <?php echo ($paginaActual === 'book.php') ? 'class="active"' : ''; ?>>
                                <i class="fas fa-book"></i> Libro
                            </a>
                        </li>
                        <li>
                            <a href="book-details.php?id=<?php echo $book_id; ?>"
                                <?php echo ($paginaActual === 'book-details.php') ? 'class="active"' : ''; ?>>
                                <i class="fas fa-info-circle"></i> Detalles
                            </a>
                        </li>
                    </ul>
                </nav>
                <br>
                <hr>
                <br>

            </header>

            <form method="POST">
                <label for="rating">Puntuación (1-5)</label>
                <input type="number" name="rating" id="rating" min="1" max="5" value="<?php echo htmlspecialchars($bookDetails['rating']); ?>">

                <label for="review">Reseña</label>
                <textarea name="review" id="review" rows="5"><?php echo htmlspecialchars($bookDetails['review']); ?></textarea>

                <label for="status">Estado</label>
                <select name="status" id="status" required>
                    <option value="">Seleccionar</option>
                    <option value="not started" <?php if ($bookDetails['status'] === 'not started') echo 'selected'; ?>>No empezado</option>
                    <option value="reading" <?php if ($bookDetails['status'] === 'reading') echo 'selected'; ?>>Leyendo</option>
                    <option value="completed" <?php if ($bookDetails['status'] === 'completed') echo 'selected'; ?>>Completado</option>
                    <option value="abandoned" <?php if ($bookDetails['status'] === 'abandoned') echo 'selected'; ?>>Abandonado</option>
                </select>

                <label for="copies">Copias</label>
                <input type="number" name="copies" id="copies" min="1" value="<?php echo htmlspecialchars($bookDetails['copies']); ?>">

                <button type="submit">Guardar</button>
            </form>

        </main>
    </div>

</body>

</html>