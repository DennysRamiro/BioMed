<?php
	ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
	if(!isset($_SESSION['login']) || !isset($_SESSION['clave'])){
		header("Location: index.php?error=1");
} else { 
	 $_SESSION["error"] = "";

switch( $_GET['accion'] ) {
      case "1":
	      //echo "Retroceder";
	     // echo "Volver atras <a href='menu_s.php'>volver</a>";
		// unset($_SESSION['form_buffer']);
		  header('Location: gral_man_usr_a.php');
	   break;
      case "2":
	     // echo "Grabar"; 
	      $_SESSION['menu'] = 1 ;
		 header('Location: gral_man_usr_c.php');
       break;
        case "7":
	     // echo "Grabar"; 
	      $_SESSION['menu'] = 2 ;
		 header('Location: gral_man_usr_c.php?msg=4');
       break;
	   case "3":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php'); 
//		 unset($_SESSION['form_buffer']);
		 header('Location: gral_man_usr_m.php');
       break;
	   case "4":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php');
//		unset($_SESSION['form_buffer']);  
		// header('Location: menu_s.php');
		 header('Location: modulo.php?modulo=1000');
		 
       break;
	   case "5":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php');
//		unset($_SESSION['form_buffer']);  
		 header('Location: gral_asig_per.php');
       break;
	   case "6":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php');
//		unset($_SESSION['form_buffer']);  
		 header('Location: gral_grab_usu_per.php');
       break;
}
?> 
<?php
}
ob_end_flush();
 ?>