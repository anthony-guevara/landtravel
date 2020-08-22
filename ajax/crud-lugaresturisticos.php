<?php

include_once("../bd/config.php");
include_once("../bd/conexion_mysqli.php");

session_start();
$connexionMysqli = new ConnexionMysqli();

$mysqli =  $connexionMysqli->connect();


switch ($_POST['accion']) {


    case "traerlugaresturisticos":
        $call = $mysqli->prepare('SELECT l.id, l.nombre,l.descripcion, d.nombre destino FROM lugar l 
        INNER JOIN destino d ON d.id = l.destino_id WHERE l.estado = 1;');

        $call->execute();
        $result = $call->get_result();
        //$destinos = $result->fetch_assoc();
        $lugares = $result->fetch_all(MYSQLI_ASSOC);

        echo json_encode($lugares);


    break;

    case "eliminarlugarturistico":
        $idlugar = (int)$_POST['id'];
        $usuario_id = (int)$_SESSION["id"];

        $call = $mysqli->prepare("CALL landtravel.SP_LUGAR(1, ?, 'null', 'null', ?, 'eliminar', @mensaje,@codigo);");

        $call->bind_param("ii", $idlugar, $usuario_id);
        
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


    case "editarlugar":
        $idlugar = (int)$_POST['id'];
        $nombre = $_POST['nombrelugar'];
        $descripcion  = $_POST['descripcion'];
        $usuario_id = (int)$_SESSION["id"];

        $call = $mysqli->prepare("CALL landtravel.SP_LUGAR(1, ?, ?, ?, ?, 'editar', @mensaje, @codigo);");

        //$call = $mysqli->prepare("
        //UPDATE landtravel.lugar SET  nombre=?,  descripcion=? WHERE id=?;");

        $call->bind_param("issi", $idlugar, $nombre, $descripcion, $usuario_id);
        
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


    case "nuevolugar":

        $idCiudad = (int)$_POST['ciudad'];
        $nombre = $_POST['lugar'];
        $descripcion  = $_POST['descripcion'];
        $usuario_id = (int)$_SESSION["id"];

        $call = $mysqli->prepare("CALL landtravel.SP_LUGAR(?, 1, ?, ?, ?, 'agregar', @mensaje, @codigo);");


        $call->bind_param(
            'issi',
            $idCiudad,
            $nombre,
            $descripcion,
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

    case "traerciudades":
        $call = $mysqli->prepare('SELECT id, nombre FROM destino d WHERE estado = 1 ORDER  BY nombre ASC;');

        $call->execute();
        $result = $call->get_result();
        //$destinos = $result->fetch_assoc();
        $ciudades = $result->fetch_all(MYSQLI_ASSOC);

        echo json_encode($ciudades);


    break;



}


$mysqli -> close();
