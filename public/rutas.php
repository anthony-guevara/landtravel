
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
    <link rel="stylesheet" href="../css/lugaresturisticos.css">
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
           <li class="sidebar-brand"><a id="menu-toggle" href="#">Menu<span id="main_icon" class="glyphicon glyphicon-align-justify"></span></a></li>
      </ul>
        <ul class="sidebar-nav" id="sidebar">     
          <li><a href="crud-tours.php">Tours<span class="sub_icon glyphicon glyphicon-wrench"></span></a></li>
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
            <h1 id="titulo" style="text-align: center; margin-top: 4px; margin-bottom:4rem;">Rutas</h1>
            <div class="tableText col col-lg-12 col-md-12 col-sm-12">
              <table class="table "> 
                <thead class="thead-dark">
  
                  <tr>
                    <th scope="col">Costo</th>
                    <th scope="col">Destino</th>
                    <th scope="col">Fecha Llegada</th>
                    <th scope="col">Fecha Salida</th>
                    <th scope="col">Inicio</th>
                  </tr>
  
                </thead>
                <tbody id="contenido-rutas">

  
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
  
    

<!-- modal editar rutas -->
      <div class="modal" id="modallugar" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Editar Lugar Turisticos</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
              <form id="informacionlugar">
                <div class="row">
                    <div class="col-6">
                            <input  type="text" id="nombreciudad" placeholder="Nombre Ciudad"><br>
                    </div>
                    <div class="col-6">
                            <input  type="text" id="lugar" placeholder="Lugar Turisticos"><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                            <input  type="text" id="Descripcion" placeholder="Descripcion"><br>
                    </div>
                </div>
                
  
                                
                <input  type="text" id="idlugar" style="display:none;" placeholder="id">
              
                    
                  
               
            </form>
  
            </div>
              <button type="button" class=" buttones" id="guardarLugar"  onclick="cerrar()">Guardar<i class="fas fa-save"></i></button>
              <button type="button" class=" buttones" data-dismiss="modal">Cerrar<i class="fas fa-window-close"></i></button>
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



    <title>Rutas</title>
</head>
<body>


   






      <script src="../js/jquery-3.4.1.min.js"></script>
      <script src="../js/bootstrap.min.js"></script>
      <script src="../js/rutas.js"></script>
      <script src="../js/sidebar.js"></script>
  
</body>
</html>