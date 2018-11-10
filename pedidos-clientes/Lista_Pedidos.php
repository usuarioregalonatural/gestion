<?php
/**
 * Created by PhpStorm.
 * User: Victor
 * Date: 10/11/2018
 * Time: 18:11
 */
echo '<link href="../css/estilos.css" type="text/css" rel="stylesheet">';
echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">';

require_once("./config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once("./config/conexion.php");//Contiene funcion que conecta a la base de datos

?>
<div class="container">
    <div class="row-fluid">

        <div class="col-md-12">
            <h2><span class="glyphicon glyphicon-list-alt"></span> Listado Pedidos Clientes</h2>

                <table class="table2">
                    <tr>
                        <th></th>
                        <th>COD. PEDIDO</th>
                        <th>FECHA PEDIDO</th>
                        <th>FECHA ENTREGA</th>
                        <th>CLIENTE</th>
                        <th><span class="pull-right">TOTAL PEDIDO</span></th>
                        <th>COMENTARIOS</th>
                        <th></th>
                    </tr>
                    <hr>
                    <div class="col-md-12">
                        <div class="pull-right">
                              <button type="submit" class="btn btn-success">
                                <span class="glyphicon glyphicon-home"></span> Inicio
                            </button>

                            <?php

    $sql=mysqli_query($con, "SELECT 
                                    pedidos.id_pedido, pedidos.cod_pedido, clientes.id_cliente, clientes.nombre_cliente,
                                    pedidos.fecha_pedido, pedidos.fecha_prevista, pedidos.total_pedido, pedidos.comentarios
                                    FROM pedidos  LEFT JOIN clientes 
                                    ON pedidos.id_cliente=clientes.id_cliente order by pedidos.fecha_prevista");
    while ($row=mysqli_fetch_array($sql)) {
        $id_pedido = $row["id_pedido"];
        $cod_pedido = $row["cod_pedido"];
        $fecha_pedido = $row["fecha_pedido"];
        $fecha_prevista= $row["fecha_prevista"];
        $id_cliente = $row["id_cliente"];
        $nombre_cliente = $row["nombre_cliente"];
        $total_pedido = $row["total_pedido"];
        $comentarios = $row["comentarios"];


        ?>
        <tr>
        <td >
            <span class="pull-right"><a href="#" onclick=""><i class="glyphicon glyphicon-zoom-in"></i></a></span>
        </td>
        <td ><?php echo $cod_pedido ?></td>
        <td ><?php echo $fecha_pedido ?></td>
        <td ><?php echo $fecha_prevista ?></td>
        <td ><?php echo $nombre_cliente ?></td>
        <td class="listado-pedidos-numeros"><?php echo $total_pedido . " €" ?></td>
        <td "><?php echo $comentarios ?></td>

    </tr>



        <?php


    }
 ?>

    <tr>
       <td></td>

    </tr>
</table>
        </div>

    </div></div>