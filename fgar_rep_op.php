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
	     $_SESSION["recal"] = 1;
		 header('Location: fgar_rep_1.php');
	   break;
      case "2":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 header('Location: cart_rep_1.php?menu=1');
       break;
	   case "3":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 header('Location: cart_rep_1.php?menu=2');
       break;
	   case "4":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php');
		$_SESSION['vig_can'] = 1;
		header('Location: tipo_rep_aho.php?menu=3');
       break;
	   case "6":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php');
		// header('Location: cart_rep_det.php');
		$_SESSION['vig_can'] = 2;
		header('Location: tipo_rep_aho.php?menu=4');
       break;
       // para diferenciar el reporte de fondo garantia y cartera
	   case "5":
	     $_SESSION["tipo_rep"] = 4;
	     //  require('garl_grab_fec.php');
		 header('Location: rep_param.php?menu=5');
       break;
}
?> 
<?php
}
ob_end_flush();
 ?>