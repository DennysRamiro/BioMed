<?php
	require_once "views/EgresoView.php";
	require_once "models/EgresoModel.php";
  require_once "models/IndexModel.php";
  require_once '../importaciones/clases/Utilitarios.php';
    /**
     * 
     */
	 

class EgresoController{
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
            $egreso_model = new EgresoModel();
            $egreso_view = new EgresoView();
            $index_model = new IndexModel();
           
            switch ($accion) {
               
             case 'index':
                  $egreso_view->runIndex();
                  break;
             case 'buscarEgresos':
                    $list_bus = $egreso_model->buscarEgresos($_GET['egresos_buscar']);
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

              case 'buscarNotasEgr':
                    $lista_not_egr= $egreso_model->buscarEgresosBoton($_GET['start'],$_GET['limit'],$_GET['egresos_buscar']);
                    $totales= $egreso_model->totalEgresosBoton($_GET['egresos_buscar']);
                    $json_data['total']= $totales[0][0]['total']; 
                    //print_r($totales);
                    $cont = 0;
                    foreach ($lista_not_egr as $key => $value) {   
                      $json_data['alm_cab_ing_nro_unico']= $value['cab']['alm_cab_ing_nro_unico'];            
                      $json_data['alm_cab_ing_egr_nro_nota']= $value['cab']['alm_cab_ing_egr_nro_nota'];
                      $json_data['alm_cab_ing_egr_nombre']= $value['cab']['alm_cab_ing_egr_nombre'];
                      $json_data['alm_cab_ing_egr_fecha_ingreso']= $util->cambiaf_a_normal($value['cab']['alm_cab_ing_egr_fecha_ingreso']);
                      $json_data['origen']= $value['orig']['GRAL_AGENCIA_NOMBRE'];
                      $json_data['destino']= $value['dest']['GRAL_AGENCIA_NOMBRE'];
                      $json_data['egresos_buscar']= $_GET['egresos_buscar'];
                      $array[$cont] = $json_data; 
                      $cont++;
                    }
                    print_r(json_encode($array));
                    //print_r($array);
                    break;

            case 'getDatosBusNotEgr':
              $datos_not_egr=$egreso_model->getDatosBusEgr($_GET['id_unico']);
              //print_r($datos_not_egr);
              $cont = 0;
              foreach ($datos_not_egr as $key => $value) {
                $json_data['alm_cab_ing_nro_unico']= $value['cab']['alm_cab_ing_nro_unico'];
                $json_data['alm_cab_ing_egr_nro_nota']= $value['cab']['alm_cab_ing_egr_nro_nota'];
                $json_data['alm_cab_ing_egr_nombre']= $value['cab']['alm_cab_ing_egr_nombre'];
                $json_data['alm_cab_ing_egr_fecha_ingreso']= $util->cambiaf_a_normal($value['cab']['alm_cab_ing_egr_fecha_ingreso']);
                $json_data['alm_cab_ing_egr_origen']= $value['cab']['alm_cab_ing_egr_origen'];
                $origen=$egreso_model->getRegionOp($json_data['alm_cab_ing_egr_origen']);
                $json_data['origen_egr']= $origen[0]['gral_agencia']['GRAL_AGENCIA_NOMBRE'];
                $json_data['alm_cab_ing_egr_destino']= $value['cab']['alm_cab_ing_egr_destino'];
                $destino=$egreso_model->getRegionOp($json_data['alm_cab_ing_egr_destino']);
                $json_data['destino_egr']= $destino[0]['gral_agencia']['GRAL_AGENCIA_NOMBRE'];
                $array[$cont] = $json_data; 
                $cont++;
              }
              print_r(json_encode($array));
              //print_r($array);
              break;
            case 'grabarEgreso' :
                  //print_r("expression");

                    $cod = $egreso_model->guardarNuevoEgreso($_GET);
                   
                  break;
             case 'listarEgresos' :
                  //print_r($accion);
                  $cont=0;
                  $val_motivo = 2;
                  $fila = 1;
                  $tot = $egreso_model->totalEgresos($val_motivo);

                  $json_data_final['total'] = $tot[0][0]['total'];
                  //print_r($json_data_final['total']);
                     foreach ($egreso_model->listarEgresos($_GET['start'],$_GET['limit'],$val_motivo) as $key => $value) {
                      //print_r($value);
                        $json_data['num'] = $fila;
                        $json_data['alm_cab_ing_egr_nro_nota']= $value['alm_ing_egr_cab']['alm_cab_ing_egr_nro_nota'];
                        $json_data['alm_cab_ing_nro_unico']= $value['alm_ing_egr_cab']['alm_cab_ing_nro_unico'];
                        $json_data['alm_cab_ing_egr_cod']= $value['alm_ing_egr_cab']['alm_cab_ing_egr_cod'];
                        $json_data['alm_cab_ing_egr_nombre']= $value['alm_ing_egr_cab']['alm_cab_ing_egr_nombre'];
                        $json_data['alm_cab_ing_egr_motivo']= $value['alm_ing_egr_cab']['alm_cab_ing_egr_motivo'];
                        $json_data['alm_cab_ing_egr_motivo_registro']= $value['alm_ing_egr_cab']['alm_cab_ing_egr_motivo_registro'];
                        $json_data['alm_cab_ing_egr_origen']= $value[0]['origen'];
                        $json_data['alm_cab_ing_egr_destino']= $value[0]['destino'];
                        $json_data['alm_cab_ing_egr_fecha_ingreso']= $util->cambiaf_a_normal($value['alm_ing_egr_cab']['alm_cab_ing_egr_fecha_ingreso']);
                        $array[$cont] = $json_data;
                        $cont++;  
                        $fila++;
                        //print_r($cont);
                  }
                    //print_r("expression");
                  
                  $json_data_final['datos'] = $array;
                  //print_r($json_data_final);
                  print_r(json_encode($json_data_final));/**/
                  break;
             case 'listarEgresosXConfirmar':
                  
              
                  $cont=0;
                  $fila = 1;
                  $val_motivo = 2;
                  $tot = $egreso_model->totalEgresosDetalle($val_motivo);
                  //print_r($tot);
                  if($tot[0][0]['total'] == 0){
                    $json_data_final['completo'] = false;
                  }else{
                    $json_data_final['completo'] = true;
                    $json_data_final['total'] = $tot[0][0]['total'];
                  /*  $datos = $index_model->listaIngresosDetalles($_GET['start'],$_GET['limit'], $val_motivo);
                    print_r($datos);*/
                    foreach ($egreso_model->listaEgresosDetallesXconfirmar($_GET['start'],$_GET['limit'], $val_motivo) as $key => $value) {
                           //print_r($value);
                          /*$json_data['num'] = $fila;
                          $json_data['codigo_int']= $value['aied']['alm_ing_egr_det_cod_int'];
                          $json_data['numero_nota']= $value['aiec']['alm_cab_ing_egr_nro_nota'];
                          $json_data['detalle_ingreso']= $value['aied']['alm_ing_egr_det_descripcion'];
                          $json_data['codigo_referencia']= $value['aied']['alm_ing_egr_det_referencia'];
                          $json_data['alm_cab_ing_egr_motivo']= $value['aiec']['alm_cab_ing_egr_motivo'];
                          $json_data['estado_ingreso'] = $value[0]['estado'];
                          $json_data['unidad']= $value[0]['unidad_detalle'];
                          $json_data['alm_cab_ing_egr_destino']= $value[0]['destino'];
                          $json_data['alm_cab_ing_egr_fecha_ingreso']= $util->cambiaf_a_normal($value['aiec']['alm_cab_ing_egr_fecha_ingreso']);
                          $array[$cont] = $json_data;
                           */ 
                           $json_data['num'] = $fila;
                          $json_data['codigo_int']= $value['aied']['alm_ing_egr_det_cod_int'];
                          $json_data['numero_nota']= $value['aiec']['alm_cab_ing_egr_nro_nota'];
                          $json_data['detalle_ingreso']= $value['aied']['alm_ing_egr_det_descripcion'];
                          $json_data['codigo_referencia']= $value['aied']['alm_ing_egr_det_referencia'];
                          $json_data['estado']= $value['aied']['alm_ing_egr_det_estado'];
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
             case 'getDataCabeceraDetalle':
                  $egreso_cabecera = $egreso_model->getEgresoDetalleCabecera($_GET['codigo_unico_cab']);
                  $json_data = $egreso_cabecera[0]['alm_ing_egr_cab'];
                  print_r(json_encode($json_data));
                  break;

              case 'deleteEgreso' :
                    //print_r($_GET['codigo']);
                   
                   if($egreso_model->deleteEgreso($_GET['codigo'])){
                        $json_res['complet'] = true;
                    }else{
                        $json_res['complet'] = false;
                    }
                    print(json_encode($json_res));
                    break;

              case 'getDatosEgresoCab' :
                    //print_r($_GET['unico']);
                    $datos_egreso_cab = $egreso_model->getDataEgresosCab($_GET['unico']);
                    //print_r($datos_egreso_cab);
                  //print(json_encode($datos_ingreso_cab[0]['alm_ing_egr_cab']));

                  $json_data['alm_cab_ing_egr_nro_nota']=$datos_egreso_cab[0]['alm_ing_egr_cab']['alm_cab_ing_egr_nro_nota'];
                  $json_data['alm_cab_ing_egr_nombre']=$datos_egreso_cab[0]['alm_ing_egr_cab']['alm_cab_ing_egr_nombre'];
                  $json_data['alm_cab_ing_egr_fecha_ingreso']=$util->cambiaf_a_normal($datos_egreso_cab[0]['alm_ing_egr_cab']['alm_cab_ing_egr_fecha_ingreso']);
                  $json_data['alm_cab_ing_egr_origen']=$datos_egreso_cab[0]['alm_ing_egr_cab']['alm_cab_ing_egr_origen'];
                  $json_data['alm_cab_ing_egr_destino']=$datos_egreso_cab[0]['alm_ing_egr_cab']['alm_cab_ing_egr_destino'];
                  $json_data['alm_cab_ing_egr_motivo']=$datos_egreso_cab[0]['alm_ing_egr_cab']['alm_cab_ing_egr_motivo'];

                  print(json_encode($json_data));/**/
                  break;

              case 'saveEditEgresoCab' :
                    //print_r("expression");
                    $val = $egreso_model->saveEditEgresoCab($_GET);

                    break;

              case 'getDatosEgresoDet' :
                  $datos_egreso_det = $egreso_model->getDataEgresosDet($_GET['unico']);
                  //print_r($datos_ingreso_det);
                  $fila = 1;
                  if (empty($datos_egreso_det)) {
                    
                        $json_data['fila']='';
                        $json_data['alm_ing_egr_det_nro_unico']='';
                        $json_data['alm_ing_egr_det_cod_int']='';
                        $json_data['alm_ing_egr_det_descripcion']='';
                        $json_data['alm_ing_egr_det_referencia']='';
                        $json_data['alm_ing_egr_det_unidad']='';
                        $json_data['alm_ing_egr_det_cantidad']='';
                        $json_data['det']=0;

                     print(json_encode($json_data));
                   
                  }else{

                      $cont=0;
                     foreach ($datos_egreso_det as $key => $value) {
                        //print_r($value);
                        $json_data['fila']=$fila;
                        $json_data['alm_ing_egr_det_nro_unico']=$value['d']['alm_ing_egr_det_nro_unico'];
                        $json_data['alm_ing_egr_det_cod_int']=$value['d']['alm_ing_egr_det_cod_int'];
                        $json_data['alm_ing_egr_det_descripcion']=$value['d']['alm_ing_egr_det_descripcion'];
                        $json_data['alm_ing_egr_det_referencia']=$value['d']['alm_ing_egr_det_referencia'];
                        $json_data['alm_ing_egr_det_unidad']=$value[0]['unidad'];
                        $json_data['alm_ing_egr_det_cantidad']=$value['d']['alm_ing_egr_det_cantidad'];
                        //$json_data['det']=1;
                        $array[$cont] = $json_data; 
                        $cont++;
                        $fila++;
                     }
                     print(json_encode($array));
                  }                
                  break;
                  
                  case 'buscarProductosEgreso' :

                    //print_r($_GET['producto_buscar']);
                     $list_prod = $egreso_model->listarBusquedaProductosEgreso($_GET['producto_buscar']);

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
                case 'buscarCantidadEgreso' :

                      
                      $busca_cantidad = $egreso_model->buscaCantidadEgreso($_GET['cantidad_buscar']);
                      //print_r($busca_cantidad);
                      $json_data['cantidad_egreso'] = $busca_cantidad[0]['alm_prod_cabecera']['alm_prod_cab_cantidad_stock'];
                      print_r(json_encode($json_data));

                    break;
                  case 'buscarPartNumberEgreso' :
                      $busca_part_number = $index_model->buscarPartNumber($_GET['part_number']);
                      //print_r($busca_part_number);
                      
                      $json_data['partNumber_egreso'] = $busca_part_number[0]['alm_prod_detalle']['alm_prod_det_part_number'];
                      print_r(json_encode($json_data));

                    break;
                  case 'buscarUnidadEgreso' :

                //print_r($_GET['unidad']);
                      $busca_unidad = $index_model->buscarUnidad($_GET['unidad']);
                   // print_r($busca_unidad);
                      $json_data['unidad_egreso'] = $busca_unidad[0][0]['unidad'];
                      $json_data['cod_unidad_egreso'] = $busca_unidad[0]['alm_prod_cabecera']['alm_prod_cab_unidad'];
                      print_r(json_encode($json_data));
 /**/
                    break;
                  case 'grabarDetalleEgreso' :
                        //print_r($_GET);
                        $cod = $egreso_model->guardarNuevoDetalleEgreso($_GET);
                    
                    break;
                  case 'deleteItemEgresoDet':
                     // print_r($_GET['codigo']);
                          
                          if ($egreso_model->deleteItemEgresoDet($_GET['codigo'])){
                            $json_res['complet'] = true;
                          }else{
                            $json_res['complet'] = false;
                          }
                          print_r(json_encode($json_res));

                       //print_r($unico_det);
                      break;

                  case 'getDatosEgresoDetItems' :

                      //print_r($_GET['unico']);
                      $datos_egreso_det = $index_model->getEditDet($_GET['unico']);
                      //print_r("expression");
                      //print_r($datos_egreso_det);
                      //print(json_encode($datos_egreso_det[0]['alm_ing_egr_det']));
                        $json_data['unidad'] = $datos_egreso_det[0][0]['unidad'];
                        $json_data['alm_ing_egr_det_cod_int'] = $datos_egreso_det[0]['alm_ing_egr_det']['alm_ing_egr_det_cod_int'];
                        $json_data['alm_ing_egr_det_descripcion'] = $datos_egreso_det[0]['alm_ing_egr_det']['alm_ing_egr_det_descripcion'];
                        $json_data['alm_ing_egr_det_cod_unico_desc'] = $datos_egreso_det[0]['alm_ing_egr_det']['alm_ing_egr_det_cod_unico_desc'];
                        $json_data['alm_ing_egr_det_referencia'] = $datos_egreso_det[0]['alm_ing_egr_det']['alm_ing_egr_det_referencia'];
                        $json_data['alm_ing_egr_det_cantidad'] = $datos_egreso_det[0]['alm_ing_egr_det']['alm_ing_egr_det_cantidad'];
                        $json_data['alm_ing_egr_det_unidad'] = $datos_egreso_det[0]['alm_ing_egr_det']['alm_ing_egr_det_unidad'];
                        $json_data['alm_ing_egr_det_nro_unico'] = $datos_egreso_det[0]['alm_ing_egr_det']['alm_ing_egr_det_nro_unico'];
                        $json_data['alm_ing_egr_det_cod_unico_cab'] = $datos_egreso_det[0]['alm_ing_egr_det']['alm_ing_egr_det_cod_unico_cab'];
                        


                      print(json_encode($json_data));

                      break;
                  case 'grabarModificarDetalleEgreso' :
                        //print_r($_GET);
                        $cod = $egreso_model->guardarModificarDetalleEgreso($_GET);
                    
                      break;

                  case 'confirmarOrdenEgreso':
                      //print_r($_GET);
                        
                      if($egreso_model->confirmarOrdenEgreso($_GET)){
                        $json_data['completo'] = true;
                      }else{
                        $json_data['completo'] = false;
                      }
                      print_r(json_encode($json_data));
                      
                      break;

                  case 'procesarNotaSalida':
                        ///print_r("controller". $_GET['codigo']);
                        $nota = $egreso_model->procesarNotaSalida($_GET);
                    
                      break;
                  case 'optenerDatosCompletoProducto':
                      $cont = 0;
                      $datos_producto = $egreso_model->getDatosProductoDetalle($_GET);
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
                      $cont = 0;
                      foreach ($datos_producto as $key => $value) {
                          //print_r($value);
                          $det['id_unico_det'] = $value['apd']['alm_prod_det_id_unico'];
                          $det['serie_det'] = $value['apd']['alm_prod_det_serie'];
                          $det['cantidad_det'] = $value['apd']['alm_prod_det_cantidad'];
                          $det['prec_compra_det'] = $value['apd']['alm_prod_det_prec_compra'];
                          $det['prec_venta_det'] = $value['apd']['alm_prod_det_prec_venta'];
                          $det['prec_venta_max_det'] = $value['apd']['alm_prod_det_prec_max_venta'];
                          $det['prec_venta_min_det'] = $value['apd']['alm_prod_det_prec_min_venta'];
                          //$det['prec_fecha_venc_det'] = $util->cambiaf_a_normal($value['apd']['alm_prod_det_fecha_venc']);
                          $det['prec_fecha_ingreso'] = $util->cambiaf_a_normal($value['apd']['alm_prod_cab_fec_ing']);
                          $det['prec_part_num_det'] = $value['apd']['alm_prod_det_part_number'];
                          $items[$cont] = $det;
                          $cont++;
                      }
                      $datos['items'] = $items;
                      print(json_encode($datos));
                      break;
                      case 'optenerCantidadTotalProducto':
                        ///print_r("controller". $_GET['codigo']);
                        $total = $egreso_model->cantidadTotalProducto($_GET);
                         //print_r($total);
                        $json_data['total_producto'] = $total[0][0]['cantidad'];
                        //$json_data['cod_unidad_egreso'] = $busca_unidad[0]['alm_prod_cabecera']['alm_prod_cab_unidad'];
                        print_r(json_encode($json_data));
                    
                      break;
            }
        
    	}  
	}
?>