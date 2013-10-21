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
$consulta = "delete from cred_cab_plan where cred_cpla_codigo = $cod_sol";
$resultado = mysql_query($consulta)or die('No pudo borra cred_cab_plan: ' . mysql_error());

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
	    <?php if ($_SESSION["fpag"] <> 9){ ?> 
	   <a href='cred_grab_plan_p.php'>Plan Pagos Completo</a>
	   <?php }else{ ?> 
	    <a href='sol_csimula_v2.php'>Plan Pagos Variable</a>
	   <?php } ?> 
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
 $nro_d1 = $nro_d - 1;
 for ($i=1; $i < $cuotas + 1; $i = $i + 1 ) {
     if ($i == 1){
	    // echo $f_uno."f_uno";
	     $fecha_nueva = date("d-m-Y", strtotime("$f_uno"));
		 $dia_f = substr($fecha_nueva,0,2);
		 $fec_pag [1] =$fecha_nueva; 
		// echo $fecha_nueva. "fecha nueva".$dia_f;
		 }else{
		  $fecha_nueva = date("d-m-Y", strtotime("$fecha_nueva + $nro_d days"));
        // }
		 if ($f_pag == 4){
		  //  $fecha_nueva = date("d-m-Y", strtotime("$fecha_nueva + $nro_d days")); 
		     $mes_f = substr($fecha_nueva,3,2);
			 $anio_f = substr($fecha_nueva,6,4);
			 $fec_fija = $anio_f."-". $mes_f."-". $dia_f;
			 $f_fija = date("d-m-Y", strtotime("$fec_fija"));
		     //echo $fecha_nueva. "dia fijo".$dia_f."mes ".$mes_f."anio".$anio_f;
			// echo "fec_fija".$fec_fija."--".$f_fija;
			 $fecha_nueva = $f_fija;
			}
		 $fec_pag [$i] =$fecha_nueva;
		} 
		 //echo $fecha_nueva;
		  }
// Calculo interes lineal
    if (($c_int == 1) or ($c_int == 4)) {
	
       $int_deu = "Select * From cred_deudor where CRED_SOL_CODIGO = $cod_sol and  CRED_DEU_USR_BAJA is null ";
        $res_int = mysql_query($int_deu);
		
		$fecha_d = date("d-m-Y", strtotime("$f_des"));
		
		$fec_f = $fec_pag[$cuotas];
		//echo $fecha_d,$fec_f;
		$tdias = $fec_f - $fecha_d;
		$ano1 = substr($f_des, 0,4); 
        $mes1 = substr($f_des, 5, 2); 
        $dia1 = substr($f_des, 8, 2);
        $ano2 = substr($fec_f, 6,4); 
        $mes2 = substr($fec_f, 3, 2); 
        $dia2 = substr($fec_f, 0, 2);
       $timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1); 
        $timestamp2 = mktime(0,0,0,$mes2,$dia2,$ano2); 
        $segundos_diferencia = $timestamp2 - $timestamp1; 
	 $dias = $segundos_diferencia / (60 * 60 * 24);
	 $dias = round($dias,0); 
	 //echo $dias. " ---dias ---";
		$int = 0;
	while ($lin_int = mysql_fetch_array($res_int)) {
		   $cli_i = $lin_int['CRED_DEU_INTERNO'];
		    $tint =  $tasa/12 ;
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
		   $fec_p2 = cambiaf_a_mysql2($fec_p);
		    $cons_plan = "insert into cred_plandp (CRED_PLD_COD_SOL, CRED_PLD_COD_CLI, CRED_PLD_NRO_CTA, CRED_PLD_FECHA,  CRED_PLD_CAPITAL, CRED_PLD_INTERES, CRED_PLD_AHORRO, CRED_PLD_USR_ALTA, CRED_PLD_FCH_HR_ALTA, CRED_PLD_USR_BAJA,CRED_PLD_FCH_HR_BAJA) values ($cod_sol, $cod_c, $i, '$fec_p2', $imp_k, $imp_i, $aho_d, '$log_usr', null, null,'0000-00-00 00:00:00')";
			$res_plan = mysql_query($cons_plan)or die('No pudo insertar cred_plandp: ' . mysql_error());
		   }
	  }
  }
 // Calculo interes sobre saldos decreciente
    if ($c_int == 3) {
	    //actualiza cred_cab_plan
			$fec_1 = $fec_pag [1];
            $fec_2 = $fec_pag [$cuotas];
            $f_exp1 = cambiaf_a_mysql2($fec_1);
            $f_exp2 = cambiaf_a_mysql2($fec_2);
            $consulta = "insert into cred_cab_plan (cred_cpla_codigo, cred_cpla_cal_int, cred_cpla_nro_cta,            cred_cpla_fec_ini,  cred_cpla_fec_fin, cred_cpla_usr_alta, cred_cpla_fch_hr_alta, cred_cpla_usr_baja,            cred_cpla_fech_hr_baja) values ($cod_sol,$c_int,$cuotas,'$f_exp1','$f_exp2','$log_usr', null,            null,'0000-00-00 00:00:00')";
           $resultado = mysql_query($consulta)or die('No pudo insertar cred_cab_plan: ' . mysql_error());
//Detalle plan de pagos
   $sum_deu1 = "Select * From cred_deudor where CRED_SOL_CODIGO = $cod_sol and  CRED_DEU_USR_BAJA is null ";
       $res_sum1 = mysql_query($sum_deu1);
while ($lin_sum1 = mysql_fetch_array($res_sum1)) {
       $cod_c = $lin_sum1['CRED_DEU_INTERNO'];
	   if ($comif == 2){ 
	      $cap = $lin_sum1['CRED_DEU_IMPORTE'] + $lin_sum1['CRED_DEU_COMISION'];
	      }
		if ($comif == 1){ 
	      $cap = $lin_sum1['CRED_DEU_IMPORTE'];
	      }  
	    $aho_d = $lin_sum1['CRED_DEU_AHO_DUR']/$cuotas;
	   $c_kap = $cap/$cuotas;
	   //echo "calculo sobre saldos decreciente" ,$cap, $c_kap,$fec_uno,$fec_dos;
	   for ($i=1; $i < $cuotas + 1; $i = $i + 1 ) {
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
				$cap = round( $cap - $c_kap,2);
				}
        $timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1); 
        $timestamp2 = mktime(0,0,0,$mes2,$dia2,$ano2); 
        $segundos_diferencia = $timestamp2 - $timestamp1; 
		 $dias = $segundos_diferencia / (60 * 60 * 24);
		 $dias = round($dias,0);
		// echo "ddd".$dias."..."; 
	if (($c_int == 1) or ($c_int == 2)) {	 
		$int = ($cap * $dias * $tint)/36000;
	}
	if ($c_int == 3){
		 $tasa_dia = round((($tint/1200/30)*$nro_d),2)+ 1;
		 $pot_1 = round(pow($tasa_dia, $cuotas),2); 
	$cuota_fija = round($cap*($tasa_dia-1)*$pot_1/($pot_1-1),2);  
	   
		$int = $cuota_fija - $tasa_dia;
		
	}			
		// echo $dias, " -- ", $cap , " --- ",$int;
		 if ($i == 1){
		    //actualiza cred_deudor
            // echo $i ,"----",$dias, " -- ", $cap , " --- ",$int;
            $act_int_deudor = "update cred_deudor set CRED_DEU_INT_CTA = $int where 
	                          CRED_SOL_CODIGO = $cod_sol and CRED_DEU_INTERNO = $cod_c
				     		  and CRED_DEU_USR_BAJA is null";
            $res_act_int = mysql_query($act_int_deudor) or die('No pudo actualizar interes cred_deudor : ' .            mysql_error());
		  }
		 $fec_p =  $fec_pag [$i];
		 $fec_p2 = cambiaf_a_mysql2($fec_p);
    	 $cons_plan = "insert into cred_plandp (CRED_PLD_COD_SOL, CRED_PLD_COD_CLI, CRED_PLD_NRO_CTA, CRED_PLD_FECHA,  CRED_PLD_CAPITAL, CRED_PLD_INTERES, CRED_PLD_AHORRO, CRED_PLD_USR_ALTA, CRED_PLD_FCH_HR_ALTA, CRED_PLD_USR_BAJA,CRED_PLD_FCH_HR_BAJA) values ($cod_sol, $cod_c, $i, '$fec_p2', $c_kap, $int, $aho_d, '$log_usr', null, null,'0000-00-00 00:00:00')";
			$res_plan = mysql_query($cons_plan)or die('No pudo insertar cred_plandp: ' . mysql_error());
		  }
		 }
      }
  // Calculo interes sobre saldos fija
    if ($c_int == 2) {
	    //actualiza cred_cab_plan
			$fec_1 = $fec_pag [1];
            $fec_2 = $fec_pag [$cuotas];
            $f_exp1 = cambiaf_a_mysql2($fec_1);
            $f_exp2 = cambiaf_a_mysql2($fec_2);
            $consulta = "insert into cred_cab_plan (cred_cpla_codigo, cred_cpla_cal_int, cred_cpla_nro_cta,            cred_cpla_fec_ini,  cred_cpla_fec_fin, cred_cpla_usr_alta, cred_cpla_fch_hr_alta, cred_cpla_usr_baja,            cred_cpla_fech_hr_baja) values ($cod_sol,$c_int,$cuotas,'$f_exp1','$f_exp2','$log_usr', null,            null,'0000-00-00 00:00:00')";
             $resultado = mysql_query($consulta)or die('No pudo insertar cred_cab_plan: ' . mysql_error());
//Detalle plan de pagos
	   $sum_deu1 = "Select * From cred_deudor where CRED_SOL_CODIGO = $cod_sol and  CRED_DEU_USR_BAJA is null ";
       $res_sum1 = mysql_query($sum_deu1);
while ($lin_sum1 = mysql_fetch_array($res_sum1)) {
       $cod_c = $lin_sum1['CRED_DEU_INTERNO'];
	   $cap = $lin_sum1['CRED_DEU_IMPORTE'];
	   $imp_s = $cap;
	   $aho_d = $lin_sum1['CRED_DEU_AHO_DUR']/$cuotas;
	   //variables
	    $factor1=0;
	 $factor2=0;
	 $fac1=0;
	 $fac2=0;
//FACTOR1 = (((TEA / 100) + 1) ^ (Periodo de pagos / 360) -1)			
      $fac1 = ($tasa/83.5)+1;
	  $fac2=($nro_d / 360);
	    
	$factor1= (pow($fac1, $fac2) -1); 
	 $fac1 = pow(($factor1 + 1),$cuotas);
	 $fac2 = (pow(($factor1 + 1),$cuotas))-1;
	 
	// ($tas_i/100)+1;			
	$factor2=($factor1*($fac1)/$fac2);
	$cuota_fija = round($imp_s*$factor2,2);  
	
	   
	   
	//   $tasa_dia = round((($tint/1200/30)*$nro_d),2)+ 1;
	   
	 //  echo $tasa_dia;
	//$pot_1 = round(pow($tasa_dia, $cuotas),2); 
//	$cuota_fija = round($cap*($tasa_dia-1)*$pot_1/($pot_1-1),2);  
	   
//	   echo " - ".$cuota_fija."cuota".$pot_1." ".$cuotas."---cap".$cap;
//   echo "cuota_fija ", $cuota_fija, "--";
	   for ($i=1; $i < $cuotas + 1; $i = $i + 1 ) {
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
				$cap = round( $cap - $c_kap,2);
				}
       $timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1); 
        $timestamp2 = mktime(0,0,0,$mes2,$dia2,$ano2); 
        $segundos_diferencia = $timestamp2 - $timestamp1; 
		 $dias = round( ($segundos_diferencia / (60 * 60 * 24)),0); 
		 
		$int = ($cap * $factor1);		
		// echo $dias, " -- ", $cap , " --- ",$int;
		 if ($i == 1){
		    //actualiza cred_deudor
            // echo $i ,"----",$dias, " -- ", $cap , " --- ",$int;
            $act_int_deudor = "update cred_deudor set CRED_DEU_INT_CTA = $int where 
	                          CRED_SOL_CODIGO = $cod_sol and CRED_DEU_INTERNO = $cod_c
				     		  and CRED_DEU_USR_BAJA is null";
            $res_act_int = mysql_query($act_int_deudor) or die('No pudo actualizar interes cred_deudor : ' .            mysql_error());
		  }
		 $c_kap = $cuota_fija - $int; 
		 $fec_p =  $fec_pag [$i];
		 $fec_p2 = cambiaf_a_mysql2($fec_p);
    	 $cons_plan = "insert into cred_plandp (CRED_PLD_COD_SOL, CRED_PLD_COD_CLI, CRED_PLD_NRO_CTA, CRED_PLD_FECHA,  CRED_PLD_CAPITAL, CRED_PLD_INTERES, CRED_PLD_AHORRO, CRED_PLD_USR_ALTA, CRED_PLD_FCH_HR_ALTA, CRED_PLD_USR_BAJA,CRED_PLD_FCH_HR_BAJA) values ($cod_sol, $cod_c, $i, '$fec_p2', $c_kap, $int, $aho_d, '$log_usr', null, null,'0000-00-00 00:00:00')";
			$res_plan = mysql_query($cons_plan)or die('No pudo insertar cred_plandp: ' . mysql_error());
		  }
		 }
//iguala centavos

		 
 $sum_deu = "Select * From cred_deudor where CRED_SOL_CODIGO = $cod_sol
             and  CRED_DEU_IMPORTE > 0
			 and  CRED_DEU_USR_BAJA is null ";
 $res_sum = mysql_query($sum_deu);
 $imp_s = 0;
 $imp_c = 0;
	while ($lin_sum = mysql_fetch_array($res_sum)) {
		   $imp_s = $lin_sum['CRED_DEU_IMPORTE'];
		   $cod_c = $lin_sum['CRED_DEU_INTERNO'];
		   $sum_cap = "Select sum(CRED_PLD_CAPITAL) From cred_plandp
		               where CRED_PLD_COD_SOL = $cod_sol
	                   and  CRED_PLD_COD_CLI = $cod_c
				       and  CRED_PLD_USR_BAJA is null";
           $res_cap = mysql_query($sum_cap);
	       while ($lin_cap = mysql_fetch_array($res_cap)) {
		          $imp_c = round($lin_cap['sum(CRED_PLD_CAPITAL)'],2);
		 		}
		  		
		   $dif = 0;
		  // echo $imp_s."----".$imp_c;		
		   if ($imp_s <>$imp_c){
		   $consulta  = "SELECT CRED_PLD_NRO_CTA FROM cred_plandp 
		                 where CRED_PLD_COD_SOL = $cod_sol
	                     and  CRED_PLD_COD_CLI = $cod_c
				         and  CRED_PLD_USR_BAJA is null ORDER BY CRED_PLD_NRO_CTA
			             DESC LIMIT 0,1";
          $resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla 999');
          $linea = mysql_fetch_array($resultado);
          $nro_cta = $linea['CRED_PLD_NRO_CTA'];
		   
		       $dif = $imp_s - $imp_c;
			   if ($dif < 0){
			       $dif = $dif * -1;
		         $act_ult_cta  = "update cred_plandp set CRED_PLD_CAPITAL=CRED_PLD_CAPITAL - $dif
  where CRED_PLD_COD_SOL = $cod_sol and  CRED_PLD_COD_CLI = $cod_c
  and CRED_PLD_NRO_CTA = $nro_cta
  and CRED_PLD_USR_BAJA is null";
   $res_ult_cta = mysql_query($act_ult_cta) or die('No pudo actualizar cred_solicitud : ' . mysql_error());	 
			}else{
			  $act_ult_cta  = "update cred_plandp set CRED_PLD_CAPITAL=CRED_PLD_CAPITAL + $dif
  where CRED_PLD_COD_SOL = $cod_sol and  CRED_PLD_COD_CLI = $cod_c
  and CRED_PLD_NRO_CTA = $nro_cta
  and CRED_PLD_USR_BAJA is null";
   $res_ult_cta = mysql_query($act_ult_cta) or die('No pudo actualizar cred_solicitud : ' . mysql_error());
   
	}			 
				 
		   }  
		
			  
	}
 
		 
		 
		 
		 
      }
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