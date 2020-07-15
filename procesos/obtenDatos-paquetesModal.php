<?php 
	
	require_once "../clases/conexion.php";

	$obj= new conectar();
	$conexion=$obj->conexion();

	$codigo=$_POST['code'];

	$sql="select tou.nombre,tou.fecha_inicio,tou.fecha_salida,tou.costo,tou.tipoTour,tou.cupos,lug.nombre,des.nombre,des.descripcion,pa.nombre from tour tou
	inner join ruta rut on tou.id=rut.tour_id
	inner join lugar lug on lug.id=rut.idlugar
	inner join destino des on des.id=lug.destino_id
	inner join pais pa on pa.id=des.pais_id
	where tou.id=$codigo
	order by fecha_inicio asc";
	
	$result=mysqli_query($conexion,$sql);

	while (	$ver=mysqli_fetch_row($result))
	{	
	  $results[] = $ver;
	}
	echo json_encode($results);
 ?>