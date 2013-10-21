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
	       $_SESSION["nro_sol"] = 0;
	       $_SESSION["cod_sol"] = 0;
		   $_SESSION["cod_grupo"] = 0;
		   $_SESSION['c_grup']= 0;
	       header('Location: solic_alta.php');
	       break;
	   case "2":
	      $_SESSION["nro_sol"] = 0;
	       $_SESSION["cod_sol"] = 0;
		   $_SESSION["cod_grupo"] = 0;
		   $_SESSION['c_grup']= 0;
	       header('Location: solic_man_cm2.php');
	      // require 'solic_man_cm2.php';
           break;
	   case "3":
	      $_SESSION["nro_sol"] = 0;
	       $_SESSION["cod_sol"] = 0;
		   $_SESSION["cod_grupo"] = 0;
		   $_SESSION['c_grup']= 0;
	      //  unset ($_SESSION["tot_err"], $_SESSION["total_s"],$_SESSION["validar"], $_SESSION["$com_f"],$_SESSION["cod_sol"]);
	       header('Location: solic_con_m.php');
	    //   require 'solic_con_m.php';
           break;
      case "4":
	       $_SESSION["nro_sol"] = 0;
	       $_SESSION["cod_sol"] = 0;
		   $_SESSION["cod_grupo"] = 0;
		   $_SESSION['c_grup']= 0;
	       unset ($_SESSION["tot_err"], $_SESSION["total_s"],$_SESSION["validar"], $_SESSION["$com_f"],$_SESSION["cod_sol"]);
		   //header('Location: menu_s.php');
		   header('Location:modulo.php?modulo=4000');
	       break;
      case "5":
	      $_SESSION["nro_sol"] = 0;
	       $_SESSION["cod_sol"] = 0;
		   $_SESSION["cod_grupo"] = 0;
		   $_SESSION['c_grup']= 0;
	       header('Location: solic_mante_aa.php');
	       break;
	  	case "6":
	      $_SESSION["nro_sol"] = 0;
	       $_SESSION["cod_sol"] = 0;
		   $_SESSION["cod_grupo"] = 0;
		   $_SESSION['c_grup']= 0;
		   $_SESSION['c_estado'] = 10;
	       header('Location: solic_rev_est.php');
	       break;   
		 case "7":
	      $_SESSION["nro_sol"] = 0;
	       $_SESSION["cod_sol"] = 0;
		   $_SESSION["cod_grupo"] = 0;
		   $_SESSION['c_grup']= 0;
		   $_SESSION['c_estado'] = 8;
	       header('Location: solic_rev_sol.php');
	       break;   
		  case "8":
	      $_SESSION["nro_sol"] = 0;
	       $_SESSION["cod_sol"] = 0;
		   $_SESSION["cod_grupo"] = 0;
		   $_SESSION['c_grup']= 0;
		   $_SESSION['c_estado'] = 8;
	       header('Location: solic_imp_plan.php');
	       break;   
		     case "9":
	      $_SESSION["nro_sol"] = 0;
	       $_SESSION["cod_sol"] = 0;
		   $_SESSION["cod_grupo"] = 0;
		   $_SESSION['c_grup']= 0;
		   $_SESSION['c_estado'] = 8;
	       header('Location: solic_imp_bol.php');
	       break; 
     	}
?>
 <?php
}
ob_end_flush();
 ?>