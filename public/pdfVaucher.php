<?php
    require_once('../vendor/mpdf-5.7-php7-master/mpdf.php');
    require_once( "../clases/conexion.php");

$obj= new conectar();
$conexion=$obj->conexion();

    $hoy = getdate();
   
    $codigo=$_GET['id'];

   

    $sql="select per.p_nombre,per.p_apellido, per.identidad,df.cantidad,tou.idtipo_tour,tou.nombre, df.Total*0.15 impuesto,df.Total*0.85 gravado,df.Total, per.correo,DAY(fac.fecha),Month(fac.fecha),Year(fac.fecha),df.Total*df.cantidad, sum(df.Total*df.cantidad) from persona per
    inner join 	usuario usu on usu.idusuario=per.idusuario
    inner join cliente cli on cli.persona_idpersona=per.idpersona
    inner join factura fac on fac.cliente_idcliente=cli.idcliente
    inner join detallefactura df on df.factura_idfactura=fac.idfactura
    inner join tour tou on tou.idtour=df.tour_idtour
    where usuario='Ganzo'";

    $conexion=$obj->conexion();
    $result=mysqli_query($conexion,$sql);

    $veru=mysqli_fetch_row($result);

    $html .=  '
    <!--<style>@page {
      margin-top: 0.0cm;
    margin-bottom:0.3cm;

     }</style>-->
     <body>

     <p style="text-align: center;margin-top: 3em;">
     <STRONG><P style="text-align: center;">Honduras, Tegucigalpa.,25 de mayo  de 2020</P>
 
        <P style="text-align: center;"> Yesica Rodríguez</P>
        <P style="text-align: center;"> Gerente de Recursos Humanos</P>
      <p  style="text-align: center;">LAND TRAVEL</p> 
     </STRONG>
        
         </p>
     
     <h1 style="margin-top: 2em;text-align: center;"> Reporte De pago Mensual</h1>
 
 <h3 style="margin-top: 5em;text-align: center;"> Ingresos</h3>
 
     <table class="table col col-lg-8" style="margin-top: 5em; margin-left: auto; margin-right: auto;">
         <thead>
           <tr>
             <th scope="col"><strong>Descripcion</strong></th>
             <th scope="col">Cantidad</th>
             <th scope="col">valor $</th>
             <th scope="col">Total</th>
           </tr>
         </thead>
         <tbody>
           <tr>
             <th scope="row">Horas Trabajadas</th>
             <td>Mark</td>
             <td>Otto</td>
             <td>@mdo</td>
           </tr>
           <tr>
             <th scope="row">Horas Extras</th>
             <td>Jacob</td>
             <td>Thornton</td>
             <td>@fat</td>
           </tr>
           <tr>
             <th scope="row">Total</th>
             <td>Larry</td>
             <td>the Bird</td>
             <td>@twitter</td>
           </tr>
         </tbody>
       </table>
    
       <hr>
 
       <h3 style="margin-top: 3em;text-align: center;"> Detalles</h3>
 
 
       <table class="table  col col-lg-8" style="margin-top: 3em; margin-left: auto; margin-right: auto;">
         <thead>
           <tr>
             <th scope="col"><strong>Descripcion</strong></th>
           
             <th scope="col">valor $</th>
         
           </tr>
         </thead>
         <tbody>
           <tr>
             <th scope="row">Salario Bruto</th>
             <td>Mark</td>
       
            
           </tr>
           <tr>
             <th scope="row">Deducciones</th>
             <td>Jacob</td>
         
           
           </tr>
           <tr>
             <th scope="row">Salario Neto </th>
             <td>Larry</td>
            
          
           </tr>
         </tbody>
       </table>
 
 
 </body>' ;

    $mpdf = new mPDF('c','A4');
   //$mpdf = new mPDF('utf-8', array(241,273));


    $css = file_get_contents('../css/factura.css');
    $mpdf->writeHTML($css, 1);
    $mpdf->writeHTML($html);
    $mpdf->Output('factura #'.$codigo.'.pdf','I');

    function num2letras($num, $fem = false, $dec = true) { 
      $matuni[2]  = "dos"; 
      $matuni[3]  = "tres"; 
      $matuni[4]  = "cuatro"; 
      $matuni[5]  = "cinco"; 
      $matuni[6]  = "seis"; 
      $matuni[7]  = "siete"; 
      $matuni[8]  = "ocho"; 
      $matuni[9]  = "nueve"; 
      $matuni[10] = "diez"; 
      $matuni[11] = "once"; 
      $matuni[12] = "doce"; 
      $matuni[13] = "trece"; 
      $matuni[14] = "catorce"; 
      $matuni[15] = "quince"; 
      $matuni[16] = "dieciseis"; 
      $matuni[17] = "diecisiete"; 
      $matuni[18] = "dieciocho"; 
      $matuni[19] = "diecinueve"; 
      $matuni[20] = "veinte"; 
      $matunisub[2] = "dos"; 
      $matunisub[3] = "tres"; 
      $matunisub[4] = "cuatro"; 
      $matunisub[5] = "quin"; 
      $matunisub[6] = "seis"; 
      $matunisub[7] = "sete"; 
      $matunisub[8] = "ocho"; 
      $matunisub[9] = "nove"; 
    
      $matdec[2] = "veint"; 
      $matdec[3] = "treinta"; 
      $matdec[4] = "cuarenta"; 
      $matdec[5] = "cincuenta"; 
      $matdec[6] = "sesenta"; 
      $matdec[7] = "setenta"; 
      $matdec[8] = "ochenta"; 
      $matdec[9] = "noventa"; 
      $matsub[3]  = 'mill'; 
      $matsub[5]  = 'bill'; 
      $matsub[7]  = 'mill'; 
      $matsub[9]  = 'trill'; 
      $matsub[11] = 'mill'; 
      $matsub[13] = 'bill'; 
      $matsub[15] = 'mill'; 
      $matmil[4]  = 'millones'; 
      $matmil[6]  = 'billones'; 
      $matmil[7]  = 'de billones'; 
      $matmil[8]  = 'millones de billones'; 
      $matmil[10] = 'trillones'; 
      $matmil[11] = 'de trillones'; 
      $matmil[12] = 'millones de trillones'; 
      $matmil[13] = 'de trillones'; 
      $matmil[14] = 'billones de trillones'; 
      $matmil[15] = 'de billones de trillones'; 
      $matmil[16] = 'millones de billones de trillones'; 
      
      //Zi hack
      $float=explode('.',$num);
      $num=$float[0];
    
      $num = trim((string)@$num); 
      if ($num[0] == '-') { 
         $neg = 'menos '; 
         $num = substr($num, 1); 
      }else 
         $neg = ''; 
      while ($num[0] == '0') $num = substr($num, 1); 
      if ($num[0] < '1' or $num[0] > 9) $num = '0' . $num; 
      $zeros = true; 
      $punt = false; 
      $ent = ''; 
      $fra = ''; 
      for ($c = 0; $c < strlen($num); $c++) { 
         $n = $num[$c]; 
         if (! (strpos(".,'''", $n) === false)) { 
            if ($punt) break; 
            else{ 
               $punt = true; 
               continue; 
            } 
    
         }elseif (! (strpos('0123456789', $n) === false)) { 
            if ($punt) { 
               if ($n != '0') $zeros = false; 
               $fra .= $n; 
            }else 
    
               $ent .= $n; 
         }else 
    
            break; 
    
      } 
      $ent = '     ' . $ent; 
      if ($dec and $fra and ! $zeros) { 
         $fin = ' coma'; 
         for ($n = 0; $n < strlen($fra); $n++) { 
            if (($s = $fra[$n]) == '0') 
               $fin .= ' cero'; 
            elseif ($s == '1') 
               $fin .= $fem ? ' una' : ' un'; 
            else 
               $fin .= ' ' . $matuni[$s]; 
         } 
      }else 
         $fin = ''; 
      if ((int)$ent === 0) return 'Cero ' . $fin; 
      $tex = ''; 
      $sub = 0; 
      $mils = 0; 
      $neutro = false; 
      while ( ($num = substr($ent, -3)) != '   ') { 
         $ent = substr($ent, 0, -3); 
         if (++$sub < 3 and $fem) { 
            $matuni[1] = 'una'; 
            $subcent = 'as'; 
         }else{ 
            $matuni[1] = $neutro ? 'un' : 'uno'; 
            $subcent = 'os'; 
         } 
         $t = ''; 
         $n2 = substr($num, 1); 
         if ($n2 == '00') { 
         }elseif ($n2 < 21) 
            $t = ' ' . $matuni[(int)$n2]; 
         elseif ($n2 < 30) { 
            $n3 = $num[2]; 
            if ($n3 != 0) $t = 'i' . $matuni[$n3]; 
            $n2 = $num[1]; 
            $t = ' ' . $matdec[$n2] . $t; 
         }else{ 
            $n3 = $num[2]; 
            if ($n3 != 0) $t = ' y ' . $matuni[$n3]; 
            $n2 = $num[1]; 
            $t = ' ' . $matdec[$n2] . $t; 
         } 
         $n = $num[0]; 
         if ($n == 1) { 
            $t = ' ciento' . $t; 
         }elseif ($n == 5){ 
            $t = ' ' . $matunisub[$n] . 'ient' . $subcent . $t; 
         }elseif ($n != 0){ 
            $t = ' ' . $matunisub[$n] . 'cient' . $subcent . $t; 
         } 
         if ($sub == 1) { 
         }elseif (! isset($matsub[$sub])) { 
            if ($num == 1) { 
               $t = ' mil'; 
            }elseif ($num > 1){ 
               $t .= ' mil'; 
            } 
         }elseif ($num == 1) { 
            $t .= ' ' . $matsub[$sub] . '?n'; 
         }elseif ($num > 1){ 
            $t .= ' ' . $matsub[$sub] . 'ones'; 
         }   
         if ($num == '000') $mils ++; 
         elseif ($mils != 0) { 
            if (isset($matmil[$sub])) $t .= ' ' . $matmil[$sub]; 
            $mils = 0; 
         } 
         $neutro = true; 
         $tex = $t . $tex; 
      } 
      $tex = $neg . substr($tex, 1) . $fin; 
      //Zi hack --> return ucfirst($tex);
      $end_num=ucfirst($tex).' lempiras con '.$float[1].'/100 centavos';
      return $end_num; 
   } 
?>