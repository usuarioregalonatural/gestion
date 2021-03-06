<?php
	/*-------------------------
	Autor: Obed Alvarado
	Web: obedalvarado.pw
	Mail: info@obedalvarado.pw
	---------------------------*/
session_start();
$session_id= session_id();
if (isset($_POST['id'])){$id=$_POST['id'];}
if (isset($_POST['cantidad'])){$cantidad=$_POST['cantidad'];}
if (isset($_POST['precio_venta'])){$precio_venta=$_POST['precio_venta'];}

	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

/**** borra previamente  lo que haya en tmp ****/
//echo "GET: " . $_GET['id_ver_pedido'];
//echo "POST: " . $_POST['id_ver_pedido'];


/***********************************************/
if (!empty($id) and !empty($cantidad) and !empty($precio_venta))
{
        $insert_tmp=mysqli_query($con, "INSERT INTO tmp (id_producto,cantidad_tmp,precio_tmp,session_id) VALUES ('$id','$cantidad','$precio_venta','$session_id')");
}
if (isset($_GET['id']))//codigo elimina un elemento del array
{
	$id=intval($_GET['id']);
$delete=mysqli_query($con, "DELETE FROM tmp WHERE id_tmp='".$id."'");
}

///////////////////////////////////////////////////
// Si estamos en edicion de pedido .....
if (isset($_GET['id_ver_pedido']))//codigo elimina un elemento del array
{
    $id_ver_pedido=intval($_GET['id_ver_pedido']);
//    echo "Estamos en edicion de pedidos";
 //   $delete=mysqli_query($con, "DELETE FROM tmp WHERE id_tmp='".$id."'");
}
///////////////////////////////////////////////////



?>
<table class="table">
<tr>

    <th></th>
	<th>CODIGO</th>
	<th>CANT.</th>
	<th>DESCRIPCION</th>
	<th><span class="pull-right">PRECIO UNIT.</span></th>
	<th><span class="pull-right">PRECIO TOTAL</span></th>
	<th></th>
</tr>
<?php
	$sumador_total=0;
	#$sql=mysqli_query($con, "select * from productos, tmp where productos.id_producto=tmp.id_producto and tmp.session_id='".$session_id."'");

//	$sql=mysqli_query($con, "select * from ps_productos, tmp where ps_productos.id_producto=tmp.id_producto and tmp.session_id='".$session_id."'");

///////////////////////////////////////////////////
// Si estamos en edicion de pedido .....
if (isset($_GET['id_ver_pedido']))//codigo elimina un elemento del array
{
    $id_ver_pedido=intval($_GET['id_ver_pedido']);
//    echo "Estamos en edicion de pedidos";
    $sql_borra_tmp="delete from tmp";
    mysqli_query($con,$sql_borra_tmp );
    $sql_inserta_det_tmp="insert into tmp (id_tmp, id_producto, cantidad_tmp, precio_tmp, session_id) 
                          select id_detalle, id_producto, cantidad, importe,'".$session_id."' from detalle_pedido where id_pedido='". $id_ver_pedido . "'";
    mysqli_query($con,$sql_inserta_det_tmp );
   // echo $sql_inserta_det_tmp;
    //$sql=mysqli_query($con, "select * from ps_productos, detalle_pedido where ps_productos.id_producto=detalle_pedido.id_producto and detalle_pedido.id_pedido='".$id_ver_pedido."'");
    //$sql=mysqli_query($con, "insert into  from ps_productos, detalle_pedido where ps_productos.id_producto=detalle_pedido.id_producto and detalle_pedido.id_pedido='".$id_ver_pedido."'");

}
$sql=mysqli_query($con, "select * from ps_productos, tmp where ps_productos.id_producto=tmp.id_producto and tmp.session_id='".$session_id."'");
///////////////////////////////////////////////////

//$sql=mysqli_query($con, "select * from ps_productos, tmp where ps_productos.id_producto=tmp.id_producto ");
	while ($row=mysqli_fetch_array($sql))
	{
	$id_tmp=$row["id_tmp"];
	$codigo_producto=$row['codigo_producto'];
    $id_producto=$row['id_producto'];
	$cantidad=$row['cantidad_tmp'];
	$nombre_producto=$row['nombre_producto'];
	$id_marca_producto=$row['id_marca_producto'];
	if (!empty($id_marca_producto))
	{
	$sql_marca=mysqli_query($con, "select nombre_marca from ps_marcas where id_marca='$id_marca_producto'");
	$rw_marca=mysqli_fetch_array($sql_marca);
	$nombre_marca=$rw_marca['marca'];
	$marca_producto=" ".strtoupper($nombre_marca);
	}
	else {$marca_producto='';}
	$precio_venta=$row['precio_tmp'];
	$precio_venta_f=number_format($precio_venta,2);//Formateo variables
	$precio_venta_r=str_replace(",","",$precio_venta_f);//Reemplazo las comas
	$precio_total=$precio_venta_r*$cantidad;
	$precio_total_f=number_format($precio_total,2);//Precio total formateado
	$precio_total_r=str_replace(",","",$precio_total_f);//Reemplazo las comas
	$sumador_total+=$precio_total_r;//Sumador
/***** foto del productos ******/
        $sql_foto_producto="SELECT 
                                        p.id_product,
                                        (case 
                                        when img.id_image<10 then concat('https://www.regalonatural.com/img/p/', img.id_image,'/',img.id_image,'-large_default.jpg')
                                        when img.id_image<100 then concat('https://www.regalonatural.com/img/p/',substr(img.id_image,1,1),'/',substr(img.id_image,2,1),'/',img.id_image,'-large_default.jpg')
                                        when img.id_image<1000 then concat('https://www.regalonatural.com/img/p/',substr(img.id_image,1,1),'/',substr(img.id_image,2,1),'/',substr(img.id_image,3,1),'/',img.id_image,'-large_default.jpg')
                                        when img.id_image<10000 then  concat('https://www.regalonatural.com/img/p/',substr(img.id_image,1,1),'/',substr(img.id_image,2,1),'/',substr(img.id_image,3,1),'/',substr(img.id_image,4,1),'/',img.id_image,'-large_default.jpg')
                                         else 'empty'
                                        end) AS url_imagen
                                        FROM regalonatural.ps_product AS p
                                        LEFT OUTER JOIN (select min(id_image) as id_image, id_product from regalonatural.ps_image group by 2) as img
                                        ON p.id_product=img.id_product
                                        WHERE 
                                        p.id_product='".$id_producto ."'";
        $tmpsql_link_foto=mysqli_query($con, $sql_foto_producto);
        $rw_foto=mysqli_fetch_array($tmpsql_link_foto);
        $sql_link_foto=$rw_foto['url_imagen'];




/******************************/
		?>
		<tr>
            <td width="15%"><span class="pull-left"><img src="<?php echo $sql_link_foto?>" width="50%"> </img></span></td>
			<td><?php echo $codigo_producto;?></td>
			<td><?php echo $cantidad;?></td>
			<td><?php echo $nombre_producto.$marca_producto;?></td>
			<td><span class="pull-right"><?php echo $precio_venta_f;?></span></td>
			<td><span class="pull-right"><?php echo $precio_total_f;?></span></td>
			<td ><span class="pull-right"><a href="#" onclick="eliminar('<?php echo $id_tmp ?>')"><i class="glyphicon glyphicon-trash"></i></a></span></td>
		</tr>		
		<?php
	}

?>
<tr>
	<td colspan=4><span class="pull-right">TOTAL $</span></td>
	<td><span class="pull-right"><?php echo number_format($sumador_total,2);?></span></td>
	<td></td>
</tr>
</table>
			
