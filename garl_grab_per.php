<?php
	ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
	if(!isset($_SESSION['login']) || !isset($_SESSION['clave'])){
		header("Location: index.php?error=1");
} else {
	require('configuracion.php');
    require('funciones.php');

//echo "entra a grabar";

echo "------";

if(isset($_POST['asig'])){
   
   	echo "valor";
}else{
echo $_POST['asig'];
}
echo "------";
}
?>

