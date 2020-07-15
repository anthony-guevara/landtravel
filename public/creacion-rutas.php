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
    <link rel="stylesheet" href="../css/Creacion-rutas.css">
    <link rel="icon" type="image/png" href="../img/favicon.ico" />
</head>

<body>
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
    <div class="container" >
        <div class="row">
            <div class="col-4">
            <div class="box-create">
                <h2>Duracion de la Ruta</h2>
                <div id="linea"></div>
                <p>
                     <label>Fecha Inicial de Tour</label><br>
                      <?php 
                      $var=$_GET["tour"];
                       $sql="select fecha_inicio from tour where id=$var;";
                       $conexion=$obj->conexion();
                       $result=mysqli_query($conexion,$sql);         
                       $mostrar=mysqli_fetch_row($result);
         ?>
         
                                        <input disabled type="date" name="fecha-fin" class="form-control" value="<?php echo $mostrar[0]?>">
         <?php 
       
       ?>
       <div id="cambiar-nruta">
                     <label>Fecha a Finalizar Ruta 1</label><br>
                     <input type="date" id="fechafin"  min="<?php echo $mostrar[0]?>" class="form-control" value="<?php echo $mostrar[0]?>" >
      </div>
                     <div class="formfecha">
                </p>
               
                </div>
             </div>
         
         </div>
         <div class="col-4 ">
                   <div class="box-create">
                   <h2>Informaciòn de Ruta</h2>
                <div id="linea"></div>
                <p>
            <label>Pais</label><br>
            <select id="create-pais" class="form-control">
            <option value="" disabled selected hidden>-</option>
				<?php 
			                $sql="select id,nombre,gentilicio,codigo from pais 
                      where id>0
                      order by nombre asc;";
                      $conexion=$obj->conexion();
                      $result=mysqli_query($conexion,$sql);         
			                while ($mostrar=mysqli_fetch_row($result)) {
				?>
                                        <option value="<?php echo $mostrar[0] ?>"><?php echo $mostrar[1] ?></option>
				<?php 
			}
			mysqli_close($conexion);
			?>
            </select>
        </p>
        <p>
            <label>Ciudad</label><br>
            <select id="create-ciudad"class="form-control">
            <option value="" disabled selected hidden>-</option>
            </select>
        </p>
        <p>
            <label data-toggle="modal" data-target="#exampleModal1" id="Create-tour" class="menu__item" role="menuitem">Lugares Turísticos</label><br>
            <select id="create-lugarturistico" class="form-control">
            </select>
        </p>
            
                  </div>
             </div>
             <div class="col-4">
                    <div class="box-create">
                    <h2>Informaciòn de Ruta</h2>
                <div id="linea"></div>
                <p>
            <label>Guia De Turismo</label><br>
            <select id="create-guiaturismo" class="form-control" >
            <option value="" disabled selected hidden>-</option>
			      	<?php 
			                $sql="select gui.id,pnombre,papellido from persona per    
                      inner join usuario usu on usu.id=per.usuario_id
                      inner join guia gui on gui.persona_id=per.id
                      where tipo_usuario='Guia'";
                                        $conexion=$obj->conexion();
                                        $result=mysqli_query($conexion,$sql);
                                       
			                while ($mostrar=mysqli_fetch_row($result)) {
				?>
                                        <option value="<?php echo $mostrar[0] ?>"><?php echo $mostrar[1].' '.$mostrar[2] ?></option>
				<?php 
			}
			mysqli_close($conexion);
			?>
            </select>
        </p>     
        <p>
        <label>Precio de RUTA</label><br>
                     <input onkeypress='return validaNumericos(event)' id="create-precioRutas"class="form-control" type="text" min="1" placeholder="Precio L.">
        </p>
        <p>
        <label>Precio TOTAL TOUR</label><br>
                     <input disabled id="create-precioTotal"class="form-control" type="text" placeholder="L."><br>
        </p>
    
                    </div>  
             </div> 
      </div>    

    

    <div class="container formulario-footer">
        <div class="row">
            
            <div class="col col-lg-12">
            <button id="button-create" style="margin-left: -15px;
width: 103%;
background-color: green !important;
padding: 9px;" type="button" class="btn btn-success">Crear</button>
            </div>

        </div>
    </div>
    <h3>Rutas De Tours Creadas</h3>
    <table id="table-tours"style="background-color:white; border-radius:10px;" class="table table-borderless">
        <thead>
          <tr>
            <th scope="col">Pais</th>
            <th scope="col">Ciudad</th>
            <th scope="col">Lugar Turistico</th>
            <th scope="col">Guia De Turismo</th>
            <th scope="col">Fecha Inicial</th>
            <th scope="col">Fecha Final</th>      
          </tr>
        </thead>
        <tbody id="contenido">
         
        </tbody>
      </table>
     
</p>
</div>
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/creacion-rutas.js"></script>
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