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
      
//modificacion de la pagina aumentando ? para poder redireccionar correctamente los mennus
      case "1":
	      //echo "Retroceder";
	     $_SESSION["tip_rep"] = 1;
		 header('Location: tipo_rep_3.php?menu=3');
	   break;
//modificacion de la pagina aumentando ? para poder redireccionar correctamente los mennus
      case "2":
	     // echo "Grabar"; 
	     $_SESSION["tip_rep"] = 2;
		 header('Location: tipo_rep_3.php?menu=4');
       break;
//modificacion de la pagina aumentando ? para poder redireccionar correctamente los mennus   
	   case "3":
	     // echo "Grabar"; 
	     $_SESSION["tip_rep"] = 3;
		 header('Location: tipo_rep_3.php?menu=5');
       break;
	   
//modificacion de la pagina aumentando ? para poder redireccionar correctamente los mennus   
	   case "4":
	    $_SESSION["tipo_rep"] = 1;
		header('Location: tipo_rep_1.php?menu=1');
       break;
	   
//modificacion de la pagina aumentando ? para poder redireccionar correctamente los mennus   
	   case "5":
	     $_SESSION["tipo_rep"] = 2;
	     header('Location: rep_param.php?menu=1');
       break;
//modificacion de la pagina aumentando ? para poder redireccionar correctamente los mennus   
	   
	   case "6":
	     $_SESSION["tipo_rep"] = 3;
	     //  require('garl_grab_fec.php');
		 header('Location: rep_param.php?menu=2');
       break;
	   
//modificacion de la pagina aumentando ? para poder redireccionar correctamente los mennus   

	   case "7":
	     $_SESSION["tipo_rep"] = 7;
	     //  require('garl_grab_fec.php');
		 header('Location: rep_param.php?menu=3');
       break;
	    case "8":
	     header('Location: tipo_rep_11.php');
       break;
//modificacion de la pagina aumentando ? para poder redireccionar correctamente los mennus	    
	    case "9":
	     $_SESSION["tip_rep"] = 9;
	     //  require('garl_grab_fec.php');
		  header('Location: tipo_rep_3.php?menu=6');
       break;
	   
//modificacion de la pagina aumentando ? para poder redireccionar correctamente los mennus	    
	   case "10":
	      $_SESSION["tipo_rep"] = 10;
	     header('Location: rep_param.php?menu=4');
       break;

 //modificacion de la pagina aumentando ? para poder redireccionar correctamente los mennus	    

	   case "11":
	      $_SESSION["tipo_rep"] = 11;
	     header('Location: rep_param.php?menu=6');
       break;
 //modificacion de la pagina aumentando ? para poder redireccionar correctamente los mennus	    
	   
	   case "12":
	      $_SESSION["tipo_rep"] = 12;
	     header('Location: rep_param.php?menu=7');
       break;

 //modificacion de la pagina aumentando ? para poder redireccionar correctamente los mennus	    

	   case "13":
	     $_SESSION["tipo_rep"] = 13;
	     header('Location: rep_param.php?menu=8');
       break;
	    
//modificacion de la pagina aumentando ? para poder redireccionar correctamente los mennus   
	    case "14":
		 $_SESSION["tipo_rep"] = 2;
	     header('Location: tipo_rep_1.php?menu=2');
       break;
}
?> 
<?php
}
ob_end_flush();
 ?>