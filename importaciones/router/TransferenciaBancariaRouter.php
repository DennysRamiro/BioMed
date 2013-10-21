<?php
session_start();
require_once '../clases/TransferenciaBancaria.php';
require_once '../clases/Proyecto.php';



/**
 * Esta clase gestiona las acciones del transferencia Bancaria
 */
class TransferenciaBancariaRouter{
	/**
	 * Metodo que realiza el ejecutar la accion 
	 * @param $action esta es la accion
	 */
	public function ejecutarAccion($accion){
		 $transferencia_bancaria = new TransferenciaBancaria(); 
		switch($accion){
			
			case 'grabarTransferenciaBancaria': // Esto es la accion para grabar el transferencia Bancaria  
			
			//print_r($_POST['numero_unico_orden']);
				$transferencia_bancaria->grabarNuevaTransferenciaBancaria($_POST['codigos_proyectos'],$_POST['cta_bco'], $_POST['fec_trans_bco'],$_POST['nro_doc_trans_bco'],$_POST['obs_trans_bco'], $_POST['monto_trans_bco'],$_POST['comision_trans_bco'],$_POST['numero_unico_orden'],$_SESSION['login'], $_SESSION['fec_proc']);
				break;
			
			case 'grabarConfirmacionTransferenciaBancaria': // esto es la accion de la confirmacion de la transferencia bancaria
				$transferencia_bancaria->grabarConfirmacionTransferenciaBancaria($_POST['codigos_proyectos'],$_POST['codigos_proveedores'],$_POST['fec_conf_trans_bco'], $_POST['cod_conf_trans_bco'],$_POST['obs_conf_trans_bco'],$_SESSION['login'], $_SESSION['fec_proc']);
				break;
			case 'grabarCertificacionTransferenciaBancaria': // esto es la accion de la confirmacion de la transferencia bancaria
			  
				$transferencia_bancaria->grabarFormularioCertificacionTransferenciaBancaria($_POST['codigos_proyectos'],$_POST['codigos_proveedores'],$_POST['fec_cert_trans_bco'], $_POST['cod_cert_trans_bco'],$_POST['obs_cert_trans_bco'],$_POST['comis_cert_banc'],$_SESSION['login'], $_SESSION['fec_proc']);
				break;
				
				case 'ListarOrdenTransferencia':

					$lista_orden = $transferencia_bancaria->obtenerListaOrden($_POST['cod_proy']);
					$cont = 0;
					 foreach($lista_orden as $key =>$value){
						 //print_r($value);
						$json_data['alm_proy_cod'] = $value['ord']['alm_proy_cod'];
						 $json_data['alm_id_orden_compra'] = $value['ord']['alm_id_orden_compra'];
						 $json_data['alm_nro_referencia_orden'] = $value['ord']['alm_nro_referencia_orden'];
						 $json_data['alm_nro_proforma'] = $value['ord']['alm_nro_proforma'];
						 $json_data['alm_fecha_proforma'] = $value['ord']['alm_fecha_proforma'];
						 $json_data['alm_fecha_orden_registro'] = $value['ord']['alm_fecha_orden_registro'];
						 $json_data['alm_termino_pago'] = $value['ord']['alm_termino_pago'];
						 $json_data['alm_terms'] = $value['ord']['alm_terms'];
						 $json_data['alm_prov_codigo'] = $value['ord']['alm_prov_codigo'];
						 $lista=$transferencia_bancaria->ListarTranBan($_POST['cod_proy'],$json_data['alm_prov_codigo']);
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
						 $json_data['alm_prov_nombre'] = $value['p']['alm_prov_nombre'];
						  $json_data['alm_prov_cod_cta'] = $value['p']['alm_prov_cod_cta'];
						   $json_data['alm_proy_nom'] = $value['proy']['alm_proy_nom'];
						   $json_data['alm_id_unico_orden_compra'] = $value['ord']['alm_id_unico_orden_compra'];
						 $array[$cont] = $json_data;
						 $cont++;
						 
					 }
					//print_r($array);
					print_r(json_encode($array));
				break;
				
				case 'BuscaOrden':
					
					//echo $_POST['orden_unico'];
					//echo $_POST['cod_proy'];
					$orden_unica = $transferencia_bancaria->recuperaOrdenUnica($_POST['orden_unico'],$_POST['cod_proy']);
					//print_r($orden_unica);
					$json_data['valor'] = $orden_unica[0]['alm_form_importacion']['alm_prov_id'];
					print_r(json_encode($json_data));
					
				break;

				case 'ListarCertificadosBancarios': // Esto es la accion para listar certificados
				//echo $_GET['accion']."<br>";
				//echo $_GET['codigo_proyecto']."<br>";
			    //$utilitarios = new Utilitarios();
				//$certificado = new Certificado(); 
				$lista_cert=$transferencia_bancaria->ListarCertificadoBancario($_GET['codigo_proyecto']);
				
				//echo $lista_cert;
				//print_r($lista_cert);
					$cont = 0;
				    foreach ($lista_cert as $key => $value) {
						$json_data['alm_form_id'] = $value['i']['alm_form_id'];
						$json_data['alm_form_nro_doc'] = $value['i']['alm_form_nro_doc'];
						$json_data['alm_form_observaciones'] = $value['i']['alm_form_observaciones'];
						$json_data['alm_form_fecha_doc'] = $transferencia_bancaria->convertirNormal($value['i']['alm_form_fecha_doc']);
						$json_data['alm_proy_cod'] = $_GET['codigo_proyecto'];
						$json_data['alm_prov_id'] = $value['i']['alm_prov_id'];
						$lista=$transferencia_bancaria->ListarCertBan($_GET['codigo_proyecto'],$json_data['alm_prov_id']);
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
							 //}  
						$json_data['alm_form_tipo'] = 6;
						$json_data['alm_form_monto_transf'] = $value['i']['alm_form_monto_transf'];
						$json_data['alm_prov_codigo_int'] = $value['p']['alm_prov_codigo_int'];
						$json_data['alm_prov_nombre'] = $value['p']['alm_prov_nombre'];
						$array[$cont]=$json_data;
						$cont++; 
				    }
				    //print_r($array);
					print_r(json_encode($array));
		
			    break;

			    case 'ListarCert': // Esto es la accion para listar certificados
				//echo $_GET['accion']."<br>";
				//echo $_GET['codigo_proyecto']."<br>";
			    //$utilitarios = new Utilitarios();
				//$certificado = new Certificado(); 
				$lista=$transferencia_bancaria->ListarCertBan($_GET['codigo_proyecto'],$_GET['codigo_proveedor']);
				//echo $lista_cert;
				//print_r($lista_cert);
					$cont = 0;
					if (empty($lista)) {
						$json_data['id'] = 0;
						$json_data['doc'] = 0;
						$array[0] = $json_data; 
						
					} else{
						$json_data['id'] = 1;
						$json_data['doc'] = 1;
						$array[0] = $json_data; 
					}
					print_r(json_encode($array));
		
			    break;
			    case 'ListarConfirmaciones': // Esto es la accion para listar certificados
				//echo $_GET['accion']."<br>";
				//echo $_GET['codigo_proyecto']."<br>";
			    //$utilitarios = new Utilitarios();
				//$certificado = new Certificado(); 
				$lista_con=$transferencia_bancaria->ListarConfirmacionBancaria($_GET['codigo_proyecto']);
				//$proyecto = new Proyecto(); 
			    //$lista_prov=$proyecto->obtenerProveedorOrden($_GET['codigo_proyecto']);
				//print_r($lista_prov);
				$cont = 0;
					
				    foreach ($lista_con as $key => $value) {
						$json_data['alm_form_id'] = $value['i']['alm_form_id'];
						$json_data['alm_form_nro_doc'] = $value['i']['alm_form_nro_doc'];
						$json_data['alm_form_observaciones'] = $value['i']['alm_form_observaciones'];
						$json_data['alm_form_fecha_doc'] = $transferencia_bancaria->convertirNormal($value['i']['alm_form_fecha_doc']);
						$json_data['alm_proy_cod'] = $_GET['codigo_proyecto']; 
						$json_data['alm_prov_id'] = $value['i']['alm_prov_id'];
						$lista=$transferencia_bancaria->ListarConfBan($_GET['codigo_proyecto'],$json_data['alm_prov_id']); 
							if (empty($lista)) {
								$json_data['id'] = 0;
								$json_data['doc'] = 0;
							
							} else{
								$json_data['id'] = 1;
								$json_data['doc'] = 1;
							}
						$json_data['alm_form_tipo'] = 7;
						$json_data['alm_form_monto_transf'] = $value['i']['alm_form_monto_transf'];
						$json_data['alm_prov_codigo_int'] = $value['p']['alm_prov_codigo_int'];
						$json_data['alm_prov_nombre'] = $value['p']['alm_prov_nombre'];
						$array[$cont]=$json_data;
						$cont++;
				    }
					print_r(json_encode($array));
		
			    break;

			    case 'ListarProveedores':
			    $proyecto = new Proyecto(); 
			    $lista_prov=$proyecto->obtenerProveedorOrden($_GET['codigo_proyecto']);
			    $cont = 0;
			    foreach ($lista_prov as $key => $value) {
			    	$json_data['alm_proy_cod'] = $value['c']['alm_proy_cod'];
			    	$json_data['alm_prov_codigo_int'] = $value['p']['alm_prov_codigo_int'];
			    	$json_data['alm_prov_nombre'] = $value['p']['alm_prov_nombre'];
			    	$array[$cont]=$json_data;
					$cont++;
			    }
			    print_r(json_encode($array));
			    break;

			    case 'DetallesCertificadosBancarios': // Esto esto es la accion para detallar un certificado
				//echo("ROUTER");
				//echo $_POST['numero_documento']."<br>";
				//echo $_POST['codigo_proyecto']."<br>";
				//echo $_POST['id_certificado']."<br>";
				//echo $_POST['descripcion_cert']."<br>";
				//$certificado = new Certificado(); 
				$detalle_cert=$transferencia_bancaria->detalleCertificadoBancario($_POST['id_certificado'], $_POST['codigo_proyecto'], $_POST['cod_prov']);
				//print_r($detalle_cert);
				$cont = 0;
				foreach ($detalle_cert as $key => $value) {
					$json_data['alm_form_id'] = $value['alm_form_importacion']['alm_form_id'];
					$json_data['alm_proy_cod'] = $value['alm_form_importacion']['alm_proy_cod'];
					$json_data['alm_prov_id'] = $value['alm_form_importacion']['alm_prov_id'];
					$json_data['alm_form_tipo'] = $value['alm_form_importacion']['alm_form_tipo'];
					$json_data['alm_form_nro_doc'] = $value['alm_form_importacion']['alm_form_nro_doc'];
					$json_data['alm_form_fecha_doc'] = $transferencia_bancaria->convertirNormal($value['alm_form_importacion']['alm_form_fecha_doc']);
					$json_data['alm_form_observaciones'] = $value['alm_form_importacion']['alm_form_observaciones'];
					$json_data['alm_form_comision_cert'] = $value['alm_form_importacion']['alm_form_comision_cert'];
					$array[$cont]=$json_data;
					$cont++;
				}
				print_r(json_encode($array));
			    break;

			     case 'DetallesConfirmacionBancaria': // Esto esto es la accion para detallar un certificado
				//echo("ROUTER");
				//echo $_POST['numero_documento']."<br>";
				//echo $_POST['codigo_proyecto']."<br>";
				//echo $_POST['id_certificado']."<br>";
				//echo $_POST['descripcion_cert']."<br>";
				//$certificado = new Certificado(); 
				$detalle_conf=$transferencia_bancaria->detalleConfirmacionBancaria($_POST['id_confirmacion'], $_POST['codigo_proyecto'], $_POST['cod_prov']);
				//print_r($detalle_conf);
				$cont = 0;
				foreach ($detalle_conf as $key => $value) {
					$json_data['alm_form_id'] = $value['alm_form_importacion']['alm_form_id'];
					$json_data['alm_proy_cod'] = $value['alm_form_importacion']['alm_proy_cod'];
					$json_data['alm_prov_id'] = $value['alm_form_importacion']['alm_prov_id'];
					$json_data['alm_form_tipo'] = $value['alm_form_importacion']['alm_form_tipo'];
					$json_data['alm_form_nro_doc'] = $value['alm_form_importacion']['alm_form_nro_doc'];
					$json_data['alm_form_fecha_doc'] = $transferencia_bancaria->convertirNormal($value['alm_form_importacion']['alm_form_fecha_doc']);
					$json_data['alm_form_observaciones'] = $value['alm_form_importacion']['alm_form_observaciones'];
					//$json_data['alm_form_comision_cert'] = $value['alm_form_importacion']['alm_form_comision_cert'];
					$array[$cont]=$json_data;
					$cont++;
				}
				print_r(json_encode($array));
			    break;


			    case 'ModificarCertificadoBancario': // Esto es la accion para modificar un certificado
				/*echo("ROUTER");
				echo $_POST['accion']."<br>";
				echo $_POST['id_certificado']."<br>";
				echo $_POST['numero_documento']."<br>";
				echo $_POST['codigo_proyecto']."<br>";
				echo $_POST['fec_doc']."<br>";
				echo $_POST['descripcion_cert']."<br>";*/ 
				//$certificado = new Certificado(); 
				$transferencia_bancaria->modificarDetalleCertificadoBancario($_POST['id_certificado'], $_POST['codigo_proyecto'], $_POST['cod_prov'],$_POST['numero_documento'],$_POST['fec_doc'],$_POST['descripcion_cert'], $_POST['comis_cert_otros_det'], $_SESSION['login'], $_SESSION['fec_proc']);
				
			    break;

			     case 'ModificarConfirmacionBancaria': // Esto es la accion para modificar un certificado
				/*echo("ROUTER");
				echo $_POST['accion']."<br>";
				echo $_POST['id_confirmacion']."<br>";
				echo $_POST['numero_documento']."<br>";
				echo $_POST['codigo_proyecto']."<br>";
				echo $_POST['fec_doc']."<br>";
				echo $_POST['descripcion_cert']."<br>";*/
				//$certificado = new Certificado(); 
				$transferencia_bancaria->modificarDetalleConfirmacionBancaria($_POST['id_confirmacion'], $_POST['codigo_proyecto'],$_POST['cod_prov'],$_POST['numero_documento'],$_POST['fec_doc'],$_POST['descripcion_cert'], $_SESSION['login'], $_SESSION['fec_proc']);
				
			    break;

			    case 'DarBajaCertificadosBancarios': // Esto esto es la accion para dar de baja certificado
				//echo("ROUTER");
				//echo $_POST['numero_documento']."<br>";
				//echo $_POST['codigo_proyecto']."<br>";
				//echo $_POST['id_certificado']."<br>";
				//echo $_POST['descripcion_cert']."<br>";
				//$certificado = new Certificado(); 
				$transferencia_bancaria->darBajaCertificadoBancario($_POST['id_certificado'], $_POST['codigo_proyecto'], $_SESSION['login']);
			    break;

			    case 'DarBajaConfirmacionesBancarias': // Esto esto es la accion para dar de baja certificado
				//echo("ROUTER");
				//echo $_POST['numero_documento']."<br>";
				//echo $_POST['codigo_proyecto']."<br>";
				//echo $_POST['id_certificado']."<br>";
				//echo $_POST['descripcion_cert']."<br>";
				//$certificado = new Certificado(); 
				$transferencia_bancaria->darBajaConfirmacionBancaria($_POST['id_confirmacion'], $_POST['codigo_proyecto'], $_SESSION['login']);
			    break;


			    case 'procesarCertificadoBancario': // Esto esto es la accion para procesar los certificados
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

			     case 'procesarConfirmacionBancaria': // Esto esto es la accion para procesar los certificados
					$proyecto = new Proyecto(); 
					
					if ($proyecto->actualizaEstadoProyecto($_POST['codigo_proyecto'], $_POST['estado_proyecto'])) {
						$json_data['completo']=true;

					}
						print_r(json_encode($json_data));
			    break;
				
				case 'buscartransferencia':
				
					//echo $_POST['cod']."--".$_POST['cod_prov'];
					$var=$transferencia_bancaria->buscatransferencias($_POST['cod'],$_POST['cod_prov']);
					//print_r($var);
					$json_data['valor']=$var[0]['alm_form_importacion']['alm_prov_id'];
					print_r(json_encode($json_data));
				break;
				
			
		}
	}
}
$trans_banc_router = new TransferenciaBancariaRouter(); // Este es el router 
if($_SERVER['REQUEST_METHOD'] == "POST"){
	$accion = $_POST['accion'];
}elseif($_SERVER['REQUEST_METHOD'] == "GET"){
	$accion = $_GET['accion'];
} 
$trans_banc_router->ejecutarAccion($accion);
?>