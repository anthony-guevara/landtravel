<?php

include_once("../bd/config.php");
include_once("../bd/conexion_mysqli.php");

session_start();
$connexionMysqli = new ConnexionMysqli();

$mysqli =  $connexionMysqli->connect();


switch ($_POST['accion']) {

    case "eliminarContrato":
        $id  = (int)$_POST['id'];
        $direccion = "null";
        $telefono = "null";
        $usuario_id = (int)$_SESSION["id"];

        $call = $mysqli->prepare("CALL SP_CONTRATO(?, ?, ?, ?, 'eliminar', @mensaje, @codigo);");

        $call->bind_param("iiss", $id, $usuario_id, $direccion, $telefono);
        
        $call->execute();

        $select = $mysqli->query('SELECT  @mensaje, @codigo');
                
        $result = $select->fetch_assoc();
        $codigo = (int)$result['@codigo'];
        $mensaje = $result['@mensaje'];
        echo json_encode(array(
            "codigo"=>$codigo,
            "mensaje"=>$mensaje
        ));


    break;


    case "guardarContrato":
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $id  = (int)$_POST['id'];
        $usuario_id = (int)$_SESSION["id"];

        $call = $mysqli->prepare("CALL SP_CONTRATO(?, ?, ?, ?, 'editar', @mensaje, @codigo);");

        $call->bind_param("iiss", $id, $usuario_id, $direccion, $telefono);
        
        $call->execute();

        $select = $mysqli->query('SELECT  @mensaje, @codigo');
                
        $result = $select->fetch_assoc();
        $codigo = (int)$result['@codigo'];
        $mensaje = $result['@mensaje'];
        echo json_encode(array(
            "codigo"=>$codigo,
            "mensaje"=>$mensaje
        ));
        
    break;

    

}


$mysqli -> close();
