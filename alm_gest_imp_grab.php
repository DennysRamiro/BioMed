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
    //echo "prueba";
?>
<?php
$_SESSION['error'] = "";
$log_usr = $_SESSION['login']; 
//$fch_ini = $_POST["fec_ini"];
$fch_ini_doc = cambiaf_a_mysql($_POST["fec_ini"]);

$nro_doc = $_POST["nro_doc"];
$proy = $_POST["proy"];
$obs = $_POST["obs"];
$tipo = 2;
$fec_proc = cambiaf_a_mysql($_SESSION['fec_proc']);
date_default_timezone_set('America/La_Paz');
      $fecha_actual  = date("y-m-d H:i:s");

/*$tipo_proy="Select GRAL_PAR_PRO_COD
               From gral_param_propios 
               where GRAL_PAR_PRO_GRP = 1700 and GRAL_PAR_PRO_COD<>0 AND GRAL_PAR_PRO_COD= 2";

$res_imp = mysql_query($tipo_proy);

$res = mysql_fetch_array($res_imp);
echo $tipo;
$tipo = $res['GRAL_PAR_PRO_COD'];
*/
//echo $tipo."--".$fch_ini_doc."--".$log_usr."--".$nro_doc."--".$proy."--".$obs."--".$fec_proc;

$consulta ="insert into alm_form_importacion (
									
									alm_form_tipo,
									alm_form_nro_doc,
									alm_form_fecha_doc,
									alm_prov_id,
									alm_proy_cod,
									alm_age_adu_id,
									alm_form_fecha_registro,
									alm_form_observaciones,
									alm_form_usr_alta,
									alm_form_fch_hr_alta,
									alm_form_usr_baja,
									alm_from_monto_cert_var,
									alm_form_fch_baja
								)
							VALUES(
									'$tipo',
									'$nro_doc',
									'$fch_ini_doc',
									null,
									'$proy',
									null,
									'$fec_proc',
									'$obs',
									'$log_usr',
									'$fecha_actual',
									null,
									null,
									null
							)
			";

 $res_imp = mysql_query($consulta);


$actuaiza="UPDATE alm_proyecto SET alm_proy_estado=2 where alm_proy_cod='$proy'";

 $res_imp = mysql_query($actuaiza);


header('location: alm_gest_imp_alta.php');



?>
<?php
}
ob_end_flush();
 ?>