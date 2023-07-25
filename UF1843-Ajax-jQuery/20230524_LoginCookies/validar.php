<?php

//Recoger parámetros enviados por POST
$nif = $_POST["n"];
$pass = $_POST["p"];

//Validar credenciales contra BD
//TO_DO consulta a BD
sleep(3);
if ($nif=="12345" && $pass=="abc")
{
    //Credenciales válidas
    echo "Pedro Picapiedra";
}
else
{
    //Credenciales inválidas
    echo "ko";
}

?>