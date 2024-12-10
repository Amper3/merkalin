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
    <link href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Alumni+Sans+Pinstripe:ital@0;1&family=Shantell+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/frontend/recursos/style_General.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="main-content">  
        <?php include_once "./aNavFooter/nav.php"; ?>
            <div class="col-12">
                <h1>Categorias</h1>
                <div id="quinta" class="card">
                    <div class="card-body">
                        <h5 id="categoria" class="card-title">Quintas</h5>
                    </div>
                </div>
                <div id="taxis" class="card">
                    <div class="card-body">
                        <h5 class="card-title">Taxistas</h5>
                    </div>
                </div>
                <div id="hogar" class="card">
                    <div class="card-body">
                        <h5 class="card-title">Hogar y Jardín</h5>
                    </div>
                </div>
                <div id="electronica" class="card">
                    <div class="card-body">
                        <h5 class="card-title">Electrónica y Tecnología</h5>
                    </div>
                </div>
                <div id="moda" class="card">
                    <div class="card-body">
                        <h5 class="card-title">Moda y Accesorios</h5>
                    </div>
                </div>
                <div id="" class="card">
                    <div class="card-body">
                        <h5 class="card-title">Salud y Belleza</h5>
                    </div>
                </div>
                <div id="" class="card">
                    <div class="card-body">
                        <h5 class="card-title">Alimentos y Bebidas</h5>
                    </div>
                </div>
                <div id="" class="card">
                    <div class="card-body">
                        <h5 class="card-title">Automotriz</h5>
                    </div>
                </div>
                <div id="" class="card">
                    <div class="card-body">
                        <h5 class="card-title">Viajes y Turismo</h5>
                    </div>
                </div>
                <div id="" class="card">
                    <div class="card-body">
                        <h5 class="card-title">Servicios Profesionales</h5>
                    </div>
                </div>

            </div>        
    </div>
    
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        document.getElementById("quinta").onclick = function() {
            window.location.href = "/frontend/quinta/index.php";
        };
        document.getElementById("taxis").onclick = function() {
            window.location.href = "";
        };
    </script>
</body>
</html>