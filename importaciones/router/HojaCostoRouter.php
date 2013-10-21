<?php
session_start();
require_once '../clases/HojaCosto.php';
require_once '../clases/TransferenciaBancaria.php';
require_once '../clases/DetalleLiquidacion.php';
require_once '../clases/Certificado.php';
require_once '../clases/Proyecto.php';
require_once '../clases/OrdenCompra.php';
/**
 * Esta clase gestiona las acciones del certificado
 */
class HojaCostoRouter{
	/**
	 * Metodo que realiza el ejecutar la accion 
	 * @param $action esta es la accion
	 */
	public function ejecutarAccion($accion){
		switch($accion){
			case 'ListarCabecera': // Esto es la accion para crear nuevo certificado
				//echo("ROUTER");
				//echo $_POST['numero_documento']."<br>";
				//echo $_POST['codigo_proyecto']."<br>";
				//echo $_POST['nro_orden'];
				//echo $_POST['cod_ref'];
				//echo $_SESSION['TC_CONTAB'];
				//echo $_POST['fec_doc']."<br>";
				//echo $_POST['descripcion_cert']."<br>"; 
				$hojacosto = new HojaCosto(); 
				$tranferencia = new TransferenciaBancaria(); 
				$detalle= new DetalleLiquidacion(); 
				$certificado= new Certificado(); 
				$datos=$hojacosto->ListarDatosOrden($_POST['codigo_proyecto'], $_SESSION['TC_CONTAB'],$_POST['cod_prov']);
				$datosTrans=$tranferencia->datosTransferencia($_POST['codigo_proyecto'], $_SESSION['TC_CONTAB'],$_POST['cod_prov']);
				$verifica=$hojacosto->verificaHojaCosto($_POST['codigo_proyecto']);
				if (empty($verifica)) {
				//echo ("vacio");
				$datosliqui=$detalle->sumatoriaPoliza2($_POST['codigo_proyecto'],$_POST['cod_prov']);
				$resp_adu= $hojacosto->datosPlanilla($_POST['codigo_proyecto'],$_POST['cod_prov']);
				$datosCert=$certificado->ListarCertificado($_POST['codigo_proyecto'],$_POST['cod_prov']);
				}else{
				//echo ("no vacio");
				$proveedor='consolidado';
				$datosliqui=$detalle->sumatoriaPoliza2($_POST['codigo_proyecto'],$proveedor);
				$resp_adu= $hojacosto->datosPlanilla($_POST['codigo_proyecto'],$proveedor);
				$datosCert=$certificado->ListarCertificado($_POST['codigo_proyecto'],$proveedor);
				}
				
				//print_r($datosCert);
				$cont = 0;
				// foreach para sacar las sumas totales de los montos de los certificados
				if (empty($datosCert)) {
				    $json_data['suma_cert'] = 0;
					$json_data['suma_cert_sus'] = 0;
				    //$array[0] = $json_data;     
				    //print_r(json_encode($array));
				} else{

				foreach ($datosCert as $key => $cert) {
					$json_data['suma_cert'] = $cert[0]['suma_cert'];
					$json_data['suma_cert_sus'] = round($json_data['suma_cert']/$_SESSION['TC_CONTAB'],2);
							}
				}
				// foreach para los datos de la hoja de costo, datos de liqui, respaldo nro documento planilla aduanera
				foreach ($datos as $key => $value) {
					//DATOS DE LA ORDEN DE COMPRA PARA LA CABECERA DE LA HOJA DE COSTO
					$json_data['alm_prov_codigo'] = $value['cab']['alm_prov_codigo'];
					$json_data['alm_nro_referencia_orden'] = $value['cab']['alm_nro_referencia_orden'];
					$json_data['alm_proy_cod'] = $value['cab']['alm_proy_cod'];
					$json_data['alm_prov_nombre'] = $value['pro']['alm_prov_nombre'];
					$json_data['precio_neto'] = $value[0]['precio_neto'];
					$json_data['costo_sus_trans'] = $value[0]['costo_sus_trans'];
                    $json_data['costo_bs_trans'] = $value[0]['costo_bs_trans'];
                    $json_data['costo_sus_fob'] = $value[0]['costo_sus_fob'];
                    $json_data['costo_bs_fob'] = $value[0]['costo_bs_fob'];
                    //DATOS TRANFERENCIA BANCARIA PARA LA CABECERA DE LA HOJA DE COSTO
					//$json_data['monto_trans_sus'] = round($datosTrans[0][0]['monto_trans_sus'],2);
					//$json_data['monto_trans_bs'] = round($datosTrans[0][0]['monto_trans_bs'],2);
					$json_data['comision_trans_sus'] = round($datosTrans[0][0]['comision_trans_sus'],2);
					$json_data['comision_trans_bs'] = round($datosTrans[0][0]['comision_trans_bs'],2);
					$json_data['nro_trans'] = $datosTrans[0][0]['nro_trans'];
					$json_data['nro_cert'] = $datosTrans[0][0]['nro_cert'];
					$json_data['monto_cert_trans_sus'] = round($datosTrans[0][0]['monto_cert_trans_sus'],2);
					$json_data['monto_cert_trans_bs'] = round($datosTrans[0][0]['monto_cert_trans_bs'],2);
					$json_data['total_costo_trans_bs'] = ($json_data['comision_trans_bs']+$json_data['costo_bs_fob']+$json_data['monto_cert_trans_bs']);
				    $json_data['total_costo_trans_sus'] = ($json_data['comision_trans_sus']+$json_data['costo_sus_fob']+$json_data['monto_cert_trans_sus']);
				   //DATOS LIQUIDACION POLIZA PARA LA CABECERA DE LA HOJA DE COSTO
				    $json_data['total_pol'] = $datosliqui[0][0]['total'];
				    $json_data['totaliva_pol'] = $datosliqui[0][0]['totaliva'];
				    $json_data['totalneto_pol'] = $datosliqui[0][0]['totalneto'];
				    $json_data['totalneto_pol_sus'] = round($json_data['totalneto_pol']/$_SESSION['TC_CONTAB'],2); 
				    $json_data['alm_form_nro_doc'] = $resp_adu[0]['alm_form_importacion']['alm_form_nro_doc'];
					$json_data['tc'] = round($_SESSION['TC_CONTAB'],2);
					$json_data['nro_orden'] = $_POST['nro_orden'];
					$json_data['cod_prov'] = $_POST['cod_prov'];
					$json_data['codigo_proyecto'] = $_POST['codigo_proyecto'];
					$json_data['nro_plan'] = $_POST['cod_ref'];
					$array[$cont]=$json_data;
						$cont++;
				    }
					print_r(json_encode($array));
					//print_r($array);
				
			break;

			case 'ListarHojaCosto': // Esto es la accion para lista las HOJA DE COSTO
				//echo $_GET['accion']."<br>";
				//echo $_GET['codigo_proyecto']."<br>";
			    //$utilitarios = new Utilitarios();
				$hojacosto = new HojaCosto();
				$verifica=$hojacosto->verificaHojaCosto($_GET['codigo_proyecto']);
				if (empty($verifica)) {
				//echo ("vacio");
				$lista_hoja=$hojacosto->listaHojaCosto($_GET['codigo_proyecto']);
				//print_r($lista_hoja);
					$cont = 0;
				    foreach ($lista_hoja as $key => $value) {
						
						$json_data['alm_nro_referencia_orden'] = $value['cab']['alm_nro_referencia_orden'];
						$json_data['alm_prov_codigo'] = $value['cab']['alm_prov_codigo'];
						$acciones=$hojacosto->accionHoja($_GET['codigo_proyecto'],$json_data['alm_prov_codigo']);
								if (empty($acciones)) {
									$json_data['id'] = 0;
								}else{
									$json_data['id'] = 1;
								}
						$json_data['alm_prov_nombre'] = $value['pro']['alm_prov_nombre'];
						$json_data['alm_prov_nombre'] = $value['pro']['alm_prov_nombre'];
						$json_data['alm_age_adu_tra_nro_fac'] = $value['t']['alm_age_adu_tra_nro_fac'];
						$json_data['codigo_proyecto'] = $_GET['codigo_proyecto'];
						$json_data['alm_form_tipo'] = 13; 
						$array[$cont]=$json_data;
						$cont++;
				    }
					print_r(json_encode($array));
					//print_r($array);
				}else{
				//echo ("no vacio");
				$lista_hoja2=$hojacosto->listaHojaCosto2($_GET['codigo_proyecto']);
				//print_r($lista_hoja2);
					$cont = 0;
				    foreach ($lista_hoja2 as $key => $value) {
						
						$json_data['alm_nro_referencia_orden'] = $value['cab']['alm_nro_referencia_orden'];
						$json_data['alm_prov_codigo'] = $value['cab']['alm_prov_codigo'];
						$acciones=$hojacosto->accionHoja($_GET['codigo_proyecto'],$json_data['alm_prov_codigo']);
								if (empty($acciones)) {
									$json_data['id'] = 0;
								}else{
									$json_data['id'] = 1;
								}
						$json_data['alm_prov_nombre'] = $value['pro']['alm_prov_nombre'];
						$json_data['alm_prov_nombre'] = $value['pro']['alm_prov_nombre'];
						$json_data['alm_age_adu_tra_nro_fac'] = $value['t']['alm_age_adu_tra_nro_fac'];
						$json_data['codigo_proyecto'] = $_GET['codigo_proyecto'];
						$json_data['alm_form_tipo'] = 13; 
						$array[$cont]=$json_data;
						$cont++;
				    }
					print_r(json_encode($array));
					//print_r($array);

				}
			break;

			case 'ListarCertificado': // Esto es la accion para modificar un certificado
			//echo $_POST['codigo_proyecto']."<br>";
			//echo $_POST['nro_orden'];
			$hojacosto = new HojaCosto();
			$certificado = new Certificado(); 
			$verifica=$hojacosto->verificaHojaCosto($_POST['codigo_proyecto']);
			if (empty($verifica)) {
			$datosCert=$certificado->ListarCertificado($_POST['codigo_proyecto'],$_POST['cod_prov']);
			}else{
			//echo ("no vacio");
			$proveedor='consolidado';				
			$datosCert=$certificado->ListarCertificado($_POST['codigo_proyecto'],$proveedor);
			//print_r($datosCert);
			}	
				if (empty($datosCert)) {
					$json_data['alm_form_nro_doc_cert'] = '';
					$json_data['alm_form_comision_cert'] = '';
					$json_data['suma_cert'] = '';
					$json_data['suma_cert_sus'] = '';
				    $array[0] = $json_data;     
				    print_r(json_encode($array));
				} else{
					$cont = 0;
					foreach ($datosCert as $key => $cert) {
					$json_data['alm_form_nro_doc_cert'] = $cert['alm_form_importacion']['alm_form_nro_doc'];
					$json_data['alm_form_comision_cert'] = $cert['alm_form_importacion']['alm_form_comision_cert'];
					$json_data['suma_cert'] = $cert[0]['suma_cert'];
					$json_data['suma_cert_sus'] = round($json_data['suma_cert']/$_SESSION['TC_CONTAB'],2);
					$array[$cont]=$json_data;
					$cont++;
				    }
					print_r(json_encode($array));
				}
			break;

			case 'grabarAlmacen': // Esto es la accion para lista las HOJA DE COSTO
				
				/*echo $_POST['cod_prov']."<br>";
			    echo $_POST['cod_prov_cab']."<br>";
			    echo $_POST['num_serie']."<br>";
			    echo $_POST['tipo_prod']."<br>";
			    echo $_POST['tipo_prod_cab']."<br>";
			    echo $_POST['nom_prod']."<br>";
			    echo $_POST['nom_prod_cab']."<br>";
			    echo $_POST['ref_prod']."<br>";
			    echo $_POST['ref_prod_cab']."<br>";
			    echo $_POST['cant_prod']."<br>";
			    echo $_POST['cant_prod_cab']."<br>";
			    echo $_POST['pu_prod']."<br>";
			    echo $_POST['costo_compra_prod']."<br>";
			    echo $_POST['costo_venta_prod']."<br>";
			    echo $_POST['uni_prod']."<br>";
			    echo $_POST['uni_prod_cab']."<br>";
			    echo $_POST['mon_prod']."<br>";
			    echo $_POST['mon_prod_cab']."<br>";*/
			    //$utilitarios = new Utilitarios(); "cod_prov" "tipo_prod[]" $tipo_prod_cab
				$hojacosto = new HojaCosto();
				$hojacosto->grabarAlmacen($_POST['cod_proy_cab'],$_POST['cod_prov'],$_POST['cod_prov_cab'],$_POST['num_serie'],$_POST['tipo_prod'],$_POST['tipo_prod_cab'],
				$_POST['nom_prod'],$_POST['nom_prod_cab'],$_POST['ref_prod'],$_POST['ref_prod_cab'],
				$_POST['cant_prod'],$_POST['cant_prod_cab'],$_POST['pu_prod'],$_POST['costo_compra_prod'],$_POST['costo_venta_prod'],
				$_POST['uni_prod'],$_POST['uni_prod_cab'],$_POST['mon_prod'],$_POST['mon_prod_cab'],$_SESSION['login'],$_SESSION['fec_proc']);
					
			break; 

			/*case 'grabarAlmacen': // Esto es la accion para lista las HOJA DE COSTO
				
				//echo $_POST['id_prod']."<br>";
			    //echo $_POST['costo_prod']."<br>";
			    //$utilitarios = new Utilitarios();
				$hojacosto = new HojaCosto(); 
				$lista_hoja=$hojacosto->updateProducto($_POST['id_prod'],$_POST['costo_prod'],$_SESSION['login'],
													$_SESSION['fec_proc']);
			break;*/

			case 'ListarDetalleHoja2': // Esto es la accion para lista las HOJA DE COSTO
				//echo $_GET['accion']."<br>";
				//echo $_POST['codigo_proyecto']."<br>";
				//echo $_POST['cod_prov']."<br>";
			    //$utilitarios = new Utilitarios();
				$hojacosto = new HojaCosto(); 
				//$datos_hoja=$hojacosto->listaDetalleHoja($_POST['codigo_proyecto'],$_POST['cod_prov']);
				$datos_hoja2=$hojacosto->listaItems($_POST['codigo_proyecto'],$_POST['cod_prov']);
				//print_r($datos_hoja2);
					$cont = 0;
				    foreach ($datos_hoja2 as $key => $value) { 
				    	$json_data['alm_item_ord_tipo'] = $value['det']['alm_item_ord_tipo'];
				    	$json_data['total_fob'] = $value[0]['total_fob'];
				    	$json_data['gran_total_fob'] = $value[0]['gran_total_fob'];
				    	$json_data['alm_item_ord_serial'] = $value['det']['alm_item_ord_serial'];
				    	$json_data['alm_nro_parte_ord_compra'] = $value['det']['alm_nro_parte_ord_compra'];
						$json_data['alm_descripcion'] = $value['det']['alm_descripcion'];
						$json_data['alm_cantidad_ord'] = $value['det']['alm_cantidad_ord'];
						$json_data['alm_unidad_um'] = $value['det']['alm_unidad_um'];
						$unidad=$hojacosto->unidad_det($json_data['alm_unidad_um']);
							foreach ($unidad as $key => $value2) {
									$json_data['unidad'] = $value2['gral_param_propios']['GRAL_PAR_PRO_DESC'];
							}
						$json_data['alm_precio_unitario'] = $value['det']['alm_precio_unitario'];
						$json_data['alm_precio_moneda'] = $value['det']['alm_precio_moneda'];
						$moneda=$hojacosto->moneda_det($json_data['alm_precio_moneda']);
							foreach ($moneda as $key => $value3) {
									$json_data['moneda'] = $value3['gral_param_super_int']['GRAL_PAR_INT_DESC'];
							}
						$json_data['codigo_proyecto'] = $_POST['codigo_proyecto'];
						$json_data['codigo_proveedor'] = $_POST['cod_prov'];
						$array[$cont]=$json_data;
						$cont++;
				    } 
				    //print_r($array);
					print_r(json_encode($array));
			break;

			case 'listarItems': // Esto es la accion para lista las HOJA DE COSTO
				//echo $_GET['accion']."<br>";
				//echo $_POST['codigo_proyecto']."<br>";
				//echo $_POST['cod_prov']."<br>";
			    //$utilitarios = new Utilitarios();
				$hojacosto = new HojaCosto(); 
				//$datos_hoja=$hojacosto->listaDetalleHoja($_POST['codigo_proyecto'],$_POST['cod_prov']);
				$datos_hoja2=$hojacosto->listaItems($_POST['codigo_proyecto'],$_POST['cod_prov']);
				//print_r($datos_hoja2);
					$cont = 0;
				    foreach ($datos_hoja2 as $key => $value) { 
				    	$json_data['alm_id_ord_compra_det'] = $value['det']['alm_id_ord_compra_det'];
				    	$json_data['alm_nro_orden_compra'] = $value['det']['alm_nro_orden_compra'];
						$json_data['alm_descripcion'] = $value['det']['alm_descripcion'];
						$json_data['alm_cantidad_ord'] = $value['det']['alm_cantidad_ord'];
						$json_data['alm_unidad_um'] = $value['det']['alm_unidad_um'];
						$unidad=$hojacosto->unidad_det($json_data['alm_unidad_um']);
							foreach ($unidad as $key => $value2) {
									$json_data['unidad'] = $value2['gral_param_propios']['GRAL_PAR_PRO_DESC'];
							}
						$json_data['alm_precio_unitario'] = $value['det']['alm_precio_unitario'];
						$json_data['alm_precio_moneda'] = $value['det']['alm_precio_moneda'];
						$moneda=$hojacosto->moneda_det($json_data['alm_precio_moneda']);
							foreach ($moneda as $key => $value3) {
									$json_data['moneda'] = $value3['gral_param_super_int']['GRAL_PAR_INT_DESC'];
							}
						$json_data['codigo_proyecto'] = $_POST['codigo_proyecto'];
						$json_data['codigo_proveedor'] = $_POST['cod_prov'];
						$array[$cont]=$json_data;
						$cont++;
				    } 
				    //print_r($array);
					print_r(json_encode($array));
			break;
			case 'grabarCabeceraProducto':
				/*echo $_POST['codigo_proyecto']."<br>";
				echo $_POST['cod_prov']."<br>";
				echo $_POST['id_item']."<br>";
				echo $_POST['nom_prod']."<br>";
				echo $_POST['ref_prod']."<br>";
				echo $_POST['cant_prod']."<br>";
				echo $_POST['pu_prod']."<br>";
				echo $_POST['uni_prod']."<br>";
				echo $_POST['mon_prod']."<br>";
				echo $_POST['tipo_prod']."<br>";*/

				$hojacosto = new HojaCosto(); 
				$hojacosto->grabarCabeceraProducto($_POST['codigo_proyecto'],$_POST['cod_prov'],$_POST['id_item'],
				$_POST['nom_prod'],$_POST['ref_prod'],$_POST['cant_prod'],$_POST['pu_prod'],
				$_POST['uni_prod'],$_POST['mon_prod'],$_POST['tipo_prod'],$_SESSION['login'],
													$_SESSION['fec_proc']);
			break;

			case 'detalleItems': // Esto es la accion para lista las HOJA DE COSTO
				//echo $_GET['accion']."<br>";
				//echo $_POST['codigo_proyecto']."<br>";
				//echo $_POST['cod_prov']."<br>";
			    //$utilitarios = new Utilitarios();
				$hojacosto = new HojaCosto(); 
				//$datos_hoja=$hojacosto->listaDetalleHoja($_POST['codigo_proyecto'],$_POST['cod_prov']);
				$datos_hoja2=$hojacosto->detalleItems($_POST['id_item'],$_POST['codigo_proyecto'],$_POST['cod_prov']);
				//print_r($datos_hoja2);
					$cont = 0;
				    foreach ($datos_hoja2 as $key => $value) { 
				    	$json_data['alm_item_ord_tipo'] = $value['det']['alm_item_ord_tipo'];
				    	$json_data['alm_id_ord_compra_det'] = $value['det']['alm_id_ord_compra_det'];
				    	$json_data['alm_nro_orden_compra'] = $value['det']['alm_nro_orden_compra'];
						$json_data['alm_descripcion'] = $value['det']['alm_descripcion'];
						$json_data['alm_cantidad_ord'] = $value['det']['alm_cantidad_ord'];
						$json_data['alm_unidad_um'] = $value['det']['alm_unidad_um'];
						$unidad=$hojacosto->unidad_det($json_data['alm_unidad_um']);
							foreach ($unidad as $key => $value2) {
									$json_data['unidad'] = $value2['gral_param_propios']['GRAL_PAR_PRO_DESC'];
							}
						$json_data['alm_precio_unitario'] = $value['det']['alm_precio_unitario'];
						$json_data['alm_precio_moneda'] = $value['det']['alm_precio_moneda'];
						$moneda=$hojacosto->moneda_det($json_data['alm_precio_moneda']);
							foreach ($moneda as $key => $value3) {
									$json_data['moneda'] = $value3['gral_param_super_int']['GRAL_PAR_INT_DESC'];
							}
						$json_data['codigo_proyecto'] = $_POST['codigo_proyecto'];
						$json_data['codigo_proveedor'] = $_POST['cod_prov'];
						$array[$cont]=$json_data;
						$cont++;
				    } 
				    //print_r($array);
					print_r(json_encode($array));
			break;
			case 'listaProd':
			$hojacosto = new HojaCosto(); 
			$tipo_prod=$hojacosto->listaTipoProd();
			$cont=0;
			foreach ($tipo_prod as $key => $value) {
				$json_data['tipo'] = $value['gral_param_propios']['GRAL_PAR_PRO_DESC'];
				$json_data['cod'] = $value['gral_param_propios']['GRAL_PAR_PRO_COD'];
				$array[$cont]=$json_data;
				$cont++;
			}
			//print_r($array);
			print_r(json_encode($array));
			break;
			case 'ListarDetalleHoja': // Esto es la accion para lista las HOJA DE COSTO
				//echo $_GET['accion']."<br>";
				//echo $_POST['codigo_proyecto']."prov";
				//echo $_POST['cod_prov']."prov";
			    //$utilitarios = new Utilitarios();
				$hojacosto = new HojaCosto(); 
				$datos_hoja=$hojacosto->listaDetalleHoja($_POST['codigo_proyecto'],$_POST['cod_prov']);
				//$datos_hoja2=$hojacosto->listaDetalleHoja($_POST['codigo_proyecto'],$_POST['cod_prov']);
				//print_r($datos_hoja);
					$cont = 0;
				foreach ($datos_hoja as $key => $value) {						
						$json_data['alm_prod_id'] = $value['p']['alm_prod_id'];
						$json_data['alm_prod_codigo'] = $value['p']['alm_prod_codigo'];
						$json_data['alm_prod_cod_ref'] = $value['p']['alm_prod_cod_ref'];
						$json_data['alm_prod_nombre'] = $value['p']['alm_prod_nombre'];	
						$json_data['alm_prod_serie'] = $value['p']['alm_prod_serie'];
						$json_data['alm_prod_cantidad_stock'] = round($value['p']['alm_prod_cantidad_stock'],0);
						$json_data['alm_prod_prec_compra'] = $value['p']['alm_prod_prec_compra'];
						$json_data['alm_prod_prec_venta'] = $value['p']['alm_prod_prec_venta'];
						$json_data['alm_prod_prec_max_venta'] = $value['p']['alm_prod_prec_max_venta'];
						$json_data['alm_prod_prec_min_venta'] = $value['p']['alm_prod_prec_min_venta'];
						$json_data['alm_prod_porcentaje'] = $value['p']['alm_prod_porcentaje'];
						$json_data['alm_prod_moneda'] = $value['p']['alm_prod_moneda'];
						$json_data['alm_prod_part_number'] = $value['p']['alm_prod_part_number'];
						$json_data['precio_fob'] = $value[0]['precio_fob'];
						$json_data['part'] = $value[0]['part'];							
						$json_data['codigo_proyecto'] = $_POST['codigo_proyecto'];
						$json_data['cod_prov'] = $_POST['cod_prov'];
					
						$array[$cont]=$json_data;
						$cont++;
						} 
					print_r(json_encode($array));
			break;
			case 'procesarHojaCosto': // Esto esto es la accion para procesar los certificados
					//echo("ROUTER");
					//
					//echo $_POST['codigo_proyecto']."<br>";
					//echo $_POST['estado_proyecto']."<br>";
					$proyecto = new Proyecto(); 
					
					if ($proyecto->actualizaEstadoProyecto($_POST['codigo_proyecto'], $_POST['estado_proyecto'])) {
						$json_data['completo']=true;

					}
						print_r(json_encode($json_data));
			break;
			
		}
	}
}
$hoja_costo_router = new HojaCostoRouter(); // Este es el router intanciado
if($_SERVER['REQUEST_METHOD'] == "POST"){
	$accion = $_POST['accion'];
}elseif($_SERVER['REQUEST_METHOD'] == "GET"){
	$accion = $_GET['accion'];
} 
$hoja_costo_router->ejecutarAccion($accion);
?>