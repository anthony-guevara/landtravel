<?php 
error_reporting(0);
include_once("../bd/config.php");
include_once("../bd/connection.php");

$datos=array($_POST['pnombre'],$_POST['papellido'],$_POST['correo'],$_POST['contrasenia'],$_POST['pais'],$_POST['direccion'],$_POST['telefono'],$_POST['fechaNac'],$_POST['pasaporte'],$_POST['exp'],$_POST['tipo'],$_POST['identidad'],$_POST['genero']);

for($i=0;$i<count($datos);$i++){
	if ($datos[$i]==""){
		$datos[$i]=null;
	}
};

            $sql_sp = "call SP_Persona('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$datos[5]','$datos[6]','$datos[7]','$datos[8]','$datos[9]','$datos[10]',$datos[11],$datos[12],@OUT_codigo,@OUT_mensaje);";
			$ins_conexion = new Connection();
			$ins_conexion->connect();
            $ins_conexion->setConsulta($sql_sp);
			$qry = $ins_conexion->getResultConsulta();
			$return = $ins_conexion->getParametroSP("@OUT_codigo,@OUT_mensaje");
			$mensajeSP[0] = $return['@OUT_codigo'];
			$mensajeSP[1] = $return['@OUT_mensaje'];
			
			echo json_encode($mensajeSP);
			mysqli_close($conexion);
 ?>
