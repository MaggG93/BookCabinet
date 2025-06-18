<?php
// Incluir la configuración de la base de datos
include "../config/db.php";

// Iniciar sesión
session_start();

// Verificar si el usuario ya está logueado y redirigirlo al dashboard
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}

// Procesar el formulario cuando se envíe por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Recoger y limpiar los datos recibidos del formulario
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $country = $_POST['country'];
    $plan = isset($_POST['plan']) ? $_POST['plan'] : '';

    // Validaciones de los campos del formulario
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password) || empty($country) || empty($plan)) {
        $error = "Por favor, complete todos los campos.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "El correo electrónico no es válido.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username)) {
        $error = "El nombre de usuario debe tener entre 3 y 20 caracteres y solo puede contener letras, números y guiones bajos.";
    } elseif ($password !== $confirm_password) {
        $error = "Las contraseñas no coinciden.";
    } else {
        // Verificar si el usuario ya existe en la base de datos
        $sql = "SELECT id FROM users WHERE username = :username OR email = :email LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['username' => $username, 'email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Si el usuario ya existe, mostrar error
        if ($user) {
            $error = "El nombre de usuario o el correo electrónico ya están registrados.";
        } else {
            // Hashear la contraseña
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            // Insertar el nuevo usuario en la base de datos
            $sql = "INSERT INTO users (username, email, password_hash, country, level) VALUES (:username, :email, :password_hash, :country, :level)";
            $stmt = $pdo->prepare($sql);

            try {
                // Intentar ejecutar la consulta de inserción
                if ($stmt->execute([
                    'username' => $username,
                    'email' => $email,
                    'password_hash' => $password_hash,
                    'country' => $country,
                    'level' => $plan
                ])) {
                    // Si la inserción es exitosa, redirigir al login
                    $_SESSION['success'] = "Usuario registrado con éxito. Ahora puedes iniciar sesión.";
                    header('Location: login.php');
                    exit;
                } else {
                    throw new Exception("Hubo un error al registrar el usuario.");
                }
            } catch (Exception $e) {
                // Si ocurre un error, mostrar mensaje de error
                $error = "Error: " . htmlspecialchars($e->getMessage());
            }
        }
    }
}
