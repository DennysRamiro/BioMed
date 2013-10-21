<?php
require_once "controllers/ClienteController.php";
class RestFul{
    public function runIndex(){
        $metodo = $_GET['action'];
        $cliente_controller = new ClienteController();
        switch ($metodo) {
            case 'loginUsuario':
                $cliente_controller->loginUsuario($_GET['log'], $_GET['pass']);
                break;
            case 'listarClientes':
                $cliente_controller->listarClientes();
                break;
            default:
                echo "default";
                break;
        }
    }
}

$restful = new RestFul();
$restful->runIndex();
?>