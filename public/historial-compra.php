<?php

include_once('seguridad.php'); 
include_once('header2.php'); 
?>

  <!--================Header Menu Area =================-->
<body background="../img/viaje.jpg">




  <div style="background-color: rgba(0, 0, 0, 0.521); padding:2em   ;height: 100vh;width: 100vw;">
    <div style="background-color: rgba(255, 255, 255, 0.911);
    width: 90%;
    margin: auto;border-radius: 10px;margin-top: 65px;">
      <h1  id="titulo" style="text-align: center;">Historial de Compra</h1>
 
              <div id="paquetes-mostrar"class="container ">
                  <div class="row">
                       <div class="col-7 col-lg-12">
                            <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#Factura</th>
      <th scope="col">Paquete</th>
      <th scope="col">Estado</th>
      <th scope="col">Fecha</th>
      <th scope="col">Ver</th>
    </tr>
  </thead>
  <tbody>
  <?php 
			$sql="select fac.idfactura, tou.nombre,fac.Fecha,usu.usuario from persona per
      inner join 	usuario usu on usu.idusuario=per.idusuario
      inner join cliente cli on cli.persona_idpersona=per.idpersona
      inner join factura fac on fac.cliente_idcliente=cli.idcliente
      inner join detallefactura df on df.factura_idfactura=fac.idfactura
      inner join tour tou on tou.idtour=df.tour_idtour
      where usuario='Ganzo'      
            ;";
			$conexion=$obj->conexion();
      $result=mysqli_query($conexion,$sql);
			while ($mostrar=mysqli_fetch_row($result)) {
				?>
    <tr class="fila-color">
      <th scope="row">1</th>
      <td><?php echo $mostrar[0] ?></td>
      <td><?php echo $mostrar[1] ?></td>
      <td><?php echo $mostrar[2] ?></td>
      <td >
      <form id="factura" target="_blank"action="" method="POST">
				<input style="Display:None;"id="idcode" type="text" name="codigo">
        <button class="btn btn-success btn-sm"  
							onclick="imprimirfactura('<?php echo $mostrar[0] ?>','<?php echo $mostrar[3] ?>')">
							<span class="fas fa-print"></span>
				</form> 
          </td>
    </tr>
    <?php 
      }
      mysqli_close($conexion);
			?>
  </tbody>
</table>
                       </div>
              </div>
  
    </div>
  </div>          



                <div class="modal fade" tabindex="-1" role="dialog" id="modalComprar">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Iniciar sesion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                       <label> <i class="fas fa-user"></i> Usuario</label><input onkeyup="validarVacio('comprar-usuario')" id="comprar-usuario"  class="form-control spaceform"type="text" placeholder="Ingresa usuario">
                       <div id="Error-comprar-usuario" class="error-vacio" style="display:none">¡Información de usuario vacia!</div>
                        <label><i class="fas fa-key"></i> Contraseña</label><input onkeyup="validarVacio('comprar-password')" id="comprar-password"  class="form-control" type="text" placeholder="Password">
                        <div id="Error-comprar-password" class="error-vacio" style="display:none">¡Contraseña vacia!</div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-success" onclick="redirigir()">Iniciar Sesión</button>
                      </div>
                    </div>
                  </div>
                </div>
</body>

<?php
      include_once('footer.php'); 
?>
