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
<img id="img-back-gcontrato" style="">
<div style="background-color: rgba(0, 0, 0, 0.521); width: 100%;heigh:100vh">

<?php 
     $usr=$_SESSION['usuario'];
     $sql="select pnombre,papellido,pasaporte,fecha_nacimiento,nacionalidad,usu.email,telefono,usu.id,'Temporal','3 Meses',tipo_usuario,'$4 por hora' from usuario usu
	 inner join persona per on per.usuario_id=usu.id
	 where email='$usr'";
 $result=mysqli_query($conexion,$sql);
$mostrar=mysqli_fetch_row($result);
 ?>

<section class="hero-banner">
    <div class="container " style="" >
        <div class="row">
            <div class="col col-lg-6 derecha" style="text-align: left;">
                <h1 style="text-align:center">Informacion De Contrato</h1>
                <div>
                <label>Pasaporte</label><br>
                <input class="form-control type="text" disabled style="width:90%" disabled value="<?php echo $mostrar[2]?>" >
                
                </div>
                <div ><label>Nombre Completo</label><br>
                    <input class="form-control" value="<?php echo $mostrar[0]." ".$mostrar[1]?>"type="nombre" disabled style="width:90%"></div>

                <div  > 
                    <label for="FechaNacimiento">Fecha De Nacimiento </label> <br>
                    <input class="form-control" value="<?php echo $mostrar[3]?>" type="date" disabled style="width:50%" >                
                
                </div>
                <div  >
                    <label for="Nacionalidad">Nacionalidad</label><br>
                    <input class="form-control" value="<?php echo $mostrar[4]?>" style="width:50%" type="text" disabled >
                </div>

             <div >
                <label for="correo">Correo Electronico</label>
                <input type="text" id="correo" value="<?php echo $mostrar[5]?>" class="inputText form-control" disabled > </input>
             </div>
             <div>
                <label for="telefono">Telefono</label><br>
                <input class="form-control" value="<?php echo $mostrar[6]?>" type="text" style="width:50%" id="telefono" class="inputText" disabled >
             </div>
            
             </div>

             <div class="col col-lg-6 izquierda" style="text-align: center;">
                <h1>Datos De Contrato</h1>

               <div style="text-align:center"><label>Numero Contrato</label><br>
                <input class="form-control disp" style="width:70%" type="text" disabled value="<?php echo $mostrar[7]?>"></div>
               <div><label>Tipo De Contrato</label><br>
                <input class="form-control disp"  style="width:70%" value="<?php echo $mostrar[8]?>" type="text" disabled></div>
               <div><label> Duracion</label><br>
                <input class="form-control disp"  style="width:70%" value="<?php echo $mostrar[9]?>" type="text" disabled></div>
               <div><label> Cargo</label><br>
                <input class="form-control disp"  style="width:70%" value="<?php echo $mostrar[10]?>" type="text" disabled></div>
               <div><label > Salario</label><br>
                <input class="form-control disp"  style="width:70%" value="<?php echo $mostrar[11]?>" type="text" disabled></div>
               

        </div>
     
        
        </div>
         </div>
     </div>   
     <div class="col-lg-6" style="margin-top: 2em; cursor:pointer">
</div>
</div>
<script src="../vendors/jquery/jquery-3.2.1.min.js"></script>
  <script src="../js/guiacontrato.js"></script>

  </section>

  <?php
      include_once('footer.php'); 
?>

 
