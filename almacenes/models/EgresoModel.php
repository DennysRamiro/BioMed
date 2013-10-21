<?php
	require_once "../lib/Mysql.php";
  require_once '../importaciones/clases/Utilitarios.php';
	/**
	 *
	 */
	class EgresoModel{

		private $mysql;
		/**
		 * Comentarios del constructor
		 */
		public function __construct() {
        	// definir variables propias de la clase
        	$this->mysql = new Mysql();
    	}
    /*
     * Este es el metodo que graba el i ngreso de almacenes
     * 
     */
    public function guardarNuevoEgreso($datos){
      $util = new Utilitarios();
      $bu = $this->getMaxNro();
      $bul = $this->getNroNota($bu);
      $datos_usuario = $this->getUsuarioDatos($_SESSION['login']);
      $valores['alm_cab_ing_egr_correlativo']=$bu+1;
      $valores['alm_cab_ing_nro_unico']=$this->getCodigoUnicoegreso();
      $valores['alm_cab_ing_egr_nombre']=$datos_usuario[0]['gral_usuario']['GRAL_USR_NOMBRES']." ".$datos_usuario[0]['gral_usuario']['GRAL_USR_AP_PATERNO']; 
      $valores['alm_cab_ing_egr_nro_nota']=$bul;
      $valores['alm_cab_ing_egr_fecha_ingreso']=$util->cambiaf_a_mysql($datos['alm_fec_egr']);     
      $valores['alm_cab_ing_egr_motivo']=$datos['alm_motivo_egr']; 
      $valores['alm_cab_ing_egr_origen']=$datos['egr_origen']; 
      $valores['alm_cab_ing_egr_destino']=$datos['egr_destino']; 
      $valores['alm_cab_ing_egr_motivo_registro'] = 3;    
      $valores['alm_cab_ing_egr_usr_alta']=$_SESSION['login'];
      $valores['alm_cab_ing_egr_fech_alta']=$util->cambiaf_a_mysql($_SESSION['fec_proc']);
     
      //return $this->mysql->insert('alm_ing_egr_cab', $valores);
      if($this->mysql->insert('alm_ing_egr_cab', $valores)){
         $json_res['completo'] = true;
        $json_res['cod_unico'] = $valores['alm_cab_ing_nro_unico'];
          //return $json_res['cod_unico'] = $valores['alm_cab_ing_nro_unico'];
      }else{
          $json_res['completo'] = false;
      }
      print_r(json_encode($json_res));
    
    } 
    /** Metodo que permite obtener todos los datos del usuarios **/
    public function getUsuarioDatos($login){
      $query = "SELECT * FROM gral_usuario WHERE GRAL_USR_LOGIN='".$login."'";
      return $this->mysql->query($query);
    }

     /** 
     * Generar codigo unico de ingreso, egreso y traspaso 
     */
    private function getCodigoUnicoegreso(){  
      $codigo = uniqid('INTER_ALM_EGR_');
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
      $query='SELECT MAX(alm_cab_ing_egr_correlativo) as val FROM alm_ing_egr_cab WHERE alm_cab_ing_egr_motivo=2';
      $max = $this->mysql->query($query);
      return $max[0][0]['val'];
    }


     /**
     * Metodo que lista Cotizacion
     */
      public function listarEgresos($start, $limit, $valor){
        //echo ($start."-".$limit."-".$valor);

         $query ='SELECT *,(SELECT gral_agencia_nombre FROM gral_agencia WHERE gral_agencia_codigo=alm_cab_ing_egr_origen) as origen,
                (SELECT gral_agencia_nombre FROM gral_agencia WHERE gral_agencia_codigo=alm_cab_ing_egr_destino) as destino
                FROM alm_ing_egr_cab 
                WHERE ISNULL(alm_cab_ing_egr_usr_baja) AND alm_cab_ing_egr_motivo='.$valor.' LIMIT '.$start.','.$limit;

        //print_r($query);

       /* $query = 'SELECT * FROM alm_ing_egr_cab 
        WHERE ISNULL(alm_cab_ing_egr_usr_baja) AND alm_cab_ing_egr_motivo='.$valor.' LIMIT '.$start.','.$limit;
        //print_r($query);*/
        return $this->mysql->query($query);
      }

    
        /** Esta es la funcion que permite listar los detalles de egreso **/
    public function listaEgresosDetalles($start, $limit, $valor){
      $query ='SELECT *, 
                     (SELECT  GRAL_PAR_PRO_DESC FROM gral_param_propios WHERE GRAL_PAR_PRO_GRP=60 AND GRAL_PAR_PRO_COD=alm_cab_ing_egr_motivo_registro) AS estado,
                     (SELECT  GRAL_PAR_PRO_DESC FROM gral_param_propios WHERE GRAL_PAR_PRO_GRP=1100 AND GRAL_PAR_PRO_COD <> 0 AND GRAL_PAR_PRO_COD=aied.alm_ing_egr_det_unidad) AS unidad_detalle,
                     (SELECT gral_agencia_nombre FROM gral_agencia WHERE gral_agencia_codigo=aiec.alm_cab_ing_egr_destino) as destino
               FROM alm_ing_egr_det AS aied INNER JOIN alm_ing_egr_cab AS aiec ON aied.alm_ing_egr_det_cod_unico_cab = aiec.alm_cab_ing_nro_unico
               WHERE ISNULL(alm_ing_egr_det_det_usr_baja) AND aied.alm_ing_egr_det_estado=3
               ORDER BY aiec.alm_cab_ing_egr_nro_nota DESC
               LIMIT '.$start.','.$limit; 
               //print_r($query);
        return $this->mysql->query($query);
    }

     /** Esta es la funcion que permite listar los detalles de egreso **/
    public function listaEgresosDetallesXconfirmar($start, $limit, $valor){
      $query ='SELECT *, 
                     (SELECT  GRAL_PAR_PRO_DESC FROM gral_param_propios WHERE GRAL_PAR_PRO_GRP=60 AND GRAL_PAR_PRO_COD=alm_cab_ing_egr_motivo_registro) AS estado,
                     (SELECT  GRAL_PAR_PRO_DESC FROM gral_param_propios WHERE GRAL_PAR_PRO_GRP=1100 AND GRAL_PAR_PRO_COD <> 0 AND GRAL_PAR_PRO_COD=aied.alm_ing_egr_det_unidad) AS unidad_detalle,
                     (SELECT gral_agencia_nombre FROM gral_agencia WHERE gral_agencia_codigo=aiec.alm_cab_ing_egr_destino) as destino
               FROM alm_ing_egr_det AS aied INNER JOIN alm_ing_egr_cab AS aiec ON aied.alm_ing_egr_det_cod_unico_cab = aiec.alm_cab_ing_nro_unico
              /* WHERE ISNULL(alm_ing_egr_det_det_usr_baja) AND aied.alm_ing_egr_det_estado=3*/
               WHERE ISNULL(alm_ing_egr_det_det_usr_baja) AND (aied.alm_ing_egr_det_estado=4 or aied.alm_ing_egr_det_estado=3)
               ORDER BY aiec.alm_cab_ing_egr_nro_nota DESC
               LIMIT '.$start.','.$limit; 
               //print_r($query);
        return $this->mysql->query($query);
    }

    /**
     * Metodo que devuelve total de los ingresos
     */
    public function totalEgresos($valor){
        $query = 'SELECT COUNT(*) AS total  FROM alm_ing_egr_cab WHERE  ISNULL(alm_cab_ing_egr_usr_baja) AND alm_cab_ing_egr_motivo='.$valor;
        //print_r($valor);
         //print_r($query);
        return $this->mysql->query($query);
    }
    /**
     * Metodo que devuelve total de los egresos de cabecera
     */
    public function totalEgresosDetalle($valor){
        $query = 'SELECT COUNT(*) AS total  FROM alm_ing_egr_cab WHERE  ISNULL(alm_cab_ing_egr_usr_baja) AND alm_cab_ing_egr_motivo='.$valor;
        //print_r($valor);
         //print_r($query);
        return $this->mysql->query($query);
    }
    
    /** Este es el metodo que permite **/
    public function getEgresoDetalleCabecera($codigo_unico_cab){
        $query = 'SELECT * FROM alm_ing_egr_cab WHERE alm_cab_ing_nro_unico="'.$codigo_unico_cab.'"';
        return $this->mysql->query($query);
    }

      /**
       * Metodo que buscar egresos
       */
      public function buscarEgresos($buscar_palabra){
        //echo ($start."-".$limit."-".$valor);

        $query = 'SELECT * 
                  FROM alm_ing_egr_cab cab INNER JOIN gral_agencia orig ON cab.alm_cab_ing_egr_origen=orig.GRAL_AGENCIA_CODIGO 
                  INNER JOIN gral_agencia dest ON cab.alm_cab_ing_egr_destino=dest.GRAL_AGENCIA_CODIGO 
                  WHERE (cab.alm_cab_ing_egr_nro_nota LIKE "%'.$buscar_palabra.'%" OR 
                  cab.alm_cab_ing_egr_nombre LIKE "%'.$buscar_palabra.'%" OR
                  orig.GRAL_AGENCIA_NOMBRE LIKE "%'.$buscar_palabra.'%" OR
                  dest.GRAL_AGENCIA_NOMBRE LIKE "%'.$buscar_palabra.'%") AND ISNULL(cab.alm_cab_ing_egr_usr_baja) AND ISNULL(orig.GRAL_AGENCIA_USR_BAJA) AND ISNULL(dest.GRAL_AGENCIA_USR_BAJA) AND cab.alm_cab_ing_egr_motivo=2
                  ORDER BY cab.alm_cab_ing_egr_nro_nota ASC';
        //print_r($query);
        return $this->mysql->query($query);
      }

      /*
       * Este es el metodo que devuelve los datos de una nota de egreso seleccionado desde la busqueda autocomplet
       */
      public function getDatosBusEgr($id_unico){
            $consulta  = 'SELECT * 
                          FROM alm_ing_egr_cab cab 
                          WHERE alm_cab_ing_nro_unico="'.$id_unico.'" AND alm_cab_ing_egr_motivo=2';
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
       * Metodo para buescar egresos desde el boton
       */
      public function buscarEgresosBoton($start, $limit, $buscar_palabra){
        //echo ($start."-".$limit."-".$valor);
        $query = 'SELECT *
                  FROM alm_ing_egr_cab cab INNER JOIN gral_agencia orig ON cab.alm_cab_ing_egr_origen=orig.GRAL_AGENCIA_CODIGO 
                  INNER JOIN gral_agencia dest ON cab.alm_cab_ing_egr_destino=dest.GRAL_AGENCIA_CODIGO 
                  WHERE (cab.alm_cab_ing_egr_nro_nota LIKE "%'.$buscar_palabra.'%" OR 
                  cab.alm_cab_ing_egr_nombre LIKE "%'.$buscar_palabra.'%" OR
                  orig.GRAL_AGENCIA_NOMBRE LIKE "%'.$buscar_palabra.'%" OR
                  dest.GRAL_AGENCIA_NOMBRE LIKE "%'.$buscar_palabra.'%") AND ISNULL(cab.alm_cab_ing_egr_usr_baja) AND ISNULL(orig.GRAL_AGENCIA_USR_BAJA) AND ISNULL(dest.GRAL_AGENCIA_USR_BAJA) AND cab.alm_cab_ing_egr_motivo=2
                  ORDER BY cab.alm_cab_ing_egr_nro_nota ASC
                  LIMIT '.$start.',10';
        //print_r($query);
        return $this->mysql->query($query);
      }

      
      
      /**
        * Metodo que devuelve total de los egresos desde el boton
        */
      public function totalEgresosBoton($buscar_palabra){
        //echo ($start."-".$limit."-".$valor);
        $query = 'SELECT COUNT(*) AS total  
                  FROM alm_ing_egr_cab cab INNER JOIN gral_agencia orig ON cab.alm_cab_ing_egr_origen=orig.GRAL_AGENCIA_CODIGO 
                  INNER JOIN gral_agencia dest ON cab.alm_cab_ing_egr_destino=dest.GRAL_AGENCIA_CODIGO 
                  WHERE (cab.alm_cab_ing_egr_nro_nota LIKE "%'.$buscar_palabra.'%" OR 
                  cab.alm_cab_ing_egr_nombre LIKE "%'.$buscar_palabra.'%" OR
                  orig.GRAL_AGENCIA_NOMBRE LIKE "%'.$buscar_palabra.'%" OR
                  dest.GRAL_AGENCIA_NOMBRE LIKE "%'.$buscar_palabra.'%") AND ISNULL(cab.alm_cab_ing_egr_usr_baja) AND ISNULL(orig.GRAL_AGENCIA_USR_BAJA) AND ISNULL(dest.GRAL_AGENCIA_USR_BAJA) AND cab.alm_cab_ing_egr_motivo=2
                  ORDER BY cab.alm_cab_ing_egr_nro_nota ASC';
                  //LIMIT '.$start.',10';
        //print_r($query);
        return $this->mysql->query($query);
      }

       /**
     * Metodo que permite eliminar un cliente
     */
    public function deleteEgreso($codigo){
      
        $condicion = "alm_cab_ing_nro_unico='".$codigo."'";

        $condicion1 = "alm_ing_egr_det_cod_unico_cab='".$codigo."'";
        //print_r($condicion);

        if($this->mysql->delete('alm_ing_egr_det', $condicion1)){
            //return true;
            if($this->mysql->delete('alm_ing_egr_cab', $condicion)){
              return true;
            }else{
              return false;
            }
        }else{
          return false;
        } 
    }

      /**
     * Metodo que permite eliminar un iten del ingreso
     */
   public function deleteItemEgresoDet($codigo){
      //print_r($codigo);
       $condicion = "alm_ing_egr_det_nro_unico='".$codigo."'";
      ///print_r($condicion);
      if($this->mysql->delete('alm_ing_egr_det', $condicion)){
          return true;
        }else{
          return false;
        }
      //print_r(json_encode($json_res));
    }

    /**
   * Metodo que devuelve la lista los datos para la modificacion
   * 
   */
    public function getDataEgresosCab($unico){
      //print_r("modelo");
    
      $query='SELECT * 
              FROM alm_ing_egr_cab 
              WHERE alm_cab_ing_nro_unico="'.$unico.'" and ISNULL(alm_cab_ing_egr_usr_baja)';
      //print_r($query);
      return $this->mysql->query($query);
  }

   /**
  * Metodo que guardas las modificaciones de ingresos de la cabecera
  *
  */
  public function saveEditEgresoCab($datos){

    $util = new Utilitarios();
    
   //print_r($datos);
     //$valores['alm_cab_ing_egr_id']= null;
     $valores['alm_cab_ing_nro_unico']=$datos['alm_unico_egre_edit'];
     $valores['alm_cab_ing_egr_nro_nota']=$datos['nro_nota_egr_edit'];
     $valores['alm_cab_ing_egr_cod']='89ui';
     $valores['alm_cab_ing_egr_nombre']=$datos['alm_nom_egre_edit'];
     $valores['alm_cab_ing_egr_fecha_ingreso']= $util->cambiaf_a_mysql($datos['alm_fec_egre_edit']);
     $valores['alm_cab_ing_egr_destino']=$datos['egr_origen'];
     $valores['alm_cab_ing_egr_destino']=$datos['egr_destino'];
     $valores['alm_cab_ing_egr_motivo']=$datos['alm_motivo_egre_edit_01'];
     $valores['alm_cab_ing_egr_usr_alta']=$_SESSION['login'];
     $valores['alm_cab_ing_egr_fech_alta']=  $util->cambiaf_a_mysql($_SESSION['fec_proc']);
     $condicion = "alm_cab_ing_nro_unico='".$datos['alm_unico_egre_edit']."'";

   //print_r($valores);
    //print_r($condicion);
    if ( $this->mysql->update('alm_ing_egr_cab', $valores, $condicion)){
       //return true;
        $json_res['completo'] = true;
        $json_res['unico'] = $valores['alm_cab_ing_nro_unico'];

     }else{
        //return false;
        $json_res['completo'] = true;
     }
     print_r(json_encode($json_res));
  
  }

   /**
   * Metodo que devuelve la lista los datos para la modificacion de los egresos
   * 
   */
    public function getDataEgresosDet($unico){
    
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

   /***
    **  Metodo que busca por palabara ingresada en producros
    *
    */
    public function listarBusquedaProductosEgreso($palabra){

             $consulta = 'SELECT * 
                          FROM alm_prod_cabecera 
                          WHERE ISNULL(alm_prod_cab_usr_baja) AND (alm_prod_cab_nombre LIKE "%'.$palabra.'%" OR 
                                                                   alm_prod_cab_codigo LIKE "%'.$palabra.'%" OR 
                                                                   alm_prod_cab_cod_ref LIKE "%'.$palabra.'%" OR
                                                                   alm_prod_cab_marca LIKE "%'.$palabra.'%" )';
        //print_r($consulta);
        return $this->mysql->query($consulta);


     }

      /*
     * Este es el metodo que graba el ingreso de almacenes    ***********************************************************************************
     * 
     */
    public function guardarNuevoDetalleEgreso($datos){

       
/*
        $cantidad = $datos['alm_det_cantidad_egr'];
        $datos_det = $this->getDatosRestaProductos($datos['cod_unico_producto_egr']);
        $cont = 0;
        foreach ($datos_det as $key => $value) {
          //print_r($value);
           //$cantidad_queda=$cantidad-$value['alm_prod_detalle']['alm_prod_det_cantidad']; 
           $condicion = 'alm_prod_det_cantidad_out="'.$value['alm_prod_detalle']['alm_prod_det_id_unico'].'"';
            if (($cantidad-$value['alm_prod_detalle']['alm_prod_det_cantidad'])>0) {
                $cant['alm_prod_det_cantidad_out'] = $cantidad-$value['alm_prod_detalle']['alm_prod_det_cantidad'];
                $this->mysql->update('alm_prod_detalle', $cant, $condicion);
                /* if ($this->mysql->update('alm_prod_detalle', $val, $condicion)) {
                // if ($this->mysql->update('alm_prod_detalle', $val['alm_prod_det_cantidad_out'], 'alm_prod_det_cantidad_out="'.$value['alm_prod_detalle']['alm_prod_det_id_unico'].'"')) {
                   print_r("grabo");
                 }else{
                    print_r("no grabo");
                 }
            }else{
                 $cant['alm_prod_det_cantidad_out']=0;
                 $this->mysql->update('alm_prod_detalle', $cant['alm_prod_det_cantidad_out'], $condicion);
            }  
        }
        
 */

      $util = new Utilitarios();
      $valores['alm_ing_egr_det_cod_unico_cab']=$datos['alm_det_unico_cab_egr'];
      $valores['alm_ing_egr_det_nro_unico']=$this->getCodigoUnicoegreso();
      $valores['alm_ing_egr_det_cod_int']=$datos['alm_det_cod_int_egr']; 
      $valores['alm_ing_egr_det_descripcion']=$datos['alm_det_desc_egr']; 
      $valores['alm_ing_egr_det_cod_unico_desc']=$datos['cod_unico_producto_egr'];    
      $valores['alm_ing_egr_det_referencia']=$datos['alm_det_ref_egr']; 
      $valores['alm_ing_egr_det_unidad']=$datos['alm_det_piezas_cod_egr']; 
      $valores['alm_ing_egr_det_cantidad']=$datos['alm_det_cantidad_egr'];
      $valores['alm_ing_egr_det_estado'] = 3;      
      $valores['alm_ing_egr_det_usr_alta']=$_SESSION['login'];
      $valores['alm_ing_egr_det_fech_alta']=$util->cambiaf_a_mysql($_SESSION['fec_proc']);
     
     // print_r($valores);

     if($this->mysql->insert('alm_ing_egr_det', $valores)){
          $json_res['completo'] = true;
          $json_res['cod_unico'] = $valores['alm_ing_egr_det_cod_unico_cab'];
          
      }else{
          $json_res['completo'] = false;
      }
      print_r(json_encode($json_res));
    
    }

    /*
     * Este es el metodo que graba el ingreso de almacenes
     * 
     */
    public function guardarModificarDetalleEgreso($datos){
       // print_r("llega...");
        //print_r($datos);
       $util = new Utilitarios();
      //$valores['alm_ing_egr_det_cod_unico_cab']=$datos['alm_det_unico_cab_egr_edit'];
      //$valores['alm_ing_egr_det_nro_unico']=$this->getCodigoUnicoegreso();
      $valores['alm_ing_egr_det_cod_int']=$datos['alm_det_cod_int_egr_edit']; 
      $valores['alm_ing_egr_det_descripcion']=$datos['alm_det_desc_egr_edit']; 
      $valores['alm_ing_egr_det_cod_unico_desc']=$datos['cod_unico_producto_egr_edit'];    
      $valores['alm_ing_egr_det_referencia']=$datos['alm_det_ref_egr_edit']; 
      $valores['alm_ing_egr_det_unidad']=$datos['alm_det_piezas_cod_egr_edit']; 
      $valores['alm_ing_egr_det_cantidad']=$datos['alm_det_cantidad_egr_edit'];      
      $valores['alm_ing_egr_det_usr_alta']=$_SESSION['login'];
      $valores['alm_ing_egr_det_fech_alta']=$util->cambiaf_a_mysql($_SESSION['fec_proc']);
      $condicion = "alm_ing_egr_det_nro_unico='".$datos['alm_det_cod_det_unico_edit']."'";
    if ( $this->mysql->update('alm_ing_egr_det', $valores, $condicion)){
       //return true;
        $json_res['completo'] = true;
        $json_res['unico'] = $datos['alm_det_cod_det_unico_cab_edit'];

     }else{
        //return false;
        $json_res['completo'] = true;
     }
     print_r(json_encode($json_res));

      /**/
    }
    /** Este es el metodo que confirma la orden de Egreso **/
    public function confirmarOrdenEgreso($datos){

      $query = 'SELECT * FROM alm_prod_detalle WHERE alm_prod_cab_codigo="'.$datos['codigo_prod'].'"';
      $producto = $this->mysql->query($query);
      foreach ($producto as $key => $value) {
          if ($value['alm_prod_detalle']['alm_prod_det_cantidad']==$value['alm_prod_detalle']['alm_prod_det_cantidad_out']) {
          }else{
              $existente = $value['alm_prod_detalle']['alm_prod_det_cantidad_out'];
              $condicion = 'alm_prod_det_id_unico="'.$value['alm_prod_detalle']['alm_prod_det_id_unico'].'"';
      
              if (($datos['cantidad_prod']>$value['alm_prod_detalle']['alm_prod_det_cantidad'])) {
                  $val['alm_prod_det_cantidad_out'] = $value['alm_prod_detalle']['alm_prod_det_cantidad'];
                  $datos['cantidad_prod'] = ($datos['cantidad_prod']-$value['alm_prod_detalle']['alm_prod_det_cantidad']);
                  if($this->mysql->update('alm_prod_detalle', $val, $condicion)){
                        $valu['alm_ing_egr_det_estado'] = 4;

                         $cond = 'alm_ing_egr_det_nro_unico="'.$datos['num_unico_det'].'"';
                        if($this->mysql->update('alm_ing_egr_det', $valu, $cond)){
                          $query = 'SELECT * FROM alm_ing_egr_det WHERE alm_ing_egr_det_nro_unico="'.$datos['num_unico_det'].'"';
                          $detalle = $this->mysql->query($query);
                          $v['alm_cab_ing_egr_motivo_registro'] = 4;
                          $cond = 'alm_cab_ing_nro_unico="'.$detalle[0]['alm_ing_egr_det']['alm_ing_egr_det_cod_unico_cab'].'"';
                          
                          if($this->mysql->update('alm_ing_egr_cab',$v, $cond)){
                            $res = true;  
                          }else{
                            $res = false;
                          }
                        }
                    }else{
                         $res = false;
                    }

              }elseif (($datos['cantidad_prod'] == $value['alm_prod_detalle']['alm_prod_det_cantidad'])) {
                  $val['alm_prod_det_cantidad_out'] = $value['alm_prod_detalle']['alm_prod_det_cantidad'];
                   $datos['cantidad_prod'] = ($datos['cantidad_prod']-$value['alm_prod_detalle']['alm_prod_det_cantidad']);
                  if($this->mysql->update('alm_prod_detalle', $val, $condicion)){
                      $valu['alm_ing_egr_det_estado'] = 4;

                        $cond = 'alm_ing_egr_det_nro_unico="'.$datos['num_unico_det'].'"';
                        if($this->mysql->update('alm_ing_egr_det', $valu, $cond)){
                          $query = 'SELECT * FROM alm_ing_egr_det WHERE alm_ing_egr_det_nro_unico="'.$datos['num_unico_det'].'"';
                          $detalle = $this->mysql->query($query);
                          $v['alm_cab_ing_egr_motivo_registro'] = 4;
                          $cond = 'alm_cab_ing_nro_unico="'.$detalle[0]['alm_ing_egr_det']['alm_ing_egr_det_cod_unico_cab'].'"';
                          
                          if($this->mysql->update('alm_ing_egr_cab',$v, $cond)){
                            $res = true;  
                          }else{
                            $res = false;
                          }
                        }
                    }else{
                       $res = false;
                    }

              }elseif(($datos['cantidad_prod'] < $value['alm_prod_detalle']['alm_prod_det_cantidad']) && ($datos['cantidad_prod'] > 0)){
                
                  $val['alm_prod_det_cantidad_out'] = $datos['cantidad_prod'] + $existente;
                   $datos['cantidad_prod'] = ($datos['cantidad_prod']-$value['alm_prod_detalle']['alm_prod_det_cantidad']);
                  if($this->mysql->update('alm_prod_detalle', $val, $condicion)){
                      $valu['alm_ing_egr_det_estado'] = 4;
                          $cond = 'alm_ing_egr_det_nro_unico="'.$datos['num_unico_det'].'"';
                        if($this->mysql->update('alm_ing_egr_det', $valu, $cond)){
                          $query = 'SELECT * FROM alm_ing_egr_det WHERE alm_ing_egr_det_nro_unico="'.$datos['num_unico_det'].'"';
                          $detalle = $this->mysql->query($query);
                          $v['alm_cab_ing_egr_motivo_registro'] = 4;
                          $cond = 'alm_cab_ing_nro_unico="'.$detalle[0]['alm_ing_egr_det']['alm_ing_egr_det_cod_unico_cab'].'"';
                          
                          if($this->mysql->update('alm_ing_egr_cab',$v, $cond)){
                            $res = true;  
                          }else{
                            $res = false;
                          }
                        }
                    }else{
                         $res = false;
                    }
              }else{
                    $val['alm_prod_det_cantidad_out'] <= 0;
                    $datos['cantidad_prod'] = ($datos['cantidad_prod']-$value['alm_prod_detalle']['alm_prod_det_cantidad']);
                    $val['alm_prod_det_cantidad_out'] = 0;
                    if($this->mysql->update('alm_prod_detalle', $val, $condicion)){
                      //$value['alm_ing_egr_det_estado'] = 4;
                    }else{
                         $res = false;
                    } 
              }
         }
      }
     return $res;
  }


     /*
     * Este es el metodo que graba el ingreso de almacenes
     * 
     */
    public function procesarNotaSalida($codigo){
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

     /***
     * Metodo que busca la cantidad para que no ingrese cantidades queno son reales
     *
     */
     public function buscaCantidadEgreso($codigo){
          $query = 'SELECT alm_prod_cab_cantidad_stock FROM alm_prod_cabecera WHERE alm_prod_cab_id_unico_prod="'.$codigo.'"';
          return $this->mysql->query($query);
     }
     /** Est es el metodo q optiene los datos por */
    public function getDatosProductoDetalle($datos){
      $query = 'SELECT *
                FROM alm_prod_cabecera AS apc INNER JOIN alm_prod_detalle AS apd  ON apc.alm_prod_cab_id_unico_prod = apd.alm_prod_cab_codigo 
                WHERE apc.alm_prod_cab_id_unico_prod = "'.$datos['id_producto'].'" AND apd.alm_prod_cab_codigo="'.$datos['id_producto'].'" AND ISNULL(apc.alm_prod_cab_usr_baja) 
                      AND ISNULL(apd.alm_prod_det_usr_baja) 
                GROUP BY apd.alm_prod_det_id_unico 
                ORDER BY alm_prod_cab_fec_ing';
      return $this->mysql->query($query);
    }

    /** Est es el metodo q optiene lla cantidad total del producto */
    public function cantidadTotalProducto($datos){
      $query = 'SELECT /*SUM(apd.alm_prod_det_cantidad) as cantidad*/
                        (SUM(apd.alm_prod_det_cantidad) - (case when  ISNULL(SUM(apd.alm_prod_det_cantidad_out)) then 0 else SUM(apd.alm_prod_det_cantidad_out) end)) as cantidad
                FROM alm_prod_cabecera AS apc INNER JOIN alm_prod_detalle AS apd  ON apc.alm_prod_cab_id_unico_prod = apd.alm_prod_cab_codigo 
                WHERE apc.alm_prod_cab_id_unico_prod = "'.$datos['id_producto'].'" AND apd.alm_prod_cab_codigo="'.$datos['id_producto'].'" AND ISNULL(apc.alm_prod_cab_usr_baja) 
                      AND ISNULL(apd.alm_prod_det_usr_baja)';
      return $this->mysql->query($query);
    }

     /** Est es el metodo q optiene los datos para poder ir restando a cada linea */
    public function getDatosRestaProductos($dato){
      $query = 'SELECT *
                FROM alm_prod_detalle 
                WHERE alm_prod_cab_codigo="'.$dato.'" and ISNULL(alm_prod_det_usr_baja)';
      return $this->mysql->query($query);
    }


}
?>