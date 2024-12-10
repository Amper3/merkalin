<footer class=" text-center py-3">
    <p>Derechos de autor &copy; 2024 MerkaLin.</p>
    <p>Redes para pagina personalizada:</p>
    <div>
        <ul class="redes">
            <li class="icon whatsapp" onclick="go_WhatsappMy()">
                <span class="tooltip">Whatsapp</span>
                <span><i class="bi bi-whatsapp"></i></i></span>
            </li>
            <li class="icon phone" onclick="go_MarcarMy()">
                <span class="tooltip">Llamar</span>
                <span><i class="bi bi-telephone-outbound"></i></span>
            </li>
            <li class="icon facebook" onclick="go_FacebookMy()">
                <span class="tooltip">Facebook</span>
                <span><i class="bi bi-facebook"></i></span>
            </li>
            <li class="icon instagram" onclick="go_InstagramMy()">
                <span class="tooltip">Instagram</span>
                <span><i class="bi bi-instagram"></i></span>
            </li>
        </ul>
    </div>
</footer>
<script>
    function go_WhatsappMy() { 
        window.open("https://wa.me/8211450189?text=Hola%20me%20interesa%20su%20servicio", "_blank");
        // window.location.replace("https://wa.me/8211450189?text=Hola%20me%20interesa%20su%20servicio");            
        // window.location.href = "https://wa.me/8211450189?text=Hola%20me%20interesa%20su%20servicio";
        // window.location.href = "https://wa.me/8211450189"; // Reemplaza con el número de teléfono que desees
    }
    function go_MarcarMy() {
        window.open("tel:8211450189"); // Reemplaza con el número de teléfono que deseas marcar
    }
    function go_FacebookMy() {
        window.open("https://www.facebook.com/alberto.constante.39?mibextid=ZbWKwL"); // Reemplaza con la URL de tu página de Facebook
    }
    function go_InstagramMy() {
        window.open("https://www.instagram.com/alberto.constante.39?igsh=MWd1dzNjZzJsamdvYg=="); // Reemplaza con la URL de tu perfil de Instagram
    }
</script>