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
       
       //modificacion del menupara redireccionar el menu correctamente
       case "1":
	     $_SESSION['detalle'] = 1 ;
	     $_SESSION['egre_bs_sus'] = 1 ;
	     $_SESSION['menu'] = 1 ;
	     
		    require 'reg_egresos.php';
	       //header('Location: reg_egresos.php?menu=1');
	       break;
	   //modificacion del menupara redireccionar el menu correctamente
	   case "2":
	     $_SESSION['detalle'] = 1 ;
	     $_SESSION['egre_bs_sus'] = 2 ;
	      $_SESSION['menu'] = 2 ;
	       //header('Location: reg_egresos.php?menu=2');
	      require 'reg_egresos.php';
           break;
	   case "3":
         $_SESSION['detalle'] = 2 ;
		 $_SESSION['egre_bs_sus'] = 1 ;
	     //header('Location: reg_egresos.php');
	    require 'reg_egresos.php';
           break;
      case "4":
	       unset ($_SESSION['egre_bs_sus']);
		   $_SESSION['egre_bs_sus'] = 2 ;
		   //header('Location: menu_s.php');
		   require 'menu_s.php';
	       break;
      case "5":
	     $_SESSION['detalle'] = 1 ;
	     $_SESSION['c_com_ven'] = 1 ;
		 $_SESSION['menu'] = 1;
		  require 'reg_com_ven.php';
	      // header('Location: reg_com_ven.php');
	       break;
      case "6":
	     $_SESSION['detalle'] = 1 ;
	     $_SESSION['c_com_ven'] = 2 ;
		 $_SESSION['menu'] = 2;
		 require 'reg_com_ven.php';
	       //header('Location: reg_com_ven.php');
	       break;
	   //modificacion del menupara redireccionar el menu correctamente
	  case "7":
	     $_SESSION['detalle'] = 1 ;
	     $_SESSION['egre_bs_sus'] = 1 ;
		 $_SESSION['msg_error'] = "";
		 $_SESSION['menu'] = 7 ;
		   require 'reg_ingresos.php';
	       //header('Location: reg_ingresos.php?menu=1');
	       break;
	    //modificacion del menupara redireccionar el menu correctamente
	   case "8":
	     $_SESSION['detalle'] = 1 ;
	     $_SESSION['egre_bs_sus'] = 2 ;
		  $_SESSION['msg_error'] = "";
		  $_SESSION['menu'] = 8;
	       //header('Location: reg_ingresos.php?menu=2');
	      require 'reg_ingresos.php';
           break;
	    case "9":
	       //unset ($_SESSION['egre_bs_sus']);
		   //$_SESSION['egre_bs_sus'] = 2 ;
		   //header('Location: menu_s.php');
		   header('Location: modulo.php?modulo=10000');
		   
	       break;	
		case "10":
	         $_SESSION['detalle'] = 1 ;
	         $_SESSION['b_dep_ret'] = 1;
		     $_SESSION['bco_bs_sus'] = 1;
		     $_SESSION['menu'] = 10;
		     header('Location: bco_dep_ret.php');
	         break;
	  case "11":
	         $_SESSION['detalle'] = 1 ;
	         $_SESSION['b_dep_ret'] = 1;
		     $_SESSION['bco_bs_sus'] = 2;
		     $_SESSION['menu'] = 11;
		     header('Location: bco_dep_ret.php');
	         break;
	   case "12":
	         $_SESSION['detalle'] = 1 ;
	         $_SESSION['b_dep_ret'] = 2;
		     $_SESSION['bco_bs_sus'] = 1;
		     $_SESSION['menu'] = 12;
		     header('Location: bco_dep_ret.php');
	         break;
	    case "13":
	         $_SESSION['detalle'] = 1 ;
	         $_SESSION['b_dep_ret'] = 2;
		     $_SESSION['bco_bs_sus'] = 2;
		     $_SESSION['menu'] = 13;
		     header('Location: bco_dep_ret.php');
	         break;	 
		  case "14":
	         $_SESSION['detalle'] = 1 ;
	         $_SESSION['val_bs_sus'] = 1;
			 $_SESSION['menu'] = 1;
		     header('Location: cja_vales.php');
	         break;
	    case "15":
	         $_SESSION['detalle'] = 1 ;
	         $_SESSION['val_bs_sus'] = 2;
			 $_SESSION['menu'] = 2;
		     header('Location: cja_vales.php');
	         break;	    
	}
?>
 <?php
}
ob_end_flush();
 ?>