<?php

include_once('header2.php'); 

if(isset($_SESSION["usuario"])) {
    $var=$_SESSION["id"];
   }else{
     $var=0;
   }
?>

<input id="user" value="<?php echo $var?>" style="display:none" type="text">
  <!--================Header Menu Area =================-->
<img id="img-back-hruta" style="">
<div style="background-color: rgba(0, 0, 0, 0.521); width: 100%;">
   
<section class="hero-banner">
  <div class="container col-md-12 col-sm-12" style="text-align:justify;margin-bottom: 20px;">
  <div style="background-color: rgba(255, 255, 255, 0.911);
    width: 90%;
    margin: auto;border-radius: 10px;padding: 20px; margin-top:10px;">
      <h1  id="titulo" style="text-align: center;">Historial de Rutas</h1>
    
      <div class="row control">
		<div class="col-12">
		
				<div class="formularioPrincipal">

					<div class="fechaInicio col-12">
						<label for="fecha">Fecha de Inicio</label>
						<input id="fechainicio" class="form-control" type="date" name="start">
					</div>

					<div class="fechaFinalizacion col-12">
						<label for="fecha">Fecha de Finalización</label>
						<input id="fechafin" class="form-control" type="date" name="end">
					</div>

					<div class="filtro col col-lg-12 col-md-12 col-sm-12">
						<button style="margin-left: 45px;" id="filtro" class="btn btn-primary">Filtrar</button>
					</div>

				</div>
		</div>
	</div>

	<div class="tabla">
		<table class="table table-sm mt-5 table-responsive">
			<thead class="thead-dark">
				<tr>
					<th scope="col">Nombre del Tour</th>
					<th scope="col">Ciudad</th>
					<th scope="col">Fecha de Inicio</th>
					<th scope="col">Fecha de Finalización</th>
					<th scope="col">Horas Trabajadas</th>
				</tr>
			</thead>
			<tbody id="contenido-hruta"class="table-striped">

			</tbody>
		</table>
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



<script src="../vendors/jquery/jquery-3.2.1.min.js"></script>
  <script src="../js/historial-ruta.js"></script>

  </section>

  <?php
      include_once('footer.php'); 
?>

 
