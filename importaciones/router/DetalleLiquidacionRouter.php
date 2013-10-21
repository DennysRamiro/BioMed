<?php
session_start();
require_once '../clases/DetalleLiquidacion.php';
require_once '../clases/Proyecto.php';
/**
 * Esta clase gestiona las acciones del Detalle de Liquidacion de poliza
 */
class DetalleLiquidacionRouter{
	/**
	 * Metodo que realiza el ejecutar la accion 
	 * @param $action esta es la accion
	 */
	public function ejecutarAccion($accion){
		$listas_poliza = new DetalleLiquidacion(); 
		switch($accion){
			case 'ListaPoliza': //Accion para listar el detalle de liquidacion
			//echo "aqui".$_POST['cod_proyecto'];
				$arreglo_listapoliza = $listas_poliza->listapoliza($_POST['cod_proyecto']);
				//print_r( $listas_poliza);
				$cont = 0;
				foreach($arreglo_listapoliza as $key => $poliza){
					//print_r($poliza);
					$json_data['detalle'] = $poliza['pp']['DETALLE'];
					$json_data['total'] = $poliza['adt']['TOTAL'];
					$json_data['iva'] = $poliza['0']['IVA'];
					$json_data['neto'] = $poliza['0']['NETO'];
					
					$array[$cont] = $json_data; 
					$cont++;
				}
				print_r(json_encode($array));									
				
				break;
			case 'ListaSumatoria':
			
				$arreglo_sumatoriapoliza = $listas_poliza->sumatoriaPoliza($_POST['cod_proyecto']);
					$json_data['total'] = 'TOTALES';
					$json_data['totales'] = $arreglo_sumatoriapoliza[0][0]['TOTAL'];
					$json_data['totaliva'] = $arreglo_sumatoriapoliza[0][0]['TOTALIVA'];
					$json_data['totalneto'] = $arreglo_sumatoriapoliza[0][0]['TOTALNETO'];
					print_r(json_encode($json_data));
				break;
			case 'Cabecera':
				//echo($_POST['cod_proyecto']);
				$cabecera = $listas_poliza->cabeceraPoliza($_POST['id_liquidacion'],$_POST['cod_proyecto']);
				//print_r($cabecera);
				
					$json_data['sidunea'] = $cabecera[0]['aat']['SIDUNEA'];
					$json_data['mercaderia'] = $cabecera[0]['aat']['MERCADERIA'];
					$json_data['bultos'] = $cabecera[0]['aat']['BULTOS'];
					$json_data['medidas'] = $cabecera[0][0]['Medida'];
					$json_data['peso'] = $cabecera[0]['aat']['PESO'];
					$json_data['pesos'] = $cabecera[0][0]['peso'];
					$json_data['factura'] = $cabecera[0]['aat']['alm_age_adu_tra_fac_comer'];
					$json_data['cif'] = $cabecera[0]['aat']['alm_age_adu_tra_val_cif'];
					$json_data['prov'] = $cabecera[0]['pro']['alm_prov_nombre'];
					$json_data['cod_adu'] = $cabecera[0]['aat']['alm_age_adu_tra_cod'];
					$json_data['agencia'] = $cabecera[0]['aat']['alm_age_adu_tra_id_age'];
					print_r(json_encode($json_data));
			break;

			case 'Cabecera1':
				//echo($_POST['cod_proyecto']);
				$cabecera = $listas_poliza->cabeceraPoliza1($_POST['cod_proyecto']);
				//print_r($cabecera);
				
					$json_data['sidunea'] = $cabecera[0]['aat']['SIDUNEA'];
					$json_data['mercaderia'] = $cabecera[0]['aat']['MERCADERIA'];
					$json_data['bultos'] = $cabecera[0]['aat']['BULTOS'];
					$json_data['medidas'] = $cabecera[0][0]['Medida'];
					$json_data['peso'] = $cabecera[0]['aat']['PESO'];
					$json_data['pesos'] = $cabecera[0][0]['peso'];
					$json_data['factura'] = $cabecera[0]['aat']['alm_age_adu_tra_fac_comer'];
					$json_data['cif'] = $cabecera[0]['aat']['alm_age_adu_tra_val_cif'];
					$json_data['prov'] = $cabecera[0]['aat']['alm_age_adu_tra_cod_prov'];
					$json_data['cod_adu'] = $cabecera[0]['aat']['alm_age_adu_tra_cod'];
					$json_data['agencia'] = $cabecera[0]['aat']['alm_age_adu_tra_id_age'];
					print_r(json_encode($json_data));
			break;


			case 'ListarLiquidacion': //Accion para listar el detalle de liquidacion
			//echo "aqui".$_POST['cod_proyecto'];
				$listado_poliza = $listas_poliza->listadoDetallePoliza($_GET['codigo_proyecto']);
				//print_r( $listado_poliza);
				$cont = 0;
				foreach($listado_poliza as $key => $value){
					//print_r($poliza);
					$json_data['alm_age_adu_tra_nro_fac'] = $value['adu']['alm_age_adu_tra_nro_fac'];
					$json_data['alm_age_adu_tra_merc'] = $value['adu']['alm_age_adu_tra_merc'];
					$json_data['alm_age_adu_tra_id'] = $value['adu']['alm_age_adu_tra_id'];
					$json_data['alm_age_adu_tra_cod'] = $value['adu']['alm_age_adu_tra_cod'];
					$json_data['alm_age_adu_tra_cod_proy'] = $value['adu']['alm_age_adu_tra_cod_proy'];
					$json_data['alm_prov_nombre'] = $value['pro']['alm_prov_nombre'];
					$json_data['codigo_proyecto'] = $_GET['codigo_proyecto'];
					$json_data['estado_proyecto'] = 12;
					
					
					$array[$cont] = $json_data; 
					$cont++;
				}
				print_r(json_encode($array));								
				
			break;
			case 'procesarLiquidacion': // Esto esto es la accion para procesar los certificados
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
$detalle_poliza = new DetalleLiquidacionRouter(); // Este es el router 
if($_SERVER['REQUEST_METHOD'] == "POST"){
	$accion = $_POST['accion'];
}elseif($_SERVER['REQUEST_METHOD'] == "GET"){
	$accion = $_GET['accion'];
}
$detalle_poliza->ejecutarAccion($accion);
?>