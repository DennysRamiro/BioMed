<?php
	session_start();
 ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
	if(!isset($_SESSION['login']) || !isset($_SESSION['clave'])){
    header("Location: index.php?error=1");
} else {


	require('configuracion.php');
    require('funciones.php');
	require('funciones2.php');
	
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
<?php
//$_SESSION['form_buffer'] = $_POST;
$fec = leer_param_gral();
$log_usr = $_SESSION['login']; 
$imp_sol = $_SESSION["impo_sol"];
//$cod_sol = $_SESSION['nro_sol'];
$total = 0;
?> 

</div>
<div id="Salir">
     <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
</div>
<center>
<div id="TitleModulo">
   	 <img src="images/24x24/001_36.png" border="0" alt="Modulo">	
           Orden de Desembolso
</div>
<div id="AtrasBoton">
    <a href="solic_mante.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
</div>
<div id="GeneralManSolicaa">
<center>
<?php
//echo $_SESSION['nro_sol'], "llega nro sol",$_SESSION['continuar'],"continuar";
//if ( $_SESSION['continuar'] == 2) {
 //  $quecom = $_POST['cod_sol'];
//   for ($i=0; $i < count($quecom); $i = $i + 1 ) {
 //      if (isset($quecom[$i]) ) {
  //        $cod_sol = $quecom[$i];
	//      $_SESSION['nro_sol'] = $cod_sol;
 //      }
 //  } 
//   }else{
   $cod_sol = 53000002;
  // }
   
//Actualiza nuevo monto deuda y la comision
   
 //Seleccion solicitud
//echo $cod_sol, "para lectura";
$con_sol  = "Select * From cred_solicitud where CRED_SOL_CODIGO = $cod_sol and CRED_SOL_USR_BAJA is null"; 
$res_sol = mysql_query($con_sol)or die('No pudo seleccionarse solicitud 2');
   while ($lin_sol = mysql_fetch_array($res_sol)) {
         $t_op = $lin_sol['CRED_SOL_TIPO_OPER']; 
		 $impo = $lin_sol['CRED_SOL_IMPORTE'];
		 $impo2 = number_format($impo, 2, '.',',');
		  
		 $imp_c = $lin_sol['CRED_SOL_IMP_COM'];
		 $impoc = number_format($imp_c, 2, '.',','); 
		 
		 $comif = $lin_sol['CRED_SOL_COM_F'];
	     $imp_sc = $impo + $imp_c;
		 if ($comif == 2){
    	    $impsc = $imp_sc ;
		    }
	     if ($comif == 1){
    	    $impsc = $impo ;
		    }	
	     $imposc = number_format($impsc, 2, '.',','); 
		 
		 $tinta = $lin_sol['CRED_SOL_TASA'];
		 $tinta = number_format($tinta, 2, '.',','); 
		 
		 $tintm = $tinta / 12;
		 $tintm = number_format($tintm, 2, '.',','); 
		 		
		 $mon  = $lin_sol['CRED_SOL_COD_MON'];
		 $comi  = $lin_sol['CRED_SOL_TIP_COM'];
		 
		 $plzm  = $lin_sol['CRED_SOL_PLZO_M'];
		 $plzd  = $lin_sol['CRED_SOL_PLZO_D'];
		 
		 $cuotas = $lin_sol['CRED_SOL_NRO_CTA'];
		 
		 $ahod  = $lin_sol['CRED_SOL_AHO_DUR'];
		 $ahoi  = $lin_sol['CRED_SOL_AHO_INI'];
		 $tint  = $lin_sol['CRED_SOL_TASA'];
		 
		 $com_f  = $lin_sol['CRED_SOL_COM_F']; 
		 $aho_f  = $lin_sol['CRED_SOL_AHO_F'];
		 $aho_fm  = $lin_sol['CRED_SOL_AHO_DM'];
		 $f_pag  = $lin_sol['CRED_SOL_FORM_PAG']; 
		 $f_des  = $lin_sol['CRED_SOL_FEC_DES'];
		 $f_uno  = $lin_sol['CRED_SOL_FEC_UNO'];
		 $c_int = $lin_sol['CRED_SOL_CAL_INT']; 
		 
		 $grupo = $lin_sol['CRED_SOL_COD_GRUPO'];
		 $f_des2= cambiaf_a_normal($f_des); 
		 $f_uno2= cambiaf_a_normal($f_uno); 
		 $dia = saca_dia($f_uno2);
		 $mes = saca_mes($f_uno2);
		 $ano = saca_anio($f_uno2);
		 $dia_p = dia_semana ($dia, $mes, $ano);
   }
  //Calculo Interes
	  
	   $con_cin = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 10 and GRAL_PAR_INT_COD = $c_int";
       $res_cin = mysql_query($con_cin)or die('No pudo seleccionarse tabla 1')  ;
	   while ($linea = mysql_fetch_array($res_cin)) {
	        $d_cin = $linea['GRAL_PAR_INT_DESC'];
	   }
       $con_top = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 21 and GRAL_PAR_INT_COD = $t_op";
       $res_top = mysql_query($con_top)or die('No pudo seleccionarse tabla 1')  ;
	   while ($linea = mysql_fetch_array($res_top)) {
	        $d_top = $linea['GRAL_PAR_INT_DESC'];
	   }
	   $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD = $mon";
       $res_mon = mysql_query($con_mon)or die('No pudo seleccionarse tabla 1')  ;
	   while ($linea = mysql_fetch_array($res_mon)) {
	        $d_mon = $linea['GRAL_PAR_INT_DESC'];
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
 if ($ahod == 1){
    $con_ahof  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 914 and GRAL_PAR_PRO_COD = $aho_f ";
    $res_ahof = mysql_query($con_ahof)or die('No pudo seleccionarse tabla 5')  ;
	while ($lin_ahof = mysql_fetch_array($res_ahof)) {
	      $aho_fa  = $lin_ahof['GRAL_PAR_PRO_CTA1'];
		  $aho_fd  = $lin_ahof['GRAL_PAR_PRO_DESC'];
	}
  }
   $fila = 1;
   $con_gral  = "Select * From cred_general"; 
   $res_gral = mysql_query($con_gral)or die('No pudo seleccionarse cred_general');
   while ($lin_gral = mysql_fetch_array($res_gral)) {
         if ($fila == 1){
		     $act_gral = "update cred_general set cred_gral_m1 = '$impo2',
			                                      cred_gral_m2 = '$impoc',
												  cred_gral_m3 = '$imposc',
												  cred_gral_m4 = '$d_mon'
												  where cred_gral_nro = $fila ";
			$gral_act = mysql_query($act_gral)or die('No pudo actualizar cred_general');
		 }
		 
		 if ($fila == 2){
		     $tint1 = $tinta.' % Anual ';
			 $tint2 = $tintm.' %  Mensual';
		     $act_gral = "update cred_general set cred_gral_m1 = '$tint1',
			                                      cred_gral_m2 = '$tint2',
												  cred_gral_m3 = '$plzm',
												  cred_gral_m4 = '$plzd'
												  where cred_gral_nro = $fila ";
			$gral_act = mysql_query($act_gral)or die('No pudo actualizar cred_general');
		 }
		 
		if ($fila == 3){
		   $nro_d = $nro_d.' dias ';
		  
		   $act_gral = "update cred_general set cred_gral_m1 = '$cuotas',
			                                      cred_gral_m2 = '$d_cin',
												  cred_gral_m3 = '$fpag_d',
												  cred_gral_m4 = ' $nro_d '
												  where cred_gral_nro = $fila ";
			$gral_act = mysql_query($act_gral)or die('No pudo actualizar cred_general');
		 } 
		 if ($fila == 4){
		   $ahod = $ahod.' % ';
		   $ahoi = $ahoi.' % ';
		   $act_gral = "update cred_general set cred_gral_m1 = '$f_des2',
			                                      cred_gral_m2 = '$f_uno2',
												  cred_gral_m3 = '$ahod',
												  cred_gral_m4 = '$ahoi'
												  where cred_gral_nro = $fila ";
			$gral_act = mysql_query($act_gral)or die('No pudo actualizar cred_general');
		 } 
		 
	$fila = $fila + 1;	  
   
   }
   
   
   
   	  
	 ?>
	
	
	 <?php
	$con_grupo  = "Select CLIENTE_COD_ID,CLIENTE_AP_PATERNO, CLIENTE_AP_MATERNO, CLIENTE_NOMBRES, CRED_GRP_MES_REL, CRED_GRP_NOMBRE, GRAL_PAR_PRO_DESC, CRED_GRP_MES_REL From cliente_general, cred_grupo, cred_grupo_mesa, gral_param_propios where CRED_GRP_CODIGO = $grupo and CRED_GRP_MES_COD = $grupo  and CRED_GRP_MES_CLI = CLIENTE_COD and GRAL_PAR_PRO_GRP = 910 and GRAL_PAR_PRO_COD = CRED_GRP_MES_REL and CRED_GRP_USR_BAJA is null and CLIENTE_USR_BAJA is null";
  
  $res_grupo = mysql_query($con_grupo);
  while ($lin_grp = mysql_fetch_array($res_grupo)) {
     echo encadenar(50).$lin_grp ['GRAL_PAR_PRO_DESC'];
	 if ($lin_grp['CRED_GRP_MES_REL'] == 1){
	     echo encadenar(13);
		 } 
	 if ($lin_grp['CRED_GRP_MES_REL'] == 2){
	     echo encadenar(24);
		 }
	 if ($lin_grp['CRED_GRP_MES_REL'] == 3){
	     echo encadenar(10);
		 }		 
     echo $lin_grp ['CLIENTE_NOMBRES'], "  ";
	 echo $lin_grp ['CLIENTE_AP_PATERNO'], "  ";
	 echo $lin_grp ['CLIENTE_AP_MATERNO'];
	 
	 ?>
	 <BR>
	 <?php
	 }
  
   ?>
 
  
 

 
	
<?php	
$consulta  = "Select * From cred_general ";
    $resultado = mysql_query($consulta);
 ?>		
		<table border="1">
	
<?php

while ($linea = mysql_fetch_array($resultado)) {
   
	 ?>
	 <tr>
	    
	 	<td><strong><?php echo $linea['cred_gral_d1']; ?></strong></td>
		
		<td><?php echo $linea['cred_gral_m1']; ?></td>
		
		<td><strong><?php echo $linea['cred_gral_d2']; ?></strong></td>
		
		<td><?php echo $linea['cred_gral_m2']; ?></td>
		
		<td><strong><?php echo $linea['cred_gral_d3']; ?></strong></td>
		
		<td><?php echo $linea['cred_gral_m3']; ?></td>
		
		<td><strong><?php echo $linea['cred_gral_d4']; ?></strong></td>
		
		<td><?php echo $linea['cred_gral_m4']; ?></td>
 <?php
}
}
?>
</table>




	


