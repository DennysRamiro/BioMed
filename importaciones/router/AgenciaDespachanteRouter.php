<?php
session_start();
require_once '../clases/AgenciaDespachante.php';
require_once '../clases/Proyecto.php';
require_once '../clases/OrdenCompra.php';
/**
 * Esta clase gestiona las acciones de la Agencia Despachante
 */
class AgenciaDespachanteRouter{
	/**
	 * Metodo que realiza el ejecutar la accion 
	 * @param $action esta es la accion
	 */
	public function ejecutarAccion($accion){
		$agencia_despachante = new AgenciaDespachante(); 
		$provee = new Proveedor();
		$orden = new OrdenCompra();
		switch($accion){
			case 'grabarNuevoAgeDespach': //Accion para grabar nuevo agencia aduanera
			//print_r($_POST['factura_age']);

				$agencia_despachante->grabarAgeDesp($_POST['codigo_proyecto_hidden_age'],
													$_POST['cod_age'],
													$_POST['nom_age_selec'],
													$_POST['nro_fac_age'], 
													$_POST['fec_age'],
													$_POST['nro_sid_age'],
													$_POST['merc'],
													$_POST['bulto'],
													$_POST['und_med_bulto'],
													$_POST['peso'],
													$_POST['und_med_peso'],
													$_POST['fac_comer'],
													$_POST['val_cib'],
													$_POST['cod_prov000002'], //*******************************************************
													$_POST['item_age'],
													$_POST['des_age'], 
													$_POST['monto_age'],
													$_POST['factura_age'],
													$_SESSION['login'],
													$_SESSION['fec_proc']);
													
				break;

				case 'consolidadoPlanilla':
				$cons=$agencia_despachante->planillaCons($_POST['codigo_proyecto']);
					if (empty($cons)) {
						$json_data['id'] = 0;
						$array[0] = $json_data; 
						//print_r($cons); 						
					} else{
						$json_data['id'] = 1;
						$array[0] = $json_data;
						//print_r($cons);  
					}

				    print_r(json_encode($array));
					//print_r($array);
				break;

				case 'grabarNuevoAgeDespach1': //Accion para grabar nuevo agencia aduanera
				print_r($_POST['nom_age_selec1']);

				$agencia_despachante->grabarAgeDesp1($_POST['codigo_proyecto_hidden_age1'],
													$_POST['cod_age1'],
													$_POST['nom_age_selec1'],
													$_POST['nro_fac_age1'], 
													$_POST['fec_age1'],
													$_POST['nro_sid_age1'],
													$_POST['merc1'],
													$_POST['bulto1'],
													$_POST['und_med_bulto1'],
													$_POST['peso1'],
													$_POST['und_med_peso1'],
													$_POST['fac_comer1'],
													$_POST['val_cib1'],
													//$_POST['cod_prov000002'], //*******************************************************
													$_POST['item_age1'],
													$_POST['des_age1'], 
													$_POST['monto_age1'],
													$_POST['factura_age1'],
													$_SESSION['login'],
													$_SESSION['fec_proc']);
												
				break;
				case 'CodigoProyCabecera':
				//print_r($_POST['cod_aduana']);
				$cabecera=$agencia_despachante->ModcodigoProyectoCabecera($_POST['codigo_proyectoo'],$_POST['cod_aduana']);
				//print_r($cabecera);
				$json_data['alm_age_adu_tra_id'] = $cabecera[0]['alm_age_adu_tra']['alm_age_adu_tra_id'];
				$json_data['alm_age_adu_tra_cod'] = $cabecera[0]['alm_age_adu_tra']['alm_age_adu_tra_cod'];
				$json_data['alm_age_adu_tra_num_corr'] = $cabecera[0]['alm_age_adu_tra']['alm_age_adu_tra_num_corr'];
				$json_data['alm_age_adu_tra_id_age'] = $cabecera[0]['alm_age_adu_tra']['alm_age_adu_tra_id_age'];
				$json_data['alm_age_adu_tra_cod_proy'] = $cabecera[0]['alm_age_adu_tra']['alm_age_adu_tra_cod_proy'];
				$json_data['alm_age_adu_tra_nro_fac'] = $cabecera[0]['alm_age_adu_tra']['alm_age_adu_tra_nro_fac'];
				$json_data['alm_age_adu_tra_fecha'] = $cabecera[0]['alm_age_adu_tra']['alm_age_adu_tra_fecha'];
				$json_data['alm_age_adu_tra_cod_sidu'] = $cabecera[0]['alm_age_adu_tra']['alm_age_adu_tra_cod_sidu'];
				$json_data['alm_age_adu_tra_merc'] = $cabecera[0]['alm_age_adu_tra']['alm_age_adu_tra_merc'];
				$json_data['alm_age_adu_tra_bulto'] = $cabecera[0]['alm_age_adu_tra']['alm_age_adu_tra_bulto'];
				$json_data['alm_age_adu_tra_med_bulto'] = $cabecera[0]['alm_age_adu_tra']['alm_age_adu_tra_med_bulto'];
				$json_data['alm_age_adu_tra_peso'] = $cabecera[0]['alm_age_adu_tra']['alm_age_adu_tra_peso'];
				$json_data['alm_age_adu_tra_med_peso'] = $cabecera[0]['alm_age_adu_tra']['alm_age_adu_tra_med_peso'];
				$json_data['alm_age_adu_tra_fac_comer'] = $cabecera[0]['alm_age_adu_tra']['alm_age_adu_tra_fac_comer'];
				$json_data['alm_age_adu_tra_val_cif'] = $cabecera[0]['alm_age_adu_tra']['alm_age_adu_tra_val_cif'];
				$json_data['alm_age_adu_tra_cod_prov'] = $cabecera[0]['alm_age_adu_tra']['alm_age_adu_tra_cod_prov'];
				$json_data['alm_age_adu_tra_monto'] = $cabecera[0]['alm_age_adu_tra']['alm_age_adu_tra_monto'];
				$json_data['alm_age_adu_tra_est'] = $cabecera[0]['alm_age_adu_tra']['alm_age_adu_tra_est'];
				$json_data['cod_aduana'] = $_POST['cod_aduana'];

				print_r(json_encode($json_data));
				break;
				
				case 'CodigoProyDetalle':
				$cont = 0;				
				$detalle=$agencia_despachante->ModcodigoProyectoDetalle($_POST['codigo_proyectoo'],$_POST['cod_aduana']);
				//print_r($detalle);
				foreach($detalle  as $key => $value){
				$json_data['alm_age_adu_tra_det_id'] = $value['alm_age_adu_tra_det']['alm_age_adu_tra_det_id'];
				$json_data['alm_age_adu_tra_det_cod'] = $value['alm_age_adu_tra_det']['alm_age_adu_tra_det_cod'];
				$json_data['alm_age_adu_tra_det_item'] = $value['alm_age_adu_tra_det']['alm_age_adu_tra_det_item'];
				$json_data['alm_age_adu_tra_det_item_des'] = $value[0]['ItemDesc']; //recupera de la consulta
				$json_data['alm_age_adu_tra_det_descrip'] = $value['alm_age_adu_tra_det']['alm_age_adu_tra_det_descrip'];
				$json_data['alm_age_adu_tra_det_monto'] = $value['alm_age_adu_tra_det']['alm_age_adu_tra_det_monto'];
				$json_data['alm_age_adu_tra_det_factura'] = $value['alm_age_adu_tra_det']['alm_age_adu_tra_det_factura'];
				$array[$cont] = $json_data;
				$cont++;
				}
				print_r(json_encode($array));
				break;
				//lista las Agencias Aduaneras para el comobobox
				case 'ListaAgencias':
				$cont = 0;				
				$agencias = $agencia_despachante->listaAgencias();
				//print_r($agencias);
				foreach($agencias  as $key => $value){
				$json_data['alm_age_adu_cod'] = $value['alm_age_adu']['alm_age_adu_cod'];
				$json_data['alm_age_adu_nom'] = $value['alm_age_adu']['alm_age_adu_nom'];
				$array[$cont] = $json_data;
				$cont++;
				}
				print_r(json_encode($array));
				
				break;
				//lista las unidades de medida para el comobobox
				case 'ListaUnidades':
				$cont = 0;				
				$agencias = $agencia_despachante->listaUnidadMedida();
				foreach($agencias  as $key => $value){
				$json_data['GRAL_PAR_PRO_COD'] = $value['gral_param_propios']['GRAL_PAR_PRO_COD'];
				$json_data['GRAL_PAR_PRO_DESC'] = $value['gral_param_propios']['GRAL_PAR_PRO_DESC'];
				$array[$cont] = $json_data;
				$cont++;
				}
				print_r(json_encode($array));
				
				break;
				//lista las unidades de medida para el comobobox
				case 'ListaProveedor':
				$cont = 0;				
				$proveedor = $provee->listaProveedores();				
				foreach($proveedor  as $key => $value){
				$json_data['alm_prov_codigo_int'] = $value['alm_proveedor']['alm_prov_codigo_int'];
				$json_data['alm_prov_nombre'] = $value['alm_proveedor']['alm_prov_nombre'];
				$array[$cont] = $json_data;
				$cont++;
				}
				print_r(json_encode($array));
				break;
				
				case 'GrabarModificacionAgencia': //Accion para grabar modificacion agencia aduanera
				//echo("router");
				$agencia_despachante->grabarModAgeDesp($_POST['codigo_proyecto_age'],
													$_POST['codigo'],
													$_POST['age_corr'],
													$_POST['codagencia'],
													$_POST['nro_fac_age1'], 
													$_POST['fec_age1'],
													$_POST['nro_sid_age1'],
													$_POST['merc1'],
													$_POST['bulto1'],
													$_POST['und_med_bulto1'],
													$_POST['peso1'],
													$_POST['und_med_peso1'],
													$_POST['fac_comer1'],
													$_POST['val_cib1'],
													$_POST['cod_prov1'],
													$_POST['item_age1'],
													$_POST['des_age1'], 
													$_POST['monto_age1'],
													$_POST['factura_age1'],
													$_SESSION['login'],
													$_SESSION['fec_proc']);
													
				break;				
		
		case 'Codigo_Proyecto': //Accion para grabar nuevo agencia aduanera
				$agencia_despachante->Cod_Proyecto($_POST['codigo_proyecto_hidden_age']);
		break;
		case 'ListarPlanillas': //Accion para grabar nuevo agencia aduanera
			$datos_plan=$orden->listaOrdenHoja($_GET['codigo_proyecto']);
			$cont = 0;	
				foreach ($datos_plan as $key => $value) {
				$json_data['alm_nro_referencia_orden'] = $value['c']['alm_nro_referencia_orden'];
				$json_data['alm_prov_codigo'] = $value['c']['alm_prov_codigo'];
				$json_data['alm_prov_nombre'] = $value['p']['alm_prov_nombre'];
				$lista=$agencia_despachante->listaAge($_GET['codigo_proyecto'],$json_data['alm_prov_codigo']);
							//print_r($_GET['codigo_proyecto']);
							//print_r($value['p']['alm_prov_nombre']);
							//print_r($lista);
							//foreach ($lista as $key => $value) {
							 	if (empty($lista)) {
									$json_data['id'] = 0;
									$json_data['doc'] = 0;
									//$array[0] = $json_data; 
							
								} else{
									$json_data['id'] = 1;
									$json_data['doc'] = 1;
									//$array[0] = $json_data; 
								}	
				$json_data['codigo_proyecto'] = $_GET['codigo_proyecto'];
				$json_data['id_proyecto'] = $_GET['id_proyecto'];
				$json_data['estado'] =11;
				$array[$cont] = $json_data;
				$cont++;
				}
				//print_r($array);
				print_r(json_encode($array));
				
				
		break;
		
		case 'listarOrdenesAgencia':
		
		$datos_plan=$orden->listaDetallarOrdenHoja($_GET['codigo_proyecto']);
			$cont = 0;	
				foreach ($datos_plan as $key => $value) {
				$json_data['alm_nro_referencia_orden'] = $value['c']['alm_nro_referencia_orden'];
				$json_data['alm_prov_codigo'] = $value['c']['alm_prov_codigo'];
				$json_data['alm_prov_nombre'] = $value['p']['alm_prov_nombre'];
				$json_data['codigo_proyecto'] = $_GET['codigo_proyecto'];
				$json_data['id_proyecto'] = $_GET['id_proyecto'];
				$json_data['alm_age_adu_tra_cod'] = $value['age']['alm_age_adu_tra_cod'];
				$json_data['estado'] =11;
				$array[$cont] = $json_data;
				$cont++;
				}
				print_r(json_encode($array));
		
		break;

		case 'listarOrdenesAgencia2':
		
		$datos_plan2=$orden->listaDetallarOrdenHoja2($_GET['codigo_proyecto'],$_GET['cod_prov']);
		//print_r($datos_plan2);	
			$cont = 0;	
				foreach ($datos_plan2 as $key => $value) {
				$json_data['alm_nro_referencia_orden'] = $value['c']['alm_nro_referencia_orden'];
				$json_data['alm_prov_codigo'] = $value['c']['alm_prov_codigo'];
				$json_data['alm_prov_nombre'] = $value['p']['alm_prov_nombre'];
				$json_data['codigo_proyecto'] = $_GET['codigo_proyecto'];
				$json_data['id_proyecto'] = $_GET['id_proyecto'];
				$json_data['alm_age_adu_tra_cod'] = $value['age']['alm_age_adu_tra_cod'];
				$json_data['estado'] =11;
				$array[$cont] = $json_data;
				$cont++;
				}
				print_r(json_encode($array));
		
		break;
	
		case 'DarBajaAgenciasLista': // Esto esto es la accion para dar de baja certificado
				$agencia_despachante->darBajaAgenciaLista($_POST['id_agencia'], $_POST['codigo_proyecto'],$_POST['cod_agencia'], $_SESSION['login']);
		break;

		case 'DarBajaAgencias': // Esto esto es la accion para dar de baja certificado
				$agencia_despachante->darBajaAgenciaLista($_POST['id_agencia'], $_POST['codigo_proyecto'],$_POST['cod_agencia'], $_SESSION['login']);
		break;

		case 'procesarPlanilla': // Esto esto es la accion para procesar los certificados
					$proyecto = new Proyecto(); 
					
					if ($proyecto->actualizaEstadoProyecto($_POST['codigo_proyecto'], $_POST['estado_proyecto'])) {
						$json_data['completo']=true;

					}
						print_r(json_encode($json_data));
			break;

		}

	}
}
$AgenciaDespachanteRouter = new AgenciaDespachanteRouter(); // Este es el router 
if($_SERVER['REQUEST_METHOD'] == "POST"){
	$accion = $_POST['accion'];
}elseif($_SERVER['REQUEST_METHOD'] == "GET"){
	$accion = $_GET['accion'];
}
$AgenciaDespachanteRouter->ejecutarAccion($accion);
?>