<?php
// Inicia la sesión 
// session_start();

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Conexión a la base de datos
$conn = include(__DIR__ . '../../../backend/auth/db.php');  // Ruta absoluta a db.php

// Variables públicas (por ejemplo, navegación básica para todos)
$avatar_path = '/frontend/recursos/img_uss/defecto.jpg';
$nombre = 'Invitado';
$apellidos = '';
$is_authenticated = false;

// Si el usuario está logueado, obtiene su información
if (isset($_SESSION['id_uss'])) {
    $id_uss = $_SESSION['id_uss'];

    // Consulta para obtener los datos del usuario
    $sql_user = "
        SELECT p.nombre, p.apellidos, u.phone 
        FROM personas p
        JOIN ussers u ON p.id_uss = u.id_uss
        WHERE p.id_uss = ?
    ";

    $stmt_user = mysqli_prepare($conn, $sql_user);
    mysqli_stmt_bind_param($stmt_user, "i", $id_uss);
    mysqli_stmt_execute($stmt_user);
    $result_user = mysqli_stmt_get_result($stmt_user);

    if ($result_user && mysqli_num_rows($result_user) > 0) {
        $user = mysqli_fetch_assoc($result_user);
        $nombre = htmlspecialchars($user['nombre'], ENT_QUOTES, 'UTF-8');
        $apellidos = htmlspecialchars($user['apellidos'], ENT_QUOTES, 'UTF-8');
        $phone = htmlspecialchars($user['phone'], ENT_QUOTES, 'UTF-8');

        // Construir la ruta del avatar
        $avatar_path = "/frontend/recursos/img_uss/{$phone}.jpg";
        if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $avatar_path)) {
            $avatar_path = '/frontend/recursos/img_uss/defecto.jpg';
        }

        $is_authenticated = true;
    } else {
        // Si el usuario no se encuentra, destruye la sesión
        session_destroy();
        $is_authenticated = false;
    }
}
?>

<nav class="navbar bg-body-tertiary fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="/frontend/"><i class="bi bi-house"></i> Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <button type="button" class="btn-close btn-outline" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">                
                    <?php if ($is_authenticated): ?>
                        <!-- Opciones para usuarios autenticados -->
                        <li class="nav-item">
                            <div class="card_perfil">
                                <div class="card__portada">
                                    <img width="100%" src="/frontend/recursos/img/fondo.png" alt="">
                                </div>
                                <div class="card__avatar">
                                    <img src="<?php echo $avatar_path; ?>" alt="Avatar">
                                </div>
                                <div class="card__title"><?php echo $nombre . ' ' . $apellidos; ?></div>
                                <a class="nav-link active" aria-current="page" href="/frontend/aRegistros/registro_quinta/registro_quinta.php">
                                    <i class="bi bi-plus-square"></i> Publicar
                                </a>
                            </div>  
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" style="pointer-events: none; opacity: 0.5; text-decoration: none;" href="/frontend/"><i class="bi bi-heart-fill"></i> Favoritos... espéralo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/frontend/quinta/list.php">
                                <i class="bi bi-pencil-square"></i> Registros
                            </a>
                        </li>
                    <?php else: ?>
                        <!-- Opciones para usuarios no autenticados -->
                        <li class="nav-item">
                            <button class="buton_nav" onclick="location.href='/frontend/aLoguin/index.php';">
                                <span>Iniciar Sesion</span><i class="bi bi-person-circle"></i>
                            </button>
                        </li>
                        <br>
                    <?php endif; ?>

                    <!-- Opciones accesibles para todos -->
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/frontend/aNavFooter/informacion.php"><i class="bi bi-person-raised-hand"></i></i> ¿Quiénes somos?</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/frontend/shop"><i class="bi bi-person-raised-hand"></i></i> Shop ejemplo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/frontend/tris"><i class="bi bi-reception-4"></i> Pirámide</a>
                    </li>

                    <!-- Opción de cerrar sesión, siempre al final -->
                    <?php if ($is_authenticated): ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../../../backend/auth/cerrarSesion.php">
                                <i class="bi bi-x-circle-fill"></i> Cerrar Sesión
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</nav>
