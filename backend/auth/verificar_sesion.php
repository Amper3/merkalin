<?php
session_start();

// // Configuración estricta de cookies para la sesión
// session_set_cookie_params([
//     'lifetime' => 0,  // Expira al cerrar el navegador
//     'path' => '/',
//     // 'domain' => 'example.com',  // Cambia a tu dominio
//     'secure' => true,  // Solo transmisión por HTTPS
//     'httponly' => true,  // No accesible por JavaScript
//     'samesite' => 'Strict'  // Restricción de cookies de terceros
// ]);

// Verificación de sesión iniciada
if (!isset($_SESSION["id_uss"])) {
    header("Location: /../frontend");
    exit();
}

// Tiempo máximo de inactividad en segundos (10 minutos)
$max_session_time = 600;

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $max_session_time)) {
    // Destruir sesión y redirigir
    session_unset();
    session_destroy();
    setcookie(session_name(), '', time() - 3600, '/');  // Borrar la cookie de sesión
    header("Location: /../frontend");
    exit();
}

// Actualización del tiempo de última actividad
$_SESSION['LAST_ACTIVITY'] = time();

// Regeneración periódica de ID de sesión para evitar fijación de sesión
if (!isset($_SESSION['CREATED'])) {
    $_SESSION['CREATED'] = time();
} elseif (time() - $_SESSION['CREATED'] > $max_session_time) {
    session_regenerate_id(true);  // Regenera el ID y borra el antiguo
    $_SESSION['CREATED'] = time();
}

// Generación de un token CSRF si no existe
if (!isset($_SESSION["token"]) || empty($_SESSION["token"])) {
    $_SESSION["token"] = bin2hex(random_bytes(32));
}

// Verificación del token CSRF solo para solicitudes POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (empty($_POST["token"]) || !hash_equals($_SESSION["token"], $_POST["token"])) {
        header("HTTP/1.1 403 Forbidden");
        die("Token CSRF inválido");
    }
    // Invalida el token usado para proteger contra reutilización
    unset($_SESSION["token"]);
}

// Puedes agregar validación de origen si es necesario
// if ($_SERVER["REQUEST_METHOD"] === "POST") {
//     $valid_referer = "https://example.com";  // Cambia a tu dominio
//     if (!isset($_SERVER['HTTP_ORIGIN']) || $_SERVER['HTTP_ORIGIN'] !== $valid_referer) {
//         header("HTTP/1.1 403 Forbidden");
//         die("Solicitud no permitida");
//     }
// }
?>