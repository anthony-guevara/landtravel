<?php 
	
	require_once "../clases/conexion.php";

	$obj= new conectar();
	$conexion=$obj->conexion();

	$codigo=$_POST['usuario'];

	$sql="select idfactura,tou.nombre,tou.fecha_inicio,tou.fecha_salida,tou.tipoTour from factura fac 
	inner join detalle_factura df on df.factura_idfactura=fac.idfactura
	inner join tour tou on tou.id=df.tour_id
	where usuario_id=$codigo and prima is null";
	
	$result=mysqli_query($conexion,$sql);

	while (	$ver=mysqli_fetch_row($result))
	{	
	  $results[] = $ver;
	}
	echo json_encode($results);
 ?>