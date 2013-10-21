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
$datos = $_SESSION['form_buffer'];
$quecom = $_POST['cod_cliente'];
$nro_sol = $_SESSION['nro_sol'];
		 echo $nro_sol;

for( $i=0; $i < count($quecom); $i = $i + 1 ) {
 if( isset($quecom[$i]) ) {
    $cod_c = $quecom[$i];
 }
}

//$baj_cli_sol = "update cred_deudor set CRED_DEU_USR_BAJA= '$log_usr', CRED_DEU_FCH_HR_BAJA = null where                 CRED_DEU_INTERNO = $cod_c and CRED_SOL_CODIGO = $nro_sol";
//$res_baj_cli_s = mysql_query($baj_cli_sol)or die('No pudo dar de baja cliente en solicitud: ' . mysql_error());

//baja cred_deudor
$baj_cli_sol = "update cred_deudor set CRED_DEU_USR_BAJA= '$log_usr', CRED_DEU_FCH_HR_BAJA = null where                 CRED_DEU_INTERNO = $cod_c and CRED_SOL_CODIGO = $nro_sol";
$res_baj_cli_s = mysql_query($baj_cli_sol));

//baja cred_plandp
$baj_cli_pld = "update cred_plandp set CRED_PLD_USR_BAJA = '$log_usr', CRED_PLD_FCH_HR_BAJA = null where                 CRED_PLD_COD_CLI = $cod_c and CRED_PLD_COD_SOL = $nro_sol";
$res_baj_pld = mysql_query($baj_cli_pld));




// require 'cliente_mante_a.php';
 header('Location: cliente_con_s2.php');


//echo "Cliente Agregado <a href='cliente_con_s.php'>volver a Consulta de Clientes</a>";
//echo "Volver a Solicitud ?<a href='solic_mante_aa.php'>Volver </a>";
}
?>


