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
$con_mcre  = "Select * From migracre_c where cre_hre > 3186 "; 
$res_mcre = mysql_query($con_mcre);
   while ($lin_mcre = mysql_fetch_array($res_mcre)) {
         $cre_cta = $lin_mcre['cre_cta'];
		 $cre_cage = $lin_mcre['cre_cage'];
		 $cre_cgru = $lin_mcre['cre_cgru'];
		 $cre_hre = $lin_mcre['cre_hre'];
		 $cre_dre = $lin_mcre['cre_dre'];
		 $cre_dire  = $lin_mcre['cre_dire'];
		 $cre_tipo  = $lin_mcre['cre_tipo'];
         $cre_fdes = $lin_mcre['cre_fdes'];
		 $cre_impo = $lin_mcre['cre_impo'];
		 $cre_imco = $lin_mcre['cre_imco'];
		 $cre_mone = $lin_mcre['cre_mone'];
		 $cre_aini = $lin_mcre['cre_aini'];
		 $cre_adur  = $lin_mcre['cre_adur'];
		 $cre_org = $lin_mcre['cre_org'];
		 $cre_ncta  = $lin_mcre['cre_ncta'];
		 $cre_plaz  = $lin_mcre['cre_plaz'];
		 $cre_forp = $lin_mcre['cre_forp'];
		 $cre_tasa  = $lin_mcre['cre_tasa'];
		 $cre_tcom  = $lin_mcre['cre_tcom']; 
		 $cre_prod  = $lin_mcre['cre_prod'];
		 $cre_cain = $lin_mcre['cre_cain']; 
		 $cre_ofic  = $lin_mcre['cre_ofic'];
		 $cre_estado  = $lin_mcre['cre_estado'];
		 $cre_stat  = $lin_mcre['cre_stat'];
		 $cre_aho = $lin_mcre['cre_aho'];
		// $nro = $nro + 1;
   
  //Convierte Char a Codigo
if ($cre_forp == "dia fijo"){
    $forma = 4;
  }  
 if ($cre_forp == "mensual"){
    $forma = 3;
  }   
 if ($cre_forp == "quincenal"){
    $forma = 2;
  }  
 if ($cre_forp == "semanal"){
    $forma = 1;
  }  
 if ($cre_prod == "individual"){
    $t_oper = 3;
  }   
 if ($cre_prod == "oportunidad"){
    $t_oper = 2;
  }  
  if ($cre_prod == "solidario"){
    $t_oper = 1;
  }
  if ($cre_stat == "B"){
    $cre_est =  $cre_estado * 10;
     }
   if ($cre_stat == "V"){
     if ($cre_estado == 1){  
        $cre_est =  3;
		}
	 if ($cre_estado == 2){  
        $cre_est =  6;
		}
	 if ($cre_estado == 3){  
        $cre_est =  7;
		}
	 if ($cre_estado == 4){  
        $cre_est =  8;
		}						
     }	 
	 
  $agen = 32;
  $usr = "super";
 /* echo $cre_cta.encadenar(2).$nro.encadenar(2).$agen.encadenar(2).$cre_cgru.encadenar(2).
       $t_oper.encadenar(2).encadenar(2).$cre_fdes.encadenar(2). 
	 $cre_impo.encadenar(2).$cre_imco.encadenar(2).$cre_mone.encadenar(2).$cre_plaz.
	 encadenar(2).$forma.encadenar(2).$cre_tasa.encadenar(2).$t_oper.encadenar(2)
	 .$cre_ofic.encadenar(2).$cre_estado.encadenar(2).$usr  ;	
 */
// Maestro Cartera
  $consulta = "insert into cart_maestro (CART_NRO_CRED,
                                         CART_NUMERICO,
                                         CART_NRO_CRED_ANT,
										 CART_NRO_SOL,
										 CART_COD_AGEN, 
										 CART_COD_GRUPO, 
										 CART_HR_REU,
										 CART_DIA_REU,
										 CAR_DIR_REU,
										 CART_TIPO_CRED,
										 CART_TIPO_OPER,
										 CART_FEC_DES,
										 CART_FEC_UNO,
										 CART_IMPORTE,
										 CART_IMP_COM,
										 CART_COD_MON,
										 CART_AHO_INI, 
										 CART_AHO_DUR, 
										 CART_ORG_FON, 
										 CART_NRO_CTAS, 
										 CART_PLZO_M, 
										 CART_PLZO_D, 
										 CART_FORM_PAG, 
										 CART_NRO_LINEA, 
										 CART_TASA, 
										 CART_TIP_COM, 
										 CART_PER_GRA, 
										 CART_PRODUCTO, 
										 CART_SECTOR, 
										 CART_SUB_SECTOR, 
										 CART_DEPTO, 
										 CART_PROV, 
										 CART_CAL_INT, 
										 CART_OFIC_RESP, 
										 CART_USR_AUT, 
										 CART_FCH_AUT, 
										 CART_FCH_CAN, 
										 CART_QUIEN_PAG, 
										 CART_DEST_CRED, 
										 CART_ESTADO,
										 CART_MAE_USR_ALTA, 
										 CART_MAE_FCH_HR_ALTA, 
										 CART_MAE_USR_BAJA, 
										 CART_MAE_FCH_HR_BAJA) 
										 values ($cre_cta,
										         $cre_hre,
										         '$cre_cta',
												 null,
												 '$agen', 
										         '$cre_cgru', 
                                                 null,
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
												 $cre_est,
												 '$usr', 
												 null, 
												 null, 
												'0000-00-00 00:00:00')";


$resultado = mysql_query($consulta));

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
 
                      