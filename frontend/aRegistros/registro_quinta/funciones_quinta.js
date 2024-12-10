//  Checkboxes Dias
    const allDiasCheckbox = document.getElementById('all_dias');
    const diasCheckbox = document.getElementById('dias');
    const diasDiv = document.getElementById('dias_div');
    const checkDias = document.getElementById('check_dias');

    function updateCheckboxes() {
        // Si check_dias está marcado, marcar all_dias y desmarcar dias
        if (checkDias.checked) {
            allDiasCheckbox.checked = true;
            diasCheckbox.checked = false;
            diasDiv.style.display = 'none'; // Ocultar el div
            clearCustomDays(); // Limpiar los días personalizados
        } else {
            // Mostrar/ocultar el div de días personalizados
            diasDiv.style.display = diasCheckbox.checked ? 'block' : 'none';
        }

        // Si all_dias está marcado
        if (allDiasCheckbox.checked) {
            diasCheckbox.checked = false; // Desmarcar personalizado
            clearCustomDays(); // Limpiar los días personalizados
            diasDiv.style.display = 'none'; // Asegurarse de que el div esté oculto
        }
    }
// desmarcar todos los checkboxes en el div de días
    function clearCustomDays() {
        const dayCheckboxes = diasDiv.querySelectorAll('input[type="checkbox"]');
        dayCheckboxes.forEach(checkbox => {
            checkbox.checked = false;
        });
    }
// Agregar eventos de cambio a los checkboxes
    checkDias.addEventListener('change', updateCheckboxes);
    allDiasCheckbox.addEventListener('change', updateCheckboxes);
    diasCheckbox.addEventListener('change', () => {
        // Cuando se chequea 'Personalizado', desmarcar 'Todos los días'
        if (diasCheckbox.checked) {
            allDiasCheckbox.checked = false;
            diasDiv.style.display = 'block'; // Mostrar el div
        } else {
            diasDiv.style.display = 'none'; // Ocultar el div si 'Personalizado' no está marcado
        }
        updateCheckboxes(); // Actualizar el estado de los checkboxes
    });

// VALIDAR FORMULARIO
    function confirmarEnvio() {
        return Swal.fire({
            title: '¿Confirmar envío?',
            text: "¿Estás seguro de que la información esta correcta? El nombre ingresado no podrá ser modificado posteriormente. Por favor, asegúrese de que esté correctamente escrito antes de continuar.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, confirmar',
            cancelButtonText: 'No, cancelar'
        }).then((result) => {
            return result.isConfirmed;
        });
    }

    function validarCamposFormulario() {
        var campos = document.getElementById('form_registro').querySelectorAll('input, select');
        var formularioValido = true;
        var maxFileSizeMB = 20;
        var maxFileSizeBytes = maxFileSizeMB * 1024 * 1024;

        campos.forEach(function (campo) {
            // Salta la validación si el campo tiene la clase 'ignorar'
            if (campo.classList.contains('ignorar')) {
                return;
            }

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

    // document.getElementById('form_registro').addEventListener('submit', function (event) {
    //     if (validarCamposFormulario()) {
    //         event.preventDefault(); // Prevenir el envío por ahora

    //         confirmarEnvio().then((confirmado) => {
    //             if (confirmado) {
    //                 event.target.submit(); // Enviar el formulario si se confirma
    //             }
    //         });
    //     } else {
    //         // Si hay campos inválidos, detener el envío
    //         event.preventDefault(); // Evitar el envío si hay errores
    //     }
    // });

    document.getElementById('form_registro').addEventListener('submit', function (event) {
        if (validarCamposFormulario()) {
            event.preventDefault(); // Prevenir el envío por ahora
    
            confirmarEnvio().then((confirmado) => {
                if (confirmado) {
                    const formData = new FormData(event.target);
                    
                    // Mostrar los datos en consola antes de enviarlos
                    for (let [name, value] of formData.entries()) {
                        console.log(name, value);
                    }
    
                    event.target.submit(); // Enviar el formulario si se confirma
                }
            });
        } else {
            // Si hay campos inválidos, detener el envío
            event.preventDefault(); // Evitar el envío si hay errores
        }
    });
    
// LIMPIAR
    function limpiar_validos() {
    var campos = document.getElementById('form_registro').querySelectorAll('input, select');
    campos.forEach(function (campo) {
        campo.classList.remove('is-invalid');
        campo.disabled = false;
    });
    }

// QUITAR INVALIDO CUANDO SE MODIFICA
    document.querySelectorAll('#form_registro input, #form_registro select').forEach(function (campo) {
        campo.addEventListener('input', function () {
            if (campo.value.trim() !== '') {
                campo.classList.remove('is-invalid');
            }
        });
    });

// DESABILITA INPUT CON CHECK
    document.addEventListener("DOMContentLoaded", function () {
        // Selecciona todos los checkboxes que tienen un id que empieza con 'check_'
        const checkboxes = document.querySelectorAll("input[type='checkbox'][id^='check_']");
        // Función que se ejecuta al cambiar el estado de cualquier checkbox
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener("change", function () {
                // Extrae el id del input relacionado, quitando "check_"
                const inputId = this.id.replace("check_", "");
                const relatedInput = document.getElementById(inputId);
                if (relatedInput) {
                    relatedInput.disabled = this.checked; // Deshabilita si está marcado, habilita si no
                    // Agrega o quita la clase 'ignorar' según el estado del checkbox
                    if (this.checked) {
                        relatedInput.classList.add("ignorar"); // Agrega la clase
                        relatedInput.classList.remove("is-invalid"); // Remueve 'is-invalid' si está marcado
                        relatedInput.value = ""; // Limpia el valor del input cuando se deshabilita
                    } else {
                        relatedInput.classList.remove("ignorar"); // Remueve la clase
                        relatedInput.value = ""; // Limpia el valor del input cuando se deshabilita
                    }
                }
            });
        });
    });

// BOTON CANCELAR
    document.getElementById('cancelButton').addEventListener('click', function (event) {
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

// llenar datos selects
    $(document).ready(function () {
        $('select').select2({});

        // Evento al abrir el Select2
        $('select').on('select2:open', function() {
            // Espera a que el menú se abra
            setTimeout(function() {
                // Obtiene el campo de búsqueda
                const searchField = $('.select2-search__field');
                if (searchField.length) {
                    // Hace focus en el campo de búsqueda
                    searchField.focus();
                }
            }, 1); // El tiempo de espera puede ser 1 ms para asegurarte que el menú esté abierto
        });
        // $.ajax({
        //     url: '../../../backend/back_quinta/select_cat.php',
        //     type: 'GET',
        //     dataType: 'json',
        //     success: function (data) {
        //         $('#id_categoria').empty();
        //         $('#id_categoria').append('<option value="">Seleccione una categoría</option>');
        //         $.each(data, function (index, categoria) {
        //             $('#id_categoria').append('<option value="' + categoria.id_categoria + '">' + categoria.categoria + '</option>');
        //         });
        //     },
        //     error: function (xhr, status, error) {
        //         console.error('Error en la solicitud:', status, error);
        //     }
        // });
        $.ajax({
            url: '../../../backend/back_quinta/select_col.php',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                $('#colonia').empty();
                $('#colonia').append('<option value="">Seleccione una colonia</option>');
                $.each(data, function (index, colonias) {
                    $('#colonia').append('<option value="' + colonias.colonia + '">' + colonias.colonia + '</option>');
                });
            },
            error: function (xhr, status, error) {
                console.error('Error en la solicitud:', status, error);
            }
        });
    });

// llenar datos auto
    function llenarDatos() {
        document.getElementById('nombre').value = '';
        document.getElementById('horario_inicio').value = '10:00';
        document.getElementById('horario_final').value = '18:00';
        document.getElementById('colonia').value = '1';
        document.getElementById('precio').value = '1000.00';
        document.getElementById('info_extra').value = 'Información adicional';
        document.getElementById('direccion').value = '123 Calle Ejemplo';
        document.getElementById('numero').value = '1234567890';
        document.getElementById('whatsapp').value = '0987654321';
        document.getElementById('facebook').value = 'facebook.com/quintaampere';
        document.getElementById('instagram').value = 'instagram.com/quintaampere';
    }
    window.onload = llenarDatos;

// FUNCION PARA PREGUNTAR SI QUIERE SALIR
// window.addEventListener('beforeunload', function(event) {
//     event.preventDefault();
//     event.returnValue = '';
// });