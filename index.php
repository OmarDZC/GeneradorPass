<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Generador de password</title>
</head>
<body>

    <header id="header">Generador de Password</header>

    <main>
        <div class="containerPost">

            <form action="" method="post">

                <div class="divGroup">
                    <label for="">Longitud de la contraseña</label>
                    <input class="inputLength" type="number" name="length" id="length" min="8" max="128" required >
                </div>
                
                <div class="divGroup">
                    <label for="upper">Incluir letras mayúsculas</label>
                    <input type="checkbox" name="upper" id="upper">
                </div>

                <div class="divGroup">
                    <label for="lower">Incluir letras minúsculas</label>
                    <input type="checkbox" name="lower" id="lower">
                </div>

                <div class="divGroup">
                    <label for="numbers">Incluir números</label>
                    <input type="checkbox" name="numbers" id="numbers">
                </div>

                <div class="divGroup">
                    <label for="special">Incluir caracteres especiales</label>
                    <input type="checkbox" name="special" id="special">
                </div>
                
                <div class="divBoton">
                    <input type="submit" value="enviar">
                </div>

            </form>

        </div>
    </main>


    <div id="result">

            <!-- para mostrar el resultado del generador --> 
            <?php
            
            //verificar si el forumlario fue enviado
            if ($_SERVER["REQUEST_METHOD"] === "POST") {

                //si el post contiene length y si no tiene valor que este sea 12
                $length = isset($_POST['length']) ? intval ($_POST['length']) : 12;

                //validar que $length sea entre 8 y 128
                if ($length < 8) {
                    $length = 8;
                } elseif ($length > 128) {
                    $length = 128;
                }

                //para ver si incluye (si ha marcado) las mayusc, minusc... etc
                $incluir_upper = isset($_POST['upper']);
                $incluir_lower = isset($_POST['lower']);
                $incluir_numbers = isset($_POST['numbers']);
                $incluir_special = isset($_POST['special']);

                //si se ha marcado cada una de las opciones, se crea la variable con cadena vacia para llenar
                $characters = '';
                if ($incluir_upper) $characters .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'; //.= para concatenar una cadena al final de la otra
                if ($incluir_lower) $characters .= 'abcdefghijklmnopqrstuvwxyz';
                if ($incluir_numbers) $characters .= '0123456789';
                if ($incluir_special) $characters .= '!@#$%^&*()_+[]{}|;:,.<>?';

                //si no hay caracteres como marcado este devuelve que no se selecciono y exit
                if (empty($characters)) {
                    echo "No se seleccionó ningún tipo de carácter";
                    return exit;
                }

                //se inicia como cadena vacia
                $password = '';
                for ($i=0; $i < $length; $i++) { 
                    $password .= $characters[random_int(0, strlen($characters) -1)]; //genera num aleatorio y strlen devuelve la longitud de la cadena en numero
                }

                //generar la password
                echo "<h2>Contraseña generada:</h2>";
                echo "<p>$password</p>";

            }

            ?>
        
    </div>

    
</body>
</html>