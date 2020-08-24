<?php

include_once("../bd/config.php");
include_once("../bd/conexion_mysqli.php");

//$datos=array((int)$_POST['usuario'],(int)$_POST['tarjeta'],$_POST['cvv'],$_POST['fechaexp'],(int)$_POST['nidtour']);


            $usuario = (int)$_POST['usuario'];
            $tarjeta = (int)$_POST['tarjeta'];
            $cvv = $_POST['cvv'];
            $fechaexp = $_POST['fechaexp'];
            $nidtour = (int)$_POST['nidtour'];

            $connexionMysqli = new ConnexionMysqli();

            $mysqli =  $connexionMysqli->connect();

            
            $call = $mysqli->prepare("CALL SP_Compra(?, ?, ?, ?, ?, @pmensaje, @pcodigo);");

            $call->bind_param(
                "iissi",
                $usuario,
                $tarjeta,
                $cvv,
                $fechaexp,
                $nidtour
            );

            
            $call->execute();
                    
            $select = $mysqli->query("SELECT  @pmensaje, @pcodigo");
                    
            $result = $select->fetch_assoc();

            $codigo = $result['@pcodigo'];
            $mensaje = $result['@pmensaje'];

            echo json_encode(array(
                $mensaje,
                $codigo
            ));


            $mysqli->close();
