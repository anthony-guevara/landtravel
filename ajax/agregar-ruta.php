<?php 
error_reporting(0);
include_once("../bd/config.php");
include_once("../bd/connection.php");

$datos=array($_POST['guiaturismo'],$_POST['idtour'],$_POST['destino'],$_POST['lugar'],$_POST['precioruta'],$_POST['fechafin']);

for($i=0;$i<count($datos);$i++){
	if ($datos[$i]==""){
		$datos[$i]=null;
	}
};

            $sql_sp = "CALL SP_rutas($datos[0], 1, 1, 1, $datos[1], 1, $datos[2], null,'$datos[5]' , $datos[3],$datos[4], @pMensaje, @montoPagar,@fechaultima,@ultimoid);";
			$ins_conexion = new Connection();
			$ins_conexion->connect();
            $ins_conexion->setConsulta($sql_sp);
			$qry = $ins_conexion->getResultConsulta();
			$return = $ins_conexion->getParametroSP("@pMensaje,@montoPagar,@fechaultima,@ultimoid");
			$mensajeSP[0] = $return['@pMensaje'];
			$mensajeSP[1] = $return['@montoPagar'];
			$mensajeSP[2] = $return['@fechaultima'];
			$mensajeSP[3] = $return['@ultimoid'];
			echo json_encode($mensajeSP);
			mysqli_close($conexion);
 ?>
