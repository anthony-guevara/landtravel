<?php
    class conectar
    {
        public function conexion()
        {
            $conexion=mysqli_connect('localhost:3306', 'root', '', 'landtravel');
            
            // conexion amazon
            //$conexion=mysqli_connect('landtravel.cnvuznrls2s2.us-east-1.rds.amazonaws.com:3306', 'admin', 'landtravel_unah_2020', 'landtravel');
            return $conexion;
        }
    }
