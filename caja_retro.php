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
	//aumentar el parametro menu para diferenciar el reporte
       case "1":
	    // $_SESSION['msje'] = "";
	     $_SESSION['detalle'] = 1 ;
		 $_SESSION['continuar'] = 1;
	     $_SESSION['caja_bs_sus'] = 1;
		 //    require 'solic_consulta.php';
	       header('Location: cja_fin_saldo.php?menu=1');
	       break;
	//aumentar el parametro menu para diferenciar el reporte
	   case "2":
	     $_SESSION['detalle'] = 1 ;
		 $_SESSION['continuar'] = 1;
	     $_SESSION['caja_bs_sus'] = 2 ;
	       header('Location: cja_fin_saldo.php?menu=2');
	      // require 'solic_man_cm2.php';
           break;
	   case "3":
         $_SESSION['detalle'] = 2 ;
		// $_SESSION['egre_bs_sus'] = 1 ;
	     //header('Location: menu_s.php');
	     header('Location: modulo.php?modulo=10000');
	    //   require 'solic_con_m.php';
           break;
      case "4":
	       unset ($_SESSION['egre_bs_sus']);
		   $_SESSION['egre_bs_sus'] = 2 ;
		   header('Location: menu_s.php');
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
	     $_SESSION['egre_bs_sus'] = 1 ;
		 //    require 'solic_consulta.php';
	       header('Location: reg_ingresos.php');
	       break;
	   case "8":
	     $_SESSION['detalle'] = 1 ;
	     $_SESSION['egre_bs_sus'] = 2 ;
	       header('Location: reg_ingresos.php');
	      // require 'solic_man_cm2.php';
           break;
	    case "9":
	       //unset ($_SESSION['egre_bs_sus']);
		   //$_SESSION['egre_bs_sus'] = 2 ;
		   header('Location: menu_s.php');
	       break;	   
	}
?>
 <?php
}
ob_end_flush();
 ?>