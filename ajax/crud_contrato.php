<?php

include_once("../bd/config.php");
include_once("../bd/conexion_mysqli.php");


$connexionMysqli = new ConnexionMysqli();

$mysqli =  $connexionMysqli->connect();


switch ($_POST['accion']) {

    case "eliminarContrato":
        $id  = (int)$_POST['id'];

        $call = $mysqli->prepare('UPDATE usuario SET habilitado=0 WHERE id=?;');

        $call->bind_param("i", $id);
        
        $call->execute();

        $filasAfectadas = $call->affected_rows;

        if ($filasAfectadas>0) {
            echo json_encode(
                array(
                    "codigo"=>1,
                    "mensaje"=>"Se eliminó correctamente"
                )
            );
        } else {
            echo json_encode(
                array(
                    "codigo"=>0,
                    "mensaje"=>"Ocurrió un error"
                )
            );
        }


    break;


    case "guardarContrato":
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $id  = (int)$_POST['id'];

        $call = $mysqli->prepare("  UPDATE persona SET telefono=?, direccion=?  WHERE usuario_id=?;");

        $call->bind_param("ssi", $telefono, $direccion, $id);
        
        $call->execute();

        $filasAfectadas = $call->affected_rows;

        if ($filasAfectadas>0) {
            echo json_encode(
                array(
                    "codigo"=>1,
                    "mensaje"=>"Se editó correctamente"
                )
            );
        } else {
            echo json_encode(
                array(
                    "codigo"=>0,
                    "mensaje"=>"Ocurrió un error"
                )
            );
        }
        
    break;

    

}


$mysqli -> close();
