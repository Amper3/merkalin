<?php
include_once "../zConexion/verificar_sesion.php";
include_once "../zConexion/config.php";

$datos = [];

$cadena_Personas = "SELECT  id_Persona, 
                            nombre, 
                            ap_Paterno, 
                            ap_Materno, 
                            fecha_Nacimiento, 
                            sexo, 
                            calle, 
                            cp, 
                            telefono_1, 
                            telefono_2, 
                            CURP, 
                            RFC 
                    FROM personas";

// Ejecuta la consulta
$consulta_Personas = mysqli_query($conn, $cadena_Personas);

while ($row_Personas = mysqli_fetch_array($consulta_Personas)) {

    $editar= "<center><a onclick='editar_Persona($row_Personas[0])' class='btn btn-success text-center'><i class='bi bi-pencil-square'></i></a></center>";
    $eliminar= "<center><a onclick='eliminar_Persona($row_Personas[0])' class='btn btn-danger text-center'><i class='bi bi-person-x'></i></a></center>";
    
    $datos[] = [
        'editar' => $editar,
        'id' => $row_Personas[0],
        'nombre' => $row_Personas[1],
        'ap_Paterno' => $row_Personas[2],
        'ap_Materno' => $row_Personas[3],
        'fecha_Nacimiento' => $row_Personas[4],
        'sexo' => $row_Personas[5],
        'calle' => $row_Personas[6],
        'cp' => $row_Personas[7],
        'telefono_1' => $row_Personas[8],
        'telefono_2' => $row_Personas[9],
        'CURP' => $row_Personas[10],
        'RFC' => $row_Personas[11],
        'eliminar' => $eliminar
    ];
}
echo (json_encode($datos));
mysqli_close($conn);
?>