<?php

// Recogo datos del post
$sesion=$_POST['sesion'];
$id_cliente=$_POST['id_cliente'];
$fecha_pedido=$_POST['fecha_pedido'];
$fecha_prevista=$_POST['fecha_prevista'];
$comentarios=$_POST['comentarios'];
$esEdicion=$_POST['esEdicion'];
$id_ver_pedido=$_POST['id_ver_pedido'];
//echo "El cliente para guardar es: " .$id_cliente;

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

// Calcular el ID del Pedido que toca
    $id_pedido_query   = mysqli_query($con, "SELECT COALESCE(MAX(id_pedido),0)+1 as id_pedido FROM pedidos");
    $row= mysqli_fetch_array($id_pedido_query);
    $tmp_id_pedido = $row['id_pedido'];
    $id_pedido=$tmp_id_pedido;
    if (isset($_POST['id_ver_pedido']))
    {
        $id_pedido=$id_ver_pedido;
    }
    $cod_pedido="PEDCLI-" . str_pad($id_pedido,6,'0',STR_PAD_LEFT);

/*echo "CLIENTE: ".$id_cliente . PHP_EOL;
echo "-FECHA PEDIDO: " . $fecha_pedido . PHP_EOL;
echo "-FECHA PREVISTA: " . $fecha_prevista . PHP_EOL;
echo "-TOTAL PEDIDO: " . $total_pedido . PHP_EOL;
echo "-SESSION: " . $sesion . PHP_EOL;
echo "-ID_PEDIDO: " . $id_pedido . PHP_EOL;
echo "-COD_PEDIDO: " . $cod_pedido . PHP_EOL;
echo "-COMENTARIOS: " . $comentarios . PHP_EOL;
echo "-ESEDICION: " . $esEdicion . PHP_EOL;
*/
// Guarda el pedido en la bbdd
try {
    if (isset($_POST['id_ver_pedido']))
    {
            $sql_borra_pedido="delete from pedidos where id_pedido='" . $id_ver_pedido . "'";
            $sql_borra_detalle_pedido="delete from detalle_pedido where id_pedido='" . $id_ver_pedido . "'";
            mysqli_query($con,$sql_borra_pedido );
            mysqli_query($con,$sql_borra_detalle_pedido );

    //        $insert_pedido = mysqli_query($con, "INSERT INTO pedidos (id_pedido,cod_pedido,id_cliente,fecha_pedido,fecha_prevista,total_pedido,comentarios) VALUES ('$id_ver_pedido','$cod_pedido','$id_cliente','$fecha_pedido','$fecha_prevista','$total_pedido','$comentarios')");
    }

    $insert_pedido = mysqli_query($con, "INSERT INTO pedidos (id_pedido,cod_pedido,id_cliente,fecha_pedido,fecha_prevista,total_pedido,comentarios) 
                                                VALUES ('$id_pedido','$cod_pedido','$id_cliente','$fecha_pedido','$fecha_prevista','$total_pedido','$comentarios')");
}catch (Exception $e){
    echo "No se ha podido guardar el pedido";
    return false;
}

$sql_insertar_detalle_pedido="insert into detalle_pedido (id_detalle, id_producto, id_pedido, cantidad, importe)".
        "select id_tmp as id_detalle, id_producto as id_producto,'". $id_pedido . "' as id_pedido, sum(cantidad_tmp) as cantidad, ".
        "sum(precio_tmp) as importe from tmp WHERE session_id='".$sesion."' group by id_detalle, id_producto, id_pedido";

// Guarda el detalle del pedido en la bbdd
$insert_detalle_pedido = mysqli_query($con,$sql_insertar_detalle_pedido );

// Borra lo temporal
$sql_borra_tmp="delete from tmp";
mysqli_query($con,$sql_borra_tmp );
unset($sesion);
//echo " ----" . $sql_insertar_detalle_pedido;

//$total_pedido_query   = mysqli_query($con, "SELECT sum(precio_tmp) as total from tmp");
//$row= mysqli_fetch_array($total_pedido_query);
//$total_pedido = $row['total'];




//echo $total_pedido;

//var SQL_Insert =" insert into "
//$sql_count=mysqli_query($con,"select * from tmp where session_id='".$session_id."'");



?>


