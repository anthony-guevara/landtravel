<?php

include_once("../bd/config.php");
include_once("../bd/conexion_mysqli.php");

session_start();
$connexionMysqli = new ConnexionMysqli();

$mysqli =  $connexionMysqli->connect();


switch ($_POST['accion']) {


    case "traerciudades":
        $call = $mysqli->prepare('select destino.id,pais.nombre nombrepais,destino.nombre,destino.descripcion from destino
        inner join pais on destino.pais_id=pais.id
        where pais.estado=1 and destino.estado=1
        order by destino .id asc;');

        $call->execute();
        $result = $call->get_result();
        //$destinos = $result->fetch_assoc();
        $destinos = $result->fetch_all(MYSQLI_ASSOC);

        echo json_encode($destinos);


    break;

    case "eliminarciudad":
        $idciudad = (int)$_POST['idciudad'];
        $usuario_id = (int)$_SESSION["id"];

        
        $call = $mysqli->prepare("CALL landtravel.SP_CIUDAD(1, ?, 'null','null', ?, 'eliminar',@mensaje,@codigo);");

        $call->bind_param("ii", $idciudad, $usuario_id);
        
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


    case "editarciudad":
        $idciudad = (int)$_POST['idciudad'];
        $nombreciudad = $_POST['nombreciudad'];
        $descripcion  = $_POST['descripcion'];
        $usuario_id = (int)$_SESSION["id"];

        $call = $mysqli->prepare("CALL landtravel.SP_CIUDAD(1, ?, ?, ?, ?, 'editar', @mensaje, @codigo);");


        $call->bind_param("issi", $idciudad, $nombreciudad, $descripcion, $usuario_id);
        
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


    case "agregarciudad":

        $idpais = (int)$_POST['idpais'];
        $nombreciudad = $_POST['nombreciudad'];
        $descripcion  = $_POST['descripcion'];
        $usuario_id = (int)$_SESSION["id"];

        $call = $mysqli->prepare("CALL landtravel.SP_CIUDAD(?, 1, ?, ?, ?, 'agregar',  @mensaje, @codigo);");

        $call->bind_param(
            'issi',
            $idpais,
            $nombreciudad,
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

    case "traerpaises":
        $call = $mysqli->prepare('SELECT id, nombre FROM pais  WHERE estado = 1  ORDER  BY nombre ASC;');

        $call->execute();
        $result = $call->get_result();
        //$destinos = $result->fetch_assoc();
        $paises = $result->fetch_all(MYSQLI_ASSOC);

        echo json_encode($paises);


    break;



}


$mysqli -> close();
