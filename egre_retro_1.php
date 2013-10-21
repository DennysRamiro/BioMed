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
		  header('Location: modulo.php?modulo=10000');
	   break;
      case "Registrar Egresos Bs.":
	     $_SESSION['detalle'] = 2 ;
	     $_SESSION['menu'] = 3 ;
	    
	    require 'reg_egresos.php';
	    // header('Location: reg_egresos.php?menu=3');
	    //   require 'solic_con_m.php';
           break;
      case "Registrar Egresos Sus.":
	     $_SESSION['detalle'] = 2 ;
	     $_SESSION['menu'] = 4 ;
		 require 'reg_egresos.php';
	    // header('Location: reg_egresos.php?menu=3');
	    //   require 'solic_con_m.php';
           break;
	  case "Registrar Vale Bs":
	 	 $_SESSION['menu'] = 1;
	      require 'cja_val_grab.php';
	      break;	
	  case "Registrar Vale Sus":
	 	 $_SESSION['menu'] = 2;
	      require 'cja_val_grab.php';
	      break;		     
	  case "Recalcular":
	     $_SESSION['detalle'] = 4;
		 //$_SESSION['t_fac_fis'] = 10;
		 require 'reg_egresos.php';
         break;	   
	  case "Imprimir Bs":
	      $_SESSION['detalle'] = 3 ;
	      $_SESSION['menu'] = 1 ;
	     // echo "prueba";
		 require 'reg_egre_grab.php';
         break;

      case "Imprimir Sus":
	      $_SESSION['detalle'] = 3 ;
	      $_SESSION['menu'] = 2 ;
	     // echo "prueba";
		 require 'reg_egre_grab.php';
         break;

	  case "Registrar Compra Sus.":
	     $_SESSION['detalle'] = 4;
	     $_SESSION['menu'] = 3;
		 //$_SESSION['t_fac_fis'] = 10;
		 require 'reg_com_ven.php';
		 break;
	  case "Registrar Venta Sus.":
	     $_SESSION['detalle'] = 4;
	     $_SESSION['menu'] = 4;
		 //$_SESSION['t_fac_fis'] = 10;
		 require 'reg_com_ven.php';
		 break;	   
      case "Recibo Compra"://Recibo_Compra
	      $_SESSION['detalle'] = 3 ;
		  $_SESSION['menu'] = 1;
		 require 'com_ven_grab.php';
         break;
	  case "Recibo Venta"://Recibo_Venta
	      $_SESSION['detalle'] = 3 ;
		  $_SESSION['menu'] = 2;
		 require 'com_ven_grab.php';
         break;
}
?> 
<?php
}
ob_end_flush();
 ?>