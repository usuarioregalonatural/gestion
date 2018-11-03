<?php

// Recogo datos del post
$sesion=$_POST['sesion'];
$id_cliente=$_POST['id_cliente'];
$fecha_pedido=$_POST['fecha_pedido'];
$fecha_prevista=$_POST['fecha_prevista'];


try {
    require_once("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
    require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
    $con=@mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    //Calcula el total del pedido
    $total_pedido_query   = mysqli_query($con, "SELECT sum(precio_tmp) as total from tmp where session_id='".$sesion."'");
    $row= mysqli_fetch_array($total_pedido_query);
    $total_pedido = $row['total'];

} catch (Exception $ex){
    echo 'Error: ' . $ex->getMessage().PHP_EOL;
}


/*try{
    $con=@mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
} catch(Exception $e)
    {$e->getMessage();}
   */


/*if (isset($_POST['id'])){$id=$_POST['id'];}
if (isset($_POST['cantidad'])){$cantidad=$_POST['cantidad'];}
if (isset($_POST['precio_venta'])){$precio_venta=$_POST['precio_venta'];}
*/

echo "CLIENTE: ".$id_cliente . PHP_EOL;
echo "-FECHA PEDIDO: " . $fecha_pedido . PHP_EOL;
echo "-FECHA PREVISTA: " . $fecha_prevista . PHP_EOL;
echo "-TOTAL PEDIDO: " . $total_pedido . PHP_EOL;
echo "-SESSION: " . $sesion . PHP_EOL;
// Calcular el ID del Pedido
// $id_pedido=




//$total_pedido_query   = mysqli_query($con, "SELECT sum(precio_tmp) as total from tmp");
//$row= mysqli_fetch_array($total_pedido_query);
//$total_pedido = $row['total'];




//echo $total_pedido;

//var SQL_Insert =" insert into "
//$sql_count=mysqli_query($con,"select * from tmp where session_id='".$session_id."'");



?>


