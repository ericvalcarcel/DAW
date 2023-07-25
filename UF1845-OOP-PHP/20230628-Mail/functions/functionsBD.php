<?php
    function conectar($host=null,$userName=null,$pass=null,$database=null)    
    {
        if(func_num_args()<3)
        {
            //conexion por defecto 

            //to_do
            exit("parametros incorrectos (conexion por defecto)");
            
        
        }
        else
        {
           $conection=mysqli_connect($host,$userName,$pass,$database);
           // ysqli_get_host_info( $conection)
           // mysqli_get_server_info( $conection)
            if($conection===false)
            {
                //error conexion
                echo "error en la conexion";
                exit("no se a podido conectar con la base de datos");
            }
            else
            {
                //mostrar mensaje con unformacion del server y el host
                
            }
           
        }
        return $conection;
    }
    function desconectar($conection)
    {
        if($conection){
            $ok=mysqli_close($conection);
            if($ok){
                echo "desconexion de la bd con exito 👍";
            }else
            {
                echo "error al desconectar";
            }
        
        }
      
    }
?>
