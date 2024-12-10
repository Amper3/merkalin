<?php
// db_connect.php
// $config = include('../../conn/config.php');
$config = include(__DIR__ . '/../../conn/config.php');  // Ruta absoluta a config.php

$conn = new mysqli(
    $config['servername'],
    $config['username'],
    $config['password'],
    $config['dbname']
);

// Verificar la conexión
if ($conn->connect_error) {
    error_log("Conexión fallida: " . $conn->connect_error); // Log error en un archivo
    die("Ocurrió un error al conectar con la base de datos. Por favor, intenta nuevamente más tarde."); // Mensaje genérico para el usuario
}

return $conn;
?>
