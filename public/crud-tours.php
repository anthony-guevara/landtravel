
<?php 
require_once "../clases/conexion.php";
require_once "../ajax/crud-tours.php";
  $obj= new conectar();
  $conexion=$obj->conexion();


include_once("../bd/config.php");                                                                       //OBTENER DATOS DE DB
include_once("../bd/conexion_mysqli.php");

  $connexionMysqli = new ConnexionMysqli();
  $mysqli =  $connexionMysqli->connect();
  $result = $mysqli->query("SELECT id, NOMBRE, fecha_inicio, fecha_salida,COSTO, TipoTour,Cupos FROM tour") or die($mysqli->error);

function pre_r( $array ){
    echo '<pre>';
    print_r($array);
    echo '<pre>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tours</title>
    <link rel="icon" href="../img/favicon.ico" type="image/png">
    <!-- <link rel="stylesheet" href="../vendors/bootstrap/bootstrap.min.css">                             SE BORRO POR CONFLICTO -->
    <link rel="stylesheet" href="../vendors/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../vendors/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="../vendors/linericon/style.css">
    <link rel="stylesheet" href="../vendors/owl-carousel/owl.theme.default.min.css">
    <link rel="stylesheet" href="../vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="../vendors/flat-icon/font/flaticon.css">
    <link rel="stylesheet" href="../vendors/nice-select/nice-select.css">
    <link rel="stylesheet" href="../css/lugaresturisticos.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css">  <!-- CAMBIO A BOOTSTRAP v4 -->
</head> 
<body>
    <!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>                 
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->                                    <!-- SE BORRO POR CONFLICTO -->

    <div id="wrapper" class="active">
      
      <!-- Sidebar -->
      <div id="sidebar-wrapper">
        <ul id="sidebar_menu" class="sidebar-nav">
          <li class="sidebar-brand"><a id="menu-toggle" href="#">Menu<span id="main_icon" class="glyphicon glyphicon-align-justify"></span></a></li>
        </ul>
        <ul class="sidebar-nav" id="sidebar">     
          <li><a href="rutas.php">Rutas<span class="sub_icon glyphicon glyphicon-wrench"></span></a></li>
          <li><a href="tablaciudad.php">Ciudad<span class="sub_icon glyphicon glyphicon-wrench"></span></a></li>
          <li><a href="lugaresTuristicos.php">Turísticos<span class="sub_icon glyphicon glyphicon-wrench"></span></a></li>
          <li><a href="tablaPais.php">Paises<span class="sub_icon glyphicon glyphicon-wrench"></span></a></li>
          <li><a href="Tours.php">Salir<span class="sub_icon glyphicon glyphicon-log-out"></span></a></li>
        </ul>
      </div>
      <!-- Page content -->
      <div id="page-content-wrapper">
      <!-- Keep all page content within the page-content inset div! -->
        <div class="page-content inset">
          <div class="row">
            <div class="col-md-12">
              <!--aqui va todo el crud -->
              <div class="container" style="text-align:center">
                <div class="row">
                  <div class="col col-sm-12">
                    <h1 id="titulo" style="text-align: center; margin-top: 3%; margin-bottom:2%;">Tours</h1>
                    <br>
                    <div class="container">
                      <div class="row justify-content-end">
                          <div class="col-2"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalAdd">Agregar &nbsp<i class="fas fa-plus"></i></button></div>
                          <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Agregar Tour</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                <form action="../ajax/crud-tours.php" method="POST"> <!-- Formulario para agregar tours -->
                                    <div class="form-row">
                                      <div class="form-group col-md-4">
                                          <label class="d-flex justify-content-start">Nombre</label>
                                          <input class="form-control"  placeholder="nombre x" name="NOMBRE">
                                      </div>
                                      <div class="form-group col-md-4">
                                          <label class="d-flex justify-content-start">Costo</label>
                                          <input class="form-control" placeholder="###" type="number" name="COSTO">
                                      </div>
                                      <div class="form-group col-md-4">
                                          <label class="d-flex justify-content-start">Cupos</label>
                                          <input class="form-control"  placeholder="###" type="number" name="Cupos">
                                      </div>
                                    </div>
                                    <div class="form-row">
                                      <div class="form-group col-md-4">
                                        <label class="d-flex justify-content-start">Tipo tour</label>
                                        <select class="custom-select" name="TipoTour">
                                          <option value="Familiar">Familiar</option>
                                          <option value="Individual">Individual</option>
                                        </select>
                                      </div>
                                      <div class="form-group col-md-4">
                                        <label class="d-flex justify-content-start">Fecha inicio</label>
                                        <input type="date" class="form-control"  placeholder="nombre x" name="fecha_inicio">
                                      </div>
                                      <div class="form-group col-md-4">
                                        <label class="d-flex justify-content-start">Fecha fin</label>
                                        <input type="date" class="form-control"  placeholder="nombre x" name="fecha_salida">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-success" name="save">Agregar</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                      </div>
                    </div>
                    <br>
                    <div class="tableText col col-lg-12 col-md-12 col-sm-12">
                      <table class="table table-striped"> 
                        <thead class="thead-dark">
                          <tr>
                            <th style="text-align: center !important;">Nombre</th>
                            <th style="text-align: center !important;">Costo</th>
                            <th style="text-align: center !important;">Cupos</th>
                            <th style="text-align: center !important;">Tipo Tour</th>
                            <th style="text-align: center !important;">Fecha inicio</th>
                            <th style="text-align: center !important;">Fecha Salida</th>
                            <th style="text-align: center !important;">Accion</th>
                          </tr>
                        </thead>
                        <tbody id="contenido-tours">   
                            <tr>
                              <td>Roma</td>
                              <td>1000</td>
                              <td>80</td>
                              <td>Familiar</td>
                              <td>1/2/20</td>
                              <td>1/3/20</td>
                              <td>  
                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">Editar &nbsp<i class="fas fa-pen"></i></button> 
                                <button type="button" class="btn btn-danger">Eliminar &nbsp<i class="fas fa-trash"></i></button>
                              </td>
                            </tr>           
                              <!-- AGREGAR DATOS DE TABLA FORMA DINAMICA -->
                              <?php while($row = $result->fetch_assoc()):?>
                                  <tr>
                                    <td id="<?php echo 'nombre'?>"><?php echo $row['NOMBRE']; ?></td>
                                    <td id="<?php echo 'nombre'?>"><?php echo $row['fecha_inicio']; ?></td>
                                    <td id="<?php echo 'nombre'?>"><?php echo $row['fecha_salida']; ?></td>
                                    <td id="<?php echo 'nombre'?>"><?php echo $row['COSTO']; ?></td>
                                    <td id="<?php echo 'nombre'?>"><?php echo $row['TipoTour']; ?></td>
                                    <td id="<?php echo 'nombre'?>"><?php echo $row['Cupos']; ?></td>
                                    <td>
                                      <a href="crud-tours.php?edit=<?php echo $row['id']?>" type="button" class="btn btn-secondary">Editar &nbsp<i class="fas fa-pen"></i></a>
                                      <!-- href="crud-tours.php?delete=<?php //echo $row['id']?>" -->
                                      <a href="crud-tours.php?delete=<?php echo $row['id']?>" type="button" class="btn btn-danger">Eliminar &nbsp<i class="fas fa-trash"></i></a>
                                    </td>
                              <?php endwhile;?>
                            </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- <script src="../js/jquery-3.4.1.min.js"></script> 
    <script src="../js/bootstrap.min.js"></script> -->                                                    <!-- SE ELIMINO POR CONFLICTO -->
    <script src="../js/crud-tours.js"></script>
    <script src="../js/sidebar.js"></script>
    <script src="../js/crud-tours-func.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js"></script>
</body>
</html>

<?php
  mysqli_close($conexion);
?>