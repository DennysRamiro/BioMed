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
if (isset($_GET['accion'])) {
	$_POST['accion'] = $_GET['accion'];
}

//echo $_POST['accion'];
switch( $_POST['accion'] ) {
      case "Salir Saldo":
	       require 'caja_fin_saldo.php';
	       break;
	  case "Salir":
	       require 'con_mante.php';
	       break;
	   case "Salir_Plancta":
	       require 'con_mant_plan.php';
	       break;
		case "Salir_Verif":
	       require 'con_mant_fac.php';
	       break;
      case "Adicionar":
	       $_SESSION['detalle'] = 1;
		   $_SESSION['continuar'] = 2;
		    $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 0;
		   $_SESSION['menu'] = 15;
		   //$_SESSION['otromenu'] = 25;
		  // header("Location: con_asiento.php?menu=3");
		   require 'con_asiento.php';
	       break;
	   case "Nueva Linea":
	       $_SESSION['detalle'] = 1;
		   $_SESSION['continuar'] = 2;
		    $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 0;
		   require 'con_asi_mod.php';
	       break;	   
	  case "Grabar":
	      // echo "aqui detalle 34";
	       $_SESSION['continuar'] = 3;
	       $_SESSION['detalle'] = 3;
	       $_SESSION['menu'] = 18;
		   //$_SESSION['continuar'] = 2;
		   require 'con_asiento.php';
	       break;
	   case "Registrar Cuenta":
	      // echo "aqui detalle 34";
	     //  $_SESSION['continuar'] = 3;
	       $_SESSION['detalle'] = 2;
	       $_SESSION['menu'] = 7;
		   //$_SESSION['continuar'] = 2;
		  require 'alt_plan_cta.php';
		  
	       break;	
	   case "Grabar Cta.":
	      // echo "aqui detalle 34";
	     //  $_SESSION['continuar'] = 3;
	       $_SESSION['detalle'] = 3;
		   //$_SESSION['continuar'] = 2;
		   require 'alt_plan_cta.php';
	       break;	      
	  case "Graba Modificado": // Graba_Modificado por Graba Modificado
	      // echo "aqui detalle 34";
	       $_SESSION['continuar'] = 3;
	       $_SESSION['detalle'] = 3;
	       $_SESSION['menu'] = 14;
		   //$_SESSION['continuar'] = 2;
		   require 'con_asi_mod.php';
	       break;
	   case "Grabar Modificacion":   //cambiando el nombre de grabar_Mod por Grabar Modificacion

	       //echo "aqui detalle 34";

	      // echo "aqui detalle 34";

	       $_SESSION['continuar'] = 3;
	       $_SESSION['detalle'] = 3;
	       $_SESSION['menu'] = 9;
	      // echo $_POST['descrip_2'];
		   //$_SESSION['continuar'] = 2;
		   require 'mod_plancta.php';
		  // require 'mod_plan_cta.php';
	       break;	
	   case "Eliminar Cta.":
	      // echo "aqui detalle 34";
	       $_SESSION['continuar'] = 3;
	       $_SESSION['detalle'] = 3;
	       $_SESSION['menu'] = 2;
		   //$_SESSION['continuar'] = 2;
		   require 'eli_plancta.php';
	       break;	   	   	   
	  case "Imprimir":
    	   require 'con_asin_grab.php';
	       break;
	 case "Imprime Modificado":
    	   require 'con_asin_grab2.php';
	       break; 	   
	  case "Contabilizar":
		   require 'con_ciedia_grab.php';
		   break;
	 case "Consultar":
	       $_SESSION['continuar'] = 2;
		if ($_SESSION['tipo'] == 1){ 
		   $_SESSION['menu'] = 46;
		   require 'con_mayor_11.php';
		 }  
		else if ($_SESSION['tipo'] == 2){ 
		  $_SESSION['menu'] = 47;
		   require 'con_mayor_22.php';
		 }  
		else if ($_SESSION['tipo'] == 3){ 
		  $_SESSION['menu'] = 48;
		   require 'con_mayor_33.php';
		 }

		  case "Consultar Reporte":
	       $_SESSION['continuar'] = 2;
		if ($_SESSION['tipo'] == 1){ 
		    $_SESSION['menu'] = 49;
		   require 'con_mayor_11.php';
		 }  
		else if ($_SESSION['tipo'] == 2){ 
		  $_SESSION['menu'] = 50;
		   require 'con_mayor_22.php';
		 }  
		else if ($_SESSION['tipo'] == 3){ 
		  $_SESSION['menu'] = 51;
		   require 'con_mayor_33.php';
		 }      


		   break; 	
	case "Consultar Diario":
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
		   $_SESSION['menu'] = 17;
		   require 'con_asiento.php';
	       break;
		 case "Modifica Asiento":
		   $_SESSION['detalle'] = 1;
		   $_SESSION['continuar'] = 1;
		   $_SESSION['eliminar'] = 0;
		   $_SESSION['modificar'] = 0;
		   $_SESSION['mod_cop'] = 1;
		   $_SESSION['menu'] = 13;

		   require 'con_asi_mod.php';
	       break;   
		 case "Copiar":
		   $_SESSION['detalle'] = 1;
		   $_SESSION['continuar'] = 1;
		   $_SESSION['eliminar'] = 0;
		   $_SESSION['modificar'] = 0;
		   $_SESSION['mod_cop'] = 2; 
		   $_SESSION['nor_res'] = 1;
		   $_SESSION['menu'] = 20;
		   require 'con_asi_mod.php';
	       break;  

		 case "Copiar Reservado":
		   $_SESSION['detalle'] = 1;
		   $_SESSION['continuar'] = 1;
		   $_SESSION['eliminar'] = 0;
		   $_SESSION['modificar'] = 0;
		   $_SESSION['mod_cop'] = 2; 
		   $_SESSION['nor_res'] = 2;
		   $_SESSION['menu'] = 22;
		   //if (!isset($_POST['nro_doc[]'])) {
         //header('Location: cons_reserv.php?menu=1');
	    //    } 
        // else {
		   require 'tipo_rep_cont2.php';
		   //}
	       break; 

		    case "Copiar_2":
		   $_SESSION['detalle'] = 1;
		   $_SESSION['continuar'] = 1;
		   $_SESSION['eliminar'] = 0;
		   $_SESSION['modificar'] = 0;
		   $_SESSION['mod_cop'] = 2; 
		   $_SESSION['nor_res'] = 2;
		   $_SESSION['descrip'] = "";
		   $_SESSION['menu'] = 26;
		   require 'con_asi_mod.php';
	       break;      
	   case "Recibo":
	      $_SESSION['detalle'] = 3 ;
		 require 'com_ven_grab.php';
		 
       break;
	   case "Guardar Modificacion":
	      // echo "aqui detalle 5 Grab_modi";
	       $_SESSION['continuar'] = 5;
	       $_SESSION['menu'] = 15;
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
		 case "Eliminar Cuenta":
	     //  $_SESSION['entra'] = "entra a eliminar menu";

		   $_SESSION['detalle'] = 1; //1
		   $_SESSION['continuar'] = 0;//0
		   $_SESSION['modificar'] = 0; //0
		   $_SESSION['eliminar'] = 1;//1
		  // $_SESSION['eliminarCta']= 1;
		   require 'con_asiento.php';
		 /* 
		   
		   $_SESSION['nor_res'] = 1;
	       $_SESSION['detalle'] = 1;
	       $_SESSION['continuar'] = 1;
		   $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 1;;

		    require 'con_asiento.php';
		   */ 
		   
	       break;  
		   case "Elimina fila":
	     //  $_SESSION['entra'] = "entra a eliminar menu";
	       $_SESSION['detalle'] = 1;
		   $_SESSION['continuar'] = 0;
		   $_SESSION['modificar'] = 0; 
		   $_SESSION['eliminar'] = 1;
		   require 'con_asi_mod.php';
	       break;   
		case "Modificar Cantidad":
	     //  $_SESSION['entra'] = "entra a eliminar menu";
	       $_SESSION['detalle'] = 1;
		   $_SESSION['continuar'] = 0;
		   $_SESSION['eliminar'] = 0;
		   $_SESSION['modificar'] = 1;
		   $_SESSION['prov'] = 0;
		   require 'cja_fin_saldo.php';
	       break; 
		 case "Grab. Modificado":
	     //  $_SESSION['entra'] = "entra a eliminar menu";
	       $_SESSION['detalle'] = 1;
		   $_SESSION['continuar'] = 0;
		   $_SESSION['eliminar'] = 0;
		   $_SESSION['modificar'] = 0;
		   $_SESSION['grab_mod'] = 1;
		   $_SESSION['prov'] = 0;
		   require 'cja_fin_saldo.php';
	       break;  
		  case "Grab. Cortes":
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
		   case "Otra Transaccion":
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
		   echo $_SESSION['con_baj'];
		    $_SESSION['con_baj'] = 1;
		    $_SESSION['menu'] = 10;

		  //echo  $_SESSION['menu'] = $_POST['nro_doc'];

		  /* if (!isset($_POST['nro_doc[]'])) {
		   	echo  $_SESSION['menu'] = $_POST['nro_doc'];
        // header('Location: cons_asiento.php?menu=24');
	        } 
         else {
	       echo "vacio";
         	*/
	       require 'consulta_asi.php';
	  		//}
	       break; 



		   case "Cambiar_Fecha":
		    $_SESSION['con_baj'] = 3;
	       require 'consulta_asi.php';
	       break; 

		  case "Revertir":
		    $_SESSION['con_baj'] = 2;
			$_SESSION["tot_err"] = 0;
			$_SESSION["menu"] = 19;
	       require 'consulta_asi.php';
	       break; 

	        case "Revertir Reservado":
		    $_SESSION['con_baj'] = 2;
			$_SESSION["tot_err"] = 0;
			$_SESSION["menu"] = 20;
	       require 'consulta_asi.php';
	       break; 

		  case "Confirma Reversion":
		   $_SESSION['con_baj'] = 2;
		   $_SESSION["menu"] = 1;
	       require 'con_cbte_rev.php';
	       break; 

	       case "Confirma Reversion Reservado":
		   $_SESSION['con_baj'] = 2;
		   $_SESSION["menu"] = 2;
	       require 'con_cbte_rev.php';
	       break; 

		   case "Cambiar":
		   $_SESSION['con_baj'] = 3;
	       require 'con_cbte_rev.php';
	       break;           
		 case "Impreso":
	       require 'imprimir_asi.php';
	       break; 
		  case "Imprimir Mayor": //Imp_Mayor
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
		   $_SESSION['menu'] = 15;
		   require 'con_asiento.php';
	       break;
		 case "Volver":
	       $_SESSION['detalle'] = 1;
		   $_SESSION['continuar'] = 2;
		    $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 0;
		   $_SESSION['menu'] = 13;
		   require 'con_asi_mod.php';
	       break;  

		case "Registro Asiento":
		   $_SESSION['nor_res'] = 2;
		   $_SESSION['detalle'] = 1 ;
	     $_SESSION['continuar'] = 1 ;
		  $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 0;
		   $_SESSION['menu'] = 21;
		  // $_SESSION['select']= $_POST['nro_doc[]'];
	     // if (!isset($_POST['nro_doc[]'])) {
	      	//header('Location: cons_reserv.php?menu=1');
	      // } 
       // else {
		
		require 'con_asiento.php';
		  //}
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
		  // graba disificacion computarizada     	     
	   case "Registrar Dosif. Computarizada":
	      // echo "aqui detalle 34";
	     //  $_SESSION['continuar'] = 3;
	       $_SESSION['detalle'] = 3;
		   //$_SESSION['continuar'] = 2;
		   require 'alt_dos_fac.php';
	       break;
		   // graba disificacion manual
		case "Registrar Dosif. Manual":
	       $_SESSION['detalle'] = 4;
		   //$_SESSION['continuar'] = 2;
		   require 'alt_dos_fac_manual.php';
	       break;
	       
		 case "Verifica":
	      // echo "aqui detalle 34";
	     //  $_SESSION['continuar'] = 3;
	       $_SESSION['detalle'] = 3;
		   //$_SESSION['continuar'] = 2;
		   require 'veri_codigo.php';
	       break;   	

		case "Asiento Contable":
		   require 'con_asin_rev.php';
		   break; 
		 case "Registrar Chequera":
	      // echo "aqui detalle 34";
	     //  $_SESSION['continuar'] = 3;
	       $_SESSION['detalle'] = 3;
	       $_SESSION['menu'] = 2;
		   //$_SESSION['continuar'] = 2;
		   require 'alt_chequera.php';
	       break;  
		        
		  case "Recibos No Utilizados":
	      // echo "aqui detalle 34";
	     //  $_SESSION['continuar'] = 3;
	       $_SESSION['detalle'] = 3;
		   //$_SESSION['continuar'] = 2;
		   require 'rec_noutilizados.php';
	       break;  
		    case "Recibos Utilizados":
		   
	      // echo "aqui detalle 34";
	     //  $_SESSION['continuar'] = 3;
		    if (!isset($_POST['nro_tal'])) {
		    	//echo "vacio";
		    	 $_SESSION['detalle'] = 1;
		    	 require 'rec_utilizados_t.php';
		    }
		 else {

			     $_SESSION['detalle'] = 3;
		    	 require 'rec_utilizados_t.php';

		}
	       
	       
		   //$_SESSION['continuar'] = 2;
		   //require 'rec_utilizados_t.php';
	       break; 
		   
}

?> 
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php
}
ob_end_flush();
 ?>