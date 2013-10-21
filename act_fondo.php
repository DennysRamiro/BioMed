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
$con_mcre  = "Select * From migracre where  cre_hre > 2258 "; 
$res_mcre = mysql_query($con_mcre);
   while ($lin_mcre = mysql_fetch_array($res_mcre)) {
         $cre_cta = $lin_mcre['cre_cta'];
		 $cre_cgru = $lin_mcre['cre_cgru'];
		 $cre_hre = $lin_mcre['cre_hre'];
		 $cre_aho = $lin_mcre['cre_aho'];
		 $cre_mone = $lin_mcre['cre_mone'];
		 $cre_ofic  = $lin_mcre['cre_ofic']; 
		// $nro = $nro + 1;
   
  //Convierte Char a Codigo
  $agen = 32;
  $usr = "super";
 /* echo $cre_cta.encadenar(2).$nro.encadenar(2).$agen.encadenar(2).$cre_cgru.encadenar(2).
       $t_oper.encadenar(2).encadenar(2).$cre_fdes.encadenar(2). 
	 $cre_impo.encadenar(2).$cre_imco.encadenar(2).$cre_mone.encadenar(2).$cre_plaz.
	 encadenar(2).$forma.encadenar(2).$cre_tasa.encadenar(2).$t_oper.encadenar(2)
	 .$cre_ofic.encadenar(2).$cre_estado.encadenar(2).$usr  ;	
 */
// Maestro Cartera
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
										 FOND_MAE_USR_ALTA,
										 FOND_MAE_FCH_HR_ALTA, 
										 FOND_MAE_USR_BAJA, 
										 FOND_MAE_FCH_HR_BAJA) 
										 values ($cre_aho,
										         $cre_hre,
										         $cre_aho,
												 $cre_hre,
												 $cre_cta,
												 $agen, 
										         '$cre_cgru', 
                                                 null,
                                                 $cre_mone,
                                                 0,
												 0,
												 0,
                                                 0,
                                                 0,
												 '$cre_ofic',
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
 
                      