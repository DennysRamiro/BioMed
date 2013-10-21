<?php
	require_once "views/IndexView.php";
	require_once "models/IndexModel.php";
  require_once '../importaciones/clases/Utilitarios.php';
    /**
     * 
     */
	 

class IndexController{
		/**
		 * Comentarios del constructor
		 */
	   public function __construct() {
        	// definir variables propias de la clase
    	}



      	public function runIndex($accion){
            
          //echo($accion); 
            $util = new Utilitarios();
          $index_view = new IndexView();
           $index_model = new IndexModel();
            switch ($accion) {
               
            case 'index':
                     //echo($accion); 
                     //$index_model = new IndexModel();
                     $index_view->runIndex();
                    break;
            case 'buscarIngresos':
                //print_r($_GET['ingresos_buscar']);
              $list_bus = $index_model->buscarIngresos($_GET['ingresos_buscar']);
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
            case 'buscarNotasIng':
              //echo ($_GET['start']);
              //echo ($_GET['limit']);
              //echo ($_GET['ingresos_buscar']);
              $lista_not_ing= $index_model->buscarIngresosBoton($_GET['start'],$_GET['limit'],$_GET['ingresos_buscar']);
              $totales= $index_model->totalIngresosBoton($_GET['ingresos_buscar']);
              $json_data['total']= $totales[0][0]['total']; 
              //print_r($totales);
              $cont = 0;
              foreach ($lista_not_ing as $key => $value) {   
                $json_data['alm_cab_ing_nro_unico']= $value['cab']['alm_cab_ing_nro_unico'];            
                $json_data['alm_cab_ing_egr_nro_nota']= $value['cab']['alm_cab_ing_egr_nro_nota'];
                $json_data['alm_cab_ing_egr_nombre']= $value['cab']['alm_cab_ing_egr_nombre'];
                $json_data['alm_cab_ing_egr_fecha_ingreso']= $util->cambiaf_a_normal($value['cab']['alm_cab_ing_egr_fecha_ingreso']);
                $json_data['origen']= $value['orig']['GRAL_AGENCIA_NOMBRE'];
                $json_data['destino']= $value['dest']['GRAL_AGENCIA_NOMBRE'];
                $json_data['ingresos_buscar']= $_GET['ingresos_buscar'];
                $array[$cont] = $json_data; 
                $cont++;
              }
              print_r(json_encode($array));
              //print_r($array);
              break;

            case 'getDatosBusNotIng':
              $datos_not_ing=$index_model->getDatosBusIng($_GET['id_unico']);
              //print_r($datos_not_ing);
              $cont = 0;
              foreach ($datos_not_ing as $key => $value) {
                $json_data['alm_cab_ing_nro_unico']= $value['cab']['alm_cab_ing_nro_unico'];
                $json_data['alm_cab_ing_egr_nro_nota']= $value['cab']['alm_cab_ing_egr_nro_nota'];
                $json_data['alm_cab_ing_egr_nombre']= $value['cab']['alm_cab_ing_egr_nombre'];
                $json_data['alm_cab_ing_egr_fecha_ingreso']= $util->cambiaf_a_normal($value['cab']['alm_cab_ing_egr_fecha_ingreso']);
                $json_data['alm_cab_ing_egr_origen']= $value['cab']['alm_cab_ing_egr_origen'];
                $origen=$index_model->getRegionOp($json_data['alm_cab_ing_egr_origen']);
                $json_data['origen_ing']= $origen[0]['gral_agencia']['GRAL_AGENCIA_NOMBRE'];
                $json_data['alm_cab_ing_egr_destino']= $value['cab']['alm_cab_ing_egr_destino'];
                $destino=$index_model->getRegionOp($json_data['alm_cab_ing_egr_destino']);
                $json_data['destino_ing']= $destino[0]['gral_agencia']['GRAL_AGENCIA_NOMBRE'];
                $array[$cont] = $json_data; 
                $cont++;
              }
              print_r(json_encode($array));
              //print_r($array);
              break;
            case 'grabarIngreso' :

                    //print_r($_GET);
                    $cod = $index_model->guardarNuevoIngreso($_GET);
                   
                    break;
                  
            case 'grabarDetalle' :

                   $cod = $index_model->guardarNuevoDetalle($_GET);
                  
                    break;
            case 'getDatosIngresoCab' :
                  $datos_ingreso_cab = $index_model->getDataIngresosCab($_GET['unico']);
                  //print_r($datos_ingreso_cab);
                  //print(json_encode($datos_ingreso_cab[0]['alm_ing_egr_cab']));

                  $json_data['alm_cab_ing_egr_nro_nota']=$datos_ingreso_cab[0]['alm_ing_egr_cab']['alm_cab_ing_egr_nro_nota'];
                  $json_data['alm_cab_ing_egr_nombre']=$datos_ingreso_cab[0]['alm_ing_egr_cab']['alm_cab_ing_egr_nombre'];
                  $json_data['alm_cab_ing_egr_fecha_ingreso']=$util->cambiaf_a_normal($datos_ingreso_cab[0]['alm_ing_egr_cab']['alm_cab_ing_egr_fecha_ingreso']);
                  $json_data['alm_cab_ing_egr_origen']=$datos_ingreso_cab[0]['alm_ing_egr_cab']['alm_cab_ing_egr_origen'];
                  $json_data['alm_cab_ing_egr_destino']=$datos_ingreso_cab[0]['alm_ing_egr_cab']['alm_cab_ing_egr_destino'];
                  $json_data['alm_cab_ing_egr_motivo']=$datos_ingreso_cab[0]['alm_ing_egr_cab']['alm_cab_ing_egr_motivo'];

                  print(json_encode($json_data));
                  break;
            case 'getDatosIngresoDet' :
                  $datos_ingreso_det = $index_model->getDataIngresosDet($_GET['unico']);
                  //print_r($datos_ingreso_det);
                  $fila = 1;
                  if (empty($datos_ingreso_det)) {
                        $json_data['fila']='';
                        $json_data['alm_ing_egr_det_nro_unico']='';
                        $json_data['alm_ing_egr_det_cod_int']='';
                        $json_data['alm_ing_egr_det_descripcion']='';
                        $json_data['alm_ing_egr_det_referencia']='';
                        $json_data['alm_ing_egr_det_unidad']='';
                        $json_data['alm_ing_egr_det_cantidad']='';
                        $json_data['alm_ing_egr_det_estado'] = '';
                        $json_data['det']=0;
                        print(json_encode($json_data));
                   
                  }else{

                      $cont=0;
                     foreach ($datos_ingreso_det as $key => $value) {
                        //print_r($value);
                        $json_data['fila']=$fila;
                        $json_data['alm_ing_egr_det_nro_unico']=$value['d']['alm_ing_egr_det_nro_unico'];
                        $json_data['alm_ing_egr_det_cod_int']=$value['d']['alm_ing_egr_det_cod_int'];
                        $json_data['alm_ing_egr_det_descripcion']=$value['d']['alm_ing_egr_det_descripcion'];
                        $json_data['alm_ing_egr_det_referencia']=$value['d']['alm_ing_egr_det_referencia'];
                        $json_data['alm_ing_egr_det_unidad']=$value[0]['unidad'];
                        $json_data['alm_ing_egr_det_cantidad']=$value['d']['alm_ing_egr_det_cantidad'];
                        $json_data['alm_ing_egr_det_estado'] = $value['d']['alm_ing_egr_det_estado'];
                        //$json_data['det']=1;
                        $array[$cont] = $json_data; 
                        $cont++;
                        $fila++;
                     }
                     print(json_encode($array));
                  }                
                  break;
            case 'optenerProductoSeleccionado':
                  $datos_producto_seleccionado = $index_model->optenerProductoSelecionado($_GET);
                  $datos['codigo_int'] = $datos_producto_seleccionado[0]['apc']['alm_prod_cab_codigo'];
                  $datos['descripcion'] = $datos_producto_seleccionado[0]['apc']['alm_prod_cab_descripcion'];
                  $datos['referencia'] = $datos_producto_seleccionado[0]['apc']['alm_prod_cab_numerico'];
                  $datos['id_unidad'] = $datos_producto_seleccionado[0]['apc']['alm_prod_cab_unidad']; 
                  $unidad = $index_model->getUnidadXId($datos_producto_seleccionado[0]['apc']['alm_prod_cab_unidad']);
                  $datos['unidad'] = $unidad[0]['gral_param_propios']['GRAL_PAR_PRO_DESC'];
                  $datos['cantidad'] = $datos_producto_seleccionado[0]['apd']['alm_prod_det_cantidad'];
                  $datos['id_unico'] = $datos_producto_seleccionado[0]['apd']['alm_prod_det_id_unico'];
                  print(json_encode($datos));
                  break;
            case 'listarIngresos' :
                  $cont=0;
                  $fila = 1;
                  $val_motivo = 1;
                  $tot = $index_model->totalIngresos($val_motivo);
                  if($tot[0][0]['total'] == 0){
                    $json_data_final['completo'] = false;
                  }else{
                    $json_data_final['completo'] = true;
                    $json_data_final['total'] = $tot[0][0]['total'];
                    foreach ($index_model->listarIgresos($_GET['start'],$_GET['limit'], $val_motivo) as $key => $value) {
                          $json_data['num'] = $fila;
                          $json_data['alm_cab_ing_egr_nro_nota']= $value['alm_ing_egr_cab']['alm_cab_ing_egr_nro_nota'];
                          $json_data['alm_cab_ing_nro_unico']= $value['alm_ing_egr_cab']['alm_cab_ing_nro_unico'];
                          $json_data['alm_cab_ing_egr_cod']= $value['alm_ing_egr_cab']['alm_cab_ing_egr_cod'];
                          $json_data['alm_cab_ing_egr_nombre']= $value['alm_ing_egr_cab']['alm_cab_ing_egr_nombre'];
                          $json_data['alm_cab_ing_egr_motivo']= $value['alm_ing_egr_cab']['alm_cab_ing_egr_motivo'];
                          $json_data['estado_ingreso'] = $value[0]['estado'];
                          $json_data['alm_cab_ing_egr_origen']= $value[0]['origen'];
                          $json_data['alm_cab_ing_egr_destino']= $value[0]['destino'];
                          $json_data['alm_cab_ing_egr_fecha_ingreso']= $util->cambiaf_a_normal($value['alm_ing_egr_cab']['alm_cab_ing_egr_fecha_ingreso']);
                          $json_data['alm_cab_ing_egr_motivo_registro'] = $value['alm_ing_egr_cab']['alm_cab_ing_egr_motivo_registro'];
                          $array[$cont] = $json_data;
                          $cont++;  
                          $fila++;
                    }
                    $json_data_final['datos'] = $array;
                  }
                  print_r(json_encode($json_data_final));
                  break;
            case 'listarIngresosXConfirmar':
                  $cont=0;
                  $fila = 1;
                  $val_motivo = 1;
                  $cont=0 ;
                  $tot = $index_model->totalIngresosDetalle();
                  if($tot[0][0]['total'] == 0){
                    $json_data_final['completo'] = false;
                  }else{
                    $json_data_final['completo'] = true;
                    $json_data_final['total'] = $tot[0][0]['total'];
                    /*$datos = $index_model->listaIngresosDetalles($_GET['start'],$_GET['limit'], $val_motivo);
                    print_r($datos);*/
                    foreach ($index_model->listaIngresosDetalles($_GET['start'],$_GET['limit'], $val_motivo) as $key => $value) {
                          $json_data['num'] = $fila;
                          $json_data['codigo_int']= $value['aied']['alm_ing_egr_det_cod_int'];
                          $json_data['numero_nota']= $value['aiec']['alm_cab_ing_egr_nro_nota'];
                          $json_data['detalle_ingreso']= $value['aied']['alm_ing_egr_det_descripcion'];
                          $json_data['codigo_referencia']= $value['aied']['alm_ing_egr_det_referencia'];
                          $json_data['alm_cab_ing_egr_motivo']= $value['aiec']['alm_cab_ing_egr_motivo'];
                          $json_data['estado_ingreso'] = $value[0]['estado'];
                          $json_data['unidad']= $value[0]['unidad_detalle'];
                          $json_data['alm_cab_ing_egr_destino']= $value[0]['destino'];
                          $json_data['cantidad_ingreso'] = $value['aied']['alm_ing_egr_det_cantidad'];
                          $json_data['alm_cab_ing_nro_unico'] = $value['aied']['alm_ing_egr_det_cod_unico_cab'];
                          $json_data['alm_det_ing_nro_unico'] = $value['aied']['alm_ing_egr_det_nro_unico'];
                          $json_data['id_unico_producto'] = $value['aied']['alm_ing_egr_det_cod_unico_desc'];
                          $json_data['alm_cab_ing_egr_fecha_ingreso']= $util->cambiaf_a_normal($value['aiec']['alm_cab_ing_egr_fecha_ingreso']);
                          $array[$cont] = $json_data;
                          $cont++;  
                          $fila++;
                    }
                    $json_data_final['datos'] = $array;
                  }
                  print_r(json_encode($json_data_final));
                  break;
            case 'optenerDatosCompletoProducto':
                  $datos_producto = $index_model->getDatosProductoDetalle($_GET);
                  $datos['codigo_prod'] = $datos_producto[0]['apc']['alm_prod_cab_codigo'];
                  $datos['nombre_prod'] = $datos_producto[0]['apc']['alm_prod_cab_nombre'];
                  $datos['descripcion_prod'] = $datos_producto[0]['apc']['alm_prod_cab_descripcion'];
                  $datos['id_unico'] = $datos_producto[0]['apc']['alm_prod_cab_id_unico_prod'];
                  $datos['fecha_prod'] = $util->cambiaf_a_normal($datos_producto[0]['apc']['alm_prod_cab_fecha_proceso']);
                  $proveedor = $index_model->getProveedor($datos_producto[0]['apc']['alm_prod_cab_prov']);
                  $datos['proveedor_prod'] = $proveedor[0]['alm_proveedor']['alm_prov_nombre'];
                  $sucursal = $index_model->getSucursalOrigen($datos_producto[0]['apc']['alm_prod_cab_suc_origen']);
      
                  $datos['sucursal_prod'] = $sucursal[0]['gral_agencia']['GRAL_AGENCIA_NOMBRE']; 
                  //print_r($datos_producto);
                  foreach ($datos_producto as $key => $value) {
                    $det['id_unico_det'] = $value['apd']['alm_prod_det_id_unico'];
                    $det['serie_det'] = $value['apd']['alm_prod_det_serie'];
                    $det['cantidad_det'] = $value['apd']['alm_prod_det_cantidad'];
                    $det['prec_compra_det'] = $value['apd']['alm_prod_det_prec_compra'];
                    $det['prec_venta_det'] = $value['apd']['alm_prod_det_prec_venta'];
                    $det['prec_venta_max_det'] = $value['apd']['alm_prod_det_prec_max_venta'];
                    $det['prec_venta_min_det'] = $value['apd']['alm_prod_det_prec_min_venta'];
                    $det['prec_fecha_venc_det'] = $util->cambiaf_a_normal($value['apd']['alm_prod_det_fecha_venc']);
                    $det['prec_part_num_det'] = $value['apd']['alm_prod_det_part_number'];
                    $items[$cont] = $det;
                    $cont++;
                  }
                  $datos['items'] = $items;
                  print(json_encode($datos));
                  break;
            case 'confirmarOrdenIngreso':
                  if($index_model->confirmarOrdenIngreso($_GET)){
                    $json_data['completo'] = true;
                  }else{
                    $json_data['completo'] = false;
                  }
                  print_r(json_encode($json_data));
                  break;
            case 'saveEditIngresoCab' :
                //print_r("expression");
                $val = $index_model->saveEditIngresoCab($_GET);

                break;
            
            case 'buscarProductos' :

                // print_r($_GET['cliente_buscar']);
                $list_prod = $index_model->listarBusquedaProductos($_GET['producto_buscar']);
                //print_r($list_prod);
                $cont = 0;
                foreach($list_prod as $key =>$value){
                  //print_r($value);
                  $json_data['id']    = $value['alm_prod_cabecera']['alm_prod_cab_id_unico_prod'];
                  $json_data['label'] = $value['alm_prod_cabecera']['alm_prod_cab_codigo']." ".$value['alm_prod_cabecera']['alm_prod_cab_nombre'];
                  $json_data['value'] = $value['alm_prod_cabecera']['alm_prod_cab_nombre'];
                  //$json_data['value'] = $value['alm_prod_cabecera']['vent_cli_codigo_cliente']." ".$value['vent_cliente']['vent_cli_nombre']." ".$value['vent_cliente']['vent_cli_apellido_pat']." ".$value['vent_cliente']['vent_cli_apellido_mat'];
                  $array[$cont] = $json_data; 
                  $cont++;
                }
                print_r(json_encode($array));
              break;

              case 'buscarCantidad' :
                      $busca_cantidad = $index_model->buscaCantidad($_GET['cantidad_buscar']);
                      //print_r($busca_cantidad);
                      $json_data['cantidad'] = $busca_cantidad[0]['alm_prod_cabecera']['alm_prod_cab_cantidad_stock'];
                      print_r(json_encode($json_data));

                    break;
              case 'buscarPartNumber' :
                      $busca_part_number = $index_model->buscarPartNumber($_GET['part_number']);
                      //print_r($busca_part_number);
                      
                      $json_data['partNumber'] = $busca_part_number[0]['alm_prod_detalle']['alm_prod_det_part_number'];
                      print_r(json_encode($json_data));

                    break;
                case 'buscarUnidad' :

                //print_r($_GET['unidad']);
                      $busca_unidad = $index_model->buscarUnidad($_GET['unidad']);
                   // print_r($busca_unidad);
                      $json_data['unidad'] = $busca_unidad[0][0]['unidad'];
                      $json_data['cod_unidad'] = $busca_unidad[0]['alm_prod_cabecera']['alm_prod_cab_unidad'];
                      print_r(json_encode($json_data));
 /**/
                    break;

                case "deleteIngreso":
                    //print_r($_GET['codigo']);
                    if($index_model->deleteIngreso($_GET['codigo'])){
                        $json_res['complet'] = true;
                    }else{
                        $json_res['complet'] = false;
                    }
                     print_r(json_encode($json_res));
                    break;

                case 'getDatosDet' :
                      $datos_ingreso_det = $index_model->getEditDet($_GET['unico']);
                      //print_r("expression");
                      //print_r($datos_ingreso_det);
                      print(json_encode($datos_ingreso_det[0]['alm_ing_egr_det']));
                  break;

                case 'saveEditItemDet' :

                  $val_item = $index_model->saveEditItemsDet($_GET);

                  break;
                case 'deleteIngresoDet':
                    //print_r('controller');
                     //$unico_det = $index_model->deleteIngresoDet($_GET['codigo']);
                     if ($index_model->deleteIngresoDet($_GET['codigo'])){
                        $json_res['complet'] = true;
                     }else{
                        $json_res['complet'] = false;
                     }
                     print_r(json_encode($json_res));
                    

                    break;

                    /*******************************************/
                 case 'listarEgresos' :
                  $cont=0;
                  $fila = 1;
                  $tot = $index_model->totalEgresos();
                  $json_data_final['total'] = $tot[0][0]['total'];
                     foreach ($index_model->listarEgresos($_GET['start'],$_GET['limit']) as $key => $value) {
                        $json_data['num'] = $fila;
                        $json_data['alm_cab_ing_egr_nro_nota']= $value['alm_ing_egr_cab']['alm_cab_ing_egr_nro_nota'];
                        $json_data['alm_cab_ing_nro_unico']= $value['alm_ing_egr_cab']['alm_cab_ing_nro_unico'];
                        $json_data['alm_cab_ing_egr_cod']= $value['alm_ing_egr_cab']['alm_cab_ing_egr_cod'];
                        $json_data['alm_cab_ing_egr_nombre']= $value['alm_ing_egr_cab']['alm_cab_ing_egr_nombre'];
                        $json_data['alm_cab_ing_egr_motivo']= $value['alm_ing_egr_cab']['alm_cab_ing_egr_motivo'];
                        $json_data['alm_cab_ing_egr_destino']= $value['alm_ing_egr_cab']['alm_cab_ing_egr_destino'];
                        $json_data['alm_cab_ing_egr_fecha_ingreso']= $util->cambiaf_a_normal($value['alm_ing_egr_cab']['alm_cab_ing_egr_fecha_ingreso']);
       
                        $array[$cont] = $json_data;
                        $cont++;  
                        $fila++;
                  }
                  $json_data_final['datos'] = $array;
                   print_r(json_encode($json_data_final));
                    break;
            }
              
    	}  
	}
?>