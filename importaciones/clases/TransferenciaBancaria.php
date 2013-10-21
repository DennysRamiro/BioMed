<?php
require_once '../lib/Mysql.php';
require_once 'Proyecto.php';
require_once 'Utilitarios.php';
require_once 'Proveedor.php';
/**
 * Clase contrato gestiona todas las consultas y formulario de transferencia Bancaria
 * @author Ramiro Gutierrez 
 * @date 21/05/2013
 */
class TransferenciaBancaria{
	// Esta es la variable mysql
	private $mysql;
	/*
	 * Este es el constructor de la clase transferencia Bancaria
	 * @param  parm1 -> signigica esto
	 *         param2 -> significa esta otra cosa
	 * @return  variable, variable[] -> descripscion 
	 */
	public function __construct() {
		// Constructor
		$this->mysql = new Mysql();
	}
	
	
	/**
	 * Metodo que crear el formulario de la nueva transferencia bancaria 
	 */
	 
	 public function listaCuentasBancarias(){
		/*$query="SELECT CONTA_CTA_NRO, CONTA_CTA_DESC
				FROM contab_cuenta ";*/
		$query = "SELECT GRAL_CTA_BAN_CTA_CTE, GRAL_CTA_BAN_DESC FROM gral_cta_banco";		
		return $this->mysql->query($query);
	}
	
	
	/**
	 * Metodo que crear el formulario de la nueva transferencia bancaria 
	 */
	public function formularioTransferenciaBancaria(){
		$template = file_get_contents('tpl/transferencia_bancaria_form_tpl.html');
		$lista_cuentas = $this->listaCuentasBancarias();
		$cta_bco = '<select name="cuentas_bancarias" size="1" size="10" id="cuentas_bancarias">';
		foreach($lista_cuentas as $key => $tipo){
			$cta_bco = $cta_bco.'<option value="'.utf8_encode($tipo['gral_cta_banco']['GRAL_CTA_BAN_CTA_CTE']).'">'.utf8_encode($tipo['gral_cta_banco']['GRAL_CTA_BAN_DESC']).'</option>';
		}
		$cta_bco = $cta_bco.'</select >';
		$template = str_replace('{cuenta_banco}', $cta_bco, $template);
	    print($template);
		
	}
	
	/**
	 * Metodo que graba los datos del transferencia bancaria en la base de datos
	 * @param $nro_doc_cont, $tipo_proyecto,$fec_doc_cont,$obs_cont, $login
	 */
	 public function grabarNuevaTransferenciaBancaria($codigos_proyectos,$cta_bco, $fec_trans_bco,$nro_doc_trans_bco,$obs_trans_bco, $monto_trans_bco,$comision_trans_bco,$numero_unico_orden,$login, $fec_proc){

		$util = new Utilitarios();
		$valor['alm_form_id'] = NULL;
		$valor['alm_form_tipo'] = "5";
		$valor['alm_form_nro_doc'] = $nro_doc_trans_bco;
		$valor['alm_form_fecha_doc'] = $util->cambiaf_a_mysql($fec_trans_bco);
		$valor['alm_prov_id'] = $numero_unico_orden;
		$valor['alm_proy_cod'] = $codigos_proyectos;
		$valor['alm_form_fecha_registro'] = $util->cambiaf_a_mysql($fec_proc);
		$valor['alm_form_observaciones'] = $obs_trans_bco;
		$valor['alm_nro_cta_tranf'] = $cta_bco;
		$valor['alm_form_monto_transf'] = $monto_trans_bco;
		$valor['alm_form_comision_trans'] = $comision_trans_bco;
		$valor['alm_form_usr_alta'] = $login;
		
		if($this->mysql->insert('alm_form_importacion', $valor)){
			$json_data['completo'] = true;
			$json_data['estado_proyecto'] = 5;
			$json_data['codigo_proyecto'] = $codigos_proyectos;
		}else{
			$json_data['completo'] = false;
		}
		print(json_encode($json_data));
	 }
	 
	 /**
	 * Metodo que crear el formulario de la nueva confirmacion de la transferencia bancaria 
	 */
	 public function formularioNuevaTransferenciaBancaria(){
		$template = file_get_contents('tpl/transferencia_bancaria_lista_form_tpl.html');
		print($template);
	}
	
	 /**
	 * Metodo que crear el formulario de la nueva confirmacion de la transferencia bancaria 
	 */
	 public function formularioConfirmacionTransferenciaBancaria(){
		$template = file_get_contents('tpl/confirmacion_transferencia_bancaria_form_tpl.html');
		print($template);
	}
		 /**
	 * Metodo formulario para lista confirmacion de la transferencia bancaria 
	 */
	 public function formularioListaConfirmacionTransferenciaBancaria(){
		$template = file_get_contents('tpl/lista_confirmacion_bancaria_tpl.html');
		print($template);
	}
   /**
	 * Metodo que graba los datos del confirmacion transferencia bancaria en la base de datos
	 * @param $nro_doc_cont, $tipo_proyecto,$fec_doc_cont,$obs_cont, $login
	 */
	 public function grabarConfirmacionTransferenciaBancaria($codigos_proyectos,$codigos_proveedores,$fec_conf_trans_bco, $cod_conf_trans_bco,$obs_conf_trans_bco,$login, $fec_proc){
		$util = new Utilitarios();
		$valor['alm_form_id'] = NULL;
		$valor['alm_form_tipo'] = "7";
		$valor['alm_form_nro_doc'] = $cod_conf_trans_bco;
		$valor['alm_form_fecha_doc'] = $util->cambiaf_a_mysql($fec_conf_trans_bco);
		$valor['alm_prov_id'] = $codigos_proveedores;
		$valor['alm_proy_cod'] = $codigos_proyectos;
		$valor['alm_form_fecha_registro'] = $util->cambiaf_a_mysql($fec_proc);
		$valor['alm_form_observaciones'] = $obs_conf_trans_bco;
		$valor['alm_form_usr_alta'] = $login;
		if($this->mysql->insert('alm_form_importacion', $valor)){
			$json_data['completo'] = true;
			$json_data['estado_proyecto'] = 7;
			$json_data['codigo_proyecto'] = $codigos_proyectos;
		}else{
			$json_data['completo'] = false;
		}
		print(json_encode($json_data));
	 }
	 
	 
   /**
	 * Metodo que crear el formulario de la nueva confirmacion de la transferencia bancaria 
	 */
	 public function formularioCertificacionTransferenciaBancaria(){
		$template = file_get_contents('tpl/certificacion_transferencia_bancaria_form_tpl.html');
		print($template);
	}
	
	 /**
	 * Metodo que graba los datos del certificacion transferencia bancaria en la base de datos
	 * @param $nro_doc_cont, $tipo_proyecto,$fec_doc_cont,$obs_cont, $login
	 */
	 public function grabarFormularioCertificacionTransferenciaBancaria($codigos_proyectos,$codigos_proveedores,$fec_cert_trans_bco, $cod_cert_trans_bco,$obs_cert_trans_bco,$comis_cert_banc,$login, $fec_proc){
		//echo($codigos_proveedores);
		$util = new Utilitarios();
		$valor['alm_form_id'] = NULL;
		$valor['alm_form_tipo'] = "6";
		$valor['alm_form_nro_doc'] = $cod_cert_trans_bco;
		$valor['alm_form_fecha_doc'] = $util->cambiaf_a_mysql($fec_cert_trans_bco);
		$valor['alm_proy_cod'] = $codigos_proyectos;
		$valor['alm_form_fecha_registro'] = $util->cambiaf_a_mysql($fec_proc);
		$valor['alm_prov_id'] = $codigos_proveedores;
		$valor['alm_form_observaciones'] = $obs_cert_trans_bco;
		$valor['alm_form_comision_cert'] = $comis_cert_banc;
		$valor['alm_form_usr_alta'] = $login;
		if($this->mysql->insert('alm_form_importacion', $valor)){
			$json_data['completo'] = true;
			$json_data['estado_proyecto'] = 6;
			$json_data['codigo_proyecto'] = $codigos_proyectos;
		}else{
			$json_data['completo'] = false;
		}
		print(json_encode($json_data));
	 }

	 	/**
	 * Metodo que devuelve la monto de la tranferencia
	 * @return el arreglo del monto de tranferencia
	 */
	public function montoTransferencia($codigo_proy){
		$query = 'SELECT alm_form_monto_transf FROM alm_form_importacion WHERE alm_form_tipo=5 AND alm_proy_cod="'.$codigo_proy.'"';
		return $this->mysql->query($query);
	}

	 	/**
	 * Metodo que devuelve la datos de tranf para hoja de costo
	 * @return el arreglo la datos de tranf para hoja de costo
	 */
	public function datosTransferencia($codigo_proy,$tc,$cod_prov){
		$query = 'SELECT (SELECT alm_form_monto_transf FROM alm_form_importacion WHERE alm_form_tipo=5 AND alm_proy_cod="'.$codigo_proy.'" AND alm_prov_id="'.$cod_prov.'" AND ISNULL(alm_form_usr_baja)) As monto_trans_sus ,
		((SELECT alm_form_monto_transf FROM alm_form_importacion WHERE alm_form_tipo=5 AND alm_proy_cod="'.$codigo_proy.'" AND alm_prov_id="'.$cod_prov.'" AND ISNULL(alm_form_usr_baja))*'.$tc.') As monto_trans_bs , 
		(SELECT alm_form_comision_trans FROM alm_form_importacion WHERE alm_form_tipo=5 AND alm_proy_cod="'.$codigo_proy.'" AND alm_prov_id="'.$cod_prov.'" AND ISNULL(alm_form_usr_baja)) As comision_trans_sus,
		((SELECT alm_form_comision_trans FROM alm_form_importacion WHERE alm_form_tipo=5 AND alm_proy_cod="'.$codigo_proy.'" AND alm_prov_id="'.$cod_prov.'" AND ISNULL(alm_form_usr_baja))*'.$tc.') As comision_trans_bs,
		(SELECT alm_form_nro_doc FROM alm_form_importacion WHERE alm_form_tipo=5 AND alm_proy_cod="'.$codigo_proy.'" AND alm_prov_id="'.$cod_prov.'" AND ISNULL(alm_form_usr_baja)) As nro_trans,
		(SELECT alm_form_nro_doc FROM alm_form_importacion WHERE alm_form_tipo=6 AND alm_proy_cod="'.$codigo_proy.'" AND alm_prov_id="'.$cod_prov.'" AND ISNULL(alm_form_usr_baja)) As nro_cert,
		(SELECT alm_form_comision_cert FROM alm_form_importacion WHERE alm_form_tipo=6 AND alm_proy_cod="'.$codigo_proy.'" AND alm_prov_id="'.$cod_prov.'" AND ISNULL(alm_form_usr_baja)) As monto_cert_trans_sus,
		((SELECT alm_form_comision_cert FROM alm_form_importacion WHERE alm_form_tipo=6 AND alm_proy_cod="'.$codigo_proy.'" AND alm_prov_id="'.$cod_prov.'" AND ISNULL(alm_form_usr_baja))*'.$tc.') As monto_cert_trans_bs
		FROM alm_form_importacion WHERE alm_proy_cod="'.$codigo_proy.'" AND alm_prov_id="'.$cod_prov.'"
		GROUP BY alm_proy_cod';
		//echo ($query);
		return $this->mysql->query($query);
	}
	
	
	
   /**
	 * Metodo que devuelve la lista de las ordenes de los proyectos para la transferrencia bancaria
	 * @return el arreglo del monto de tranferencia
	 */
	public function obtenerListaOrden($codigo_proy){
		
		$query ='SELECT ord.alm_proy_cod,proy.alm_proy_nom,ord.alm_id_orden_compra,ord.alm_id_unico_orden_compra, ord.alm_nro_referencia_orden, 
						ord.alm_nro_proforma, ord.alm_fecha_proforma, ord.alm_fecha_orden_registro, 
						ord.alm_termino_pago, ord.alm_terms, ord.alm_prov_codigo,p.alm_prov_nombre, p.alm_prov_cod_cta
				FROM alm_ord_compra_cab ord INNER JOIN alm_proveedor p ON ord.alm_prov_codigo=p.alm_prov_codigo_int 
				 INNER JOIN alm_proyecto proy ON ord.alm_proy_cod=proy.alm_proy_cod
				WHERE ord.alm_proy_cod="'.$codigo_proy.'" AND ISNULL(ord.alm_ord_compra_usr_baja) 
				GROUP BY ord.alm_prov_codigo';	
			
		return $this->mysql->query($query);
	}

	/**
	 * Metodo que devuelve la lista de las ordenes que ya fueron realizadas sus transacciones bancarias
	 * @orden_unico devuelve el valor de la llave unica 
	 */
	public function recuperaOrdenUnica($orden_unico,$cod_proy){
		//print_r($orden_unico."--".$cod_proy);		
		$query='
		SELECT alm_prov_id FROM alm_form_importacion WHERE alm_proy_cod="'.$cod_proy.'" AND alm_prov_id="'.$orden_unico.'"
		';		

		return $this->mysql->query($query);
	}
	/*
	* Metodo convertir normal las fechas
	*/
	 public function convertirNormal($fecha){
		 $util = new Utilitarios();
		 return $util->cambiaf_a_normal($fecha);
	 }
/*
	* Metodo que crear la lista de los certificados
	*/
	public function formularioListaCertificadoBancario(){
		$template = file_get_contents('tpl/lista_certificado_bancario_tpl.html');
	    print($template);
		
	}
	/*
	* Consulta listar de los certificados Bancarios
	*/
	public function ListarCertificadoBancario($codigo_proy){
		//echo "aquiiiiii".$codigo_proy;
		$query = 'SELECT * FROM alm_form_importacion i INNER JOIN alm_proveedor p ON i.alm_prov_id=p.alm_prov_codigo_int 
				  WHERE alm_form_tipo=5 AND alm_proy_cod="'.$codigo_proy.'" AND ISNULL(p.alm_prov_usr_baja) AND ISNULL(i.alm_form_usr_baja)  ';
		return $this->mysql->query($query);
		
	}

		/*
	* Consulta listar de los certificados Bancarios
	*/
	public function ListarCertBan($codigo_proy,$codigo_prov){
		//echo "aquiiiiii".$codigo_proy;
		$query = 'SELECT * FROM alm_form_importacion i INNER JOIN alm_proveedor p ON i.alm_prov_id=p.alm_prov_codigo_int 
				  WHERE alm_form_tipo=6 AND alm_proy_cod="'.$codigo_proy.'" AND i.alm_prov_id="'.$codigo_prov.'" AND ISNULL(p.alm_prov_usr_baja) AND ISNULL(i.alm_form_usr_baja)';
		return $this->mysql->query($query);
		
	}

			/*
	* Consulta listar de los certificados Bancarios
	*/
	public function ListarTranBan($codigo_proy,$codigo_prov){
		//echo "aquiiiiii".$codigo_proy;
		$query = 'SELECT * FROM alm_form_importacion i INNER JOIN alm_proveedor p ON i.alm_prov_id=p.alm_prov_codigo_int 
				  WHERE alm_form_tipo=5 AND alm_proy_cod="'.$codigo_proy.'" AND i.alm_prov_id="'.$codigo_prov.'" AND ISNULL(p.alm_prov_usr_baja) AND ISNULL(i.alm_form_usr_baja)';
		return $this->mysql->query($query);
		
	}

		/*
	* Consulta listar de los certificados Bancarios
	*/
	public function ListarConfBan($codigo_proy,$codigo_prov){
		//echo "aquiiiiii".$codigo_proy;
		$query = 'SELECT * FROM alm_form_importacion i INNER JOIN alm_proveedor p ON i.alm_prov_id=p.alm_prov_codigo_int 
				  WHERE alm_form_tipo=7 AND alm_proy_cod="'.$codigo_proy.'" AND i.alm_prov_id="'.$codigo_prov.'" AND ISNULL(p.alm_prov_usr_baja) AND ISNULL(i.alm_form_usr_baja) ';
		return $this->mysql->query($query);
		
	}
		/*
	* Consulta listar de los corfirmaciones
	*/
	public function ListarConfirmacionBancaria($codigo_proy){
		//echo "aquiiiiii".$codigo_proy;
		$query = 'SELECT * FROM alm_form_importacion i INNER JOIN alm_proveedor p ON i.alm_prov_id=p.alm_prov_codigo_int 
				  WHERE alm_form_tipo=5 AND alm_proy_cod="'.$codigo_proy.'" AND ISNULL(p.alm_prov_usr_baja) AND ISNULL(i.alm_form_usr_baja)';
		return $this->mysql->query($query);
		
	}
	/*
	* Metodo formulario detallar los certificados
	*/
	public function formularioDetallarCertificadoBancario(){
		//echo "LLEGO PHP".$id_certificado;
		//$tipos = $this->listaTipos();
		$template = file_get_contents('tpl/detallar_certificado_bancario_tpl.html');
	    print($template);
		
	}
	/*
	* Metodo formulario detallar las confirmaciones
	*/
	public function formularioDetallarConfirmacionBancaria(){
		//echo "LLEGO PHP".$id_certificado;
		//$tipos = $this->listaTipos();
		$template = file_get_contents('tpl/detallar_confirmacion_bancaria_tpl.html');
	    print($template);
		
	}
		/*
	* Consulta detalle de un certificado
	*/
	public function detalleCertificadoBancario($id_certificado, $codigo_proy, $cod_prov){
		/*echo "aquiiiiii".$codigo_proy;
		echo "aquiiiiii".$id_certificado;
		echo "aquiiiiii".$cod_prov;*/
		

		$query = 'SELECT * FROM alm_form_importacion 
		          WHERE alm_form_tipo=6 AND alm_proy_cod="'.$codigo_proy.'" AND alm_prov_id="'.$cod_prov.'" AND ISNULL(alm_form_usr_baja)';
		return $this->mysql->query($query);
		
	}

		/*
	* Consulta detalle de un confirmacion
	*/
	public function detalleConfirmacionBancaria($id_confirmacion, $codigo_proy, $cod_prov){
		//echo "aquiiiiii".$codigo_proy;
		//echo "aquiiiiii".$id_certificado;
		

		$query = 'SELECT * FROM alm_form_importacion 
				  WHERE alm_form_tipo=7 AND alm_proy_cod="'.$codigo_proy.'" AND alm_prov_id="'.$cod_prov.'" AND ISNULL(alm_form_usr_baja)';
		return $this->mysql->query($query);
		
	}

		/*
	* Metodo para grabar lo modificado en los certificados 
	*/

	public function modificarDetalleCertificadoBancario($id_certificado, $codigo_proyecto,$cod_prov,$numero_documento,$fec_doc,$descripcion_cert,$comis_cert_otros_det, $login, $fec_proc){
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
	$valor['alm_form_tipo'] =6;
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
			$json_data['tipo_formulario']=6;
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

	public function modificarDetalleConfirmacionBancaria($id_confirmacion, $codigo_proyecto,$cod_prov,$numero_documento,$fec_doc,$descripcion_cert, $login, $fec_proc){
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
	
		if ($this->mysql->update('alm_form_importacion',$value,'alm_form_id='.$id_confirmacion.'')) {
			//return true; 

	$valor['alm_form_id']=NULL;
	$valor['alm_form_tipo'] =7;
	$valor['alm_form_nro_doc'] = $numero_documento;
	$valor['alm_form_fecha_doc'] = $util->cambiaf_a_mysql($fec_doc);
	$valor['alm_proy_cod'] = $codigo_proyecto;
	$valor['alm_prov_id'] = $cod_prov;
	$valor['alm_form_fecha_registro'] = $util->cambiaf_a_mysql($fec_proc);
	$valor['alm_form_observaciones'] = $descripcion_cert;
	//$valor['alm_form_comision_cert'] = $comis_cert_otros_det;
	$valor['alm_form_usr_alta'] = $login;
		if($this->mysql->insert('alm_form_importacion', $valor)){
			$json_data['completo'] = true;
			$json_data['tipo_formulario']=7;
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
	public function darBajaCertificadoBancario($id_certificado, $codigo_proyecto, $login){
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
		$json_data['tipo_formulario']=6;
		$json_data['codigo_proyecto']=$codigo_proyecto;
	}else{
		$json_data['completo'] = false;
		}
	print(json_encode($json_data));
	}

	
	/*
	* Metodo dar de baja de los certificados
	*/
	public function buscatransferencias($cod_proy,$cod_prov){
	 
	 	$query='SELECT alm_prov_id FROM alm_form_importacion WHERE alm_proy_cod="'.$cod_proy.'" AND alm_prov_id="'.$cod_prov.'"';
	 return $this->mysql->query($query);
	}
	
	
	
	/*
	* Metodo dar de baja de los confirmaciones
	*/
	public function darBajaConfirmacionBancaria($id_confirmacion, $codigo_proyecto, $login){
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
	if ($this->mysql->update('alm_form_importacion',$value,'alm_form_id='.$id_confirmacion.'')) {
		$json_data['completo'] = true;
		$json_data['tipo_formulario']=7;
		$json_data['codigo_proyecto']=$codigo_proyecto;
	}else{
		$json_data['completo'] = false;
		}
	print(json_encode($json_data));
	}


	
	 
	
}