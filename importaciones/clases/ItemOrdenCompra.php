<?php
require_once '../lib/Mysql.php';
require_once 'Utilitarios.php';
require_once 'OrdenCompra.php';
/**
 * Esta es la clase de los items de la orden de compra
 * @author Daniel Fernandez
 * @date   25/05/2013
 */
class ItemOrdenCompra{
	// Esta es la variable mysql
	private $mysql;
	/*
	 * Este es el constructor de la clase ItemOrdenCompra
	 */
	public function __construct() {
		// Constructor
		$this->mysql = new Mysql();
	}
	/**
	 * Metodo que permite mostrar el formulario de nuevo item orden de compra
	 */
	public function formularioNuevoItemOrdenCompra(){
		$template = file_get_contents('tpl/orden_compra_nuevo_item_tpl.html');
		$list_unidades_item_prod = $this->mysql->query('SELECT GRAL_PAR_PRO_GRP, 
															   GRAL_PAR_PRO_COD, 
															   GRAL_PAR_PRO_SIGLA, 
															   GRAL_PAR_PRO_DESC
														FROM gral_param_propios 
														WHERE GRAL_PAR_PRO_GRP=1100 AND (GRAL_PAR_PRO_COD = 1 OR GRAL_PAR_PRO_COD = 9) ');
		$tipos_unidades_item = '<select name="unidad_tipo_item" id="unidad_tipo_item">';
		foreach($list_unidades_item_prod as $key => $unidad){
			$tipos_unidades_item = $tipos_unidades_item.'<option value="'.$unidad['gral_param_propios']['GRAL_PAR_PRO_COD'].'">'.
						  $unidad['gral_param_propios']['GRAL_PAR_PRO_DESC'].'</option>';
		}
		$tipos_unidades_item = $tipos_unidades_item.'</select >';
		$template = str_replace('{unidad_item_producto}', $tipos_unidades_item, $template);
		$list_tipo_item_prod = $this->mysql->query('SELECT GRAL_PAR_PRO_COD, GRAL_PAR_PRO_DESC 
													FROM gral_param_propios 
													WHERE GRAL_PAR_PRO_GRP=1000 AND GRAL_PAR_PRO_COD <> 0 
      													  AND ISNULL(GRAL_PAR_PRO_USR_BAJA)');
		$tipos_item_prod = '<select name="tipo_item_prod_nuevo" id="tipo_item_prod_nuevo">';
		foreach ($list_tipo_item_prod as $key => $tipo) {
			$tipos_item_prod = $tipos_item_prod.'<option value="'.$tipo['gral_param_propios']['GRAL_PAR_PRO_COD'].'">'.
						           $tipo['gral_param_propios']['GRAL_PAR_PRO_DESC'].'</option>';
		}
		$tipos_item_prod = $tipos_item_prod.'</select>';
		$template = str_replace('{product_type}', $tipos_item_prod, $template);
	    print($template);
	}
	/**
	 * Metodo que permite grabar el nuevo item
	 *                                    $nro_referencia,
	 *									  $codigo_proyecto_item,
	 *									  $codigo_proforma,
	 *									  $part_number_item,
	 *									  $description_item,
	 *									  $qty_nuevo_item,
	 *									  $unidad_tipo_item,
	 *									  $precio_unitario,
	 *									  $log  
	 */
	public function grabarNuevoItemCompra($nro_referencia,
										  $codigo_proyecto_item,
										  $codigo_unico_proyecto,
										  $codigo_proforma,
										  $part_number_item,
										  $description_item,
										  $qty_nuevo_item,
										  $unidad_tipo_item,
										  $precio_unitario,
										  $serial_number_val,
										  $tipo_item_prod_nuevo,
										  $log){
		$util = new Utilitarios();
		$orden_compra = new OrdenCompra();
		$moneda = $orden_compra->getMonedaOrdenCompra($codigo_unico_proyecto);
		$numero_unico = $util->generaNumeroOrdenUnico();
		$value['alm_nro_orden_compra'] = $nro_referencia;
		$value['alm_id_unico_item_ord_compra'] = $numero_unico;
		$value['alm_id_codigo_unico_proy'] = $codigo_unico_proyecto;
		$value['alm_cod_proyecto'] = $codigo_proyecto_item;
		$value['alm_nro_proforma'] = $codigo_proforma;
		$value['alm_nro_parte_ord_compra'] = $part_number_item;
		$value['alm_descripcion'] = strtoupper($description_item);
		$value['alm_cantidad_ord'] = $qty_nuevo_item;
		$value['alm_unidad_um'] = $unidad_tipo_item;
		$value['alm_precio_unitario'] = $precio_unitario;
		$value['alm_precio_moneda'] = $moneda[0]['alm_ord_compra_cab']['alm_ord_compra_moneda'];
		$value['alm_item_ord_serial'] = $serial_number_val;
		$value['alm_item_ord_tipo'] = $tipo_item_prod_nuevo;
		$value['alm_item_ord_usr_alta'] = $log;
		return $this->mysql->insert('alm_ord_compra_det', $value);
	}
	/**
	 * Metodo que permite listar los items por cad orden de compra
	 */
	public function listaItemsOrdenCompra($nro_ref, $codigo_proyecto, $codigo_proforma, $codigo_unico_proyecto){
		$query = 'SELECT alm_id_ord_compra_det,alm_id_unico_item_ord_compra,alm_id_codigo_unico_proy,
				         alm_nro_orden_compra,alm_cod_proyecto, alm_nro_proforma , alm_nro_parte_ord_compra,alm_item_ord_serial,
				         alm_descripcion,alm_cantidad_ord, alm_unidad_um, alm_precio_unitario,  GRAL_PAR_PRO_SIGLA,
				         (CASE alm_precio_moneda WHEN 1 THEN "BS"  WHEN 2 THEN "USD" WHEN 3 THEN "EUR" END) AS alm_precio_moneda 
					FROM alm_ord_compra_det INNER JOIN gral_param_propios
					WHERE alm_nro_orden_compra= "'.$nro_ref.'" AND alm_cod_proyecto="'.$codigo_proyecto.'" 
					          AND alm_nro_proforma="'.$codigo_proforma.'" AND alm_id_codigo_unico_proy="'.$codigo_unico_proyecto.'" 
					          AND GRAL_PAR_PRO_GRP = 1100 AND alm_unidad_um = GRAL_PAR_PRO_COD 
					          AND ISNULL(alm_item_ord_usr_baja)';
		return $this->mysql->query($query);
	}

	/**
	 * Metodo que permite eliminar el item de la orden de compra
	 */
	public function eliminarItemOrdenCompra($codigo_unico_item, $login){
		date_default_timezone_set('America/La_Paz');
		$fecha_actual  = date("y-m-d H:i:s");
		$res = false;
		$values['alm_item_ord_usr_baja'] = $login;
		$values['alm_item_ord_fch_hr_baja'] = $fecha_actual;
		$condicion = 'alm_id_unico_item_ord_compra="'.$codigo_unico_item.'"';
		//print_r($condicion);
		if($this->mysql->update('alm_ord_compra_det', $values, $condicion)){
			$res = true;
		}
		return $res;
	}
	/**
	 * Metodo que obtiene los totales de la orden de compra
	 */
	public function obtenerTotalesOrdenCompra($codigo_unico_orden){
		return $this->mysql->query('SELECT (CASE WHEN (alm_tot_descuento IS NULL) THEN "0" ELSE alm_tot_descuento END) AS alm_tot_descuento, 
			 						       (CASE WHEN (alm_tot_asegurado IS NULL) THEN "0" ELSE alm_tot_asegurado END) AS alm_tot_asegurado,  
       									   (CASE WHEN (alm_tot_transporte IS NULL) THEN "0" ELSE alm_tot_transporte END) AS alm_tot_transporte, 
       								       (CASE WHEN (alm_tot_otros IS NULL) THEN "0" ELSE alm_tot_otros END) AS alm_tot_otros
									FROM alm_ord_compra_cab
									WHERE alm_id_unico_orden_compra = "'.$codigo_unico_orden.'" AND ISNULL(alm_ord_compra_usr_baja)');
	}

}
?>