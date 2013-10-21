<?php
ob_start();
session_start();
if(!isset($_SESSION['login']) || !isset($_SESSION['clave'])){
    header("Location: index.php?error=1");
} else {
   require('configuracion.php');
   //require('funciones.php');
	if($_GET['tp'] == 'eliminarProd'){
		date_default_timezone_set('America/La_Paz');
		$fecha_actual  = date("y-m-d H:i:s");
		$idPrducto = $_GET['idPrducto'];
		$consulta = "UPDATE alm_producto 
					 SET 
							alm_prod_estado = '9',
							alm_prod_usr_baja = '".$_SESSION['login']."' ,
							alm_prod_fch_hr_baja = '".$fecha_actual."'
					 WHERE  alm_prod_id =".$idPrducto;
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