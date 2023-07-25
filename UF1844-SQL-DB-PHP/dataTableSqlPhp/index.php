<?php 
    
    require('functions/functionsBD.php');// biblioteca funciones para accedes BDs

    require('controls/head.php');

    require('controls/header.php');

?>
    
<main> 
    <div class="container">
        <div class="row">
             
            <div class="col-12">
            <select class="form-select" id="selecionar" >
                <option>Productos</option>
                <option>Clientes</option>
                <option>empleados</option>
            </select>
            <?php
 
                    //Crear la conexión al MySQL de localhost
                    $conexion = conectar('localhost','root','','neptuno');
 
                    //Conectar a la BD que queramos
                   
                    if(!$conexion)
                    {
                        echo "No se ha podido conectar a esta base de datos<br/>";
                        exit("Base de datos inexistente");
                    }
 
                    //Preparar la SQL
                    $sql = "SELECT ROW_Number()over() as num,NombreProducto, PrecioUnidad,
                                    UnidadesEnExistencia, Suspendido
                            FROM producto 
                            
                            ORDER BY num desc";
                    
                    //Lanzar la consulta
                    $resultSet = mysqli_query($conexion, $sql);
 
                    //Fetch de las filas del resultSet
                    $counter=0;
                    while (true)
                    {
                        $linea = mysqli_fetch_object($resultSet);
 
                        if ($linea == null) { break; };
 
                        $counter++;
 
                        //Cabecera de la tabla
                        if ($counter==1)
                        {
                            //Cabecera del atabla
                            echo "<table class='table' id='tbDatos'>
                            <thead><tr><th>Nº</th>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>estado</th>
                            </tr></thead>";
                        }
 
                        //Las diferentes filas de la tabla
                        echo "<tbody><tr><td>".$linea->num . "</td>".                      
                            "<td>" . $linea->NombreProducto . "</td>" .
                            "<td>" . $linea->PrecioUnidad . "</td>" .
                            "<td>" . $linea->UnidadesEnExistencia . "</td>" .
                            "<td>" . (($linea->Suspendido == 0) ? "Activo" : "Descatalogado") . "</td></tr></tbody>";
 
                        //Footer de la tabla
                        if ($counter == mysqli_num_rows($resultSet))
                        {
                            echo "</table>";
                        }
                    }
                    
                    //Número de registros de la consulta
                    echo "Registros: " . mysqli_num_rows($resultSet) . "<br/>";
 
                    //Cerrar la conexión
                    desconectar($conexion);
                  
                    
 
                ?>
            </div>              
        </div>
    </div>
</main>

<?php 
    include('controls/aside.php');

    include('controls/footer.php');

    include('controls/links.php');
?>