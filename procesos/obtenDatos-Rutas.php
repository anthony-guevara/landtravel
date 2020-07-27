<?php 
	
	require_once "../clases/conexion.php";

	$obj= new conectar();
	$conexion=$obj->conexion();

	$codigo=$_POST['idtour'];

	$sql="select pa.nombre,des.nombre,lug.nombre,concat(per.pnombre,' ',per.papellido),rut.fecha_llegada,rut.fecha_salida from ruta rut
	inner join tour tou on tou.id=rut.tour_id
    	inner join destino des on des.id=rut.destino
	inner join guia gui on gui.id=rut.idguia
	inner join lugar lug on lug.id=rut.idlugar
	inner join pais pa on pa.id=des.pais_id
    inner join persona per on per.id=gui.persona_id
    where tou.id=$codigo";
	
	$result=mysqli_query($conexion,$sql);

	$results =  array();

	while (	$ver=mysqli_fetch_row($result))
	{	
		array_push( $results, $ver);
	}
	echo json_encode(isset($results)?$results: array());
 ?>