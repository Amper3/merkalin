<?php
// Conectar a la base de datos
$conn = include(__DIR__ . '/../auth/db.php');  // Ruta absoluta a db.php

$stmt = $conn->prepare("SELECT nombre FROM categorias WHERE activo = '1'");
$stmt->execute();
$resultado = $stmt->get_result();

$categorias = [];
if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        // Sanitizar la salida para prevenir XSS
        $categoria = htmlspecialchars($row['nombre'], ENT_QUOTES, 'UTF-8');

        // Agregar categoría a la lista de tarjetas con escapado seguro
        $categorias[] = "
        <div id='$categoria' class='card' style='background-image: url(/frontend/recursos/img_cat/$categoria.png);'>
            <div class='card-body'>
                <h5 class='card-title'>$categoria</h5>
            </div>
        </div>";
    }
} else {
    $categorias[] = "No se encontraron categorías.";
}

$conn->close();

// Salida controlada
echo implode("", $categorias);
?>