<?php
// Verificar si el archivo está siendo accedido directamente
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    http_response_code(403);
    die('Acceso denegado.');
}

return [
    'servername' => 'localhost',
    'username' => 'u734923132_Chuk_Nub',
    'password' => 'E=8w~?:q4',
    'dbname' => 'u734923132_Mer_ka_C_tin',
];