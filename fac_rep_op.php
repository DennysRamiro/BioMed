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
echo $_GET['accion'];
switch( $_GET['accion'] ) {

      
//modificacion de las acciones para que el menu sea redireccionada correctamente
      case "Procesar":  //<!--   Aumentar -->
		  $_SESSION["tip_rep"] == 25;
		  header('Location: tipo_rep_3.php?menu=8');
	   break;
	  case "1":
	      //echo "Retroceder";
	     $_SESSION["tip_rep"] = 23;
		 header('Location: tipo_rep_3.php?menu=8');
	   break;
     
//modificacion de las acciones para que el menu sea redireccionada correctamente

      case "2":
	     // echo "Grabar"; 
	     $_SESSION["tip_rep"] = 24;
		 header('Location: con_factura.php?menu=1');
       break;
	  
//modificacion de las acciones para que el menu sea redireccionada correctamente	  
	   case "3":
	     // echo "Grabar"; 
	     $_SESSION["tip_rep"] = 25;
		 header('Location: tipo_rep_3.php?menu=8');
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
	   //modificacion de las acciones para que el menu sea redireccionada correctamente
      case "11":
	      //echo "Retroceder";
	     $_SESSION["tip_rep"] = 26;
		 header('Location: tipo_rep_3.php?menu=9');
	   break;
	    case "12":
	     // echo "Grabar"; 
	     $_SESSION["tip_rep"] = 28;
		 header('Location: con_factura.php?menu=2');
       break;
       break;
	    case "13":
	     // echo "Grabar"; 
	     $_SESSION["tip_rep"] = 27;
		 header('Location: tipo_rep_3.php?menu=10');
       break;
	   case "31":
	      //echo "Retroceder";
	     $_SESSION["tip_rep"] = 31;
		 header('Location: tipo_rep_3.php?menu=7');
	   break;
     
//modificacion de las acciones para que el menu sea redireccionada correctamente

      case "32":
	     // echo "Grabar"; 
	     $_SESSION["tip_rep"] = 32;
		 header('Location: con_factura.php?menu=11');
       break;
	  
//modificacion de las acciones para que el menu sea redireccionada correctamente	  
	   case "33":
	     // echo "Grabar"; 
	     $_SESSION["tip_rep"] = 33;
		 header('Location: tipo_rep_3.php?menu=7');
       break;
	    case "41":
	      //echo "Retroceder";
	     $_SESSION["tip_rep"] = 41;
		 header('Location: tipo_rep_3.php?menu=6');
	   break;
	    case "42":
	     // echo "Grabar"; 
	     $_SESSION["tip_rep"] = 42;
		 header('Location: con_factura.php?menu=12');
       break;
	    case "43":
	     // echo "Grabar"; 
	     $_SESSION["tip_rep"] = 43;
		 header('Location: tipo_rep_3.php?menu=6');
       break;
}
?> 
<?php
}
ob_end_flush();
 ?>