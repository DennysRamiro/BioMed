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
$cod_top = $_SESSION['producto'];
$c_grup = $_SESSION['c_grup'];
//$cod_prod = $_SESSION['producto'];
$_SESSION['cod_tipo'] = $cod_top;
$cod_mon = $_POST['cod_mon'];
$cod_pro = $_SESSION['producto'];
$cod_fpa = $_POST['cod_fpa'];
$cod_ofo = $_POST['cod_ofo'];
$cod_zon = $_POST['cod_zon'];
$cod_com = $_POST['cod_com'];
$cod_fco = $_POST['cod_ccom'];
$cod_cin = $_POST['cod_cin'];
$cod_pin = $_POST['cod_pin'];
//echo $cod_sol;
$log_usr =$_SESSION['login'];
//echo $log_usr;
$agen = $_POST["cod_agencia"];
$imp_s = $_POST["imp_sol"];
$aho_i = 0;
$tas_i = $_POST['tas_int'];
$aho_d = 0;
$plz_m = $_POST['plz_mes'];
$fec_d = $_POST["fec_des"];
$fec_1 = $_POST["fec_uno"];
$nro_c = $_POST["nro_cta"];
$hra_r = $_POST["hra_reu"];
$dir_r = $_POST["dir_reu"];

$dir_r = strtoupper ($dir_r); 
$mes = saca_mes_2($fec_1);
$dia = saca_dia_2($fec_1);
$anio = saca_anio_2($fec_1);
$dia_l = dia_semana($dia, $mes, $anio);
$_SESSION['dia_l'] = $dia_l;
$_SESSION['hra_reu'] = $hra_r;
$_SESSION['dir_reu'] = $dir_r;                                                                              
$cod_est = 3;
if ($cod_top == 3) {
  $cod_est = 2;
  } 
if (empty($imp_s)) {
    $error_d = 1;
    $_SESSION['msg_err'] = "Error en Importe Solicitado no puede estar vacio o cero";
	header('Location: solic_mante_op.php');
	}
if ($imp_s == 0) {
    $error_d = 1;
    $_SESSION['msg_err'] = "Error en Importe Solicitado no puede estar vacio o cero";
	}
if (empty($tas_i)) {
    $error_d = 1;
    $_SESSION['msg_err'] ="Error en Tasa Interes Anual no puede estar vacio";
	}
if ($tas_i < 0) {
    $error_d = 1;
    $_SESSION['msg_err'] ="Error en Tasa Interes Anual no puede ser menos de 20%";
	}	
if ($tas_i > 100) {
   $error_d = 1;
    $_SESSION['msg_err'] ="Error en Tasa Interes Anual no puede ser mas de 50% ";
	}
if (empty($aho_i)) {
   $aho_i = 0 ;
   }
if ($aho_i > 50) {
     $error_d = 1;
    $_SESSION['msg_err'] = "Error en Porcentaje Fondo Garantia Inicio no puede ser mas de 50% ";
	}
if (empty($aho_d)) {
    $aho_d = 0 ;
	}
if ($aho_d > 50) {
    $error_d = 1;
    $_SESSION['msg_err'] = "Error en Porcentaje Fondo Garantia Ciclo no puede ser mas de 50% ";
	}	
if (empty($plz_m)) {
    $error_d = 1;
    $_SESSION['msg_err'] = "Error plazo en meses no puede estar vacio";
	}
if ($plz_m < 0.01) {
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
if (empty($fec_d)) {
	 $error_d = 1;
    $_SESSION['msg_err'] = "Error en Fecha Desembolso no puede estar vacio o cero";
	}				
//if (valida_fecha($fec_d)) {
   $f_des = cambiaf_a_mysql($fec_d);
  // }else {
 //  $error_d = 1;
  // $_SESSION['msg_err'] = "Error en Fecha Desembolso no es valida";
 // }
if (empty($fec_1)) {
	 $error_d = 1;
    $_SESSION['msg_err'] = "Error en Fecha Primer Pago no puede estar vacio o cero";
	}				
//if (valida_fecha($fec_1)) {
    $f_uno = cambiaf_a_mysql($fec_1);
//	$dia = leer_dia($f_uno);
//	}else {
//	$error_d = 1;
 //   $_SESSION['msg_err'] = "Error en Fecha Primer Pago no es valida";
//	}
	echo "entra a grabar";
if ($f_uno <= $f_des){
   $error_d = 1;
    $_SESSION['msg_err'] ="Error en Fecha Primer Pago no puede ser menor o igual a Fecha Desembolso".$f_uno.$f_des; 
}
if (empty($hra_r)) {
   if ($cod_top < 3) {
      $error_d = 1;
      $_SESSION['msg_err'] = "Error en Hora Reunion no puede estar vacia por el Tipo de Operación";
    }
 } 
if (empty($dir_r)) {
   if ($cod_top < 3) {
      $error_d = 1;
      $_SESSION['msg_err'] = "Error en Dirección de Reunion no puede estar vacia por el Tipo de Operación";
   }
  } 
if ($error_d == 1) {
    $error_d = 0;
    header('Location: solic_mante_op.php');
    }else{
$r = "";
$nro_s = leer_nro_solic();
$n = strlen($nro_s);
$n2 = 4 - $n;
for ($i = 1; $i <= $n2; $i++) {
    $r = $r."0";
    }  
$nro_sol = "5".$agen.$r.$nro_s;
//echo $nro_sol;
$_SESSION['nro_sol'] = $nro_sol;
$_SESSION['cod_sol'] = $nro_sol;
$_SESSION['continuar'] = 3;
//$consulta  = "update cred_solicitud set CRED_SOL_COD_MON = $cod_mon, CRED_SOL_IMPORTE = $imp_s, CRED_SOL_PLZO_M = $p_mes, CRED_SOL_PLZO_D =$p_dias, CRED_SOL_PRODUCTO = $cod_pro, CRED_SOL_FORM_PAG = $cod_fpa, CRED_SOL_ORG_FON = $cod_ofo,CRED_SOL_ESTADO = 2  where CRED_SOL_CODIGO = $cod_sol  and CRED_SOL_USR_BAJA IS NULL";
$consulta = "insert into cred_solicitud    (CRED_SOL_CODIGO,
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
								   			$c_grup, 
								   			'$hra_r',
								    		'$dia_l', 
											'$dir_r', 
											'$f_des',
									 		'$f_uno',
									  		null,
									   		$cod_top,
									    	$imp_s,
										 	0,
										  	$cod_fco,
										   	$cod_mon,
										    $cod_ofo, 
											null,
											$plz_m, 
											$p_dias,
											$nro_c,
											$cod_fpa,
											null, 
											$tas_i,
											null,
											$cod_cin,
											$cod_com,
											null, 
											$aho_d,
											0,
										    $aho_i,
											$cod_pin, 
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
//if (($cod_top == 1) or ($cod_top == 2)){
 //    $_SESSION['continuar'] = 1 ;
 $_SESSION['oport'] = 1;
    header('Location:cliente_con_opo.php');
//	}
//if ($cod_top == 3) {
 //   header('Location:cliente_con_s.php');
//	}	
}
?>
<?php
}
    ob_end_flush();
 ?>