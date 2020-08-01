<?php

include_once("../bd/config.php");
include_once("../bd/conexion_mysqli.php");


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

    case "eliminarlugar":
        $idlugar = (int)$_POST['idlugar'];

        $call = $mysqli->prepare('UPDATE lugar  SET estado=0 WHERE id=?;');

        $call->bind_param("i", $idlugar);
        
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


    case "editarlugar":
        $idlugar = (int)$_POST['idlugar'];
        $nombre = $_POST['nombre'];
        $descripcion  = $_POST['descripcion'];

        $call = $mysqli->prepare("
        UPDATE landtravel.lugar SET  nombre=?,  descripcion=? WHERE id=?;");

        $call->bind_param("ssi", $nombre, $descripcion, $idlugar);
        
        $call->execute();

        $filasAfectadas = $call->affected_rows;

        if ($filasAfectadas>0) {
            echo json_encode(
                array(
                    "codigo"=>1,
                    "mensaje"=>"Se editó correctamente."
                )
            );
        } else {
            echo json_encode(
                array(
                    "codigo"=>0,
                    "mensaje"=>"Ocurrió un error."
                )
            );
        }
        
    break;


    case "agregarlugar":

        $idCiudad = (int)$_POST['idCiudad'];
        $nombre = $_POST['nomre$nombre'];
        $descripcion  = $_POST['descripcion'];


        $call = $mysqli->prepare('CALL SP_LUGAR(?, ? , ?, @mensaje, @codigo);');

        $call->bind_param(
            'iss',
            $idCiudad,
            $nombreCiudad,
            $descripcion
        );
        $call->execute();
                
        $select = $mysqli->query('SELECT  @mensaje, @codigo');
                
        $result = $select->fetch_assoc();
        $codigo = $result['@codigo'];
        $mensaje = $result['@mensaje'];
        echo json_encode(array(
            $codigo,
            $mensaje
        ));
    break;

    case "traerciudades":
        $call = $mysqli->prepare('SELECT id, nombre FROM destino d WHERE estado = 1;');

        $call->execute();
        $result = $call->get_result();
        //$destinos = $result->fetch_assoc();
        $ciudades = $result->fetch_all(MYSQLI_ASSOC);

        echo json_encode($ciudades);


    break;



}


$mysqli -> close();
