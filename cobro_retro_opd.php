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
	      if ($_SESSION['cart_fgar'] == 1){
		      require 'cart_cobros.php';
		   }
		   if ($_SESSION['cart_fgar'] == 2){
		      require 'fgar_tran.php';
		   }
	       break;
      case "Confirmar":
	       $_SESSION['calculo'] = 2;
		   $_SESSION['detalle'] = 3;
		   $_SESSION['continuar'] = 2;
	       require 'cobro_detalle_2.php';
           break; 
      case "Detalle":
	       $_SESSION['calculo'] = 1;
		  $_SESSION['detalle'] = 1; 
		   $_SESSION['continuar'] = 3;
	       require 'cobro_detalle_2.php';
           break;
	  case "Validar":
	       $_SESSION['calculo'] = 2;
		   $_SESSION['detalle'] = 9;
		   $_SESSION['continuar'] = 2;
		   require 'cobro_detalle_2.php';
           break; 
	  case "Valida_Ind":
	       $_SESSION['calculo'] = 2;
		   $_SESSION['detalle'] = 19;
		   $_SESSION['continuar'] = 2;
		   require 'cobro_detalle_2.php';
           break; 
	   case "Valida_Ind_2":
	       $_SESSION['calculo'] = 2;
		   $_SESSION['detalle'] = 29;
		   $_SESSION['continuar'] = 2;
		   require 'cobro_detalle_2.php';
           break;    
	 case "Fecha de Calculo":
	        $_SESSION['cuota'] = 0;
			 $_SESSION['cuota_d'] = 0;
	       require 'cobro_valida_2.php';
           break;
	  
	  case "Recalcular":
	       $_SESSION['calculo'] = 2;
		   $_SESSION['detalle'] = 7;
		   $_SESSION['continuar'] = 2;
	       require 'cobro_detalle_2.php';
           break; 
	  case "Det-Contable":
	        $_SESSION['calculo'] = 2;
		   $_SESSION['detalle'] = 10;
		   $_SESSION['continuar'] = 2;
	       require 'cobro_detalle_2.php';
           break; 
	  //     require 'car_imp_cob.php';
      //     break;
	  case "Kardex":
	       
	       require 'cart_imp_kar.php';
           break;  
	   case "Boleta de Cobro":
	       
	       require 'cart_imp_boleta2.php';
           break;  	   
	  case "Mov. Fondo Gar":
	       
	       require 'fgar_imp_kar.php';
           break;
	  case "Monto Fijo C_FGar":
	   $cuan_1 = 0;
		   $nro_rec = 0;
		   $_SESSION['nro_rec'] = 0;
		  $_SESSION['nro_rec'] = $_POST['rec_nro'];
		  $nro_rec = $_POST['rec_nro'];
		if ($nro_rec > 0){
		    $cuan_1 = 0;
		    $con_reci = "Select count(*) From recibo_deta where  REC_DET_NRO = $nro_rec and
	                     REC_DET_USR_BAJA is null ";
            $res_reci = mysql_query($con_reci)or die('No pudo seleccionarse tabla');
	                    while ($lin_reci = mysql_fetch_array($res_reci)) {
	                          $cuan_1 =  $lin_reci['count(*)'];
	                    }
		
		}
		if ($cuan_1 > 0){
		 $_SESSION['detalle'] = 1;
		 require 'cobro_detalle_2.php';
		}else{
	  
	       $_SESSION['calculo'] = 2;
		   $_SESSION['detalle'] = 2;
		   $_SESSION['COBRO_TIPO'] = 2;
		   $_SESSION['continuar'] = 2;
	       require 'cobro_detalle_2.php';
		}   
           break;  
	  	case "Monto Fijo S_FGar":
		    $cuan_1 = 0;
		   $nro_rec = 0;
		   $_SESSION['nro_rec'] = 0;
		  $_SESSION['nro_rec'] = $_POST['rec_nro'];
		  $nro_rec = $_POST['rec_nro'];
		if ($nro_rec > 0){
		    $cuan_1 = 0;
		    $con_reci = "Select count(*) From recibo_deta where  REC_DET_NRO = $nro_rec and
	                     REC_DET_USR_BAJA is null ";
            $res_reci = mysql_query($con_reci)or die('No pudo seleccionarse tabla');
	                    while ($lin_reci = mysql_fetch_array($res_reci)) {
	                          $cuan_1 =  $lin_reci['count(*)'];
	                    }
		
		}
		if ($cuan_1 > 0){
		 $_SESSION['detalle'] = 1;
		 require 'cobro_detalle_2.php';
		}else{
	       $_SESSION['calculo'] = 2;
		   $_SESSION['detalle'] = 2;
		   $_SESSION['COBRO_TIPO'] = 1;
		   $_SESSION['continuar'] = 2;
	       require 'cobro_detalle_2.php';
		}   
           break;     
	  case "Cuota con FGar":
	   $cuan_1 = 0;
		   $nro_rec = 0;
		   $_SESSION['nro_rec'] = 0;
		  $_SESSION['nro_rec'] = $_POST['rec_nro'];
		  $nro_rec = $_POST['rec_nro'];
		if ($nro_rec > 0){
		    $cuan_1 = 0;
		    $con_reci = "Select count(*) From recibo_deta where  REC_DET_NRO = $nro_rec and
	                     REC_DET_USR_BAJA is null ";
            $res_reci = mysql_query($con_reci)or die('No pudo seleccionarse tabla');
	                    while ($lin_reci = mysql_fetch_array($res_reci)) {
	                          $cuan_1 =  $lin_reci['count(*)'];
	                    }
		
		}
		if ($cuan_1 > 0){
		 $_SESSION['detalle'] = 1;
		 require 'cobro_detalle_2.php';
		}else{
	       $_SESSION['calculo'] = 2;
		   $_SESSION['detalle'] = 5;
		   $_SESSION['continuar'] = 2;
	       require 'cobro_detalle_2.php';
		 }  
           break; 
	  case "Condonar":
	       $_SESSION['calculo'] = 2;
		   $_SESSION['detalle'] = 4;
		   $_SESSION['continuar'] = 2;
	       require 'cobro_detalle_2.php';
           break; 
	  	case "Condona_sup":
	       $_SESSION['calculo'] = 2;
		   $_SESSION['detalle'] = 14;
		   $_SESSION['continuar'] = 2;
	       require 'cobro_detalle_2.php';
           break;    
	   case "Cuota sin FGar":
	    $cuan_1 = 0;
		   $nro_rec = 0;
		   $_SESSION['nro_rec'] = 0;
		  $_SESSION['nro_rec'] = $_POST['rec_nro'];
		  $nro_rec = $_POST['rec_nro'];
		if ($nro_rec > 0){
		    $cuan_1 = 0;
		    $con_reci = "Select count(*) From recibo_deta where  REC_DET_NRO = $nro_rec and
	                     REC_DET_USR_BAJA is null ";
            $res_reci = mysql_query($con_reci)or die('No pudo seleccionarse tabla');
	                    while ($lin_reci = mysql_fetch_array($res_reci)) {
	                          $cuan_1 =  $lin_reci['count(*)'];
	                    }
		
		}
		if ($cuan_1 > 0){
		 $_SESSION['detalle'] = 1;
		 require 'cobro_detalle_2.php';
		}else{
	   
	   
	   
	       $_SESSION['calculo'] = 2;
		   $_SESSION['detalle'] = 6;
		   $_SESSION['continuar'] = 2;
	       require 'cobro_detalle_2.php';
		 }  
           break; 
	  case "Aplicar":
	       $_SESSION['calculo'] = 2;
		   $_SESSION['detalle'] = 8;
		   $_SESSION['continuar'] = 2;
	       require 'cobro_detalle_2.php';
           break; 	
	 case "Imprimir":
	    //   echo $_SESSION['itf']."va imprimir ";
	     $_SESSION['calculo'] = 2;
		  $_SESSION['detalle'] = 10;
		//   $_SESSION['continuar'] = 2;
	       require 'cobro_detalle_2.php';
          break; 
	 case "Reporte":
	       require 'cart_imp_trasp.php';
           break; 	
	 case "Continuar":
	       require 'cart_cont_trasp.php';
           break; 
	 case "Deposito":
	       $_SESSION['detalle'] = 1;
	       $_SESSION['dep_ret'] = 1 ;
		   $_SESSION['continuar'] = 1;
	       require 'fgar_depret.php';
           break; 
	 case "Retiro":
	       $_SESSION['msg_err'] = ""; 
	       $_SESSION['detalle'] = 1;
	        $_SESSION['dep_ret'] = 2 ;
			$_SESSION['continuar'] = 1;
	       require 'fgar_depret.php';
           break; 
		case "Grabar":
	     //  $_SESSION['detalle'] = 1;
         if ($_SESSION['dep_ret'] == 2){
	       require 'fgar_val_m.php';
		   }
		   require 'fga_imp_dere.php';
           break; 
	 case "Oportunidad":
	     //  $_SESSION['detalle'] = 1;
	     //   $_SESSION['dep_ret'] = 2 ;
	       require 'solic_mante_op.php';
           break; 
	 case "Calculo_deuda":
	       $_SESSION['calculo'] = 2;
		   $_SESSION['detalle'] = 5;
		   $_SESSION['continuar'] = 2;
	       require 'cobro_detalle_2.php';
           break; 
	 case "Terminar":
	      require 'cred_cobros_2.php';
		  break;
	  case "Registrar":
	    //   echo $_SESSION['itf']."va imprimir ";
	     $_SESSION['calculo'] = 2;
		  $_SESSION['detalle'] = 20;
		//   $_SESSION['continuar'] = 2;
	       require 'cobro_detalle_2.php';
          break;
	  case "Rep_Calificacion":
	       require 'cart_imp_cali.php';
           break; 	
	 case "Contab_Prevision":
	       require 'cart_cont_cali.php';
           break; 
	case "Contabiliza_Prev.":
	       require 'con_previ_grab.php';
           break; 	   	
	case "Plan de Pagos":
	       $_SESSION['cont_imp'] = 0;
	       require 'cart_imprime_p.php';
           break; 
	case "Imprime":
	       require 'cart_imp_p_cart.php';
           break; 
	case "Reasignar":
	       require 'cred_reasig.php';
           break;
	case "Envia_Caja":
	       require 'cred_cob_cja.php';
           break;	
	case "Salir_Opc":
	      require 'menu_s.php';
		  break;	      
	case "Seguimiento de Pagos":
	      require 'cred_seg_pag.php';
		  break;		   	   		   	     
	 case "Continua-Deven":
	       require 'cart_cont_deven.php';
           break; 	  	     	      	   	   	         	   	      	   	   	        
	}
?>  
<?php
}
    ob_end_flush();
 ?>