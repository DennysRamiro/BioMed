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
$_SESSION["alta_grab"] = 2;
$log_usr = $_SESSION['login']; 
$c_grp = $_SESSION["cod_g"];
//echo $c_grp;
$r_car1 = $_POST["cod_cargo1"];
$r_car2 = $_POST["cod_cargo2"];
$r_car3 = $_POST["cod_cargo3"];
$r_car4 = $_POST["cod_cargo4"];
$r_car5 = $_POST["cod_cargo5"];
//echo count($r_car1),count($r_car2), count($r_car3),count($r_car4),count($r_car5);
for( $i=0; $i < count($r_car1); $i = $i + 1 ) {
 if( isset($r_car1[$i]) ) {
    $cod_car1 = $r_car1[$i];
	$c_cli1 = $_SESSION["cod_cli1"];
	$marca_car1 = "update cred_grupo_mesa set CRED_GRP_MES_REL=$cod_car1 where CRED_GRP_MES_COD= $c_grp and CRED_GRP_MES_CLI =$c_cli1 and CRED_GRP_MES_USR_BAJA is null";
 $res_mcar = mysql_query($marca_car1);
 	 }
}
for( $i=0; $i < count($r_car2); $i = $i + 1 ) {
 if( isset($r_car2[$i]) ) {
    $cod_car2 = $r_car2[$i];
 	$c_cli2 = $_SESSION["cod_cli2"];
	$marca_car2 = "update cred_grupo_mesa set CRED_GRP_MES_REL=$cod_car2 where CRED_GRP_MES_COD= $c_grp and CRED_GRP_MES_CLI =$c_cli2 and CRED_GRP_MES_USR_BAJA is null";
 $res_mcar = mysql_query($marca_car2);
 }
}
for( $i=0; $i < count($r_car3); $i = $i + 1 ) {
 if( isset($r_car3[$i]) ) {
    $cod_car3 = $r_car3[$i];
    $c_cli3 = $_SESSION["cod_cli3"];
	$marca_car3 = "update cred_grupo_mesa set CRED_GRP_MES_REL=$cod_car3 where CRED_GRP_MES_COD= $c_grp and CRED_GRP_MES_CLI =$c_cli3 and  CRED_GRP_MES_USR_BAJA is null";
 $res_mcar = mysql_query($marca_car3);
 }
}
for( $i=0; $i < count($r_car4); $i = $i + 1 ) {
 if( isset($r_car4[$i]) ) {
    $cod_car4 = $r_car4[$i];
    $c_cli4 = $_SESSION["cod_cli4"];
	$marca_car4 = "update cred_grupo_mesa set CRED_GRP_MES_REL=$cod_car4 where CRED_GRP_MES_COD= $c_grp and CRED_GRP_MES_CLI =$c_cli4 and CRED_GRP_MES_USR_BAJA is null";
 $res_mcar = mysql_query($marca_car4);
 }
}
for( $i=0; $i < count($r_car5); $i = $i + 1 ) {
 if( isset($r_car5[$i]) ) {
    $cod_car5 = $r_car5[$i];
    $c_cli5 = $_SESSION["cod_cli5"];
	$marca_car1 = "update cred_grupo_mesa set CRED_GRP_MES_REL=$cod_car5 where CRED_GRP_MES_COD= $c_grp and CRED_GRP_MES_CLI =$c_cli5 and CRED_GRP_MES_USR_BAJA is null";
 $res_mcar = mysql_query($marca_car5);
 }
}
header('Location: grupo_mante_dir.php');
?>
<?php
}
ob_end_flush();
 ?>