<?php

require_once '../lib/Mysql.php';
require_once 'Proyecto.php';
require_once 'Utilitarios.php';
require_once 'Proveedor.php';

/**
 * Clase Proyecto gestiona todas las consultas y formulario de desaduanizacion
 * @author ARGO SI 
 * @date 16/05/2013
 */
class Desaduanizacion{
	// Esta es la variable mysql
	private $mysql;
	/**
	 * Este es el constructor de la clase desaduanizacion
	 * @param  parm1 -> signigica esto
	 *         param2 -> significa esta otra cosa
	 * @return  variable, variable[] -> descripscion 
	 */
	public function __construct() {
		// Constructor
		$this->mysql = new Mysql();
	}


/*
	* Metodo que crear el formulario de Desaduanizaciones
	*/
	public function formularioDesaduanizacion(){
		$template = file_get_contents('tpl/desaduanizacion_form_tpl.html');
		
        print($template);
	}

	/*
	* Metodo que crear el formulario de Desaduanizaciones
	*/
	public function formularioDesaduanizacionProv(){
		$template = file_get_contents('tpl/desaduanizacion_prov_form_tpl.html');
		
        print($template);
	}

		/*
	* Metodo que crear la lista de los certificados 
	*/
	public function listaDesOpciones(){
		$template = file_get_contents('tpl/desa_seleccionar_form_tpl.html');
	    print($template);
		
	}

		/*
	* Metodo que crear la lista de los certificados 
	*/
	/*public function formularioListaDesaProv(){
		$template = file_get_contents('tpl/lista_desa_prov_tpl.html');
	    print($template);
		
	}*/
			/*
	* Consulta listar de los certificados
	*/
	public function ListarDesaProveedor($codigo_proy){
		//echo "aquiiiiii".$codigo_proy;
		$query = 'SELECT * 
				  FROM alm_form_importacion i INNER JOIN alm_proveedor p ON i.alm_prov_id=p.alm_prov_codigo_int
				  WHERE alm_proy_cod="'.$codigo_proy.'" AND alm_form_tipo=8 AND ISNULL(alm_form_usr_baja)';
		return $this->mysql->query($query);
		
	}
			/*
	* Consulta listar de los certificados Bancarios
	*/
	public function ListarDesaProv($codigo_proy,$codigo_prov){
		//echo "aquiiiiii".$codigo_proy;
		$query = 'SELECT * FROM alm_form_importacion i INNER JOIN alm_proveedor p ON i.alm_prov_id=p.alm_prov_codigo_int 
				  WHERE alm_form_tipo=10 AND alm_proy_cod="'.$codigo_proy.'" AND i.alm_prov_id="'.$codigo_prov.'" AND ISNULL(p.alm_prov_usr_baja) AND ISNULL(i.alm_form_usr_baja)';
		return $this->mysql->query($query);
		
	}

	/*
	* Metodo que crear la lista de los certificados
	*/
	public function formularioListaDesaProv(){
		$template = file_get_contents('tpl/lista_desa_prov_tpl.html');
	    print($template);
		
	}

		/*
	* Metodo que crear la lista de los certificados
	*/
	public function formularioDetallarDesa(){
		$template = file_get_contents('tpl/detallar_desa_prov_tpl.html');
	    print($template);
		
	}

		/*
	/*
	* Metodo convertir normal las fechas
	*/
	 public function convertirNormal($fecha){
		 $util = new Utilitarios();
		 return $util->cambiaf_a_normal($fecha);
	 }

			/*
	* Consulta detalle de un certificado
	*/
	public function DetallesDesa($id_desa, $codigo_proy,$codigo_prov){
		//echo "aquiiiiii".$codigo_proy;
		//echo "aquiiiiii".$id_certificado;
		

		$query = 'SELECT * FROM alm_form_importacion WHERE alm_form_tipo=10 AND alm_proy_cod="'.$codigo_proy.'" AND alm_form_id='.$id_desa;
		return $this->mysql->query($query);
		
	}
	
	
		/**
	 * Metodo que graba los datos de desaduanizacion en la base de datos
	 * @param $nro_doc_cont, $tipo_proyecto,$fec_doc_cont,$obs_cont, $login
	 */
	 public function grabarNuevaDesanuanizacion($codigo_proyecto,$codigos_dui,$fec_doc_dui, $obs_dui,$login, $fec_proc){
		$util = new Utilitarios();
		$valor['alm_form_id'] = NULL;
		$valor['alm_form_tipo'] = "10";
		$valor['alm_form_nro_doc'] = $codigos_dui;
		$valor['alm_form_fecha_doc'] = $util->cambiaf_a_mysql($fec_doc_dui);
		$valor['alm_proy_cod'] = $codigo_proyecto;
		$valor['alm_form_fecha_registro'] = $util->cambiaf_a_mysql($fec_proc);
		$valor['alm_form_observaciones'] = $obs_dui;
		$valor['alm_form_usr_alta'] = $login;
		if($this->mysql->insert('alm_form_importacion', $valor)){
			$json_data['completo'] = true;
			$json_data['estado_proyecto'] = 10;
			$json_data['codigo_proyecto'] = $codigo_proyecto;
		}else{
			$json_data['completo'] = false;
		}
		print(json_encode($json_data));
	 }

	 	/*
	* Metodo para grabar lo modificado en los certificados 
	*/

	public function modificarDetalleDesaProv($id_desa, $codigo_proyecto,$cod_prov,$numero_documento,$fec_doc,$descripcion_desa, $login, $fec_proc){
	//echo("GRABAR PHP CERT");
	$util = new Utilitarios();
	//echo $id_certificado;
	//echo $codigo_proyecto;
	//echo $numero_documento;
	//echo $fec_doc;
	//echo $descripcion_cert;
	//echo $login;
	//echo $fec_proc; 
	$fecha= $util->obtenerFechaActual();
	$value['alm_form_usr_baja']=$login;
	$value['alm_form_fch_baja']=$fecha;
	//echo $fecha; 
	
		if ($this->mysql->update('alm_form_importacion',$value,'alm_form_id='.$id_desa.'')) {
			//return true; 

	$valor['alm_form_id']=NULL;
	$valor['alm_form_tipo'] =10;
	$valor['alm_form_nro_doc'] = $numero_documento;
	$valor['alm_form_fecha_doc'] = $util->cambiaf_a_mysql($fec_doc);
	$valor['alm_proy_cod'] = $codigo_proyecto;
	$valor['alm_prov_id'] = $cod_prov;
	$valor['alm_form_fecha_registro'] = $util->cambiaf_a_mysql($fec_proc);
	$valor['alm_form_observaciones'] = $descripcion_desa;
	$valor['alm_form_usr_alta'] = $login;
		if($this->mysql->insert('alm_form_importacion', $valor)){
			$json_data['completo'] = true;
			$json_data['tipo_formulario']=10;
			$json_data['codigo_proyecto']=$codigo_proyecto;
		}else{
			$json_data['completo'] = false;
		}
		print(json_encode($json_data));

		}else{
		 return false;
	  }


	}

	/*
	* Metodo dar de baja de los certificados
	*/
	public function darBajaDesa($id_desa, $codigo_proyecto, $login){
    //echo("GRABAR PHP CERT");
	$util = new Utilitarios();
	//echo $id_certificado;
	//echo $codigo_proyecto;
	//echo $numero_documento;
	//echo $fec_doc;
	//echo $descripcion_cert;
	//echo $login;
	//echo $fec_proc; 
	$fecha= $util->obtenerFechaActual();
	$value['alm_form_usr_baja']=$login;
	$value['alm_form_fch_baja']=$fecha;
	if ($this->mysql->update('alm_form_importacion',$value,'alm_form_id='.$id_desa.'')) {
		$json_data['completo'] = true;
		$json_data['tipo_formulario']=10;
		$json_data['codigo_proyecto']=$codigo_proyecto;
	}else{
		$json_data['completo'] = false;
		}
	print(json_encode($json_data));
	}

	 	/**
	 * Metodo que graba los datos de desaduanizacion en la base de datos
	 * @param $nro_doc_cont, $tipo_proyecto,$fec_doc_cont,$obs_cont, $login
	 */
	 public function grabarNuevaDesanuanizacionProv($codigo_proyecto,$codigo_proveedor,$codigos_dui,$fec_doc_dui, $obs_dui,$login, $fec_proc){
		$util = new Utilitarios();
		$valor['alm_form_id'] = NULL;
		$valor['alm_form_tipo'] = "10";
		$valor['alm_form_nro_doc'] = $codigos_dui;
		$valor['alm_form_fecha_doc'] = $util->cambiaf_a_mysql($fec_doc_dui);
		$valor['alm_proy_cod'] = $codigo_proyecto;
		$valor['alm_prov_id'] = $codigo_proveedor;
		$valor['alm_form_fecha_registro'] = $util->cambiaf_a_mysql($fec_proc);
		$valor['alm_form_observaciones'] = $obs_dui;
		$valor['alm_form_usr_alta'] = $login;
		if($this->mysql->insert('alm_form_importacion', $valor)){
			$json_data['completo'] = true;
			$json_data['estado_proyecto'] = 10;
			$json_data['codigo_proyecto'] = $codigo_proyecto;
		}else{
			$json_data['completo'] = false;
		}
		print(json_encode($json_data));
	 }

}