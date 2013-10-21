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
	      $_SESSION['msg_error'] = "";
	      $_SESSION['nor_res'] = 1;
	     $_SESSION['detalle'] = 1;
	     $_SESSION['continuar'] = 1;
		  $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 0;
		   $_SESSION['menu'] = 1;
		 //    require 'solic_consulta.php';
	       header('Location: alt_entr_rec.php');
	       break;
	   case "2":
	    // $_SESSION['detalle'] = 1 ;
		// $_SESSION["tot_err"] = 0;
	    // $_SESSION['nor_res'] = 1;
	       header('Location: rec_reportes.php');
	      // require 'solic_man_cm2.php';
           break;
	  
//modificacion de los menus segun la llamada que se realiza
	   case "3":
        
	     $_SESSION["tipo_rep"] = 20;
	     header('Location: rep_param.php?menu=9');
      
           break;
      case "4":
	    $_SESSION['msg_error'] = "";
	      $_SESSION['nor_res'] = 1;
	     $_SESSION['detalle'] = 1;
	     $_SESSION['continuar'] = 1;
		  $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 0;
	     header('Location: rec_noutilizados.php');
      
           break;
      case "5":
	    $_SESSION['msg_error'] = "";
	      $_SESSION['nor_res'] = 1;
	     $_SESSION['detalle'] = 1;
	     $_SESSION['continuar'] = 1;
		  $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 0;
	     //header('Location: rec_utilizados_t.php');
         header('Location: modulo.php?modulo=8000');
           break;

         //case agregaado para que se redireccione a la pagina correcta
		case "55":
	    $_SESSION['msg_error'] = "";
	      $_SESSION['nor_res'] = 1;
	     $_SESSION['detalle'] = 1;
	     $_SESSION['continuar'] = 1;
		  $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 0;
	     //header('Location: rec_utilizados_t.php');
         header('Location: rec_utilizados_t.php');
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
	   case "8":
	     $_SESSION['detalle'] = 1 ;
	   //  $_SESSION['egre_bs_sus'] = 2 ;
	       header('Location: tipo_rep_cont3.php');
	      // require 'solic_man_cm2.php';
           break;	
		 case "9":
	     //$_SESSION['detalle'] = 1 ;
		// $_SESSION["tot_err"] = 0;
	       $_SESSION['nor_res'] = 2;
	       header('Location: cons_reserv.php');
	      // require 'solic_man_cm2.php';
           break;
		case "10":
	     $_SESSION['detalle'] = 1 ;
	     $_SESSION['continuar'] = 1 ;
		  $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 0;
		 //    require 'solic_consulta.php';
	       header('Location: con_plan_cta.php');
	       break;  
		case "11":
	     $_SESSION['detalle'] = 1 ;
	     $_SESSION['continuar'] = 1 ;
		  $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 0;
		   $_SESSION['msg_error'] = "";
		 //    require 'solic_consulta.php';
	       header('Location: alt_plan_cta.php');
	       break;       
		 case "12":
	       $_SESSION['detalle'] = 1 ;
	       $_SESSION['continuar'] = 1 ;
		   $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 0;
		   
		 //    require 'solic_consulta.php';
	       header('Location: mod_plan_cta.php');
	       break; 
		  case "13":
	     $_SESSION['detalle'] = 1 ;
	     $_SESSION['continuar'] = 1 ;
		  $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 0;
		 //    require 'solic_consulta.php';
	       header('Location: rep_plan_cta.php');
	       break; 
		   case "14":
	       $_SESSION['detalle'] = 1 ;
	       $_SESSION['continuar'] = 1 ;
		   $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 0;
		   
		 //    require 'solic_consulta.php';
	       header('Location: eli_plan_cta.php');
	       break;        	   
		   case "21":
	     $_SESSION['detalle'] = 1 ;
	     $_SESSION['continuar'] = 1 ;
		  $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 0;
		   $_SESSION['msg_error'] = "";
		 //    require 'solic_consulta.php';
	       header('Location: alt_dos_fac.php');
	       break; 
		   case "23":
	       header('Location: fac_reportes.php');
	       break; 
		   case "25":
		    $_SESSION['detalle'] = 1 ;
	       header('Location: veri_codigo.php');
	       break;
		  case "24":
		   header('Location: menu_s.php');
	       break; 
		   case "30":
		    $_SESSION['detalle'] = 1;
	       header('Location: con_ufv_act.php');
	       break;
		   case "32":
		    $_SESSION['asiento'] = 1;
			$_SESSION['detalle'] = 1;
	       header('Location: con_rev_ufv.php');
	       break;
		    case "33":
		    $_SESSION['asiento'] = 2;
			$_SESSION['detalle'] = 1;
	       header('Location: con_rev_ufv.php');
	       break;
		   case "34":
		    $_SESSION['asiento'] = 3;
			$_SESSION['detalle'] = 1;
	       header('Location: con_rev_ufv.php');
	       break;
		    case "35":
		    $_SESSION['asiento'] = 4;
			$_SESSION['detalle'] = 1;
	       header('Location: con_rev_ufv.php');
	       break;
	}
?>
 <?php
}
ob_end_flush();
 ?>