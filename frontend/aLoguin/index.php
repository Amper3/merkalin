<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Farsan&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Estonia&family=Kaushan+Script&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/frontend/recursos/style_General.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="main-content" >
        <?php include_once "../aNavFooter/nav.php"; ?> 

        <form class="inicio"   action="/../backend/auth/logueo.php" method="POST">

            <!-- Mostrar intentos restantes -->
            <?php if (isset($_SESSION['remaining_attempts']) && $_SESSION['remaining_attempts'] > 0): ?>
                <p>Te quedan <?php echo htmlspecialchars($_SESSION['remaining_attempts']); ?> intentos.</p>
            <?php elseif (isset($_SESSION['login_blocked_until']) && $_SESSION['login_blocked_until'] > time()): ?>
                <p>Has alcanzado el límite de intentos. Intenta nuevamente en unos minutos.</p>
            <?php endif; ?>

            <h1>Inicio De Sesion</h1>
            <div class="col-md-12">
                <div class="form-floating mb-3 d-flex align-items-center">
                    <input type="text" id="phone" name="phone" class="form-control" placeholder="Numero de Telefono">
                    <label for="phone">*Numero de Telefono:</label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-floating mb-3 d-flex align-items-center">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña">
                    <label for="password">*Contraseña:</label>
                </div>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-primary" type="submit">Iniciar</button>
            </div>
            <br>
            <p>¿No tienes cuenta? <a href="#" onclick="toggleForms('inicio', 'registro')">Registrarse.</a></p>
        </form>
        <form class="registro" action="/../backend/auth/registro.php" method="POST">
            <p>¿Ya tienes cuenta? <a href="#" onclick="toggleForms('registro', 'inicio')">Iniciar Sesión.</a></p>
            <h1>Registro de Usuario</h1>
            <div class="col-md-12">
                <div class="form-floating mb-3 d-flex align-items-center">
                    <input type="text" id="username_Registro" name="username_Registro" class="form-control" placeholder="Nombre">
                    <label for="username_Registro">*Nombre:</label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-floating mb-3 d-flex align-items-center">
                    <input type="text" id="apellidos_Registro" name="apellidos_Registro" class="form-control" placeholder="Nombre">
                    <label for="apellidos_Registro">*Apellidos:</label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-floating mb-3 d-flex align-items-center">
                    <input type="date" id="fecha_na_Registro" name="fecha_na_Registro" class="form-control" placeholder="Nombre">
                    <label for="fecha_na_Registro">*Fecha de Nacimiento:</label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-floating mb-3 d-flex align-items-center">
                    <input type="number" id="numero" name="numero" class="form-control" placeholder="Nombre">
                    <label for="numero">*Numero de Contacto:</label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-floating mb-3 d-flex align-items-center">
                    <input type="password" id="password_Registro" name="password_Registro" class="form-control" placeholder="Nombre">
                    <label for="password_Registro">*Contraseña:</label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-floating mb-3 d-flex align-items-center">
                    <input type="password" id="confirmar_password_Registro" name="confirmar_password_Registro" class="form-control" placeholder="Nombre">
                    <label for="confirmar_password_Registro">*Confirmar Contraseña:</label>
                </div>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" name="defaultCheck1" >
                <label class="form-check-label" for="defaultCheck1">
                    Acepto <a class="TyC" onclick="openModal_TyC();">Términos y condiciones</a>
                </label>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-primary" type="submit">Registrarme</button>
            </div>
        </form>
        <!-- Enlace para ir al login -->
    </div>

    <?php   include "../aNavFooter/modal_TyC.php";?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script><!-- ICONOS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
       function toggleForms(claseOcultar, claseMostrar) {
            // Obtiene los formularios mediante las clases
            const formOcultar = document.querySelector(`.${claseOcultar}`);
            const formMostrar = document.querySelector(`.${claseMostrar}`);

            // Cambia la visibilidad de los formularios
            if (formOcultar && formMostrar) {
                formOcultar.style.display = 'none';
                formMostrar.style.display = 'block';
            }
        }
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelector('.registro').style.display = 'none';
            document.querySelector('.inicio').style.display = 'block';
        });
    </script>
    <script>
        document.querySelector('.registro').addEventListener('submit', function (event) {
            const nombre = document.getElementById('username_Registro').value.trim();
            const apellidos = document.getElementById('apellidos_Registro').value.trim();
            const fechaNacimiento = document.getElementById('fecha_na_Registro').value;
            const numero = document.getElementById('numero').value.trim();
            const password = document.getElementById('password_Registro').value;
            const confirmarPassword = document.getElementById('confirmar_password_Registro').value;
            const terminos = document.getElementById('defaultCheck1').checked;

            const errores = [];

            // Validación de nombre
            if (!/^[a-zA-Zá-úÁ-ÚñÑ\s]+$/.test(nombre)) {
                errores.push("El nombre solo puede contener letras y espacios.");
            }

            // Validación de apellidos
            if (!/^[a-zA-Zá-úÁ-ÚñÑ\s]+$/.test(apellidos)) {
                errores.push("Los apellidos solo pueden contener letras y espacios.");
            }

            // Validación de fecha de nacimiento (mayor de 18 años)
            const fechaActual = new Date();
            const fechaUsuario = new Date(fechaNacimiento);
            const edad = fechaActual.getFullYear() - fechaUsuario.getFullYear();
            if (isNaN(fechaUsuario) || edad < 18 || (edad === 18 && fechaActual < new Date(fechaUsuario.setFullYear(fechaUsuario.getFullYear() + 18)))) {
                errores.push("Debes ser mayor de 18 años.");
            }

            // Validación de número de contacto
            if (!/^\d{10}$/.test(numero)) {
                errores.push("El número de contacto debe tener 10 dígitos.");
            }

            // Validación de contraseñas
            if (password.length < 6) {
                errores.push("La contraseña debe tener al menos 6 caracteres.");
            }
            if (password !== confirmarPassword) {
                errores.push("Las contraseñas no coinciden.");
            }

            // Validación de términos y condiciones
            if (!terminos) {
                errores.push("Debes aceptar los términos y condiciones.");
            }

            // Mostrar errores si existen
            if (errores.length > 0) {
                event.preventDefault();
                Swal.fire({
                    title: "Errores en el formulario",
                    icon: "error",
                    html: `<ul style="text-align: left; color: red;">
                            ${errores.map(error => `<li>${error}</li>`).join("")}
                        </ul>`,
                    confirmButtonText: "Entendido",
                });
            }
        });
    </script>
    <script>
        function openModal_TyC() {
            var modal_TyC = new bootstrap.Modal(document.getElementById('modal_TyC'));
            modal_TyC.show();
        }
    </script>
</body>
</html>