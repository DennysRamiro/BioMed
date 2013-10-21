<?php
require_once "app/models/Venta.php";
require_once "app/views/VentaView.php";
require_once "app/models/Cliente.php";
require_once "app/models/Home.php";
require_once "app/views/HomeView.php";
/**
 * Description of Router
 *
 * @author Daniel Fernandez
 */
class VentasController {
    /*
     * Este es el metodo constructor para el proyecto
     */
    public function __construct() {
        
    }
    /*
     * Esta es la funcion que ejecuta y redirecciona la solicitud  que se haga
     */
    public function runIndex($tp){
        $ventas_view = new VentaView();
        $ventas_model = new venta();
         $home_model = new Home();
        switch ($tp) {
            case "index":
                
                $ventas_view->runIndex();
                break;
             case 'listarVentasPriv':
                //print_r("VentasController");
               // print_r($_GET);
              
               $cliente_model = new Cliente();
               //echo $_GET['start'].' '.$_GET['limit'];
               $cod_uni_op=$home_model->getCodUniOp($_SESSION['login']);
               //print_r($cod_uni_op);
               $op=$cod_uni_op[0]['vent_operador']['vent_op_cod_unico'];
               //print_r($op);
               $list_cot=$home_model->listaCotizacionPriv($_GET['start'],$_GET['limit'],$op);
               $fila = 1;
               $tot = $home_model->totalCotPriv($op);
               $json_data['total'] = $tot[0][0]['total'];
               $cont=0;
               foreach ($list_cot as $key => $value) {
                    $json_data['num'] = $fila;
                    $json_data['vent_prof_cab_cod_prof']= $value['vent_prof_cab']['vent_prof_cab_cod_prof'];
                    $json_data['vent_prof_cab_cod_unico']= $value['vent_prof_cab']['vent_prof_cab_cod_unico'];
                    $json_data['vent_prof_cab_cod_cliente']= $value['vent_prof_cab']['vent_prof_cab_cod_cliente'];
                    $cod_cliente=$cliente_model->getCodCliente($json_data['vent_prof_cab_cod_cliente']);
                    //print_r($cod_cliente);
                          foreach ($cod_cliente as $key => $value1) {
                            $json_data['codigo_cliente']= $value1['vent_cliente']['vent_cli_codigo_cliente'];
                          }
                    
                    $nom_cliente=$cliente_model->getNombreCliente($json_data['vent_prof_cab_cod_cliente']);
                          foreach ($nom_cliente as $key => $value2) {
                            $json_data['nombre_cliente']=$value2['vent_cliente']['vent_cli_nombre'];
                            $json_data['ap_pat_cliente']=$value2['vent_cliente']['vent_cli_apellido_pat'];
                            $json_data['ap_mat_cliente']=$value2['vent_cliente']['vent_cli_apellido_mat'];
                          }
                    $json_data['vent_prof_cab_cod_operador']= $value['vent_prof_cab']['vent_prof_cab_cod_operador'];
                    $nom_op=$home_model->getNombreOp($json_data['vent_prof_cab_cod_operador']);
                          foreach ($nom_op as $key => $value3) {
                              $json_data['nom_op']=$value3['vent_operador']['vent_op_nombres'];
                              $json_data['ap_part_op']=$value3['vent_operador']['vent_op_ap_paterno'];
                              $json_data['ap_mat_op']=$value3['vent_operador']['vent_op_ap_materno'];
                          }

                    $json_data['vent_prof_cab_fech_cot'] = $home_model->convertirNormal($value['vent_prof_cab']['vent_prof_cab_fech_cot']);
                    $json_data['vent_prof_cab_fech_entrega_cot'] = $home_model->convertirNormal($value['vent_prof_cab']['vent_prof_cab_fech_entrega_cot']);

                    $json_data['vent_prof_cab_forma_pago'] = $value['vent_prof_cab']['vent_prof_cab_forma_pago'];
                    $nom_pago=$home_model->getNomFormaPago($json_data['vent_prof_cab_forma_pago']);
                          foreach ($nom_pago as $key => $value5) {
                            $json_data['nom_pago']=$value5['gral_param_propios']['GRAL_PAR_PRO_DESC'];
                          }
                    $array[$cont] = $json_data;
                    $cont++;
                    $fila++;
               }
               print_r(json_encode($array));
               
              break;
              case 'getCabeceraVentaPriv':
              //print_r("expression");
            $cliente_model = new Cliente();
            $list_cab=$home_model->getCabeceraPriv($_GET['id_prof']);
            //$list_cab=$home_model->getCabecera($_GET['id_prof']);
            //print_r($list_cab);
            $cont=0;
            foreach ($list_cab as $key => $value) {
              $json_data['vent_prof_cab_cod_prof']= $value['vent_prof_cab']['vent_prof_cab_cod_prof'];
              $json_data['vent_prof_cab_cod_cliente']= $value['vent_prof_cab']['vent_prof_cab_cod_cliente'];
              $cod_cliente=$cliente_model->getCodCliente($json_data['vent_prof_cab_cod_cliente']);
              $json_data['cod_cliente']= $cod_cliente[0]['vent_cliente']['vent_cli_codigo_cliente'];
              
              $nom_cliente=$cliente_model->getNombreCliente($json_data['vent_prof_cab_cod_cliente']);
                          foreach ($nom_cliente as $key => $value2) {
                            $json_data['nombre_cliente']=$value2['vent_cliente']['vent_cli_nombre'];
                            $json_data['ap_pat_cliente']=$value2['vent_cliente']['vent_cli_apellido_pat'];
                            $json_data['ap_mat_cliente']=$value2['vent_cliente']['vent_cli_apellido_mat'];
                          }

              $json_data['vent_prof_cab_cod_operador']= $value['vent_prof_cab']['vent_prof_cab_cod_operador'];
              $cod_op=$home_model->getDatosOpe2($json_data['vent_prof_cab_cod_operador']);
              $json_data['cod_operador']= $cod_op[0]['vent_operador']['vent_op_codigo'];
              $nom_op=$home_model->getNombreOp($json_data['vent_prof_cab_cod_operador']);
                          foreach ($nom_op as $key => $value3) {
                              $json_data['nom_op']=$value3['vent_operador']['vent_op_nombres'];
                              $json_data['ap_part_op']=$value3['vent_operador']['vent_op_ap_paterno'];
                              $json_data['ap_mat_op']=$value3['vent_operador']['vent_op_ap_materno'];
                               //$json_data['id_region_op']=$value3['vent_operador']['vent_op_agencia_cod'];
                              $region=$home_model->getRegionOp($value3['vent_operador']['vent_op_agencia_cod']);
                              foreach ($region as $key => $value31) {
                                $json_data['id_region_op']=$value31['gral_agencia']['GRAL_AGENCIA_SIGLA'];
                              }
                          }
              $json_data['vent_prof_cab_tipo_cot']= $value['vent_prof_cab']['vent_prof_cab_tipo_cot'];
              $json_data['vent_prof_cab_tipo_compra']= $value['vent_prof_cab']['vent_prof_cab_tipo_compra'];
              /*$nom_com=$home_model->getNomTipoCompra($json_data['vent_prof_cab_tipo_compra']);
                          foreach ($nom_com as $key => $value4) {
                            $json_data['nom_compra']=$value4['gral_param_propios']['GRAL_PAR_PRO_DESC'];
                          }*/
              $json_data['vent_prof_cab_forma_pago']= $value['vent_prof_cab']['vent_prof_cab_forma_pago'];
              $nom_pago=$home_model->getNomFormaPago($json_data['vent_prof_cab_forma_pago']);
                          foreach ($nom_pago as $key => $value5) {
                            $json_data['nom_pago']=$value5['gral_param_propios']['GRAL_PAR_PRO_DESC'];
                          }
              $json_data['vent_prof_cab_fech_cot']= $home_model->convertirNormal($value['vent_prof_cab']['vent_prof_cab_fech_cot']);
              //$json_data['vent_prof_cab_nom_cot']= $value['vent_prof_cab']['vent_prof_cab_nom_cot'];
              $json_data['vent_prof_cab_fech_entrega_cot']= $home_model->convertirNormal($value['vent_prof_cab']['vent_prof_cab_fech_entrega_cot']);
              $json_data['vent_prof_cab_nom_cotizado']= $value['vent_prof_cab']['vent_prof_cab_nom_cotizado'];
              $json_data['codigo_unico']=$_GET['id_prof'];
              $array[$cont] = $json_data;
              $cont++;
            }
            print_r(json_encode($array));
            //print_r($array); 
            break;

          case 'getDetalleVentaPriv':
            $cliente_model = new Cliente();
            //print_r($_GET['id_prof']);
            $list_det=$home_model->getDetallePriv($_GET['id_prof']);
            //print_r($list_det);  
            $cont=0;
            foreach ($list_det as $key => $value) {
              $json_data['vent_prof_cab_cod_unico']= $value['vent_prof_det']['vent_prof_cab_cod_unico'];
              $json_data['vent_prof_det_cod_unico']= $value['vent_prof_det']['vent_prof_det_cod_unico'];
              $json_data['vent_prof_det_cod_proveedor']= $value['vent_prof_det']['vent_prof_det_cod_proveedor'];
              $json_data['vent_prof_prod_cod_unico']= $value['vent_prof_det']['vent_prof_prod_cod_unico'];
              $json_data['vent_prof_det_precio_venta']= $value['vent_prof_det']['vent_prof_det_precio_venta'];
              $json_data['vent_prof_det_tipo_mon']=$value['vent_prof_det']['vent_prof_det_tipo_mon'];
              $datos_prod=$home_model->getDatosProd($json_data['vent_prof_prod_cod_unico']);
              //print_r($datos_prod); 
                  foreach ($datos_prod as $key => $value1) {
                    $json_data['nom_prod']= $value1['c']['alm_prod_cab_nombre'];
                  }
              $json_data['vent_prof_det_estado_prod']= $value['vent_prof_det']['vent_prof_det_estado_prod'];
              $json_data['vent_prof_det_tipo_prod']= $value['vent_prof_det']['vent_prof_det_tipo_prod'];
              $nom_tipo_prod=$home_model->getNomTipoProd($value['vent_prof_det']['vent_prof_det_tipo_prod']);
              //print_r($nom_tipo_prod);
                  foreach ($nom_tipo_prod as $key => $value2) {
                    $json_data['nom_tipo']= $value2['gral_param_propios']['GRAL_PAR_PRO_DESC'];
                  }   
              $json_data['vent_prof_det_cant_prod']= $value['vent_prof_det']['vent_prof_det_cant_prod'];
              $json_data['vent_prof_det_marca_prod']= $value['vent_prof_det']['vent_prof_det_marca_prod'];
              $json_data['venta_prof_det_proced_prod']= $value['vent_prof_det']['venta_prof_det_proced_prod'];
              $region=$home_model->getRegionOp($json_data['venta_prof_det_proced_prod']);
                              foreach ($region as $key => $value3) {
                                $json_data['region_prod']=$value3['gral_agencia']['GRAL_AGENCIA_SIGLA'];
                              }
              $json_data['vent_prof_det_tiempo_esp_prod']= $value['vent_prof_det']['vent_prof_det_tiempo_esp_prod'];
              $json_data['vent_prof_det_catalogo_prod']= $value['vent_prof_det']['vent_prof_det_catalogo_prod'];
              $json_data['catalogo']= $value[0]['catalogo'];
              $json_data['especif']= $value[0]['especif'];
              $json_data['conf']= $value[0]['conf'];
              $json_data['acces']= $value[0]['acces'];
              $json_data['vent_prof_det_serv_prof']= $value['vent_prof_det']['vent_prof_det_serv_prof'];
              $json_data['vent_prof_det_porc_serv_prof']= $value['vent_prof_det']['vent_prof_det_porc_serv_prof'];
              $nom_serv_nec=$home_model->getNomSerNec($json_data['vent_prof_det_serv_prof']);
              //print_r($nom_serv_nec);
                  foreach ($nom_serv_nec as $key => $value4) {
                    $json_data['nom_serv']= $value4['gral_param_propios']['GRAL_PAR_PRO_DESC'];
                  }              
              $array[$cont] = $json_data;
              $cont++;
            }

              print_r(json_encode($array));
              //print_r($array);  

            break;
             case 'eliminarVentaPriv':

             //print_r($_GET['id_unico']);
            if($ventas_model->eliminarVentas($_GET['id_unico'])){
                     $json_res['completo'] = true;
                }else{
                    $json_res['completo'] = false;
                }
                print_r(json_encode($json_res));
                //print_r($json_res);
            break;

            case 'eliminarItemVentaPriv':

              if($ventas_model->eliminarItemsVentas($_GET['id_unico'])){
                       $json_res['completo'] = true;
                  }else{
                      $json_res['completo'] = false;
                  }
                  print_r(json_encode($json_res));
                  //print_r($json_res);
              break;

            case 'getDetalleItemsVentaPriv' :
            //print_r($_GET['id_unico']);
                $datos = $ventas_model->getDetalleItemsVentaPriv($_GET['id_unico']);
                
                // print_r($datos);


                  $json_data['cod_cab_unico'] = $datos[0]['vpd']['vent_prof_cab_cod_unico']; 
                  $json_data['cod_det_unico'] = $datos[0]['vpd']['vent_prof_det_cod_unico'] ;
                  $json_data['cod_prod_unico'] = $datos[0]['vpd']['vent_prof_prod_cod_unico'] ;
                  $json_data['cantidad'] = $datos[0]['vpd']['vent_prof_det_cant_prod'] ;
                  $json_data['precio_venta'] = $datos[0]['vpd'] ['vent_prof_det_precio_venta'] ;
                  $json_data['tiempo'] = $datos[0]['vpd'] ['vent_prof_det_tiempo_esp_prod'] ;
                  $json_data['nombre'] = $datos[0]['apc'] ['alm_prod_cab_nombre'] ;



                     $array = $json_data;
                     print_r(json_encode($array));
                /*
                if($ventas_model->getDetalleItemsVentaPriv($_GET['id_unico'])){
                       $json_res['completo'] = true;
                  }else{
                      $json_res['completo'] = false;
                  }
                  */
                  //
                  //print_r($json_res);
              break;
               case "actualizarVentaPriv":
              //echo("CASE".$_GET);
               
               $venta_model->actualizarVentaPriv($_GET);
               /*if($home_model->guardarCotizaciones($_GET)){
                     $json_res['completo'] = true;
                }else{
                    $json_res['completo'] = false;
                }
                print_r(json_encode($json_res));*/
                //print_r($json_res);
              break;
        }
    }
}

?>