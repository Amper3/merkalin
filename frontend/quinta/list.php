<?php
    include_once "../../backend/auth/verificar_sesion.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quintas</title>
    <!--FUENTES-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Farsan&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Estonia&family=Kaushan+Script&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Assistant:wght@200..800&display=swap" rel="stylesheet"><!-- FUENTE -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/frontend/recursos/style_General.css">
    <link rel="stylesheet" href="style_quinta.css">
</head>
<body>
    <div class="main-content">
        <?php include_once "../aNavFooter/nav.php";?>
        <div class="buscar">
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Buscar..." aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Buscar</button>
            </form>
        </div>
        <br>
        <h1>Registros</h1>
        <br>
        <div id="cards-container" class="cards-container">
        </div>

        <section>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link">Anterior</a>
                    </li>
                    <!-- Aquí se insertarán dinámicamente los números de página -->
                    <li class="page-item">
                        <a class="page-link" href="#">Siguiente</a>
                    </li>
                </ul>
            </nav>
        </section>
      
        <?php   
            include_once "../aNavFooter/footer.php"; 
            include "modals/modal_img.php";
            include "modals/modal_img_up.php";
            include "modals/modal_info.php";
            include "modals/modal_editar.php";
        ?>
    </div>
    
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script><!-- ICONOS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="funcion_quinta.js"></script>
    <script src="../aRegistros/registro_quinta/funciones_quinta.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Parámetros de paginación
            let itemsPorPagina = 10;
            let paginaActual = 1;
            let totalPaginas;
            let datosGlobales = [];

            function mostrarDatos(pagina) {
                const container = document.getElementById("cards-container");
                container.innerHTML = ""; // Limpiar contenido previo

                // Calcular el índice de inicio y fin
                const inicio = (pagina - 1) * itemsPorPagina;
                const fin = inicio + itemsPorPagina;
                const itemsPagina = datosGlobales.slice(inicio, fin);

                itemsPagina.forEach(item => {
                    // Crear la estructura de cada tarjeta
                    const card = document.createElement("div");
                    card.classList.add("card");

                    // let collageHTML = "";
                    // item.imagenes.forEach((ruta, index) => {
                    //     const imgClass = index === 0 ? "img_principal" : "img_secundario";
                    //     const imgType = index === 0 ? "principal" : `secundaria_${index}`; // Para identificar el tipo de imagen

                    //     collageHTML += `
                    //         <div class="box ${imgClass}">
                    //             <img src="${ruta || 'ruta/default.jpg'}" class="img-fluid" alt="Imagen ${index + 1}" 
                    //                 onclick="openReplaceModal(this, ${item.id_sub_cat}, '${imgType}', '${item.nombre}')">
                    //         </div>
                    //     `;
                    // });

                    let collageHTML = "";
                    item.imagenes.forEach((ruta, index) => {
                        const imgClass = index === 0 ? "img_principal" : "img_secundario";
                        const imgType = index === 0 ? "principal" : `secundaria_${index}`; // Para identificar el tipo de imagen
                        const uniqueURL = `${ruta || 'ruta/default.jpg'}?t=${new Date().getTime()}`; // Marca de tiempo única

                        collageHTML += `
                            <div class="box ${imgClass}">
                                <img src="${uniqueURL}" class="img-fluid" alt="Imagen ${index + 1}" 
                                    onclick="openReplaceModal(this, ${item.id_sub_cat}, '${imgType}', '${item.nombre}')">
                            </div>
                        `;
                    });

                    // Determinar propiedades del botón según `activo`
                    const buttonClass = Number(item.activo) === 1 ? "btn-danger" : "btn-success";
                    const buttonText = Number(item.activo) === 1 ? "Desactivar" : "Activar";


                    card.innerHTML = `
                        <i class="bi bi-list titulo_left"></i>
                        <div class="titulo_centro">
                            <h1 class="card_h1">${item.nombre || "Nombre no disponible"}</h1>
                        </div>
                        <div class="titulo_rigth">
                            <i class="bi bi-share"></i>
                            <i class="bi bi-heart" onclick="toggleHeart(this)"></i>
                        </div>
                        <div id="collage" class="collage">
                            ${collageHTML}
                        </div>
                        <div class="card-body">
                            <div class="accordion" id="accordionPanelsStayOpenExample">
                                <div class="accordion-item">
                                   <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                            Datos del Servicio
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <p>Nombre: ${item.nombre || "No disponible"}</p>
                                            <p>Colonia: ${item.colonia || "No disponible"}</p>
                                            <p>Precio: ${item.precio || "No disponible"}</p>
                                            <p>Horario de inicio: ${item.horario_inicio || "No disponible"}</p>
                                            <p>Horario de cierre: ${item.horario_final || "No disponible"}</p>
                                            <p>Días disponible: ${item.dias || "No disponible"}</p>
                                            <p>Información adicional: ${item.info_extra || "No disponible"}</p>
                                            <p>Dirección Exacta: ${item.address || "No disponible"}</p>
                                            <p>Número de teléfono: ${item.phone || "No disponible"}</p>
                                            <p>Número de WhatsApp: ${item.whatsapp || "No disponible"}</p>
                                            <p>Facebook: ${item.facebook || "No disponible"}</p>
                                            <p>Instagram: ${item.instagram || "No disponible"}</p>
                                            <p>Activo: ${item.activo || "No disponible"}</p>
                                            <p>Revisado: ${item.revisado || "No disponible"}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="d-grid gap-2 d-md-block">
                                <button class="btn btn-primary" type="button" onclick="editarItem('${item.id_sub_cat}', '${item.nombre}', '${item.colonia}', '${item.precio}', '${item.horario_inicio}','${item.horario_final}','${item.dias}','${item.info_extra}', '${item.address}','${item.phone}', '${item.whatsapp}', '${item.facebook}', '${item.instagram}')">Editar</button>
                                <button class="btn ${buttonClass}" type="button" onclick="toggleActivo(${item.id_sub_cat}, ${item.activo})">${buttonText}</button>
                            </div>
                        </div>
                    `;
                    container.appendChild(card);
                });

                // Actualizar los botones de la paginación dinámicamente
                    const paginationContainer = document.querySelector(".pagination");
                    // Remover cualquier página numérica previa
                    while (paginationContainer.children.length > 2) {
                        paginationContainer.removeChild(paginationContainer.children[1]);
                    }
                    
                    for (let i = 1; i <= totalPaginas; i++) {
                        const pageItem = document.createElement("li");
                        pageItem.classList.add("page-item");
                        if (i === paginaActual) {
                            pageItem.classList.add("active");
                        }
                        const pageLink = document.createElement("a");
                        pageLink.classList.add("page-link");
                        pageLink.href = "#";
                        pageLink.textContent = i;
                        pageItem.appendChild(pageLink);
                        paginationContainer.insertBefore(pageItem, paginationContainer.children[paginationContainer.children.length - 1]);
                    }

                // Actualizar botones de paginación
                    document.querySelector(".pagination .page-item:first-child").classList.toggle("disabled", paginaActual === 1);
                    document.querySelector(".pagination .page-item:last-child").classList.toggle("disabled", paginaActual === totalPaginas);
            }

            function cargarPagina(pagina) {
                if (pagina >= 1 && pagina <= totalPaginas) {
                    paginaActual = pagina;
                    mostrarDatos(pagina);
                }
            }

            fetch("/../backend/back_quinta/quinta_cards_list.php")
                .then(response => response.json())
                .then(data => {
                    datosGlobales = data;
                    totalPaginas = Math.ceil(data.length / itemsPorPagina);
                    mostrarDatos(paginaActual);
                })
                .catch(error => console.error("Error al obtener los datos:", error));

            // Eventos para la paginación
            document.querySelector(".pagination").addEventListener("click", function(event) {
                if (event.target.tagName === "A") {
                    event.preventDefault();
                    if (event.target.textContent === "Anterior") {
                        cargarPagina(paginaActual - 1);
                    } else if (event.target.textContent === "Siguiente") {
                        cargarPagina(paginaActual + 1);
                    } else {
                        cargarPagina(parseInt(event.target.textContent));
                    }
                }
            });
        });
    </script>

    <script>
        function editarItem(id_sub_cat , nombre, colonia, precio, horario_inicio, horario_final, dias, info_extra, address,  phone, whatsapp, facebook, instagram) {
            // Asignar valores a los campos del formulario
            document.getElementById("id_sub_cat").value = id_sub_cat || "";
            document.getElementById("nombre").innerText = nombre || "";

            document.getElementById("colonia").value = colonia || "";
            document.getElementById("precio").value = precio || "";
            document.getElementById("horario_inicio").value = horario_inicio || "";
            document.getElementById("horario_final").value = horario_final || "";

            const diasCheckboxes = ["L", "M", "MI", "J", "V", "S", "D"];
            if (dias === "L-D") {
                // Marcar "Todos los días"
                document.getElementById("all_dias").checked = true;
                document.getElementById("dias").checked = false;
                document.getElementById("dias_div").style.display = "none"; // Ocultar la sección de días personalizados
            } else {
                // Marcar días personalizados
                document.getElementById("all_dias").checked = false;
                document.getElementById("dias").checked = dias && dias.length > 0;
                const diasArray = dias ? dias.split(",") : [];
                diasCheckboxes.forEach(dia => {
                    document.getElementById(dia).checked = diasArray.includes(dia);
                });
                document.getElementById("dias_div").style.display = diasArray.length > 0 ? "block" : "none"; // Mostrar si hay días seleccionados
            }

            document.getElementById("info_extra").value = info_extra || "";
            document.getElementById("direccion").value = address || "";
            document.getElementById("numero").value = phone || "";
            document.getElementById("whatsapp").value = whatsapp || "";
            document.getElementById("facebook").value = facebook || "";
            document.getElementById("instagram").value = instagram || "";

            // Mostrar el modal después de asignar los datos
            const modal = new bootstrap.Modal(document.getElementById('modal_editar'));
            modal.show();
        }
    </script>
    <script>
        function openReplaceModal(imageElement, idSubCat, imageType, nombre) {
            const modal = document.getElementById("modal_replace_img");
            const imgElement = document.getElementById("replace_img01");

            // Configurar datos en el modal
            modal.dataset.idSubCat = idSubCat;
            modal.dataset.imageType = imageType;
            modal.dataset.nombre = encodeURIComponent(nombre);

            // Verificar si la imagen tiene una ruta válida
            imgElement.src = imageElement.src || 'ruta/default.jpg';

            modal.style.display = "block"; // Mostrar el modal
            document.body.style.overflow = "hidden"; // Desactivar el scroll
        }

        function closeReplaceModal() {
            const modal = document.getElementById("modal_replace_img");
            modal.style.display = "none";
            document.body.style.overflow = ""; // Reactiva scroll
        }

        function submitImageReplace() {
            const modal = document.getElementById("modal_replace_img");
            const idSubCat = modal.dataset.idSubCat;
            const imageType = modal.dataset.imageType;
            const nombre = modal.dataset.nombre;
            const inputFile = document.getElementById("replaceInputNewImage");

            if (inputFile.files.length === 0) {
                alert("Por favor, selecciona una imagen para reemplazar.");
                return;
            }

            const formData = new FormData();
            formData.append("id_sub_cat", idSubCat);
            formData.append("imageType", imageType);
            formData.append("nombre", nombre);
            formData.append("new_image", inputFile.files[0]);

            fetch("/../backend/back_quinta/quinta_remplazar_img.php", {
                method: "POST",
                body: formData,
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        alert("Imagen reemplazada correctamente. Los cambios pueden verse después de cargar nuevamente la página.");

                        // Actualizar la imagen en el collage si está disponible
                        const collageImg = document.querySelector(`[src="${data.old_image}"]`);
                        if (collageImg) collageImg.src = data.new_image;

                        // Actualizar la imagen en el modal
                        document.getElementById("replace_img01").src = data.new_image;

                        closeReplaceModal();
                    } else {
                        alert(`Error: ${data.error}`);
                    }
                })
                .catch((error) => console.error("Error:", error));
        }
    </script>

    <script>
        function toggleActivo(id, estadoActual, paginaActual) {
            const nuevoEstado = estadoActual === 1 ? 0 : 1;
            fetch("/backend/back_quinta/quinta_activo.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                body: `id=${id}&activo=${nuevoEstado}`,
            })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    console.log("Estado actualizado correctamente.");
                    location.reload(); // Recarga la página actual
                } else {
                    throw new Error(data.message || "Error al actualizar el estado.");
                }
            })
        }
    </script>
</body>
</html>