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
$log_usr = $_SESSION['login'];
$cod_s = $_SESSION["cod_sol"];
$_SESSION['nro_sol'] = $cod_s;
$numer = $_SESSION['corre'];
$mod = 0;
$error_d = 0;
$f_des = "";
$f_uno = "";
$cod_pro = 0; 
$_SESSION['msg_err'] = " ";
//$_SESSION['form_buffer'] = $_POST;
//$log_usr = $_SESSION['login'];
$cod_top = $_POST['tip_ope'];
$_SESSION['cod_tipo'] = $cod_top;
$cod_mon = $_POST['cod_mon'];
if (isset($_SESSION['producto'])){  
    $cod_pro = $_SESSION['producto'];
	}
$cod_fpa = $_POST['cod_fpa'];
$cod_ofo = $_POST['cod_ofo'];
$cod_zon = $_POST['cod_zon'];
$cod_com = $_POST['cod_com'];
$cod_cin = $_POST['cod_cin'];
$cod_fco = $_POST['cod_ccom'];
$cod_pin = $_POST['cod_pin'];
//echo $log_usr;
$agen = $_POST["cod_agencia"];
$imp_s = $_POST['imp_sol'];
$aho_i = $_POST['aho_ini'];
$tas_i = $_POST['tas_int'];
$aho_d = $_POST['aho_dur'];
$plz_m = $_POST['plz_mes'];
$fec_d = $_POST["fec_des"];
$fec_1 = $_POST["fec_uno"];
$nro_c = $_POST["nro_cta"];
$hra_r = $_POST["hra_reu"];
$dir_r = $_POST["dir_reu"];
$dir_r = strtoupper ($dir_r);
$mes = saca_mes($fec_1);
$dia = saca_dia($fec_1);
$anio = saca_anio($fec_1);
$dia_l = dia_semana($dia, $mes, $anio);
echo $dia_l, $fec_d,$fec_1 ;
$_SESSION['dia_l'] = $dia_l;
$_SESSION['hra_reu'] = $hra_r;
$_SESSION['dir_reu'] = $dir_r;
$cod_est = 1;
$_SESSION['msg_err'] = "";
//echo $imp_s, $aho_i, $tas_i, $aho_d, $plz_m;
if ($cod_top == 3) {
  $cod_est = 2;
  } 
if (empty($imp_s)) {
    $error_d = 1;
    $_SESSION['msg_err'] = "Error en Importe Solicitado no puede estar vacio o cero";
	}
if ($imp_s == 0) {
    $error_d = 1;
    $_SESSION['msg_err'] = "Error en Importe Solicitado no puede estar vacio o cero";
	}
if (empty($tas_i)) {
    $error_d = 1;
    $_SESSION['msg_err'] ="Error en Tasa Interes Anual no puede estar vacio";
	}
if ($tas_i < 20) {
    $error_d = 1;
    $_SESSION['msg_err'] ="Error en Tasa Interes Anual no puede ser menos de 20%";
	}	
if ($tas_i > 99) {
   $error_d = 1;
    $_SESSION['msg_err'] ="Error en Tasa Interes Anual no puede ser mas de 99% ";
	}
if (empty($aho_i)) {
   $aho_i = 0 ;
  // $error_d = 0;
  // $_SESSION['msg_err'] = " ";
   }
if ($aho_i > 50) {
     $error_d = 1;
    $_SESSION['msg_err'] = "Error en Porcentaje Fondo Garantia Inicio no puede ser mas de 50% ";
	}
if (empty($aho_d)) {
    $aho_d = 0 ;
	//$error_d = 0;
   // $_SESSION['msg_err'] = " ";
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
$p_dias = round($plz_m * 30,0);
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
 //   $f_des = cambiaf_a_mysql_2($fec_d);
//	}else {
//	$error_d = 1;
 //   $_SESSION['msg_err'] = "Error en Fecha Desembolso no es valida";
//	}
if (empty($fec_1)) {
	 $error_d = 1;
    $_SESSION['msg_err'] = "Error en Fecha Primer Pago no puede estar vacio o cero";
	}				
//if (valida_fecha_2($fec_1)) {
//    $f_uno = cambiaf_a_mysql_2($fec_1);
//	}else {
//	$error_d = 1;
 //   $_SESSION['msg_err'] = "Error en Fecha Primer Pago no es valida";
//	}
$nro_dias = nro_dias($fec_d ,$fec_1);
 
echo $fec_1,"*****", $fec_d,"***",$nro_dias;
if ($nro_dias < 0){
   $error_d = 1;
    $_SESSION['msg_err'] = "Error en Fecha Primer Pago no puede ser menor o igual a Fecha Desembolso aqui". $fec_d." ".$fec_1.
	"***".$nro_dias  ; 
}
if ($hra_r == "") {
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
    header('Location: solic_mante_mod.php');
    }else{
//echo $cod_s;
//if ($error_d == 0) {
$con_sol  = "Select * From cred_solicitud where CRED_SOL_CODIGO = $cod_s and CRED_SOL_USR_BAJA is null"; 
$res_sol = mysql_query($con_sol);
while ($lin_sol = mysql_fetch_array($res_sol)) {
       $fec_d = $_POST["fec_des"];
	   $f_des = cambiaf_a_mysql_2($fec_d);
	   $fec_1 = $_POST["fec_uno"];
       $f_uno = cambiaf_a_mysql_2($fec_1);
	   $nro_corr = $lin_sol["CRED_SOL_NUMERICO"];
      if ($_POST['cod_zon'] <> $lin_sol["CRED_SOL_ZONA"]){
         echo "entra 1";
         $mod = $mod + 1;
         }
      if ($_POST['tip_ope'] <> $lin_sol["CRED_SOL_TIPO_OPER"]){
         $mod = $mod + 1;
         echo "entra 2";
         } 
      if ($_POST['cod_mon'] <> $lin_sol["CRED_SOL_COD_MON"]){
         $mod = $mod + 1;
         echo "entra 3";
         } 
      if ($_POST['imp_sol'] <> $lin_sol["CRED_SOL_IMPORTE"]){
         $mod = $mod + 1;
         echo "entra 4";
         } 
	if (isset($_POST['cod_pro'])){  	 
      if ($_POST['cod_pro'] <> $lin_sol["CRED_SOL_PRODUCTO"]){
         $mod = $mod + 1;
         echo "entra 5";
         }  
		}
      if ($_POST['tas_int'] <> $lin_sol["CRED_SOL_TASA"]){
         $mod = $mod + 1;
         echo "entra 6";
         } 
      if ($_POST['plz_mes'] <> $lin_sol["CRED_SOL_PLZO_M"]){
         $mod = $mod + 1;
         echo "entra 7";
         }     
      if ($_POST['cod_fpa'] <> $lin_sol["CRED_SOL_FORM_PAG"]){
         $mod = $mod + 1;
         echo "entra 8";
         }
      if ($_POST['cod_ofo'] <> $lin_sol["CRED_SOL_ORG_FON"]){
         $mod = $mod + 1;
         echo "entra 9"; 
         }  
      if ($_POST['cod_com'] <> $lin_sol["CRED_SOL_TIP_COM"]){
         $mod = $mod + 1;
         echo "entra 10";
         }  
      if ($_POST['aho_dur'] <> $lin_sol["CRED_SOL_AHO_DUR"]){
         $mod = $mod + 1;
         echo "entra 11";
         }    
      if ($_POST['aho_ini'] <> $lin_sol["CRED_SOL_AHO_INI"]){
         $mod = $mod + 1;
         echo "entra 12";
         }
      if ($_POST['cod_cin'] <> $lin_sol["CRED_SOL_CAL_INT"]){
         $mod = $mod + 1;
         echo "entra 13";
         } 
		 
	  if ($_POST["nro_cta"] <> $lin_sol['CRED_SOL_NRO_CTA']){
         $mod = $mod + 1;
         echo "entra 14";
         } 
	if (isset($f_des)){  	 
      if ($f_des <> $lin_sol['CRED_SOL_FEC_DES']){
         $mod = $mod + 1;
         echo "entra 15";
         } 
	 }
	 if (isset($f_uno)){ 
	 if ($f_uno <> $lin_sol['CRED_SOL_FEC_UNO']){
         $mod = $mod + 1;
         echo "entra 16";
         } 
	}
	  if ($hra_r <> $lin_sol['CRED_SOL_HRA_REU']){
             $mod = $mod + 1;
             echo "entra 17";
         } 
	  if ($dir_r <> $lin_sol['CRED_SOL_DIR_REU']){
             $mod = $mod + 1;
             echo "entra 18";
         } 
		  if ($_POST['cod_ccom'] <> $lin_sol["CRED_SOL_COM_F"]){
         $mod = $mod + 1;
         echo "entra 19";
         }  
     }

// Se hicieron cambios ???
//echo "modif ".$mod;
if ($mod > 0 ) {
$act_solic  = "update cred_solicitud set CRED_SOL_USR_BAJA = '$log_usr', CRED_SOL_FCH_HR_BAJA = null where CRED_SOL_CODIGO = $cod_s and CRED_SOL_USR_BAJA IS NULL";
$res_act = mysql_query($act_solic);
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
										 CRED_SOL_FCH_HR_BAJA) values 
										 ($cod_s,
										  $nro_corr,
										  $agen,
										  null,
										  null,
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
$_SESSION['continuar'] = 3;
  }
if (($cod_top == 1) or ($cod_top == 2)){
     $_SESSION['continuar'] = 1 ;
    header('Location:grupo_con_m_sol.php');
	}
if ($cod_top == 3) {
    header('Location:cliente_con_s.php');
	}	
}
?>
<?php
}
ob_end_flush();
 ?>



