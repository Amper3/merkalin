<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NO,ON,NO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bad+Script&family=Chela+One&family=Love+Light&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="zRecursos/css/estilos_Logueo.css">
</head>
<body>
    <div class="login-container">
        <img class="Bloqueo_imagen" src="./zRecursos/imgagenes/capibara.gif" alt="">
        <section id="seccion_Logueo" class="Bloqueo">
            <h2 class="Bloqueo">Bloqueo por intentos excedidos</h2>
            <div class="Bloqueo" id="countdown">Tiempo restante: <span id="timer">1:00</span></div>
        </section>
    </div>
       
    <script src="zRecursos/js/funciones_Logueo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <script>
        // Temporizador de cuenta regresiva
        var countdown = 60; // segundos
        var timerDisplay = document.getElementById('timer');

        // Función para actualizar el temporizador cada segundo
        var countdownInterval = setInterval(function() {
            var minutes = Math.floor(countdown / 60);
            var seconds = countdown % 60;
            timerDisplay.textContent = minutes.toString().padStart(2, '0') + ':' + seconds.toString().padStart(2, '0');

            // Redirige a la página de inicio cuando el temporizador llega a cero
            if (countdown <= 0) {
                clearInterval(countdownInterval);
                window.location.href = '/../frontend/aLoguin/index.php';
            } else {
                countdown--;
            }
        }, 1000);
    </script>
</body>
</html>