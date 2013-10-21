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
$con_mcli  = "Select * From migragar where gar_ddrr > 2386 "; 
$res_mcli = mysql_query($con_mcli);
   while ($lin_mcli = mysql_fetch_array($res_mcli)) {
         $gar_codi = $lin_mcli['gar_codi'];
		 $gar_ci = $lin_mcli['gar_ci'];
		 $gar_mosol = $lin_mcli['gar_mosol'];
		 $gar_ddrr = $lin_mcli['gar_ddrr'];
		 $nro = $nro + 1;
  
  $agen = 32;
  $usr = "super";
 
  
/*  echo $nro.encadenar(2).$codigo.encadenar(2).$ci.encadenar(2).$nombres.encadenar(2).
       $paterno.encadenar(2).$materno.encadenar(2).$esposo.encadenar(2). 
	 $fec_nac.encadenar(2).$sex.encadenar(2).$est_c.encadenar(2).$activ.
	 encadenar(2).$vende.encadenar(2).$tip_v.encadenar(2).$direc.encadenar(2)
	 .$zona.encadenar(2).$fono_d.encadenar(2).$celu.encadenar(2).$agen.encadenar(2).$conyuge.
	  encadenar(2).$usr ;	
 */
// Maestro Cartera
  $consulta  = "Insert into cart_deudor       (CART_DEU_NCRED,
	                                           CART_DEU_SOL,
	                                           CART_DEU_RELACION,
											   CART_DEU_INTERNO,
                                               CART_DEU_ID,
											   CART_DEU_IMPORTE,
											   CART_DEU_COMI,
											   CART_DEU_AHO_INI,	
											   CART_DEU_AHO_DUR,
											   CART_DEU_INT_CTA,
											   CART_DEU_USR_ALTA,
											   CART_DEU_FCH_HR_ALTA,
											   CART_DEU_USR_BAJA,
											   CART_DEU_FCH_HR_BAJA) values
											   ($gar_codi,
											    $gar_ddrr,
											    'C',
											    1,
											    '$gar_ci',
											    $gar_mosol,
											    0,
											    0,
											    0,
											    0,
											    '$usr',
											    null,
											    null,
											     '0000-00-00 00:00:00')";

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
											    $est_c,
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
 
                      