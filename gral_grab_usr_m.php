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
$log_usr = $_SESSION['cod_log'];
echo "Entra a Grabar  ";
$log_usr = strtolower($log_usr);
if (empty($log_usr)) {
    echo "Error en Login no puede estar vacia <a href='gral_man_usr_cm.php'>volver a Intentar</a><br>";
//	return;
}

$cod_a = $_SESSION['cod_a'];

$agen = $_POST["cod_agencia"];
$c_i = $_POST["ci"];
if (empty($c_i)) {
    echo "Error en Carnet de Identidad no puede estar vacio <a href='gral_man_usr_cm.php'>volver a Intentar</a><br>";
//	return;
}
$nom = $_POST["nombres"]; 
if (empty($nom)) {
    echo "Error en Nombres no puede estar vacio <a href='gral_man_usr_cm.php'>volver a Intentar</a><br>";
	//return;
}
$nom = strtoupper($nom);
$a_pat = $_POST["ap_pater"];
if (empty($a_pat)) {
    echo "Error en Apellido Paterno no puede estar vacio <a href='gral_man_usr_cm.php'>volver a Intentar</a><br>";
	//return;
} 
$a_pat = strtoupper($a_pat);
//echo $a_pat;
$a_mat = $_POST["ap_mater"]; 
$a_mat = strtoupper ($a_mat);
$fec_nac = $_POST['fec_nac']; 
if (empty($fec_nac)) {
    echo "Error en Fecha Nacimiento no puede estar vacio <a href='gral_man_usr_cm.php'>volver a Intentar</a><br>";
	//return;
} 
$dir = $_POST["direc"]; 
if (empty($dir)) {
    echo "Error en Direccion no puede estar vacio <a href='gral_man_usr_cm.php'>volver a Intentar</a><br>";
	//return;
} 
$fon = $_POST["fono"]; 
if (empty($fon)) {
    echo "Error en Telefono no puede estar vacio <a href='gral_man_usr_cm.php'>volver a Intentar</a><br>";
	//return;
}
$cel = $_POST["celu"]; 
if (empty($cel)) {
    echo "Error en Celular no puede estar vacio <a href='gral_man_usr_cm.php'>volver a Intentar</a><br>";
//	return;
}

$pass =$_POST["clav"]; 
if (empty($pass)) {
    echo "Error en Clave no puede estar vacia <a href='gral_man_usr_cm.php'>volver a Intentar</a><br>";
//	return;
}else{

//$pass = md5($pass);

}
$sec = $_POST["cod_sec"]; 
$car = $_POST["cod_car"]; 
$e_m = $_POST["email"]; 
$est = $_POST["cod_est"]; 
$logi = $_SESSION['login']; 
//$_SESSION['form_buffer'] = $_POST;
//$datos = $_SESSION['form_buffer'];
 if (valida_fecha($fec_nac)) {
    $f_nac = cambiaf_a_mysql($fec_nac);
	
	
	$marca_baja = "update gral_usuario set GRAL_USR_USR_BAJA='$logi', GRAL_USR_FEC_HR_BAJA=null where GRAL_USR_LOGIN= '$log_usr' ";
	$res_mbaja = mysql_query($marca_baja);
	echo $log_usr,$cod_a,$agen, $c_i, $nom,$a_pat,$a_mat,$pass,$f_nac,$sec, $car, $dir, $fon, $cel, $e_m, $est, $logi;
    $consulta  = "Insert into gral_usuario (GRAL_USR_LOGIN,
	                                        GRAL_USR_CODIGO,
											GRAL_AGENCIA_CODIGO,GRAL_USR_CI, GRAL_USR_NOMBRES,GRAL_USR_AP_PATERNO,GRAL_USR_AP_MATERNO,GRAL_USR_CLAVE,GRAL_USR_FEC_NAC,GRAL_USR_SECTOR,GRAL_USR_CARGO,GRAL_USR_DIRECCION,GRAL_USR_TELEFONO,GRAL_USR_CELULAR,GRAL_USR_EMAIL,GRAL_USR_ESTADO,GRAL_USR_USR_ALTA,GRAL_USR_FEC_HR_ALTA,GRAL_USR_USR_BAJA,GRAL_USR_FEC_HR_BAJA) values 
('$log_usr',$cod_a,$agen, '$c_i', '$nom','$a_pat','$a_mat','$pass','$f_nac',$sec, $car, '$dir', $fon, $cel, '$e_m', $est, '$logi',null,null,'0000-00-00 00:00:00')";

$resultado = mysql_query($consulta);
//require 'gral_man_usr.php';
header('Location: gral_man_usr_c.php');
} else {
header('Location: gral_man_usr_cm.php');
}
?>
<?php
}
ob_end_flush();
 ?>


