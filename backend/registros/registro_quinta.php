<?php
// Mostrar todos los datos recibidos en el backend
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<pre>";
    print_r($_POST); // Datos del formulario (excluye archivos)
    print_r($_FILES); // Datos de los archivos subidos (si los hay)
    echo "</pre>";
}
?>
