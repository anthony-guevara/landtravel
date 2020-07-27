<?php

include_once("../bd/config.php");
include_once("../bd/conexion_mysqli.php");


$connexionMysqli = new ConnexionMysqli();

$mysqli =  $connexionMysqli->connect();


switch($_POST['accion']){


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
        echo "i es igual a 0";
    break;


    case "editarciudad":
        echo "i es igual a 0";


break;


}




$mysqli -> close();


?>