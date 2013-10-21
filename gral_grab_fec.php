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
$_SESSION['msg_error'] = "";
$agen = $_POST["cod_agencia"];
$fec_proc = $_POST['fecha'];
$mes = saca_mes($fec_proc);
$dia = saca_dia($fec_proc);
$anio = saca_anio($fec_proc);
$dia_ing = dia_semana($dia, $mes, $anio);
echo $dia_ing;
//if (($dia_ing == "Sábado") or ($dia_ing == "Domingo")) {
 //   $_SESSION['msg_error'] = "Ingreso un día no habil";
 //   header('Location: gral_cam_fec.php');
//}else{
$agen =$_SESSION['COD_AGENCIA'];

$siguientedia  = mktime(0,0,0,date("$mes"),date("$dia")+ 1,date("$anio"));
$dia_p = $dia + 1;
$fecha_prox = date("Y-m-d", $siguientedia);
$dia_prox2 = dia_semana($dia_p, $mes, $anio);

//$f_prox = $anio."-".$mes."-".$dia_p;

//echo $dia_prox2. "dia_prox2".$f_prox."A".$anio."M".$mes."D".$dia_p."siguientedia".$fecha_prox;
if ($dia_prox2 == "Sábado") {
    $siguientedia  = mktime(0,0,0,date("$mes"),date("$dia")+ 3,date("$anio"));
	$fecha_prox = date("Y-m-d", $siguientedia);
//	$dia_p = $dia + 3;
//	$f_prox = $anio."-".$mes."-".$dia_p;
$dia_prox2 = dia_semana($dia_p, $mes, $anio);
 // echo "Proxima Fecha: ".date("d-m-Y", $siguientedia).$dia_prox2."<br>";
}




$logi = $_SESSION['login']; 
 
// if (valida_fecha($fec_proc)) {
    $f_proc = cambiaf_a_mysql($fec_proc);
	$f_ant = $_SESSION['f_proc'];
	//$f_prox = cambiaf_a_mysql($fec_proc);
	//$f_prox = 
    $consulta  = "Insert into gral_control_fecha (GRAL_AGENCIA_CODIGO,
	                                              GRAL_CTRL_FECHA_ANT,
	                                              GRAL_CTRL_FECHA_ACT,
												  GRAL_CTRL_FECHA_PROX,
												  GRAL_CTRL_FECHA_USR_ALTA,
												  GRAL_CTRL_FECHA_FEC_HR_ALTA,
												  GRAL_CTRL_FECHA_USR_BAJA,
												  GRAL_CTRL_FECHA_FEC_HR_BAJA)
										  values  ($agen,
										           '$f_ant',
										           '$f_proc',
												   '$fecha_prox',
												   '$logi',
												   null,
												   null,
												   '0000-00-00 00:00:00')";

$resultado = mysql_query($consulta);
 header('Location: menu_s.php');
//}
}
ob_end_flush();
?>


