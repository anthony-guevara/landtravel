<?php
    session_start();
    require_once "../clases/conexion.php";
    include_once("../bd/config.php");
    include_once("../bd/conexion_mysqli.php");
    


    $obj= new conectar();
    $conexion=$obj->conexion();

    $sql="select * from usuario;";

    $result=mysqli_query($conexion, $sql);
    

        while ($row = mysqli_fetch_row($result)) {
            if ($row[1]==$_POST["usuario"]  && $row[2]==$_POST["contrasenia"]) {
                $_SESSION["correo"] = $row[1];
                $_SESSION["id"] = $row[0];
                $_SESSION["tipo"] = $row[3];
                
                $respuesta["mensaje"]="Usuario logueado con exito";
                $respuesta["codigo"]=1;
                
                $_SESSION["usuario"]=$_POST["usuario"];

                //log
                $connexionMysqli = new ConnexionMysqli();
                $mysqli =  $connexionMysqli->connect();
                $call = $mysqli->prepare("INSERT INTO landtravel.log (fecha, usuario_id, descripcion) VALUES(NOW(), ?, 'Inicio de sesión.');");
        
                $call->bind_param("i", $row[0]);
                
                $call->execute();
                $mysqli -> close();
                
                echo json_encode($respuesta);
                exit();
            }
        }
    $respuesta["mensaje"]="Usuario o contrasenia invalida";
    $respuesta["codigo"]=0;
    echo json_encode($respuesta);
