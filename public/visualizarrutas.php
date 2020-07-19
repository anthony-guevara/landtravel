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
<img id="img-back-vruta" style="">
<div style="background-color: rgba(0, 0, 0, 0.521); width: 100%;">
   
<section class="hero-banner">
  <div class="container" style="text-align:justify;margin-bottom: 20px;">
  <div style="background-color: rgba(255, 255, 255, 0.911);
    width: 90%;
    margin: auto;border-radius: 10px;padding:30px">
      <h1  id="titulo" style="text-align: center;">Rutas Asignadas</h1>


      <div id="contenido-paquetes"class="row ">


      <div class="col col-lg-8 tablacolor" style="margin-top:3em ;">
          <label style="margin-left:15px" for="guia">Guia De Turismo </label>
          <?php
				  $usr=$_SESSION['usuario'];
				  
				            $sql="select pnombre,papellido from usuario usu
							inner join persona per on per.usuario_id=usu.id
							where email='$usr'";
                $result=mysqli_query($conexion,$sql);
                $mostrar=mysqli_fetch_row($result)
								
                ?>
          <input style="margin-left:15px" value="<?php echo $mostrar[0]." ".$mostrar[1]; ?>" type="text" id="usr" class="form-control" disable style="width: 50%;">
      </div>
      <div class="col col-lg-12 tablacolor" style="margin-top:3em ;">
        <h1 style="font-size:25px;margin-left:20px">Horario De Trabajo</h1>


        <table id="vruta" class="table table-bordered tablacolor table-responsive table-hover">
            <thead class="coloricono">
              <tr>
                <th scope="col">Nombre Del Tour</th>
                <th scope="col">Ciudad</th>
                <th scope="col">Fecha De Inicio</th>
                <th scope="col">Fecha De Finalizacion</th>
                <th scope="col">Estado</th>
              </tr>
            </thead>
            <tbody id="contenido-vruta">
             
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
  <script src="../js/visualizarruta.js"></script>

  </section>

  <?php
      include_once('footer.php'); 
?>

 
