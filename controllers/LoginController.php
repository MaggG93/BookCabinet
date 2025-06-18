<?php
// Incluir el archivo de configuración para la conexión a la base de datos
include "../config/db.php";

// Inicia la sesión para poder manejar datos del usuario
session_start();

// Verificar si el usuario ya está logueado
// Si es así, redirigir al dashboard para evitar que acceda al login nuevamente
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}

// Variable para almacenar posibles mensajes de error
$error_message = '';

// Procesar el formulario de login cuando se recibe una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir los datos del formulario y eliminar espacios adicionales
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validar que los campos no estén vacíos
    if (empty($username) || empty($password)) {
        $error_message = "Por favor, complete todos los campos.";
        // Validar que el nombre de usuario cumpla con el formato esperado (4-20 caracteres, solo letras, números y guiones bajos)
    } elseif (!preg_match('/^[a-zA-Z0-9_]{4,20}$/', $username)) {
        $error_message = "El usuario debe tener de 4 a 20 caracteres y solo incluir letras, números y guiones bajos.";
        // Validar que la contraseña tenga al menos 6 caracteres
    } elseif (strlen($password) < 6) {
        $error_message = "La contraseña debe tener al menos 6 caracteres.";
    } else {
        // Preparar la consulta SQL para verificar si el usuario existe en la base de datos
        $sql = "SELECT id, username, password_hash FROM users WHERE username = :username LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['username' => $username]);

        // Verificar si el usuario fue encontrado en la base de datos
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Verificar que la contraseña proporcionada coincida con la contraseña almacenada en la base de datos
            if (password_verify($password, $user['password_hash'])) {
                // Si la contraseña es correcta, iniciar sesión
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                // Redirigir al usuario al dashboard
                header('Location: dashboard.php');
                exit;
            } else {
                // Si la contraseña es incorrecta, mostrar un mensaje de error
                $error_message = "Usuario o contraseña incorrectos.";
            }
        } else {
            // Si no se encuentra al usuario, mostrar un mensaje de error
            $error_message = "Usuario o contraseña incorrectos.";
        }
    }
}
