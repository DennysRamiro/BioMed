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
	     if (isset($_SESSION["$com_f"])){
		    unset ($_SESSION["$com_f"]);
			}
	     unset ($_SESSION["tot_err"],$_SESSION["total_s"],$_SESSION["validar"],$_SESSION["cod_sol"]);
	      //echo "Retroceder";
	     // echo "Volver atras <a href='menu_s.php'>volver</a>";
		  //unset($_SESSION['form_buffer']);
		  require 'menu_s.php';
	   break;
      case "Grabar":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 require 'gral_grab_cli.php';
       break;
	    case "Modificar":
		  $_SESSION['con_mod'] = 1;
	      //echo "Modificar- Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 require 'cliente_man_cm.php';
       break;
	   case "Detalles":
	    $_SESSION['con_mod'] = 2; 
	      //echo "Modificar- Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 require 'cliente_man_cm.php';
       break;
	    case "Inhabilita/Habilita":
	    $_SESSION['con_mod'] = 3; 
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
	      if ($_SESSION['c_estado'] == 1) {
		     $_SESSION['continuar'] = 2 ;
		     require 'solic_consulta.php';
			 }
		  if ($_SESSION['c_estado'] == 2) {
		      $_SESSION['continuar'] = 2 ;
		  //    require 'cliente_con_s.php';
			  require 'cred_grupo_a.php';
		  }
		  if ($_SESSION['c_estado'] == 3) {
		      $_SESSION['continuar'] = 2 ;
		      require 'cliente_con_s.php';
		  }
		  if ($_SESSION['c_estado'] == 4) {
		      $_SESSION['continuar'] = 2 ;
		      require 'cred_plan_pag.php';
		  }
		  if ($_SESSION['c_estado'] == 5) {
		      $_SESSION['continuar'] = 2 ;
		      require 'cred_contrato.php';
			//require 'cred_ord_desem.php';
		  }
		   if ($_SESSION['c_estado'] == 6) {
		      $_SESSION['continuar'] = 2 ;
		      require 'cliente_con_s3.php';
		  }
		   if ($_SESSION['c_estado'] == 5) {
		      $_SESSION['continuar'] = 2 ;
		      require 'cred_contrato.php';
			//require 'cred_ord_desem.php';
		  }
		  if ($_SESSION['c_estado'] == 7) {
		      $_SESSION['continuar'] = 2 ;
		      require 'cred_est_desem.php';
		  }
	      //echo "Modificar- Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 
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
	  case "Acoplar":
	      // $_SESSION['continuar'] = 2 ;
		      require 'solic_mante_ad.php';
	  case "Revertir-Estado":
	      // $_SESSION['continuar'] = 2 ;
		      require 'solic_rever_s.php';	
	  case "Revertir-Solicitud":
	      // $_SESSION['continuar'] = 2 ;
		      require 'solic_revertir.php';	
	   case "Impresion Plan Pagos":
	       $_SESSION['cont_imp'] = 0;
		      require 'solic_imprime_p.php';
	    case "Impresion Boletas de Pago":
	       $_SESSION['cont_imp'] = 0;
		      require 'solic_impr_bole.php';		  			  		  	  
}
?> 
<?php
}
ob_end_flush();
 ?>
