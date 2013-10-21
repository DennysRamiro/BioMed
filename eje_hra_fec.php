<?php
//Script hecho por Raul Gerardo Marmolejo Velázquez
//Para el manejo de fechas, horas e información del
//navegador en español.
//Distribución gratuita
//Dudas, comentarios y/o sugerencias
//raul@marmolejo.net
//rm3 KrEaTiOnZ 2002
// http://www.lawebdelprogramador.com

$dia=date("w");
switch($dia)
{
	case 0:$dia="Domingo";break;
	case 1:$dia="Lunes";break;
	case 2:$dia="Martes";break;
	case 3:$dia="Miércoles";break;
	case 4:$dia="Jueves";break;
	case 5:$dia="Viernes";break;
	case 6:$dia="Sábado";break;
}

//date("w") nos devuelve el número del día con el switch case lo
//aplicamos a el día correspondiente en Español.

$mes=date("n");
switch($mes)
{
	case 1:$mes="Enero";break;
	case 2:$mes="Febrero";break;
	case 3:$mes="Marzo";break;
	case 4:$mes="Abril";break;
	case 5:$mes="Mayo";break;
	case 6:$mes="Junio";break;
	case 7:$mes="Julio";break;
	case 8:$mes="Agosto";break;
	case 9:$mes="Septiembre";break;
	case 10:$mes="Octubre";break;
	case 11:$mes="Noviembre";break;
	case 12:$mes="Diciembre";break;
}

//date("n") nos devuelve el número del mes con el switch case lo
//aplicamos a el mes correspondiente en Español.

$numero=date("j");
$anio=date("Y");  
//Tomamos directos el día del mes y el año.

$difhor = "+1"; //Diferencia horaria entre el server y la Laguna.
$ajuste = ($difhor * 60 * 60); //Ajustamos por horas 60 seg* 60 min.
$hora = date("g:i  a",time() + $ajuste); //la hora es igual a la hora del server + el ajuste.
$browser_type = getenv("HTTP_USER_AGENT");
If (preg_match("/MSIE/i", "$browser_type")) {
	$navegador="Microsoft Internet Explorer";
} else if (preg_match("/Mozilla/i", "browser_type")) {
	$navegador="Netscape Comunicator";
} else {
	$navegador="$browser_type"; }

$ip=getenv("REMOTE_ADDR");
$puerto=getenv("REMOTE_PORT");

//EJEMPLOS de como usar el script.
print("Hoy es $dia $numero de $mes del $anio");
print ("<br>Son las: $hora");
print ("<br>IP: $ip");
print ("<br>Puerto: $puerto");
print ("<br>Navegador: $navegador");

$UsuarioIp = $_SERVER['REMOTE_ADDR']; 
$UsuarioFechaYHora = date('l dS \of F Y h:i:s A'); 

echo "$UsuarioIp : ($UsuarioFechaYHora)"; 
//
$localtime_assoc = localtime(time(), true); 
print_r($localtime_assoc); 

echo "Hora Actual: " .date("H:i:s") . "<br />"; 
echo "-1 hora: ".date("H:i:s",strtotime("-1 hour"));





?>
