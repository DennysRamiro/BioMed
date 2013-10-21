<?php
	require_once "views/TraspasoView.php";
	require_once "models/TraspasoModel.php";
  require_once "models/IndexModel.php";
  require_once '../importaciones/clases/Utilitarios.php';
    /**
     * 
     */
	 

class TraspasoController{
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
          $traspaso_model = new TraspasoModel();
          $traspaso_view = new TraspasoView();
          $index_model = new IndexModel();
           
            switch ($accion) {
               
              case 'index':
                     //echo("index"); 
                     //$egreso_view = new EgresoModel();
                  $traspaso_view->runIndex();
                break;
              case 'listarTraspasos':
                 //echo "Aqui";
                $list_trasp=$traspaso_model->listarTraspasos($_GET['start'],$_GET['limit']);
                $tot = $traspaso_model->totalTraspasos();
                $json_data['total'] = $tot[0][0]['total'];
                //print_r($list_trasp);
                $cont=0;
                foreach ($list_trasp as $key => $value) {
                  
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

              case 'buscarTraspasos':
                //print_r($_GET['ingresos_buscar']);
              $list_bus = $traspaso_model->buscarTraspasos($_GET['traspasos_buscar']);
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

            case 'getDatosBusNotTrasp':
              $datos_not_trasp=$traspaso_model->getDatosBusTrasp($_GET['id_unico']);
              //print_r($datos_not_ing);
              $cont = 0;
              foreach ($datos_not_trasp as $key => $value) {
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

            case 'buscarNotasTrasp':
              //echo ($_GET['start']);
              //echo ($_GET['limit']);
              //echo ($_GET['ingresos_buscar']);
              $lista_not_trasp= $traspaso_model->buscarTraspasosBoton($_GET['start'],$_GET['limit'],$_GET['traspasos_buscar']);
              $totales= $traspaso_model->totalTraspasosBoton($_GET['traspasos_buscar']);
              $json_data['total']= $totales[0][0]['total']; 
              //print_r($totales);
              $cont = 0;
              foreach ($lista_not_trasp as $key => $value) {   
                $json_data['alm_cab_ing_nro_unico']= $value['cab']['alm_cab_ing_nro_unico'];            
                $json_data['alm_cab_ing_egr_nro_nota']= $value['cab']['alm_cab_ing_egr_nro_nota'];
                $json_data['alm_cab_ing_egr_nombre']= $value['cab']['alm_cab_ing_egr_nombre'];
                $json_data['alm_cab_ing_egr_fecha_ingreso']= $util->cambiaf_a_normal($value['cab']['alm_cab_ing_egr_fecha_ingreso']);
                $json_data['origen']= $value['orig']['GRAL_AGENCIA_NOMBRE'];
                $json_data['destino']= $value['dest']['GRAL_AGENCIA_NOMBRE'];
                $json_data['traspasos_buscar']= $_GET['traspasos_buscar'];
                $array[$cont] = $json_data; 
                $cont++;
              }
              print_r(json_encode($array));
              //print_r($array);
              break;

            case 'grabarNuevoTraspaso' :
                    //print_r($_GET);
                    $traspaso_model->grabarNuevoTraspaso($_GET);    
              break;

            case 'getCabTrasp':
              $cab_trasp=$traspaso_model->getCabTrasp($_GET['cod_unico']);
              //print_r($cab_trasp);
              $cont = 0;
              foreach ($cab_trasp as $key => $value) {
                $json_data['alm_cab_ing_egr_nro_nota']= $value['alm_ing_egr_cab']['alm_cab_ing_egr_nro_nota'];
                $json_data['alm_cab_ing_egr_nombre']= $value['alm_ing_egr_cab']['alm_cab_ing_egr_nombre'];
                $json_data['alm_cab_ing_egr_fecha_ingreso']= $util->cambiaf_a_normal($value['alm_ing_egr_cab']['alm_cab_ing_egr_fecha_ingreso']);
                $json_data['alm_cab_ing_egr_origen']= $value['alm_ing_egr_cab']['alm_cab_ing_egr_origen'];
                $origen=$traspaso_model->getRegionOp($json_data['alm_cab_ing_egr_origen']);
                $json_data['origen']= $origen[0]['gral_agencia']['GRAL_AGENCIA_NOMBRE'];
                $json_data['alm_cab_ing_egr_destino']= $value['alm_ing_egr_cab']['alm_cab_ing_egr_destino'];
                $destino=$traspaso_model->getRegionOp($json_data['alm_cab_ing_egr_destino']);
                $json_data['destino']= $destino[0]['gral_agencia']['GRAL_AGENCIA_NOMBRE'];
                $json_data['cod_unico']= $_GET['cod_unico'];
                $array[$cont] = $json_data; 
                $cont++;
              }
              print_r(json_encode($array));
              //print_r($array);
              break;
            case 'agenciaDestino':
              //echo($_GET['nro_destino']);
              $tab_dest=$traspaso_model->getAgenciaDestino($_GET['nro_origen']);
              $cont = 0;
              foreach ($tab_dest as $key => $value) {
                $json_data['cod_destino']= $value['gral_agencia']['GRAL_AGENCIA_CODIGO'];
                $json_data['nom_destino']= $value['gral_agencia']['GRAL_AGENCIA_NOMBRE'];
                $array[$cont] = $json_data; 
                $cont++;
              }
              print_r(json_encode($array));
              break;

            case 'buscarProducto':
                //print_r($_GET['ingresos_buscar']);
              $list_bus = $traspaso_model->buscarProductos($_GET['palabra_buscar']);
              //print_r($list_bus);
              $cont = 0;
              foreach($list_bus as $key =>$value){
                $json_data['id']    = $value['alm_prod_cabecera']['alm_prod_cab_id_unico_prod'];
                $json_data['label'] = $value['alm_prod_cabecera']['alm_prod_cab_codigo']." ".$value['alm_prod_cabecera']['alm_prod_cab_nombre'];
                $json_data['value'] = $value['alm_prod_cabecera']['alm_prod_cab_nombre'];
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