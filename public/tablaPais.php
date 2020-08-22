
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


  <link rel="icon" href="../img/favicon.ico" type="image/png">
  <link rel="stylesheet" href="../vendors/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="../vendors/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="../vendors/themify-icons/themify-icons.css">
  <link rel="stylesheet" href="../vendors/linericon/style.css">
  <link rel="stylesheet" href="../vendors/owl-carousel/owl.theme.default.min.css">
  <link rel="stylesheet" href="../vendors/owl-carousel/owl.carousel.min.css">
  <link rel="stylesheet" href="../vendors/flat-icon/font/flaticon.css">
  <link rel="stylesheet" href="../vendors/nice-select/nice-select.css">
  <link rel="stylesheet" href="../css/tablaPais.css">
  <link rel="stylesheet" href="../css/sidebar.css">


  <!-- Sidebar recursos -->
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <div id="wrapper" class="active">
      
      <!-- Sidebar -->
            <!-- Sidebar -->
      <div id="sidebar-wrapper">
      <ul id="sidebar_menu" class="sidebar-nav">
           <li class="sidebar-brand"><a id="menu-toggle" href="#">Menu<span id="main_icon" class="fas fa-bars""></span></a></li>
      </ul>
        <ul class="sidebar-nav" id="sidebar">     
          <li><a href="rutas.php">Rutas<span class="sub_icon fas fa-route"></span></a></li>
          <li><a href="tablaciudad.php">Ciudad<span class="sub_icon fas fa-hotel"></span></a></li>
          <li><a href="crud-tours.php">Tours<span class="sub_icon fas fa-plane"></span></a></li>
          <li><a href="lugaresTuristicos.php">Turísticos<span class="sub_icon fas fa-map-marked-alt"></span></a></li>
          <li><a href="bitacora.php">Bitacora<span class="sub_icon fas fa-clipboard-check"></span></a></li>
          <li><a href="Tours.php">Salir<span class="sub_icon fas fa-sign-out-alt"></span></a></li>

        </ul>
      </div>
          
      <!-- Page content -->
      <div id="page-content-wrapper" class="fondo">
        <!-- Keep all page content within the page-content inset div! -->
        <div class="page-content inset">
          <div class="row">
              <div class="col-md-12">
              
                <!--aqui va todo el crud -->
                
                <div class="container" style="text-align:center">
      <div class="row">
        <div class="col col-sm-12">
          <h1  class="colorletra" id="titulo" style="text-align: center; margin-top: 4px; margin-bottom:4rem; "> Gestion Paises



         
        
                    <form class="form-inline" style="justify-content: flex-end; margin-bottom: 0px;margin-top:50px;">
          <button id="btpais" type="button" class=" btn btn-primary mb-2" onclick="nuevoPais()"     style="background-color: #e65b02; border-color: #e65b02;  width: 198px; margin-bottom:0px !important;" data-toggle="modal" data-target="#modalnuevopais"
                       id="agregarPais"><i class="fas fa-plus-circle"></i>Agregar</button>
                       </form>
        </h1>
          <div class="tableText col col-lg-12 col-md-12 col-sm-12">
          
            <!-- <table class="table fondotabla"  style="width:100%" > 
              <thead class="estilotarjeta" style="width:100%">

                <tr>
                  <th scope="col">Nombre</th>
                  <th scope="col">Gentilicio</th>
                  <th scope="col">Acciones</th>
                </tr>

              </thead>
              <tbody id="contenido-paises">


              </tbody>
            </table> -->



            <table id="tabla-paises" class="table table-striped table-bordered dt-responsive nowrap"
                      style="width: 100%;">
                      <thead class="estilotarjeta">
                        <tr>
                          <th>Nombre</th>
                          <th>Gentilicio</th>
                          <th>Opciones</th>
                        </tr>
                      </thead>
                    </table>




          </div>
        </div>
      </div>
    </div>



    <!-- /*modal editar pais*/ -->






    <div class="modal" id="modalpais" tabindex="-1" role="dialog">
      <div class="modal-dialog modales" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Editar Pais</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            
            <form id="informacionpais">
              <div class="row">
                  <div class="col-6">
                          <input  type="text" id="nombrePais" placeholder="Nombre Pais"><br>
                  </div>
                  <div class="col-6">
                          <input  type="text" id="gentilicio" placeholder="Gentilicio"><br>
                  </div>
              </div>
              <div class="row">
                  <div class="col-12">
                          <input  type="text" id="codigo" placeholder="Abreviatura"><br>
                  </div>
              </div>
              

                              
              <input  type="text" id="idpais" style="display:none;" placeholder="id">
            
                  
                
             
          </form>

          </div>
            <button type="button" class=" buttones" id="guardarpais"  onclick="cerrar()">Guardar<i class="fas fa-save"></i></button>
            <button type="button" class=" buttones" data-dismiss="modal">Cerrar<i class="fas fa-window-close"></i></button>
          </div>
        </div>
      </div>
    </div>







          <!-- agregar  -->
          <div class="modal  col col-sm-12  "  style="width:100%" id="modalnuevopais" tabindex="-1" role="dialog">
            <div class=" modal-dialog  modales" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Agregar pais</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">

                  <form id="informacionnuevopais">
                    <div class="row">
                      
                      <div class="col-6">
                        <input type="text" id="nombrepais" placeholder="nombrepais"><br>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <input type="text" id="Gentilicio" placeholder="Gentilicio"><br>
                      </div>
                    </div>



                    <input type="text" id="idciudad" style="display:none;" placeholder="id">




                  </form>

                </div>
                <button type="button" class=" buttones" id="guardarnuevopais" onclick="nuevoPais()">Guardar<i
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

  
  <title>Pais</title>
</head>

<body>

  
   
   


    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>



    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap4.min.js"></script>





    <script src="../js/tablaPais.js"></script>
    <script src="../js/sidebar.js"></script>

</body>

</html>