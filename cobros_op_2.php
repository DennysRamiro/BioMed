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
      
//modificandoo el menu para que redireccione el menu
      case "1":
	      $_SESSION['msg_err']="";
	     $_SESSION['cart_fgar'] = 1;
		 header('Location: grupo_con_cob.php?menu=11');
	   break;
	   //duplicar case 1 para diferenciar segun menu
	   case "99":
	      $_SESSION['msg_err']="";
	     $_SESSION['cart_fgar'] = 1;
		 header('Location: grupo_con_cob.php?menu=12');
	   break;
	   //duplicar case 1 para diferenciar segun menu
	   case "100":
	      $_SESSION['msg_err']="";
	     $_SESSION['cart_fgar'] = 1;
		 header('Location: grupo_con_cob.php?menu=13');
	   break;
      case "2":
	     // echo "Grabar"; 
	     $_SESSION['msg_err']= ""; 
		 $_SESSION['cart_fgar'] = 1;
		 header('Location: cliente_con_cobro.php?menu=11');
       break;
       //duplicar case 2 para diferenciar segun menu
       case "101":
	     // echo "Grabar"; 
	     $_SESSION['msg_err']= ""; 
		 $_SESSION['cart_fgar'] = 1;
		 header('Location: cliente_con_cobro.php?menu=12');
       break;
       //duplicar case 2 para diferenciar segun menu
       case "102":
	     // echo "Grabar"; 
	     $_SESSION['msg_err']= ""; 
		 $_SESSION['cart_fgar'] = 1;
		 header('Location: cliente_con_cobro.php?menu=13');
       break;

	   case "3":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 header('Location: cobro_con.php');
       break;
	   case "4":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php');
		 //header('Location: modulo.php');
		 //header('Location:  cred_cobros.php');
		 header('Location:  modulo.php?modulo=6000');
		
       break;
	   case "5":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php');
		 $_SESSION["tip_cta"] = 1;
		 header('Location: tipo_rep_4.php?menu=11');
       break;
       //duplicar case 5 para diferenciar segun menu
       case "103":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php');
		 $_SESSION["tip_cta"] = 1;
		 header('Location: tipo_rep_4.php?menu=12');
       break;
       //duplicar case 5 para diferenciar segun menu
       case "104":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php');
		 $_SESSION["tip_cta"] = 1;
		 header('Location: tipo_rep_4.php?menu=13');
       break;
	    case "10":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php');
		 $_SESSION["tip_cta"] = 3;
		 header('Location: cliente_con_solic.php');
       break;
	   //modificar un parametro menu para diferenciar el reporte 
	   case "11":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php');
		 $_SESSION['vig_can'] = 3;
		header('Location: tipo_rep_aho.php?menu=5');
       break;
	     //aumentar un parametro menu para diferenciar el reporte 
        //del resto q llaman al mismo
	    case "12":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php');
		 $_SESSION["tip_cta"] = 1;
		 header('Location: tipo_rep_4.php?menu=3');
       break;
	    case "60":
	      //echo "Retroceder";
	     $_SESSION['cart_fgar'] = 2;
		 header('Location: grupo_con_cob.php?menu=1');
	   break;
	   //case aumentado para el menu
	   case "61":
	      //echo "Retroceder";
	     $_SESSION['cart_fgar'] = 2;
		 header('Location: grupo_con_cob.php?menu=2');
	   break;
      case "70":
	     // echo "Grabar"; 
		 $_SESSION["tip_cta"] = 0;
	     $_SESSION['cart_fgar'] = 2;
		 header('Location: cliente_con_cobro.php?menu=1');
       break;
       //case aumentado para que se diferencia el menu 
       case "71":
	     // echo "Grabar"; 
		 $_SESSION["tip_cta"] = 0;
	     $_SESSION['cart_fgar'] = 2;
		 header('Location: cliente_con_cobro.php?menu=2');
       break;

	   case "80":
	     // echo "Grabar"; 
	      $_SESSION["tip_cta"] = 0;
		  header('Location: modulo.php?modulo=11000');
       break;

//aumentando un case para que regrese al modulo que le corresponde

 		case "81":
	     // echo "Grabar"; 
	      $_SESSION["tip_cta"] = 0;
		  header('Location: modulo.php?modulo=10000');
       break;

	   case "90":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php');
		 $_SESSION["tip_cta"] = 2;
		 $_SESSION['cart_fgar'] = 2;		 
		 header('Location: tipo_rep_4.php?menu=1');
       break;

       case "91":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php');
		 $_SESSION["tip_cta"] = 2;
		 $_SESSION['cart_fgar'] = 2;		 
		 header('Location: tipo_rep_4.php?menu=2');
       break;
	   
	   
	   
}
?> 
<?php
}
ob_end_flush();
 ?>