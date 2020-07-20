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
    <title>Pago Mensual</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/pagosMensual.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" >
    <script src="https://kit.fontawesome.com/3ac10e43fc.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/png" href="../img/favicon.ico" />
</head>
<nav class="navbar fixed-top navegacion">
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

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        
        <script type="text/javascript">
      $(document).ready(function(){
        $('.menu').click(function(){
          $('ul').toggleClass('active');
          
        })
      })
      </script> 

    <body class="fondo" style="color: white;">
    
    <div class="content " style="margin-top: 2em;">
        <div class="col col-lg-12"   style="margin-bottom:3em;">  <h1><i class="fas fa-user-alt fa-2x anarajado"></i></i>Ganacias</h1>
          </div>
    
          <?php 
			$sql="select * from reporte_ingresos";
			$conexion=$obj->conexion();
      $result=mysqli_query($conexion,$sql);
      $number=0;
      $mostrar=mysqli_fetch_row($result);
        $number++;
				?>
            
    <div class="row">
    
<div class="col-lg-4">

<div class="card border-success mb-3" style="max-width: 18rem;  height: 31em;">
    <div class="card-header bg-transparent border-success estilotarjeta">Ingresos</div>
    <div class="card-body text-success">
     


        <table class="table thead-light table-striped tablacolor table-hover table-responsive divfondo round_table" style="width: 12rem;">
            <thead class="coloricono thead-green tableheader ">
              <tr>
                <th scope="col">DETALLES</th>
                <th scope="col">VALOR EN $</th>
                
                
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">Comision Por Venta</th>
           
                <td><?php echo $mostrar[1]?></td>
               

                
                
              </tr>
              <tr>
                <th scope="row">Comision Por publicidad</th>
               
                
                <td>100</td>
               
               
              </tr>
              <tr>
               
               
                <th scope="row">Total</th>
           
                <td><?php echo $mostrar[8]?></td>
                
               
                
                
              </tr>
            </tbody>
          </table>


    </div>
    <div class="card-footer bg-transparent border-success estilotarjeta"></div>
  </div>


</div>
<div class="col-lg-4">









    <div class="card border-success mb-3" style="max-width: 20rem; height: 31em;">
        <div class="card-header bg-transparent border-success estilotarjeta">Egresos</div>
        <div class="card-body text-success">
         


            <table class="table thead-light table-striped tablacolor table-responsive table-hover divfondo round_table" style="width: 13rem;">
                <thead class="coloricono thead-green  tableheader">
                  <tr>
                    <th scope="col">DETALLES</th>
                    <th scope="col">VALOR EN $</th>
                    
                    
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">Pagos Por Planilla</th>
               
                    <td><?php echo $mostrar[4]?></td>
                   

                    
                    
                  </tr>
                  <tr>
                    <th scope="row">Gastos Administrativos</th>
                   
                    
                    <td><?php echo $mostrar[5]?></td>
                   
                   
                  </tr>
                  <tr>
                   
                   
                    <th scope="row">Gastos Operativos</th>
               
                    <td><?php echo $mostrar[6]?></td>
                    
                   
                    
                    
                  </tr>
                  <tr>
                   
                   
                    <th scope="row">Impuestos </th>
               
                    <td><?php echo $mostrar[7]?></td>

                    
                    
                  </tr>
                  <tr>
                   
                   
                    <th scope="row">Total</th>
               
                    <td><?php echo $mostrar[9]?></td>
                    
                   
                    
                    
                  </tr>

                </tbody>
              </table>


        </div>
        <div class="card-footer bg-transparent border-success estilotarjeta"></div>
      </div>
</div>

      <div class="col-lg-4">

        <div class="card border-success mb-3" style="max-width: 18rem;  height: 31em;">
            <div class="card-header bg-transparent border-success estilotarjeta">Ganancia</div>
            <div class="card-body text-success">
             


                <table class="table thead-light table-striped tablacolor table-responsive table-hover divfondo round_table" style="width: 15rem;">
                    <thead class="coloricono thead-green tableheader ">
                      <tr>
                        <th scope="col">DETALLES</th>
                        <th scope="col">VALOR EN $</th>
                        
                        
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">Ganancia</th>
                   
                        <td><?php echo $mostrar[10]?></td>
                       

                        
                        
                      </tr>

                     
                    </tbody>
                  </table>


            </div>
            <div class="card-footer bg-transparent border-success estilotarjeta"></div>
          </div>


        </div>

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