<?php
// Conexión a la base de datos
session_start();

$conn = include(__DIR__ . '/../auth/db.php');  // Ruta absoluta a db.php

$usuario = $_SESSION['id_uss'];

$stmt = $conn->prepare("
    SELECT sub_cat_quinta.*, img_sub_cat.ruta_imagen
    FROM sub_cat_quinta
    LEFT JOIN img_sub_cat ON sub_cat_quinta.id_sub_cat = img_sub_cat.id_sub_cat
    WHERE sub_cat_quinta.id_uss = $usuario
    ORDER BY sub_cat_quinta.nombre
");
$stmt->execute();
$resultado = $stmt->get_result();

$datos = [];

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $id_sub_cat = $fila['id_sub_cat'];

        // Si el ID ya existe en el array, agregar la imagen al subarray de imágenes
        if (isset($datos[$id_sub_cat])) {
            $datos[$id_sub_cat]['imagenes'][] = $fila['ruta_imagen'];
        } else {
            // Si el ID no existe, crear la entrada con las imágenes en un array
            $datos[$id_sub_cat] = [
                'id_sub_cat' => $fila['id_sub_cat'],
                'nombre' => $fila['nombre'],
                'colonia' => $fila['colonia'],
                'precio' => $fila['precio'],
                'horario_inicio' => $fila['horario_inicio'],
                'horario_final' => $fila['horario_final'],
                'info_extra' => $fila['info_extra'],
                'dias' => $fila['dias'],
                'address' => $fila['direccion'],
                'phone' => $fila['numero'],
                'whatsapp' => $fila['whatsapp'],
                'facebook' => $fila['facebook'],
                'instagram' => $fila['instagram'],
                'imagenes' => [$fila['ruta_imagen']]
            ];
        }
    }
}

// Convertir a un array indexado
$datos = array_values($datos);

echo json_encode($datos);

$conn->close();
?>
