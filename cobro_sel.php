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
switch( $_POST['accion'] ) {
      case "Salir":
	     unset ($_SESSION["tot_err"],$_SESSION["total_s"],$_SESSION["validar"],$_SESSION["$com_f"],
		 $_SESSION["cod_sol"]);
	      //echo "Retroceder";
	     // echo "Volver atras <a href='menu_s.php'>volver</a>";
		  //unset($_SESSION['form_buffer']);
		  require 'cred_cobros.php';
	   break;
      case "Grabar":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 require 'gral_grab_cli.php';
       break;
	    case "Modificar":
	      //echo "Modificar- Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 require 'cliente_man_cm.php';
       break;
	   case "Consultar":
	      unset ($_SESSION["tot_err"], $_SESSION["total_s"],$_SESSION["validar"], $_SESSION["$com_f"],$_SESSION["cod_sol"]); 
	      //echo "Modificar- Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 require 'solic_man_cm.php';
       break;
	   case "Asignar":
	      //echo "Modificar- Grabar"; 
	      $_SESSION["validar"] = 0; 
		  $_SESSION["total_s"] = 0;
          $_SESSION["tot_err"] = 0;
		  require 'cred_montos_a.php';
       break;
	   case "Continuar":
	         $_SESSION['continuar'] = 2 ;
		     require 'cobro_pag_det.php';
		     break;
	  case "Seguir":
	      //echo "Modificar- Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 require 'solic_mante_mod.php';
       break; 
	  case "Desembol-Prov":
	      //echo "Modificar- Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 require 'cja_des_prov.php';
       break; 
	  case "Desembolsar":
	      //echo "Modificar- Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 require 'cart_desem.php';
       break;  
}
?> 
<?php
}
ob_end_flush();
 ?>
