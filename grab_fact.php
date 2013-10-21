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
//echo "prueba";
switch( $_POST['accion'] ) { 

     
      case "Grabar Egresos":

		 require ('reg_fac_egresos.php');

       break;
       case "Grabar Ingresos":
	    
		 require ('reg_fac_egresos.php'); 

       break;
         case "Grabar Factura":

		 require ('reg_fac_egresos.php');

       break;
         case "Grabar Deposito":

		 require ('reg_fac_egresos.php');

       break;
      

}
?> 
<?php
}
ob_end_flush();
 ?>