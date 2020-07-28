<?php

include_once("../bd/config.php");
include_once("../bd/conexion_mysqli.php");


$connexionMysqli = new ConnexionMysqli();

$mysqli =  $connexionMysqli->connect();


switch ($_POST['accion']) {


    case "traerciudades":
        $call = $mysqli->prepare('select destino.id,pais.nombre,destino.nombre,destino.descripcion from destino
        inner join pais on destino.pais_id=pais.id
        where pais.estado=1 and destino.estado=1;');

        $call->execute();
        $result = $call->get_result();
        //$destinos = $result->fetch_assoc();
        $destinos = $result->fetch_all(MYSQLI_ASSOC);

        echo json_encode($destinos);


    break;

    case "eliminarciudad":
        $idciudad = (int)$_POST['idciudad'];

        $call = $mysqli->prepare('UPDATE DESTINO  SET estado=0 WHERE id=?;');

        $call->bind_param("i", $idciudad);
        
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


    case "editarciudad":
        $idciudad = (int)$_POST['idciudad'];
        $nombreCiudad = $_POST['nombreciudad'];
        $descripcion  = $_POST['descripcion'];

        $call = $mysqli->prepare("
        UPDATE landtravel.destino SET  nombre=?,  descripcion=? WHERE id=?;");

        $call->bind_param("ssi", $nombreCiudad, $descripcion, $idciudad);
        
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


    case "agregarciudad":

        $idpais = (int)$_POST['idpais'];
        $nombreCiudad = $_POST['nombreciudad'];
        $descripcion  = $_POST['descripcion'];


        $query = "INSERT INTO destino ( pais_id, nombre, descripcion, estado) VALUES(?, ?, ?, 1);";


        $call = $mysqli->prepare($query);

        $call->bind_param("iss", $idpais, $nombreCiudad, $descripcion);
        
        $call->execute();

        $filasAfectadas = $call->affected_rows;

        if ($filasAfectadas>0) {
            echo json_encode(
                array(
                    "codigo"=>1,
                    "mensaje"=>"Se agregó correctamente"
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

    case "traerpaises":
        $call = $mysqli->prepare('SELECT id, nombre FROM pais  WHERE estado = 1;');

        $call->execute();
        $result = $call->get_result();
        //$destinos = $result->fetch_assoc();
        $paises = $result->fetch_all(MYSQLI_ASSOC);

        echo json_encode($paises);


    break;



}


$mysqli -> close();
