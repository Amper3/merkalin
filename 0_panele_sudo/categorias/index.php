<!-- <?php
   // include_once "../zConexion/verificar_sesion.php";
?> -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
    <!-- <meta name="csrf-token" content="<?php //echo $_SESSION['token']; ?>">  -->
    <title>CATEGORIAS</title>
    <!--FUENTES-->
    <link href="https://cdn.datatables.net/v/dt/jq-3.7.0/jszip-3.10.1/dt-2.0.2/af-2.7.0/b-3.0.1/b-html5-3.0.1/b-print-3.0.1/cr-2.0.0/date-1.5.2/fc-5.0.0/fh-4.0.1/kt-2.12.0/r-3.0.0/sc-2.4.1/sb-1.7.0/sp-2.3.0/sl-2.0.0/sr-1.4.0/datatables.min.css" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/alertify.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../zRecursos/css/estilosInicio.css"><!-- Limpia la pagina para permitir los cambios con el css -->
</head>
<body>

    <div class="main-content">
        <?php include "../aaNavbar/navBarr.php"; ?>

        <section id="section_Categorias">                                 <!--SECCION TABLA-->
            <div title="Agregar Nueva Categoria" width="40px" height="40px">
                <svg class="Aument" onclick="Registro_categoria_Ver()" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" id="svg-person" class="bi bi-person-plus svg-icon text-right" viewBox="0 0 16 16">
                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                    <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                </svg>
            </div>
            <div class="table-responsive">
                <table id="lista_categorias" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="5%">Editar</th>
                            <th width="">Activar</th>
                            <th width="">ID</th>
                            <th width="">Categoria</th>
                            <th width="">Descripcion</th>
                            <th width="">Fondo</th>
                            <th width="5%">Eliminar</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </section>
        
        <section id="section_Registrar" style="display: none;"><!--   SECCION REGISTRAR/EDITAR-->
            <form method="POST" id="form_categorias">
                <div class="row">
                    <div class="ml-auto">
                        <i class="bi bi-x-circle icono_cerrar" onclick="Registro_categoria_Ver(); Limpiar_datos();"></i>
                    </div>
                    <div class="col-md-12 mb-3"> <!--SECCION DE -->
                        <div class="row">
                            <h4>Registro de Categorias</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Nombre" require autofocus>
                                    <label for="name">Nombre:</label>
                                    <input type="hidden" name="id_registro" id="id_registro" value="0">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Apellido paterno" require>
                                    <label for="descripcion">Descripcion:</label>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="ap_Materno" id="ap_Materno" placeholder="Apellido materno:" require>
                                    <label for="ap_Materno">Fondo:</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-grid gap-2 col-6 mx-auto">
                    <button class="btn btn-success" type="button" onclick="insertar_Persona()">Guardar datos</button>
                    <button class="btn btn-danger" type="button" onclick="Registro_categoria_Ver(),Limpiar_datos()">Cancelar</button>
                    <button class="btn btn-success" type="button" onclick=" Llenar_datos()">Datos</button>
                </div>
            </form>
        </section>

        <?php include "../aaNavbar/footer.php"; ?>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/v/dt/jq-3.7.0/jszip-3.10.1/dt-2.0.2/af-2.7.0/b-3.0.1/b-html5-3.0.1/b-print-3.0.1/cr-2.0.0/date-1.5.2/fc-5.0.0/fh-4.0.1/kt-2.12.0/r-3.0.0/sc-2.4.1/sb-1.7.0/sp-2.3.0/sl-2.0.0/sr-1.4.0/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/alertify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../zRecursos/js/funciones_Generlaes.js"></script>

    <script>
        $(document).ready(function() {  // CARGAR NOMAS ABRIENDO LA PAGINA
            cargar_tabla_Personas()
        });

        var csrfToken = "<?php echo $_SESSION['token']; ?>"; //Variable Token
        
        function Registro_categoria_Ver() { // Ver - Ocultar
            const section_Registrar = document.getElementById('section_Registrar');
            const section_Categorias = document.getElementById('section_Categorias');

            if (section_Registrar.style.display === 'none') {
                section_Registrar.style.display = 'block'; // Mostrar la sección
                section_Categorias.style.display = 'none'; 
            } else {
                section_Registrar.style.display = 'none'; // Ocultar la sección
                section_Categorias.style.display = 'block'; 
            }
        }

        function cargar_tabla_Personas() {
            var token = csrfToken;
            $('#lista_categorias').DataTable().destroy();
            $('#lista_categorias').DataTable({
                "paging": false,
                "dom": 'Bfrtip',
                buttons: [
                    {
                        extend: 'pageLength',
                        text: 'Registros',
                        className: 'btn btn-default'
                    },
                    {
                        extend: 'excel',
                        text: 'Exportar a Excel',
                        className: 'btn btn-default',
                        title: 'Lista Personas',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdf',
                        text: 'Exportar a PDF',
                        className: 'btn btn-default',
                        title: 'Lista Personas',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        text: 'Imprimir',
                        className: 'btn btn-default',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }
                ],
                "ajax": {
                    "type": "POST",
                    "url": "read_Personas.php",
                    "dataSrc": "",
                    // "data": {token: token}
                },
                "columns": [
                    { "data": "editar" },
                    { "data": "nombre" },
                    { "data": "ap_Paterno" },
                    { "data": "ap_Materno" },
                    { "data": "fecha_Nacimiento" },
                    { "data": "sexo" },
                    { "data": "calle" },
                    { "data": "telefono_1" },
                    { "data": "CURP" },
                    { "data": "RFC" },
                    { "data": "nombre" },
                    { "data": "eliminar" }
                ]
            });
        }
        function confirmarAccion(mensaje, callback) {
            Swal.fire({
                title: '¿Confirmar accion?',
                text: mensaje,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, confirmar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    callback();
                }
            });
        }

        function insertar_Persona() {
            if (validarCamposFormulario()) {                                    //Funcion para validar campos
                confirmarAccion("¿Quieres guardar este registro?", function() {
                    var datosFormulario = $("#form_categorias").serialize();             // Datos de los inputs
                    // datosFormulario += '&token=' + encodeURIComponent(csrfToken);   // Agregar el token CSRF a los datos serializados
                    $.ajax({
                        type: "POST",
                        url: 'insertar_Personas.php',
                        data: datosFormulario,
                        success: function(respuesta) {
                            console.log("Respuesta del servidor:", respuesta); // Agregar este console.log para depurar la respuesta del servidor
                            if (respuesta.trim() == "ok") {
                                console.log("Registro guardado correctamente");
                                alertify.success("Registro guardado correctamente");
                                Limpiar_datos();
                                Registro_categoria_Ver();
                                cargar_tabla_Personas();
                                $('#id_registro').val("0");
                            } else if (respuesta.trim() == "YA") {
                                alertify.error("La Persona ya existe");
                            } else {
                                console.log("Error en la respuesta:", respuesta); // Agregar este console.log para depurar cualquier error en la respuesta
                                alert(respuesta);
                                alertify.error("Ha ocurrido un error");
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Error en la petición AJAX:", error); // Agregar este console.log para depurar errores en la petición AJAX
                            alert("Error en la petición AJAX: " + error);
                        }
                    });
                });
            }
            return false;
        }

        function editar_Persona(id){
            // var token = csrfToken;
            $.ajax({
                url: 'update_Persona.php',
                // data: { id: id, token: token },
                data: { id: id},
                type: "POST",
                success: function(respuesta) {
                    Limpiar_datos();
                    Registro_categoria_Ver()
                    var array = eval(respuesta);
                    $('#id_registro').val(id);
                    // alert(id);
                    $('#name').val(array[0]);
                    $('#ap_Paterno').val(array[1]);
                    $('#ap_Materno').val(array[2]);
                    $('#fecha_Nacimiento').val(array[3]);
                    setTimeout(calcularEdad, 100); //Calcular edad 100milesegundos despues por el dom tarda en cargar
                    $('#edad').val(edad);
                    $('#sexo').val(array[4]);
                    $('#calle').val(array[5]);
                    $('#cp').val(array[6]);
                    $('#telefono_1').val(array[7]);
                    $('#telefono_2').val(array[8]);
                    $('#CURP').val(array[9]);
                    $('#RFC').val(array[10]);
                }
            });
        }

        function eliminar_Persona(id_registro) {
            // var token = csrfToken;
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta acción no se puede deshacer",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#00FF64',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'delete_Persona.php',
                        type: 'POST',
                        // data: { id_registro: id_registro, token: token },
                        data: { id_registro: id_registro},
                        success: function(response) {
                            if (response.trim() === 'ok') { //si se elimino
                                cargar_tabla_Personas();
                                Swal.fire(
                                    'Eliminado',
                                    'La persona ha sido eliminada correctamente',
                                    'success'
                                );
                            } else {
                                Swal.fire(
                                    'Error',
                                    'Hubo un error al intentar eliminar la persona',
                                    'error'
                                );
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Error en la petición AJAX:", error);
                            // Si hubo un error en la solicitud AJAX, mostrar un mensaje de error
                            Swal.fire(
                                'Error',
                                'Hubo un error al intentar eliminar la persona',
                                'error'
                            );
                        }
                    });
                }
            });
        }

        function Limpiar_datos() {
            $('#id_registro').val('0');
            $('#name').val('');
            $('#ap_Paterno').val('');
            $('#ap_Materno').val('');
            $('#fecha_Nacimiento').val('');
            $('#edad').val('');
            $("#sexo").val('').trigger('change');
            $('#calle').val('');
            $('#cp').val('');
            $('#telefono_1').val('');
            $('#telefono_2').val('');
            $('#CURP').val('');
            $('#RFC').val('');
            $('#form_categorias input, #form_categorias select').removeClass('is-invalid');
        }

        function Llenar_datos() {
            var n = 13;
            // $('#id_registro').val('0');
            $('#name').val('Ampere' + n);
            $('#ap_Paterno').val('Constante' + n);
            $('#ap_Materno').val('Caballero' + n);
            $('#fecha_Nacimiento').val('2002-02-08');
                var fechaNacimiento = new Date($('#fecha_Nacimiento').val());
                var fechaActual = new Date();
                var edad = fechaActual.getFullYear() - fechaNacimiento.getFullYear();
                if (fechaActual.getMonth() < fechaNacimiento.getMonth() || (fechaActual.getMonth() === fechaNacimiento.getMonth() && fechaActual.getDate() < fechaNacimiento.getDate())) {
                    edad--;
                }
            $('#edad').val(edad);
            $("#sexo").val('Masculino').trigger('change');
            $('#calle').val('Juan Pablo Duarte' + n);
            $('#cp').val('77777' + n);
            $('#telefono_1').val('8211450189' + n);
            $('#telefono_2').val('8211031666' + n);
            $('#CURP').val('AA5AAA232AA2W3' + n);
            $('#RFC').val('BBB3B24BBB23BB23' + n);
        }
    </script>
</body>
</html>