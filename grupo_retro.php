<?php
	ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
	if(!isset($_SESSION['login']) || !isset($_SESSION['clave'])){
		header("Location: index.php?error=1");
} else {
	//require('configuracion.php');
    //require('funciones.php');
?>
<?php
switch( $_POST['accion'] ) {
      case "Salir":
		  header('Location: menu_s.php');
	      break;
      case "Grabar":
	      $_SESSION['nom_grup'] =$_POST['nom_grup'];
		  $_SESSION['cod_ag'] =$_POST['cod_agencia'];	   
	      header('Location: gral_grab_grup.php');
          break;
	  case "Agregar Clientes":	   
	      header('Location: cliente_con_grup.php');
		  break; 
	  case "Actualizar Cargos":	   
	      header('Location: grupo_act_dir.php');
       break;  
	   case "Registrar":	   
	      header('Location: grupo_act_grab.php');
       break;  
	    case "Cambiar":	
		//  $_SESSION['detalle'] = 2;   
	      header('Location: cred_act_coord_2.php');
       break;  
	   case "Volver":
	      header('Location: grupo_mante_dir.php');
       break;  
}
?> 
<?php
}
ob_end_flush();
 ?>