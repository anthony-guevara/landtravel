<?php 
	
	require_once "../clases/conexion.php";

	$obj= new conectar();
	$conexion=$obj->conexion();

	//$codigo=$_POST['idtour'];

	$sql="select DISTINCT tou.id,tou.nombre,tou.fecha_inicio,tou.fecha_salida,tou.costo,tou.tipotour,tou.cupos from tour tou
	inner join ruta rut on tou.id=rut.tour_id";
	$result=mysqli_query($conexion,$sql);
	while (	$ver=mysqli_fetch_row($result))
	{	
	  $results[] = $ver;
	}
	echo json_encode($results);
 ?>