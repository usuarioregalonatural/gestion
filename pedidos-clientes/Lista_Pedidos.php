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

        <div class="col-md-12" id="Tabla">
            <h2><span class="glyphicon glyphicon-list-alt"></span> Listado Pedidos Clientes
            <button type="submit" class="btn btn-success" onclick="window.open('../index.php','_self')">
                <span class="glyphicon glyphicon-home"></span> Inicio
            </button>
            </h2>
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
        <td id="<?php echo $id_pedido?>">
            <span class="pull-right"><a href="./index.php?id_pedido_ver=<?php echo $id_pedido?>&id_ver_cliente=<?php echo $id_cliente?>" ><i class="glyphicon glyphicon-zoom-in"></i></a></span>
        </td>
        <td><?php echo $cod_pedido ?></td>
        <td ><?php echo $fecha_pedido ?></td>
        <td ><?php echo $fecha_prevista ?></td>
        <td ><?php echo $nombre_cliente ?></td>
        <td class="listado-pedidos-numeros"><?php echo $total_pedido . " €" ?></td>
        <td "><?php echo $comentarios ?></td>

        <td><button type="submit" class="btn btn-danger" onclick="elimina_pedido(<?php echo $id_pedido?>)">
                <span class="glyphicon glyphicon-trash"></span>
            </button>
        </td>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/VentanaCentrada.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>

<script>
function ver_pedido (id_pedido_ver)
{
//    var precio_venta=$('#precio_venta_'+id).val();
//    var cantidad=$('#cantidad_'+id).val();
//var sesion=$session_id;
var id_cliente = $("#customer").val();
var fecha_pedido=$("#fechapedidocliente").val();
var fecha_prevista=$("#fechapeprevistaentrega").val();
var comentarios=$("#comentarios").val();
var pId_Cliente='<?php echo $id_cliente?>';
var parametros={"id_pedido_ver":id_pedido_ver, "id_ver_cliente":pId_Cliente};
//alert("Dentro de la funcion de ver pedido");
$.ajax({
type: "GET",
url: "index.php",
data: parametros,
beforeSend: function (objeto) {
$("#resultados").html("Buscando pedido...");
},
success: function (datos) {
    $("#Tabla").load(" #Tabla");
    $("#resultados").html(datos);
}
});


}

function elimina_pedido (id_pedido_ver) {
//    var precio_venta=$('#precio_venta_'+id).val();
//    var cantidad=$('#cantidad_'+id).val();
//var sesion=$session_id;
    var id_cliente = $("#customer").val();
    var fecha_pedido = $("#fechapedidocliente").val();
    var fecha_prevista = $("#fechapeprevistaentrega").val();
    var comentarios = $("#comentarios").val();
    var pId_Cliente = '<?php echo $id_cliente?>';
    var parametros = {"id_pedido_ver": id_pedido_ver};
 //   alert("Dentro de la funcion de eliminar pedido" + id_pedido_ver);
    DeletePedDB(id_pedido_ver);
    $.ajax({
        type: "POST",
        url: "./Lista_Pedidos.php",
        data: parametros,
        beforeSend: function (objeto) {
            $("#resultados").html("Eliminando pedido...");
        },
        success: function (datos) {
            $("#Tabla").load(" #Tabla");
            $("#resultados").html(datos);
        }
    });
}
function DeletePedDB(id_pedido) {
  //  alert("En la funcion principal");
    var parametros = {"id_pedido": id_pedido};
    $.ajax({
        type: "POST",
        url: "./ajax/BorraPedido.php",
        data: parametros,
        beforeSend: function (objeto) {
            $("#resultados").html("Eliminando pedido...");
        },
        success: function (datos) {
   //         alert("Ha ido bien");
        },
        error: function (xhr,status) {
    //        alert("Se ha producido un error");
        }
    })
}

</script>