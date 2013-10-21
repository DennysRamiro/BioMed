<?php
session_start();
require_once '../clases/Certificado.php';
require_once '../clases/GuiaEmbarque.php';
require_once '../clases/Proyecto.php';
/**
 * Esta clase gestiona las acciones del certificado
 */
class CertificadoRouter{
	/**
	 * Metodo que realiza el ejecutar la accion 
	 * @param $action esta es la accion
	 */
	public function ejecutarAccion($accion){
		switch($accion){
			case 'grabarNuevoCertificado': // Esto es la accion para crear nuevo certificado
				//echo("ROUTER");
				//echo $_POST['numero_documento']."<br>";
				//echo $_POST['codigo_proyecto']."<br>";
				//echo $_POST['fec_doc']."<br>";
				//echo $_POST['descripcion_cert']."<br>";
				$certificado = new Certificado(); 
				$certificado->grabarCertificado($_POST['numero_documento'], $_POST['codigo_proyecto'],$_POST['fec_doc'],$_POST['descripcion_cert'],$_POST['comis_cert_otros'], $_SESSION['login'], $_SESSION['fec_proc']);
				
			break;

			case 'grabarNuevoCertificadoProv': // Esto es la accion para crear nuevo certificado
				//echo("ROUTER");
				/*echo $_POST['numero_documento']."<br>";
				echo $_POST['codigo_proyecto']."<br>";
				echo $_POST['codigo_proveedor']."<br>";
				echo $_POST['fec_doc']."<br>";
				echo $_POST['descripcion_cert']."<br>";
				echo $_POST['comis_cert_otros']."<br>";*/
				$certificado = new Certificado(); 
				$certificado->grabarCertificadoProv($_POST['numero_documento'], $_POST['codigo_proyecto'],$_POST['codigo_proveedor'],$_POST['fec_doc'],$_POST['descripcion_cert'],$_POST['comis_cert_otros'], $_SESSION['login'], $_SESSION['fec_proc']);
				
			break;

			case 'ModificarCertificado': // Esto es la accion para modificar un certificado
				//echo("ROUTER");
				//echo $_POST['accion']."<br>";
				/*echo $_POST['id_certificado']."<br>";
				echo $_POST['numero_documento']."<br>";
				echo $_POST['codigo_proyecto']."<br>";
				echo $_POST['fec_doc']."<br>";
				echo $_POST['descripcion_cert']."<br>"; 
				echo $_POST['comis_cert_otros_det']."<br>"; */
				$certificado = new Certificado(); 
				$certificado->modificarDetalleCertificado($_POST['id_certificado'], $_POST['codigo_proyecto'],$_POST['numero_documento'],$_POST['fec_doc'],$_POST['descripcion_cert'], $_POST['comis_cert_otros_det'], $_SESSION['login'], $_SESSION['fec_proc']);
				
			break;

			case 'ModificarCertificadoProv': // Esto es la accion para modificar un certificado
				//echo("ROUTER");
				//echo $_POST['accion']."<br>";
				/*echo $_POST['id_certificado']."<br>";
				echo $_POST['numero_documento']."<br>";
				echo $_POST['codigo_proyecto']."<br>";
				echo $_POST['fec_doc']."<br>";
				echo $_POST['descripcion_cert']."<br>"; 
				echo $_POST['comis_cert_otros_det']."<br>"; */
				$certificado = new Certificado(); 
				$certificado->modificarDetalleCertificadoProv($_POST['id_certificado'], $_POST['codigo_proyecto'],$_POST['cod_prov'],$_POST['numero_documento'],$_POST['fec_doc'],$_POST['descripcion_cert'], $_POST['comis_cert_otros_det'], $_SESSION['login'], $_SESSION['fec_proc']);
				
			break;


			case 'ListarCertificados': // Esto es la accion para listar certificados
				//echo $_GET['accion']."<br>";
				//echo $_GET['codigo_proyecto']."<br>";
			    //$utilitarios = new Utilitarios();
				$certificado = new Certificado(); 
				$guia_embarque = new GuiaEmbarque(); 
				$lista_cert=$certificado->ListarCertificado($_GET['codigo_proyecto']);
			    $nro_prov=$guia_embarque->nroProveedor($_GET['codigo_proyecto']);
			   
				//print_r($lista_cert);
				if (empty($lista_cert)) {
					//echo "VACIO";				
					    $json_data['alm_form_id'] = '';
						$json_data['alm_form_nro_doc'] = '';
						$json_data['alm_form_observaciones'] = '';
						$json_data['alm_form_fecha_doc'] = '';
						$json_data['alm_form_comision_cert'] ='';
						$json_data['alm_proy_cod'] = $_GET['codigo_proyecto']; 
						//$json_data['alm_proy_id'] = $_GET['id_proyecto']; 
						$json_data['alm_form_tipo'] = 9;
						$json_data['nro_prov'] = $nro_prov[0][0]['nro_prov']; 
						$array[0] = $json_data;     
				    print_r(json_encode($array));
				} else{
					//echo "NO VACIO";
					$cont = 0;
				    foreach ($lista_cert as $key => $value) {
						$json_data['alm_form_id'] = $value['alm_form_importacion']['alm_form_id'];
						$json_data['alm_form_nro_doc'] = $value['alm_form_importacion']['alm_form_nro_doc'];
						$json_data['alm_form_observaciones'] = $value['alm_form_importacion']['alm_form_observaciones'];
						$json_data['alm_form_fecha_doc'] = $certificado->convertirNormal($value['alm_form_importacion']['alm_form_fecha_doc']);
						$json_data['alm_proy_cod'] = $_GET['codigo_proyecto']; 
						//$json_data['alm_proy_id'] = $_GET['id_proyecto']; 
						$json_data['alm_form_tipo'] = $value['alm_form_importacion']['alm_form_tipo'];
						$json_data['alm_form_comision_cert'] = $value['alm_form_importacion']['alm_form_comision_cert'];
						$json_data['nro_prov'] = $nro_prov[0][0]['nro_prov'];
						$array[$cont]=$json_data;
						$cont++;
				    }
					print_r(json_encode($array));

				}
		
			break;

			case 'ListarCertificadosProveedor': // Esto es la accion para listar certificados
				//echo $_GET['accion']."<br>";
				//echo $_GET['codigo_proyecto']."<br>";
			    //$utilitarios = new Utilitarios();
				$certificado = new Certificado(); 
				$lista_cert_prov=$certificado->ListarCertificadosProveedor($_GET['codigo_proyecto']);
				//print_r($lista_cert_prov);
				$cont = 0;
				    foreach ($lista_cert_prov as $key => $value) {
						$json_data['alm_form_id'] = $value['i']['alm_form_id'];
						$json_data['alm_form_nro_doc'] = $value['i']['alm_form_nro_doc'];
						$json_data['alm_form_observaciones'] = $value['i']['alm_form_observaciones'];
						$json_data['alm_form_fecha_doc'] = $certificado->convertirNormal($value['i']['alm_form_fecha_doc']);
						$json_data['alm_proy_cod'] = $_GET['codigo_proyecto']; 
						$json_data['alm_prov_id'] = $value['i']['alm_prov_id'];
						$json_data['alm_form_cert_otros'] = $value['i']['alm_form_cert_otros'];
						$lista=$certificado->ListarCertProv($_GET['codigo_proyecto'],$json_data['alm_prov_id']);
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
									$json_data['id_certificado'] = $value1['i']['alm_form_id'];
									}
									
									//$array[0] = $json_data; 
								}
						$json_data['alm_prov_nombre'] = $value['p']['alm_prov_nombre'];
						$json_data['alm_form_tipo'] = 9;
						$array[$cont]=$json_data;
						$cont++;
				    }
				    //print_r($array);
				    print_r(json_encode($array));
			break;

		    case 'DetallesCertificados': // Esto esto es la accion para detallar un certificado
				//echo("ROUTER");
				//echo $_POST['numero_documento']."<br>";
				//echo $_POST['codigo_proyecto']."<br>";
				//echo $_POST['id_certificado']."<br>";
				//echo $_POST['descripcion_cert']."<br>";
				$certificado = new Certificado(); 
				$detalle_cert=$certificado->detalleCertificado($_POST['id_certificado'], $_POST['codigo_proyecto']);
				$cont = 0;
				foreach ($detalle_cert as $key => $value) {
					$json_data['alm_form_id'] = $value['alm_form_importacion']['alm_form_id'];
					$json_data['alm_proy_cod'] = $value['alm_form_importacion']['alm_proy_cod'];
					$json_data['alm_form_tipo'] = $value['alm_form_importacion']['alm_form_tipo'];
					$json_data['alm_form_nro_doc'] = $value['alm_form_importacion']['alm_form_nro_doc'];
					$json_data['alm_form_fecha_doc'] = $certificado->convertirNormal($value['alm_form_importacion']['alm_form_fecha_doc']);
					$json_data['alm_form_observaciones'] = $value['alm_form_importacion']['alm_form_observaciones'];
					$json_data['alm_form_comision_cert'] = $value['alm_form_importacion']['alm_form_comision_cert'];
					$array[$cont]=$json_data;
					$cont++;
				}
				print_r(json_encode($array));
			break;

			case 'DetallesCertificadosProv': // Esto esto es la accion para detallar un certificado
				//echo("ROUTER");
				//echo $_POST['numero_documento']."<br>";
				//echo $_POST['codigo_proyecto']."<br>";
				//echo $_POST['id_certificado']."<br>";
				//echo $_POST['descripcion_cert']."<br>";
				$certificado = new Certificado(); 
				$detalle_cert=$certificado->detalleCertificadoProv($_POST['id_certificado'], $_POST['codigo_proyecto'],$_POST['cod_prov']);
				$cont = 0;
				foreach ($detalle_cert as $key => $value) {
					$json_data['alm_form_id'] = $value['alm_form_importacion']['alm_form_id'];
					$json_data['alm_proy_cod'] = $value['alm_form_importacion']['alm_proy_cod'];
					$json_data['alm_prov_id'] = $value['alm_form_importacion']['alm_prov_id'];
					$json_data['alm_form_tipo'] = $value['alm_form_importacion']['alm_form_tipo'];
					$json_data['alm_form_nro_doc'] = $value['alm_form_importacion']['alm_form_nro_doc'];
					$json_data['alm_form_fecha_doc'] = $certificado->convertirNormal($value['alm_form_importacion']['alm_form_fecha_doc']);
					$json_data['alm_form_observaciones'] = $value['alm_form_importacion']['alm_form_observaciones'];
					$json_data['alm_form_comision_cert'] = $value['alm_form_importacion']['alm_form_comision_cert'];
					$array[$cont]=$json_data;
					$cont++;
				}
				print_r(json_encode($array));
			break;

			case 'DarBajaCertificados': // Esto esto es la accion para dar de baja certificado
				//echo("ROUTER");
				//echo $_POST['numero_documento']."<br>";
				//echo $_POST['codigo_proyecto']."<br>";
				//echo $_POST['id_certificado']."<br>";
				//echo $_POST['descripcion_cert']."<br>";
				$certificado = new Certificado(); 
				$certificado->darBajaCertificado($_POST['id_certificado'], $_POST['codigo_proyecto'], $_SESSION['login']);
			break;

			case 'DarBajaCertificadosLista': // Esto esto es la accion para dar de baja certificado
				//echo("ROUTER");
				//echo $_POST['numero_documento']."<br>";
				//echo $_POST['codigo_proyecto']."<br>";
				//echo $_POST['id_certificado']."<br>";
				//echo $_POST['descripcion_cert']."<br>";
				$certificado = new Certificado(); 
				$certificado->darBajaCertificadoLista($_POST['id_certificado'], $_POST['codigo_proyecto'], $_SESSION['login']);
			break;

			case 'procesarCertificado': // Esto esto es la accion para procesar los certificados
					//echo("ROUTER");
					//
					//echo $_POST['codigo_proyecto']."<br>";
					//echo $_POST['estado_proyecto']."<br>";
					$proyecto = new Proyecto();
					$certificado = new Certificado(); 
					$lista_cert=$certificado->ListarCertificado($_POST['codigo_proyecto']);
					//print_r($lista_cert);
					if (empty($lista_cert)) {
						//echo("vacio");
						$json_data['completo']=false;
							
					} else{
						//echo("lleno");
						if ($proyecto->actualizaEstadoProyecto($_POST['codigo_proyecto'], $_POST['estado_proyecto'])) {
					    $json_data['completo']=true;

						}	
						
					}
					print_r(json_encode($json_data));
			break;

			case 'procesarCertificadoProv': // Esto esto es la accion para procesar los certificados
					//echo("ROUTER");
					//
					//echo $_POST['codigo_proyecto']."<br>";
					//echo $_POST['estado_proyecto']."<br>";
					$proyecto = new Proyecto();
					//$certificado = new Certificado(); 
					//$lista_cert=$certificado->ListarCertificado($_POST['codigo_proyecto']);
					//print_r($lista_cert);
						//echo("lleno");
						if ($proyecto->actualizaEstadoProyecto($_POST['codigo_proyecto'], $_POST['estado_proyecto'])) {
					    $json_data['completo']=true;

						}	
					print_r(json_encode($json_data));
			break;
			
		}
	}
}
$certificado_router = new CertificadoRouter(); // Este es el router intanciado
if($_SERVER['REQUEST_METHOD'] == "POST"){
	$accion = $_POST['accion'];
}elseif($_SERVER['REQUEST_METHOD'] == "GET"){
	$accion = $_GET['accion'];
} 
$certificado_router->ejecutarAccion($accion);
?>