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
	//$fec = leer_param_gral();
?>
<html>
<head>
<title>Modificar Nombre Grupo</title>
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script>
<script type="text/javascript" src="js/cjas_cart_nombre_modif_sel_bol.js"></script>   




<link href="css/estilo.css" rel="stylesheet" type="text/css"> 
<script language="javascript" src="script/validarForm.js"></script> 
</head>
<body>	

     <?php
	   include("header.php");
 	 ?>
<div id="pagina_sistema">
     <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>
  <li id="menu_modulo_cjas">
                    
                     <img src="img/fax_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CAJAS
                    
                 </li>
                  <li id="menu_modulo_cjas_cart">
                    
                     <img src="img/my documents_32x32.png" border="0" alt="Modulo" align="absmiddle"> COBROS CARTERA
                    
                 </li>
                  <li id="menu_modulo_cjas_cart_dir">
                    
                     <img src="img/search_32x32.png" border="0" alt="Modulo" align="absmiddle"> DIRECTO
                    
                 </li>
                    <li id="menu_modulo_cjas_cart_dir_nomgroup">
                    
                     <img src="img/users group_32x32.png" border="0" alt="Modulo" align="absmiddle"> NOMBRE DE GRUPO
                    
                 </li>
                 <li id="menu_modulo_cjas_cart_dir_nomgroup_sel">
                    
                     <img src="img/checkmark_32x32.png" border="0" alt="Modulo" align="absmiddle"> SELECCIONAR GRUPO
                    
                 </li>
                 <li id="menu_modulo_cjas_cart_dir_nomgroup_sel_modif">
                    
                     <img src="img/edit user_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODIFICAR GRUPO
                    
                 </li>
                 <li id="menu_modulo_fondo_grupo">
                    
                     <img src="img/my documents_32x32.png" border="0" alt="Modulo" align="absmiddle"> SEG. DE PAGOS
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
                      <h2> <img src="img/my documents_64x64.png" border="0" alt="Modulo" align="absmiddle">SEGUIMIENTO DE PAGOS </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
				          <img src="img/alert_32x32.png" align="absmiddle">
				          Elija el Grupo para modificar
				        </div>
<center>

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
			  and CRED_PLD_NRO_CTA = 1
			  and CRED_PLD_USR_BAJA is null";
        $res_pla = mysql_query($con_pla);
		
		//   $lin_plan['CRED_PLD_INTERES'] = 0;
		  // }
		  $nro_cli = 0;
		while ($lin_pla = mysql_fetch_array($res_pla)) {
		        $nro_cli = $nro_cli + 1;
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
										   $nro_cli,
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
				
		$con_tpa = "Select *  from temp_cobro where TEMP_COB_TIPO = 1 
				    and TEMP_COB_CLI = $cod_cl";
    $res_tpa = mysql_query($con_tpa)or die('No pudo seleccionarse tabla cart_det_tran')  ;
	//$nro = 0;
	    while ($lin_tpa = mysql_fetch_array($res_tpa)) {
		   //    $nro = $nro + 1;
			   $nro_cli = $lin_tpa['TEMP_COB_DEHA'];
		 	 
			 
		}	 
			
				
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
										    $nro_cli,
										   $cod_mo
									       )";
										   
    $resultado = mysql_query($consulta)or die('No pudo insertar temp_ctable3 1 : ' . mysql_error());
       }	

//$	
	
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
       <td><strong> Fdo.Garantia</strong></td>
       <td align="right"><?php $_SESSION["aho_d"] =  $ahod; 
           echo $ahod. " %"; ?></td>
 </tr> 
 <tr> 
      <td><strong> Fecha Desembolso </strong></td>
      <td><?php echo  $f_des2;?> </td>  
      <td><strong> Fecha 1er. Pago </strong></td>
      <td align="center"> <?php echo  $f_uno2; ?></td>  
      <td><strong> Fecha Ultimo Pago </strong></td>
	  <?php if (isset($fec_pag[$cuotas])) {?>
      <td align="center"><?php echo cambiaf_a_normal($fec_pag[$cuotas]); ?> </td>
	  <?php } ?>	
 </tr>
 </table> 
 </FONT> 

<?php
$nro_ctas = $cuotas;
 ?>	
  
	 <?php
  $con_tpa = "Select * from temp_cobro where TEMP_COB_TIPO = 1";
  $res_tpa = mysql_query($con_tpa)or die('No pudo seleccionarse tabla cart_det_tran');
	//$nro = 0;
	$nro_clie = 0;
	$tot_0 = 0;
	    while ($lin_tpa = mysql_fetch_array($res_tpa)) {
		   //    $nro = $nro + 1;
		   $nro_clie = $nro_clie + 1;
			   $cod_cli = $lin_tpa['TEMP_COB_CLI'];
		 	   $nro_cli = $lin_tpa['TEMP_COB_DEHA'];
			   $mon_cta[$nro_cli] = $lin_tpa['TEMP_COB_IMPO'];
               $tot_0 =  $tot_0 + $lin_tpa['TEMP_COB_IMPO'];	



	$consulta  = "Select CRED_DEU_INTERNO, CLIENTE_COD_ID,CLIENTE_AP_PATERNO, CLIENTE_AP_MATERNO, CLIENTE_NOMBRES, CRED_DEU_RELACION,CRED_DEU_IMPORTE, CRED_DEU_COMISION, CRED_DEU_AHO_INI, CRED_DEU_AHO_DUR, CRED_DEU_INT_CTA From cliente_general, cred_deudor where CRED_SOL_CODIGO = $cod_sol and CRED_DEU_INTERNO =  $cod_cli and
	 CRED_DEU_INTERNO = CLIENTE_COD and CRED_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null";
    $resultado = mysql_query($consulta);
	
	while ($linea = mysql_fetch_array($resultado)) {
	     // $nro_clie = $nro_clie + 1;
		  $clie_int = $linea['CRED_DEU_INTERNO'];
	      $cliente[$nro_cli] = $linea['CRED_DEU_INTERNO'];
	      $clie_nomb = $linea['CLIENTE_AP_PATERNO']. "  ". $linea['CLIENTE_AP_MATERNO']. " ".
		               $linea['CLIENTE_NOMBRES'];
	      $clie_nombre[$nro_cli] = $clie_nomb;
		  $rela[$nro_cli] = $linea['CRED_DEU_RELACION'];
		  
		  //echo $nro_clie;
	}
}	
 for ($i=1; $i < $nro_clie+1; $i = $i + 1 ) {
     $mon_pag_1[$i] = 0;
	  $mon_pag_2[$i] = 0;
      $mon_pag_3[$i] = 0;
	  $mon_pag_4[$i] = 0;
	  $mon_pag_5[$i] = 0;
	  $mon_pag_6[$i] = 0;
	  $mon_pag_7[$i] = 0;
	  $mon_pag_8[$i] = 0;
	  $mon_pag_9[$i] = 0;
	  $mon_pag_10[$i] = 0;
	  $mon_pag_11[$i] = 0;
	  $mon_pag_12[$i] = 0;
	  $mon_pag_13[$i] = 0;
	  $mon_pag_14[$i] = 0;
	  $mon_pag_15[$i] = 0;
}
    ?>
	 <?php
 //   if ($nro_ctas < 6){
    ?>			
	<table width="800"  border="1" align="center">
    <tr>
	   <th width="5%" style="font-size:12px">Rel.</td>
	   <th width="40%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />CLIENTE</th>
	  <th width="15%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />CUOTA</th>
	 <?php 
	  $con_tpa = "Select DISTINCT TEMP_COB_FECHA  from temp_cobro where TEMP_COB_TIPO = 2 
				 order by TEMP_COB_FECHA ";
    $res_tpa = mysql_query($con_tpa)or die('No pudo seleccionarse tabla cart_det_tran')  ;
	$nro = 0;
	    while ($lin_tpa = mysql_fetch_array($res_tpa)) {
		       $nro = $nro + 1;
			   $fecha_pag[$nro] = $lin_tpa['TEMP_COB_FECHA'];
	
}	 
	 
	 
	 
	 
	 $con_tpa = "Select DISTINCT TEMP_COB_FECHA  from temp_cobro where TEMP_COB_TIPO = 2 
				 order by TEMP_COB_FECHA ";
    $res_tpa = mysql_query($con_tpa)or die('No pudo seleccionarse tabla cart_det_tran')  ;
	$nro_p = 0;
	    while ($lin_tpa = mysql_fetch_array($res_tpa)) {
		        $nro_p = $nro_p + 1;
			   $fec_pag = $lin_tpa['TEMP_COB_FECHA'];
	       
		   
		       
	        $con_tpa2 = "Select *  from temp_cobro where TEMP_COB_TIPO = 2 and
			             TEMP_COB_FECHA = '$fec_pag'";
    $res_tpa2 = mysql_query($con_tpa2)or die('No pudo seleccionarse tabla temp_cobro')  ;
	//$nro_p = 0;
	    while ($lin_tpa2 = mysql_fetch_array($res_tpa2)) {
		      
		       // $cod_cli = $lin_tpa['TEMP_COB_CLI'];
		 	   $nro_cli = $lin_tpa2['TEMP_COB_DEHA'];
			   
			   if ($nro_p == 1){
			      $mon_pag_1[$nro_cli] = $lin_tpa2['TEMP_COB_IMPO'];
			   }
			   if ($nro_p == 2){
			      $mon_pag_2[$nro_cli] = $lin_tpa2['TEMP_COB_IMPO'];
			   }
			   if ($nro_p == 3){
			      $mon_pag_3[$nro_cli] = $lin_tpa2['TEMP_COB_IMPO'];
				  //echo $mon_pag_3[$nro_cli];
			   }
			   if ($nro_p == 4){
			      $mon_pag_4[$nro_cli] = $lin_tpa2['TEMP_COB_IMPO'];
			   }
			    if ($nro_p == 5){
			      $mon_pag_5[$nro_cli] = $lin_tpa2['TEMP_COB_IMPO'];
			   }
			    if ($nro_p == 6){
			      $mon_pag_6[$nro_cli] = $lin_tpa2['TEMP_COB_IMPO'];
			   }
			    if ($nro_p == 7){
			      $mon_pag_7[$nro_cli] = $lin_tpa2['TEMP_COB_IMPO'];
			   }
			    if ($nro_p == 8){
			      $mon_pag_8[$nro_cli] = $lin_tpa2['TEMP_COB_IMPO'];
			   }
			    if ($nro_p == 9){
			      $mon_pag_9[$nro_cli] = $lin_tpa2['TEMP_COB_IMPO'];
			   }
			    if ($nro_p == 10){
			      $mon_pag_10[$nro_cli] = $lin_tpa2['TEMP_COB_IMPO'];
			   }
			   if ($nro_p == 11){
			      $mon_pag_11[$nro_cli] = $lin_tpa2['TEMP_COB_IMPO'];
			   }
			   if ($nro_p == 12){
			      $mon_pag_12[$nro_cli] = $lin_tpa2['TEMP_COB_IMPO'];
			   }
			   if ($nro_p == 13){
			      $mon_pag_13[$nro_cli] = $lin_tpa2['TEMP_COB_IMPO'];
			   }
			   if ($nro_p == 14){
			      $mon_pag_14[$nro_cli] = $lin_tpa2['TEMP_COB_IMPO'];
			   }
			   if ($nro_p == 15){
			      $mon_pag_15[$nro_cli] = $lin_tpa2['TEMP_COB_IMPO'];
			   }
			   if ($nro_p == 16){
			      $mon_pag_16[$nro_cli] = $lin_tpa2['TEMP_COB_IMPO'];
			   }
			   if ($nro_p == 17){
			      $mon_pag_17[$nro_cli] = $lin_tpa2['TEMP_COB_IMPO'];
			   }
			   if ($nro_p == 18){
			      $mon_pag_18[$nro_cli] = $lin_tpa2['TEMP_COB_IMPO'];
			   }
			   if ($nro_p == 19){
			      $mon_pag_19[$nro_cli] = $lin_tpa2['TEMP_COB_IMPO'];
			   }
			   if ($nro_p == 20){
			      $mon_pag_20[$nro_cli] = $lin_tpa2['TEMP_COB_IMPO'];
			   }
			   if ($nro_p == 21){
			      $mon_pag_21[$nro_cli] = $lin_tpa2['TEMP_COB_IMPO'];
			   }
			   if ($nro_p == 22){
			      $mon_pag_22[$nro_cli] = $lin_tpa2['TEMP_COB_IMPO'];
			   }
			   if ($nro_p == 23){
			      $mon_pag_23[$nro_cli] = $lin_tpa2['TEMP_COB_IMPO'];
			   }
			   if ($nro_p == 24){
			      $mon_pag_24[$nro_cli] = $lin_tpa2['TEMP_COB_IMPO'];
			   }
			   if ($nro_p == 25){
			      $mon_pag_25[$nro_cli] = $lin_tpa2['TEMP_COB_IMPO'];
			   }
			   if ($nro_p == 26){
			      $mon_pag_26[$nro_cli] = $lin_tpa2['TEMP_COB_IMPO'];
			   }
			   if ($nro_p == 27){
			      $mon_pag_27[$nro_cli] = $lin_tpa2['TEMP_COB_IMPO'];
			   }
			   if ($nro_p == 28){
			      $mon_pag_28[$nro_cli] = $lin_tpa2['TEMP_COB_IMPO'];
			   }
			   if ($nro_p == 29){
			      $mon_pag_29[$nro_cli] = $lin_tpa2['TEMP_COB_IMPO'];
			   }
			   if ($nro_p == 30){
			      $mon_pag_30[$nro_cli] = $lin_tpa2['TEMP_COB_IMPO'];
			   }
			   if ($nro_p == 31){
			      $mon_pag_31[$nro_cli] = $lin_tpa2['TEMP_COB_IMPO'];
			   }
			   if ($nro_p == 32){
			      $mon_pag_32[$nro_cli] = $lin_tpa2['TEMP_COB_IMPO'];
			   }
			   if ($nro_p == 33){
			      $mon_pag_33[$nro_cli] = $lin_tpa2['TEMP_COB_IMPO'];
			   }
			   if ($nro_p == 34){
			      $mon_pag_34[$nro_cli] = $lin_tpa2['TEMP_COB_IMPO'];
			   }
		}
	$tot_cta = 0;
	
	
	
		 	 
			 
		}	 
	
	 
	 
	 for ($i=1; $i < $nro+1; $i = $i + 1 ) { ?>
		<th>
		<?php echo  cambiaf_a_normal($fecha_pag[$i]);?></th>
			
		<?php } ?>		
	  
	</th>
	 <?php
  
	
//	$consulta  = "Select * From temp_cobro where TEMP_COB_DEHA = 1 order by TEMP_COB_CLI,TEMP_COB_FECHA  ";
 //   $resultado = mysql_query($consulta);
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
//$tot_0 = 0;
echo $nro_clie."nro clie";




			 for ($i=1; $i < $nro_clie+1; $i = $i + 1 ) {
			?>
	<tr>
	   <td align="left" style="font-size:12px" ><?php echo $rela[$i]; ?></td> 
	   <td align="left" style="font-size:12px" ><?php echo  $clie_nombre[$i]; ?></td>
	   <th align="right" style="font-size:14px" ><?php echo $mon_cta[$i]; ?></td>
	   <?php if (isset($mon_pag_1[$i])) { 
	            $tot_1 = $tot_1 + $mon_pag_1[$i];?> 
	    <td align="right" style="font-size:14px" ><?php echo $mon_pag_1[$i]; ?></td>
		<?php } ?>
		<?php if (isset($mon_pag_2[$i])) {
		     	  $tot_2 = $tot_2 + $mon_pag_2[$i];  ?> 
	 	<td align="right" style="font-size:14px" ><?php echo $mon_pag_2[$i]; ?></td> 
		<?php } ?>
		<?php if (isset($mon_pag_3[$i])) { 
		         $tot_3 = $tot_3 + $mon_pag_3[$i];
			//	 echo $tot_3;?>
		<td align="right" style="font-size:14px" ><?php echo $mon_pag_3[$i]; ?></td> 
		<?php } ?>
		<?php if (isset($mon_pag_4[$i])) {
		      	  $tot_4 = $tot_4 + $mon_pag_4[$i]; ?>
		<td align="right" style="font-size:14px" ><?php echo $mon_pag_4[$i]; ?></td> 
		<?php } ?>
		<?php if (isset($mon_pag_5[$i])) {
		          $tot_5 = $tot_5 + $mon_pag_5[$i]; ?>
		<td align="right" style="font-size:14px" ><?php echo $mon_pag_5[$i]; ?></td> 
		<?php } ?>
		<?php if (isset($mon_pag_6[$i])) { 
		      	  $tot_6 = $tot_6 + $mon_pag_6[$i]; ?>
		<td align="right" style="font-size:14px" ><?php echo $mon_pag_6[$i]; ?></td> 
		<?php } ?>
		<?php if (isset($mon_pag_7[$i])) { 
		      	 $tot_7 = $tot_7 + $mon_pag_7[$i];?>
		<td align="right" style="font-size:14px" ><?php echo $mon_pag_7[$i]; ?></td> 
		<?php } ?>
		<?php if (isset($mon_pag_8[$i])) { 
		      	 $tot_8 = $tot_8 + $mon_pag_8[$i];?>
		<td align="right" style="font-size:14px" ><?php echo $mon_pag_8[$i]; ?></td> 
		<?php } ?>
		<?php if (isset($mon_pag_9[$i])) { 
		      	 $tot_9 = $tot_9 + $mon_pag_9[$i];?>
		<td align="right" style="font-size:14px" ><?php echo $mon_pag_9[$i]; ?></td> 
		<?php } ?>
		<?php if (isset($mon_pag_10[$i])) { 
		      	 $tot_10 = $tot_10 + $mon_pag_10[$i];?>
		<td align="right" style="font-size:14px" ><?php echo $mon_pag_10[$i]; ?></td> 
		<?php } ?>
		<?php if (isset($mon_pag_11[$i])) { 
		      	 $tot_11 = $tot_11 + $mon_pag_11[$i];?>
		<td align="right" style="font-size:14px" ><?php echo $mon_pag_11[$i]; ?></td> 
		<?php } ?>
		<?php if (isset($mon_pag_12[$i])) { 
		      	 $tot_12 = $tot_12 + $mon_pag_12[$i];?>
		<td align="right" style="font-size:14px" ><?php echo $mon_pag_12[$i]; ?></td> 
		<?php } ?>
		<?php if (isset($mon_pag_13[$i])) { 
		      	 $tot_13 = $tot_13 + $mon_pag_13[$i];?>
		<td align="right" style="font-size:14px" ><?php echo $mon_pag_13[$i]; ?></td> 
		<?php } ?>
		<?php if (isset($mon_pag_14[$i])) { 
		      	 $tot_14 = $tot_14 + $mon_pag_14[$i];?>
		<td align="right" style="font-size:14px" ><?php echo $mon_pag_14[$i]; ?></td> 
		<?php } ?>
		<?php if (isset($mon_pag_15[$i])) { 
		      	 $tot_15 = $tot_15 + $mon_pag_15[$i];?>
		<td align="right" style="font-size:14px" ><?php echo $mon_pag_15[$i]; ?></td> 
		<?php } ?>
		<?php $total = $mon_pag_1[$i] + $mon_pag_2[$i] +$mon_pag_3[$i]+$mon_pag_4[$i]+
		               $mon_pag_5[$i] + $mon_pag_6[$i] +$mon_pag_8[$i]+$mon_pag_9[$i]+
					   $mon_pag_10[$i] + $mon_pag_11[$i] +$mon_pag_12[$i]+$mon_pag_13[$i]+
					   $mon_pag_14[$i] + $mon_pag_15[$i];?>
		<th align="right" style="font-size:14px" ><?php echo number_format($total, 2, '.',','); ?></td> 
		
	</tr>
		
	
	   <?php
	   
	   
	   
	    
	   $cuenta1 = $cuenta2;
	  }
	   //  }
	   $con_det  = "Select * From temp_cobro where TEMP_COB_TIPO = 2 order by TEMP_COB_FECHA";
    $res_det = mysql_query($con_det);
	$tot_debe_1 = 0;
    $tot_haber_1 = 0;
    $tot_debe_2 = 0;
    $tot_haber_2 = 0;
	$cuenta1 = 0;
	$cuenta2 = 0;
	 $nrocta = 0;
	// $tot_2 = 0;
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
		
		
		
		  
		  
		   
		  
		
		   
		 
		 
		 
		 
		
		   
     <?php
	} 
//	}
	?> 
	<tr>
	   <td align="left" style="font-size:12px" ><?php echo encadenar(4); ?></td> 
	   <th align="center" style="font-size:12px" ><?php echo  "TOTALES"; ?></td>
	   <th align="right" style="font-size:14px" ><?php echo  number_format($tot_0, 2, '.',','); ?></td> 
	   <?php if ($tot_1 > 0){ ?>
	   
	   <th align="right" style="font-size:12px"><?php echo number_format($tot_1, 2, '.',',') ; ?></td> 
	   <?php } ?> 
	   <?php if ($tot_2 > 0){ ?>
	  
	   <th align="right" style="font-size:12px"><?php echo number_format($tot_2, 2, '.',',') ; ?></td>
	    <?php } ?> 
		<?php if ($tot_3 > 0){ ?>
	  
	   <th align="right" style="font-size:12px"><?php echo number_format($tot_3, 2, '.',',') ; ?></td>
	    <?php } ?>
		<?php if ($tot_4 > 0){ ?>
	  
	   <th align="right" style="font-size:12px"><?php echo number_format($tot_4, 2, '.',',') ; ?></td>
	    <?php } ?>
		<?php if ($tot_5 > 0){ ?>
	  
	   <th align="right" style="font-size:12px"><?php echo number_format($tot_5, 2, '.',',') ; ?></td>
	    <?php } ?>
	   <?php if ($tot_6 > 0){ ?>
	  
	   <th align="right" style="font-size:12px"><?php echo number_format($tot_6, 2, '.',',') ; ?></td>
	    <?php } ?>
		<?php if ($tot_7 > 0){ ?>
	  
	   <th align="right" style="font-size:12px"><?php echo number_format($tot_7, 2, '.',',') ; ?></td>
	    <?php } ?>
		<?php if ($tot_8 > 0){ ?>
	  
	   <th align="right" style="font-size:12px"><?php echo number_format($tot_8, 2, '.',',') ; ?></td>
	    <?php } ?>
		<?php if ($tot_9 > 0){ ?>
	  
	   <th align="right" style="font-size:12px"><?php echo number_format($tot_9, 2, '.',',') ; ?></td>
	    <?php } ?>
		<?php if ($tot_10 > 0){ ?>
	  
	   <th align="right" style="font-size:12px"><?php echo number_format($tot_10, 2, '.',',') ; ?></td>
	    <?php } ?>
		<?php if ($tot_11 > 0){ ?>
	  
	   <th align="right" style="font-size:12px"><?php echo number_format($tot_11, 2, '.',',') ; ?></td>
	    <?php } ?>
		<?php if ($tot_12 > 0){ ?>
	  
	   <th align="right" style="font-size:12px"><?php echo number_format($tot_12, 2, '.',',') ; ?></td>
	    <?php } ?>
		<?php if ($tot_13 > 0){ ?>
	  
	   <th align="right" style="font-size:12px"><?php echo number_format($tot_13, 2, '.',',') ; ?></td>
	    <?php } ?>
		<?php if ($tot_14 > 0){ ?>
	  
	   <th align="right" style="font-size:12px"><?php echo number_format($tot_14, 2, '.',',') ; ?></td>
	    <?php } ?>
		<?php if ($tot_15 > 0){ ?>
	  
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