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
//echo "prueba";
switch( $_POST['accion'] ) { 
      case "Salir":
	      //echo "Salir";
	     // echo "Volver atras <a href='menu_s.php'>volver</a>";
		  require 'gral_man_usr.php';
	   break;
      case "Grabar":
	      //echo "Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 

		 require ('gral_grab_usr.php');
		 


		 //linea de codigo para que retorne la formulario de alta
		 //header('Location: gral_man_usr_a.php');
       break;
	    case "Guardar":
	     // echo "Modificar- Grabar"; 
	     require('gral_grab_usr_m.php'); 
		 //require 'gral_grab_usr_m.php';
       break;
	   case "Guardar":
	     // echo "Modificar- Grabar"; 
	     require('gral_grab_usu_per.php'); 
		 //require 'gral_grab_usr_m.php';
       break;
       case "Salir":
	      //echo "Salir";
	     // echo "Volver atras <a href='menu_s.php'>volver</a>";
		  require 'gral_man_usr.php';
	   break;
}
?> 
<?php
}
ob_end_flush();
 ?>