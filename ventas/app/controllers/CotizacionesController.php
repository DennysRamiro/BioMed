<?php
require_once "app/models/Home.php";
require_once "app/models/Cliente.php";
require_once "app/views/HomeView.php";
/**
 * Description of Router
 *
 * @author Daniel Fernandez
 */
class CotizacionesController {
    /*
     * Este es el metodo constructor para el proyecto
     */
    public function __construct() {
        
    }
    /*
     * Esta es la funcion que ejecuta y redirecciona la solicitud  que se haga
     */
    public function runIndex($tp){
        $home_model = new Home();
        switch ($tp) {
            case "buscarClientes":
              //echo($_GET['cliente_buscar']);
              //echo("ACA");
             
              $list_bus = $home_model->listarBusquedaClientes($_GET['cliente_buscar']);
              //print_r($list_bus);
              $cont = 0;
              foreach($list_bus as $key =>$value){
                $json_data['id']    = $value['vent_cliente']['vent_cli_cod_unico'];
                $json_data['label'] = $value['vent_cliente']['vent_cli_codigo_cliente']." ".$value['vent_cliente']['vent_cli_nombre']." ".$value['vent_cliente']['vent_cli_apellido_pat']." ".$value['vent_cliente']['vent_cli_apellido_mat'];
                $json_data['value'] = $value['vent_cliente']['vent_cli_nombre']." ".$value['vent_cliente']['vent_cli_apellido_pat']." ".$value['vent_cliente']['vent_cli_apellido_mat'];
                //$json_data['value'] = $value['vent_cliente']['vent_cli_codigo_cliente']." ".$value['vent_cliente']['vent_cli_nombre']." ".$value['vent_cliente']['vent_cli_apellido_pat']." ".$value['vent_cliente']['vent_cli_apellido_mat'];
                $array[$cont] = $json_data; 
                $cont++;
              }
              print_r(json_encode($array));
              //print_r($array);
              break;

            case 'buscarCotizacionesPriv':
              $cod_uni_op=$home_model->getCodUniOp($_SESSION['login']);
              $op=$cod_uni_op[0]['vent_operador']['vent_op_cod_unico'];
              $list_bus = $home_model->buscarCotizacionPriv($_GET['cotizacion_buscar'],$op);
              //print_r($list_bus);
              $cont = 0;
              foreach($list_bus as $key =>$value){
                $json_data['id']    = $value['c']['vent_prof_cab_cod_unico'];
                $json_data['label'] = $value['c']['vent_prof_cab_cod_prof']." ".$value['v']['vent_cli_nombre']." ".$value['v']['vent_cli_apellido_pat']." ".$value['o']['vent_op_nombres']." ".$value['o']['vent_op_ap_paterno'];
                $json_data['value'] = $value['c']['vent_prof_cab_cod_prof']." ".$value['v']['vent_cli_nombre']." ".$value['v']['vent_cli_apellido_pat']." ".$value['o']['vent_op_nombres']." ".$value['o']['vent_op_ap_paterno'];
                $array[$cont] = $json_data; 
                $cont++;
              }
              print_r(json_encode($array));
              //print_r($array);
              break;

             case 'buscarCotizacionesPubl':
              $cod_uni_op=$home_model->getCodUniOp($_SESSION['login']);
              $op=$cod_uni_op[0]['vent_operador']['vent_op_cod_unico'];
              $list_bus = $home_model->buscarCotizacionPubl($_GET['cotizacion_buscar'],$op);
              //print_r($list_bus);
              $cont = 0;
              foreach($list_bus as $key =>$value){
                $json_data['id']    = $value['c']['vent_prof_cab_cod_unico'];
                $json_data['label'] = $value['c']['vent_prof_cab_cod_prof']." ".$value['v']['vent_cli_nombre']." ".$value['v']['vent_cli_apellido_pat']." ".$value['o']['vent_op_nombres']." ".$value['o']['vent_op_ap_paterno'];
                $json_data['value'] = $value['c']['vent_prof_cab_cod_prof']." ".$value['v']['vent_cli_nombre']." ".$value['v']['vent_cli_apellido_pat']." ".$value['o']['vent_op_nombres']." ".$value['o']['vent_op_ap_paterno'];
                $array[$cont] = $json_data; 
                $cont++;
              }
              print_r(json_encode($array));
              //print_r($array);
              break;

            case 'buscarCotizacionesPrivBoton':
              //echo($_GET['cotizacion_buscar']);
              $cliente_model = new Cliente();
              $cod_uni_op=$home_model->getCodUniOp($_SESSION['login']);
              $op=$cod_uni_op[0]['vent_operador']['vent_op_cod_unico'];
              $bus_cot = $home_model->buscarCotizacionPrivBoton($_GET['cotizacion_buscar'],$_GET['start'],$_GET['limit'],$op);
              $fila = 1;
              $tot = $home_model->totalCotPrivBus($_GET['cotizacion_buscar'],$op);
              $json_data['total'] = $tot[0][0]['total'];
              //print_r($tot);
              $cont = 0;
              foreach ($bus_cot as $key => $value) {
                $json_data['vent_prof_cab_cod_prof']= $value['c']['vent_prof_cab_cod_prof'];
                $json_data['vent_prof_cab_cod_unico']= $value['c']['vent_prof_cab_cod_unico'];
                $json_data['vent_prof_cab_cod_cliente']= $value['c']['vent_prof_cab_cod_cliente'];
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
                $json_data['vent_prof_cab_cod_operador']= $value['c']['vent_prof_cab_cod_operador'];
                $nom_op=$home_model->getNombreOp($json_data['vent_prof_cab_cod_operador']);
                      foreach ($nom_op as $key => $value3) {
                          $json_data['nom_op']=$value3['vent_operador']['vent_op_nombres'];
                          $json_data['ap_part_op']=$value3['vent_operador']['vent_op_ap_paterno'];
                          $json_data['ap_mat_op']=$value3['vent_operador']['vent_op_ap_materno'];
                      }

                $json_data['vent_prof_cab_fech_cot'] = $home_model->convertirNormal($value['c']['vent_prof_cab_fech_cot']);
                $json_data['vent_prof_cab_fech_entrega_cot'] = $home_model->convertirNormal($value['c']['vent_prof_cab_fech_entrega_cot']);
                $json_data['vent_prof_cab_tipo_compra'] = $value['c']['vent_prof_cab_tipo_compra'];
                /*$nom_com=$home_model->getNomTipoCompra($json_data['vent_prof_cab_tipo_compra']);
                      foreach ($nom_com as $key => $value4) {
                        $json_data['nom_compra']=$value4['gral_param_propios']['GRAL_PAR_PRO_DESC'];
                      }*/
                $json_data['vent_prof_cab_forma_pago'] = $value['c']['vent_prof_cab_forma_pago'];
                $nom_pago=$home_model->getNomFormaPago($json_data['vent_prof_cab_forma_pago']);
                      foreach ($nom_pago as $key => $value5) {
                        $json_data['nom_pago']=$value5['gral_param_propios']['GRAL_PAR_PRO_DESC'];
                      }
                $json_data['cotizacion_buscar']= $_GET['cotizacion_buscar'];
                $array[$cont] = $json_data;
                $cont++;

              }
             print_r(json_encode($array));
             //print_r($array);
              break;

            case 'buscarCotizacionesPublBoton':
              /*echo($_GET['cotizacion_buscar']);
              echo($_GET['start']);
              echo($_GET['limit']);*/
              $cliente_model = new Cliente();
              $cod_uni_op=$home_model->getCodUniOp($_SESSION['login']);
              $op=$cod_uni_op[0]['vent_operador']['vent_op_cod_unico'];
              $bus_cot = $home_model->buscarCotizacionPublBoton($_GET['cotizacion_buscar'],$_GET['start'],$_GET['limit'],$op);
              //print_r($bus_cot);
              $fila = 1;
              $tot = $home_model->totalCotPublBus($_GET['cotizacion_buscar'],$op);
              $json_data['total'] = $tot[0][0]['total'];
              //print_r($tot);
              $cont = 0;
              foreach ($bus_cot as $key => $value) {
                $json_data['vent_prof_cab_cod_prof']= $value['c']['vent_prof_cab_cod_prof'];
                $json_data['vent_prof_cab_cod_unico']= $value['c']['vent_prof_cab_cod_unico'];
                $json_data['vent_prof_cab_cod_cliente']= $value['c']['vent_prof_cab_cod_cliente'];
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
                $json_data['vent_prof_cab_cod_operador']= $value['c']['vent_prof_cab_cod_operador'];
                $nom_op=$home_model->getNombreOp($json_data['vent_prof_cab_cod_operador']);
                      foreach ($nom_op as $key => $value3) {
                          $json_data['nom_op']=$value3['vent_operador']['vent_op_nombres'];
                          $json_data['ap_part_op']=$value3['vent_operador']['vent_op_ap_paterno'];
                          $json_data['ap_mat_op']=$value3['vent_operador']['vent_op_ap_materno'];
                      }

                $json_data['vent_prof_cab_fech_cot'] = $home_model->convertirNormal($value['c']['vent_prof_cab_fech_cot']);
                $json_data['vent_prof_cab_fech_entrega_cot'] = $home_model->convertirNormal($value['c']['vent_prof_cab_fech_entrega_cot']);
                $json_data['vent_prof_cab_tipo_compra'] = $value['c']['vent_prof_cab_tipo_compra'];
                $nom_com=$home_model->getNomTipoCompra($json_data['vent_prof_cab_tipo_compra']);
                      foreach ($nom_com as $key => $value4) {
                        $json_data['nom_compra']=$value4['gral_param_propios']['GRAL_PAR_PRO_DESC'];
                      }
                $json_data['vent_prof_cab_forma_pago'] = $value['c']['vent_prof_cab_forma_pago'];
                $nom_pago=$home_model->getNomFormaPago($json_data['vent_prof_cab_forma_pago']);
                      foreach ($nom_pago as $key => $value5) {
                        $json_data['nom_pago']=$value5['gral_param_propios']['GRAL_PAR_PRO_DESC'];
                      }
                $json_data['cotizacion_buscar']= $_GET['cotizacion_buscar'];
                $array[$cont] = $json_data;
                $cont++;

              }
              print_r(json_encode($array));
              //print_r($array);
              break;

            case "grabarCotizacionPriv":
              //echo("CASE".$_GET);
               
               $home_model->guardarCotizacionesPriv($_GET);
               /*if($home_model->guardarCotizaciones($_GET)){
                     $json_res['completo'] = true;
                }else{
                    $json_res['completo'] = false;
                }
                print_r(json_encode($json_res));*/
                //print_r($json_res);
              break;

            case "grabarCotizacionPubl":
              //echo("CASE".$_GET);
               
               $home_model->guardarCotizacionesPubl($_GET);
               /*if($home_model->guardarCotizaciones($_GET)){
                     $json_res['completo'] = true;
                }else{
                    $json_res['completo'] = false;
                }
                print_r(json_encode($json_res));*/
                //print_r($json_res);
              break;

            case "modificarCotizacionPriv":
              //echo("CASE".$_GET);
               
               $home_model->modificarCotizacionesPriv($_GET);
               /*if($home_model->guardarCotizaciones($_GET)){
                     $json_res['completo'] = true;
                }else{
                    $json_res['completo'] = false;
                }
                print_r(json_encode($json_res));*/
                //print_r($json_res);
              break;

            case "modificarCotizacionPubl":
              //echo("CASE".$_GET);
               
               $home_model->modificarCotizacionesPubl($_GET);
               /*if($home_model->guardarCotizaciones($_GET)){
                     $json_res['completo'] = true;
                }else{
                    $json_res['completo'] = false;
                }
                print_r(json_encode($json_res));*/
                //print_r($json_res);
              break;

            case 'listarCotizacionesPriv':
               $cliente_model = new Cliente();
               //echo $_GET['start'].' '.$_GET['limit'];
               $cod_uni_op=$home_model->getCodUniOp($_SESSION['login']);
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
                    /*$json_data['vent_prof_cab_tipo_compra'] = $value['vent_prof_cab']['vent_prof_cab_tipo_compra'];
                    $nom_com=$home_model->getNomTipoCompra($json_data['vent_prof_cab_tipo_compra']);
                          foreach ($nom_com as $key => $value4) {
                            $json_data['nom_compra']=$value4['gral_param_propios']['GRAL_PAR_PRO_DESC'];
                          }*/
                    $json_data['vent_prof_cab_forma_pago'] = $value['vent_prof_cab']['vent_prof_cab_forma_pago'];
                    $nom_pago=$home_model->getNomFormaPago($json_data['vent_prof_cab_forma_pago']);
                          foreach ($nom_pago as $key => $value5) {
                            $json_data['nom_pago']=$value5['gral_param_propios']['GRAL_PAR_PRO_DESC'];
                          }
                    $array[$cont] = $json_data;
                    $cont++;
                    $fila++;
               }
               //$json_data_final['datos'] = $array;
               //print_r($array);
               print_r(json_encode($array));
              break;

            case 'listarCotizacionesPubl':
               $cliente_model = new Cliente();
               //echo $_GET['start'].' '.$_GET['limit'];
              $cod_uni_op=$home_model->getCodUniOp($_SESSION['login']);
               $op=$cod_uni_op[0]['vent_operador']['vent_op_cod_unico'];
               $list_cot=$home_model->listaCotizacionPubl($_GET['start'],$_GET['limit'],$op);
               //print_r($list_cot);
               $fila = 1;
               $tot = $home_model->totalCotPubl($op);
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
                    $json_data['vent_prof_cab_tipo_compra'] = $value['vent_prof_cab']['vent_prof_cab_tipo_compra'];
                    $nom_com=$home_model->getNomTipoCompra($json_data['vent_prof_cab_tipo_compra']);
                          foreach ($nom_com as $key => $value4) {
                            $json_data['nom_compra']=$value4['gral_param_propios']['GRAL_PAR_PRO_DESC'];
                          }
                    $json_data['vent_prof_cab_forma_pago'] = $value['vent_prof_cab']['vent_prof_cab_forma_pago'];
                    $nom_pago=$home_model->getNomFormaPago($json_data['vent_prof_cab_forma_pago']);
                          foreach ($nom_pago as $key => $value5) {
                            $json_data['nom_pago']=$value5['gral_param_propios']['GRAL_PAR_PRO_DESC'];
                          }
                    $array[$cont] = $json_data;
                    $cont++;
                    $fila++;
               }
               //$json_data_final['datos'] = $array;
               //print_r($array);
               print_r(json_encode($array));
              break;


          case 'getCabeceraPriv':
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

          case 'getDetallePriv':
            $cliente_model = new Cliente();
            $list_det=$home_model->getDetallePriv($_GET['id_prof']);
            //print_r($list_det);  
            $cont=0;
            foreach ($list_det as $key => $value) {
              $json_data['vent_prof_cab_cod_unico']= $value['vent_prof_det']['vent_prof_cab_cod_unico'];
              $json_data['vent_prof_det_cod_unico']= $value['vent_prof_det']['vent_prof_det_cod_unico'];
              $json_data['vent_prof_det_cod_proveedor']= $value['vent_prof_det']['vent_prof_det_cod_proveedor'];
              $json_data['vent_prof_prod_cod_unico']= $value['vent_prof_det']['vent_prof_prod_cod_unico'];
              $json_data['vent_prof_det_precio_venta']= $value['vent_prof_det']['vent_prof_det_precio_venta'];
              $json_data['vent_prof_det_prod_id']=$value['vent_prof_det']['vent_prof_prod_cod_unico'];
              //print_r($value['vent_prof_det']['vent_prof_prod_cod_unico']);
              $datos_prod=$home_model->getDatosProd($value['vent_prof_det']['vent_prof_prod_cod_unico']);
              /*echo "--->";*/
             // print_r($datos_prod); 
              //foreach ($datos_prod as $key => $value1) {
              $json_data['nom_prod']= $datos_prod[0]['apc']['alm_prod_cab_nombre'];
              //}
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

          case 'detallarCotizacionesPriv':
            $cliente_model = new Cliente();
            $modif_cot=$home_model->getDatosCot($_GET['id_unico']);
            //print_r($modif_cot);
            $cont=0;
            foreach ($modif_cot as $key => $value) {
              $json_data['vent_prof_cab_cod_unico']= $value['vent_prof_cab']['vent_prof_cab_cod_unico'];
              $json_data['vent_prof_cab_cod_prof']= $value['vent_prof_cab']['vent_prof_cab_cod_prof'];
              $json_data['vent_prof_cab_cod_cliente']= $value['vent_prof_cab']['vent_prof_cab_cod_cliente'];
              $cod_cliente=$cliente_model->getCodCliente($json_data['vent_prof_cab_cod_cliente']);
              $json_data['codigo_cliente']= $cod_cliente[0]['vent_cliente']['vent_cli_codigo_cliente'];
              $nom_cliente=$cliente_model->getNombreCliente($json_data['vent_prof_cab_cod_cliente']);
                          foreach ($nom_cliente as $key => $value2) {
                            $json_data['nombre_cliente']=$value2['vent_cliente']['vent_cli_nombre'];
                            $json_data['ap_pat_cliente']=$value2['vent_cliente']['vent_cli_apellido_pat'];
                            $json_data['ap_mat_cliente']=$value2['vent_cliente']['vent_cli_apellido_mat'];
                          }

              $json_data['vent_prof_cab_cod_operador']= $value['vent_prof_cab']['vent_prof_cab_cod_operador'];
              $json_data['vent_prof_cab_tipo_cot']= $value['vent_prof_cab']['vent_prof_cab_tipo_cot'];
              //$json_data['vent_prof_cab_tipo_compra']= $value['vent_prof_cab']['vent_prof_cab_tipo_compra'];
              $json_data['vent_prof_cab_forma_pago']= $value['vent_prof_cab']['vent_prof_cab_forma_pago'];

              $json_data['vent_prof_cab_fech_cot']= $home_model->convertirNormal($value['vent_prof_cab']['vent_prof_cab_fech_cot']);
              $json_data['vent_prof_cab_fech_entrega_cot']= $home_model->convertirNormal($value['vent_prof_cab']['vent_prof_cab_fech_entrega_cot']);
              $json_data['vent_prof_cab_nom_cotizado']= $value['vent_prof_cab']['vent_prof_cab_nom_cotizado'];
              $array[$cont] = $json_data;
              $cont++;
            }
            print_r(json_encode($array));
            break;

          case 'detallarCotizacionesPubl':
            $cliente_model = new Cliente();
            $modif_cot=$home_model->getDatosCot($_GET['id_unico']);
            //print_r($modif_cot);
            $cont=0;
            foreach ($modif_cot as $key => $value) {
              $json_data['vent_prof_cab_cod_unico']= $value['vent_prof_cab']['vent_prof_cab_cod_unico'];
              $json_data['vent_prof_cab_cod_prof']= $value['vent_prof_cab']['vent_prof_cab_cod_prof'];
              $json_data['vent_prof_cab_cod_cliente']= $value['vent_prof_cab']['vent_prof_cab_cod_cliente'];
              $cod_cliente=$cliente_model->getCodCliente($json_data['vent_prof_cab_cod_cliente']);
              $json_data['codigo_cliente']= $cod_cliente[0]['vent_cliente']['vent_cli_codigo_cliente'];
              $nom_cliente=$cliente_model->getNombreCliente($json_data['vent_prof_cab_cod_cliente']);
                          foreach ($nom_cliente as $key => $value2) {
                            $json_data['nombre_cliente']=$value2['vent_cliente']['vent_cli_nombre'];
                            $json_data['ap_pat_cliente']=$value2['vent_cliente']['vent_cli_apellido_pat'];
                            $json_data['ap_mat_cliente']=$value2['vent_cliente']['vent_cli_apellido_mat'];
                          }

              $json_data['vent_prof_cab_cod_operador']= $value['vent_prof_cab']['vent_prof_cab_cod_operador'];
              $json_data['vent_prof_cab_tipo_cot']= $value['vent_prof_cab']['vent_prof_cab_tipo_cot'];
              $json_data['vent_prof_cab_tipo_compra']= $value['vent_prof_cab']['vent_prof_cab_tipo_compra'];
              $json_data['vent_prof_cab_forma_pago']= $value['vent_prof_cab']['vent_prof_cab_forma_pago'];

              $json_data['vent_prof_cab_fech_cot']= $home_model->convertirNormal($value['vent_prof_cab']['vent_prof_cab_fech_cot']);
              $json_data['vent_prof_cab_fech_entrega_cot']= $home_model->convertirNormal($value['vent_prof_cab']['vent_prof_cab_fech_entrega_cot']);
              $json_data['vent_prof_cab_nom_cotizado']= $value['vent_prof_cab']['vent_prof_cab_nom_cotizado'];
              $array[$cont] = $json_data;
              $cont++;
            }
            print_r(json_encode($array));
            break;
          case 'getDatosBusCotPriv':
           //echo("control");
            $cliente_model = new Cliente();
            $cot_bus=$home_model->getDatosBusCotPriv($_GET['id_unico']);
            $cont=0;
            foreach ($cot_bus as $key => $value) {
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
              /*$json_data['vent_prof_cab_tipo_compra'] = $value['vent_prof_cab']['vent_prof_cab_tipo_compra'];
              $nom_com=$home_model->getNomTipoCompra($json_data['vent_prof_cab_tipo_compra']);
                    foreach ($nom_com as $key => $value4) {
                      $json_data['nom_compra']=$value4['gral_param_propios']['GRAL_PAR_PRO_DESC'];
                    }*/
              $json_data['vent_prof_cab_forma_pago'] = $value['vent_prof_cab']['vent_prof_cab_forma_pago'];
              $nom_pago=$home_model->getNomFormaPago($json_data['vent_prof_cab_forma_pago']);
                    foreach ($nom_pago as $key => $value5) {
                      $json_data['nom_pago']=$value5['gral_param_propios']['GRAL_PAR_PRO_DESC'];
                    }
              $array[$cont] = $json_data;
              $cont++;
            }
            //print_r($array);
            print_r(json_encode($array));
            break;

          case 'getDatosBusCotPubl':
           //echo("control");
            $cliente_model = new Cliente();
            $cot_bus=$home_model->getDatosBusCotPubl($_GET['id_unico']);
            $cont=0;
            foreach ($cot_bus as $key => $value) {
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
              $json_data['vent_prof_cab_tipo_compra'] = $value['vent_prof_cab']['vent_prof_cab_tipo_compra'];
              $nom_com=$home_model->getNomTipoCompra($json_data['vent_prof_cab_tipo_compra']);
              foreach ($nom_com as $key => $value4) {
                $json_data['nom_compra']=$value4['gral_param_propios']['GRAL_PAR_PRO_DESC'];
              }
              $json_data['vent_prof_cab_forma_pago'] = $value['vent_prof_cab']['vent_prof_cab_forma_pago'];
              $nom_pago=$home_model->getNomFormaPago($json_data['vent_prof_cab_forma_pago']);
              foreach ($nom_pago as $key => $value5) {
                $json_data['nom_pago']=$value5['gral_param_propios']['GRAL_PAR_PRO_DESC'];
              }
              $array[$cont] = $json_data;
              $cont++;
            }
            //print_r($array);
            print_r(json_encode($array));
            break;

          case 'listarProductosStock': // este es el que lista los productos del stock
            $productos = $home_model->listarProductosStock();
            $cont = 0 ;
            foreach ($productos as $key => $value) {
             // print_r($value);
              $json_data[$cont] = array_merge($value['apc'],$value[0], $value['apd']);
              $cont++;

            }
            print(json_encode($json_data));
            break;
          case 'buscarProductosStock': //Esta es cuando busca por plabra
              $productos = $home_model->listarProductosStockPalabra($_GET['producto']);
             // print_r($productos);
              $cont = 0 ;
              foreach ($productos as $key => $value) {
                //$json_data[$cont] = array_merge($value['apc'],$value[0], $value['apd']);
                $json_data['id']    = $value['apd']['alm_prod_det_id_unico'];
                //$json_data['label'] = $value['apc']['alm_prod_cab_codigo']." ".$value['apc']['alm_prod_cab_nombre']." ".$value['apc']['alm_prod_det_marca']." ".$value['apd']['alm_prod_cab_nom_prov'];
                $json_data['label'] = "CODIGO:".$value['apc']['alm_prod_cab_codigo']." NOMBRE:".$value['apc']['alm_prod_cab_nombre']." MARCA:".$value['apd']['alm_prod_det_marca']." PROVEEDOR:".$value[0]['alm_prod_cab_nom_prov'];
                $json_data['value'] = $value['apc']['alm_prod_cab_nombre'];
                //$json_data['value'] = $value['vent_cliente']['vent_cli_codigo_cliente']." ".$value['vent_cliente']['vent_cli_nombre']." ".$value['vent_cliente']['vent_cli_apellido_pat']." ".$value['vent_cliente']['vent_cli_apellido_mat'];
                $array[$cont] = $json_data; 
                $cont++;
              }
              print(json_encode($array));
            break;
          case 'productoEnfocado': // Este caso es cuando se enfoca al producto
            $productos = $home_model->listarProductoEnfocadoStock($_GET['id_producto_unico']);
            $cont = 0 ;
            foreach ($productos as $key => $value) {
              $json_data[$cont] = array_merge($value['apc'],$value[0], $value['apd']);
              $cont++;
            }
            print(json_encode($json_data));
            break;
          case 'buscarProductosStockXPalabra':
             $productos = $home_model->listarProductosStockPalabra($_GET['producto']);
             // print_r($productos);
              $cont = 0 ;
              foreach ($productos as $key => $value) {
                $json_data[$cont] = array_merge($value['apc'],$value[0], $value['apd']);
                $array[$cont] = $json_data; 
                $cont++;
              }
              print(json_encode($array));
            break;
          case 'getProductoInformation':
              $productos = $home_model->getProductoInformation($_GET['codigo_cab'], $_GET['codigo_det']);
              //print_r($productos);
             
              print(json_encode($productos[0]));
            break;
          case 'getServicesOnProducto':
            //echo "Ok-->";
            $productos = $home_model->getServiciosProducto();
            $cont = 0;
            foreach ($productos as $key => $value) {
              $json_data['GRAL_PAR_PRO_COD']= $value['gral_param_propios']['GRAL_PAR_PRO_COD'];
              $json_data['GRAL_PAR_PRO_DESC']= $value['gral_param_propios']['GRAL_PAR_PRO_DESC'];
              $json_data['GRAL_PAR_PRO_CTA1']= $value['gral_param_propios']['GRAL_PAR_PRO_CTA1'];
              $array[$cont] = $json_data;
              $cont++;
            }
            print(json_encode($array));
            break;
          case 'getServicesXID':
            $productos = $home_model->getServicesXID($_GET['id_service']);
            $cont=0;
            foreach ($productos as $key => $value) {
              $json_data['GRAL_PAR_PRO_CTA1']= $value['gral_param_propios']['GRAL_PAR_PRO_CTA1'];
              $array[$cont] = $json_data;
              $cont++;
            }
            print(json_encode($array));
            break;
          case 'getTipoProductoXIni':
            $productos = $home_model->getTipoProductoXInicial($_GET['inicial']);
            $cont=0;
            foreach ($productos as $key => $value) {
              $json_data['GRAL_PAR_PRO_COD'] = $value['gral_param_propios']['GRAL_PAR_PRO_COD'];
              $json_data['GRAL_PAR_PRO_DESC']= $value['gral_param_propios']['GRAL_PAR_PRO_DESC'];
              $array[$cont] = $json_data;
              $cont++;
            }
            print(json_encode($array));
            break;
          case '':
            break;
          case 'listaTipoCompra':
            $tipo_compra=$home_model->getTipoCompra();
            $cont=0;
            foreach ($tipo_compra as $key => $value) {
              $json_data['GRAL_PAR_PRO_COD']= $value['gral_param_propios']['GRAL_PAR_PRO_COD'];
              $json_data['GRAL_PAR_PRO_DESC']= $value['gral_param_propios']['GRAL_PAR_PRO_DESC'];
              $array[$cont] = $json_data;
              $cont++;
            }
            print_r(json_encode($array));
            break;

          case 'listaFormaPago':
            $forma_pago=$home_model->getFormaPago();
            $cont=0;
            foreach ($forma_pago as $key => $value) {
              $json_data['GRAL_PAR_PRO_COD']= $value['gral_param_propios']['GRAL_PAR_PRO_COD'];
              $json_data['GRAL_PAR_PRO_DESC']= $value['gral_param_propios']['GRAL_PAR_PRO_DESC'];
              $array[$cont] = $json_data;
              $cont++;
            }
            print_r(json_encode($array));
            
            break;

          case 'eliminarCotizacionesPriv':

            if($home_model->eliminarCotizaciones($_GET['id_unico'])){
                     $json_res['completo'] = true;
                }else{
                    $json_res['completo'] = false;
                }
                print_r(json_encode($json_res));
                //print_r($json_res);
            break;

           case 'eliminarCotizacionesPubl':
                if($home_model->eliminarCotizaciones($_GET['id_unico'])){
                     $json_res['completo'] = true;
                }else{
                    $json_res['completo'] = false;
                }
                print_r(json_encode($json_res));
                //print_r($json_res);
            break;
          case 'registrarNuevaProducto':
               $home_model->registrarNuevoProducto($_POST);
            break;
          case 'eliminarDetProfVenta':
                $home_model->eliminarDetaProfVenta($_GET);
            break;
          case 'getDetalleProductoEspecif':
                $detalle_producto = $home_model->getDetalleProductoEspecif($_GET);
               // print_r($detalle_producto);
                $json_data['id_codigo_unico_det'] = $detalle_producto[0]['vpd']['vent_prof_det_cod_unico'];
                $json_data['precio_venta_max_det_prod'] = $detalle_producto[0]['apd']['alm_prod_det_prec_max_venta'];
                $json_data['precio_venta_min_det_prod'] = $detalle_producto[0]['apd']['alm_prod_det_prec_min_venta'];
                $json_data['vent_precio_venta_prof'] = $detalle_producto[0]['vpd']['vent_prof_det_precio_venta'];
                $json_data['cantidad_vent_prof_prod'] = $detalle_producto[0]['vpd']['vent_prof_det_cant_prod'];
                print_r(json_encode($json_data));
            break;
          case 'updatePrecioCantProd':
                $home_model->setNuevaCantidadPrecio($_GET);
            break;
        }
    }
}

?>
