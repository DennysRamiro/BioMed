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
      case "1":
	      //echo "Retroceder";
	     $_SESSION["tip_rep"] = 1;
		 header('Location: tipo_rep_6.php');
	   break;
      case "2":
	     // echo "Grabar"; 
	     $_SESSION["tip_rep"] = 2;
		 header('Location: tipo_rep_3.php');
       break;
	   case "3":
	     // echo "Grabar"; 
	     $_SESSION["tip_rep"] = 3;
		 header('Location: tipo_rep_3.php');
       break;
	   case "4":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php');
		// header('Location: cart_rep_det.php');
		header('Location: tipo_rep_1.php');
       break;
	   case "5":
	     $_SESSION["tipo_rep"] = 2;
	     header('Location: rep_param.php');
       break;
	   case "6":
	     $_SESSION["tipo_rep"] = 3;
	     //  require('garl_grab_fec.php');
		 header('Location: rep_param.php');
       break;
	   case "7":
	     $_SESSION["tipo_rep"] = 7;
	     //  require('garl_grab_fec.php');
		 header('Location: rep_param.php');
       break;
	    case "8":
	     header('Location: tipo_rep_11.php');
       break;
	    case "9":
	     $_SESSION["tip_rep"] = 9;
	     //  require('garl_grab_fec.php');
		  header('Location: tipo_rep_3.php');
       break;
	   	    case "10":
	      $_SESSION["tipo_rep"] = 10;
	     header('Location: rep_param.php');
       break;
	   break;
	   	    case "11":
	      $_SESSION["tipo_rep"] = 11;
	     header('Location: rep_param.php');
       break;
}
?> 
<?php
}
ob_end_flush();
 ?>