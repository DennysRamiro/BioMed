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
      case "Alta-Grupo":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 require 'grupo_mante_a.php';
       break;
	    case "Elegir-Grupo":
	      //echo "Modificar- Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 require 'grupo_sel_sol.php';
       break;
}
?> 
<?php
}
ob_end_flush();
 ?>
