<?php 
	require_once "../clases/conexion.php";


	$obj= new conectar();
	$conexion=$obj->conexion();

	$datos=array(
		$_POST['codigocliente'],
		$_POST['primernombre'],
		$_POST['segundonombre'],
		$_POST['primerapellido'],
		$_POST['segundoapellido'],
		$_POST['identidad'],
		$_POST['direccion'],
		$_POST['telefono'],
		$_POST['genero'],
		);
	    $sql="UPDATE persona set primernombre='$datos[1]',
		segundonombre='$datos[2]',
		primerapellido='$datos[3]',
		segundoapellido='$datos[4]',
		direccion='$datos[6]',
		sexo='$datos[8]'
		where numeroidentidad='$datos[5]';";
	
		mysqli_query($conexion,$sql);

		$sql="UPDATE telefono set numertelefono=$datos[7]
		where persona_numeroidentidad=$datos[5];";

		$result= mysqli_query($conexion,$sql);

		echo $result;



 ?>