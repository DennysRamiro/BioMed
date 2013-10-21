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
$c_grp = $_SESSION['cod_g'];
$agen = $_POST["cod_agencia"];
$n_g = $_POST["nom_g"];
if (empty($n_g)) {
    header('Location: grupo_man_cm.php');
  //  echo "Error Nombre de grupo no puede estar vacio <a href='grupo_man_cm.php'>volver a Intentar</a><br>";
	}
$n_g = strtoupper($n_g);

  $marca_baja = "update cred_grupo set CRED_GRP_USR_BAJA='$log_usr', CRED_GRP_FCH_HR_BAJA=null where  
               CRED_GRP_CODIGO= $c_grp and  CRED_GRP_USR_BAJA is null";
  $res_mbaja = mysql_query($marca_baja);
  $consulta  = "Insert into cred_grupo (CRED_GRP_CODIGO,CRED_GRP_NOMBRE,CRED_GRP_FECHA,CRED_GRP_AGENCIA, CRED_GRP_DIA_REU, CRED_GRP_HRA_REU, CRED_GRP_DIR_REU, CRED_GRP_USR_ALTA,CRED_GRP_FCH_HR_ALTA, CRED_GRP_USR_BAJA,CRED_GRP_FCH_HR_BAJA) values 
($c_grp,'$n_g',null,$agen, null, null, null, '$log_usr',null,null,'0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);
 header('Location: grupo_mante.php');
}
 ob_end_flush();
?>


