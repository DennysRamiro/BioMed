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
switch( $_GET['accion'] ) {
       case "1":
	       $_SESSION['producto'] = 1 ;
		   header('Location: solic_mante_aa.php');
	       break;
	   case "2":
	       $_SESSION['producto'] = 2 ;
	       header('Location: solic_man_cm3.php');
	       break;
	   case "3":
	       $_SESSION['producto'] = 3 ;
	       header('Location: solic_adiciona.php');
	       break;
      case "4":
	       unset ($_SESSION["tot_err"], $_SESSION["total_s"],$_SESSION["validar"], $_SESSION["$com_f"],$_SESSION["cod_sol"]);
		   header('Location: menu_s.php');
	       break;
      case "5":
	       header('Location: solic_mante_aa.php');
	       break;
      case "Clientes":
	       require 'cliente_con_m_sol.php';
           break;
	  case "Grupo":
	       require 'grupo_con_m_sol.php';
           break;
	  case "Continuar":
	       require 'solic_mante_proc.php';
		   break;
	  case "Grabar":
	       require 'grab_sol_com.php';
           break;
	  case "Modificar":
	       require 'solic_man_cm2.php';
           break;
	  case "Grabar-Montos":
	       require 'cred_val_m.php';
		   $_SESSION['continuar'] = 2 ;
           break;
	  case "Registrar Cambios":
	        $_SESSION['continuar'] = 2 ;
	       require 'grab_sol_com_m.php';
           break;
	  case "Siguiente Paso":
		   $_SESSION['continuar'] = 1 ;
	       if ($_SESSION['cod_tipo'] == 1) {
              require 'cliente_con_s2.php';
	          break;
			  }
           if ($_SESSION['cod_tipo'] == 2) {
              require 'cliente_con_s2.php';
	          break;
			  }
	       if ($_SESSION['cod_tipo'] == 3) {
              require 'cliente_con_s2.php';
	          break;
			  }
	     case "Elegir Otro Grupo":
	     	  $_SESSION["continuar"] = 1; 
	    	  require 'grupo_con_m_sol.php';
		 case "Siguiente-Paso":
		     require 'cred_val_m.php';
              break;
		 case "Plan de Pagos":
		      require 'cred_plan_pag.php';
              break;
	     case "Plan_Pag_Completo":
		      $_SESSION['continuar'] = 1;
		      require 'cred_grab_plan_p.php';
              break;
		 case "Contrato":	  
		      $_SESSION['continuar'] = 1 ;
		      require 'cred_contrato.php'; 	  
		      break;
	     case "Impresion Contrato":
		      $cod_sol = $_SESSION['nro_sol'];
			  $act_cred_solic  = "update cred_solicitud set CRED_SOL_ESTADO=6 where CRED_SOL_CODIGO = $cod_sol and                                  CRED_SOL_USR_BAJA is null";
              $res_act_s = mysql_query($act_cred_solic);
		      require 'cred_imp_cont1.php';
              break;
	     case "Impresion Orden Desem":
		      $cod_sol = $_SESSION['nro_sol'];
			  $act_cred_solic  = "update cred_solicitud set CRED_SOL_ESTADO=7 where CRED_SOL_CODIGO = $cod_sol and                                  CRED_SOL_USR_BAJA is null";
              $res_act_s = mysql_query($act_cred_solic);
		      require 'cred_imp_odesem.php';
              break;
		 case "Imp_Desembolso":
			  require 'car_imp_des.php';
              break;
	}
?>  
<?php
}
ob_end_flush();
 ?>