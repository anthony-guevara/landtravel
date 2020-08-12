<?php 
  require_once "../clases/conexion.php";
  $obj= new conectar();
  $conexion=$obj->conexion();

  // header('Content-Type: text/html; charset=utf-8');
  // function utf8_for_xml($string)
  // {
  //   return preg_replace('/[^\x{0009}\x{000a}\x{000d}\x{0020}-\x{D7FF}\x{E000}-\x{FFFD}]+/u',
  //                       ' ', $string);
  // }

  include_once("../bd/config.php");                                                                       //OBTENER DATOS DE DB
  include_once("../bd/conexion_mysqli.php");
  $connexionMysqli = new ConnexionMysqli();
  $mysqli =  $connexionMysqli->connect();
  $mysqli->set_charset("utf8");
  $result = $mysqli->query("SELECT r.id,
                                    v.titulo as viaje,
                                    m.nombre as metodo,
                                    r.paquete_id,
                                    t.nombre AS tour,
                                    i.nombre AS inicio,
                                    d.nombre AS destino,
                                    r.fecha_llegada, r.fecha_salida,
                                    l.nombre AS lugar,
                                    concat(p.pnombre,' ', p.papellido) AS guia,
                                    r.costo
                            FROM  ruta    AS r,
                                  viaje   AS v,
                                  metodo  AS m,
                                  tour    AS t,
                                  destino as i,
                                  destino AS d,
                                  lugar   AS l,
                                  guia    AS g,
                                  persona AS p
                            WHERE	r.viaje_id  = v.id
                            AND		r.metodo_id = m.id
                            AND		r.tour_id   = t.id
                            AND		r.inicio    = i.id
                            AND		r.destino   = d.id
                            AND		r.idlugar   = l.id
                            AND		r.idguia    = g.id
                            AND		g.persona_id = p.id") or die ($mysqli->error);

  // pre_r($result);
  
  // pre_r($result->fetch_assoc());

  function pre_r($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../img/favicon.ico" type="image/png">
  <!-- <link rel="stylesheet" href="../vendors/bootstrap/bootstrap.min.css"> -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css">   <!-- CAMBIO A BOOTSTRAP v4 -->
  <link rel="stylesheet" href="../vendors/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="../vendors/themify-icons/themify-icons.css">
  <link rel="stylesheet" href="../vendors/linericon/style.css">
  <link rel="stylesheet" href="../vendors/owl-carousel/owl.theme.default.min.css">
  <link rel="stylesheet" href="../vendors/owl-carousel/owl.carousel.min.css">
  <link rel="stylesheet" href="../vendors/flat-icon/font/flaticon.css">
  <link rel="stylesheet" href="../vendors/nice-select/nice-select.css">
  <link rel="stylesheet" href="../css/lugaresturisticos.css">
  <link rel="stylesheet" href="../css/sidebar.css">
  <link rel="stylesheet" href="../css/crud-tours-rutas.css">
</head>
<body>
    <div id="wrapper" class="active">
      <!-- Sidebar -->
      <div id="sidebar-wrapper">
        <ul id="sidebar_menu" class="sidebar-nav">
          <li class="sidebar-brand"><a id="menu-toggle" href="#">Menu<span id="main_icon" class="fas fa-bars"></span></a></li>
        </ul>
        <ul class="sidebar-nav" id="sidebar">     
          <li><a href="crud-tours.php">Tours<span class="sub_icon fas fa-plane"></span></a></li>
          <li><a href="tablaciudad.php">Ciudad<span class="sub_icon fas fa-hotel"></span></a></li>
          <li><a href="lugaresTuristicos.php">Turísticos<span class="sub_icon fas fa-map-marked-alt"></span></a></li>
          <li><a href="tablaPais.php">Paises<span class="sub_icon fas fa-globe-americas"></span></a></li>
          <li><a href="Tours.php">Salir<span class="sub_icon fas fa-sign-out-alt"></span></a></li>
        </ul>
      </div>      
      <!-- Page content -->
      <div id="page-content-wrapper">
        <!-- Keep all page content within the page-content inset div! -->
        <div class="page-content inset">
          <div class="row">
            <div class="col-md-12">
              <!--aqui va todo el crud -->    
              <div class="" style="">
                <div class="row">
                  <div class="col col-sm-12">
                      <h1 id="titulo" style="text-align: center; margin-top: 3%; margin-bottom:2%;">Gestión de Rutas</h1>
                      <br>
                    <div class="col col-lg-12 col-md-12 col-sm-12">
                      <form class="form-inline" style="justify-content: flex-end; margin-bottom: 0px;">
                        <div class="form-group mx-sm-3 mb-2">
                          <input class="form-control" placeholder="Buscar">
                        </div>
                        <button type="button" class="btn btn-primary mb-2" style="background-color: #e65b02; border-color: #e65b02;" data-toggle="modal" data-target="#modalAdd">Agregar &nbsp; <i class="fas fa-plus"></i></button>
                      </form>
                      <div class="row justify-content-end">
                        <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                              <form action="../ajax/crud-tours.php" method="POST"> <!-- Formulario para agregar tours -->
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Agregar Rutas</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              </div>
                              <div class="modal-body">
                                  <div class="form-row">
                                    <div class="form-group col-md-4">
                                      <label class="d-flex justify-content-start">Nombre</label>
                                      <input type="hidden" name="id" value="">
                                      <input class="form-control"  placeholder="nombre x" name="NOMBRE" value="">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="d-flex justify-content-start">Costo</label>
                                        <input class="form-control" placeholder="###" type="number" name="COSTO" value="">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="d-flex justify-content-start">Cupos</label>
                                        <input class="form-control"  placeholder="###" type="number" name="Cupos" value="">
                                    </div>
                                  </div>
                                  <div class="form-row">
                                    <div class="form-group col-md-4">
                                      <label class="d-flex justify-content-start">Tipo tour</label>
                                      <select class="custom-select" name="TipoTour">
                                        <option value="Familiar" value="" name="Familiar">Familiar</option>
                                        <option value="Individual" value="" name="Individual">Individual</option>
                                      </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                      <label class="d-flex justify-content-start">Fecha inicio</label>
                                      <input type="date" class="form-control"  placeholder="nombre x" name="fecha_inicio" value="">
                                    </div>
                                    <div class="form-group col-md-4">
                                      <label class="d-flex justify-content-start">Fecha fin</label>
                                      <input type="date" class="form-control"  placeholder="nombre x" name="fecha_salida" value="">
                                    </div>
                                  </div>
                                  <div class="form-row">
                                    <div class="form-group col-md-4">
                                      <label class="d-flex justify-content-start">Nombre</label>
                                      <input type="hidden" name="id" value="<?php echo $id;?>">
                                      <input class="form-control"  placeholder="nombre x" name="NOMBRE" 
                                                  value="<?php echo $NOMBRE;?>">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="d-flex justify-content-start">Costo</label>
                                        <input class="form-control" placeholder="###" type="number" name="COSTO" 
                                              value="<?php echo $COSTO;?>">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="d-flex justify-content-start">Cupos</label>
                                        <input class="form-control"  placeholder="###" type="number" name="Cupos" 
                                              value="<?php echo $Cupos;?>">
                                    </div>
                                  </div>
                              </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn org-btn-drk"   data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn org-btn" style="background-color:#e65b02" name="update">Actualizar</button>
                                  </div>
                                </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tableText col col-lg-12 col-md-12 col-sm-12">
                      <table class="table table-striped bordeado"> 
                        <thead class="estilotarjeta" style="background: linear-gradient(90deg, rgba(230,91,2,1) 16%, rgba(180,70,0,1) 40%, rgba(94,37,0,1) 90%) !important;">
                          <tr>
                            <th style="text-align: center !important;">Ruta</th>
                            <th style="text-align: center !important;">Viaje</th>
                            <th style="text-align: center !important;">Metodo</th>
                            <th style="text-align: center !important;">Paquete</th>
                            <th style="text-align: center !important;">Tour</th>
                            <th style="text-align: center !important;">Origen</th>
                            <th style="text-align: center !important;">Destino</th>
                            <th style="text-align: center !important;">Llegada</th>
                            <th style="text-align: center !important;">Salida</th>
                            <th style="text-align: center !important;">Lugar</th>
                            <th style="text-align: center !important;">Guia</th>
                            <th style="text-align: center !important;">Costo</th>
                            <th style="text-align: center !important;">Acción</th>
                          </tr>
                        </thead>
                        <tbody id="tabla-rutas" class="contenido-rutas">      
                          <!-- AGREGAR DATOS DE TABLA FORMA DINAMICA -->
                          <?php 
                            while($row = $result->fetch_assoc()):
                          ?>
                            <tr>
                              <td id=""><?php echo $row['id'];?></td>
                              <td id=""><?php echo $row['viaje'];?></td>
                              <td id=""><?php echo $row['metodo'];?></td>
                              <td id=""><?php echo $row['paquete_id'];?></td>
                              <td id=""><?php echo $row['tour'];?></td>
                              <td id=""><?php echo $row['inicio'];?></td>
                              <td id=""><?php echo $row['destino'];?></td>
                              <td id=""><?php echo $row['fecha_llegada'];?></td>
                              <td id=""><?php echo $row['fecha_salida'];?></td>
                              <td id=""><?php echo $row['lugar'];?></td>
                              <td id=""><?php echo $row['guia'];?></td>
                              <td id=""><?php echo $row['costo'];?></td>
                              <td>
                                <a href="" type="button" class="btn org-btn btn-rutas" style="margin-bottom: 6px;">Editar &nbsp<i class="fas fa-pen"></i></a>
                                <a href="" type="button" class="btn org-btn-drk btn-rutas">Eliminar &nbsp<i class="fas fa-trash"></i></a>
                              </td>
                            </tr>
                          <?php 
                            endwhile;
                          ?>
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
  <script src="../js/jquery-3.4.1.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/rutas.js"></script>
  <script src="../js/sidebar.js"></script>  
</body>
</html>

<?php
  mysqli_close($conexion);
?>