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
<html>
<head>
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
</head>
 
</head>
<body>
	<div id="cuerpoModulo">
	<?php
		//		include("header.php");
			?>
            

				<?php
					// $fec = leer_param_gral();
					// $fec1 = cambiaf_a_mysql_2($fec);
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
				?>
 <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <a href='cja_com_ven.php'>Salir</a>
  </div>
      


<font  size="+1">
<?php
if(isset($_SESSION['fec_proc'])){ 
   $fec = $_SESSION['fec_proc']; 
   $fec1 = cambiaf_a_mysql_2($fec);
 }		
 $con_emp = "Select *  From gral_empresa ";
         $res_emp = mysql_query($con_emp)or die('No pudo seleccionarse tabla gral_empresa');
 	     while ($lin_emp = mysql_fetch_array($res_emp)) {
		        $emp_nom = $lin_emp['GRAL_EMP_NOMBRE'];
				$emp_ger = $lin_emp['GRAL_EMP_GERENTE'];
				$emp_cig = $lin_emp['GRAL_EMP_GER_CI'];
				$emp_dir = $lin_emp['GRAL_EMP_DIREC'];
		  }
 $nro_tr_caj = leer_nro_co_cja($apli,$log_usr);
   $nro_tr_comven = leer_nro_co_comven();		  
		  
		  
?>
<table border="0" width="900">
	<tr>
	    <th align="left"><?php echo $emp_nom; ?> </th> 
		<th align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Cochabamba"; ?></th>  
	   	<td align="right"><?php echo $_SESSION['fec_proc']; ?></th> 
		<th align="center"><?php echo encadenar(14); ?></th>
		<th align="left"><?php echo $emp_nom; ?></th>
		<th align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "Cochabamba"; ?></th>  
		<td align="right"><?php echo $_SESSION['fec_proc']; ?></th>     
			
    </tr>	
	<tr>
	    <td align="left"><?php echo $emp_dir; ?> </th> 
		<td align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Cte Caja"; ?></th>  
	   	<th align="right"><?php echo "Nro.".encadenar(5).$nro_tr_caj; ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		<td align="left"><?php echo $emp_dir; ?></th>
		<td align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "Cte Caja"; ?></th>  
		<th align="right"><?php echo "Nro.".encadenar(5).$nro_tr_caj; ?></th>     
			
    </tr>	
	<tr>
	    <td align="left"><?php echo encadenar(16); ?> </th> 
		<td align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Cte Com/Ven Div."; ?></th>  
	   	<th align="right"><?php echo "Nro.".encadenar(5). $nro_tr_comven; ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		<th align="left"><?php echo encadenar(16); ?></th>
		<th align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "Cte Com/Ven Div."; ?></th>  
		<th align="right"><?php echo "Nro.".encadenar(5). $nro_tr_comven; ?></th>     
			
    </tr>	
	</table>
	</center>
<?php
echo encadenar(25)."Recibo de".encadenar(1).$_SESSION['des_tran'].encadenar(55)."Recibo de".encadenar(1).$_SESSION['des_tran']; 
?>	

<br><br>
</font>
<?php
//echo encadenar(62). "Nro. Tran. ".encadenar(2).$nro_tr_caj;
?>
 <?php
//if ($_SESSION['detalle'] == 3){
   $apli = 10000;
   $tc_ctb = $_SESSION['tc_com'];
   $c_agen = $_SESSION['COD_AGENCIA'];
   if ($_SESSION['c_com_ven'] == 1){
      $descrip = "Compra de Divisas";
      $importe = $_SESSION['monto_com'];
      $imp_or = $_SESSION['imp_sus'];
	  $cta_ctb = $_SESSION['cta_ctus'];
	  }
	if ($_SESSION['c_com_ven'] == 2){
      $descrip = "Venta de Divisas";
      $importe = $_SESSION['monto_ven'];
      $imp_or = $_SESSION['imp_sus'];
	  $cta_ctb = $_SESSION['cta_ctbs'];
	  }  
  // $cta_ctbg = "11220101";
  // $cta_ctb = "11220101";
  // $deb_hab = 2;	
  
   //$tipo = $_SESSION['t_fac_fis'];
//   echo encadenar(112). "Nro. Tran. ".encadenar(2).$nro_tr_caj;
   // echo "aqui".$c_agen.$nro_tr_caj,$descrip,$monto_t,$cta_ctbg ;
?>
<table border="0" width="900">
<tr>
	    <th align="left"><?php echo "Cajero"; ?> </th> 
		<td align="left"><?php echo $_SESSION['nombres']; ?></th> 
		<th align="left"><?php echo encadenar(10); ?></th>  
	   	<td align="left"><?php echo encadenar(10); ?></th> 
		<th align="center"><?php echo encadenar(10); ?></th>
		<th align="left"><?php echo "Cajero"; ?></th>
		<td align="left"><?php echo $_SESSION['nombres']; ?></th>     
		<th align="left"><?php echo encadenar(10); ?></th>  
		<td align="left"><?php echo encadenar(10); ?></th>     
			
    </tr>	
</table>
 <table border="0" width="900">
 <?php if ($_SESSION['c_com_ven'] == 1){  ?> 
  <tr>
	    <th align="left"><?php echo $descrip.encadenar(1)."de"; ?> </th> 
		<th align="left"><?php echo number_format($imp_or, 2, '.',','); ?></th>
		<td align="left"><?php echo encadenar(1)."Dol.".encadenar(1)."T.C.".encadenar(1); ?></th> 
		<th align="center"><?php echo number_format($tc_ctb, 2, '.',','); ?></th> 
		<th align="left"><?php echo "son".encadenar(1); ?> </th> 
		<th align="center"><?php echo number_format($importe, 2, '.',','); ?></th>
		<td align="left"><?php echo encadenar(1)."Bs."; ?></th> 
		 <th align="left"><?php echo encadenar(3); ?> </th>
		<th align="left"><?php echo $descrip.encadenar(1)."de"; ?> </th> 
		<th align="left"><?php echo number_format($imp_or, 2, '.',','); ?></th>
		<td align="left"><?php echo encadenar(1)."Dol.".encadenar(1)."T.C.".encadenar(1); ?></th> 
		<th align="center"><?php echo number_format($tc_ctb, 2, '.',','); ?></th> 
		<th align="left"><?php echo "son".encadenar(1); ?> </th> 
		<th align="center"><?php echo number_format($importe, 2, '.',','); ?></th>
		<td align="left"><?php echo encadenar(1)."Bs."; ?></th>    
   </tr>
  <?php } ?> 	
  <?php if ($_SESSION['c_com_ven'] == 2){  ?> 
  <tr>
	    <th align="left"><?php echo $descrip.encadenar(1)."de"; ?> </th> 
		<th align="left"><?php echo number_format($imp_or, 2, '.',','); ?></th>
		<td align="left"><?php echo encadenar(1)."Dol.".encadenar(1)."T.C.".encadenar(1); ?></th> 
		<th align="center"><?php echo number_format($tc_ctb, 2, '.',','); ?></th> 
		<th align="left"><?php echo "son".encadenar(1); ?> </th> 
		<th align="center"><?php echo number_format($importe, 2, '.',','); ?></th>
		<td align="left"><?php echo encadenar(1)."Bs."; ?></th> 
		 <th align="left"><?php echo encadenar(3); ?> </th>
		<th align="left"><?php echo $descrip.encadenar(1)."de"; ?> </th> 
		<th align="left"><?php echo number_format($imp_or, 2, '.',','); ?></th>
		<td align="left"><?php echo encadenar(1)."Dol.".encadenar(1)."T.C.".encadenar(1); ?></th> 
		<th align="center"><?php echo number_format($tc_ctb, 2, '.',','); ?></th> 
		<th align="left"><?php echo "son".encadenar(1); ?> </th> 
		<th align="center"><?php echo number_format($importe, 2, '.',','); ?></th>
		<td align="left"><?php echo encadenar(1)."Bs."; ?></th>    
   </tr>
  <?php } ?> 	
     <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		<td align="right"><?php echo encadenar(3); ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th> 
		<th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		<td align="right"><?php echo encadenar(3); ?></th>  
   </tr>
   <tr>
	    <th align="left"><?php echo $_SESSION['descrip']; ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="center"><?php echo encadenar(3); ?></th>
		<td align="right"><?php echo encadenar(3); ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo $_SESSION['descrip']; ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="center"><?php echo encadenar(3); ?></th>
		<td align="right"><?php echo encadenar(3); ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="center"><?php echo encadenar(3); ?></th> 
   </tr>
  
   </table>
 
 <table border="0" width="900"> 
	
    <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		<td align="right"><?php echo encadenar(3); ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th> 
	 </tr>
   <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		<td align="right"><?php echo encadenar(3); ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th> 
	 </tr>
	 <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		<td align="right"><?php echo encadenar(3); ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th> 
	 </tr>
   <tr>
	    <th align="left"><?php  echo encadenar(5)."_____________________", encadenar(15),"_____________________"; ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(3); ?> </th>  
		<th align="left"><?php echo  encadenar(5)."_____________________", encadenar(15),"_____________________"; ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th> 
   </tr>	
    <tr>
	    <th align="left"><?php  echo encadenar(12)."INTERESADO", encadenar(25),"CAJERO"; ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(3); ?> </th>  
		<th align="left"><?php echo  encadenar(12)."INTERESADO", encadenar(25),"CAJERO"; ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th> 
   </tr>
    <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		<td align="right"><?php echo encadenar(3); ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th> 
	 </tr>
    <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		<td align="right"><?php echo encadenar(3); ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th> 
	 </tr>
	  <tr>
	    <th align="left" style="font-size:11px"><?php echo "Nota: No valido como Credito Fiscal "; ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(3); ?> </th>  
		<th align="left" style="font-size:11px" ><?php echo "Nota: No valido como Credito Fiscal "; ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th> 
   </tr>
    <tr>
	    <th align="left" style="font-size:11px"><?php echo "Antes de firmar verifique los datos"; ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(3); ?> </th>  
		<th align="left" style="font-size:11px" ><?php echo "Antes de firmar verifique los datos "; ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th> 
   </tr>
	 
	 
  </table>
 <?php
 if ($_SESSION['c_com_ven'] == 1){
      $descrip = "Compra de Divisas";
      $importe = $_SESSION['monto_com'] * - 1;
      $imp_or = $_SESSION['imp_sus'];
	  $cta_ctb = $_SESSION['cta_ctus'];
	  }
	if ($_SESSION['c_com_ven'] == 2){
      $descrip = "Venta de Divisas";
      $importe = $_SESSION['monto_ven'];
      $imp_or = $_SESSION['imp_sus'] * -1;
	  $cta_ctb = $_SESSION['cta_ctus'];
	  }  
//  echo $nro_tr_caj.$c_agen.$c_agen.$fec1.$log_usr.$nro_tr_caj.$log_usr.$cta_ctb.
//												 $importe.$imp_or.$tc_ctb.$descrip.$log_usr;					 		 
$consulta = "insert into caja_transac (CAJA_TRAN_NRO_COR, 
                                       CAJA_TRAN_AGE_CJRO,
									   CAJA_TRAN_AGE_ORG,
									   CAJA_TRAN_COD_SC,
									   CAJA_TRAN_FECHA,
					                   CAJA_TRAN_CAJERO1,
					                   CAJA_TRAN_APL_ORG,
   				                       CAJA_TRAN_TIPO_OPE,
					                   CAJA_TRAN_NRO_DOC, 
									   CAJA_TRAN_NRO_CAR, 
									   CAJA_TRAN_NRO_FON, 
									   CAJA_TRAN_CAJERO2,
                                       CAJA_TRAN_APL_DES,
                                       CAJA_TRAN_DOC_EQUIV,
                                       CAJA_TRAN_VIA_PAG,
                                       CAJA_TRAN_REL_FAC,
                                       CAJA_TRAN_DEB_CRED,
									   CAJA_TRAN_CTA_CONT,
                                       CAJA_TRAN_IMPORTE,
                                       CAJA_TRAN_IMP_EQUIV,
                                       CAJA_TRAN_MON,
                                       CAJA_TRAN_TIP_CAMB,
                                       CAJA_TRAN_DESCRIP,
                                       CAJA_TRAN_USR_ALTA,
                                       CAJA_TRAN_FCH_HR_ALTA,
									   CAJA_TRAN_USR_BAJA,
									   CAJA_TRAN_FCH_HR_BAJA
									   ) values ($nro_tr_caj,
									             $c_agen,
												 $c_agen,
												 0,
												 '$fec1',
												 '$log_usr',
												 14000,
												 14,
												 $nro_tr_caj,
												 0,
												 0,
												 '$log_usr',
												 14000,
												 null,
												 null,
 											     null,
												 null,
												 $cta_ctb,
												 $importe,
										         $imp_or,
												 1,
												 $tc_ctb,
												 '$descrip',				 
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_transac : ' . mysql_error());
//Correlativo de compra venta
//$nro_tr_comven = 0;
$cta_ctbs = "";
$cta_ctus =	"";
$monto_com = 0;
$monto_ven = 0;
$monto_ctb = 0;
$dif_tc =0;
$cta_dtc = "";
$imp_bs = 0;
$imp_sus = 0;
$descrip = "";


$cta_ctbs = $_SESSION['cta_ctbs'];
$cta_ctus =	$_SESSION['cta_ctus'];
$monto_com = $_SESSION['monto_com'];
$monto_ven = $_SESSION['monto_ven'];
$monto_ctb = $_SESSION['monto_ctb'];
$dif_tc = $_SESSION['dif_tc'];
$cta_dtc = $_SESSION['cta_dtc'];
$imp_bs = $_SESSION['imp_bs'];
$imp_sus = $_SESSION['imp_sus'];
$descrip = $_SESSION['descrip'];

echo $_SESSION['cta_ctbs'],$_SESSION['cta_ctus'],$monto_com,$monto_ven,$monto_ctb,$dif_tc,$cta_dtc,$imp_bs,$imp_sus ,$descrip;



if ($_SESSION['c_com_ven'] == 1){
   $deb_hsus = 1;
   $deb_hbs = 2;
   $deb_hdif = 1;
   $tipo = 1; 
   $mon = 2;
   $importe = $monto_ctb;
   $impo_eq = $imp_sus;
   }else{
   $deb_hsus = 2;
   $deb_hbs = 1;
   $deb_hdif = 2;
   $tipo = 2;
   $mon = 2;
   $importe = $monto_ctb;
   $impo_eq = $imp_sus;
}
 //echo $nro_tr_comven." ".$nro_tr_caj." ".$c_agen." ".$deb_hsus." ".$cta_ctus." ".$tipo." ".$fec1." ".$descrip." ".$mon." ".$importe." ".$impo_eq;
$consulta = "insert into caja_com_ven(caja_comven_corr, 
	                                   caja_comven_corr_cja,
                                       caja_comven_agen,
									   caja_comven_debhab,
									   caja_comven_cta,
									   caja_comven_tipo,
					                   caja_comven_fecha,
					                   caja_comven_descrip,
   				                       caja_comven_mon, 
									   caja_comven_impo, 
									   caja_comven_impo_e,
									   caja_comven_contab,
									   caja_comven_usr_alta,
                                       caja_comven_fch_hra_alta,
                                       caja_comven_usr_baja,
                                       caja_comven_fch_hra_baja
                                       ) values ($nro_tr_comven,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hsus,
												 '$cta_ctus',
												 $tipo,
												 '$fec1',
												 '$descrip',
												  $mon,
												  $importe,
												  $impo_eq,
												  2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_com_ven  1: ' . mysql_error()); 
if ($_SESSION['c_com_ven'] == 1){
   $deb_hab = 2;
   $mon = 1;
   $importe = $monto_com;
   $impo_eq = $monto_com;
   }else{
   $deb_hab = 1;
   $mon = 1;
   $importe = $monto_ven;
   $impo_eq = $monto_ven;
 }
// echo $nro_tr_comven.$nro_tr_caj.$c_agen.$deb_hbs.$cta_ctbs.$tipo.$fec1.$descrip.$mon.$importe.$impo_eq;
 
$consulta = "insert into caja_com_ven(caja_comven_corr, 
	                                   caja_comven_corr_cja,
                                       caja_comven_agen,
									   caja_comven_debhab,
									   caja_comven_cta,
									   caja_comven_tipo,
					                   caja_comven_fecha,
					                   caja_comven_descrip,
   				                       caja_comven_mon, 
									   caja_comven_impo, 
									   caja_comven_impo_e,
									   caja_comven_contab,
									   caja_comven_usr_alta,
                                       caja_comven_fch_hra_alta,
                                       caja_comven_usr_baja,
                                       caja_comven_fch_hra_baja
                                       ) values ($nro_tr_comven,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hbs,
												 '$cta_ctbs',
												 $tipo,
												 '$fec1',
												 '$descrip',
												  $mon,
												  $importe,
												  $impo_eq,
												  2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_com_ven  2: ' . mysql_error()); 
if ($_SESSION['c_com_ven'] == 1){
   $dif_tc = $dif_tc * -1;
 }
$mon = 1;
$consulta = "insert into caja_com_ven(caja_comven_corr, 
	                                   caja_comven_corr_cja,
                                       caja_comven_agen,
									   caja_comven_debhab,
									   caja_comven_cta,
									   caja_comven_tipo,
					                   caja_comven_fecha,
					                   caja_comven_descrip,
   				                       caja_comven_mon, 
									   caja_comven_impo, 
									   caja_comven_impo_e,
									   caja_comven_contab,
									   caja_comven_usr_alta,
                                       caja_comven_fch_hra_alta,
                                       caja_comven_usr_baja,
                                       caja_comven_fch_hra_baja
                                       ) values ($nro_tr_comven,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hdif,
												 '$cta_dtc',
												 $tipo,
												 '$fec1',
												 '$descrip',
												  $mon,
												  $dif_tc,
												  $dif_tc,
												  2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_com_ven  3: ' . mysql_error()); 
/*	
  	 

*/	 
	
	?>
	
<?php

?>

  <?php //} ?>
	 
</div>
  <?php
		 //	include("footer_in.php");
		 ?>
</div>
</body>
</html>
<?php
}
ob_end_flush();
 ?>