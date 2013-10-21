<?php
session_start();
require_once '../clases/Proyecto.php';
/**
 * Esta clase gestiona las acciones del proyecto
 */
class ProyectoRouter{
	/**
	 * Metodo que realiza el ejecutar la accion 
	 * @param $action esta es la accion
	 */
	public function ejecutarAccion($accion){
		$proyecto = new Proyecto(); 
		switch($accion){
			case 'grabarNuevoProyecto': // Esto esto es la accion para grabar el proyecto
				
				$proyecto->grabarProyecto($_POST['nombre_proyecto'], $_POST['tipo_proyecto'],$_POST['fec_ini'],$_POST['fec_fin'],$_POST['descripcion_proyecto'], $_SESSION['login']);
				break;
			case 'listarProyectos':
				$lista_proy = $proyecto->listaProyectos();
				$cont = 0;
				foreach($lista_proy  as $key => $value){
					
					$json_data['alm_proy_id'] = $value['alm_proyecto']['alm_proy_id'];
					$json_data['alm_proy_cod'] = $value['alm_proyecto']['alm_proy_cod'];
					$json_data['alm_proy_nom'] = $value['alm_proyecto']['alm_proy_nom'];
					$json_data['alm_proy_fecha_inicio'] = $proyecto->convertirNormal($value['alm_proyecto']['alm_proy_fecha_inicio']);
					$json_data['alm_proy_fecha_fin'] = $proyecto->convertirNormal($value['alm_proyecto']['alm_proy_fecha_fin']);
					$tipo = $proyecto->obtenerTipo($value['alm_proyecto']['alm_proy_tipo']);
					$json_data['alm_proy_tipo'] = $tipo[0]['gral_param_propios']['GRAL_PAR_PRO_DESC'];  
					$estado = $proyecto->obtenerEstado($value['alm_proyecto']['alm_proy_estado']);
					$json_data['alm_proy_estado'] = $estado[0]['gral_param_propios']['GRAL_PAR_PRO_DESC']; 
					$json_data['alm_proy_cod_estado'] = $value['alm_proyecto']['alm_proy_estado']; 
					$array[$cont] = $json_data; 
					$cont++;
				}
				print_r(json_encode($array));
				break;
			case 'buscarProyectos':
				 $list_bus = $proyecto->listarBusquedaProyectos($_GET['proyecto_buscar']);
				 $cont = 0;
				 foreach($list_bus as $key =>$value){
					$json_data['id']    = $value['p']['alm_proy_id'];
					$json_data['label'] = $value['p']['alm_proy_cod']." ".$value['p']['alm_proy_nom']." ".$value['t']['GRAL_PAR_PRO_DESC']." ".$value['e']['GRAL_PAR_PRO_DESC'];
					$json_data['value'] = $value['p']['alm_proy_cod']." ".$value['p']['alm_proy_nom'];
					$json_data['value'] = $value['p']['alm_proy_cod']." ".$value['p']['alm_proy_nom'];
					$array[$cont] = $json_data; 
					$cont++;
				 }
				 print_r(json_encode($array));
			     break;
				 
			case 'proyectoSeleccionado':
                $proyecto_seleccionado  = $proyecto->seleccionarProyecto($_GET['id_proyecto'], $_GET['codigo_proyecto']);
				$json_data['alm_proy_id'] = $proyecto_seleccionado[0]['alm_proyecto']['alm_proy_id'];
				$json_data['alm_proy_cod'] = $proyecto_seleccionado[0]['alm_proyecto']['alm_proy_cod'];
				$json_data['alm_proy_nom'] = $proyecto_seleccionado[0]['alm_proyecto']['alm_proy_nom'];
				$json_data['estado_proyeto'] = $proyecto_seleccionado[0]['alm_proyecto']['alm_proy_estado'];
				$json_data['alm_proy_fecha_inicio'] = $proyecto->convertirNormal($proyecto_seleccionado[0]['alm_proyecto']['alm_proy_fecha_inicio']);
				$json_data['alm_proy_fecha_fin'] = $proyecto->convertirNormal($proyecto_seleccionado[0]['alm_proyecto']['alm_proy_fecha_fin']);
				$tipo = $proyecto->obtenerTipo($proyecto_seleccionado[0]['alm_proyecto']['alm_proy_tipo']);
				$json_data['alm_proy_tipo'] = $tipo[0]['gral_param_propios']['GRAL_PAR_PRO_DESC'];
				$estado = $proyecto->obtenerEstado($proyecto_seleccionado[0]['alm_proyecto']['alm_proy_estado']);
				$json_data['alm_proy_estado'] = $estado[0]['gral_param_propios']['GRAL_PAR_PRO_DESC'];
				print_r(json_encode($json_data));
				break;
				
			case 'actualizaEstadoProyecto':
				if($proyecto->actualizaEstadoProyecto($_POST['codigo_proyecto'],$_POST['estado_proyecto'])){
					$json_data['completo'] = true;	
				}else{
					$json_data['completo'] = false;
				}
				print_r(json_encode($json_data));
				break;
			case 'buscarXPalabraConBtn':
				$lista_proy = $proyecto->listaProyectosXPalabra($_GET['codigo_proyecto']);
				$cont = 0;
				foreach($lista_proy  as $key => $value){
					$json_data['alm_proy_id'] = $value['alm_proyecto']['alm_proy_id'];
					$json_data['alm_proy_cod'] = $value['alm_proyecto']['alm_proy_cod'];
					$json_data['alm_proy_nom'] = $value['alm_proyecto']['alm_proy_nom'];
					$json_data['alm_proy_fecha_inicio'] = $proyecto->convertirNormal($value['alm_proyecto']['alm_proy_fecha_inicio']);
					$json_data['alm_proy_fecha_fin'] = $proyecto->convertirNormal($value['alm_proyecto']['alm_proy_fecha_fin']);
					$tipo = $proyecto->obtenerTipo($value['alm_proyecto']['alm_proy_tipo']);
					$json_data['alm_proy_tipo'] = $tipo[0]['gral_param_propios']['GRAL_PAR_PRO_DESC'];  
					$estado = $proyecto->obtenerEstado($value['alm_proyecto']['alm_proy_estado']);
					$json_data['alm_proy_estado'] = $estado[0]['gral_param_propios']['GRAL_PAR_PRO_DESC']; 
					$json_data['alm_proy_cod_estado'] = $value['alm_proyecto']['alm_proy_estado']; 
					$array[$cont] = $json_data; 
					$cont++;
				}
				print_r(json_encode($array));
				break;
				
				case 'darBajaProyecto':
					if(	$proyecto->bajaProyecto($_POST['codigo_proyecto'])){
							$json_data['completo'] = true;	
				}else{
					$json_data['completo'] = false;
				}
				print_r(json_encode($json_data));
				break;
		}
	}
}
$proyecto_router = new ProyectoRouter(); // Este es el router 
if($_SERVER['REQUEST_METHOD'] == "POST"){
	$accion = $_POST['accion'];
}elseif($_SERVER['REQUEST_METHOD'] == "GET"){
	$accion = $_GET['accion'];
}
$proyecto_router->ejecutarAccion($accion);
?>