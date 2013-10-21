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
		 header('Location: cart_cobro_selec.php');
	   break;
      case "2":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 header('Location: cred_cobros_2.php?menu=3');
       break;
	   case "3":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 header('Location: cobro_con.php');
       break;
	   case "4":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php');
		 header('Location: modulo.php');
       break;
	   case "5":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php');
		 header('Location: cobro_selec.php');
       break;
	   case "10":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php'); 
		  header('Location: fgar_tran.php');
       break;
	   case "11":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php'); 
		  header('Location: fgar_de_re.php');
       break;
}
?> 
<?php
}
ob_end_flush();
 ?>