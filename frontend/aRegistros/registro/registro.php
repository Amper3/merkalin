<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/frontend/recursos/style_General.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="main-content">
        <?php include_once "../../aNavFooter/navBarHome.php"; ?>
        <section>
            <form id="form_registro" action="/../backend/back_quinta/quintas_registro.php" method="post" enctype="multipart/form-data">
                <div class="col-md-12 mb-3">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <select id="categoria" name="categoria" class="form-control" >
                                    <option value="quinta">Categoría 1</option>
                                    <option value="pinta">Categoría 2</option>
                                </select>
                                <label for="categoria">Categoría:</label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre">
                                <label for="nombre">*Nombre de la quinta:</label>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="time" id="horario_inicio" name="horario_inicio" class="form-control">
                                <label for="horario_inicio">*Horario de inicio:</label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="time" id="horario_final" name="horario_final" class="form-control">
                                <label for="horario_final">*Horario de cierre:</label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <select id="colonia" name="colonia" class="form-control" >
                                    <option value="Colonia1">Colonia 1</option>
                                    <option value="Colonia2">Colonia 2</option>
                                    <!-- Agrega más colonias según sea necesario -->
                                </select>
                                <label for="colonia">Colonia:</label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="number" id="precio" name="precio" class="form-control" step="0.01" placeholder="Precio">
                                <label for="precio">*Precio: $$$$</label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="text" id="info_extra" name="info_extra" class="form-control" placeholder="Información Extra" size="50">
                                <label for="info_extra">Información: (comentarios, datos relevantes)</label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="text" id="direccion_exacta" name="direccion_exacta" class="form-control" placeholder="Dirección Exacta">
                                <label for="direccion_exacta">*Dirección Exacta: (copie de Google maps)</label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="text" id="numero" name="numero" class="form-control" placeholder="Número">
                                <label for="numero">*Número:</label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="text" id="whatsapp" name="whatsapp" class="form-control" placeholder="WhatsApp" size="15">
                                <label for="whatsapp">WhatsApp:</label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="text" id="facebook" name="facebook" class="form-control" placeholder="Facebook">
                                <label for="facebook">Facebook: (enlace de perfil, copie de su cuenta)</label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="text" id="instagram" name="instagram" class="form-control" placeholder="Instagram">
                                <label for="instagram">Instagram: (enlace de perfil, copie de su cuenta)</label>
                            </div>
                        </div>
                    </div>
                    <div class="row" >
                        <h4>Imágenes:</h4>
                        <div class="col-md-3 mb-3">
                            <div class="form-floating">
                                <input type="file" id="imagen_principal" name="imagen_principal" class="form-control">
                                <label for="imagen_principal">*Imagen Principal:</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-floating">
                                <input type="file" id="imagen_secundaria1" name="imagen_secundaria1" class="form-control">
                                <label for="imagen_secundaria1">*Imagen Secundaria 1:</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-floating">
                                <input type="file" id="imagen_secundaria2" name="imagen_secundaria2" class="form-control">
                                <label for="imagen_secundaria2">*Imagen Secundaria 2:</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-floating">
                                <input type="file" id="imagen_secundaria3" name="imagen_secundaria3" class="form-control">
                                <label for="imagen_secundaria3">*Imagen Secundaria 3:</label>
                            </div>
                        </div>
                        <h6>(no mayores a 20 MB)</h6>                       
                    </div>
                    
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button type="submit" class="btn btn-success">Enviar</button>
                        <button type="button" id="cancelButton" class="btn btn-danger">Cancelar</button>
                    </div>
                </div>
            </form>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script><!-- ICONOS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    

    <script>
        llenarDatos('A');

        function llenarDatos(sufijo) {
            document.getElementById('nombre').value = 'Nombre_' + sufijo;
            document.getElementById('horario_inicio').value = '09:00';
            document.getElementById('horario_final').value = '23:59';
            document.getElementById('colonia').value = 'Colonia1';
            document.getElementById('precio').value = '1000.00';
            document.getElementById('info_extra').value = 'Información adicional_' + sufijo;
            document.getElementById('direccion_exacta').value = 'Calle_' + sufijo;
            document.getElementById('numero').value = '1234567890_' + sufijo;
            document.getElementById('whatsapp').value = '0987654321_' + sufijo;
            document.getElementById('facebook').value = 'facebook.com/quintaampere_' + sufijo;
            document.getElementById('instagram').value = 'instagram.com/quintaampere_' + sufijo;
        }

    </script>

    <script>
        function confirmarEnvio() {
            return Swal.fire({
                title: '¿Confirmar envío?',
                text: "¿Estás seguro de que deseas enviar este formulario?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, enviar',
                cancelButtonText: 'No, cancelar'
            }).then((result) => {
                return result.isConfirmed;
            });
        }
        function limpiar_validos() {
            var campos = document.getElementById('form_registro').querySelectorAll('input, select');
            
            campos.forEach(function(campo) {
                campo.classList.remove('is-invalid');
            });
        }
        function validarCamposFormulario() {
            var campos = document.getElementById('form_registro').querySelectorAll('input, select');
            var formularioValido = true;
            var maxFileSizeMB = 20;
            var maxFileSizeBytes = maxFileSizeMB * 1024 * 1024;

            campos.forEach(function(campo) {
                if (campo.type === 'file') {
                    if (campo.files.length === 0) {
                        campo.classList.add('is-invalid');
                        formularioValido = false;
                    } else {
                        let fileTooLarge = false;
                        for (var i = 0; i < campo.files.length; i++) {
                            if (campo.files[i].size > maxFileSizeBytes) {
                                fileTooLarge = true;
                                break;
                            }
                        }
                        if (fileTooLarge) {
                            campo.classList.add('is-invalid');
                            formularioValido = false;
                            Swal.fire({
                                icon: 'error',
                                title: 'Archivo demasiado grande',
                                text: `El archivo "${campo.files[0].name}" supera el tamaño máximo de ${maxFileSizeMB}MB.`,
                            });
                        } else {
                            campo.classList.remove('is-invalid');
                        }
                    }
                } else if (campo.value.trim() === '') {
                    campo.classList.add('is-invalid');
                    formularioValido = false;
                } else {
                    campo.classList.remove('is-invalid');
                }
            });

            return formularioValido;
        }

        document.getElementById('form_registro').addEventListener('submit', function(event) {            
            if (validarCamposFormulario()) {
                event.preventDefault(); // Prevenir el envío por ahora
                
                confirmarEnvio().then((confirmado) => {
                    if (confirmado) {
                        event.target.submit(); // Enviar el formulario si se confirma
                    }
                });
            } else {
                event.preventDefault(); // Evitar el envío si hay errores
            }
        });



        document.getElementById('cancelButton').addEventListener('click', function(event) {
            event.preventDefault(); // Evita que el botón envíe el formulario

            Swal.fire({
                title: '¿Estás seguro?',
                text: "Se perderán todos los datos no guardados.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, cancelar',
                cancelButtonText: 'No, volver'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Limpia el formulario
                    limpiar_validos();
                    document.getElementById('form_registro').reset();
                }
            });
        });

        // FUNCION PARA PREGUNTAR SI QUIERE SALIR
        // window.addEventListener('beforeunload', function(event) {
        //     event.preventDefault();
        //     event.returnValue = '';
        // });

    </script>
</body>

</html>