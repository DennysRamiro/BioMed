<?php
require('configuracion.php');
$codigo = $_POST['codigo'];
$chequera = $_POST['chequera'];
$cheque = $_POST['cheque'];
$_SESSION['codigo']= $codigo;
$_SESSION['cheque']= $cheque;
$_SESSION['chequera']= $chequera;
$query ="SELECT CONTA_CHEQ_NRO 
		 FROM contab_cheques
		 WHERE CONTA_CHEQ_CTA= '$codigo' AND
		 CONTA_CHEQ_TALON = '$chequera' AND
		 CONTA_CHEQ_NRO = $cheque AND
		 CONTA_CHEQ_USR_BAJA is null";
$res1  = mysql_query($query)or die('No pudo seleccionarse tabla 1');
$cont = 0;
    $ciudad1 = mysql_fetch_array($res1);
	$array['CONTA_CHEQ_NRO'] = $ciudad1['CONTA_CHEQ_NRO'];
    print(json_encode($array));
?>