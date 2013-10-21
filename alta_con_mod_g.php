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
		  header('Location: grupo_mante_a.php');
	   break;
      case "2":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 header('Location: grupo_consulta.php');
       break;
	   case "3":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 
		 header('Location: grupo_con_mod.php');
       break;
	   case "4":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php');
		
		 //header('Location: menu_s.php');
		 header('Location: modulo.php?modulo=3000');
		 
       break;
}
?> 
<?php
}
ob_end_flush();
 ?>