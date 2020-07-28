
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
  <link rel="stylesheet" href="../css/tablaPais.css">
  
  <title>Pais</title>
</head>

<body>

  
   
    <div class="container" style="text-align:center">
      <div class="row">
        <div class="col col-sm-12">
          <h1 id="titulo" style="text-align: center; margin-top: 4px; margin-bottom:4rem;"> Gestion Paises</h1>
          <div class="tableText col col-lg-12 col-md-12 col-sm-12">
            <table class="table "> 
              <thead class="thead-dark">

                <tr>
                  <th scope="col">Nombre</th>
                  <th scope="col">Gentilicio</th>
                  <th scope="col">Acciones</th>
                </tr>

              </thead>
              <tbody id="contenido-paises">


              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>



    <!-- /*modal editar pais*/ -->






    <div class="modal" id="modalpais" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Editar Pais</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            
            <form id="informacionpais">
              <div class="row">
                  <div class="col-6">
                          <input  type="text" id="nombrePais" placeholder="Nombre Pais"><br>
                  </div>
                  <div class="col-6">
                          <input  type="text" id="gentilicio" placeholder="Gentilicio"><br>
                  </div>
              </div>
              <div class="row">
                  <div class="col-12">
                          <input  type="text" id="codigo" placeholder="Abreviatura"><br>
                  </div>
              </div>
              

                              
              <input  type="text" id="idpais" style="display:none;" placeholder="id">
            
                  
                
             
          </form>

          </div>
            <button type="button" class=" buttones" id="guardarpais"  onclick="cerrar()">Guardar<i class="fas fa-save"></i></button>
            <button type="button" class=" buttones" data-dismiss="modal">Cerrar<i class="fas fa-window-close"></i></button>
          </div>
        </div>
      </div>
    </div>


    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/tablaPais.js"></script>


</body>

</html>