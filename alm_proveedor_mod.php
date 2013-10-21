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
switch( $_GET['accion'] ) {
      case "1":
	      //echo "Retroceder";
	     // echo "Volver atras <a href='menu_s.php'>volver</a>";
		 header('Location: alm_proveedor_mod_al.php');
	   break;
	   // Consultar
      case "2":
	     // echo "Grabar"; 
	     $_SESSION['alm_mod'] = 1;

	     //echo $_SESSION['alm_mod'];
		 header('Location: alm_proveedor_mod_cons.php?menu=1');
       break;
       // consultar/ despues de crear
        case "6":
	     // echo "Grabar"; 
	     $_SESSION['alm_mod'] = 1;

	     //echo $_SESSION['alm_mod'];
		 header('Location: alm_proveedor_mod_cons.php?menu=2');
       break;

	   case "3":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php'); 
		$_SESSION['alm_mod'] = 2;
		 header('Location: alm_proveedor_mod_al.php');
       break;
	    case "5":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php'); 
		$_SESSION['alm_mod'] = 3;
		 header('Location: alm_proveedor_mod_al.php');
       break;
	   case "4":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php');
		
		 //header('Location: menu_s.php');
		 header('Location: modulo.php?modulo=2000');
		 
       break;
}
?> 
<?php
}
ob_end_flush();
 ?>

