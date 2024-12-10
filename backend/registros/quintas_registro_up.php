<?php
session_start();

$conn = include(__DIR__ . '/../auth/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Iniciar la transacción
        $conn->begin_transaction();

        // Guardar datos en la sesión antes de procesarlos
        $_SESSION['form_data'] = $_POST;

        $id_sub_cat = filter_var($_POST['id_sub_cat'], FILTER_SANITIZE_STRING);
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

        $usuario = $_SESSION['id_uss'];
        $id_categoria = '1';


        // actualizar en sub_cat

        $sql = "UPDATE sub_cat_quinta 
                SET colonia = ?, precio = ?, horario_inicio = ?, horario_final = ?, dias = ?, info_extra = ?, direccion = ?, numero = ?, whatsapp = ?, facebook = ?, instagram = ?, fecha = ?, id_categoria = ? 
                WHERE id_sub_cat = ? AND id_uss = ?";

        // Preparar la consulta
        $stmt = $conn->prepare($sql);

        $stmt->bind_param("sssssssssssssii", $colonia, $precio, $horario_inicio, $horario_final, $dias, $info_extra, $direccion, $numero, $whatsapp, $facebook, $instagram, $fecha, $id_categoria, $id_sub_cat, $usuario);
        $stmt->execute();

        if ($stmt->affected_rows <= 0) {
            throw new Exception("Error al actualizar los datos en sub_cat.");
        }

        // Confirmar la transacción
        $conn->commit();

        // Limpiar datos de la sesión
        unset($_SESSION['form_data']);
            echo "Datos insertados correctamente.";
        header('Location: /../frontend/quinta/list.php');
        exit();
    } catch (Exception $e) {
        $conn->rollback();  // Revertir los cambios si ocurre un error
        error_log("Error: " . $e->getMessage());
        $_SESSION['error_message'] = "Ocurrió un error al procesar tu solicitud. Inténtalo de nuevo.";
        header('Location: /../frontend/quinta/list.php');
        exit();
    } finally {
        // Cerrar las conexiones
        if (isset($stmt)) $stmt->close();
        $conn->close();
    }
}