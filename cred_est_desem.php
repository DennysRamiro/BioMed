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
if(isset($_SESSION['login'])){
   $log_usr = $_SESSION['login'];
   } 
if(isset($_SESSION["impo_sol"])){    
   $imp_sol = $_SESSION["impo_sol"];
   }
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
if ( $_SESSION['continuar'] == 2) {
   $quecom = $_POST['cod_sol'];
   for ($i=0; $i < count($quecom); $i = $i + 1 ) {
       if (isset($quecom[$i]) ) {
          $cod_sol = $quecom[$i];
	      $_SESSION['nro_sol'] = $cod_sol;
       }
   } 
   }else{
   $cod_sol = $_SESSION['nro_sol'];
   }
//Seleccion solicitud
//echo $cod_sol, "para lectura";
$con_sol  = "Select * From cred_solicitud where CRED_SOL_CODIGO = $cod_sol and CRED_SOL_USR_BAJA is null"; 
$res_sol = mysql_query($con_sol)or die('No pudo seleccionarse solicitud 2');
   while ($lin_sol = mysql_fetch_array($res_sol)) {
         $t_op = $lin_sol['CRED_SOL_TIPO_OPER']; 
		 $impo = $lin_sol['CRED_SOL_IMPORTE'];
		 $imp_c = $lin_sol['CRED_SOL_IMP_COM'];
		 $imp_sc = $impo + $imp_c;
		 $mon  = $lin_sol['CRED_SOL_COD_MON'];
		 $comi  = $lin_sol['CRED_SOL_TIP_COM'];
		 $comif = $lin_sol['CRED_SOL_COM_F'];
		 $ahod  = $lin_sol['CRED_SOL_AHO_DUR'];
		 $ahoi  = $lin_sol['CRED_SOL_AHO_INI'];
		 $tint  = $lin_sol['CRED_SOL_TASA'];
		 $plzm  = $lin_sol['CRED_SOL_PLZO_M'];
		 $plzd  = $lin_sol['CRED_SOL_PLZO_D'];
		 $com_f  = $lin_sol['CRED_SOL_COM_F']; 
		 $aho_f  = $lin_sol['CRED_SOL_AHO_F'];
		 $aho_fm  = $lin_sol['CRED_SOL_AHO_DM'];
		 $f_pag  = $lin_sol['CRED_SOL_FORM_PAG']; 
		 $f_des  = $lin_sol['CRED_SOL_FEC_DES'];
		 $f_uno  = $lin_sol['CRED_SOL_FEC_UNO'];
		 $c_int = $lin_sol['CRED_SOL_CAL_INT']; 
		 $cuotas = $lin_sol['CRED_SOL_NRO_CTA'];
		 $grupo = $lin_sol['CRED_SOL_COD_GRUPO'];
		 $dia_p = $lin_sol['CRED_SOL_DIA_REU']; 
		 $f_des2= cambiaf_a_normal($f_des); 
		 $f_uno2= cambiaf_a_normal($f_uno); 
	 	// $dia = saca_dia($f_uno2);
		// $mes = saca_mes($f_uno2);
		// $ano = saca_anio($f_uno2);
		// $dia_p = dia_semana ($dia, $mes, $ano);
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
 	 ?>
	 <br>
	<form name="form1" method="post" action="solic_retro_sol.php" style="border:groove" target="_self"  > 
	<strong> Datos Basicos para Orden de Desembolso </strong>	
    <br>
	<strong>  Solicitud </strong>
	<strong>
   <?php  
     echo $cod_sol, "  ",  "  Tipo Operacion ", $d_top ;    
 ?>
 
 <?php 
  if ($t_op < 3) {
      $con_g_nom  = "Select CRED_GRP_NOMBRE from cred_grupo where CRED_GRP_CODIGO = $grupo and CRED_GRP_USR_BAJA is null ";
  
  $res_g_nom = mysql_query($con_g_nom);
  while ($lin_g_nom = mysql_fetch_array($res_g_nom)) {
     $nom_grp = $lin_g_nom ['CRED_GRP_NOMBRE'];
	 }
   	 ?>
	 <strong> Grupo  </strong>
	 <?php 
     echo  "  " , $nom_grp; 
	  ?>
    <br><br>
	<center>
	  <strong> MESA DIRECTIVA </strong>
	  <br>
  	<table border="1">
	<tr>
	   	<th align="center">Cargo</th>
		<th align="center">Cliente</th>
	</tr>
  
  
  <?php
	 
	$con_grupo  = "Select CLIENTE_COD_ID,CLIENTE_AP_PATERNO, CLIENTE_AP_MATERNO, CLIENTE_NOMBRES, CRED_GRP_MES_REL, CRED_GRP_NOMBRE, GRAL_PAR_PRO_DESC, CRED_GRP_MES_REL From cliente_general, cred_grupo, cred_grupo_mesa, gral_param_propios where CRED_GRP_CODIGO = $grupo and CRED_GRP_MES_COD = $grupo  and CRED_GRP_MES_CLI = CLIENTE_COD and GRAL_PAR_PRO_GRP = 910 and GRAL_PAR_PRO_COD = CRED_GRP_MES_REL and CRED_GRP_USR_BAJA is null and CLIENTE_USR_BAJA is null";
   $res_grupo = mysql_query($con_grupo);
  while ($lin_grp = mysql_fetch_array($res_grupo)) {
     ?>
	 <tr>
	   	<td align="left"> <?php echo $lin_grp ['GRAL_PAR_PRO_DESC'];?> </td>
		<td align="center"><?php echo $lin_grp ['CLIENTE_NOMBRES'], "  ";
	                             echo $lin_grp ['CLIENTE_AP_PATERNO'], "  ";
	                             echo $lin_grp ['CLIENTE_AP_MATERNO'];?></td>
	</tr>
	 <?php
	
	 ?>
	 <BR>
	 <?php
	 }
  }
   ?>
  <?php 
   $impo = $impo ;
   $impo2 = number_format($impo, 2, '.',','); 
    $impc = $imp_c ;
	$impoc = number_format($impc, 2, '.',',');
	if ($comif == 2){
    	$impsc = $imp_sc ;
		}
	if ($comif == 1){
    	$impsc = $impo ;
		}	
	$imposc = number_format($impsc, 2, '.',','); 
	$tint_f = number_format($tint, 2, '.',','); 
	  $_SESSION["aho_d"] =  $ahod;  
    ?>
   </table>
 <center>
 </strong>
 <br>
 <table border="1">
 <tr>
   <th align="left"> Importe Solicitado </th>
   <td align="right"> <?php echo $impo2; ?> </td>
   <th align="left"> Comision </th>
   <td align="right"> <?php echo $impoc;  ?> </td>
   <th align="left"> Importe Cartera </th>
   <td align="right"> <?php echo $imposc;  ?> </td>
 </tr>
  <tr>
   <th align="left"> Moneda </th>
   <td align="right"> <?php echo $d_mon; ?> </td>
   <th align="left"> Tasa Int. Anual </th>
   <td align="right"> <?php echo $tint_f." %"; ?> </td>
   <th align="left"> Plazo </th>
   <td align="right"> <?php  echo $plzm, "  Meses  ", $plzd , "  Días"; ?> </td>
 </tr>  
  <tr>
   <th align="left"> Numero de Cuotas </th>
   <td align="right"> <?php echo $cuotas; ?> </td>
   <th align="left"> Calculo Interes </th>
   <td align="right"> <?php echo  $d_cin; ?> </td>
   <th align="left"> Fondo Garantia Ciclo </th>
   <td align="right"> <?php echo $ahod. " %";  ?> </td>
 </tr>  
  <tr>
   <th align="left"> Fecha Desembolso </th>
   <td align="center"> <?php echo $f_des2; ?> </td>
   <th align="left"> Fecha 1er. Pago </th>
   <td align="right"> <?php echo $f_uno2.encadenar(1).$dia_p; ?> </td>
   <th align="left"> Fondo Garantia Inicio </th>
   <td align="right"> <?php echo $ahoi. " %"; ?> </td>
 </tr> 
 
 </table>
 <br> 
<?php	
$consulta  = "Select CRED_DEU_INTERNO, CLIENTE_COD_ID,CLIENTE_AP_PATERNO, CLIENTE_AP_MATERNO, CLIENTE_NOMBRES, CRED_DEU_RELACION,CRED_DEU_IMPORTE, CRED_DEU_COMISION, CRED_DEU_AHO_INI, CRED_DEU_AHO_DUR, CRED_DEU_INT_CTA, CRED_DEU_USR_BAJA From cliente_general, cred_deudor where CRED_SOL_CODIGO = $cod_sol and CRED_DEU_INTERNO = CLIENTE_COD and CRED_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null";
    $resultado = mysql_query($consulta);
	$t_imp_car = 0; 
    $t_imp_com = 0;
    $t_imp_aho = 0;
    $t_imp_cap = 0;
    $t_imp_cta = 0;
 ?>		
		<table border="1">
	<tr>
	   	<th>Cliente</th>
		<th>Monto Cartera</th>
		<th>Comisión</th>
		<th>Ahorro Inicio</th>
		<th>Monto Cuota</th>
		</tr>
<?php
$imp_aho = 0;
while ($linea = mysql_fetch_array($resultado)) {
  $nom_com = $linea['CLIENTE_AP_PATERNO']. " ". $linea['CLIENTE_AP_MATERNO']." ".$linea['CLIENTE_NOMBRES'];
	 ?>
	 <tr>
	 	<td><?php echo $nom_com; ?></td>
		
	        <?php if ($comif == 2){ ?>	
		<td align="right"><?php echo number_format($linea['CRED_DEU_IMPORTE'] + $linea['CRED_DEU_COMISION'], 2, '.',','); ?></td>
		    <?php } ?>
			<?php if ($comif == 1){ ?>	
		<td align="right"><?php echo number_format($linea['CRED_DEU_IMPORTE'], 2, '.',',') ; ?></td>
		    <?php } ?>
		<td align="right"><?php echo number_format($linea['CRED_DEU_COMISION'], 2, '.',',') ; ?></td>
		<td align="right"><?php echo number_format($linea['CRED_DEU_AHO_INI'], 2, '.',','); ?></td>
		 <?php if ($comif == 2){ ?>	
		<td align="right"><?php echo number_format((($linea['CRED_DEU_IMPORTE'] + $linea['CRED_DEU_COMISION'])/$cuotas)+ $linea['CRED_DEU_AHO_DUR']+($linea['CRED_DEU_INT_CTA']/$cuotas), 2, '.',','); ?></td>
		    <?php } ?>
			<?php if ($comif == 1){ 
			 $cuota_t = (($linea['CRED_DEU_IMPORTE'] + $linea['CRED_DEU_AHO_DUR'])/$cuotas) + $linea['CRED_DEU_INT_CTA']; ?>	
		<td align="right"><?php echo number_format($cuota_t,2, '.',','); ?></td>
		
		    <?php } ?>
 <?php
  if ($comif == 2){ 
     $imp_car =($linea['CRED_DEU_IMPORTE'] + $linea['CRED_DEU_COMISION']);
	 }else{
	 $imp_car =$linea['CRED_DEU_IMPORTE'];
	 }
   $t_imp_cap = $t_imp_cap + $imp_car;
   $t_imp_com = $t_imp_com + $linea['CRED_DEU_COMISION'];
   $t_imp_aho = $t_imp_aho + $linea['CRED_DEU_AHO_INI'];
   $t_imp_cta = $t_imp_cta + $cuota_t;
}
?>
</tr>
<tr>
    <th align="center"><?php echo "Totales"; ?></th>
    <th align="right"><?php echo number_format($t_imp_cap, 2, '.',',') ; ?></th>
    <th align="right"><?php echo number_format($t_imp_com, 2, '.',',') ; ?></th>
    <th align="right"><?php echo number_format($t_imp_aho, 2, '.',',') ; ?></th>
	<th align="right"><?php echo number_format($t_imp_cta, 2, '.',',') ; ?></th>
</tr>





</table>
</center>
<strong>
<?php
 
?>
</strong>	
<center>
<input type="submit" name="accion" value="Impresion Orden Desem">
<input type="submit" name="accion" value="Salir">
</form>	
<br><br>
 <?php
}
    ob_end_flush();
 ?>