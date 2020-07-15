<?php
include_once("config.php");
include_once("connection.php");
            $sql_sp = "CALL SP_MATRICULAR('2018', 2, 'ADD',@pnCodeMessage,@pcMessage)";
            $ins_conexion = new Connection();
			$ins_conexion->connect();
            $ins_conexion->setConsulta($sql_sp);
            $qry = $ins_conexion->getResultConsulta();
            $return = $ins_conexion->getParametroSP("@pnCodeMessage,@pcMessage");
            if ($qry != '1') {
                echo "Error:" . $qry . " <br/>";
            }
            $mensajeSP = $return['@pcMessage'];
            $codigoMensaje = $return['@pnCodeMessage'];
			echo $mensajeSP;
            
        
?>