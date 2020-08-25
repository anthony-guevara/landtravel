<?php

include_once('seguridad_admin.php');

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../vendors/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../vendors/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="../css/ciudad.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <!-- <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
    <!-- <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css">
    <title>Ciudades</title>
  </head>
    <body>
      <div id="wrapper" class="active  ">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
          <ul id="sidebar_menu" class="sidebar-nav">
            <li class="sidebar-brand"><a id="menu-toggle" href="#">Menu<span id="main_icon" class="fas fa-bars"></span></a></li>
          </ul>
          <ul class="sidebar-nav" id="sidebar">     
            <li><a href="rutas.php">Rutas<span class="sub_icon fas fa-route"></span></a></li>
            <li><a href="crud-tours.php">Tours<span class="sub_icon fas fa-plane"></span></a></li>
            <li><a href="tablaPais.php">Paises<span class="sub_icon fas fa-globe-americas"></span></a></li>
            <li><a href="lugaresturisticos.php">Turísticos<span class="sub_icon fas fa-map-marked-alt"></span></a></li>
            <li><a href="bitacora.php">Bitacora<span class="sub_icon fas fa-clipboard-check"></span></a></li>
            <li><a href="Tours.php">Salir<span class="sub_icon fas fa-sign-out-alt"></span></a></li>
          </ul>
        </div> 
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
                  <div class="col-md-12">
                    <!--aqui va todo el crud -->
                    <div class="container" style="text-align:center">
                      <div class="row">
                        <div class="col col-sm-12">
                          <h1 id="titulo" class="titulo" style="text-align: center; margin-top: 3%; margin-bottom:2%;"> Gestion Ciudades</h1>
                          <div class="tableText col col-lg-12 col-md-12 col-sm-12">
                            <form class="agg-estilo" style="">
                              <button type="button" onclick="GenerarPaises()" data-toggle="modal" data-target="#modalnuevaciudad" class=" btn org-btn mb-2" id="agregarciudad" style="width: 176px; padding-right: 42px;">Agregar &nbsp; <i class="fas fa-plus"></i></button> </h1>
                            </form>  
                            <table id="tabla-ciudades" class="table table-striped table-bordered dt-responsive nowrap"
                              style="width: 100%;">
                              <thead class="estilotarjeta">
                                <tr>
                                  <th>Nombre</th>
                                  <th>País</th>
                                  <th>Descripcion</th>
                                  <th>Opciones</th>
                                </tr>
                              </thead>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- ------------------------------ MODAL EDITAR CIUDAD ---------------------------------------------- -->
                    <div class="modal" id="modalciudad" tabindex="-1" role="dialog">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Editar Ciudad</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form id="informaciondestino">
                              <div class="form-row">
                                <div class="form-group col-md-6" id="seleccionpais">
                                  <label class="d-flex justify-content-start">Seleccione un país</label>
                                  <select class="custom-select" id="nombrePais">
                                    <option>-- --</option>
                                  </select>
                                </div>
                                <div class="form-group col-md-6">
                                  <label class="d-flex justify-content-start">Nombre Ciudad</label>
                                  <input type="text" class="form-control" id="nombreciudad" placeholder="Ciudad x">
                                </div>
                                <input type="hidden" id="idciudad" placeholder="id">
                              </div>
                              <div class="form-row">
                                <div class="form-group col-md-12">
                                  <label class="d-flex justify-content-start">Descripcion</label>
                                  <input type="text" class="form-control" id="descripcion" placeholder="Escriba aqui la descripcion">
                                </div>
                              </div>
                            </form>
                            <div class="modal-footer">
                              <button type="button" class="btn org-btn" id="guardarciudad" onclick="cerrar()">Guardar &nbsp <i class="fas fa-save"></i></button>
                              <button type="button" class="btn org-btn-drk" data-dismiss="modal">Cerrar &nbsp <i class="fas fa-window-close"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- NUEVO MODAL -->
                    <div class="modal" id="modalnuevaciudad"  tabindex="-1" role="dialog">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Agregar Ciudad</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form id="informacionnuevodestino">
                                <div class="form-row">
                                  <div class="form-group col-md-4" id="seleccionpais">
                                    <label class="d-flex justify-content-start">Seleccione un país</label>
                                    <select class="custom-select" id="listapaises">
                                      <option>-- --</option>
                                    </select>
                                  </div>
                                  <div class="form-group col-md-4">
                                    <label class="d-flex justify-content-start">Nombre Ciudad</label>
                                    <input type="text" class="form-control" id="nombrenuevaciudad" placeholder="Ciudad x">
                                  </div>
                                  <div class="form-group col-md-4">
                                    <label class="d-flex justify-content-start">Descripcion</label>
                                    <input type="text" class="form-control" id="descripcionnueva" placeholder="Escriba aqui la descripcion">
                                  </div>
                                  <input type="hidden" id="idciudad" placeholder="id">
                                </div>
                              </form>
                              <div class="modal-footer">
                                <button type="button" class="btn org-btn" id="guardarnuevaciudad" onclick="agregar()">Guardar &nbsp <i class="fas fa-save"></i></button>
                                <button type="button" class="btn org-btn-drk" data-dismiss="modal" onclick="cerrar()">Cerrar &nbsp <i class="fas fa-window-close"></i></button>
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>
                    <!--FIN NUEVO MODAL -->
                  </div>
                  <!--aqui termina el crud -->
                </div>
              </div>
            </div>
          </div>
        </div>
      <script src="../js/jquery-3.4.1.min.js"></script>                          
      <script src="../js/bootstrap.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
      <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
      <script src="https://cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap4.min.js"></script>
      <script src="../js/tablaciudad.js"></script>
      <script src="../js/sidebar.js"></script>
    </body>
</html>

<!-- ----------------------------------------------VIEJO MODAL AGG CIUDAD----------------------------------------- -->
<!-- <div class="modal" id="modalnuevaciudad" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agregar Ciudad</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="informacionnuevodestino">
          <div class="row">
            <div class="col-6" id="seleccionpais">
              <label>Seleccione un pais</label> <select type="text" style="width:10em"
                id="listapaises"></select><br> 
            </div>
            <div class="col-6">
              <input type="text" id="nombrenuevaciudad" placeholder="Nombre Ciudad"><br>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <input type="text" id="descripcionnueva" placeholder="Descripcion"><br>
            </div>
          </div>
          <input type="text" id="idciudad" style="display:none;" placeholder="id">
        </form>
      </div>
      <button type="button" class=" buttones" id="guardarnuevaciudad" onclick="agregar()">Guardar<i
          class="fas fa-save"></i></button>
      <button type="button" class=" buttones" data-dismiss="modal" onclick="cerrar()">Cerrar<i
          class="fas fa-window-close"></i></button>
    </div>
  </div>
</div> -->