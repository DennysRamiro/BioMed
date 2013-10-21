<?php
require_once '../lib/Mysql.php';
require_once 'Utilitarios.php';
/**
 * Clase Proyecto gestiona todas las consultas y formulario de agencias
 * @author Dennys Ramiro 
 * @date 05/07/2013
 */
class Productos{
	// Esta es la variable mysql
	private $mysql;
	/**
	 * Este es el constructor de la clase proyecto
	 * @param  parm1 -> signigica esto
	 *         param2 -> significa esta otra cosa
	 * @return  variable, variable[] -> descripscion 
	 */
	public function __construct() {
		// Constructor
		$this->mysql = new Mysql();
	}
	/** Metodo que permite listar los productos en general sin ningun parametro **/
	public function listaGeneralProductos(){
		$query = 'SELECT pc.alm_prod_cab_codigo,pc.alm_prod_cab_id_unico_prod,
					(SELECT GRAL_PAR_PRO_DESC FROM gral_param_propios 
 					WHERE gral_par_pro_grp=1000 AND GRAL_PAR_PRO_COD >= 1 AND gral_par_pro_cod=pc.alm_prod_cab_tipo) as tipo,
					pc.alm_prod_cab_nombre,	pc.alm_prod_cab_cantidad_stock,	
					(SELECT GRAL_AGENCIA_NOMBRE
					FROM gral_agencia WHERE GRAL_AGENCIA_CODIGO=pc.alm_prod_cab_suc_origen) AS AGE_ORIG,
					pd.alm_prod_det_prec_compra,pd.alm_prod_det_prec_venta,
					(SELECT GRAL_PAR_PRO_DESC
					FROM gral_param_propios 
					WHERE gral_par_pro_grp=1200 AND GRAL_PAR_PRO_COD >= 1 AND GRAL_PAR_PRO_COD=pd.alm_prod_det_estado) AS ESTADO, SUM(pd.alm_prod_det_cantidad) as cantidad
				FROM alm_prod_cabecera pc INNER JOIN alm_prod_detalle pd ON pc.alm_prod_cab_id_unico_prod=pd.alm_prod_cab_codigo
				WHERE ISNULL(pc.alm_prod_cab_usr_baja)
				GROUP BY pc.alm_prod_cab_nombre ORDER BY alm_prod_cab_tipo,alm_prod_cab_nombre';
		return $this->mysql->query($query);
	}

	/**
	 * Metodo que devuelve la lista de busqueda de los productoa
	 * @return el arreglo de la lista de busqueda proyectos
	 */

	public function listarBusquedaProductos($buscar){
		$query= 'SELECT * 
				 FROM alm_prod_cabecera
			     WHERE ISNULL(alm_prod_cab_usr_baja) 
				 	     AND (alm_prod_cab_nombre LIKE "%'.$buscar.'%" OR alm_prod_cab_codigo LIKE "%'.$buscar.'%" OR alm_prod_cab_cod_ref LIKE "%'.$buscar.'%");';	 	     
		return $this->mysql->query($query);
					          
	}
	/**
	 * Metodo que devuelve la lista de busqueda de los productoa
	 * @return el arreglo de la lista de busqueda proyectos
	 */

	public function seleccionarProducto($id_prod, $cod_prod){

//print_r($id_prod."--".$cod_prod);

			$query='SELECT
					pc.alm_prod_cab_id_unico_prod,pc.alm_prod_cab_codigo,pc.alm_prod_cab_tipo,pc.alm_prod_cab_fecha_proceso,
					pc.alm_prod_cab_prov,pc.alm_prod_cab_nombre,pc.alm_prod_cab_unidad,pc.alm_prod_cab_moneda,
					pc.alm_prod_cab_suc_origen,
					(SELECT COUNT(alm_prod_cab_codigo) FROM alm_prod_detalle WHERE alm_prod_cab_codigo=pc.alm_prod_cab_id_unico_prod AND ISNULL(alm_prod_det_usr_baja)) as totalItems,
					(SELECT GRAL_PAR_PRO_DESC FROM gral_param_propios 
					 					WHERE gral_par_pro_grp=1000 AND GRAL_PAR_PRO_COD >= 1 AND gral_par_pro_cod=pc.alm_prod_cab_tipo) as Tipo,
					(SELECT GRAL_AGENCIA_NOMBRE
										FROM gral_agencia WHERE GRAL_AGENCIA_CODIGO=pc.alm_prod_cab_suc_origen) AS AGE_ORIG,
					(SELECT GRAL_PAR_PRO_DESC
										FROM gral_param_propios 
										WHERE gral_par_pro_grp=1200 AND GRAL_PAR_PRO_COD >= 1 AND GRAL_PAR_PRO_COD=pd.alm_prod_det_estado) AS ESTADO,
					(SELECT (CASE WHEN sum(alm_prod_det_cantidad)<>0 THEN sum(alm_prod_det_cantidad) ELSE 0 END)FROM alm_prod_detalle WHERE alm_prod_cab_codigo=pc.alm_prod_cab_id_unico_prod AND ISNULL(alm_prod_det_usr_baja)) as cantidad
					FROM
					alm_prod_cabecera as pc, alm_prod_detalle as pd
					WHERE  ISNULL(pc.alm_prod_cab_usr_baja) AND pc.alm_prod_cab_codigo = "'.$cod_prod.'" AND pc.alm_prod_cab_id_unico_prod="'.$id_prod.'"
					GROUP BY pc.alm_prod_cab_id_unico_prod;';
//print_r($query);

		/*$query= 'SELECT pc.alm_prod_cab_codigo,pc.alm_prod_cab_id_unico_prod,
						(SELECT GRAL_PAR_PRO_DESC FROM gral_param_propios 
						WHERE gral_par_pro_grp=1000 AND GRAL_PAR_PRO_COD >= 1 AND gral_par_pro_cod=pc.alm_prod_cab_tipo) as tipo,
						pc.alm_prod_cab_nombre,	pc.alm_prod_cab_cantidad_stock,	
						(SELECT GRAL_AGENCIA_NOMBRE
						FROM gral_agencia WHERE GRAL_AGENCIA_CODIGO=pc.alm_prod_cab_suc_origen) AS AGE_ORIG,
						pd.alm_prod_det_prec_compra,pd.alm_prod_det_prec_venta,
						(SELECT GRAL_PAR_PRO_DESC
						FROM gral_param_propios 
						WHERE gral_par_pro_grp=1200 AND GRAL_PAR_PRO_COD >= 1 AND GRAL_PAR_PRO_COD=pd.alm_prod_det_estado) AS ESTADO, SUM(pd.alm_prod_det_cantidad) as cantidad
					FROM alm_prod_cabecera pc INNER JOIN alm_prod_detalle pd ON pc.alm_prod_cab_id_unico_prod=pd.alm_prod_cab_codigo
					WHERE ISNULL(pc.alm_prod_cab_usr_baja) AND pc.alm_prod_cab_codigo = "'.$cod_prod.'" AND pc.alm_prod_cab_id_unico_prod="'.$id_prod.'"
					GROUP BY pc.alm_prod_cab_codigo';*/
		return $this->mysql->query($query);
					          
	}

	/** Este es le metodo que permite enfocar el producto */
	public function listaBusquedaProductoEnfocado($id_unico, $codigo_producto){

			$query='SELECT
				pc.alm_prod_cab_id_unico_prod,pc.alm_prod_cab_codigo,pc.alm_prod_cab_tipo,pc.alm_prod_cab_fecha_proceso,
				pc.alm_prod_cab_prov,pc.alm_prod_cab_nombre,pc.alm_prod_cab_unidad,pc.alm_prod_cab_moneda,
				pc.alm_prod_cab_suc_origen,
				(SELECT COUNT(alm_prod_cab_codigo) FROM alm_prod_detalle WHERE alm_prod_cab_codigo=pc.alm_prod_cab_id_unico_prod AND ISNULL(alm_prod_det_usr_baja)) as totalItems,
				(SELECT GRAL_PAR_PRO_DESC FROM gral_param_propios 
				 					WHERE gral_par_pro_grp=1000 AND GRAL_PAR_PRO_COD >= 1 AND gral_par_pro_cod=pc.alm_prod_cab_tipo) as Tipo,
				(SELECT GRAL_AGENCIA_NOMBRE
									FROM gral_agencia WHERE GRAL_AGENCIA_CODIGO=pc.alm_prod_cab_suc_origen) AS AGE_ORIG,
				(SELECT GRAL_PAR_PRO_DESC
									FROM gral_param_propios 
									WHERE gral_par_pro_grp=1200 AND GRAL_PAR_PRO_COD >= 1 AND GRAL_PAR_PRO_COD=pd.alm_prod_det_estado) AS ESTADO,
				(SELECT (CASE WHEN sum(alm_prod_det_cantidad)<>0 THEN sum(alm_prod_det_cantidad) ELSE 0 END)FROM alm_prod_detalle WHERE alm_prod_cab_codigo=pc.alm_prod_cab_id_unico_prod AND ISNULL(alm_prod_det_usr_baja)) as cantidad
				FROM
				alm_prod_cabecera as pc, alm_prod_detalle as pd
				WHERE  ISNULL(pc.alm_prod_cab_usr_baja) AND pc.alm_prod_cab_codigo = "'.$codigo_producto.'" AND pc.alm_prod_cab_id_unico_prod="'.$id_unico.'"
				GROUP BY pc.alm_prod_cab_id_unico_prod;';




/*
		$query= 'SELECT pc.alm_prod_cab_codigo,pc.alm_prod_cab_id_unico_prod,
						(SELECT GRAL_PAR_PRO_DESC FROM gral_param_propios 
						WHERE gral_par_pro_grp=1000 AND GRAL_PAR_PRO_COD >= 1 AND gral_par_pro_cod=pc.alm_prod_cab_tipo) as tipo,
						pc.alm_prod_cab_nombre,	pc.alm_prod_cab_cantidad_stock,	
						(SELECT GRAL_AGENCIA_NOMBRE
						FROM gral_agencia WHERE GRAL_AGENCIA_CODIGO=pc.alm_prod_cab_suc_origen) AS AGE_ORIG,
						pd.alm_prod_det_prec_compra,pd.alm_prod_det_prec_venta,
						(SELECT GRAL_PAR_PRO_DESC
						FROM gral_param_propios 
						WHERE gral_par_pro_grp=1200 AND GRAL_PAR_PRO_COD >= 1 AND GRAL_PAR_PRO_COD=pd.alm_prod_det_estado) AS ESTADO, SUM(pd.alm_prod_det_cantidad) as cantidad
					FROM alm_prod_cabecera pc INNER JOIN alm_prod_detalle pd ON pc.alm_prod_cab_id_unico_prod=pd.alm_prod_cab_codigo
					WHERE ISNULL(pc.alm_prod_cab_usr_baja) AND pc.alm_prod_cab_codigo = "'.$codigo_producto.'" AND pc.alm_prod_cab_id_unico_prod="'.$id_unico.'"
					GROUP BY pc.alm_prod_cab_codigo';*/
		return $this->mysql->query($query);
	}
	
	/**
	*	Metodo el cual recupera todos los productos
	*
	*/
	public function listaProductosExistentes(){
		
		
		$query='SELECT
				pc.alm_prod_cab_id_unico_prod,pc.alm_prod_cab_codigo,pc.alm_prod_cab_tipo,pc.alm_prod_cab_fecha_proceso,
				pc.alm_prod_cab_prov,pc.alm_prod_cab_nombre,pc.alm_prod_cab_unidad,pc.alm_prod_cab_moneda,
				pc.alm_prod_cab_suc_origen,
				(SELECT COUNT(alm_prod_cab_codigo) FROM alm_prod_detalle WHERE alm_prod_cab_codigo=pc.alm_prod_cab_id_unico_prod AND ISNULL(alm_prod_det_usr_baja)) as totalItems,
				(SELECT GRAL_PAR_PRO_DESC FROM gral_param_propios 
				 					WHERE gral_par_pro_grp=1000 AND GRAL_PAR_PRO_COD >= 1 AND gral_par_pro_cod=pc.alm_prod_cab_tipo) as Tipo,
				(SELECT GRAL_AGENCIA_NOMBRE
									FROM gral_agencia WHERE GRAL_AGENCIA_CODIGO=pc.alm_prod_cab_suc_origen) AS AGE_ORIG,
				(SELECT GRAL_PAR_PRO_DESC
									FROM gral_param_propios 
									WHERE gral_par_pro_grp=1200 AND GRAL_PAR_PRO_COD >= 1 AND GRAL_PAR_PRO_COD=pd.alm_prod_det_estado) AS ESTADO,
				(SELECT (CASE WHEN sum(alm_prod_det_cantidad)<>0 THEN sum(alm_prod_det_cantidad) ELSE 0 END)FROM alm_prod_detalle WHERE alm_prod_cab_codigo=pc.alm_prod_cab_id_unico_prod AND ISNULL(alm_prod_det_usr_baja)) as cantidad
				FROM
				alm_prod_cabecera as pc, alm_prod_detalle as pd
				WHERE  ISNULL(pc.alm_prod_cab_usr_baja) 
				GROUP BY pc.alm_prod_cab_id_unico_prod;';


	/*	$query='SELECT pc.alm_prod_cab_codigo,pc.alm_prod_cab_id_unico_prod,
					(SELECT GRAL_PAR_PRO_DESC FROM gral_param_propios 
 					WHERE gral_par_pro_grp=1000 AND GRAL_PAR_PRO_COD >= 1 AND gral_par_pro_cod=pc.alm_prod_cab_tipo) as tipo,
					pc.alm_prod_cab_nombre,	pc.alm_prod_cab_cantidad_stock,	
					(SELECT GRAL_AGENCIA_NOMBRE
					FROM gral_agencia WHERE GRAL_AGENCIA_CODIGO=pc.alm_prod_cab_suc_origen) AS AGE_ORIG,
					pd.alm_prod_det_prec_compra,pd.alm_prod_det_prec_venta,
					(SELECT GRAL_PAR_PRO_DESC
					FROM gral_param_propios 
					WHERE gral_par_pro_grp=1200 AND GRAL_PAR_PRO_COD >= 1 AND GRAL_PAR_PRO_COD=pd.alm_prod_det_estado) AS ESTADO, SUM(pd.alm_prod_det_cantidad) as cantidad
				FROM alm_prod_cabecera pc INNER JOIN alm_prod_detalle pd ON pc.alm_prod_cab_id_unico_prod=pd.alm_prod_cab_codigo
				WHERE ISNULL(pc.alm_prod_cab_usr_baja)
				GROUP BY pc.alm_prod_cab_nombre ORDER BY alm_prod_cab_tipo,alm_prod_cab_nombre';*/
		
		return $this->mysql->query($query);
	}
	
	/**
	 * Metodo que devuelve la lista los tipos de productos que pueden ser
	 * 
	 */
	public function listaMaterial(){
			$query='SELECT * FROM gral_param_propios 
 					WHERE gral_par_pro_grp=1000 AND GRAL_PAR_PRO_COD >= 1';
 			return $this->mysql->query($query);
	
	}

/**
	 * Metodo que devuelve la cantidad total de los items
	 * 
	 */
	public function cantidadTotalItem($codigo){
			$query='SELECT SUM(alm_prod_det_cantidad) as cantidad 
			        FROM alm_prod_detalle 
					WHERE alm_prod_cab_codigo="'.$codigo.'" AND ISNULL(alm_prod_det_usr_baja)';
 			return $this->mysql->query($query);
	
	}

	
	/**
	 * Metodo que devuelve la lista de los proveedores que se tiene
	 * 
	 */
	public function listaProveedor(){
			$query='SELECT alm_prov_codigo_int, alm_prov_nombre 
					FROM alm_proveedor 
					WHERE alm_prov_estado=1 and alm_prov_usr_baja is null';
 			return $this->mysql->query($query);
	
	}
	
	/**
	 * Metodo que devuelve la lista de las medidas que se tiene
	 * 
	 */
	public function listaMedida(){
		
			$query='SELECT GRAL_PAR_PRO_COD, GRAL_PAR_PRO_SIGLA,GRAL_PAR_PRO_DESC
					FROM gral_param_propios 
					WHERE gral_par_pro_grp=1100 AND GRAL_PAR_PRO_COD >= 1';
 			//print_r($query);
			return $this->mysql->query($query);
	}
	
	/**
	 * Metodo que devuelve la lista de las monedas que se tiene
	 * 
	 */
	public function listaMoneda(){
		
			$query='SELECT *
					FROM gral_param_super_int
					WHERE  GRAL_PAR_INT_GRP = 18 AND GRAL_PAR_INT_COD >= 1';
 			//print_r($query);
			return $this->mysql->query($query);
	}
	
	/**
	 * Metodo que devuelve la lista de las monedas que se tiene
	 * 
	 */
	public function listaSucursalOrigen(){
		
			$query='SELECT *
					FROM gral_agencia ';
 			//print_r($query);
			return $this->mysql->query($query);
	}
	
	/**
	 * Metodo que devuelve la lista los estados posibles que se tiene
	 * 
	 */
	public function listaEstado(){
		
			$query='SELECT *
					FROM gral_param_propios 
					WHERE gral_par_pro_grp=1200 AND GRAL_PAR_PRO_COD >= 1';
 			//print_r($query);
			return $this->mysql->query($query);
	}
	
	/**
	*	Metodo el cual graba la cabecera de los productos 
	*/
	public function grabarCabeceraProductos($cod_ref,$tipo,$prov,$nom,$desc,$cantidad,$fech_proce,$unidad,$moneda,$prest,$suc_org,$imag,$login,$fec_proc,$marca){
		//print_r($fech_proce);
		
		$util = new Utilitarios();
		//print_r($util->imagen($imag));
		
		$ruta = '';
	
		if(!empty($imag['dat_tec']['tmp_name'])){
				$codigo = uniqid('treb_det_'); 
				$ruta = '../../images/producto/dt/'.$codigo.$imag['dat_tec']['name'];
				copy($imag['dat_tec']['tmp_name'], $ruta);
				//return $ruta;
		}
		
		$ruta2 = '';
		
		if(!empty($imag['img_produc']['tmp_name'])){
			//print_r($ima_prod);
			$codigo = uniqid('treb_img_');
			$ruta2 = '../../images/producto/img/'.$codigo.$imag['img_produc']['name'];
			//$img->load($imag['img_produc']['tmp_name'])->resize(320, 200)->save($ruta2);
			copy($imag['img_produc']['tmp_name'], $ruta2);
			//print_r($ruta2);
			//return $ruta2;
		}
		$valor['alm_prod_cab_id'] = NULL;
		$valor['alm_prod_cab_codigo'] = $util->crearCodigo($tipo, $prov);
		$valor['alm_prod_cab_numerico'] = $_SESSION['numerico'];
		$valor['alm_prod_cab_cod_ref'] = $cod_ref;
		$valor['alm_prod_cab_id_unico_prod'] = uniqid('INTER_CAB_PROD_');
		$valor['alm_prod_cab_tipo'] = $tipo;
		$valor['alm_prod_cab_fecha_proceso'] = $util->cambiaf_a_mysql($fech_proce);
		$valor['alm_prod_cab_prov'] = $prov;
		$valor['alm_prod_cab_nombre'] =strtoupper($nom);
		$valor['alm_prod_cab_descripcion'] = strtoupper($desc);
		$valor['alm_prod_cab_unidad'] = $unidad;
		$valor['alm_prod_cab_cantidad_stock'] = $cantidad;
		$valor['alm_prod_cab_presentacion'] = strtoupper($prest);
		$valor['alm_prod_cab_moneda'] = $moneda;
		//$valor['alm_prod_cab_porcentaje'] = NULL;
		$valor['alm_prod_cab_img'] = $ruta2;
		$valor['alm_prod_cab_pdf_descp'] = $ruta;
		$valor['alm_prod_cab_suc_origen'] = $suc_org;
		$valor['alm_prod_cab_usr_alta'] = $login;
		$valor['alm_prod_cab_marca'] = strtoupper($marca);
		//print_r($valor);
		
		if($this->mysql->insert('alm_prod_cabecera', $valor)){
			$json_data['completo'] = true;
			$json_data['alm_prod_cab_id_unico_prod'] = $valor['alm_prod_cab_id_unico_prod']; //$util->generaNumeroOrdenUnico();
		}else{
			$json_data['completo'] = false;
		}
		print(json_encode($json_data));
		/**/
		
	}
	
	/**
	*	Metodo el cual graba la cabecera de los productos 
	*/
	public function grabarDetalleProductos($serie,$cantidad,$p_c,$p_v,$p_min_v,$p_max_v,$fech_venc, $part_number,$t_c,$lote,$estado,$cod_cab_det,$fech_ingreso,$login,$fec_proc){
		
		$util = new Utilitarios();
		$valor['alm_prod_det_id'] = NULL;
		$valor['alm_prod_cab_codigo'] = $cod_cab_det;
		$valor['alm_prod_det_id_unico'] = uniqid('INTER_DET_PROD_');
		$valor['alm_prod_cab_fec_ing'] = $util->cambiaf_a_mysql($fech_ingreso);
		$valor['alm_prod_det_serie'] = $serie;
		$valor['alm_prod_det_tc'] = $t_c;
		$valor['alm_prod_det_cantidad'] = $cantidad;
		$valor['alm_prod_det_prec_compra'] = $p_c;
		$valor['alm_prod_det_prec_venta'] = $p_v;
		$valor['alm_prod_det_prec_max_venta'] = $p_max_v;
		$valor['alm_prod_det_prec_min_venta'] = $p_min_v;
		$valor['alm_prod_det_estado'] = $estado;
		$valor['alm_prod_det_fecha_venc'] = $util->cambiaf_a_mysql($fech_venc);
		$valor['alm_prod_det_lote'] = $lote;
		$valor['alm_prod_det_part_number'] = $part_number;
		$valor['alm_prod_det_usr_alta'] = $login;
		
		if($this->mysql->insert('alm_prod_detalle', $valor)){
			$json_data['completo'] = true;
			//$json_data['estado_proyecto'] = 5;
			//$json_data['codigo_proyecto'] = $codigos_proyectos;
		}else{
			$json_data['completo'] = false;
		}
		print(json_encode($json_data));
		/**/
	}
	
	/**
	*	Metodo el cual lista la cabecera de los productos 
	*/
	public function listaCabecera($codigo){
		//$query ='SELECT * FROM alm_prod_cabecera WHERE alm_prod_cab_id_unico_prod="'.$codigo.'"';
		//print_r($codigo);
		$query='SELECT alm_prod_cab_codigo,alm_prod_cab_cod_ref,alm_prod_cab_id_unico_prod,alm_prod_cab_fecha_proceso,alm_prod_cab_tipo,alm_prod_cab_marca,
				(SELECT GRAL_PAR_PRO_DESC FROM gral_param_propios 
							WHERE gral_par_pro_grp=1000 AND GRAL_PAR_PRO_COD >= 1 AND GRAL_PAR_PRO_COD=alm_prod_cab_tipo) as tipo,
				alm_prod_cab_prov,(SELECT alm_prov_nombre 
							FROM alm_proveedor 
							WHERE alm_prov_estado=1 and alm_prov_usr_baja is null AND alm_prov_codigo_int	= alm_prod_cab_prov) as proveedor,	alm_prod_cab_nombre,	alm_prod_cab_descripcion,alm_prod_cab_marca,alm_prod_cab_unidad,(SELECT GRAL_PAR_PRO_DESC
							FROM gral_param_propios 
							WHERE gral_par_pro_grp=1100 AND GRAL_PAR_PRO_COD >= 1 AND GRAL_PAR_PRO_COD = alm_prod_cab_unidad) AS UNIDAD,
				alm_prod_cab_cantidad_stock,	alm_prod_cab_presentacion,alm_prod_cab_moneda,(SELECT GRAL_PAR_INT_DESC
							FROM gral_param_super_int
							WHERE  GRAL_PAR_INT_GRP = 18 AND GRAL_PAR_INT_COD >= 1 AND GRAL_PAR_INT_COD=alm_prod_cab_moneda) AS MONEDA, alm_prod_cab_img,
				alm_prod_cab_pdf_descp,alm_prod_cab_suc_origen,(SELECT GRAL_AGENCIA_NOMBRE
							FROM gral_agencia WHERE GRAL_AGENCIA_CODIGO=alm_prod_cab_suc_origen) AS AGE_ORIG
				FROM alm_prod_cabecera 
				WHERE alm_prod_cab_id_unico_prod="'.$codigo.'" AND ISNULL(alm_prod_cab_usr_baja)';
		//print_r($query);
		return $this->mysql->query($query);
	}
	/**
	*	Metodo el cual lista la cabecera de los productos 
	*/
	public function listaCabeceraModificar($codigo){
		$query='SELECT alm_prod_cab_codigo,alm_prod_cab_suc_origen,alm_prod_cab_cod_ref,alm_prod_cab_id_unico_prod,alm_prod_cab_fecha_proceso,alm_prod_cab_tipo,
		alm_prod_cab_marca,alm_prod_cab_img,alm_prod_cab_pdf_descp,alm_prod_cab_unidad,alm_prod_cab_moneda,alm_prod_cab_suc_origen,
		alm_prod_cab_prov,alm_prod_cab_numerico,
				(SELECT GRAL_PAR_PRO_DESC FROM gral_param_propios 
							WHERE gral_par_pro_grp=1000 AND GRAL_PAR_PRO_COD >= 1 AND GRAL_PAR_PRO_COD=alm_prod_cab_tipo) as tipo,
				alm_prod_cab_prov,(SELECT alm_prov_nombre 
							FROM alm_proveedor 
							WHERE alm_prov_estado=1 and alm_prov_usr_baja is null AND alm_prov_codigo_int	= alm_prod_cab_prov) as proveedor,	alm_prod_cab_nombre,	alm_prod_cab_descripcion,alm_prod_cab_marca,alm_prod_cab_unidad,(SELECT GRAL_PAR_PRO_DESC
							FROM gral_param_propios 
							WHERE gral_par_pro_grp=1100 AND GRAL_PAR_PRO_COD >= 1 AND GRAL_PAR_PRO_COD = alm_prod_cab_unidad) AS UNIDAD,
				alm_prod_cab_cantidad_stock,	alm_prod_cab_presentacion,alm_prod_cab_moneda,(SELECT GRAL_PAR_INT_DESC
							FROM gral_param_super_int
							WHERE  GRAL_PAR_INT_GRP = 18 AND GRAL_PAR_INT_COD >= 1 AND GRAL_PAR_INT_COD=alm_prod_cab_moneda) AS MONEDA, alm_prod_cab_img,
				alm_prod_cab_pdf_descp,alm_prod_cab_suc_origen,(SELECT GRAL_AGENCIA_NOMBRE
							FROM gral_agencia WHERE GRAL_AGENCIA_CODIGO=alm_prod_cab_suc_origen) AS AGE_ORIG
		FROM alm_prod_cabecera 
		WHERE alm_prod_cab_id_unico_prod="'.$codigo.'" AND ISNULL(alm_prod_cab_usr_baja) ';
	//	print_r($query);
		return $this->mysql->query($query);
	}

	/**
	* Metodo el cual lista la cabecera
	*/

	public function getCabeceraProd($codigo_unico){
		$query='SELECT *,(CASE WHEN alm_prod_cab_marca IS NULL THEN " " ELSE alm_prod_cab_marca END) AS marca  
				FROM alm_prod_cabecera 
				WHERE alm_prod_cab_id_unico_prod="'.$codigo_unico.'" AND ISNULL(alm_prod_cab_usr_baja)';
		return $this->mysql->query($query);



	}
	       /*
     * Este es el metodo que devuelve el nombre unidad de medida del producto
     * 
     */
    public function getUnidadProd($id){
        $query  = 'SELECT GRAL_PAR_PRO_COD,GRAL_PAR_PRO_DESC 
                      FROM gral_param_propios 
                      WHERE GRAL_PAR_PRO_GRP=1100 AND GRAL_PAR_PRO_COD='.$id.'';
        return $this->mysql->query($query);
    }

    	       /*
     * Este es el metodo que devuelve el tipo  del producto
     * 
     */
    public function getTipoProd($id){
        $query  = 'SELECT GRAL_PAR_PRO_COD,GRAL_PAR_PRO_DESC 
                      FROM gral_param_propios 
                      WHERE GRAL_PAR_PRO_GRP=1000 AND GRAL_PAR_PRO_COD='.$id.'';
        return $this->mysql->query($query);
    }



/*
     * Este es el metodo que devuelve la region 
     * 
     */
    public function getRegionOp($id_region){
        $query  = 'SELECT GRAL_AGENCIA_NOMBRE 
                      FROM gral_agencia 
                      WHERE GRAL_AGENCIA_USR_BAJA is null AND GRAL_AGENCIA_CODIGO='.$id_region.'';
        return $this->mysql->query($query);
    }

    /*
    * Metodo que devuelve el nom del proveedor
    */

    public function getNomProv($cod_prov){
        $query  = 'SELECT alm_prov_nombre 
        		   FROM alm_proveedor 
        		   WHERE alm_prov_codigo_int="'.$cod_prov.'"';
        return $this->mysql->query($query);
       //print_r($query);
    }

       /*
     * Este es el metodo que devuelve la moneda del prod
     * 
     */ 
    public function getMonProd($id){
        $consulta  = 'SELECT GRAL_PAR_INT_COD,GRAL_PAR_INT_DESC 
                      FROM gral_param_super_int 
                      WHERE GRAL_PAR_INT_GRP=18 AND GRAL_PAR_INT_COD='.$id.'';
        return $this->mysql->query($consulta);
    }

	
	/**
	 * Metodo que actualiza el estado de losproductoa en la base de datos
	 * @param 
	 */
	public function actualizaProductos($codigo,$unico,$cod_ref,$tipo,$prov,$nom,$desc,$cantidad,$fech_proce,$unidad,$moneda,$prest,$suc_org,$login,$fec_proc,$marca,$numerico){
		$util = new utilitarios();
		$valor['alm_prod_cab_codigo'] = $codigo;
		$valor['alm_prod_cab_numerico'] = $numerico;
		$valor['alm_prod_cab_cod_ref'] = $cod_ref;
		$valor['alm_prod_cab_id_unico_prod'] = $unico;
		$valor['alm_prod_cab_tipo'] = $tipo;
		$valor['alm_prod_cab_fecha_proceso'] = $util->cambiaf_a_mysql($fech_proce);
		$valor['alm_prod_cab_prov'] = $prov;
		$valor['alm_prod_cab_nombre'] = strtoupper($nom);
		$valor['alm_prod_cab_marca'] = strtoupper($marca);
		$valor['alm_prod_cab_descripcion'] = strtoupper($desc);
		$valor['alm_prod_cab_unidad'] = $unidad;
		$valor['alm_prod_cab_cantidad_stock'] = $cantidad;
		$valor['alm_prod_cab_presentacion'] = $prest;
		$valor['alm_prod_cab_moneda'] = $moneda;
		$valor['alm_prod_cab_porcentaje'] = 0;
		$valor['alm_prod_cab_suc_origen'] = $suc_org;
		$valor['alm_prod_cab_usr_alta'] = $login;
	  	if($this->mysql->update('alm_prod_cabecera', $valor,'alm_prod_cab_id_unico_prod="'.$unico.'" ')){
	    	$json_data['completo'] = true;
			$json_data['alm_prod_cab_id_unico_prod'] = $valor['alm_prod_cab_id_unico_prod']; 
	    	$json_data['alm_prod_cab_nombre'] = $valor['alm_prod_cab_nombre']; 
	  	}else{
		 	$json_data['completo'] = false;
	  	}
	  	print(json_encode($json_data));  
	}
	/** Este es el metodo que permite modificar el item **/
	public function modificarProductoWithImgDet($codigo,$unico,$num, $cod_ref,$tipo,$prov,$nom,$desc,$cantidad,$fech_proce,$unidad,$moneda,$prest,$suc_org,$login,$fec_proc,$marca, $imag){
		$util = new utilitarios();
		$descripcion=$this->getCabDescp($unico);
		$this->darBajaProductos($unico, $nom, $login);
		$valor['alm_prod_cab_id'] = NULL;
		$valor['alm_prod_cab_codigo'] = $codigo;
		$valor['alm_prod_cab_cod_ref'] = $cod_ref;
		$valor['alm_prod_cab_numerico'] = $num;
		$valor['alm_prod_cab_id_unico_prod'] = $unico;
		$valor['alm_prod_cab_tipo'] = $descripcion[0]['alm_prod_cabecera']['alm_prod_cab_tipo'];
		$valor['alm_prod_cab_fecha_proceso'] = $util->cambiaf_a_mysql($fech_proce);
		$valor['alm_prod_cab_prov'] = $prov;
		$valor['alm_prod_cab_nombre'] = strtoupper($nom);
		$valor['alm_prod_cab_marca'] = strtoupper($marca);
		$valor['alm_prod_cab_descripcion'] = strtoupper($desc);
		$valor['alm_prod_cab_unidad'] = $unidad;
		$valor['alm_prod_cab_cantidad_stock'] = $cantidad;
		$valor['alm_prod_cab_presentacion'] = $prest;
		$valor['alm_prod_cab_moneda'] = $moneda;
		$valor['alm_prod_cab_porcentaje'] = 0;
		$valor['alm_prod_cab_suc_origen'] = $suc_org;
		if(isset($imag['dat_tec']['tmp_name'])){
			if(!empty($imag['dat_tec']['tmp_name'])){
				$ruta = '';
				$cod_un_img = uniqid('inter_det_'); 
				$ruta = '../../images/producto/dt/'.$cod_un_img.$imag['dat_tec']['name'];
				copy($imag['dat_tec']['tmp_name'], $ruta);
				$valor['alm_prod_cab_pdf_descp'] = $ruta;
			}
		}else{
			
			$valor['alm_prod_cab_pdf_descp'] = $descripcion[0]['alm_prod_cabecera']['alm_prod_cab_pdf_descp'];
		}
		if(isset($imag['img_produc']['tmp_name'])){
			if(!empty($imag['img_produc']['tmp_name'])){
				$ruta2 = '';
				$cod_un_img = uniqid('inter_img_');
				$ruta2 = '../../images/producto/img/'.$cod_un_img.$imag['img_produc']['name'];
				copy($imag['img_produc']['tmp_name'], $ruta2);
				$valor['alm_prod_cab_img'] = $ruta2;
			}
		}else{
			$valor['alm_prod_cab_img'] = $descripcion[0]['alm_prod_cabecera']['alm_prod_cab_img'];
		}
		$valor['alm_prod_cab_usr_alta'] = $login;
	  	if($this->mysql->insert('alm_prod_cabecera', $valor)){
	    	$json_data['completo'] = true;
			$json_data['alm_prod_cab_id_unico_prod'] = $valor['alm_prod_cab_id_unico_prod']; 
	    	$json_data['alm_prod_cab_nombre'] = $valor['alm_prod_cab_nombre']; 
	  	}else{
		 	$json_data['completo'] = false;
	  	}
	  	print(json_encode($json_data));
	}

	/** Este es le metodo que optiene la descripcion de cabecera **/
	public function getCabDescp($unico){
		$query = 'SELECT * FROM alm_prod_cabecera WHERE alm_prod_cab_id_unico_prod="'.$unico.'" and ISNULL(alm_prod_cab_usr_baja)';
		return $this->mysql->query($query);
	}
	/**
	*	Metodo el cual lista el detalle de los productos  
	*/
	public function CargarDetProductos($codigo){
		//print_r($codigo);
		$query ='SELECT * FROM alm_prod_detalle WHERE alm_prod_cab_codigo="'.$codigo.'" and ISNULL(alm_prod_det_usr_baja)';
		//print_r($query);
		return $this->mysql->query($query);
	}
	/**
	*	Metodo el cual lista el detalle de los productos  para modificar
	*/
	
	public function listarDetProductos($codigo,$id){
		//print_r($codigo);
		$query ='SELECT * FROM alm_prod_detalle WHERE alm_prod_det_id_unico="'.$codigo.'" and alm_prod_det_id='.$id;
		//print_r($query);
		return $this->mysql->query($query);
	}

		/**
	*	Metodo que devuelve el cod de un producto
	*/
	
	public function getCodProducto($id_unico){
		//print_r($codigo);
		$query ='SELECT alm_prod_cab_codigo FROM alm_prod_cabecera WHERE alm_prod_cab_id_unico_prod="'.$id_unico.'"';
		//print_r($query);
		return $this->mysql->query($query);
	}
	
   /*
	* Metodo formulario confirmacion de eliminacion
	*/
	/*public function nuevoItemProductoDetalle(){
		$template = file_get_contents('tpl/formulario_nuevo_item_detalle.html');
	    print($template);
		
	}*/


	/***
	* Metodo que obtiene el codigo de la cabecera para mostrar en el producto
	*
	*/
	public function obtenerCodCab($codCab){
		$query = 'SELECT alm_prod_cab_codigo 
		          FROM alm_prod_cabecera 
		          WHERE alm_prod_cab_id_unico_prod="'.$codCab.'"';

		          //print_r($query);
		return $this->mysql->query($query);
	}

	   /*
	* Metodo formulario confirmacion de eliminacion
	*/
	public function desabilitarProducto(){
		$template = file_get_contents('tpl/dialogo_msg_tpl.html');
	    print($template);
		
	}

	   /*
	* Metodo formulario confirmacion de eliminacion
	*/
	public function modificarProducto(){
		//print_r("expression");
		$template = file_get_contents('tpl/formulario_modif_productos_tpl.html');
	    print($template);		
	}

	/*
	* Metodo formulario confirmacion de eliminacion
	*/
	public function eliminarDetProducto(){
		$template = file_get_contents('tpl/det_dialogo_msg_tpl.html');
	    print($template);
		
	}
   
	/**
	  *  Metodo que permite imprimir el dialogo de los mensajes en el html
	  */
	 public function dialogoMensaje(){
	 	$template = file_get_contents('tpl/dialogos_msg_tpl.html');
	 	print($template);
	 }


   public function darBajaProductos($cod,$nom,$login){
   		$util = new Utilitarios();
		$fecha= $util->obtenerFechaActual();	
		//$cod_det= $util->obtenerFechaActual();	
		$value['alm_prod_cab_usr_baja']=$login;
		$value['alm_prod_cab_fch_hr_baja']=$fecha;

		if ($this->mysql->update('alm_prod_cabecera',$value,'alm_prod_cab_id_unico_prod="'.$cod.'"')){
			return true;
		}else{
			return false;
		}
   }

   /**
   * Metodo que elimina el detalle del producto
   *
   */
   public function darBajadDetProductos($cod,$nom,$login){
   	

   		$util = new Utilitarios();
	
		$fecha= $util->obtenerFechaActual();
		//echo $cod."-".$nom."-".$login."-".$fecha;
		
		$value['alm_prod_det_usr_baja']=$login;
		$value['alm_prod_det_fch_hr_baja']=$fecha;

		if ($this->mysql->update('alm_prod_detalle',$value,'alm_prod_det_id_unico="'.$cod.'"')){
			return true;
		}else{
			return false;
		}

   }



   /**
	*	Metodo el cual lista el detalle de los productos  para modificar
	*/
	
	public function darBajaDetProductos($codigo,$id,$login){
		
		
		$util = new Utilitarios();
	
		$fecha= $util->obtenerFechaActual();
		//echo $codigo."-".$id."-".$login."-".$fecha;
		
		$value['alm_prod_det_usr_baja,']=$login;
		$value['alm_prod_det_fch_hr_baja']=$fecha;
		//echo($this->mysql->update('alm_prod_detalle',$value,'alm_prod_cab_codigo="'.$codigo.'" and alm_prod_det_id='.$id));
		if ($this->mysql->update('alm_prod_detalle',$value,'alm_prod_cab_codigo="'.$codigo.'" and alm_prod_det_id='.$id)) {
			return true;
			 //$json_data['completo'] = true;
			//$json_data['alm_prod_cab_id_unico_prod'] = $valor['alm_prod_cab_id_unico_prod'];
		}else{
			//$json_data['completo'] = false;
			return false;
		}

		  print(json_encode($json_data));
		
	}
	
	
		/**
	 * Metodo que actualiza el estado de lo sproductoa del detalle en la base de datos
	 * @param 
	 */
	public function updateDetProductos($codigo,$id,$fech_ingreso_me,$serie_me,$cant_prod_deta_me,$estado_producto_me,$p_c_me,$p_v_me,$p_min_v_me,$p_max_v_me,$fech_venc_me,$part_number_me,$t_c_me,$lot_me, $login){
		
		
		//print_r($codigo."--".$id."--".$fech_ingreso_me."--".$serie_me."--".$cant_prod_deta_me."--".$estado_producto_me."--".$p_c_me."--".$p_v_me."--".$p_min_v_me."--".$p_max_v_me."--".$fech_venc_me."--".$part_number_me."--".$t_c_me."--".$lot_me."--". $login);

			//print_r($estado_producto_me);
		//print_r($codigo);
		$util = new utilitarios();
		
		//$valor['alm_prod_det_id'] = NULL;
		//$valor['alm_prod_cab_codigo'] = $codigo;
		$valor['alm_prod_cab_fec_ing'] = $util->cambiaf_a_mysql($fech_ingreso_me);
		//$valor['alm_prod_det_marca'] = $marka_me;
		$valor['alm_prod_det_serie'] = $serie_me;
		$valor['alm_prod_det_tc'] = $t_c_me;
		$valor['alm_prod_det_cantidad'] = $cant_prod_deta_me;
		$valor['alm_prod_det_prec_compra'] = $p_c_me;
		$valor['alm_prod_det_prec_venta'] = $p_v_me;
		$valor['alm_prod_det_prec_max_venta'] = $p_max_v_me;
		$valor['alm_prod_det_prec_min_venta'] = $p_min_v_me;
		$valor['alm_prod_det_estado'] = $estado_producto_me;
		$valor['alm_prod_det_fecha_venc'] = $util->cambiaf_a_mysql($fech_venc_me);
		$valor['alm_prod_det_lote'] = $lot_me;
		$valor['alm_prod_det_part_number'] = $part_number_me;
		$valor['alm_prod_det_usr_alta'] = $login;

		//print_r($valor);
		 if($this->mysql->update('alm_prod_detalle', $valor,'alm_prod_det_id_unico="'.$codigo.'" and alm_prod_det_id='.$id)){
			 return true; 
		  }else{
			 return false;
		  }
		  
	}

	/**
	 * Esta e la lista de los productos por palabra
	 */
	public function listaProductosxPalabra($palabra){

			//print_r($palabra);
		$query='SELECT
				pc.alm_prod_cab_id_unico_prod,pc.alm_prod_cab_codigo,pc.alm_prod_cab_tipo,pc.alm_prod_cab_fecha_proceso,
				pc.alm_prod_cab_prov,pc.alm_prod_cab_nombre,pc.alm_prod_cab_unidad,pc.alm_prod_cab_moneda,
				pc.alm_prod_cab_suc_origen,
				(SELECT COUNT(alm_prod_cab_codigo) FROM alm_prod_detalle WHERE alm_prod_cab_codigo=pc.alm_prod_cab_id_unico_prod AND ISNULL(alm_prod_det_usr_baja)) as totalItems,
				(SELECT GRAL_PAR_PRO_DESC FROM gral_param_propios 
				 					WHERE gral_par_pro_grp=1000 AND GRAL_PAR_PRO_COD >= 1 AND gral_par_pro_cod=pc.alm_prod_cab_tipo) as Tipo,
				(SELECT GRAL_AGENCIA_NOMBRE
									FROM gral_agencia WHERE GRAL_AGENCIA_CODIGO=pc.alm_prod_cab_suc_origen) AS AGE_ORIG,
				(SELECT GRAL_PAR_PRO_DESC
									FROM gral_param_propios 
									WHERE gral_par_pro_grp=1200 AND GRAL_PAR_PRO_COD >= 1 AND GRAL_PAR_PRO_COD=pd.alm_prod_det_estado) AS ESTADO,
				(SELECT (CASE WHEN sum(alm_prod_det_cantidad)<>0 THEN sum(alm_prod_det_cantidad) ELSE 0 END)FROM alm_prod_detalle WHERE alm_prod_cab_codigo=pc.alm_prod_cab_id_unico_prod AND ISNULL(alm_prod_det_usr_baja)) as cantidad
				FROM
				alm_prod_cabecera as pc, alm_prod_detalle as pd
				WHERE  ISNULL(pc.alm_prod_cab_usr_baja) AND (pc.alm_prod_cab_codigo LIKE "%'.$palabra.'%" OR
																pc.alm_prod_cab_nombre LIKE "%'.$palabra.'%" OR
																pc.alm_prod_cab_marca LIKE "%'.$palabra.'%")
				GROUP BY pc.alm_prod_cab_id_unico_prod;';


//print_r($query);


/*


		$query = 'SELECT pc.alm_prod_cab_codigo,pc.alm_prod_cab_id_unico_prod,
						(SELECT GRAL_PAR_PRO_DESC FROM gral_param_propios 
						WHERE gral_par_pro_grp=1000 AND GRAL_PAR_PRO_COD >= 1 AND gral_par_pro_cod=pc.alm_prod_cab_tipo) as tipo,
						pc.alm_prod_cab_nombre,	pc.alm_prod_cab_cantidad_stock,	
						(SELECT GRAL_AGENCIA_NOMBRE
						FROM gral_agencia WHERE GRAL_AGENCIA_CODIGO=pc.alm_prod_cab_suc_origen) AS AGE_ORIG,
						pd.alm_prod_det_prec_compra,pd.alm_prod_det_prec_venta,
						(SELECT GRAL_PAR_PRO_DESC
						FROM gral_param_propios 
						WHERE gral_par_pro_grp=1200 AND GRAL_PAR_PRO_COD >= 1 AND GRAL_PAR_PRO_COD=pd.alm_prod_det_estado) AS ESTADO, SUM(pd.alm_prod_det_cantidad) as cantidad
					FROM alm_prod_cabecera pc INNER JOIN alm_prod_detalle pd ON pc.alm_prod_cab_id_unico_prod=pd.alm_prod_cab_codigo
					WHERE ISNULL(pc.alm_prod_cab_usr_baja) AND (pc.alm_prod_cab_codigo LIKE "%'.$palabra.'%" OR
																pc.alm_prod_cab_nombre LIKE "%'.$palabra.'%" OR
																pc.alm_prod_cab_marca LIKE "%'.$palabra.'%")
					GROUP BY pc.alm_prod_cab_codigo';*/

		return $this->mysql->query($query);
	}
	
	/**
	 * Esta e la lista de los productos por palabra
	 */
	public function listaProductosxxxPalabra($codigo_proyecto){
			//print_r($codigo_proyecto);

		$query = 'SELECT * 
					FROM alm_prod_cabecera
					WHERE ISNULL(alm_prod_cab_usr_baja) 
					       AND (alm_prod_cab_nombre LIKE "%'.$codigo_proyecto.'%" OR alm_prod_cab_codigo like "%'.$codigo_proyecto.'%" OR alm_prod_cab_cod_ref like "%'.$codigo_proyecto.'%")';
		//print_r($query);
		return $this->mysql->query($query);
	}


/***
**	Metodo el cuan actualiza lacantidad de lacabecera
*/
	public function updateCantidadCab($codigo, $cantidad){
		
		//print_r("---------".$codigo."--".$cantidad);
		//$util = new Utilitarios();
		//$fecha= $util->obtenerFechaActual();		
		$value['alm_prod_cab_cantidad_stock']=$cantidad;
		//$value['alm_prod_cab_fch_hr_baja']=$fecha;

		if ($this->mysql->update('alm_prod_cabecera',$value,'alm_prod_cab_id_unico_prod="'.$codigo.'"')){
			return true;
		}else{
			return false;
		}

	}

}
?>