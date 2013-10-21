<?php
require_once '../lib/Mysql.php';
require_once 'Proyecto.php';
require_once 'Utilitarios.php';
require_once 'Proveedor.php';
/**
 * Clase contrato gestiona todas las consultas y formulario de contrato
 * @author ARGO SI 
 * @date 16/05/2013
 */
class GuiaEmbarque{
	// Esta es la variable mysql
	private $mysql;
	/*
	 * Este es el constructor de la clase guia de embarque
	 * @param  parm1 -> signigica esto
	 *         param2 -> significa esta otra cosa
	 * @return  variable, variable[] -> descripscion 
	 */
	public function __construct() {
		// Constructor
		$this->mysql = new Mysql();
	}
	/* Este es el metodo para el formulario de Guia de embarque
	*
	*/
	public function formularioGuiaEmbarque(){
		//echo ("PHP");
	
	$template = file_get_contents('tpl/guia_embarque_form_tpl.html');
	    print($template);
		
	}

	/* Este es el metodo para el formulario de opciones  Guia de embarque
	*
	*/
	public function listaGuiaOpciones(){
		//echo ("PHP");
	
	$template = file_get_contents('tpl/guia_seleccionar_form_tpl.html');
	    print($template);
		
	}

		/* Este es el metodo para el formulario de opciones  Guia de embarque
	*
	*/
	public function formularioListaGuiaEmbarque(){
		//echo ("PHP");
	
	$template = file_get_contents('tpl/guia_embarque_lista_form_tpl.html');
	    print($template);
		
	}

		/* Este es el metodo para el formulario de opciones  Guia de embarque
	*
	*/
	public function formularioGuiaEmbarqueLista(){
		//echo ("PHP");
	
	$template = file_get_contents('tpl/nueva_guia_embarque_form_tpl.html');
	    print($template);
		
	}

	/* Este es el metodo para el formulario detalle de Guia de embarque
	*
	*/
	public function formularioDetallarGuiaEmbarque(){
		//echo ("PHP");
	
	$template = file_get_contents('tpl/detallar_guia_embarque_tpl.html');
	    print($template);
		
	}

		/*
	* Metodo convertir normal las fechas
	*/
	 public function convertirNormal($fecha){
		 $util = new Utilitarios();
		 return $util->cambiaf_a_normal($fecha);
	 }


	/* Este es el metodo para grabar los datos de formulario de Guia de embarque
	*  
	*/
	public function grabarGuiaEmbarque($numero_documento, $codigo_proyecto,$fec_doc,$descripcion_guia, $login, $fec_proc,$cert){
		$util = new Utilitarios();
		//echo $numero_documento;
		//echo $codigo_proyecto;
		//echo $fec_doc1=$util->cambiaf_a_mysql($fec_doc);
		//ECHO $fec_doc;
		//echo $descripcion_guia;
		//echo $login;
		//echo $fec_proc; alm_from_cert_otros		
		$valor['alm_form_id']=NULL;
		$valor['alm_form_tipo'] =8;
		$valor['alm_form_nro_doc'] = $numero_documento;
		$valor['alm_form_fecha_doc'] = $util->cambiaf_a_mysql($fec_doc);
		$valor['alm_proy_cod'] = $codigo_proyecto;
		$valor['alm_form_fecha_registro'] = $util->cambiaf_a_mysql($fec_proc);
		$valor['alm_form_observaciones'] = $descripcion_guia;
		$valor['alm_form_cert_otros'] = $cert;
		$valor['alm_form_usr_alta'] = $login;
		if($this->mysql->insert('alm_form_importacion', $valor)){
			$json_data['completo'] = true;
			$json_data['tipo_formulario']=8;
			$json_data['codigo_proyecto']=$codigo_proyecto;
		}else{
			$json_data['completo'] = false;
		}
		print(json_encode($json_data));
	}

	/* Este es el metodo para grabar los datos de formulario de Guia de embarque
	*  
	*/

			/*
	* Metodo para grabar lo modificado en los certificados 
	*/

	public function modificarDetalleGuiaEmbarque($id_guia, $codigo_proyecto,$cod_prov,$numero_documento,$fec_doc,$descripcion_guia,$cert, $login, $fec_proc){
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
	
		if ($this->mysql->update('alm_form_importacion',$value,'alm_form_id='.$id_guia.'')) {
			//return true; 

	$valor['alm_form_id']=NULL;
	$valor['alm_form_tipo'] =8;
	$valor['alm_form_nro_doc'] = $numero_documento;
	$valor['alm_form_fecha_doc'] = $util->cambiaf_a_mysql($fec_doc);
	$valor['alm_proy_cod'] = $codigo_proyecto;
	$valor['alm_prov_id'] = $cod_prov;
	$valor['alm_form_fecha_registro'] = $util->cambiaf_a_mysql($fec_proc);
	$valor['alm_form_observaciones'] = $descripcion_guia;
	$valor['alm_form_cert_otros'] = $cert;
	//$valor['alm_form_comision_cert'] = $comis_cert_otros_det;
	$valor['alm_form_usr_alta'] = $login;
		if($this->mysql->insert('alm_form_importacion', $valor)){
			$json_data['completo'] = true;
			$json_data['tipo_formulario']=8;
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
	public function darBajaGuiaEmbarque($id_guia, $codigo_proyecto, $login){
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
	if ($this->mysql->update('alm_form_importacion',$value,'alm_form_id='.$id_guia.'')) {
		$json_data['completo'] = true;
		$json_data['tipo_formulario']=8;
		$json_data['codigo_proyecto']=$codigo_proyecto;
	}else{
		$json_data['completo'] = false;
		}
	print(json_encode($json_data));
	}
	public function grabarGuiaEmbarqueLista($numero_documento, $codigo_proyecto, $codigo_proveedor,$fec_doc,$descripcion_guia, $login, $fec_proc,$cert){
		$util = new Utilitarios();
		//echo $numero_documento;
		//echo $codigo_proyecto;
		//echo $fec_doc1=$util->cambiaf_a_mysql($fec_doc);
		//ECHO $fec_doc;
		//echo $descripcion_guia;
		//echo $login;
		//echo $fec_proc; alm_from_cert_otros		
		$valor['alm_form_id']=NULL;
		$valor['alm_form_tipo'] =8;
		$valor['alm_form_nro_doc'] = $numero_documento;
		$valor['alm_form_fecha_doc'] = $util->cambiaf_a_mysql($fec_doc);
		$valor['alm_proy_cod'] = $codigo_proyecto;
		$valor['alm_prov_id'] = $codigo_proveedor;
		$valor['alm_form_fecha_registro'] = $util->cambiaf_a_mysql($fec_proc);
		$valor['alm_form_observaciones'] = $descripcion_guia;
		$valor['alm_form_cert_otros'] = $cert;
		$valor['alm_form_usr_alta'] = $login;
		if($this->mysql->insert('alm_form_importacion', $valor)){
			$json_data['completo'] = true;
			$json_data['tipo_formulario']=8;
			$json_data['codigo_proyecto']=$codigo_proyecto;
		}else{
			$json_data['completo'] = false;
		}
		print(json_encode($json_data));
	}


	/**
	 * Metodo que devuelve la lista de las Guias de Embarque
	 * @return el arreglo de la lista de Guia de Embarque
	 */
	public function listaGuiasCert($codigo_proy){
		//print_r($codigo_proy);
		$query = 'SELECT * FROM alm_ord_compra_cab c INNER JOIN alm_proveedor p ON c.alm_prov_codigo=p.alm_prov_codigo_int AND ISNULL(c.alm_ord_compra_usr_baja) AND ISNULL(p.alm_prov_usr_baja)  WHERE alm_proy_cod="'.$codigo_proy.'" GROUP BY alm_prov_codigo';
		//print_r($query);
		return $this->mysql->query($query);
	}


	/**
	 * Metodo que devuelve la lista de las Guias de Embarque
	 * @return el arreglo de la lista de Guia de Embarque
	 */
	public function nroProveedor($codigo_proy){
		//print_r($codigo_proy);
		$query = 'SELECT COUNT(alm_prov_id) AS nro_prov
				  FROM alm_form_importacion 
				  WHERE alm_proy_cod="'.$codigo_proy.'" AND alm_form_tipo=5 AND alm_prov_id IS NOT NULL AND ISNULL(alm_form_usr_baja)';
		//print_r($query);
		return $this->mysql->query($query);
	}
		/**
	 * Metodo que devuelve la lista de las Guias de Embarque
	 * @return el arreglo de la lista de Guia de Embarque
	 */
	public function certGuia($codigo_proy){
		//print_r($codigo_proy);
		$query = 'SELECT alm_form_cert_otros 
				  FROM alm_form_importacion 
				  WHERE alm_proy_cod="'.$codigo_proy.'" AND alm_form_tipo=8 AND ISNULL(alm_prov_id) AND ISNULL(alm_form_usr_baja)';
		//print_r($query);
		return $this->mysql->query($query);
	}

		/*
	* Consulta listar de los certificados Bancarios
	*/
	public function ListarGe($codigo_proy,$codigo_prov){
		//echo "aquiiiiii".$codigo_proy;
		$query = 'SELECT * FROM alm_form_importacion i INNER JOIN alm_proveedor p ON i.alm_prov_id=p.alm_prov_codigo_int 
				  WHERE alm_form_tipo=8 AND alm_proy_cod="'.$codigo_proy.'" AND i.alm_prov_id="'.$codigo_prov.'" AND ISNULL(p.alm_prov_usr_baja) AND ISNULL(i.alm_form_usr_baja)';
		return $this->mysql->query($query);
		
	}

		/*
	* Consulta detalle de un confirmacion
	*/
	public function detalleGuiaEmbarque($id_guia, $codigo_proy, $cod_prov){
		//echo "aquiiiiii".$codigo_proy;
		//echo "aquiiiiii".$id_certificado;
		$query = 'SELECT * FROM alm_form_importacion 
				  WHERE alm_form_tipo=8 AND alm_proy_cod="'.$codigo_proy.'" AND alm_prov_id="'.$cod_prov.'" AND ISNULL(alm_form_usr_baja)';
		return $this->mysql->query($query);
		
	}


}
?>