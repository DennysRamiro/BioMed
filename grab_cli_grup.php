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
$log_usr = $_SESSION['login']; 
$datos = $_SESSION['form_buffer'];
$quecom = $_POST['cod_cliente'];
$nro_grup = $_SESSION['cod_g'];
for( $i=0; $i < count($quecom); $i = $i + 1 ) {
 if( isset($quecom[$i]) ) {
    $cod_c = $quecom[$i];
 }
}
if (validar_deu_grupo($cod_c,$nro_grup)) {
   echo "Cliente ya existe en la operacion <a href='cliente_con_g.php'>volver a Intentar</a><br>";
   return;
 }
$con_cli = "Select * From cliente_general where CLIENTE_COD = $cod_c and CLIENTE_USR_BAJA is null";
$res_cli = mysql_query($con_cli);
while ($linea = mysql_fetch_array($res_cli)){
$c_i = $linea['CLIENTE_COD_ID'];
$ccli = $linea['CLIENTE_COD']; 
$con_gdeu = "Select * From cred_grupo_mesa where CRED_GRP_MES_COD = $nro_grup and CRED_GRP_MES_USR_BAJA is null";
$res_gdeu = mysql_query($con_gdeu);
$nro_d = 0;
while ($lin_gdeu = mysql_fetch_array($res_gdeu)){
      $nro_d = $nro_d + 1;
	  }
if ($nro_d == 0 ){
   $rsol = 1;
  }
 if ($nro_d == 1 ){
   $rsol = 2;
  } 
 if ($nro_d > 1 ){
   $rsol = 3;
  } 
 }
 $_SESSION["alta_grab"] = 2;
 echo $_SESSION["alta_grab"];
$consulta  = "Insert into cred_grupo_mesa(CRED_GRP_MES_COD, CRED_GRP_MES_CLI, CRED_GRP_MES_REL, CRED_GRP_MES_USR_ALTA, CRED_GRP_MES_FCH_HR_ALTA, CRED_GRP_MES_USR_BAJA, CRED_GRP_MES_FCH_HR_BAJA) values 
($nro_grup,$ccli,$rsol,'$log_usr',null,null,'0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);
header('Location: grupo_mante_dir.php');
?>
<?php
}
ob_end_flush();
 ?>