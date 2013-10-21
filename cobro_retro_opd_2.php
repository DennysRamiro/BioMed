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
	      //echo "Retroceder";
	     // echo "Volver atras <a href='menu_s.php'>volver</a>";
		  require 'egre_mante.php';
	   break;
      case "Grabar":
	     $_SESSION['detalle'] = 2 ;
		 require 'reg_egresos.php';
	   //  header('Location: reg_egresos.php');
	    //   require 'solic_con_m.php';
           break;
	    case "Imprimir":
	      $_SESSION['detalle'] = 3 ;
		 require 'cart_imp_cob.php';
		 
       break;
}
?> 
<?php
}
ob_end_flush();
 ?>