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
$nro_doc = 0;
$con_mcli  = "Select DISTINCT CONTA_TRS_NRO From contab_trans where CONTA_TRS_USR_BAJA is null"; 
 $res_mcli = mysql_query($con_mcli);
   while ($lin_mcli = mysql_fetch_array($res_mcli)) {
         $nro_doc = $lin_mcli['CONTA_TRS_NRO'];
		 
		 $con_doc  = "Select * From contab_trans where CONTA_TRS_NRO =  $nro_doc and CONTA_TRS_USR_BAJA is null"; 
         $res_doc = mysql_query($con_doc);
          while ($lin_doc = mysql_fetch_array($res_doc)) {
		        $nro_d = $lin_doc['CONTA_TRS_NRO'];
		        $fec = $lin_doc['CONTA_TRS_FEC_VAL'];
				$glosa = $lin_doc['CONTA_TRS_GLOSA'];
				$logi = $lin_doc['CONTA_TRS_USR_ALTA'];
		  
		  }
	  
  // Maestro Cartera
  $consulta  = "Insert into contab_cabec (CONTA_CAB_AGEN,
	                                      CONTA_CAB_NRO,
	                                      CONTA_CAB_FEC_VAL,
										  CONTA_CAB_FEC_TRAN,
                                          CONTA_CAB_CBIO,
										  CONTA_CAB_GLOSA,
										  CONTA_CAB_USR_ALTA,
										  CONTA_CAB_FCH_HR_ALTA
										) values
											   (30,
											     $nro_d,
											    '$fec',
											    '$fec',
											    0,
											    '$glosa',
											    '$logi',
											     null
											    )";

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
 
                      