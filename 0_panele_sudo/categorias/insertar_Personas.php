<?php
include_once "../zConexion/verificar_sesion.php";
include_once "../zConexion/config.php";

// Obtener datos del formulario y escaparlos
$nombre = mysqli_real_escape_string($conn, $_POST['name']);
$ap_paterno = mysqli_real_escape_string($conn, $_POST['ap_Paterno']);
$ap_materno = mysqli_real_escape_string($conn, $_POST['ap_Materno']);
$fecha_nacimiento = mysqli_real_escape_string($conn, $_POST['fecha_Nacimiento']);
$sexo = mysqli_real_escape_string($conn, $_POST['sexo']);
$calle = mysqli_real_escape_string($conn, $_POST['calle']);
$cp = mysqli_real_escape_string($conn, $_POST['cp']);
$telefono_1 = mysqli_real_escape_string($conn, $_POST['telefono_1']);
$telefono_2 = mysqli_real_escape_string($conn, $_POST['telefono_2']);
$CURP = mysqli_real_escape_string($conn, $_POST['CURP']);
$RFC = mysqli_real_escape_string($conn, $_POST['RFC']);
$id_Usuario = $_SESSION['id_Usuario'];

// mysqli_real_escape_string() ayuda a prevenir ataques de inyección SQL al garantizar que 
// los datos ingresados por el usuario no puedan modificar la estructura de la consulta SQL.

$id_registro = $_POST['id_registro'];

// Si el ID de registro es 0, comprobamos la existencia del CURP
if ($id_registro == 0) {
    // Consulta para verificar duplicados
    $Ver_duplicado = "SELECT * FROM personas WHERE CURP = ?";
    // Preparar la consulta
    $statement = mysqli_prepare($conn, $Ver_duplicado);
    // Enlazar el parámetro CURP
    mysqli_stmt_bind_param($statement, "s", $CURP);
    // Ejecutar la consulta
    mysqli_stmt_execute($statement);
    // Almacenar el resultado
    mysqli_stmt_store_result($statement);
    // Contar las filas resultantes
    $existe = mysqli_stmt_num_rows($statement);

    // Si existe algún registro con el mismo CURP
    if ($existe > 0) {
        echo "YA";
    } else {
        // Insertar nuevo registro
        $insertar_consulta = "INSERT INTO personas(nombre, ap_Paterno, ap_Materno, fecha_Nacimiento, sexo, calle, cp, telefono_1, telefono_2, CURP, RFC, id_Usuario) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        // Preparar la consulta
        $statement_insertar = mysqli_prepare($conn, $insertar_consulta);
        // Enlazar los parámetros
        mysqli_stmt_bind_param($statement_insertar, "sssssssssssi", $nombre, $ap_paterno, $ap_materno, $fecha_nacimiento, $sexo, $calle, $cp, $telefono_1, $telefono_2, $CURP, $RFC, $id_Usuario);
        // Ejecutar la consulta
        $resultado_insertar = mysqli_stmt_execute($statement_insertar);
        // Verificar el resultado de la inserción
        if ($resultado_insertar) {
            echo "ok";
        } else {
            echo "error";
        }
        // Cerrar la consulta preparada
        mysqli_stmt_close($statement_insertar);
    }
} else {
    // Actualizar registro existente
    $cadena_actualizar = "UPDATE personas SET nombre = ?, ap_Paterno = ?, ap_Materno = ?, fecha_Nacimiento = ?, sexo = ?, calle = ?, cp = ?, telefono_1 = ?, telefono_2 = ?, RFC = ? , id_Usuario = ?  WHERE id_Persona = ?";
    // Preparar la consulta
    $statement_actualizar = mysqli_prepare($conn, $cadena_actualizar);
    // Enlazar los parámetros
    mysqli_stmt_bind_param($statement_actualizar, "ssssssssssii", $nombre, $ap_paterno, $ap_materno, $fecha_nacimiento, $sexo, $calle, $cp, $telefono_1, $telefono_2, $RFC, $id_Usuario, $id_registro);
    // Ejecutar la consulta
    $resultado_actualizar = mysqli_stmt_execute($statement_actualizar);
    // Verificar el resultado de la actualización
    if ($resultado_actualizar) {
        echo "ok";
    } else {
        echo "error";
    }
    // Cerrar la consulta preparada
    mysqli_stmt_close($statement_actualizar);
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>