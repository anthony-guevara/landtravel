<?php 
	
	require_once "../clases/conexion.php";
	$obj= new conectar();
	$conexion=$obj->conexion();

	$codigo=$_POST['id'];
	$sql="select per.identidad,usu.id,per.pnombre,per.papellido,tipo_usuario,per.direccion,per.fecha_nacimiento,per.telefono,per.nacionalidad from persona per 
	inner join usuario usu on usu.id=per.usuario_id
	where usu.id=$codigo";
	$result=mysqli_query($conexion,$sql);

	while (	$ver=mysqli_fetch_row($result))
	{	
	  $results[] = $ver;
	}


	echo json_encode($results);
 ?>