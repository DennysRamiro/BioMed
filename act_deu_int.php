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
$con_deu  = "SELECT * 
             FROM cart_deudor 
             WHERE CART_DEU_INTERNO IS NULL "; 
$res_deu = mysql_query($con_deu);
   while ($lin_deu = mysql_fetch_array($res_deu)) {
         $deu_ncre = $lin_deu['CART_DEU_NCRED'];
		 $deu_ci = $lin_deu['CART_DEU_ID'];
		 echo $deu_ncre. " ".$deu_ci;
	     $con_cli = "Select * from cliente_general where CLIENTE_COD_ID = '$deu_ci' and CLIENTE_USR_BAJA is null ";
         $res_cli = mysql_query($con_cli);
         while ($lin_cli = mysql_fetch_array($res_cli)) {	
		        $cod_cli = $lin_cli['CLIENTE_COD'];
		 }
		 
// Maestro Cartera
  $consulta  = "UPDATE cart_deudor SET CART_DEU_INTERNO = $cod_cli WHERE CART_DEU_NCRED = $deu_ncre  and
                       CART_DEU_ID = '$deu_ci'";
											   

$resultado = mysql_query($consulta);

}
}
ob_end_flush();
 //Correlativos transaccion
/*($nro,
											    $nro,
											    '$codigo',
											    1,
											    1,
											    '$ci',
											    null,
											    '$nombres',
											    '$paterno',
											    '$materno',
											    '$esposo',
											    '$fec_nac',
												null,
											    $sex,
											    $est_c,alizar
											    '$activ',
											    '$vende',
												null,
											    null,
											    null,
												null,
											    null,
											    $tip_v,
											    null,
											    null,
											    '$direc', 
											    '$zona',
											    $fono_d,
											    $celu,
											    null,
											    null,
											     null,
											     null,
											    $agen,
											    null,
											    '$conyuge',
											    null,
											    null,
											    null,
											    null,
											    '$usr',
											     null,
											     null,
											     '0000-00-00 00:00:00')";
*/	




 ?>
 
                      