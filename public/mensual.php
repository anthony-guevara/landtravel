<?php

include_once('header2.php'); 

if(isset($_SESSION["usuario"])) {
 $var=1;
}else{
  $var=0;
}
?>

<input id="user" value="<?php echo $var?>" style="display:none" type="text">
  <!--================Header Menu Area =================-->
<img id="img-back-mensual" style="">
<div style="background-color: rgba(0, 0, 0, 0.521); width: 100%;">
   
<section class="hero-banner">
  <div class="container" style="text-align:justify;margin-bottom: 20px;">
  <div class="col col-lg-12 col-md-12 col-sm-12" style="background-color: rgba(255, 255, 255, 0.911);
    width: 60%;
    margin: auto;border-radius: 10px;padding: 20px;">
      <h1  id="titulo" style="text-align: center;">Pago Mensual</h1>
    
    

      <table class="table thead-light table-striped tablacolor table-responsive table-hover divfondo  " style="margin-bottom: 5em;width: 80%;margin-left: 3em; text-align: center;">
                  <thead class="coloricono tableheader">
                    <tr>
                      <th scope="col">DESCRIPCION</th>
                      <th scope="col">Cantidad</th>
                      <th scope="col">Valor en $</th>
                      <th scope="col">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
			$sql="select (pago.horas) horasrutas ,pago.horas_extra,pago.mensual,(pago.mensual+(pago.horas_extra*pago.extra)-pago.deducido)Salario 
      from pago
      inner join guia gui on gui.id=pago.guia_id
      where gui.id=46";
			$conexion=$obj->conexion();
      $result=mysqli_query($conexion,$sql);
      $number=0;
      $mostrar=mysqli_fetch_row($result);
        $number++;
				?>
                     <tr>
                      <th scope="row">Horas Trabajadas</th>                    
                      <td><?php echo $mostrar[0]?></td>
                      <td>4</td>
                      <td><?php echo $mostrar[2]?></td>             
    </tr>
    <tr>
                      <th scope="row">Horas Extras</th>                    
                      <td><?php echo $mostrar[1]?></td>
                      <td>4</td>
                      <td>0</td>
                      
              
    </tr>
    <tr>
                      <th scope="row">Deducciones</th>                    
                      <td>1</td>
                      <td>8.64</td>
                      <td>8.64</td>
    </tr>
    <tr>
                      <th scope="row"></th>                    
                      <td></td>
                      <td>TOTAL</td>
                      <td><?php echo $mostrar[3]?></td>
    </tr>

                  </tbody>
                </table>
      


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

 
