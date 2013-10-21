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
      

//modificacion del menu para que se redireccione correctamente
       case "1":
	      $_SESSION['nor_res'] = 1;
	     $_SESSION['detalle'] = 1;
	     $_SESSION['continuar'] = 1;
		  $_SESSION['modificar'] = 0;
		   $_SESSION['menu'] = 16;

		    require 'con_asiento.php';
	       //header('Location: con_asiento.php?menuinicio=1');
	       break;
	   
//modificacion del menu para que se redireccione correctamente

	   case "2":
	     $_SESSION['detalle'] = 1 ;
		 $_SESSION["tot_err"] = 0;
	     $_SESSION['nor_res'] = 1;
	     $_SESSION['menu'] = 24;
	       //header('Location: tipo_rep_cont2.php?menu=1');
	      require 'tipo_rep_cont2.php';
           break;
	  
//modificacion del menu para que se redireccione correctamente

	   case "3":
        // $_SESSION['detalle'] = 2 ;
	     header('Location: con_revalor.php?menu=1');
	    //   require 'solic_con_m.php';
           break;
      case "4":
	       unset ($_SESSION['egre_bs_sus']);
		   //header('Location: menu_s.php');
		   header('Location: modulo.php?modulo=8000');
	       break;
      case "5":
	     $_SESSION['detalle'] = 1 ;
	     $_SESSION['c_com_ven'] = 1 ;
		 //    require 'solic_consulta.php';
	       header('Location: reg_com_ven.php');
	       break;
      case "6":
	     $_SESSION['detalle'] = 1 ;
	     $_SESSION['c_com_ven'] = 2 ;
		 //    require 'solic_consulta.php';
	       header('Location: reg_com_ven.php');
	       break;
	  case "7":
	     $_SESSION['detalle'] = 1 ;
	   //  $_SESSION['egre_bs_sus'] = 2 ;
	       header('Location: cons_asiento.php');
	      // require 'solic_man_cm2.php';
           break;
	   
//modificacion del menu para que se redireccione correctamente
	   case "8":
	     $_SESSION['detalle'] = 1 ;
	   //  $_SESSION['egre_bs_sus'] = 2 ;
	       header('Location: tipo_rep_cont3.php?menu=1');
	      // require 'solic_man_cm2.php';
           break;	
		
//modificacion del menu para que se redireccione correctamente
		 case "9":
	     //$_SESSION['detalle'] = 1 ;
		// $_SESSION["tot_err"] = 0;
	       $_SESSION['nor_res'] = 2;
	       $_SESSION['menu'] = 1;
	       //header('Location: cons_reserv.php?menu=1');
	       require 'cons_reserv.php';
           break;
          //Aumentar el parametro menu para diferenciar un reporte del otro

		case "10":
	     $_SESSION['detalle'] = 1 ;
	     $_SESSION['continuar'] = 1 ;
		  $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 0;
		 //    require 'solic_consulta.php';
	       header('Location: con_plan_cta.php?menu=1');
	       break;
	    //Aumentar el parametro menu para diferenciar un reporte del otro  
		case "11":
	     $_SESSION['detalle'] = 1 ;
	     $_SESSION['continuar'] = 1 ;
		  $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 0;
		   $_SESSION['msg_error'] = "";
		   $_SESSION['menu'] = 5;
		     require 'alt_plan_cta.php';
	       //header('Location: alt_plan_cta.php?menu=5');
	       break;
	    //Aumentar el parametro menu para diferenciar un reporte del otro         
		 case "12":
	       $_SESSION['detalle'] = 1 ;
	       $_SESSION['continuar'] = 1 ;
		   $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 0;
		   $_SESSION['menu'] = 7;
		   
		   require 'mod_plan_cta.php';
	       //header('Location: mod_plan_cta.php?menu=7');
	       break; 
	    //Aumentar el parametro menu para diferenciar un reporte del otro 
		  case "13":
	     $_SESSION['detalle'] = 1 ;
	     $_SESSION['continuar'] = 1 ;
		  $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 0;
		 //    require 'solic_consulta.php';
	       header('Location: rep_plan_cta.php?menu=11');
	       break; 
	       //Aumentar el parametro menu para diferenciar un reporte del otro 
		   case "14":
	       $_SESSION['detalle'] = 1 ;
	       $_SESSION['continuar'] = 1 ;
		   $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 0;
		   $_SESSION['menu'] = 9;
		   
		   require 'eli_plan_cta.php';
	      // header('Location: eli_plan_cta.php?menu=9');
	       break;        	   
		   
//MODIFICACION DEL MENU DE CONTABILIDAD PARA REDIRECCIONAR EL MENU
		  case "20":
		 //    require 'solic_consulta.php';
	       header('Location: cont_menu_dos.php');
	       break; 
		   
		   case "21":
	     $_SESSION['detalle'] = 1 ;
	     $_SESSION['continuar'] = 1 ;
		  $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 0;
		   $_SESSION['msg_error'] = "";
		 //    require 'solic_consulta.php';
	       header('Location: alt_dos_fac.php?menu=1');
	       break; 
		   //Dosificacion automtico
		    case "21i":
	     $_SESSION['detalle'] = 2 ;
	     $_SESSION['continuar'] = 1 ;
		  $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 0;
		   $_SESSION['msg_error'] = "";
		 //    require 'solic_consulta.php';
	       header('Location: alt_dos_fac_manual.php?menu=2');
	       break;
		    case "22":
		    $_SESSION['detalle'] = 1;
	       header('Location: con_fac.php');
	       break;
		   case "23":
	       header('Location: fac_reportes.php');
	       break; 
		   case "25":
		    $_SESSION['detalle'] = 1 ;
	       header('Location: veri_codigo.php');
	       break;
		  case "24":
		   //header('Location: menu_s.php');
		   header('Location: modulo.php?modulo=8000');
	       break; 
		   case "30":
		    $_SESSION['detalle'] = 1;
		    //$_SESSION['menu'] = 1;
	       header('Location: con_ufv_act.php');
	       break;
		    case "31":
		    $_SESSION['detalle'] = 1;
		    //$_SESSION['menu'] = 2;
	       header('Location: con_ufv.php');
	       break;
		   case "32":
		    $_SESSION['asiento'] = 1;
			$_SESSION['detalle'] = 1;
			$_SESSION['menu'] = 1;
	       header('Location: con_rev_ufv.php');
	       break;
		    case "33":
		    $_SESSION['asiento'] = 2;
			$_SESSION['detalle'] = 1;
			$_SESSION['menu'] = 2;
	       header('Location: con_rev_ufv.php');
	       break;
		   case "34":
		    $_SESSION['asiento'] = 3;
			$_SESSION['detalle'] = 1;
			$_SESSION['menu'] = 3;
	       header('Location: con_rev_ufv.php');
	       break;
		    case "35":
		    $_SESSION['asiento'] = 4;
			$_SESSION['detalle'] = 1;
			$_SESSION['menu'] = 4;
	       header('Location: con_rev_ufv.php');
	       break;

	   // DUPLICAR EL CASE DEL REPORTE DE CONTABILIDAD PARA DIFERENCIAR DEL MANT. CUENTAS 
	       //Aumentar el parametro menu para diferenciar un reporte del otro
	       case "36":
	     $_SESSION['detalle'] = 1 ;
	     $_SESSION['continuar'] = 1 ;
		  $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 0;
		 //    require 'solic_consulta.php';
	       header('Location: con_plan_cta.php?menu=2');
	       break;
	       //Aumentar el parametro menu para diferenciar un reporte del otro  
	       case "37":
			     $_SESSION['detalle'] = 1 ;
			     $_SESSION['continuar'] = 1 ;
				 $_SESSION['modificar'] = 0;
				 $_SESSION['eliminar'] = 0;
				 //    require 'solic_consulta.php';
			       header('Location: con_plan_cta.php?menu=3');
			       break;
	       //Aumentar el parametro menu para diferenciar un reporte del otro  
	       case "38":
	     $_SESSION['detalle'] = 1 ;
	     $_SESSION['continuar'] = 1 ;
		  $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 0;
		 //    require 'solic_consulta.php';
	       header('Location: con_plan_cta.php?menu=4');
	       break;  
	      //Aumentar el parametro menu para diferenciar un reporte del otro  estado sys
	       case "39":
	     $_SESSION['detalle'] = 1 ;
	     $_SESSION['continuar'] = 1 ;
		  $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 0;
		   $_SESSION['msg_error'] = "";
		 //    require 'solic_consulta.php';
	       header('Location: alt_plan_cta.php?menu=6');
	       break; 
	       //Aumentar el parametro menu para diferenciar un reporte del otro  balance  gral
	       case "40":
	       $_SESSION['detalle'] = 1 ;
	       $_SESSION['continuar'] = 1 ;
		   $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 0;
		   
		 //    require 'solic_consulta.php';
	       header('Location: mod_plan_cta.php?menu=8');
	       break; 
	       //Aumentar el parametro menu para diferenciar un reporte del otro  EERR balance
	       case "41":
	       $_SESSION['detalle'] = 1 ;
	       $_SESSION['continuar'] = 1 ;
		   $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 0;
		   
		 //    require 'solic_consulta.php';
	       header('Location: eli_plan_cta.php?menu=10');
	       break;  
	       //Aumentar el parametro menu para diferenciar un reporte del otro  mayor ctas
	        case "42":
	     $_SESSION['detalle'] = 1 ;
	     $_SESSION['continuar'] = 1 ;
		  $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 0;
		 //    require 'solic_consulta.php';
	       header('Location: rep_plan_cta.php?menu=12');
	       break; 
	}
?>
 <?php
}
ob_end_flush();
 ?>