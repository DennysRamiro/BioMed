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
<title>Registrando  Devengamiento</title>
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
 $log_usr = $logi;
 ?>
</div>
            <div id="Salir">
            <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
            </div>
            <div id="TitleModulo">
            	 <img src="images/24x24/001_36.png" border="0" alt="Modulo">
                      Registrando Detalle Contable Devengamiento
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
$borr_cob  = "Delete From temp_ctable"; 
$cob_borr = mysql_query($borr_cob);
echo encadenar(45)."Registrando devengamiento al ".encadenar(3).$fec;
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
$con_tras = "Select * From temp_trasp where saldo > 0";
$res_tras = mysql_query($con_tras);
$nro_tr_cart = 0;
$nro_tr_caj = 0;
$nro_tr_fond = 0;
$nro_tr_cart = leer_nro_co_car(4,$logi);	
$nro_tr_cart = $nro_tr_cart - 1; 
	    while ($lin_tras = mysql_fetch_array($res_tras)) {
		    $nro_tr_cart = $nro_tr_cart + 1; 
			$nro_cre = $lin_tras['credito'];  
			$est_act = $lin_tras['esta_act'];
			$nro_cta = $lin_tras['esta_nue'];
			$cta_act = $lin_tras['cta_act'];
			$cta_nue = $lin_tras['cta_nue']; 
			$cta_tipa = $lin_tras['cta_tipa'];
			$cta_tipn = $lin_tras['cta_tipn']; 
			$f_vto = $lin_tras['fecha_vto'];
			$f_tra = $lin_tras['fecha'];
			$fec1 = $lin_tras['fecha'];
			$saldo = $lin_tras['saldo'];
			$mon = $lin_tras['moneda'];
			$c_agen = 32;
			$deb_hab1 = 2;
			$deb_hab2 = 1;
			if ($mon == 1){
			    $importe = $saldo;
				$importe_e = $saldo;
				}
			if ($mon == 2){
			    $importe = $saldo;
				$importe_e = $saldo * $tc_ctb;
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
												 4,
												 $est_act,
												 $nro_cta,
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
													 '$nro_cta',
													 '$f_tra',
												     4,
												     $cta_tipa,
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
													 '$nro_cta',
													 '$f_tra',
												     4,
												     $cta_tipn,
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



            }  	
	
	// devengado
    $con_cart  = "select  CART_DTRA_CTA_CBT, sum(CART_DTRA_IMPO),sum(CART_DTRA_IMPO_BS) from cart_det_tran
	              where CART_DTRA_FEC_TRAN = '$fec1' and CART_DTRA_DEB_CRE = 2
	              and CART_DTRA_TIP_TRAN = 4 and CART_DTRA_USR_BAJA is null
	              group by CART_DTRA_CTA_CBT";
    $res_cart = mysql_query($con_cart); 
	while ($lin_cart = mysql_fetch_array($res_cart)) {
	    //    $monto2 = $lin_cart['sum(CART_DTRA_IMPO)'];
			$cuenta = $lin_cart['CART_DTRA_CTA_CBT'];
			$cod_mon = substr($cuenta,5,1);
			if ($cod_mon == 1){
			    $monto2 = round($lin_cart['sum(CART_DTRA_IMPO)'],2);
				$mon_eqv = 0;
				}else{
			    $monto2  = round($lin_cart['sum(CART_DTRA_IMPO_BS)'],2);
				$mon_eqv = round($lin_cart['sum(CART_DTRA_IMPO)'],2);
				}
			$des_cta = 	leer_cta_des($cuenta);
			$consulta = "insert into temp_ctable (temp_tip_tra,
	                                      temp_nro_cta, 
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  (6001,
										   '$cuenta',
									       '$des_cta',
										   0,
										   $monto2,
										   0,
										   $mon_eqv)";
										   
    $resultado = mysql_query($consulta);
					
			?>
   
	<?php } ?>
	<?php 
	
	 $con_cart  = "select  CART_DTRA_CTA_CBT, sum(CART_DTRA_IMPO), sum(CART_DTRA_IMPO_BS) from cart_det_tran 
	               where CART_DTRA_FEC_TRAN = '$fec1' and CART_DTRA_DEB_CRE = 1 
	               and CART_DTRA_TIP_TRAN = 4 and CART_DTRA_USR_BAJA is null group by CART_DTRA_CTA_CBT";
    $res_cart = mysql_query($con_cart); 
	while ($lin_cart = mysql_fetch_array($res_cart)) {
	      //  $monto2 = $lin_cart['sum(CART_DTRA_IMPO)'];
			$cuenta = $lin_cart['CART_DTRA_CTA_CBT'];
			$cod_mon = substr($cuenta,5,1);
			if ($cod_mon == 1){
			    $monto2 = round($lin_cart['sum(CART_DTRA_IMPO)'],2);
				$mon_eqv = 0;
				}else{
			    $monto2  = round($lin_cart['sum(CART_DTRA_IMPO_BS)'],2);
				$mon_eqv = round($lin_cart['sum(CART_DTRA_IMPO)'],2);
				}
				$des_cta = 	leer_cta_des($cuenta);
			$consulta = "insert into temp_ctable (temp_tip_tra,
	                                      temp_nro_cta, 
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  (6004,
										   '$cuenta',
									       '$des_cta',
										    $monto2,
										    0,
										   $mon_eqv,
										   0)";
										   
    $resultado = mysql_query($consulta);
			
				?>
        
	<?php }
		
	$con_temp  = "Select * From temp_ctable order by temp_tip_tra,temp_nro_cta ";
 $res_temp = mysql_query($con_temp);
 $tipo = 2;
 $i_deb = 0;
 $i_hab = 0;
 $n_deb = 0;
 $n_hab = 0;
 $apli = 0; 
  $nro_tr_con = leer_nro_co_con();
  $glosa = "Devengado Interes ".$_SESSION['fecha_cbte'];
 while ($lin_temp = mysql_fetch_array($res_temp)) {
     
			$apli = $lin_temp['temp_tip_tra']; 
		
     /*   if ($lin_temp['temp_tip_tra'] <> $apli) {
		    $nro_tr_con = leer_nro_co_con();
			$apli = $lin_temp['temp_tip_tra'];
		// Graba en gral_cierre_mod
		$con_cierre = "insert into gral_cierre_mod (GRAL_CIERR_MOD_AGEN, 
                                                    GRAL_CIERR_MOD_APL,
									                GRAL_CIERR_MOD_FCH_CIERRE,
									                GRAL_CIERR_MOD_NRO_DOC,
									                GRAL_CIERR_MOD_MOV,
					                                GRAL_CIERR_MOD_ESTADO,
					                                GRAL_CIERR_MOD_USR_ALTA,
   				                                    GRAL_CIERR_MOD_FCH_ALTA,
										            GRAL_CIERR_MOD_USR_BAJA,
					                                GRAL_CIERR_MOD_FCH_BAJA) 				                                             values (30,
										             $apli,
									                 '$fec1',
												     $nro_tr_con,
												     1,
												     1,
												 	 '$log_usr',
												     null,
												     null,
												    '0000-00-00 00:00:00')";
        $res_cierre = mysql_query($con_cierre)or die('No pudo insertar caja_transac : ' . mysql_error());
		
			
			$con_apl = "Select GRAL_PAR_PRO_DESC From gral_param_propios where GRAL_PAR_PRO_GRP = 100 and 
	              GRAL_PAR_PRO_COD = $apli";
		     $res_apl = mysql_query($con_apl)or die('No pudo seleccionarse gral_param_propios xx');
		     while ($lin_apl = mysql_fetch_array($res_apl)) {
		          $aplicacion = $lin_apl['GRAL_PAR_PRO_DESC']  ;
		      }
			
			
			
			$glosa = "Cierre de "." ".$aplicacion." "." "." ".$fec;
			} */ 
        $cod_cta = $lin_temp['temp_nro_cta'];   
 		$imp = $lin_temp['temp_debe_1'] + $lin_temp['temp_haber_1']; 
		$imp_e = $lin_temp['temp_debe_2'] + $lin_temp['temp_haber_2'];
		if ($lin_temp['temp_debe_1'] > 0){
		    $deb_hab = 1;
			$i_deb = $imp;
			$i_hab = 0;
			$n_deb = 1;
			$n_hab = 0;
		   }
		if ($lin_temp['temp_haber_1'] > 0){
		    $deb_hab = 2;
			$i_deb = 0;
			$i_hab = $imp;
			$n_deb = 0;
			$n_hab = 1;
		   } 
		$_SESSION['deb_hab'] =  $deb_hab;    
		 $consulta  = "Insert into contab_cabec (CONTA_CAB_AGEN,
	                                      CONTA_CAB_NRO,
	                                      CONTA_CAB_FEC_VAL,
										  CONTA_CAB_FEC_TRAN,
                                          CONTA_CAB_CBIO,
										  CONTA_CAB_GLOSA,
										  CONTA_CAB_USR_ALTA,
										  CONTA_CAB_FCH_HR_ALTA
										) values
											   (30,
											    $nro_tr_con,
											    '$fec1',
											    '$fec1',
											    0,
											    '$glosa',
											    '$logi',
											     null
											    )";

$resultado = mysql_query($consulta);

		
		
		
		
		
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
												 '$cod_cta',
												 '$glosa',
												 $imp,
												 $imp_e,
												 $deb_hab,
												 $tipo,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);


$con_msal  = "Select count(*) From contab_mae_sal where CONTA_MSAL_CTA ='$cod_cta' and
              CONTA_MSAL_FEC_VAL = '$fec1' and CONTA_MSAL_USR_BAJA is null";
$res_msal = mysql_query($con_msal);
       $cta = "";  
       $fec = "";
	   $hay = 0;
	   $imp_d = 0;
	   $imp_h = 0;
	   $nro_d = 0;
	   $nro_h = 0;
	   
	 //  echo "Habia o no Reg.".$cod_cta." ".$fec1;
while ($lin_msal = mysql_fetch_array($res_msal)) {
       if (isset ($lin_msal['count(*)'])){
           $hay = $lin_msal['count(*)'];
		   }
//	   echo "hay" .$hay;
	   if (isset ($lin_msal['CONTA_MSAL_FEC_VAL'])){
           $fec = $lin_msal['CONTA_MSAL_FEC_VAL'];
		   }
	   if (isset ($lin_msal['CONTA_MSAL_IMP_D'])){
	       $imp_d = $lin_msal['CONTA_MSAL_IMP_D'];
		   $nro_d = $lin_msal['CONTA_MSAL_NRO_D'];
		   }
	   if (isset ($lin_msal['CONTA_MSAL_IMP_H'])){   
	       $imp_h = $lin_msal['CONTA_MSAL_IMP_H'];
	       $nro_h = $lin_msal['CONTA_MSAL_NRO_H'];
	       }
	   if ($hay > 0){
	      // echo "Actualiza Reg.";
		   $con_msald  = "Select * From contab_mae_sal where CONTA_MSAL_CTA ='$cod_cta' and
              CONTA_MSAL_FEC_VAL = '$fec1' and CONTA_MSAL_USR_BAJA is null";
           $res_msald = mysql_query($con_msald);
           $cta = "";  
           $fec = "";
	       $imp_d = 0;
	       $imp_h = 0;
	       $nro_d = 0;
	       $nro_h = 0;
	   
	 //  echo "Habia o no Reg.".$cod_cta." ".$fec1;
           while ($lin_msald = mysql_fetch_array($res_msald)) {
		   
	             if (isset ($lin_msald['CONTA_MSAL_FEC_VAL'])){
                    $fec = $lin_msald['CONTA_MSAL_FEC_VAL'];
		            }
	             if (isset ($lin_msald['CONTA_MSAL_IMP_D'])){
	                $imp_d = $lin_msald['CONTA_MSAL_IMP_D'];
		            $nro_d = $lin_msald['CONTA_MSAL_NRO_D'];
		            }
	             if (isset ($lin_msald['CONTA_MSAL_IMP_H'])){   
	                $imp_h = $lin_msald['CONTA_MSAL_IMP_H'];
	                $nro_h = $lin_msald['CONTA_MSAL_NRO_H'];
	                } 
				$consulta = "update contab_mae_sal set CONTA_MSAL_IMP_D = $imp_d + $i_deb,
					                                   CONTA_MSAL_IMP_H = $imp_h + $i_hab,
					                                   CONTA_MSAL_NRO_D = $nro_d + 1,
   				                                       CONTA_MSAL_NRO_H = $nro_h + 1 
													   where CONTA_MSAL_CTA ='$cod_cta' and
                                                             CONTA_MSAL_FEC_VAL = '$fec1' and 
															 CONTA_MSAL_USR_BAJA is null ";
                $resultado = mysql_query($consulta);	
										
		   }
		   
	       }else{
		  // echo "Nuevo Reg.";
		   $consulta = "insert into contab_mae_sal (CONTA_MSAL_AGEN, 
                                         CONTA_MSAL_CTA,
									     CONTA_MSAL_FEC_VAL,
									     CONTA_MSAL_FEC_TRAN,
									     CONTA_MSAL_IMP_D,
					                     CONTA_MSAL_IMP_H,
					                     CONTA_MSAL_NRO_D,
   				                         CONTA_MSAL_NRO_H,
					                     CONTA_MSAL_USR_ALTA, 
									     CONTA_MSAL_FCH_HR_ALTA, 
									     CONTA_MSAL_USR_BAJA, 
									     CONTA_MSAL_FCH_HR_BAJA
                                        ) values (30,
										         '$cod_cta',
												 '$fec1',
												 '$fec1',
												 $i_deb,
												 $i_hab,
												 $n_deb,
												 $n_hab,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta));
 	       } 
         }
       } 
	 ?>
<br><br>
<table width="85%"  border="1" cellspacing="1" cellpadding="1" align="center">
    <tr>
      <th width="8%" scope="col"><border="0" alt="" align="absmiddle" />FECHA  </th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />GLOSA</th>
	  <th width="5%" scope="col"><border="0" alt="" align="absmiddle" />Nro. CBTE</th>
	  <th width="8%" scope="col"><border="0" alt="" align="absmiddle" />DEBE Bs.</th>
	  <th width="8%" scope="col"><border="0" alt="" align="absmiddle" />HABER Bs.</th>
	  <th width="8%" scope="col"><border="0" alt="" align="absmiddle" />DEBE $us.</th>
	  <th width="8%" scope="col"><border="0" alt="" align="absmiddle" />HABER $us.</th>
	</tr>  
	<?php
	$con_cbt  = "Select CONTA_TRS_NRO,CONTA_TRS_GLOSA
	              From contab_trans where CONTA_TRS_TIPO = 2 
				  and CONTA_TRS_FEC_VAL = '$fec1' and CONTA_TRS_USR_BAJA is null group by 
				  CONTA_TRS_NRO,CONTA_TRS_GLOSA order by CONTA_TRS_NRO ";
    $res_cbt = mysql_query($con_cbt);
	while ($lin_cbt = mysql_fetch_array($res_cbt)) {
	      $nro_cbte =  $lin_cbt['CONTA_TRS_NRO'];
	      $glosa =  $lin_cbt['CONTA_TRS_GLOSA'];
	$con_cbte  = "Select CONTA_TRS_NRO, sum(CONTA_TRS_IMPO),sum(CONTA_TRS_IMPO_E)
	              From contab_trans where CONTA_TRS_TIPO = 2 and CONTA_TRS_NRO = $nro_cbte
				   and CONTA_TRS_DEB_CRED = 1
				  and CONTA_TRS_FEC_VAL = '$fec1' and CONTA_TRS_USR_BAJA is null group by 
				  CONTA_TRS_NRO order by CONTA_TRS_NRO ";
    $res_cbte = mysql_query($con_cbte);
	while ($lin_cbte = mysql_fetch_array($res_cbte)) {
	      $impo_1 = $lin_cbte['sum(CONTA_TRS_IMPO)'];
	      $impoe_1 = $lin_cbte['sum(CONTA_TRS_IMPO_E)'];
	} 
	$con_cbte  = "Select CONTA_TRS_NRO,sum(CONTA_TRS_IMPO),sum(CONTA_TRS_IMPO_E)
	              From contab_trans where CONTA_TRS_TIPO = 2 and CONTA_TRS_NRO = $nro_cbte
				   and CONTA_TRS_DEB_CRED = 2
				  and CONTA_TRS_FEC_VAL = '$fec1' and CONTA_TRS_USR_BAJA is null group by 
				  CONTA_TRS_NRO order by CONTA_TRS_NRO";
    $res_cbte = mysql_query($con_cbte);
	 while ($lin_cbte = mysql_fetch_array($res_cbte)) {
	      $impo_2 = $lin_cbte['sum(CONTA_TRS_IMPO)'];
	      $impoe_2 = $lin_cbte['sum(CONTA_TRS_IMPO_E)'];
	} 
	
	 
	?>
	 <tr>
	 	      <td align="left"><?php echo $fec; ?></td>
			  <td align="left"><?php echo $glosa; ?></td>
		      <td align="left"><?php echo $nro_cbte; ?></td>
		      <td align="right"><?php echo number_format($impo_1, 2, '.',',') ; ?></td>
		      <td align="right"><?php echo number_format($impo_2, 2, '.',','); ?></td>
		      <td align="right"><?php echo number_format($impoe_1, 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($impoe_2, 2, '.',','); ?></td>
	     </tr>
	<?php }  ?>
	
	</table>	
		
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

