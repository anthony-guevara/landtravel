<?php
include_once("../bd/config.php");
include_once("../bd/conexion_mysqli.php");

$connexionMysqli = new ConnexionMysqli();

$mysqli =  $connexionMysqli->connect();


$call = $mysqli->prepare('SELECT l.fecha, CONCAT(p2.pnombre, " ",p2.papellido ) nombre, l.descripcion FROM log l 
                            INNER JOIN usuario u ON u.id = l.usuario_id 
                            INNER JOIN persona p2 ON p2.usuario_id = u.id ');

        $call->execute();
        $result = $call->get_result();
        //$paises = $result->fetch_assoc();
        $logs = $result->fetch_all(MYSQLI_ASSOC);

        echo json_encode($logs);
