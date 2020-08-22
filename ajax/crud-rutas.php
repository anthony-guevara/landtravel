<?php
    session_start();
    include_once("../bd/config.php");
    include_once("../bd/conexion_mysqli.php");
    
    $connexionMysqli = new ConnexionMysqli();
    $mysqli =  $connexionMysqli->connect();

    $his_usuario = $_SESSION['usuario'];
    $his_id = $_SESSION['id'] + 0;

    $id = 0;
    $actualizar = false;

    if(isset($_POST['save'])){  //agregar
        $viaje = $_POST['viaje_id'];
        $metodo = $_POST['metodo_id'];
        $tour = $_POST['tour_id'];
        $origen = $_POST['inicio'];
        $destino = $_POST['destino'];
        $f_lleg = $_POST['fecha_llegada'];
        $f_sal = $_POST['fecha_salida'];
        $lugar = $_POST['idlugar'];
        $guia = $_POST['idguia'];
        $costo = $_POST['COSTO'];

        $mysqli->query("INSERT INTO ruta(viaje_id, metodo_id, tour_id, inicio, destino, fecha_llegada, fecha_salida, idlugar, idguia, costo, paquete_id)
                        VALUES ('$viaje', '$metodo', '$tour', '$origen', '$destino', '$f_lleg', '$f_sal', '$lugar', '$guia', '$costo', '1')") or die($mysqli->error);
        
        //Actualizar tabla logs(agregar):
        $mysqli->query("INSERT INTO log (fecha, usuario_id, descripcion) 
                        VALUES(NOW(),$his_id , CONCAT('El usuario ', '$his_usuario' , ' agrego una nueva ruta.'))") or die ($mysqli->error);

        header("location: ../public/rutas.php");
    }

    if(isset($_GET['delete'])){ //eliminar
        $id = $_GET['delete'];

        //Actualizar tabla logs (eliminar):
        $mysqli->query("INSERT INTO log (fecha, usuario_id, descripcion) 
                        VALUES(NOW(),$his_id , CONCAT('El usuario ', '$his_usuario' , ' elimino ruta con id: $id.'))") or die ($mysqli->error);

        $mysqli->query("DELETE FROM ruta WHERE id = $id") or die($mysqli->error());

        header("location: ../public/rutas.php");
    }

    if(isset($_GET['edit'])){
        echo "<script>
                $(document).ready(function(){
                    $('#modalAddRutas').modal();
                });
            </script>";
                        
        echo "<script>
                $(document).ready(function(){
                    $('#modalAddRutas').on('hidden.bs.modal', function (e) {
                        window.history.back();
                    })
                });
            </script>";
        
        $id = $_GET['edit'];
        $actualizar = true;
        $result = $mysqli->query("SELECT * FROM ruta WHERE id=$id") or die($mysqli->error);
        
        if(get_object_vars($result)!=NULL){
            $row = $result->fetch_array();
            $viaje = $row['viaje_id'];
            $metodo = $row['metodo_id'];
            $paquete = $row['paquete_id'];
            $tour = $row['tour_id'];
            $origen = $row['inicio'];
            $destino = $row['destino'];
            $f_lleg = $row['fecha_llegada'];
            $f_sal = $row['fecha_salida'];
            $lugar = $row['idlugar'];
            $guia = $row['idguia'];
            $costo = $row['costo'];
        }

        echo "<script>
                $(document).ready(function(){
                    $('#s-viaje option[value=$viaje]').attr('selected','selected');
                    $('#s-metodo option[value=$metodo]').attr('selected','selected');
                    $('#s-lugar option[value=$lugar]').attr('selected','selected');
                    $('#s-tour option[value=$tour]').attr('selected','selected');
                    $('#s-origen option[value=$origen]').attr('selected','selected');
                    $('#s-destino option[value=$destino]').attr('selected','selected');
                    document.getElementById('fecha_llegada').value = '$f_lleg';
                    document.getElementById('fecha_salida').value = '$f_sal';
                    $('#s-guia option[value=$guia]').attr('selected','selected');
                    document.getElementById('COSTO').value = '$costo';
                });
            </script>";
    }

    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $viaje = $_POST['viaje_id'];
        $metodo = $_POST['metodo_id'];
        $tour = $_POST['tour_id'];
        $origen = $_POST['inicio'];
        $destino = $_POST['destino'];
        $f_lleg = $_POST['fecha_llegada'];
        $f_sal = $_POST['fecha_salida'];
        $lugar = $_POST['idlugar'];
        $guia = $_POST['idguia'];
        $costo = $_POST['COSTO'];

        $mysqli->query("UPDATE ruta 
                        SET viaje_id='$viaje', 
                            metodo_id='$metodo', 
                            paquete_id='1', 
                            tour_id='$tour', 
                            inicio='$origen', 
                            destino='$destino', 
                            fecha_llegada='$f_lleg',
                            fecha_salida='$f_sal', 
                            idlugar='$lugar', 
                            idguia='$guia', 
                            costo='$costo'
                        WHERE id='$id'") or die($mysqli->error);
        
        //Actualizar tabla logs (actualizar):
        $mysqli->query("INSERT INTO log (fecha, usuario_id, descripcion) 
                        VALUES(NOW(),$his_id , CONCAT('El usuario ', '$his_usuario' , ' actualizo ruta con id: $id.'))") or die ($mysqli->error);
        
        header("location: ../public/rutas.php");
    }

?>
