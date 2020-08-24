<?php
// error_reporting(0);

include_once("../bd/config.php");
include_once("../bd/conexion_mysqli.php");

//$datos=array((int)$_POST['usuario'], (int)$_POST['tarjeta'],$_POST['cvv'],$_POST['fechaexp'],(int)$_POST['nidtour'],(float)$_POST['prima']);

            $usuario = (int)$_POST['usuario'];
            $tarjeta = (int)$_POST['tarjeta'];
            $cvv = $_POST['cvv'];
            $fechaexp = $_POST['fechaexp'];
            $nidtour = (int)$_POST['nidtour'];
            $prima = (float)$_POST['prima'];


            //echo json_encode(array(
            //    $usuario,
            //    $tarjeta,
            //    $cvv,
            //    $fechaexp,
            //    $nidtour,
            //    $prima,
            //));

            $connexionMysqli = new ConnexionMysqli();

            $mysqli =  $connexionMysqli->connect();
            
            $call = $mysqli->prepare("CALL landtravel.SP_Reserva(?, ?, ?, ?, ?, ?, @pmensaje, @pcodigo);");
            ##{ CALL landtravel.SP_Reserva(:nusuario,:ntarjeta,:ncvv,:nfechaexp,:nidtour,:nreserva,?,?) }

            $call->bind_param(
                "iissid",
                $usuario,
                $tarjeta,
                $cvv,
                $fechaexp,
                $nidtour,
                $prima
            );

            
            $call->execute();
            
            $select = $mysqli->query("SELECT @pmensaje, @pcodigo");
            
            $result = $select->fetch_assoc();

            $codigo = $result['@pcodigo'];
            $mensaje = $result['@pmensaje'];

            echo json_encode(array(
                $mensaje,
                $codigo
            ));


            $mysqli->close();
