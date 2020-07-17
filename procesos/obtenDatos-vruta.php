<?php 
	
	require_once "../clases/conexion.php";

	$obj= new conectar();
	$conexion=$obj->conexion();

	$codigo=$_POST['usuario'];

	$sql="select tou.nombre,des.nombre,tou.fecha_inicio,tou.fecha_salida from tour tou
    inner join ruta rut on rut.tour_id=tou.id
    inner join destino des on des.id=rut.destino
    inner join guia gui on gui.id=rut.idguia
    inner join persona per on per.id=gui.persona_id
    inner join usuario usu on usu.id=per.usuario_id
    where usu.id=$codigo";
	
	$result=mysqli_query($conexion,$sql);



	$results =  array();


	while (	$ver=mysqli_fetch_row($result))
	{	
	  array_push($results, $ver);
	}
	echo json_encode(isset($results)?$results: array());
 ?>