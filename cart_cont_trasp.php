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
?>
<html>
<head>
<title>Registrando  Traspaso</title>
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
<?php
 $fec = leer_param_gral();
 $f_pro = cambiaf_a_mysql_2($fec);
 $logi = $_SESSION['login'];
 ?>
</div>
            <div id="Salir">
            <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
            </div>
            <div id="TitleModulo">
            	 <img src="images/24x24/001_36.png" border="0" alt="Modulo">
                      Registrando Detalle Contable de Traspaso
			</div>
            <div id="AtrasBoton">
           	<a href="menu_s.php?modulo=<?php echo $_SESSION['modulo'];?>"><img src="images/24x24/001_23.png" border="0"  alt="Regresar" align="absmiddle">Atras</a>
            </div>
<font size="+1">
<div id="TableModulo2" >

 <form name="form2" method="post" action="cobro_retro_opd.php" style="border:groove" onSubmit="return">  
<?php

 

?> 
 <font size="+2"  style="" >
<?php
echo encadenar(45)."Registrando traspaso al ".encadenar(3).$fec;
 $nro_tr_cart = leer_nro_co_car(2,32);
 echo "Nro. Transaccion Cartera" . encadenar(2).$nro_tr_cart;

?>
</font>
<br><br>
<?php
// Leer temp_trasp	
$mone = 0;
$d_mone = "";
$nro = 0;
$tc_ctb = $_SESSION['TC_CONTAB'];
$con_tras = "Select * From temp_trasp";
$res_tras = mysql_query($con_tras);
$nro_tr_cart = 0;
$nro_tr_caj = 0;
$nro_tr_fond = 0;
$nro_tr_cart = leer_nro_co_car(2,$logi);	
$nro_tr_cart = $nro_tr_cart - 1; 
	    while ($lin_tras = mysql_fetch_array($res_tras)) {
		    $nro_tr_cart = $nro_tr_cart + 1; 
			$nro_cre = $lin_tras['credito'];  
			$est_act = $lin_tras['esta_act'];
			$est_nue = $lin_tras['esta_nue'];
			$cta_act = $lin_tras['cta_act'];
			$cta_nue = $lin_tras['cta_nue']; 
			$f_vto = $lin_tras['fecha_vto'];
			$f_tra = $lin_tras['fecha'];
			$saldo = $lin_tras['saldo'];
			
			$con_car  = "Select * From cart_maestro where CART_NRO_CRED = $nro_cre
             			 and  CART_MAE_USR_BAJA is null "; 
            $res_car = mysql_query($con_car);
            while ($lin_car = mysql_fetch_array($res_car)) {
			       $c_agen = $lin_car['CART_COD_AGEN'];
				   $mon = $lin_car['CART_COD_MON'];
				   }
			if ($mon == 1){
			    $importe = $saldo;
				$importe_e = $saldo;
				}
			if ($mon == 2){
			    $importe = $saldo;
				$importe_e = $saldo * $tc_ctb;
				}	
			if ($est_act == 3){
			    $tip1 = 131;
			    $tip2 = 133; 
			    $deb_hab1 = 2;
				$deb_hab2 = 1;
				}	
			if ($est_act == 6){
			    $tip1 = 133;
			    $tip2 = 131; 
			    $deb_hab1 = 2;
				$deb_hab2 = 1;
				}			   
			if ($est_act == 7){
			    $tip1 = 134;
			    $tip2 = 133; 
			    $deb_hab1 = 2;
				$deb_hab2 = 1;
				}	
//cart_cabecera			
			$consulta = "insert into cart_cabecera (CART_CAB_NCRE, 
                                         CART_CAB_AGEN,
									     CART_CAB_NRO_TRAN,
									     CART_CAB_TRAN_CAJ,
										 CART_CAB_TRAN_FON,
									     CART_CAB_FECHA,
					                     CART_CAB_TIP_TRAN,
					                     CART_CAB_EST_ANT,
   				                         CART_CAB_EST_ACT,
					                     CART_CAB_TIP_CAM, 
									     CART_CAB_FEC_TRAN, 
									     CART_CAB_FEC_VTO, 
									     CART_CAB_FEC_SUS,
                                         CART_CAB_USR_ALTA,
                                         CART_CAB_FCH_HR_ALTA,
                                         CART_CAB_USR_BAJA,
                                         CART_CAB_FCH_HR_BAJA
									    ) values ($nro_cre,
									             $c_agen,
												 $nro_tr_cart,
												 $nro_tr_caj,
												 $nro_tr_fond,
												 '$f_tra',
												 3,
												 $est_act,
												 $est_nue,
 											     $tc_ctb,
												 '$f_tra',
												 '$f_vto',
												 null,
												 '$logi',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
             $resultado = mysql_query($consulta); 
			 
			 
			 
$consulta = "insert into cart_det_tran(CART_DTRA_NCRE, 
                                           CART_DTRA_AGEN,
									       CART_DTRA_NRO_TRAN,
										   CART_DTRA_NRO_CTA,
									       CART_DTRA_FECHA,
					                       CART_DTRA_TIP_TRAN,
   				                           CART_DTRA_CCON,
					                       CART_DTRA_DEB_CRE, 
									       CART_DTRA_CTA_CBT, 
									       CART_DTRA_IMPO, 
									       CART_DTRA_IMPO_BS,
                                           CART_DTRA_FEC_TRAN,
                                           CART_DTRA_FEC_INI2,
                                           CART_DTRA_FEC_FIN,
                                           CART_DTRA_TASA,
										   CART_DTRA_EST_ANT,
										   CART_DTRA_VIA,
										   CART_DTRA_TIP_CAM,
										   CART_DTRA_USR_ALTA,
										   CART_DTRA_FCH_HR_ALTA,
										   CART_DTRA_USR_BAJA,
										   CART_DTRA_FCH_HR_BAJA
									       ) values ($nro_cre,
									                 $c_agen,
												     $nro_tr_cart,
													 0,
													 '$f_tra',
												     3,
												     $tip1,
													 $deb_hab1,
												     '$cta_act',
													 $importe,
													 $importe_e,
 											     	 '$f_tra',
												     null,
													 null,
													 0,
													 null,
													 null,
												     $tc_ctb,
												    '$logi',
												     null,
												     null,
												    '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta); 
$consulta = "insert into cart_det_tran(CART_DTRA_NCRE, 
                                           CART_DTRA_AGEN,
									       CART_DTRA_NRO_TRAN,
										   CART_DTRA_NRO_CTA,
									       CART_DTRA_FECHA,
					                       CART_DTRA_TIP_TRAN,
   				                           CART_DTRA_CCON,
					                       CART_DTRA_DEB_CRE, 
									       CART_DTRA_CTA_CBT, 
									       CART_DTRA_IMPO, 
									       CART_DTRA_IMPO_BS,
                                           CART_DTRA_FEC_TRAN,
                                           CART_DTRA_FEC_INI2,
                                           CART_DTRA_FEC_FIN,
                                           CART_DTRA_TASA,
										   CART_DTRA_EST_ANT,
										   CART_DTRA_VIA,
										   CART_DTRA_TIP_CAM,
										   CART_DTRA_USR_ALTA,
										   CART_DTRA_FCH_HR_ALTA,
										   CART_DTRA_USR_BAJA,
										   CART_DTRA_FCH_HR_BAJA
									       ) values ($nro_cre,
									                 $c_agen,
												     $nro_tr_cart,
													 0,
													 '$f_tra',
												     3,
												     $tip2,
													 $deb_hab2,
												     '$cta_nue',
													 $importe,
													 $importe_e,
 											     	 '$f_tra',
												     null,
													 null,
													 0,
													 null,
													 null,
												     $tc_ctb,
												    '$logi',
												     null,
												     null,
												    '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);

$consulta = "update cart_maestro set CART_ESTADO = $est_nue where CART_NRO_CRED = $nro_cre"; 
$resultado = mysql_query($consulta);
$consulta = "update cart_plandp set CART_PLD_STAT = 'M' where CART_PLD_NCRE = $nro_cre and
                                    CART_PLD_FECHA = '$f_vto'"; 
$resultado = mysql_query($consulta);

            }  						

		 	include("footer_in.php");
			
			
		 ?>

</div>
</body>
</html>



<?php
}
ob_end_flush();
 ?>

