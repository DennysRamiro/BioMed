<?php

require_once '../lib/Mysql.php';
require_once 'Utilitarios.php';

/**
 * Clase Proyecto gestiona todas las consultas y formulario de proyecto
 * @author ARGO SI 
 * @date 16/05/2013
 */
class Proyecto{
	// Esta es la variable mysql
	private $mysql;
	/**
	 * Este es el constructor de la clase proyecto
	 * @param  parm1 -> signigica esto
	 *         param2 -> significa esta otra cosa
	 * @return  variable, variable[] -> descripscion 
	 */
	public function __construct() {
		// Constructor
		$this->mysql = new Mysql();
	}
	/**
	 * Metodo que devuelve la lista de los proyectos
	 * @return el arreglo de la lista de proyectos
	 */
	public function listaProyectos(){
		$query = "SELECT * FROM  alm_proyecto WHERE  ISNULL(alm_proy_usr_baja) ORDER BY alm_proy_estado";
		return $this->mysql->query($query);
	}
	/**
	 * Esta e la lista de los proyectos por palabra
	 */
	public function listaProyectosXPalabra($codigo_proyecto){
		$query = 'SELECT * FROM  alm_proyecto 
		          WHERE (alm_proy_cod like "%'.$codigo_proyecto.'%" 
	                      OR alm_proy_nom like "%'.$codigo_proyecto.'%" 
	                      OR alm_proy_descripcion like "%'.$codigo_proyecto.'%") AND ISNULL(alm_proy_usr_baja) ORDER BY alm_proy_estado';
		//print_r($query);
		return $this->mysql->query($query);
	}

		/**
	 * Metodo que devuelve la lista de los proyectos concluidos
	 * @return el arreglo de la lista de proyectos
	 */
	public function listaProyectosTerminados(){
		$query = "SELECT * FROM  alm_proyecto WHERE  ISNULL(alm_proy_usr_baja) AND 	alm_proy_estado='13'";
		return $this->mysql->query($query);
	}

	/**
	 * Metodo que devuelve la lista de busqueda de los proyectos
	 * @return el arreglo de la lista de busqueda proyectos
	 */

	public function listarBusquedaProyectos($buscar){
		$query= 'SELECT * 
		         FROM alm_proyecto p INNER JOIN gral_param_propios t ON p.alm_proy_tipo=t.GRAL_PAR_PRO_COD 
                            INNER JOIN gral_param_propios e  ON p.alm_proy_estado=e.GRAL_PAR_PRO_COD
                 WHERE t.GRAL_PAR_PRO_GRP=1500 AND e.GRAL_PAR_PRO_GRP=1700 AND ISNULL(p.alm_proy_usr_baja)
				                      AND (p.alm_proy_nom like "%'.$buscar.'%" 
				                      OR p.alm_proy_cod like "%'.$buscar.'%" 
				                      OR t.GRAL_PAR_PRO_DESC like "%'.$buscar.'%" 
				                      OR e.GRAL_PAR_PRO_DESC like "%'.$buscar.'%");';
	
			return $this->mysql->query($query);
					          
	}
	/**
	 * Metodo que devuelve la lista de busqueda de los proyectos
	 * @return el arreglo de la lista de busqueda proyectos
	 */

	public function listarBusquedaProyectosTerminados($buscar){
		$query= 'SELECT * 
		         FROM alm_proyecto p INNER JOIN gral_param_propios t ON p.alm_proy_tipo=t.GRAL_PAR_PRO_COD 
                            INNER JOIN gral_param_propios e  ON p.alm_proy_estado=e.GRAL_PAR_PRO_COD
                 WHERE t.GRAL_PAR_PRO_GRP=1500 AND e.GRAL_PAR_PRO_GRP=1700 
				                      AND (p.alm_proy_nom like "%'.$buscar.'%" 
				                      OR p.alm_proy_cod like "%'.$buscar.'%" 
				                      OR t.GRAL_PAR_PRO_DESC like "%'.$buscar.'%" 
				                      OR e.GRAL_PAR_PRO_DESC like "%'.$buscar.'%")AND p.alm_proy_estado=13;';
	
			return $this->mysql->query($query);
					          
	}
	
	/*
	 * Metodo que permite seleccionar un proyecto en especifico
	 * @param id, codigo_proyecto  son los datos necesarios para la seleccion del proyecto
	 */
	 
	public function seleccionarProyecto($id_proyecto, $codigo_proyecto){
		$query = 'SELECT *
		          FROM alm_proyecto
		          WHERE alm_proy_id='.$id_proyecto.' AND alm_proy_cod="'.$codigo_proyecto.'"
				   AND ISNULL(alm_proy_usr_baja) ORDER BY alm_proy_estado asc';
		return $this->mysql->query($query);
	}
	/**
	 * Metodo que se encarga de devolver el tipo dell proyecto
	 * @param $id_tipo  este es el id del tipo de proyecto
	 */
	public function obtenerTipo($id_tipo){
		$query = 'Select GRAL_PAR_PRO_ID, GRAL_PAR_PRO_DESC, GRAL_PAR_PRO_COD
                                                   From gral_param_propios 
                                                   where GRAL_PAR_PRO_GRP = 1500 and GRAL_PAR_PRO_COD <> 0  AND GRAL_PAR_PRO_COD='.$id_tipo;
		return $this->mysql->query($query);
	}
	/*
	 * Lista de tipos devulvel el arreglo con los tipos de preoyectos
	 * @return listaTipos arreglo
	 */
	public function listaTipos(){
		$query = 'Select GRAL_PAR_PRO_ID, GRAL_PAR_PRO_DESC, GRAL_PAR_PRO_COD
				   From gral_param_propios 
				   where GRAL_PAR_PRO_GRP = 1500 and GRAL_PAR_PRO_COD <> 0';
		return $this->mysql->query($query);
	}
	
	/**
	 * Metodo que nos sirve para optener el estado del proyecto
	 * @param $estado 
	 */
	public function obtenerEstado($estado){
		$query='Select GRAL_PAR_PRO_ID, GRAL_PAR_PRO_DESC, GRAL_PAR_PRO_COD 
				 From gral_param_propios 
				where GRAL_PAR_PRO_GRP = 1700 and GRAL_PAR_PRO_COD<>0 AND GRAL_PAR_PRO_COD='.$estado;
		return $this->mysql->query($query);
	}
	/*
	* Metodo que crear el formulario de nuevos proyectos 
	*/
	public function formularioNuevo(){
		$template = file_get_contents('tpl/proyecto_form_tpl.html');
		$tipos = $this->listaTipos();
		$tipos_proy = '<select name="tipo_proyecto" size="1" size="10" id="tipo_proyecto">';
		foreach($tipos as $key => $tipo){
			$tipos_proy = $tipos_proy.'<option value="'.utf8_encode($tipo['gral_param_propios']['GRAL_PAR_PRO_COD']).'">'.
						  utf8_encode($tipo['gral_param_propios']['GRAL_PAR_PRO_DESC']).'</option>';
		}
		$tipos_proy = $tipos_proy.'</select >';
		$template = str_replace('{proyecto_tipo}', $tipos_proy, $template);
        print($template);
	}
	
	/**
	 * Metodo que graba los datos del proyecto en la base de datos
	 * @param $nombre_proyecto, $tipo_proyecto,$fec_ini,$fec_fin,$descripcion_proyecto
	 */
	 public function grabarProyecto($nombre_proyecto, $tipo_proyecto,$fec_ini,$fec_fin,$descripcion_proyecto, $login){
		$util = new Utilitarios();
		$valor['alm_proy_id'] = NULL;
		$valor['alm_proy_cod'] = $util->codigoIncrementableProyecto($tipo_proyecto);
		$valor['alm_proy_nom'] = strtoupper($nombre_proyecto);
		$valor['alm_proy_fecha_inicio'] = $util->cambiaf_a_mysql($fec_ini);
		$valor['alm_proy_fecha_fin'] = $util->cambiaf_a_mysql($fec_fin);
		$valor['alm_proy_tipo'] = $tipo_proyecto;
		$valor['alm_proy_estado'] = 1;
		$valor['alm_proy_usr_alta'] = $login;
		$valor['alm_proy_descripcion'] = strtoupper($descripcion_proyecto);
	//	echo $this->mysql->insert('alm_proyecto', $valor);
	//echo $valor;
		if($this->mysql->insert('alm_proyecto', $valor)){
			$json_data['completo'] = true;
		}else{
			$json_data['completo'] = false;
		}
		print(json_encode($json_data));
	 }

	 /**
	  *  Metodo que permite imprimir el dialogo de los mensajes en el html
	  *
	  */
	 public function dialogoMensaje(){
	 	$template = file_get_contents('tpl/dialogo_msg_tpl.html');
	 	print($template);
	 }
	 public function convertirNormal($fecha){
		 $util = new Utilitarios();
		 return $util->cambiaf_a_normal($fecha);
	 }
	 
	 
   /**
	 * Metodo que actualiza el estado del proyecto en la base de datos
	 * @param $proy id deo proyecto para obtener el proyecto correcto
	 */
	public function actualizaEstadoProyecto($codigo_proyecto,$estado){
		  $value['alm_proy_estado'] = $estado;
		  //print_r($value);
		  if($this->mysql->update('alm_proyecto', $value,'alm_proy_cod="'.$codigo_proyecto.'"')){
			 return true; 
		  }else{
			 return false;
		  }
	}
	
	 /**
	 * Metodo que actualiza el estado del proyecto en la base de datos
	 * @param $proy id deo proyecto para obtener el proyecto correcto
	 */
	public function ListaModificarProyectos($codigo_proyecto){
		$query='
				SELECT i.alm_form_id,i.alm_form_tipo, pp.GRAL_PAR_PRO_DESC,i.alm_form_nro_doc, i.alm_form_fecha_registro, i.alm_form_observaciones,
				   p.alm_proy_cod, p.alm_proy_nom, p.alm_proy_fecha_inicio, p.alm_proy_fecha_fin
				FROM alm_form_importacion i INNER JOIN alm_proyecto p ON i.alm_proy_cod=p.alm_proy_cod
				INNER JOIN gral_param_propios pp ON pp.GRAL_PAR_PRO_COD = i.alm_form_tipo
				WHERE i.alm_proy_cod="'.$codigo_proyecto.'" AND pp.GRAL_PAR_PRO_GRP = 1700 and pp.GRAL_PAR_PRO_COD <> 0
				ORDER BY i.alm_form_tipo ASC';
		
		return $this->mysql->query($query);
	}

	/**
	 * Metodo que nos sirve para optener los proveedores de las ordenes del proyecto
	 * @param $estado 
	 */
	public function obtenerProveedorOrden($codigo_proyecto){
		$query='SELECT c.alm_proy_cod,p.alm_prov_codigo_int, p.alm_prov_nombre  
				FROM alm_ord_compra_cab c INNER JOIN alm_proveedor p ON c.alm_prov_codigo=p.alm_prov_codigo_int
				WHERE c.alm_proy_cod="'.$codigo_proyecto.'"
				GROUP BY p.alm_prov_codigo_int';
		return $this->mysql->query($query);
	}	
	
	/**
	 * Metodo que nos sirve para dar de baja el proyecto
	 * @param $estado 
	 */
	 public function bajaProyecto($cod_proy){
		//print_r($cod_proy);
		$value['alm_proy_usr_baja'] = $_SESSION['login'];
		 if($this->mysql->update('alm_proyecto', $value,'alm_proy_cod="'.$cod_proy.'"')){
			 return true; 
		  }else{
			 return false;
		  }
		  
	}
}
?>