<?php
require_once '../lib/Mysql.php';
/**
 * Esta es la clase 
 */
class Cliente{
	/**
	 * Atributo de mysql private para cargar el mysql
	 */
	private $mysql;
    /*
     * Este es el constructo de del modelo HomeModel
     */
    public function __construct() {
        $this->mysql = new Mysql();
    }
        /**
     * Metodo que devuelve total Clientes
     */
    public function totalClientes(){
        $query = 'SELECT COUNT(*) AS total 
                  FROM vent_cliente 
                  WHERE ISNULL(vent_cli_usr_baja)';
        return $this->mysql->query($query);
    }
       /**
     * Metodo que devuelve Nombre Cliente
     */
    public function getNombreCliente($id_cliente){
		$query = 'SELECT vent_cli_nombre,vent_cli_apellido_pat,vent_cli_apellido_mat/*,vent_cli_nombre, vent_cli_apellido_pat,vent_cli_apellido_mat,vent_cli_codigo_cliente,vent_cli_cod_unico,vent_cli_codigo_cliente*/
				  FROM vent_cliente 
				  WHERE vent_cli_cod_unico="'.$id_cliente.'" AND ISNULL(vent_cli_usr_baja)';
		return $this->mysql->query($query);
    }
    /**
     * Metodo que permite listar los clientes que tengan coincidencia con el id
     */
    public function listaClientesxId($cliente_id,$start, $limit){
      $query = 'SELECT * 
                FROM vent_cliente 
                WHERE vent_cli_cod_unico="'.$cliente_id.'" AND ISNULL(vent_cli_usr_baja)
                LIMIT '.$start.',10';
      return $this->mysql->query($query);
    }
    /**
     * Metodo que lista los clientes
     */
    public function listaClientes($start, $limit){
    	$query = 'SELECT * 
                  FROM vent_cliente 
                  WHERE ISNULL(vent_cli_usr_baja)
                  LIMIT '.$start.',10';
    	return $this->mysql->query($query);
    }

       /**
     * Metodo que lista los clientes Sin Limites
     */
    public function listaTodosClientes(){
      $query='SELECT *
              FROM vent_cliente 
              WHERE ISNULL(vent_cli_usr_baja)';
      return $this->mysql->query($query);
    }

           /*
     * Este es el metodo que devuelve el codigo del cliente
     * 
     */
    public function getCodCliente($id_unico){
        $consulta  = 'SELECT vent_cli_codigo_cliente
                      FROM vent_cliente 
                      WHERE ISNULL(vent_cli_usr_baja) AND vent_cli_cod_unico="'.$id_unico.'"';
        return $this->mysql->query($consulta);
    }

    /**
     * Metodo que guarda los datos
     */
    public function guardarCliente($datos){
      $valores['vent_cli_id']=NULL;
      $valores['vent_cli_cod_unico']=$this->getCodigoUnicoCliente();
      $valores['vent_cli_codigo_cliente']=$this->getCodigoCliente('C', 6);
      $valores['vent_cli_nombre']=strtoupper($datos['txt_vent_nombre_cliente']);
      $valores['vent_cli_apellido_pat']=strtoupper($datos['txt_vent_apellido_pat_cliente']);
      $valores['vent_cli_apellido_mat']=strtoupper($datos['txt_vent_apellido_mat_cliente']);
      $valores['vent_cli_empresa_trab']=strtoupper($datos['txt_vent_empresa_cliente']);
      $valores['vent_cli_direccion']=strtoupper($datos['txt_area_vent_dirrecion_cliente']);
      $valores['vent_cli_persona_cont']=strtoupper($datos['txt_vent_cliente_persona_contacto']);
      $valores['vent_cli_cargo']=strtoupper($datos['txt_vent_cargo_cliente']);
      $valores['vent_cli_departamento_cargo']=strtoupper($datos['txt_vent_departamento_cliente']);
      $valores['vent_cli_telefono']=$datos['txt_vent_telefono_cliente'];
      $valores['vent_cli_interno']=$datos['txt_vent_numero_interno'];
      $valores['vent_cli_celular']=$datos['txt_vent_celular_cliente'];
      $valores['vent_cli_correo']=$datos['txt_vent_cliente_correo'];
      $valores['vent_cli_nit']=$datos['txt_vent_nit_cliente'];
      $valores['vent_cli_razon_fact']=strtoupper($datos['txt_vent_razon_social_cliente']);
      $valores['vent_cli_usr_alta']=$_SESSION['login'];
      return $this->mysql->insert('vent_cliente', $valores);
    }

        /**
     * Metodo que guarda los datos boton desde home
     */
    public function guardarClienteBot($datos){
      $valores['vent_cli_id']=NULL;
      $valores['vent_cli_cod_unico']=$this->getCodigoUnicoCliente();
      $valores['vent_cli_codigo_cliente']=$this->getCodigoCliente('C', 6);
      $valores['vent_cli_nombre']=strtoupper($datos['txt_vent_nombre_cliente_bot']);
      $valores['vent_cli_apellido_pat']=strtoupper($datos['txt_vent_apellido_pat_cliente_bot']);
      $valores['vent_cli_apellido_mat']=strtoupper($datos['txt_vent_apellido_mat_cliente_bot']);
      $valores['vent_cli_empresa_trab']=strtoupper($datos['txt_vent_empresa_cliente_bot']);
      $valores['vent_cli_direccion']=strtoupper($datos['txt_area_vent_dirrecion_cliente_bot']);
      $valores['vent_cli_persona_cont']=strtoupper($datos['txt_vent_cliente_persona_contacto_bot']);
      $valores['vent_cli_cargo']=strtoupper($datos['txt_vent_cargo_cliente_bot']);
      $valores['vent_cli_departamento_cargo']=strtoupper($datos['txt_vent_departamento_cliente_bot']);
      $valores['vent_cli_telefono']=$datos['txt_vent_telefono_cliente_bot'];
      $valores['vent_cli_interno']=$datos['txt_vent_numero_interno_bot'];
      $valores['vent_cli_celular']=$datos['txt_vent_celular_cliente_bot'];
      $valores['vent_cli_correo']=$datos['txt_vent_cliente_correo_bot'];
      $valores['vent_cli_nit']=$datos['txt_vent_nit_cliente_bot'];
      $valores['vent_cli_razon_fact']=strtoupper($datos['txt_vent_razon_social_cliente_bot']);
      $valores['vent_cli_usr_alta']=$_SESSION['login'];
      if ($this->mysql->insert('vent_cliente', $valores)){
                    $json_res['complet'] = true;
                    $json_res['codigo_cliente'] = $valores['vent_cli_codigo_cliente'];
                    $json_res['id_cliente'] = $valores['vent_cli_cod_unico'];
                    $json_res['nom_cliente'] = $valores['vent_cli_nombre'];
                    $json_res['app_cliente'] = $valores['vent_cli_apellido_pat'];
                    $json_res['appm_cliente'] = $valores['vent_cli_apellido_mat'];

                }else{
                    $json_res['complet'] = false;
                }
      print(json_encode($json_res));
    }

          /**
     * Metodo que guarda los datos boton desde home publ
     */
    public function guardarClienteBotPubl($datos){
      $valores['vent_cli_id']=NULL;
      $valores['vent_cli_cod_unico']=$this->getCodigoUnicoCliente();
      $valores['vent_cli_codigo_cliente']=$this->getCodigoCliente('C', 6);
      $valores['vent_cli_nombre']=strtoupper($datos['txt_vent_nombre_cliente_bot_publ']);
      $valores['vent_cli_apellido_pat']=strtoupper($datos['txt_vent_apellido_pat_cliente_bot_publ']);
      $valores['vent_cli_apellido_mat']=strtoupper($datos['txt_vent_apellido_mat_cliente_bot_publ']);
      $valores['vent_cli_empresa_trab']=strtoupper($datos['txt_vent_empresa_cliente_bot_publ']);
      $valores['vent_cli_direccion']=strtoupper($datos['txt_area_vent_dirrecion_cliente_bot_publ']);
      $valores['vent_cli_persona_cont']=strtoupper($datos['txt_vent_cliente_persona_contacto_bot_publ']);
      $valores['vent_cli_cargo']=strtoupper($datos['txt_vent_cargo_cliente_bot_publ']);
      $valores['vent_cli_departamento_cargo']=strtoupper($datos['txt_vent_departamento_cliente_bot_publ']);
      $valores['vent_cli_telefono']=$datos['txt_vent_telefono_cliente_bot_publ'];
      $valores['vent_cli_interno']=$datos['txt_vent_numero_interno_bot_publ'];
      $valores['vent_cli_celular']=$datos['txt_vent_celular_cliente_bot_publ'];
      $valores['vent_cli_correo']=$datos['txt_vent_cliente_correo_bot_publ'];
      $valores['vent_cli_nit']=$datos['txt_vent_nit_cliente_bot_publ'];
      $valores['vent_cli_razon_fact']=strtoupper($datos['txt_vent_razon_social_cliente_bot_publ']);
      $valores['vent_cli_usr_alta']=$_SESSION['login'];
      if ($this->mysql->insert('vent_cliente', $valores)){
                    $json_res['complet'] = true;
                    $json_res['codigo_cliente'] = $valores['vent_cli_codigo_cliente'];
                    $json_res['id_cliente'] = $valores['vent_cli_cod_unico'];
                    $json_res['nom_cliente'] = $valores['vent_cli_nombre'];
                    $json_res['app_cliente'] = $valores['vent_cli_apellido_pat'];
                    $json_res['appm_cliente'] = $valores['vent_cli_apellido_mat'];

                }else{
                    $json_res['complet'] = false;
                }
      print(json_encode($json_res));
    }
    /**
     * Generar codigo de Cliente
     **/
    private function getCodigoCliente($inicial, $num_cel){
      $codigo = $inicial;
      $max_id = $this->getMaxCliente();
      $cant = strlen($max_id);
      $ceros = '';
      while($num_cel > 0){
        while($cant>0){
          $num_cel = $num_cel-1;
          $cant=$cant-1;
        }
        $ceros = $ceros.'0';
        $num_cel = $num_cel-1;
      }
      $codigo = $codigo.$ceros.($max_id+1);
     return $codigo;
    }
    /**
     * Metodo que devuelve el maximo de cliente
     */
    private function getMaxCliente(){
      $query = "SELECT MAX(vent_cli_id) AS id_max 
                FROM vent_cliente
                WHERE ISNULL(vent_cli_usr_baja)";
      $max = $this->mysql->query($query);
      return $max[0][0]['id_max'];
    }
    /**
     * Generar codogo unico cliente
     */
    private function getCodigoUnicoCliente(){
      $codigo = uniqid('inter_cliente_');
      return $codigo;
    }
    /**
     * Metodo que permite eliminar un cliente
     */
    public function deleteCliente($id_cliente){
      date_default_timezone_set('America/La_Paz');
      $fecha_actual  = date("y-m-d H:i:s");
      $valores['vent_cli_usr_baja'] = $_SESSION['login'];
      $valores['vent_cli_fch_hr_baja'] = $fecha_actual;
      $condicion = "vent_cli_cod_unico='".$id_cliente."'";
      return $this->mysql->update('vent_cliente', $valores, $condicion);
    }
    /**
     * Metodo que devuevel los datos de un cliente en funcion a su id de Cliente
     */
    public function getDataCliente($id_cliente){
      $query = "SELECT * 
                FROM vent_cliente
                WHERE ISNULL(vent_cli_usr_baja) AND vent_cli_cod_unico='".$id_cliente."'";
      return $this->mysql->query($query);
    }
    /*
     * Metodo que guardas los datos del edit de clientes
     */
    public function saveEditCliente($datos){
      date_default_timezone_set('America/La_Paz');
      $fecha_actual  = date("y-m-d H:i:s");
      $valor['vent_cli_usr_baja'] = $_SESSION['login'];
      $valor['vent_cli_fch_hr_baja'] = $fecha_actual;
      $condicion = "vent_cli_cod_unico='".$datos['id_unico_cliente']."'";
      $this->mysql->update('vent_cliente', $valor, $condicion);
      //print_r($datos);
      $valores['vent_cli_id']=NULL;
      $valores['vent_cli_cod_unico']=$datos['id_unico_cliente'];
      $valores['vent_cli_codigo_cliente']=$datos['codigo_cliente'];
      $valores['vent_cli_nombre']=strtoupper($datos['txt_vent_nombre_cliente_edit']);
      $valores['vent_cli_apellido_pat']=strtoupper($datos['txt_vent_apellido_pat_cliente_edit']);
      $valores['vent_cli_apellido_mat']=strtoupper($datos['txt_vent_apellido_mat_cliente_edit']);
      $valores['vent_cli_empresa_trab']=strtoupper($datos['txt_vent_empresa_cliente_edit']);
      $valores['vent_cli_direccion']=strtoupper($datos['txt_area_vent_dirrecion_cliente_edit']);
      $valores['vent_cli_persona_cont']=strtoupper($datos['txt_vent_cliente_persona_contacto_edit']);
      $valores['vent_cli_cargo']=strtoupper($datos['txt_vent_cargo_cliente_edit']);
      $valores['vent_cli_departamento_cargo']=strtoupper($datos['txt_vent_departamento_cliente_edit']);
      $valores['vent_cli_telefono']=$datos['txt_vent_telefono_cliente_edit'];
      $valores['vent_cli_interno']=$datos['txt_vent_numero_interno_edit'];
      $valores['vent_cli_celular']=$datos['txt_vent_celular_cliente_edit'];
      $valores['vent_cli_correo']=$datos['txt_vent_cliente_correo_edit'];
      $valores['vent_cli_nit']=$datos['txt_vent_nit_cliente_edit'];
      $valores['vent_cli_razon_fact']=strtoupper($datos['txt_vent_razon_social_cliente_edit']);
      $valores['vent_cli_usr_alta']=$_SESSION['login'];
      return $this->mysql->insert('vent_cliente', $valores);
    }

    /**
     * Metodo que busca la palabra en la tabla de clientes
     */
    public function buscarClienteXPalabra($buscar_palabra){
      $query = 'SELECT * 
                FROM vent_cliente
                WHERE (vent_cli_codigo_cliente LIKE "%'.$buscar_palabra.'%" OR 
                      vent_cli_nombre LIKE "%'.$buscar_palabra.'%" OR
                      vent_cli_apellido_pat LIKE "%'.$buscar_palabra.'%" OR
                      vent_cli_apellido_mat LIKE "%'.$buscar_palabra.'%") AND ISNULL(vent_cli_usr_baja)
                ORDER BY vent_cli_nombre ASC';
      return $this->mysql->query($query);
    }
}
?>