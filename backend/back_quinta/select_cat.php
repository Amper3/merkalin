<?php
$conn = include(__DIR__ . '/../auth/db.php');  // Ruta a db.php


$stmt = $conn->prepare("SELECT id_categoria, categoria FROM categorias WHERE activo = '1'");
$stmt->execute();
$resultado = $stmt->get_result();

$categorias = [];

if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $categorias[] = $row;
    }
}
$stmt->close();
$conn->close();
header('Content-Type: application/json');
echo json_encode($categorias);

?>
