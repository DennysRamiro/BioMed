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
switch( $_POST['accion'] ) {
      case "Salir":
	       require 'menu_s.php';
	       break;
      case "Grabar":
	       require 'gral_grab_fec.php';
           break;
    }
?> 
<?php
}
ob_end_flush();
 ?>
