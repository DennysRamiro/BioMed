<?php
ob_start();
session_start();
if(!isset($_SESSION['login']) || !isset($_SESSION['clave'])){
    header("Location: index.php?error=1");
} else {
   require('configuracion.php');
   require('funciones.php');
	if($_GET['accion'] == 'eliminarProv'){
		date_default_timezone_set('America/La_Paz');
		$fecha_actual  = date("y-m-d H:i:s");
		$idProveedor = $_GET['idProveedor'];
		$consulta = "UPDATE alm_proveedor  
					 SET 
								alm_prov_estado = '9',
								alm_prov_usr_baja = '".$_SESSION['login']."' ,
								alm_prov_fch_hr_baja = '".$fecha_actual."'
					 WHERE  alm_prov_id =".$idProveedor.";";
		$res = mysql_query($consulta);
		if($res){
			$msg = array('completo' => true);
		}else{
			$msg = array('completo' => false);
		}
		print_r(json_encode($msg));
	}
}
ob_end_flush();
?>