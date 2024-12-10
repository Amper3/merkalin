<?php
session_start();

// Conectar con la base de datos
$conn = include(__DIR__ . '/../auth/db.php');

// Verificar sesión
if (!isset($_SESSION['id_uss'])) {
    echo json_encode(['error' => 'No estás autenticado.']);
    exit;
}

$usuario = $_SESSION['id_uss'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_sub_cat'], $_POST['imageType'], $_POST['nombre'], $_FILES['new_image'])) {
    $id_sub_cat = intval($_POST['id_sub_cat']);
    $imageType = $_POST['imageType'];
    $nombre = $_POST['nombre'];
    $file = $_FILES['new_image'];

    $allowedTypes = ['principal', 'secundaria_1', 'secundaria_2', 'secundaria_3'];
    if (!in_array($imageType, $allowedTypes)) {
        echo json_encode(['error' => 'Tipo de imagen inválido.']);
        exit;
    }

    // Obtener ruta actual
    $stmt = $conn->prepare("SELECT ruta_imagen FROM img_sub_cat WHERE id_sub_cat = ? AND ruta_imagen LIKE CONCAT('%', ?, '%')");
    $stmt->bind_param("is", $id_sub_cat, $imageType);
    $stmt->execute();
    $result = $stmt->get_result();
    $currentImage = $result->fetch_assoc()['ruta_imagen'] ?? null;

    // Si ya existe la imagen actual, borrarla
    if ($currentImage && file_exists($currentImage)) {
        unlink($currentImage); // Borrar imagen actual
    }

    $targetDir = "../../frontend/quinta/img_sub_cat";
    $fileExtension = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));

    $nombre = preg_replace('/[^a-zA-Z0-9áéíóúÁÉÍÓÚñÑ_-]/u', '_', $_POST['nombre']);
    $newFileName = $nombre . "_" . $imageType . "." . $fileExtension;
    $targetFile = $targetDir . "/" . $newFileName;

    // Si el archivo se sube correctamente, se procesa la actualización
    if (move_uploaded_file($file["tmp_name"], $targetFile)) {
        // Verificar si la imagen realmente cambió
        $imageChanged = ($currentImage !== $targetFile);

        if ($imageChanged) {
            // Actualizamos la base de datos solo si la imagen cambió
            $stmt = $conn->prepare("UPDATE img_sub_cat SET ruta_imagen = ? WHERE id_sub_cat = ? AND ruta_imagen LIKE CONCAT('%', ?, '%')");
            $stmt->bind_param("sis", $targetFile, $id_sub_cat, $imageType);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo json_encode(['success' => true, 'new_image' => $targetFile, 'old_image' => $currentImage]);
            } else {
                echo json_encode(['error' => 'No se pudo actualizar la base de datos.']);
            }
        } else {
            // Si no cambió la imagen, enviamos un mensaje de éxito sin actualizar la base de datos
            echo json_encode(['success' => true, 'message' => 'La imagen no ha cambiado.']);
        }
    } else {
        echo json_encode(['error' => 'Error al subir la nueva imagen.']);
    }
} else {
    echo json_encode(['error' => 'Solicitud no válida.']);
}

$conn->close();
?>
