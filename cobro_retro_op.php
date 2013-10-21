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
switch( $_POST['accion'] ) {
      case "Salir":
	     //  unset ($_SESSION["tot_err"], $_SESSION["total_s"],$_SESSION["validar"], $_SESSION["$com_f"],$_SESSION["cod_sol"]);
		  // unset($_SESSION['form_buffer']);
		   require 'cred_cobros.php';
	       break;
      case "Confirmar":
	       require 'cobro_confirma.php';
           break;
	        break;
      case "Detalle":
	       $_SESSION['calculo'] = 1;
	       require 'cobro_detalle.php';
           break;
	  case "Validar":
	       require 'cobro_valida.php';
           break;
	 case "Fecha de Calculo":
	       require 'cobro_valida_1.php';
           break;
	  
	  case "Recalcular":
	       
	       require 'cart_val_cob.php';
           break;
	  case "Aplicar":
	       
	       require 'car_imp_cob.php';
           break;
	  case "Kardex":
	       
	       require 'cart_imp_kar.php';
           break;  
	  case "Mov. Fondo Garantia":
	       
	       require 'fgar_imp_kar.php';
           break;       
	}
?>  
<?php
}
    ob_end_flush();
 ?>