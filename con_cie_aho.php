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
				include("header.php");
			?>
            

				<?php
					 $fec = leer_param_gral();
					 $fec1 = cambiaf_a_mysql_2($fec);
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
				?>
 <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <a href='menu_s.php'>Salir</a>
  </div>

<br><br>
            
<center>
<BR>
<font  size="+2">


<br><br>
<?php
echo "Comprobante Cierre Saldos Mínimos Fondo de Garantia ";
?>
<br><br>
</font>
<?php
/*if (isset($_SESSION['diferencia'])){
   if ($_SESSION['diferencia'] == 1){
      echo "No se contabiliza en uno de los Modulos hay diferencia";
   }
 }
 */   
$_SESSION['descrip'] = "Cierre Saldos Mínimos Fondo de Garantia " .encadenar(2).$fec;

//$glosa = $_SESSION['descrip'];
?>
<br><br>

 <?php
 /*
  */
  ?>	
  <br>
   </center>
 <?php
 //Graba contab_trans, contab_mae_sal
  $cod_cta1 = $_SESSION['cod_cta1'];
  $cod_cta2 = $_SESSION['cod_cta2'];	
  $impo1 = $_SESSION['impo1'];
  $impo2 = $_SESSION['impo2'];
  $cod_mon = $_SESSION['cod_mon'];
   $impo = $_SESSION['impo'];
  $imp = $impo1;
  $imp_e= $impo2;
  $nro_tr_con = leer_nro_co_con();
  $glosa = $_SESSION['descrip'];
  $consulta = "insert into contab_trans (CONTA_TRS_AGEN, 
                                         CONTA_TRS_NRO,
									     CONTA_TRS_FEC_VAL,
									     CONTA_TRS_CTA,
									     CONTA_TRS_GLOSA,
					                     CONTA_TRS_IMPO,
					                     CONTA_TRS_IMPO_E,
   				                         CONTA_TRS_DEB_CRED,
										 CONTA_TRS_TIPO,
					                     CONTA_TRS_USR_ALTA, 
									     CONTA_TRS_FCH_HR_ALTA, 
									     CONTA_TRS_USR_BAJA, 
									     CONTA_TRS_FCH_HR_BAJA
                                        ) values (30,
										         $nro_tr_con,
									             '$fec1',
												 '$cod_cta1',
												 '$glosa',
												 $imp,
												 $imp_e,
												 1,
												 2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_transac : ' . mysql_error());
 
 $consulta = "insert into contab_trans (CONTA_TRS_AGEN, 
                                         CONTA_TRS_NRO,
									     CONTA_TRS_FEC_VAL,
									     CONTA_TRS_CTA,
									     CONTA_TRS_GLOSA,
					                     CONTA_TRS_IMPO,
					                     CONTA_TRS_IMPO_E,
   				                         CONTA_TRS_DEB_CRED,
										 CONTA_TRS_TIPO,
					                     CONTA_TRS_USR_ALTA, 
									     CONTA_TRS_FCH_HR_ALTA, 
									     CONTA_TRS_USR_BAJA, 
									     CONTA_TRS_FCH_HR_BAJA
                                        ) values (30,
										         $nro_tr_con,
									             '$fec1',
												 '$cod_cta2',
												 '$glosa',
												 $imp,
												 $imp_e,
												 2,
												 2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_transac : ' . mysql_error());
 
 $con_temp  = "Select * From temp_fondo where TEMP_SAL <= '$impo' and  TEMP_CRED = ' '";
 $res_temp = mysql_query($con_temp);
 $tipo = 2;
 $i_deb = 0;
 $i_hab = 0;
 $n_deb = 0;
 $n_hab = 0;
 $apli = 0; 
 $deb_hab = 0;
  $nro_tr_con = leer_nro_co_con();
  echo $_SESSION['descrip'].encadenar(2)."Nro.".encadenar(2).$nro_tr_con;
 while ($lin_temp = mysql_fetch_array($res_temp)) {
   		$glosa = "Cierre Saldos Mínimos Fondo de Garantia";
	    $deb_hab = 1;
        $nro_tr_fond = leer_nro_co_fon(2,$log_usr); 
	     if ($cod_mon == 1){
			$importe =  $lin_temp['TEMP_SAL'];
			$importe_e =  $lin_temp['TEMP_SAL'];
		 }
		 if ($cod_mon == 2){
			$importe =  $lin_temp['TEMP_SAL'];
			$importe_e =$lin_temp['TEMP_SAL'] * $_SESSION['TC_CONTAB'];
			  }
		$cta =  $lin_temp['TEMP_CTA']; 
		 $tc_ctb =  $_SESSION['TC_CONTAB'];
	$consulta = "insert into fond_cabecera (FOND_CAB_NCTA, 
                                         FOND_CAB_AGEN,
									     FOND_CAB_NRO_TRAN,
									     FOND_CAB_TRAN_CAJ,
										 FOND_CAB_TRAN_CAR,
									     FOND_CAB_FECHA,
					                     FOND_CAB_TIP_TRAN,
					                     FOND_CAB_EST_ANT,
   				                         FOND_CAB_EST_ACT,
					                     FOND_CAB_TIP_CAM, 
									     FOND_CAB_FEC_TRAN, 
									     FOND_CAB_FEC_VTO, 
									     FOND_CAB_FEC_SUS,
                                         FOND_CAB_USR_ALTA,
                                         FOND_CAB_FCH_HR_ALTA,
                                         FOND_CAB_USR_BAJA,
                                         FOND_CAB_FCH_HR_BAJA
									    ) values ($cta,
									             30,
												 $nro_tr_fond,
												 0,
												 0,
												 '$fec1',
												 2,
												 null,
												 null,
 											     $tc_ctb,
												 '$fec1',
												 null,
												 null,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar fon_cabecera : ' . mysql_error());
$consulta = "insert into fond_det_tran(FOND_DTRA_NCTA, 
                                           FOND_DTRA_AGEN,
										   FOND_DTRA_NCRE,
									       FOND_DTRA_NRO_TRAN,
										   FOND_DTRA_NRO_CTA,
									       FOND_DTRA_FECHA,
					                       FOND_DTRA_TIP_TRAN,
   				                           FOND_DTRA_CCON,
					                       FOND_DTRA_DEB_CRE, 
									       FOND_DTRA_CTA_CBT, 
									       FOND_DTRA_IMPO, 
									       FOND_DTRA_IMPO_BS,
                                           FOND_DTRA_FEC_TRAN,
                                           FOND_DTRA_FEC_INI2,
                                           FOND_DTRA_FEC_FIN,
                                           FOND_DTRA_TASA,
										   FOND_DTRA_EST_ANT,
										   FOND_DTRA_VIA,
										   FOND_DTRA_TIP_CAM,
										   FOND_DTRA_USR_ALTA,
										   FOND_DTRA_FCH_HR_ALTA,
										   FOND_DTRA_USR_BAJA,
										   FOND_DTRA_FCH_HR_BAJA
									       ) values ($cta,
									                 30,
													 0,
												     $nro_tr_fond,
													 1,
													 '$fec1',
												     2,
												     212,
													 2,
												     '$cod_cta2',
													 $importe,
													 $importe_e,
 											     	 '$fec1',
												     null,
													 null,
													 0,
													 null,
													 null,
												     $tc_ctb,
												    '$log_usr',
												     null,
												     null,
												    '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar fon_det_tran : ' . mysql_error()); 

 $con_maes = "update fond_maestro set FOND_ESTADO = 9, FOND_FCH_CAN = '$fec1'
			              where FOND_NRO_CTA = $cta ";
			 $res_maes = mysql_query($con_maes)or die
			            ('No pudo actualizar estado maestro ' . mysql_error());	
}						
	   
?>	
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