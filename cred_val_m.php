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
           Validar Montos
	</div>
<div id="AtrasBoton">
    <a href="solic_mante.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
</div>
<center>
<div id="GeneralManSolicaa">
<?php
if(isset($_SESSION['form_buffer'])){
   $_SESSION['form_buffer'] = $_POST;
}
if(isset($_SESSION['login'])){
   $log_usr = $_SESSION['login']; 
   }else{
 }
if(isset($_SESSION["impo_sol"])){
$imp_sol = $_SESSION["impo_sol"];
}else{
 }
if(isset( $_SESSION['nro_sol'])){
$cod_sol = $_SESSION['nro_sol'];
}else{
 }
$total = 0;
if(isset($_SESSION['login'])){
$impor_1 = $_POST["imp_1"];
}else{
$impor_1 = 0;
 }
if(isset($_SESSION["cli_1"])){
$clie_1 = $_SESSION["cli_1"];
}else{
$clie_1 = "";
 }
if(isset($_POST["imp_2"])){
$impor_2 = $_POST["imp_2"];
}else{
$impor_2 = 0;
 }
if(isset($_SESSION["cli_2"])){
$clie_2 = $_SESSION["cli_2"];
}else{
$clie_2 = "";
 }
if(isset($_POST["imp_3"])){
$impor_3 = $_POST["imp_3"];
}else{
$impor_3 = 0;
 }
if(isset($_SESSION["cli_3"])){
$clie_3 = $_SESSION["cli_3"];
}else{
$clie_3 = "";
 }
if(isset($_POST["imp_4"])){
$impor_4 = $_POST["imp_4"];
}else{
$impor_4 = 0;
 }
if(isset($_SESSION["cli_4"])){
$clie_4 = $_SESSION["cli_4"];
}else{
$clie_4 = "";
 }
if(isset( $_POST["imp_5"])){
$impor_5 = $_POST["imp_5"];
}else{
$impor_5 = 0;
 }
if(isset( $_SESSION["cli_5"])){
$clie_5 = $_SESSION["cli_5"];
}else{
$clie_5 = "";
 }
if(isset($_POST["imp_6"])){
$impor_6 = $_POST["imp_6"];
}else{
$impor_6 = 0;
 }
if(isset($_SESSION["cli_6"])){
$clie_6 = $_SESSION["cli_6"];
}else{
$clie_6 = "";
 }
if(isset($_POST["imp_7"])){
$impor_7 = $_POST["imp_7"];
}else{
$impor_7 = 0;
 }
if(isset( $_SESSION["cli_7"])){
$clie_7 = $_SESSION["cli_7"];
}else{
$clie_7 = "";
 }
if(isset($_POST["imp_8"])){
$impor_8 = $_POST["imp_8"];
}else{
$impor_8 = 0;
 }
if(isset($_SESSION["cli_8"])){
$clie_8 = $_SESSION["cli_8"];
}else{
$clie_8 = "";
 }
if(isset($_POST["imp_9"])){
$impor_9 = $_POST["imp_9"];
}else{
$impor_9 = 0;
 }
if(isset($_SESSION["cli_9"])){
$clie_9 = $_SESSION["cli_9"];
}else{
$clie_9 = "";
 }
if(isset($_POST["imp_10"])){
$impor_10 = $_POST["imp_10"];
}else{
$impor_10 = 0;
 }
if(isset($_SESSION["cli_10"])){
$clie_10 = $_SESSION["cli_10"];
}else{
$clie_10 = "";
 }
if(isset($_POST["imp_11"])){
$impor_11 = $_POST["imp_11"];
}else{
$impor_11 = 0;
 }
if(isset($_SESSION["cli_11"])){
$clie_11 = $_SESSION["cli_11"];
}else{
$clie_11 = "";
 }
if(isset($_POST["imp_12"])){
$impor_12 = $_POST["imp_12"];
}else{
$impor_12 = 0;
 }
if(isset($_SESSION["cli_12"])){
$clie_12 = $_SESSION["cli_12"];
}else{
$clie_12 = "";
 }
if(isset($_POST["imp_13"])){
$impor_13 = $_POST["imp_13"];
}else{
$impor_13 = 0;
 }
if(isset($_SESSION["cli_13"])){
$clie_13 = $_SESSION["cli_13"];
}else{
$clie_13 = "";
 }
if(isset( $_POST["imp_14"])){
$impor_14 = $_POST["imp_14"];
}else{
$impor_14 = 0;
 }
if(isset($_SESSION["cli_14"])){
$clie_14 = $_SESSION["cli_14"];
}else{
$clie_14 = "";
 }
if(isset($_POST["imp_15"])){
$impor_15 = $_POST["imp_15"];
}else{
$impor_15 = 0;
 }
if(isset( $_SESSION["cli_15"])){
$clie_15 = $_SESSION["cli_15"];
}else{
$clie_15 = "";
 }
if(isset($_POST["imp_16"])){
$impor_16 = $_POST["imp_16"];
}else{
$impor_16 = 0;
 }
if(isset($_SESSION["cli_16"])){
$clie_16 = $_SESSION["cli_16"];
}else{
$clie_16 = "";
 }
if(isset( $_POST["imp_17"])){
$impor_17 = $_POST["imp_17"];
}else{
$impor_17 = 0;
 }
if(isset($_SESSION["cli_17"])){
$clie_17 = $_SESSION["cli_17"];
}else{
$clie_17 = "";
 }
if(isset($_POST["imp_18"])){
$impor_18 = $_POST["imp_18"];
}else{
$impor_18 = 0;
 }
if(isset($_SESSION["cli_18"])){
$clie_18 = $_SESSION["cli_18"];
}else{
$clie_18 = "";
 }
if(isset($_POST["imp_19"])){
$impor_19 = $_POST["imp_19"];
}else{
$impor_19 = 0;
 }
if(isset($_SESSION["cli_19"])){
$clie_19 = $_SESSION["cli_19"];
}else{
$clie_19 = "";
 }
if(isset($_POST["imp_20"])){
$impor_20 = $_POST["imp_20"];
}else{
$impor_20 = 0;
 }
if(isset($_SESSION["cli_20"])){
$clie_20 = $_SESSION["cli_20"];
}else{
$clie_20 = "";
 }
 if(isset($_POST["imp_21"])){
$impor_21 = $_POST["imp_21"];
}else{
$impor_21 = 0;
 }
 if(isset($_SESSION["cli_21"])){
$clie_21 = $_SESSION["cli_21"];
}else{
$clie_21 = "";
 }
 if(isset($_POST["imp_22"])){
$impor_22 = $_POST["imp_22"];
}else{
$impor_22 = 0;
 }
 if(isset($_SESSION["cli_22"])){
$clie_22 = $_SESSION["cli_22"];
}else{
$clie_22 = "";
 }
 if(isset($_POST["imp_23"])){
$impor_23 = $_POST["imp_23"];
}else{
$impor_23 = 0;
 }
 if(isset($_SESSION["cli_23"])){
$clie_23 = $_SESSION["cli_23"];
}else{
$clie_23 = "";
 }
 if(isset($_POST["imp_24"])){
$impor_24 = $_POST["imp_24"];
}else{
$impor_24 = 0;
 }
 if(isset($_SESSION["cli_24"])){
$clie_24 = $_SESSION["cli_24"];
}else{
$clie_24 = "";
 }
 if(isset($_POST["imp_25"])){
$impor_25 = $_POST["imp_25"];
}else{
$impor_25 = 0;
 }
 if(isset($_SESSION["cli_25"])){
$clie_25 = $_SESSION["cli_25"];
}else{
$clie_25 = "";
 }
if(isset($_POST["com_e"])){
$comi_e = $_POST["com_e"];
}else{
//$comi_e = "";
 }
if(isset($_SESSION["com_f"])){
$comi_f = $_SESSION["com_f"];
}else{
//$comi_f = "";
 }
if(isset($_POST["aho_f"])){
$aho_f = $_POST["aho_f"];
}else{
//$aho_f = "";
 }
if(isset($_POST["aho_fi"])){
$aho_fi = $_POST["aho_fi"];
}else{
//$aho_fi = 0;
 }

if (empty($aho_fi)) {
   $aho_fi = 0;
   }
if (empty($aho_f)) {
   $aho_f = 0;
   }
if (empty($com_f)) {
   $com_f = 0;
   } 

$total  = round($impor_1+$impor_2+$impor_3+$impor_4 +$impor_5+$impor_6+$impor_7+$impor_8+$impor_9+$impor_10+
          $impor_11+$impor_12+$impor_13+$impor_14+$impor_15+$impor_16+$impor_17+$impor_18+
		  $impor_19+$impor_20+$impor_21+$impor_22+$impor_23+$impor_24+$impor_25,2);

$_SESSION["total_s"] = $total;
$_SESSION["tot_err"] = 0;
//Seleccion solicitud
$con_sol  = "Select * From cred_solicitud where CRED_SOL_CODIGO = $cod_sol and CRED_SOL_USR_BAJA is null"; 
$res_sol = mysql_query($con_sol)or die('No pudo seleccionarse solicitud 2');
   while ($lin_sol = mysql_fetch_array($res_sol)) {
         $t_op = $lin_sol['CRED_SOL_TIPO_OPER']; 
		 $impo = $lin_sol['CRED_SOL_IMPORTE'];
		 $mon  = $lin_sol['CRED_SOL_COD_MON'];
		 $comi  = $lin_sol['CRED_SOL_TIP_COM'];
		 $comif = $lin_sol['CRED_SOL_COM_F'];
		 $ahod  = $lin_sol['CRED_SOL_AHO_DUR'];
		 $ahoi  = $lin_sol['CRED_SOL_AHO_INI'];
		 $fpag = $lin_sol['CRED_SOL_FORM_PAG'];
		 $_SESSION["fpag"] = $fpag;
   }
   $con_mon = "Select GRAL_PAR_INT_DESC  From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and                     GRAL_PAR_INT_COD = $mon ";
         $res_mon = mysql_query($con_mon)or die('No pudo seleccionarse tabla')  ;
		  while ($lin_mon = mysql_fetch_array($res_mon)) {
		        $mon_d = $lin_mon['GRAL_PAR_INT_DESC'];
		  }
    $con_comf  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 913 and GRAL_PAR_PRO_COD = $comi ";
    $res_comf = mysql_query($con_comf)or die('No pudo seleccionarse tabla')  ;
	while ($lin_comf = mysql_fetch_array($res_comf)) {
	      $com_d = $lin_comf['GRAL_PAR_PRO_DESC'];
	      $comi_f  = $lin_comf['GRAL_PAR_PRO_CTA1'];
	}
$con_comf = "Select GRAL_PAR_PRO_DESC,GRAL_PAR_PRO_CTA1 From gral_param_propios where GRAL_PAR_PRO_GRP = 911                    and GRAL_PAR_PRO_COD = $comif ";
         $res_comf = mysql_query($con_comf)or die('No pudo seleccionarse tabla comif')  ;
		  while ($lin_comf = mysql_fetch_array($res_comf)) {
		        $comf_d = $lin_comf['GRAL_PAR_PRO_DESC'];
				}	
 	$clie_mon = array ( "cod_clie"  => array ( 1 => $clie_1,
                                               2 => $clie_2,
											   3 => $clie_3,
											   4 => $clie_4,
											   5 => $clie_5,
											   6 => $clie_6,
											   7 => $clie_7,
											   8 => $clie_8,
											   9 => $clie_9,
											  10 => $clie_10,
											  11 => $clie_11,
											  12 => $clie_12,
											  13 => $clie_13,
											  14 => $clie_14,
											  15 => $clie_15,
											  16 => $clie_16,
											  17 => $clie_17,
											  18 => $clie_18, 
											  19 => $clie_19,
											  20 => $clie_20,
											  21 => $clie_21,
											  22 => $clie_22,
											  23 => $clie_23,
											  24 => $clie_24,
											  25 => $clie_25						                              
                                     ),
                          "imp_sol" => array ( 1 => $impor_1,
				                               2 => $impor_2,
											   3 => $impor_3,
											   4 => $impor_4,
											   5 => $impor_5,
											   6 => $impor_6,
											   7 => $impor_7,
											   8 => $impor_8,
											   9 => $impor_9,
											  10 => $impor_10,
											  11 => $impor_11, 
											  12 => $impor_12,
											  13 => $impor_13,
											  14 => $impor_14,
											  15 => $impor_15,
											  16 => $impor_16, 
											  17 => $impor_17, 
											  18 => $impor_18,
											  19 => $impor_19,
											  20 => $impor_20, 
											  21 => $impor_21,
											  22 => $impor_22,
											  23 => $impor_23,
											  24 => $impor_24,
											  25 => $impor_25        
                                              )
                                  );
// Si total no iguala con monto solicitado da error
if ($total <> $imp_sol ) {
    $_SESSION["tot_err"] = 1;
	$_SESSION["validar"] = 2;
    header('Location: cred_montos_a.php');
    }//else{
 for ($i=1; $i < 26; $i = $i + 1 ) {
     $c_cli = $clie_mon['cod_clie'][$i];
	 $i_sol = $clie_mon['imp_sol'][$i];
 //    echo $c_cli, "cod_cli", $i_sol, "imp_sol";
// Si comision es factor
// 	Si comision es efectivo
// Si comision es cero
	$i_com = $i_sol * $comi_f;	
	if ($comif == 2){
	    $imp_sc = $i_sol + $i_comi;
		}else{
		$imp_sc = $i_sol;
		}	
//  ahorro durante 
//	if ($ahod == 1){
if ($ahod > 0) {
	   $i_aho = ($i_sol * $ahod)/100;
	   }else {
	   $i_aho = 0;
	  }
// Ahorro inicio
   if (isset($ahoi)) {
	 $i_aho_i = ($i_sol * $ahoi)/100;
	}
   if (isset($c_cli) and $i_sol > 0) {
  //    echo $cod_sol, " cod_sol", $c_cli, " c_cli";
	  $act_cred_deudor = "update cred_deudor set CRED_DEU_IMPORTE = $i_sol, CRED_DEU_COMISION = $i_com,                          CRED_DEU_AHO_INI = $i_aho_i, CRED_DEU_AHO_DUR = $i_aho where 
	                     CRED_SOL_CODIGO = $cod_sol and CRED_DEU_INTERNO = $c_cli
						 and CRED_DEU_USR_BAJA is null";
      $res_act = mysql_query($act_cred_deudor) or die('No pudo actualizar cred_deudor : ' . mysql_error());
	 ?>
	 <br>
	 <?php
	 }
    }
   //}
 //  echo $total, $imp_sol;
   if($total == $imp_sol ) {
      //Actualiza datos en cred_solicitud
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
			  if ($comif == 2){
		      $imp_sc =$imp_sc + $lin_sum['CRED_DEU_IMPORTE'] + $lin_sum['CRED_DEU_COMISION']; 
			  }
			  if ($comif == 1){
		      $imp_sc =$imp_sc + $lin_sum['CRED_DEU_IMPORTE']; 
			  }
			  $imp_ad = $imp_ad + $lin_sum['CRED_DEU_AHO_DUR'];
			  $imp_ai = $imp_ai + $lin_sum['CRED_DEU_AHO_INI'];
		   
		}
		$act_cred_solic  = "update cred_solicitud set CRED_SOL_IMP_COM=$imp_c, CRED_SOL_ESTADO=4 where CRED_SOL_CODIGO = $cod_sol and CRED_SOL_USR_BAJA is null";
$res_act_s = mysql_query($act_cred_solic) or die('No pudo actualizar cred_solicitud : ' . mysql_error());
	}
	 ?>
	 <form name="form1" method="post" action="solic_retro_sol.php" style="border:groove" target="_self"  > 
<table align="center" border="1">
	<tr>
	    <td> <strong> Solicitud </strong></td>
        <td> <?php  echo $cod_sol, "  "; ?></td>
        <td><strong> Importe Solicitado </strong></td>
        <td align="right"><?php $_SESSION["impo_sol"] = $impo;
	        $impo = number_format($impo, 2, '.',','); 
            echo $impo;?> </td>
		<td><strong> Moneda </strong></td>
        <td><?php $_SESSION["mon_d"] = $mon_d;
            echo $mon_d; ?></td>
  </tr>
  <tr>
	    <td><strong> Comision </strong></td>
        <td align="right"><?php echo $com_d;?></td>
        <td><strong> Calculo Comision </strong></td>
        <td><?php echo $comf_d; ?></td>
		<td><?php echo encadenar(5); ?></td>
		<td><?php echo encadenar(5); ?></td>
</tr>
<tr>		
    <td><strong> Fondo Garantia Ciclo </strong></td>
    <td><?php $_SESSION["aho_d"] =  $ahod; 
              echo $ahod. " %";?></td>
    <td><strong> Fondo Garantia Inicio </strong></td>
    <td align="right"><?php $_SESSION["aho_i"] = $ahoi;  
        echo $ahoi. "%"; ?></td>
	<td><?php echo encadenar(5); ?></td>
	<td><?php echo encadenar(5); ?></td>
</tr>
</table>
 </FONT> 
<?php
$_SESSION["continuar"] = 1;	
$consulta  = "Select CRED_DEU_INTERNO, CLIENTE_COD_ID,CLIENTE_AP_PATERNO, CLIENTE_AP_MATERNO, CLIENTE_NOMBRES, CRED_DEU_RELACION,CRED_DEU_IMPORTE, CRED_DEU_COMISION, CRED_DEU_AHO_INI, CRED_DEU_AHO_DUR From cliente_general, cred_deudor where CRED_SOL_CODIGO = $cod_sol and CRED_DEU_INTERNO = CLIENTE_COD and CRED_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null";
    $resultado = mysql_query($consulta);
 ?>		
		<table border="1">
	<tr>
	    <th>Codigo Cliente</th>
		<th>Cliente</th>
		<th>Monto Solicitado</th>
		<th>Comisión</th>
		<th>Monto Cartera</th>
		<th>FonGar. Inicio</th>
		<th>FonGar. Ciclo</th>
	</tr>
<?php
while ($linea = mysql_fetch_array($resultado)) {
     $cliente = $linea['CLIENTE_AP_PATERNO'].encadenar(2). $linea['CLIENTE_AP_MATERNO'].encadenar(2).$linea['CLIENTE_NOMBRES'];
	 ?>
	 <tr>
	 	<td><?php echo $linea['CRED_DEU_INTERNO']; ?></td>
		<td><?php echo $cliente; ?></td>
		<td align="right"><?php echo number_format($linea['CRED_DEU_IMPORTE'], 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($linea['CRED_DEU_COMISION'], 2, '.',',') ; ?></td>
	    <?php if ($comif == 2){ ?>
		<td align="right" ><?php echo number_format($linea['CRED_DEU_IMPORTE'] + $linea['CRED_DEU_COMISION'], 2, '.',','); ?></td>
		<?php }?>
		<?php if ($comif == 1){ ?>
		<td align="right" ><?php echo number_format($linea['CRED_DEU_IMPORTE'], 2, '.',','); ?></td>
		<?php }?>
		<td align="right"><?php echo $linea['CRED_DEU_AHO_INI']; ?></td>
		<td align="right"><?php echo $linea['CRED_DEU_AHO_DUR']; ?></td>	
	</tr>		
	 <?php
}
?>
  <tr> 
       <th><?php echo encadenar(5); ?></th>
       <th><?php echo encadenar(35)."Totales".encadenar(32); ?></th>
       <th align="right"><?php echo number_format($imp_s, 2, '.',','); ?></th>
	   <th align="right"><?php echo number_format($imp_c, 2, '.',','); ?></th>
	   <th align="right" ><?php echo number_format($imp_sc, 2, '.',','); ?></th>
	   <th align="right"><?php echo number_format($imp_ai, 2, '.',','); ?></th>
	   <th align="right"><?php echo number_format($imp_ad, 2, '.',','); ?></th>
 </tr>
</table>
</center>
<strong>
<font size="+0">
<?php

?>
</font>
</strong>	
<center>	
<input type="submit" name="accion" value="Plan de Pagos">
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