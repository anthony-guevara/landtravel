<?php 
	
	require_once "../clases/conexion.php";

	$obj= new conectar();
	$conexion=$obj->conexion();

	$codigo=$_POST['usuario'];
	$fecha1=$_POST['fechainicio'];
	$fecha2=$_POST['fechafin'];

	$sql="select tou.nombre,des.nombre,tou.fecha_inicio,tou.fecha_salida from tour tou
    inner join ruta rut on rut.tour_id=tou.id
    inner join destino des on des.id=rut.destino
	inner join guia gui on gui.id=rut.idguia
	inner join persona per on per.id=gui.persona_id
	inner join usuario usu on usu.id=per.usuario_id
    where gui.id=$codigo and tou.fecha_inicio >= '$fecha1' and tou.fecha_salida <= '$fecha2'";
	$result=mysqli_query($conexion,$sql);

	while (	$ver=mysqli_fetch_row($result))
	{	
	  $results[] = $ver;
	}
	if(!isset($results)){
		echo json_encode($user=0);
	}else{
	echo json_encode($results);
}
 ?>