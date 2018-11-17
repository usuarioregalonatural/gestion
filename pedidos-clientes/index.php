<?php
	/*-------------------------
	Autor: Obed Alvarado
	Web: obedalvarado.pw
	Mail: info@obedalvarado.pw
	---------------------------*/
session_start();
$session_id= session_id();
//echo "Session: " . $session_id;
//echo "La otra forma: " . htmlspecialchars(SID);
require_once("./config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once("./config/conexion.php");//Contiene funcion que conecta a la base de datos
//$con=@mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$es_edicion="NO";
if (isset($_GET['id_pedido_ver']))//codigo elimina un elemento del array
{
    $es_edicion="SI";
    $id_pedido_ver=intval($_GET['id_pedido_ver']);
    $id_ver_cliente=$_GET['id_ver_cliente'];

 //   echo "Editar el pedido:" . $id_pedido_ver;

    $sql=mysqli_query($con, "SELECT 
                                        pedidos.id_pedido, pedidos.cod_pedido, clientes.id_cliente, clientes.nombre_cliente,
                                        pedidos.fecha_pedido, pedidos.fecha_prevista, pedidos.total_pedido, pedidos.comentarios
                                        FROM pedidos  LEFT JOIN clientes 
                                        ON pedidos.id_cliente=clientes.id_cliente where id_pedido='$id_pedido_ver'");
    while ($row=mysqli_fetch_array($sql)) {
        $id_pedido = $row["id_pedido"];
        $cod_pedido = $row["cod_pedido"];
        $fecha_pedido = $row["fecha_pedido"];
        $fecha_prevista = $row["fecha_prevista"];
        $id_cliente = $row["id_cliente"];
        $nombre_cliente = $row["nombre_cliente"];
        $total_pedido = $row["total_pedido"];
        $comentarios = $row["comentarios"];

  //      echo $nombre_cliente;
    }







}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Pedidos Clientes</title>
   <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" />
	<link rel=icon href='http://obedalvarado.pw/img/logo-icon.png' sizes="32x32" type="image/png">

  </head>
  <body>
  
    <div class="container">
		  <div class="row-fluid">
		  
			<div class="col-md-12">
			<h2><span class="glyphicon glyphicon-user"></span> Pedido Cliente
                <button type="submit" class="btn btn-success" onclick="window.open('../index.php','_self')">
                    <span class="glyphicon glyphicon-home"></span> Inicio
                </button>
            </h2>
                <hr>
			<form class="form-horizontal" role="form" id="datos_pedido">
				<div class="row">
                        <div class="col-md-3">
                            <label for="fechapedidocliente" class="control-label">Fecha Pedido</label>
                            <input type="date" class="form-control input-sm" id="fechapedidocliente" >
                       </div>
                    <?php
                    if ($es_edicion=="SI"){
                   //     echo "Es edicion";
                        ?>
                    <div class="col-md-3">
                        <label for="customer" class="control-label">Cliente</label>
                        <input type="text-area" class="form-control input-sm" name ="customer_edicion" id="customer_edicion" >

                    </div>
                    <?php
                    }else {
                       ?>
                    <div class="col-md-3">
                        <label for="customer" class="control-label">Selecciona el cliente</label>
                        <select class="customer form-control" name="customer" id="customer" >
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="cliente_nuevo" class="control-label"> o mete Cliente Nuevo</label>
                        <button type="button" class="btn btn-warning" onclick="agregar_cliente(1)">
                            <span class="glyphicon glyphicon-plus"></span> Nuevo Cliente
                        </button>
                    </div>

                <?php
                    }
                    ?>
                        <div class="col-md-3">
                            <label for="fechaentregacliente" class="control-label">Fecha Prevista Entrega</label>
                            <input type="date" class="form-control input-sm" id="fechapeprevistaentrega" >
                        </div>
                        <div class="col-md-5">
                            <label for="comentarios" class="control-label">Comentarios</label>
                            <input type="text-area" class="form-control input-sm" name ="comentarios" id="comentarios" >
                        </div>
		</div>


				<hr>
				<div class="col-md-12">
					<div class="pull-right">
						<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" id="Productos">
						    <span class="glyphicon glyphicon-plus"></span> Productos
						</button>
                        <button type="button" class="btn btn-primary" onclick="guardar_pedido('<?php echo $session_id ?>')">
                            <span class="glyphicon glyphicon-save"></span> Guardar
                         </button>
                 <!--       <button type="button" class="btn btn-warning" onclick="ver_detalle_pedido('<?php echo $id_pedido_ver ?>')">
                            <span class="glyphicon glyphicon-save"></span> Ver detalles
                        </button> -->
					</div>	
				</div>
			</form>
			<br><br>
		<div id="resultados" class='col-md-12'></div><!-- Carga los datos ajax -->
	
			<!-- Modal -->
			<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Buscar productos</h4>
				  </div>
				  <div class="modal-body">
					<form class="form-horizontal">
					  <div class="form-group">
						<div class="col-sm-6">
						  <input type="text" class="form-control" id="q" placeholder="Buscar productos" onkeyup="load(1)">
						</div>
						<button type="button" class="btn btn-default" onclick="load(1)"><span class='glyphicon glyphicon-search'></span> Buscar</button>
					  </div>
					</form>
					<div id="loader" style="position: absolute;	text-align: center;	top: 55px;	width: 100%;display:none;"></div><!-- Carga gif animado -->
					<div class="outer_div" ></div><!-- Datos ajax Final -->
				  </div>
				  <div class="modal-footer" >
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					
				  </div>
				</div>
			  </div>
			</div>
			
			</div>	
		 </div>
	</div>

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
	<script>
         $(document).ready(function() {
             var pEsEdicion='<?php echo $es_edicion?>'; // Compruebo si vengo para editar
             if (pEsEdicion=="SI") {
                 var pComentarios='<?php echo $comentarios?>';
                 var pId_Pedido='<?php echo $id_pedido?>';
                 var pFechaPedido='<?php echo $fecha_pedido?>';
                 var pFechaPrevista='<?php echo $fecha_prevista?>';
                 var pId_Cliente='<?php echo $id_cliente?>';
                 var pCod_Pedido='<?php echo $cod_pedido?>';
                 var pTotal_Pedido='<?php echo $total_pedido?>';
                 var pNombre_Cliente='<?php echo $nombre_cliente?>';

                 $("#comentarios").val(pComentarios);
                 $("#fechapedidocliente").val(pFechaPedido);
                 $("#customer").val(pNombre_Cliente);
                 $("#customer_edicion").val(pNombre_Cliente)
                 $("#fechapeprevistaentrega").val(pFechaPrevista);
     /*            $("#comentarios").val(pComentarios);
                 $("#comentarios").val(pComentarios);
                 $("#comentarios").val(pComentarios);
        */       ver_detalle_pedido(pId_Pedido);

             } else {
             //     alert('Borrando TMP!!!');
                   <?php     $sql_borra_tmp = "delete from tmp";
                        mysqli_query($con, $sql_borra_tmp);
                        ?>
               }
        });
    </script>

    <script>
		$(document).ready(function(){
          //  $("#comentarios").val('Pepillo');
        //   $( "#fechapedidocliente" ).datepicker({dateFormat:"dd/mm/yy"}).datepicker("setDate",new Date());
      //      $("#fechapedidocliente").val();
            load(1);
		});

		function load(page){
			var q= $("#q").val();
			var parametros={"action":"ajax","page":page,"q":q};
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'./ajax/productos_pedido.php',
				data: parametros,
				 beforeSend: function(objeto){
				 $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
					
				}
			})
		}
	</script>
	<script>
	function agregar (id)
		{
			var precio_venta=$('#precio_venta_'+id).val();
			var cantidad=$('#cantidad_'+id).val();
			//Inicia validacion
			if (isNaN(cantidad))
			{
			alert('Esto no es un numero');
			document.getElementById('cantidad_'+id).focus();
			return false;
			}
			if (isNaN(precio_venta))
			{
			alert('Esto no es un numero');
			document.getElementById('precio_venta_'+id).focus();
			return false;
			}
			//Fin validacion
		var parametros={"id":id,"precio_venta":precio_venta,"cantidad":cantidad};	
		$.ajax({
        type: "POST",
        url: "./ajax/agregar_pedido.php",
        data: parametros,
		 beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		}
			});
		}
		
			function eliminar (id)
		{
			
			$.ajax({
        type: "GET",
        url: "./ajax/agregar_pedido.php",
        data: "id="+id,
		 beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Guardando...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		}
			});

		}
    function ver_detalle_pedido(id) {
      //  alert("Antes del ajax");

        $.ajax({
            type: "GET",
            url: "./ajax/agregar_pedido.php",
            data: "id_ver_pedido=" + id,
            beforeSend: function (objeto) {
                $("#resultados").html("Mostrando Artículos...");
            },
            success: function (datos) {
                $("#resultados").html(datos);
            }
        });
      //  alert("despues del ajax");
    }

    function guardar_pedido (id)
    {
    //    var precio_venta=$('#precio_venta_'+id).val();
    //    var cantidad=$('#cantidad_'+id).val();
       //var sesion=$session_id;
        var id_cliente = $("#customer").val();
        var fecha_pedido=$("#fechapedidocliente").val();
        var fecha_prevista=$("#fechapeprevistaentrega").val();
        var comentarios=$("#comentarios").val();
        var pId_Pedido='<?php echo $id_pedido?>';
        var pId_Ver_Cliente='<?php echo $id_ver_cliente?>';
        var parametros={"id_cliente":id_cliente,"fecha_pedido":fecha_pedido,"fecha_prevista":fecha_prevista,"sesion":id,"comentarios":comentarios, "esEdicion":0};
        var pEsEdicion='<?php echo $es_edicion?>'; // Compruebo si vengo para editar
        if (pEsEdicion=="SI") {
            var parametros={"id_cliente":pId_Ver_Cliente,"fecha_pedido":fecha_pedido,"fecha_prevista":fecha_prevista,"sesion":id,"comentarios":comentarios, "esEdicion":1, "id_ver_pedido":pId_Pedido};
        }
            $.ajax({
              type: "POST",
              url: "./ajax/GuardaPedCli.php",
              data: parametros,
              beforeSend: function (objeto) {
                  $("#resultados").html("Mensaje: Guardando...");
              },
              success: function (datos) {
                  $("#resultados").html(datos);
              }
          });


    }
    function agregar_cliente (id)
    {
      //  var parametros={"id":id,"precio_venta":precio_venta,"cantidad":cantidad};
        var parametros={"id":id};
   //     alert("Dentro de agregar cliente");
        $.ajax({
            type: "POST",
            url: "./ajax/agregar_cliente.php",
            data: parametros,
            beforeSend: function(objeto){
                $("#resultados").html("Mensaje: Cargando...");
            },
            success:
                function(datos){$("#resultados").html(datos);}
              //  alert("Vuelta");
        });
    }




        //$("#comentarios").text("Prueba");
//	alert("Por el limbo");
    /***** Guarda los datos en la tabla *****/
         $("#datos_pedido").submit(function(){
            var customer = $("#customer").val();
            var transporte = $("#transporte").val();
            var condiciones = $("#condiciones").val();
       //     var comentarios = $("#comentarios").val();
        if (customer>0){
           // alert("El id: "+id);
           // alert("Guardando");
            alert("Guardando normal");
      //      guardar(id);
 //           var parametros={"id":id,"precio_venta":precio_venta,"cantidad":cantidad};
 //           $id=$_GET['id'];




        //    return false;
        } else
        {
          //  alert("El id: "+id);
          //  alert("Guardando en else");

            //  alert("No ha podido grabarse el pedido!!!");
       //  return false;
        }



        });


	/*	$("#datos_pedido").submit(function(){
		  var customer = $("#customer").val();
		  var transporte = $("#transporte").val();
		  var condiciones = $("#condiciones").val();
		  var comentarios = $("#comentarios").val();
		  if (customer>0)
		 {
			VentanaCentrada('./pdf/documentos/pedido_pdf.php?customer='+customer+'&transporte='+transporte+'&condiciones='+condiciones+'&comentarios='+comentarios,'Pedido','','1024','768','true');	
		 } else {
			 alert("Selecciona el cliente");
			 return false;
		 }
		 
	 	});*/
	</script>
	
	
<script type="text/javascript">
$(document).ready(function() {
    $( ".customer" ).select2({        
    ajax: {
        url: "ajax/load_clientes.php",
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
                q: params.term // search term
            };
        },
        processResults: function (data) {
            return {
                results: data
            };
        },
        cache: true
    },
    minimumInputLength: 2
});
});
</script>




  </body>
</html>
