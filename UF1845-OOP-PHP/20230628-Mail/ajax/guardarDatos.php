<?php
if(file_exists('../data/datos.txt')){unlink('../data/datos.txt');}

$datos = $_POST; // Obtener los datos enviados desde AJAX

// Convertir el arreglo de datos en una cadena JSON
$jsonData = json_encode($datos);

$archivo = fopen('../data/datos.txt', 'ab'); // Abrir el archivo en modo escritura

    fwrite($archivo, $jsonData); // Escribir los datos en el archivo
    fclose($archivo); // Cerrar el archivo
    echo "Archivo creado y datos guardados correctamente.";

?>