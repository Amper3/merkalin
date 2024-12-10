<div id="modal_replace_img" class="modal_replace_img">
    <!-- Botón de cerrar -->
    <i class="bi bi-x-circle-fill close cerrar_modal_replace_img" onclick="closeReplaceModal()"></i>

    <!-- Contenido del modal -->
    <div class="modal_replace_content">
        <!-- Imagen en el modal -->
        <img class="modal-content-remplace" id="replace_img01" alt="Imagen actual">

        <!-- Input para seleccionar nueva imagen -->
        <!-- <input type="file" id="replaceInputNewImage" class="form-control mt-3"> -->
        <input type="file" id="replaceInputNewImage" class="form-control mt-3" accept="image/*">

        <br>
        <!-- Botón para reemplazar imagen -->
        <button class="btn btn-success mt-2" onclick="submitImageReplace()">Reemplazar Imagen</button>
    </div>
</div>

<style>
    /* Modal */
    .modal_replace_img {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.8); /* Fondo semi-transparente */
        z-index: 1050;
        padding-top: 60px; /* Para que no quede debajo del nav */
        overflow: hidden; /* Evitar que el contenido se desborde */
    }

    /* Contenido del modal */
    .modal_replace_content {
        position: relative;
        height: calc(100% - 60px); /* Ajustar el contenido para no cubrir el nav */
        display: flex;
        flex-direction: column; /* Disposición vertical */
        justify-content: flex-start; /* Alineación al inicio (arriba) */
        align-items: center; /* Centrado horizontal */
        color: white;
        padding: 20px;
        box-sizing: border-box;
        overflow: hidden; /* Evitar que haya desbordamiento de contenido */
    }

    /* Imagen dentro del modal */
    .modal-content-remplace {
        width: auto;
        max-width: 80%; /* Limitar el ancho máximo */
        max-height: 50vh; /* Limitar la altura máxima */
        height: auto; /* Mantener proporciones */
        object-fit: contain; /* Mantener la proporción original de la imagen */
        display: block;
        margin: auto;
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    /* Animación de zoom */
    @keyframes zoom {
        from {
            transform: scale(0.5);
        }
        to {
            transform: scale(1);
        }
    }

    /* Botones en la parte inferior */
    .modal_replace_content .buttons-container {
        margin-top: auto; /* Empuja los botones al final */
        display: flex;
        justify-content: center; /* Centrar los botones */
        width: 100%;
    }

    /* Estilo para el botón de cerrar */
    .close {
        position: absolute;
        top: 10px;
        right: 20px;
        font-size: 30px;
        color: white;
        cursor: pointer;
    }

    /* Asegurarse que no haya desbordamiento */
    body.modal-open {
        overflow: hidden; /* Evita que se pueda hacer scroll cuando el modal está abierto */
    }
</style>