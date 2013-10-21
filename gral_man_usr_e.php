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
 <title>ELIMINAR USUARIO</title>

  </head>
<body>
<?php
    include("header.php");

// Se realiza una consulta SQL a tabla gral_param_propios
//if(isset($_GET['cod_log'])){
   $log = $_GET['cod_log'];
   $_SESSION['cod_log'] = $log;


//echo  $log;
$con_usr = mysql_query("UPDATE gral_usuario SET GRAL_USR_USR_BAJA='".$_SESSION['login']."',GRAL_USR_FEC_HR_BAJA=CURRENT_TIMESTAMP
WHERE GRAL_USR_LOGIN='$log'") or die ('erooaa');




 ?>

		<script languaje="JavaScript">
		location.href='gral_man_usr_c.php';
		</script>
  </body>
</html>
<?php
}
ob_end_flush();
 ?>