<?php
require_once "../clases/conexion.php";
$obj= new conectar();
$conexion=$obj->conexion();
session_start(); 
if(isset($_SESSION["tipo"])) {
if (($_SESSION["tipo"]=="Admin"))
  header("Location: Tours.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>


  <meta charset="UTF-8">
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>LandTravel</title>

  <!-- <link rel="manifest" href="../manifest.json" /> -->
  <meta name="viewport" content="width=device-width, user-scalable=no" />
  <link rel="manifest" href="../manifest.json" />

  <link rel="apple-touch-icon" href="../img/logo.png">
  <meta name="apple-mobile-web-app-status-bar" content="#FFE1C4">
  <meta name="theme-color" content="#FFE1C4">
  <script src="app.js"></script>


  <link rel="icon" href="../img/favicon.ico" type="image/png">
  <link rel="stylesheet" href="../vendors/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="../vendors/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="../vendors/themify-icons/themify-icons.css">
  <link rel="stylesheet" href="../vendors/linericon/style.css">
  <link rel="stylesheet" href="../vendors/owl-carousel/owl.theme.default.min.css">
  <link rel="stylesheet" href="../vendors/owl-carousel/owl.carousel.min.css">
  <link rel="stylesheet" href="../vendors/flat-icon/font/flaticon.css">
  <link rel="stylesheet" href="../vendors/nice-select/nice-select.css">
  <link rel="stylesheet" href="../css/header.css">



</head>

<body class="bg-shape">

  <!--================ Header Menu Area start =================-->
  <header class="header_area">
    <div class="main_menu">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container box_1620">
          <a class="navbar-brand logo_h" href="index.php"><img src="../img/logo.png" style="width: 120px;" alt=""></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

          <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
            <ul class="nav navbar-nav menu_nav justify-content-end">
              <li class="nav-item active"><a class="nav-link" href="index.php">Inicio</a></li>



              <?php 
              if(isset($_SESSION["tipo"])){
              $usr=$_SESSION['usuario'];
              $sql="select tipo_usuario from usuario usu
        inner join persona per on per.usuario_id=usu.id
        where email='$usr'";
        $result=mysqli_query($conexion,$sql);
        $mostrar=mysqli_fetch_row($result);


        
          if($mostrar[0]=="Guia"){
      ?>
              <li class="nav-item"><a class="nav-link negro" href="guiascontrato.php">Contrato</a></li>
              <li class="nav-item"><a class="nav-link negro cwhite" href="visualizarrutas.php">Rutas Asignadas</a></li>
              <li class="nav-item"><a class="nav-link negro cwhite" href="historial-rutas.php">Historial de Rutas</a>
              </li>
              <li class="nav-item"><a class="nav-link negro cwhite" href="mensual.php">Pago Mensual</a></li>
              <?php
          }else{?>
              <li class="nav-item"><a class="nav-link negro" href="mostrarpaquetes.php">paquetes turisticos</a>
              <li class="nav-item"><a class="nav-link negro" href="historial.php">Historial</a></li>
              <li class="nav-item"><a class="nav-link negro" href="Contactos.php">Contactos</a></li>
              <?php
          }
        
    ?>
              <?php 
				  
              if(isset($_SESSION["usuario"])){
				  ?>
              <li class="nav-item"><a class="nav-link negro" href="logout.php">Salir</a></li>
            </ul>

            <div class="nav-right text-center text-lg-right py-4 py-lg-0">
              <a class="button" href="#">
                <?php
				  $usr=$_SESSION['usuario'];
				  
				            $sql="select pnombre,papellido from usuario usu
							inner join persona per on per.usuario_id=usu.id
							where email='$usr'";
              	$result=mysqli_query($conexion,$sql);
			          while ($mostrar=mysqli_fetch_row($result)) {

								echo $mostrar[0]." ".$mostrar[1];
			}
		}
			else{
				?>


                <?php
			}
      mysqli_close($conexion);
      }else{?>

                <li class="nav-item"><a class="nav-link negro" href="mostrarpaquetes.php">paquetes turisticos</a>
                  </ul>
                  <div class="nav-right text-center text-lg-right py-4 py-lg-0">
                    <a class="button" href="login.php"> Iniciar Sesión
                    </a>
                </li><?php
      }
			?>
              </a></li>
              </a>
            </div>
          </div>
        </div>
      </nav>
    </div>
  </header>
  <!--================Header Menu Area =================-->