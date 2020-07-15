<?php 
error_reporting(0);
include_once("../bd/config.php");
include_once("../bd/connection.php");

$datos=array($_POST['usuario'],$_POST['tarjeta'],$_POST['cvv'],$_POST['fechaexp'],$_POST['nidtour']);

for($i=0;$i<count($datos);$i++){
	if ($datos[$i]==""){
		$datos[$i]=null;
	}
};

            $sql_sp = "CALL SP_Compra($datos[0], $datos[1], $datos[2], '$datos[3]', $datos[4], @pmensaje, @pcodigo);";
			$ins_conexion = new Connection();
			$ins_conexion->connect();
            $ins_conexion->setConsulta($sql_sp);
			$qry = $ins_conexion->getResultConsulta();
			$return = $ins_conexion->getParametroSP("@pmensaje,@pcodigo");
			$mensajeSP[0] = $return['@pmensaje'];
			$mensajeSP[1] = $return['@pcodigo'];
			
			echo json_encode($mensajeSP);
			mysqli_close($conexion);
 ?>
