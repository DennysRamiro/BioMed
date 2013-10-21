<?php
	require_once "../lib/Mysql.php";
    require_once '../importaciones/clases/Utilitarios.php';
	/**
	 *
	 */
	class IndexModel{

		private $mysql;
		/**
		 * Comentarios del constructor
		 */
		public function __construct() {
        	// definir variables propias de la clase
        	$this->mysql = new Mysql();
    	}

         /**
             * Metodo que lista Cotizacion
             */
    	public function listarIgresos($start, $limit, $valor){
        $query ='SELECT *,(SELECT gral_agencia_nombre FROM gral_agencia WHERE gral_agencia_codigo=alm_cab_ing_egr_origen) as origen,
                (SELECT gral_agencia_nombre FROM gral_agencia WHERE gral_agencia_codigo=alm_cab_ing_egr_destino) as destino, 
                (SELECT  GRAL_PAR_PRO_DESC FROM gral_param_propios WHERE GRAL_PAR_PRO_GRP=60 AND GRAL_PAR_PRO_COD=alm_cab_ing_egr_motivo_registro) AS estado 
                FROM alm_ing_egr_cab 
                WHERE ISNULL(alm_cab_ing_egr_usr_baja) AND alm_cab_ing_egr_motivo='.$valor.' 
                ORDER BY alm_cab_ing_egr_nro_nota DESC
                LIMIT '.$start.','.$limit;
    		return $this->mysql->query($query);
    	}
    /** Esta es la funcion que permite listar los detalles de ingreso **/
    public function listaIngresosDetalles ($start, $limit, $valor){
      $query ='SELECT *, 
                     (SELECT  GRAL_PAR_PRO_DESC FROM gral_param_propios WHERE GRAL_PAR_PRO_GRP=60 AND GRAL_PAR_PRO_COD=alm_ing_egr_det_estado) AS estado,
                     (SELECT  GRAL_PAR_PRO_DESC FROM gral_param_propios WHERE GRAL_PAR_PRO_GRP=1100 AND GRAL_PAR_PRO_COD <> 0 AND GRAL_PAR_PRO_COD=aied.alm_ing_egr_det_unidad) AS unidad_detalle,
                     (SELECT gral_agencia_nombre FROM gral_agencia WHERE gral_agencia_codigo=aiec.alm_cab_ing_egr_destino) as destino
               FROM alm_ing_egr_det AS aied INNER JOIN alm_ing_egr_cab AS aiec ON aied.alm_ing_egr_det_cod_unico_cab = aiec.alm_cab_ing_nro_unico
               WHERE ISNULL(alm_ing_egr_det_det_usr_baja) AND ISNULL(alm_cab_ing_egr_usr_baja) AND (aied.alm_ing_egr_det_estado=1 OR aied.alm_ing_egr_det_estado=2)
               ORDER BY aiec.alm_cab_ing_egr_nro_nota DESC
               LIMIT '.$start.','.$limit;
        return $this->mysql->query($query);
    }
    /** Est es el metodo q optiene los datos por */
    public function getDatosProductoDetalle($datos){
      $query = 'SELECT *
                FROM alm_prod_cabecera AS apc INNER JOIN alm_prod_detalle AS apd  ON apc.alm_prod_cab_id_unico_prod = apd.alm_prod_cab_codigo 
                WHERE apc.alm_prod_cab_id_unico_prod = "'.$datos['id_producto'].'" AND apd.alm_prod_cab_codigo="'.$datos['id_producto'].'" AND ISNULL(apc.alm_prod_cab_usr_baja) 
                      AND ISNULL(apd.alm_prod_det_usr_baja) 
                GROUP BY apd.alm_prod_det_id_unico';
      return $this->mysql->query($query);
    }
    /** Metodo que permite optener el los datos del producto **/
    public function optenerProductoSelecionado($datos){
      $query = 'SELECT * 
                FROM alm_prod_cabecera AS apc INNER JOIN alm_prod_detalle AS apd  ON apc.alm_prod_cab_id_unico_prod = apd.alm_prod_cab_codigo 
                WHERE apd.alm_prod_det_id_unico = "'.$datos['id_producto'].'" AND ISNULL(apc.alm_prod_cab_usr_baja) AND ISNULL(apd.alm_prod_det_usr_baja) 
                GROUP BY apd.alm_prod_det_id_unico';
      return $this->mysql->query($query);
    }
    /** Este es el metodo que confirma la orden de Ingreso **/
    public function confirmarOrdenIngreso($datos){
      // aqui es donde tienes que confirmar la transaccion del producto
      $query = 'SELECT * FROM alm_prod_detalle WHERE alm_prod_det_id_unico="'.$datos['codigo_prod'].'"';
      $producto = $this->mysql->query($query);
      //print_r($producto);
      $val['alm_prod_det_cantidad'] = ($datos['cantidad_prod']+$producto[0]['alm_prod_detalle']['alm_prod_det_cantidad']);
      $condicion = 'alm_prod_det_id_unico="'.$datos['codigo_prod'].'"';
      $res = false;
      if($this->mysql->update('alm_prod_detalle', $val, $condicion)){
        $value['alm_ing_egr_det_estado'] = 2;
        $cond = 'alm_ing_egr_det_nro_unico="'.$datos['num_unico_det'].'"';
        if($this->mysql->update('alm_ing_egr_det', $value, $cond)){
          $query = 'SELECT * FROM alm_ing_egr_det WHERE alm_ing_egr_det_nro_unico="'.$datos['num_unico_det'].'"';
          $detalle = $this->mysql->query($query);
          $v['alm_cab_ing_egr_motivo_registro'] = 2;
          $cond = 'alm_cab_ing_nro_unico="'.$detalle[0]['alm_ing_egr_det']['alm_ing_egr_det_cod_unico_cab'].'"';
          if($this->mysql->update('alm_ing_egr_cab',$v, $cond)){
            $res = true;  
          }else{
            $res = false;
          }
        }else{
          $res = false;
        }
      }else{
        $res = false;
      }
      return $res;
      //print_r($datos);
    }

    /** Este es el metodo que permite optener el proveedor */
    public function getProveedor($codigo_prov){
      $query = 'SELECT alm_prov_nombre FROM alm_proveedor WHERE alm_prov_codigo_int="'.$codigo_prov.'"';
      return $this->mysql->query($query);
    }
    public function getSucursalOrigen($codigo_sucursal){
      $query = 'SELECT GRAL_AGENCIA_NOMBRE FROM gral_agencia WHERE GRAL_AGENCIA_CODIGO="'.$codigo_sucursal.'"';
      return $this->mysql->query($query);
    }
    /** Metodo que permite optener la socursal */
    public function getSucursal($codigo_sucursal){

    }
    /** Esta es la uniodad del producto **/
    public function getUnidadXId($id){
      $query = 'SELECT GRAL_PAR_PRO_DESC
                    FROM gral_param_propios 
                    WHERE gral_par_pro_grp=1100 AND GRAL_PAR_PRO_COD >= 1 AND GRAL_PAR_PRO_COD='.$id;
      return $this->mysql->query($query);
    }
    /**
     * Metodo que devuelve total de los ingresos
     */
    public function totalIngresos($valor){
      //print_r($valor);
        $query = 'SELECT COUNT(*) AS total  FROM alm_ing_egr_cab WHERE  ISNULL(alm_cab_ing_egr_usr_baja) AND alm_cab_ing_egr_motivo='.$valor;
      //print_r($query);
        return $this->mysql->query($query);
    }
    /**
     * Metodo que se encarga de contar los detalles de cada cabecera
     **/
    public function totalIngresosDetalle(){
        $query = 'SELECT COUNT(*) AS total  FROM alm_ing_egr_det WHERE  ISNULL(alm_ing_egr_det_det_usr_baja) AND alm_ing_egr_det_estado=1';
        return $this->mysql->query($query); 
    }
    /**
     * Metodo que devuelve total de los ingresos desde el boton
     */
    public function totalIngresosBoton($buscar_palabra){
        //echo ($start."-".$limit."-".$valor);
        $query = 'SELECT COUNT(*) AS total  
                  FROM alm_ing_egr_cab cab INNER JOIN gral_agencia orig ON cab.alm_cab_ing_egr_origen=orig.GRAL_AGENCIA_CODIGO 
                  INNER JOIN gral_agencia dest ON cab.alm_cab_ing_egr_destino=dest.GRAL_AGENCIA_CODIGO 
                  WHERE (cab.alm_cab_ing_egr_nro_nota LIKE "%'.$buscar_palabra.'%" OR 
                  cab.alm_cab_ing_egr_nombre LIKE "%'.$buscar_palabra.'%" OR
                  orig.GRAL_AGENCIA_NOMBRE LIKE "%'.$buscar_palabra.'%" OR
                  dest.GRAL_AGENCIA_NOMBRE LIKE "%'.$buscar_palabra.'%") AND ISNULL(cab.alm_cab_ing_egr_usr_baja) AND ISNULL(orig.GRAL_AGENCIA_USR_BAJA) AND ISNULL(dest.GRAL_AGENCIA_USR_BAJA) AND cab.alm_cab_ing_egr_motivo=1
                  ORDER BY cab.alm_cab_ing_egr_nro_nota ASC';
                  //LIMIT '.$start.',10';
        //print_r($query);
        return $this->mysql->query($query);
      }
      /**
       * Metodo que buscar ingresos
       */
      public function buscarIngresos($buscar_palabra){
        //echo ($start."-".$limit."-".$valor);

        $query = 'SELECT * 
                  FROM alm_ing_egr_cab cab INNER JOIN gral_agencia orig ON cab.alm_cab_ing_egr_origen=orig.GRAL_AGENCIA_CODIGO 
                  INNER JOIN gral_agencia dest ON cab.alm_cab_ing_egr_destino=dest.GRAL_AGENCIA_CODIGO 
                  WHERE (cab.alm_cab_ing_egr_nro_nota LIKE "%'.$buscar_palabra.'%" OR 
                  cab.alm_cab_ing_egr_nombre LIKE "%'.$buscar_palabra.'%" OR
                  orig.GRAL_AGENCIA_NOMBRE LIKE "%'.$buscar_palabra.'%" OR
                  dest.GRAL_AGENCIA_NOMBRE LIKE "%'.$buscar_palabra.'%") AND ISNULL(cab.alm_cab_ing_egr_usr_baja) AND ISNULL(orig.GRAL_AGENCIA_USR_BAJA) AND ISNULL(dest.GRAL_AGENCIA_USR_BAJA) AND cab.alm_cab_ing_egr_motivo=1
                  ORDER BY cab.alm_cab_ing_egr_nro_nota ASC';
        //print_r($query);
        return $this->mysql->query($query);
      }

      /*
       * Metodo para buescar ingresos desde el boton
       */
      public function buscarIngresosBoton($start, $limit, $buscar_palabra){
        //echo ($start."-".$limit."-".$valor);
        $query = 'SELECT *
                  FROM alm_ing_egr_cab cab INNER JOIN gral_agencia orig ON cab.alm_cab_ing_egr_origen=orig.GRAL_AGENCIA_CODIGO 
                  INNER JOIN gral_agencia dest ON cab.alm_cab_ing_egr_destino=dest.GRAL_AGENCIA_CODIGO 
                  WHERE (cab.alm_cab_ing_egr_nro_nota LIKE "%'.$buscar_palabra.'%" OR 
                  cab.alm_cab_ing_egr_nombre LIKE "%'.$buscar_palabra.'%" OR
                  orig.GRAL_AGENCIA_NOMBRE LIKE "%'.$buscar_palabra.'%" OR
                  dest.GRAL_AGENCIA_NOMBRE LIKE "%'.$buscar_palabra.'%") AND ISNULL(cab.alm_cab_ing_egr_usr_baja) AND ISNULL(orig.GRAL_AGENCIA_USR_BAJA) AND ISNULL(dest.GRAL_AGENCIA_USR_BAJA) AND cab.alm_cab_ing_egr_motivo=1
                  ORDER BY cab.alm_cab_ing_egr_nro_nota ASC
                  LIMIT '.$start.',10';
        //print_r($query);
        return $this->mysql->query($query);
      }

        /*
         * Este es el metodo que devuelve los datos de una nota de ingreso seleccionado desde la busqueda autocomplet
         */
        public function getDatosBusIng($id_unico){
            $consulta  = 'SELECT * 
                          FROM alm_ing_egr_cab cab 
                          WHERE alm_cab_ing_nro_unico="'.$id_unico.'" AND alm_cab_ing_egr_motivo=1';
            return $this->mysql->query($consulta);
        }

    /*
     * Este es el metodo que devuelve la region 
     */
    public function getRegionOp($id_region){
        $consulta  = 'SELECT GRAL_AGENCIA_NOMBRE
                      FROM gral_agencia 
                      WHERE GRAL_AGENCIA_USR_BAJA is null AND GRAL_AGENCIA_CODIGO='.$id_region.'';
        return $this->mysql->query($consulta);
    }

        /*
         * Este es el metodo que devuelve los datos de la empresa
         * 
         */
        public function getEmpresa(){
            $consulta  = "SELECT GRAL_EMP_NOMBRE,GRAL_EMP_CENTRAL 
                          FROM gral_empresa";
            return $this->mysql->query($consulta);
        }

        /*
     * Este es el metodo que devuelve los datos de tipos de ingresos
     * 
     */
    public function getMotivo(){
        $consulta  = "SELECT GRAL_PAR_PRO_COD,GRAL_PAR_PRO_DESC 
                      FROM gral_param_propios 
                      WHERE GRAL_PAR_PRO_GRP=15 AND GRAL_PAR_PRO_COD <>0";
        return $this->mysql->query($consulta);
    }


    /*
     * Este es el metodo que devuelve los datos de las ciudades
     * 
     */
    public function getDestino(){
        $consulta  = "SELECT * FROM gral_agencia ";
        return $this->mysql->query($consulta);
    }

     
     /*
     * Este es el metodo que devuelve el numero de 
     * 
     */
        public function getUltimo(){
            $consulta  = "SELECT * FROM gral_agencia ";
            return $this->mysql->query($consulta);
        }

    /*
     * Este es el metodo que graba el i ngreso de almacenes
     * 
     */
    public function guardarNuevoIngreso($datos){
      $util = new Utilitarios();
      $bu = $this->getMaxNro();
      $bul = $this->getNroNota($bu);
      $dato_usuario = $this->getUsuarioDatos($_SESSION['login']);
      $valores['alm_cab_ing_egr_correlativo']=$bu+1;
      $valores['alm_cab_ing_nro_unico']=$this->getCodigoUnicoingreso();
      $valores['alm_cab_ing_egr_nombre']=$dato_usuario[0]['gral_usuario']['GRAL_USR_NOMBRES']." ".$dato_usuario[0]['gral_usuario']['GRAL_USR_AP_PATERNO']; 
      $valores['alm_cab_ing_egr_nro_nota']=$bul;
      $valores['alm_cab_ing_egr_fecha_ingreso']=$util->cambiaf_a_mysql($datos['alm_fec_ing']);     
      $valores['alm_cab_ing_egr_motivo']=$datos['alm_motivo_ing']; 
      $valores['alm_cab_ing_egr_origen']=$datos['ing_origen']; 
      $valores['alm_cab_ing_egr_destino']=$datos['ing_destino'];
      $valores['alm_cab_ing_egr_motivo_registro'] = 1;
      $valores['alm_cab_ing_egr_usr_alta']=$_SESSION['login'];
      $valores['alm_cab_ing_egr_fech_alta']=$util->cambiaf_a_mysql($_SESSION['fec_proc']);
      if($this->mysql->insert('alm_ing_egr_cab', $valores)){
        $json_res['completo'] = true;
        $json_res['cod_unico'] = $valores['alm_cab_ing_nro_unico'];
      }else{
          $json_res['completo'] = false;
      }
      print_r(json_encode($json_res));
     /*  */
    }

       /** 
     * Generar codigo unico de ingreso, egreso y traspaso 
     */
    private function getCodigoUnicoingreso(){  
      $codigo = uniqid('INTER_ALM_ING_');
      return $codigo;
    }

    /**
    * metodo que genera el numero de la nota de entrega
    */
    private function getNroNota($ultimo){
      //print_r("llega");
      
      //$ultimo = $this->getMaxNro();
      //print_r($ultimo);
      $cant = strlen($ultimo);
      //print_r($cant);
      $total = 6;
      $lo = '';
      for ($i=0; $i < ($total-$cant)  ; $i++) { 
        $lo = $lo.'0';
      }
      //print_r($lo);
      //print_r("--");
      //print_r(($ultimo+1));
      //print_r($lo.($ultimo+1));
    return $lo.($ultimo+1);
 
     // print_r($nro);
   /*   //return $nro;
*/

    }

    /**
    * Metodo que busca el maximo numero
    */
    private function getMaxNro(){
      //print_r("expression");
      $query='SELECT MAX(alm_cab_ing_egr_correlativo) as val FROM alm_ing_egr_cab WHERE alm_cab_ing_egr_motivo=1';
      $max = $this->mysql->query($query);
      return $max[0][0]['val'];
    }

     /*
     * Este es el metodo que graba el ingreso de almacenes
     * 
     */
    public function guardarNuevoDetalle($datos){
      $util = new Utilitarios();
      $uni_det_ing_egre = $this->getCodigoUnicoingreso();
      $valores['alm_ing_egr_det_cod_unico_cab'] = $datos['codigo_cab_unico_ing_egr'];
      $valores['alm_ing_egr_det_cod_unico_desc']=$datos['cod_unico_producto'];
      $valores['alm_ing_egr_det_nro_unico']=$uni_det_ing_egre;
      $valores['alm_ing_egr_det_cod_int']=$datos['alm_det_cod_int']; 
      $valores['alm_ing_egr_det_descripcion']=$datos['alm_det_desc'];     
      $valores['alm_ing_egr_det_referencia']=$datos['alm_det_ref']; 
      $valores['alm_ing_egr_det_unidad']=$datos['alm_det_piezas_cod']; 
      $valores['alm_ing_egr_det_cantidad']=$datos['alm_det_cantidad'];
      $valores['alm_ing_egr_det_estado'] = 1;      
      $valores['alm_ing_egr_det_usr_alta']=$_SESSION['login'];
      $valores['alm_ing_egr_det_fech_alta']=$util->cambiaf_a_mysql($_SESSION['fec_proc']);
     if($this->mysql->insert('alm_ing_egr_det', $valores)){
          $json_res['completo'] = true;
          $json_res['cod_unico'] = $valores['alm_ing_egr_det_nro_unico'];
          
      }else{
          $json_res['completo'] = false;
      }
      print_r(json_encode($json_res));
    }

/**
   * Metodo que devuelve la lista de las medidas que se tiene
   * 
   */
    public function getunidad(){
    
      $query='SELECT GRAL_PAR_PRO_COD, GRAL_PAR_PRO_SIGLA,GRAL_PAR_PRO_DESC
          FROM gral_param_propios 
          WHERE gral_par_pro_grp=1100 AND GRAL_PAR_PRO_COD >= 1';
      //print_r($query);
      return $this->mysql->query($query);
  }

  /**
   * Metodo que devuelve la lista los datos para la modificacion
   * 
   */
    public function getDataIngresosCab($unico){
    
      $query='SELECT * 
              FROM alm_ing_egr_cab 
              WHERE alm_cab_ing_nro_unico="'.$unico.'" and ISNULL(alm_cab_ing_egr_usr_baja)';
      //print_r($query);
      return $this->mysql->query($query);
  }

  /**
   * Metodo que devuelve la lista los datos para la modificacion
   * 
   */
    public function getDataIngresosDet($unico){
    
     /* $query='SELECT * 
              FROM alm_ing_egr_cab c INNER JOIN alm_ing_egr_det d ON c.alm_cab_ing_nro_unico=d.alm_ing_egr_det_cod_unico_cab
              WHERE c.alm_cab_ing_nro_unico="'.$unico.'" and ISNULL(c.alm_cab_ing_egr_usr_baja)';
      print_r($query);*/

      $query ='SELECT *,(SELECT GRAL_PAR_PRO_DESC
                         FROM gral_param_propios 
                         WHERE gral_par_pro_grp=1100 AND GRAL_PAR_PRO_COD >= 1 AND GRAL_PAR_PRO_COD= d.alm_ing_egr_det_unidad) as unidad
              FROM alm_ing_egr_cab c INNER JOIN alm_ing_egr_det d ON c.alm_cab_ing_nro_unico=d.alm_ing_egr_det_cod_unico_cab
              WHERE c.alm_cab_ing_nro_unico="'.$unico.'" and ISNULL(c.alm_cab_ing_egr_usr_baja)';       
      return $this->mysql->query($query);
  }

  /**
  * Metodo que guardas las modificaciones de ingresos de la cabecera
  */
  public function saveEditIngresoCab($datos){
    // print_r($datos);
     $util = new Utilitarios();
     $usuario_datos = $this->getUsuarioDatos($_SESSION['login']);
     $valores['alm_cab_ing_nro_unico']=$datos['alm_unico_ing_edit'];
     $valores['alm_cab_ing_egr_nro_nota']=$datos['nro_nota_edit'];
     $valores['alm_cab_ing_egr_cod']='89ui';
     $valores['alm_cab_ing_egr_nombre']=$usuario_datos[0]['gral_usuario']['GRAL_USR_NOMBRES']." ".$usuario_datos[0]['gral_usuario']['GRAL_USR_AP_PATERNO'];
     $valores['alm_cab_ing_egr_fecha_ingreso']= $util->cambiaf_a_mysql($datos['alm_fec_ing_edit']);
     $valores['alm_cab_ing_egr_origen']=$datos['ing_origen'];
     $valores['alm_cab_ing_egr_detino']=$datos['ing_destino'];
     $valores['alm_cab_ing_egr_motivo']=$datos['alm_motivo_ing_edit_01'];
     $valores['alm_cab_ing_egr_usr_alta']=$_SESSION['login'];
     $valores['alm_cab_ing_egr_fech_alta']=  $util->cambiaf_a_mysql($_SESSION['fec_proc']);
     $condicion = "alm_cab_ing_nro_unico='".$datos['alm_unico_ing_edit']."'";
    if ( $this->mysql->update('alm_ing_egr_cab', $valores, $condicion)){
        $json_res['completo'] = true;
        $json_res['unico'] = $valores['alm_cab_ing_nro_unico'];

     }else{
        $json_res['completo'] = true;
     }
     print_r(json_encode($json_res));
  }
    /**
     * Metodo que permite eliminar un cliente
     */
    public function deleteIngreso($codigo){
      
      //print_r($codigo);
      /*date_default_timezone_set('America/La_Paz');
      $fecha_actual  = date("y-m-d H:i:s");
      $valores['vent_cli_usr_baja'] = $_SESSION['login'];
      $valores['vent_cli_fch_hr_baja'] = $fecha_actual;
      */
     $condicion = "alm_cab_ing_nro_unico='".$codigo."'";
      //print_r($condicion);
      if($this->mysql->delete('alm_ing_egr_cab', $condicion)){
        return true;
      }else{
        return false;
      }
    }


    /***
    **  Metodo que busca por palabara ingresada en producros
    *
    */
     public function listarBusquedaProductos($palabra){
       /* $consulta = 'SELECT * 
                    FROM alm_prod_cabecera AS apc INNER JOIN alm_prod_detalle AS apd ON apc.alm_prod_cab_id_unico_prod = apd.alm_prod_cab_codigo
                    WHERE ISNULL(alm_prod_cab_usr_baja) AND ISNULL(apd.alm_prod_det_usr_baja) AND (apc.alm_prod_cab_nombre LIKE "%'.$palabra.'%" OR 
                                                                                                   apc.alm_prod_cab_codigo LIKE "%'.$palabra.'%" OR 
                                                                                                   apc.alm_prod_cab_cod_ref LIKE "%'.$palabra.'%" OR
                                                                                                   apc.alm_prod_cab_marca LIKE "%'.$palabra.'%")';*/
        $consulta = 'SELECT * 
                     FROM alm_prod_cabecera 
                     WHERE ISNULL(alm_prod_cab_usr_baja) AND (alm_prod_cab_nombre LIKE "%'.$palabra.'%" OR 
                                                                   alm_prod_cab_codigo LIKE "%'.$palabra.'%" OR 
                                                                   alm_prod_cab_cod_ref LIKE "%'.$palabra.'%" OR
                                                                   alm_prod_cab_marca LIKE "%'.$palabra.'%" )';
        //print_r($consulta);
        return $this->mysql->query($consulta);


     }


     /***
     * Metodo que busca la cantidad para que no ingrese cantidades queno son reales
     *
     */
     public function buscaCantidad($codigo){
          $query = 'SELECT alm_prod_cab_cantidad_stock FROM alm_prod_cabecera WHERE alm_prod_cab_id_unico_prod="'.$codigo.'"';
          return $this->mysql->query($query);
     }

     /***
     * Metodo que busca la cantidad para que no ingrese cantidades queno son reales
     *
     */
     public function buscarPartNumber($codigo){


          $query = 'SELECT alm_prod_det_part_number 
                    FROM alm_prod_detalle 
                    WHERE alm_prod_cab_codigo="'.$codigo.'"
                    GROUP BY alm_prod_det_part_number';

         /* $query = 'SELECT alm_prod_det_part_number 
                    FROM alm_prod_detalle 
                    WHERE alm_prod_cab_codigo in (SELECT alm_prod_cab_id_unico_prod 
                                                  FROM alm_prod_cabecera 
                                                  WHERE alm_prod_cab_codigo='I-GIR-000202')
                    GROUP BY alm_prod_det_part_number';*/

                   // print_r($query);
          return $this->mysql->query($query);
     }

      /***
     * Metodo que busca la cantidad para que no ingrese cantidades queno son reales
     *
     */
     public function buscarUnidad($codigo){

//print_r($codigo);
          
       



          $query = 'SELECT  alm_prod_cab_unidad,(SELECT GRAL_PAR_PRO_DESC
                    FROM gral_param_propios 
                    WHERE gral_par_pro_grp=1100 AND GRAL_PAR_PRO_COD >= 1 AND GRAL_PAR_PRO_COD= alm_prod_cab_unidad) as unidad
                    FROM alm_prod_cabecera 
                    WHERE alm_prod_cab_id_unico_prod="'.$codigo.'"
                    GROUP BY alm_prod_cab_id_unico_prod
                        ';

      
          return $this->mysql->query($query);
     }


     /**
     * Metodo que permite eliminar un cliente
     */
    public function getEditDet($codigo){

      //print_r($codigo);
       
        $query='SELECT *, (SELECT GRAL_PAR_PRO_DESC
                    FROM gral_param_propios 
                    WHERE gral_par_pro_grp=1100 AND GRAL_PAR_PRO_COD >= 1 AND GRAL_PAR_PRO_COD= alm_ing_egr_det_unidad) as unidad
               FROM alm_ing_egr_det 
               WHERE alm_ing_egr_det_nro_unico="'.$codigo.'" and ISNULL(alm_ing_egr_det_det_usr_baja)';

       /*$query='SELECT * 
               FROM alm_ing_egr_det 
               WHERE alm_ing_egr_det_nro_unico="'.$codigo.'" and ISNULL(alm_ing_egr_det_det_usr_baja)';*/
      //print_r($query);
      return $this->mysql->query($query);

    }

    /**
     * Metodo que permite eliminar un cliente
     */
    public function saveEditItemsDet($datos){

       $util = new Utilitarios();

      // print_r($datos);



      //$valores['alm_ing_egr_det_cod_unico_cab']=$datos['alm_det_unico_cab'];
      //$valores['alm_ing_egr_det_nro_unico']=$this->getCodigoUnicoingreso();
      $valores['alm_ing_egr_det_cod_int']=$datos['alm_det_cod_int_edit']; 
      $valores['alm_ing_egr_det_descripcion']=$datos['alm_det_desc_edit'];     
      $valores['alm_ing_egr_det_referencia']=$datos['alm_det_ref_edit']; 
      $valores['alm_ing_egr_det_unidad']=$datos['ing_unidad_edit']; 
      $valores['alm_ing_egr_det_cantidad']=$datos['alm_det_cantidad_edit'];      
      $valores['alm_ing_egr_det_usr_alta']=$_SESSION['login'];
      $valores['alm_ing_egr_det_fech_alta']=$util->cambiaf_a_mysql($_SESSION['fec_proc']);

      $condicion = "alm_ing_egr_det_nro_unico='".$datos['alm_det_unico_cab_edit']."'";

      $valor['unico_cab']=$datos['alm_cab_unico_edit']; 
   

   //print_r($valor);
    //print_r($condicion);
    if ( $this->mysql->update('alm_ing_egr_det', $valores, $condicion)){
       //return true;
        $json_res['completo'] = true;
        $json_res['unico'] = $valor['unico_cab'];

     }else{
        //return false;
        $json_res['completo'] = true;
     }
     print_r(json_encode($json_res));
     /* */
    }



     /**
     * Metodo que permite eliminar un iten del ingreso
     */
    public function deleteIngresoDet($codigo){
      //print_r($codigo);
       $condicion = "alm_ing_egr_det_nro_unico='".$codigo."'";
      //print_r($condicion);
      if($this->mysql->delete('alm_ing_egr_det', $condicion)){
         return true;
          //$json_res['unico'] = $valores['alm_ing_egr_det_nro_unico'];
        //return true;
      }else{
        //return false;
        return false;
      }
    }
    /** Metodo que permite obtener todos los datos del usuarios **/
    public function getUsuarioDatos($login){
      $query = "SELECT * FROM gral_usuario WHERE GRAL_USR_LOGIN='".$login."'";
      return $this->mysql->query($query);
    }
}
?>