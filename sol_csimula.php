<?php
	 ob_start();
    if (!isset ($_SESSION)){
	session_start();
	}
	if(!isset($_SESSION['login']) || !isset($_SESSION['clave'])){
    header("Location: index.php?error=1");
} else { 
	require('configuracion.php');
    require('funciones.php');
?>
 <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	   <a href='menu_s.php'>Salir</a>


<br>
<center>
                <strong > Simulacion Plan de Pagos </strong>
<br>

<?php
$_SESSION['form_buffer'] = $_POST;
$error_d = 0;
$_SESSION['msg_err'] = " ";
$log_usr = $_SESSION['login'];

$cod_fpa = $_POST['cod_fpa'];
$_SESSION['cod_fpa'] = $cod_fpa;
$cod_cin = $_POST['cod_cin'];
$_SESSION['cod_cin'] = $cod_cin;
$log_usr =$_SESSION['login'];
//echo $log_usr;
$imp_s = $_POST["imp_sol"];
$_SESSION['imp_sol'] = $imp_s;
$aho_d = $_POST["aho_dur"];
$_SESSION['aho_dur'] = $aho_d;
$tas_i = $_POST['tas_int'];
$_SESSION['tas_int'] = $tas_i;
$plz_m = $_POST['plz_mes'];
$_SESSION['plz_mes'] = $plz_m;
$fec_d = $_POST["fec_des"];
$_SESSION['fec_des'] = $fec_d;
$fec_1 = $_POST["fec_uno"];
$_SESSION['fec_uno'] = $fec_1;
$nro_c = $_POST["nro_cta"];
$_SESSION['nro_cta'] = $nro_c;
$mes = saca_mes($fec_1);
$dia = saca_dia($fec_1);
$anio = saca_anio($fec_1);
$dia_l = dia_semana($dia, $mes, $anio);
$_SESSION['dia_l'] = $dia_l;
                                                     
                       
 

$_SESSION['msg_err'] = ""; 
if (empty($imp_s)) {
    $error_d = 1;
    $_SESSION['msg_err'] = $_SESSION['msg_err']." -- "."Error en Importe Solicitado no puede estar vacio o cero";
	//header('Location: solic_mante_aa.php');
	}
if ($imp_s == 0) {
    $error_d = 1;
    $_SESSION['msg_err'] = $_SESSION['msg_err']." -- "."Error en Importe Solicitado no puede estar vacio o cero";
	}


	
//if (empty($tas_i)) {
//    $error_d = 1;
//    $_SESSION['msg_err'] ="Error en Tasa Interes Anual no puede estar vacio";
//	}
if ($tas_i < 0) {
    $error_d = 1;
    $_SESSION['msg_err'] =$_SESSION['msg_err']." -- "."Error en Tasa Interes Anual no puede ser menos de 20%";
	}	
if ($tas_i > 150) {
   $error_d = 1;
    $_SESSION['msg_err'] =$_SESSION['msg_err']." -- "."Error en Tasa Interes Anual no puede ser mas de 150% ";
	}
if (empty($aho_i)) {
   $aho_i = 0 ;
   }
if ($aho_i > 50) {
     $error_d = 1;
    $_SESSION['msg_err'] = $_SESSION['msg_err']." -- "."Error en Porcentaje Fondo Garantia Inicio no puede ser mas de 50% ";
	}
if (empty($aho_d)) {
    $aho_d = 0 ;
	}
if ($aho_d > 50) {
    $error_d = 1;
    $_SESSION['msg_err'] =$_SESSION['msg_err']." -- ". "Error en Porcentaje Fondo Garantia Ciclo no puede ser mas de 50% ";
	}

	
		
if (empty($plz_m)) {
    $error_d = 1;
    $_SESSION['msg_err'] = $_SESSION['msg_err']." -- "."Error plazo en meses no puede estar vacio";
	}
if ($plz_m < 0.1) {
    $error_d = 1;
    $_SESSION['msg_err'] = $_SESSION['msg_err']." -- ". "Error plazo en meses no puede ser Cero";
	}
$p_dias = $plz_m * 30;
//Valida nro cuotas
 $con_fpa = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 13 and GRAL_PAR_INT_COD = $cod_fpa";
          $res_fpa = mysql_query($con_fpa);
          while ($lin_fpa = mysql_fetch_array($res_fpa)) {
		        $nro_d = $lin_fpa['GRAL_PAR_INT_CTA1'];
				$fpag_d = $lin_fpa['GRAL_PAR_INT_DESC'];
		  }
 $con_cin = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 10 and GRAL_PAR_INT_COD = $cod_cin";
       $res_cin = mysql_query($con_cin);
	   while ($linea = mysql_fetch_array($res_cin)) {
	        $d_cin = $linea['GRAL_PAR_INT_DESC'];
	   }
	   
	   
if ($cod_fpa == 9){  
	   echo $cuantos." res";
	    $_SESSION["tot_err"] = 1;
	    header('Location: sol_csimula_v.php');
	}	   
	   
$cuotas = (round( $p_dias/$nro_d));

$dif_cta = $cuotas - $nro_c;

if ($cod_fpa <> 9) {

if ($dif_cta < 0) {
    $dif_cta = $dif_cta * -1;
	}
if ($dif_cta > 1) {
    $error_d = 1;
    $_SESSION['msg_err'] =$_SESSION['msg_err']." -- ". "Error en Nro. Cuotas en relacion a plazo y forma de pago **".$dif_cta."***".$nro_c."***".$cuotas." +++";
	}
}



if (empty($nro_c)) {
    $error_d = 1;
    $_SESSION['msg_err'] =$_SESSION['msg_err']." -- ". "Error en Numero de Cuotas no puede estar vacio o cero";
	}
if ($nro_c == 0) {
    $error_d = 1;
    $_SESSION['msg_err'] =$_SESSION['msg_err']." -- ". "Error en Numero de Cuotas no puede estar vacio o cero";
	}
if (empty($fec_d)) {
	 $error_d = 1;
    $_SESSION['msg_err'] =$_SESSION['msg_err']." -- ". "Error en Fecha Desembolso no puede estar vacio o cero";
	}else{				
   $f_des = cambiaf_a_mysql($fec_d);
   $f_pro = $_SESSION['fec_proc'];
   $ano1 = substr($f_des, 0,4); 
        $mes1 = substr($f_des, 5, 2); 
        $dia1 = substr($f_des, 8, 2);
        $ano2 = substr($f_pro, 6,4); 
        $mes2 = substr($f_pro, 3, 2); 
        $dia2 = substr($f_pro, 0, 2);
       $timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1); 
        $timestamp2 = mktime(0,0,0,$mes2,$dia2,$ano2); 
        $segundos_diferencia = $timestamp1 - $timestamp2; 
	 $dias = $segundos_diferencia / (60 * 60 * 24); 	
	
/*	if ($dias < 0){
   $error_d = 1;
    $_SESSION['msg_err'] = $_SESSION['msg_err']." -- "."Error en Fecha  Desembolso no puede ser menor a la de proceso".$f_pro.$f_des; 
}
*/	
	
	
	
  }
if (empty($fec_1)) {
	 $error_d = 1;
    $_SESSION['msg_err'] =$_SESSION['msg_err']." -- ". "Error en Fecha Primer Pago no puede estar vacio o cero";
	}				
//if (valida_fecha($fec_1)) {
    $f_uno = cambiaf_a_mysql($fec_1);
//	$dia = leer_dia($f_uno);
//	}else {
//	$error_d = 1;
 //   $_SESSION['msg_err'] = "Error en Fecha Primer Pago no es valida";
//	}
	//echo "";
        $ano1 = substr($f_des, 0,4); 
        $mes1 = substr($f_des, 5, 2); 
        $dia1 = substr($f_des, 8, 2);
        $ano2 = substr($fec_1, 6,4); 
        $mes2 = substr($fec_1, 3, 2); 
        $dia2 = substr($fec_1, 0, 2);
       $timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1); 
        $timestamp2 = mktime(0,0,0,$mes2,$dia2,$ano2); 
        $segundos_diferencia = $timestamp2 - $timestamp1; 
	 $dias = $segundos_diferencia / (60 * 60 * 24); 	
	//echo $dias;
	//$error_d = 1;
    //$_SESSION['msg_err'] ="Error en Fecha Primer Pago no puede ser menor o igual a Fecha Desembolso".$f_uno.$f_des.$dias;
if ($dias <= 0){
   $error_d = 1;
    $_SESSION['msg_err'] = $_SESSION['msg_err']." -- "."Error en Fecha Primer Pago no puede ser menor o igual a Fecha Desembolso".$f_uno.$f_des; 
}

if ($error_d == 1) {
    $error_d = 0;
    header('Location: solic_simulador.php');
    }else{
    $mes = 12;
    $tint_m = $tas_i / $mes;
    $fecha_d = date("d-m-Y", strtotime("$f_des"));
		
	$nro_d1 = $nro_d - 1;
    for ($i=1; $i < $nro_c + 1; $i = $i + 1 ) {
        if ($i == 1){
	    // echo $f_uno."f_uno";
	     $fecha_nueva = date("d-m-Y", strtotime("$f_uno"));
		 $dia_f = substr($fecha_nueva,0,2);
		// echo $fecha_nueva. "fecha nueva".$dia_f;
		 $fec_pag [1] =$fecha_nueva; 
		 }else{
		 
		  $fecha_nueva = date("d-m-Y", strtotime("$fecha_nueva + $nro_d days"));
		// echo "fec_nue". $fecha_nueva.$nro_d;
        // }
		 if ($cod_fpa == 4){
		 
		//  $fecha_nueva = date("d-m-Y", strtotime("$fecha_nueva + $nro_d days"));
		 echo "fec_nue 2". $fecha_nueva.$nro_d;
		 
		     // echo " == ". $fecha_nueva.$nro_d;
		     $mes_f = substr($fecha_nueva,3,2);
			 $anio_f = substr($fecha_nueva,6,4);
			 // echo $fecha_nueva. "dia fijo".$dia_f."mes ".$mes_f."anio".$anio_f;
			 $fec_fija = $anio_f."-". $mes_f."-". $dia_f;
			 $f_fija = date("d-m-Y", strtotime("$fec_fija"));
		    
			 //echo "fec_fija".$fec_fija."--".$f_fija;
			 $fecha_nueva = $f_fija;
		  }
		    $fec_pag [$i] =$fecha_nueva;
		}	
		// echo $fecha_nueva;
	  }
	  $aho = (($imp_s * $aho_d)/100)/ $nro_c;
		  for ($i=1; $i < $nro_c + 1; $i = $i + 1 ) {
	 	     $pag_aho[$i] = $aho;
	     }
	 $cap = $imp_s;
	 
//Cuota Fija

	 
	 if ($cod_cin == 2) { 
	 $factor1=0;
	 $factor2=0;
	 $fac1=0;
	 $fac2=0;
//FACTOR1 = (((TEA / 100) + 1) ^ (Periodo de pagos / 360) -1)			
      $fac1 = ($tas_i/83.5)+1;
	  $fac2=($nro_d / 360);
	    
	$factor1= (pow($fac1, $fac2) -1); 
	
//	echo $fac1."----".$fac2."***".$factor1;
	
//FACTOR2 = (((Factor1* (Factor1 + 1) ^ Numero Cuotas)) / (((Factor1 + 1) ^Cuotas)-1))
     $fac1 = pow(($factor1 + 1),$nro_c);
	 $fac2 = (pow(($factor1 + 1),$nro_c))-1;
	 
	// ($tas_i/100)+1;			
	$factor2=($factor1*($fac1)/$fac2);
//	echo $fac1."----".$fac2."++++".$factor2;
	
	
	  $cap = $imp_s;
	  $tint =  $tas_i/12 ;
//	 $tasa_dia = round((($tas_i/1200/30)*($nro_d-1)),2)+ 1;
	   
	  	
//	   $pot_1 = round(pow($tasa_dia, $nro_c),2); 

// CUOTA FIJA = Monto del Préstamo * Factor2 = 1000 * 0.22462709579 = 224.62

	$cuota_fija = round($imp_s*$factor2,2);  
	echo " Cuota Fija ". $cuota_fija;
//	$cuota_fija = $cuota_fija ;
		
	 for ($i=1; $i < $nro_c + 1; $i = $i + 1 ) {
    
//	echo  "imp_sol".$imp_s;
    if ($i == 1){
	   $cap = $imp_s;
     }	
	 
//ojo para ver cuanto varia	 
	// $int = ($cap * $tint);
		$int = ($cap * $factor1);
	//	echo "iinntt".$int."iinntt";
		 $pag_int[$i] = $int;	
		 $c_kap = $cuota_fija - $int; 
		 $pag_cap[$i] = $c_kap;
		 $cap = $cap - $c_kap;
		 $fec_p =  $fec_pag [$i];
	  } 
	  $tot_cap1 = 0;
	   for ($i=1; $i < $nro_c; $i = $i + 1 ) {
	 	    $tot_cap1 = $tot_cap1 + $pag_cap[$i];
	     }
	  	$pag_cap[$nro_c] =  $imp_s - $tot_cap1;
	  //if ($tot_cap > $imp_s){
	   //  $pag_cap[$nro_c] =  ($tot_cap - $imp_s);
		 
		// }
	  //if ($tot_cap < $imp_s){
	   //  $pag_int[$nro_c] =$pag_int[$nro_c] + ($tot_cap - $imp_s);
		 
		// } 	  
	  
	  }
	  
	  
	  
	  
	  
	   if ($cod_cin == 1) {   
	 	 $tint =  $tas_i/12 ;
		 $int = $imp_s*($tint/100);
		 $int = ($int*$plz_m)/$nro_c;
	    for ($i=1; $i < $nro_c + 1; $i = $i + 1 ) {
		     $pag_int[$i] = $int;
	   }
		 $cap = $imp_s / $nro_c;
		 for ($i=1; $i < $nro_c + 1; $i = $i + 1 ) {
	     $pag_cap[$i] = $cap;
	     }
		 
	}	
	// echo $dias;


}
 if ($cod_cin == 3) { 
	$cuota_cap = 0;  
	  $cap = $imp_s;
	  
	  $tint =  $tas_i/12 ;
	// $tasa_dia = round((($tas_i/1200/30)*($nro_d-1)),2)+ 1;
	   
	 //  echo $tasa_dia."tasa dia".$nro_d;	
	 //  $pot_1 = round(pow($tasa_dia, $nro_c),2); 
	$cuota_cap = $imp_s/$nro_c;  
	//echo $cuota_fija;
	//$cuota_fija = $cuota_fija+1.5;
		
	 for ($i=1; $i < $nro_c + 1; $i = $i + 1 ) {
            if ($i == 1){
			    $fec_uno = $f_des;
	            $fec_dos = $fec_pag [1];
				$ano1 = substr($fec_uno, 0,4); 
                $mes1 = substr($fec_uno, 5, 2); 
                $dia1 = substr($fec_uno, 8, 2);
               $ano2 = substr($fec_dos, 6,4); 
                $mes2 = substr($fec_dos, 3, 2); 
                $dia2 = substr($fec_dos, 0, 2);
				//$cap = round( $cap - $c_kap,2);
				}else{
				$j = $i - 1;
				$fec_uno = $fec_pag[$j];
				$fec_dos = $fec_pag[$i];
				$ano1 = substr($fec_uno, 6,4); 
                $mes1 = substr($fec_uno, 3, 2); 
                $dia1 = substr($fec_uno, 0, 2);
               $ano2 = substr($fec_dos, 6,4); 
                $mes2 = substr($fec_dos, 3, 2); 
                $dia2 = substr($fec_dos, 0, 2);
				$cap = round( $cap - $cuota_cap,2);
				}
       $timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1); 
        $timestamp2 = mktime(0,0,0,$mes2,$dia2,$ano2); 
        $segundos_diferencia = $timestamp2 - $timestamp1; 
		 $dias = round( ($segundos_diferencia / (60 * 60 * 24)),0); 
		$int = ($cap * $dias * $tint*12)/36000;
		 $pag_int[$i] = $int;	
		// $c_kap = $cuota_fija - $int; 
		 $pag_cap[$i] = $cuota_cap;
		 $fec_p =  $fec_pag [$i];
	  } 
	  $tot_cap1 = 0;
	   for ($i=1; $i < $nro_c; $i = $i + 1 ) {
	 	    $tot_cap1 = $tot_cap1 + $pag_cap[$i];
	     }
	  	$pag_cap[$nro_c] =  $imp_s - $tot_cap1;
	  //if ($tot_cap > $imp_s){
	   //  $pag_cap[$nro_c] =  ($tot_cap - $imp_s);
		 
		// }
	  //if ($tot_cap < $imp_s){
	   //  $pag_int[$nro_c] =$pag_int[$nro_c] + ($tot_cap - $imp_s);
		 
		// } 	  
	  
	  }
	   if ($cod_cin == 1) {   
	 	 $tint =  $tas_i/12 ;
		 $int = $imp_s*($tint/100);
		 $int = ($int*$plz_m)/$nro_c;
	     for ($i=1; $i < $nro_c + 1; $i = $i + 1 ) {
	 	     $pag_int[$i] = $int;
	     }
		 $cap = $imp_s / $nro_c;
		 for ($i=1; $i < $nro_c + 1; $i = $i + 1 ) {
	 	     $pag_cap[$i] = $cap;
	     }
		 
	}	
	// echo $dias;


//}
?>
<table align="center" border="1">
 <tr>   
             <th ><?php echo "Monto Solicitado";?></td>
			 <td align="right"><?php echo number_format($imp_s, 2, '.',',');?></td>
			 <th><?php echo "Tasa Int. Anual";?></td>
			 <td align="right"><?php echo number_format($tint*12, 2, '.',',');?></td>
			  <th><?php echo "Tasa Int. Mensual";?></td>
			 <td align="right"><?php echo number_format($tint, 2, '.',',');?></td>
			 
		</tr>
		 <tr>   
             <th ><?php echo "Plazo Meses";?></td>
			 <td align="right"><?php echo number_format($plz_m, 2, '.',',');?></td>
			 <th><?php echo "Nro. Cuotas";?></td>
			 <td align="right"><?php echo number_format($nro_c, 2, '.',',');?></td>
			  <th><?php echo "% Ahorro";?></td>
			 <td align="right"><?php echo number_format($aho_d, 2, '.',',');?></td>
			 
		</tr>
		 <tr>   
             <th ><?php echo "Forma de Pago";?></td>
			 <td align="right"><?php echo $fpag_d;?></td>
			 <th><?php echo "Cal. Interes";?></td>
			 <td align="right"><?php echo $d_cin;?></td>
			  <th><?php echo encadenar(2);?></td>
			 <td align="right"><?php echo encadenar(2);?></td>
			 
		</tr>
		
		 <tr>   
             <th ><?php echo "Fec. Desembolso";?></td>
			 <td align="right"><?php echo $fec_d;?></td>
			 <th><?php echo "Fec. Primer Pago";?></td>
			 <td align="right"><?php echo $fec_1;?></td>
			  <th><?php echo "Fec. Ultimo Pago";?></td>
			 <td align="right"><?php echo  $fec_pag [$nro_c];?></td>
			 
		</tr>
</table>
<br>
<table align="center" border="1">
 <tr>   
             <th align="center"><?php echo "Nro. Cuota";?></td>
			 <th><?php echo "Fec.Pago";?></td>
			 <th><?php echo "Capital";?></td>
			  <th><?php echo "Interes";?></td>
			   <th><?php echo "Ahorro";?></td>
			   <th><?php echo "Total Cta.";?></td>
			   <th><?php echo "Saldo Capital";?></td>
			   
		</tr>
<?php
$tot_cap = 0;
$tot_int = 0;
$tot_aho = 0;
for ($i=1; $i < $nro_c + 1; $i = $i + 1 ) {
 $tot_cap = $tot_cap+$pag_cap[$i];
$tot_int = $tot_int +$pag_int[$i];
$tot_aho = $tot_aho+ $pag_aho[$i];

if ($i == 1){
    $saldo = $imp_s - $pag_cap[$i];
	}else{
	$saldo = $saldo - $pag_cap[$i];
	}
?>


   
	     <tr>   
             <td align="center"><strong><?php echo $i;?></strong></td>
			 <td align="center"><?php echo $fec_pag [$i];?></td>
			 <td align="right"><?php echo number_format($pag_cap[$i], 2, '.',',');?></td>
			  <td align="right"><?php echo number_format($pag_int[$i], 2, '.',',');?></td>
			   <td align="right"><?php echo number_format($pag_aho[$i], 2, '.',',');?></td>
			   <td align="right"><?php echo number_format($pag_cap[$i]+$pag_int[$i]+$pag_aho[$i], 2, '.',',');?></td>
			    <td align="right"><?php echo number_format($saldo, 2, '.',',');?></td>
			   
		</tr>
		 	 
<?php } ?>
 <tr>   
             <td align="center"><strong><?php echo "Totales";?></strong></td>
			 <td><?php echo encadenar(2);?></td>
			 <th align="right"><?php echo number_format($tot_cap, 2, '.',',');?></td>
			  <th align="right"><?php echo number_format($tot_int, 2, '.',',');?></td>
			   <th align="right"><?php echo number_format($tot_aho, 2, '.',',');?></td>
			   <th align="right"><?php echo number_format($tot_cap[$i]+$tot_int[$i]+$tot_aho[$i], 2, '.',',');?></td>
		</tr>
</table>		

<?php
}
    ob_end_flush();
 ?>