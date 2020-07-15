<?php 
	class conectar{
		public function conexion(){
			$conexion=mysqli_connect('localhost','root','','landtravel_3');
			return $conexion;
		}
	}


 ?>



<select id="select-empleado" name="select" class="col-xl-12 col-lg-12 form-control ">
            <option value="" disabled selected hidden>-</option>
				<?php 
			                $sql="select * from empleado emp
                      inner join persona per on per.idpersona=emp.idpersona
                      inner join pais pa on pa.idpais=per.idpais
                      order by p_nombre asc";
                                        $conexion=$obj->conexion();
                                        $result=mysqli_query($conexion,$sql);
                                       
			                while ($mostrar=mysqli_fetch_row($result)) {
				?>
                                        <option value="<?php echo $mostrar[0] ?>"><?php echo $mostrar[4].' '.$mostrar[5].' '.$mostrar[6].' '.$mostrar[7] ?></option>
				<?php 
			}
			mysqli_close($conexion);
			?>
            </select>