<?php

	/*-------------------------
	Autor: Obed Alvarado
	Web: obedalvarado.pw
	Mail: info@obedalvarado.pw
	---------------------------*/
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('codigo_producto', 'nombre_producto');//Columnas de busqueda
		 $sTable = "ps_productos";
		 $sWhere = "";
		{
            if ( $_GET['q'] != "" )
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 5; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './index.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			
			?>
            <div class="table-responsive" xmlns="http://www.w3.org/1999/html">
			  <table class="table">
				<tr  class="warning">
					<th></th>
					<th>Producto</th>
					<th><span class="pull-rigth">Cant.</span></th>
					<th><span class="pull-rigth">Precio</span></th>
                    <th><span class="pull-rigth">Imagen</span></th>
					<th style="width: 36px;"></th>
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
					$id_producto=$row['id_producto'];
					$codigo_producto=$row['codigo_producto'];
					$nombre_producto=$row['nombre_producto'];
					$id_marca_producto=$row['id_marca_producto'];
					$codigo_producto=$row["codigo_producto"];
					$sql_marca=mysqli_query($con, "select nombre_marca from ps_marcas where id_marca='$id_marca_producto'");
					$rw_marca=mysqli_fetch_array($sql_marca);
					$nombre_marca=$rw_marca['nombre_marca'];
					$precio_venta=$row["precio_producto"];
					$precio_venta=number_format($precio_venta,2);
					/**** sacar foto del producto ****/
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

					/*********************************/
					?>
					<tr>
						<td class="col-xs-1"><span class="pull-left"><a href="#" onclick="agregar('<?php echo $id_producto ?>')"><i class="glyphicon glyphicon-plus"></i></a></span></td>
						<td class="col-xs-2"><?php echo $nombre_producto; ?></td>
						<td class='col-xs-1'>
						<div class="pull-right">
						<input type="text" class="form-control" style="text-align:rigth" id="cantidad_<?php echo $id_producto; ?>"  value="1" >
						</div></td>
						<td class='col-xs-2'><div class="pull-rigth">
						<input type="text" class="form-control" style="text-align:rigth" id="precio_venta_<?php echo $id_producto; ?>"  value="<?php echo $precio_venta;?>" >
						</div></td>
                        <td class='col-xs-2'><div class="pull-rigth">
                        <img src="<?php echo $sql_link_foto?>" width="50%"> </img>
                        </div></td>
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan=5><span class="pull-left"><?php
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
			</div>
			<?php
		}
	}
?>
