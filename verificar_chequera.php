<?php
require('configuracion.php');
$codigo = $_GET['codigo'];
$_SESSION['codigo']= $codigo;
$query ="SELECT * 
		 FROM contab_chequera
		 WHERE CONTA_CHRA_CTA= '$codigo' AND
		 CONTA_CHRA_USR_BAJA is null
		 ORDER BY CONTA_CHRA_TALON ASC";

//$query  = mysql_query('SET CHARACTER SET utf8');
$res  = mysql_query($query);
$cont = 0;
while($ciudad = mysql_fetch_array($res)){
	$array['CONTA_CHRA_CTA'] = utf8_encode($ciudad[3]);
	$array['CONTA_CHRA_TALON'] = utf8_encode($ciudad[4]);
	$json_data[$cont] = $array;
	$cont++;
}
/*foreach($json_data as &$record){
	array_map("utf8_encode", $record);
}*/
print_r(json_encode($json_data));
//print_r(json_encode($json_data));
?>