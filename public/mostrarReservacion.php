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
    <link rel="stylesheet" href="../css/mostrarpaquete.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>  
    <title>Comprar Paquete</title>
    <link href="https://fonts.googleapis.com/css?family=Courgette&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel="icon" href="../img/favicon.ico" type="image/png">
    
    
  <link rel="stylesheet" href="../vendors/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="../vendors/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="../vendors/themify-icons/themify-icons.css">
  <link rel="stylesheet" href="../vendors/linericon/style.css">
  <link rel="stylesheet" href="../vendors/owl-carousel/owl.theme.default.min.css">
  <link rel="stylesheet" href="../vendors/owl-carousel/owl.carousel.min.css">
  <link rel="stylesheet" href="../vendors/flat-icon/font/flaticon.css">
  <link rel="stylesheet" href="../vendors/nice-select/nice-select.css">
  <link rel="stylesheet" href="../css/style.css">

</head>

 <!--================ Header Menu Area start =================-->
 <header class="header_area">
    <div class="main_menu">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container box_1620">
          <a class="navbar-brand logo_h" href="index.html"><img src="../img/logo.png" style="width: 91px !important;" alt=""></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

          <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
            <ul class="nav navbar-nav menu_nav justify-content-end">
              <li class="nav-item active"><a class="nav-link" href="home-cliente.php">Inicio</a></li> 
              <li class="nav-item"><a class="nav-link" href="mostrarpaquetes.php">paquetes turisticos</a>
              <li class="nav-item"><a class="nav-link" href="infoServiCliente.php">Ayuda</a></li> 
                    
              <li class="nav-item"><a class="nav-link" href="mostrarReservacion.php">Reservaciones</a></li> 
              <li class="nav-item"><a class="nav-link" href="403.php">Contactos</a></li>
            </ul>

            <div class="nav-right text-center text-lg-right py-4 py-lg-0">
              <a class="button" href="login.php">Inicio de sesion</a>
            </div>
          </div> 
        </div>
      </nav>
    </div>
  </header>
  <!--================Header Menu Area =================-->
<body background="../img/jardin.jpg">

<div style="background-color: rgba(0, 0, 0, 0.521); padding:2em   ;height: 100%;width: 100vw;">
    <div style="background-color: rgba(255, 255, 255, 0.911);
    width: 90%;
    margin: auto;border-radius: 10px;margin-top: 65px;">
      <h1  id="titulo" style="text-align: center;">Paquetes Turisticos</h1>
 
<div id="paquetes-mostrar"class="container ">

    <!--------------->
    <?php 
			$sql="select tou.idtour,nombre,round(sum(precio),2) total,hot.descripcion,transp.descripcion,ttransp.Descripcion,tou.fecha_inicio,date_add(tou.fecha_inicio, interval rut.c_noches day) fecha_fin, ttour.descripcion from tour tou
      inner join ruta rut on rut.idtour=tou.idtour
      inner join paquete_hotel paq on paq.idpaquete_hotel=rut.idpaquete
      inner join hotel hot on hot.idhotel=paq.idpaquete_hotel
      inner join ruta_has_transporte rht on rht.ruta_idruta=rut.idruta
      inner join transporte transp on transp.idtransporte=rht.transporte_idtransporte
      inner join tipo_transporte ttransp on ttransp.idTipo_transporte=transp.idtransporte
      inner join tipo_tour ttour on ttour.idtipo_tour=tou.idtipo_tour
      group by idtour
            ;";
			$conexion=$obj->conexion();
      $result=mysqli_query($conexion,$sql);
			while ($mostrar=mysqli_fetch_row($result)) {
				?>
<div class="row">
      <div class="col-7 col-lg-5" style="width: 18rem;">
        <p class="card-text card-title" style="margin-left: 63px;"><?php echo $mostrar[1]?></p>
          <img src="../img/vuelo.png" class="card-img-top" alt="...">
          <div class="card-body">
            <p class="card-text"></p>
          </div>
        </div>

      <div class="col-5 col-lg-5"><label><b>Precio L.<?php echo $mostrar[2] ?></b></label><br>
        <label><b>Tipo de Tour:</b> <?php echo $mostrar[8] ?> </label><br>
        <label><b>Hotel:</b> <?php echo $mostrar[3] ?></label><br>
        <label><b>Transporte:</b> <?php echo $mostrar[4] ?>-<?php echo $mostrar[5] ?></label><br>
        <label><b>Fecha Inicio:</b> <?php echo $mostrar[6] ?></label><br>
        <label><b>Fecha Fin:</b> <?php echo $mostrar[7] ?></label><br>
        <div  class="col-2 col-lg-4 colcomprar-off"><button onclick="verificarsesion(<?php echo $mostrar[0] ?>)" class=" btnestilos btn btn-lg" >Comprar</button></div></div>
      <div  class="col-2 col-lg-2 colcomprar"><button onclick="verificarsesion(<?php echo $mostrar[0] ?>)" class=" btnestilos btn btn-lg" >Comprar</button></div>
  </div>
<?php 
			}
			mysqli_close($conexion);
			?>
  <!------------------->

    </div>
  </div>
  
                </div>
                </div>          



                <div class="modal fade" tabindex="-1" role="dialog" id="modalComprar">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Iniciar sesion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                       <label> <i class="fas fa-user"></i> Usuario</label><input onkeyup="validarVacio('comprar-usuario')" id="comprar-usuario"  class="form-control spaceform"type="text" placeholder="Ingresa usuario">
                       <div id="Error-comprar-usuario" class="error-vacio" style="display:none">¡Información de usuario vacia!</div>
                        <label><i class="fas fa-key"></i> Contraseña</label><input onkeyup="validarVacio('comprar-password')" id="comprar-password"  class="form-control" type="text" placeholder="Password">
                        <div id="Error-comprar-password" class="error-vacio" style="display:none">¡Contraseña vacia!</div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-success" onclick="redirigir()">Iniciar Sesión</button>
                      </div>
                    </div>
                  </div>
                </div>
</body>
<script src="../js/mostrarreservar.js"></script>

<script src="../vendors/jquery/jquery-3.2.1.min.js"></script>
  <script src="../vendors/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="../vendors/owl-carousel/owl.carousel.min.js"></script>
  <script src="../vendors/nice-select/jquery.nice-select.min.js"></script>
  <script src="../js/jquery.ajaxchimp.min.js"></script>
  <script src="../js/mail-script.js"></script>
  <script src="../js/skrollr.min.js"></script>
  <script src="../js/main.js"></script>
</html>
