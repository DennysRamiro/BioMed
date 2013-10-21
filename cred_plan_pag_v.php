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
    

<?php

 //$_SESSION['continuar'] = 1;
$fec = leer_param_gral();
if(isset($_SESSION['login'])){
   $log_usr = $_SESSION['login'];
   }
if(isset($_SESSION["impo_sol"])){    
   $imp_sol = $_SESSION["impo_sol"];
   }

$total = 0;
if ( $_SESSION['continuar'] == 2) {
   $quecom = $_POST['cod_sol'];
   for ($i=0; $i < count($quecom); $i = $i + 1 ) {
       if (isset($quecom[$i]) ) {
          $cod_sol = $quecom[$i];
	      $_SESSION['nro_sol'] = $cod_sol;
       }
	 $_SESSION['continuar'] = 1;  
   } 
   }else{
   $cod_sol = $_SESSION['nro_sol'];
   }
//Seleccion solicitud
//echo  "cod sol".$cod_sol."****";
//$consulta = "delete from cred_cab_plan where cred_cpla_codigo = $cod_sol";
//$resultado = mysql_query($consulta)or die('No pudo borra cred_cab_plan: ' . mysql_error());

$consulta = "delete from cred_plandp where CRED_PLD_COD_SOL = $cod_sol";
$resultado = mysql_query($consulta)or die('No pudo borra cred_plandp: ' . mysql_error());


$con_sol  = "Select * From cred_solicitud where CRED_SOL_CODIGO = $cod_sol and CRED_SOL_USR_BAJA is null"; 
$res_sol = mysql_query($con_sol)or die('No pudo seleccionarse solicitud 2');
   while ($lin_sol = mysql_fetch_array($res_sol)) {
        // echo "***".$lin_sol['CRED_SOL_CAL_INT']." *** ";
         $t_op = $lin_sol['CRED_SOL_TIPO_OPER']; 
		 $impo = $lin_sol['CRED_SOL_IMPORTE'];
		 $imp_c = $lin_sol['CRED_SOL_IMP_COM'];
		 $mon  = $lin_sol['CRED_SOL_COD_MON'];
		 $comi  = $lin_sol['CRED_SOL_TIP_COM'];
		 $comif = $lin_sol['CRED_SOL_COM_F'];
		 $ahod  = $lin_sol['CRED_SOL_AHO_DUR'];
		 $ahoi  = $lin_sol['CRED_SOL_AHO_INI'];
		 $tint  = $lin_sol['CRED_SOL_TASA'];
		 $tasa  = $lin_sol['CRED_SOL_TASA'];
		 $mes = 12;
		 $tint_m = $tint / $mes;
		 $plzm  = $lin_sol['CRED_SOL_PLZO_M'];
		 $plzd  = $lin_sol['CRED_SOL_PLZO_D'];
		 $com_f  = $lin_sol['CRED_SOL_COM_F']; 
		 $aho_f  = $lin_sol['CRED_SOL_AHO_F'];
		 $aho_fm  = $lin_sol['CRED_SOL_AHO_DM'];
		 $f_pag  = $lin_sol['CRED_SOL_FORM_PAG']; 
		 $_SESSION["fpag"] = $f_pag;
		 $f_des  = $lin_sol['CRED_SOL_FEC_DES'];
		 $f_uno  = $lin_sol['CRED_SOL_FEC_UNO'];
		 $c_int = $lin_sol['CRED_SOL_CAL_INT']; 
		 $p_int = $lin_sol['CRED_SOL_AHO_F']; 
		 $cuotas = $lin_sol['CRED_SOL_NRO_CTA'];
		 $f_des2= cambiaf_a_normal($f_des); 
		 $f_uno2= cambiaf_a_normal($f_uno); 
   }
   ?>
 <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	   <a href='cred_grab_plan_p.php'>Plan Pagos Completo</a>
	   <a href='solic_mante.php'>Salir</a>
     <?php
	   include("header.php");
 	 ?>

<?php
   if (isset($p_int)){
     if ($p_int == 1) { 
		 $tip_pagi = "C/Cta";
		 }	
	 if ($p_int == 4) { 
	     $tip_pagi = "Ant.";
	  }	
	 } 
  //Calculo Interes
   $con_cin = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 10 and GRAL_PAR_INT_COD = $c_int";
       $res_cin = mysql_query($con_cin)or die('No pudo seleccionarse tabla 10')  ;
	   while ($linea = mysql_fetch_array($res_cin)) {
	        $d_cin = $linea['GRAL_PAR_INT_DESC'];
	   }
	 $con_pin = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 11 and GRAL_PAR_INT_COD = $p_int";
       $res_pin = mysql_query($con_pin)or die('No pudo seleccionarse tabla 11')  ;
	   while ($linea = mysql_fetch_array($res_pin)) {
	        $d_pin = $linea['GRAL_PAR_INT_DESC'];
	   }   
	   
	   
	   
        $con_ahod = "Select GRAL_PAR_PRO_DESC  From gral_param_propios where GRAL_PAR_PRO_GRP = 912 and                     GRAL_PAR_PRO_COD = $ahod ";
         $res_ahod = mysql_query($con_ahod)or die('No pudo seleccionarse tabla 2')  ;
		  while ($lin_ahod = mysql_fetch_array($res_ahod)) {
		        $aho_d = $lin_ahod['GRAL_PAR_PRO_DESC'];
		  } 
          $con_fpa = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 13 and GRAL_PAR_INT_COD = $f_pag";
          $res_fpa = mysql_query($con_fpa)or die('No pudo seleccionarse tabla 3')  ;
          while ($lin_fpa = mysql_fetch_array($res_fpa)) {
		        $nro_d = $lin_fpa['GRAL_PAR_INT_CTA1'];
				$fpag_d = $lin_fpa['GRAL_PAR_INT_DESC'];
		  } 
if ($comi < 3){
    $con_comf  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 913 and GRAL_PAR_PRO_COD = $com_f ";
    $res_comf = mysql_query($con_comf)or die('No pudo seleccionarse tabla 4')  ;
	while ($lin_comf = mysql_fetch_array($res_comf)) {
	      $comi_f  = $lin_comf['GRAL_PAR_PRO_CTA1'];
	}
  }
   $con_comf = "Select GRAL_PAR_PRO_DESC,GRAL_PAR_PRO_CTA1 From gral_param_propios where GRAL_PAR_PRO_GRP = 911                    and GRAL_PAR_PRO_COD = $comif ";
         $res_comf = mysql_query($con_comf)or die('No pudo seleccionarse tabla comif')  ;
		  while ($lin_comf = mysql_fetch_array($res_comf)) {
		        $comf_d = $lin_comf['GRAL_PAR_PRO_DESC'];
				} 
if ($ahod == 1){
    $con_ahof  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 914 and GRAL_PAR_PRO_COD = $aho_f ";
    $res_ahof = mysql_query($con_ahof)or die('No pudo seleccionarse tabla 5')  ;
	while ($lin_ahof = mysql_fetch_array($res_ahof)) {
	      $aho_fa  = $lin_ahof['GRAL_PAR_PRO_CTA1'];
		  $aho_fd  = $lin_ahof['GRAL_PAR_PRO_DESC'];
	}
  }
 //numero de cuotas
  //$cuotas = (round( $plzd/$nro_d));
//fechas de las cuotas

 $int_deu = "Select * From cred_deudor where CRED_SOL_CODIGO = $cod_sol 
             and CRED_DEU_RELACION= 'C' and
             CRED_DEU_USR_BAJA is null ";
 $res_int = mysql_query($int_deu);
	while ($lin_int = mysql_fetch_array($res_int)) {
		   $cod_c = $lin_int['CRED_DEU_INTERNO'];
    }
     

 $nro_d1 = $nro_d - 1;
 for ($i=1; $i < $cuotas + 1; $i = $i + 1 ) {
     // Calculo interes lineal
   // if (($c_int == 1) or ($c_int == 4)) {
		
//		$fecha_d = date("d-m-Y", strtotime("$f_des"));
//		$fec_f = $fec_pag[$cuotas];
		//echo $fecha_d,$fec_f;
//		$tdias = $fec_f - $fecha_d;
//		$ano1 = substr($f_des, 0,4); 
 //       $mes1 = substr($f_des, 5, 2); 
  //      $dia1 = substr($f_des, 8, 2);
  //      $ano2 = substr($fec_f, 6,4); 
  //      $mes2 = substr($fec_f, 3, 2); 
  //      $dia2 = substr($fec_f, 0, 2);
   //    $timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1); 
   //     $timestamp2 = mktime(0,0,0,$mes2,$dia2,$ano2); 
    //    $segundos_diferencia = $timestamp2 - $timestamp1; 
//	 $dias = $segundos_diferencia / (60 * 60 * 24);
//	 $dias = round($dias,0); 
	 //echo $dias. " ---dias ---";
//		$int = 0;
		 /*   $tint =  $tasa/12 ;
			if ($f_pag <> 8){
			   $int = $lin_int['CRED_DEU_IMPORTE']*($tint/100);
			  $int = ($int*$plzm)/$cuotas;
			  }else{
			  //$int = $lin_int['CRED_DEU_IMPORTE']*($tint/100);
			  //$int = ($int*$plzm)/$cuotas;
		      $int = ($lin_int['CRED_DEU_IMPORTE']*$dias*$tasa)/36000;
			  }
			  //$int_t = $int*$cuotas;
			  //echo "int".$int;
			  $act_int_deudor = "update cred_deudor set CRED_DEU_INT_CTA = $int where 
	                     CRED_SOL_CODIGO = $cod_sol and CRED_DEU_INTERNO = $cli_i
						 and CRED_DEU_USR_BAJA is null";
      $res_act_int = mysql_query($act_int_deudor) or die('No pudo actualizar interes cred_deudor : ' . mysql_error());
	//      echo $cli_i, "--", $int, "--", $cod_sol;
		}
//Grabar cred_cab_plan	
$fec_1 = $fec_pag [1];
$fec_2 = $fec_pag [$cuotas];
$f_exp1 = cambiaf_a_mysql2($fec_1);
$f_exp2 = cambiaf_a_mysql2($fec_2);

//echo $fec_1, $fec_2," - ",$f_exp1," - ",$f_exp2;


//actualiza cred_cab_plan
 $consulta = "insert into cred_cab_plan (cred_cpla_codigo, cred_cpla_cal_int, cred_cpla_nro_cta, cred_cpla_fec_ini,  cred_cpla_fec_fin, cred_cpla_usr_alta, cred_cpla_fch_hr_alta, cred_cpla_usr_baja, cred_cpla_fech_hr_baja) values
 ($cod_sol,$c_int,$cuotas,'$f_exp1','$f_exp2','$log_usr', null, null,'0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar cred_cab_plan: ' . mysql_error());
//actualiza cred_deudor

 $act_int_deudor = "update cred_deudor set CRED_DEU_INT_CTA = $int where 
	                     CRED_SOL_CODIGO = $cod_sol and CRED_DEU_INTERNO = $cli_i
						 and CRED_DEU_USR_BAJA is null";
      $res_act_int = mysql_query($act_int_deudor) or die('No pudo actualizar interes cred_deudor : ' . mysql_error());
//Grabar cred_plandp
$sum_deu1 = "Select * From cred_deudor where CRED_SOL_CODIGO = $cod_sol and  CRED_DEU_USR_BAJA is null ";
 $res_sum1 = mysql_query($sum_deu1);
while ($lin_sum1 = mysql_fetch_array($res_sum1)) {
       $cod_c = $lin_sum1['CRED_DEU_INTERNO'];
	   if ($comif == 2){ 
          round($imp_k =($lin_sum1['CRED_DEU_IMPORTE'] + $lin_sum1['CRED_DEU_COMISION'])/$cuotas);
	   }
	   if ($comif == 1){ 
          round($imp_k =($lin_sum1['CRED_DEU_IMPORTE'])/$cuotas);
	   }
	 //  $imp_i =  $lin_sum1['CRED_DEU_INT_CTA']/$cuotas;
	   $imp_i =  $lin_sum1['CRED_DEU_INT_CTA'];
	   $aho_d = $lin_sum1['CRED_DEU_AHO_DUR']/$cuotas;
	   for ($i=1; $i < $cuotas + 1; $i = $i + 1 ) {
	       $fec_p =  $fec_pag [$i];
		   $fec_p2 = cambiaf_a_mysql2($fec_p); */
if ($i == 1){		   
if (isset($_SESSION['fec_1'])) {
    $fec_1 = $_SESSION['fec_1'];
    $fec_p2 = cambiaf_a_mysql2($fec_1);
    $imp_k = $_SESSION['cap_1'];
	$imp_i = $_SESSION['int_1'];
	$aho_d = $_SESSION['aho_1'];
}	
}
if ($i == 2){
if (isset($_SESSION['fec_2'])) {
    $fec_1 = $_SESSION['fec_2'];
    $fec_p2 = cambiaf_a_mysql2($fec_1);
    $imp_k = $_SESSION['cap_2'];
	$imp_i = $_SESSION['int_2'];
	$aho_d = $_SESSION['aho_2'];
}	
}
if ($i == 3){
if (isset($_SESSION['fec_3'])) {
    $fec_1 = $_SESSION['fec_3'];
    $fec_p2 = cambiaf_a_mysql2($fec_1);
    $imp_k = $_SESSION['cap_3'];
	$imp_i = $_SESSION['int_3'];
	$aho_d = $_SESSION['aho_3'];
}		   
}
if ($i == 4){
if (isset($_SESSION['fec_4'])) {
    $fec_1 = $_SESSION['fec_4'];
    $fec_p2 = cambiaf_a_mysql2($fec_1);
    $imp_k = $_SESSION['cap_4'];
	$imp_i = $_SESSION['int_4'];
	$aho_d = $_SESSION['aho_4'];
}		   
}
if ($i == 5){
if (isset($_SESSION['fec_5'])) {
    $fec_1 = $_SESSION['fec_5'];
    $fec_p2 = cambiaf_a_mysql2($fec_1);
    $imp_k = $_SESSION['cap_5'];
	$imp_i = $_SESSION['int_5'];
	$aho_d = $_SESSION['aho_5'];
}		   
}
if ($i == 6){
if (isset($_SESSION['fec_6'])) {
    $fec_1 = $_SESSION['fec_6'];
    $fec_p2 = cambiaf_a_mysql2($fec_1);
    $imp_k = $_SESSION['cap_6'];
	$imp_i = $_SESSION['int_6'];
	$aho_d = $_SESSION['aho_6'];
}		   
}
if ($i == 7){
if (isset($_SESSION['fec_7'])) {
    $fec_1 = $_SESSION['fec_7'];
    $fec_p2 = cambiaf_a_mysql2($fec_1);
    $imp_k = $_SESSION['cap_7'];
	$imp_i = $_SESSION['int_7'];
	$aho_d = $_SESSION['aho_7'];
}		   
}
if ($i == 8){
if (isset($_SESSION['fec_8'])) {
    $fec_1 = $_SESSION['fec_8'];
    $fec_p2 = cambiaf_a_mysql2($fec_1);
    $imp_k = $_SESSION['cap_8'];
	$imp_i = $_SESSION['int_8'];
	$aho_d = $_SESSION['aho_8'];
}		   
}
if ($i == 9){
if (isset($_SESSION['fec_9'])) {
    $fec_1 = $_SESSION['fec_9'];
    $fec_p2 = cambiaf_a_mysql2($fec_1);
    $imp_k = $_SESSION['cap_9'];
	$imp_i = $_SESSION['int_9'];
	$aho_d = $_SESSION['aho_9'];
}		   
}
if ($i == 10){
if (isset($_SESSION['fec_10'])) {
    $fec_1 = $_SESSION['fec_10'];
    $fec_p2 = cambiaf_a_mysql2($fec_1);
    $imp_k = $_SESSION['cap_10'];
	$imp_i = $_SESSION['int_10'];
	$aho_d = $_SESSION['aho_10'];
}		   
}
	   
$cons_plan = "insert into cred_plandp (CRED_PLD_COD_SOL, CRED_PLD_COD_CLI, CRED_PLD_NRO_CTA, CRED_PLD_FECHA,  CRED_PLD_CAPITAL, CRED_PLD_INTERES, CRED_PLD_AHORRO, CRED_PLD_USR_ALTA, CRED_PLD_FCH_HR_ALTA, CRED_PLD_USR_BAJA,CRED_PLD_FCH_HR_BAJA) values ($cod_sol, $cod_c, $i, '$fec_p2', $imp_k, $imp_i, $aho_d, '$log_usr', null, null,'0000-00-00 00:00:00')";
			$res_plan = mysql_query($cons_plan)or die('No pudo insertar cred_plandp: ' . mysql_error());
		   }
	 // }
  //}
 // Calculo interes sobre saldos decreciente
   
      $sum_deu = "Select * From cred_deudor where CRED_SOL_CODIGO = $cod_sol and  CRED_DEU_USR_BAJA is null ";
        $res_sum = mysql_query($sum_deu);
		$imp_s = 0;
		$imp_c = 0;
		$imp_sc = 0;
		$imp_ad = 0;
		$imp_ai = 0;
		while ($lin_sum = mysql_fetch_array($res_sum)) {
		      $imp_s = $imp_s + $lin_sum['CRED_DEU_IMPORTE'];
		      $imp_c = $imp_c + $lin_sum['CRED_DEU_COMISION'];
		      $imp_sc =$imp_sc + $lin_sum['CRED_DEU_IMPORTE'] + $lin_sum['CRED_DEU_COMISION']; 
			  $imp_ad = $imp_ad + $lin_sum['CRED_DEU_AHO_DUR'];
			  $imp_ai = $imp_ai + $lin_sum['CRED_DEU_AHO_INI'];
		   
		}
	 ?>
	 <br>
<center>	 
	<strong> Datos Basicos para Plan de Pagos </strong>
<table align="center" border="1">
	<tr>
	    <td><strong>  Solicitud </strong></td>
        <td><?php echo $cod_sol; ?></td>
        <td> <strong> Importe Solicitado </strong></td>
        <td align="center"><?php if(isset($_SESSION["impo_sol"])){
                  $impo = $_SESSION["impo_sol"] ;
	              }
	              $impo = $imp_s ;
	              $impo2 = number_format($impo, 2, '.',','); 
                  echo $impo2;    ?></td>
		<td> <strong> Moneda </strong></td>
        <td> <?php  if(isset($_SESSION["mon_d"])){
             echo $_SESSION["mon_d"];
	         }  ?> </td>
  </tr>	
  <tr>		 		  
	   <td><strong> Comision </strong></td>
       <td align="right"><?php $impc = $imp_c ;
	            $impoc = number_format($impc, 2, '.',','); 
                echo $impoc; ?></td>
				
       <td><strong> Forma Pag. Interes </strong></td>
       <td align="center"><?php echo $tip_pagi;    ?></td> 
		<td><strong> Tasa Interes  </strong></td>
        <td><?php echo number_format($tasa, 2, '.',',').  " % Anual"; ?></td>					   
   </tr>
 <tr>		 		  
	   <td><strong> Cobro Comision </strong></td>
       <td><?php echo $comf_d; ?></td>
	   <td><strong> Plazo </strong></td>
       <td><?php echo number_format($plzm, 2, '.',','). "  Meses  ".number_format($plzd, 2, '.',',')."  Días"; ?></td>
       <td><strong> Numero de Cuotas </strong></td>
       <td align="center"><?php echo ($cuotas);?></td>
 </tr>
 <tr>
       <td><strong> Calculo Interes  </strong></td>
       <td><?php echo $d_cin;?></td>
       <td><strong> Forma de Pago </strong></td>
       <td><?php echo $fpag_d . " cada ". $nro_d . " días";?></td>
       <td><strong> Fondo Garantia </strong></td>
       <td align="right"><?php $_SESSION["aho_d"] =  $ahod; 
           echo $ahod. " %"; ?></td>
 </tr> 
 <tr> 
      <td><strong> Fecha Desembolso </strong></td>
      <td><?php echo  $f_des2;?> </td>  
      <td><strong> Fecha 1er. Pago </strong></td>
      <td align="center"> <?php echo  $f_uno2; ?></td>  
      <td><strong> Fecha Ultimo Pago </strong></td>
      <td align="center"><?php echo  $fec_pag[$cuotas]; ?> </td>
 </tr>
 <?php  if ($c_int == 2) {?>
  <tr> 
      <th><strong> Cuota fija </strong></td>
      <th><?php echo  $cuota_fija;?> </td>  
      <td><strong>  </strong></td>
      <td align="center"> <?php echo ""; ?></td>  
      <td><strong>  </strong></td>
      <td align="center"><?php echo  " "; ?> </td>
 </tr>
 
 
 <?php }?>
 </table>
 </FONT> 
<?php	
$consulta  = "Select CRED_DEU_INTERNO, CLIENTE_COD_ID,CLIENTE_AP_PATERNO, CLIENTE_AP_MATERNO, CLIENTE_NOMBRES, CRED_DEU_RELACION,CRED_DEU_IMPORTE, CRED_DEU_COMISION, CRED_DEU_AHO_INI, CRED_PLD_CAPITAL, CRED_PLD_INTERES,CRED_PLD_AHORRO
From cliente_general, cred_deudor,cred_plandp  where CRED_SOL_CODIGO = $cod_sol and CRED_DEU_INTERNO = CLIENTE_COD
and CRED_PLD_COD_SOL = $cod_sol and CRED_PLD_COD_CLI = CLIENTE_COD and CRED_PLD_NRO_CTA = 1 
 and CRED_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null and CRED_PLD_USR_BAJA is null";
    $resultado = mysql_query($consulta);
 ?>	

		<table border="1">
	<tr>
	    <th>Rel.</th>
	   	<th>Cliente</th>
		<th>FonGar Inicio</th>
		<th>Comisión</th>
		<th>Monto Cartera</th>
		<th>FonGar Ciclo</th>
		<th>Cuota Capital</th>
		<th>Cuota Interes</th>
		<th>Cuota Total</th>
	</tr>
<?php
$monc = 0;
$intc = 0;
$cta = 0;
$t_ahoi = 0;
$t_monc = 0;
$t_comi = 0;
$t_cta  = 0;
while ($linea = mysql_fetch_array($resultado)) {
   $nom_com = $linea['CLIENTE_AP_PATERNO']. " ". $linea['CLIENTE_AP_MATERNO']." ".$linea['CLIENTE_NOMBRES'];
   $t_ahoi = $t_ahoi + $linea['CRED_DEU_AHO_INI'];
   if ($comif == 2){ 
       $monc =$linea['CRED_DEU_IMPORTE'] + $linea['CRED_DEU_COMISION'];
	   }else{
	   $monc =$linea['CRED_DEU_IMPORTE'];
	   }  
   $t_monc = $t_monc + $monc;  
   $t_comi =$t_comi + $linea['CRED_DEU_COMISION'];
   $cta_mon = $linea['CRED_PLD_CAPITAL'];
   $cta_aho = $linea['CRED_PLD_AHORRO'];
   $cta_int = $linea['CRED_PLD_INTERES'];
   $cta = $cta_mon + $cta_aho + $cta_int;
  // if ($c_int == 1) {
	  // $intc = $linea['CRED_DEU_INT_CTA']/$cuotas;
//	  $intc = $linea['CRED_DEU_INT_CTA'];
//	   }else{
//	   $intc = $linea['CRED_DEU_INT_CTA'];
//	   }
//	$cta = ($linea['CRED_DEU_AHO_DUR']/$cuotas)+($monc/$cuotas)+$intc;   
//	if ($p_int == 4){   
//	    $cta = ($linea['CRED_DEU_AHO_DUR']/$cuotas)+($monc/$cuotas);
//	    }
	$t_cta = $t_cta + $cta;
	 ?>
	 <font size="-1">
	 <tr>
	    <td align="center"><?php echo $linea['CRED_DEU_RELACION']; ?></td>
	 	<td> <font size="-1"><?php echo $nom_com; ?></font></td>
		<td align="right"><?php echo number_format($linea['CRED_DEU_AHO_INI'], 2, '.',',') ; ?></td>
		<td align="right"><?php echo number_format($linea['CRED_DEU_COMISION'], 2, '.',',') ; ?></td>
		<td align="right"><?php echo number_format($monc, 2, '.',','); ?></td>
		<td align="right"><?php echo number_format($cta_aho, 2, '.',','); ?></td>
		<td align="right"><?php echo number_format($cta_mon, 2, '.',','); ?></td>
		<td align="right"><?php echo number_format($cta_int, 2, '.',',');?> </td>
		<td align="right"><?php echo number_format($cta, 2, '.',',');?> </td>
	</tr>			
	 <?php
}
?>
       <tr>
	    <td align="right"><?php echo encadenar(3); ?></td>
	 	<th align="center"> <?php echo "Totales"; ?></th>
		<th align="right"><?php echo number_format($t_ahoi, 2, '.',',') ; ?></th>
		<th align="right"><?php echo number_format($t_comi, 2, '.',',') ; ?></th>
		<th align="right"><?php echo number_format($t_monc, 2, '.',','); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<td align="right"><?php echo encadenar(5); ?></td>
		<td align="right"><?php echo encadenar(5);?> </td>
		<th align="right"><?php echo number_format($t_cta, 2, '.',',');?> </th>
	</tr>			

</table>

<?php
 
 $_SESSION['t_cta'] = $t_cta;
?>


   <?php
		// 	include("footer_in.php");
	 ?> 

<?php
}
ob_end_flush();
 ?>