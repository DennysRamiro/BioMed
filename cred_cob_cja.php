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
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
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
 <form name="form2" method="post" action="cred_grab_cob.php" onSubmit="return 
	 ValidarCamposUsuario(this)">
	<strong>Fecha Pago </strong>
         <input type="text" name="fec_nac" maxlength="10"  size="10" > <script language="JavaScript">
            new tcal ({
                // form name
                'formname': 'form2',
                // input name
                'controlname': 'fec_nac'
            });
            </script> 
<?php
if(isset($_SESSION['form_buffer'])){
   $_SESSION['form_buffer'] = $_POST;
}
if(isset($_SESSION['login'])){
   $log_usr = $_SESSION['login']; 
   }else{
 }
if(isset($_SESSION['ncre'])){
$ncre = $_SESSION['ncre'];
}else{
 }
if(isset( $_SESSION['nom_grp'])){
$nom_grp = $_SESSION['nom_grp'];
}else{
 }
if(isset( $_SESSION['nom_cli'])){
$nom_cli = $_SESSION['nom_cli'];
}else{
 } 
if(isset( $_SESSION['des_mon'])){
$des_mon = $_SESSION['des_mon'];
}else{
 } 
$total = 0;
if(isset($_POST['impo_1'])){
$importe_1 = $_POST["impo_1"];
}else{
$importe_1 = 0;
 }
if(isset($_POST['impo_2'])){
$importe_2 = $_POST["impo_2"];
}else{
$importe_2 = 0;
 }
if ( $importe_1 + $importe_2 == 0){
 echo "Debe ingresar el monto total Cobrado";
 ?>
</font>
</strong>	
<center>	

<input type="submit" name="accion" value="Salir">
</form>
   <?php
 
}
if ( $importe_1 + $importe_2 > 0){


		   
if(isset($_POST['imp_1'])){
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
/*if(isset($_POST["com_e"])){
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
*/
$total  = $impor_1+$impor_2+$impor_3+$impor_4 +$impor_5+$impor_6+$impor_7+$impor_8+$impor_9+$impor_10+$impor_11+
          $impor_12+$impor_13+$impor_14+$impor_15+$impor_16+$impor_17+$impor_18+$impor_19+$impor_20;
		  
		  
		  
		  

$_SESSION["total_s"] = $total;
$_SESSION["tot_err"] = 0;
//Calculo en moneda origen
/*	*/

	
	
	
				
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
											  20 => $clie_20						                              
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
											  20 => $impor_20         
                                              )
									  
                                  );
$imp_equiv = 0;
 $tot_orig = 0;							  
if ($_SESSION['des_mon'] == "BOLIVIANOS"){
    if ($importe_2 > 0){
	    $imp_equiv = round($importe_2 * $_SESSION['TC_COMPRA'],2);
	    $tot_orig = $importe_1 + $imp_equiv;
	}else{
	$tot_orig = $importe_1;
	
	}

}
if ($_SESSION['des_mon'] == "DOLARES"){
    if ($importe_2 > 0){
	    $imp_equiv = round($importe_2 / $_SESSION['TC_VENTA'],2);
	    $tot_orig = $importe_1 + $imp_equiv;
	}else{
	$tot_orig = $importe_1;
	
	}

}								  
// Si total no iguala con monto solicitado da error
if (($tot_orig) <> $total ) {
    $_SESSION['calculo'] = 2;
		   $_SESSION['detalle'] = 5;
		   $_SESSION['continuar'] = 2;
    header('Location: cobro_detalle_2.php');
    }//else{
	
//echo $_SESSION['ncre'].encadenar(2).$_SESSION['nom_grp'].encadenar(2)."Monto Total".$total;
$tot_bs = 0;	
$tot_su = 0;	
$impo = 0;
?>
 <form name="form1" method="post" action="cred_cob_cja1.php" style="border:groove" target="_self"  > 
<table align="center" border="1">
	<tr>
	    <td> <strong> Operacion </strong></td>
        <td> <?php  echo $ncre, "  "; ?></td>
        
		
  </tr>
  <tr>
	    <td><strong> Coordinador </strong></td>
        <td align="left"><?php echo $nom_cli;?></td>
		<td><strong> Grupo </strong></td>
        <td> <?php  echo $nom_grp, "  "; ?></td>
       
	</tr>
     <tr>
	    <td><strong> Moneda </strong></td>
        <td align="left"><?php echo $_SESSION['des_mon'];?></td>
       
	</tr>	
	</table>
	<table align="center" border="1">
	<tr>
	<?php	if ($_SESSION['des_mon'] == "BOLIVIANOS"){?>
	    <td><strong> Bolivianos </strong></td>
	<?php } ?>	
	<?php	if ($_SESSION['des_mon'] == "DOLARES"){?>
	    <td><strong> Dolares </strong></td>
	<?php } ?>	
        <td align="right"><?php 
	        $impo = number_format($importe_1, 2, '.',','); 
            echo $impo;?> </td>	
	<?php	if ($_SESSION['des_mon'] == "BOLIVIANOS"){?>		
		 <td><strong> Dolares </strong></td>
	<?php } ?>	
	<?php	if ($_SESSION['des_mon'] == "DOLARES"){?>		
		 <td><strong> Bolivianos </strong></td>
	<?php } ?>		 
		 
        <td align="right"><?php 
	        $impo = number_format($importe_2, 2, '.',','); 
            echo $impo;?> </td>		
	
		 <td><strong> Total Mon. Original </strong></td>	
         <td align="right"><?php 
	        $impo = number_format($tot_orig, 2, '.',','); 
            echo $impo;?> </td>	
		</tr>	
</table>
 </FONT> 
 	<table border="1">
	<tr>
	    <th>Codigo Cliente</th>
		<th>Cliente</th>
		<th>Importe Desembolsado</th>
		<th>Importe Cobrado</th>
		
		
		
	</tr>
 <?php	
 for ($i=1; $i < 21; $i = $i + 1 ) {
     $t_orig = 0;
     $c_cli = $clie_mon['cod_clie'][$i];
	 $i_sol = $clie_mon['imp_sol'][$i];
	 $i_sol_1 = 0;
	  $t_orig = $i_sol;
	  $tot_bs = $tot_bs + $i_sol;
	 // $tot_su = $tot_su + $i_sol_1;
  //   echo $c_cli, "cod_cli", $i_sol, "imp_sol";
// Si comision es factor
// 	Si comision es efectivo
// Si comision es cero
	if ($_SESSION['des_mon'] == "BOLIVIANOS"){
	    if ($i_sol_1 > 0){
		    $t_orig = $t_orig + ($i_sol_1 * $_SESSION['TC_VENTA']);
		    }
	
		}
	if ($_SESSION['des_mon'] == "DOLARES"){
	    if ($i_sol_1 > 0){
		    $t_orig = $t_orig + ($i_sol_1 / $_SESSION['TC_COMPRA']);
		    }
	
		}		
//  ahorro durante 
//	if ($ahod == 1){
//if ($ahod > 0) {
//	   $i_aho = ($i_sol * $ahod)/100;
//	   }else {
//	   $i_aho = 0;
//	  }
// Ahorro inicio
 /*  if (isset($ahoi)) {
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
	 }*/
 //   } 
   //}
 //  echo $total, $imp_sol;
  /* if($total == $imp_sol ) {
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
	} */
	 ?>
	
<?php
$_SESSION["continuar"] = 1;	
if ($c_cli > 0){
$consulta  = "Select CART_DEU_INTERNO, CLIENTE_COD_ID,CLIENTE_AP_PATERNO, CLIENTE_AP_MATERNO, CLIENTE_NOMBRES,
              CART_DEU_RELACION,CART_DEU_IMPORTE, CART_DEU_COMI, CART_DEU_AHO_INI, CART_DEU_AHO_DUR
			  From cliente_general, cart_deudor where CART_DEU_NCRED = $ncre and 
			                                          CART_DEU_INTERNO =  $c_cli and
			 CART_DEU_INTERNO = CLIENTE_COD and CART_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null";
   $resultado = mysql_query($consulta)or die('No pudo seleccionarse cliente_general, cart_deudor');
 ?>		
	
<?php
while ($linea = mysql_fetch_array($resultado)) {
     $cliente = $linea['CLIENTE_AP_PATERNO'].encadenar(2). $linea['CLIENTE_AP_MATERNO'].encadenar(2).$linea['CLIENTE_NOMBRES'];
	 ?>
	 <tr>
	 	<td><?php echo $linea['CART_DEU_INTERNO']; ?></td>
		<td><?php echo $cliente; ?></td>
		<td align="right"><?php echo number_format($linea['CART_DEU_IMPORTE'], 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($i_sol, 2, '.',',') ; ?></td>
	    
	</tr>		
	 <?php
}
}
}
?>
  <tr> 
       <th><?php echo encadenar(5); ?></th>
       <th><?php echo encadenar(35)."Totales".encadenar(32); ?></th>
       <th align="right"><?php echo number_format(0, 2, '.',','); ?></th>
	   <th align="right"><?php echo number_format($tot_bs, 2, '.',','); ?></th>
	   
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
<input type="submit" name="accion" value="Envio a Caja">
<input type="submit" name="accion" value="Salir">
</form>
<div id="FooterTable">
<BR><B><FONT SIZE=+2><MARQUEE>Revise los montos antes de Continuar</MARQUEE></FONT></B>
</div>
   <?php
   }
		 	include("footer_in.php");
	 ?> 
<?php
}
ob_end_flush();
 ?>