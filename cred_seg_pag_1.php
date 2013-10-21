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
$ncre = " ";
$consulta = "delete from temp_cobro";
$resultado = mysql_query($consulta)or die('No pudo borrar temp_cobro 1 : ' . mysql_error()); 
 $_SESSION['cod_sol'] = 0;
if(isset($_POST['ncre'])){
      $ncre = $_POST['ncre'];
	  $ncre1 = $ncre;
      $_SESSION['ncre'] = $ncre;
      
   }

 $con_car  = "Select CART_NRO_SOL From cart_maestro where CART_NRO_CRED = $ncre and CART_ESTADO < 9 and CART_MAE_USR_BAJA is null"; 
   $res_car = mysql_query($con_car)or die('No pudo seleccionarse solicitud 2');
   while ($lin_car = mysql_fetch_array($res_car)) { // 5 a
          $cod_sol = $lin_car['CART_NRO_SOL'];
		  $_SESSION['cod_sol'] = $cod_sol;
  }
//Seleccion solicitud
//echo $cod_sol;
$con_sol  = "Select * From cred_solicitud where CRED_SOL_CODIGO = $cod_sol and CRED_SOL_USR_BAJA is null"; 
$res_sol = mysql_query($con_sol)or die('No pudo seleccionarse solicitud 2');
   while ($lin_sol = mysql_fetch_array($res_sol)) {
         $t_op = $lin_sol['CRED_SOL_TIPO_OPER'];
		 $ncre = $lin_sol['CRED_SOL_NRO_CRED']; 
		 $impo = $lin_sol['CRED_SOL_IMPORTE'];
		 $mon  = $lin_sol['CRED_SOL_COD_MON'];
		 $comi  = $lin_sol['CRED_SOL_IMP_COM'];
		 $ahod  = $lin_sol['CRED_SOL_AHO_DUR'];
		 $ahoi  = $lin_sol['CRED_SOL_AHO_INI'];
		 $tasa  = $lin_sol['CRED_SOL_TASA'];
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
    if ($p_int == 1) { 
		 $tip_pagi = "C/Cta";
		 }	
	 if ($p_int == 4) { 
	     $tip_pagi = "Ant.";
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
	   $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD = $mon";
          $res_mon = mysql_query($con_mon)or die('No pudo seleccionarse tabla 3')  ;
	      while ($linea = mysql_fetch_array($res_mon)) {
	             $d_mon = $linea['GRAL_PAR_INT_DESC'];
				 $s_mon = $linea['GRAL_PAR_INT_SIGLA'];
				 $_SESSION['des_mon'] = $d_mon;
				 
				 
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
 $con_pla  = "Select CRED_PLD_NRO_CTA,CRED_PLD_COD_CLI,CRED_PLD_FECHA,CRED_PLD_CAPITAL,
              CRED_PLD_INTERES,CRED_PLD_AHORRO
		      From cred_plandp where  CRED_PLD_COD_SOL = $cod_sol 
			  and CRED_PLD_USR_BAJA is null";
        $res_pla = mysql_query($con_pla);
		
		//   $lin_plan['CRED_PLD_INTERES'] = 0;
		  // }
		while ($lin_pla = mysql_fetch_array($res_pla)) {
		       $i = $lin_pla['CRED_PLD_NRO_CTA'];
                $fec_pag[$i] = $lin_pla['CRED_PLD_FECHA'];
				$fec_pa = $fec_pag[$i];
				$mon_cta[$i] = $lin_pla['CRED_PLD_CAPITAL']+
			                  $lin_pla['CRED_PLD_INTERES']+
							  $lin_pla['CRED_PLD_AHORRO'];
				$mon_ct = $mon_cta[$i];
				$cod_cli[$i] = $lin_pla['CRED_PLD_COD_CLI'];			  
                $cod_cl = $cod_cli[$i];
$consulta = "insert into temp_cobro (TEMP_COB_NCRE,
	                                   TEMP_COB_CLI, 
									   TEMP_COB_TIPO,
                                       TEMP_COB_FEC_CTA,
									   TEMP_COB_DEHA,
						 	           TEMP_COB_IMPO
									     ) values
										  ($ncre,
										   $cod_cl,
										   1,
										   '$fec_pa',
										   $i,
										   $mon_ct
									       )";
										   
    $resultado = mysql_query($consulta)or die('No pudo insertar temp_ctable3 1 : ' . mysql_error());
		}
//Consulta de Pagos
  $con_pag  = "Select CRED_PLP_COD_SOL,CRED_PLP_NRO_CRE,CRED_PLP_COD_CLI,CRED_PLP_FECHA,
               CRED_PLP_FCTA,CRED_PLP_MONTO
		       From cred_plandp_pag where CRED_PLP_COD_SOL = $cod_sol 
			   and CRED_PLP_USR_BAJA is null";
        $res_pag = mysql_query($con_pag);
		 $x = 0; 
		while ($lin_pag = mysql_fetch_array($res_pag)) {
		       $x = $x + 1;
                $cod_so = $lin_pag['CRED_PLP_COD_SOL'];
				$cod_nc = $lin_pag['CRED_PLP_NRO_CRE'];
			    $cod_cl = $lin_pag['CRED_PLP_COD_CLI'];
				$cod_fe = $lin_pag['CRED_PLP_FECHA'];
				$cod_fc = $lin_pag['CRED_PLP_FCTA'];
				$cod_mo = $lin_pag['CRED_PLP_MONTO'];
				$consulta = "insert into temp_cobro (TEMP_COB_NCRE,
	                                   TEMP_COB_CLI, 
									   TEMP_COB_TIPO,
									   TEMP_COB_FECHA,
                                       TEMP_COB_FEC_CTA,
									   TEMP_COB_DEHA,
						 	           TEMP_COB_IMPO
									     ) values
										  ($ncre,
										   $cod_cl,
										   2,
										   '$cod_fe',
										   '$cod_fc',
										   0,
										   $cod_mo
									       )";
										   
    $resultado = mysql_query($consulta)or die('No pudo insertar temp_ctable3 1 : ' . mysql_error());
				
				
				
				
				
				
				
        }
	





	$consulta  = "Select CRED_DEU_INTERNO, CLIENTE_COD_ID,CLIENTE_AP_PATERNO, CLIENTE_AP_MATERNO, CLIENTE_NOMBRES, CRED_DEU_RELACION,CRED_DEU_IMPORTE, CRED_DEU_COMISION, CRED_DEU_AHO_INI, CRED_DEU_AHO_DUR, CRED_DEU_INT_CTA From cliente_general, cred_deudor where CRED_SOL_CODIGO = $cod_sol and CRED_DEU_INTERNO = CLIENTE_COD and CRED_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null";
    $resultado = mysql_query($consulta);
	$nro_clie = 0;
	while ($linea = mysql_fetch_array($resultado)) {
	      $nro_clie = $nro_clie + 1;
	      $cliente[$nro_clie] = $linea['CRED_DEU_INTERNO'];
	      $clie_nomb = $linea['CLIENTE_AP_PATERNO']. "  ". $linea['CLIENTE_AP_MATERNO']. " ".
		               $linea['CLIENTE_NOMBRES'];
	      $clie_nombre[$nro_clie] = $clie_nomb;
	}
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
		  }
		  if ($lin_plan['CRED_PLD_NRO_CTA'] == 2) {
		    
		     $nro_cta_2[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
		  }            
		  if ($lin_plan['CRED_PLD_NRO_CTA'] == 3) {
		     
		     $nro_cta_3[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
		  }         
		  if ($lin_plan['CRED_PLD_NRO_CTA'] == 4) {
		     $nro_cta_4[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
		  }       
		  if ($lin_plan['CRED_PLD_NRO_CTA'] == 5) {
		     $nro_cta_5[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
    	  }       
		  if ($lin_plan['CRED_PLD_NRO_CTA'] == 6) {
		     $nro_cta_6[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
		  }  
		  if ($lin_plan['CRED_PLD_NRO_CTA'] == 7) {
		     $nro_cta_7[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
		  } 
		  if ($lin_plan['CRED_PLD_NRO_CTA'] == 8) {
		     $nro_cta_8[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
		  }  
		  if ($lin_plan['CRED_PLD_NRO_CTA'] == 9) {
		     $nro_cta_9[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
		  } 
		  if ($lin_plan['CRED_PLD_NRO_CTA'] == 10) {
		     $nro_cta_10[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
		  }             
		  if ($lin_plan['CRED_PLD_NRO_CTA'] == 11) {
		     $nro_cta_11[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
		  } 
		  if ($lin_plan['CRED_PLD_NRO_CTA'] == 12) {
		     $nro_cta_12[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
		  } 
		  if ($lin_plan['CRED_PLD_NRO_CTA'] == 13) {
		     $nro_cta_13[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
		  } 
		  if ($lin_plan['CRED_PLD_NRO_CTA'] == 14) {
		     $nro_cta_14[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
		  }
		  if ($lin_plan['CRED_PLD_NRO_CTA'] == 15) {
		     $nro_cta_15[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
		  }
		  if ($lin_plan['CRED_PLD_NRO_CTA'] == 16) {
		     $nro_cta_16[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
		  }             
		  if ($lin_plan['CRED_PLD_NRO_CTA'] == 17) {
		     $nro_cta_17[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
		  }             
		  if ($lin_plan['CRED_PLD_NRO_CTA'] == 18) {
		     $nro_cta_18[$x] = $lin_plan['CRED_PLD_CAPITAL']+
			                  $lin_plan['CRED_PLD_INTERES']+
							  $lin_plan['CRED_PLD_AHORRO'];
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
	
	
	
	
		?>
	 <br>
	<form name="form1" method="post" action="solic_retro_sol.php" > 
	<strong> Datos Basicos del Crédito </strong>	
	<table align="center" border="1">
	<tr>
	    <td><strong>  Solicitud </strong></td>
        <td><?php echo $cod_sol; ?></td>
        <td> <strong> Importe Solicitado </strong></td>
        <td align="right"><?php if(isset($_SESSION["impo_sol"])){
                  $impo = $_SESSION["impo_sol"] ;
	              }
	           //   $impo = $imp_s ;
	              $impo2 = number_format($impo, 2, '.',','); 
                  echo $impo2;    ?></td>
		<td> <strong> Moneda </strong></td>
        <td> <?php  if(isset( $_SESSION['des_mon'])){
             echo  $_SESSION['des_mon'];
	         }  ?> </td>
  </tr>	
   <tr>		 		  
	   <td><strong> Comision </strong></td>
       <td align="right"><?php $impc = $comi ;
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
       <td><?php echo number_format($plzm, 2, '.',','), "  Meses  ", $plzd , "  Días"; ?></td>
       <td><strong> Numero de Cuotas </strong></td>
       <td align="center"><?php echo ($cuotas);?></td>
 </tr>
 <tr>
       <td><strong> Calculo Interes  </strong></td>
       <td><?php echo $d_cin;?></td>
       <td><strong> Forma de Pago </strong></td>
       <td><?php echo $fpag_d . " cada ". $nro_d . " días";?></td>
       <td><strong> Formularios</strong></td>
       <td align="right"><?php $_SESSION["aho_d"] =  $ahod; 
           echo $ahod. " %"; ?></td>
 </tr> 
 <tr> 
      <td><strong> Fecha Desembolso </strong></td>
      <td><?php echo  $f_des2;?> </td>  
      <td><strong> Fecha 1er. Pago </strong></td>
      <td align="center"> <?php echo  $f_uno2; ?></td>  
      <td><strong> Fecha Ultimo Pago </strong></td>
      <td align="center"><?php echo cambiaf_a_normal($fec_pag[$cuotas]); ?> </td>
 </tr>
 </table> 
 </FONT> 

<?php
$nro_ctas = $cuotas;
 ?>	
   <?php
    if ($nro_ctas > 5){
    ?>			
	<table width="1100"  border="1" align="center">
    <tr>
	   <th width="5%" style="font-size:12px">Rel.</td>
	   <th width="50%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />CLIENTE</th>
	  <th width="15%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />CUOTA</th>
	 <?php for ($i=1; $i < $nro_ctas+1; $i = $i + 1 ) { ?>
		<th><?php echo "Cuota (" ,$i, ") ";?>
		<br>
		<?php echo  encadenar(2);?></th>
			<th>Monto </th>
		<?php } ?>		
	  
	</tr>
	 <?php
    }
    ?>
	 <?php
    if ($nro_ctas < 6){
    ?>			
	<table width="800"  border="1" align="center">
    <tr>
	   <th width="5%" style="font-size:12px">Rel.</td>
	   <th width="40%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />CLIENTE</th>
	  <th width="15%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />CUOTA</th>
	 <?php for ($i=1; $i < $nro_ctas+1; $i = $i + 1 ) { ?>
		<th><?php echo "Cuota (" ,$i, ") ";?>
		<br>
		<?php echo  $fec_pag [$i];?></th>
			<th>Monto </th>
		<?php } ?>		
	  
	</tr>
	 <?php
    }
	
    //}
	$tot_cta = 0;
	
	$consulta  = "Select * From temp_cobro where TEMP_COB_DEHA = 1 order by TEMP_COB_CLI,TEMP_COB_FECHA  ";
    $resultado = mysql_query($consulta);
	$tot_debe_1 = 0;
    $tot_haber_1 = 0;
    $tot_debe_2 = 0;
    $tot_haber_2 = 0;
	$cuenta1 = 0;
	$cuenta2 = 0;
	 $tot_1 = 0;
	 $tot_2 = 0;
	 $tot_3 = 0;
	 $tot_4 = 0;
	 $tot_5 = 0;
	 $tot_6 = 0;
	 $tot_7 = 0;
	 $tot_8 = 0;
	 $tot_9 = 0;
	 $tot_10 = 0;
	 $tot_11 = 0;
	 $tot_12 = 0;
	 $tot_13 = 0;
	 $tot_14 = 0;
	 $tot_15 = 0;
	 $tot_0 = 0;
	while ($linea = mysql_fetch_array($resultado)) {
	       $cuenta2  = $linea['TEMP_COB_CLI'];
	       $fec_pag  = $linea['TEMP_COB_FECHA'];
	       $fec_cta  = $linea['TEMP_COB_FEC_CTA'];
	       $cuota_1 = $linea['TEMP_COB_IMPO'];
		   $tot_0 = $tot_0 + $cuota_1;
		  // echo $cuenta1 , $cuenta2;
		   if ($cuenta1 <> $cuenta2){
		   
	       	$con_cli  = "Select CRED_DEU_INTERNO, CLIENTE_COD_ID,CLIENTE_AP_PATERNO, CLIENTE_AP_MATERNO, CLIENTE_NOMBRES,             CRED_DEU_RELACION From cliente_general, cred_deudor where CRED_SOL_CODIGO = $cod_sol and 
			 CRED_DEU_INTERNO =$cuenta2 and CRED_DEU_INTERNO = CLIENTE_COD and 
			 CRED_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null";
            $res_cli = mysql_query($con_cli);
	
	        while ($lin_cli = mysql_fetch_array($res_cli)) {
	     // $nro_clie = $nro_clie + 1;
	              $cod_cli = $lin_cli['CRED_DEU_INTERNO'];
	              $clie_nomb = $lin_cli['CLIENTE_AP_PATERNO']. "  ". $lin_cli['CLIENTE_AP_MATERNO']. " ".
		                       $lin_cli['CLIENTE_NOMBRES'];
	               $rela = $lin_cli['CRED_DEU_RELACION'];
				  // echo  $clie_nomb; 
	         
			?>
	<tr>
	   <td align="left" style="font-size:12px" ><?php echo $rela; ?></td> 
	   <td align="left" style="font-size:12px" ><?php echo  $clie_nomb; ?></td>
	   <th align="right" style="font-size:14px" ><?php echo $cuota_1; ?></td> 
	 	
	</tr>
		
	
	   <?php 
	   $cuenta1 = $cuenta2;
	   }
	     }
	   $con_det  = "Select * From temp_cobro where TEMP_COB_TIPO = 2 and TEMP_COB_CLI = $cuenta2";
    $res_det = mysql_query($con_det);
	$tot_debe_1 = 0;
    $tot_haber_1 = 0;
    $tot_debe_2 = 0;
    $tot_haber_2 = 0;
	$cuenta1 = 0;
	$cuenta2 = 0;
	 $nrocta = 0;
	 $tot_2 = 0;
	while ($lin_det = mysql_fetch_array($res_det)) {
	     $fec_pago = $lin_det['TEMP_COB_FEC_CTA'];	
	   //   echo $fec_pago; 
		  $con_cta  = "Select TEMP_COB_DEHA From temp_cobro where TEMP_COB_TIPO = 1 and TEMP_COB_FEC_CTA = '$fec_pago'";
          $res_cta = mysql_query($con_cta);
		  while ($lin_cta = mysql_fetch_array($res_cta)) {
		        $nrocta = $lin_cta['TEMP_COB_DEHA'];
			//	echo  $nrocta;
		  }
		  
		  ?>
		  <?php if ($nrocta == 1){
		        $tot_1 = $tot_1 + $lin_det['TEMP_COB_IMPO']; ?>
		   <tr>
		      <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td> 
		      <td align="right" style="font-size:12px"><?php echo encadenar(4); ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
	 	      <td align="left" style="font-size:12px"><?php echo $lin_det['TEMP_COB_FECHA']; ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format($lin_det['TEMP_COB_IMPO'], 2, '.',',') ; ?></td>
		  </tr>
	     <?php } ?>
		 <?php if ($nrocta == 2){
		           $tot_2 = $tot_2 + $lin_det['TEMP_COB_IMPO']; ?>
		   <tr>
		      <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td> 
		      <td align="right" style="font-size:12px"><?php echo encadenar(4); ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
		      <td align="left" style="font-size:12px"><?php echo $lin_det['TEMP_COB_FECHA']; ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format($lin_det['TEMP_COB_IMPO'], 2, '.',',') ; ?></td>
		  </tr>
	     <?php } ?>
		 <?php if ($nrocta == 3){ 
		           $tot_3 = $tot_3 + $lin_det['TEMP_COB_IMPO'];?>
		   <tr>
		      <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td> 
		      <td align="right" style="font-size:12px"><?php echo encadenar(4); ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			   <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td> 
		      <td align="left" style="font-size:12px"><?php echo $lin_det['TEMP_COB_FECHA']; ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format($lin_det['TEMP_COB_IMPO'], 2, '.',',') ; ?></td>
		  </tr>
	     <?php } ?> 
		  <?php if ($nrocta == 4){
		            $tot_4 = $tot_4 + $lin_det['TEMP_COB_IMPO']; ?>
		   <tr>
		      <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td> 
		      <td align="right" style="font-size:12px"><?php echo encadenar(4); ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td> 
		      <td align="left" style="font-size:12px"><?php echo $lin_det['TEMP_COB_FECHA']; ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format($lin_det['TEMP_COB_IMPO'], 2, '.',',') ; ?></td>
		  </tr>
	     <?php } ?> 
		  <?php if ($nrocta == 5){ 
		             $tot_5 = $tot_5 + $lin_det['TEMP_COB_IMPO'];?>
		   <tr>
		      <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td> 
		      <td align="right" style="font-size:12px"><?php echo encadenar(4); ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td> 
		      <td align="left" style="font-size:12px"><?php echo $lin_det['TEMP_COB_FECHA']; ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format($lin_det['TEMP_COB_IMPO'], 2, '.',',') ; ?></td>
		  </tr>
	     <?php } ?> 
		   <?php if ($nrocta == 6){ ?>
		   <tr>
		      <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td> 
		      <td align="right" style="font-size:12px"><?php echo encadenar(4); ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td> 
		      <td align="left" style="font-size:12px"><?php echo $lin_det['TEMP_COB_FECHA']; ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format($lin_det['TEMP_COB_IMPO'], 2, '.',',') ; ?></td>
		  </tr>
	     <?php } ?> 
		   <?php if ($nrocta == 7){ ?>
		   <tr>
		      <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td> 
		      <td align="right" style="font-size:12px"><?php echo encadenar(4); ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td> 
		      <td align="left" style="font-size:12px"><?php echo $lin_det['TEMP_COB_FECHA']; ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format($lin_det['TEMP_COB_IMPO'], 2, '.',',') ; ?></td>
		  </tr>
	     <?php } ?> 
		  <?php if ($nrocta == 8){ ?>
		   <tr>
		      <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td> 
		      <td align="right" style="font-size:12px"><?php echo encadenar(4); ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td> 
		      <td align="left" style="font-size:12px"><?php echo $lin_det['TEMP_COB_FECHA']; ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format($lin_det['TEMP_COB_IMPO'], 2, '.',',') ; ?></td>
		  </tr>
	     <?php } ?> 
		   <?php if ($nrocta == 9){ ?>
		   <tr>
		      <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td> 
		      <td align="right" style="font-size:12px"><?php echo encadenar(4); ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td> 
		      <td align="left" style="font-size:12px"><?php echo $lin_det['TEMP_COB_FECHA']; ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format($lin_det['TEMP_COB_IMPO'], 2, '.',',') ; ?></td>
		  </tr>
	     <?php } ?> 
		 <?php if ($nrocta == 10){ ?>
		   <tr>
		      <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td> 
		      <td align="right" style="font-size:12px"><?php echo encadenar(4); ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td> 
		      <td align="left" style="font-size:12px"><?php echo $lin_det['TEMP_COB_FECHA']; ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format($lin_det['TEMP_COB_IMPO'], 2, '.',',') ; ?></td>
		  </tr>
	     <?php } ?> 
		  <?php if ($nrocta == 11){ ?>
		   <tr>
		      <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td> 
		      <td align="right" style="font-size:12px"><?php echo encadenar(4); ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td> 
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td> 
		      <td align="left" style="font-size:12px"><?php echo $lin_det['TEMP_COB_FECHA']; ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format($lin_det['TEMP_COB_IMPO'], 2, '.',',') ; ?></td>
		  </tr>
	     <?php } ?> 
		 <?php if ($nrocta == 12){ ?>
		   <tr>
		      <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td> 
		      <td align="right" style="font-size:12px"><?php echo encadenar(4); ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td> 
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td> 
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td> 
		      <td align="left" style="font-size:12px"><?php echo $lin_det['TEMP_COB_FECHA']; ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format($lin_det['TEMP_COB_IMPO'], 2, '.',',') ; ?></td>
		  </tr>
	     <?php } ?> 
		<?php if ($nrocta == 13){ ?>
		   <tr>
		      <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td> 
		      <td align="right" style="font-size:12px"><?php echo encadenar(4); ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td> 
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td> 
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td> 
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td> 
		      <td align="left" style="font-size:12px"><?php echo $lin_det['TEMP_COB_FECHA']; ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format($lin_det['TEMP_COB_IMPO'], 2, '.',',') ; ?></td>
		  </tr>
	     <?php } ?>  
		 <?php if ($nrocta == 14){ ?>
		   <tr>
		      <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td> 
		      <td align="right" style="font-size:12px"><?php echo encadenar(4); ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td> 
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td> 
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td> 
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td> 
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td> 
		      <td align="left" style="font-size:12px"><?php echo $lin_det['TEMP_COB_FECHA']; ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format($lin_det['TEMP_COB_IMPO'], 2, '.',',') ; ?></td>
		  </tr>
	     <?php } ?>  
		  <?php if ($nrocta == 15){ ?>
		   <tr>
		      <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td> 
		      <td align="right" style="font-size:12px"><?php echo encadenar(4); ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td> 
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td> 
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td> 
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td> 
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td>
			  <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',',') ; ?></td> 
		      <td align="left" style="font-size:12px"><?php echo $lin_det['TEMP_COB_FECHA']; ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format($lin_det['TEMP_COB_IMPO'], 2, '.',',') ; ?></td>
		  </tr>
	     <?php } ?> 
     <?php
	} 
	}
	?> 
	<tr>
	   <td align="left" style="font-size:12px" ><?php echo encadenar(4); ?></td> 
	   <th align="center" style="font-size:12px" ><?php echo  "TOTALES"; ?></td>
	   <th align="right" style="font-size:14px" ><?php echo  number_format($tot_0, 2, '.',','); ?></td> 
	   <?php if ($cuotas >= 1){ ?>
	   <th align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
	   <th align="right" style="font-size:12px"><?php echo number_format($tot_1, 2, '.',',') ; ?></td> 
	   <?php } ?> 
	   <?php if ($cuotas >= 2){ ?>
	   <th align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
	   <th align="right" style="font-size:12px"><?php echo number_format($tot_2, 2, '.',',') ; ?></td>
	    <?php } ?> 
		<?php if ($cuotas >= 3){ ?>
	    <th align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
	   <th align="right" style="font-size:12px"><?php echo number_format($tot_3, 2, '.',',') ; ?></td> 
	    <?php } ?> 
		<?php if ($cuotas >= 4){ ?>
	   <th align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
	   <th align="right" style="font-size:12px"><?php echo number_format($tot_4, 2, '.',',') ; ?></td>
	    <?php } ?> 
		<?php if ($cuotas >= 5){ ?>
	   <th align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
	   <th align="right" style="font-size:12px"><?php echo number_format($tot_5, 2, '.',',') ; ?></td>
	    <?php } ?> 
		<?php if ($cuotas >= 6){ ?>
	    <th align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
	   <th align="right" style="font-size:12px"><?php echo number_format($tot_6, 2, '.',',') ; ?></td>
	    <?php } ?> 
	    <?php if ($cuotas >= 7){ ?>
	    <th align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
		<th align="right" style="font-size:12px"><?php echo number_format($tot_7, 2, '.',',') ; ?></td>
		 <?php } ?> 
		 <?php if ($cuotas >= 8){ ?>
	    <th align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
	   <th align="right" style="font-size:12px"><?php echo number_format($tot_8, 2, '.',',') ; ?></td>
	    <?php } ?> 
	   <?php if ($cuotas >= 9){ ?>
	    <th align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
	   <th align="right" style="font-size:12px"><?php echo number_format($tot_9, 2, '.',',') ; ?></td>
	   <?php } ?>  
	   <?php if ($cuotas >= 10){ ?>
	    <th align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
	   <th align="right" style="font-size:12px"><?php echo number_format($tot_10, 2, '.',',') ; ?></td>
	    <?php } ?> 
	   <?php if ($cuotas >= 11){ ?>
	    <th align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
	   <th align="right" style="font-size:12px"><?php echo number_format($tot_11, 2, '.',',') ; ?></td>
	    <?php } ?> 
	   <?php if ($cuotas >= 12){ ?>
	    <th align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
	   <th align="right" style="font-size:12px"><?php echo number_format($tot_12, 2, '.',',') ; ?></td>
	    <?php } ?> 
	   <?php if ($cuotas >= 13){ ?>
	    <th align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
	   <th align="right" style="font-size:12px"><?php echo number_format($tot_13, 2, '.',',') ; ?></td>
	    <?php } ?> 
	   <?php if ($cuotas >= 14){ ?>
	    <th align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
	   <th align="right" style="font-size:12px"><?php echo number_format($tot_14, 2, '.',',') ; ?></td>
	    <?php } ?> 
	   <?php if ($cuotas >= 15){ ?>
	    <th align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
	   <th align="right" style="font-size:12px"><?php echo number_format($tot_15, 2, '.',',') ; ?></td>
	   <?php } ?>  
	</tr>
	
	<?php
	
	
	
	//}
	
	
    ?>
	
		
	
	 
   </table>
   <?php
  
	 ?>
   
   
   
   
</center>

<strong>
</strong>
<br>	
<center>
<input type="submit" name="accion" value="Salir">
</form>	
</div>
<div id="FooterTable">
<BR><B><FONT SIZE=+2><MARQUEE>Seguimiento de Pagos</MARQUEE></FONT></B>
</div>
   <?php
		 	include("footer_in.php");
	 ?> 
<?php
}
ob_end_flush();
 ?>