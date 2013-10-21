<?php
session_start();
require_once '../clases/ItemOrdenCompra.php';
/**
 * Esta clase gestiona las acciones de la proforma
 */
class ItemCompraRouter{
	/**
	 * Metodo que realiza el ejecutar la accion 
	 * @param $action esta es la accion
	 */
	public function ejecutarAccion($accion){
		$item_orden_compra = new ItemOrdenCompra(); 
		switch($accion){
			case 'grabarNuevoItemOrdenCompra': // Esto esto es la accion para grabar la proforma
				$item_orden_compra->grabarNuevoItemCompra($_POST['nro_referencia'], 
														  $_POST['codigo_proyecto_item'], 
														  $_POST['codigo_unico_proyecto'],
														  $_POST['codigo_proforma'], 
														  $_POST['part_number_item'], 
														  $_POST['description_item'], 
														  $_POST['qty_nuevo_item'], 
														  $_POST['unidad_tipo_item'], 
														  $_POST['precio_unitario'],
														  $_POST['serial_number_val'],
														  $_POST['tipo_item_prod_nuevo'],
														  $_SESSION['login']);
				//echo $_POST['serial_number_val'];
				//echo $_SESSION['login'];
				$json_data['completo'] = true;
				print_r(json_encode($json_data));
				break;
			case 'listaItemsOrdenCompra':
				$listas_items = $item_orden_compra->listaItemsOrdenCompra($_GET['nro_ref'], $_GET['codigo_proyecto'], $_GET['codigo_proforma'], $_GET['codigo_unico_proy']);
				//print_r($listas_items);
				if(empty($listas_items)){
					$data['codigo_unico_item'] = '0';
			     	$data['nro_ref'] = '0';
					$data['codigo_proyecto'] = '0';
					$data['nro_proforma'] = '0';
					$data['parte_ord_compra'] = '0';
					$data['serial_number'] = '0';
					$data['description_item'] = '0';
					$data['cantidad_item'] = '0';
					$data['unidad_item'] = '0';
					$data['precio_unitario'] = '0';
					$data['moneda_item'] = '0';
			     	$json_dat[0] = $data;
			     	print_r(json_encode($json_dat));
			     }else{
					$cont = 0;
					foreach ($listas_items as $key => $value) {
						$data['codigo_unico_item'] = $value['alm_ord_compra_det']['alm_id_unico_item_ord_compra'];
						$data['nro_ref'] = $value['alm_ord_compra_det']['alm_nro_orden_compra'];
						$data['codigo_proyecto'] = $value['alm_ord_compra_det']['alm_cod_proyecto'];
						$data['nro_proforma'] = $value['alm_ord_compra_det']['alm_nro_proforma'];
						$data['parte_ord_compra'] = $value['alm_ord_compra_det']['alm_nro_parte_ord_compra'];
						$data['serial_number'] = $value['alm_ord_compra_det']['alm_item_ord_serial'];
						$data['description_item'] = $value['alm_ord_compra_det']['alm_descripcion'];
						$data['cantidad_item'] = $value['alm_ord_compra_det']['alm_cantidad_ord'];
						$data['unidad_item'] = $value['gral_param_propios']['GRAL_PAR_PRO_SIGLA'];
						$data['precio_unitario'] = $value['alm_ord_compra_det']['alm_precio_unitario'];
						$data['moneda_item'] = $value[0]['alm_precio_moneda'];
						$json_data[$cont] = $data;
						$cont++;
					}
					print_r(json_encode($json_data));
				}
				
				break;
			case 'eliminarItemOrdenCompra':
				if($item_orden_compra->eliminarItemOrdenCompra($_POST['codigo_unico_item'],  $_SESSION['login'])){
					$json_res['completo'] = true;
				}else{
					$json_res['completo'] = false;
				}
				print_r(json_encode($json_res));
				break;
			case 'optenerTotalesOrdenCompra':
				$totales = $item_orden_compra->obtenerTotalesOrdenCompra($_GET['cod_unico_orden_compra']);
				$json_res['alm_tot_descuento'] = $totales[0][0]['alm_tot_descuento'];
				$json_res['alm_tot_asegurado'] = $totales[0][0]['alm_tot_asegurado'];
				$json_res['alm_tot_transporte'] = $totales[0][0]['alm_tot_transporte'];
				$json_res['alm_tot_otros'] = $totales[0][0]['alm_tot_otros'];
				print_r(json_encode($json_res));
				break;

		}
	}
}
$item_compra_router = new ItemCompraRouter(); // Este es el router
if($_SERVER['REQUEST_METHOD'] == "POST"){
	$accion = $_POST['accion'];
}elseif($_SERVER['REQUEST_METHOD'] == "GET"){
	$accion = $_GET['accion'];
} 
$item_compra_router->ejecutarAccion($accion);
?>