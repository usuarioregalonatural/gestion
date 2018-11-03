<?php
// connect to database
include("../config/db.php");		
 $con=@mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$search = strip_tags(trim($_GET['q'])); 
// Do Prepared Query
#$query = mysqli_query($con, "SELECT * FROM proveedores WHERE nombre_proveedor LIKE '%$search%' LIMIT 40");
#$query = mysqli_query($con, "SELECT id_customer, concat(firstname,"-",lastname) as nombre FROM regalonatural.ps_customer WHERE concat(firstname,"-",lastname) LIKE '%$search%' LIMIT 40");
$query = mysqli_query($con, "SELECT *  FROM clientes WHERE nombre_cliente LIKE '%$search%' LIMIT 40");
// Do a quick fetchall on the results
$list = array();
while ($list=mysqli_fetch_array($query)){
	$data[] = array('id' => $list['id_cliente'], 'text' => $list['nombre_cliente']);
}
// return the result in json
echo json_encode($data);
?>
