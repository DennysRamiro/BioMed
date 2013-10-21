<?php
	ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
	if(!isset($_SESSION['login']) || !isset($_SESSION['clave'])){
		header("Location: index.php?error=1");
} else { 
?>
<?php
switch( $_GET['accion'] ) {
	//Alta proyecto
      case "1":
	      //echo "Retroceder";
	     // echo "Volver atras <a href='menu_s.php'>volver</a>";
		 header('Location: alm_proyecto_alta.php');
	   break;
	   // Consultar
      case "2":
	     // echo "Grabar"; 
	     //$_SESSION['alm_mod'] = 1;

	     //echo $_SESSION['alm_mod'];
		 header('Location: alm_proyecto_cons.php');
       break;       
}
?> 
<?php
}
ob_end_flush();
 ?>

