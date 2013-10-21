<?php
require_once "../lib/Mysql.php";
class ClienteController{
    private $mysql;

    public function __construct() {
        $this->mysql = new Mysql();
    }
    /** Este es el metodo que permite hacer login de usuarios */
	public function loginUsuario($login, $password){
		$query = "SELECT * 
             FROM gral_usuario 
             WHERE GRAL_USR_LOGIN='".$login."' 
             AND GRAL_USR_CLAVE='".$password."' AND GRAL_USR_USR_BAJA IS NULL LIMIT 1 ";
 		if($clientes = $this->mysql->query($query)){
 			$json_data['complet'] = true;	
 		}else{
 			$json_data['complet'] = false;
 		}
		header( "Content-type: application/json; charset=utf-8"); 
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Credentials: true"); 
        header('Access-Control-Allow-Headers: *');
        header('Access-Control-Allow-Headers: Content-Type');
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT'); 
        header('Access-Control-Max-Age: 86400');
        if(isset($_GET['callback'])){ 
            print_r($_GET['callback']."(".json_encode($json_data).")"); 
        }else{ 
            print_r(json_encode($json_data)); 
        } 
	}
    /** La lista de los clientes **/
    public function listarClientes(){
        $query = "SELECT * 
                  FROM vent_cliente 
                  WHERE ISNULL(vent_cli_usr_baja)";
        $clientes = $this->mysql->query($query);
        header( "Content-type: application/json; charset=utf-8"); 
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Credentials: true"); 
        header('Access-Control-Allow-Headers: *');
        header('Access-Control-Allow-Headers: Content-Type');
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT'); 
        header('Access-Control-Max-Age: 86400');
        $cont = 0;
        foreach ($clientes as $key => $value) {
            $json_data[$cont] = $clientes[$cont]['vent_cliente'];
            $cont++; 
        }
        $cliente['clientes'] = $json_data;
        print(json_encode($cliente));
    }
}
?>