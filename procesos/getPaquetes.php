<?php 
	
	require_once "../clases/conexion.php";
	$obj= new conectar();
	$conexion=$obj->conexion();

	$sql="select tou.idtour,nombre,round(sum(precio),2) total,hot.descripcion,transp.descripcion,ttransp.Descripcion,tou.fecha_inicio,date_add(tou.fecha_inicio, interval rut.c_noches day) fecha_fin from tour tou
	inner join ruta rut on rut.idtour=tou.idtour
	inner join paquete_hotel paq on paq.idpaquete_hotel=rut.idpaquete
	inner join hotel hot on hot.idhotel=paq.idpaquete_hotel
	inner join ruta_has_transporte rht on rht.ruta_idruta=rut.idruta
	inner join transporte transp on transp.idtransporte=rht.transporte_idtransporte
	inner join tipo_transporte ttransp on ttransp.idTipo_transporte=transp.idtransporte
	group by idtour,nombre, hot.descripcion,transp.descripcion,ttransp.Descripcion,tou.fecha_inicio ";
	$result=mysqli_query($conexion,$sql);

	while (	$ver=mysqli_fetch_row($result))
	{	
	  $results[] = $ver;
	}


	echo json_encode($results);
 ?>