// MODAL IMGENES COLLAGE
var currentIndex = 0;
    var images = [];
    var startX; // Almacena la posición inicial del toque o clic
    var endX;   // Almacena la posición final

    function openModal_img(element) {
        var modal = document.getElementById("modal_img");
        var modalImg = document.getElementById("img01");

        var card = element.closest('.card'); // Asegúrate de que '.card' sea la clase de tu tarjeta
        var collageImages = card.querySelectorAll("img"); // Solo busca imágenes dentro de esta tarjeta
        
        // Recolectar todas las imágenes del collage
        images = Array.from(collageImages);
        
        // Encontrar el índice de la imagen actual
        currentIndex = images.indexOf(element);

        // Mostrar el modal y cargar la imagen seleccionada
        modal.style.display = "block";
        modalImg.src = element.src;
        document.body.style.overflow = "hidden"; // Desactiva el scroll

        // Añadir los eventos para detectar arrastre (drag/swipe)
        modalImg.addEventListener("touchstart", startSwipe);
        modalImg.addEventListener("touchend", endSwipe);
        modalImg.addEventListener("mousedown", startDrag);
        modalImg.addEventListener("mouseup", endDrag);
    }

    function closeModal_img() {
        var modal = document.getElementById("modal_img");
        modal.style.display = "none";
        document.body.style.overflow = ""; // Reactiva el scroll

        // Remover los eventos de arrastre (drag/swipe) para evitar interferencias
        var modalImg = document.getElementById("img01");
        modalImg.removeEventListener("touchstart", startSwipe);
        modalImg.removeEventListener("touchend", endSwipe);
        modalImg.removeEventListener("mousedown", startDrag);
        modalImg.removeEventListener("mouseup", endDrag);
    }

    let isThrottled = false; // Definir la variable globalmente

    function plusSlides(n) {
        if (isThrottled) return; // Si estamos en espera, no hacer nada

        isThrottled = true; // Activar la restricción temporal porque iba muy rapido si le dejabas picado
        setTimeout(() => {
            isThrottled = false; // Desactivar la restricción después de medio segundo (500 ms)
        }, 150);


        currentIndex += n;

        // Si nos pasamos del rango de imágenes, reiniciamos
        if (currentIndex >= images.length) {
            currentIndex = 0; // Volver al inicio
        } else if (currentIndex < 0) {
            currentIndex = images.length - 1; // Ir al final
        }

        // Actualizar la imagen en el modal
        var modalImg = document.getElementById("img01");
        modalImg.src = images[currentIndex].src;
    }

    function startSwipe(event) {
        startX = event.touches[0].clientX; // Posición inicial del toque
    }

    function endSwipe(event) {
        endX = event.changedTouches[0].clientX; // Posición final del toque
        handleSwipe();
    }

    function startDrag(event) {
        startX = event.clientX; // Posición inicial del clic
    }

    function endDrag(event) {
        endX = event.clientX; // Posición final del clic
        handleSwipe();
    }

    function handleSwipe() {
        var deltaX = startX - endX;

        if (Math.abs(deltaX) > 50) { // Detecta si hubo un deslizamiento significativo
            if (deltaX > 0) {
                // Deslizamiento hacia la izquierda, ir a la siguiente imagen
                plusSlides(1);
            } else {
                // Deslizamiento hacia la derecha, ir a la imagen anterior
                plusSlides(-1);
            }
        }
}
// funciones modal info extra
    function openMyModal_info(nombre, info_extra, dias, phone, whatsapp, facebook, instagram, address) {
        // Actualiza el contenido del modal con los datos pasados
        document.getElementById('modal_title').textContent = nombre;
        document.getElementById('modal_info_extra').textContent = info_extra;
        document.getElementById('modal_dias').textContent = dias;


        // Configura los enlaces o acciones para los iconos
        if (phone) {
            document.getElementById('phone_icon').setAttribute('data-phone', phone);
            document.getElementById('phone_icon').style.display = ''; // Restablece el estilo predeterminado
        } else {
            document.getElementById('phone_icon').style.display = 'none';
        }
        
        if (whatsapp) {
            document.getElementById('whatsapp_icon').setAttribute('data-whatsapp', whatsapp);
            document.getElementById('whatsapp_icon').style.display = '';
        } else {
            document.getElementById('whatsapp_icon').style.display = 'none';
        }
        
        if (facebook) {
            document.getElementById('facebook_icon').setAttribute('data-facebook', facebook);
            document.getElementById('facebook_icon').style.display = '';
        } else {
            document.getElementById('facebook_icon').style.display = 'none';
        }
        
        if (instagram) {
            document.getElementById('instagram_icon').setAttribute('data-instagram', instagram);
            document.getElementById('instagram_icon').style.display = '';
        } else {
            document.getElementById('instagram_icon').style.display = 'none';
        }
        
        if (address) {
            document.getElementById('googlemaps_icon').setAttribute('data-address', address);
            document.getElementById('googlemaps_icon').style.display = '';
        } else {
            document.getElementById('googlemaps_icon').style.display = 'none';
        }
        
        // Muestra el modal
        var modal_info = new bootstrap.Modal(document.getElementById('modal_info'));
        modal_info.show();
    }
// FUNCIONES REDES:
    function go_Whatsapp(whatsapp) {
        window.open(`https://wa.me/${whatsapp}?text=Hola%20me%20interesa%20su%20servicio`, "_blank");
    }

    function go_Marcar(phone) {
        window.open(`tel:${phone}`);
    }

    function go_Facebook(facebook) {
        window.open(facebook, "_blank");
    }

    function go_Instagram(instagram) {
        window.open(instagram, "_blank");
    }
    function go_GoogleMaps(address) {
        const encodedAddress = encodeURIComponent(address);
        window.open(`https://www.google.com/maps/search/?api=1&query=${encodedAddress}`, "_blank");
    }

    document.getElementById('phone_icon').addEventListener('click', function() {
        var phone = this.getAttribute('data-phone');
        go_Marcar(phone);
    });

    document.getElementById('whatsapp_icon').addEventListener('click', function() {
        var whatsapp = this.getAttribute('data-whatsapp');
        go_Whatsapp(whatsapp);
    });

    document.getElementById('facebook_icon').addEventListener('click', function() {
        var facebook = this.getAttribute('data-facebook');
        go_Facebook(facebook);
    });

    document.getElementById('instagram_icon').addEventListener('click', function() {
        var instagram = this.getAttribute('data-instagram');
        go_Instagram(instagram);
    });
    document.getElementById('googlemaps_icon').addEventListener('click', function() {
        var address = this.getAttribute('data-address');
        go_GoogleMaps(address);
    });

    function toggleHeart(element) {
        // Si el elemento contiene la clase 'bi-heart-fill'
        if (element.classList.contains('bi-heart-fill')) {
            // Cambiar a 'bi-heart' y eliminar el color rojo
            element.classList.remove('bi-heart-fill');
            element.classList.add('bi-heart');
            element.style.color = ''; // Restablecer el color
        } else {
            // Cambiar a 'bi-heart-fill' y agregar el color rojo
            element.classList.remove('bi-heart');
            element.classList.add('bi-heart-fill');
            element.style.color = 'red'; // Cambiar a rojo
        }
    }

// function openMyModal_registro() { ??????????
//     var modal_info = new bootstrap.Modal(document.getElementById('modal_registro'));
//     modal_info.show();
// }