<?php
include "../config/db.php";
include "../config/functions.php";

$paginaActual = basename($_SERVER['PHP_SELF']);
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$collections = get_user_collections($user_id);

// Variables de mensajes para cada sección
$exportSuccess = false;
$exportError = "";

$deleteCollectionSuccess = false;
$deleteCollectionError = "";

$passwordChangeSuccess = false;
$passwordChangeError = "";

$emailChangeSuccess = false;
$emailChangeError = "";

$usernameChangeSuccess = false;
$usernameChangeError = "";

$deleteAccountSuccess = false;
$deleteAccountError = "";

// Eliminar colección
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete_collection"])) {
    $collection_id = $_POST["collection_id"];

    if (empty($collection_id)) {
        $deleteCollectionError = "Por favor, selecciona una colección para eliminar.";
    } else {
        try {
            // Verifica que la colección pertenezca al usuario
            $stmt = $pdo->prepare("SELECT * FROM collections WHERE id = :id AND user_id = :user_id");
            $stmt->execute([
                ':id' => $collection_id,
                ':user_id' => $user_id
            ]);
            $collection = $stmt->fetch();

            if ($collection) {
                // Elimina los registros de la tabla intermedia
                $stmt = $pdo->prepare("DELETE FROM collection_books WHERE collection_id = :collection_id");
                $stmt->execute([':collection_id' => $collection_id]);

                // Elimina la colección
                $stmt = $pdo->prepare("DELETE FROM collections WHERE id = :id");
                $stmt->execute([':id' => $collection_id]);

                $deleteCollectionSuccess = "La colección se eliminó correctamente.";

                // Actualiza la lista de colecciones después de eliminar
                $collections = get_user_collections($user_id);
            } else {
                $deleteCollectionError = "No se encontró la colección o no tienes permiso para eliminarla.";
            }
        } catch (PDOException $e) {
            $deleteCollectionError = "Error al eliminar la colección: " . $e->getMessage();
        }
    }
}

// Cambiar contraseña 
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["change_password"])) {
    $current_password = trim($_POST["current_password"]);
    $new_password = trim($_POST["new_password"]);
    $confirm_password = trim($_POST["confirm_password"]);

    if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
        $passwordChangeError = "Por favor, rellena todos los campos.";
    } elseif ($new_password !== $confirm_password) {
        $passwordChangeError = "La nueva contraseña y su confirmación no coinciden.";
    } else {
        try {
            // Obtener el hash de la contraseña actual del usuario
            $stmt = $pdo->prepare("SELECT password_hash FROM users WHERE id = :id");
            $stmt->execute([':id' => $user_id]);
            $user = $stmt->fetch();

            if ($user && password_verify($current_password, $user['password_hash'])) {
                // Hashear la nueva contraseña
                $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);

                // Actualizar en la base de datos
                $stmt = $pdo->prepare("UPDATE users SET password_hash = :password_hash WHERE id = :id");
                $stmt->execute([
                    ':password_hash' => $new_password_hashed,
                    ':id' => $user_id
                ]);

                // Destruir sesión antes de redirigir
                session_destroy();
                header("Location: login.php");
                exit();
            } else {
                $passwordChangeError = "La contraseña actual no es correcta.";
            }
        } catch (PDOException $e) {
            $passwordChangeError = "Error al actualizar la contraseña: " . $e->getMessage();
        }
    }
}

// Cambiar email
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["change_email"])) {
    $current_email = trim($_POST["current_email"]);
    $new_email = trim($_POST["new_email"]);

    if (empty($current_email) || empty($new_email)) {
        $emailChangeError = "Por favor, rellena todos los campos.";
    } elseif (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
        $emailChangeError = "El nuevo correo electrónico no es válido.";
    } else {
        try {
            // Verificar que el email actual coincide con el del usuario
            $stmt = $pdo->prepare("SELECT email FROM users WHERE id = :id");
            $stmt->execute([':id' => $user_id]);
            $user = $stmt->fetch();

            if ($user && $user['email'] === $current_email) {
                // Verificar que el nuevo correo no esté en uso por otro usuario
                $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :new_email AND id != :id");
                $stmt->execute([':new_email' => $new_email, ':id' => $user_id]);
                $emailExists = $stmt->fetchColumn();

                if ($emailExists > 0) {
                    $emailChangeError = "El nuevo correo ya está registrado por otro usuario.";
                } else {
                    // Actualizar el correo
                    $stmt = $pdo->prepare("UPDATE users SET email = :email WHERE id = :id");
                    $stmt->execute([
                        ':email' => $new_email,
                        ':id' => $user_id
                    ]);

                    $emailChangeSuccess = "Correo electrónico actualizado correctamente.";
                }
            } else {
                $emailChangeError = "El correo electrónico actual no es correcto.";
            }
        } catch (PDOException $e) {
            $emailChangeError = "Error al actualizar el correo: " . $e->getMessage();
        }
    }
}

// Cambiar username 
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["change_username"])) {
    $new_username = trim($_POST["new_username"]);

    if (empty($new_username)) {
        $usernameChangeError = "El nombre de usuario no puede estar vacío.";
    } else {
        try {
            // Verificar si el nuevo nombre de usuario ya está en uso por otro usuario
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username AND id != :id");
            $stmt->execute([
                ':username' => $new_username,
                ':id' => $user_id
            ]);
            $usernameExists = $stmt->fetchColumn();

            if ($usernameExists > 0) {
                $usernameChangeError = "El nombre de usuario ya está en uso.";
            } else {
                // Actualizar el nombre de usuario
                $stmt = $pdo->prepare("UPDATE users SET username = :username WHERE id = :id");
                $stmt->execute([
                    ':username' => $new_username,
                    ':id' => $user_id
                ]);

                // Destruir sesión antes de redirigir
                session_destroy();
                header("Location: login.php");
                exit();
            }
        } catch (PDOException $e) {
            $usernameChangeError = "Error al actualizar el nombre de usuario: " . $e->getMessage();
        }
    }
}

// Eliminar cuenta

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete_account"])) {
    $confirmPassword = $_POST["confirm_delete_password"];

    if (empty($confirmPassword)) {
        $deleteAccountError = "Debes confirmar tu contraseña.";
    } else {
        try {
            // Obtener el hash actual de la base de datos
            $stmt = $pdo->prepare("SELECT password_hash FROM users WHERE id = :id");
            $stmt->execute([':id' => $user_id]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($confirmPassword, $user["password_hash"])) {

                // Eliminar registros relacionados si es necesario
                $pdo->beginTransaction();

                // Eliminar de la tabla collection_books 
                $stmt = $pdo->prepare("DELETE FROM collection_books WHERE collection_id IN (SELECT id FROM collections WHERE user_id = :id)");
                $stmt->execute([':id' => $user_id]);

                // Eliminar colecciones del usuario
                $stmt = $pdo->prepare("DELETE FROM collections WHERE user_id = :id");
                $stmt->execute([':id' => $user_id]);

                // Eliminar el usuario
                $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
                $stmt->execute([':id' => $user_id]);

                $pdo->commit();

                // Cerrar sesión y redirigir al login
                session_destroy();
                header("Location: login.php");
                exit();
            } else {
                $deleteAccountError = "La contraseña introducida no es correcta.";
            }
        } catch (PDOException $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
            $deleteAccountError = "Error al eliminar la cuenta: " . $e->getMessage();
        }
    }
}

// Exportar csv
// Exportar colección a CSV
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["export_csv_collection"])) {
    $collection_id = $_POST["collection_id"];

    if (empty($collection_id)) {
        $exportError = "Por favor, selecciona una colección para exportar.";
    } else {
        try {
            // Verifica que la colección pertenezca al usuario
            $stmt = $pdo->prepare("SELECT * FROM collections WHERE id = :id AND user_id = :user_id");
            $stmt->execute([
                ':id' => $collection_id,
                ':user_id' => $user_id
            ]);
            $collection = $stmt->fetch();

            if ($collection) {
                // Obtener los libros de la colección
                $stmt = $pdo->prepare("
                    SELECT b.title, b.author, b.publication_date, b.categories, b.pages, b.publisher, b.isbn_13, b.description
                    FROM books b
                    JOIN collection_books cb ON b.id = cb.book_id
                    WHERE cb.collection_id = :collection_id
                ");
                $stmt->execute([':collection_id' => $collection_id]);
                $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (count($books) === 0) {
                    $exportError = "La colección está vacía. No hay libros para exportar.";
                } else {
                    // Crear el nombre del archivo
                    $filename = "exportar_" . preg_replace('/[^a-zA-Z0-9]/', '_', $collection['title']) . ".csv";

                    // Enviar encabezados para descarga
                    header('Content-Type: text/csv; charset=utf-8');
                    header('Content-Disposition: attachment; filename=' . $filename);

                    // Abrir salida para escritura
                    $output = fopen('php://output', 'w');

                    // Escribir encabezados
                    fputcsv($output, [
                        'Título',
                        'Autor',
                        'Fecha de Publicación',
                        'Categorías',
                        'Páginas',
                        'Editorial',
                        'ISBN',
                        'Descripción'
                    ]);

                    // Escribir libros
                    foreach ($books as $book) {
                        fputcsv($output, [
                            $book['title'],
                            $book['author'],
                            $book['publication_date'],
                            $book['categories'],
                            $book['pages'],
                            $book['publisher'],
                            $book['isbn_13'],
                            $book['description']
                        ]);
                    }

                    fclose($output);
                    exit(); // Detener el resto del script, ya que se ha enviado la descarga
                }
            } else {
                $exportError = "No tienes permiso para exportar esta colección.";
            }
        } catch (PDOException $e) {
            $exportError = "Error al exportar la colección: " . $e->getMessage();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookCabinet | Configuración</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/settings.css">
</head>

<body>
    <div class="dashboard-container">
        <?php include "sidebar.php"; ?>

        <main class="main-content">
            <header>
                <h1>Configuración</h1>
                <hr>
            </header>

            <!-- Exportar colección -->
            <details>
                <summary>Exportar datos de una colección (CSV)</summary>
                <form action="" method="POST">
                    <div class="form-container">
                        <div class="form-row">
                            <div class="form-column">
                                <label for="collection_id">Selecciona una colección</label><br>
                                <select name="collection_id" id="collection_id" required>
                                    <option value="">Seleccione una colección</option>
                                    <?php foreach ($collections as $collection) : ?>
                                        <option value="<?= $collection['id'] ?>"><?= $collection['title'] ?></option>
                                    <?php endforeach; ?>
                                </select><br>
                                <small><em>Selecciona la colección que deseas exportar como un archivo CSV.</em></small>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" name="export_csv_collection">Exportar</button>
                            <?php if ($exportSuccess): ?><div class="success"><?= $exportSuccess ?></div><?php endif; ?>
                            <?php if ($exportError): ?><div class="error"><?= $exportError ?></div><?php endif; ?>
                        </div>
                    </div>
                </form>
            </details>

            <!-- Borrar colección -->
            <details>
                <summary>Eliminar colección</summary>
                <form action="" method="POST">
                    <div class="form-container">
                        <div class="form-row">
                            <div class="form-column">
                                <label for="collection_id">Selecciona una colección</label><br>
                                <select name="collection_id" id="collection_id" required>
                                    <option value="">Seleccione una colección</option>
                                    <?php foreach ($collections as $collection) : ?>
                                        <option value="<?= $collection['id'] ?>"><?= $collection['title'] ?></option>
                                    <?php endforeach; ?>
                                </select><br>
                                <small><em>Selecciona la colección que deseas eliminar.</em></small>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" name="delete_collection">Eliminar</button>
                            <?php if ($deleteCollectionSuccess): ?><div class="success"><?= $deleteCollectionSuccess ?></div><?php endif; ?>
                            <?php if ($deleteCollectionError): ?><div class="error"><?= $deleteCollectionError ?></div><?php endif; ?>
                        </div>
                    </div>
                </form>
            </details>

            <!-- Cambiar contraseña -->
            <details>
                <summary>Cambiar contraseña</summary>
                <form action="" method="POST">
                    <div class="form-container">
                        <div class="form-row">
                            <div class="form-column">
                                <label>Contraseña actual</label><br>
                                <input type="password" name="current_password" required><br>
                                <label>Nueva contraseña</label><br>
                                <input type="password" name="new_password" required><br>
                                <label>Confirmar nueva contraseña</label><br>
                                <input type="password" name="confirm_password" required>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" name="change_password">Guardar</button>
                            <?php if ($passwordChangeSuccess): ?><div class="success"><?= $passwordChangeSuccess ?></div><?php endif; ?>
                            <?php if ($passwordChangeError): ?><div class="error"><?= $passwordChangeError ?></div><?php endif; ?>
                        </div>
                    </div>
                </form>
            </details>

            <!-- Cambiar correo electrónico -->
            <details>
                <summary>Cambiar correo electrónico</summary>
                <form action="" method="POST">
                    <div class="form-container">
                        <div class="form-row">
                            <div class="form-column">
                                <label>Correo electrónico actual</label><br>
                                <input type="email" name="current_email" required><br>
                                <label>Nuevo correo electrónico</label><br>
                                <input type="email" name="new_email" required>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" name="change_email">Guardar</button>
                            <?php if ($emailChangeSuccess): ?><div class="success"><?= $emailChangeSuccess ?></div><?php endif; ?>
                            <?php if ($emailChangeError): ?><div class="error"><?= $emailChangeError ?></div><?php endif; ?>
                        </div>
                    </div>
                </form>
            </details>

            <!-- Cambiar nombre de usuario -->
            <details>
                <summary>Cambiar nombre de usuario</summary>
                <form action="" method="POST">
                    <div class="form-container">
                        <div class="form-row">
                            <div class="form-column">
                                <label>Nuevo nombre de usuario</label><br>
                                <input type="text" name="new_username" required>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" name="change_username">Guardar</button>
                            <?php if ($usernameChangeSuccess): ?><div class="success"><?= $usernameChangeSuccess ?></div><?php endif; ?>
                            <?php if ($usernameChangeError): ?><div class="error"><?= $usernameChangeError ?></div><?php endif; ?>
                        </div>
                    </div>
                </form>
            </details>

            <!-- Eliminar cuenta -->
            <details>
                <summary>Eliminar cuenta</summary>
                <form action="" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar tu cuenta? Esta acción no se puede deshacer.');">
                    <div class="form-container">
                        <div class="form-row">
                            <div class="form-column">
                                <label>Confirma tu contraseña</label><br>
                                <input type="password" name="confirm_delete_password" required><br>
                                <small><em><strong>Advertencia: </strong>Esta acción es irreversible. Todos tus datos serán eliminados.</em></small>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" name="delete_account" class="danger">Eliminar</button>
                            <?php if ($deleteAccountSuccess): ?><div class="success"><?= $deleteAccountSuccess ?></div><?php endif; ?>
                            <?php if ($deleteAccountError): ?><div class="error"><?= $deleteAccountError ?></div><?php endif; ?>
                        </div>
                    </div>
                </form>
            </details>

        </main>
    </div>
</body>

</html>