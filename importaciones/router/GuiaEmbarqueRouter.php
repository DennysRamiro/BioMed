<?php
session_start();
require_once '../clases/GuiaEmbarque.php';
require_once '../clases/Proyecto.php';
/**
 * Esta clase gestiona las acciones del contrato
 */
class GuiaEmbarqueRouter{
	/**
	 * Metodo que realiza el ejecutar la accion 
	 * @param $action esta es la accion
	 */
	public function ejecutarAccion($accion){
		switch($accion){
			case 'grabarNuevaGuiaEmbarque': // Esto esto es la accion para grabar la Guia de Contrato
				//echo("ROUTER");
				/*echo $_POST['numero_documento']."<br>";
				echo $_POST['codigo_proyecto']."<br>";
				echo $_POST['fec_doc']."<br>";
				echo $_POST['descripcion_guia']."<br>";
				echo $_POST['cert']."<br>";*/
				
				$guia_embarque = new GuiaEmbarque(); 
				$guia_embarque->grabarGuiaEmbarque($_POST['numero_documento'], $_POST['codigo_proyecto'],$_POST['fec_doc'],$_POST['descripcion_guia'], $_SESSION['login'], $_SESSION['fec_proc'], $_POST['cert']);
				
			break;

			case 'grabarNuevaGuiaEmbarquelista': // Esto esto es la accion para grabar la Guia de Contrato
				//echo("ROUTER");
				/*echo $_POST['numero_documento']."<br>";
				echo $_POST['codigo_proyecto']."<br>";
				echo $_POST['fec_doc']."<br>";
				echo $_POST['descripcion_guia']."<br>";
				echo $_POST['cert']."<br>";*/
				
				$guia_embarque = new GuiaEmbarque(); 
				$guia_embarque->grabarGuiaEmbarqueLista($_POST['numero_documento'], $_POST['codigo_proyecto'],$_POST['codigo_proveedor'],$_POST['fec_doc'],$_POST['descripcion_guia'], $_SESSION['login'], $_SESSION['fec_proc'], $_POST['cert']);
				
			break;

			case 'listaGuiaEmbarque': // Esto esto es la accion para grabar la Guia de Contrato
				//echo("ROUTER");
				//echo $_POST['codigo_proyecto'];
				$guia_embarque = new GuiaEmbarque(); 
				$lista_guia=$guia_embarque->listaGuiasCert($_GET['codigo_proyecto']);
				//print_r($lista_guia);
				$cont=0;
				foreach ($lista_guia as $key => $value) {
				$json_data['alm_nro_referencia_orden'] = $value['c']['alm_nro_referencia_orden'];
				$json_data['alm_prov_codigo'] = $value['c']['alm_prov_codigo'];
				$json_data['alm_prov_nombre'] = $value['p']['alm_prov_nombre'];
				$lista=$guia_embarque->ListarGe($_GET['codigo_proyecto'],$json_data['alm_prov_codigo']);
				//print_r($lista);
							//foreach ($lista as $key => $value) {
							 	if (empty($lista)) {
									$json_data['id'] = 0;
									$json_data['doc'] = 0;
									//$array[0] = $json_data; 
							
								} else{
									$json_data['id'] = 1;
									$json_data['doc'] = 1;
									foreach ($lista as $key => $value1) {
									$json_data['alm_form_id'] = $value1['i']['alm_form_id'];
									}
									
									//$array[0] = $json_data; 
								}	
				$json_data['codigo_proyecto'] = $_GET['codigo_proyecto'];
				$json_data['estado_proyecto'] = 8;
				$array[$cont] = $json_data;
				$cont++;
				}
				//print_r($array);
				print_r(json_encode($array));
		
			break;

			case 'consolidadoGuia':
			$guia_embarque = new GuiaEmbarque(); 
			$nro_prov=$guia_embarque->nroProveedor($_POST['codigo_proyecto']);
			$json_data['nro_prov'] = $nro_prov[0][0]['nro_prov'];
			//print_r($nro_prov);
			print_r(json_encode($json_data));
			break;

			 case 'DetallesGuiaEmbarque': // Esto esto es la accion para detallar un certificado
				//echo("ROUTER");
				//echo $_POST['numero_documento']."<br>";
				//echo $_POST['codigo_proyecto']."<br>";
				//echo $_POST['id_certificado']."<br>";
				//echo $_POST['descripcion_cert']."<br>";
				//$certificado = new Certificado(); 
			 	$guia_embarque = new GuiaEmbarque(); 
				$detalle_guia=$guia_embarque->detalleGuiaEmbarque($_POST['id_guia'], $_POST['codigo_proyecto'], $_POST['cod_prov']);
				//print_r($detalle_conf);
				$cont = 0;
				foreach ($detalle_guia as $key => $value) {
					$json_data['alm_form_id'] = $value['alm_form_importacion']['alm_form_id'];
					$json_data['alm_proy_cod'] = $value['alm_form_importacion']['alm_proy_cod'];
					$json_data['alm_prov_id'] = $value['alm_form_importacion']['alm_prov_id'];
					$json_data['alm_form_tipo'] = $value['alm_form_importacion']['alm_form_tipo'];
					$json_data['alm_form_nro_doc'] = $value['alm_form_importacion']['alm_form_nro_doc'];
					$json_data['alm_form_cert_otros'] = $value['alm_form_importacion']['alm_form_cert_otros'];
					$json_data['alm_form_fecha_doc'] = $guia_embarque->convertirNormal($value['alm_form_importacion']['alm_form_fecha_doc']);
					$json_data['alm_form_observaciones'] = $value['alm_form_importacion']['alm_form_observaciones'];
					//$json_data['alm_form_comision_cert'] = $value['alm_form_importacion']['alm_form_comision_cert'];
					$array[$cont]=$json_data;
					$cont++;
				}
				//print_r($array);
				print_r(json_encode($array));
			break;
			
			case 'ModificarGuiaEmbarque': // Esto es la accion para modificar un certificado
				/*echo("ROUTER");
				echo $_POST['accion']."<br>";
				echo $_POST['id_guia']."<br>";
				echo $_POST['numero_documento']."<br>";
				echo $_POST['codigo_proyecto']."<br>";
				echo $_POST['fec_doc']."<br>";
				echo $_POST['descripcion_guia']."<br>";
				echo $_POST['cert']."<br>";*/
				//$certificado = new Certificado()
				$guia_embarque = new GuiaEmbarque();  
				$guia_embarque->modificarDetalleGuiaEmbarque($_POST['id_guia'], $_POST['codigo_proyecto'],$_POST['cod_prov'],$_POST['numero_documento'],$_POST['fec_doc'],$_POST['descripcion_guia'],$_POST['cert'],$_SESSION['login'], $_SESSION['fec_proc']);
			break;

			case 'DarBajaGuiaEmbarque': // Esto esto es la accion para dar de baja certificado
				//echo("ROUTER");
				//echo $_POST['numero_documento']."<br>";
				//echo $_POST['codigo_proyecto']."<br>";
				//echo $_POST['id_certificado']."<br>";
				//echo $_POST['descripcion_cert']."<br>";
				//$certificado = new Certificado();
				$guia_embarque = new GuiaEmbarque();  
				$guia_embarque->darBajaGuiaEmbarque($_POST['id_guia'], $_POST['codigo_proyecto'], $_SESSION['login']);
			 break;

			case 'procesarGuiaEmbarque': // Esto esto es la accion para procesar los certificados
					//echo $_POST['estado_proyecto'];
					//echo $_POST['codigo_proyecto'];
					$proyecto = new Proyecto(); 
					
					if ($proyecto->actualizaEstadoProyecto($_POST['codigo_proyecto'], $_POST['estado_proyecto'])) {
						$json_data['completo']=true;

					}
						print_r(json_encode($json_data));
			break;
			
		}
	}
}
$guia_embarque_router = new GuiaEmbarqueRouter(); // Este es el router intanciado
if($_SERVER['REQUEST_METHOD'] == "POST"){
	$accion = $_POST['accion'];
}elseif($_SERVER['REQUEST_METHOD'] == "GET"){
	$accion = $_GET['accion'];
} 
$guia_embarque_router->ejecutarAccion($accion);
?>