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
		  unset($_SESSION['form_buffer']);
		  require 'menu_s.php';
	   break;
      case "Agregar-Cliente":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 require 'grab_cli_grup.php';
       break;
	    case "Alta-Cliente":
	      //echo "Modificar- Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 require 'cliente_mante_a.php';
       break;
	   case "Cobro":
	      //echo "Modificar- Grabar"; 
	      $_SESSION['continuar'] = 2;
		 require 'cobro_pag_det.php';
       break;
	   case "Cobro Directo":    //SE CAMBIA EL NOMBRE DE "COB_DIRECTO" POR "COBRO DIRECTO"
	      //echo "Modificar- Grabar"; 
	      $_SESSION['continuar'] = 2;
		 require 'cobro_pag_det.php';
       break;
	   case "Consulta":
	      //echo "Modificar- Grabar"; 
	      $_SESSION['continuar'] = 2;
		 require 'cobro_pag_det.php';
       break;
	    case "Dep-Ret":
	      //echo "Modificar- Grabar"; 
	      $_SESSION['continuar'] = 2;
		 require 'fgar_tran_det.php';
       break;
}
?> 
<?php
}
ob_end_flush();
 ?>
