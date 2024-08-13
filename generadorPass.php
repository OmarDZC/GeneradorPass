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