<?php
require('configuracion.php');
//$codigo = $_POST['codigo'];
//$chequera = $_POST['chequera'];
$recibo = $_POST['recibo'];
//$_SESSION['codigo']= $codigo;
$query ="SELECT REC_DET_NRO 
		 FROM recibo_deta
		 WHERE REC_DET_NRO= $recibo AND
		 REC_DET_USR_BAJA is null";
$res1  = mysql_query($query)or die('No pudo seleccionarse tabla 1');
$cont = 0;
    $ciudad1 = mysql_fetch_array($res1);
	$array['REC_DET_NRO'] = $ciudad1['REC_DET_NRO'];
    print(json_encode($array));
?>