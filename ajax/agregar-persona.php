<?php 
error_reporting(0);
include_once("../bd/config.php");
include_once("../bd/conexion_mysqli.php");

$datos=array($_POST['pnombre'],$_POST['papellido'],$_POST['correo'],$_POST['contrasenia'],$_POST['pais'],$_POST['direccion'],$_POST['telefono'],$_POST['fechaNac'],$_POST['pasaporte'],$_POST['exp'],$_POST['tipo'],$_POST['identidad'],$_POST['genero']);

for($i=0;$i<count($datos);$i++){
	if ($datos[$i]==""){
		$datos[$i]=null;
	}
};

			// $sql_sp = "CALL SP_Persona('$datos[0]','$datos[1]','$datos[2]','$datos[3]',$datos[4],'$datos[5]','$datos[6]','$datos[7]','$datos[8]','$datos[9]','$datos[10]','$datos[11]',$datos[12],@OUT_codigo,@OUT_mensaje);";
			
			
			$connexionMysqli = new ConnexionMysqli();

			$mysqli =  $connexionMysqli->connect();

			

			$call = $mysqli->prepare('CALL SP_Persona(?, ? , ? , ? , ?, ? , ?, ? ,?,?,?, ?, ?, @OUT_codigo, @OUT_mensaje)');

			$call->bind_param('ssssisssssssi', 
			$datos[0],
			$datos[1],
			$datos[2],
			$datos[3],
			$datos[4],
			$datos[5],
			$datos[6],
			$datos[7],
			$datos[8],
			$datos[9],
			$datos[10],
			$datos[11],
			$datos[12]
			);


			$call->execute();
					
			$select = $mysqli->query('SELECT  @OUT_codigo, @OUT_mensaje');
					
			$result = $select->fetch_assoc();
			$codigo = $result['@OUT_codigo'];
			$mensaje = $result['@OUT_mensaje'];

			echo json_encode(array(
				$codigo,
				$mensaje
			));


			$mysqli -> close();
			

 ?>
