<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <title>¿Quiénes somos?</title>
    <!--FUENTES-->
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Farsan&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Estonia&family=Kaushan+Script&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/frontend/recursos/style_General.css">
    <link rel="stylesheet" href="style_info.css">
</head>
<body>
    <div class="main-content">
        <?php include_once "nav.php"; ?>
            <div class="buscar">
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Buscar..." aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Buscar</button>
                </form>
            </div>
            <br>
            <h1>¿Quiénes somos?</h1>

            <div class="row">
                <div class="col-4">
                    <div id="list-example" class="list-group">
                    <a class="list-group-item list-group-item-action" href="#list-item-1">Presentación.</a>
                    <a class="list-group-item list-group-item-action" href="#list-item-2">¿Qué sucede después de cargar toda mi información?</a>
                    <a class="list-group-item list-group-item-action" href="#list-item-3">¿Cuándo estará disponible mi servicio para los usuarios?</a>
                    <a class="list-group-item list-group-item-action" href="#list-item-4">¿Puedo hacer cambios durante el proceso de revisión?</a>
                    </div>
                </div>
                <div class="col-8">
                    <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" class="scrollspy-example bg-body-tertiary p-3 rounded-2" tabindex="0" style="height: 400px; overflow-y: auto;">
                    
                        <h4 id="list-item-1">Presentación.</h4>
                        <p>Somos una <strong>plataforma diseñada para facilitar la búsqueda y conexión</strong> con quintas que ofrecen sus servicios al público. Nuestro objetivo es convertirnos en el <strong>directorio web</strong> de referencia, proporcionando información clara y precisa sobre contacto, ubicación y servicios disponibles.</p>
                        <p>Trabajamos constantemente para mejorar tu experiencia, y nuestras futuras actualizaciones estarán orientadas a hacer de MerkaLin una herramienta aún más útil y accesible. ¡Esperamos que disfrutes explorar lo que tenemos para ofrecer!</p>
                        
                        <h4 id="list-item-2">¿Qué sucede después de cargar toda mi información?</h4>
                        <p>Una vez que se carga la información, esta entra en un proceso de revisión que puede tardar hasta 24 horas. Durante este proceso, se verifica que las imágenes, descripciones y demás datos cumplan con los términos y condiciones de uso de la plataforma.</p>
                        
                        <h4 id="list-item-3">¿Cuándo estará disponible mi servicio para los usuarios?</h4>
                        <p>Tras superar el proceso de revisión, tu servicio será publicado en el directorio web y podrá ser visto por todos los usuarios.</p>

                        <h4 id="list-item-4">¿Puedo hacer cambios durante el proceso de revisión?</h4>
                        <p>Sí, puedes realizar cambios en la información durante el proceso de revisión (como precios, descripciones o redes sociales). Sin embargo, cada cambio reinicia el proceso de revisión, lo que podría prolongar la publicación de tu servicio. Por ello, se recomienda realizar solo los cambios estrictamente necesarios para minimizar el tiempo de inactividad.</p>
                    </div>
                </div>
            </div>

        <?php include_once "footer.php"; ?>
    </div>
    
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>