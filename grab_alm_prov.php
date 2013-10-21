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
	      //echo "Retroceder";
	     // echo "Volver atras <a href='menu_s.php'>volver</a>";
		  unset($_SESSION['form_buffer']);
		  require 'menu_s.php';
	   break;
      case "Grabar":
	     //echo "Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 require 'gral_grab_prov.php';
       break;
	    case "Modificar":
	      //echo "Modificar- Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 require 'gral_grab_cli_m.php';
       break;
}
?> 
<?php
}
ob_end_flush();
 ?>

