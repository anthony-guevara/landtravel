<?php 
error_reporting(0);
include_once("../bd/config.php");
include_once("../bd/connection.php");

$datos=array($_POST['Nombre'],$_POST['fecha'],$_POST['cupos'],$_POST['tipos']);

for($i=0;$i<count($datos);$i++){
	if ($datos[$i]==""){
		$datos[$i]=null;
	}
};

            $sql_sp = "call SP_Tours('$datos[0]', '$datos[1]', $datos[2],'$datos[3]', 'agregar', @pcmensaje,@pccodigo,@pcid);";
			$ins_conexion = new Connection();
			$ins_conexion->connect();
            $ins_conexion->setConsulta($sql_sp);
			$qry = $ins_conexion->getResultConsulta();
			$return = $ins_conexion->getParametroSP("@pcmensaje,@pccodigo,@pcid");
			$mensajeSP[0] = $return['@pcmensaje'];
			$mensajeSP[1] = $return['@pccodigo'];
			$mensajeSP[2] = $return['@pcid'];
			
			if($mensajeSP[1]==1){
				header("Location: ../public/creacion-rutas.php?tour=$mensajeSP[2]");
 
			}else{
				header("Location: ../public/creacion-tours.php?error=1");
			}
			
			mysqli_close($conexion);
 ?>
