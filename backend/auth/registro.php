<?php
session_start();
$conn = include(__DIR__ . '/../auth/db.php');  // Ruta absoluta a db.php

$max_attempts = 3; // Define el límite de intentos fallidos

// Verifica si el usuario está bloqueado
if (isset($_SESSION['login_blocked_until']) && $_SESSION['login_blocked_until'] > time()) {
    // Redirige al usuario a la página de bloqueo de inicio de sesión
    header('Location: ../bloqueo.php');
    exit; // Termina el script
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verifica si se ha alcanzado el límite de intentos fallidos
    if (isset($_SESSION['login_attempts']) && $_SESSION['login_attempts'] >= $max_attempts) {
        // Bloquea el inicio de sesión por:
        $_SESSION['login_blocked_until'] = time() + 60; //segundos

        unset($_SESSION['login_attempts']); // Reinicia el contador de intentos fallidos

        header('Location: ../bloqueo.php');
        exit; // Termina el script
    }

    // Obtener los datos del formulario y escaparlos
    // $ip_TyC = mysqli_real_escape_string($conn, $_SERVER['REMOTE_ADDR']);

    $ip_TyC = $_SERVER['REMOTE_ADDR']; // Por defecto, toma la IP directa
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $ip_TyC = trim($ips[0]); // La primera IP es la IP pública real
    }

    // Validar que la IP sea válida
    if (filter_var($ip_TyC, FILTER_VALIDATE_IP)) {
        $ip_TyC = mysqli_real_escape_string($conn, $ip_TyC); // Escapar la IP para prevenir inyecciones SQL
    } else {
        $ip_TyC = '0.0.0.0'; // En caso de que no sea válida, asignar una IP por defecto
    }


    $nombre = mysqli_real_escape_string($conn, $_POST['username_Registro']);
    $aplellidos = mysqli_real_escape_string($conn, $_POST['apellidos_Registro']);
    $fecha_na = mysqli_real_escape_string($conn, $_POST['fecha_na_Registro']);

    date_default_timezone_set('America/Monterrey');
    $fecha_actual = date('Y-m-d');
    $fecha_actual_TyC = date('Y-m-d H:i:s'); // Fecha y hora actuales
    $fecha = mysqli_real_escape_string($conn, $fecha_actual);
    $fecha_TyC = mysqli_real_escape_string($conn, $fecha_actual_TyC);

    $phone = mysqli_real_escape_string($conn, $_POST['numero']);
    $password = mysqli_real_escape_string($conn, $_POST['password_Registro']);
    $passwordVerify = mysqli_real_escape_string($conn, $_POST['confirmar_password_Registro']);
    $activo = '1';

     // Validar datos del formulario
    if (empty($nombre) || !preg_match('/^[a-zA-Zá-úÁ-ÚñÑ\s]+$/', $nombre)) {
        $error_message = "El nombre solo puede contener letras y espacios.";
    } elseif (empty($aplellidos) || !preg_match('/^[a-zA-Zá-úÁ-ÚñÑ\s]+$/', $aplellidos)) {
        $error_message = "Los apellidos solo pueden contener letras y espacios.";
    } elseif (empty($fecha_na) || (new DateTime($fecha_na))->diff(new DateTime())->y < 18) {
        $error_message = "Debes ser mayor de 18 años.";
    } elseif (empty($phone) || !preg_match('/^\d{10}$/', $phone)) {
        $error_message = "El número de contacto debe tener 10 dígitos.";
    } elseif (strlen($password) < 6) {
        $error_message = "La contraseña debe tener al menos 6 caracteres.";
    } elseif ($password !== $passwordVerify) {
        $error_message = "Las contraseñas no coinciden.";
    } elseif (!isset($_POST['defaultCheck1'])) {
        $error_message = "Debes aceptar los términos y condiciones.";
    }

    // Mostrar errores si existen
    if (isset($error_message)) {
        echo "<script>alert('$error_message'); window.history.back();</script>";
        exit;
    }

    // Verificar si el numero de usuario ya está en uso
    $sql_check_phone = "SELECT phone FROM ussers WHERE phone = ?";
    $stmt_check_phone = mysqli_prepare($conn, $sql_check_phone);
    mysqli_stmt_bind_param($stmt_check_phone, "s", $phone);
    mysqli_stmt_execute($stmt_check_phone);
    $result_check_phone = mysqli_stmt_get_result($stmt_check_phone);
    if (mysqli_num_rows($result_check_phone) > 0) {
        $error_message = "El numero de usuario ya está en uso. Por favor, elige otro.";
    }

    // Si hay errores, mostrar mensaje de error
    if (isset($error_message)) {
        echo "<script>alert('$error_message'); window.history.back();</script>";
        exit;
    }

    // Hash the password
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    // Iniciar transacción para asegurar inserciones consistentes
    mysqli_begin_transaction($conn);

    try {
        // Insertar el usuario en la tabla `ussers`
        $sql_user = "INSERT INTO ussers (pwd, phone, fecha, activo) VALUES (?, ?, ?, ?)";
        $stmt_user = mysqli_prepare($conn, $sql_user);
        mysqli_stmt_bind_param($stmt_user, "sssi", $password_hashed, $phone, $fecha, $activo);

        if (!mysqli_stmt_execute($stmt_user)) {
            throw new Exception("Error al registrar el usuario.");
        }

        // Obtener el ID del usuario recién creado
        $id_uss = mysqli_insert_id($conn);

        // Insertar la persona asociada en la tabla `personas`
        $sql_persona = "INSERT INTO personas (nombre, apellidos, fecha_na, id_uss, fecha_TyC, ip_TyC) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt_persona = mysqli_prepare($conn, $sql_persona);
        mysqli_stmt_bind_param($stmt_persona, "sssiss", $nombre, $aplellidos, $fecha_na, $id_uss, $fecha_TyC, $ip_TyC);

        if (!mysqli_stmt_execute($stmt_persona)) {
            throw new Exception("Error al registrar la persona.");
        }

        // Si ambos `INSERT` son exitosos, confirmar la transacción
        mysqli_commit($conn);
        
        // Establecer indicador de éxito en sesión
        $_SESSION['registration_success'] = true;
        echo "<script>window.location='/../frontend';</script>";    
        exit;
    } catch (Exception $e) {
        // Si hay un error, deshacer la transacción
        mysqli_rollback($conn);
        echo "<script>alert('{$e->getMessage()}'); window.history.back();</script>";
        exit;
    }
}
?>