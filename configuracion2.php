<?php
//session_start();
$bd_host = "localhost";
$bd_usuario = "root";
$bd_password = "";
$bd_base = "trebol_server";
$con = mysql_connect($bd_host, $bd_usuario, $bd_password)
       or die('No pudo conectarse : ' . mysql_error());
mysql_select_db($bd_base, $con) or die('No pudo seleccionarse la BD.');
?>
