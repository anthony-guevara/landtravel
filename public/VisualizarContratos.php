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
    <title>Contratos</title>
    <link rel="icon" type="image/png" href="../img/favicon.ico" />
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/visualizar-contratos.css">
    <script src="https://kit.fontawesome.com/c9865cd77e.js" crossorigin="anonymous"></script>
</head>
<nav class="navbar fixed-top navegacion">
      <ul class="nav">
      <li class="nav-item naveup"> <a href="#">Administración</a>
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
    <a href="tours.php"><img style="width:40px; position: absolute;top:80px;left:30px;cursor:pointer;" src="../img/flecha_izquierda1.png" alt=""></a>
    <div id="imagenFondo" style="" >
    </div>
<body>
    <div class="container" style="margin-top:15px;">
    <div class="row">
        <div class="col col-lg-12" >
        <h3 class="texto">Contrato de Empleados</h3>
        </div>  
        <div class="col col-lg-6 ">
            <button type="button"  class='btn data-toggle="dropdown"' >
                 <h5 class="texto">Seleccione un Empleado </h5> <span class="caret"></span>
                 <select id="inputEmpleado" class="txtid form-control" style="  border-color:  rgb(189, 101, 0);
    border-style: groove;" >
                 <option value="" disabled selected hidden>-</option>
			      	<?php 
                        $sql="select * from usuario usu
                        inner join persona per on per.usuario_id=usu.id
                        where tipo_usuario='Guia' and usu.id!=6
                        ";
                                        $conexion=$obj->conexion();
                                        $result=mysqli_query($conexion,$sql);
                                       
			                while ($mostrar=mysqli_fetch_row($result)) {
				?>
                                        <option value="<?php echo $mostrar[0] ?>"><?php echo $mostrar[10].' '.$mostrar[11] ?></option>
				<?php 
			}
			mysqli_close($conexion);
			?>  
                </select>
                </button></div>
       

        </div>
    </div>
    </div> 

    <h3 class="texto titulos" style="margin-left: 15em;">Informacion Empleado</h3>

 
       <div class="form-row formulario">
            <div class="form-group col-md-6">
               <label class ="texto" for="inputEmail4">Identidad</label>
               <input id="vc-identidad" disabled type="text" class="form-control" class="inputEmail4" >
            </div>
        <div class="form-group col-md-6">
               <label  class ="texto" for="inputPassword4">Numero De Contrato</label>
               <input id="vc-ncontrato" disabled type="text" class="form-control" class="inputPassword4" >
        </div>
        <div class="form-group col-md-6">
                <label class ="texto" for="inputPassword4">Primer Nombre</label>
                <input id="vc-pnombre" disabled type="text" class="form-control" class="inputPassword4" >
        </div>   

        <div class="form-group col-md-6">
                <label class ="texto" for="inputPassword4">Primer  Apellido</label>
              <input id="vc-papellido" disabled type="text" class="form-control" class="inputPassword4" >
        </div>   
      
        <div class="form-group col-md-6">
                <label class ="texto" for="inputPassword4">Tipo de Contrato</label>
              <input id="tipo_contrato" disabled type="text" class="form-control" class="inputPassword4" >
        </div>   
        <div class="form-group col-md-6">
                <label class ="texto" for="inputPassword4">Tipo de Empleado</label>
              <input id="tipo_empleado" disabled type="text" class="form-control" class="inputPassword4" >
        </div>   
        <div class="form-group col-md-6">
                <label class ="texto" for="inputPassword4">Direccion</label>
              <input id="direccion" disabled type="text" class="form-control" class="inputPassword4" >
        </div> 
        <div class="form-group col-md-6">
                <label class ="texto" for="inputPassword4">Fecha Nacimiento</label>
              <input id="fechanac" disabled type="text" class="form-control" class="inputPassword4" >
        </div> 
        <div class="form-group col-md-6">
                <label class ="texto" for="inputPassword4">Telefono</label>
              <input id="telefono" disabled type="text" class="form-control" class="inputPassword4" >
        </div> 
        <div class="form-group col-md-6">
                <label class ="texto" for="inputPassword4">Nacionalidad</label>
              <input id="nacionalidad" disabled type="text" class="form-control" class="inputPassword4" >
        </div> 
    </div>
    <img style="float: right;

width: 317px;

position: absolute;

top: 290px;

right: 131px;

border-radius: 10px;

cursor: pointer;"src="../img/co.jpg" onclick="location.href='404.php';" alt="">
  <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
<script src="../js/visualizarcontratos.js"> </script>
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
          <img style="height: 140px;margin-left: 58px;" src="../img/logo.png" alt="">      </div>
        <div class="col col-lg-4 col-md-6 col-sm-12"><H6>
          <h6>UNAH</h6>
          <h6>Direccion</h6>
            <h6>Telefono</h6>
          
        </H3></div>
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

</html>