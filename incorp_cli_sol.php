<?php
	ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
	if(!isset($_SESSION['login']) || !isset($_SESSION['clave'])){
		header("Location: index.php?error=1");
} else {
	require('configuracion.php');
    //require('funciones.php');
?>
<?php
switch( $_POST['accion'] ) {
      case "Salir":
	      //  unset($_SESSION['form_buffer']);
		   require 'menu_s.php';
	       break;
      case "Agregar-Cliente":
	       require 'grab_cli_sol.php';
           break;
	  case "Agregar-Clientes":
	      require 'cliente_con_s.php';
          break;
	  case "Quitar-Cliente":
//	      echo "va a baja_cli_sol.php";
	      require 'baja_cli_sol.php';
          break; 
	  case "Alta-Cliente":
	      require 'cliente_mante_a.php';
          break;
	  case "Quitar-Deudor":
//	      echo "va a baja_cli_sol.php";
	      require 'baja_cli_sol3.php';
          break; 
	  case "Sale-Deudor":
//	      echo "va a baja_cli_sol.php";
	      require 'baja_cli_sol4.php';
          break;   
	  case "Siguiente-Paso":
	       $_SESSION["validar"] = 0; 
		  $_SESSION["total_s"] = 0;
          $_SESSION["tot_err"] = 0;
	      require 'cred_montos_a.php';
          break;
	  case "Confirmar":
	      $_SESSION['continuar'] = 1;
	      require 'cred_ord_desem.php';
          break;
	  case "Adicionar-Cliente":
	       require 'grab_cli_adc.php';
           break;
	  case "Consultar-Cliente":
	       require 'cliente_con_solic.php';
           break;
      //mod grantia ertura cta, incorporar
	  case "Consultar":
	       require 'cliente_con_sol.php';
           break;
	  case "Agregar":
	      require 'grab_cli_sol.php';
          break;
	  case "Grabar":
	      require 'grab_cli_fga.php';
          break;
	  case "Titular":
	      require 'fgar_cli_a.php';
          break;	  
	   case "Ingresa-Deudor":
	      require 'cliente_con_s.php';
          break;
	   case "Cambia-Coordinador":
	      $_SESSION['detalle'] = 1;
	      require 'cred_act_coord_2.php';
          break;	
	   	 case "Marca-Garante":
	      $_SESSION['detalle'] = 3;
	      require 'cred_act_coord_2.php';
          break;  
		 case "Cambiar":
	      $_SESSION['detalle'] = 2;
	      require 'cred_act_coord_2.php';
          break; 
		  case "Cambia-Gar":
	      $_SESSION['detalle'] = 4;
	      require 'cred_act_coord_2.php';
          break; 
		  case "Imprimir":
	      require 'cart_imp_plan.php';
          break;   	   
     }
?> 
<?php
}
ob_end_flush();
 ?>
