<?php 
error_reporting(0);
include_once("../bd/config.php");
include_once("../bd/conexion_mysqli.php");

$datos=array((int)$_POST['guiaturismo'],(int)$_POST['idtour'],(int)$_POST['destino'],(int)$_POST['lugar'],(double)$_POST['precioruta'],$_POST['fechafin']);

for($i=0;$i<count($datos);$i++){
	if ($datos[$i]==""){
		$datos[$i]=null;
	}
};

		//echo json_encode($datos);

            // $sql_sp = "CALL SP_rutas($datos[0], 1, 1, 1, $datos[1], 1, $datos[2], null,'$datos[5]' , $datos[3],$datos[4], @pMensaje, @montoPagar,@fechaultima,@ultimoid);";
			// $ins_conexion = new Connection();
			// $ins_conexion->connect();
            // $ins_conexion->setConsulta($sql_sp);
			// $qry = $ins_conexion->getResultConsulta();
			// $return = $ins_conexion->getParametroSP("@pMensaje,@montoPagar,@fechaultima,@ultimoid");
			// $mensajeSP[0] = $return['@pMensaje'];
			// $mensajeSP[1] = $return['@montoPagar'];
			// $mensajeSP[2] = $return['@fechaultima'];
			// $mensajeSP[3] = $return['@ultimoid'];
			// echo json_encode($mensajeSP);
			// mysqli_close($conexion);

				
			$connexionMysqli = new ConnexionMysqli();

			$mysqli =  $connexionMysqli->connect();

			

			$call = $mysqli->prepare('CALL SP_rutas(?, 1 , 1 , 1 , ?, 1 , ?, null , ? , ? , ? , @pMensaje, @montoPagar,@fechaultima, @ultimoid);');

			$call->bind_param('iiisid', 
			$datos[0],
			$datos[1],
			$datos[2],
			$datos[5],
			$datos[3],
			$datos[4]
			);


			$call->execute();
					
			$select = $mysqli->query('SELECT  @pMensaje, @montoPagar, @fechaultima, @ultimoid');
					
			$result = $select->fetch_assoc();
			
			$mensaje = $result['@pMensaje'];
			$montoPagar = $result['@montoPagar'];
			$fechaultima = $result['@fechaultima'];
			$ultimoid = $result['@ultimoid'];

			echo json_encode(array(
				$mensaje,
				$montoPagar,
				$fechaultima,
				$ultimoid
			));


			$mysqli -> close();
 ?>
