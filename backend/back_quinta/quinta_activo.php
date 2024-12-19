<?php
$conn = include(__DIR__ . '/../auth/db.php');  // Ruta absoluta a db.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $activo = $_POST['activo'] ?? null;

    if ($id && ($activo === "0" || $activo === "1")) {
        $stmt = $conn->prepare("UPDATE sub_cat_quinta SET activo = ? WHERE id_sub_cat = ?");
        if ($stmt->execute([$activo, $id])) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar el estado.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Parámetros inválidos.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
}
?>
