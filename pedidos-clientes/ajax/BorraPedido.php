<?php
require_once("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
$con=@mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

$id_pedido=$_POST["id_pedido"];
// Borra lo temporal
$sql_borra_ped="delete from pedidos where id_pedido=". $id_pedido .";";
mysqli_query($con,$sql_borra_ped );

$sql_borra_detped="delete from detalle_pedido where id_pedido=". $id_pedido .";";
mysqli_query($con,$sql_borra_detped );


?>

