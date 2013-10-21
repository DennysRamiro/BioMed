<?php
require('configuracion.php');
$codigo = $_POST['codigo'];
$chequera = $_POST['chequera'];
$cheque = $_POST['cheque'];

$_SESSION['codigo']= $codigo;
$query ="SELECT CONTA_CHRA_TALON 
		 FROM contab_chequera
		 WHERE CONTA_CHRA_CTA = '$codigo' AND
		 CONTA_CHRA_TALON = '$chequera' AND
		 ($cheque  BETWEEN CONTA_CHRA_INI AND CONTA_CHRA_FIN) AND
		 CONTA_CHRA_USR_BAJA is null";
$res2  = mysql_query($query)or die('No pudo seleccionarse tabla 1');
$cont = 0;
    $ciudad2 = mysql_fetch_array($res2);
	$array2['CONTA_CHRA_TALON'] = $ciudad2['CONTA_CHRA_TALON'];
	print(json_encode($array2));

?>