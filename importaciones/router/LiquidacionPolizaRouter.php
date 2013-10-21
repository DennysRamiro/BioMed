<?php
session_start();
require_once '../clases/AgenciaDespachante.php';
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
		switch($accion){
			case 'grabarNuevoAgeDespach': //Accion para grabar nuevo agencia aduanera
			//print_r($_POST['codigo_proyecto_hidden']);
				$agencia_despachante->grabarAgeDesp($_POST['codigo_proyecto_hidden_age'],
													$_POST['cod_age'],
													$_POST['nom_age_selec'],
													$_POST['nro_fac_age'], 
													$_POST['fec_age'],
													$_POST['nro_sid_age'],
													$_POST['item_age'],
													$_POST['des_age'], 
													$_POST['monto_age'],
													$_POST['factura_age'],
													$_SESSION['login'],
													$_SESSION['fec_proc']);
													
				
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
					$array[$cont] = $json_data; 
					$cont++;
				}
				print_r(json_encode($array));
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