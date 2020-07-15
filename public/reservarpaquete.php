<?php
require_once "../clases/conexion.php";
$obj= new conectar();
$conexion=$obj->conexion();

include_once('header2.php'); 
include_once('seguridad.php'); 
if(isset($_SESSION["usuario"])) {
    $var=$_SESSION["id"];
   }else{
     $var=0;
   }
?>
<input id="user" value="<?php echo $var?>" style="display:none" type="text">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
  <!--================Header Menu Area =================-->
<img id="img-back-compra" style="">
<div style="background-color: rgba(0, 0, 0, 0.521); width: 100%;">
   
<section class="hero-banner">
  <div class="container" style="text-align:justify;margin-bottom: 20px;">
  <div style="background-color: rgba(255, 255, 255, 0.911);
    width: 90%;
    margin: auto;border-radius: 10px;margin-bottom:20px">
      <h1 id="titulo" style="text-align: center;">Reservar Paquete</h1>

      <div class="container" style="width: 90% !important;">
        <img style="width: 260px; margin-left: 15px;"src="../img/visa.png" alt="">
        <img style="width: 80px; float: right;"src="../img/secure.png" alt="">
        <div class="row">
            <div class="col-md-6 col-xl-12" style="margin-bottom: 1em;">
          <form id="form-comprar" data-toggle="validator" data-disable="false" role="form" action="" method="get"></form>
                <div class="form-row">
                    <div class="form-group col-md-6 col-xl-6">
                      <form id="form-comprar" action="">
                        <label>Fecha</label>
                        <input readonly type="date" id="fecha" name="fecha" class="form-control" style="width: 100%;">
                        <span class="error-vacio" id="mensajeFecha" style="display:none"> ¡Ingresa Una fecha!</span>
                    </div>

                    <div class="form-group col-md-6 col-lg-6">
                        <label>Cliente</label>
                        <?php 
                         $usr=$_SESSION['usuario'];
				  
     $sql="select pnombre,papellido from usuario usu
inner join persona per on per.usuario_id=usu.id
where email='$usr'";
 $result=mysqli_query($conexion,$sql);
$mostrar=mysqli_fetch_row($result);
 ?>
                        <input readonly value="<?php  echo $mostrar[0]." ".$mostrar[1]; ?> " name="nombre" type="text" id="nombre" class="form-control">


                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-12" style="margin-bottom: 1em;">
                <div class="form-row">
                    <div class="form-group col-md-6 col-lg-6">
                        <div>TOUR</div>
                                         <input readonly name="nombre" type="text" id="nombretour" class="form-control">
                        </select>

                        <span class="error-vacio" id="mensajetour" style="display: none;">¡Seleccione un tour!</span>
                    </div>
                    <div class="form-group col-md-6 col-lg-6">

                        <div for="tipotour">Tipo Tour</div>

                        <input readonly type="text" id="tipotour" class="form-control">

                        <span class="error-vacio" id="mensajetipotour" style="display: none;">¡Seleccione un tipo de tour!</span>
                    </div>

                </div>


            </div>

            <div class="col col-lg-12" style="margin-bottom: 1em;">
                <div class="form-row">
                    <div class="form-group col-md-6 col-lg-6">
                        <label  for="formapago">Forma Pago</label>
                        <input readonly value="Tarjeta Crédito" name="formapago" type="text" id="formapago" class="form-control">
                    </div>


                        <div class="form-group col-md-6 col-lg-6">
                        <label>TARJETA CREDITO</label>
                        <input data-error="Please enter your cd" required onkeypress='return validaNumericos(event)' name="nTarjeta" type="text" id="nTarjeta" class="form-control">
                        </div>

                    </div>
                
                <div class="form-row">
                    <div class="form-group col-6 col-md-6 col-lg-3">
                        <label>CVV</label>
                        <input onkeypress='return validaNumericos(event)' title="CVV solo de 3 digitos" required pattern="[0-9]{3}" type="text" id="cvv" class="form-control">
                        </div>
                        <div class="form-group col-6 col-md-6 col-lg-3">
                            <label>Fecha de Expiración</label>
                            <input required name="fecha-exp" type="date" id="fecha-exp" class="form-control">
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-6">
                            <label>Prima</label>
                            <select name="prima" class="form-control" id="prima">
                              <option value="0.3">30%</option>
                              <option value="0.4">40%</option>
                               <option value="0.5">50%</option>
                             </select>
                            </div>
                </div>

                <div style="text-align: center;" class="col-md-12 col-lg-12">
                    <button type="button" class="button btn-lg" id="botonreservar">Reservar</button>
                    </form>
                </div>

            </div>


        </div>


    </div>



</div>
</div>
</div>


<!-- Modal tabla 
<button type="button" class="btn btn-primary" onclick="launchmodal()">Large modal</button>
-->
<script src="../vendors/jquery/jquery-3.2.1.min.js"></script>
  <script src="../js/reservarpaquete.js"></script>

  </section>

  <?php
      include_once('footer.php'); 
?>