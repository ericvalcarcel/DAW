<?php
    //Arrays añadiendo elementos uno a uno
    $numeros[] = 'cero'; // => índice 0
    $numeros[] = 'uno'; // => índice max (0) + 1 = 1
    $numeros[] = 'dos'; // => índice max (1) + 1 = 2
    $numeros[] = 'tres'; // => índice max (2) + 1 = 3
    $numeros[5] = 'cinco'; // => índice 5
    $numeros[] = 'seis'; // => índice max (5) + 1 = 6
    $numeros['uno'] = 1; // índice "un"
    $numeros[] = 'siete'; // => índice max (6) + 1 = 7
    $numeros[-1] = 'menos uno'; // => -1

    //Arrays añadiendo coleciones de datos
    $ciudades1 = ["Barcelona", "Tarragona","Lleida","Girona"];
    $ciudades2 = ["Valencia", "Castellón","Alicante"];
    
    $paises = ["Catalunya" => $ciudades1, "Valencia" => $ciudades2];

    $bidimensional = [["hola","adios","saludo"], ["pepe","marta","juan"] ];

    //Arrays con constructor
    $otrosNumeros = array('cero','uno','dos','tres', 5 => 'cinco','seis','uno' => "Pepito",'siete',-1 => 'menos uno');

?>
<!doctype html>
<html lang="es">
    <head>
        <title></title>
        <meta description="" />
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">        
        
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    
        <link rel="stylesheet" href="styles/styles.css" />
        
    </head>
    <body>
        <header>
            
        </header>
        <nav>

        </nav>
        <main>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <?php
                            echo $numeros[5] . "<br/>";
                            echo $numeros["uno"] . "<br/>";
                            echo $ciudades1[1] . "<br/>";
                            echo $paises["Catalunya"][1] . "<br/>";
                            echo $bidimensional[0][1] . "<br/>";
                        ?>
                    </div>
                    <div class="col"></div>
                    <div class="col"></div>
                </div>
            </div>
        </main>
        <aside>

        </aside>
        <footer>

        </footer>

        <!-- Si utilizamos componentes de Bootstrap que requieran Javascript agregar el siguiente archivo -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

		<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

        <script src="scripts/scripts.js"></script>
    </body>
</html>