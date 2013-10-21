<?php
//session_start();
//$bd_host = "25.131.38.23";
$bd_host = "localhost";
//$bd_host = "25.131.38.23";
$bd_usuario = "root";
$bd_password = "";
//$bd_password = "123456";
$bd_base = "biomedical";
$con = mysql_connect($bd_host, $bd_usuario, $bd_password);
mysql_select_db($bd_base, $con) ;
?>
