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
	      unset($_SESSION['form_buffer']);
		  require 'menu_s.php';
	   break;
      case "Consultar":
	      require 'grupo_con_m.php';
	 
       case "Seleccionar_cred":
	      //require 'grupo_con_c.php';
	      header('location:grupo_con_c.php?menu=1')	;  
       break;

       case "Seleccionar_fondo":
	      //require 'grupo_con_c.php';
	      header('location:grupo_con_c.php?menu=2')	;  
       break;

       case "Seleccionar_cart":
	      //require 'grupo_con_c.php';
	      header('location:grupo_con_c.php?menu=3')	;  
       break;

       case "Seleccionar_cjas":
	      //require 'grupo_con_c.php';
	      header('location:grupo_con_c.php?menu=13')	;  
       break;


}
?> 
<?php
}
ob_end_flush();
 ?>