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
	       require 'menu_s.php';
	       break;
      case "Grabar":
	       require 'grab_sal_cja.php';
           break;
	  case "Detalle":
	       require 'cja_det_rev.php';
           break;
	  case "Revertir":
	       require 'cja_des_rev.php';
           break;
	  case "Det-cobro":
	       require 'cja_det_revc.php';
           break;
	  case "Rev-Cobro":
	       require 'cja_cob_rev.php';
           break;
	  case "Reimpresion Bancos":
	       require 'cja_rimp_bco.php';
           break;	   
	   //duplicar el case Det-Bco para diferenciar reportes de bancos en reversiones
       //y reversiones y usar el header para redireccionar

	   //case "Detalle-Banco":
     case "Detalle Bancos":
	   $_SESSION["menu"] = 1;
    // echo $_POST['nro_tra'];
	   //if (!isset($_POST['nro_tra'])) {
	   //header('Location: cja_rev_bco.php');
	 // } 
       // else {
	       require 'cja_det_bco.php';
	     // }
		break;


        // case "Det-Bco":
        // case "Reimpresion Bancos";
         //$_SESSION["menu"] = 2;
       /* if (!isset($_POST['nro_tra'])) {
         	
          header('Location: cja_rev_bco.php');
         	//echo "Variable Vacia";
         } 
         else {*/
         	
         //	require 'cja_det_bco.php';
       
	   //case "Rev-Bco":
     case "Revertir Banco":
     
	       require 'cja_bco_rev.php';
           break;


	   case "Det-tran":
	       require 'cja_det_fga.php';
           break;
	   	case "Rev-Transac":
	       require 'cja_fga_rev.php';
           break;
        //duplicar el case Det-ComVen para diferenciar reportes de bancos en reversiones
       //y reversiones y usar el header para redireccionar 

		//case "Detalle-ComVen":
    case "Detalle Compra Venta Div.":
		$_SESSION["menu"] = 3;
		 if (!isset($_POST['nro_tra'])) {
         header('Location: cja_rev_cove.php');
         	//echo "Variable Vacia";
         } 
         else {
	    require 'cja_det_cove.php';
		}
           break; 


        //case "Det-ComVen":
         case "Reimpresion Compra venta Div.":
        
        $_SESSION["menu"] = 4;
      //  if (!isset($_POST['nro_tra'])) {
       //  header('Location: cja_rev_cove.php');
         	//echo "Variable Vacia";
        // } 
        // else {
        require 'com_ven_rimp.php';
    	//}
        
        //header('Location: cja_det_cove.php?menu=4');
	     break; 

		 //case "Rev-ComVen":
     case "Reversion Compra/Venta":
	       require 'cja_cove_rev.php';
           break; 
		 
     case "Reversion Ingresos/Egresos":
	       require 'cja_ineg_rev.php';
           break;
        //duplicar el case Det-IngEgr para diferenciar reportes de bancos en reversiones
       //y reversiones y usar el header para redireccionar  

		//case "Detalle IngEgr":
    case "Detalle Ingresos Egresos":
		$_SESSION["menu"] = 7;
		if (!isset($_POST['nro_tra'])) {
		header('Location: cja_rev_ineg.php');
         	//echo "Variable Vacia";
         } 
         else {
	    require 'cja_det_ineg.php';
            }
        break;

        //case "Det-IngEgr":
        case "Reimpresion Ingresos Egresos":
        $_SESSION["menu"] = 8;
        //if (!isset($_POST['nro_tra'])) {
		//header('Location: cja_rev_ineg.php');
         	//echo "Variable Vacia";
         //} 
         //else {
	    require 'egr_ingr_rimp.php';
	    // }
           break; 
		//duplicar el case Det-ComVen para diferenciar reportes de bancos en reversiones
       //y reversiones y usar el header para redireccionar

		case  "Detalle Vales":
		$_SESSION["menu"] = 5;
		require 'cja_det_val.php';
	    
           break;


        //case "Det-Val":
        case  "Reimpresion Vales":
        $_SESSION["menu"] = 6;
        require 'cja_rimp_val.php';
	    break;


		//case "Rev-Val":
    case "Reversión Vales":
	       require 'cja_val_rev.php';
           break;

        case "Reimpresion":
		 if ($_SESSION["reimpre"] == 1){ 
	       require 'car_rimp_des.php';
		   }
		  if ($_SESSION["reimpre"] == 2){ 
	       require 'car_rimp_cob.php';
		   } 
		   if ($_SESSION["reimpre"] == 3){ 
	       require 'fga_rimp_dere.php';
		   }
           if ($_SESSION["reimpre"] == 5){ 

              if (!isset($_POST['nro_fac'])) {
           header('Location: cja_rimp_fac.php');
         	//echo "Variable Vacia";
         } 
              else {	
	       require 'fac_rimpre.php';
		   }
		}
           break;
    }
?> 
<?php
}
ob_end_flush();
 ?>