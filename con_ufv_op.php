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
	       require 'con_mant_ufv.php';
	       break;
	  case "Salir_Menu":
	       require 'con_mant_fac.php';
	       break;
	   case "Revalorizar":
	       $_SESSION['detalle'] = 2;
	       require 'con_rev_ufv.php';
	       break;	   
      case "Consultar":
	       $_SESSION['detalle'] = 2;
		   require 'con_ufv_act.php';
	       break;
	   case "Nueva Linea":
	       $_SESSION['detalle'] = 1;
		   $_SESSION['continuar'] = 2;
		    $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 0;
		   require 'con_asi_mod.php';
	       break;	   
	  case "Actualizar":
	        $_SESSION['detalle'] = 3;
		   require 'con_ufv_act.php';
	       break;
	   case "Valida_Cta":
	      // echo "aqui detalle 34";
	     //  $_SESSION['continuar'] = 3;
	       $_SESSION['detalle'] = 2;
		   //$_SESSION['continuar'] = 2;
		   require 'alt_plan_cta.php';
	       break;	
	   case "Grabar_Cta":
	      // echo "aqui detalle 34";
	     //  $_SESSION['continuar'] = 3;
	       $_SESSION['detalle'] = 3;
		   //$_SESSION['continuar'] = 2;
		   require 'alt_plan_cta.php';
	       break;	      
	  case "Graba_Modificado":
	      // echo "aqui detalle 34";
	       $_SESSION['continuar'] = 3;
	       $_SESSION['detalle'] = 3;
		   //$_SESSION['continuar'] = 2;
		   require 'con_asi_mod.php';
	       break;
	   case "Grabar_Mod":
	      // echo "aqui detalle 34";
	       $_SESSION['continuar'] = 3;
	       $_SESSION['detalle'] = 3;
		   //$_SESSION['continuar'] = 2;
		   require 'mod_plancta.php';
	       break;	
	   case "Eli_Cuenta":
	      // echo "aqui detalle 34";
	       $_SESSION['continuar'] = 3;
	       $_SESSION['detalle'] = 3;
		   //$_SESSION['continuar'] = 2;
		   require 'eli_plancta.php';
	       break;	   	   	   
	  case "Imprimir":
    	   require 'con_asin_grab.php';
	       break;
	 case "Imprime_Mod":
    	   require 'con_asin_grab2.php';
	       break; 	   
	  case "Contabilizar":
		   require 'con_ciedia_grab.php';
		   break;
	 case "Procesar":
	       $_SESSION['continuar'] = 2;
		if ($_SESSION['tipo'] == 1){ 
		  // $_SESSION['detalle'] = 3;
		   require 'con_mayor_11.php';
		 }  
		if ($_SESSION['tipo'] == 2){ 
		  // $_SESSION['detalle'] = 3;
		   require 'con_mayor_22.php';
		 }  
		if ($_SESSION['tipo'] == 3){ 
		  // $_SESSION['detalle'] = 3;
		   require 'con_mayor_33.php';
		 }   
		   break; 	
	case "Generar":
	       $_SESSION['continuar'] = 2;
		  // $_SESSION['detalle'] = 3;
		 //  require 'imprimir_dia.php';
		  require 'prueba_imp.php';
		   break;	      
	   case "Modificar":
	       $_SESSION['detalle'] = 1;
		   $_SESSION['continuar'] = 0;
		   $_SESSION['eliminar'] = 0;
		   $_SESSION['modificar'] = 1;
		   require 'con_asiento.php';
	       break;
		 case "Modifica Asiento":
		   $_SESSION['detalle'] = 1;
		   $_SESSION['continuar'] = 1;
		   $_SESSION['eliminar'] = 0;
		   $_SESSION['modificar'] = 0;
		   $_SESSION['mod_cop'] = 1; 
		   require 'con_asi_mod.php';
	       break;   
		 case "Copiar":
		   $_SESSION['detalle'] = 1;
		   $_SESSION['continuar'] = 1;
		   $_SESSION['eliminar'] = 0;
		   $_SESSION['modificar'] = 0;
		   $_SESSION['mod_cop'] = 2; 
		   $_SESSION['nor_res'] = 1;
		   require 'con_asi_mod.php';
	       break;   
		 case "Copiar_Otro":
		   $_SESSION['detalle'] = 1;
		   $_SESSION['continuar'] = 1;
		   $_SESSION['eliminar'] = 0;
		   $_SESSION['modificar'] = 0;
		   $_SESSION['mod_cop'] = 2; 
		   $_SESSION['nor_res'] = 2;
		   require 'tipo_rep_cont2.php';
	       break; 
		    case "Copiar_2":
		   $_SESSION['detalle'] = 1;
		   $_SESSION['continuar'] = 1;
		   $_SESSION['eliminar'] = 0;
		   $_SESSION['modificar'] = 0;
		   $_SESSION['mod_cop'] = 2; 
		   $_SESSION['nor_res'] = 2;
		   $_SESSION['descrip'] = "";
		   require 'con_asi_mod.php';
	       break;      
	   case "Recibo":
	      $_SESSION['detalle'] = 3 ;
		 require 'com_ven_grab.php';
		 
       break;
	   case "Grab_modi":
	      // echo "aqui detalle 5 Grab_modi";
	       $_SESSION['continuar'] = 5;
	       //$_SESSION['detalle'] = 3;
		   //$_SESSION['continuar'] = 2;
		   require 'con_asiento.php';
	       break;
	   case "Añadir":
	       $_SESSION['detalle'] = 1;
		   $_SESSION['continuar'] = 2;
		   $_SESSION['eliminar'] = 0;
		   $_SESSION['modificar'] = 0;
		   $_SESSION['prov'] = 0;
		   require 'cja_fin_saldo.php';
	       break;
	   case "Eliminar":
	     //  $_SESSION['entra'] = "entra a eliminar menu";
	       $_SESSION['detalle'] = 1;
		   $_SESSION['continuar'] = 0;
		   $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 1;
		   $_SESSION['prov'] = 0;
		   require 'cja_fin_saldo.php';
	       break; 
		 case "Elimina_linea":
	     //  $_SESSION['entra'] = "entra a eliminar menu";
	       $_SESSION['detalle'] = 1;
		   $_SESSION['continuar'] = 0;
		   $_SESSION['modificar'] = 0; 
		   $_SESSION['eliminar'] = 1;
		   require 'con_asiento.php';
	       break;  
		   case "Elimina_fila":
	     //  $_SESSION['entra'] = "entra a eliminar menu";
	       $_SESSION['detalle'] = 1;
		   $_SESSION['continuar'] = 0;
		   $_SESSION['modificar'] = 0; 
		   $_SESSION['eliminar'] = 1;
		   require 'con_asi_mod.php';
	       break;   
		case "Mod_cant":
	     //  $_SESSION['entra'] = "entra a eliminar menu";
	       $_SESSION['detalle'] = 1;
		   $_SESSION['continuar'] = 0;
		   $_SESSION['eliminar'] = 0;
		   $_SESSION['modificar'] = 1;
		   $_SESSION['prov'] = 0;
		   require 'cja_fin_saldo.php';
	       break; 
		 case "Grab_mod":
	     //  $_SESSION['entra'] = "entra a eliminar menu";
	       $_SESSION['detalle'] = 1;
		   $_SESSION['continuar'] = 0;
		   $_SESSION['eliminar'] = 0;
		   $_SESSION['modificar'] = 0;
		   $_SESSION['grab_mod'] = 1;
		   $_SESSION['prov'] = 0;
		   require 'cja_fin_saldo.php';
	       break;  
		  case "Grab_cortes":
	     //  $_SESSION['entra'] = "entra a eliminar menu";
	       $_SESSION['detalle'] = 0;
		   $_SESSION['continuar'] = 0;
		   $_SESSION['eliminar'] = 0;
		   $_SESSION['modificar'] = 0;
		   $_SESSION['grab_mod'] = 0;
		   $_SESSION['grab_def_prov'] = 2;
		   $_SESSION['prov'] = 0;
		   require 'cortes_grab.php';
	       break;  
		   case "Otra_transac":
	     //  $_SESSION['entra'] = "entra a eliminar menu";
	       $_SESSION['detalle'] = 0;
		   $_SESSION['continuar'] = 0;
		   $_SESSION['eliminar'] = 0;
		   $_SESSION['modificar'] = 0;
		   $_SESSION['grab_mod'] = 1;
		   $_SESSION['grab_def_prov'] = 1;
		   $_SESSION['prov'] = 0;
		   require 'cortes_grab.php';
	       break; 
		    case "Corriga":
	     //  $_SESSION['entra'] = "entra a eliminar menu";
	        $_SESSION['detalle'] = 1 ;
		 $_SESSION['continuar'] = 1;
		   $_SESSION['eliminar'] = 0;
		   $_SESSION['modificar'] = 0;
		   $_SESSION['grab_mod'] = 0;
		   $_SESSION['grab_def_prov'] = 0;
		   $_SESSION['prov'] = 0;
		   $_SESSION['caja_bs_sus'] = $_SESSION['caja_bs_sus'];
		   require 'cja_fin_saldo.php';
	       break;  
		 case "Consulta":
		    $_SESSION['con_baj'] = 1;
	       require 'consulta_asi.php';
	       break; 
		   case "Cambiar_Fecha":
		    $_SESSION['con_baj'] = 3;
	       require 'consulta_asi.php';
	       break;   
		  case "Revertir":
		    $_SESSION['con_baj'] = 2;
			$_SESSION["tot_err"] = 0;
	       require 'consulta_asi.php';
	       break; 
		  case "Confirma Reversion":
		   $_SESSION['con_baj'] = 2;
	       require 'con_cbte_rev.php';
	       break; 
		   case "Cambiar":
		   $_SESSION['con_baj'] = 3;
	       require 'con_cbte_rev.php';
	       break;           
		 case "Impreso":
	       require 'imprimir_asi.php';
	       break; 
		  case "Imp_Mayor":
	       require 'imprimir_may.php';
	       break; 
		    case "Imp_Diario":
	       require 'imprimir_dia.php';
	       break;             
		   case "Retornar":
	       $_SESSION['detalle'] = 1;
		   $_SESSION['continuar'] = 2;
		    $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 0;
		   require 'con_asiento.php';
	       break;
		 case "Volver":
	       $_SESSION['detalle'] = 1;
		   $_SESSION['continuar'] = 2;
		    $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 0;
		   require 'con_asi_mod.php';
	       break;  
		case "Registro Asiento":
		   $_SESSION['nor_res'] = 2;
		   $_SESSION['detalle'] = 1 ;
	     $_SESSION['continuar'] = 1 ;
		  $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 0;
		   require 'con_asiento.php';
		   break;  
		case "Salir_Opc":
		   require 'menu_s.php';
		   break;    
		  case "Consulta_Cta":
		    $_SESSION['detalle'] = 0 ;
	     $_SESSION['continuar'] = 2 ;
		  $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 0;
		 //    require 'solic_consulta.php';
	       header('Location: con_plan_cta.php');
	       break;      	     
	   case "Graba_Dosifi":
	      // echo "aqui detalle 34";
	     //  $_SESSION['continuar'] = 3;
	       $_SESSION['detalle'] = 3;
		   //$_SESSION['continuar'] = 2;
		   require 'alt_dos_fac.php';
	       break;
		 case "Verifica":
	      // echo "aqui detalle 34";
	     //  $_SESSION['continuar'] = 3;
	       $_SESSION['detalle'] = 3;
		   //$_SESSION['continuar'] = 2;
		   require 'veri_codigo.php';
	       break;   	
		//case "Asiento Contable1":

		case "Asiento 1 Contable":
		//case "Comprobante":
		$_SESSION['asiento'] == 1;
		$_SESSION['menu'] == 1;
		   require 'con_asin_ufv.php';
		   break; 

		case "Asiento 2 Contable":
		$_SESSION['asiento'] == 1;
		$_SESSION['menu'] == 2;
		   require 'con_asin_ufv.php';
		   break;  

		case "Asiento 3 Contable":
		//$_SESSION['asiento'] == 1;
		$_SESSION['menu'] == 3;
		  require 'con_asin_ufv2.php';
		   break;  

		case "Asiento 4 Contable":
		//$_SESSION['asiento'] == 1;
		$_SESSION['menu'] == 4;
		require 'con_asin_ufv2.php';
		   break;        

		/*case "Asiento AITB":
		   require 'con_asin_ufv2.php';
		   break;    */
		   
}

?> 
<?php
}
ob_end_flush();
 ?>