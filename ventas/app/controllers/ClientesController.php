<?php
require_once "app/models/Cliente.php";
require_once "app/views/ClienteView.php";
/**
 * Description of Router
 *
 * @author Daniel Fernandez
 */
class ClientesController {
    /*
     * Este es el metodo constructor para el proyecto
     */
    public function __construct() {
        
    }
    /*
     * Esta es la funcion que ejecuta y redirecciona la solicitud  que se haga
     */
    public function runIndex($tp){
        $cliente_view = new ClienteView();
        $cliente_model = new Cliente();
        switch ($tp) {
            case "index":
                $cliente_view->runIndex();
                break;
            case "listarClientes":
                //$clinte_model->listaClientes();
                $cont = 0;
                $fila = 1;
                $tot = $cliente_model->totalClientes();
                $json_data_final['total'] = $tot[0][0]['total'];
                foreach ($cliente_model->listaClientes($_GET['start'], $_GET['limit']) as $key => $value) {
                    $data['num'] = $fila;
                    $data['codigo_unico'] = $value['vent_cliente']['vent_cli_cod_unico'];
                    $data['codigo_cliente'] = $value['vent_cliente']['vent_cli_codigo_cliente'];
                    $data['nombre'] = $value['vent_cliente']['vent_cli_nombre'];
                    $data['apellido_pat'] = $value['vent_cliente']['vent_cli_apellido_pat'];
                    $data['empresa_trab'] = $value['vent_cliente']['vent_cli_empresa_trab'];
                    $data['direccion'] = $value['vent_cliente']['vent_cli_direccion'];
                    $data['contacto'] = $value['vent_cliente']['vent_cli_persona_cont'];
                    $data['telefono'] = $value['vent_cliente']['vent_cli_telefono'];
                    $data['celular'] = $value['vent_cliente']['vent_cli_celular'];
                    $data['correo'] = $value['vent_cliente']['vent_cli_correo'];
                    $json_data[$cont] = $data;
                    $cont++;
                    $fila++;
                }
                $json_data_final['datos'] = $json_data;
                print(json_encode($json_data_final));
                break;
            case "getDataClientexId":
                $cont = 0;
                $fila = 1;
                $tot = $cliente_model->totalClientes();
                $json_data_final['total'] = $tot[0][0]['total'];
                foreach ($cliente_model->listaClientesxId($_GET['client_id'],$_GET['start'], $_GET['limit']) as $key => $value) {
                    $data['num'] = $fila;
                    $data['codigo_unico'] = $value['vent_cliente']['vent_cli_cod_unico'];
                    $data['codigo_cliente'] = $value['vent_cliente']['vent_cli_codigo_cliente'];
                    $data['nombre'] = $value['vent_cliente']['vent_cli_nombre'];
                    $data['apellido_pat'] = $value['vent_cliente']['vent_cli_apellido_pat'];
                    $data['empresa_trab'] = $value['vent_cliente']['vent_cli_empresa_trab'];
                    $data['direccion'] = $value['vent_cliente']['vent_cli_direccion'];
                    $data['contacto'] = $value['vent_cliente']['vent_cli_persona_cont'];
                    $data['telefono'] = $value['vent_cliente']['vent_cli_telefono'];
                    $data['celular'] = $value['vent_cliente']['vent_cli_celular'];
                    $data['correo'] = $value['vent_cliente']['vent_cli_correo'];
                    $json_data[$cont] = $data;
                    $cont++;
                    $fila++;
                }
                $json_data_final['datos'] = $json_data;
                print(json_encode($json_data_final));
                break;
            case "saveCliente":
                if($cliente_model->guardarCliente($_GET)){
                    $json_res['complet'] = true;
                }else{
                    $json_res['complet'] = false;
                }
                print(json_encode($json_res));
                break;
            case "saveClienteBot":
                $cliente_model->guardarClienteBot($_GET);
               /*     $json_res['complet'] = true;
                }else{
                    $json_res['complet'] = false;
                }
                print(json_encode($json_res));*/
                break;

            case "saveClienteBotPubl":
                $cliente_model->guardarClienteBotPubl($_GET);
               /*     $json_res['complet'] = true;
                }else{
                    $json_res['complet'] = false;
                }
                print(json_encode($json_res));*/
                break;
            case "deleteCliente":
                if($cliente_model->deleteCliente($_GET['cliente_id'])){
                    $json_res['complet'] = true;
                }else{
                    $json_res['complet'] = false;
                }
                break;
            case "getDataCliente":
                $datos_cliente = $cliente_model->getDataCliente($_GET['client_id']);
                print(json_encode($datos_cliente[0]['vent_cliente']));
                break;
            case "saveEditCliente":
                if($cliente_model->saveEditCliente($_GET)){
                    $json_data['complet'] = true;
                }else{
                    $json_data['complet'] = false;
                }
                print(json_encode($json_data));
                break;
            case "buscarCliente":
                $list_clientes = $cliente_model->buscarClienteXPalabra($_GET['buscar_palabra']);
                if(!empty($list_clientes)){
                    $cont = 0;
                    foreach($list_clientes as $key =>$value){
                        $json_data['id']    = $value['vent_cliente']['vent_cli_cod_unico'];
                        $json_data['label'] = $value['vent_cliente']['vent_cli_codigo_cliente']." ".$value['vent_cliente']['vent_cli_nombre']." ".$value['vent_cliente']['vent_cli_apellido_pat']." ".$value['vent_cliente']['vent_cli_apellido_mat'];
                        $json_data['value'] = $value['vent_cliente']['vent_cli_nombre']." ".$value['vent_cliente']['vent_cli_apellido_pat']." ".$value['vent_cliente']['vent_cli_apellido_mat'];
                        $array[$cont] = $json_data; 
                        $cont++;
                    }
                }else{
                    $json_data['id']    = '';
                    $json_data['label'] = 'Por favor intente con otro nombre no se encontraron coicidencia para '.$_GET['buscar_palabra'];
                    $json_data['value'] = '';
                    $array[0] = $json_data;
                }
                print(json_encode($array));    
                
                break;
        }
    }
}

?>