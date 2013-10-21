<?php
session_start();
require_once '../clases/OrdenCompra.php';
require_once '../clases/Proveedor.php';
require_once '../clases/Utilitarios.php';
/**
 * Esta clase gestiona las acciones de la proforma
 */
class OrdenCompraRouter{
	/**
	 * Metodo que realiza el ejecutar la accion 
	 * @param $action esta es la accion
	 */
	public function ejecutarAccion($accion){
		$orden_compra = new OrdenCompra(); 
		switch($accion){
			case 'actualizarOrdenTotalFinal':
				$orden_compra->actualizarOrdenTotalFinal($_POST['total_final'], $_POST['orden_unico_compra']);
				break;
			case 'grabarNuevaCabeceraOrdenCompra': // Esto esto es la accion para grabar la proforma
				$orden_compra->grabarNuevaCabeceraOrdenCompra($_POST['codigo_proyecto'],
				 	                                           $_POST['num_orden_compra_ref'],
				 	                                           $_POST['codigo_proveedor'],
				 	                                           $_POST['nro_doc_proforma'],
				 	                                           $_POST['fec_doc_proforma'], 
				 	                                           $_POST['fec_orden_cabecera'], 
				 	                                           $_POST['fecha_entrega_orden_compra'], 
				 	                                           $_POST['formas_pago'], 
				 	                                           $_POST['metodo_envio_orden_compra'], 
				 	                                           $_POST['broker_orden'], 
				 	                                           $_POST['terminos_orden'], 
				 	                                           $_POST['obs_orden_compra'],
				 	                                           $_POST['moneda_orden_compra'], 
				 	                                           $_SESSION['login']);
				
				break;
			case 'grabarNuevaCabeceraOrdenCompraDescuento':
				$orden_compra->grabarNuevaCabeceraOrdenCompraDescuento($_POST['codigo_proyecto'],
				 	                                           $_POST['num_orden_compra_ref'],
				 	                                           $_POST['codigo_proveedor'],
				 	                                           $_POST['nro_doc_proforma'],
				 	                                           $_POST['fec_doc_proforma'], 
				 	                                           $_POST['fec_orden_cabecera'], 
				 	                                           $_POST['fecha_entrega_orden_compra'], 
				 	                                           $_POST['formas_pago'], 
				 	                                           $_POST['metodo_envio_orden_compra'], 
				 	                                           $_POST['broker_orden'], 
				 	                                           $_POST['terminos_orden'], 
				 	                                           $_POST['obs_orden_compra'],
				 	                                           $_POST['moneda_orden_compra'],
				 	                                           $_POST['descuento_orden_compra'],
				 	                                           $_POST['seguro_orden_compra'],
				 	                                           $_POST['flete_aereo_orden_compra'],
				 	                                         //  $_POST['otro_gastos_orden_compra'], 
				 	                                           $_SESSION['login']);
				break;
			case 'listarOrdenesCompra': // Esto es la accion para listar las ordenes de compra
				 $proveedor = new Proveedor();
				 $utilitarios = new Utilitarios();
			     $ordenes_compra = $orden_compra->listarOrdenesCompra($_GET['codigo_proyecto']);
			     //print_r($ordenes_compra);
			     if(empty($ordenes_compra)){
			     	$data['id_orden_compra'] = 0;
                    $data['id_unico_orden_compra'] = '';
			     	$data['nro_ref_orden'] = '';
			     	$data['fecha_orden_registro'] = '';
			     	$data['nro_proforma'] = '';
			     	$data['fecha_proforma'] = '';
			     	$data['nombre_proveedor'] = '';
			     	$json_dat[0] = $data;
			     	print_r(json_encode($json_dat));
			     }else{
			     		$cont = 0;
			     		foreach($ordenes_compra as $key => $orden){
							 $json_data['id_orden_compra'] = $orden['alm_ord_compra_cab']['alm_id_orden_compra'];
							 $json_data['id_unico_orden_compra'] = $orden['alm_ord_compra_cab']['alm_id_unico_orden_compra'];
							 $json_data['nro_ref_orden'] = $orden['alm_ord_compra_cab']['alm_nro_referencia_orden'];
							 $json_data['fecha_orden_registro'] =$utilitarios->cambiaf_a_normal($orden['alm_ord_compra_cab']['alm_fecha_orden_registro']);
							 $json_data['nro_proforma'] = $orden['alm_ord_compra_cab']['alm_nro_proforma'];
							 $json_data['fecha_proforma'] = $utilitarios->cambiaf_a_normal($orden['alm_ord_compra_cab']['alm_fecha_proforma']);
							 $ord = $proveedor->obtenerDatosProveedor($orden['alm_ord_compra_cab']['alm_prov_codigo']);
							 $json_data['nombre_proveedor'] = $ord[0]['alm_proveedor']['alm_prov_nombre'];
							 $datos[$cont] = $json_data;
							 $cont++;
						 }
						 print(json_encode($datos));
			     }
		         break;
		    case 'listarOrdenesCompraInicial':
		    	  $proveedor = new Proveedor();
				  $utilitarios = new Utilitarios();
			      $ordenes_compra = $orden_compra->listarOrdenesCompraInicial($_GET['codigo_proyecto']);
				     if(empty($ordenes_compra)){
				     	$data['id_orden_compra'] = 0;
				     	$data['id_unico_orden_compra'] = '';
				     	$data['nro_ref_orden'] = '';
				     	$data['fecha_orden_registro'] = '';
				     	$data['nro_proforma'] = '';
				     	$data['fecha_proforma'] = '';
				     	$data['nombre_proveedor'] = '';
				     	$json_dat[0] = $data;
				     	print_r(json_encode($json_dat));
				     }else{
				     		$cont = 0;
				     		foreach($ordenes_compra as $key => $orden){
								 $json_data['id_orden_compra'] = $orden['alm_ord_compra_cab']['alm_id_orden_compra'];
								 $json_data['id_unico_orden_compra'] = $orden['alm_ord_compra_cab']['alm_id_unico_orden_compra'];
								 $json_data['nro_ref_orden'] = $orden['alm_ord_compra_cab']['alm_nro_referencia_orden'];
								 $json_data['fecha_orden_registro'] =$utilitarios->cambiaf_a_normal($orden['alm_ord_compra_cab']['alm_fecha_orden_registro']);
								 $json_data['nro_proforma'] = $orden['alm_ord_compra_cab']['alm_nro_proforma'];
								 $json_data['fecha_proforma'] = $utilitarios->cambiaf_a_normal($orden['alm_ord_compra_cab']['alm_fecha_proforma']);
								 $ord = $proveedor->obtenerDatosProveedor($orden['alm_ord_compra_cab']['alm_prov_codigo']);
								 //print_r($orden['alm_ord_compra_cab']['alm_prov_id']);
								 $json_data['nombre_proveedor'] = $ord[0]['alm_proveedor']['alm_prov_nombre'];
								 $datos[$cont] = $json_data;
								 $cont++;
							 }
							 print(json_encode($datos));
				     }
			    	 break;
			case 'obtenerCabceraOrdenDetalle':
				 $proveedor = new Proveedor();
				 $utilitarios = new Utilitarios();
				 $cabecera_orden = $orden_compra->obtenerCabeceraOrdenDetalle($_GET['id_orden']);
				 $json_data['nro_orden_ref'] = $cabecera_orden[0]['alm_ord_compra_cab']['alm_nro_referencia_orden'];
				 $json_data['codigo_proy'] = $cabecera_orden[0]['alm_ord_compra_cab']['alm_proy_cod'];
				 $datos_prove = $proveedor->obtenerDatosProveedor($cabecera_orden[0]['alm_ord_compra_cab']['alm_prov_codigo']);
				 $json_data['nombre_proveedor'] = $datos_prove[0]['alm_proveedor']['alm_prov_nombre'];
				 $json_data['nro_proforma'] = $cabecera_orden[0]['alm_ord_compra_cab']['alm_nro_proforma'];
				 $json_data['fecha_proforma'] = $utilitarios->cambiaf_a_normal($cabecera_orden[0]['alm_ord_compra_cab']['alm_fecha_proforma']);
				 $json_data['fecha_orden'] = $utilitarios->cambiaf_a_normal($cabecera_orden[0]['alm_ord_compra_cab']['alm_fecha_orden_registro']);
				 $json_data['fecha_orden_entrega'] = $utilitarios->cambiaf_a_normal($cabecera_orden[0]['alm_ord_compra_cab']['alm_fecha_entrega']);
				 $terminos = $orden_compra->obtenerTerminosPago($cabecera_orden[0]['alm_ord_compra_cab']['alm_termino_pago']);
				 $json_data['term_pago'] = $terminos[0]['gral_param_propios']['GRAL_PAR_PRO_DESC'];
				 $json_data['ship_via'] = $cabecera_orden[0]['alm_ord_compra_cab']['alm_ship_via'];
				 $json_data['broker_imp'] = $cabecera_orden[0]['alm_ord_compra_cab']['alm_broker'];
				 $term = $orden_compra->obtenerTerminoEnvio($cabecera_orden[0]['alm_ord_compra_cab']['alm_terms']);
				 $json_data['termino_envio'] = $term[0]['gral_param_propios']['GRAL_PAR_PRO_DESC'];
				 print(json_encode($json_data));	
				 break;
			case 'seleccionarContactos':
				 $contactos = $orden_compra->seleccionarContactos();
				 $cont = 0;
				 foreach($contactos as $key => $contacto){
					 $json_data['ref_nombre'] = $contacto['gral_empresa_ref']['gral_empresa_ref_nombre'];
					 $json_data['ref_direccion'] = $contacto['gral_empresa_ref']['gral_empresa_ref_dir'];
					 $json_data['ref_telefono'] = $contacto['gral_empresa_ref']['gral_empresa_ref_telf'];
					 $json_data['ref_fax'] = $contacto['gral_empresa_ref']['gral_empresa_ref_fax'];
					 $json_data['ref_email'] = $contacto['gral_empresa_ref']['gral_empresa_ref_email'];
					 $json_data['ref_tipo'] = $contacto['gral_empresa_ref']['gral_empresa_ref_tipo'];
					 $json_data['ref_ciudad'] = $contacto['gral_empresa_ref']['gral_empresa_ref_ciu_pais'];
					 $json_data['ref_pais'] = $contacto['gral_empresa_ref']['gral_empresa_ref_pais'];
					 $datos[$cont] = $json_data;
					 $cont++;
				 }
				 print(json_encode($datos));
				 break;
			case 'seleccionarProveedorProforma':
					$proforma = $orden_compra->seleccionarProveedorProforma($_GET['codigo_proyecto']);
					$json_data['completo'] = true;
					print_r(json_encode($json_data)); 
				 break;
			case 'listaProveedoresOrdenCompra':
				 $proveedor = new Proveedor();
				 $lista_proveedores = $proveedor->listaProveedores();
				 $cont = 0;
				 foreach ($lista_proveedores as $key => $value) {
				 	$data['codigo_proveedor'] = $value['alm_proveedor']['alm_prov_codigo_int'];
				 	$data['nombre_proveedor'] = $value['alm_proveedor']['alm_prov_nombre'];
				 	$json_data[$cont] = $data;
				 	$cont++;
				 }
				 print_r(json_encode($json_data));
				 break;
			case 'listaTerminosPagoOrdenCompra':
				 $terminos_pago = $orden_compra->listaFormasPago();
				 $cont = 0;
				 foreach ($terminos_pago as $key => $value) {
				 	$data['codigo_termino_pago'] = $value['gral_param_propios']['GRAL_PAR_PRO_COD'];
				 	$data['desc_termino_pago'] = $value['gral_param_propios']['GRAL_PAR_PRO_DESC'];
				 	$json_data[$cont] = $data;
				 	$cont++;
				 }
				 print_r(json_encode($json_data));
				 break;
			case 'listaTerminosOrdenOrdenCompra':
				 $terminos_orden = $orden_compra->listaTerminiosOrden();
				 $cont = 0;
				 foreach ($terminos_orden as $key => $value) {
				 	$data['codigo_termino_orden'] = $value['gral_param_propios']['GRAL_PAR_PRO_COD'];
				 	$data['desc_termino_orden'] = $value['gral_param_propios']['GRAL_PAR_PRO_DESC'];
				 	$json_data[$cont] = $data;
				 	$cont++;
				 }
				 print_r(json_encode($json_data));
				 break;
			case 'listaMonedasOrdenCompra':
				 $listaMonedasOrdenComrpa = $orden_compra->listaMonedasOrdenCompra();
				 $cont = 0;
				 foreach ($listaMonedasOrdenComrpa as $key => $value) {
				 	$data['codigo_moneda_orden_compra'] = $value['gral_param_super_int']['GRAL_PAR_INT_COD'];
				 	$data['sigla_moneda_orden_compra'] = $value['gral_param_super_int']['GRAL_PAR_INT_SIGLA'];
				 	$data['descripcion_moneda_orden_compra'] = $value['gral_param_super_int']['GRAL_PAR_INT_DESC'];
				 	$json_data[$cont] = $data;
				 	$cont++;
				 }
				 print_r(json_encode($json_data));
				 break;
			case 'armarOrdenCompraFormulario':
				  $json_data['completo'] = true;
				  print_r(json_encode($json_data));
				 break;
			case 'eliminarOrdenCompra':
				 if($orden_compra->eliminarOrdenCompra($_POST['codigo_unico_proy'], $_SESSION['login'])){
				 	$json_data['completo'] = true;
				 }else{
				 	$json_data['completo'] = false;
				 }
				 print_r(json_encode($json_data));
				 break;
			case 'procesarOrdenCompra':
				 if($orden_compra->procesarOrdenCompra($_POST['codigo_unico_proy'], $_SESSION['login'])){
				 	$json_data['completo'] = true;
				 }else{
				 	$json_data['completo'] = false;
				 }
				 print_r(json_encode($json_data));
				 break;
				 
				 case 'bajaDetalleOrden':
				 //print_r($_POST['codigo_proy']);
				 	$valro = $orden_compra->procesarBajaDetalleOrdenCompra($_POST['codigo_proy']);
					//print_r ($valor);
				 break;
		}
	}
}
$orden_compra_router = new OrdenCompraRouter(); // Este es el router
if($_SERVER['REQUEST_METHOD'] == "POST"){
	$accion = $_POST['accion'];
}elseif($_SERVER['REQUEST_METHOD'] == "GET"){
	$accion = $_GET['accion'];
} 
$orden_compra_router->ejecutarAccion($accion);
?>