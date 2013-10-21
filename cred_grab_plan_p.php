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
	$fec = leer_param_gral();
?>
<link href="css/estilo.css" rel="stylesheet" type="text/css"> 
<script language="javascript" src="script/validarForm.js"></script> 
</head>
<body>	
<div id="cuerpoModulo">
     <?php
	   include("header.php");
 	 ?>
<div id="UserData">
     <img src="images/24x24/001_20.png" border="0" align="absmiddle" alt="Home" />
	 </div>
<div id="Salir">
     <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
</div>
<center>
<div id="TitleModulo">
   	 <img src="images/24x24/001_36.png" border="0" alt="Modulo">			
           Grabar Plan de Pagos 
	</div>
<div id="AtrasBoton">
    <a href="solic_mante.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
</div>
<center>
<div id="GeneralManSolicaa">
<font color="#0000FF"
 <br>
<?php
if(isset($_SESSION['login'])){
  $log_usr = $_SESSION['login']; 
  }
if(isset($_SESSION["impo_sol"])){ 
   $imp_sol = $_SESSION["impo_sol"];
   }
//echo $_SESSION['nro_sol'], "codigo sol";
$total = 0;
if ( $_SESSION['continuar'] == 2) {
   $quecom = $_POST['cod_sol'];
   for ($i=0; $i < count($quecom); $i = $i + 1 ) {
       if (isset($quecom[$i]) ) {
          $cod_sol = $quecom[$i];
	      $_SESSION['nro_sol'] = $nro_sol;
       }
   } 
   }else{
   $cod_sol = $_SESSION['nro_sol'];
   }
//Seleccion solicitud
//echo $cod_sol;
$con_sol  = "Select * From cred_solicitud where CRED_SOL_CODIGO = $cod_sol and CRED_SOL_USR_BAJA is null"; 
$res_sol = mysql_query($con_sol)or die('No pudo seleccionarse solicitud 2');
   while ($lin_sol = mysql_fetch_array($res_sol)) {
         $t_op = $lin_sol['CRED_SOL_TIPO_OPER']; 
		 $impo = $lin_sol['CRED_SOL_IMPORTE'];
		 $mon  = $lin_sol['CRED_SOL_COD_MON'];
		 $comi  = $lin_sol['CRED_SOL_TIP_COM'];
		 $ahod  = $lin_sol['CRED_SOL_AHO_DUR'];
		 $ahoi  = $lin_sol['CRED_SOL_AHO_INI'];
		 $tint  = $lin_sol['CRED_SOL_TASA'];
		 $plzm  = $lin_sol['CRED_SOL_PLZO_M'];
		 $plzd  = $lin_sol['CRED_SOL_PLZO_D'];
		 $comif = $lin_sol['CRED_SOL_COM_F'];
		 $aho_f  = $lin_sol['CRED_SOL_AHO_F'];
		 $aho_fm  = $lin_sol['CRED_SOL_AHO_DM'];
		 $f_pag  = $lin_sol['CRED_SOL_FORM_PAG']; 
		 $f_des  = $lin_sol['CRED_SOL_FEC_DES'];
		 $f_uno  = $lin_sol['CRED_SOL_FEC_UNO']; 
		 $c_int = $lin_sol['CRED_SOL_CAL_INT']; 
		 $p_int = $lin_sol['CRED_SOL_AHO_F'];
		 $cuotas = $lin_sol['CRED_SOL_NRO_CTA'];
		 $f_des2= cambiaf_a_normal($f_des); 
		 $f_uno2= cambiaf_a_normal($f_uno);
   }
    //Calculo Interes
	   $con_cin = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 10 and GRAL_PAR_INT_COD = $c_int";
       $res_cin = mysql_query($con_cin)or die('No pudo seleccionarse tabla')  ;
	   while ($linea = mysql_fetch_array($res_cin)) {
	        $d_cin = $linea['GRAL_PAR_INT_DESC'];
	   }
 $con_pin = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 11 and GRAL_PAR_INT_COD = $p_int";
       $res_pin = mysql_query($con_pin)or die('No pudo seleccionarse tabla 1')  ;
	   while ($linea = mysql_fetch_array($res_pin)) {
	        $d_pin = $linea['GRAL_PAR_INT_DESC'];
	   } 	   
	   
	   
	   
	   
       $con_fpa = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 13 and GRAL_PAR_INT_COD = $f_pag";
       $res_fpa = mysql_query($con_fpa)or die('No pudo seleccionarse tabla')  ;
       while ($lin_fpa = mysql_fetch_array($res_fpa)) {
	          $nro_d = $lin_fpa['GRAL_PAR_INT_CTA1'];
			  $fpag_d = $lin_fpa['GRAL_PAR_INT_DESC'];
		      } 
$con_comf = "Select GRAL_PAR_PRO_DESC,GRAL_PAR_PRO_CTA1 From gral_param_propios where GRAL_PAR_PRO_GRP = 911                    and GRAL_PAR_PRO_COD = $comif ";
         $res_comf = mysql_query($con_comf)or die('No pudo seleccionarse tabla comif')  ;
		  while ($lin_comf = mysql_fetch_array($res_comf)) {
		        $comf_d = $lin_comf['GRAL_PAR_PRO_DESC'];
				} 			  
 //fechas de las cuotas
 $nro_d1 = $nro_d - 1;
/* $con_pla  = "Select CRED_PLD_NRO_CTA,CRED_PLD_FECHA
		             From cred_plandp where  CRED_PLD_COD_SOL = $cod_sol and CRED_PLD_COD_CLI = $c_clie
					 and CRED_PLD_USR_BAJA is null";
        $res_pla = mysql_query($con_pla);
		
		//   $lin_plan['CRED_PLD_INTERES'] = 0;
		  // }
		while ($lin_pla = mysql_fetch_array($res_pla)) {
		       $i = $lin_pla['CRED_PLD_NRO_CTA'];
                $fec_pag [$i] = $lin_pla['CRED_PLD_FECHA'];
        }
 */
 
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
		 $fecha_nueva = date("d-m-Y", strtotime("$fecha_nueva + $nro_d days"));
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
	    ?>
	  <?php 
	 $sum_deu = "Select * From cred_deudor where CRED_SOL_CODIGO = $cod_sol and  CRED_DEU_USR_BAJA is null ";
        $res_sum = mysql_query($sum_deu);
		$imp_s = 0;
		$imp_c = 0;
		$imp_sc = 0;
		$imp_ad = 0;
		$imp_ai = 0;
		//$nro_clie = 0;
		while ($lin_sum = mysql_fetch_array($res_sum)) {
		  //    $nro_clie = $nro_clie + 1;
		      $imp_s = $imp_s + $lin_sum['CRED_DEU_IMPORTE'];
		      $imp_c = $imp_c + $lin_sum['CRED_DEU_COMISION'];
			  if ($comif == 2){ 
		         $imp_sc =$imp_sc + $lin_sum['CRED_DEU_IMPORTE'] + $lin_sum['CRED_DEU_COMISION']; 
			  }
			  if ($comif == 1){ 
		         $imp_sc =$imp_sc + $lin_sum['CRED_DEU_IMPORTE']; 
			  }
			  $imp_ad = $imp_ad + $lin_sum['CRED_DEU_AHO_DUR'];
			  $imp_ai = $imp_ai + $lin_sum['CRED_DEU_AHO_INI'];
			 // $cliente[$nro_clie] = $lin_sum['CRED_DEU_INTERNO'];
			 // $clie_plan = array ("cod_cli"  => array ($nro_clie => $lin_sum['CRED_DEU_INTERNO']));
		 	}
	//Redondear Capital
	$con_redo  = "Select CRED_DEU_INTERNO,CRED_DEU_IMPORTE, CRED_DEU_COMISION, CRED_DEU_AHO_INI, CRED_DEU_AHO_DUR                  From cred_deudor where CRED_SOL_CODIGO = $cod_sol and CRED_DEU_USR_BAJA is null";
    $res_redo = mysql_query($con_redo)or die('No pudo seleccionarse cred_deudor red');
	while ($lin_redo = mysql_fetch_array($res_redo)) {
	      $cli_redo = $lin_redo['CRED_DEU_INTERNO'];
		  if ($comif == 2){
		     $kap_redo = $lin_redo['CRED_DEU_IMPORTE'] + $lin_redo['CRED_DEU_COMISION'];
		  }
		  if ($comif == 1){
		     $kap_redo = $lin_redo['CRED_DEU_IMPORTE'];
		  }
	      $con_rpla  = "Select CRED_PLD_CAPITAL From cred_plandp where CRED_PLD_COD_SOL = $cod_sol and 
	                    CRED_PLD_COD_CLI = $cli_redo and CRED_PLD_USR_BAJA is null";
          $res_rpla = mysql_query($con_rpla) or die('No pudo seleccionarse cred_plandp red');
	$t_kap = 0;
	if(isset($ult_p)){
	   $f_ult = cambiaf_a_mysql2($ult_p);
	   }      
	while ($lin_rpla = mysql_fetch_array($res_rpla)) {
	       $t_kap = $t_kap + $lin_rpla['CRED_PLD_CAPITAL'];
		   $ult_cta = $lin_rpla['CRED_PLD_CAPITAL'];
		  }
		  $dif = round ($t_kap - $kap_redo,2);
		  if ($dif > 0) {
		     $dif_a = $ult_cta +$dif;
		     $act_kpla  = "Update cred_plandp set CRED_PLD_CAPITAL = $dif_a where CRED_PLD_COD_SOL = $cod_sol and 
	                    CRED_PLD_COD_CLI = $cli_redo  and CRED_PLD_NRO_CTA= $cuotas and CRED_PLD_USR_BAJA is null";
			 $res_actp = mysql_query($act_kpla) or die('No pudo actualizr cred_plandp ult'. mysql_error());
		      //echo "actualiza +", $dif_a, $cod_sol, $cli_redo, $cuotas;
			  } 
		  if ($dif < 0) {
		      $dif_a = $ult_cta - $dif;
		      $act_kpla  = "Update cred_plandp set CRED_PLD_CAPITAL =$dif_a where CRED_PLD_COD_SOL = $cod_sol and 
	                    CRED_PLD_COD_CLI = $cli_redo  and CRED_PLD_NRO_CTA = $cuotas and CRED_PLD_USR_BAJA is null";
			 $res_actp = mysql_query($act_kpla) or die('No pudo actualizr cred_plandp ult'. mysql_error());
		      //echo "actualiza -", $dif_a ,$cod_sol, $cli_redo, $cuotas;
			  }   
	  	}
	
		
		
		
		
		
	$consulta  = "Select CRED_DEU_INTERNO, CLIENTE_COD_ID,CLIENTE_AP_PATERNO, CLIENTE_AP_MATERNO, CLIENTE_NOMBRES, CRED_DEU_RELACION,CRED_DEU_IMPORTE, CRED_DEU_COMISION, CRED_DEU_AHO_INI, CRED_DEU_AHO_DUR, CRED_DEU_INT_CTA From cliente_general, cred_deudor where CRED_SOL_CODIGO = $cod_sol and CRED_DEU_INTERNO = CLIENTE_COD and CRED_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null";
    $resultado = mysql_query($consulta);
	$nro_clie = 0;
	while ($linea = mysql_fetch_array($resultado)) {
	      $nro_clie = $nro_clie + 1;
	      $cliente[$nro_clie] = $linea['CRED_DEU_INTERNO'];
	      $clie_nomb = $linea['CLIENTE_AP_PATERNO']. "  ". $linea['CLIENTE_AP_MATERNO']. " ".
		               $linea['CLIENTE_NOMBRES'];
		  //. " ".
		   //                         $lin_sum['CLIENTE_AP_MATERNO']. " ".
		//							$lin_sum['CLIENTE_NOMBRES'];
		 $clie_nombre[$nro_clie] = $clie_nomb;
	}
	//for ($x=1; $x < $nro_clie+1; $x = $x + 1 ) {
	    $tot_cta_1 = 0;
	    $tot_cta_2 = 0;
	    $tot_cta_3 = 0;
		$tot_cta_4 = 0;
		$tot_cta_5 = 0;
		$tot_cta_6 = 0;
		$tot_cta_7 = 0;
		$tot_cta_8 = 0;
		$tot_cta_9 = 0;
		$tot_cta_10 = 0;
		$tot_cta_11 = 0;
	    $tot_cta_12 = 0;
	    $tot_cta_13 = 0;
		$tot_cta_14 = 0;
		$tot_cta_15 = 0;
		$tot_cta_16 = 0;
		$tot_cta_17 = 0;
		$tot_cta_18 = 0;
		$tot_cta_19 = 0;
		
	//}	
	
	
	
	
	for ($x=1; $x < $nro_clie+1; $x = $x + 1 ) {
	    $c_clie = $cliente[$x];
		$con_plan  = "Select CRED_PLD_NRO_CTA,CRED_PLD_FECHA, CRED_PLD_CAPITAL, CRED_PLD_INTERES, CRED_PLD_AHORRO
		             From cred_plandp where  CRED_PLD_COD_SOL = $cod_sol and CRED_PLD_COD_CLI = $c_clie
					 and CRED_PLD_USR_BAJA is null";
        $res_plan = mysql_query($con_plan);
		
		//   $lin_plan['CRED_PLD_INTERES'] = 0;
		  // }
		while ($lin_plan = mysql_fetch_array($res_plan)) {
		  //  $fec_pag [$x] =  $lin_plan['CRED_PLD_FECHA'];
		 if ($lin_plan['CRED_PLD_NRO_CTA'] == 1) {
		    
		     $nro_cta_1[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
		     if ($p_int == 4){
		        $nro_cta_1[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                     $lin_plan['CRED_PLD_AHORRO'];
				}
				$tot_cta_1 = $tot_cta_1 + $nro_cta_1[$x];
				
		  }
		  if ($lin_plan['CRED_PLD_NRO_CTA'] == 2) {
		     
		     $nro_cta_2[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
			if ($p_int == 4){
		        $nro_cta_2[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                     $lin_plan['CRED_PLD_AHORRO'];
			}				  
			$tot_cta_2 = $tot_cta_2 + $nro_cta_2[$x];				  
		  }            
		  if ($lin_plan['CRED_PLD_NRO_CTA'] == 3) {
		     
		     $nro_cta_3[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
			 if ($p_int == 4){
		        $nro_cta_3[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                     $lin_plan['CRED_PLD_AHORRO'];
			}				  
			$tot_cta_3 = $tot_cta_3 + $nro_cta_3[$x];
		  }         
		  if ($lin_plan['CRED_PLD_NRO_CTA'] == 4) {
		     $nro_cta_4[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
			 if ($p_int == 4){
		        $nro_cta_4[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                     $lin_plan['CRED_PLD_AHORRO'];
			}				  
			$tot_cta_4 = $tot_cta_4 + $nro_cta_4[$x];				  
		  }       
		  if ($lin_plan['CRED_PLD_NRO_CTA'] == 5) {
		     $nro_cta_5[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
			if ($p_int == 4){
		        $nro_cta_5[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                     $lin_plan['CRED_PLD_AHORRO'];
			}				  
			$tot_cta_5 = $tot_cta_5 + $nro_cta_5[$x];				  
    	  }       
		  if ($lin_plan['CRED_PLD_NRO_CTA'] == 6) {
		     $nro_cta_6[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
			 if ($p_int == 4){
		        $nro_cta_6[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                     $lin_plan['CRED_PLD_AHORRO'];
			}				  
			$tot_cta_6 = $tot_cta_6 + $nro_cta_6[$x];				  
		  }  
		  if ($lin_plan['CRED_PLD_NRO_CTA'] == 7) {
		     $nro_cta_7[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
			if ($p_int == 4){
		        $nro_cta_7[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                     $lin_plan['CRED_PLD_AHORRO'];
			}				  
			$tot_cta_7 = $tot_cta_7 + $nro_cta_7[$x];				  
			 				  
		  } 
		  if ($lin_plan['CRED_PLD_NRO_CTA'] == 8) {
		     $nro_cta_8[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
			 if ($p_int == 4){
		        $nro_cta_8[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                     $lin_plan['CRED_PLD_AHORRO'];
			}				  
			$tot_cta_8 = $tot_cta_8 + $nro_cta_8[$x];				  
		  }  
		  if ($lin_plan['CRED_PLD_NRO_CTA'] == 9) {
		     $nro_cta_9[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
			if ($p_int == 4){
		        $nro_cta_9[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                     $lin_plan['CRED_PLD_AHORRO'];
			}				  
			$tot_cta_9 = $tot_cta_9 + $nro_cta_9[$x];				  
		  } 
		  if ($lin_plan['CRED_PLD_NRO_CTA'] == 10) {
		     $nro_cta_10[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
			if ($p_int == 4){
		        $nro_cta_10[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                     $lin_plan['CRED_PLD_AHORRO'];
			}				  
			$tot_cta_10 = $tot_cta_10 + $nro_cta_10[$x];				  
		  }             
		  if ($lin_plan['CRED_PLD_NRO_CTA'] == 11) {
		     $nro_cta_11[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
			if ($p_int == 4){
		        $nro_cta_11[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                     $lin_plan['CRED_PLD_AHORRO'];
			}				  
			$tot_cta_11 = $tot_cta_11 + $nro_cta_11[$x];
		  } 
		  if ($lin_plan['CRED_PLD_NRO_CTA'] == 12) {
		     $nro_cta_12[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
			if ($p_int == 4){
		        $nro_cta_12[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                     $lin_plan['CRED_PLD_AHORRO'];
			}				  
			$tot_cta_12 = $tot_cta_12 + $nro_cta_12[$x];				  
		  } 
		  if ($lin_plan['CRED_PLD_NRO_CTA'] == 13) {
		     $nro_cta_13[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
			if ($p_int == 4){
		        $nro_cta_13[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                     $lin_plan['CRED_PLD_AHORRO'];
			}				  
			$tot_cta_13 = $tot_cta_13 + $nro_cta_13[$x];				  
							  
		  } 
		  if ($lin_plan['CRED_PLD_NRO_CTA'] == 14) {
		     $nro_cta_14[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
			if ($p_int == 4){
		        $nro_cta_14[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                     $lin_plan['CRED_PLD_AHORRO'];
			}				  
			$tot_cta_14 = $tot_cta_14 + $nro_cta_14[$x];				  
		  }
		  if ($lin_plan['CRED_PLD_NRO_CTA'] == 15) {
		     $nro_cta_15[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
			if ($p_int == 4){
		        $nro_cta_15[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                     $lin_plan['CRED_PLD_AHORRO'];
			}				  
			$tot_cta_15 = $tot_cta_15 + $nro_cta_15[$x];				  
		  }
		  if ($lin_plan['CRED_PLD_NRO_CTA'] == 16) {
		     $nro_cta_16[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
			 if ($p_int == 4){
		        $nro_cta_16[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                     $lin_plan['CRED_PLD_AHORRO'];
			}				  
			$tot_cta_16 = $tot_cta_16 + $nro_cta_16[$x];				  
		  }             
		  if ($lin_plan['CRED_PLD_NRO_CTA'] == 17) {
		     $nro_cta_17[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
			 if ($p_int == 4){
		        $nro_cta_17[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                     $lin_plan['CRED_PLD_AHORRO'];
			}				  
			$tot_cta_17 = $tot_cta_17 + $nro_cta_17[$x];				  
		  }             
		  if ($lin_plan['CRED_PLD_NRO_CTA'] == 18) {
		     $nro_cta_18[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
			if ($p_int == 4){
		        $nro_cta_18[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                     $lin_plan['CRED_PLD_AHORRO'];
			}				  
			$tot_cta_18 = $tot_cta_18 + $nro_cta_18[$x];				  
		  }   
		  if ($lin_plan['CRED_PLD_NRO_CTA'] == 19) {
		     $nro_cta_19[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
		  }   
		   if ($lin_plan['CRED_PLD_NRO_CTA'] == 20) {
		     $nro_cta_20[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
		  }  
		  if ($lin_plan['CRED_PLD_NRO_CTA'] == 21) {
		     $nro_cta_21[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
		  }   
		  if ($lin_plan['CRED_PLD_NRO_CTA'] == 22) {
		     $nro_cta_22[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
		  }  
		  if ($lin_plan['CRED_PLD_NRO_CTA'] == 23) {
		     $nro_cta_23[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
		  } 
		  if ($lin_plan['CRED_PLD_NRO_CTA'] == 24) {
		     $nro_cta_24[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
		  }   
		  if ($lin_plan['CRED_PLD_NRO_CTA'] == 25) {
		     $nro_cta_25[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
		  }  
		 if ($lin_plan['CRED_PLD_NRO_CTA'] == 26) {
		     $nro_cta_26[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
		  } 
		 if ($lin_plan['CRED_PLD_NRO_CTA'] == 27) {
		     $nro_cta_27[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
		  } 
		if ($lin_plan['CRED_PLD_NRO_CTA'] == 28) {
		     $nro_cta_28[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
		  }  
		if ($lin_plan['CRED_PLD_NRO_CTA'] == 29) {
		     $nro_cta_29[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
		  } 
		 if ($lin_plan['CRED_PLD_NRO_CTA'] == 30) {
		     $nro_cta_30[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
		  }            
		 }
	}
	//actualiza estado solicitud
	$act_cred_solic  = "update cred_solicitud set CRED_SOL_ESTADO=5 where CRED_SOL_CODIGO = $cod_sol and CRED_SOL_USR_BAJA is null";
$res_act_s = mysql_query($act_cred_solic) or die('No pudo actualizar cred_solicitud : ' . mysql_error());
		?>
	 <br>
	<form name="form1" method="post" action="solic_retro_sol.php" > 
	<strong> Datos Basicos para Plan de Pagos </strong>	
	<table align="center" border="1">
	<tr>
	    <td><strong>  Solicitud </strong></td>
        <td><?php echo $cod_sol; ?></td>
        <td> <strong> Importe Solicitado </strong></td>
        <td align="right"><?php if(isset($_SESSION["impo_sol"])){
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
				
       <td><strong> Importe Cartera </strong></td>
       <td align="right"><?php if ($comif == 2){
	                           $impsc = $imp_sc;
	                           }else{
	                           $impsc = $imp_s;
                               }	 
	                           $imposc = number_format($impsc, 2, '.',','); 
                               echo $imposc;    ?></td> 
		<td><strong> Tasa Interes  </strong></td>
        <td><?php echo number_format($tint, 2, '.',',').  " % Anual"; ?></td>					   
   </tr>
 <tr>		 		  
	   <td><strong> Cobro Comision </strong></td>
       <td><?php echo $comf_d; ?></td>
	   <td><strong> Plazo </strong></td>
       <td><?php echo number_format($plzm, 2, '.',','). "  Meses  ". number_format($plzd, 0, '.',','). "  Días"; ?></td>
       <td><strong> Numero de Cuotas </strong></td>
       <td align="center"><?php echo ($cuotas);?></td>
 </tr>
 <tr>
       <td><strong> Calculo Interes  </strong></td>
       <td><?php echo $d_cin;?></td>
       <td><strong> Forma de Pago </strong></td>
       <td><?php echo $fpag_d . " cada ". $nro_d . " días";?></td>
       <td><strong> Fondo Garantia Ciclo </strong></td>
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
 </table> 
 </FONT> 
<?php
$nro_ctas = $cuotas;
 ?>	
   <?php
    if ($nro_ctas > 5){
    ?>			
	<table border="1" width="1500">
	 <?php
    }
    ?>
	 <?php
    if ($nro_ctas < 6){
    ?>			
	<table border="1" width="800">
	 <?php
    }
    ?>
	
		
	<tr>
		<th>Nombre Cliente </th>
		<?php for ($i=1; $i < $nro_ctas+1; $i = $i + 1 ) { ?>
		<th><?php echo "Cuota (" ,$i, ") ";?>
		<br>
		<?php echo  $fec_pag [$i]; ?></th>
		<?php } ?>		
	</tr>
	   <?php for ($i=1; $i < $nro_clie+1; $i = $i + 1 ) { ?>
	 <tr>
	  	 	<td><?php echo  $clie_nombre[$i]; ?></td>
			<?php if(isset($nro_cta_1[$i])){?>
		          <td align="right"><?php echo number_format($nro_cta_1[$i], 2, '.',',') ; ?></td>
		    <?php } ?>	
		<td align="right"><?php if(isset($nro_cta_2[$i])){
		          echo  number_format($nro_cta_2[$i], 2, '.',','); 
		          }?></td>
		<td align="right"><?php  if(isset($nro_cta_3[$i])){
		           echo  number_format($nro_cta_3[$i], 2, '.',',');
				  }?></td>		 
		<td align="right"><?php if(isset($nro_cta_4[$i])){
		          echo  number_format($nro_cta_4[$i], 2, '.',',');
				  } ?></td>
		<td align="right"><?php if(isset($nro_cta_5[$i])){
		          echo  number_format($nro_cta_5[$i], 2, '.',',');
				  } ?></td>
		<td align="right"><?php if(isset($nro_cta_6[$i])){
		          echo  number_format($nro_cta_6[$i], 2, '.',','); 
				  }?></td>
		<td align="right"><?php if(isset($nro_cta_7[$i])){
		          echo  number_format($nro_cta_7[$i], 2, '.',','); 
				  }?></td>
		<td align="right" ><?php if(isset($nro_cta_8[$i])){
		          echo number_format($nro_cta_8[$i], 2, '.',','); 
				  }?></td>
		<td align="right"><?php if(isset($nro_cta_9[$i])){
		          echo  number_format($nro_cta_9[$i], 2, '.',','); 
				  }?></td>
		<td align="right" ><?php if(isset($nro_cta_10[$i])){
		          echo  number_format($nro_cta_10[$i], 2, '.',','); 
				  }?></td>
		<td align="right"><?php if(isset($nro_cta_11[$i])){
		          echo  number_format($nro_cta_11[$i], 2, '.',','); 
				  }?></td>
		<td align="right"><?php if(isset($nro_cta_12[$i])){
		          echo  number_format($nro_cta_12[$i], 2, '.',','); 
				  }?></td>
		<td align="right"><?php if(isset($nro_cta_13[$i])){
		          echo  number_format($nro_cta_13[$i], 2, '.',','); 
				  }?></td>
		<td align="right"><?php if(isset($nro_cta_14[$i])){
		          echo number_format($nro_cta_14[$i], 2, '.',','); 
				  }?></td>
		<td align="right"><?php if(isset($nro_cta_15[$i])){
		          echo number_format($nro_cta_15[$i], 2, '.',','); 
				  }?></td>
		<td align="right"><?php if(isset($nro_cta_16[$i])){
		          echo  number_format($nro_cta_16[$i], 2, '.',','); 
				  }?></td>
		<td align="right"><?php if(isset($nro_cta_17[$i])){
		          echo number_format($nro_cta_17[$i], 2, '.',','); 
				  }?></td>
		<td align="right"><?php if(isset($nro_cta_18[$i])){
		          echo  number_format($nro_cta_18[$i], 2, '.',','); 
				  }?></td>
		<td align="right" ><?php if(isset($nro_cta_19[$i])){
		          echo  number_format($nro_cta_19[$i], 2, '.',','); 
				  }?></td>		  
		<td align="right"><?php if(isset($nro_cta_20[$i])){
		          echo  number_format($nro_cta_20[$i], 2, '.',','); 
				  }?></td>
		<td align="right"><?php if(isset($nro_cta_21[$i])){
		          echo  number_format($nro_cta_21[$i], 2, '.',','); 
				  }?></td>
		<td align="right"><?php if(isset($nro_cta_22[$i])){
		          echo  number_format($nro_cta_22[$i], 2, '.',','); 
				  }?></td>		  
       <td align="right"><?php if(isset($nro_cta_23[$i])){
		          echo  number_format($nro_cta_23[$i], 2, '.',','); 
				  }?></td> 
	   <td align="right"><?php if(isset($nro_cta_24[$i])){
		          echo  number_format($nro_cta_24[$i], 2, '.',','); 
				  }?></td>
	   	<td align="right"><?php if(isset($nro_cta_25[$i])){
		          echo  number_format($nro_cta_25[$i], 2, '.',','); 
				  }?></td>	
		<td><?php if(isset($nro_cta_26[$i])){
		          echo  number_format($nro_cta_26[$i], 2, '.',','); 
				  }?></td>	
		 <td align="right"><?php if(isset($nro_cta_27[$i])){
		          echo  number_format($nro_cta_27[$i], 2, '.',','); 
				  }?></td> 
		<td align="right"><?php if(isset($nro_cta_28[$i])){
		          echo  $nro_cta_28[$i]; 
				  }?></td>
		<td align="right"><?php if(isset($nro_cta_29[$i])){
		          echo  number_format($nro_cta_29[$i], 2, '.',','); 
				  }?></td>
		<td align="right"><?php if(isset($nro_cta_30[$i])){
		          echo  number_format($nro_cta_30[$i], 2, '.',','); 
				  }?></td>		  
		<?php } ?>
		<br>
	</tr>
	  <?php  //for ($i=1; $i < $nro_clie+1; $i = $i + 1 ) { ?>
	 <tr>
	  	 	<th><?php echo  "TOTAL CUOTA"; ?></th>
			<?php if($tot_cta_1 > 0){?>
		          <th align="right"><?php echo number_format($tot_cta_1, 2, '.',',') ; ?>
		    <?php } ?>	
		<?php if($tot_cta_2 > 0){?>
		          <th align="right"><?php echo number_format($tot_cta_2, 2, '.',',') ; ?>
		    <?php } ?>
		<?php if($tot_cta_3 > 0){?>
		          <th align="right"><?php echo number_format($tot_cta_3, 2, '.',',') ; ?>
		    <?php } ?>	 
		<?php if($tot_cta_4 > 0){?>
		          <th align="right"><?php echo number_format($tot_cta_4, 2, '.',',') ; ?>
		    <?php } ?>	
		<?php if($tot_cta_5 > 0){?>
		          <th align="right"><?php echo number_format($tot_cta_5, 2, '.',',') ; ?>
		    <?php } ?>	
		<?php if($tot_cta_6 > 0){?>
		          <th align="right"><?php echo number_format($tot_cta_6, 2, '.',',') ; ?>
		    <?php } ?>	
		<?php if($tot_cta_7 > 0){?>
		          <th align="right"><?php echo number_format($tot_cta_7, 2, '.',',') ; ?>
		    <?php } ?>	
		<?php if($tot_cta_8 > 0){?>
		          <th align="right"><?php echo number_format($tot_cta_8, 2, '.',',') ; ?>
		    <?php } ?>	
		<?php if($tot_cta_9 > 0){?>
		          <th align="right"><?php echo number_format($tot_cta_9, 2, '.',',') ; ?>
		    <?php } ?>	
		<?php if($tot_cta_10 > 0){?>
		          <th align="right"><?php echo number_format($tot_cta_10, 2, '.',',') ; ?>
		    <?php } ?>	
		<?php if($tot_cta_11 > 0){?>
		          <th align="right"><?php echo number_format($tot_cta_1, 2, '.',',') ; ?>
		    <?php } ?>	
		<?php if($tot_cta_12 > 0){?>
		          <th align="right"><?php echo number_format($tot_cta_2, 2, '.',',') ; ?>
		    <?php } ?>
		<?php if($tot_cta_13 > 0){?>
		          <th align="right"><?php echo number_format($tot_cta_3, 2, '.',',') ; ?>
		    <?php } ?>	 
		<?php if($tot_cta_14 > 0){?>
		          <th align="right"><?php echo number_format($tot_cta_4, 2, '.',',') ; ?>
		    <?php } ?>	
		<?php if($tot_cta_15 > 0){?>
		          <th align="right"><?php echo number_format($tot_cta_5, 2, '.',',') ; ?>
		    <?php } ?>	
		<?php if($tot_cta_16 > 0){?>
		          <th align="right"><?php echo number_format($tot_cta_6, 2, '.',',') ; ?>
		    <?php } ?>	
		<?php if($tot_cta_17 > 0){?>
		          <th align="right"><?php echo number_format($tot_cta_7, 2, '.',',') ; ?>
		    <?php } ?>	
		<?php if($tot_cta_18 > 0){?>
		          <th align="right"><?php echo number_format($tot_cta_8, 2, '.',',') ; ?>
		    <?php } ?>	
		<?php if($tot_cta_19 > 0){?>
		          <th align="right"><?php echo number_format($tot_cta_9, 2, '.',',') ; ?>
		    <?php } ?>
		<br>
	</tr>
	
	
	
	
	
	
		
   </table>
</center>
<strong>
</strong>	
<center>
<input type="submit" name="accion" value="Contrato">
<input type="submit" name="accion" value="Salir">
</form>	
<div id="FooterTable">
<BR><B><FONT SIZE=+2><MARQUEE>Revise los montos antes de Continuar</MARQUEE></FONT></B>
</div>
   <?php
		 	include("footer_in.php");
	 ?> 
<?php
}
ob_end_flush();
 ?>