<?php
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
/* Busca un numero de cliente */
    $sql_id_cliente="select max(id_cliente) as maxid from clientes where id_cliente>10000";
    $tmp_id_cliente=mysqli_query($con,$sql_id_cliente );
    $rw_id_cliente=mysqli_fetch_array($tmp_id_cliente);
    $id_cliente=$rw_id_cliente['maxid']+1;
?>
<div class="col-md-12">
    <h2><span class="glyphicon glyphicon-user"></span> Nuevo Cliente
    </h2>
<table>
<!--<tr>

    <th></th>
	<th>CODIGO CLIENTE</th>
	<th>NOMBRE CLIENTE</th>
	<th>COMENTARIOS</th>
	<th></th>
</tr>-->

    <tr>
        <div class="col-md-2">
            <label for="id_cliente" class="control-label">Id_Cliente</label>
            <input type="text" class="form-control input-sm" name ="id_cliente" id="id_cliente"  >
        </div>
        <div class="col-md-5">
            <label for="nombrecliente" class="control-label">Nombre Cliente</label>
            <input type="text-area" class="form-control input-sm" name ="nombrecliente" id="nombrecliente" >
        </div>

        <button type="button" class="btn btn-primary" onclick="guardar_cliente(1000)">
            <span class="glyphicon glyphicon-floppy-disk"></span> Guardar
        </button>

    </tr>

</table>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/VentanaCentrada.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>

<script>
    $("#id_cliente").val(<?php echo $id_cliente?>);
    $("#nombrecliente").focus();

</script>

    <script>
        function guardar_cliente (id)
        {
   //         alert ("Dentro de guardar cliente");
            var id_cliente = $("#id_cliente").val();
            var nombre_cliente = $("#nombrecliente").val();
            var parametros={"id_cliente":id_cliente,"nombre_cliente":nombre_cliente};
            $.ajax({
                type: "POST",
                url: "./ajax/GuardaCli.php",
                data: parametros,
                beforeSend: function (objeto) {
                    $("#resultados").html("Mensaje: Guardando...");
                },
                success:
                   function (datos) {$("#resultados").html(datos);

                }
            });

        }

    </script>