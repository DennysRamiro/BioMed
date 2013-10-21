<?php
require_once '../lib/Mysql.php';
require_once 'Proyecto.php';
require_once 'Utilitarios.php';
require_once 'Proveedor.php';
/**
 * Clase contrato gestiona todas las consultas y formulario de certificado
 * @Ruth Palomino ARGO SI 
 * @date 16/05/2013
 */
class HojaCosto{
	// Esta es la variable mysql
	private $mysql;
	/*
	 * Este es el constructor de la clase contrato
	 * @param  parm1 -> signigica esto
	 *         param2 -> significa esta otra cosa
	 * @return  variable, variable[] -> descripscion 
	 */
	public function __construct() {
		// Constructor
		$this->mysql = new Mysql();
	}

	/*
	* Metodo que crear el formulario del certificado 
	*/
	/*public function formularioHojaCosto(){
		$template = file_get_contents('tpl/hoja_costo_tpl.html');
	    print($template);
		
	}*/


	/*
	* Metodo que crear el formulario del hoja Cabecera 
	*/
	public function generarCabeceraHoja(){
		$template = file_get_contents('tpl/hoja_costo_tpl.html');
	    print($template);
		
	}

	public function formularioListaItems(){
		$template = file_get_contents('tpl/lista_item_hoja_tpl.html');
	    print($template);	
	}

	public function serieDialog(){
		$template = file_get_contents('tpl/serie_dialog_form_tpl.html');
	    print($template);	
	}
	public function grabarCabecera(){
		$template = file_get_contents('tpl/serie_dialog_form_tpl.html');
	    print($template);	
	}

	/*
	* Metodo que crear el formulario del hoja Cabecera 
	*/
	/*public function actualizarDetalleHoja(){
		$template = file_get_contents('tpl/hoja_costo_tpl.html');
	    print($template);
		
	}*/

	/*
	* Metodo que crear la lista de los certificados
	*/
	public function formularioListaHojaCosto(){
		$template = file_get_contents('tpl/lista_hoja_tpl.html');
	    print($template);
		
	}

	/*
	* Metodo formulario detallar los certificados
	*/
	public function formularioDetallarCertificado(){
		//echo "LLEGO PHP".$id_certificado;
		//$tipos = $this->listaTipos();
		$template = file_get_contents('tpl/detallar_certificado_tpl.html');
	    print($template);
		
	}

	public function procesarFormDet(){
		$template = file_get_contents('tpl/dialogo_msg_hoja_tpl.html');
	    print($template);	
	}

	public function formularioItemsAlmacen(){
	$template = file_get_contents('tpl/item_hoja_form_tpl.html');
    print($template);	
	}

		/* Este es el metodo para grabar los datos de formulario de certificados
	*  
	*/
	public function grabarCertificado($numero_documento, $codigo_proyecto, $fec_doc, $descripcion_cert, $login, $fec_proc){
		//echo("GRABAR PHP CERT");
		$util = new Utilitarios();
		//echo $numero_documento;
		//echo $codigo_proyecto;
		//echo $fec_doc1=$util->cambiaf_a_mysql($fec_doc);
		//ECHO $fec_doc;
		//echo $descripcion_cert;
		//echo $login;
		//echo $fec_proc; 		
		$valor['alm_form_id']=NULL;
		$valor['alm_form_tipo'] =9;
		$valor['alm_form_nro_doc'] = $numero_documento;
		$valor['alm_form_fecha_doc'] = $util->cambiaf_a_mysql($fec_doc);
		$valor['alm_proy_cod'] = $codigo_proyecto;
		$valor['alm_form_fecha_registro'] = $util->cambiaf_a_mysql($fec_proc);
		$valor['alm_form_observaciones'] = $descripcion_cert;
		$valor['alm_form_usr_alta'] = $login;
		if($this->mysql->insert('alm_form_importacion', $valor)){
			$json_data['completo'] = true;
			$json_data['tipo_formulario']=9;
			$json_data['codigo_proyecto']=$codigo_proyecto;
		}else{
			$json_data['completo'] = false;
		}
		print(json_encode($json_data));
	}

		/* Este es el metodo para grabar los datos de formulario de certificados
	*  
	*/
	public function grabarCabeceraProducto($codigo_proyecto,$cod_prov,$id_item,
		$nom_prod,$ref_prod,$cant_prod,$pu_prod,
		$uni_prod,$mon_prod,$tipo_prod,$login,$fec_proc){
		//echo("GRABAR PHP CERT");
		
		$util = new Utilitarios();
		$existe = $this->almacenProducto($nom_prod,$cod_prov);
		$fecha= $util->obtenerFechaActual();
		
		if (empty($existe)) {
		$codigo_interno=$util->crearCodigo($tipo_prod,$cod_prov);
		$codigo_unico=$util->generaNumeroOrdenUnico();
		$valor['alm_prod_cab_codigo']=$codigo_interno;
		$valor['alm_prod_cab_numerico']=$_SESSION['correlativo'];
		$valor['alm_prod_cab_cod_ref']=$ref_prod;
		$valor['alm_prod_cab_id_unico_prod']=$codigo_unico;
		$valor['alm_prod_cab_tipo']=$tipo_prod;
		$valor['alm_prod_cab_fecha_proceso']=$fecha;
		$valor['alm_prod_cab_prov']=$cod_prov;
		$valor['alm_prod_cab_nombre']=$nom_prod;
		$valor['alm_prod_cab_unidad']=$uni_prod;
		$valor['alm_prod_cab_cantidad_stock']=$cant_prod;
		$valor['alm_prod_cab_moneda']=$mon_prod;
		$valor['alm_prod_cab_suc_origen']=21;
		$valor['alm_prod_cab_usr_alta']=$login;
		$valor['alm_prod_cab_fch_hr_alta']=$util->cambiaf_a_mysql($fec_proc);;
		if($this->mysql->insert('alm_prod_cabecera', $valor)){
			$json_data['completo'] = true;
			$json_data['codigo_proy']=$codigo_proyecto;
			$json_data['codigo_unico']=$codigo_unico;
			$json_data['codigo_prod']=$codigo_interno;
			$json_data['codigo_prov']=$cod_prov;
			$json_data['cant_prod']=$cant_prod;
		}else{
			$json_data['completo'] = false;
		}
		print(json_encode($json_data)); 

		//echo("vacio");
		}else{
	
		echo("no vacio");

		}	
 
	}

	/*
	* Metodo para grabar lo modificado en los certificados
	*/

	public function modificarDetalleCertificado($id_certificado, $codigo_proyecto,$numero_documento,$fec_doc,$descripcion_cert, $login, $fec_proc){
	//echo("GRABAR PHP CERT");
	$util = new Utilitarios();
	//echo $id_certificado;
	//echo $codigo_proyecto;
	//echo $numero_documento;
	//echo $fec_doc;
	//echo $descripcion_cert;
	//echo $login;
	//echo $fec_proc; 
	$fecha= $util->obtenerFechaActual();
	$value['alm_form_usr_baja']=$login;
	$value['alm_form_fch_baja']=$fecha;
	//echo $fecha; 
	
		if ($this->mysql->update('alm_form_importacion',$value,'alm_form_id='.$id_certificado.'')) {
			//return true; 

	$valor['alm_form_id']=NULL;
	$valor['alm_form_tipo'] =9;
	$valor['alm_form_nro_doc'] = $numero_documento;
	$valor['alm_form_fecha_doc'] = $util->cambiaf_a_mysql($fec_doc);
	$valor['alm_proy_cod'] = $codigo_proyecto;
	$valor['alm_form_fecha_registro'] = $util->cambiaf_a_mysql($fec_proc);
	$valor['alm_form_observaciones'] = $descripcion_cert;
	$valor['alm_form_usr_alta'] = $login;
		if($this->mysql->insert('alm_form_importacion', $valor)){
			$json_data['completo'] = true;
			$json_data['tipo_formulario']=9;
			$json_data['codigo_proyecto']=$codigo_proyecto;
		}else{
			$json_data['completo'] = false;
		}
		print(json_encode($json_data));

		}else{
		 return false;
	  }


	}

		/*
	* Metodo para grabar lo modificado en los certificados
	*/

	public function updateProducto($id_prod,$costo_prod,$login,$fec_proc){
		//echo("updateProducto");
		$cont=0;
		foreach ($id_prod as $key => $value) {
		  $cont=$cont+1;
		}
		$numTotal=$cont;
		//echo ($numTotal);
		
	    for ($i=0; $i < $numTotal; $i++) { 
		    $valor['alm_prod_usr_alta'] =$login;
		    $valor['alm_prod_fch_hr_alta']=$fec_proc;
		    $valor['alm_prod_prec_venta'] =$costo_prod[$i];	
		    //echo ($costo_prod[$i]);
		    $this->mysql->update('alm_producto',$valor,'alm_prod_id='.$id_prod[$i].'');
		}
			
		$json_data['completo'] = true;
		print(json_encode($json_data));	
	}

	public function grabarAlmacen($cod_proy_cab,$cod_prov,$cod_prov_cab,$num_serie,$tipo_prod,$tipo_prod_cab,
				$nom_prod,$nom_prod_cab,$ref_prod,$ref_prod_cab,
				$cant_prod,$cant_prod_cab,$pu_prod,$costo_compra_prod,$costo_venta_prod,
				$uni_prod,$uni_prod_cab,$mon_prod,$mon_prod_cab,$login,$fec_proc){
		//echo($nom_prod_cab);
		$cont=0;	
		foreach ($nom_prod_cab as $key => $value) {
		  $cont=$cont+1;
		}
		$numTotal=$cont;

		$cont1=0;
		foreach ($nom_prod as $key => $value) {
		  $cont1=$cont1+1;
		}
		$numTotal1=$cont1;

		//echo ($numTotal);
		//echo ($numTotal1);
		$util = new Utilitarios();
		for ($i=0; $i < $numTotal; $i++) { 
		$existe = $this->almacenProducto($nom_prod_cab[$i],$cod_prov_cab[$i]);
	    //print_r($existe);
	    }
		
		$fecha= $util->obtenerFechaActual();
		
		if (empty($existe)) {
			for ($i=0; $i < $numTotal; $i++) { 
				//echo ("TIPO".$tipo_prod_cab);
				$codigo_interno=$util->crearCodigo($tipo_prod_cab[$i],$cod_prov_cab[$i]);
				$codigo_unico=$util->generaNumeroOrdenUnico();
				$valor['alm_prod_cab_codigo']=$codigo_interno;
				$valor['alm_prod_cab_numerico']=$_SESSION['correlativo'];
				$valor['alm_prod_cab_cod_ref']=$ref_prod_cab[$i];
				$valor['alm_prod_cab_id_unico_prod']=$codigo_unico;
				$valor['alm_prod_cab_tipo']=$tipo_prod_cab[$i];
				$valor['alm_prod_cab_fecha_proceso']=$fecha;
				$valor['alm_prod_cab_prov']=$cod_prov_cab[$i];
				$valor['alm_prod_cab_nombre']=$nom_prod_cab[$i];
				$valor['alm_prod_cab_unidad']=$uni_prod_cab[$i];
				$valor['alm_prod_cab_cantidad_stock']=$cant_prod_cab[$i];
				$valor['alm_prod_cab_moneda']=$mon_prod_cab[$i];
				$valor['alm_prod_cab_suc_origen']=21;
				$valor['alm_prod_cab_usr_alta']=$login;
				$valor['alm_prod_cab_fch_hr_alta']=$util->cambiaf_a_mysql($fec_proc);
				$this->mysql->insert('alm_prod_cabecera', $valor);
			}		
				for ($j=0; $j < $numTotal1; $j++) { 
			    $existe2 = $this->almacenProducto($nom_prod[$j],$cod_prov_cab[0]);
			    for ($i=0; $i < $numTotal; $i++) {
				$cod_ord = $this->codOrdCab($cod_proy_cab[0],$cod_prov_cab[0]);	
				   
				if ($cod_ord[$i]['d']['alm_descripcion']==$existe2[0]['alm_prod_cabecera']['alm_prod_cab_nombre']) {
			    //echo($cod_ord[$i]['d']['alm_descripcion']."=".$existe2[0]['alm_prod_cabecera']['alm_prod_cab_nombre']);
			    $valor2['alm_prod_unico_orden']=$cod_ord[$i]['d']['alm_id_unico_item_ord_compra'];
			    //echo($cod_ord[$i]['d']['alm_descripcion']."=".$existe2[0]['alm_prod_cabecera']['alm_prod_cab_nombre']."ID".$valor2['alm_prod_unico_orden']);
			    }else{
			    //echo($cod_ord[$i]['d']['alm_descripcion']."!=".$existe2[0]['alm_prod_cabecera']['alm_prod_cab_nombre']);
			    }
				}	    	    
				//$cod_ord = $this->codOrdCab($cod_prov_cab[0],$cod_prov[$j]);	
				//echo ($nom_prod[$j]);
				//echo ($cod_prov[$j]);
				//print_r( $existe2);
				//$codigo_interno=$util->crearCodigo($tipo_prod,$cod_prov);
				//$codigo_unico=$util->generaNumeroOrdenUnico();
				$valor2['alm_prod_cab_codigo']=$existe2[0]['alm_prod_cabecera']['alm_prod_cab_id_unico_prod'];
				$valor2['alm_prod_cab_fec_ing']=$fecha;
				$valor2['alm_prod_det_serie']=$num_serie[$j];
				$valor2['alm_prod_det_tc']=$_SESSION['TC_CONTAB'];
				if ($num_serie[$j]==0) {
				$valor2['alm_prod_det_cantidad']=$cant_prod[$j];	
				}else{
					while($cant_prod[$j]>0){
				$valor2['alm_prod_det_cantidad']=1;
					$cant_prod[$j]--;
					}
				}		
				$valor2['alm_prod_det_prec_compra']=$costo_compra_prod[$j];
				$valor2['alm_prod_det_prec_venta']=$costo_venta_prod[$j];
				$valor2['alm_prod_det_estado']=1;
				$valor2['alm_prod_det_part_number']=$ref_prod[$j];
				$valor2['alm_prod_det_usr_alta']=$login;
				$valor2['alm_prod_det_fch_hr_alta']=$util->cambiaf_a_mysql($fec_proc);;
				$this->mysql->insert('alm_prod_detalle', $valor2);
		    }			
				$json_data['completo'] = true;
				$json_data['codigo_proy']=$cod_proy_cab[0];
				//$json_data['codigo_unico']=$codigo_unico;
				//$json_data['codigo_prod']=$codigo_interno;
				//$json_data['codigo_prov']=$cod_prov;
				//$json_data['cant_prod']=$cant_prod;
				
				print(json_encode($json_data));

		//echo("vacio");
		}else{
			//print($existe);				
			for ($j=0; $j < $numTotal1; $j++) { 
			    $existe2 = $this->almacenProducto($nom_prod[$j],$cod_prov_cab[0]);	    	    
				for ($i=0; $i < $numTotal; $i++) {
				$cod_ord = $this->codOrdCab($cod_proy_cab[0],$cod_prov_cab[0]);	
				   
				if ($cod_ord[$i]['d']['alm_descripcion']==$existe2[0]['alm_prod_cabecera']['alm_prod_cab_nombre']) {
			    //echo($cod_ord[$i]['d']['alm_descripcion']."=".$existe2[0]['alm_prod_cabecera']['alm_prod_cab_nombre']);
			    $valor2['alm_prod_unico_orden']=$cod_ord[$i]['d']['alm_id_unico_item_ord_compra'];
			    //echo($cod_ord[$i]['d']['alm_descripcion']."=".$existe2[0]['alm_prod_cabecera']['alm_prod_cab_nombre']."ID".$valor2['alm_prod_unico_orden']);
			    }else{
			    //echo($cod_ord[$i]['d']['alm_descripcion']."!=".$existe2[0]['alm_prod_cabecera']['alm_prod_cab_nombre']);
			    }
				}
				//$existe = $this->almacenProducto($nom_prod_cab[$i],$cod_prov_cab[$i]);
			    //print_r($cod_proy_cab[0]);
			    //print_r($cod_ord);
				//echo ($cod_prov[$j]); d.alm_id_unico_item_ord_compra
				//echo ($nom_prod[$j]);
				//echo ($cod_prov[$j]);
				//print_r( $cod_ord);
				//echo ( $cod_ord);
				//$codigo_interno=$util->crearCodigo($tipo_prod,$cod_prov);
				//$codigo_unico=$util->generaNumeroOrdenUnico(); cantProducto
				$valor2['alm_prod_cab_codigo']=$existe2[0]['alm_prod_cabecera']['alm_prod_cab_id_unico_prod'];
				$cants= $this->cantProducto($valor2['alm_prod_cab_codigo']);
				//print_r( $cants);
				$valor2['alm_prod_cab_fec_ing']=$fecha;
				$valor2['alm_prod_det_serie']=$num_serie[$j];
				$valor2['alm_prod_det_tc']=$_SESSION['TC_CONTAB'];
				if ($num_serie[$j]==0) {
				$valor2['alm_prod_det_cantidad']=$cant_prod[$j];	
				}else{
					while($cant_prod[$j]>0){
				$valor2['alm_prod_det_cantidad']=1;
					$cant_prod[$j]--;
					}
				}			
				$valor2['alm_prod_det_prec_compra']=$costo_compra_prod[$j];
				$valor2['alm_prod_det_prec_venta']=$costo_venta_prod[$j];
				$valor2['alm_prod_det_estado']=1;
				$valor2['alm_prod_det_part_number']=$ref_prod[$j];
				$valor2['alm_prod_det_usr_alta']=$login;
				$valor2['alm_prod_det_fch_hr_alta']=$util->cambiaf_a_mysql($fec_proc);;
				$this->mysql->insert('alm_prod_detalle', $valor2);
		    }	

		    	for ($i=0; $i < $numTotal; $i++) {
		    	$existe = $this->almacenProducto($nom_prod_cab[$i],$cod_prov_cab[$i]); 
			    	foreach ($existe as $key => $value3) {
			    	$valor3['alm_prod_cab_cantidad_stock'] =($value3['alm_prod_cabecera']['alm_prod_cab_cantidad_stock']+$cant_prod_cab[$i]);
			    	$unico=$value3['alm_prod_cabecera']['alm_prod_cab_id_unico_prod'];
					//print_r( $valor3['alm_prod_cab_cantidad_stock']);
			   		$this->mysql->update('alm_prod_cabecera',$valor3,'alm_prod_cab_id_unico_prod="'.$unico.'"');
			    	}				
				}

		    	
		    	//}		
				$json_data['completo'] = true;
				$json_data['codigo_proy']=$cod_proy_cab[0];
				//$json_data['codigo_proy']=$codigo_proyecto;
				//$json_data['codigo_unico']=$codigo_unico;
				//$json_data['codigo_prod']=$codigo_interno;
				//$json_data['codigo_prov']=$cod_prov;
				//$json_data['cant_prod']=$cant_prod;
				
				print(json_encode($json_data));
		//echo("no vacio");		
		}
		
}
	/*
	* Metodo dar de baja de los certificados
	*/
	public function darBajaCertificado($id_certificado, $codigo_proyecto, $login){
    //echo("GRABAR PHP CERT");
	$util = new Utilitarios();
	//echo $id_certificado;
	//echo $codigo_proyecto;
	//echo $numero_documento;
	//echo $fec_doc;
	//echo $descripcion_cert;
	//echo $login;
	//echo $fec_proc; 
	$fecha= $util->obtenerFechaActual();
	$value['alm_form_usr_baja']=$login;
	$value['alm_form_fch_baja']=$fecha;
	if ($this->mysql->update('alm_form_importacion',$value,'alm_form_id='.$id_certificado.'')) {
		$json_data['completo'] = true;
		$json_data['tipo_formulario']=9;
		$json_data['codigo_proyecto']=$codigo_proyecto;
	}else{
		$json_data['completo'] = false;
		}
	print(json_encode($json_data));
	}

	/*
	* Metodo dar de baja de los certificados
	*/
	public function darBajaCertificadoLista($id_certificado, $codigo_proyecto, $login){
    //echo("GRABAR PHP CERT");
	$util = new Utilitarios();
	//echo $id_certificado;
	//echo $codigo_proyecto;
	//echo $numero_documento;
	//echo $fec_doc;
	//echo $descripcion_cert;
	//echo $login;
	//echo $fec_proc; 
	$fecha= $util->obtenerFechaActual();
	$value['alm_form_usr_baja']=$login;
	$value['alm_form_fch_baja']=$fecha;
	if ($this->mysql->update('alm_form_importacion',$value,'alm_form_id='.$id_certificado.'')) {
		$json_data['completo'] = true;
		$json_data['tipo_formulario']=9;
		$json_data['codigo_proyecto']=$codigo_proyecto;
	}else{
		$json_data['completo'] = false;
		}
	print(json_encode($json_data));
	}
	/*
	* Consulta listar de los certificados
	*/
	public function ListarDatosOrden($codigo_proy,$tc,$codigo_prov){
		//echo "aquiiiiii".$codigo_proy.$tc.$nro_orden;
		$query = 'SELECT  cab.alm_prov_codigo,cab.alm_nro_referencia_orden,cab.alm_proy_cod,pro.alm_prov_nombre,
		ROUND((SELECT SUM(det.alm_cantidad_ord* det.alm_precio_unitario) FROM alm_ord_compra_det AS det INNER JOIN alm_ord_compra_cab AS cab ON cab.alm_id_unico_orden_compra=det.alm_id_codigo_unico_proy WHERE cab.alm_proy_cod="'.$codigo_proy.'" AND cab.alm_prov_codigo="'.$codigo_prov.'"  AND ISNULL(cab.alm_ord_compra_usr_baja) AND ISNULL(alm_item_ord_usr_baja)),2)AS precio_neto,
		ROUND((((SELECT SUM(det.alm_cantidad_ord* det.alm_precio_unitario) FROM alm_ord_compra_det AS det INNER JOIN alm_ord_compra_cab AS cab ON cab.alm_id_unico_orden_compra=det.alm_id_codigo_unico_proy WHERE cab.alm_proy_cod="'.$codigo_proy.'" AND cab.alm_prov_codigo="'.$codigo_prov.'" AND ISNULL(cab.alm_ord_compra_usr_baja) AND ISNULL(alm_item_ord_usr_baja)))-((SELECT CASE WHEN SUM(alm_tot_descuento) IS NULL THEN 0 ELSE SUM(alm_tot_descuento) END FROM alm_ord_compra_cab WHERE alm_proy_cod="'.$codigo_proy.'" AND alm_prov_codigo="'.$codigo_prov.'" AND ISNULL(alm_ord_compra_usr_baja)))),2) AS costo_sus_fob,
		ROUND((((SELECT SUM(det.alm_cantidad_ord* det.alm_precio_unitario) FROM alm_ord_compra_det AS det INNER JOIN alm_ord_compra_cab AS cab ON cab.alm_id_unico_orden_compra=det.alm_id_codigo_unico_proy WHERE cab.alm_proy_cod="'.$codigo_proy.'" AND cab.alm_prov_codigo="'.$codigo_prov.'"  AND ISNULL(cab.alm_ord_compra_usr_baja) AND ISNULL(alm_item_ord_usr_baja)))-((SELECT CASE WHEN SUM(alm_tot_descuento) IS NULL THEN 0 ELSE SUM(alm_tot_descuento) END FROM alm_ord_compra_cab WHERE alm_proy_cod="'.$codigo_proy.'" AND alm_prov_codigo="'.$codigo_prov.'" AND ISNULL(alm_ord_compra_usr_baja))))*'.$tc.',2) AS costo_bs_fob,
		ROUND((SELECT SUM((CASE WHEN cab.alm_tot_asegurado IS NULL THEN 0 ELSE cab.alm_tot_asegurado END) + (CASE WHEN cab.alm_tot_transporte IS NULL THEN 0 ELSE cab.alm_tot_transporte END)) FROM alm_ord_compra_cab AS cab  WHERE cab.alm_proy_cod="'.$codigo_proy.'"  AND alm_prov_codigo="'.$codigo_prov.'" AND ISNULL(alm_ord_compra_usr_baja)),2) AS costo_sus_trans,
		ROUND((SELECT SUM((CASE WHEN cab.alm_tot_asegurado IS NULL THEN 0 ELSE cab.alm_tot_asegurado END) + (CASE WHEN cab.alm_tot_transporte IS NULL THEN 0 ELSE cab.alm_tot_transporte END)) FROM alm_ord_compra_cab AS cab  WHERE cab.alm_proy_cod="'.$codigo_proy.'"  AND alm_prov_codigo="'.$codigo_prov.'" AND ISNULL(alm_ord_compra_usr_baja))*'.$tc.',2)  AS costo_bs_trans
		FROM alm_ord_compra_cab AS cab 
		INNER JOIN alm_ord_compra_det AS det ON cab.alm_id_unico_orden_compra=det.alm_id_codigo_unico_proy 
		INNER JOIN alm_proveedor pro ON cab.alm_prov_codigo=pro.alm_prov_codigo_int 
		WHERE cab.alm_proy_cod="'.$codigo_proy.'"  AND cab.alm_prov_codigo="'.$codigo_prov.'"
		GROUP BY cab.alm_prov_codigo';

		/*$query='SELECT cab.alm_prov_codigo,alm_nro_referencia_orden,cab.alm_proy_cod,pro.alm_prov_nombre,
		ROUND((SELECT SUM(det.alm_cantidad_ord* det.alm_precio_unitario) FROM alm_ord_compra_det AS det WHERE det.alm_cod_proyecto="'.$codigo_proy.'"   AND det.alm_nro_orden_compra='.$nro_ref.' AND ISNULL(det.alm_item_ord_usr_baja)),2)AS precio_neto,
		ROUND((((SELECT SUM(det.alm_cantidad_ord* det.alm_precio_unitario) FROM alm_ord_compra_det AS det WHERE det.alm_cod_proyecto="'.$codigo_proy.'"   AND det.alm_nro_orden_compra='.$nro_ref.' AND ISNULL(det.alm_item_ord_usr_baja)))-((SELECT SUM(alm_tot_descuento)  FROM alm_ord_compra_cab  WHERE alm_proy_cod="'.$codigo_proy.'"  AND alm_nro_referencia_orden='.$nro_ref.'))),2) AS costo_sus_fob, 
		ROUND(((((SELECT SUM(det.alm_cantidad_ord* det.alm_precio_unitario) FROM alm_ord_compra_det AS det WHERE det.alm_cod_proyecto="'.$codigo_proy.'"   AND det.alm_nro_orden_compra='.$nro_ref.' AND ISNULL(det.alm_item_ord_usr_baja)))-(((SELECT SUM(alm_tot_descuento)  FROM alm_ord_compra_cab  WHERE alm_proy_cod="'.$codigo_proy.'"  AND alm_nro_referencia_orden='.$nro_ref.')))) * '.$tc.'),2)  AS costo_bs_fob,
		ROUND((SELECT SUM(cab.alm_tot_asegurado + cab.alm_tot_transporte) FROM alm_ord_compra_cab AS cab  WHERE cab.alm_proy_cod="'.$codigo_proy.'"  AND cab.alm_nro_referencia_orden='.$nro_ref.'),2) AS costo_sus_trans,
		ROUND((SELECT (SUM(cab.alm_tot_asegurado + cab.alm_tot_transporte)*'.$tc.') FROM alm_ord_compra_cab AS cab  WHERE cab.alm_proy_cod="'.$codigo_proy.'"  AND cab.alm_nro_referencia_orden='.$nro_ref.'),2)  AS costo_bs_trans
		FROM alm_ord_compra_cab AS cab 
		INNER JOIN alm_ord_compra_det AS det ON cab.alm_nro_referencia_orden=det.alm_nro_orden_compra
		INNER JOIN alm_proveedor pro ON cab.alm_prov_codigo=pro.alm_prov_codigo_int 
		WHERE cab.alm_proy_cod="'.$codigo_proy.'"   AND cab.alm_nro_referencia_orden='.$nro_ref.'
		GROUP BY cab.alm_nro_referencia_orden';*/
		return $this->mysql->query($query);	
	}

	/*
	* Preguntar si existe producto en almacen
	*/
	public function almacenProducto($nom_prod,$cod_prov){
		$query = 'SELECT alm_prod_cab_nombre,alm_prod_cab_id,alm_prod_cab_codigo,alm_prod_cab_cod_ref,alm_prod_cab_id_unico_prod,alm_prod_cab_tipo,alm_prod_cab_prov
				  ,alm_prod_cab_cantidad_stock,alm_prod_cab_moneda
				  FROM alm_prod_cabecera 
				  WHERE alm_prod_cab_nombre LIKE "'.$nom_prod.'" AND alm_prod_cab_prov LIKE "'.$cod_prov.'" AND ISNULL(alm_prod_cab_usr_baja)';
		return $this->mysql->query($query);
		
	}

		/*
	* Preguntar cod unico cabecera
	*/
	public function codOrdCab($cod_proy,$cod_prov){
		$query = 'SELECT d.alm_id_unico_item_ord_compra, d.alm_descripcion, d.alm_cantidad_ord FROM alm_ord_compra_det d 
				  INNER JOIN alm_ord_compra_cab c ON c.alm_id_unico_orden_compra=d.alm_id_codigo_unico_proy
				  WHERE d.alm_cod_proyecto="'.$cod_proy.'" AND c.alm_prov_codigo="'.$cod_prov.'"';
		return $this->mysql->query($query);
		
	}


		/*
	* Preguntar si existe producto en almacen
	*/
	public function accionHoja($codigo_proy,$cod_prov){
		$query = 'SELECT * FROM alm_ord_compra_det d 
				INNER JOIN alm_ord_compra_cab c ON c.alm_id_unico_orden_compra=d.alm_id_codigo_unico_proy 
				INNER JOIN alm_prod_detalle as dp ON d.alm_id_unico_item_ord_compra =dp.alm_prod_unico_orden
				WHERE d.alm_cod_proyecto="'.$codigo_proy.'" AND c.alm_prov_codigo="'.$cod_prov.'"';
		return $this->mysql->query($query);
		
	}

	/*
	* Preguntar si existe producto en almacen
	*/
	public function cantProducto($id_unico_prod){
		$query = 'SELECT alm_prod_cab_cantidad_stock
				  FROM alm_prod_cabecera 
				  WHERE alm_prod_cab_id_unico_prod="'.$id_unico_prod.'" AND ISNULL(alm_prod_cab_usr_baja)';
		return $this->mysql->query($query);
		
	}
	/*
	* Consulta detalle de un certificado
	*/
	public function listaHojaCosto($codigo_proy){
		$query = 'SELECT cab.alm_nro_referencia_orden, cab.alm_proy_cod , cab.alm_prov_codigo, pro.alm_prov_nombre, t.alm_age_adu_tra_nro_fac
		          FROM alm_ord_compra_cab AS cab INNER JOIN alm_proveedor pro ON cab.alm_prov_codigo=pro.alm_prov_codigo_int 
				  INNER JOIN alm_age_adu_tra t ON t.alm_age_adu_tra_cod_prov=pro.alm_prov_codigo_int
                  WHERE cab.alm_proy_cod="'.$codigo_proy.'" AND ISNULL(cab.alm_ord_compra_usr_baja) AND ISNULL(pro.alm_prov_usr_baja) AND ISNULL(t.alm_age_adu_tra_usr_baja) 
                  GROUP BY cab.alm_prov_codigo';
		return $this->mysql->query($query);
		
	}

	/*
	* Consulta detalle de un certificado
	*/
	public function listaHojaCosto2($codigo_proy){
		$query = 'SELECT cab.alm_nro_referencia_orden, cab.alm_proy_cod , cab.alm_prov_codigo, pro.alm_prov_nombre, t.alm_age_adu_tra_nro_fac
				  FROM alm_ord_compra_cab AS cab INNER JOIN alm_proveedor pro ON cab.alm_prov_codigo=pro.alm_prov_codigo_int 
				  INNER JOIN alm_age_adu_tra t ON t.alm_age_adu_tra_cod_proy=cab.alm_proy_cod
				  WHERE cab.alm_proy_cod="'.$codigo_proy.'" AND ISNULL(cab.alm_ord_compra_usr_baja) AND ISNULL(pro.alm_prov_usr_baja) AND ISNULL(t.alm_age_adu_tra_usr_baja)
				  GROUP BY cab.alm_prov_codigo';
		return $this->mysql->query($query);
		
	}

	/*
	* Consulta detalle de un certificado
	*/
	public function verificaHojaCosto($codigo_proy){
		$query = 'SELECT * 
				  FROM alm_age_adu_tra 
				  WHERE alm_age_adu_tra_cod_proy="'.$codigo_proy.'" AND alm_age_adu_tra_cod_prov="consolidado"';
		return $this->mysql->query($query);
		
	}

	/*
	* Consulta detalle planilla aduanera
	*/
	public function datosPlanilla($codigo_proy,$cod_prov){
		$query = 'SELECT * 
				  FROM alm_form_importacion 
                  WHERE alm_proy_cod="'.$codigo_proy.'" AND ISNULL(alm_form_usr_baja) AND alm_form_tipo=11 AND alm_prov_id="'.$cod_prov.'"';
		return $this->mysql->query($query);		
	} 

		/*
	* Consulta detalle planilla aduanera
	*/
	public function detallePlanilla($codigo_proy,$nro_orden){
		$query = 'SELECT * FROM alm_producto p INNER JOIN alm_ord_compra_det d ON p.alm_prod_part_number=d.alm_nro_parte_ord_compra
                  WHERE d.alm_cod_proyecto="'.$codigo_proy.'" AND d.alm_nro_orden_compra='.$nro_orden.'';
		return $this->mysql->query($query);		
	} 
		 	 /*
	 * Metodo para lista detalle de la hoja de costo cabecera vs detalle
	 */

	 public function listaItems($codigo_proyecto, $codigo_prov){
	 	$query='SELECT (det.alm_precio_unitario* (CASE WHEN det.alm_item_ord_serial=1 THEN 1 ELSE det.alm_cantidad_ord END)) AS total_fob,det.alm_item_ord_serial,det.alm_item_ord_tipo,det.alm_id_ord_compra_det,det.alm_nro_parte_ord_compra,det.alm_descripcion,det.alm_cantidad_ord, det.alm_unidad_um, det.alm_precio_unitario, det.alm_precio_moneda, 
						(SELECT (SUM(det.alm_precio_unitario* det.alm_cantidad_ord)) AS Suma
				FROM alm_ord_compra_cab cab INNER JOIN alm_ord_compra_det det ON cab.alm_id_unico_orden_compra=det.alm_id_codigo_unico_proy 
				WHERE cab.alm_proy_cod="'.$codigo_proyecto.'" AND cab.alm_prov_codigo="'.$codigo_prov.'" AND ISNULL(det.alm_item_ord_usr_baja) AND ISNULL(cab.alm_ord_compra_usr_baja)) AS gran_total_fob
				FROM alm_ord_compra_cab cab INNER JOIN alm_ord_compra_det det ON cab.alm_id_unico_orden_compra=det.alm_id_codigo_unico_proy 
				WHERE cab.alm_proy_cod="'.$codigo_proyecto.'" AND cab.alm_prov_codigo="'.$codigo_prov.'" AND ISNULL(det.alm_item_ord_usr_baja) AND ISNULL(cab.alm_ord_compra_usr_baja)';

        return $this->mysql->query($query);
	 }

	 		 	 /*
	 * Metodo para lista detalle de la hoja de costo cabecera vs detalle
	 */

	 public function detalleItems($id_item,$codigo_proyecto, $codigo_prov){
	 	$query='SELECT det.alm_id_ord_compra_det,det.alm_nro_orden_compra,det.alm_descripcion,det.alm_cantidad_ord, det.alm_unidad_um, det.alm_precio_unitario, det.alm_precio_moneda 
				FROM alm_ord_compra_cab cab INNER JOIN alm_ord_compra_det det ON cab.alm_id_unico_orden_compra=det.alm_id_codigo_unico_proy 
				WHERE cab.alm_proy_cod="'.$codigo_proyecto.'" AND cab.alm_prov_codigo="'.$codigo_prov.'" AND ISNULL(det.alm_item_ord_usr_baja) AND ISNULL(cab.alm_ord_compra_usr_baja) AND det.alm_id_ord_compra_det='.$id_item.'';

        return $this->mysql->query($query);
	 }

	 	 	 /*
	 * Metodo para lista detalle de la hoja de costo cabecera vs detalle
	 */

	 /*public function listaItems($codigo_proyecto, $codigo_prov){
	 	$query='SELECT det.alm_nro_orden_compra,det.alm_descripcion,det.alm_cantidad_ord, det.alm_unidad_um, det.alm_precio_unitario, det.alm_precio_moneda 
FROM alm_ord_compra_cab cab INNER JOIN alm_ord_compra_det det ON cab.alm_id_unico_orden_compra=det.alm_id_codigo_unico_proy 
WHERE cab.alm_proy_cod="'.$codigo_proyecto.'" AND cab.alm_prov_codigo="'.$codigo_prov.'" AND ISNULL(det.alm_item_ord_usr_baja) AND ISNULL(cab.alm_ord_compra_usr_baja)';

        return $this->mysql->query($query);
	 }*/

	 		 	 /*
	 * Metodo para lista detalle de la hoja de costo cabecera vs detalle
	 */

	 public function unidad_det($cod_unidad){
	 	$query='SELECT GRAL_PAR_PRO_DESC 
	 			FROM gral_param_propios 
	 			WHERE GRAL_PAR_PRO_GRP=1100 AND GRAL_PAR_PRO_COD='.$cod_unidad.'';

        return $this->mysql->query($query);
	 }

	 	 		 	 /*
	 * Metodo para lista detalle de la hoja de costo cabecera vs detalle
	 */

	 public function moneda_det($cod_moneda){
	 	$query='SELECT GRAL_PAR_INT_DESC 
	 			FROM gral_param_super_int 
	 			WHERE GRAL_PAR_INT_GRP=18 AND GRAL_PAR_INT_COD='.$cod_moneda.'';

        return $this->mysql->query($query);
	 }

	  		 	 /*
	 * Metodo para lista detalle de la hoja de costo cabecera vs detalle
	 */

	 public function listaTipoProd(){
	 	$query='SELECT GRAL_PAR_PRO_COD,GRAL_PAR_PRO_DESC 
	 			FROM gral_param_propios 
	 			WHERE GRAL_PAR_PRO_GRP=1000 AND GRAL_PAR_PRO_COD<>0';

        return $this->mysql->query($query);
	 }
	 	 	 /*
	 * Metodo para lista detalle de la hoja de costo cabecera vs producto
	 */

	 public function listaDetalleHoja($codigo_proyecto, $codigo_prov){
	 	$query='SELECT p.alm_prod_id,p.alm_prod_codigo,p.alm_prod_cod_ref,p.alm_id_unico_orden_compra,p.alm_prod_nombre,p.alm_prod_serie,p.alm_prod_cantidad_stock,p.alm_prod_part_number,
		p.alm_prod_prec_compra,p.alm_prod_prec_venta,p.alm_prod_prec_max_venta,p.alm_prod_prec_min_venta,p.alm_prod_porcentaje,p.alm_prod_moneda,
		(p.alm_prod_cantidad_stock*p.alm_prod_prec_compra)AS precio_fob,
		((p.alm_prod_cantidad_stock*p.alm_prod_prec_compra)/(SELECT SUM(p.alm_prod_cantidad_stock*p.alm_prod_prec_compra) FROM alm_ord_compra_cab c 
		INNER JOIN alm_producto p ON c.alm_id_unico_orden_compra=p.alm_id_unico_orden_compra
		WHERE c.alm_proy_cod="'.$codigo_proyecto.'" AND c.alm_prov_codigo="'.$codigo_prov.'")*100)AS part
		FROM alm_ord_compra_cab c 
		INNER JOIN alm_producto p ON c.alm_id_unico_orden_compra=p.alm_id_unico_orden_compra
		WHERE c.alm_proy_cod="'.$codigo_proyecto.'" AND c.alm_prov_codigo="'.$codigo_prov.'"';

        return $this->mysql->query($query);
	 }
	/*
	* Metodo convertir normal las fechas
	*/
	 public function convertirNormal($fecha){
		 $util = new Utilitarios();
		 return $util->cambiaf_a_normal($fecha);
	 }
}
?>