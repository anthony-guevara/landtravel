<?php
include_once("../bd/config.php");
include_once("../bd/conexion_mysqli.php");

echo "<script>console.log('conexion a crud tours exitosa')</script>";

$connexionMysqli = new ConnexionMysqli();
$mysqli =  $connexionMysqli->connect();

$result = $mysqli->query("SELECT NOMBRE, fecha_inicio, fecha_salida,COSTO, TipoTour,Cupos FROM tour") or die($mysqli->error);

if(isset($_POST['save'])){
    $nombre = $_POST['NOMBRE'];
    $costo = $_POST['COSTO'];
    $cupos = $_POST['Cupos'];
    $tipotour = $_POST['TipoTour'];
    $fechaini = $_POST['fecha_inicio'];
    $fechafinal = $_POST['fecha_salida'];
    echo "<script>console.log('nombre:".$nombre.", fecha Inicio:".$fechaini.", fecha fin:".$fechafinal."')</script>";
    $mysqli->query("INSERT INTO tour(NOMBRE, fecha_inicio, fecha_salida,COSTO, TipoTour,Cupos, habilitado) VALUES('$nombre','$fechaini','$fechafinal','$costo','$tipotour','$cupos','1')") or die($mysqli->error());
    
    header("location: ../public/crud-tours.php");
}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM TOUR WHERE id=$id") or die ($mysqli->error());

}

?>