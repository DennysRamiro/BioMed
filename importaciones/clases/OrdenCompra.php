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
class OrdenCompra{
	// Esta es la variable mysql
	private $mysql;
	/*
	 * Este es el constructor de la clase contrato 
	 */
	public function __construct() {
		// Constructor
		$this->mysql = new Mysql();
	}

	/*
	* Metodo que crear el formulario de la nueva Proforma 
	*/
	public function formularioNuevaOrdenCompra(){
		$template = file_get_contents('tpl/orden_compra_form_tpl.html');
		$proveedor = new Proveedor();
		$lista_proveedores = $proveedor->listaProveedores();
		$list_proveedores = '<select name="camp_002_codigo_proveedor" id="camp_002_codigo_proveedor">';
		foreach ($lista_proveedores as $key => $value) {
			$list_proveedores = $list_proveedores.'<option value="'.$value['alm_proveedor']['alm_prov_codigo_int'].'">'.
						  $value['alm_proveedor']['alm_prov_nombre'].'</option>';
		}
		$list_proveedores = $list_proveedores.'</select >';
		$template = str_replace('{lista_proveedor}',$list_proveedores, $template);
		$lista_formas_pago = $this->listaFormasPago();
		$formas_pago='<select name="camp_003_codigo_termino_pago" id="camp_003_codigo_termino_pago">';
		foreach($lista_formas_pago as $ke => $formas){
			$formas_pago = $formas_pago.'<option value="'.$formas['gral_param_propios']['GRAL_PAR_PRO_COD'].'">'.
						                                            $formas['gral_param_propios']['GRAL_PAR_PRO_DESC'].'</option>';
		}
		$formas_pago = $formas_pago.'</select >';
		$template = str_replace('{terminos_pago}',$formas_pago, $template);
		$lista_terminos_orden = $this->listaTerminiosOrden();
		$lista_term = '<select name="camp_004_codigo_terminos_pago" id="camp_004_codigo_terminos_pago">';
		foreach($lista_terminos_orden as $key => $term){
			$lista_term = $lista_term.'<option value="'.$term['gral_param_propios']['GRAL_PAR_PRO_COD'].'">'.
						                                            $term['gral_param_propios']['GRAL_PAR_PRO_DESC'].'</option>';
		}
		$lista_term = $lista_term.'</select>';
		$template = str_replace('{terminos_orden}',$lista_term, $template);

		$monedas = $this->listaMonedasOrdenCompra();
		$lista_monedas = '<select id="moneda_orden_compra_001">';
		foreach ($monedas as $k1 => $mon) {
			$lista_monedas = $lista_monedas.'<option value="'.$mon['gral_param_super_int']['GRAL_PAR_INT_COD'].'">'.
						                                            $mon['gral_param_super_int']['GRAL_PAR_INT_DESC'].'</option>'; 
		}
		$lista_monedas = $lista_monedas.'</select>';
		$template = str_replace('{moneda_orden_compra}',$lista_monedas, $template);
	    print($template);
		
	}
	/**
	 * Este es el metodo que devuelve la lista de los teminos de orden
	 */
	 public function listaTerminiosOrden(){
		return $this->mysql->query('SELECT GRAL_PAR_PRO_COD, GRAL_PAR_PRO_DESC, GRAL_PAR_PRO_ID
									FROM gral_param_propios 
									WHERE GRAL_PAR_PRO_GRP=1900 AND GRAL_PAR_PRO_COD <> 0');	 
	 }
	/**
	 *  Esta es la funcion que devuelve la lista de formas de pagi
	 */
	 public function listaFormasPago(){
		 $query = 'SELECT GRAL_PAR_PRO_COD, GRAL_PAR_PRO_DESC
		 		   FROM gral_param_propios 
				   WHERE GRAL_PAR_PRO_GRP=1800 AND GRAL_PAR_PRO_COD <> 0';
		 return $this->mysql->query($query);
	 }

	 /*
	 * Metodo para lista las ordenes de compras
	 */

	 public function listaOrdenCompra(){
	 	$query='SELECT alm_id_orden_compra, alm_nro_referencia_orden, alm_nro_proforma,alm_fecha_proforma,alm_fecha_orden_registro, alm_termino_pago, alm_terms, pr.alm_prov_nombre
                FROM alm_ord_compra_cab ord INNER JOIN alm_proveedor pr ON ord.alm_prov_id=pr.alm_prov_id 
                WHERE ISNULL(alm_ord_compra_usr_baja)';

        return $this->mysql->query($query);
	 }
	/*
	* Metodo que crear la lista de las proformas
	*/
	public function formularioListaOrdenCompra(){
		$template = file_get_contents('tpl/lista_orden_compra_tpl.html');
	    print($template);
		
	}
	
	
	/**
	 * Metodo que actualiza el estado del proyecto en la base de datos
	 * @param $proy
	 */
	public function actualizaPrpyecto($proy){
	  $value['alm_proy_estado'] = $id_usuario_baja;
	  if($this->mysql->update('alm_proyecto', $value,'alm_proy_cod='.$proy)){
		 return true; 
	  }else{
		 return false;
	  }

	}
	
	/**
	 * Metodo que graba los datos de la Proforma en la base de datos
	 * @param $nro_doc_cont, $tipo_proyecto,$fec_doc_cont,$obs_cont, $login
	 */
	 public function grabarNuevaCabeceraOrdenCompraDescuento($codigo_proyecto,$num_orden_compra_ref, $codigo_proveedor,$nro_doc_proforma,$fec_doc_proforma, $fec_orden_cabecera, $fecha_entrega_orden, $formas_pago, $metodo_envio, $broker_orden, $terminos_orden, $obs_orden_compra,$moneda_orden_compra,	
	 														   $descuento_orden_compra, $seguro_orden_compra, $flete_aereo_orden_compra,/*$otro_gastos_orden_compra, */$login){
		$util = new Utilitarios();
		$numero_unico = $util->generaNumeroOrdenUnico();
		$valor['alm_id_orden_compra'] = NULL;
		$valor['alm_id_orden_compra'] = 'NULL';
		$valor['alm_id_unico_orden_compra'] = $numero_unico;
		$valor['alm_nro_referencia_orden'] = $num_orden_compra_ref;
		$valor['alm_prov_codigo'] =$codigo_proveedor;
		$valor['alm_proy_cod'] = $codigo_proyecto;
		$valor['alm_nro_proforma'] = strtoupper($nro_doc_proforma);
		$valor['alm_fecha_proforma'] = $util->cambiaf_a_mysql($fec_doc_proforma);
		$valor['alm_fecha_orden_registro'] = $util->cambiaf_a_mysql($fec_orden_cabecera);
		$valor['alm_fecha_entrega'] = $util->cambiaf_a_mysql($fecha_entrega_orden);
		$valor['alm_termino_pago'] = $formas_pago;
		$valor['alm_ship_via'] = strtoupper($metodo_envio);
		$valor['alm_broker'] = strtoupper($broker_orden);
		$valor['alm_terms'] = $terminos_orden;
		$valor['alm_ord_compra_moneda'] = $moneda_orden_compra;
		$valor['alm_tot_descuento'] = $descuento_orden_compra;
		$valor['alm_tot_asegurado'] = $seguro_orden_compra;
		$valor['alm_tot_transporte'] = $flete_aereo_orden_compra;
		//$valor['alm_tot_otros'] = $otro_gastos_orden_compra;
		$valor['alm_ord_compra_usr_alta'] = $login;
		if($this->mysql->insert('alm_ord_compra_cab', $valor)){
			$json_data['completo'] = true;
			$json_data['codigo_proyecto'] = $codigo_proyecto;
		}else{
			$json_data['completo'] = false;
		}
		print(json_encode($json_data));
	 }
	 /**
	  * Esta es la cabecera con orden de descuento
	  */
	 public function grabarNuevaCabeceraOrdenCompra($codigo_proyecto,$num_orden_compra_ref, $codigo_proveedor,$nro_doc_proforma,$fec_doc_proforma, $fec_orden_cabecera, $fecha_entrega_orden, $formas_pago, $metodo_envio, $broker_orden, $terminos_orden, $obs_orden_compra,$moneda_orden_compra, $login){
		$util = new Utilitarios();
		$num_aleratorio = $util->generaNumeroOrdenUnico();
		$valor['alm_id_orden_compra'] = 'NULL';
		$valor['alm_id_unico_orden_compra'] = $num_aleratorio;
		$valor['alm_nro_referencia_orden'] = $num_orden_compra_ref;
		$valor['alm_prov_codigo'] =$codigo_proveedor;
		$valor['alm_proy_cod'] = $codigo_proyecto;
		$valor['alm_nro_proforma'] = strtoupper($nro_doc_proforma);
		$valor['alm_fecha_proforma'] = $util->cambiaf_a_mysql($fec_doc_proforma);
		$valor['alm_fecha_orden_registro'] = $util->cambiaf_a_mysql($fec_orden_cabecera);
		$valor['alm_fecha_entrega'] = $util->cambiaf_a_mysql($fecha_entrega_orden);
		$valor['alm_termino_pago'] = $formas_pago;
		$valor['alm_ship_via'] = strtoupper($metodo_envio);
		$valor['alm_broker'] = strtoupper($broker_orden);
		$valor['alm_terms'] = $terminos_orden;
		$valor['alm_ord_compra_moneda'] = $moneda_orden_compra;
		$valor['alm_ord_compra_usr_alta'] = $login;
		if($this->mysql->insert('alm_ord_compra_cab', $valor)){
			$json_data['completo'] = true;
			$json_data['codigo_proyecto'] = $codigo_proyecto;
		}else{
			$json_data['completo'] = false;
		}
		print(json_encode($json_data));
	 }
	 /**
	  * Metodo que permite listar las ordenes de compra 
	  */
	 public function listarOrdenesCompra($codigo_proyecto){
	 	$query = 'SELECT alm_id_orden_compra,alm_id_unico_orden_compra, alm_nro_referencia_orden, alm_fecha_orden_registro, 
	 	                 alm_nro_proforma, alm_fecha_proforma, alm_prov_codigo
				  FROM alm_ord_compra_cab
				  WHERE alm_proy_cod="'.$codigo_proyecto.'" AND  ISNULL(alm_ord_compra_usr_baja)';
		return $this->mysql->query($query);
	 }

	 /**
	  * Metodo que permite listar las ordenes de cada proyecto
	  */
	 public function listarOrdenesCompraInicial($codigo_proyecto){
	 	$query = 'SELECT alm_id_orden_compra,alm_id_unico_orden_compra, alm_nro_referencia_orden, alm_fecha_orden_registro, 
	 	                 alm_nro_proforma, alm_fecha_proforma, alm_prov_codigo
				  FROM alm_ord_compra_cab
				  WHERE alm_proy_cod="'.$codigo_proyecto.'" AND  ISNULL(alm_ord_compra_usr_baja)';
		return $this->mysql->query($query);	
	 }
	 
	 /**
	  * Metodo que permite detallar el orden el orden de compra
	  */
	 public function detallarOrdenCompra(){
		$template = file_get_contents('tpl/orden_compra_detalle_form_tpl.html');
	    print($template);
		
	 }
	/**
	 * Metodo que permite obtener los datos de la cabecera
	 * @param $id_orden que es el id de la orden de compra
	 */
	 public function obtenerCabeceraOrdenDetalle($id_orden){
		return $this->mysql->query('SELECT *					 
									FROM alm_ord_compra_cab
									WHERE alm_id_orden_compra = '.$id_orden.' AND ISNULL(alm_ord_compra_usr_baja)');
	 }
	/**
	 * Este es el metodo que permite devolver los datos de los terminos de pago
	 */
	public function obtenerTerminosPago($id_termino){
		$query = 'SELECT GRAL_PAR_PRO_ID, GRAL_PAR_PRO_DESC 
									FROM gral_param_propios 
									WHERE GRAL_PAR_PRO_GRP=1800 AND GRAL_PAR_PRO_COD <> 0 AND GRAL_PAR_PRO_COD='.$id_termino;
		return $this->mysql->query($query);
	}

	/**
	 * Metodo que devuelve el metodo de envio
	 */
	public function obtenerTerminoEnvio($id_term_envio){
		$query = 'SELECT GRAL_PAR_PRO_ID, GRAL_PAR_PRO_DESC 
				  FROM  gral_param_propios 
				  WHERE GRAL_PAR_PRO_GRP=1900 AND GRAL_PAR_PRO_COD <> 0 AND GRAL_PAR_PRO_COD='.$id_term_envio;
		return $this->mysql->query($query);

	}
	/**
	 * Metodo que permite devolver a los datos de referencia
	 */
	public function seleccionarContactos(){
		$query = 'SELECT gral_empresa_ref_nombre, gral_empresa_ref_dir, gral_empresa_ref_telf, gral_empresa_ref_fax, gral_empresa_ref_email, gral_empresa_ref_tipo, 
			 			 gral_empresa_ref_ciu_pais, gral_empresa_ref_pais
				  FROM gral_empresa_ref';
		return $this->mysql->query($query);
	}
	 	 
	 /**
	 * Metodo que permite obtener la suma total de los productos por proyecto y proveedor
	 * @param $id_orden 
	 */
	public function obtenerTotalOrdenes($id_orden,$id_orden){
		return $this->mysql->query('SELECT SUM(alm_gran_total)
									FROM alm_ord_compra_cab
									WHERE alm_proy_cod = '.$id_orden.' and alm_prov_id='.$id_orden.'');
	}
	/**
	 * Metodo que permite seleccionar la proforma el proveedor y la fecha de la proforma
	 * @param  $codigo_proyecto
	 */
	public function seleccionarProveedorProforma($codigo_proyecto){
		return $this->mysql->query('SELECT ');
	}

	/**
	 * Metodo que permite listar las monedas de orden de Compra
	 */
	public function listaMonedasOrdenCompra(){
		return $this->mysql->query('SELECT GRAL_PAR_INT_GRP,GRAL_PAR_INT_COD,GRAL_PAR_INT_SIGLA,GRAL_PAR_INT_DESC
									FROM gral_param_super_int 
									WHERE GRAL_PAR_INT_GRP=18 AND ISNULL(GRAL_PAR_INT_USR_BAJA) AND GRAL_PAR_INT_COD <> 0 AND GRAL_PAR_INT_COD <> 1');
	}
	/**
	 * Metodo que permite eliminar la orden de compra
	 */
	public function eliminarOrdenCompra($codigo_unico_proyecto, $login){
		date_default_timezone_set('America/La_Paz');
		$fecha_actual  = date("y-m-d H:i:s");
		$res = false;
		$items = $this->mysql->query('SELECT * FROM alm_ord_compra_det WHERE alm_id_codigo_unico_proy="'.$codigo_unico_proyecto.'"');
		if(!empty($items)){
			foreach ($items as $key => $value) {
				$values['alm_item_ord_usr_baja'] = $login;
				$values['alm_item_ord_fch_hr_baja'] = $fecha_actual;
				$condicion = 'alm_id_unico_item_ord_compra="'.$value['alm_ord_compra_det']['alm_id_unico_item_ord_compra'].'"';
				$this->mysql->update('alm_ord_compra_det',$values, $condicion);	
			}
		}
		$valores['alm_ord_compra_usr_baja'] = $login;
		$valores['alm_ord_compra_fch_hr_baja'] = $fecha_actual;
		$condiciones = 'alm_id_unico_orden_compra="'.$codigo_unico_proyecto.'"';
		if($this->mysql->update('alm_ord_compra_cab', $valores, $condiciones)){
			$res = true;
		}
		return $res; 
	}

		 /*
	 * Metodo para lista las ordenes de compras ojo borrar
	 */

	 public function listaOrdenHoja($codigo_proyecto){
		
		
	 	$query='SELECT c.alm_nro_referencia_orden,c.alm_prov_codigo,p.alm_prov_nombre 
	 	        FROM alm_ord_compra_cab c INNER JOIN alm_proveedor p ON c.alm_prov_codigo=p.alm_prov_codigo_int
                WHERE alm_proy_cod="'.$codigo_proyecto.'" AND ISNULL(c.alm_ord_compra_usr_baja) AND ISNULL(p.alm_prov_usr_baja)  GROUP BY c.alm_prov_codigo';
		//print_r($query);
       return $this->mysql->query($query);
		
	 }

	 /*
	 * Metodo para lista el detalle de las ordenes que se crearon para poder modificar o dar de baja
	 */
	 public function listaDetallarOrdenHoja($codigo_proyecto){
		 $query='
					 SELECT c.alm_nro_referencia_orden,c.alm_prov_codigo,p.alm_prov_nombre,
							age.alm_age_adu_tra_cod
					FROM alm_ord_compra_cab c 
						 INNER JOIN alm_proveedor p ON c.alm_prov_codigo=p.alm_prov_codigo_int
						 INNER JOIN alm_age_adu_tra age ON age.alm_age_adu_tra_cod_proy= c.alm_proy_cod
					 WHERE c.alm_proy_cod="'.$codigo_proyecto.'" AND ISNULL(age.alm_age_adu_tra_usr_baja)
					 GROUP BY c.alm_nro_referencia_orden
			 ';
			 
			 return $this->mysql->query($query);
	
	}

		 /*
	 * Metodo para lista el detalle de las ordenes que se crearon para poder modificar o dar de baja
	 */
	 public function listaDetallarOrdenHoja2($codigo_proyecto,$cod_prov){
		 $query='SELECT c.alm_nro_referencia_orden,c.alm_prov_codigo,p.alm_prov_nombre,
							age.alm_age_adu_tra_cod
				 FROM alm_ord_compra_cab c 
				 INNER JOIN alm_proveedor p ON c.alm_prov_codigo=p.alm_prov_codigo_int
				 INNER JOIN alm_age_adu_tra age ON age.alm_age_adu_tra_cod_proy= c.alm_proy_cod
				 WHERE c.alm_proy_cod="'.$codigo_proyecto.'" AND age.alm_age_adu_tra_cod_prov="'.$cod_prov.'" AND c.alm_prov_codigo="'.$cod_prov.'" AND ISNULL(age.alm_age_adu_tra_usr_baja)
				 GROUP BY c.alm_nro_referencia_orden';
			 
			 return $this->mysql->query($query);
	
	}

	 	 /*
	 * Metodo para lista las ordenes de compras ojo borrar
	 */

	 public function listaOrdenHoja2($codigo_proyecto, $codigo_prov){
	 	$query='SELECT * FROM alm_ord_compra_cab c INNER JOIN  alm_ord_compra_det d ON c.alm_id_unico_orden_compra=d.alm_id_unico_item_ord_compra
				WHERE c.alm_proy_cod="'.$codigo_proyecto.'" AND c.alm_prov_codigo="'.$codigo_prov.'"';

        return $this->mysql->query($query);
	 }


	/**
	 * Este metodo es el que procesa la orden de compra
	 */
	public function procesarOrdenCompra($codigo_proyecto, $log){
		$res = false;
		$ordene_compra = $this->mysql->query('SELECT * FROM alm_ord_compra_cab WHERE alm_proy_cod="'.$codigo_proyecto.'" AND ISNULL(alm_ord_compra_usr_baja)');
		//print_r($ordene_compra);
		if(!empty($ordene_compra)){
			$proy = $this->mysql->query("SELECT * FROM alm_proyecto WHERE alm_proy_cod='".$codigo_proyecto."' AND ISNULL(alm_proy_usr_baja)");
			$valores['alm_proy_cod'] = $proy[0]['alm_proyecto']['alm_proy_cod'];
			$valores['alm_proy_nom'] = $proy[0]['alm_proyecto']['alm_proy_nom'];
			$valores['alm_proy_fecha_inicio'] = $proy[0]['alm_proyecto']['alm_proy_fecha_inicio'];
			$valores['alm_proy_fecha_fin'] = $proy[0]['alm_proyecto']['alm_proy_fecha_fin'];
			$valores['alm_proy_tipo'] = $proy[0]['alm_proyecto']['alm_proy_tipo'];
			$valores['alm_proy_estado'] = '4';
			$valores['alm_proy_usr_alta'] = $log;
			date_default_timezone_set('America/La_Paz');
			$fecha_actual  = date("y-m-d H:i:s");
			$fecha_registro = date("y-m-d");
			$val['alm_proy_usr_baja'] = $log;
			$val['alm_proy_fch_hr_baja'] = $fecha_actual;
			$condicion = 'alm_proy_cod="'.$codigo_proyecto.'"';
			$this->mysql->update('alm_proyecto', $val, $condicion);
			$valores_imp['alm_form_tipo'] = '4';
			$valores_imp['alm_form_nro_doc'] = 'Orden';
			$valores_imp['alm_form_fecha_doc'] = $proy[0]['alm_proyecto']['alm_proy_fecha_inicio'];
			$valores_imp['alm_prov_id'] = NULL;
			$valores_imp['alm_proy_cod'] = $proy[0]['alm_proyecto']['alm_proy_cod'];
			$valores_imp['alm_form_fecha_registro'] = $fecha_registro;
			$valores_imp['alm_form_observaciones'] = $proy[0]['alm_proyecto']['alm_proy_descripcion'];
			$valores_imp['alm_form_usr_alta'] = $log;
			$this->mysql->insert('alm_form_importacion', $valores_imp);
			if($this->mysql->insert('alm_proyecto', $valores)){
				$res = true;
			}
		}else{
			$res = false;
		}
		return $res;
	}
	
	
	 /**
	  *  Metodo que permite imprimir el dialogo de los mensajes en el html
	  *
	  */
	 public function dialogoMensaje(){
	 	$template = file_get_contents('tpl/dialogo_msg_tpl.html');
	 	print($template);
	 }
	
	/**
	  *  Metodo que dara de baja a los items de los detalles
	  *  $codigo_proy codigo de proyecto para la seleccion
	  */
	 public function procesarBajaDetalleOrdenCompra($codigo_proy){
	 	//print_r($codigo_proy);
		
			$query='SELECT * 
					FROM alm_ord_compra_cab
					WHERE alm_proy_cod="'.$codigo_proy.'" AND ISNULL(alm_ord_compra_usr_baja)';
					$cabecera = $this->mysql->query($query);
					if (empty($cabecera)){
						//print_r("Vacio cabecera");
						$value['alm_proy_usr_baja'] = $_SESSION['login'];
						if($this->mysql->update('alm_proyecto', $value,'alm_proy_cod="'.$codigo_proy.'"')){ 
							 print_r("positivo"); 
						  }else{
							 print_r("negativo");
						  }		
					}else{
						  $query='SELECT cd.alm_id_codigo_unico_proy
								  FROM alm_ord_compra_det cd INNER JOIN alm_ord_compra_cab c ON cd.alm_id_codigo_unico_proy=c.alm_id_unico_orden_compra
								  WHERE cd.alm_cod_proyecto="'.$codigo_proy.'" AND ISNULL(cd.alm_item_ord_usr_baja)
								  ';
								$detalle = $this->mysql->query($query);
								foreach ($cabecera as $key => $value) {
									if (empty($detalle)){
										 //print_r("Vacio detalle ".$codigo_proy);
										 $value['alm_ord_compra_usr_baja'] = $_SESSION['login'];
										 $this->mysql->update('alm_ord_compra_cab', $value,'alm_proy_cod="'.$codigo_proy.'" ');
									}else{
										 $cont = 0;
										 
												$data['alm_id_codigo_unico_proy'] = $value['cd']['alm_id_codigo_unico_proy'];
												$value['alm_item_ord_usr_baja'] = $_SESSION['login'];
												$this->mysql->update('alm_ord_compra_det', $value,'alm_cod_proyecto="'.$codigo_proy.'" ');
												$this->mysql->update('alm_ord_compra_cab', $value,'alm_proy_cod="'.$codigo_proy.'" ');
												$this->mysql->update('alm_proyecto', $value,'alm_proy_cod="'.$codigo_proy.'" '); 
										 }
									}
				     }
	 }
	 public function actualizarOrdenTotalFinal($total_final, $id_unico_orden){
	 	//echo $id_unico_orden;
	 	$valores['alm_gran_total'] = $total_final;
	 	$condicion = 'alm_id_unico_orden_compra="'.$id_unico_orden.'"';
	 	$this->mysql->update('alm_ord_compra_cab', $valores, $condicion);

	 }
	 
	 /**
	  * Metodo que devuelve la moneda del orden de compra
	  */
	 public function getMonedaOrdenCompra($codigo_orden_compra){
		 $query = "SELECT alm_ord_compra_moneda FROM alm_ord_compra_cab WHERE alm_id_unico_orden_compra='".$codigo_orden_compra."'";
		 return $this->mysql->query($query);
	 }
	 
	 /**
	  *  Metodo que dara de baja a los items de la cabecea
	  *  $codigo_proy codigo de proyecto para la seleccion
	  */
	 /* public function procesarBajaCabeceraOrdenCompra($codigo_proy){
	  	$query='SELECT * 
				FROM alm_ord_compra_cab
				WHERE alm_proy_cod="'.$codigo_proy.'" AND ISNULL(alm_ord_compra_usr_baja)';
		
		$cabecera = $this->mysql->query($query);
				if (empty($cabecera)){
					//print_r("Vacio cabecera");
					$this->bajaProyecto($codigo_proy);
				}else{
					//print_r("cabecera");
					//print_r($cabecera);
					$this->bajaProyecto($codigo_proy);
				}
	  }
	  */
	  /**
	 * Metodo que nos sirve para dar de baja el proyecto
	 * @param $estado 
	 */
	/* public function bajaProyecto($cod_proy){
		//print_r("PROYECYO ".$cod_proy);
		$value['alm_proy_usr_baja'] = $_SESSION['login'];
		  //print_r($value);
		 if($this->mysql->update('alm_proyecto', $value,'alm_proy_cod="'.$cod_proy.'"')){
			 return true; 
		  }else{
			 return false;
		  }
		  
	 }	*/

}
?>