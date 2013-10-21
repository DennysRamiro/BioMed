<?php
require_once '../lib/Mysql.php';
require_once 'Proyecto.php';
require_once 'Utilitarios.php';
require_once 'Proveedor.php';
/**
 * Clase contrato gestiona todas las consultas y formulario de certificado
 * @Ruth Palomino ARGO SI 
 * @date 16/05/2013
 */
class Certificado{
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
	* Metodo que crear el formulario del certificado
	*/
	public function formularioNuevoCertificado(){
		$template = file_get_contents('tpl/certificado_form_tpl.html');
	    print($template);
		
	}

	/*
	* Metodo que crear el formulario del certificado
	*/
	public function formularioNuevoCertificadoProv(){
		$template = file_get_contents('tpl/certificado_prov_form_tpl.html');
	    print($template);
		
	}

	/*
	* Metodo que crear la lista de los certificados
	*/
	public function formularioListaCertificado(){
		$template = file_get_contents('tpl/lista_certificado_tpl.html');
	    print($template);
		
	}

	/*
	* Metodo que crear la lista de los certificados
	*/
	public function formularioListaCertificadoProv(){
		$template = file_get_contents('tpl/lista_certificado_prov_tpl.html');
	    print($template);
		
	}

	/*
	* Metodo que crear la lista de los certificados 
	*/
	public function listaCertOpciones(){
		$template = file_get_contents('tpl/certificado_seleccionar_form_tpl.html');
	    print($template);
		
	}

	/*
	* Metodo formulario detallar los certificados
	*/
	public function formularioDetallarCertificado(){
		//echo "LLEGO PHP".$id_certificado;
		//$tipos = $this->listaTipos();
		$template = file_get_contents('tpl/detallar_certificado_tpl.html');
	    print($template);
		
	}

		/*
	* Metodo formulario detallar los certificados
	*/
	public function formularioDetallarCertificadoProv(){
		//echo "LLEGO PHP".$id_certificado;
		//$tipos = $this->listaTipos();
		$template = file_get_contents('tpl/detallar_certificado_prov_tpl.html');
	    print($template);
		
	}

		/* Este es el metodo para grabar los datos de formulario de certificados
	*  
	*/
	public function grabarCertificado($numero_documento, $codigo_proyecto, $fec_doc, $descripcion_cert, $comis_cert_otros, $login, $fec_proc){
		//echo("GRABAR PHP CERT");
		$util = new Utilitarios();
		//echo $numero_documento;
		//echo $codigo_proyecto;
		//echo $fec_doc1=$util->cambiaf_a_mysql($fec_doc);
		//ECHO $fec_doc;
		//echo $descripcion_cert;
		//echo $login;
		//echo $fec_proc; 		
		$valor['alm_form_id']=NULL;
		$valor['alm_form_tipo'] =9;
		$valor['alm_form_nro_doc'] = $numero_documento;
		$valor['alm_form_fecha_doc'] = $util->cambiaf_a_mysql($fec_doc);
		$valor['alm_proy_cod'] = $codigo_proyecto;
		$valor['alm_prov_id'] = 'Consolidado';
		$valor['alm_form_fecha_registro'] = $util->cambiaf_a_mysql($fec_proc);
		$valor['alm_form_observaciones'] = $descripcion_cert;
		$valor['alm_form_comision_cert'] = $comis_cert_otros;
		$valor['alm_form_usr_alta'] = $login;
		if($this->mysql->insert('alm_form_importacion', $valor)){
			$json_data['completo'] = true;
			$json_data['tipo_formulario']=9;
			$json_data['codigo_proyecto']=$codigo_proyecto;
		}else{
			$json_data['completo'] = false;
		}
		print(json_encode($json_data));
	}
		/* Este es el metodo para grabar los datos de formulario de certificados
	*  
	*/
	public function grabarCertificadoProv($numero_documento, $codigo_proyecto,$codigo_proveedor, $fec_doc, $descripcion_cert, $comis_cert_otros, $login, $fec_proc){
		//echo("GRABAR PHP CERT");
		$util = new Utilitarios();
		//echo $numero_documento;
		//echo $codigo_proyecto;
		//echo $fec_doc1=$util->cambiaf_a_mysql($fec_doc);
		//ECHO $fec_doc;
		//echo $descripcion_cert;
		//echo $login;
		//echo $fec_proc; 		
		$valor['alm_form_id']=NULL;
		$valor['alm_form_tipo'] =9;
		$valor['alm_form_nro_doc'] = $numero_documento;
		$valor['alm_form_fecha_doc'] = $util->cambiaf_a_mysql($fec_doc);
		$valor['alm_proy_cod'] = $codigo_proyecto;
		$valor['alm_prov_id'] = $codigo_proveedor;
		$valor['alm_form_fecha_registro'] = $util->cambiaf_a_mysql($fec_proc);
		$valor['alm_form_observaciones'] = $descripcion_cert;
		$valor['alm_form_comision_cert'] = $comis_cert_otros;
		$valor['alm_form_usr_alta'] = $login;
		if($this->mysql->insert('alm_form_importacion', $valor)){
			$json_data['completo'] = true;
			$json_data['tipo_formulario']=9;
			$json_data['codigo_proyecto']=$codigo_proyecto;
		}else{
			$json_data['completo'] = false;
		}
		print(json_encode($json_data));
	}

	/*
	* Metodo para grabar lo modificado en los certificados 
	*/

	public function modificarDetalleCertificado($id_certificado, $codigo_proyecto,$numero_documento,$fec_doc,$descripcion_cert,$comis_cert_otros_det, $login, $fec_proc){
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
	
		if ($this->mysql->update('alm_form_importacion',$value,'alm_form_id='.$id_certificado.'')) {
			//return true; 

	$valor['alm_form_id']=NULL;
	$valor['alm_form_tipo'] =9;
	$valor['alm_form_nro_doc'] = $numero_documento;
	$valor['alm_form_fecha_doc'] = $util->cambiaf_a_mysql($fec_doc);
	$valor['alm_proy_cod'] = $codigo_proyecto;
	$valor['alm_form_fecha_registro'] = $util->cambiaf_a_mysql($fec_proc);
	$valor['alm_form_observaciones'] = $descripcion_cert;
	$valor['alm_form_comision_cert'] = $comis_cert_otros_det;
	$valor['alm_form_usr_alta'] = $login;
		if($this->mysql->insert('alm_form_importacion', $valor)){
			$json_data['completo'] = true;
			$json_data['tipo_formulario']=9;
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
	* Metodo para grabar lo modificado en los certificados 
	*/

	public function modificarDetalleCertificadoProv($id_certificado, $codigo_proyecto,$cod_prov,$numero_documento,$fec_doc,$descripcion_cert,$comis_cert_otros_det, $login, $fec_proc){
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
	
		if ($this->mysql->update('alm_form_importacion',$value,'alm_form_id='.$id_certificado.'')) {
			//return true; 

	$valor['alm_form_id']=NULL;
	$valor['alm_form_tipo'] =9;
	$valor['alm_form_nro_doc'] = $numero_documento;
	$valor['alm_form_fecha_doc'] = $util->cambiaf_a_mysql($fec_doc);
	$valor['alm_proy_cod'] = $codigo_proyecto;
	$valor['alm_prov_id'] = $cod_prov;
	$valor['alm_form_fecha_registro'] = $util->cambiaf_a_mysql($fec_proc);
	$valor['alm_form_observaciones'] = $descripcion_cert;
	$valor['alm_form_comision_cert'] = $comis_cert_otros_det;
	$valor['alm_form_usr_alta'] = $login;
		if($this->mysql->insert('alm_form_importacion', $valor)){
			$json_data['completo'] = true;
			$json_data['tipo_formulario']=9;
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
	public function darBajaCertificado($id_certificado, $codigo_proyecto, $login){
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
	if ($this->mysql->update('alm_form_importacion',$value,'alm_form_id='.$id_certificado.'')) {
		$json_data['completo'] = true;
		$json_data['tipo_formulario']=9;
		$json_data['codigo_proyecto']=$codigo_proyecto;
	}else{
		$json_data['completo'] = false;
		}
	print(json_encode($json_data));
	}

	/*
	* Metodo dar de baja de los certificados
	*/
	public function darBajaCertificadoLista($id_certificado, $codigo_proyecto, $login){
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
	if ($this->mysql->update('alm_form_importacion',$value,'alm_form_id='.$id_certificado.'')) {
		$json_data['completo'] = true;
		$json_data['tipo_formulario']=9;
		$json_data['codigo_proyecto']=$codigo_proyecto;
	}else{
		$json_data['completo'] = false;
		}
	print(json_encode($json_data));
	}
	/*
	* Consulta listar de los certificados
	*/
	public function ListarCertificadosProveedor($codigo_proy){
		//echo "aquiiiiii".$codigo_proy;
		$query = 'SELECT * 
				  FROM alm_form_importacion i INNER JOIN alm_proveedor p ON i.alm_prov_id=p.alm_prov_codigo_int
				  WHERE i.alm_proy_cod="'.$codigo_proy.'" AND  i.alm_form_tipo=8 AND ISNULL(i.alm_form_usr_baja)';
		return $this->mysql->query($query);
		
	}

		/* ListarCertificado
	* Consulta listar de los certificados
	*/
	public function ListarCertificado($codigo_proy){
		//echo "aquiiiiii".$codigo_proy;
		$query = 'SELECT *,(SELECT SUM(alm_form_comision_cert) 
							  FROM alm_form_importacion 
							  WHERE ISNULL(alm_form_usr_baja) AND  alm_form_tipo=9 AND alm_proy_cod="'.$codigo_proy.'")  AS suma_cert  
                 FROM alm_form_importacion WHERE alm_proy_cod="'.$codigo_proy.'" AND  alm_form_tipo=9 AND ISNULL(alm_form_usr_baja)';
		return $this->mysql->query($query);
		
	}

		/*
	* Consulta listar de los certificados Bancarios
	*/
	public function ListarCertProv($codigo_proy,$codigo_prov){
		//echo "aquiiiiii".$codigo_proy;
		$query = 'SELECT * FROM alm_form_importacion i INNER JOIN alm_proveedor p ON i.alm_prov_id=p.alm_prov_codigo_int 
				  WHERE alm_form_tipo=9 AND alm_proy_cod="'.$codigo_proy.'" AND i.alm_prov_id="'.$codigo_prov.'" AND ISNULL(p.alm_prov_usr_baja) AND ISNULL(i.alm_form_usr_baja)';
		return $this->mysql->query($query);
		
	}

	/*
	* Consulta detalle de un certificado
	*/
	public function detalleCertificado($id_certificado, $codigo_proy){
		//echo "aquiiiiii".$codigo_proy;
		//echo "aquiiiiii".$id_certificado;
		

		$query = 'SELECT * FROM alm_form_importacion WHERE alm_form_tipo=9 AND alm_proy_cod="'.$codigo_proy.'" AND alm_form_id='.$id_certificado;
		return $this->mysql->query($query);
		
	}

		/*
	* Consulta detalle de un certificado
	*/
	public function detalleCertificadoProv($id_certificado, $codigo_proy,$codigo_prov){
		//echo "aquiiiiii".$codigo_proy;
		//echo "aquiiiiii".$id_certificado;
		

		$query = 'SELECT * FROM alm_form_importacion WHERE alm_form_tipo=9 AND alm_proy_cod="'.$codigo_proy.'" AND alm_form_id='.$id_certificado;
		return $this->mysql->query($query);
		
	}
	/*
	/*
	* Metodo convertir normal las fechas
	*/
	 public function convertirNormal($fecha){
		 $util = new Utilitarios();
		 return $util->cambiaf_a_normal($fecha);
	 }
}
?>