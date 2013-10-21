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
$nro_nue = 1;
for ($x=1329; $x < 1400; $x = $x + 1 ) {
     $nro_doc = 0;
     $con_doc  = "Select DISTINCT CONTA_TRS_NRO From contab_trans where CONTA_TRS_NRO = $x and
	              CONTA_TRS_USR_BAJA is null"; 
 $res_doc = mysql_query($con_doc);
   while ($lin_doc = mysql_fetch_array($res_doc)) {
         $nro_doc = $lin_doc['CONTA_TRS_NRO'];
		 echo "nro_doc ".$nro_doc."-".$x;
   }
   
   if ($nro_doc > 0){
     $nro_nue = $nro_nue + 1;
   	 echo "nro_doc ".$nro_doc."nuev_doc".$nro_nue;
     $con_mcli = "UPDATE contab_trans set CONTA_TRS_NRO = $nro_nue  where CONTA_TRS_NRO = $nro_doc"; 
     $res_mcli = mysql_query($con_mcli);
     //echo $nro_nue, $x;
	$con_mcli = "UPDATE contab_cabec set CONTA_CAB_NRO = $nro_nue  where CONTA_CAB_NRO = $nro_doc"; 
    $res_mcli = mysql_query($con_mcli);
     }
	 
   }

        

}
 ?>
 
                      