<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<?php

include_once('seguridad_admin.php');

  require_once "../clases/conexion.php";
  require_once "../ajax/crud-rutas.php";

  $obj= new conectar();
  $conexion=$obj->conexion();

  

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
                            AND		g.persona_id = p.id") or die($mysqli->error);

  $rtours=$mysqli->query("SELECT	id AS tour_id,
                                  nombre AS tours
                          FROM    tour") or die($mysqli->error);

  $rviajes = $mysqli->query("SELECT	id AS viaje_id, 
                                    titulo AS viaje
                            FROM	  viaje") or die($mysqli->error);
  
  $rmet = $mysqli->query("SELECT  id AS met,
                                  nombre AS metodo
                          FROM    metodo") or die($mysqli->error);

  $ror = $mysqli->query("SELECT	id AS id_or,
                                nombre AS origen
                         FROM   destino") or die($mysqli->error);
  $rdes = $mysqli->query("SELECT	id AS id_or,
                                nombre AS origen
                         FROM   destino") or die($mysqli->error);

  $rlug = $mysqli->query("SELECT  id AS id_lug,
                                  nombre AS lugares
                          FROM    lugar") or die($mysqli->error);

  $rguia = $mysqli->query("SELECT g.id AS id_guia,
                                  concat(p.pnombre,' ',p.papellido) AS guia
                          FROM	  guia AS g, 
                                  persona AS p
                          WHERE	  g.persona_id = p.id") or die($mysqli->error);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Rutas</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../img/favicon.ico" type="image/png">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css">   <!-- CAMBIO A BOOTSTRAP v4 -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
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
          <li><a href="bitacora.php">Bitacora<span class="sub_icon fas fa-clipboard-check"></span></a></li>
          <li><a href="Tours.php">Salir<span class="sub_icon fas fa-sign-out-alt"></span></a></li>
        </ul>
      </div>      
      <!-- Page content -->
      <div id="page-content-wrapper">
        <!-- Keep all page content within the page-content inset div! -->
        <div class="page-content inset" style="margin-bottom: 50px !important;">
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
                        <button type="button" class="btn btn-primary mb-2" style="background-color: #e65b02; border-color: #e65b02; margin-right: 16px; width: 174px;" data-toggle="modal" data-target="#modalAddRutas">Agregar &nbsp; <i class="fas fa-plus"></i></button>
                      </form>
                      <div class="row justify-content-end">
                        <div class="modal fade" id="modalAddRutas" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                          <div class="modal-dialog modales modal-lg" role="document">
                            <div class="modal-content">
                              <form action="../ajax/crud-rutas.php" method="POST"> <!-- Formulario para agregar tours -->
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                              <div class="modal-header">
                                <?php if ($actualizar==true):?>
                                  <h5 class="modal-title" id="exampleModalLabel">Actualizar Ruta</h5>
                                <?php else: ?>
                                  <h5 class="modal-title" id="exampleModalLabel">Agregar Ruta</h5>
                                <?php endif; ?>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              </div>
                              <div class="modal-body">
                                  <div class="form-row">
                                    <div class="form-group col-md-4">
                                      <label class="d-flex justify-content-start">Viaje</label>
                                      <select class="custom-select" id="s-viaje" name="viaje_id">
                                        <option value="" name="">-- --</option>
                                        <?php while ($rowv = $rviajes->fetch_assoc()):?>
                                          <option value="<?php echo $rowv['viaje_id'];?>" name=""><?php echo $rowv['viaje'];?></option>
                                        <?php endwhile;?>
                                      </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="d-flex justify-content-start">Metodo</label>
                                        <select class="custom-select" id="s-metodo" name="metodo_id">
                                          <option value="" name="">-- --</option>
                                          <?php while ($rowm = $rmet->fetch_assoc()):?>
                                            <option value="<?php echo $rowm['met'];?>" name=""><?php echo $rowm['metodo'];?></option>
                                          <?php endwhile;?>
                                      </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="d-flex justify-content-start">Paquete</label>
                                        <input class="form-control"  placeholder="1" name="paquete" value="1" disabled="disabled">
                                    </div>
                                  </div>
                                  <div class="form-row">
                                    <div class="form-group col-md-4">
                                      <label class="d-flex justify-content-start">Tour</label>
                                      <select class="custom-select" id="s-tour" name="tour_id">
                                        <option value="" name="">-- --</option>
                                        <?php while ($rowt = $rtours->fetch_assoc()):?>
                                          <option value="<?php echo $rowt['tour_id'];?>"><?php echo $rowt['tours'];?></option>
                                        <?php endwhile;?>
                                      </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                      <label class="d-flex justify-content-start">Origen</label>
                                      <select class="custom-select" id="s-origen" name="inicio">
                                        <option value="" name="">-- --</option>
                                        <?php while ($rowr = $ror->fetch_assoc()):?>
                                          <option value="<?php echo $rowr['id_or'];?>"><?php echo $rowr['origen'];?></option>
                                        <?php endwhile;?>
                                      </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                      <label class="d-flex justify-content-start">Destino</label>
                                      <select class="custom-select" id="s-destino" name="destino">
                                        <option value="" name="">-- --</option>
                                        <?php while ($rowd = $rdes->fetch_assoc()):?>
                                          <option value="<?php echo $rowd['id_or'];?>"><?php echo $rowd['origen'];?></option>
                                        <?php endwhile;?>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="form-row">
                                    <div class="form-group col-md-4">
                                      <label class="d-flex justify-content-start">Fecha Llegada</label>
                                      <input type="date" class="form-control" id="fecha_llegada" value="" name="fecha_llegada">
                                    </div>
                                    <div class="form-group col-md-4">
                                      <label class="d-flex justify-content-start">Fecha Salida</label>
                                      <input type="date" class="form-control" id="fecha_salida" value="" name="fecha_salida">
                                    </div>
                                    <div class="form-group col-md-4">
                                      <label class="d-flex justify-content-start">Lugar</label>
                                      <select class="custom-select" id="s-lugar" name="idlugar">
                                        <option value="" name="">-- --</option>
                                        <?php while ($rowl = $rlug->fetch_assoc()):?>
                                          <option value="<?php echo $rowl['id_lug'];?>"><?php echo $rowl['lugares'];?></option>
                                        <?php endwhile;?>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="form-row" style="justify-content: space-evenly;">
                                    <div class="form-group col-md-4">
                                      <label class="d-flex justify-content-start">Guia</label>
                                      <select class="custom-select" id="s-guia" name="idguia">
                                        <option value="" name="">-- --</option>
                                        <?php while ($rowl = $rguia->fetch_assoc()):?>
                                          <option value="<?php echo $rowl['id_guia'];?>"><?php echo $rowl['guia'];?></option>
                                        <?php endwhile;?>
                                      </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="d-flex justify-content-start">Costo</label>
                                        <input class="form-control" placeholder="###" type="number" id="COSTO" name="COSTO">
                                    </div>
                                  </div>
                              </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn org-btn-drk"   data-dismiss="modal">Cancelar</button>
                                    <?php
                                      if ($actualizar==true):
                                    ?>
                                      <button type="submit" class="btn org-btn" style="background-color:#e65b02" name="update">Actualizar</button>
                                    <?php
                                      else:
                                    ?>
                                      <button type="submit" class="btn org-btn" style="background-color:#e65b02" name="save">Guardar</button>
                                    <?php
                                      endif;
                                    ?>
                                  </div>
                                </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tableText col col-lg-12 col-md-12 col-sm-12">
                      <table class="table table-striped bordeado" id="tb-rutas"> 
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
                            while ($row = $result->fetch_assoc()):
                          ?>
                            <tr>
                              <td id="" value=""><?php echo $row['id'];?></td>
                              <td id="" value=""><?php echo $row['viaje'];?></td>
                              <td id="" value=""><?php echo $row['metodo'];?></td>
                              <td id="" value=""><?php echo $row['paquete_id'];?></td>
                              <td id="" value=""><?php echo $row['tour'];?></td>
                              <td id="" value=""><?php echo $row['inicio'];?></td>
                              <td id="" value=""><?php echo $row['destino'];?></td>
                              <td id="" value=""><?php echo $row['fecha_llegada'];?></td>
                              <td id="" value=""><?php echo $row['fecha_salida'];?></td>
                              <td id="" value=""><?php echo $row['lugar'];?></td>
                              <td id="" value=""><?php echo $row['guia'];?></td>
                              <td id="" value=""><?php echo $row['costo'];?></td>
                              <td>
                                <a href="rutas.php?edit=<?php echo $row['id'];?>" type="button" class="btn org-btn btn-rutas" style="margin-bottom: 15px;">Editar &nbsp<i class="fas fa-pen"></i></a>
                                <a href="rutas.php?delete=<?php echo $row['id']?>" type="button" class="btn org-btn-drk btn-rutas">Eliminar &nbsp<i class="fas fa-trash"></i></a>
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
  <!-- <script src="../js/jquery-3.4.1.min.js"></script>
  <script src="../js/bootstrap.min.js"></script> -->
  <!-- <script src="../js/rutas.js"></script> -->
<script>
  $(document).ready(function() {
    $('#tb-rutas').DataTable();
} );
</script>
  <script src="../js/sidebar.js"></script>  
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js"></script>
  
</body>
</html>

<?php
  mysqli_close($conexion);
?>