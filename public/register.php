<?php
include "../controllers/RegisterController.php"; // Incluir el controlador
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookCabinet | Registro</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/register.css">
</head>

<body>

    <h1>¡Regístrate en BookCabinet!</h1>
    <h2>La mejor forma de mantener tu colección literaria siempre a punto</h2>

    <div class="form-container">
        <form method="POST" action="register.php">
            <fieldset>
                <legend>Información de la Cuenta</legend>

                <div class="form-row">
                    <div class="form-column">
                        <label for="username">Usuario</label>
                        <input type="text" id="username" name="username" placeholder="Tu usuario" required value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>">
                    </div>

                    <div class="form-column">
                        <label for="email">Correo electrónico</label>
                        <input type="email" id="email" name="email" placeholder="Tu correo electrónico" required value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-column">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password" placeholder="Tu contraseña" required value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>">
                    </div>

                    <div class="form-column">
                        <label for="confirm_password">Confirmar contraseña</label>
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirma tu contraseña" required value="<?php echo isset($_POST['confirm_password']) ? $_POST['confirm_password'] : ''; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-column">
                        <label for="country">País</label>
                        <select id="country" name="country">
                            <option value="">Selecciona tu país</option>
                            <option value="ES" <?php echo isset($_POST['country']) && $_POST['country'] == 'ES' ? 'selected' : ''; ?>>España</option>
                            <option value="FR" <?php echo isset($_POST['country']) && $_POST['country'] == 'FR' ? 'selected' : ''; ?>>Francia</option>
                            <option value="DE" <?php echo isset($_POST['country']) && $_POST['country'] == 'DE' ? 'selected' : ''; ?>>Alemania</option>
                            <option value="IT" <?php echo isset($_POST['country']) && $_POST['country'] == 'IT' ? 'selected' : ''; ?>>Italia</option>
                            <option value="GB" <?php echo isset($_POST['country']) && $_POST['country'] == 'GB' ? 'selected' : ''; ?>>Reino Unido</option>
                            <option value="PT" <?php echo isset($_POST['country']) && $_POST['country'] == 'PT' ? 'selected' : ''; ?>>Portugal</option>
                            <option value="NL" <?php echo isset($_POST['country']) && $_POST['country'] == 'NL' ? 'selected' : ''; ?>>Países Bajos</option>
                            <option value="SE" <?php echo isset($_POST['country']) && $_POST['country'] == 'SE' ? 'selected' : ''; ?>>Suecia</option>
                            <option value="OT" <?php echo isset($_POST['country']) && $_POST['country'] == 'OT' ? 'selected' : ''; ?>>Otra opción</option>
                        </select>
                    </div>
                    <div class="form-column">
                        <label for="plan_select">Seleccionar un Plan</label>
                        <!-- El select se muestra pero no se envía -->
                        <select id="plan_select" disabled>
                            <option value="free" selected>Free</option>
                            <option value="premium">Premium</option>
                        </select>
                        <!-- El campo oculto es el que se enviará con valor 'free' -->
                        <input type="hidden" name="plan" value="free">
                    </div>

                </div>
            </fieldset>

            <div class="form-actions">
                <button type="submit">Registrarse</button>
            </div>
            <br>

            <!-- Mostrar mensaje de error -->
            <?php if (isset($error)): ?>
                <div class="error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <br>

            <p>¿Ya tienes cuenta? <a href="login.php">¡Inicia sesión!</a>.</p>
        </form>
    </div>
</body>

</html>