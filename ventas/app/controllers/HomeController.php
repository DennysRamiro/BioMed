<?php
require_once "app/models/Home.php";
require_once "app/views/HomeView.php";
/**
 * Description of Router
 *
 * @author Daniel Fernandez
 */
class HomeController {
    /*
     * Este es el metodo constructor para el proyecto
     */
    public function __construct() {

        
    }
    /*
     * Esta es la funcion que ejecuta y redirecciona la solicitud  que se haga
     */
    public function runIndex($action){
        switch ($action) {
            case "index":
                  $home_model = new Home();
                  $home_model->runIni();
                  $home_view = new HomeView();
                  $home_view->runIndex();
              break;
        }
    }
}

?>
