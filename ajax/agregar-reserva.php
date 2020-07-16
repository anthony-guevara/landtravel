<?php 
error_reporting(0);
include_once("../bd/config.php");
include_once("../bd/conexion_mysqli.php");

$datos=array((int)$_POST['usuario'], (int)$_POST['tarjeta'],$_POST['cvv'],$_POST['fechaexp'],(int)$_POST['nidtour'],(float)$_POST['prima']);

for($i=0;$i<count($datos);$i++){
	if ($datos[$i]==""){
		$datos[$i]=null;
	}
};

            // $sql_sp = "CALL SP_Reserva($datos[0], $datos[1], $datos[2], '$datos[3]', $datos[4],$datos[5], @pmensaje, @pcodigo);";
			// $ins_conexion = new Connection();
			// $ins_conexion->connect();
            // $ins_conexion->setConsulta($sql_sp);
			// $qry = $ins_conexion->getResultConsulta();
			// $return = $ins_conexion->getParametroSP("@pmensaje,@pcodigo");
			// $mensajeSP[0] = $return['@pmensaje'];
			// $mensajeSP[1] = $return['@pcodigo'];
			
			// echo json_encode($mensajeSP);
			// mysqli_close($conexion);

			$connexionMysqli = new ConnexionMysqli();

			$mysqli =  $connexionMysqli->connect();

			

			$call = $mysqli->prepare('CALL SP_Reserva(?, ? , ? , ? , ?, ? , @pmensaje, @pcodigo);');

			$call->bind_param('iissid',
			$datos[0],
			$datos[1],
			$datos[2],
			$datos[3],
			$datos[4],
			$datos[5],
			);


		
			$call->execute();
					
			$select = $mysqli->query('SELECT  @pmensaje, @pcodigo');
					
			$result = $select->fetch_assoc();

			$codigo = $result['@pcodigo'];
			$mensaje = $result['@pmensaje'];

			echo json_encode(array(
				$mensaje,
				$codigo
			));


			$mysqli -> close();
 ?>
