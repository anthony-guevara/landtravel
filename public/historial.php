<?php


include_once('header.php'); 
include_once('seguridad.php'); 
if(isset($_SESSION["usuario"])) {
    $var=$_SESSION["id"];
   }else{
     $var=0;
   }
?>

  <!--================Hero Banner Area Start =================-->
  <section class="hero-banner">
  <input id="user" value="<?php echo $var ?>" style="display:none" type="text">
  <div class="container" style="text-align:justify">
  <div class="row">
    <div class="col col-sm-12">
    <h1 id="titulo" style="text-align: center; margin-top: 4px">Historial de Compra</h1>
    <div class="tableText">
    <table class="table">
  <thead class="thead-dark">
    
    <tr>
      <th scope="col">#Factura</th>
      <th scope="col">Nombre del Tour</th>
      <th scope="col">Fecha Inicio</th>
      <th scope="col">Fecha Fin</th>
      <th scope="col">Tipo de Tour</th>
      <th scope="col">Ver</th>
    </tr>
  
  </thead>
  <tbody id="contenido-historial">
    
  </tbody>
</table>
  </div>  
 </div>
 </div>
 </div>



 <div class="container" style="text-align:justify">
  <div class="row">
    <div class="col col-sm-12">
    <h1 id="titulo" style="text-align: center;">Historial de Reserva</h1>
    <div class="tableText2">
    <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#Factura</th>
      <th scope="col">Nombre del Tour</th>
      <th scope="col">Fecha Inicio</th>
      <th scope="col">Fecha Fin</th>
      <th scope="col">Tipo de Tour</th>
      <th scope="col">Prima Inicial</th>
      <th scope="col">Total a Pagar</th>
      <th scope="col">Costo Total</th>
    </tr>
  </thead>
  <tbody id="contenido-historial-reserva">
    
  </tbody>
</table>
  </div>
 </div>
 </div>
 </div>
 <script src="../vendors/jquery/jquery-3.2.1.min.js"></script>
 <script src="../js/historial.js"></script>
  </section>
  <!--================Hero Banner Area End =================-->

<?php
      include_once('footer.php'); 
?>

 