<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quintas</title>

    <!-- Fuentes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Farsan&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Estonia&family=Kaushan+Script&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Assistant:wght@200..800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="/frontend/recursos/style_General.css">
    <link rel="stylesheet" href="style_quinta.css">
</head>
<body>
    <div class="main-content">
        <!-- Navegación -->
        <?php include_once "../aNavFooter/nav.php"; ?>

        <!-- Búsqueda -->
        <div class="buscar">
            <form class="d-flex" role="search" aria-label="Formulario de búsqueda">
                <input class="form-control me-2" type="search" placeholder="Buscar..." aria-label="Buscar">
                <button class="btn btn-outline-success" type="submit" aria-label="Iniciar búsqueda">Buscar</button>
            </form>
        </div>

        <br>
        <h1>Quintas</h1>
        <br>

        <!-- Contenedor de tarjetas -->
        <div id="cards-container" class="cards-container"></div>

        <!-- Paginación -->
        <section aria-label="Navegación de paginación">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" aria-label="Página anterior">Anterior</a>
                    </li>
                    <!-- Números de página dinámicos -->
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Página siguiente">Siguiente</a>
                    </li>
                </ul>
            </nav>
        </section>

        <!-- Modales y pie de página -->
        <?php   
            include_once "../aNavFooter/footer.php"; 
            include "modals/modal_img.php";
            include "modals/modal_info.php";
        ?>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="funcion_quinta.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Parámetros
            let itemsPorPagina = 3;
            let paginaActual = 1;
            let totalPaginas;
            let datosGlobales = [];

            // Función para sanitizar datos
            function sanitizeHTML(str) {
                const temp = document.createElement('div');
                temp.textContent = str;
                return temp.innerHTML;
            }

            // Mostrar datos en tarjetas
            function mostrarDatos(pagina) {
                const container = document.getElementById("cards-container");
                container.innerHTML = "";

                // Calcular el índice de inicio y fin
                const inicio = (pagina - 1) * itemsPorPagina;
                const fin = inicio + itemsPorPagina;
                const itemsPagina = datosGlobales.slice(inicio, fin);

                itemsPagina.forEach(item => {
                    // Crear la estructura de cada tarjeta
                    const card = document.createElement("div");
                    card.classList.add("card");

                    let collageHTML = "";
                    item.imagenes.forEach((ruta, index) => {
                        const imgClass = index === 0 ? "img_principal" : "img_secundario";
                        collageHTML += `
                            <div class="box ${imgClass}">
                                <img src="${ruta || 'ruta/default.jpg'}" loading="lazy" class="img-fluid" alt="Imagen ${index + 1}" onclick="openModal_img(this)">
                            </div>`;
                    });

                    card.innerHTML = `
                        <i class="bi bi-list titulo_left" onclick="openMyModal_info('${sanitizeHTML(item.nombre)}', '${sanitizeHTML(item.info_extra)}', '${sanitizeHTML(item.dias)}', '${sanitizeHTML(item.phone)}', '${sanitizeHTML(item.whatsapp)}', '${sanitizeHTML(item.facebook)}', '${sanitizeHTML(item.instagram)}', '${sanitizeHTML(item.address)}');"></i>
                        <div class="titulo_centro">
                            <h1 class="card_h1">${sanitizeHTML(item.nombre || "Nombre no disponible")}</h1>
                        </div>
                        <div class="titulo_rigth">
                            <i class="bi bi-share"></i>
                            <i class="bi bi-heart" onclick="toggleHeart(this)"></i>
                        </div>
                        <div id="collage" class="collage">
                            ${collageHTML}
                        </div>
                        <div class="card-body" onclick="openMyModal_info('${sanitizeHTML(item.nombre)}', '${sanitizeHTML(item.info_extra)}', '${sanitizeHTML(item.dias)}', '${sanitizeHTML(item.phone)}', '${sanitizeHTML(item.whatsapp)}', '${sanitizeHTML(item.facebook)}', '${sanitizeHTML(item.instagram)}', '${sanitizeHTML(item.address)}');">
                            <p>Horario: ${sanitizeHTML(item.horario || "No disponible")}</p>
                            <p>Dirección: ${sanitizeHTML(item.address || "No disponible")}</p>
                            <p>Precio: $ ${sanitizeHTML(item.precio || "No disponible")}</p>
                        </div>`;
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
            
            fetch("/../backend/back_quinta/quinta_cards.php")
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

</body>
</html>