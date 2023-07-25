<?php
    //Funciones de BD
    require("functions/functionsBD.php");

    //Head de la página
    require('controls/head.php');

    //Header
    require('controls/header.php'); 

    //Nav
    require('controls/nav.php'); 
?>

<main>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Pedidos</h1>

                <p><a href='javascript:gestionarEmpleado(0);'>Crear empleado</a></p>

                <table class='table' id='tblPedidos'>
                    <!-- Encabezados -->
                    <thead>
                        <tr>
                            <th>#id</th>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Empleado</th>
                            <th>Importe</th>
                            <th>Cargo</th>
                            <th>Entrega</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                <?php
                    //Crear SQL
                    $sql = "SELECT p.IdPedido, p.FechaPedido, c.NombreEmpresa,
                        CONCAT(e.Nombre,' ',e.Apellidos) as NombreEmpleado, e.IdEmpleado,
                        ROUND(SUM(dp.Cantidad*dp.PrecioUnidad*(1-dp.Descuento)),2) as Importe,
                        p.Cargo, p.FechaEnvio
                    FROM cliente c INNER JOIN pedido p 
                            ON c.IdCliente = p.IdCliente
                        INNER JOIN empleado e 
                            ON p.IdEmpleado = e.IdEmpleado
                        INNER JOIN detalles_de_pedido dp 
                            ON p.IdPedido = dp.IdPedido
                    GROUP BY p.IdPedido
                    ORDER BY p.FechaPedido DESC, p.IdPedido DESC";

                    //Crear la conexión
                    $conexion = conectar("localhost","root","","neptuno");
            
                    //Lanzar SQL y recuperar datos
                    $resultSet = mysqli_query($conexion,$sql);

                    //Template de cada fila
                    $fila ="<tr>
                            <td>[IdPedido]</td>
                            <td nowrap>[FechaPedido]</td>
                            <td>[Cliente]</td>
                            <td>[Empleado]</td>
                            <td>[Importe]</td>
                            <td class='tdCostes' id='tdCostes_[IdPedido]' style='cursor:pointer;'>[Costes]</td>
                            <td nowrap id='tdEntrega_[IdPedido]'>[Entregado]</td>
                            <td class='text-center'>[Acciones]</td>
                        </tr>";

                    //Recorrer el resultSet
                    while (true)
                    {
                        $linea = mysqli_fetch_object($resultSet);
                        if ($linea==null) break;

                        $html = $fila;
                        $html = str_replace("[IdPedido]",$linea->IdPedido,$html);
                        $html = str_replace("[FechaPedido]",$linea->FechaPedido,$html);
                        $html = str_replace("[Cliente]",$linea->NombreEmpresa,$html);
                        
                        //Empleado
                        $empleado = "<a href='javascript:gestionarEmpleado(".$linea->IdEmpleado.");'>" . $linea->NombreEmpleado . "</a>";
                        $html = str_replace("[Empleado]",$empleado,$html);

                        $html = str_replace("[Importe]",$linea->Importe,$html);
                        $html = str_replace("[Costes]",$linea->Cargo,$html);

                        //Entregado
                        $entregado = ($linea->FechaEnvio=="") 
                            ? "<a href='javascript:actualizarEntrega(".$linea->IdPedido.");'>Sin entregar</a>" 
                            : $linea->FechaEnvio;
                        $html = str_replace("[Entregado]",$entregado,$html);

                        //Acciones
                        $acciones="<a href='javascript:mostrarDetalles(".$linea->IdPedido.");'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-search' viewBox='0 0 16 16'>
                            <path d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/>
                        </svg></a>";
                        $html = str_replace("[Acciones]",$acciones,$html);

                        echo $html;
                    }

                    //Cerrar la conexión
                    desconectar($conexion);
                ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Detalles del pedido</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table" id="tblDetallesPedidos">
            <thead>
                <tr>
                    <th>Cantidad</th>
	                <th>Producto</th>
	                <th>Precio</th>
                	<th>Descuento</th>
	                <th>Importe</th>
                </tr>
            </thead>
            <tbody id="bdyDetallesPedidos">

            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalEmpleados" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEmpleadosLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEmpleadosLabel">Ficha de Empleado</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <div class="container">
            <form>
                <div class="mb-3 row">
                    <label for="txtNombre" class="col-sm-3 col-form-label">Nombre:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="txtNombre" name="txtNombre">
                    </div>
                </div>
            </form>
         </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btnGuardarEmpleado">Guardar</button>      
      </div>
    </div>
  </div>
</div>



<?php
    //Nav
    include('controls/aside.php'); 

    //Footer
    require('controls/footer.php'); 

    //Links
    require('controls/links.php'); 
?>
