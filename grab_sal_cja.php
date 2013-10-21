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
<?php
//echo "entra a grabar";
$_SESSION['form_buffer'] = $_POST;
$error_d = 0;
$_SESSION['msg_err'] = " ";
$log_usr = $_SESSION['login'];

if (isset($_SESSION['saldo'])){
    $sal_bs = $_SESSION['saldo'];
	}else{
	$sal_bs = 0;
	}
if (isset($_SESSION['saldo2'])){	
    $sal_us = $_SESSION['saldo2'];
	}else{
	$sal_us = 0;
	}
$log_usr =$_SESSION['login'];
$fec_p = $_SESSION['fec_p'];
 $ag_usr = $_SESSION['COD_AGENCIA'];
$t_cam = $_SESSION['TC_CONTAB'];
$fch_fin = $_SESSION['fch_fin'];
echo $_SESSION['fch_fin'];
$f_tra = cambiaf_a_mysql_2($fec_p);
echo $log_usr;
if ($sal_bs < 0) {
    $error_d = 1;
    $_SESSION['msg_err'] = "Error Saldo Bolivianos no puede ser negativo";
	}
if ($sal_us < 0) {
    $error_d = 1;
    $_SESSION['msg_err'] ="Error Saldo Dolares no puede ser negativo";
	}
if ($error_d == 1) {
    $error_d = 0;
    header('Location: cja_ini_saldo.php');
    }else{
	$nro_tra = leer_nro_co_cja(10000,$log_usr);
    for ($i=1; $i < 3; $i = $i + 1 ) {
        $_SESSION['nro_tra'] = $nro_tra;
        if ($i == 1){
           $imp =  $sal_bs;
           $eqv = $sal_bs;
           $t_tra = 1;
           $mon = 1;
           $ntra =$nro_tra + 1;
           }
        if ($i == 2){
           $imp =  $sal_us *$t_cam;
           $eqv = $sal_us;
           $t_tra = 1;
           $mon = 2;
           $ntra = $nro_tra + 1;
           }
//echo $nro_tra, $fec_p, $f_tra, $ntra, $mon,$imp,$eqv;
$consulta = "insert into caja_transac (CAJA_TRAN_NRO_COR, 
                                       CAJA_TRAN_AGE_CJRO,
									   CAJA_TRAN_AGE_ORG,
									   CAJA_TRAN_COD_SC,
									   CAJA_TRAN_FECHA,
					                   CAJA_TRAN_CAJERO1,
					                   CAJA_TRAN_APL_ORG,
   				                       CAJA_TRAN_TIPO_OPE,
					                   CAJA_TRAN_NRO_DOC, 
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
									   ) values ($ntra,
									             $ag_usr,
												 $ag_usr,
												 null,
												 '$f_tra',
												 '$log_usr',
												 10000,
												 $t_tra,
												 $nro_tra,
												 '$log_usr',
												 10000,
												 null,
												 null,
 											     null,
												 null,
												 null,
												 $imp,
												 $eqv,
												 $mon,
												 $t_cam,
												 'SALDO INICIAL',				 
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);
}
echo $fch_fin."esta fecha";
 
$con_cor = "SELECT * FROM caja_cortes where 
	            CAJA_COR_USR_ALTA =  '$log_usr' 
                and CAJA_COR_FECHA = '$fch_fin'
				and CAJA_COR_INI_FIN = 2
				 and CAJA_COR_USR_BAJA IS NULL";
    $res_cor = mysql_query($con_cor);
	//$sal_bs = 0; 
	//$sal_us = 0;
    while ($lin_cor = mysql_fetch_array($res_cor)) {
	       $cor_agen = $lin_cor['CAJA_COR_AGEN'];
		   $cor_caj = $lin_cor['CAJA_COR_CAJERO'];
		   $cor_mon = $lin_cor['CAJA_COR_MON'];
		   $cor_tip = $lin_cor['CAJA_COR_TIPO'];
		   $cor_cod = $lin_cor['CAJA_COR_CODIGO'];
		   $cor_can = $lin_cor['CAJA_COR_CANTIDAD'];
		   $cor_imp = $lin_cor['CAJA_COR_MONTO'];
		   echo $cor_agen." ".$ag_usr." ".$f_tra." ".
				$nro_tra." ".$cor_mon." ".$cor_tip." ".
				$cor_cod." ".$cor_can." ".$cor_mon." ".$log_usr;
		   $con_inser = "insert into caja_cortes (CAJA_COR_AGEN, 
                                                  CAJA_COR_CAJERO,
												  CAJA_COR_INI_FIN,
									              CAJA_COR_FECHA,
									              CAJA_COR_NRO_DOC,
									              CAJA_COR_MON,
					                              CAJA_COR_TIPO,
					                              CAJA_COR_CODIGO,
   				                                  CAJA_COR_CANTIDAD,
					                              CAJA_COR_MONTO, 
									              CAJA_COR_USR_ALTA,
                                                  CAJA_COR_FCH_HR_ALTA,
									              CAJA_COR_USR_BAJA,
									              CAJA_COR_FCH_HR_BAJA
									    ) values ($cor_agen,
									              '$log_usr',
												  1,
												  '$f_tra',
												  $nro_tra,
												  $cor_mon,
												  $cor_tip,
												  $cor_cod,
												  $cor_can,
												  $cor_imp,
												  '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$res_inser = mysql_query($con_inser);
    }
	
 $con_cajero = "insert into cajero (CAJERO_LOGIN, 
                                    CAJERO_FECHA,
									CAJERO_TRAN_CJA1,
									CAJERO_TRAN_CJA2,
									CAJERO_INI1,
					                CAJERO_INI2,
					                CAJERO_FIN1,
   				                    CAJERO_FIN2,
					                CAJERO_ESTADO, 
									CAJERO_USR_ALTA,
                                    CAJERO_FCH_HR_ALTA,
									CAJERO_USR_BAJA,
									CAJERO_FCH_HR_BAJA
									    ) values ('$log_usr',
									              '$f_tra',
												   $nro_tra,
												   0,
												   1,
												   1,
												   0,
												   0,
												   1,
												  '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$res_cajero = mysql_query($con_cajero);

$_SESSION['continuar'] = 1 ;
 header('Location: imp_sal_cja1.php');
	   	 
	} 
	

?>


<?php
}
ob_end_flush();
 ?>