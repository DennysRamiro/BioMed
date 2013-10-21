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
	     $_SESSION["tipo"] = 1;
		 header('Location: tipo_rep_2.php?menu=1');
	   break;
      case "2":
	     $_SESSION["tipo"] = 2;
		 header('Location: tipo_rep_2.php?menu=2');
	   break;
      case "3":
	     // echo "Grabar"; 
	   //  $_SESSION["tipo"] = 2;
		// header('Location: tipo_rep_2.php');
       break;
	  case "4":
	     // echo "Grabar"; 
	   //  $_SESSION["tipo"] = 2;
		header('Location: verif_solteras.php');
       break;
}
?> 
<?php
}
ob_end_flush();
 ?>