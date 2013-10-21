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
<html>
<head>
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<?php
 $fec = leer_param_gral();
 $logi = $_SESSION['login']; 
?>
  <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <a href='cart_reportes.php'>Salir</a>
  </div>
<?php
//$_SESSION['form_buffer'] = $_POST;
$f_has ="";
$f_cal ="";
$t_cuo = 0;
$log_usr = $_SESSION['login']; 
$total = 0;
//$cod_mon = 	$_POST['cod_mon'] ;
$fec_pro = $_POST['fec_nac'] ; 
$f_pro = cambiaf_a_mysql($fec_pro); 


 ?>  
  <?php
echo encadenar(15)."Resumen Calificacion Cartera por Tipo de Operacion al ".
encadenar(2).$fec_pro.encadenar(2);
?>
<br>
<?php
echo encadenar(2)."Bolivianos";
?>
<br>
  <table border="1" width="650">
	
	<tr>
	    <th align="center">Tipo Operacion</th> 
		<th align="center">Nro. Opera.</th> 
	   	<th align="center">Saldo</th>
		<th align="center">Normales</th>
		<th align="center">Problemas Potenciales</th>
		<th align="center">Deficientes</th>
		<th align="center">Dudosos</th>
		<th align="center">Perdidos A</th>
		<th align="center">Perdidos B</th>
		<th align="center">Total</th>
		
    </tr>	
     
 <?php 
 $d_mon_1 = "";
$d_mon_2 = "";
$d_mon_3 = "";
$nro_1 = 0;
$nro_2 = 0;
$nro_3 = 0;
$mon_1 = 0;
$mon_2 = 0;
$mon_3 = 0;
   
$con_car  = "Select * From cart_maestro where CART_ESTADO between 3 and 7 and CART_COD_MON = 1
             and CART_MAE_USR_BAJA is null"; 
$res_car = mysql_query($con_car);
// while ($lin_car = mysql_fetch_array($res_car)) {

$mon_nor_1 = 0;
$mon_pot_1 = 0;
$mon_def_1 = 0;
$mon_dud_1 = 0;
$mon_per_11 = 0;
$mon_per_12 = 0;

$mon_nor_2 = 0;
$mon_pot_2 = 0;
$mon_def_2 = 0;
$mon_dud_2 = 0;
$mon_per_21 = 0;
$mon_per_22 = 0;

$mon_nor_3 = 0;
$mon_pot_3 = 0;
$mon_def_3 = 0;
$mon_dud_3 = 0;
$mon_per_31 = 0;
$mon_per_32 = 0;

$tot_tpa  = 0;
$tot_tde = 0;
 while ($lin_car = mysql_fetch_array($res_car)) {
         $cod_cre = $lin_car['CART_NRO_CRED']; 
		 $impo = $lin_car['CART_IMPORTE'];
		 $mon = $lin_car['CART_COD_MON'];
		 $est = $lin_car['CART_ESTADO'];
		 $tope = $lin_car['CART_TIPO_OPER'];
		 $nom_grp = "";
		 $d_est = "";
		 $tot_tpa  = 0;
         $tot_tde = 0;
		 
		 
		 
		   
   $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 21 and GRAL_PAR_INT_COD = $tope";
       $res_mon = mysql_query($con_mon);
	   while ($linea = mysql_fetch_array($res_mon)) {
	      if ($tope == 1){
	        $d_mon_1 = $linea['GRAL_PAR_INT_DESC'];
			}
		   if ($tope == 2){	
			$d_mon_2 = $linea['GRAL_PAR_INT_DESC'];
			}
			if ($tope == 3){	
			$d_mon_3 = $linea['GRAL_PAR_INT_DESC'];
			}
	   }
  
	  $con_est  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 809 and GRAL_PAR_PRO_COD = $est";
      $res_est = mysql_query($con_est);
	  while ($linea = mysql_fetch_array($res_est)) {
	  $d_est = $linea['GRAL_PAR_PRO_DESC'];
	  }  	
		
	//Datos del cart_det_tran						
	$con_tde = "Select * From cart_det_tran where CART_DTRA_NCRE = $cod_cre and CART_DTRA_TIP_TRAN = 1 
	            AND CART_DTRA_FECHA <= '$f_pro' and CART_DTRA_CCON = 131 
				and CART_DTRA_USR_BAJA is null";
    $res_tde = mysql_query($con_tde);
	    while ($lin_tde = mysql_fetch_array($res_tde)) {
	        $mon_tde = $lin_tde['CART_DTRA_IMPO'];
			$tot_tde = $tot_tde + $mon_tde;
			//$tot_cta = $tot_cta + 1;
			}		
	$con_tpa = "Select * From cart_det_tran where CART_DTRA_NCRE = $cod_cre and CART_DTRA_TIP_TRAN = 2 
	  AND CART_DTRA_FECHA <= '$f_pro' and  (CART_DTRA_CCON BETWEEN 131 AND 134) 
	  and CART_DTRA_USR_BAJA is null";
    $res_tpa = mysql_query($con_tpa);
	
	    while ($lin_tpa = mysql_fetch_array($res_tpa)) {
	        $mon_tpa = $lin_tpa['CART_DTRA_IMPO'];
			$tot_tpa = $tot_tpa + $mon_tpa;
			//$tot_cta = $tot_cta + 1;
			}
	$cta_venf = cta_venf($cod_cre);
	$cta_vef= cambiaf_a_normal($cta_venf);
	//dias de mora
		$ano1 = substr($cta_venf, 0,4); 
        $mes1 = substr($cta_venf, 5, 2); 
        $dia1 = substr($cta_venf, 8, 2);
        $ano2 = substr($fec, 6,4); 
        $mes2 = substr($fec, 3, 2); 
        $dia2 = substr($fec, 0, 2);
        $timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1); 
        $timestamp2 = mktime(0,0,0,$mes2,$dia2,$ano2); 
        $segundos_diferencia = $timestamp2 - $timestamp1; 
	    $dias = round($segundos_diferencia / (60 * 60 * 24),0); 		
	if ($tope == 1){
	    $nro_1 = $nro_1 + 1;
		$mon_1 = $mon_1 + ($tot_tde - $tot_tpa);
		
    	if ($dias < 6){
		    $mon_nor_1 = $mon_nor_1 + (($tot_tde - $tot_tpa)* 0.015);
			}
		 if ($dias > 5){
		    if ($dias < 31){
		    $mon_pot_1 = $mon_pot_1 + (($tot_tde - $tot_tpa)* 0.065);
			  }
			}
		 if ($dias > 30) {
		    if ($dias < 56){
		        $mon_def_1 = $mon_def_1 + (($tot_tde - $tot_tpa)* 0.20);
				}
			}
			
		 if ($dias > 55){
		     if ($dias < 76){
		 	     $mon_dud_1 = $mon_dud_1 + (($tot_tde - $tot_tpa)* 0.50);
				 }
			 }
		  if ($dias > 75){
		     if ($dias < 91){
		 	     $mon_per_11 = $mon_per_11 + (($tot_tde - $tot_tpa)* 0.80);
				 }
			 }	 
		 if ($dias > 90){
		 	$mon_per_12 = $mon_per_12 +($tot_tde - $tot_tpa);
			}	
	}	
	if ($tope == 2){
		$nro_2 = $nro_2 + 1;
		$mon_2 = $mon_2 + ($tot_tde - $tot_tpa);
    	if ($dias < 6){
		    $mon_nor_2 = $mon_nor_2 + (($tot_tde - $tot_tpa)* 0.015);
			}
		 if ($dias > 5){
		    if ($dias < 31){
		    $mon_pot_2 = $mon_pot_2 + (($tot_tde - $tot_tpa)* 0.065);
			  }
			}
		 if ($dias > 30) {
		    if ($dias < 56){
		        $mon_def_2 = $mon_def_2 + (($tot_tde - $tot_tpa)* 0.20);
				}
			}
			
		 if ($dias > 55){
		     if ($dias < 76){
		 	     $mon_dud_2 = $mon_dud_2 + (($tot_tde - $tot_tpa)* 0.50);
				 }
			 }
		  if ($dias > 75){
		     if ($dias < 91){
		 	     $mon_per_21 = $mon_per_21 + (($tot_tde - $tot_tpa)* 0.80);
				 }
			 }	 
		 if ($dias > 90){
		 	$mon_per_22 = $mon_per_22 +($tot_tde - $tot_tpa);
			}	
	}		
	if ($tope == 3){
		$nro_3 = $nro_3 + 1;
		$mon_3 = $mon_3 + ($tot_tde - $tot_tpa);
    	if ($dias < 6){
		    $mon_nor_3 = $mon_nor_3 + (($tot_tde - $tot_tpa)* 0.015);
			}
		 if ($dias > 5){
		    if ($dias < 31){
		    $mon_pot_3 = $mon_pot_3 + (($tot_tde - $tot_tpa)* 0.065);
			  }
			}
		 if ($dias > 30) {
		    if ($dias < 56){
		        $mon_def_3 = $mon_def_3 + (($tot_tde - $tot_tpa)* 0.20);
				}
			}
			
		 if ($dias > 55){
		     if ($dias < 76){
		 	     $mon_dud_3 = $mon_dud_3 + (($tot_tde - $tot_tpa)* 0.50);
				 }
			 }
		  if ($dias > 75){
		     if ($dias < 91){
		 	     $mon_per_31 = $mon_per_31 + (($tot_tde - $tot_tpa)* 0.80);
				 }
			 }	 
		 if ($dias > 90){
		 	$mon_per_32 = $mon_per_32 +($tot_tde - $tot_tpa);
			}	
	}			
 
}
	?>
		<tr>
	    <td align="left" ><?php echo $d_mon_1; ?></td>
		<td align="right" ><?php echo number_format($nro_1, 0, '.',','); ?></td>
		<td align="right" ><?php echo number_format($mon_1, 2, '.',','); ?></td>
	 	<td align="right" ><?php echo number_format($mon_nor_1, 2, '.',','); ?></td>
	    <td align="right" ><?php echo number_format($mon_pot_1, 2, '.',','); ?></td>
       	<td align="right" ><?php echo number_format($mon_def_1, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($mon_dud_1, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($mon_per_11, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($mon_per_12, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($mon_nor_1 + $mon_pot_1 +
		                                            $mon_def_1 + $mon_dud_1 +
		                                            $mon_per_11 + $mon_per_12, 2, '.',','); ?></td>
	</tr>	
	<tr>
	    <td align="left" ><?php echo $d_mon_2; ?></td>
		<td align="right" ><?php echo number_format($nro_2, 0, '.',','); ?></td>
		<td align="right" ><?php echo number_format($mon_2, 2, '.',','); ?></td>
	 	<td align="right" ><?php echo number_format($mon_nor_2, 2, '.',','); ?></td>
	    <td align="right" ><?php echo number_format($mon_pot_2, 2, '.',','); ?></td>
       	<td align="right" ><?php echo number_format($mon_def_2, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($mon_dud_2, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($mon_per_21, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($mon_per_22, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($mon_nor_2 + $mon_pot_2 +
		                                            $mon_def_2 + $mon_dud_2 +
		                                            $mon_per_21 + $mon_per_22 , 2, '.',','); ?></td>
	<tr>
	    <td align="left" ><?php echo $d_mon_3; ?></td>
		<td align="right" ><?php echo number_format($nro_3, 0, '.',','); ?></td>
		<td align="right" ><?php echo number_format($mon_3, 2, '.',','); ?></td>
	 	<td align="right" ><?php echo number_format($mon_nor_3, 2, '.',','); ?></td>
	    <td align="right" ><?php echo number_format($mon_pot_3, 2, '.',','); ?></td>
       	<td align="right" ><?php echo number_format($mon_def_3, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($mon_dud_3, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($mon_per_31, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($mon_per_32, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($mon_nor_3 + $mon_pot_3 +
		                                            $mon_def_3 + $mon_dud_3 +
		                                            $mon_per_31 + $mon_per_32, 2, '.',','); ?></td>	
		
		<tr>
	    <th align="center" ><?php echo "Total"; ?></td>
		<th align="right" ><?php echo number_format($nro_1 + $nro_2 +$nro_3, 0, '.',','); ?></td>
		<th align="right" ><?php echo number_format($mon_1+$mon_2+$mon_3,
										            2, '.',','); ?></td>
	 	<th align="right" ><?php echo number_format($mon_nor_1 + $mon_nor_2 + 
		                                            $mon_nor_3, 2, '.',','); ?></td>
	    <th align="right" ><?php echo number_format($mon_pot_1 + $mon_pot_2 + 
		                                            $mon_pot_3, 2, '.',','); ?></td>
       	<th align="right" ><?php echo number_format($mon_def_1 + $mon_def_2 + 
		                                            $mon_def_3, 2, '.',','); ?></td>
		<th align="right" ><?php echo number_format($mon_dud_1 + $mon_dud_2 + 
       		                                        $mon_dud_3, 2, '.',','); ?></td>
		<th align="right" ><?php echo number_format($mon_per_11 + $mon_per_21 + 
		                                            $mon_per_31, 2, '.',','); ?></td>
		<th align="right" ><?php echo number_format($mon_per_12 + $mon_per_22 + 
		                                            $mon_per_32, 2, '.',','); ?></td>											
		<th align="right" ><?php echo number_format($mon_nor_1 + $mon_pot_1 +
		                                            $mon_def_1 + $mon_dud_1 +
		                                            $mon_per_11 + $mon_per_12 +
		                                            $mon_nor_2 + $mon_pot_2 +
		                                            $mon_def_2 + $mon_dud_2 +
		                                            $mon_per_21 +  $mon_per_22 +
		                                            $mon_nor_3 + $mon_pot_3 +
		                                            $mon_def_3 + $mon_dud_3 +
		                                            $mon_per_31 + $mon_per_32, 2, '.',','); ?></td>
													
		
	</table> 												
	<br><br>												
 <?php
 //Dolares
echo encadenar(15)."Resumen Calificacion Cartera por Tipo de Operacion al ".
encadenar(2).$fec_pro.encadenar(2);
?>
<br>
<?php
echo encadenar(2)."Dolares";
?>
<br>
  <table border="1" width="650">
	
	<tr>
	    <th align="center">Tipo Operacion</th> 
		<th align="center">Nro. Opera.</th> 
	   	<th align="center">Saldo</th>
		<th align="center">Normales</th>
		<th align="center">Problemas Potenciales</th>
		<th align="center">Deficientes</th>
		<th align="center">Dudosos</th>
		<th align="center">Perdidos A</th>
		<th align="center">Perdidos B</th>
		<th align="center">Total</th>
		
    </tr>	
     
 <?php 
 $d_mon_1 = "SOLIDARIO";
$d_mon_2 = "OPORTUNIDAD";
$d_mon_3 = "INDIVIDUAL";
$nro_1 = 0;
$nro_2 = 0;
$nro_3 = 0;
$mon_1 = 0;
$mon_2 = 0;
$mon_3 = 0;
   
$con_car  = "Select * From cart_maestro where CART_ESTADO between 3 and 7 and CART_COD_MON = 2
             and CART_MAE_USR_BAJA is null"; 
$res_car = mysql_query($con_car);
// while ($lin_car = mysql_fetch_array($res_car)) {

$mon_nor_1 = 0;
$mon_pot_1 = 0;
$mon_def_1 = 0;
$mon_dud_1 = 0;
$mon_per_11 = 0;
$mon_per_12 = 0;

$mon_nor_2 = 0;
$mon_pot_2 = 0;
$mon_def_2 = 0;
$mon_dud_2 = 0;
$mon_per_21 = 0;
$mon_per_22 = 0;

$mon_nor_3 = 0;
$mon_pot_3 = 0;
$mon_def_3 = 0;
$mon_dud_3 = 0;
$mon_per_31 = 0;
$mon_per_32 = 0;

$tot_tpa  = 0;
$tot_tde = 0;
 while ($lin_car = mysql_fetch_array($res_car)) {
         $cod_cre = $lin_car['CART_NRO_CRED']; 
		 $impo = $lin_car['CART_IMPORTE'];
		 $mon = $lin_car['CART_COD_MON'];
		 $est = $lin_car['CART_ESTADO'];
		 $tope = $lin_car['CART_TIPO_OPER'];
		 $nom_grp = "";
		 $d_est = "";
		 $tot_tpa  = 0;
         $tot_tde = 0;
		 
		 
		 
/*		   
   $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 21 and GRAL_PAR_INT_COD = $tope";
       $res_mon = mysql_query($con_mon)or die('No pudo seleccionarse tabla 1')  ;
	   while ($linea = mysql_fetch_array($res_mon)) {
	      if ($tope == 1){
	        $d_mon_1 = $linea['GRAL_PAR_INT_DESC'];
			}
		   if ($tope == 2){	
			$d_mon_2 = $linea['GRAL_PAR_INT_DESC'];
			}
			if ($tope == 3){	
			$d_mon_3 = $linea['GRAL_PAR_INT_DESC'];
			}
	   }
 */ 
	  $con_est  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 809 and GRAL_PAR_PRO_COD = $est";
      $res_est = mysql_query($con_est);
	  while ($linea = mysql_fetch_array($res_est)) {
	  $d_est = $linea['GRAL_PAR_PRO_DESC'];
	  }  	
		
	//Datos del cart_det_tran						
	$con_tde = "Select * From cart_det_tran where CART_DTRA_NCRE = $cod_cre and CART_DTRA_TIP_TRAN = 1 
	            AND CART_DTRA_FECHA <= '$f_pro' and CART_DTRA_CCON = 131 
				and CART_DTRA_USR_BAJA is null";
    $res_tde = mysql_query($con_tde);
	    while ($lin_tde = mysql_fetch_array($res_tde)) {
	        $mon_tde = $lin_tde['CART_DTRA_IMPO'];
			$tot_tde = $tot_tde + $mon_tde;
			//$tot_cta = $tot_cta + 1;
			}		
	$con_tpa = "Select * From cart_det_tran where CART_DTRA_NCRE = $cod_cre and CART_DTRA_TIP_TRAN = 2 
	  AND CART_DTRA_FECHA <= '$f_pro' and  (CART_DTRA_CCON BETWEEN 131 AND 134) 
	  and CART_DTRA_USR_BAJA is null";
    $res_tpa = mysql_query($con_tpa);
	
	    while ($lin_tpa = mysql_fetch_array($res_tpa)) {
	        $mon_tpa = $lin_tpa['CART_DTRA_IMPO'];
			$tot_tpa = $tot_tpa + $mon_tpa;
			//$tot_cta = $tot_cta + 1;
			}
	$cta_venf = cta_venf($cod_cre);
	$cta_vef= cambiaf_a_normal($cta_venf);
	//dias de mora
		$ano1 = substr($cta_venf, 0,4); 
        $mes1 = substr($cta_venf, 5, 2); 
        $dia1 = substr($cta_venf, 8, 2);
        $ano2 = substr($fec, 6,4); 
        $mes2 = substr($fec, 3, 2); 
        $dia2 = substr($fec, 0, 2);
        $timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1); 
        $timestamp2 = mktime(0,0,0,$mes2,$dia2,$ano2); 
        $segundos_diferencia = $timestamp2 - $timestamp1; 
	    $dias = round($segundos_diferencia / (60 * 60 * 24),0); 		
	if ($tope == 1){
	    $nro_1 = $nro_1 + 1;
		$mon_1 = $mon_1 + ($tot_tde - $tot_tpa);
    	if ($dias < 6){
		    $mon_nor_1 = $mon_nor_1 + (($tot_tde - $tot_tpa)* 0.05);
			}
		 if ($dias > 5){
		    if ($dias < 31){
		    $mon_pot_1 = $mon_pot_1 + (($tot_tde - $tot_tpa)* 0.08);
			  }
			}
		 if ($dias > 30) {
		    if ($dias < 56){
		        $mon_def_1 = $mon_def_1 + (($tot_tde - $tot_tpa)* 0.20);
				}
			}
			
		 if ($dias > 55){
		     if ($dias < 76){
		 	     $mon_dud_1 = $mon_dud_1 + (($tot_tde - $tot_tpa)* 0.50);
				 }
			 }
		if ($dias > 75){
		     if ($dias < 91){
		 	     $mon_per_11 = $mon_per_11 + (($tot_tde - $tot_tpa)* 0.50);
				 }
			 }	 
		 if ($dias > 90){
		 	$mon_per_12 = $mon_per_12 +($tot_tde - $tot_tpa);
			}	
	}	
	if ($tope == 2){
		$nro_2 = $nro_2 + 1;
		$mon_2 = $mon_2 + ($tot_tde - $tot_tpa);
    	if ($dias < 6){
		    $mon_nor_2 = $mon_nor_2 + (($tot_tde - $tot_tpa)* 0.05);
			}
		 if ($dias > 5){
		    if ($dias < 31){
		    $mon_pot_2 = $mon_pot_2 + (($tot_tde - $tot_tpa)* 0.08);
			  }
			}
		 if ($dias > 30) {
		    if ($dias < 56){
		        $mon_def_2 = $mon_def_2 + (($tot_tde - $tot_tpa)* 0.20);
				}
			}
			
		 if ($dias > 55){
		     if ($dias < 76){
		 	     $mon_dud_2 = $mon_dud_2 + (($tot_tde - $tot_tpa)* 0.50);
				 }
			 }
		if ($dias > 75){
		     if ($dias < 91){
		 	     $mon_per_21 = $mon_per_21 + (($tot_tde - $tot_tpa)* 0.50);
				 }
			 }	 
		 if ($dias > 90){
		 	$mon_per_22 = $mon_per_22 +($tot_tde - $tot_tpa);
			}	
	}		
	if ($tope == 3){
		$nro_3 = $nro_3 + 1;
		$mon_3 = $mon_3 + ($tot_tde - $tot_tpa);
    	if ($dias < 6){
		    $mon_nor_3 = $mon_nor_3 + (($tot_tde - $tot_tpa)* 0.05);
			}
		 if ($dias > 5){
		    if ($dias < 31){
		    $mon_pot_3 = $mon_pot_3 + (($tot_tde - $tot_tpa)* 0.08);
			  }
			}
		 if ($dias > 30) {
		    if ($dias < 56){
		        $mon_def_3 = $mon_def_3 + (($tot_tde - $tot_tpa)* 0.20);
				}
			}
			
		 if ($dias > 55){
		     if ($dias < 76){
		 	     $mon_dud_3 = $mon_dud_3 + (($tot_tde - $tot_tpa)* 0.50);
				 }
			 }
		if ($dias > 75){
		     if ($dias < 91){
		 	     $mon_per_31 = $mon_per_31 + (($tot_tde - $tot_tpa)* 0.50);
				 }
			 }	 
		 if ($dias > 90){
		 	$mon_per_32 = $mon_per_32 +($tot_tde - $tot_tpa);
			}	
	}			
 
}
	?>
		<tr>
	    <td align="left" ><?php echo $d_mon_1; ?></td>
		<td align="right" ><?php echo number_format($nro_1, 0, '.',','); ?></td>
		<td align="right" ><?php echo number_format($mon_1, 2, '.',','); ?></td>
	 	<td align="right" ><?php echo number_format($mon_nor_1, 2, '.',','); ?></td>
	    <td align="right" ><?php echo number_format($mon_pot_1, 2, '.',','); ?></td>
       	<td align="right" ><?php echo number_format($mon_def_1, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($mon_dud_1, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($mon_per_11, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($mon_per_12, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($mon_nor_1 + $mon_pot_1 +
		                                            $mon_def_1 + $mon_dud_1 +
		                                            $mon_per_11 + $mon_per_12, 2, '.',','); ?></td>
	</tr>	
	<tr>
	    <td align="left" ><?php echo $d_mon_2; ?></td>
		<td align="right" ><?php echo number_format($nro_2, 0, '.',','); ?></td>
		<td align="right" ><?php echo number_format($mon_2, 2, '.',','); ?></td>
	 	<td align="right" ><?php echo number_format($mon_nor_2, 2, '.',','); ?></td>
	    <td align="right" ><?php echo number_format($mon_pot_2, 2, '.',','); ?></td>
       	<td align="right" ><?php echo number_format($mon_def_2, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($mon_dud_2, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($mon_per_21, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($mon_per_22, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($mon_nor_2 + $mon_pot_2 +
		                                            $mon_def_2 + $mon_dud_2 +
		                                            $mon_per_21 + $mon_per_22 , 2, '.',','); ?></td>
	<tr>
	    <td align="left" ><?php echo $d_mon_3; ?></td>
		<td align="right" ><?php echo number_format($nro_3, 0, '.',','); ?></td>
		<td align="right" ><?php echo number_format($mon_3, 2, '.',','); ?></td>
	 	<td align="right" ><?php echo number_format($mon_nor_3, 2, '.',','); ?></td>
	    <td align="right" ><?php echo number_format($mon_pot_3, 2, '.',','); ?></td>
       	<td align="right" ><?php echo number_format($mon_def_3, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($mon_dud_3, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($mon_per_31, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($mon_per_32, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($mon_nor_3 + $mon_pot_3 +
		                                            $mon_def_3 + $mon_dud_3 +
		                                            $mon_per_31 + $mon_per_32, 2, '.',','); ?></td>	
		
		<tr>
	    <th align="center" ><?php echo "Total"; ?></td>
		<th align="right" ><?php echo number_format($nro_1 + $nro_2 +$nro_3, 0, '.',','); ?></td>
		<th align="right" ><?php echo number_format($mon_1+$mon_2+$mon_3,
										            2, '.',','); ?></td>
	 	<th align="right" ><?php echo number_format($mon_nor_1 + $mon_nor_2 + 
		                                            $mon_nor_3, 2, '.',','); ?></td>
	    <th align="right" ><?php echo number_format($mon_pot_1 + $mon_pot_2 + 
		                                            $mon_pot_3, 2, '.',','); ?></td>
       	<th align="right" ><?php echo number_format($mon_def_1 + $mon_def_2 + 
		                                            $mon_def_3, 2, '.',','); ?></td>
		<th align="right" ><?php echo number_format($mon_dud_1 + $mon_dud_2 + 
       		                                        $mon_dud_3, 2, '.',','); ?></td>
		<th align="right" ><?php echo number_format($mon_per_11 + $mon_per_21 + 
		                                            $mon_per_31, 2, '.',','); ?></td>
		<th align="right" ><?php echo number_format($mon_per_12 + $mon_per_22 + 
		                                            $mon_per_32, 2, '.',','); ?></td>											
		<th align="right" ><?php echo number_format($mon_nor_1 + $mon_pot_1 +
		                                            $mon_def_1 + $mon_dud_1 +
		                                            $mon_per_11 + $mon_per_12 +
		                                            $mon_nor_2 + $mon_pot_2 +
		                                            $mon_def_2 + $mon_dud_2 +
		                                            $mon_per_21 +  $mon_per_22 +
		                                            $mon_nor_3 + $mon_pot_3 +
		                                            $mon_def_3 + $mon_dud_3 +
		                                            $mon_per_31 + $mon_per_32, 2, '.',','); ?></td>
														
		
	</table> 												
	<br><br>
	
	
	
	<?php
       
    ?>	  
</table>		  
<br>
 

</center>

<?php
		 	include("footer_in.php");
		 ?>

</div>
</body>
</html>



<?php
}
ob_end_flush();
 ?>

