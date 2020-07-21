<?php

include_once("../bd/config.php");
include_once("../bd/conexion_mysqli.php");


$connexionMysqli = new ConnexionMysqli();

$mysqli =  $connexionMysqli->connect();


switch($_POST['accion']){

  
    case "traerpaises":


        $call = $mysqli->prepare('select id, nombre, gentilicio from pais where estado=1;');

        $call->execute();
        $result = $call->get_result();
        //$paises = $result->fetch_assoc(); 
        $paises = $result->fetch_all(MYSQLI_ASSOC);

        echo json_encode($paises);


    break;
    case "eliminarpais":

        //parametros
        $idPais =  (int) $_POST['id'];

        
        $call = $mysqli->prepare('update pais set estado=0 where id=?;');
        $call->bind_param('i', 
                $idPais
        );

        $call->execute();
        
        $filasAfectadas = $call->affected_rows;

        if($filasAfectadas>0){
            echo json_encode(
                array(
                    "codigo"=>1,
                    "mensaje"=>"Se eliminó correctamente"
                )
                );
        }else{
            
            echo json_encode(
                array(
                    "codigo"=>0,
                    "mensaje"=>"Ocurrió un error"
                )
                );
        }

    break;
    case "editarpais":

    break;
}


$mysqli -> close();

?>