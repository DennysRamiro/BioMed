<?php
session_start();
require_once '../clases/Contrato.php';
require_once '../clases/Utilitarios.php';
require_once '../clases/Proyecto.php';
/**
 * Esta clase gestiona las acciones del contrato
 */
class ContratoRouter{
	/**
	 * Metodo que realiza el ejecutar la accion 
	 * @param $action esta es la accion
	 */
	public function ejecutarAccion($accion){
		$contrato = new Contrato();
		$util = new Utilitarios();
		switch($accion){
			
			case 'grabarNuevoContrato': // Esto esto es la accion para grabar el Contrato
				 
					$contrato->grabarContrato($_POST['numero_documnento'], $_POST['codigo_proyecto'],$_POST['fec_doc'],$_POST['descripcion_contrato'], $_SESSION['login'], $_SESSION['fec_proc']);
				break;
				
				case 'modificarContrato':
					//print_r($_POST['cod_proy']);
					//print_r($_POST['id_proy']);
					$lista_contratos = $contrato->listarContrato($_POST['cod_proy'], $_POST['id_proy']);
					
					$json_data['alm_proy_cod'] = $lista_contratos[0]['alm_form_importacion']['alm_proy_cod'];
					$json_data['alm_form_id'] = $lista_contratos[0]['alm_form_importacion']['alm_form_id'];
					$json_data['alm_form_nro_doc'] = $lista_contratos[0]['alm_form_importacion']['alm_form_nro_doc'];
					$json_data['alm_form_fecha_doc'] =  $util->cambiaf_a_normal($lista_contratos[0]['alm_form_importacion']['alm_form_fecha_doc']);
					$json_data['alm_form_observaciones'] = $lista_contratos[0]['alm_form_importacion']['alm_form_observaciones'];
					
					print_r(json_encode($json_data));
					//print_r($lista_contratos);
				break;
				
			case 'ActualizarContrato':
				$contrato->actualizarFormularioContrato($_POST['cod_proy_con'], $_POST['id_proy_con'], $_POST['num_doc_con'],$_POST['fecha_doc_con'],$_POST['obs_con'], $_SESSION['login'], $_SESSION['fec_proc']);
				//print_r($_POST['cod_proy'], $_POST['id_proy']);
			break;
			
			case 'bajaContrato':
			
			$contrato->actualizarFormularioContrato($_POST['codigo_proyecto'], $_POST['id_proyecto'], $_SESSION['login'], $_SESSION['fec_proc']);
			
			break;

			case 'procesarContrato': // Esto esto es la accion para procesar los certificados
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
$contrato_router = new ContratoRouter(); // Este es el router 
$contrato_router->ejecutarAccion($_POST['accion']);
?>