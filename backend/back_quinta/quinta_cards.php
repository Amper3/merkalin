<?php
// Conexión a la base de datos
$conn = include(__DIR__ . '/../auth/db.php');  // Ruta absoluta a db.php

$stmt = $conn->prepare("
    SELECT sub_cat_quinta.*, img_sub_cat.ruta_imagen
    FROM sub_cat_quinta
    LEFT JOIN img_sub_cat ON sub_cat_quinta.id_sub_cat = img_sub_cat.id_sub_cat
    WHERE sub_cat_quinta.activo = 1
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
            $info = $fila['info_extra'];
            $dias = $fila['dias'];
            // $texto = $info .', Abierto: '. $dias;
            $texto = 'Días: '. $dias;


            // Si el ID no existe, crear la entrada con las imágenes en un array
            $datos[$id_sub_cat] = [
                'id_sub_cat' => $fila['id_sub_cat'],
                'nombre' => $fila['nombre'],
                'colonia' => $fila['colonia'],
                'precio' => $fila['precio'],
                'horario' => $fila['horario_inicio'] . ' - ' . $fila['horario_final'],
                'info_extra' => $info,
                'dias' => $texto,
                'phone' => $fila['numero'],
                'whatsapp' => $fila['whatsapp'],
                'facebook' => $fila['facebook'],
                'instagram' => $fila['instagram'],
                'address' => $fila['direccion'],
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
