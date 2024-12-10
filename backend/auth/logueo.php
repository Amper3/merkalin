<?php
// Inicia la sesión del usuario
session_start();
$conn = include(__DIR__ . '/../auth/db.php');  // Ruta absoluta a db.php

$max_attempts = 3; // Define el límite de intentos fallidos

// Verifica si el usuario está bloqueado
if (isset($_SESSION['login_blocked_until']) && $_SESSION['login_blocked_until'] > time()) {
    header('Location: bloqueo.php');
    exit;
}

// Verifica si se ha alcanzado el límite de intentos fallidos
if (isset($_SESSION['login_attempts']) && $_SESSION['login_attempts'] >= $max_attempts) {
    $_SESSION['login_blocked_until'] = time() + 60; // Bloquea por 60 segundos
    unset($_SESSION['login_attempts']); // Reinicia el contador de intentos fallidos
    header('Location: bloqueo.php');
    exit;
}

// Procesa el intento de inicio de sesión si no hay bloqueo
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    // Consulta preparada para obtener el usuario
    $sql = "SELECT id_uss, phone, pwd FROM ussers WHERE phone = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $phone);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Verifica la contraseña
        if (password_verify($password, $user['pwd'])) {
            // Restablece los intentos fallidos y permite el acceso
            unset($_SESSION['login_attempts']);
            unset($_SESSION['login_blocked_until']);
            $_SESSION['id_uss'] = $user['id_uss'];

            // Establece un indicador de éxito
            $_SESSION['login_success'] = true;

            header('Location: /../frontend');
            exit;
        } else {
            // Contraseña incorrecta
            $_SESSION['login_attempts'] = isset($_SESSION['login_attempts']) ? $_SESSION['login_attempts'] + 1 : 1;
            $_SESSION['remaining_attempts'] = $max_attempts - $_SESSION['login_attempts'];
            header('Location: /../frontend/aLoguin/index.php');
            exit;
        }
    } else {
        // Usuario no encontrado
        $_SESSION['login_attempts'] = isset($_SESSION['login_attempts']) ? $_SESSION['login_attempts'] + 1 : 1;
        $_SESSION['remaining_attempts'] = $max_attempts - $_SESSION['login_attempts'];
        header('Location: /../frontend/aLoguin/index.php');
        exit;
    }
}
?>
