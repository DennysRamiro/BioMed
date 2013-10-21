<?php
session_start();
require_once '../clases/Desaduanizacion.php';
require_once '../clases/GuiaEmbarque.php';
/**
 * Esta clase gestiona las acciones de desaduanizacion
 */
class DesaduanizacionRouter{
	/**
	 * Metodo que realiza el ejecutar la accion 
	 * @param $action esta es la accion
	 */
	public function ejecutarAccion($accion){
		switch($accion){
			case 'grabarDesaduanizacion': // Esto es la accion para grabar la desaduanizacion
				 $desaduanizacion = new Desaduanizacion();  
				$desaduanizacion->grabarNuevaDesanuanizacion($_POST['codigo_proyecto'],$_POST['codigos_dui'],$_POST['fec_doc_dui'], $_POST['obs_dui'],$_SESSION['login'], $_SESSION['fec_proc']);
			break;
			case 'grabarDesaduanizacionProv': // Esto es la accion para grabar la desaduanizacion
				 $desaduanizacion = new Desaduanizacion();  
				$desaduanizacion->grabarNuevaDesanuanizacionProv($_POST['codigo_proyecto'],$_POST['codigo_proveedor'],$_POST['codigos_dui'],$_POST['fec_doc_dui'], $_POST['obs_dui'],$_SESSION['login'], $_SESSION['fec_proc']);
			break;
			case 'procesarDesaduanizacion': // Esto esto es la accion para procesar los certificados
					//echo $_POST['estado_proyecto'];
					//echo $_POST['codigo_proyecto'];
					$proyecto = new Proyecto(); 
					
					if ($proyecto->actualizaEstadoProyecto($_POST['codigo_proyecto'], $_POST['estado_proyecto'])) {
						$json_data['completo']=true;

					}
						print_r(json_encode($json_data));
			break;
			case 'ListarDesaProveedor': // Esto es la accion para listar certificados
				//echo $_GET['accion']."<br>";
				//echo $_GET['codigo_proyecto']."<br>";
			    //$utilitarios = new Utilitarios();
				$desaduanizacion = new Desaduanizacion(); 
				$lista_desa_prov=$desaduanizacion->ListarDesaProveedor($_GET['codigo_proyecto']);
				//print_r($lista_cert_prov);
				$cont = 0;
				    foreach ($lista_desa_prov as $key => $value) {
						$json_data['alm_form_id'] = $value['i']['alm_form_id'];
						$json_data['alm_form_nro_doc'] = $value['i']['alm_form_nro_doc'];
						$json_data['alm_form_observaciones'] = $value['i']['alm_form_observaciones'];
						$json_data['alm_form_fecha_doc'] = $desaduanizacion->convertirNormal($value['i']['alm_form_fecha_doc']);
						$json_data['alm_proy_cod'] = $_GET['codigo_proyecto']; 
						$json_data['alm_prov_id'] = $value['i']['alm_prov_id'];
						$lista=$desaduanizacion->ListarDesaProv($_GET['codigo_proyecto'],$json_data['alm_prov_id']);
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
									$json_data['id_desa'] = $value1['i']['alm_form_id'];
									}
									
									//$array[0] = $json_data; 
								}
						$json_data['alm_prov_nombre'] = $value['p']['alm_prov_nombre'];
						$json_data['alm_form_tipo'] = 10;
						$array[$cont]=$json_data;
						$cont++;
				    }
				    print_r(json_encode($array));
			break;

			case 'consolidadoGuia':
			$guia_embarque = new GuiaEmbarque(); 
			$nro_prov=$guia_embarque->nroProveedor($_POST['codigo_proyecto']);
			$json_data['nro_prov'] = $nro_prov[0][0]['nro_prov'];
			//print_r($nro_prov);
			print_r(json_encode($json_data));
			break;

			case 'DetallesDesa': // Esto es la accion para listar certificados
				//echo("ROUTER");
				//echo $_POST['numero_documento']."<br>";
				//echo $_POST['codigo_proyecto']."<br>";
				//echo $_POST['id_certificado']."<br>";
				//echo $_POST['descripcion_cert']."<br>";
				$desaduanizacion = new Desaduanizacion(); 
				$detalle_desa=$desaduanizacion->DetallesDesa($_POST['id_desa'], $_POST['codigo_proyecto'],$_POST['cod_prov']);
				$cont = 0;
				foreach ($detalle_desa as $key => $value) {
					$json_data['alm_form_id'] = $value['alm_form_importacion']['alm_form_id'];
					$json_data['alm_proy_cod'] = $value['alm_form_importacion']['alm_proy_cod'];
					$json_data['alm_prov_id'] = $value['alm_form_importacion']['alm_prov_id'];
					$json_data['alm_form_tipo'] = $value['alm_form_importacion']['alm_form_tipo'];
					$json_data['alm_form_nro_doc'] = $value['alm_form_importacion']['alm_form_nro_doc'];
					$json_data['alm_form_fecha_doc'] = $desaduanizacion->convertirNormal($value['alm_form_importacion']['alm_form_fecha_doc']);
					$json_data['alm_form_observaciones'] = $value['alm_form_importacion']['alm_form_observaciones'];
					$array[$cont]=$json_data;
					$cont++;
				}
				print_r(json_encode($array));
			break;
			case 'ModificarDesaProv': // Esto es la accion para modificar un certificado
				//echo("ROUTER");
				//echo $_POST['accion']."<br>";
				/*echo $_POST['id_desa']."<br>";
				echo $_POST['numero_documento']."<br>";
				echo $_POST['codigo_proyecto']."<br>";
				echo $_POST['fec_doc']."<br>";
				echo $_POST['descripcion_desa']."<br>"; 
				echo $_POST['cod_prov']."<br>"; */
				$desaduanizacion = new Desaduanizacion();  
				$desaduanizacion->modificarDetalleDesaProv($_POST['id_desa'], $_POST['codigo_proyecto'],$_POST['cod_prov'],$_POST['numero_documento'],$_POST['fec_doc'],$_POST['descripcion_desa'], $_SESSION['login'], $_SESSION['fec_proc']);
				
			break;

			case 'DarBajaDesa': // Esto esto es la accion para dar de baja certificado
				//echo("ROUTER");
				//echo $_POST['numero_documento']."<br>";
				//echo $_POST['codigo_proyecto']."<br>";
				//echo $_POST['id_certificado']."<br>";
				//echo $_POST['descripcion_cert']."<br>";
				$desaduanizacion = new Desaduanizacion();   
				$desaduanizacion->darBajaDesa($_POST['id_desa'], $_POST['codigo_proyecto'], $_SESSION['login']);
			break;
			
		}
	}
}
$desaduanizacion_router = new DesaduanizacionRouter(); // Este es el router 
if($_SERVER['REQUEST_METHOD'] == "POST"){
	$accion = $_POST['accion'];
}elseif($_SERVER['REQUEST_METHOD'] == "GET"){
	$accion = $_GET['accion'];
}
$desaduanizacion_router->ejecutarAccion($accion );
?>