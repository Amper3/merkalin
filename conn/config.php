<?php
// Verificar si el archivo está siendo accedido directamente
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    http_response_code(403);
    die('Acceso denegado.');
}

return [
    'servername' => 'localhost',
    'username' => 'root',
    'password' => '',
    'dbname' => 'pruebas',
];