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
    <a href="solic_simulador.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
</div>
<center>
<div id="GeneralManSolicaa">
<?php
if(isset($_SESSION['form_buffer'])){
   $_SESSION['form_buffer'] = $_POST;
}
$error_d = 0;
if(isset($_SESSION['login'])){
   $log_usr = $_SESSION['login']; 
   }else{
 }
 $log_usr = $_SESSION['login'];

$cod_fpa = $_SESSION['cod_fpa'];
$cod_cin = $_SESSION['cod_cin'];
//echo $cod_sol;
$log_usr =$_SESSION['login'];
//echo $log_usr;
$imp_s = $_SESSION['imp_sol'] ;
$aho_d = $_SESSION['aho_dur'];
$tas_i = $_SESSION['tas_int'];
$plz_m = $_SESSION['plz_mes'];
$fec_d = $_SESSION['fec_des'];
$fec_1 = $_SESSION['fec_uno'];
$nro_c = $_SESSION['nro_cta'];
 //$tint_m = $tas_i / $mes;                                                  
  $tint =  $tas_i/12 ;   
  
if(isset($_SESSION["impo_sol"])){
$imp_sol = $_SESSION["impo_sol"];
}else{
 }
if(isset( $_SESSION['nro_sol'])){
$cod_sol = $_SESSION['nro_sol'];
}else{
 }
$total = 0;
//echo $_POST["fec_1"]."---";

//echo $fec_1;
if(isset($_POST["fec_1"])){
$fec_1 = $_POST["fec_1"];
$fec_pag[1] = $fec_1;
//echo $fec_1;
$pag_cap[1] = $_POST["imp_1"];
$pag_aho[1] = $_POST["aho_1"];
$pag_int[1] = 0;
}else{
$fec_pag[1] = 0;
$pag_cap[1] = 0;
$pag_aho[1] = 0;
$pag_int[1] = 0;
 }

if(isset($_POST["fec_2"])){
$fec_pag[2] = $_POST["fec_2"];
$pag_cap[2] = $_POST["imp_2"];
$pag_aho[2] = $_POST["aho_2"];
$pag_int[2] = 0;
}else{
$fec_pag[2] = 0;
$pag_cap[2] = 0;
$pag_aho[2] = 0;
$pag_int[2] = 0;
 }

if(isset($_POST["fec_3"])){
$fec_pag[3] = $_POST["fec_3"];
$pag_cap[3] = $_POST["imp_3"];
$pag_aho[3] = $_POST["aho_3"];
$pag_int[3] = 0;
}else{
$fec_pag[3] = 0;
$pag_cap[3] = 0;
$pag_aho[3] = 0;
$pag_int[3] = 0;
 }

if(isset($_POST["fec_4"])){
$fec_pag[4] = $_POST["fec_4"];
$pag_cap[4] = $_POST["imp_4"];
$pag_aho[4] = $_POST["aho_4"];
$pag_int[4] = 0;
}else{
$fec_pag[4] = 0;
$pag_cap[4] = 0;
$pag_aho[4] = 0;
$pag_int[4] = 0;
}
if(isset( $_POST["fec_5"])){
$fec_pag[5] = $_POST["fec_5"];
$pag_cap[5] = $_POST["imp_5"];
$pag_aho[5] = $_POST["aho_5"];
$pag_int[5] = 0;
}else{
$fec_pag[5] = 0;
$pag_cap[5] = 0;
$pag_aho[5] = 0;
$pag_int[5] = 0;
 }

if(isset($_POST["fec_6"])){
$fec_pag[6] = $_POST["fec_6"];
$pag_cap[6] = $_POST["imp_6"];
$pag_aho[6] = $_POST["aho_6"];
$pag_int[6] = 0;
}else{
$fec_pag[6] = 0;
$pag_cap[6] = 0;
$pag_aho[6] = 0;
$pag_int[6] = 0;
 }

if(isset($_POST["fec_7"])){
$fec_pag[7] = $_POST["fec_7"];
$pag_cap[7] = $_POST["imp_7"];
$pag_aho[7] = $_POST["aho_7"];
$pag_int[7] = 0;
}else{
$fec_pag[7] = 0;
$pag_cap[7] = 0;
$pag_aho[7] = 0;
$pag_int[7] = 0;
 }

if(isset($_POST["fec_8"])){
$fec_pag[8] = $_POST["fec_8"];
$pag_cap[8] = $_POST["imp_8"];
$pag_aho[8] = $_POST["aho_8"];
$pag_int[8] = 0;
}else{
$fec_pag[8] = 0;
$pag_cap[8] = 0;
$pag_aho[8] = 0;
$pag_int[8] = 0;
 }

if(isset($_POST["fec_9"])){
$fec_pag[9] = $_POST["fec_9"];
$pag_cap[9] = $_POST["imp_9"];
$pag_aho[9] = $_POST["aho_9"];
$pag_int[9] = 0;
}else{
$fec_pag[9] = 0;
$pag_cap[9] = 0;
$pag_aho[9] = 0;
$pag_int[9] = 0;
 }

if(isset($_POST["fec_10"])){
$fec_pag[10] = $_POST["fec_10"];
$pag_cap[10] = $_POST["imp_10"];
$pag_aho[10] = $_POST["aho_10"];
$pag_int[10] = 0;
}else{
$fec_pag[10] = 0;
$pag_cap[10] = 0;
$pag_aho[10] = 0;
$pag_int[10] = 0;
 }

if(isset($_POST["fec_11"])){
$fec_pag[11] = $_POST["fec_11"];
$pag_cap[11] = $_POST["imp_11"];
$pag_aho[11] = $_POST["aho_11"];
$pag_int[11] = 0;
}else{
$fec_pag[11] = 0;
$pag_cap[11] = 0;
$pag_aho[11] = 0;
$pag_int[11] = 0;
 }

if(isset($_POST["fec_12"])){
$fec_pag[12] = $_POST["fec_12"];
$pag_cap[12] = $_POST["imp_12"];
$pag_aho[12] = $_POST["aho_12"];
$pag_int[12] = 0;
}else{
$fec_pag[12] = 0;
$pag_cap[12] = 0;
$pag_aho[12] = 0;
$pag_int[12] = 0;
 }

if(isset($_POST["fec_13"])){
$fec_pag[13] = $_POST["fec_13"];
$pag_cap[13] = $_POST["imp_13"];
$pag_aho[13] = $_POST["aho_13"];
$pag_int[13] = 0;
}else{
$fec_pag[13] = 0;
$pag_cap[13] = 0;
$pag_aho[13] = 0;
$pag_int[13] = 0;
 }

if(isset( $_POST["fec_14"])){
$fec_pag[14] = $_POST["fec_14"];
$pag_cap[14] = $_POST["imp_14"];
$pag_aho[14] = $_POST["aho_14"];
$pag_int[14] = 0;
}else{
$fec_pag[14] = 0;
$pag_cap[14] = 0;
$pag_aho[14] = 0;
$pag_int[14] = 0;
 }

if(isset($_POST["fec_15"])){
$fec_pag[15] = $_POST["fec_15"];
$pag_cap[15] = $_POST["imp_15"];
$pag_aho[15] = $_POST["aho_15"];
$pag_int[15] = 0;
}else{
$fec_pag[15] = 0;
$pag_cap[15] = 0;
$pag_aho[15] = 0;
$pag_int[15] = 0;
 }

if(isset($_POST["fec_16"])){
$fec_pag[16] = $_POST["fec_16"];
$pag_cap[16] = $_POST["imp_16"];
$pag_aho[16] = $_POST["aho_16"];
$pag_int[16] = 0;
}else{
$fec_pag[16] = 0;
$pag_cap[16] = 0;
$pag_aho[16] = 0;
$pag_int[16] = 0;
 }

if(isset( $_POST["fec_17"])){
$fec_pag[17] = $_POST["fec_17"];
$pag_cap[17] = $_POST["imp_17"];
$pag_aho[17] = $_POST["aho_17"];
$pag_int[17] = 0;
}else{
$fec_pag[17] = 0;
$pag_cap[17] = 0;
$pag_aho[17] = 0;
$pag_int[17] = 0;
 }

if(isset($_POST["fec_18"])){
$fec_pag[18] = $_POST["fec_18"];
$pag_cap[18] = $_POST["imp_18"];
$pag_aho[18] = $_POST["aho_18"];
$pag_int[18] = 0;
}else{
$fec_pag[18] = 0;
$pag_cap[18] = 0;
$pag_aho[18] = 0;
$pag_int[18] = 0;
 }

if(isset($_POST["fec_19"])){
$fec_pag[19] = $_POST["fec_19"];
$pag_cap[19] = $_POST["imp_19"];
$pag_aho[19] = $_POST["aho_19"];
$pag_int[19] = 0;
}else{
$fec_pag[19] = 0;
$pag_cap[19] = 0;
$pag_aho[19] = 0;
$pag_int[19] = 0;
 }

if(isset($_POST["fec_20"])){
$fec_pag[20] = $_POST["fec_20"];
$pag_cap[20] = $_POST["imp_20"];
$pag_aho[20] = $_POST["aho_20"];
$pag_int[20] = 0;
}else{
$fec_pag[20] = 0;
$pag_cap[20] = 0;
$pag_aho[20] = 0;
$pag_int[20] = 0;
 }
if(isset($_POST["fec_21"])){
$fec_pag[21] = $_POST["fec_21"];
$pag_cap[21] = $_POST["imp_21"];
$pag_aho[21] = $_POST["aho_21"];
$pag_int[21] = 0;
}else{
$fec_pag[21] = 0;
$pag_cap[21] = 0;
$pag_aho[21] = 0;
$pag_int[21] = 0;
 }
if(isset($_POST["fec_22"])){
$fec_pag[22] = $_POST["fec_22"];
$pag_cap[22] = $_POST["imp_22"];
$pag_aho[22] = $_POST["aho_22"];
$pag_int[22] = 0;
}else{
$fec_pag[22] = 0;
$pag_cap[22] = 0;
$pag_aho[22] = 0;
$pag_int[22] = 0;
 }
if(isset($_POST["fec_23"])){
$fec_pag[23] = $_POST["fec_23"];
$pag_cap[23] = $_POST["imp_23"];
$pag_aho[23] = $_POST["aho_23"];
$pag_int[23] = 0;
}else{
$fec_pag[23] = 0;
$pag_cap[23] = 0;
$pag_aho[23] = 0;
$pag_int[23] = 0;
 }
if(isset($_POST["fec_24"])){
$fec_pag[24] = $_POST["fec_24"];
$pag_cap[24] = $_POST["imp_24"];
$pag_aho[24] = $_POST["aho_24"];
$pag_int[24] = 0;
}else{
$fec_pag[24] = 0;
$pag_cap[24] = 0;
$pag_aho[24] = 0;
$pag_int[24] = 0;
 }
if(isset($_POST["fec_25"])){
$fec_pag[25] = $_POST["fec_25"];
$pag_cap[25] = $_POST["imp_25"];
$pag_aho[25] = $_POST["aho_25"];
$pag_int[25] = 0;
}else{
$fec_pag[25] = 0;
$pag_cap[25] = 0;
$pag_aho[25] = 0;
$pag_int[25] = 0;
 }



?>
<form name="form2" method="post" action="solic_simulador.php" onSubmit="return">
<table align="center" border="1">
 <tr>   
             <th ><?php echo "Monto Solicitado";?></td>
			 <td align="right"><?php echo number_format($imp_s, 2, '.',',');?></td>
			 <th><?php echo "Tasa Int. Anual";?></td>
			 <td align="right"><?php echo number_format($tint*12, 2, '.',',');?></td>
			  <th><?php echo "Tasa Int. Mensual";?></td>
			 <td align="right"><?php echo number_format($tint, 2, '.',',');?></td>
			 
		</tr>
		 <tr>   
             <th ><?php echo "Plazo Meses";?></td>
			 <td align="right"><?php echo number_format($plz_m, 2, '.',',');?></td>
			 <th><?php echo "Nro. Cuotas";?></td>
			 <td align="right"><?php echo number_format($nro_c, 2, '.',',');?></td>
			  <th><?php echo "% Ahorro";?></td>
			 <td align="right"><?php echo number_format($aho_d, 2, '.',',');?></td>
			 
		</tr>
		 <tr>   
             <th ><?php echo "Forma de Pago";?></td>
			 <td align="right"><?php echo "VARIABLE";?></td>
			 <th><?php echo "Cal. Interes";?></td>
			 <td align="right"><?php echo "VARIABLE";?></td>
			  <th><?php echo encadenar(2);?></td>
			 <td align="right"><?php echo encadenar(2);?></td>
			 
		</tr>
		
		 <tr>   
             <th ><?php echo "Fec. Desembolso";?></td>
			 <td align="right"><?php echo $fec_d;?></td>
			 <th><?php echo "Fec. Primer Pago";?></td>
			 <td align="right"><?php echo $fec_1;?></td>
			  <th><?php echo "Fec. Ultimo Pago";?></td>
			 <td align="right"><?php echo "";?></td>
			 
		</tr>
</table>


<table align="center" border="1">
 <tr>   
             <th align="center"><?php echo "Nro. Cuota";?></td>
			 <th><?php echo "Fec.Pago";?></td>
			 <th><?php echo "Capital";?></td>
			 <th><?php echo "Interes";?></td>
	 	   <th><?php echo "Ahorro";?></td>
		    <th><?php echo "Total Cta.";?></td>
			 <th><?php echo "Saldo Capital";?></td>   
			   
		</tr>
<?php
$tot_cap = 0;
for ($i=1; $i < $nro_c + 1; $i = $i + 1 ) {
     $tot_cap = round($tot_cap+$pag_cap[$i],2);
	 }
if ($tot_cap <> $imp_s){	 
    $error_d = 1;
    $_SESSION['msg_err'] = $_SESSION['msg_err']."--"."Error en Total Capital **".$tot_cap."<>". $imp_s." +++";
	}	
if ($error_d == 1) {
    $error_d = 0;
    header('Location: sol_csimula_v.php');
	}	 
$tot_cap = 0;
$tot_int = 0;
$tot_aho = 0;
for ($i=1; $i < $nro_c + 1; $i = $i + 1 ) {
     $tot_cap = $tot_cap+$pag_cap[$i];
    
     $tot_aho = $tot_aho+ $pag_aho[$i];

if ($i == 1){
        $ano1 = substr($fec_d, 6,4); 
        $mes1 = substr($fec_d, 3, 2); 
        $dia1 = substr($fec_d, 0, 2);
        $ano2 = substr($fec_1, 6,4); 
        $mes2 = substr($fec_1, 3, 2); 
        $dia2 = substr($fec_1, 0, 2);
       $timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1); 
        $timestamp2 = mktime(0,0,0,$mes2,$dia2,$ano2); 
        $segundos_diferencia = $timestamp2 - $timestamp1; 
	 $dias = $segundos_diferencia / (60 * 60 * 24);
	 $dias = round($dias,0); 
	// echo $dias;
	 $pag_int[1] = ($imp_s * $dias *  $tas_i)/36000;
    $saldo = $imp_s - $pag_cap[$i];
	}else{
	 $ano1 = substr($fec_pag[$i-1], 6,4); 
        $mes1 = substr($fec_pag[$i-1], 3, 2); 
        $dia1 = substr($fec_pag[$i-1], 0, 2);
        $ano2 = substr($fec_pag[$i], 6,4); 
        $mes2 = substr($fec_pag[$i], 3, 2); 
        $dia2 = substr($fec_pag[$i], 0, 2);
       $timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1); 
        $timestamp2 = mktime(0,0,0,$mes2,$dia2,$ano2); 
        $segundos_diferencia = $timestamp2 - $timestamp1; 
	 $dias = $segundos_diferencia / (60 * 60 * 24);
	 $dias = round($dias,0); 
	// echo $dias;
	 $pag_int[$i] = ($saldo * $dias *  $tas_i)/36000;
	$saldo = $saldo - $pag_cap[$i];
	}
	 $tot_int = $tot_int +$pag_int[$i];
?>
<tr> 
	 <?php // if ($i == 1) { ?>
	    <td align="center"><strong><?php echo $i;?></strong></td>
        <?php if (valida_fecha($fec_pag[$i])){ ?>
		<td><?php echo $fec_pag[$i]; ?> </td>
		  <?php         }else{ 
		   $error_d = 1;
    $_SESSION['msg_err'] =$_SESSION['msg_err']." -- ". "error en fecha **".$fec_pag[$i];
	header('Location: sol_csimula_v.php');
		      } ?>
				   
		
		 <td align="right"><?php echo number_format($pag_cap[$i], 2, '.',','); ?> </td> 
		 <td align="right"><?php echo number_format($pag_int[$i], 2, '.',','); ?> </td> 
		  <td align="right" ><?php echo number_format($pag_aho[$i], 2, '.',','); ?> </td> 
		   <td align="right"><?php echo number_format($pag_cap[$i]+$pag_int[$i]+$pag_aho[$i], 2, '.',','); ?> </td> 
		   <td align="right"><?php echo number_format($saldo, 2, '.',','); ?> </td> 
	   	    <?php // }?> 
        <?php  //} ?>

	
</tr>  					
<?php } ?>
 <tr>   
             <td align="center"><strong><?php echo "Totales";?></strong></td>
			 <td><?php echo encadenar(2);?></td>
			 <th align="right"><?php echo number_format($tot_cap, 2, '.',',');?></td>
			  <th align="right"><?php echo number_format($tot_int, 2, '.',',');?></td>
			  <th align="right"><?php echo number_format($tot_aho, 2, '.',',');?></td>
			  <th align="right"><?php echo number_format($tot_cap+$tot_int+$tot_aho, 2, '.',',');?></td>
			 
		</tr>
</table>		

 <br>
	<center>


  
<strong>
<font size="+0">
<?php

?>
</font>
</strong>	
<center>	
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