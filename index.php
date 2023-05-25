<?php
session_start();
require_once 'includes/functions.php';

// Si el usuario ya ha iniciado sesión, redirigir al panel de control
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = getUserByEmailAndPassword($email, $password);

    if ($user) {
        $_SESSION['user_id'] = $user['IdUsuario'];
        header('Location: dashboard.php');
        exit();
    } else {
        $loginError = "Usuario no encontrado. Por favor, verifica tus credenciales.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Iniciar sesión</h1>
        <?php if (isset($loginError)) : ?>
            <div class="error"><?php echo $loginError; ?></div>
        <?php endif; ?>
        <form method="post" action="">
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Contraseña" required><br>
            <input type="submit" value="Iniciar sesión">
        </form>
        <p>¿No tienes una cuenta? <a href="register.php">Regístrate aquí</a></p>
    </div>
</body>
</html>
