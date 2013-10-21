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

$_SESSION['form_buffer'] = $_POST;
$error_d = 0;
$_SESSION['msg_err'] = " ";
$log_usr = $_SESSION['login'];
$cod_c = $_SESSION["cod_cre"];
$cod_pro = $_SESSION['producto'];
//$cod_top = $_POST['tip_ope'];
$_SESSION['cod_tipo'] = $cod_top;
$agen = $_POST["cod_agencia"];
$imp_s = $_POST["imp_sol"];
$plz_m = $_POST['plz_mes'];
$fec_d = $_POST["fec_des"];
$fec_1 = $_POST["fec_uno"];
$nro_c = $_POST["nro_cta"];
$cod_est = 2;
$con_sol  = "Select * From cred_solicitud where CRED_SOL_NRO_CRED = $cod_c and CRED_SOL_USR_BAJA is null"; 
$res_sol = mysql_query($con_sol);
while ($lin_sol = mysql_fetch_array($res_sol)) {
      $agen = $lin_sol['CRED_SOL_COD_AGE'];
      $grupo = $lin_sol['CRED_SOL_COD_GRUPO'];
	  $hra_r = $lin_sol['CRED_SOL_HRA_REU'];
	  $dia_r = $lin_sol['CRED_SOL_DIA_REU'];
	  $dir_r = $lin_sol['CRED_SOL_DIR_REU'];
	  $cod_mon = $lin_sol['CRED_SOL_COD_MON'];
	  $cod_top = $lin_sol['CRED_SOL_TIPO_OPER'];
	  $org_fo = $lin_sol['CRED_SOL_ORG_FON'];
	  $for_pa = $lin_sol['CRED_SOL_FORM_PAG'];
	  $cod_fco = $lin_sol['CRED_SOL_COM_F'];
	  $t_int = $lin_sol['CRED_SOL_TASA'];
	  $p_int = $lin_sol['CRED_SOL_AHO_F']; 
	  $c_int = $lin_sol['CRED_SOL_CAL_INT'];
	  $t_com = $lin_sol['CRED_SOL_TIP_COM'];
	  $a_dur = $lin_sol['CRED_SOL_AHO_DUR'];
	  $a_ini = $lin_sol['CRED_SOL_AHO_INI'];
	  $cod_com = $lin_sol['CRED_SOL_TIP_COM'];
	  $cod_zon = $lin_sol['CRED_SOL_ZONA'];
	 }   
if (empty($imp_s)) {
    $error_d = 1;
    $_SESSION['msg_err'] = "Error en Importe Solicitado no puede estar vacio o cero";
	}
if ($imp_s == 0) {
    $error_d = 1;
    $_SESSION['msg_err'] = "Error en Importe Solicitado no puede estar vacio o cero";
	}
if (empty($plz_m)) {
    $error_d = 1;
    $_SESSION['msg_err'] = "Error plazo en meses no puede estar vacio";
	}
if ($plz_m < 1) {
    $error_d = 1;
    $_SESSION['msg_err'] = "Error plazo en meses no puede ser Cero";
	}
$p_dias = $plz_m * 30;
if (empty($nro_c)) {
   $error_d = 1;
   $_SESSION['msg_err'] = "Error en Numero de Cuotas no puede estar vacio o cero";
	}
if ($nro_c == 0) {
    $error_d = 1;
    $_SESSION['msg_err'] = "Error en Numero de Cuotas no puede estar vacio o cero";
	}
//if (empty($fec_d)) {
//	 $error_d = 1;
//    $_SESSION['msg_err'] = "Error en Fecha Desembolso no puede estar vacio o cero";
//	}				
//if (valida_fecha($fec_d)) {
 
   $f_des = cambiaf_a_mysql($fec_d);

 //  }else {
  // $error_d = 1;
  // $_SESSION['msg_err'] = "Error en Fecha Desembolso no es valida";
  // }

//if (empty($fec_1)) {
//	 $error_d = 1;
//    $_SESSION['msg_err'] = "Error en Fecha Primer Pago no puede estar vacio o cero";
//	}				
//if (valida_fecha($fec_1)) {

    $f_uno = cambiaf_a_mysql_2($fec_1);

   	
//	$dia = leer_dia($f_uno);
//	}else {
//	$error_d = 1;
//    $_SESSION['msg_err'] = "Error Fecha Primer Pago no es valida";
//	}
if ($f_uno <= $f_des){
   $error_d = 1;
    $_SESSION['msg_err'] ="Error en Fecha Primer Pago no puede ser menor o igual a Fecha Desembolso".$f_uno.$f_des; 
}
if ($error_d == 1) {
    $error_d = 0;
    header('Location: solic_mante_ad.php');
    }else{
$r = "";
$nro_s = leer_nro_solic();
$n = strlen($nro_s);
$n2 = 4 - $n;
for ($i = 1; $i <= $n2; $i++) {
    $r = $r."0";
    }  
$nro_sol = "5".$agen.$r.$nro_s;	
//$nro_sol = leer_nro_solic();
$_SESSION['nro_sol'] = $nro_sol;
$_SESSION['cod_sol'] = $nro_sol;
$_SESSION['continuar'] = 3;
echo $nro_sol," ", $nro_s," ", $agen,"  ", null," ", $grupo, " ", $hra_r,
												  $dia_r, 
												  $dir_r, 
												  $f_des,
												  $f_uno,
												  null,
												  $cod_top,
												  $imp_s;
												   
//$consulta  = "update cred_solicitud set CRED_SOL_COD_MON = $cod_mon, CRED_SOL_IMPORTE = $imp_s, CRED_SOL_PLZO_M = $p_mes, CRED_SOL_PLZO_D =$p_dias, CRED_SOL_PRODUCTO = $cod_pro, CRED_SOL_FORM_PAG = $cod_fpa, CRED_SOL_ORG_FON = $cod_ofo,CRED_SOL_ESTADO = 2  where CRED_SOL_CODIGO = $cod_sol  and CRED_SOL_USR_BAJA IS NULL";
$consulta = "insert into cred_solicitud (CRED_SOL_CODIGO,
                                         CRED_SOL_NUMERICO, 
										 CRED_SOL_COD_AGE,
                                         CRED_SOL_NRO_CRED,
										 CRED_SOL_COD_GRUPO,
										 CRED_SOL_HRA_REU,
										 CRED_SOL_DIA_REU,
										 CRED_SOL_DIR_REU,
										 CRED_SOL_FEC_DES,
										 CRED_SOL_FEC_UNO,
										 CRED_SOL_TIPO_CRED,
										 CRED_SOL_TIPO_OPER,
										 CRED_SOL_IMPORTE,
										 CRED_SOL_IMP_COM,
										 CRED_SOL_COM_F,
										 CRED_SOL_COD_MON,
										 CRED_SOL_ORG_FON,
										 CRED_SOL_DESTINO,
										 CRED_SOL_PLZO_M,
										 CRED_SOL_PLZO_D,
										 CRED_SOL_NRO_CTA,
										 CRED_SOL_FORM_PAG,
										 CRED_SOL_NRO_LINEA,
										 CRED_SOL_TASA,
										 CRED_SOL_DIF_TASA,
										 CRED_SOL_CAL_INT,
										 CRED_SOL_TIP_COM, 
										 CRED_SOL_PER_GRA,
										 CRED_SOL_AHO_DUR,
										 CRED_SOL_AHO_DM,
										 CRED_SOL_AHO_INI,
										 CRED_SOL_AHO_F,
										 CRED_SOL_PRODUCTO,
										 CRED_SOL_SECTOR,
										 CRED_SOL_SUB_SECTOR,
										 CRED_SOL_DEPTO,
										 CRED_SOL_PROV,
										 CRED_SOL_CANTON, 
										 CRED_SOL_MES_NEG,
										 CRED_SOL_MES_REC,
										 CRED_SOL_OF_RESP, 
										 CRED_SOL_ZONA,
										 CRED_SOL_USR_AUT,
										 CRED_SOL_ESTADO,
										 CRED_SOL_USR_ALTA,
										 CRED_SOL_FCH_HR_ALTA, 
										 CRED_SOL_USR_BAJA,
										 CRED_SOL_FCH_HR_BAJA)
										  values ($nro_sol,
										          $nro_s,
								  			      $agen,
										          null,
												  $grupo,
												  '$hra_r',
												  '$dia_r', 
												  '$dir_r', 
												  '$f_des',
												  '$f_uno',
												  null,
												  $cod_top,
												  $imp_s,
												  0, 
												  $cod_fco,
												  $cod_mon,
												  $org_fo,
												  null,
												  $plz_m, 
												  $p_dias,
												  $nro_c,
												  $for_pa,
												  null,
												  $t_int,
												  null,
												  $c_int,
												  $cod_com,
												  null,
												  $a_dur,
												  0,
												  $a_ini,
												  $p_int,
												  $cod_pro,
												  null,
												  null,
												  null,
												  null,
												  null,
												  null,
												  null,
												  '$log_usr',
												  $cod_zon,
												  null,
												  $cod_est,
												  '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";

$resultado = mysql_query($consulta);
 header('Location:cliente_con_sad.php');
}
?>
<?php
}
ob_end_flush();
 ?>