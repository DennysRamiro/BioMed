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

	//MODIFICADO POR EL MENU SE REDIRIJE A TRES DIFERENTES LUGARES, SOLO SE AUMENTO ?
      case "1":
	      //echo "Retroceder";
	     $_SESSION['cart_fgar'] = 3;
		 header('Location: grupo_con_cob.php?menu=3');
	   break;
      
//MODIFICADO POR EL MENU SE REDIRIJE A TRES DIFERENTES LUGARES, SOLO SE AUMENTO ?
      case "2":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 $_SESSION['cart_fgar'] = 3;
		 header('Location: cliente_con_cobro.php?menu=1');
       break;
	   case "3":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 header('Location: cobro_con.php');
       break;
	   case "4":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php');
		 //header('Location: menu_s.php');
		 header('Location: modulo.php?modulo=6000');
		 
       break;
	   case "5":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php');
		 header('Location: cobro_selec.php');
       break;
	    case "60":
	      //echo "Retroceder";
	     $_SESSION['cart_fgar'] = 2;
		 header('Location: grupo_con_cob.php');
	   break;
      case "70":
	     // echo "Grabar"; 
	     $_SESSION['cart_fgar'] = 2;
		 header('Location: cliente_con_cobro.php');
       break;
	   case "80":
	     // echo "Grabar"; 
	   //  $_SESSION['cart_fgar'] = 2;
		  header('Location: modulo.php');
       break;
	   
	   
	   
	   
}
?> 
<?php
}
ob_end_flush();
 ?>