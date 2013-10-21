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
$con_mgru  = "Select * From mig_grupo "; 
$res_mgru = mysql_query($con_mgru);
   while ($lin_mgru = mysql_fetch_array($res_mgru)) {
         $gru_cod = $lin_mgru['codigo'];
		 $gru_nom = $lin_mgru['nombre'];
		 $nro = $nro + 1;
  
  $agen = 32;
  $usr = "super";
 /* echo $cre_cta.encadenar(2).$nro.encadenar(2).$agen.encadenar(2).$cre_cgru.encadenar(2).
       $t_oper.encadenar(2).encadenar(2).$cre_fdes.encadenar(2). 
	 $cre_impo.encadenar(2).$cre_imco.encadenar(2).$cre_mone.encadenar(2).$cre_plaz.
	 encadenar(2).$forma.encadenar(2).$cre_tasa.encadenar(2).$t_oper.encadenar(2)
	 .$cre_ofic.encadenar(2).$cre_estado.encadenar(2).$usr  ;	
 */
// Maestro Cartera
  $consulta = "insert into cred_grupo (CRED_GRP_CODIGO,
                                         CRED_GRP_NUMERICO,
                                         CRED_GRP_NOMBRE,
										 CRED_GRP_FECHA,
										 CRED_GRP_AGENCIA, 
										 CRED_GRP_DIA_REU, 
										 CRED_GRP_HRA_REU,
										 CRED_GRP_DIR_REU,
										 CRED_GRP_USR_ALTA,
										 CRED_GRP_FCH_HR_ALTA,
										 CRED_GRP_USR_BAJA,
										 CRED_GRP_FCH_HR_BAJA) 
										 values ($gru_cod ,
										         $nro,
										         '$gru_nom',
												 null,
												 '$agen', 
										         null,
                                                 null,
                                                 null,
												'$usr', 
												 null, 
												 null, 
												'0000-00-00 00:00:00')";


$resultado = mysql_query($consulta);

}
}
ob_end_flush();
 //Correlativos transaccion
/*$agen = 32
$r = "";
$nro_cre = leer_nro_credito($agen);

$n = strlen($nro_cre);
$n2 = 4 - $n;
$nro_c = "";
$nro_cred = 0;
$nro_ctaf = 0;
$nro_ctf = 0;

if(isset($r)){ 
   for ($i = 1; $i <= $n2; $i++) {
    $r = $r."0";
    }
$nro_cred = "9".$agen."0".$t_op.$r.$nro_cre;

values ($cre_cta,
										         $nro,
										         '$cre_cta',
												 null,
												 '$agen', 
										         '$cre_cgru', 
                                                 null',
                                                 null,
                                                 null,
												 null,
												 $t_oper,
                                                 '$cre_fdes',
                                                 null,
                                                 $cre_impo, 
                                                 $cre_imco,
                                                 $cre_mone,
												 null,
		                                         null,
												 1,
												 $cre_plaz,
												 null,
                                                 null,	
												 $forma,
												 null,
												 $cre_tasa,
												 null,
												 null,
												 $t_oper,
												 null,
												 null,
												 null,
												 null,
												 null,
												 '$cre_ofic',
												 null,
												 null,
												 null,
												 null,
												 null,
												 $cre_estado,
												 '$usr', 
												 null, 
												 null, 
												'0000-00-00 00:00:00')";




*/	




 ?>
 
                      