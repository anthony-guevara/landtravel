<?php
require_once "../clases/conexion.php";
$obj= new conectar();
$conexion=$obj->conexion();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../vendors/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="../vendors/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="../vendors/themify-icons/themify-icons.css">


  <!-- datatable -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.min.css">


  <link rel="stylesheet" href="../css/ciudad.css">
  <link rel="stylesheet" href="../css/sidebar.css">


  <!-- datatable -->



  <!-- Sidebar recursos -->
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
  <!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css">


  <div id="wrapper" class="active  ">

    <!-- Sidebar -->
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
      <ul id="sidebar_menu" class="sidebar-nav">
           <li class="sidebar-brand"><a id="menu-toggle" href="#">Menu<span id="main_icon" class="fas fa-bars"></span></a></li>
      </ul>
        <ul class="sidebar-nav" id="sidebar">     
          <li><a href="rutas.php">Rutas<span class="sub_icon fas fa-route"></span></a></li>
          <li><a href="crud-tours.php">Tours<span class="sub_icon fas fa-plane"></span></a></li>
          <li><a href="tablaPais.php">Paises<span class="sub_icon fas fa-globe-americas"></span></a></li>
          <li><a href="lugaresTuristicos.php">Turísticos<span class="sub_icon fas fa-map-marked-alt"></span></a></li>
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



                    <!-- <table class="table  ">
                      <tr>
                        <th scope="col">Pais</th>
                        <th scope="col">Nombre Ciudad</th>
                        <th scope="col">Descripcion</th>
                      </tr>

                      </thead>
                      <tbody id="contenido-ciudades">


                      </tbody>
                    </table> -->

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


            <!-- /*modal editar ciudad*/ -->






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
                      <div class="row">
                        <div class="col-6" id="seleccionpais">
                          <label>Seleccione un pais</label> <select type="text" style="width:10em"
                            id="nombrePais"></select><br>
                        </div>
                        <div class="col-6">
                          <input type="text" id="nombreciudad" placeholder="Nombre Ciudad"><br>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-12">
                          <input type="text" id="descripcion" placeholder="Descripcion"><br>
                        </div>
                      </div>



                      <input type="text" id="idciudad" style="display:none;" placeholder="id">




                    </form>

                  </div>
                  <button type="button" class=" buttones" id="guardarciudad" onclick="cerrar()">Guardar<i
                      class="fas fa-save"></i></button>
                  <button type="button" class=" buttones" data-dismiss="modal">Cerrar<i
                      class="fas fa-window-close"></i></button>
                </div>
              </div>
            </div>
          </div>



          <!-- agregar  -->
          <div class="modal" id="modalnuevaciudad" tabindex="-1" role="dialog">
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
          </div>
        </div>

        <!--aqui termina el crud -->

      </div>
    </div>
  </div>
  </div>

  </div>


  <title>Ciudades</title>
</head>

<body>





  <!-- <table id="tabla-ciudades" class="table table-striped table-bordered display" style="width: 100%;">
    <thead class="thead-dark">
      <tr>
        <th>Nombre</th>
        <th>NombrePais</th>
        <th>Descripcion</th>
        <th>Opciones</th>
      </tr>
    </thead>
  </table> -->








  <script src="../js/jquery-3.4.1.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>

  <!-- datatable -->
  <!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js">
  </script> -->
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap4.min.js"></script>


  <script src="../js/tablaciudad.js"></script>
  <script src="../js/sidebar.js"></script>

</body>

</html>