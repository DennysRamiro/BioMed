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
$cod_cre = $_SESSION["cod_cre"];
$_SESSION['msg_error'] = "";
		// echo $nro_sol;

for( $i=0; $i < count($quecom); $i = $i + 1 ) {
 if( isset($quecom[$i]) ) {
    $cod_c = $quecom[$i];
 }
}
if (empty($cod_c)) {
    $_SESSION['msg_error'] = "Debe elegir un cliente";
	header('Location: cliente_con_s.php');
	return;
	}


if (validar_deu_cred($cod_c,$cod_cre)) {
   $_SESSION['msg_error'] = "Cliente ya existe en el Credito ".$cod_cre;
   header('Location: cliente_con_sad.php');
   return;
  // echo "Cliente ya existe en la operacion <a href='cliente_con_s.php'>volver a Intentar</a><br>";
  // return;
 }
if (validar_deu_solic($cod_c,$nro_sol)) {
   $_SESSION['msg_error'] = "Cliente ya existe en la Solicitud ";
   header('Location: cliente_con_sad.php');
   return;
  // echo "Cliente ya existe en la operacion <a href='cliente_con_s.php'>volver a Intentar</a><br>";
  // return;
 }


$con_cli = "Select * From cliente_general where CLIENTE_COD = $cod_c and CLIENTE_USR_BAJA is null";
$res_cli = mysql_query($con_cli);

while ($linea = mysql_fetch_array($res_cli)){
$c_i = $linea['CLIENTE_COD_ID'];
$ccli = $linea['CLIENTE_COD']; 

$rsol = "D";
 }
 
 // echo $csol,$rsol,$ccli,$c_i,$log_usr;
$consulta  = "Insert into cred_deudor(CRED_SOL_CODIGO, CRED_DEU_RELACION, CRED_DEU_INTERNO, CRED_DEU_ID, CRED_DEU_IMPORTE,CRED_DEU_COMISION, CRED_DEU_AHO_INI, CRED_DEU_AHO_DUR, CRED_DEU_INT_CTA, CRED_DEU_USR_ALTA, CRED_DEU_FCH_HR_ALTA, CRED_DEU_USR_BAJA, CRED_DEU_FCH_HR_BAJA) values 
($nro_sol,'$rsol',$ccli,'$c_i',0,0,0,0,0,'$log_usr',null,null,'0000-00-00 00:00:00')";

$resultado = mysql_query($consulta);
// require 'cliente_mante_a.php';
 header('Location: cliente_con_sad.php');


//echo "Cliente Agregado <a href='cliente_con_s.php'>volver a Consulta de Clientes</a>";
//echo "Volver a Solicitud ?<a href='solic_mante_aa.php'>Volver </a>";

?>
<?php
}
ob_end_flush();
 ?>



