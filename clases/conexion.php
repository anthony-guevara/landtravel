<?php 
	class conectar{
		public function conexion(){
			$conexion=mysqli_connect('localhost:3306','root','','landtravel');
			return $conexion;
		}
	}


 ?>