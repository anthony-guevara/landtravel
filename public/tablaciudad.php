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
    <link rel="stylesheet" href="../vendors/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="../vendors/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="../vendors/themify-icons/themify-icons.css">
  <link rel="stylesheet" href="../css/ciudad.css">
    <title>Ciudades</title>
</head>
<body>
    

    <div class="container" style="text-align:center">
        <div class="row">
          <div class="col col-sm-12">
            <h1 id="titulo" style="text-align: center; margin-top: 4px; margin-bottom:4rem;"> Gestion Ciudades</h1>
            <div class="tableText col col-lg-12 col-md-12 col-sm-12">
              <table class="table  "> 
                <!-- <thead class="thead-dark col col-lg-12 col-md-12 col-sm-12 " style="width:100%!important"> -->
  
                  <tr>
                    <th scope="col">Pais</th>
                    <th scope="col">Nombre Ciudad</th>
                    <th scope="col">Descripcion</th>
                  </tr>
  
                </thead>
                <tbody id="contenido-ciudades">
  
  
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <script src="../js/jquery-3.4.1.min.js"></script>
      <script src="../js/bootstrap.min.js"></script>
      <script src="../js/tablaciudad.js"></script>
  
</body>
</html>