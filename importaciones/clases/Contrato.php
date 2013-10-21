<?php
require_once '../lib/Mysql.php';
require_once 'Proyecto.php';
require_once 'Utilitarios.php';
/**
 * Clase contrato gestiona todas las consultas y formulario de contrato
 * @author ARGO SI 
 * @date 16/05/2013
 */
class Contrato{
	// Esta es la variable mysql
	private $mysql;
	/*
	 * Este es el constructor de la clase contrato
	 * @param  parm1 -> signigica esto
	 *         param2 -> significa esta otra cosa
	 * @return  variable, variable[] -> descripscion 
	 */
	public function __construct() {
		// Constructor
		$this->mysql = new Mysql();
	}

	/*
	* Metodo que crear el formulario de nuevos Contratos o Pedidos 
	*/
	public function formularioContrato(){
		$template = file_get_contents('tpl/contrato_form_tpl.html');
		/*$proyecto = new Proyecto();
		$tipos = $proyecto->listaProyectos();
		$tipos_proy = '<select name="tipo_proyecto" size="1" size="10" id="tipo_proyecto">';
		foreach($tipos as $key => $tipo){
			$tipos_proy = $tipos_proy.'<option value="'.utf8_encode($tipo['alm_proyecto']['alm_proy_cod']).'">'.
						  utf8_encode($tipo['alm_proyecto']['alm_proy_nom']).'</option>';
		}
		$tipos_proy = $tipos_proy.'</select >';
		$template = str_replace('{proyecto_tipo}', $tipos_proy, $template);
       */
	    print($template);
		
	}
	
	

	
	/**
	 * Metodo que graba los datos del contrato en la base de datos
	 * @param $nro_doc_cont, $tipo_proyecto,$fec_doc_cont,$obs_cont, $login
	 */
	 public function grabarContrato($numero_documnento, $codigo_proyecto,$fec_doc,$descripcion_contrato, $login, $fec_proc){
		$util = new Utilitarios();
		$valor['alm_form_id'] = NULL;
		$valor['alm_form_tipo'] = "2";
		$valor['alm_form_nro_doc'] = $numero_documnento;
		$valor['alm_form_fecha_doc'] = $util->cambiaf_a_mysql($fec_doc);
		$valor['alm_proy_cod'] = $codigo_proyecto;
		$valor['alm_form_fecha_registro'] = $util->cambiaf_a_mysql($fec_proc);
		$valor['alm_form_observaciones'] = $descripcion_contrato;
		$valor['alm_form_usr_alta'] = $login;
		if($this->mysql->insert('alm_form_importacion', $valor)){
			$json_data['completo'] = true;
			$json_data['codigo_proyecto'] = $codigo_proyecto;
			$json_data['estado_proyecto'] = 2;
		}else{
			$json_data['completo'] = false;
		}
		print(json_encode($json_data));
	 }
	 
	 /**
	 * metodo que saca los valores para poder modificar elcontrato
	 */
	 
	 public function listarContrato($cod_proy, $id_proy){
		 //print_r($cod_proy.$id_proy);
		
		$query = "SELECT * FROM alm_form_importacion WHERE alm_proy_cod='".$cod_proy."' AND alm_form_id=".$id_proy;
		//print_r($query);
		return $this->mysql->query($query);

	 }
	 
	  /**
	 * metodo que saca los valores para poder lista el contrato
	 */
	 public function formularioModificarContrato(){
		$template = file_get_contents('tpl/ModificacionContrato_form_tpl.html');
	    print($template);	
	}
	
	 /**
	 * metodo que saca los valores para poder modificar el contrato
	 * $cod_proy_con, $num_doc_con,$fecha_doc_con,$obs_con, $login, $fec_proc
	 */
	public function ActualizarFormularioContrato($cod_proy_con,$id_proy_con, $num_doc_con,$fecha_doc_con,$obs_con, $login, $fec_proc){
		$util = new Utilitarios();
		$valor['alm_form_tipo'] = "2";
		$valor['alm_form_nro_doc'] = $num_doc_con;
		$valor['alm_form_fecha_doc'] = $util->cambiaf_a_mysql($fecha_doc_con);
		$valor['alm_proy_cod'] = $cod_proy_con;
		$valor['alm_form_fecha_registro'] = $util->cambiaf_a_mysql($fec_proc);
		$valor['alm_form_observaciones'] = $obs_con;
		$valor['alm_form_usr_alta'] = $login;

		if($this->mysql->insert('alm_form_importacion', $valor)){
			$json_data['completo'] = true;
			$json_data['codigo_proyecto'] = $cod_proy_con;
			$json_data['id_proyecto'] = $id_proy_con;
			$json_data['estado_proyecto'] = 2;
			
		}else{
			$json_data['completo'] = false;
		}
		print(json_encode($json_data));
	 }
				


	 /**
	 * metodo que saca los valores para poder modificar elcontrato
	 */
	public function modificarFormularioContrato($cod_proy_con, $num_doc_con,$fecha_doc_con,$obs_con, $login, $fec_proc){
		//$util = new Utilitarios();
		 $value['alm_form_usr_baja'] = $_SESSION['login'];
		 //$value['alm_form_fch_baja'] = $util->obtenerFechaActual;
		  //print_r($value);
		  if($this->mysql->update('alm_form_importacion', $value,'alm_proy_cod="'.$cod_proy.'"')){
			 return true; 
		  }else{
			 return false;
		  }
	}
	
	/**
	 * metodo que saca los valores para poder modificar elcontrato
	 */
	public function bajaContrato($codigo_proyecto, $id_proyecto, $login, $fec_proc){
		$util = new Utilitarios();
		 $value['alm_form_id'] = $id_proyecto;
		 $value['alm_proy_cod'] = $codigo_proyecto;
		 $value['alm_form_usr_baja'] = $login;
		 $value['alm_form_fch_baja'] = obtenerFechaActual();

		  if($this->mysql->update('alm_form_importacion', $value,'alm_proy_cod="'.$cod_proy.'" AND alm_form_id="'.$id_proyecto.'"')){
			 return true; 
		  }else{
			 return false;
		  }
	}
		
	
	
	
}
?>