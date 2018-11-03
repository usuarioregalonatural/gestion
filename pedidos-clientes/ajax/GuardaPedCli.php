<?php
/**
 * Created by PhpStorm.
 * User: Victor
 * Date: 02/11/2018
 * Time: 21:44
 */
/*try {
    require_once("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
} catch (Exception $ex){
    echo 'Error: ' . $ex->getMessage().PHP_EOL;
}

require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
*/
/*try{
    $con=@mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
} catch(Exception $e)
    {$e->getMessage();}
   */


/*if (isset($_POST['id'])){$id=$_POST['id'];}
if (isset($_POST['cantidad'])){$cantidad=$_POST['cantidad'];}
if (isset($_POST['precio_venta'])){$precio_venta=$_POST['precio_venta'];}
*/

// Recogo datos del post
$id_cliente=$_POST['id_cliente'];
$fecha_pedido=$_POST['fecha_pedido'];
$fecha_prevista=$_POST['fecha_prevista'];

echo $fecha_prevista;

// Calcular el ID del Pedido
// $id_pedido=

//Calcula el total del pedido

//$total_pedido_query   = mysqli_query($con, "SELECT sum(precio_tmp) as total from tmp");
//$row= mysqli_fetch_array($total_pedido_query);
//$total_pedido = $row['total'];




//echo $total_pedido;

//var SQL_Insert =" insert into "
//$sql_count=mysqli_query($con,"select * from tmp where session_id='".$session_id."'");



?>


