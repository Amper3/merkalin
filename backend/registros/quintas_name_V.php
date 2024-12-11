<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$conn = include(__DIR__ . '/../auth/db.php');

// Lee los datos enviados por el cliente
$data = json_decode(file_get_contents('php://input'), true);
$nombre = $data['nombre'] ?? '';

if (empty($nombre)) {
    echo json_encode(['existe' => false]);
    exit;
}

$stmt = $conn->prepare("SELECT COUNT(*) AS total FROM sub_cat_quinta WHERE nombre = ?");
$stmt->bind_param('s', $nombre);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$stmt->close();
$conn->close();

echo json_encode(['existe' => $row['total'] > 0]);
