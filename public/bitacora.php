
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
  <link rel="stylesheet" href="../css/vitacora.css">
  <link rel="stylesheet" href="../css/sidebar.css">

      

  
    <title>Bitacora</title>
</head>
<body>


    
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
        <li><a href="bitacora.php">Bitacora<span class="sub_icon fas fa-sign-out-alt"></span></a></li>
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
                <div class="col col-sm-12"  >
        
                <h1  class="colorletra" id="titulo" style="text-align: center; margin-top: 4px; margin-bottom:4rem; ">Vitacora</h1>
                </div>
                <div class="tableText col col-lg-12 col-md-12 col-sm-12" style="margin-top: 10em;">

                <table id="tabla-bitacora" class="table table-striped table-bordered dt-responsive nowrap"
                style="width: 100%;">
                <thead class="estilotarjeta">
                  <tr>
                    <th>Fecha</th>
                    <th>usuario</th>
                    <th>Descripcion</th>
                    
                  </tr>
                </thead>
              </table>

                </div>
              </div>
              
    <script src="../js/bitacora.js"></script>
    <script src="../js/sidebar.js"></script>
    
</body>
</html>