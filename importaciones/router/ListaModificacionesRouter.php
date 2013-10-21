<?php
session_start();
require_once '../clases/ListaModificaciones.php';
require_once '../clases/Proyecto.php';
/**
 * Esta clase gestiona las acciones del contrato
 */
class ListaModificacionesRouter{
	/**
	 * Metodo que realiza el ejecutar la accion 
	 * @param $action esta es la accion
	 */
	public function ejecutarAccion($accion){
		$proyecto = new Proyecto();
		switch($accion){
			case 'listarProyectosModificados': // Esto esto es la accion para grabar el Contrato
					//print_r ($_POST['cod_proy']);
				$lista_mod_proyec=$proyecto->ListaModificarProyectos($_POST['cod_proy']);
				//print_r($lista_mod_proyec);
				//print_r($lista_mod_proyec);
				$cont = 0;
				foreach ($lista_mod_proyec as $key => $list_mod) {
					//print_r($list_mod);
					$json_data['id_proy'] = $list_mod['i']['alm_form_id'];
					$json_data['nom_proy'] = $list_mod['p']['alm_proy_nom'];
					$json_data['cod_proy'] = $list_mod['p']['alm_proy_cod'];
					$json_data['fec_reg_proy'] = $proyecto->convertirNormal($list_mod['i']['alm_form_fecha_registro']);
					$json_data['tipo'] = $list_mod['i']['alm_form_tipo'];
					$json_data['tipo_nombre'] = $list_mod['pp']['GRAL_PAR_PRO_DESC'];
					$json_data['fec_inicio_proy'] = $proyecto->convertirNormal($list_mod['p']['alm_proy_fecha_inicio']);
					$json_data['fec_fin_proy'] = $proyecto->convertirNormal($list_mod['p']['alm_proy_fecha_fin']);
					$json_data['cod_proye'] = $_POST['cod_proy']; 
					$json_data['obser_proy'] = $list_mod['i']['alm_form_observaciones'];
					$array_data[$cont]=$json_data;
					$cont++;
				}
				print_r(json_encode($array_data));				
				break;
				
				
			
		}
	}
}
$lista_modificaciones_router = new ListaModificacionesRouter(); // Este es el router 
if($_SERVER['REQUEST_METHOD'] == "POST"){
	$accion = $_POST['accion'];
}elseif($_SERVER['REQUEST_METHOD'] == "GET"){
	$accion = $_GET['accion'];
} 
$lista_modificaciones_router->ejecutarAccion($_POST['accion']);
?>