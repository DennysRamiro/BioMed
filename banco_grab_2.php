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
			//	include("header.php");
			?>
            

				<?php
					 $fec = $_SESSION['fec_proc']; //leer_param_gral();
					 $fec1 = cambiaf_a_mysql_2($fec);
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
				?>
 <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <a href='cja_bancos.php'>Salir</a>
  </div>

<br><br>
            
<center>
<BR>
<font  size="+2">


<br><br>
<?php
echo "Recibo de ".encadenar(1).$_SESSION['des_tran'];
?>
<br><br>
</font>
<?php
//echo encadenar(62). "Nro. Tran. ".encadenar(2).$nro_tr_caj;
?>
 <?php
//if ($_SESSION['detalle'] == 3){
   $apli = 10000;
   $tc_ctb = $_SESSION['TC_CONTAB'];
   $c_agen = $_SESSION['COD_AGENCIA'];
   
  ?>
    <strong>
 <?php echo $_SESSION['des_tran'].encadenar(2)."a cta.".encadenar(2).
 $_SESSION['cta_bco'].encadenar(2).$_SESSION['nom_cta']; ?>
  <br>
 
	</strong>  
  <br><br>
 
 <table align="center">
 <tr>
        <th align="left"><?php echo encadenar(25); ?></th>
		<td align="right"><?php echo  encadenar(15); ?></td>
		<td align="right"><?php echo  encadenar(8); ?></td>
		<td align="right"><?php echo  encadenar(15); ?></td>
     </tr>
  <?php if ($_SESSION['bco_bs_sus'] == 2){  ?> 
    
    <tr>
        <td align="right"><?php echo $_SESSION['des_tran'].encadenar(2)."de"; ?></th>
		<th align="right"><?php echo number_format($_SESSION['impo_eqv1'], 2, '.',','); ?></td>
		<td align="left"><?php echo encadenar(2)."Dol.".encadenar(2)."T.C.".encadenar(2); ?></th>
		<th align="left"><?php echo number_format($_SESSION['TC_CONTAB'], 2, '.',','); ?></td>
		<td align="left"><?php echo "son".encadenar(2); ?></td>
		<th align="right"><?php echo number_format($_SESSION['impo_bs1'], 2, '.',','); ?></td>
		<td align="left"><?php echo encadenar(2)."Bs."; ?></td>
     </tr>
    <?php } ?>
	 <?php if ($_SESSION['bco_bs_sus'] == 1){  ?> 
   
    <tr>
        <td align="right"><?php echo $_SESSION['des_tran'].encadenar(2)."de"; ?></th>
		<th align="right"><?php echo number_format($_SESSION['impo_bs1'], 2, '.',','); ?></td>
		<td align="left"><?php echo encadenar(2)."Bs."; ?></td>
		
     </tr>
    <?php } ?>
	 <tr>
        <th align="left"><?php echo "Transaccion de".encadenar(2).$_SESSION['des_tran'].encadenar(2)."por".encadenar(2).
 $_SESSION['descrip']; ?></th>
		<td align="right"><?php echo  encadenar(15); ?></td>
		<td align="right"><?php echo  encadenar(8); ?></td>
		<td align="right"><?php echo  encadenar(15); ?></td>
     </tr>
	
	
	
        </table>
		
<br><br>
</center>
<?php
	 //$mon_des = f_literal($imp_or,1);
	 //echo "Son:". encadenar(8).$mon_des.encadenar(3).$_SESSION['des_mon'];
	 ?>		
<br><br>
<br><br>
<br><br>
<center>
 <?php
  
  echo encadenar(5)."_____________________", encadenar(15),"_____________________";
  ?>
  <br>
 <?php
  
  echo encadenar(12)."INTERESADO", encadenar(40),"     CAJERO";
  ?>	
  <br><br>
  <br><br>
 <?php
 $tipo = $_SESSION['b_dep_ret'];
 $mon = $_SESSION['bco_bs_sus'];
 echo 'tipo'.$tipo.'mon'.$mon;
 echo $_SESSION['impo_bs1']."*".$_SESSION['impo_eqv1']."*".$_SESSION['impo_bs2']."*".$_SESSION['impo_eqv2'];
 
$impo_bs1 = $_SESSION['impo_bs1']; 
$impo_eqv1 = $_SESSION['impo_eqv1'];
$impo_bs2 = $_SESSION['impo_bs2']; 
$impo_eqv2 = $_SESSION['impo_eqv2'];
echo $impo_bs1," + ",$impo_eqv1," + ",$impo_bs2," + ",$impo_eqv2;
	
$cta_bco = $_SESSION['cta_bco'];
$cta_otra = $_SESSION['cta_otra'];
$cta_banco = $_SESSION['cta_banco'];
$des_otra = $_SESSION['des_otra'];
$des_banco = $_SESSION['des_banco'];
//$impo_bs1 = $_SESSION['impo_bs1'];
//$impo_eqv1 = $_SESSION['impo_eqv1'];
//$impo_bs2 = $_SESSION['impo_bs2'];
//$impo_eqv2 = $_SESSION['impo_eqv2'];		
$tc_ctb = $_SESSION['TC_CONTAB'];
$cod_bco = $_SESSION['cod_bco'];
$tip_cta = substr($cta_otra,0,3);
$mon_otra = substr($cta_otra,5,1);
$descrip = $_SESSION['descrip'];
//$cod_bco = $_SESSION['bco_bs_sus'];

echo $_SESSION['impo_bs1']," a ",$_SESSION['impo_eqv1']," a ",
$_SESSION['impo_bs2']," a ",$_SESSION['impo_eqv2'];
/*if ($mon_otra == 2){
   $impo_eqv2 = round(($impo_eqv2 / $_SESSION['TC_CONTAB']),2);
   $impo_eqv1 = round(($impo_eqv1 / $_SESSION['TC_CONTAB']),2); 
}*/
if ($_SESSION['b_dep_ret'] == 1){
   $desc = "Deposito";
   $deb_hab1 = 1;
   $deb_hab2 = 2;
   if ($_SESSION['bco_bs_sus'] == 1){
    //  $impo_bs1 = $impo_bs1; 
    //  $impo_eqv1 = $impo_bs1;
      $impo_bs1 = $_SESSION['impo_bs1']; 
      $impo_eqv1 = $_SESSION['impo_bs1'];
	  $impo_bs2 = $_SESSION['impo_bs1']*-1; 
      $impo_eqv2 = $_SESSION['impo_bs1']*-1;
	  }else{
	  $impo_bs1 = $_SESSION['impo_bs1'] ; 
      $impo_eqv1 = $_SESSION['impo_eqv1'] ;
	  $impo_bs2 = $_SESSION['impo_bs1']* -1; 
      $impo_eqv2 = $_SESSION['impo_eqv1']* -1;
}


}

if ($_SESSION['b_dep_ret'] == 2){
   $desc = "Retiro";
   $deb_hab1 = 2;
   $deb_hab2 = 1;
   
   if ($_SESSION['bco_bs_sus'] == 1){
  
     $impo_bs1 = $_SESSION['impo_bs1']* -1; 
      $impo_eqv1 = $_SESSION['impo_bs1']* -1;
	  $impo_bs2 = $_SESSION['impo_bs1']; 
      $impo_eqv2 = $_SESSION['impo_bs1'];
	   echo "aqui retiro bs",$impo_bs2,$impo_eqv2;
	  }else{
	  $impo_bs1 = $_SESSION['impo_bs1']* -1 ; 
      $impo_eqv1 = $_SESSION['impo_eqv1']* -1 ;
	  $impo_bs2 = $_SESSION['impo_bs1']; 
      $impo_eqv2 = $_SESSION['impo_eqv1'];
   }

}


if ($tip_cta == '111'){
$nro_tr_caj = leer_nro_co_cja($apli,$log_usr);
											 					 		 
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
												 15000,
												 15,
												 $nro_tr_caj,
												 0,
												 0,
												 '$log_usr',
												 15000,
												 null,
												 null,
 											     null,
												 null,
												 '$cta_otra',
												 $impo_bs2,
										         $impo_eqv2,
												 1,
												 $tc_ctb,
												 '$desc',				 
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);
//Correlativo de compra venta
}
$nro_tr_bco = leer_nro_tr_banco();
echo "a grabar";
$consulta = "insert into caja_deposito(CAJA_DEP_TIPO, 
	                                   CAJA_DEP_AGEN,
                                       CAJA_DEP_BANCO,
									   CAJA_DEP_CTA_CTB,
									   CAJA_DEP_CTA_BCO,
									   CAJA_DEP_DEB_HAB,
									   CAJA_DEP_NRO,
									   CAJA_DEP_MON,
					                   CAJA_DEP_IMPO,
									   CAJA_DEP_IMPO2,
					                   CAJA_DEP_FECHA,
   				                       CAJA_DEP_QUIEN, 
									   CAJA_DEP_USR_ALTA, 
									   CAJA_DEP_FCH_HR_ALTA,
									   CAJA_DEP_USR_BAJA,
									   CAJA_DEP_FCH_HR_BAJA
                                       ) values ($tipo,
									             $c_agen,
												 $cod_bco,
												 '$cta_banco',
												 '$cta_bco',
												 $deb_hab1,
												 $nro_tr_bco,
												 $mon,
												 $impo_bs1,
												 $impo_eqv1,
												 '$fec1',
												 '$descrip',
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta); 
$consulta = "insert into caja_deposito(CAJA_DEP_TIPO, 
	                                   CAJA_DEP_AGEN,
                                       CAJA_DEP_BANCO,
									   CAJA_DEP_CTA_CTB,
									   CAJA_DEP_CTA_BCO,
									   CAJA_DEP_DEB_HAB,
									   CAJA_DEP_NRO,
									   CAJA_DEP_MON,
					                   CAJA_DEP_IMPO,
									   CAJA_DEP_IMPO2,
					                   CAJA_DEP_FECHA,
   				                       CAJA_DEP_QUIEN, 
									   CAJA_DEP_USR_ALTA, 
									   CAJA_DEP_FCH_HR_ALTA,
									   CAJA_DEP_USR_BAJA,
									   CAJA_DEP_FCH_HR_BAJA
                                       ) values ($tipo,
									             $c_agen,
												 $cod_bco,
												 '$cta_otra',
												 '$cta_bco',
												 $deb_hab2,
												 $nro_tr_bco,
												 $mon,
												 $impo_bs2,
												 $impo_eqv2,
												 '$fec1',
												 '$descrip',
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta); 
  	 

	 
	
	?>
	
<?php

?>

  <?php //} ?>
	 
</div>
  <?php
		 	include("footer_in.php");
		 ?>
</div>
</body>
</html>
<?php
}
ob_end_flush();
 ?>