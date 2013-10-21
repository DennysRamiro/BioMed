<?php
ob_start();
session_start();
if(!isset($_SESSION['login']) || !isset($_SESSION['clave'])){
    header("Location: index.php?error=1");
} else {
   require('configuracion.php');
   require('funciones.php');




	if($_GET['tu'] == 'eliminaUser'){


		date_default_timezone_set('America/La_Paz');
		$fecha_actual  = date("y-m-d H:i:s");
		$ci = $_GET['ci'];
		echo $_post[''];


		$consulta= "UPDATE gral_usuario 
                    SET  GRAL_USR_USR_BAJA='".$_SESSION['login']."', GRAL_USR_FEC_HR_BAJA='".$fecha_actual."',GRAL_USR_ESTADO = '2'  
                    WHERE GRAL_USR_CI='".$ci."'";

$res = mysql_query($consulta);


         //echo $consulta;
		
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