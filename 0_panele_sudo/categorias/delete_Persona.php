<?php
include_once "../zConexion/verificar_sesion.php";
include_once "../zConexion/config.php";


$id_registro = $_POST['id_registro'];

// Verificar si la solicitud es mediante POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $eliminar = $conn->prepare("DELETE FROM personas WHERE id_Persona = ?");
    $eliminar->bind_param("i", $id_registro); // "i" indica que el ID es un entero
    $eliminar->execute();

    // Verificar si la consulta se ejecutó correctamente
    if ($eliminar->affected_rows > 0) {
        echo "ok";
    } else {
        echo "error al eliminar la persona";
    }
    // Cerrar la consulta
    $eliminar->close();
} else {
    http_response_code(405); // Método no permitido
    echo "Método no permitido";
}
mysqli_close($conn);
?>