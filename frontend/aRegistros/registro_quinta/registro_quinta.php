<?php
    include_once "../../../backend/auth/verificar_sesion.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo $_SESSION['token']; ?>"> 
    <title>Registrar</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Farsan&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Estonia&family=Kaushan+Script&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/frontend/recursos/style_General.css">
    <link rel="stylesheet" href="style_quinta_registro.css">
</head>

<body>
    <div class="main-content">
        <?php include_once "../../aNavFooter/nav.php"; ?> 
        <section>
            <form id="form_registro" action="../../../backend/registros/quintas_registro.php" method="post" enctype="multipart/form-data">
                <div class="col-md-12 mb-3">
                    <h4>Datos de Quinta:</h4>
                    <br>
                    <div class="row">
                        <h5>Los campos opcionales están indicados con un recuadro en el lado derecho. Marque esta casilla si desea dejar el campo vacío.</h5>
                    </div>
                    <br>
                    <div class="row">
                        <!-- nombre -->
                        <div class="col-md-4 mb-3">
                            <h6><i class="bi bi-info-circle"></i> Nombre por el cual es conocida la quinta. El nombre ingresado no podrá ser modificado posteriormente.</h6>
                            <div class="form-floating mb-3 position-relative">
                                <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre" oninput="validarNombre()">
                                <label for="nombre">Nombre de la quinta:</label>
                                <div id="popover-validacion" class="popover fade show position-absolute" style="top: -60px; right: 10px; display: none;">
                                    <div class="popover-body"></div>
                                </div>
                            </div>
                        </div>

                        <!-- colonia -->
                        <div class="col-md-4 mb-3">
                            <h6><i class="bi bi-info-circle"></i> Seleccione la colonia donde se encuentra ubicada la quinta.</h6>
                            <div class="form-floating mb-3 d-flex align-items-center">
                                <select id="colonia" name="colonia" class="form-control">
                                </select>
                            </div>
                        </div>

                        <!-- precio -->
                        <div class="col-md-4 mb-3">
                            <h6><i class="bi bi-info-circle"></i> Indique el precio general. Si hay variaciones, especifíquelo en la información adicional.</h6>
                            <div class="form-floating mb-3 d-flex align-items-center">
                                <input type="number" id="precio" name="precio" class="form-control" step="0.01"
                                    placeholder="Precio">
                                <label for="precio">Precio: $$$$</label>
                            </div>
                        </div>

                        <!-- horario_inicio -->
                        <div class="col-md-4 mb-3">
                            <h6><i class="bi bi-info-circle"></i> Por favor, indique la hora de inicio del servicio.</h6>
                            <div class="form-floating mb-3 d-flex align-items-center">
                                <input type="time" id="horario_inicio" name="horario_inicio" class="form-control">
                                <label for="horario_inicio">Horario de inicio:</label>
                                <input type="checkbox" id="check_horario_inicio" name="check_horario_inicio" class="ms-2">
                            </div>
                        </div>

                        <!-- horario_final -->
                        <div class="col-md-4 mb-3">
                            <h6><i class="bi bi-info-circle"></i> Indique la hora de finalización del servicio.</h6>
                            <div class="form-floating mb-3 d-flex align-items-center">
                                <input type="time" id="horario_final" name="horario_final" class="form-control">
                                <label for="horario_final">Horario de cierre:</label>
                                <input type="checkbox" id="check_horario_final" name="check_horario_final" class="ms-2">
                            </div>
                        </div>

                        <!-- dias -->
                        <div class="col-md-4 mb-3">
                            <h6><i class="bi bi-info-circle"></i> Especifique los días en que el servicio está disponible.</h6>
                            <div class="form-floating mb-3 d-flex align-items-center">
                                <div class="dias_p">
                                    <input type="checkbox" id="all_dias" name="all_dias" class="ms-2" value="all" checked> Todos los días
                                    <input type="checkbox" id="dias" name="dias" class="ms-2"> Personalizado
                                    <div id="dias_div" style="display: none;">
                                        <input type="checkbox" id="L" name="dias[]" class="ms-2" value="L">L
                                        <input type="checkbox" id="M" name="dias[]" class="ms-2" value="M">M
                                        <input type="checkbox" id="MI" name="dias[]" class="ms-2" value="MI">MI
                                        <input type="checkbox" id="J" name="dias[]" class="ms-2" value="J">J
                                        <input type="checkbox" id="V" name="dias[]" class="ms-2" value="V">V
                                        <input type="checkbox" id="S" name="dias[]" class="ms-2" value="S">S
                                        <input type="checkbox" id="D" name="dias[]" class="ms-2" value="D">D
                                    </div>
                                </div>
                                <input type="checkbox" id="check_dias" name="check_dias" class="ms-2">
                            </div>
                        </div>

                        <!-- info_extra -->
                        <div class="col-md-4 mb-3">
                            <h6><i class="bi bi-info-circle"></i> Proporcione cualquier comentario o información adicional relevante sobre el servicio.</h6>
                            <div class="form-floating mb-3 d-flex align-items-center">
                                <input type="text" id="info_extra" name="info_extra" class="form-control"
                                    placeholder="Información Extra">
                                <label for="info_extra">Información adicional:</label>
                                <input type="checkbox" id="check_info_extra" name="check_info_extra" class="ms-2">
                            </div>
                        </div>

                        <!-- direccion -->
                        <div class="col-md-4 mb-3">
                            <h6><i class="bi bi-info-circle"></i> Dirección requerida. Esta información debe ser extraída de Google Maps para que el localizador funcione correctamente.</h6>
                            <div class="form-floating mb-3 d-flex align-items-center">
                                <input type="text" id="direccion" name="direccion" class="form-control"
                                    placeholder="Dirección Exacta">
                                <label for="direccion">Dirección Exacta:</label>
                                <input type="checkbox" id="check_direccion" name="check_direccion" class="ms-2">
                            </div>
                        </div>

                        <!-- numero -->
                        <div class="col-md-4 mb-3">
                            <h6><i class="bi bi-info-circle"></i> Número de teléfono de contacto. Por favor, proporcione un número donde podamos comunicarnos fácilmente.</h6>
                            <div class="form-floating mb-3 d-flex align-items-center">
                                <input type="text" id="numero" name="numero" class="form-control"
                                    placeholder="Número de contacto">
                                <label for="numero">Número:</label>
                                <input type="checkbox" id="check_numero" name="check_numero" class="ms-2">
                            </div>
                        </div>

                        <!-- whatsapp -->
                        <div class="col-md-4 mb-3">
                            <h6><i class="bi bi-info-circle"></i> Número de WhatsApp. Indique el número donde se puede contactar a través de esta plataforma para mayor comodidad.</h6>
                            <div class="form-floating mb-3 d-flex align-items-center">
                                <input type="text" id="whatsapp" name="whatsapp" class="form-control"
                                    placeholder="WhatsApp">
                                <label for="whatsapp">WhatsApp:</label>
                                <input type="checkbox" id="check_whatsapp" name="check_whatsapp" class="ms-2">
                            </div>
                        </div>

                        <!-- facebook -->
                        <div class="col-md-4 mb-3">
                            <h6><i class="bi bi-info-circle"></i> Proporcione el enlace a su perfil de Facebook. Puede obtenerlo directamente desde la plataforma.</h6>
                            <div class="form-floating mb-3 d-flex align-items-center">
                                <input type="text" id="facebook" name="facebook" class="form-control"
                                    placeholder="Facebook">
                                <label for="facebook">Facebook: (enlace de perfil)</label>
                                <input type="checkbox" id="check_facebook" name="check_facebook" class="ms-2">
                            </div>
                        </div>

                        <!-- instagram -->
                        <div class="col-md-4 mb-3">
                            <h6><i class="bi bi-info-circle"></i> Proporcione el enlace a su perfil de Instagram. Puede obtenerlo directamente desde la plataforma.</h6>
                            <div class="form-floating mb-3 d-flex align-items-center">
                                <input type="text" id="instagram" name="instagram" class="form-control"
                                    placeholder="Instagram">
                                <label for="instagram">Instagram: (enlace de perfil)</label>
                                <input type="checkbox" id="check_instagram" name="check_instagram" class="ms-2">
                            </div>
                        </div>
                    </div>
                    <!-- IMAGENES -->
                    <div class="row">
                        <legend>Imágenes:</legend>
                        <h6><i class="bi bi-info-circle"></i> Seleccione imágenes no mayores a 20 MB</h6>

                        <div class="col-md-3 mb-3">
                            <div class="form-floating">
                                <input type="file" id="imagen_principal" name="imagen_principal" class="form-control" accept="image/*">
                                <label for="imagen_principal">Imagen Principal:</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-floating">
                                <input type="file" id="imagen_secundaria_1" name="imagen_secundaria_1" class="form-control" accept="image/*">
                                <label for="imagen_secundaria_1">Imagen Secundaria 1:</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-floating">
                                <input type="file" id="imagen_secundaria_2" name="imagen_secundaria_2" class="form-control" accept="image/*">
                                <label for="imagen_secundaria_2">Imagen Secundaria 2:</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-floating">
                                <input type="file" id="imagen_secundaria_3" name="imagen_secundaria_3" class="form-control" accept="image/*">
                                <label for="imagen_secundaria_3">Imagen Secundaria 3:</label>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button type="submit" class="btn btn-info">Publicar</button>
                        <button type="button" id="cancelButton" class="btn btn-danger">Cancelar</button>
                    </div>
                </div>
            </form>
        </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script><!-- ICONOS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="funciones_quinta.js"></script>
</body>

</html>