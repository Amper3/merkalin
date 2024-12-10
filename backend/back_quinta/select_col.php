<?php
$conn = include(__DIR__ . '/../auth/db.php');  // Ruta a db.php


$stmt = $conn->prepare("SELECT colonia FROM colonias");
$stmt->execute();
$resultado = $stmt->get_result();

$colonias = [];

if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $colonias[] = $row;
    }
}
$stmt->close();
$conn->close();
header('Content-Type: application/json');
echo json_encode($colonias);
?>
