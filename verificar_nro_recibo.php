<?php
require('configuracion.php');
$recibo = $_POST['recibo'];
//$chequera = $_POST['chequera'];
//$cheque = $_POST['cheque'];

//$_SESSION['codigo']= $codigo;
$query ="SELECT REC_CTRL_NRO
		 FROM recibo_cntrl
		 WHERE ($recibo  BETWEEN REC_CTRL_DESDE AND REC_CTRL_HASTA) AND
		 REC_CTRL_USR_BAJA is null";
$res2  = mysql_query($query)or die('No pudo seleccionarse tabla 1');
$cont = 0;
    $ciudad2 = mysql_fetch_array($res2);
	$array2['REC_CTRL_NRO'] = $ciudad2['REC_CTRL_NRO'];
	print(json_encode($array2));

?>