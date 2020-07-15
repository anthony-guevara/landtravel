<?php

include_once('header2.php'); 

if(isset($_SESSION["usuario"])) {
 $var=1;
}else{
  $var=0;
}
?>
<input id="valoc" value="<?php echo $var?>" style="display:none" type="text">
  <!--================Header Menu Area =================-->
<img id="img-back" style="">
<div style="background-color: rgba(0, 0, 0, 0.521); width: 100%;">
   
<section class="hero-banner">
  <div class="container" style="text-align:justify;margin-bottom: 20px;">
  <div style="background-color: rgba(255, 255, 255, 0.911);
    width: 90%;
    margin: auto;border-radius: 10px;padding:20px">
      <h1  id="titulo" style="text-align: center;">Paquetes Turisticos</h1>


      <div id="contenido-paquetes"class="row ">
<!--===========================================-->

<div class="paquetes col-4">


      <div class="card" style="width: 18rem;">
  <img class="card-img-top" src="../img/Espa_a.png" alt="Card image cap">
  <div class="card-body">
    <h1 class="card-title" style="font-size:20px">Card title</h1> <div onclick="verrutas()" class="button" style="float: right;margin-top: -52px;padding: 9px 14px;cursor:pointer"><i class="fas fa-eye"></i></div>
    <div class="card-text" style="color:black"><i class="far fa-calendar-alt"></i> <span style="margin-left:7px"> Fecha Inicio: 10</span> </div>
    <div class="card-text" style="color:black"><i class="fas fa-calendar-alt"></i> <span style="margin-left:7px"> Fecha Fin: 20</span> </div>
    <div class="card-text" style="color:black"><i class="fas fa-dollar-sign"></i><span style="margin-left:10px"> Costo: 30</span></div>
    <div class="card-text" style="color:black"><i class="fas fa-users"></i> Tipo de Tour: 40</div>
    <div class="card-text" style="color:black"><i class="fas fa-box-open"></i> Cupos: 50</div><br>
    <button onclick="verificarsesioncompra(<?php echo $var ?>)" class="btn btn-primary">Comprar</button>    <button  href="#" style="float:right" onclick="verificarsesionreserva(<?php echo $var ?>)" class="btn btn-primary">Reservar</button>
  </div>  
</div>
</div>
<!--===========================================-->
<!--===========================================-->

<div class="paquetes col-4">


      <div class="card" style="width: 18rem;">
  <img class="card-img-top" src="../img/Espa_a.png" alt="Card image cap">
  <div class="card-body">
    <h1 class="card-title" style="font-size:20px">Card title</h1> <div class="button" onclick="verrutas()" style="float: right;margin-top: -52px;padding: 9px 14px;cursor:pointer"><i class="fas fa-eye"></i></div>
    <div class="card-text" style="color:black"><i class="far fa-calendar-alt"></i> <span style="margin-left:7px"> Fecha Inicio: 10</span> </div>
    <div class="card-text" style="color:black"><i class="fas fa-calendar-alt"></i> <span style="margin-left:7px"> Fecha Fin: 20</span> </div>
    <div class="card-text" style="color:black"><i class="fas fa-dollar-sign"></i><span style="margin-left:10px"> Costo: 30</span></div>
    <div class="card-text" style="color:black"><i class="fas fa-users"></i> Tipo de Tour: 40</div>
    <div class="card-text" style="color:black"><i class="fas fa-box-open"></i> Cupos: 50</div><br>
    <button onclick="verificarsesioncompra(<?php echo $var ?>)" class="btn btn-primary">Comprar</button>    <button  href="#" style="float:right" onclick="verificarsesionreserva(<?php echo $var ?>)" class="btn btn-primary">Reservar</button>
  </div>
</div>
</div>
<!--===========================================-->
<!--===========================================-->
<div class="paquetes col-4">


      <div class="card" style="width: 18rem;">
  <img class="card-img-top" src="../img/Espa_a.png" alt="Card image cap">
  <div class="card-body">
    <h3 class="card-title">Card title</h3>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-primary">Comprar</a>    <a style="float:right" href="#" class="btn btn-primary">Reservar</a>
  </div>
</div>
</div>
<!--===========================================-->
<!--===========================================-->
<div class="paquetes col-4">


      <div class="card" style="width: 18rem;">
  <img class="card-img-top" src="../img/Espa_a.png" alt="Card image cap">
  <div class="card-body">
    <h3 class="card-title">Card title</h3>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-primary">Comprar</a>    <a style="float:right" href="#" class="btn btn-primary">Reservar</a>
  </div>
</div>
</div>
<!--===========================================-->
<!--===========================================-->
<div class="paquetes col-4">


      <div class="card" style="width: 18rem;">
  <img class="card-img-top" src="../img/Espa_a.png" alt="Card image cap">
  <div class="card-body">
    <h3 class="card-title">Card title</h3>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-primary">Comprar</a>    <a style="float:right" href="#" class="btn btn-primary">Reservar</a>
  </div>
</div>
</div>
<!--===========================================-->
<!--===========================================-->
<div class="paquetes col-4">


      <div class="card" style="width: 18rem;">
  <img class="card-img-top" src="../img/Espa_a.png" alt="Card image cap">
  <div class="card-body">
    <h3 class="card-title">Card title</h3>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a onclick="verificarsesion()" class="btn btn-primary">Comprar</a>    <a style="float:right" href="#" class="btn btn-primary">Reservar</a>
  </div>
</div>
</div>
<!--===========================================-->



</div>
</div>
  </div>


<!-- Modal HTML -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header">
				<div class="icon-box" style="margin-left: 40%;">
					<i class="material-icons">&#xE5CD;</i>
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body text-center">
				<h4 style="color:gray">Lo sentimos, debe iniciar sesión antes!</h4>	
				<button onclick="location.href='login.php'" class="btn btn-success" data-dismiss="modal">Iniciar Sesión</button>
			</div>
		</div>
	</div>
</div>  

<!-- Modal tabla 
<button type="button" class="btn btn-primary" onclick="launchmodal()">Large modal</button>
-->
<div id="contenido-modal">
<div id="modal-tour" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
  <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title" id="exampleModalLabel" style="font-size: 35px;margin-left: 8em;margin-bottom: -2px;">Modal title</h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Pais</th>
      <th scope="col">Ciudad</th>
      <th scope="col">Descripción</th>
      <th scope="col">Lugar Turistico</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
  </tbody>
</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
</div>


<script src="../vendors/jquery/jquery-3.2.1.min.js"></script>
  <script src="../js/mostrarpaquetes.js"></script>

  </section>

  <?php
      include_once('footer.php'); 
?>

 
