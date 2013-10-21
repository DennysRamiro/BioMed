<?php
	ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
	if(!isset($_SESSION['login']) || !isset($_SESSION['clave'])){
    header("Location: index.php?error=1");
} else {
	$_SESSION['msj_error']= "";
?>
<?php
switch( $_GET['accion'] ) {
      case "1":
	      //echo "Retroceder";
	     // echo "Volver atras <a href='menu_s.php'>volver</a>";
		 header('Location: cred_cobros_2.php?menu=1');
	   break;
	   //case aumentaado para que se redreccione el menu correctamente
	   case "11":
	      //echo "Retroceder";
	     // echo "Volver atras <a href='menu_s.php'>volver</a>";
		 header('Location: cred_cobros_2.php?menu=2');
	   break;
      case "2":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 header('Location: cobro_prep.php');
       break;
	   case "3":
	     // echo "Grabar"; 
	      $_SESSION['tipo'] = 1;
		 header('Location: cob_prox_vto.php');
       break;
	   case "4":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php');
		 //header('Location: modulo.php');
		 header('Location: modulo.php?modulo=4000');
       break;
	   case "5":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php');
		 header('Location: cobro_selec.php');
       break;
	    case "6":
	     // echo "Grabar"; 
	     $_SESSION['tipo'] = 1;
		 header('Location: cart_mora_fec.php');
       break;
	   case "7":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php');
		 $_SESSION['tipo'] = 2; 
		 header('Location: cart_mora_fec.php');
       break; 
	    case "8":
	     // echo "Grabar"; 
	      $_SESSION['tipo'] = 2;
		 header('Location: cob_prox_vto.php');
       break;
}
?> 
<?php
}
ob_end_flush();
 ?>