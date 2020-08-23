<?php

include_once('seguridad_admin.php');


require_once "../clases/conexion.php";
$obj= new conectar();
$conexion=$obj->conexion();



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Creacion Tours</title>
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/Creacion-Tours.css">
  <link rel="icon" type="image/png" href="../img/favicon.ico" />
</head>

<body>
  <a href="tours.php"><img id="imgatras" ; style="width:40px;  position: absolute;top:10px;left:30px;cursor:pointer;"
      src="../img/flecha_izquierda1.png" alt=""></a>
  <div id="imagenFondo" style="">
  </div>
  <nav class="navbar  navegacion" style="margin-top:2em">
    <div class="toggle">
      <i class="fa fa-bars menu" aria-hidden="true"></i>
    </div>
    <ul class="nav">
      <li class="nav-item naveup"> <a href="#">Administración</a>
      <ul class="nave">
            <li><a href="crud-tours.php">Mantenimiento</a></li>
          </ul>
        <ul class="nave">
          <li><a href="logout.php">Cerrar Sesión</a></li>
        </ul>
      </li>
      <li class="nav-item naveup"> <a href="#">Reportes</a>
        <ul class="nave">
          <li><a href="ReporteEmpleados.php">Reporte Empleados</a></li>
          <li><a href="ReporteTurista.php">Reporte de Turistas</a></li>
          <li><a href="ganancia.php">Reporte de Ganancias</a></li>
        </ul>
      </li>
      <li> <a style="color:orange;font-size='20px'" href="Tours.php">LANDTRAVEL</a></li>
      <li> <a href="VisualizarContratos.php">Visualizar Contratos</a></li>
      <li class="nav-item naveup"> <a href="#">Tours</a>
        <ul class="nave">
          <li><a href="creacion-tours.php">Agregar</a></li>
        </ul>
      </li>
    </ul>
  </nav>


  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

  <script type="text/javascript">
    $(document).ready(function () {
      $('.menu').click(function () {
        $('ul').toggleClass('active');

      })
    })
  </script>





  <div class="container">
    <form>
      <div class="row">

        <div class="col-12">
          <div class="box-create">
            <h2>Informaciòn de Tour</h2>
            <div id="linea"></div>
            <p>
              <label>Nombre</label><br>
              <input required name="Nombre" id="nombreTour" class="form-control" type="text"
                placeholder="Nombre del Tour">
              <div class="alert alert-danger" role="alert" style="display:none;" id="mensajeTour">
                Nombre de tour inválido
              </div>
            </p>
            <p>
              <label>Fecha de Inicio</label><br>
              <input required name="fecha" id="fechaInicio" class="form-control" type="date"
                placeholder="Nombre del Tour">
                <div class="alert alert-danger" role="alert" style="display:none;" id="mensajeFecha">
                Seleccione una fecha mayor a la actual
              </div>
            </p>
            <p>
              <label>Cupos</label><br>
              <input required onkeypress='return validaNumericos(event)' name="cupos" id="cupos" class="form-control"
                type="text" placeholder="#Número de Cupos">

              
            </p>
            <p>
              <label>Tipo Tour</label><br>
              <select required name="tipos" id="create-tipotour" class="form-control">
                <option value="null" disabled selected>Seleccione una opción</option>
                <option value="Individual">Individual</option>
                <option value="Familiar">Familiar</option>
              </select>
            </p>
            <button id="btncrear"
              style="margin-left: auto; margin-rith: auto;width: 150px;border-color: green;background-color: green !important;"
              type="button" class="btn btn-success">Crear Tour</button>
          </div>
        </div>
      </div>
  </div>
  </form>
  <script src="../js/jquery-3.4.1.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/creacion-tours.js"></script>
</body>

<footer>
  <div class="MD">
    <div class="contenedor container">
      <div class="row row1">
        <div class="col col-lg-6">
          <h6>
            <span style="margin-top: -10px;" id="name-logo">Land Travel</span>

          </h6>
        </div>
        <div class="col col-lg-6">
          <H6>
            CONTACTOS

          </H6>
        </div>
      </div>
      <div class="row ">
        <div class="col col-lg-4 col-md-6 col-sm-12">
          <img style="height: 140px;margin-left: 58px;" src="../img/logo.png" alt=""> </div>
        <div class="col col-lg-4 col-md-6 col-sm-12">
          <H6>
            <h6>UNAH</h6>
            <h6>Direccion</h6>
            <h6>Telefono</h6>

            </H3>
        </div>
        <div class="col col-lg-4 col-md-6 col-sm-12">
          <h6>
            CONTACTOS
          </h6>
        </div>
      </div>
      <div class="row derechos row2">
        <div class="col  col-lg-12">
          <h6 style="margin-top:-30px">@Todos los derechos reservados</h6>
        </div>
      </div>
    </div>
  </div>
</footer>
<script>
  function validaNumericos(event) {
    if (event.charCode >= 48 && event.charCode <= 57) {
      return true;
    }
    return false;
  }
</script>

</html>