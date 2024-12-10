<?php
include_once "../zConexion/verificar_sesion.php";
include_once "../zConexion/config.php";

$id = $_POST['id'];
  
$cadena = mysqli_query($conn, "SELECT
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
                                FROM
                                    personas
                                WHERE
                                    id_Persona = '$id'");

  $row = mysqli_fetch_array($cadena);
  $array  = array(
                    $row[0], //nombre
                    $row[1], //ap_paterno
                    $row[2], //ap_materno
                    $row[3], //fecha_nacimiento
                    $row[4], //sexo
                    $row[5], //calle
                    $row[6], //cp
                    $row[7], //telefono_1
                    $row[8], //telefono_2
                    $row[9], //CURP
                    $row[10]  //RFC
                  );
  $array1 = json_encode($array);
  echo $array1; 
  mysqli_close($conn);
?>