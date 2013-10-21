<?php
session_start();
if(!isset($_SESSION['login']) || !isset($_SESSION['clave'])){
    header("Location: index.php?error=1");
} 
require('configuracion.php');
if($_GET['tp'] == 'buscar'){

	$consulta = "SELECT * From contab_cuenta
                WHERE CONTA_CTA_DESC like '%".$_GET['busca']."%' and CONTA_CTA_NIVEL='A'

                ";
	$resultado = mysql_query($consulta);
	$cont =0;
	while($row = mysql_fetch_array($resultado)){
		$array['id'] = $row['CONTA_CTA_NRO'];
		$array['label'] = $row['CONTA_CTA_NRO']." ".$row['CONTA_CTA_DESC'];
		$array['value'] = $row['CONTA_CTA_NRO']." ".$row['CONTA_CTA_DESC'];
		$json_data[$cont] = $array;
		$cont++;
	}
	print_r(json_encode($json_data));	
}

?>