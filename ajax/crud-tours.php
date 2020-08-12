<?php
include_once("../bd/config.php");
include_once("../bd/conexion_mysqli.php");
// echo "<script>console.log('conexion a crud tours exitosa')</script>";

$connexionMysqli = new ConnexionMysqli();
$mysqli =  $connexionMysqli->connect();
$result = $mysqli->query("SELECT NOMBRE,
                                fecha_inicio,
                                fecha_salida,
                                COSTO,
                                TipoTour,
                                Cupos 
                            FROM tour") or die($mysqli->error);

$NOMBRE = '';
$fecha_inicio = '';
$fecha_salida = '';
$COSTO = '';
$TipoTour = '';
$Cupos = '';
$id=0;
$update=false;

if(isset($_POST['save'])){
    $nombre = $_POST['NOMBRE'];
    $costo = $_POST['COSTO'];
    $cupos = $_POST['Cupos'];
    $tipotour = $_POST['TipoTour'];
    $fechaini = $_POST['fecha_inicio'];
    $fechafinal = $_POST['fecha_salida'];

    $mysqli->query("INSERT INTO tour(NOMBRE,fecha_inicio,fecha_salida,COSTO,TipoTour,Cupos,habilitado) 
                    VALUES('$nombre','$fechaini','$fechafinal','$costo','$tipotour','$cupos','1')") or die($mysqli->error);
    
    header("location: ../public/crud-tours.php");
}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM TOUR WHERE id=$id") or die ($mysqli->error());
   
    header("location: ../public/crud-tours.php");   
}

if (isset($_GET['edit'])){
    echo "<script>
            $(document).ready(function(){
                $('#modalAdd').modal();
            });
        </script>";

    echo "<script>
    $(document).ready(function(){
        $('#modalAdd').on('hidden.bs.modal', function (e) {
            window.history.back();
        })
    });
    </script>";
    
    $id = $_GET['edit'];
    $update=true;
    $result = $mysqli->query("SELECT * 
                            FROM tour 
                            WHERE id = $id") or die($mysqli->error());

    if(get_object_vars($result)!=NULL){
        $row = $result->fetch_array();
        $NOMBRE = $row['nombre'];
        $fecha_inicio = $row['fecha_inicio'];
        $fecha_salida = $row['fecha_salida'];
        $COSTO = $row['costo'];
        $TipoTour = $row['TipoTour'];
        $Cupos = $row['Cupos'];
    }
}

if (isset($_POST['update'])){
    $id=$_POST['id'];
    $NOMBRE = $_POST['NOMBRE'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_salida = $_POST['fecha_salida'];
    $COSTO = $_POST['COSTO'];
    $TipoTour = $_POST['TipoTour'];
    $Cupos = $_POST['Cupos'];

    $mysqli->query("UPDATE tour
                    SET nombre = '$NOMBRE',
                        fecha_inicio='$fecha_inicio',
                        fecha_salida='$fecha_salida',
                        costo='$COSTO',
                        habilitado='1',
                        TipoTour='$TipoTour',
                        Cupos='$Cupos'
                    WHERE id='$id'") or die($mysqli->error);

    header("location: ../public/crud-tours.php");
}
?>