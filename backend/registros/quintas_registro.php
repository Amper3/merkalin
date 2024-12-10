<?php
session_start();

$conn = include(__DIR__ . '/../auth/db.php');

// Función para mover archivos subidos y renombrarlos
function uploadFile($file, $targetDir, $imageType) {
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    $fileExtension = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));

    if ($file['error'] !== UPLOAD_ERR_OK) {
        error_log("Error en la subida del archivo: " . $file['error']);
        return null;
    }

    $maxFileSize = 20 * 1024 * 1024;  // Definir el tamaño máximo en bytes (20 MB)
    if (!in_array($fileExtension, $allowedTypes) || $file["size"] > $maxFileSize) {
        error_log("Archivo no permitido o demasiado grande.");
        return null;
    }

    global $nombre;
    $newFileName = $nombre . "_" . $imageType . "." . $fileExtension;
    $targetFile = $targetDir . "/" . $newFileName;

    if (move_uploaded_file($file["tmp_name"], $targetFile)) {
        return $targetFile;
    } else {
        error_log("No se pudo mover el archivo: " . $file["name"]);
        return null;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Iniciar la transacción
        $conn->begin_transaction();

        // Guardar datos en la sesión antes de procesarlos
        $_SESSION['form_data'] = $_POST;

        $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
        $colonia = filter_var($_POST['colonia'], FILTER_SANITIZE_STRING);
        $precio = filter_var($_POST['precio'], FILTER_SANITIZE_STRING);
        $horario_inicio = filter_var($_POST['horario_inicio'], FILTER_SANITIZE_STRING);
        $horario_final = filter_var($_POST['horario_final'], FILTER_SANITIZE_STRING);
        $dias = 'L-D';  // Valor por defecto

        if (isset($_POST['all_dias']) && $_POST['all_dias'] === 'all') {
            $dias = 'L-D';
        } elseif (!empty($_POST['dias'])) {
            $dias_seleccionados = $_POST['dias'];
            $dias = implode(',', array_map('filter_var', $dias_seleccionados, array_fill(0, count($dias_seleccionados), FILTER_SANITIZE_STRING)));
        }

        $info_extra = filter_var($_POST['info_extra'], FILTER_SANITIZE_STRING);
        $direccion = filter_var($_POST['direccion'], FILTER_SANITIZE_STRING);
        $numero = filter_var($_POST['numero'], FILTER_SANITIZE_STRING);
        $whatsapp = filter_var($_POST['whatsapp'], FILTER_SANITIZE_STRING);
        $facebook = filter_var($_POST['facebook'], FILTER_SANITIZE_STRING);
        $instagram = filter_var($_POST['instagram'], FILTER_SANITIZE_STRING);

        date_default_timezone_set('America/Monterrey');
        $fecha_actual = date('Y-m-d');
        $fecha = mysqli_real_escape_string($conn, $fecha_actual);

        $activo = '1';
        $usuario = $_SESSION['id_uss'];
        $id_categoria = '1';

        $targetDir = "../../frontend/quinta/img_sub_cat";

        $imagen_principal    = uploadFile($_FILES['imagen_principal'], $targetDir, "principal");
        $imagen_secundaria_1 = uploadFile($_FILES['imagen_secundaria_1'], $targetDir, "secundaria_1");
        $imagen_secundaria_2 = uploadFile($_FILES['imagen_secundaria_2'], $targetDir, "secundaria_2");
        $imagen_secundaria_3 = uploadFile($_FILES['imagen_secundaria_3'], $targetDir, "secundaria_3");

        if (!$imagen_principal) {
            throw new Exception("No se pudo subir la imagen principal.");
        }

        // Insertar en sub_cat
        $sql = "INSERT INTO sub_cat_quinta (nombre, colonia, precio, horario_inicio, horario_final, dias, info_extra, direccion, numero, whatsapp, facebook, instagram, fecha, activo, id_uss, id_categoria) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssssssssss", $nombre, $colonia, $precio, $horario_inicio, $horario_final, $dias, $info_extra, $direccion, $numero, $whatsapp, $facebook, $instagram, $fecha, $activo, $usuario, $id_categoria);
        $stmt->execute();

        if ($stmt->affected_rows <= 0) {
            throw new Exception("Error al insertar los datos en sub_cat.");
        }

        // Obtener el ID de la última inserción
        $id_sub_cat = $conn->insert_id;

        // Insertar en registros
        $sql_registros = "INSERT INTO registros (id_sub_cat, id_uss) VALUES (?, ?)";
        $stmt_registros = $conn->prepare($sql_registros);
        $stmt_registros->bind_param("ii", $id_sub_cat, $usuario);
        $stmt_registros->execute();

        if ($stmt_registros->affected_rows <= 0) {
            throw new Exception("Error al insertar los datos en registros.");
        }

        // Insertar en img_sub_cat
        $sql_rutas = "INSERT INTO img_sub_cat (ruta_imagen, id_sub_cat, id_uss) VALUES (?, ?, ?)";
        $stmt_rutas = $conn->prepare($sql_rutas);

        // Insertar imagen principal
        if ($imagen_principal) {
            $stmt_rutas->bind_param("sii", $imagen_principal, $id_sub_cat, $usuario);
            $stmt_rutas->execute();

            if ($stmt_rutas->affected_rows <= 0) {
                throw new Exception("Error al insertar la imagen principal.");
            }
        }

        // Insertar imágenes secundarias
        $secundarias = [$imagen_secundaria_1, $imagen_secundaria_2, $imagen_secundaria_3];
        foreach ($secundarias as $imagen_secundaria) {
            if ($imagen_secundaria) {
                $stmt_rutas->bind_param("sii", $imagen_secundaria, $id_sub_cat, $usuario);
                $stmt_rutas->execute();

                if ($stmt_rutas->affected_rows <= 0) {
                    throw new Exception("Error al insertar una imagen secundaria.");
                }
            }
        }

        // Confirmar la transacción
        $conn->commit();

        // Limpiar datos de la sesión
        unset($_SESSION['form_data']);
            echo "Datos insertados correctamente.";
        header('Location: /../frontend');
        exit();
    } catch (Exception $e) {
        $conn->rollback();  // Revertir los cambios si ocurre un error
        error_log("Error: " . $e->getMessage());
        $_SESSION['error_message'] = "Ocurrió un error al procesar tu solicitud. Inténtalo de nuevo.";
        header('Location: /../frontend/aRegistros/registro_quinta/registro_quinta.php');
        exit();
    } finally {
        // Cerrar las conexiones
        if (isset($stmt)) $stmt->close();
        if (isset($stmt_registros)) $stmt_registros->close();
        if (isset($stmt_rutas)) $stmt_rutas->close();
        $conn->close();
    }
}