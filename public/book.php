<?php
include "../controllers/BooksController.php"; // Incluir el controlador
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
    <link rel="stylesheet" href="./css/book.css">
</head>

<body>

    <div class="dashboard-container">

        <?php include "sidebar.php"; ?>

        <main class="main-content">
            <header>
                <h1><?php echo htmlspecialchars($book['title']); ?></h1>

                <nav class="nav-tabs">
                    <ul>
                        <li>
                            <a href="book.php?id=<?php echo $book_id; ?>"
                                class="<?php echo ($paginaActual === 'book.php') ? 'active' : ''; ?>">
                                <i class="fas fa-book"></i> Libro
                            </a>
                        </li>
                        <li>
                            <a href="book-details.php?id=<?php echo $book_id; ?>">
                                <i class="fas fa-info-circle"></i> Detalles
                            </a>
                        </li>
                        <li class="delete-book">
                            <a href="book.php?id=<?php echo $book_id; ?>&collection_id=<?php echo $collection_id; ?>&action=delete"
                                onclick="return confirm('¿Estás seguro de que quieres eliminar este libro de esta colección?');">
                                <i class="fas fa-trash-alt"></i> Eliminar
                            </a>
                        </li>
                    </ul>
                </nav>

                <br>
                <hr>
                <br>
            </header>

            <section class="book-details">
                <div class="book-top">
                    <div class="book-cover-container">
                        <img src="<?php echo htmlspecialchars($book['cover_image']); ?>"
                            alt="Portada de <?php echo htmlspecialchars($book['title']); ?>" class="book-cover">

                        <?php if (!empty($status)): ?>
                            <div class="book-status-label status-<?php echo strtolower(str_replace(' ', '-', $status)); ?>">
                                <?php echo htmlspecialchars($status); ?>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($rating)): ?>
                            <div class="book-rating">
                                <?php
                                $maxStars = 5;
                                $fullStars = floor($rating);
                                $halfStar = ($rating - $fullStars) >= 0.5;
                                $emptyStars = $maxStars - $fullStars - ($halfStar ? 1 : 0);

                                for ($i = 0; $i < $fullStars; $i++) {
                                    echo '<i class="fas fa-star"></i> ';
                                }
                                if ($halfStar) {
                                    echo '<i class="fas fa-star-half-alt"></i> ';
                                }
                                for ($i = 0; $i < $emptyStars; $i++) {
                                    echo '<i class="far fa-star"></i> ';
                                }
                                ?>
                            </div>
                        <?php endif; ?>


                    </div>
                    <div class="book-info">
                        <h2><?php echo htmlspecialchars($book['title']); ?></h2>
                        <h3>Autor: <?php echo htmlspecialchars($book['author']); ?></h3>
                        <p><strong>ISBN13:</strong> <?php echo htmlspecialchars($book['isbn_13']); ?></p>
                        <p><strong>Fecha de Publicación:</strong> <?php echo htmlspecialchars($book['publication_date']); ?>
                        </p>
                        <p><strong>Editorial:</strong> <?php echo htmlspecialchars($book['publisher']); ?></p>

                        <div class="book-description">
                            <h3>Descripción</h3>
                            <p><?php echo nl2br(htmlspecialchars($book['description'])); ?></p>
                        </div>
                    </div>
                </div>
            </section>

        </main>
    </div>

</body>

</html>