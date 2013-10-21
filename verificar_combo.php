<?php
require('configuracion.php');
$codigo = $_GET['codigo'];
$query ="SELECT * 
		 FROM city
		 WHERE CountryCode= '$codigo' 
		 ORDER BY Name ASC";

//$query  = mysql_query('SET CHARACTER SET utf8');
$res  = mysql_query($query);
$cont = 0;
while($ciudad = mysql_fetch_array($res)){
	$array['ID'] = utf8_encode($ciudad[0]);
	$array['Name'] = utf8_encode($ciudad[1]);
	$json_data[$cont] = $array;
	$cont++;
}
/*foreach($json_data as &$record){
	array_map("utf8_encode", $record);
}*/
print_r(json_encode($json_data));
//print_r(json_encode($json_data));
?>