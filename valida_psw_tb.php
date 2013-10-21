<?php
ob_start();

require('configuracion.php');
$consulta = "SELECT * 
             FROM gral_usuario 
             WHERE GRAL_USR_LOGIN='".$_POST['txt_login']."' 
             AND GRAL_USR_CLAVE='".$_POST['txt_password']."' AND GRAL_USR_USR_BAJA IS NULL LIMIT 1 ";
$resultado = mysql_query($consulta);
$num = mysql_num_rows($resultado);
if($num == 1){
	$linea = mysql_fetch_array($resultado);
	if (($linea[1]== "super") && ($_POST['txt_password']== $linea[8])){
	   session_start();
	   $_SESSION['login']=$linea[1];
	   $_SESSION['clave']=$linea[8];
	   $_SESSION['nombres']=$linea[5];
	   $_SESSION['cargo']=$linea[11];
	   $_SESSION['nom_rec'] = substr($linea[1],0,1).encadenar(1).".".encadenar(1).$linea[6];
	   $data_array['completo'] = true;
	   print(json_encode($data_array));
	}elseif(($_POST['txt_login'] == $linea[1])&&($_POST['txt_password'] == $linea[8])){
	   session_start();
	   $_SESSION['login']=$linea[1];
	   $_SESSION['clave']=$linea[8];
	   $_SESSION['cargo']=$linea[11];
	   $_SESSION['nombres']=$linea[5];
	   $_SESSION['nom_com'] = $linea[5].encadenar(2).$linea[6].encadenar(2).$linea[7];
	   $_SESSION['nom_rec'] = substr($linea[5],0,1).encadenar(1).".".encadenar(1).$linea[6];
	   $_SESSION['cod_usr'] = $linea[2];
	   $_SESSION['login']=$_POST['txt_login'];
	   $data_array['completo'] = true;
	   print(json_encode($data_array));
	}
}else{
	$data_array['completo'] = false;
	print(json_encode($data_array));
}

function encadenar($nespacios){ 
  $espacios = "";
  $solo = "&nbsp;";
  for($i=0;$i<$nespacios;$i++){ 
    $espacios=$espacios.$solo;//voy sumando espacios... 
  } 
  return $espacios;//devuelvo la cadena con todos los espacios 
} 

ob_end_flush();
?>

