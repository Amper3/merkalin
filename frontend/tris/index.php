<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <title>Piramide</title>
    <!--FUENTES-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Farsan&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Estonia&family=Kaushan+Script&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Assistant:wght@200..800&display=swap" rel="stylesheet"><!-- FUENTE -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/frontend/recursos/style_General.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="main-content">
        <?php include_once "../aNavFooter/nav.php";?>
        <div class="contenedor">
            <section>
                <h1>Piramide</h1>
                <div class="cuadro" id="fila_1">
                    <input value="0" class="numero activo" id="n1" type="number">
                    <input value="0" class="numero activo" id="n2" type="number">
                    <input value="0" class="numero activo" id="n3" type="number">

                    <input value="0" class="numero" id="d1" type="text">
                    <input value="0" class="numero" id="d2" type="text">

                    <input value="0" class="numero" id="m1" type="text">
                    <input value="0" class="numero" id="m2" type="text">

                    <input value="0" class="numero" id="y1" type="text">
                    <input value="0" class="numero" id="y2" type="text">
                </div>
                <div class="cuadro" id="fila_2">
                    <input class="numero oculto" type="text">
                    <input value="0" class="numero" id="r8_2" type="text">
                    <input value="0" class="numero" id="r7_2" type="text">
                    <input value="0" class="numero" id="r6_2" type="text">
                    <input value="0" class="numero" id="r5_2" type="text">
                    <input value="0" class="numero" id="r4_2" type="text">
                    <input value="0" class="numero" id="r3_2" type="text">
                    <input value="0" class="numero" id="r2_2" type="text">
                    <input value="0" class="numero" id="r1_2" type="text">
                </div>
                <div class="cuadro" id="fila_3">
                    <input class="numero oculto" type="text">
                    <input class="numero oculto" type="text">
                    <input value="0" class="numero" id="r7_3" type="text">
                    <input value="0" class="numero" id="r6_3" type="text">
                    <input value="0" class="numero" id="r5_3" type="text">
                    <input value="0" class="numero" id="r4_3" type="text">
                    <input value="0" class="numero" id="r3_3" type="text">
                    <input value="0" class="numero" id="r2_3" type="text">
                    <input value="0" class="numero" id="r1_3" type="text">
                </div>
                <div class="cuadro" id="fila_4">
                    <input class="numero oculto" type="text">
                    <input class="numero oculto" type="text">
                    <input class="numero oculto" type="text">
                    <input value="0" class="numero" id="r6_4" type="text">
                    <input value="0" class="numero" id="r5_4" type="text">
                    <input value="0" class="numero" id="r4_4" type="text">
                    <input value="0" class="numero" id="r3_4" type="text">
                    <input value="0" class="numero" id="r2_4" type="text">
                    <input value="0" class="numero" id="r1_4" type="text">
                </div>
                <div class="cuadro" id="fila_5">
                    <input class="numero oculto" type="text">
                    <input class="numero oculto" type="text">
                    <input class="numero oculto" type="text">
                    <input class="numero oculto" type="text">
                    <input value="0" class="numero" id="r5_5" type="text">
                    <input value="0" class="numero" id="r4_5" type="text">
                    <input value="0" class="numero" id="r3_5" type="text">
                    <input value="0" class="numero" id="r2_5" type="text">
                    <input value="0" class="numero" id="r1_5" type="text">
                </div>
                <div class="cuadro" id="fila_6">
                    <input class="numero oculto" type="text">
                    <input class="numero oculto" type="text">
                    <input class="numero oculto" type="text">
                    <input class="numero oculto" type="text">
                    <input class="numero oculto" type="text">
                    <input value="0" class="numero" id="r4_6" type="text">
                    <input value="0" class="numero" id="r3_6" type="text">
                    <input value="0" class="numero" id="r2_6" type="text">
                    <input value="0" class="numero" id="r1_6" type="text">
                </div>
                <div class="cuadro" id="fila_7">
                    <input class="numero oculto" type="text">
                    <input class="numero oculto" type="text">
                    <input class="numero oculto" type="text">
                    <input class="numero oculto" type="text">
                    <input class="numero oculto" type="text">
                    <input class="numero oculto" type="text">
                    <input value="0" class="numero" id="r3_7" type="text">
                    <input value="0" class="numero" id="r2_7" type="text">
                    <input value="0" class="numero" id="r1_7" type="text">
                </div>
                <div class="cuadro" id="fila_8">
                    <input class="numero oculto" type="text">
                    <input class="numero oculto" type="text">
                    <input class="numero oculto" type="text">
                    <input class="numero oculto" type="text">
                    <input class="numero oculto" type="text">
                    <input class="numero oculto" type="text">
                    <input class="numero oculto" type="text">
                    <input value="0" class="numero" id="r2_8" type="text">
                    <input value="0" class="numero" id="r1_8" type="text">
                </div>
                <div class="cuadro" id="fila_9">
                    <input class="numero oculto" type="text">
                    <input class="numero oculto" type="text">
                    <input class="numero oculto" type="text">
                    <input class="numero oculto" type="text">
                    <input class="numero oculto" type="text">
                    <input class="numero oculto" type="text">
                    <input class="numero oculto" type="text">
                    <input class="numero oculto" type="text">
                    <input value="0" class="numero" id="r1_9" type="text">
                </div>
            </section>
        </div>
        
      
        <?php include_once "../aNavFooter/footer.php"; ?>
    </div>
    
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        function setDateInputs() {
            const today = new Date();
            const day = String(today.getDate()).padStart(2, '0'); // Día con dos dígitos
            const month = String(today.getMonth() + 1).padStart(2, '0'); // Mes con dos dígitos
            const year = String(today.getFullYear()).slice(-2); // Últimos dos dígitos del año

            document.getElementById('d1').value = day[0];
            document.getElementById('d2').value = day[1];
            document.getElementById('m1').value = month[0];
            document.getElementById('m2').value = month[1];
            document.getElementById('y1').value = year[0];
            document.getElementById('y2').value = year[1];
         // 2   SEGUNDA
            const y1 = parseFloat(document.getElementById('y1').value) || 0;
            const y2 = parseFloat(document.getElementById('y2').value) || 0;
            const m1 = parseFloat(document.getElementById('m1').value) || 0;
            const m2 = parseFloat(document.getElementById('m2').value) || 0;
            const d1 = parseFloat(document.getElementById('d1').value) || 0;
            const d2 = parseFloat(document.getElementById('d2').value) || 0;
            const n1 = parseFloat(document.getElementById('n1').value) || 0;
            const n2 = parseFloat(document.getElementById('n2').value) || 0;
            const n3 = parseFloat(document.getElementById('n3').value) || 0;

            const r1_2 = y2 + y1;
            const r2_2 = y1 + m2;
            const r3_2 = m2 + m1;
            const r4_2 = m1 + d2;
            const r5_2 = d2 + d1;
            const r6_2 = d1 + n3;
            const r7_2 = n3 + n2;
            const r8_2 = n2 + n1;
            
            document.getElementById('r1_2').value = r1_2;
            document.getElementById('r2_2').value = r2_2;
            document.getElementById('r3_2').value = r3_2;
            document.getElementById('r4_2').value = r4_2;
            document.getElementById('r5_2').value = r5_2;
            document.getElementById('r6_2').value = r6_2;
            document.getElementById('r7_2').value = r7_2;
            document.getElementById('r8_2').value = r8_2;

         // 3 TERCERA
            const r1_3 = r1_2 + r2_2;
            const r2_3 = r2_2 + r3_2;
            const r3_3 = r3_2 + r4_2;
            const r4_3 = r4_2 + r5_2;
            const r5_3 = r5_2 + r6_2;
            const r6_3 = r6_2 + r7_2;
            const r7_3 = r7_2 + r8_2;
            
            document.getElementById('r1_3').value = r1_3;
            document.getElementById('r2_3').value = r2_3;
            document.getElementById('r3_3').value = r3_3;
            document.getElementById('r4_3').value = r4_3;
            document.getElementById('r5_3').value = r5_3;
            document.getElementById('r6_3').value = r6_3;
            document.getElementById('r7_3').value = r7_3;

         // 4 CUARTA
            const r1_4 = r1_3 + r2_3;
            const r2_4 = r2_3 + r3_3;
            const r3_4 = r3_3 + r4_3;
            const r4_4 = r4_3 + r5_3;
            const r5_4 = r5_3 + r6_3;
            const r6_4 = r6_3 + r7_3;
            
            document.getElementById('r1_4').value = r1_4;
            document.getElementById('r2_4').value = r2_4;
            document.getElementById('r3_4').value = r3_4;
            document.getElementById('r4_4').value = r4_4;
            document.getElementById('r5_4').value = r5_4;
            document.getElementById('r6_4').value = r6_4;

         // 5 quinta
            const r1_5 = r1_4 + r2_4;
            const r2_5 = r2_4 + r3_4;
            const r3_5 = r3_4 + r4_4;
            const r4_5 = r4_4 + r5_4;
            const r5_5 = r5_4 + r6_4;
            
            document.getElementById('r1_5').value = r1_5;
            document.getElementById('r2_5').value = r2_5;
            document.getElementById('r3_5').value = r3_5;
            document.getElementById('r4_5').value = r4_5;
            document.getElementById('r5_5').value = r5_5;

         // 6 SEXTA
            const r1_6 = r1_5 + r2_5;
            const r2_6 = r2_5 + r3_5;
            const r3_6 = r3_5 + r4_5;
            const r4_6 = r4_5 + r5_5;
            
            document.getElementById('r1_6').value = r1_6;
            document.getElementById('r2_6').value = r2_6;
            document.getElementById('r3_6').value = r3_6;
            document.getElementById('r4_6').value = r4_6;

         // 7 SEPTIMA
            const r1_7 = r1_6 + r2_6;
            const r2_7 = r2_6 + r3_6;
            const r3_7 = r3_6 + r4_6;
            
            document.getElementById('r1_7').value = r1_7;
            document.getElementById('r2_7').value = r2_7;
            document.getElementById('r3_7').value = r3_7;

         // 8 OCTAVA
            const r1_8 = r1_7 + r2_7;
            const r2_8 = r2_7 + r3_7;
            
            document.getElementById('r1_8').value = r1_8;
            document.getElementById('r2_8').value = r2_8;

         // 9 NOVENA
            const r1_9 = r1_8 + r2_8;
            
            document.getElementById('r1_9').value = r1_9;     
            
            cleanAndDisableInputs();

        }
        window.onload = setDateInputs;
        document.getElementById('n1').addEventListener('input', setDateInputs);
        document.getElementById('n2').addEventListener('input', setDateInputs);
        document.getElementById('n3').addEventListener('input', setDateInputs);

        function cleanInputs() {
            const inputs = document.querySelectorAll('.numero');
            
            inputs.forEach(input => {
                let value = input.value;
                if (value.length > 1) {
                    input.value = value.slice(-1); // Deja solo el último dígito
                }
            });
        }

        function cleanAndDisableInputs() {
            // Selecciona todos los inputs en la página
            const inputs = document.querySelectorAll('input');

            // Recorre cada input
            inputs.forEach(input => {
                // Si el input tiene la clase "numero"
                if (input.classList.contains('numero')) {
                    // Deja solo el último dígito en el valor del input
                    let value = input.value;
                    if (value.length > 1) {
                        input.value = value.slice(-1);
                    }
                }
                
                // Deshabilita el input si no tiene la clase "activo"
                if (!input.classList.contains('activo')) {
                    input.disabled = true;
                }
            });
        }


    </script>
</body>
</html>