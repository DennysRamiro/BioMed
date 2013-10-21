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
      // aumentar parametro menu para diferenciar el reporte
      case "1":
	      $_SESSION["tipo_rep"] = 6;
	     //  require('garl_grab_fec.php');
		 header('Location: rep_param_cja.php?menu=1');
	   break;
	    // aumentar parametro menu para diferenciar el reporte
      case "2":
	     $_SESSION["tipo_rep"] = 15;
	     //  require('garl_grab_fec.php'); 
		 header('Location: rep_param_cja.php?menu=2');
       break;
        // aumentar parametro menu para diferenciar el reporte
	   case "3":
	      $_SESSION["tipo_rep"] = 5;
	     //  require('garl_grab_fec.php');
		 header('Location: rep_param_cja.php?menu=3');
       break;
        // aumentar parametro menu para diferenciar el reporte
	   case "4":
	     $_SESSION["tipo_rep"] = 7;
	     //  require('garl_grab_fec.php');
		 header('Location: rep_param_cja.php?menu=5');
       break;
       // aumentar parametro menu para diferenciar el reporte
	   case "5":
	     $_SESSION["tipo_rep"] = 8;
	     //  require('garl_grab_fec.php');
		 header('Location: rep_param_cja.php?menu=6');
       break;
         // aumentar parametro menu para diferenciar el reporte
	   case "6":
	     $_SESSION["tipo_rep"] = 9;
	     //  require('garl_grab_fec.php');
		 header('Location: rep_param_cja.php?menu=7');
       break;
        // aumentar parametro menu para diferenciar el reporte
	   case "12":
	     $_SESSION["tipo_rep"] = 12;
	     //  require('garl_grab_fec.php');
		 header('Location: rep_param_cja.php?menu=8');
       break;
        // aumentar parametro menu para diferenciar el reporte
	    case "7":
	      $_SESSION["tipo_rep"] = 17;
	     //  require('garl_grab_fec.php');
		 header('Location: rep_param_cja.php?menu=4');
       break;
}
?> 
<?php
}
ob_end_flush();
 ?>