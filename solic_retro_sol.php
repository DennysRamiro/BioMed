<?php
 ob_start();
   if (!isset ($_SESSION)){
	   session_start();
	}
	if(!isset($_SESSION['login']) || !isset($_SESSION['clave'])){
    header("Location: index.php?error=1");
} else { 
	require_once('configuracion.php');
    //require_once('funciones.php');
?>
<?php
switch( $_POST['accion'] ) {
      case "Salir":
	       unset ($_SESSION["tot_err"], $_SESSION["total_s"],$_SESSION["validar"], $_SESSION["cod_sol"]);
		  // unset($_SESSION['form_buffer']);
		   require_once 'menu_s.php';
		   
	       break;
	    case "Salir-Cont":
	       unset ($_SESSION["tot_err"], $_SESSION["total_s"],$_SESSION["validar"], $_SESSION["cod_sol"]);
		  // unset($_SESSION['form_buffer']);
		   require_once 'solic_con_m.php';
	       break;  
      case "Clientes":
	       require_once 'cliente_con_m_sol.php';
           break;
	  case "Grupo":
	       require_once 'grupo_con_m_sol.php';
           break;
	  case "Continuar":
	       require_once 'solic_mante_proc.php';
		   break;
	  case "Alta":
	       unset ($_SESSION['cod_grupo'],$_SESSION["cod_sol"]);
	       require_once 'solic_mante_aa.php';
           break;
	  case "Grabar":
	       require_once 'grab_sol_com.php';
           break;
	   case "Grab-Oportunidad":
	       
	       require_once 'grab_sol_opo.php';
           break;	   
	  case "Modificar":
	       require_once 'solic_man_cm2.php';
           break;
	  case "Consultar":
	   unset ($_SESSION["tot_err"], $_SESSION["total_s"],$_SESSION["validar"], $_SESSION["$com_f"],$_SESSION["cod_sol"]);
	       require_once 'solic_con_m.php';
           break;
	  case "Grabar-Montos":
	       require_once 'cred_val_m.php';
		   $_SESSION['continuar'] = 2 ;
           break;
	  case "Registrar Cambios":
	        $_SESSION['continuar'] = 2 ;
	       require_once 'grab_sol_com_m.php';
           break;
	  case "Siguiente Paso":
		   $_SESSION['continuar'] = 1 ;
	       if ($_SESSION['cod_tipo'] == 1) {
              require_once 'cliente_con_s2.php';
	          break;
			  }
           if ($_SESSION['cod_tipo'] == 2) {
              require_once 'cliente_con_s2.php';
	          break;
			  }
	       if ($_SESSION['cod_tipo'] == 3) {
              require_once 'cliente_con_s2.php';
	          break;
			  }
	     case "Elegir Otro Grupo":
	     	  $_SESSION["continuar"] = 1; 
	    	  require_once 'grupo_con_m_sol.php';
		 case "Siguiente-Paso":
		     require_once 'cred_val_m.php';
              break;
		 case "Plan de Pagos":
		      require_once 'cred_plan_pag.php';
              break;
	     case "Plan_Pag_Completo":
		      $_SESSION['continuar'] = 1;
		      require_once 'cred_grab_plan_p.php';
              break;
		 case "Contrato":	  
		      $_SESSION['continuar'] = 1 ;
		      require_once 'cred_contrato.php'; 	  
		      break;
	     case "Impresion Contrato":
		      $cod_sol = $_SESSION['nro_sol'];
			  $act_cred_solic  = "update cred_solicitud set CRED_SOL_ESTADO=6 where CRED_SOL_CODIGO = $cod_sol and                                  CRED_SOL_USR_BAJA is null";
              $res_act_s = mysql_query($act_cred_solic);
			  if ($_SESSION['tipo_cont'] == 1){
			       require_once 'cred_imp_cont1.php';
			  }

			  if ($_SESSION['tipo_cont'] == 2){
		          require_once 'cred_imp_cont12.php';
			  }
			   if ($_SESSION['tipo_cont'] == 3){
		          require_once 'cred_imp_cont3.php';
			  }
              break;
	          
	     case "Impresion Orden Desem":
		      $cod_sol = $_SESSION['nro_sol'];
			  $act_cred_solic  = "update cred_solicitud set CRED_SOL_ESTADO=7 where CRED_SOL_CODIGO = $cod_sol and                                  CRED_SOL_USR_BAJA is null";
              $res_act_s = mysql_query($act_cred_solic);
		      require_once 'cred_imp_odesem.php';
              break;
			  
		 case "Imp_Desembolso":
		  $cuan_1 = 0;
		   $nro_rec = 0;
		   $_SESSION['nro_rec'] = 0;
		  $_SESSION['nro_rec'] = $_POST['rec_nro'];
		  $nro_rec = $_POST['rec_nro'];
		if ($nro_rec > 0){
		    $cuan_1 = 0;
		    $con_reci = "Select count(*) From recibo_deta where  REC_DET_NRO = $nro_rec and
	                     REC_DET_USR_BAJA is null ";
            $res_reci = mysql_query($con_reci);
	                    while ($lin_reci = mysql_fetch_array($res_reci)) {
	                          $cuan_1 =  $lin_reci['count(*)'];
	                    }
		
		}
		if ($cuan_1 > 0){
		 $_SESSION['detalle'] = 1;
		 $_SESSION['continuar'] = 1;
		 require_once 'cart_desem.php';
		}else{
	  
	       $_SESSION['calculo'] = 2;
		   $_SESSION['detalle'] = 2;
		   $_SESSION['COBRO_TIPO'] = 2;
		   $_SESSION['continuar'] = 2;
	      require_once 'car_imp_des.php';
		}   
           break;
			  
              
		case "Registrar Acople":
	        $_SESSION['continuar'] = 2 ;
	       require_once 'grab_sol_adi.php';
           break;
		  case "Simular":	  
		      $_SESSION['continuar'] = 2 ;
		      require_once 'sol_csimula.php'; 	  
		      break;  
		case "Cambiar Estado":
		      $cod_sol = $_SESSION['cod_sol'];
			  if (isset($_POST['cod_est'])){  
                  $quecom = $_POST['cod_est'];
	             }
			  if (isset($quecom)){  	
                 for( $i=0; $i < count($quecom); $i = $i + 1 ) {
                 if( isset($quecom[$i]) ) {
                   $cod_s = $quecom[$i];
                    }
                  }
               }
			  $act_cred_solic  = "update cred_solicitud set CRED_SOL_ESTADO=$cod_s where
			                      CRED_SOL_CODIGO = $cod_sol and
								  CRED_SOL_USR_BAJA is null";
              $res_act_s = mysql_query($act_cred_solic);
		      require_once 'menu_s.php';
              break; 
		   
	}
?>  
<?php
}
ob_end_flush();
 ?>