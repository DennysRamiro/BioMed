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
<title>Grabar Grupos Solidarios/Banca </title>
</head>
<body>
<?php
 $fec = leer_param_gral();
 $logi = $_SESSION['login'];
// $agen = $_SESSION['COD_AGENCIA']; 
?> 
<center>
<BR><br><br><br><br>
<strong> Grabar Grupos Solidarios/Banca</strong><br>
<br>
<?php
$_SESSION['form_buffer'] = $_POST;
$_SESSION['error'] = "";
$_SESSION['nom_grup'] =$_POST['nom_grup'];
$_SESSION['cod_ag'] =$_POST['cod_agencia'];	
$log_usr = $_SESSION['login']; 
$agen = $_SESSION['cod_ag'];
//$agen = 30;
$n_g = $_SESSION["nom_grup"];
echo $agen,$n_g;
$d_re = "";
/*if (empty($n_g)) {
    echo "Error Nombre de grupo no puede estar vacio <a href='grupo_mante_a.php'>volver a Intentar</a><br>";
	}*/
$n_g = strtoupper($n_g);
if (validar_grupo($n_g)) {
   $_SESSION['error'] = "Ya existe Grupo".encadenar(3).$n_g;
  // echo "Nombre de Grupo ya existe <a href='grupo_mante_a.php'>volver a Intentar</a><br>";
   header('Location: grupo_mante_a.php');
   return;
 }
//$fec_crea = $_POST["fec_crea"]; 
//if (empty($fec_crea)) {
//    echo "Error en Fecha Creación <a href='grupo_mante_a.php'>volver a Intentar</a><br>";
//}
//if (valida_fecha($fec_crea)) {
//    $f_crea = cambiaf_a_mysql($fec_crea);
//	}else {
//	echo "Error en Fecha Creacion <a href='grupo_mante_a.php'>volver a Intentar</a><br>";
//	}
$h_r = "";
//if (empty($h_r)) {
//    echo "Error Hora de reunion no puede estar vacio <a href='grupo_mante_a.php'>volver a Intentar</a><br>";
//	}	
$d_r = "";

//if (empty($d_r)) {
//    echo "Error Dirección de reunion no puede estar vacio <a href='grupo_mante_a.php'>volver a Intentar</a><br>";
//	}	
$ng = leer_nro_grupo();

$n = strlen($ng);
$n2 = 4 - $n;
for ($i = 1; $i <= $n2; $i++) {
    $r = $r."0";
    }  
$ngrup = "8".$agen.$r.$ng;
echo $ng,"numerico",$ngrup;
 $_SESSION["alta_grab"] = 2;
 $_SESSION["cod_g"] = $ngrup;
 $consulta  = "Insert into cred_grupo (CRED_GRP_CODIGO,CRED_GRP_NUMERICO,CRED_GRP_NOMBRE,CRED_GRP_FECHA,CRED_GRP_AGENCIA, CRED_GRP_DIA_REU, CRED_GRP_HRA_REU, CRED_GRP_DIR_REU, CRED_GRP_USR_ALTA,CRED_GRP_FCH_HR_ALTA, CRED_GRP_USR_BAJA,CRED_GRP_FCH_HR_BAJA) values 
($ngrup,$ng,'$n_g',null,$agen, null, null, null, '$log_usr',null,null,'0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);
header('Location: grupo_mante_dir.php');
?>
</body>
</html>
<?php
}
ob_end_flush();
 ?>