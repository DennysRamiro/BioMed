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
$nro = 0;
$con_mcre  = "Select * From mig_cliente where tipo_ci = 0 "; 
$res_mcre = mysql_query($con_mcre);
   while ($lin_mcre = mysql_fetch_array($res_mcre)) {
          $gar_codi = $lin_mcre['codigo'];
		  $gar_ci = $lin_mcre['ci'];
		  $nro = $nro + 1;
		   echo $gar_codi,$gar_ci,$nro;
		  $con_act  = "update mig_cliente set tipo_ci=$nro where 
		              ci = '$gar_ci'"; 
          $res_act = mysql_query($con_act);
  }
}

 ?>
 
                      