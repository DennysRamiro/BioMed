<?php
	require_once "views/DevolucionView.php";
	require_once "models/DevolucionModel.php";
  require_once "models/IndexModel.php";
  require_once '../importaciones/clases/Utilitarios.php';
    /**
     * 
     */
	 

class DevolucionController{
		/**
		 * Comentarios del constructor
		 */
	   public function __construct() {
        	// definir variables propias de la clase
    	}

      	 /*
     * Esta es la funcion que ejecuta y redirecciona la solicitud  que se haga
     */

        public function runIndex($accion){
            //echo ("runIndex");
          $util = new Utilitarios();
          $devolucion_model = new DevolucionModel();
          $devolucion_view = new DevolucionView();
          $index_model = new IndexModel();
           
            switch ($accion) {
               
              case 'index':
                     //echo("index"); 
                     //$egreso_view = new EgresoModel();
                  $devolucion_view->runIndex();
                break;

              case 'listarDevoluciones':
                 //echo "Aqui";
                $list_dev=$devolucion_model->listarDevoluciones($_GET['start'],$_GET['limit']);
                $tot = $devolucion_model->totalDevoluciones();
                $json_data['total'] = $tot[0][0]['total'];
                //print_r($list_trasp);
                $cont=0;
                foreach ($list_dev as $key => $value) {
                  
                  $json_data['alm_cab_ing_nro_unico']= $value['alm_ing_egr_cab']['alm_cab_ing_nro_unico'];
                  $json_data['alm_cab_ing_egr_nro_nota']= $value['alm_ing_egr_cab']['alm_cab_ing_egr_nro_nota'];
                  $json_data['alm_cab_ing_egr_cod']= $value['alm_ing_egr_cab']['alm_cab_ing_egr_cod'];
                  $json_data['alm_cab_ing_egr_nombre']= $value['alm_ing_egr_cab']['alm_cab_ing_egr_nombre'];
                  $json_data['alm_cab_ing_egr_origen']= $value['alm_ing_egr_cab']['alm_cab_ing_egr_origen'];
                  $origen=$index_model->getRegionOp($json_data['alm_cab_ing_egr_origen']);
                  $json_data['origen']= $origen[0]['gral_agencia']['GRAL_AGENCIA_NOMBRE'];
                  $json_data['alm_cab_ing_egr_destino']= $value['alm_ing_egr_cab']['alm_cab_ing_egr_destino'];
                  $destino=$index_model->getRegionOp($json_data['alm_cab_ing_egr_destino']);
                  $json_data['destino']= $destino[0]['gral_agencia']['GRAL_AGENCIA_NOMBRE'];
                  $json_data['alm_cab_ing_egr_fecha_ingreso']= $util->cambiaf_a_normal($value['alm_ing_egr_cab']['alm_cab_ing_egr_fecha_ingreso']);
                  $array[$cont] = $json_data; 
                  $cont++;
                }
                print_r(json_encode($array));                
                
                break;
              case 'buscarDevoluciones':
                //print_r($_GET['ingresos_buscar']);
              $list_bus = $devolucion_model->buscarDevoluciones($_GET['devoluciones_buscar']);
              //print_r($list_bus);
              $cont = 0;
              foreach($list_bus as $key =>$value){
                $json_data['id']    = $value['cab']['alm_cab_ing_nro_unico'];
                $json_data['label'] = $value['cab']['alm_cab_ing_egr_nro_nota']." ".$value['cab']['alm_cab_ing_egr_nombre']." ".$value['orig']['GRAL_AGENCIA_NOMBRE']." ".$value['dest']['GRAL_AGENCIA_NOMBRE'];
                $json_data['value'] = $value['cab']['alm_cab_ing_egr_nro_nota']." ".$value['cab']['alm_cab_ing_egr_nombre']." ".$value['orig']['GRAL_AGENCIA_NOMBRE']." ".$value['dest']['GRAL_AGENCIA_NOMBRE'];
                $array[$cont] = $json_data; 
                $cont++;
              }
              print_r(json_encode($array));
              //print_r($array);
              break;

            case 'getDatosBusNotDev':
              $datos_not_dev=$devolucion_model->getDatosBusDev($_GET['id_unico']);
              //print_r($datos_not_ing);
              $cont = 0;
              foreach ($datos_not_dev as $key => $value) {
                $json_data['alm_cab_ing_nro_unico']= $value['cab']['alm_cab_ing_nro_unico'];
                $json_data['alm_cab_ing_egr_nro_nota']= $value['cab']['alm_cab_ing_egr_nro_nota'];
                $json_data['alm_cab_ing_egr_nombre']= $value['cab']['alm_cab_ing_egr_nombre'];
                $json_data['alm_cab_ing_egr_fecha_ingreso']= $util->cambiaf_a_normal($value['cab']['alm_cab_ing_egr_fecha_ingreso']);
                $json_data['alm_cab_ing_egr_origen']= $value['cab']['alm_cab_ing_egr_origen'];
                $origen=$index_model->getRegionOp($json_data['alm_cab_ing_egr_origen']);
                $json_data['origen']= $origen[0]['gral_agencia']['GRAL_AGENCIA_NOMBRE'];
                $json_data['alm_cab_ing_egr_destino']= $value['cab']['alm_cab_ing_egr_destino'];
                $destino=$index_model->getRegionOp($json_data['alm_cab_ing_egr_destino']);
                $json_data['destino']= $destino[0]['gral_agencia']['GRAL_AGENCIA_NOMBRE'];
                $array[$cont] = $json_data; 
                $cont++;
              }
              print_r(json_encode($array));
              //print_r($array);
              break;

            case 'buscarNotasDev':
              //echo ($_GET['start']);
              //echo ($_GET['limit']);
              //echo ($_GET['ingresos_buscar']);
              $lista_not_dev= $devolucion_model->buscarDevolucionesBoton($_GET['start'],$_GET['limit'],$_GET['devoluciones_buscar']);
              $totales= $devolucion_model->totalDevolucionesBoton($_GET['devoluciones_buscar']);
              $json_data['total']= $totales[0][0]['total']; 
              //print_r($totales);
              $cont = 0;
              foreach ($lista_not_dev as $key => $value) {   
                $json_data['alm_cab_ing_nro_unico']= $value['cab']['alm_cab_ing_nro_unico'];            
                $json_data['alm_cab_ing_egr_nro_nota']= $value['cab']['alm_cab_ing_egr_nro_nota'];
                $json_data['alm_cab_ing_egr_nombre']= $value['cab']['alm_cab_ing_egr_nombre'];
                $json_data['alm_cab_ing_egr_fecha_ingreso']= $util->cambiaf_a_normal($value['cab']['alm_cab_ing_egr_fecha_ingreso']);
                $json_data['origen']= $value['orig']['GRAL_AGENCIA_NOMBRE'];
                $json_data['destino']= $value['dest']['GRAL_AGENCIA_NOMBRE'];
                $json_data['devoluciones_buscar']= $_GET['devoluciones_buscar'];
                $array[$cont] = $json_data; 
                $cont++;
              }
              print_r(json_encode($array));
              //print_r($array);
              break;
            }
        
    	}  
	}
?>