<?php

include_once("../bd/config.php");
include_once("../bd/conexion_mysqli.php");

session_start();
$connexionMysqli = new ConnexionMysqli();

$mysqli =  $connexionMysqli->connect();


switch ($_POST['accion']) {

    case "traerpaises":


        $call = $mysqli->prepare('select id, nombre, gentilicio ,codigo from pais where estado=1;');

        $call->execute();
        $result = $call->get_result();
        //$paises = $result->fetch_assoc();
        $paises = $result->fetch_all(MYSQLI_ASSOC);

        echo json_encode($paises);


    break;
    case "eliminarpais":

        //parametros
        $idPais =  (int) $_POST['id'];
        $usuario_id = (int) $_SESSION["id"];

        $call = $mysqli->prepare("CALL SP_PAIS('null', 'null', ?, ?, 'eliminar', 'null', @mensaje, @codigo);");
        //{ CALL landtravel.SP_PAIS(:pNombre,:pGentilicio,:pIdPais,:pusuarioId,:paccion,:pCodigo,?,?) }


        $call->bind_param("ii", $idPais, $usuario_id);
        
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

    case "editarpais":
        //parametros
        $idPais =  (int) $_POST['idpais'];
        $nombre=$_POST['nombre'];
        $gentilicio=$_POST['gentilicio'];
        $codigo=$_POST['codigo'];
        $usuario_id = (int) $_SESSION["id"];


        $call = $mysqli->prepare("CALL landtravel.SP_PAIS(?, ?, ?, ?, 'editar', ?, @mensaje, @codigo);");
        //{ CALL landtravel.SP_PAIS(:pNombre,:pGentilicio,:pIdPais,:pusuarioId,:paccion,:pCodigo,?,?) }


        $call->bind_param("ssiis", $nombre, $gentilicio, $idPais, $usuario_id, $codigo);
        
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

    case "agregarpais":
        $nombre = $_POST['nombrepais'];
        $gentilicio  = $_POST['gentilicio'];
        $usuario_id = (int)$_SESSION["id"];

        $call = $mysqli->prepare("CALL landtravel.SP_PAIS(?, ?, 1, ?, 'agregar','null',  @mensaje, @codigo);");
        //{ CALL landtravel.SP_PAIS(:pNombre,:pGentilicio,:pIdPais,:pusuarioId,:paccion,:pCodigo,?,?) }

        $call->bind_param(
            'ssi',
            $nombre,
            $gentilicio,
            $usuario_id
        );
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
