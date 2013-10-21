<?php
ob_start();
session_start();
if(!isset($_SESSION['login']) || !isset($_SESSION['clave'])){
        header("Location: ../index.php?error=1");
} else {
  require_once 'app/controllers/HomeController.php';
  require_once 'app/controllers/VentasController.php';
  require_once 'app/controllers/ClientesController.php';
  require_once 'app/controllers/CotizacionesController.php';

  /**
   * Description of index
   * @author Daniel Fernandez
   *
   */
  class Index {
      /*
       * Este es el metodo que ejecuta la aplicación
       */
      public function run($action){

    	  switch ($action) {
    		  case 'index': // Este es el menu de cotizacion
    			  $home_controller = new HomeController();
            $home_controller->runIndex($action);
    			  break; 
          case 'ventas': // Este es el menu de ventas
            $venta_controller = new VentasController();
            $venta_controller->runIndex($_GET['tp']);
            break;
          case 'clientes': // Este es el menu de clientes
            $cliente_controller = new ClientesController();
            $cliente_controller->runIndex($_GET['tp']);
            break;
          case 'cotizaciones': // Este es el menu de clientes
            $cotizacion_controller = new CotizacionesController();
            $cotizacion_controller->runIndex($_GET['tp']);
            break;
    	  }   
      }
  }
  $index = new Index();
  $index->run($_GET['action']);
}
ob_end_flush();
?>
