<?php
include "../controllers/add-collections.php"; // Incluir el controlador
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookCabinet | Agregar Colecciones</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/add-collections.css">
</head>

<body>
    <div class="dashboard-container">
        <?php include "sidebar.php"; ?> <!-- Incluir barra lateral -->

        <main class="main-content">
            <header>
                <h1>Agregar Colección</h1>
                <hr><br>
                <h2 class="collection-count">
                    <?php
                    if ($userLevel === 'premium') {
                        echo "Actualmente tienes $currentCollections colecciones.";
                    } else {
                        echo "Actualmente tienes ($currentCollections de $maxCollections) colecciones.";
                    }
                    ?>
                </h2>

                <form method="POST" action="">
                    <label for="title">Título de la Colección</label>
                    <input type="text" name="title" id="title" required maxlength="40" placeholder="Título de la colección" value="<?= isset($title) ? htmlspecialchars($title) : '' ?>">
                    <small><em>Límite de 40 caracteres. p.ej. (Mis libros, Lista de deseos, Mi biblioteca, favoritos).</em></small>

                    <label for="description">Descripción</label>
                    <textarea name="description" id="description" required maxlength="250" placeholder="Descripción breve de la colección"><?= isset($description) ? htmlspecialchars($description) : '' ?></textarea>
                    <small><em>Límite de 250 caracteres. p.ej. (Puedes mencionar el tipo de libros, temática o cualquier detalle que la identifique).</em></small>

                    <button type="submit" name="add_collection">Agregar</button>

                    <!-- Mostrar mensajes de error o éxito -->
                    <?php if (!empty($collectionError)): ?>
                        <p class="error"><?= $collectionError; ?></p>
                    <?php elseif (isset($_GET['success'])): ?>
                        <p class="success">Colección agregada correctamente.</p>
                    <?php endif; ?>

                </form>
            </header>
        </main>
    </div>
</body>

</html>