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
$nro_cli = 0;
$_SESSION['form_buffer'] = $_POST;
$log_usr = $_SESSION['login']; 
$datos = $_SESSION['form_buffer'];
//$quecom = $_POST['cod_cliente'];
 $nro_ctf = leer_nro_ctafon(30);
 $agen = 30;
$r = ""; 
    $nro_ctf = leer_nro_ctafon($agen);
    $n = strlen($nro_ctf);
    $n2 = 4 - $n;
    for ($i = 1; $i <= $n2; $i++) {
        $r = $r."0";
      }  
    $nro_ctaf = "7".$agen.$r.$nro_ctf;
	$_SESSION['cta_aho'] =  $nro_ctaf;
$_SESSION['msg_error'] = "";
		// echo $nro_sol;
//for( $i=0; $i < count($quecom); $i = $i + 1 ) {
 //if( isset($quecom[$i]) ) {
    $cod_c = $_SESSION['cod_cli'];
 //}
//}
/*if (empty($cod_c)) {
    $_SESSION['msg_error'] = "Debe elegir un cliente";
	header('Location: cliente_con_s.php');
	return;
	}
if (validar_deu_solic($cod_c,$nro_sol)) {
   $_SESSION['msg_error'] = "Cliente ya existe en la ";
   header('Location: cliente_con_s.php');
   return;
  // echo "Cliente ya existe en la operacion <a href='cliente_con_s.php'>volver a Intentar</a><br>";
  // return;
 }
 $con_trc = "SELECT count(*) FROM cred_deudor where CRED_SOL_CODIGO = $nro_sol
              and CRED_DEU_USR_BAJA is null";
   $res_trc = mysql_query($con_trc)or die('No pudo seleccionarse tabla cred_deudor');
   while ($lin_trc = mysql_fetch_array($res_trc)) {
         $nro_cli =  $lin_trc['count(*)'];
      } 
 */
$cod_mon = $_POST['cod_mon'];
$_SESSION['cod_mon'] = $cod_mon;
$con_cli = "Select * From cliente_general where CLIENTE_COD = $cod_c and CLIENTE_USR_BAJA is null";
$res_cli = mysql_query($con_cli);
while ($linea = mysql_fetch_array($res_cli)){
$c_i = $linea['CLIENTE_COD_ID'];
$ccli = $linea['CLIENTE_COD']; 
if ($nro_cli == 0){
    $rsol = "C";
	}else{
	$rsol = "D";
  }	
 }
 // echo $csol,$rsol,$ccli,$c_i,$log_usr;
$consulta = "insert into fond_maestro (FOND_NRO_CTA,
                                         FOND_NUMERICO,
                                         FOND_NRO_CTA_ANT,
										 FOND_NRO_SOL,
										 FOND_NRO_CRED, 
										 FOND_COD_AGEN, 
										 FOND_COD_GRUPO, 
										 FOND_TIPO_OPER,
										 FOND_COD_MON,
										 FOND_PLZO_M, 
										 FOND_PLZO_D, 
										 FOND_TASA, 
										 FOND_TIP_COM, 
										 FOND_PRODUCTO, 
										 FOND_OFIC_RESP, 
										 FOND_FCH_CAN, 
										 FOND_ESTADO,
										 FOND_MAE_USR_ALTA, 
										 FOND_MAE_FCH_HR_ALTA, 
										 FOND_MAE_USR_BAJA, 
										 FOND_MAE_FCH_HR_BAJA) 
										 values ($nro_ctaf,
										         $nro_ctf,
										         null,
												 0,
												 0,
												 $agen, 
										         '', 
                                                 2,
                                                 $cod_mon,
                                                 0,
                                                 0,	
												 null,
												 null,
												 0,
												 '$log_usr',
												 null,
												 3,
												 '$log_usr', 
												 null, 
												 null, 
												'0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);
 $con_ccli = "insert into fond_cliente (FOND_CLI_NCTA, 
                                         FOND_CLI_SOL,
										 FOND_CLI_RELACION,
										 FOND_CLI_INTERNO, 
										 FOND_CLI_ID, 
										 FOND_CLI_USR_ALTA, 
										 FOND_CLI_FCH_HR_ALTA, 
										 FOND_CLI_USR_BAJA, 
										 FOND_CLI_FCH_HR_BAJA) 
										 values ($nro_ctaf,
										         0,
												 'T',
												 $ccli,
												 '$c_i',
												 '$log_usr', 
												 null, 
												 null, 
												'0000-00-00 00:00:00')";
$res_ccli = mysql_query($con_ccli); 
// require 'cliente_mante_a.php';
 header('Location: fga_imp_aper.php');
//echo "Cliente Agregado <a href='cliente_con_s.php'>volver a Consulta de Clientes</a>";
//echo "Volver a Solicitud ?<a href='solic_mante_aa.php'>Volver </a>";
?>
<?php
}
ob_end_flush();
 ?>