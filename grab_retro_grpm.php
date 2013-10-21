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
	      //echo "Retroceder";
	     // echo "Volver atras <a href='menu_s.php'>volver</a>";
		 // unset($_SESSION['form_buffer']);
		 // session_unset(); 
		  require 'menu_s.php';
	   break;
      case "Grabar":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 require 'gral_grab_grup_m.php';
       break;
	    case "Modificar":
	      //echo "Modificar- Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 require 'grupo_man_cm.php';
		 case "Directiva":
	      //echo "Modificar- Grabar"; 
	     //  require('garl_grab_fec.php');
		 $_SESSION["alta_grab"] = 1; 
		 require 'grupo_mante_dir.php';
		 case "Volver Solicitud":
	      //echo "Modificar- Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 require 'solic_mante_aa.php';
       break;
	   case "Elegir Otro Grupo":
	      //echo "Modificar- Grabar"; 
	      $_SESSION["ida_vuelta"] = 2;
		 require 'grupo_con_m_sol.php';
	   case "Este Grupo":
	        $nrosol = $_SESSION['nro_sol'];
			$_SESSION['cod_sol'] = $nrosol;
			$cod_grup = $_SESSION["cod_grupo"];
		//	echo "sol",$nrosol, "grup",$cod_grup;
	        $act_grupo = "update cred_solicitud set CRED_SOL_COD_GRUPO = $cod_grup, CRED_SOL_ESTADO = 2 where                         CRED_SOL_CODIGO= $nrosol and  CRED_SOL_USR_BAJA is null";
            $res_agrup = mysql_query($act_grupo);
	        //$_SESSION['nro_sol'] = $_SESSION['cod_sol'];
		    require 'cliente_con_s.php';

		case "Elegir":
	      $_SESSION['cod_gru'] = ""; 
	      $_SESSION['continuar'] = 2;
		if (isset($_SESSION['cart_fgar'])){	  
		  if ($_SESSION['cart_fgar'] == 1){
		  	// elegir de cjs-cobros carteras-directo-nom group
		  	//header("Location: cobro_pag_det_gd.php");
		      require 'cobro_pag_det_gd.php';
			}
			//fondo garantia
		   if ($_SESSION['cart_fgar'] == 2){ 
			  require 'fgar_det_dere.php';
			  }
		   	 if ($_SESSION['cart_fgar'] == 3){
		      require 'cobro_pag_det_gd.php';
			}  
	}		  
}
?> 
<?php
}
ob_end_flush();
 ?>
