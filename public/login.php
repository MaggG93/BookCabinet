<?php
include "../controllers/LoginController.php"; // Incluir el controlador
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>BookCabinet | Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/login.css">
</head>

<body>

    <header class="header-login">
        <div class="logo-container">
            <img src="./images/magpie-bird-logo-design-simple-animal-in-circle-frame-vector-removebg-preview.png" alt="Logo" class="logo">
            <span class="site-name">BookCabinet</span>
        </div>

    </header>

    <div class="form-container">
        <h1>Iniciar sesión</h1>
        <h2>Accede a tu colección y optimiza su organización fácilmente</h2>
        <form action="login.php" method="POST">
            <label for="username">Usuario</label>
            <input type="text" id="username" name="username" placeholder="Tu usuario" required value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>"><br>

            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" placeholder="Tu contraseña" required value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>"><br>

            <button type="submit">Iniciar sesión</button>
            <br>
            <br>

            <!-- Mostrar mensaje de error -->
            <?php if (!empty($error_message)): ?>
                <p class="error-message"><?php echo $error_message; ?></p>
            <?php endif; ?>
            <br>

            <p>¿No tienes una cuenta? <a href="register.php">¡Regístrate!</a>.</p>
        </form>
    </div>

    <script src="./js/login.js"></script>
</body>

</html>