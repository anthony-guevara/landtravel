<?php
    require_once('../vendor/mpdf-5.7-php7-master/mpdf.php');
    require_once( "../clases/conexion.php");

$obj= new conectar();
$conexion=$obj->conexion();

    $hoy = getdate();
   
    $codigo=$_GET['codigo'];

    $sql="select distinct pnombre,papellido,identidad,email,cantidad,monto,des.nombre,des.descripcion,day(now()),month(now()),year(now()),fac.idfactura,round(monto*0.15,2),round(monto+(monto*0.15),2),rut.costo,tou.nombre,rut.id from factura fac 
    inner join usuario usu on usu.id=fac.usuario_id
    inner join persona per on per.usuario_id=usu.id
    inner join detalle_factura df on df.factura_idfactura=fac.idfactura
    inner join tour tou on tou.id=df.tour_id
    inner join ruta rut on rut.tour_id=tou.id
    inner join destino des on rut.destino=des.id
    where fac.idfactura=$codigo";

    $conexion=$obj->conexion();
    $result=mysqli_query($conexion,$sql);

    $veru=mysqli_fetch_row($result);

    $html .=  '
    <!--<style>@page {
      margin-top: 0.3cm;
    margin-bottom:0.3cm;

     }</style>-->
    <body>
    <header class="clearfix">
      <h1 style="color:orange">FACTURA ORIGINAL</h1>
      <div id="company" class="clearfix">
      <table id="tablefecha">
      <thead>
        <tr style="background-color: #576E87; color:white; padding: 100px 10px;">
          <th style="" class="">DIA</th>
          <th class="">MES</th>
          <th>AÑO</th>
        </tr>
      </thead>
      <tbody>
        <tr >
          <td style="font-weight: bold;text-align:center;" class="">'.$veru[8].'</td>
          <td style="font-weight: bold;text-align:center;" class="">'.$veru[9].'</td>
          <td style="font-weight: bold;text-align:center;" class="">'.$veru[10].'</td>
        </tr>
      </tbody>
    </table>
      </div>
      <img style="width:150px;position: absolute;margin-top:-65px;" src="../img/logo.png" alt="">
      <div id="project">
        <div style="margin-left:240px;font-weight: bold;"> LANDTRAVEL </div>
        <div style="margin-left:125px;"> Colonia El Comercio 300 mts a la derecha Desvio Santa Ana</div>
        <div style="margin-left:180px;"> TEGUCIGALPA M.D.C, Honduras, C.A.</div>
        <div style="margin-left:200px;"> Tel: 9999-9999  Cel:9999-9999   </div>
        <div style="margin-left:210px;"> Email:landtravelhn@gmail.com</div><div style="margin-top:-12px;margin-left:483px;position:absolute;font-weight: bold;">FACTURA ORIGINAL</div>
        <div style="margin-left:223px;font-weight: bold;"> R.T.N. 12345678912345 <div style="margin-top:-15px;margin-left:250px;position:absolute;font-weight: bold;">N° 000-000-00-'.sprintf("%08d", $codigo).'</div></div>
        <div style="margin-left:143px;font-weight: bold;"> C.A.I A1B1C1-D1F1G1-H1I1J1-K2M2L3-N4O5P5-31 <div style="margin-top:-12px;margin-left:350px;position:absolute;font-weight: bold;">Hora: '.date('g:ia').'</div> </div>
      </div>
    </header>
    <main>
    <table id="tablename">
    <thead>
      <tr style="text-align:left;background-color: #576E87; color:white; padding: 10px 10px;">
        <td style="font-weight: bold"colspan="2">Cliente:'.$veru[0].' '.$veru[1].'</td>
      </tr>
    </thead>
    <tbody>
      <tr >
        <td style="font-weight: bold;text-align:left;font-weight: bold;" class="">Identidad: '.$veru[2].' </td>
        <td style="font-weight: bold;text-align:left;font-weight: bold;" class="">Correo:'.$veru[3].' </td>
      </tr>
    </tbody>
  </table>
      <table>
        <thead>
          <tr style="background-color: #576E87; color:white;">
            <th class="">CANTIDAD</th>
            <th class="">CODIGO</th>
            <th class="">DESCRIPCION</th>
            <th>PRECIO UNITARIO</th>
         |
            <th>TOTAL</th>
          </tr>
        </thead>
        <tbody>';
        $result=mysqli_query($conexion,$sql);
        while (	$ver=mysqli_fetch_row($result))
    {	
         $html .=' <tr>
            <td class="service">'.$ver[4].'</td>
            <td class="service">'.$ver[16].'</td>
            <td  class="desc">Tour: '.$ver[15].' <br>Ruta: '.$ver[6].' '.$ver[7].'</td>
            <td style="text-align:right" class="unit">L.'.$ver[14].'</td>
            <td style="text-align:right" class="total">L.'.$ver[14   ].'</td>
          </tr>';
    }
    $nume=str_replace(',','',$veru[13]);
         $html .=' 
          
        </tbody>
    
      </table>
      <div style="font-weight: bold;"> Valor en letras: </div>
      <div>'.num2letras($nume).'</div>
      <div style="border-width: thin;border-top: solid 1px;margin-top:2px; width: 400px;"></div>
      <div id="idcorrelativo">
    <table >
    <thead>
      <tr style="text-align:left;background-color: #576E87; color:white; padding: 10px 10px;">
        <td style="font-weight: bold;font-size: 6px;">No. CORRELATIVO DE LA ORDEN DE COMPRA EXENTA </td>
        <td style="font-weight: bold;font-size: 6px;">No. CORRELATIVO DE CONSTANCIA DE REGISTRO EXONERADO</td>
        <td style="font-weight: bold;font-size: 6px;">No. IDENTIFICATIVO DEL REGISTRO DE LA SAG </td>
      </tr>
    </thead>
    <tbody>
      <tr >
        <td style="height:25px;font-weight: bold;text-align:left;font-weight: bold;" class=""></td>
        <td style="font-weight: bold;text-align:left;font-weight: bold;" class=""></td>
        <td style="font-weight: bold;text-align:left;font-weight: bold;" class=""></td>
      </tr>
    </tbody>
  </table>
  </div>
  <div style="margin-left:0px; font-size:8px;"> Original: Cliente / Copia: Obligado Tributario Emisor</div>
  <div style="margin-left:0px; font-size:8px;"> Rango Auto. 000-000-00-00000000 al 000-000-00-00090000</div>
  <div style="margin-left:0px; font-size:8px;"> Fecha limite de Emisión: 30/12/2020</div>
      <div id="notices">
      <div id="raya"></div>
       <div id="firma">
        <b> FIRMA Y SELLO</b>
       </div>
      </div>
    <table border-spacing: 2px id="tablesub">
    <thead>
      <tr style="background-color: #576E87; color:white; padding: 5px 10px;">
        <th style="text-align:right;padding: 7px 10px;" class="color-tb">Importe exonerado</th>
        <td  style="width:10px; font-weight: bold;text-align:right;color:black;" class="no-color">L.0.00</td>
      </tr>
    </thead>
    <tbody>
      <tr >
        <th  style="text-align:right; padding: 7px 10px;" class="">Importe exento</th>
        <td style="width:10px; font-weight: bold;text-align:right;" class="">L.0.00</td>
      </tr>
      <tr >
      <th  style="text-align:right; padding: 7px 10px;" class="">Importe Gravado 15%</th>
      <td style="width:85px; font-weight: bold;text-align:right;" class="">L.'.$veru[5].'</td>
    </tr>
    <tr >
    <th  style="text-align:right;padding: 7px 10px;" class="">Importe Gravado 18%</th>
    <td style="width:10px; font-weight: bold;text-align:right;" class="">L.0.00</td>
  </tr>
  <tr >
  <th  style="text-align:right; padding: 7px 10px;" class="">I.S.V. 15%</th>
  <td style="width:10px; font-weight: bold;text-align:right;" class="">L.'.$veru[12].'</td>
</tr>
<tr >
<th  style="text-align:right;padding: 7px 10px;" class="">I.S.V. 18%</th>
<td style="width:10px; font-weight: bold;text-align:right;" class="">L.0.00</td>
</tr>
<tr >
<th  style="text-align:right; padding: 7px 10px;" class="">TOTAL A PAGAR</th>
<td style="width:10px; font-weight: bold;text-align:right;" class="">L.'.$veru[13].'</td>
</tr>
    </tbody>
  </table>
    </main>
    <footer>
     Presentar esta factura a ventanilla. La factura es derecho de todos "exijala".
    </footer>' ;

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