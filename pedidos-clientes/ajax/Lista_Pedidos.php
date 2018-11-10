<?php
/**
 * Created by PhpStorm.
 * User: Victor
 * Date: 10/11/2018
 * Time: 18:11
 */
require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

?>
<table class="table">
    <tr>
        <th>CODIGO PEDIDO</th>
        <th>FECHA PEDIDO</th>
        <th>FECHA PREVISTA ENTREGA</th>
        <th>CLIENTE</th>
        <th><span class="pull-right">TOTAL PEDIDO</span></th>
        <th>COMENTARIOS</th>
        <th></th>
    </tr>
<?php

    $sql=mysqli_query($con, "select * from ps_productos, tmp where ps_productos.id_producto=tmp.id_producto and tmp.session_id='".$session_id."'");
    while ($row=mysqli_fetch_array($sql)) {
        $id_tmp = $row["id_tmp"];

    }
 ?>

    <tr>
       <td></td>

    </tr>
