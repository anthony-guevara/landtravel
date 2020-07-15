<?php 
	session_start();
	require_once "../clases/conexion.php";

	$obj= new conectar();
	$conexion=$obj->conexion();

	$sql="select * from usuario;";

	$result=mysqli_query($conexion,$sql);
	

		while ($row = mysqli_fetch_row($result)) {		 
		if ($row[1]==$_POST["usuario"]  && $row[2]==$_POST["contrasenia"]){

			$_SESSION["correo"] = $row[1];
			$_SESSION["id"] = $row[0];
			$_SESSION["tipo"] = $row[3];
			$respuesta["mensaje"]="Usuario logueado con exito";
      $respuesta["codigo"]=1;
      $_SESSION["usuario"]=$_POST["usuario"];
			echo json_encode($respuesta);
			exit();
		}
	}
	$respuesta["mensaje"]="Usuario o contrasenia invalida";
	$respuesta["codigo"]=0;
	echo json_encode($respuesta);
 ?>