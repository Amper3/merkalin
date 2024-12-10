<?php
session_start();

if (isset($_SESSION['login_success']) && $_SESSION['login_success'] === true) {
    unset($_SESSION['login_success']);
    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                title: "¡Inicio de sesión exitoso!",
                text: "Bienvenido a MerkaLin.",
                icon: "success",
                confirmButtonText: "Continuar"
            }).then(() => {
            });
        });
    </script>';
}

if (isset($_SESSION['registration_success']) && $_SESSION['registration_success'] === true) {
    unset($_SESSION['registration_success']);
    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                title: "¡Registro exitoso!",
                text: "Tu cuenta ha sido creada correctamente. Inicia sesión, y registra tu servicio.",
                icon: "success",
                confirmButtonText: "Continuar"
            }).then(() => {
            });
        });
    </script>';
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <title>Categorias</title>
    <!--FUENTES-->
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Farsan&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Estonia&family=Kaushan+Script&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/frontend/recursos/style_General.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="main-content">
        <?php include_once "./aNavFooter/nav.php"; ?>
            <div class="buscar">
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Buscar..." aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Buscar</button>
                </form>
            </div>
            <br>
            <h1>Categorias</h1>
            <div  id="categorias_container" class="col-12"></div>
        
        <?php include_once "./aNavFooter/footer.php"; ?>
    </div>
    
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function(){
            $.ajax({
                url: '../backend/categorias/categorias.php', // Archivo PHP que genera las tarjetas
                type: 'GET',
                success: function(response) {
                    $('#categorias_container').html(response); // Insertar las tarjetas en el contenedor
                    setTimeout(function() {
                        document.getElementById("Quintas").onclick = function() {
                            window.location.href = "/frontend/quinta/index.php";
                        };
                    }, 100);
                },
                error: function() {
                    alert('Error al cargar las categorías.');
                }
            });
        });
    </script>
</body>
</html>