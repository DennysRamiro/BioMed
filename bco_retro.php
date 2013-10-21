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
	      //echo "Retroceder";
	     // echo "Volver atras <a href='menu_s.php'>volver</a>";
		  require 'cja_bancos.php';
	   break;
      case "Registrar Deposito Bs.":
	  
	     $_SESSION['detalle'] = 2 ;
	     $_SESSION['menu'] = 14 ;
		 require 'bco_dep_ret.php';
	     //echo "llego aqui";

	   //  header('Location: reg_egresos.php');
	    //   require 'solic_con_m.php';
           break;
 	  case "Registrar Deposito Sus.":
	  
	     $_SESSION['detalle'] = 2 ;
	     $_SESSION['menu'] = 15 ;
		 require 'bco_dep_ret.php';
	   //  header('Location: reg_egresos.php');
	    //   require 'solic_con_m.php';
           break; 

        case "Registrar Retiro Bs.":
	  
	     $_SESSION['detalle'] = 2 ;
	     $_SESSION['menu'] = 16 ;
		 require 'bco_dep_ret.php';
	   //  header('Location: reg_egresos.php');
	    //   require 'solic_con_m.php';
           break; 

          case "Registrar Retiro Sus.":
	  
	     $_SESSION['detalle'] = 2 ;
	     $_SESSION['menu'] = 17 ;
		 require 'bco_dep_ret.php';
	   //  header('Location: reg_egresos.php');
	    //   require 'solic_con_m.php';
           break; 

	  case "Grab_vale":
	      require 'cja_val_grab.php';
	      break;	   
	  case "Recalcular":
	     $_SESSION['detalle'] = 4;
		 //$_SESSION['t_fac_fis'] = 10;
		
		 require 'reg_egresos.php';
	   //  header('Location: reg_egresos.php');
	    //   require 'solic_con_m.php';
           break;	   
	    case "Imprimir":
	      $_SESSION['detalle'] = 3 ;
		 require 'reg_egre_grab.php';
		 
       break;
	   case "Calcular":
	     $_SESSION['detalle'] = 4;
		 //$_SESSION['t_fac_fis'] = 10;
		
		 require 'reg_com_ven.php';
	   case "Recibo":
	   	$_SESSION['menu'] = 1;
	    $_SESSION['detalle'] = 3 ;
		 require 'banco_grab.php';
		 
       break;
	   case "Recibo Sus":
	   $_SESSION['menu'] = 2;
	      $_SESSION['detalle'] = 3 ;
		 require 'banco_grab.php';
       break;
	   case "Recibo Bs":
	   $_SESSION['menu'] = 3;
	      $_SESSION['detalle'] = 3 ;
		 require 'banco_grab.php';
       break;
	   case "Recibo Dol":
	   $_SESSION['menu'] = 4;
	      $_SESSION['detalle'] = 3 ;
		 require 'banco_grab.php';
       break;
}
?> 
<?php
}
ob_end_flush();
 ?>