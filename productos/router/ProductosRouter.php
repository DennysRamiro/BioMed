<?php
session_start();
require_once '../lib/Mysql.php';
require_once '../clases/Productos.php';
require_once '../clases/Utilitarios.php';

/**
 * Esta clase gestiona las acciones de los productos
 */
class ProductosRouter{
	/**
	 * Metodo que realiza el ejecutar la accion 
	 * @param $action esta es la accion
	 */
	public function ejecutarAccion($accion){
		
		$productos = new Productos();
		
		switch($accion){
			
		case 'listarProductosGeneral':
				$lista_productos = $productos->listaGeneralProductos();
				$cont=0;
				foreach ($lista_productos as $key => $value) {
					$json_data['alm_prod_cab_codigo'] = $value['pc']['alm_prod_cab_codigo'];
					$json_data['alm_prod_cab_nombre'] = $value['pc']['alm_prod_cab_nombre'];
					$json_data['tipo'] = $value[0]['tipo'];
					$json_data['cantidad'] = $value[0]['cantidad'];
					$json_data['alm_prod_det_prec_compra'] = $value['pd']['alm_prod_det_prec_compra'];
					$json_data['alm_prod_det_prec_venta'] = $value['pd']['alm_prod_det_prec_venta'];
					$json_data['AGE_ORIG'] = $value[0]['AGE_ORIG'];
					$json_data['ESTADO'] = $value[0]['ESTADO'];
					$json_data['codigo_unico_producto'] = $value['pc']['alm_prod_cab_id_unico_prod'];
					$datos[$cont] = $jsçon_data;
					$cont++;
				}
				print(json_encode($datos));
			break;
		case'cargarTipo':
				//print_r("seguimos");
				$lista_tipos = $productos->ListaMaterial();
				
				$cont = 0;
				foreach($lista_tipos as $key => $value){
					//print_r($value);
					$json_data['nombre']= $value['gral_param_propios']['GRAL_PAR_PRO_DESC'];
					$json_data['codigo']= $value['gral_param_propios']['GRAL_PAR_PRO_COD'];
					$json_data['sigla']= $value['gral_param_propios']['GRAL_PAR_PRO_SIGLA'];	
					$array[$cont] = $json_data;
				    $cont++;
				}
				 print_r(json_encode($array));
			break;
				
		case'cargarProveedor':
					//print_r("seguimos");
					$lista_proveedor = $productos->listaProveedor();
					
					$cont = 0;
					foreach($lista_proveedor as $key => $value){
						//print_r($value);
						$json_data['cod_int']= $value['alm_proveedor']['alm_prov_codigo_int'];
						$json_data['nom_prov']= $value['alm_proveedor']['alm_prov_nombre'];
							
						$array[$cont] = $json_data;
						$cont++;
						
					}
					 print_r(json_encode($array));
			break;
				
		case'cargarMedida':
					//print_r("seguimos");
					$lista_medida = $productos->listaMedida();
					//print_r($lista_medida);
					$cont = 0;
					foreach($lista_medida as $key => $value){
						//print_r($value);
						$json_data['cod_medida']= $value['gral_param_propios']['GRAL_PAR_PRO_COD'];
						$json_data['sigla_medida']= $value['gral_param_propios']['GRAL_PAR_PRO_SIGLA'];
						$json_data['nom_medida']= $value['gral_param_propios']['GRAL_PAR_PRO_DESC'];
						$array[$cont] = $json_data;
						$cont++;
						
					}
					//print_r($array);
					 print_r(json_encode($array));
			break;
		case'cargarMoneda':
					//print_r("seguimos");
					$lista_moneda = $productos->listaMoneda();
					//print_r($lista_medida);
					$cont = 0;
					foreach($lista_moneda as $key => $value){
						//print_r($value);
						$json_data['cod_moneda']= $value['gral_param_super_int']['GRAL_PAR_INT_COD'];
						$json_data['sigla_moneda']= $value['gral_param_super_int']['GRAL_PAR_INT_SIGLA'];
						$json_data['nom_moneda']= $value['gral_param_super_int']['GRAL_PAR_INT_DESC'];
						$array[$cont] = $json_data;
						$cont++;
					
					}
					 print_r(json_encode($array));
			break;
		case'cargarSucursalOrigen':
					//print_r("seguimos");
					$lista_moneda = $productos->listaSucursalOrigen();
					//print_r($lista_medida);
					$cont = 0;
					foreach($lista_moneda as $key => $value){
						//print_r($value);
						$json_data['cod_agencia']= $value['gral_agencia']['GRAL_AGENCIA_CODIGO'];
						$json_data['sigla_agencia']= $value['gral_agencia']['GRAL_AGENCIA_SIGLA'];
						$json_data['nom_agencia']= $value['gral_agencia']['GRAL_AGENCIA_NOMBRE'];
						$array[$cont] = $json_data;
						$cont++;
						
					}
					 print_r(json_encode($array));
			break;
		case'cargarEstado':
					//print_r("seguimos");
					$lista_moneda = $productos->listaEstado();
					//print_r($lista_medida);
					$cont = 0;
					foreach($lista_moneda as $key => $value){
						//print_r($value);
					    $json_data['cod_estado']= $value['gral_param_propios']['GRAL_PAR_PRO_COD'];
						$json_data['sigla_estado']= $value['gral_param_propios']['GRAL_PAR_PRO_SIGLA'];
						$json_data['nom_estado']= $value['gral_param_propios']['GRAL_PAR_PRO_DESC'];
						$array[$cont] = $json_data;
						$cont++;
						
					}
					 print_r(json_encode($array));
			break;
			
		
		case 'buscarProductos':
				 $list_bus = $productos->listarBusquedaProductos($_GET['proyecto_buscar']);
				// print_r($list_bus);
				 $cont = 0;
				 foreach($list_bus as $key =>$value){
					$json_data['id']    = $value['alm_prod_cabecera']['alm_prod_cab_id_unico_prod'];
					$json_data['label'] = $value['alm_prod_cabecera']['alm_prod_cab_codigo']." ".$value['alm_prod_cabecera']['alm_prod_cab_nombre']." ".$value['alm_prod_cabecera']['alm_prod_cab_cod_ref'];
					$json_data['value'] = $value['alm_prod_cabecera']['alm_prod_cab_codigo']." ".$value['alm_prod_cabecera']['alm_prod_cab_nombre'];
					$array[$cont] = $json_data; 
					$cont++;
				 }
				 print_r(json_encode($array));
		     break;

		case 'productoEnfocadoListaAutocomplete':

			$util = new Utilitarios();
			$lista_producto_enfocado = $productos->listaBusquedaProductoEnfocado($_GET['id_producto'], $_GET['codigo_producto']);
			$cont=0;
			foreach ($lista_producto_enfocado as $key => $value) {
				//print_r($value);
				$json_data['alm_prod_cab_codigo'] = $value['pc']['alm_prod_cab_codigo'];
				$json_data['alm_prod_cab_nombre'] = $value['pc']['alm_prod_cab_nombre'];
				$json_data['alm_prod_cab_fecha_proceso'] =$util->cambiaf_a_normal($value['pc']['alm_prod_cab_fecha_proceso']);
				$json_data['tipo'] = $value[0]['Tipo'];
				$json_data['cantidad'] = $value[0]['cantidad'];
				//$json_data['alm_prod_det_prec_compra'] = $value['pd']['alm_prod_det_prec_compra'];
				//$json_data['alm_prod_det_prec_venta'] = $value['pd']['alm_prod_det_prec_venta'];
				$json_data['AGE_ORIG'] = $value[0]['AGE_ORIG'];
				$json_data['ESTADO'] = $value[0]['ESTADO'];
				$json_data['codigo_unico_producto'] = $value['pc']['alm_prod_cab_id_unico_prod'];
				$datos[$cont] = $json_data;
			}
			print(json_encode($datos));
			break;
		case 'productoSeleccionados':

				//print_r($_GET['id_pro']."--". $_GET['cod_proy']);
		    $util = new Utilitarios();
            $producto_seleccionado  = $productos->seleccionarProducto($_GET['id_pro'], $_GET['cod_proy']);
			$cont=0;
			foreach ($producto_seleccionado as $key => $value) {
				//print_r($value);
				$json_data['alm_prod_cab_codigo'] = $value['pc']['alm_prod_cab_codigo'];
				$json_data['alm_prod_cab_nombre'] = $value['pc']['alm_prod_cab_nombre'];
				$json_data['alm_prod_cab_fecha_proceso'] = $util->cambiaf_a_normal($value['pc']['alm_prod_cab_fecha_proceso']);
				$json_data['tipo'] = $value[0]['Tipo'];
				$json_data['cantidad'] = $value[0]['cantidad'];
				//$json_data['alm_prod_det_prec_compra'] = $value['pd']['alm_prod_det_prec_compra'];
				//$json_data['alm_prod_det_prec_venta'] = $value['pd']['alm_prod_det_prec_venta'];
				$json_data['AGE_ORIG'] = $value[0]['AGE_ORIG'];
				$json_data['ESTADO'] = $value[0]['ESTADO'];
				$json_data['codigo_unico_producto'] = $value['pc']['alm_prod_cab_id_unico_prod'];
				$datos[$cont] = $json_data;
			}
			print(json_encode($datos));
			break;

		case 'buscarXPalabraConBtn':

		 		$util = new Utilitarios();
				$lista_prod = $productos->listaProductosxPalabra($_GET['palabra']);
				$cont = 0;
				foreach($lista_prod  as $key => $value){
					//print_r($value);
					$json_data['alm_prod_cab_codigo'] = $value['pc']['alm_prod_cab_codigo'];
					$json_data['alm_prod_cab_nombre'] = $value['pc']['alm_prod_cab_nombre'];
					$json_data['alm_prod_cab_fecha_proceso'] = $util->cambiaf_a_normal($value['pc']['alm_prod_cab_fecha_proceso']);
					$json_data['tipo'] = $value['0']['Tipo'];
					$json_data['cantidad'] = $value['0']['cantidad'];
					$json_data['alm_prod_det_prec_compra'] = $value['pd']['alm_prod_det_prec_compra'];
					$json_data['alm_prod_det_prec_venta'] = $value['pd']['alm_prod_det_prec_venta'];
					$json_data['AGE_ORIG'] = $value['0']['AGE_ORIG'];
					$json_data['ESTADO'] = $value['0']['ESTADO'];
					$json_data['codigo_unico_producto'] = $value['pc']['alm_prod_cab_id_unico_prod']; 
					$array[$cont] = $json_data; 
					$cont++;
				}
				print_r(json_encode($array));
			break;


		case 'insertarCabecera':
		
		    $util = new utilitarios();
		
			//print_r($_POST);
			
		/*	echo $_POST['cod_ref']."<br>";
			echo $_POST['tipo']."<br>";
			echo $_POST['prov']."<br>";
			echo $_POST['nom']."<br>";
			echo $_POST['desc']."<br>";
			echo $_POST['cantidad']."<br>";
			echo $_POST['fech_proce']."<br>";
			echo $_POST['unidad']."<br>";
			echo $_POST['moneda']."<br>";
			echo $_POST['prest']."<br>";
			echo $_POST['suc_org']."<br>";
			echo $_POST['imag']."<br>";
			echo $_POST['dat_tec']."<br>";
			echo $_POST['prest']."<br>";
			echo $util->crearCodigo($_POST['tipo'],$_POST['prov'])."<br>";
			echo $_SESSION['login']."<br>";
			echo $_SESSION['fec_proc']."<br>";
			*/
//mod Nela			
			//print_r("router");
			$productos->grabarCabeceraProductos($_POST['cod_ref'],$_POST['tipo'],$_POST['prov'],$_POST['nom'],$_POST['desc'],$_POST['cantidad'],$_POST['fech_proce'],$_POST['unidad'],$_POST['moneda'],$_POST['prest'],$_POST['suc_org'],$_FILES,$_SESSION['login'],$_SESSION['fec_proc'],$_POST['marca']);
		/*	*/
			break;
		
		case 'insertarDetalle':
		
		$util = new utilitarios();
			/*		
			echo $_POST['serie']."<br>";
			echo $_POST['cantidad']."<br>";
			echo $_POST['p_c']."<br>";
			echo $_POST['p_v']."<br>";
			echo $_POST['p_min_v']."<br>";
			echo $_POST['p_max_v']."<br>";
			echo $_POST['fech_venc']."<br>";
			echo $_POST['part_number']."<br>";
			echo $_POST['t_c']."<br>";
			echo $_POST['lote']."<br>";
			echo $_POST['marca']."<br>";
			echo $_POST['estado']."<br>";
			echo $_SESSION['login']."<br>";
			echo $_SESSION['fec_proc']."<br>";
			echo "fecha :".$_POST['fech_ingreso']."<br>";
			echo "codigo : ".$_POST['cod_cab_det']."<br>";
			*/
			$productos->grabarDetalleProductos($_POST['serie'],$_POST['cantidad'],$_POST['p_c'],$_POST['p_v'],$_POST['p_min_v'],$_POST['p_max_v'],$_POST['fech_venc'], $_POST['part_number'],$_POST['t_c'],$_POST['lote'],$_POST['estado'],$_POST['cod_cab_det'],$_POST['fech_ingreso'],$_SESSION['login'],$_SESSION['fec_proc']);
		/*	*/
			break;
		
		case 'listaCabecera': // Obtiene los datos de la cabecera despues  registrar
		
				$util = new utilitarios();
				$lista_cab = $productos->listaCabecera($_POST['codigo']);
				$cont = 0;
					foreach($lista_cab as $key => $value){
						//print_r($value);
					    $json_data['alm_prod_cab_codigo']= $value['alm_prod_cabecera']['alm_prod_cab_codigo'];
					    $json_data['alm_prod_cab_fecha_proceso']= $util->cambiaf_a_normal($value['alm_prod_cabecera']['alm_prod_cab_fecha_proceso']);
						$json_data['alm_prod_cab_cod_ref']= $value['alm_prod_cabecera']['alm_prod_cab_cod_ref'];
						$json_data['alm_prod_cab_id_unico_prod']= $value['alm_prod_cabecera']['alm_prod_cab_id_unico_prod'];
						$json_data['alm_prod_cab_tipo']= $value['alm_prod_cabecera']['alm_prod_cab_tipo'];
						$json_data['alm_prod_cab_prov']= $value['alm_prod_cabecera']['alm_prod_cab_prov'];
						$json_data['alm_prod_cab_nombre']= $value['alm_prod_cabecera']['alm_prod_cab_nombre'];
						$json_data['alm_prod_cab_descripcion']= $value['alm_prod_cabecera']['alm_prod_cab_descripcion'];
						$json_data['alm_prod_cab_unidad']= $value['alm_prod_cabecera']['alm_prod_cab_unidad'];
						$json_data['alm_prod_cab_cantidad_stock']= $value['alm_prod_cabecera']['alm_prod_cab_cantidad_stock'];
						$json_data['alm_prod_cab_presentacion']= $value['alm_prod_cabecera']['alm_prod_cab_presentacion'];
						$json_data['alm_prod_cab_moneda']= $value['alm_prod_cabecera']['alm_prod_cab_moneda'];
						$json_data['alm_prod_cab_img']= $value['alm_prod_cabecera']['alm_prod_cab_img'];
						$json_data['alm_prod_cab_pdf_descp']= $value['alm_prod_cabecera']['alm_prod_cab_pdf_descp'];
						$json_data['alm_prod_cab_marca']= $value['alm_prod_cabecera']['alm_prod_cab_marca'];
						$json_data['tipo']= $value['0']['tipo'];
						$json_data['proveedor']= $value['0']['proveedor'];
						$json_data['unidad']= $value['0']['UNIDAD'];
						$json_data['moneda']= $value['0']['MONEDA'];
						$json_data['age_orig']= $value['0']['AGE_ORIG'];
						$array[$cont] = $json_data;
						$cont++;
					/**/
						
					}
					 print_r(json_encode($array));
			break;
			
		case 'cargardetalleProducto':
			
					//echo $_POST['codigo'];
					$util = new utilitarios();
				 	$det_prod = $productos->CargarDetProductos($_POST['codigo']);
				 	if (empty($det_prod)) {
					//echo "VACIO";				
						$json_data['alm_prod_det_id']= '';
						$json_data['alm_prod_cab_codigo']= '';
						$json_data['alm_prod_cab_fec_ing']= '';
						$json_data['alm_prod_det_id_unico']= '';
						$json_data['alm_prod_det_serie']= '';
						$json_data['alm_prod_det_cantidad']= '';
						$json_data['alm_prod_det_prec_compra']= '';
						$json_data['alm_prod_det_prec_venta']= '';
						$json_data['alm_prod_det_prec_max_venta']= '';
						$json_data['alm_prod_det_prec_min_venta']= '';
						$json_data['alm_prod_det_estado']= '';
						$json_data['alm_prod_det_fecha_venc']= '';
						$json_data['alm_prod_det_lote']= '';
						$json_data['alm_prod_det_part_number']= '';
						$json_data['alm_prod_det_tc']= '';
						$json_data['tipo']=0;
						$array[0] = $json_data;     
				    print_r(json_encode($array));
				    } else{
						$cont = 0;
						foreach($det_prod as $key => $value){
							//print_r($value);
						    $json_data['alm_prod_det_id']= $value['alm_prod_detalle']['alm_prod_det_id'];
							$json_data['alm_prod_cab_codigo']= $value['alm_prod_detalle']['alm_prod_cab_codigo'];
							$json_data['alm_prod_cab_fec_ing']= $util->cambiaf_a_normal($value['alm_prod_detalle']['alm_prod_cab_fec_ing']);
							$json_data['alm_prod_det_id_unico']= $value['alm_prod_detalle']['alm_prod_det_id_unico'];
							$json_data['alm_prod_det_serie']= $value['alm_prod_detalle']['alm_prod_det_serie'];
							$json_data['alm_prod_det_cantidad']= $value['alm_prod_detalle']['alm_prod_det_cantidad'];
							$json_data['alm_prod_det_prec_compra']= $value['alm_prod_detalle']['alm_prod_det_prec_compra'];
							$json_data['alm_prod_det_prec_venta']= $value['alm_prod_detalle']['alm_prod_det_prec_venta'];
							$json_data['alm_prod_det_prec_max_venta']= $value['alm_prod_detalle']['alm_prod_det_prec_max_venta'];
							$json_data['alm_prod_det_prec_min_venta']= $value['alm_prod_detalle']['alm_prod_det_prec_min_venta'];
							$json_data['alm_prod_det_estado']= $value['alm_prod_detalle']['alm_prod_det_estado'];
							$json_data['alm_prod_det_fecha_venc']= $util->cambiaf_a_normal($value['alm_prod_detalle']['alm_prod_det_fecha_venc']);
							$json_data['alm_prod_det_lote']= $value['alm_prod_detalle']['alm_prod_det_lote'];
							$json_data['alm_prod_det_part_number']= $value['alm_prod_detalle']['alm_prod_det_part_number'];
							$json_data['alm_prod_det_tc']= $value['alm_prod_detalle']['alm_prod_det_tc'];
							$json_data['tipo']=1;
							$array[$cont] = $json_data;
							$cont++;
							
						}
						//print_r($array);
						print_r(json_encode($array));
				    }
			break;
			
		case 'listarModificarCabecera':
				$util = new utilitarios();
				$lista_cab = $productos->listaCabeceraModificar($_POST['codigo']);
				$cont = 0;
			    //$lista_cab = $productos->listaCabecera($_POST['codigo']);
				foreach($lista_cab as $key => $value){
					//print_r($value);
					
				    $json_data['alm_prod_cab_codigo']= $value['alm_prod_cabecera']['alm_prod_cab_codigo'];
				    $json_data['alm_prod_cab_fecha_proceso']= $util->cambiaf_a_normal($value['alm_prod_cabecera']['alm_prod_cab_fecha_proceso']);
					$json_data['alm_prod_cab_cod_ref']= $value['alm_prod_cabecera']['alm_prod_cab_cod_ref'];
					$json_data['alm_prod_cab_id_unico_prod']= $value['alm_prod_cabecera']['alm_prod_cab_id_unico_prod'];
					$json_data['alm_prod_cab_tipo']= $value['alm_prod_cabecera']['alm_prod_cab_tipo'];
					$json_data['alm_prod_cab_prov']= $value['alm_prod_cabecera']['alm_prod_cab_prov'];
					$json_data['alm_prod_cab_nombre']= $value['alm_prod_cabecera']['alm_prod_cab_nombre'];
					$json_data['alm_prod_cab_descripcion']= $value['alm_prod_cabecera']['alm_prod_cab_descripcion'];
					$json_data['alm_prod_cab_unidad']= $value['alm_prod_cabecera']['alm_prod_cab_unidad'];
					$json_data['alm_prod_cab_cantidad_stock']= $value['alm_prod_cabecera']['alm_prod_cab_cantidad_stock'];
					$json_data['alm_prod_cab_presentacion']= $value['alm_prod_cabecera']['alm_prod_cab_presentacion'];
					$json_data['alm_prod_cab_moneda']= $value['alm_prod_cabecera']['alm_prod_cab_moneda'];
					$json_data['alm_prod_cab_img']= $value['alm_prod_cabecera']['alm_prod_cab_img'];
					$json_data['alm_prod_cab_pdf_descp']= $value['alm_prod_cabecera']['alm_prod_cab_pdf_descp'];
					$json_data['alm_prod_cab_marca']= $value['alm_prod_cabecera']['alm_prod_cab_marca'];
					$json_data['alm_prod_cab_suc_origen']= $value['alm_prod_cabecera']['alm_prod_cab_suc_origen'];					
					$json_data['tipo']= $value['0']['tipo'];
					$json_data['proveedor']= $value['0']['proveedor'];
					$json_data['unidad']= $value['0']['UNIDAD'];
					$json_data['moneda']= $value['0']['MONEDA'];
					$json_data['age_orig']= $value['0']['AGE_ORIG'];
					

					$array[$cont] = $json_data;
					$cont++;
				/**/
					
				}
				 //print_r($array);
				 print_r(json_encode($array));
		    break;
		
		case 'cargardetalleProducto':		
			 	$det_prod = $productos->CargarDetProductos($_POST['codigo']);
				$cont = 0;
				foreach($det_prod as $key => $value){
					//print_r($value);
				    $json_data['alm_prod_det_id']= $value['alm_prod_detalle']['alm_prod_det_id'];
					$json_data['alm_prod_cab_codigo']= $value['alm_prod_detalle']['alm_prod_cab_codigo'];
					$json_data['alm_prod_cab_fec_ing']= $value['alm_prod_detalle']['alm_prod_cab_fec_ing'];
					$json_data['alm_prod_det_id_unico']= $value['alm_prod_detalle']['alm_prod_det_id_unico'];
					$json_data['alm_prod_det_serie']= $value['alm_prod_detalle']['alm_prod_det_serie'];
					$json_data['alm_prod_det_cantidad']= $value['alm_prod_detalle']['alm_prod_det_cantidad'];
					$json_data['alm_prod_det_prec_compra']= $value['alm_prod_detalle']['alm_prod_det_prec_compra'];
					$json_data['alm_prod_det_prec_venta']= $value['alm_prod_detalle']['alm_prod_det_prec_venta'];
					$json_data['alm_prod_det_prec_max_venta']= $value['alm_prod_detalle']['alm_prod_det_prec_max_venta'];
					$json_data['alm_prod_det_prec_min_venta']= $value['alm_prod_detalle']['alm_prod_det_prec_min_venta'];
					$json_data['alm_prod_det_estado']= $value['alm_prod_detalle']['alm_prod_det_estado'];
					$json_data['alm_prod_det_fecha_venc']= $value['alm_prod_detalle']['alm_prod_det_fecha_venc'];
					$json_data['alm_prod_det_lote']= $value['alm_prod_detalle']['alm_prod_det_lote'];
					$json_data['alm_prod_det_part_number']= $value['alm_prod_detalle']['alm_prod_det_part_number'];
					$json_data['alm_prod_det_tc']= $value['alm_prod_detalle']['alm_prod_det_tc'];
					$array[$cont] = $json_data;
					$cont++;
				}
				//print_r($array);
				print_r(json_encode($array));
		    break;
		
		case 'listarModificarCabecera':
			$util = new utilitarios();
			$lista_cab = $productos->listaCabeceraModificar($_POST['codigo']);
			$cont = 0;
			foreach($lista_cab as $key => $value){
				
				//print_r($value);
			    $json_data['alm_prod_cab_codigo']= $value['alm_prod_cabecera']['alm_prod_cab_codigo'];
			    $json_data['alm_prod_cab_fecha_proceso']= $util->cambiaf_a_normal($value['alm_prod_cabecera']['alm_prod_cab_fecha_proceso']);
				$json_data['alm_prod_cab_cod_ref']= $value['alm_prod_cabecera']['alm_prod_cab_cod_ref'];
				$json_data['alm_prod_cab_id_unico_prod']= $value['alm_prod_cabecera']['alm_prod_cab_id_unico_prod'];
				$json_data['alm_prod_cab_tipo']= $value['alm_prod_cabecera']['alm_prod_cab_tipo'];
				$json_data['alm_prod_cab_prov']= $value['alm_prod_cabecera']['alm_prod_cab_prov'];
				$json_data['alm_prod_cab_nombre']= $value['alm_prod_cabecera']['alm_prod_cab_nombre'];
				$json_data['alm_prod_cab_descripcion']= $value['alm_prod_cabecera']['alm_prod_cab_descripcion'];
				$json_data['alm_prod_cab_unidad']= $value['alm_prod_cabecera']['alm_prod_cab_unidad'];
				$json_data['alm_prod_cab_cantidad_stock']= $value['alm_prod_cabecera']['alm_prod_cab_cantidad_stock'];
				$json_data['alm_prod_cab_presentacion']= $value['alm_prod_cabecera']['alm_prod_cab_presentacion'];
				$json_data['alm_prod_cab_moneda']= $value['alm_prod_cabecera']['alm_prod_cab_moneda'];
				$json_data['alm_prod_cab_img']= $value['alm_prod_cabecera']['alm_prod_cab_img'];
				$json_data['alm_prod_cab_pdf_descp']= $value['alm_prod_cabecera']['alm_prod_cab_pdf_descp'];
				$json_data['alm_prod_cab_marca']= $value['alm_prod_cabecera']['alm_prod_cab_marca'];
				$json_data['alm_prod_cab_suc_origen']= $value['alm_prod_cabecera']['alm_prod_cab_suc_origen'];
				$json_data['alm_prod_cab_numerico']= $value['alm_prod_cabecera']['alm_prod_cab_numerico'];
				$json_data['tipo']= $value['0']['tipo'];
				$json_data['proveedor']= $value['0']['proveedor'];
				$json_data['unidad']= $value['0']['UNIDAD'];
				$json_data['moneda']= $value['0']['MONEDA'];
				$json_data['age_orig']= $value['0']['AGE_ORIG'];
				$array[$cont] = $json_data;
				$cont++;
			/**/
				
			}
			 print_r(json_encode($array));
				
		    break;

		case 'detalleCabeceraModif':
			$util = new utilitarios();
			$det_cab = $productos->getCabeceraProd($_POST['codigo']);
			//print_r($det_cab);
			$cont = 0;
			foreach ($det_cab as $key => $value) {
				$json_data['alm_prod_cab_codigo']= $value['alm_prod_cabecera']['alm_prod_cab_codigo'];
			    $json_data['alm_prod_cab_fecha_proceso']= $util->cambiaf_a_normal($value['alm_prod_cabecera']['alm_prod_cab_fecha_proceso']);
				$json_data['alm_prod_cab_cod_ref']= $value['alm_prod_cabecera']['alm_prod_cab_cod_ref'];
				$json_data['alm_prod_cab_id_unico_prod']= $value['alm_prod_cabecera']['alm_prod_cab_id_unico_prod'];
				$json_data['alm_prod_cab_tipo']= $value['alm_prod_cabecera']['alm_prod_cab_tipo'];
				$tipo_prod=$productos->getTipoProd($json_data['alm_prod_cab_tipo']);
					foreach ($tipo_prod as $key => $value1) {
						$json_data['tipo']=$value1['gral_param_propios']['GRAL_PAR_PRO_DESC'];
					}
				$json_data['alm_prod_cab_prov']= $value['alm_prod_cabecera']['alm_prod_cab_prov'];
				$nom_prov=$productos->getNomProv($json_data['alm_prod_cab_prov']);
				//print_r($nom_prov);
				$json_data['proveedor']=$nom_prov[0]['alm_proveedor']['alm_prov_nombre'];
				$json_data['alm_prod_cab_nombre']= $value['alm_prod_cabecera']['alm_prod_cab_nombre'];
				$json_data['alm_prod_cab_descripcion']= $value['alm_prod_cabecera']['alm_prod_cab_descripcion'];
				$json_data['alm_prod_cab_unidad']= $value['alm_prod_cabecera']['alm_prod_cab_unidad'];
				$uni_prod=$productos->getUnidadProd($json_data['alm_prod_cab_unidad']);
					foreach ($uni_prod as $key => $value2) {
						$json_data['unidad']=$value2['gral_param_propios']['GRAL_PAR_PRO_DESC'];
					}
				$json_data['alm_prod_cab_cantidad_stock']= $value['alm_prod_cabecera']['alm_prod_cab_cantidad_stock'];
				$json_data['alm_prod_cab_presentacion']= $value['alm_prod_cabecera']['alm_prod_cab_presentacion'];
				$json_data['alm_prod_cab_moneda']= $value['alm_prod_cabecera']['alm_prod_cab_moneda'];
				$mon_prod=$productos->getMonProd($json_data['alm_prod_cab_moneda']);
					foreach ($mon_prod as $key => $value3) {
						$json_data['moneda']=$value3['gral_param_super_int']['GRAL_PAR_INT_DESC'];
					}
				$json_data['alm_prod_cab_img']= $value['alm_prod_cabecera']['alm_prod_cab_img'];
				$json_data['alm_prod_cab_pdf_descp']= $value['alm_prod_cabecera']['alm_prod_cab_pdf_descp'];
				$json_data['alm_prod_cab_marca']= $value['alm_prod_cabecera']['alm_prod_cab_marca'];
				$json_data['alm_prod_cab_suc_origen']= $value['alm_prod_cabecera']['alm_prod_cab_suc_origen'];
				$suc_prod=$productos->getRegionOp($json_data['alm_prod_cab_suc_origen']);
				$json_data['age_orig']=$suc_prod[0]['gral_agencia']['GRAL_AGENCIA_NOMBRE'];
				$json_data['alm_prod_cab_numerico']= $value['alm_prod_cabecera']['alm_prod_cab_numerico'];
				$json_data['marca']= $value[0]['marca'];
				$array[$cont] = $json_data;
				$cont++;	
			}

			//print_r($array);
			print_r(json_encode($array));
			
			break;
		case 'modificarCabecera':
		
			$util = new utilitarios();
			/*
			echo $_POST['cod_ref']."<br>";
			echo $_POST['codigo']."<br>";
			echo $_POST['tipo']."<br>";
			echo $_POST['unico']."<br>";
			echo $_POST['prov']."<br>";
			echo $_POST['nom']."<br>";
			echo $_POST['desc']."<br>";
			echo $_POST['cantidad']."<br>";
			echo $_POST['fech_proce']."<br>";
			echo $_POST['unidad']."<br>";
			echo $_POST['moneda']."<br>";
			echo $_POST['prest']."<br>";
			echo $_POST['suc_org']."<br>";
			echo $_POST['imag']."<br>";
			echo $_POST['dat_tec']."<br>";
			echo $_POST['prest']."<br>";
			echo $_POST['marca']."<br>";
		//	echo $util->crearCodigo($_POST['tipo'],$_POST['prov'])."<br>";
			echo $_SESSION['login']."<br>";
			echo $_SESSION['fec_proc']."<br>";
			
		*/
		
			
			$productos->actualizaProductos($_POST['codigo'],$_POST['unico'],$_POST['cod_ref'],$_POST['tipo'],$_POST['prov'],$_POST['nom'],$_POST['desc'],
			      $_POST['cantidad'],$_POST['fech_proce'],$_POST['unidad'],$_POST['moneda'],$_POST['prest'],$_POST['suc_org'],$_POST['imag'],$_POST['dat_tec'],
			      $_SESSION['login'],$_SESSION['fec_proc'],$_POST['marca'],$_POST['numerico']);

			$util = new utilitarios();
			$det_prod = $productos->listarDetProductos($_POST['codigo'],$_POST['id']);
			$cont = 0;
				foreach($det_prod as $key => $value){
						///print_r($value);
					    $json_data['alm_prod_det_id']= $value['alm_prod_detalle']['alm_prod_det_id'];
						$json_data['alm_prod_cab_codigo']= $value['alm_prod_detalle']['alm_prod_cab_codigo'];
						$json_data['alm_prod_cab_fec_ing']= $util->cambiaf_a_normal($value['alm_prod_detalle']['alm_prod_cab_fec_ing']);
						//$json_data['alm_prod_det_marca']= $value['alm_prod_detalle']['alm_prod_det_marca'];
						$json_data['alm_prod_det_serie']= $value['alm_prod_detalle']['alm_prod_det_serie'];
						$json_data['alm_prod_det_cantidad']= $value['alm_prod_detalle']['alm_prod_det_cantidad'];
						$json_data['alm_prod_det_prec_compra']= $value['alm_prod_detalle']['alm_prod_det_prec_compra'];
						$json_data['alm_prod_det_prec_venta']= $value['alm_prod_detalle']['alm_prod_det_prec_venta'];
						$json_data['alm_prod_det_prec_max_venta']= $value['alm_prod_detalle']['alm_prod_det_prec_max_venta'];
						$json_data['alm_prod_det_prec_min_venta']= $value['alm_prod_detalle']['alm_prod_det_prec_min_venta'];
						$json_data['alm_prod_det_estado']= $value['alm_prod_detalle']['alm_prod_det_estado'];
						$json_data['alm_prod_det_fecha_venc']= $util->cambiaf_a_normal($value['alm_prod_detalle']['alm_prod_det_fecha_venc']);
						$json_data['alm_prod_det_lote']= $value['alm_prod_detalle']['alm_prod_det_lote'];
						$json_data['alm_prod_det_part_number']= $value['alm_prod_detalle']['alm_prod_det_part_number'];
						$json_data['alm_prod_det_tc']= $value['alm_prod_detalle']['alm_prod_det_tc'];
						$array[$cont] = $json_data;
						$cont++;
						
				}
					//print_r(json_encode($array));
					print_r($array);
			break;

			case 'modificarCabeceraModif':	
			$productos->actualizaProductos($_POST['codigo'],$_POST['unico'],$_POST['cod_ref'],$_POST['tipo'],$_POST['prov'],$_POST['nom'],$_POST['desc'],
			      $_POST['cantidad'],$_POST['fech_proce'],$_POST['unidad'],$_POST['moneda'],$_POST['prest'],$_POST['suc_org'],$_SESSION['login'],$_SESSION['fec_proc'],$_POST['marca'],$_POST['numerico']);
			break;
			case 'modificarProductoWithImgDet':
				$productos->modificarProductoWithImgDet($_POST['codigo'],$_POST['unico'],$_POST['num'], $_POST['cod_ref'],$_POST['tipo'],$_POST['prov'],$_POST['nom'],$_POST['desc'],
			    $_POST['cantidad'],$_POST['fech_proce'],$_POST['unidad'],$_POST['moneda'],$_POST['prest'],$_POST['suc_org'],$_SESSION['login'],$_SESSION['fec_proc'],$_POST['marca'], $_FILES);
				break;
			case 'cantidadTotalItem' :
			//print_r($_POST['codigo']);
					$total = $productos->cantidadTotalItem($_POST['codigo']);
					
					$json_data['total']=$total[0][0]['cantidad'];
					print_r(json_encode($json_data));

			break;

			case 'eliminarCabecera' :
				if($productos->darBajaProductos($_POST['cod'], $_POST['nom'],$_SESSION['login'])){
					$json_data['completo'] = true;	
				}else{
					$json_data['completo'] = false;
				}
				print_r(json_encode($json_data));
		    break;
		
		case 'cargarDetallePaModificar':

			$util = new utilitarios();
			//print_r($_POST['codCab']);

			$cod_cab = $productos->obtenerCodCab($_POST['codCab']);
			//print_r($cod_cab);

			$json_data['todo']=$cod_cab[0]['alm_prod_cabecera']['alm_prod_cab_codigo'];

			$det_prod = $productos->listarDetProductos($_POST['codigo'],$_POST['id']);
			//print_r($det_prod);
				$cont = 0;
				foreach($det_prod as $key => $value){
					///print_r($value);
				    $json_data['alm_prod_det_id']= $value['alm_prod_detalle']['alm_prod_det_id'];
					$json_data['alm_prod_cab_codigo']= $value['alm_prod_detalle']['alm_prod_cab_codigo'];
					$cod_prod= $productos->getCodProducto($json_data['alm_prod_cab_codigo']);
					$json_data['codigo_producto']= $cod_prod[0]['alm_prod_cabecera']['alm_prod_cab_codigo'];
					$json_data['alm_prod_cab_fec_ing']= $util->cambiaf_a_normal($value['alm_prod_detalle']['alm_prod_cab_fec_ing']);
					//$json_data['alm_prod_det_marca']= $value['alm_prod_detalle']['alm_prod_det_marca'];
					$json_data['alm_prod_det_serie']= $value['alm_prod_detalle']['alm_prod_det_serie'];
					$json_data['alm_prod_det_cantidad']= $value['alm_prod_detalle']['alm_prod_det_cantidad'];
					$json_data['alm_prod_det_prec_compra']= $value['alm_prod_detalle']['alm_prod_det_prec_compra'];
					$json_data['alm_prod_det_prec_venta']= $value['alm_prod_detalle']['alm_prod_det_prec_venta'];
					$json_data['alm_prod_det_prec_max_venta']= $value['alm_prod_detalle']['alm_prod_det_prec_max_venta'];
					$json_data['alm_prod_det_prec_min_venta']= $value['alm_prod_detalle']['alm_prod_det_prec_min_venta'];
					$json_data['alm_prod_det_estado']= $value['alm_prod_detalle']['alm_prod_det_estado'];
					$json_data['alm_prod_det_fecha_venc']= $util->cambiaf_a_normal($value['alm_prod_detalle']['alm_prod_det_fecha_venc']);
					$json_data['alm_prod_det_lote']= $value['alm_prod_detalle']['alm_prod_det_lote'];
					$json_data['alm_prod_det_part_number']= $value['alm_prod_detalle']['alm_prod_det_part_number'];
					$json_data['alm_prod_det_tc']= $value['alm_prod_detalle']['alm_prod_det_tc'];
					$array[$cont] = $json_data;
					$cont++;
					

				}

				$json_data['todo']= $array;
				print_r(json_encode($json_data));
		    break;

		case 'cargarDetallePaModificar2':

			$util = new utilitarios();
			$det_prod = $productos->listarDetProductos($_POST['codigo'],$_POST['id']);
			//print_r($det_prod);
				$cont = 0;
				foreach($det_prod as $key => $value){
					///print_r($value);
				    $json_data['alm_prod_det_id']= $value['alm_prod_detalle']['alm_prod_det_id'];
					$json_data['alm_prod_cab_codigo']= $value['alm_prod_detalle']['alm_prod_cab_codigo'];
					$cod_prod= $productos->getCodProducto($json_data['alm_prod_cab_codigo']);
					$json_data['codigo_producto']= $cod_prod[0]['alm_prod_cabecera']['alm_prod_cab_codigo'];
					$json_data['alm_prod_cab_fec_ing']= $util->cambiaf_a_normal($value['alm_prod_detalle']['alm_prod_cab_fec_ing']);
					//$json_data['alm_prod_det_marca']= $value['alm_prod_detalle']['alm_prod_det_marca'];
					$json_data['alm_prod_det_serie']= $value['alm_prod_detalle']['alm_prod_det_serie'];
					$json_data['alm_prod_det_cantidad']= $value['alm_prod_detalle']['alm_prod_det_cantidad'];
					$json_data['alm_prod_det_prec_compra']= $value['alm_prod_detalle']['alm_prod_det_prec_compra'];
					$json_data['alm_prod_det_prec_venta']= $value['alm_prod_detalle']['alm_prod_det_prec_venta'];
					$json_data['alm_prod_det_prec_max_venta']= $value['alm_prod_detalle']['alm_prod_det_prec_max_venta'];
					$json_data['alm_prod_det_prec_min_venta']= $value['alm_prod_detalle']['alm_prod_det_prec_min_venta'];
					$json_data['alm_prod_det_estado']= $value['alm_prod_detalle']['alm_prod_det_estado'];
					$json_data['alm_prod_det_fecha_venc']= $util->cambiaf_a_normal($value['alm_prod_detalle']['alm_prod_det_fecha_venc']);
					$json_data['alm_prod_det_lote']= $value['alm_prod_detalle']['alm_prod_det_lote'];
					$json_data['alm_prod_det_part_number']= $value['alm_prod_detalle']['alm_prod_det_part_number'];
					$json_data['alm_prod_det_tc']= $value['alm_prod_detalle']['alm_prod_det_tc'];
					$array[$cont] = $json_data;
					$cont++;
					

				}
				print_r(json_encode($array));
		    break;
		
		case 'eliminarCabecera' :
			if($productos->darBajaProductos($_POST['cod'], $_POST['nom'],$_SESSION['login'])){
				$json_data['completo'] = true;	
			}else{
				$json_data['completo'] = false;
			}
			print_r(json_encode($json_data));

		    break;

		case 'eliminarDetalle' :

				//echo ($_POST['cod']."--". $_POST['nom']);
			if($productos->darBajadDetProductos($_POST['cod'], $_POST['id'],$_SESSION['login'])){
				$json_data['completo'] = true;	
			}else{
				$json_data['completo'] = false;
			}
			print_r(json_encode($json_data));

		    break;

		case 'deleteDetalleProductos':
				//echo($_POST['codigo']."-".$_POST['id']."-". $_SESSION['login']);
				if($productos->darBajaDetProductos($_POST['codigo'], $_POST['id'], $_SESSION['login'])){
					$json_data['completo baj'] = true;	
				}else{
					$json_data['completo baj'] = false;
				}
				print_r(json_encode($json_data));
			break;
			
		case 'updateDetalleProducto':

		//print_r($_POST['estado_producto_me']);
			
				if($productos->updateDetProductos($_POST['codigo'],$_POST['id'],$_POST['fech_ingreso_me'],$_POST['serie_me'],$_POST['cant_prod_deta_me'],$_POST['estado_producto_me'],$_POST['p_c_me'],$_POST['p_v_me'],$_POST['p_min_v_me'],$_POST['p_max_v_me'],$_POST['fech_venc_me'],$_POST['part_number_me'],$_POST['t_c_me'],$_POST['lot_me'], $_SESSION['login'])){
					$json_data['completo'] = true;	
				}else{
					$json_data['completo'] = false;
				}
				print_r(json_encode($json_data));
			break;
		
		case 'updateCantidadCabecera':
		//print_r("expression");
		
			//print_r($_POST['codigo']."--".$_POST['cantidad']);
			if($productos->updateCantidadCab($_POST['codigo'],$_POST['cantidad'])){
				$json_data['completo'] = true;	
			}else{
				$json_data['completo'] = false;
			}
			print_r(json_encode($json_data));
			/**/
		break;
		
		}
	}
}	
			
$producto_router = new ProductosRouter(); // Este es el router intanciado
if($_SERVER['REQUEST_METHOD'] == "POST"){
	$accion = $_POST['accion'];
}elseif($_SERVER['REQUEST_METHOD'] == "GET"){
	$accion = $_GET['accion'];
} 
$producto_router->ejecutarAccion($accion);
?>