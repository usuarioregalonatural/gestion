<?php
/**
 * Created by PhpStorm.
 * User: Victor
 * Date: 17/11/2018
 * Time: 12:23
 */

require_once("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

$id_cliente=$_POST['id_cliente'];
$nombre_cliente=$_POST['nombre_cliente'];

try {
    $sql_insertar_cliente_potencial = "insert into clientes_potenciales (id, nombre) " .
        "values ('$id_cliente','$nombre_cliente' )";

 // Guarda el detalle del pedido en la bbdd
    $insert_cliente_potencial = mysqli_query($con, $sql_insertar_cliente_potencial);
}catch (Exception $e){
    echo "No se ha podido guardar el cliente";
    return false;
}

?>