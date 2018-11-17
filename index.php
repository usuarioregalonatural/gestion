<?php
ini_set('display_errors', 'On');
ini_set('error_reporting', E_ALL);
?>

<html>

  <head>
    <title>index.html</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="stylesheet" href="menu_files/mbcsmbmcp.css" type="text/css" />
      <link href="../css/estilos.css" type="text/css" rel="stylesheet">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
      <link href="../css/estilos.css" type="text/css" rel="stylesheet">


  </head>

<body>
<?php
require_once("./pedidos-clientes/config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once("./pedidos-clientes/config/conexion.php");//Contiene funcion que conecta a la base de datos


?>
    <div class="container">
        <div class="row-fluid">

            <div class="col-md-26">
                <h2><img src="imagenes/Logo-20180921-255x47.jpg"> Gestion</h2>
                <hr>
                <div class="col-md-12">
                      <div class="pull-left">
                        <button type="submit" class="btn btn-primary" onclick="window.open('./pedidos-clientes/index.php', '_self')">
                            <span class="glyphicon glyphicon glyphicon-pencil"></span> Crear Pedido Cliente
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <span class="glyphicon glyphicon glyphicon-pencil"></span> Crear Pedido Proveedor
                        </button>
                      </div>

                    <div class="pull-left">
                      <button type="submit" class="btn btn-success" onclick="window.open('./pedidos-clientes/Lista_Pedidos.php', '_self')">
                            <span class="glyphicon  glyphicon-list-alt"></span> Ver Pedidos Cliente
                      </button>
                      <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-list-alt"></span> Ver Pedidos Proveedor
                      </button>
                    </div>
                        <?php




    ?>

            </div>
                <div id="resultados" class='col-md-12'></div><!-- Carga los datos ajax -->
            </div>
    </div>




        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <script type="text/javascript" src="js/VentanaCentrada.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>



    <script>
        function ver_pedidos_cliente ()
        {
        //    var precio_venta=$('#precio_venta_'+id).val();
        //    var cantidad=$('#cantidad_'+id).val();
        //var sesion=$session_id;
            $.ajax({
            type: "POST",
            url: "./pedidos-clientes/Lista_Pedidos.php",
            beforeSend: function (objeto) {
            $("#resultados").html("Cargando pedidos...");
            },
            success: function (datos) {
            $("#resultados").html(datos);
            }
            });
        }
        function pedidos_cliente ()
        {
            //    var precio_venta=$('#precio_venta_'+id).val();
            //    var cantidad=$('#cantidad_'+id).val();
            //var sesion=$session_id;
            $.ajax({
                type: "POST",
                url: "./pedidos-clientes/index.php",
                beforeSend: function (objeto) {
                    $("#resultados").html("Mensaje: Guardando...");
                },
                success: function (datos) {
                    $("#resultados").html(datos);
                }
            });
        }

</script>

  </body>
</html>
