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
    <title>Creacion Tours</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/ReporteEmpleados.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" >
    <script src="https://kit.fontawesome.com/3ac10e43fc.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/png" href="../img/favicon.ico" />
</head>
<!-- <a href="tours.php"><img id="imgatras"; style="width:40px;position:absolute;margin-bottom:10em   top:10px;left:30px;cursor:pointer;" src="../img/flecha_izquierda1.png" alt=""></a> -->
<!-- <div id="imagenFondo" style="" >
    </div>  -->
 <nav class="navbar fixed-top navegacion" style="margin-top:5em margin-bottom:3em" id="na">
 <div class="toggle">
  <i class="fa fa-bars menu" aria-hidden="true"></i>
</div> 
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




  <!-- Aqui empieza el navbar -->








  <!-- aqui termina -->






     <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        
        <script type="text/javascript">
      $(document).ready(function(){
        $('.menu').click(function(){
          $('ul').toggleClass('active');
          
        })
      })
      </script> 
    <body class="fondo col col-sm-12" style="color: white;">
    
    <div class="content col-sm-12  " style="margin-top: 2em;">
        <div class="col col-lg-12 col-sm-12"   style="margin-bottom:3em;">  <h1><i class="fas fa-user-alt fa-2x anarajado"></i>Reporte De Empleados</h1>
          </div>
    
            <div class="card text-center col col-md-12 col-sm-12">
              <div class="card-header estilotarjeta col col-md-12 col-sm-12">
               Detalles
              </div>
              <div class="card-body col col-md-12 col-sm-12">
                
    
    
    
           
    
                <table class="table thead-light table-striped tablacolor table-hover divfondo table-responsive  " style="margin-bottom: 5em;width: 80%; text-align: center;">
                  <thead class="coloricono tableheader">
                    <tr>
                      <th scope="col">No.</th>
                      <th scope="col">Identidad</th>
                      <th scope="col">Primer Nombre</th>
                      <th scope="col">Primer Apellido</th>
                      <th scope="col">Pais De Residencia</th>
                      <th scope="col">Cargo</th>
                      <th scope="col">Salario De El Mes</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
			$sql="select persona.identidad,persona.pnombre,persona.papellido,persona.identidad,usu.tipo_usuario,(pago.mensual+(pago.horas_extra*pago.extra)-pago.deducido)Salario, persona.nacionalidad from usuario usu
      inner join   persona  on usu.id=persona.usuario_id
      inner join   guia  on persona.id=guia.persona_id
      inner join pago on guia.id=pago.guia_id
      where  usu.tipo_usuario='guia' or  usu.tipo_usuario='admin'
            ;";
			$conexion=$obj->conexion();
      $result=mysqli_query($conexion,$sql);
      $number=0;
			while ($mostrar=mysqli_fetch_row($result)) {
        $number++;
				?>
                     <tr>
                      <th scope="row"><?php echo $number?></th>                    
                      <td><?php echo $mostrar[0]?></td>
                      <td><?php echo $mostrar[1]?></td>
                      <td><?php echo $mostrar[2]?></td>
                      <td><?php echo $mostrar[6]?></td>
                      <td><?php echo $mostrar[4]?></td>
                      <td>$.<?php echo $mostrar[5]?></td>
    </tr>
    <?php 
      }
      mysqli_close($conexion);
			?>
                  </tbody>
                </table>
      
      
      
      
      
      
      
      
      
      
      
      
      
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
              </div>
              <div class="card-footer text-muted col-sm-12 estilotarjeta">
                
              </div>
            </div>
    
    
    
            
          
    
    
    
    
    
    
        </div>
        
    
    
    </div>
    
    
    <script src="js/ReporteEmpleados.js"></script>
    </body>

<footer>
<div class="MD">
    <div class="contenedor container">
      <div class="row row1">
        <div class="col col-lg-6 col-sm-12">
          <h6>
              <span style="margin-top: -10px;" id="name-logo">Land Travel</span>
            
          </h6>
        </div>
        <div class="col col-lg-6 col-sm-12">
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
        <div class="col  col-lg-12 col-sm-12">
          <h6 style="margin-top:-30px">@Todos los derechos reservados</h6>
        </div>
      </div>
    </div>
  </div>
  
  <script>
   
function validaNumericos(event) {
    if(event.charCode >= 48 && event.charCode <= 57){
      return true;
     }
     return false;        
}
</script>
  </footer> 
</html>