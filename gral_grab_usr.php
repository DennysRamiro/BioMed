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
		//echo 'llegando al formulario';
		$_SESSION["error"]="";
		$log_usr =$_POST["log"];
		//echo "$log_usr";
		$log_usr = strtolower($log_usr);
		if (validar_usuario($log_usr)) {

		   $_SESSION["error"] = "El Login de Usuario ya Existe";
		   header('Location: gral_man_usr_a.php');
		   return;
		   //echo "Login ya existe <a href='gral_man_usr_a.php'>volver a Intentar</a><br>";
		  // return;
 		}
/*if (empty($log_usr)) {
    echo "Error en Login no puede estar vacia <a href='gral_man_usr_a.php'>volver a Intentar</a><br>";*/
//	return;
/*}*/
$agen = $_POST["cod_agencia"];
//echo "$agen";
$c_i = $_POST["ci"];
//echo "$c_i";
/*if (empty($c_i)) {
    echo "Error en Carnet de Identidad no puede estar vacio <a href='gral_man_usr_a.php'>volver a Intentar</a><br>";
//	return;
}**/
$nom = $_POST["nombres"]; 
$nom = strtoupper($nom);
$a_pat = $_POST["ap_pater"];

$a_pat = strtoupper($a_pat);
//echo $a_pat;

if ($_POST["ap_mater"]!=" ") {
	$a_mat = $_POST["ap_mater"];
	$a_mat = strtoupper ($a_mat);
}else{
	$a_mat = null;
}
 
//echo "$a_mat";

$fec_nac = $_POST['fec_nac']; 
//echo "$fec_nac";
if (empty($fec_nac)) {
    $_SESSION["error"] = "Debe ingresar datos";
    //header('Location: gral_man_usr_a.php');
	//return;
} 
$dir = $_POST["direc"];
//echo "$dir"; 
$dir = strtoupper ($dir);
/*if (empty($dir)) {
    echo "Error en Direccion no puede estar vacio <a href='gral_man_usr_a.php'>volver a Intentar</a><br>";
	//return;
} */
//$fon = $_POST["fono"];

if ($_POST["fono"]!= " ") {

	$fon = $_POST["fono"];
}else{
	$fon = 0;
	echo "fomo:".$fon."<br>";
}
//echo "$fon"; 
/*if (empty($fon)) {
    echo "Error en Telefono no puede estar vacio <a href='gral_man_usr_a.php'>volver a Intentar</a><br>";
	//return;
}*/
//$cel = $_POST["celu"];

//$agen,$c_i ,$nom,$a_pat,$a_mat,$fec_nac,$dir,$fon, $cel,$pass ,$sec,$car,$e_m, $est,$logi, $f_nac


 if(isset($_POST["celu"])){ 
   $cel = $_POST["celu"]; 
   //echo "$cel";
   }else{
   $cel = 999;
   }   
/*if (empty($cel)) {
    echo "Error en Celular no puede estar vacio <a href='gral_man_usr_a.php'>volver a Intentar</a><br>";
//	return;
}*/

$pass =$_POST["clav"];
//echo "$pass";
/*if (empty($pass)) {
    echo "Error en Clave no puede estar vacia <a href='gral_man_usr_a.php'>volver a Intentar</a><br>";
//	return;
}*/
$sec = $_POST["cod_sec"]; 
//echo "$sec";
$car = $_POST["cod_car"]; 
//echo "$car";
$e_m = $_POST["email"];
//echo "$e_m";
$est = $_POST["cod_est"]; 
//echo "$est";
$logi = $_SESSION['login']; 
//echo "$logi";
//$_SESSION['form_buffer'] = $_POST;
//$datos = $_SESSION['form_buffer'];
// if (valida_fecha($fec_nac)) {
//echo $fec_nac, "fec_nac";
    $f_nac = cambiaf_a_mysql($fec_nac);



//echo $log_usr."<br>". $c_i."<br>".$pass ."<br>".$agen."<br>".$nom."<br>".$a_pat."<br>".$a_mat."<br>".$fec_nac."<br>".$dir."<br>".$fon."<br>". $cel."<br>".$e_m."<br>".$sec."<br>".$car."<br>". $est."<br>". $f_nac ;



//echo $f_nac, "f_nac";	
    $consulta  = "Insert into gral_usuario (GRAL_USR_LOGIN,GRAL_AGENCIA_CODIGO,GRAL_USR_CI, GRAL_USR_NOMBRES,GRAL_USR_AP_PATERNO,GRAL_USR_AP_MATERNO,GRAL_USR_CLAVE,GRAL_USR_FEC_NAC,GRAL_USR_SECTOR,GRAL_USR_CARGO,GRAL_USR_DIRECCION,GRAL_USR_TELEFONO,GRAL_USR_CELULAR,GRAL_USR_EMAIL,GRAL_USR_ESTADO,GRAL_USR_USR_ALTA,GRAL_USR_FEC_HR_ALTA,GRAL_USR_USR_BAJA,GRAL_USR_FEC_HR_BAJA) values 
('$log_usr',$agen, '$c_i', '$nom','$a_pat','$a_mat','$pass','$f_nac',$sec, $car, '$dir', $fon, $cel, '$e_m', $est, '$logi',null,null,'0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);

//Asigna permisos

$con_car  = "Select * From gral_permiso where GRAL_USR_LOGIN = $car "; 
   $res_car = mysql_query($con_car);
   while ($lin_car = mysql_fetch_array($res_car)) { // 5 a
          $cod_mod = $lin_car['GRAL_PER_COD_MOD'];
		  $cod_prg = $lin_car['GRAL_OPC_PRG_COD'];
		  $est = $lin_car['GRAL_USR_ESTADO'];
		 // $_SESSION['cod_sol'] = $cod_sol;
		  $con_cdeu = "insert into gral_permiso_usuario (GRAL_USR_LOGIN, 
                                         GRAL_PER_COD_MOD,
										 GRAL_OPC_PRG_COD,
										 GRAL_USR_ESTADO,
										 GRAL_PER_USR_ALTA, 
										 GRAL_PER_USR_FEC_HR_ALTA, 
										 GRAL_PER_USR_BAJA, 
										 GRAL_PER_USR_FEC_HR_BAJA) 
										 values ('$log_usr',
										         $cod_mod,
												 $cod_prg,
												 $est,
												 '$logi', 
												 null, 
												 null, 
												'0000-00-00 00:00:00')";
$res_cdeu = mysql_query($con_cdeu); 
		} 
		 
		 
		 
 // }
//Seleccion solicitud
//echo $cod_sol;

//require 'gral_man_usr.php';
//echo "Usuario Registrado <a href='gral_man_usr.php'>volver a Menu Mantenimiento Usuarios</a>";
//} else {
//echo "Error algun Dato <a href='gral_man_usr_a.php'>volver a Intentar</a>";
//}
header('Location: alta_con_mod.php?accion=7');

//header('Location: gral_man_usr_c.php?&msg=3');
?>
<?php
}
ob_end_flush();
 ?>