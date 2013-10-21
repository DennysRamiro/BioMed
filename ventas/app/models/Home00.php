<?php
require_once '../lib/Mysql.php';
require_once '../importaciones/clases/Utilitarios.php';
/**
 * Description of HomeModel
 *
 * @author Daniel Fernandez
 */
class Home {
    private $mysql;
    /*
     * Este es el constructo de del modelo HomeModel
     */
    public function __construct() {
        $this->mysql = new Mysql();
    }

      /**
     * Metodo que lista Cotizacion
     */
    public function listaCotizacionPriv($start, $limit, $op){
      $query = 'SELECT * 
                FROM vent_prof_cab 
                WHERE ISNULL(vent_prof_cab_usr_baja) AND vent_prof_cab_tipo_cot=1 AND vent_prof_cab_cod_operador="'.$op.'"
                ORDER BY vent_prof_cab_cod_prof
                LIMIT '.$start.',10';
      //print_r($query);
      return $this->mysql->query($query);
    }

       /**
     * Metodo que lista Cotizacion
     */
    public function listaCotizacionPubl($start, $limit, $op){
      $query = 'SELECT * 
                FROM vent_prof_cab 
                WHERE ISNULL(vent_prof_cab_usr_baja) AND vent_prof_cab_tipo_cot=0 AND vent_prof_cab_cod_operador="'.$op.'"
                ORDER BY vent_prof_cab_cod_prof
                LIMIT '.$start.',10';
      //print_r($query);
      return $this->mysql->query($query);
    }

     /**
     * Metodo que devuelve total Cot
     */
    public function totalCotPubl($op){
        $query = 'SELECT COUNT(*) AS total 
                  FROM vent_prof_cab 
                  WHERE ISNULL(vent_prof_cab_usr_baja) AND vent_prof_cab_tipo_cot=0 AND vent_prof_cab_cod_operador="'.$op.'"' ;
        return $this->mysql->query($query);
    }


    /**
     * Metodo que devuelve total Cot
     */
    public function totalCotPriv($op){
        $query = 'SELECT COUNT(*) AS total 
                  FROM vent_prof_cab 
                  WHERE ISNULL(vent_prof_cab_usr_baja) AND vent_prof_cab_tipo_cot=1 AND vent_prof_cab_cod_operador="'.$op.'"';
        return $this->mysql->query($query);
    }

    /**
     * Metodo que devuelve el total de las cot priv en una busqueda 
     */
    public function totalCotPrivBus($buscar_palabra,$op){
        $query = 'SELECT COUNT(c.vent_prof_cab_cod_unico) AS total 
                FROM vent_prof_cab c INNER JOIN vent_cliente v ON c.vent_prof_cab_cod_cliente=v.vent_cli_cod_unico
                INNER JOIN vent_operador o ON c.vent_prof_cab_cod_operador=o.vent_op_cod_unico
                WHERE (c.vent_prof_cab_cod_prof LIKE "%'.$buscar_palabra.'%"  
                                      OR v.vent_cli_nombre LIKE "%'.$buscar_palabra.'%" 
                                      OR v.vent_cli_apellido_pat LIKE "%'.$buscar_palabra.'%"  
                                      OR v.vent_cli_apellido_mat LIKE "%'.$buscar_palabra.'%" 
                                      OR o.vent_op_nombres LIKE "%'.$buscar_palabra.'%" 
                                      OR o.vent_op_ap_paterno LIKE "%'.$buscar_palabra.'%" 
                                      OR o.vent_op_ap_materno LIKE "%'.$buscar_palabra.'%" ) AND ISNULL(c.vent_prof_cab_usr_baja) AND ISNULL(v.vent_cli_usr_baja) AND c.vent_prof_cab_tipo_cot=1 AND vent_prof_cab_cod_operador="'.$op.'"';

      return $this->mysql->query($query);

    }

        /**
     * Metodo que devuelve el total de las cot publ en una busqueda 
     */
    public function totalCotPublBus($buscar_palabra,$op){
        $query = 'SELECT COUNT(c.vent_prof_cab_cod_unico) AS total 
                FROM vent_prof_cab c INNER JOIN vent_cliente v ON c.vent_prof_cab_cod_cliente=v.vent_cli_cod_unico
                INNER JOIN vent_operador o ON c.vent_prof_cab_cod_operador=o.vent_op_cod_unico
                WHERE (c.vent_prof_cab_cod_prof LIKE "%'.$buscar_palabra.'%"  
                                      OR v.vent_cli_nombre LIKE "%'.$buscar_palabra.'%" 
                                      OR v.vent_cli_apellido_pat LIKE "%'.$buscar_palabra.'%"  
                                      OR v.vent_cli_apellido_mat LIKE "%'.$buscar_palabra.'%" 
                                      OR o.vent_op_nombres LIKE "%'.$buscar_palabra.'%" 
                                      OR o.vent_op_ap_paterno LIKE "%'.$buscar_palabra.'%" 
                                      OR o.vent_op_ap_materno LIKE "%'.$buscar_palabra.'%" ) AND ISNULL(c.vent_prof_cab_usr_baja) AND ISNULL(v.vent_cli_usr_baja) AND c.vent_prof_cab_tipo_cot=0 AND vent_prof_cab_cod_operador="'.$op.'"';

      return $this->mysql->query($query);

    }

     /**
     * Metodo que busca la palabra en la tabla de cotizaciones privadas
     */
    public function buscarCotizacionPrivBoton($buscar_palabra,$start, $limit,$op){
      $query = 'SELECT *,COUNT(c.vent_prof_cab_cod_unico) AS total 
                FROM vent_prof_cab c INNER JOIN vent_cliente v ON c.vent_prof_cab_cod_cliente=v.vent_cli_cod_unico
                INNER JOIN vent_operador o ON c.vent_prof_cab_cod_operador=o.vent_op_cod_unico
                WHERE (c.vent_prof_cab_cod_prof LIKE "%'.$buscar_palabra.'%" 
                                      OR v.vent_cli_nombre LIKE "%'.$buscar_palabra.'%"
                                      OR v.vent_cli_apellido_pat LIKE "%'.$buscar_palabra.'%" 
                                      OR v.vent_cli_apellido_mat LIKE "%'.$buscar_palabra.'%"
                                      OR o.vent_op_nombres LIKE "%'.$buscar_palabra.'%"
                                      OR o.vent_op_ap_paterno LIKE "%'.$buscar_palabra.'%"
                                      OR o.vent_op_ap_materno LIKE "%'.$buscar_palabra.'%") AND ISNULL(c.vent_prof_cab_usr_baja) AND ISNULL(v.vent_cli_usr_baja) AND c.vent_prof_cab_tipo_cot=1 AND vent_prof_cab_cod_operador="'.$op.'"
                GROUP BY c.vent_prof_cab_cod_unico
                LIMIT '.$start.',10';
      //print_r($query);
      return $this->mysql->query($query);
    }

      /**
     * Metodo que busca la palabra en la tabla de cotizaciones publicas
     */
    public function buscarCotizacionPublBoton($buscar_palabra,$start, $limit,$op){
      $query = 'SELECT *,COUNT(c.vent_prof_cab_cod_unico) AS total 
                FROM vent_prof_cab c INNER JOIN vent_cliente v ON c.vent_prof_cab_cod_cliente=v.vent_cli_cod_unico
                INNER JOIN vent_operador o ON c.vent_prof_cab_cod_operador=o.vent_op_cod_unico
                WHERE (c.vent_prof_cab_cod_prof LIKE "%'.$buscar_palabra.'%" 
                                      OR v.vent_cli_nombre LIKE "%'.$buscar_palabra.'%"
                                      OR v.vent_cli_apellido_pat LIKE "%'.$buscar_palabra.'%" 
                                      OR v.vent_cli_apellido_mat LIKE "%'.$buscar_palabra.'%"
                                      OR o.vent_op_nombres LIKE "%'.$buscar_palabra.'%"
                                      OR o.vent_op_ap_paterno LIKE "%'.$buscar_palabra.'%"
                                      OR o.vent_op_ap_materno LIKE "%'.$buscar_palabra.'%") AND ISNULL(c.vent_prof_cab_usr_baja) AND ISNULL(v.vent_cli_usr_baja) AND c.vent_prof_cab_tipo_cot=0 AND vent_prof_cab_cod_operador="'.$op.'"
                GROUP BY c.vent_prof_cab_cod_unico
                LIMIT '.$start.',10';
      //print_r($query);
      return $this->mysql->query($query);
    }

    /**
     * Metodo que busca la palabra en la tabla de cotizaciones privadas
     */
    public function buscarCotizacionPriv($buscar_palabra,$op){
      $query = 'SELECT *,COUNT(c.vent_prof_cab_cod_unico) AS total 
                FROM vent_prof_cab c INNER JOIN vent_cliente v ON c.vent_prof_cab_cod_cliente=v.vent_cli_cod_unico
                INNER JOIN vent_operador o ON c.vent_prof_cab_cod_operador=o.vent_op_cod_unico
                WHERE (c.vent_prof_cab_cod_prof LIKE "%'.$buscar_palabra.'%" 
                                      OR v.vent_cli_nombre LIKE "%'.$buscar_palabra.'%"
                                      OR v.vent_cli_apellido_pat LIKE "%'.$buscar_palabra.'%" 
                                      OR v.vent_cli_apellido_mat LIKE "%'.$buscar_palabra.'%"
                                      OR o.vent_op_nombres LIKE "%'.$buscar_palabra.'%"
                                      OR o.vent_op_ap_paterno LIKE "%'.$buscar_palabra.'%"
                                      OR o.vent_op_ap_materno LIKE "%'.$buscar_palabra.'%") AND ISNULL(c.vent_prof_cab_usr_baja) AND ISNULL(v.vent_cli_usr_baja) AND c.vent_prof_cab_tipo_cot=1 AND vent_prof_cab_cod_operador="'.$op.'"
                GROUP BY c.vent_prof_cab_cod_unico';
      //print_r($query);
      return $this->mysql->query($query);
    }

    /**
     * Metodo que busca la palabra en la tabla de cotizaciones publicas
     */
    public function buscarCotizacionPubl($buscar_palabra,$op){
      $query = 'SELECT *,COUNT(c.vent_prof_cab_cod_unico) AS total 
                FROM vent_prof_cab c INNER JOIN vent_cliente v ON c.vent_prof_cab_cod_cliente=v.vent_cli_cod_unico
                INNER JOIN vent_operador o ON c.vent_prof_cab_cod_operador=o.vent_op_cod_unico
                WHERE (c.vent_prof_cab_cod_prof LIKE "%'.$buscar_palabra.'%" 
                                      OR v.vent_cli_nombre LIKE "%'.$buscar_palabra.'%"
                                      OR v.vent_cli_apellido_pat LIKE "%'.$buscar_palabra.'%" 
                                      OR v.vent_cli_apellido_mat LIKE "%'.$buscar_palabra.'%"
                                      OR o.vent_op_nombres LIKE "%'.$buscar_palabra.'%"
                                      OR o.vent_op_ap_paterno LIKE "%'.$buscar_palabra.'%"
                                      OR o.vent_op_ap_materno LIKE "%'.$buscar_palabra.'%") AND ISNULL(c.vent_prof_cab_usr_baja) AND ISNULL(v.vent_cli_usr_baja) AND c.vent_prof_cab_tipo_cot=0 AND vent_prof_cab_cod_operador="'.$op.'"
                GROUP BY c.vent_prof_cab_cod_unico';
      //print_r($query);
      return $this->mysql->query($query);
    }
    
    /*
     * Este es el metodo que devuelve los datos de la busqueda cot priv
     * 
     */
    public function getDatosBusCotPriv($id_unico){
      $consulta  = 'SELECT * 
                    FROM vent_prof_cab 
                    WHERE ISNULL(vent_prof_cab_usr_baja) AND vent_prof_cab_tipo_cot=1 AND vent_prof_cab_cod_unico="'.$id_unico.'"';
        return $this->mysql->query($consulta);
    }

     /*
     * Este es el metodo que devuelve los datos de la busqueda cot publ
     * 
     */
    public function getDatosBusCotPubl($id_unico){
      $consulta  = 'SELECT * 
                    FROM vent_prof_cab 
                    WHERE ISNULL(vent_prof_cab_usr_baja) AND vent_prof_cab_tipo_cot=0 AND vent_prof_cab_cod_unico="'.$id_unico.'"';
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
     * Este es el metodo que devuelve los datos de tipo de compra de la cotizacion
     * 
     */
    public function getTipoCompra(){
        $consulta  = "SELECT GRAL_PAR_PRO_COD,GRAL_PAR_PRO_DESC 
                      FROM gral_param_propios 
                      WHERE GRAL_PAR_PRO_GRP=2000 AND GRAL_PAR_PRO_COD <>0";
        return $this->mysql->query($consulta);
    }

     /*
     * Este es el metodo que devuelve el nombre de tipo de compra de la cotizacion
     * 
     */
    public function getNomTipoCompra($id){
        $consulta  = 'SELECT GRAL_PAR_PRO_COD,GRAL_PAR_PRO_DESC 
                      FROM gral_param_propios 
                      WHERE GRAL_PAR_PRO_GRP=2000 AND GRAL_PAR_PRO_COD='.$id.'';
        return $this->mysql->query($consulta);
    }

    /*
     * Este es el metodo que devuelve los datos de forma de pago de la cotizacion
     * 
     */
    public function getFormaPago(){
        $consulta  = "SELECT GRAL_PAR_PRO_COD,GRAL_PAR_PRO_DESC 
                      FROM gral_param_propios 
                      WHERE GRAL_PAR_PRO_GRP=2100 AND GRAL_PAR_PRO_COD <>0";
        return $this->mysql->query($consulta);
    }

       /*
     * Este es el metodo que devuelve el nombre de forma de pago de la cotizacion
     * 
     */
    public function getNomFormaPago($id){
        $consulta  = 'SELECT GRAL_PAR_PRO_COD,GRAL_PAR_PRO_DESC 
                      FROM gral_param_propios 
                      WHERE GRAL_PAR_PRO_GRP=2100 AND GRAL_PAR_PRO_COD='.$id.'';
        return $this->mysql->query($consulta);
    }


    /*
     * Este es el metodo que devuelve los datos de estado del producto de la cotizacion
     * 
     */
    public function getEstadoProd(){
        $consulta  = "SELECT GRAL_PAR_PRO_COD,GRAL_PAR_PRO_DESC 
                      FROM gral_param_propios 
                      WHERE GRAL_PAR_PRO_GRP=2200 AND GRAL_PAR_PRO_COD <>0";
        return $this->mysql->query($consulta);
    }

       /*
     * Este es el metodo que devuelve el nombre de tipo de producto de la cotizacion
     * 
     */
    public function getNomTipoProd($id){
        $consulta  = 'SELECT GRAL_PAR_PRO_COD,GRAL_PAR_PRO_DESC 
                      FROM gral_param_propios 
                      WHERE GRAL_PAR_PRO_GRP=1000 AND GRAL_PAR_PRO_COD='.$id.'';
        //print_r($consulta);
        return $this->mysql->query($consulta);
    }

           /*
     * Este es el metodo que devuelve los datos de un determinado producto de la cotizacion
     * 
     */
    public function getDatosProd($id_unico){
        $consulta  = 'SELECT * 
                      FROM alm_prod_detalle AS vent_prof_det, alm_prod_cabecera AS apc 
                      WHERE vent_prof_det.alm_prod_cab_codigo = apc.alm_prod_cab_id_unico_prod AND vent_prof_det.alm_prod_det_id_unico="'.$id_unico.'"';
       // print_r($consulta);
        return $this->mysql->query($consulta);
    }

     /*
     * Este es el metodo que devuelve los datos de tipo del producto de la cotizacion
     * 
     */
    public function getTipoProd(){
        $consulta  = "SELECT GRAL_PAR_PRO_COD,GRAL_PAR_PRO_DESC 
                      FROM gral_param_propios 
                      WHERE GRAL_PAR_PRO_GRP=2300 AND GRAL_PAR_PRO_COD <>0";
        return $this->mysql->query($consulta);
    }

    /*
     * Este es el metodo que devuelve los datos de Servicios Necesarios del Producto de la cotizacion
     * 
     */
    public function getServiciosNec(){
        $consulta  = "SELECT GRAL_PAR_PRO_COD,GRAL_PAR_PRO_DESC, GRAL_PAR_PRO_CTA1 
                      FROM gral_param_propios 
                      WHERE GRAL_PAR_PRO_GRP=2400 AND GRAL_PAR_PRO_COD <>0";
        return $this->mysql->query($consulta);
    }

         /*
     * Este es el metodo que devuelve el nombre de servicios necesarios de la cotizacion
     * 
     */
    public function getNomSerNec($id){
        $consulta  = 'SELECT GRAL_PAR_PRO_COD,GRAL_PAR_PRO_DESC 
                      FROM gral_param_propios 
                      WHERE GRAL_PAR_PRO_GRP=2400 AND GRAL_PAR_PRO_COD='.$id.'';
        return $this->mysql->query($consulta);
    }

    /*
     * Este es el metodo que devuelve los nombres del operador de la cotizacion
     * 
     */
    public function getNombreOp($id_op){
        $consulta  = 'SELECT vent_op_agencia_cod,vent_op_nombres,vent_op_ap_paterno,vent_op_ap_materno 
                      FROM vent_operador 
                      WHERE ISNULL(vent_op_usr_baja) AND vent_op_cod_unico="'.$id_op.'"';
        return $this->mysql->query($consulta);
    }

        /*
     * Este es el metodo que devuelve el cod unico  del operador de la cotizacion
     * 
     */
    public function getCodUniOp($login){
      //print_r("expression");
        $consulta  = 'SELECT vent_op_cod_unico
                      FROM vent_operador 
                      WHERE ISNULL(vent_op_usr_baja) AND vent_op_login="'.$login.'"';
                      //print_r($consulta);
        return $this->mysql->query($consulta);
    }

     /*
     * Este es el metodo que devuelve la region del operador de la cotizacion
     * 
     */
    public function getRegionOp($id_region){
        $consulta  = 'SELECT GRAL_AGENCIA_SIGLA 
                      FROM gral_agencia 
                      WHERE GRAL_AGENCIA_USR_BAJA is null AND GRAL_AGENCIA_CODIGO='.$id_region.'';
        return $this->mysql->query($consulta);
    }

     /*
     * Este es el metodo que devuelve los datos de cliente buscados en la cotizacion
     * 
     */

    public function listarBusquedaClientes($buscar){
        $consulta = 'SELECT * 
                     FROM vent_cliente
                     WHERE ISNULL(vent_cli_usr_baja) AND (vent_cli_nombre like "%'.$buscar.'%" 
                                            OR vent_cli_apellido_pat like "%'.$buscar.'%" 
                                            OR vent_cli_apellido_mat like "%'.$buscar.'%")';
        return $this->mysql->query($consulta);

    }


    /*
     * Este es el metodo que devuelve los datos de la cabecera para grabar detalle cot priv
     * 
     */
    public function getCabeceraPriv($id_prof){
        $consulta  = 'SELECT *
                      FROM vent_prof_cab 
                      WHERE ISNULL(vent_prof_cab_usr_baja) AND vent_prof_cab_cod_unico="'.$id_prof.'"';
        return $this->mysql->query($consulta);
    }

     /*
     * Este es el metodo que devuelve los datos del detalle de la cot priv
     * 
     */
    public function getDetallePriv($id_prof){
        $consulta  = 'SELECT *,(CASE WHEN vent_prof_det_catalogo_prod IS NULL THEN "No existe" ELSE vent_prof_det_catalogo_prod END)AS catalogo,
                      (CASE WHEN vent_prof_det_esp_tecn IS NULL THEN "No existe" ELSE vent_prof_det_esp_tecn END)AS especif,
                      (CASE WHEN vent_prof_det_conf_des IS NULL THEN "No existe" ELSE vent_prof_det_conf_des END)AS conf,
                      (CASE WHEN vent_prof_det_acces IS NULL THEN "No existe" ELSE vent_prof_det_acces END)AS acces
                      FROM vent_prof_det 
                      WHERE ISNULL(vent_prof_det_usr_baja) AND vent_prof_cab_cod_unico="'.$id_prof.'"';
        return $this->mysql->query($consulta);
    }

    /*
     *Este metodo devolver los datos del operador de acuerdo en la sesion
     *
     */
    public function getDatosOpe($login){
        $consulta = 'SELECT * 
                     FROM vent_operador 
                     WHERE ISNULL(vent_op_usr_baja) AND vent_op_login="'.$login.'"';
         return $this->mysql->query($consulta);
    }

    /*
     *Este metodo devolver los datos del operador de acuerdo en la sesion
     *
     */
    public function getDatosOpe2($cod_unico){
        $consulta = 'SELECT * 
                     FROM vent_operador 
                     WHERE ISNULL(vent_op_usr_baja) AND vent_op_cod_unico="'.$cod_unico.'"';
         return $this->mysql->query($consulta);
    }

    /*
     *Este metodo devuelve los datos de la cotizacion para realizar modificaciones
     *
     */
    public function getDatosCot($id_unico){
        $consulta = 'SELECT *
                     FROM vent_prof_cab 
                     WHERE ISNULL(vent_prof_cab_usr_baja) AND vent_prof_cab_cod_unico="'.$id_unico.'"';
         return $this->mysql->query($consulta);
    }

     /**
     * Metodo que guarda los datos la cabecera de la cotizacion
     */
    public function guardarCotizacionesPriv($datos){
        //echo("consulta");
      $util = new Utilitarios();
      //$valores['vent_prof_cab_id']=NULL;
      $login=$_SESSION['login'];
      $cod_unico_op=$this->getDatosOpe($login);
      $valores['vent_prof_cab_cod_unico']=$this->getCodigoUnicoCotizacionPriv();
      $valores['vent_prof_cab_cod_prof']=$this->getCodigoCotizacionPriv('CPR', 6);
      $valores['vent_prof_cab_cod_cliente']=$datos['cod_unico_cliente'];     
      $valores['vent_prof_cab_cod_operador']=$cod_unico_op[0]['vent_operador']['vent_op_cod_unico'];
      $valores['vent_prof_cab_tipo_cot']=1;     
      //$valores['vent_prof_cab_tipo_compra']=$datos['tipo_compra'];
      $valores['vent_prof_cab_forma_pago']=$datos['forma_pago'];
      $valores['vent_prof_cab_fech_cot']=$util->cambiaf_a_mysql($datos['txt_vent_fch_inc_proforma']);
      //$valores['vent_prof_cab_nom_cot']=$datos['txt_vent_nombre_proforma'];
      $valores['vent_prof_cab_fech_entrega_cot']=$util->cambiaf_a_mysql($datos['txt_vent_fch_entr_proforma']);
      $valores['vent_prof_cab_nom_cotizado']=$datos['txt_vent_cotizador_proforma'];
      $valores['vent_prof_cab_usr_alta']=$_SESSION['login'];
      $valores['vent_prof_cab_fech_hr_alta']=$util->cambiaf_a_mysql($_SESSION['fec_proc']);

      if($this->mysql->insert('vent_prof_cab', $valores)){
          $json_res['completo'] = true;
          $json_res['id_prof'] = $valores['vent_prof_cab_cod_unico'];
      }else{
          $json_res['completo'] = false;
      }
      print_r(json_encode($json_res));

      
      //return $this->mysql->insert('vent_prof_cab', $valores);

      //echo("cod".$valores['vent_prof_cab_cod_operador']);

    }

        /**
     * Metodo que guarda los datos la cabecera de la cotizacion
     */
    public function guardarCotizacionesPubl($datos){
        //echo("consulta");
      $util = new Utilitarios();
      //$valores['vent_prof_cab_id']=NULL;
      $login=$_SESSION['login'];
      $cod_unico_op=$this->getDatosOpe($login);
      $valores['vent_prof_cab_cod_unico']=$this->getCodigoUnicoCotizacionPubl();
      $valores['vent_prof_cab_cod_prof']=$this->getCodigoCotizacionPubl('CPU', 6);
      $valores['vent_prof_cab_cod_cliente']=$datos['cod_unico_cliente_publ'];     
      $valores['vent_prof_cab_cod_operador']=$cod_unico_op[0]['vent_operador']['vent_op_cod_unico'];
      $valores['vent_prof_cab_tipo_cot']=0;     
      $valores['vent_prof_cab_tipo_compra']=$datos['tipo_compra'];
      $valores['vent_prof_cab_forma_pago']=$datos['forma_pago'];
      $valores['vent_prof_cab_fech_cot']=$util->cambiaf_a_mysql($datos['txt_vent_fch_inc_proforma_publ']);
      //$valores['vent_prof_cab_nom_cot']=$datos['txt_vent_nombre_proforma'];
      $valores['vent_prof_cab_fech_entrega_cot']=$util->cambiaf_a_mysql($datos['txt_vent_fch_entr_proforma_publ']);
      $valores['vent_prof_cab_nom_cotizado']=$datos['txt_vent_cotizador_proforma_publ'];
      $valores['vent_prof_cab_usr_alta']=$_SESSION['login'];
      $valores['vent_prof_cab_fech_hr_alta']=$util->cambiaf_a_mysql($_SESSION['fec_proc']);

      if($this->mysql->insert('vent_prof_cab', $valores)){
          $json_res['completo'] = true;
          $json_res['id_prof'] = $valores['vent_prof_cab_cod_unico'];
      }else{
          $json_res['completo'] = false;
      }
      print_r(json_encode($json_res));

      
      //return $this->mysql->insert('vent_prof_cab', $valores);

      //echo("cod".$valores['vent_prof_cab_cod_operador']);

    }

    /**
     *Metodo que modifica los datos de la cabecera de la cotizacion priv
     */
    public function modificarCotizacionesPriv($datos){
     // echo("php".$datos);
      $util = new Utilitarios();
      date_default_timezone_set('America/La_Paz');
      $fecha_actual  = date("y-m-d H:i:s");
      $valores['vent_prof_cab_usr_baja'] = $_SESSION['login'];
      $valores['vent_prof_cab_fech_hr_baja'] = $fecha_actual;
      $id_unico=$datos['cod_unico_cot_det'];
      $condicion = "vent_prof_cab_cod_unico='".$id_unico."'";
      $this->mysql->update('vent_prof_cab', $valores, $condicion);

          $login=$_SESSION['login']; 
          $valor['vent_prof_cab_cod_unico']=$datos['cod_unico_cot_det'];
          $valor['vent_prof_cab_cod_prof']=$datos['cod_cot_det']; 
          $valor['vent_prof_cab_cod_cliente']=$datos['cod_unico_cliente_det'];     
          $valor['vent_prof_cab_cod_operador']=$datos['cod_unico_op_det']; 
          $valor['vent_prof_cab_tipo_cot']=1;     
          //$valor['vent_prof_cab_tipo_compra']=$datos['tipo_compra_det'];
          $valor['vent_prof_cab_forma_pago']=$datos['forma_pago_det'];
          $valor['vent_prof_cab_fech_cot']=$util->cambiaf_a_mysql($datos['txt_vent_fch_inc_proforma_det']);
          $valor['vent_prof_cab_fech_entrega_cot']=$util->cambiaf_a_mysql($datos['txt_vent_fch_entr_proforma_det']);
          $valor['vent_prof_cab_nom_cotizado']=$datos['txt_vent_cotizador_proforma_det'];
          $valor['vent_prof_cab_usr_alta']=$_SESSION['login'];
          $valor['vent_prof_cab_fech_hr_alta']=$util->cambiaf_a_mysql($_SESSION['fec_proc']);

          if($this->mysql->insert('vent_prof_cab', $valor)){
              $json_res['completo'] = true;
              $json_res['id_prof'] = $valor['vent_prof_cab_cod_unico'];
          }else{
              $json_res['completo'] = false;
          }
          print_r(json_encode($json_res));
    }

       /**
     *Metodo que modifica los datos de la cabecera de la cotizacion publ
     */
    public function modificarCotizacionesPubl($datos){
     // echo("php".$datos);
      $util = new Utilitarios();
      date_default_timezone_set('America/La_Paz');
      $fecha_actual  = date("y-m-d H:i:s");
      $valores['vent_prof_cab_usr_baja'] = $_SESSION['login'];
      $valores['vent_prof_cab_fech_hr_baja'] = $fecha_actual;
      $id_unico=$datos['cod_unico_cot_publ_det'];
      $condicion = "vent_prof_cab_cod_unico='".$id_unico."'";
      $this->mysql->update('vent_prof_cab', $valores, $condicion);
          $login=$_SESSION['login']; 
          $valor['vent_prof_cab_cod_unico']=$datos['cod_unico_cot_publ_det'];
          $valor['vent_prof_cab_cod_prof']=$datos['cod_cot_publ_det']; 
          $valor['vent_prof_cab_cod_cliente']=$datos['cod_unico_cliente_det_publ'];     
          $valor['vent_prof_cab_cod_operador']=$datos['cod_unico_op_det_publ']; 
          $valor['vent_prof_cab_tipo_cot']=0;     
          $valor['vent_prof_cab_tipo_compra']=$datos['tipo_compra_det_publ'];
          $valor['vent_prof_cab_forma_pago']=$datos['forma_pago_det_publ'];
          $valor['vent_prof_cab_fech_cot']=$util->cambiaf_a_mysql($datos['txt_vent_fch_inc_proforma_det_publ']);
          $valor['vent_prof_cab_fech_entrega_cot']=$util->cambiaf_a_mysql($datos['txt_vent_fch_entr_proforma_det_publ']);
          $valor['vent_prof_cab_nom_cotizado']=$datos['txt_vent_cotizador_proforma_det_publ'];
          $valor['vent_prof_cab_usr_alta']=$_SESSION['login'];
          $valor['vent_prof_cab_fech_hr_alta']=$util->cambiaf_a_mysql($_SESSION['fec_proc']);

          if($this->mysql->insert('vent_prof_cab', $valor)){
              $json_res['completo'] = true;
              $json_res['id_prof'] = $valor['vent_prof_cab_cod_unico'];
          }else{
              $json_res['completo'] = false;
          }
          print_r(json_encode($json_res));
    }

    /**
     * Metodo que elimina la cabecera de la cotizacion
     */
    public function eliminarCotizaciones($id_unico){
        //echo($id_unico);
      date_default_timezone_set('America/La_Paz');
      $fecha_actual  = date("y-m-d H:i:s");
      $datos['vent_prof_cab_usr_baja'] = $_SESSION['login'];
      $datos['vent_prof_cab_fech_hr_baja'] = $fecha_actual;
      $condicion = "vent_prof_cab_cod_unico='".$id_unico."'";
      return $this->mysql->update('vent_prof_cab', $datos, $condicion);
      //$this->mysql->update('vent_prof_cab',$datos,'vent_prof_cab_cod_unico='.$id_unico.'');
    }

           /** 
     * Generar codigo unico cliente  publico
     */
    private function getCodigoUnicoCotizacionPubl(){  
      $codigo = uniqid('inter_cotpubl_');
      return $codigo;
    }

        /**
     * Generar codigo de Cliente Publico
     **/
    private function getCodigoCotizacionPubl($inicial, $num_cel){
      $codigo = $inicial;
      $max_id = $this->getMaxCotizacionPubl();
      $cant = strlen($max_id);
      $ceros = '';
      while($num_cel > 0){
        while($cant>0){
          $num_cel = $num_cel-1;
          $cant=$cant-1;
        }
        $ceros = $ceros.'0';
        $num_cel = $num_cel-1;
      }
      $codigo = $codigo.$ceros.($max_id+1);
     return $codigo;
    }

       /**
     * Metodo que devuelve el maximo de cliente Publico
     */
    private function getMaxCotizacionPubl(){
      $query = "SELECT MAX(vent_prof_cab_id) AS id_max 
                FROM vent_prof_cab
                WHERE ISNULL(vent_prof_cab_usr_baja) AND vent_prof_cab_tipo_cot=0";
      $max = $this->mysql->query($query);
      return $max[0][0]['id_max'];
    }

            /** 
     * Generar codigo unico cliente privado
     */
    private function getCodigoUnicoCotizacionPriv(){  
      $codigo = uniqid('inter_cotpriv_');
      return $codigo;
    }

       /**
     * Generar codigo de Cliente Privado
     **/
    private function getCodigoCotizacionPriv($inicial, $num_cel){
      $codigo = $inicial;
      $max_id = $this->getMaxCotizacionPriv();
      $cant = strlen($max_id);
      $ceros = '';
      while($num_cel > 0){
        while($cant>0){
          $num_cel = $num_cel-1;
          $cant=$cant-1;
        }
        $ceros = $ceros.'0';
        $num_cel = $num_cel-1;
      }
      $codigo = $codigo.$ceros.($max_id+1);
     return $codigo;
    }
    /**
     * Metodo que devuelve el maximo de cliente
     */
    private function getMaxCotizacionPriv(){
      $query = "SELECT MAX(vent_prof_cab_id) AS id_max 
                FROM vent_prof_cab
                WHERE ISNULL(vent_prof_cab_usr_baja) AND vent_prof_cab_tipo_cot=1";
      $max = $this->mysql->query($query);
      return $max[0][0]['id_max'];
    }
    /*
     * Este es el metodo que verifica 
     * @return boolean si exite o no en la base de datos
     */
    public function runIni(){
    }

    /**
    * Metodo que permite ejecutar la lista de productos en el stock
     */
    public function listarProductosStock(){
      $query = 'SELECT apc.alm_prod_cab_id_unico_prod,apd.alm_prod_det_id_unico,apc.alm_prod_cab_codigo, alm_prod_cab_cod_ref, alm_prod_cab_prov,(SELECT alm_prov_nombre FROM alm_proveedor WHERE alm_prov_codigo_int=apc.alm_prod_cab_prov) AS alm_prod_cab_nom_prov, alm_prod_cab_nombre, alm_prod_cab_descripcion
                       alm_prod_cab_unidad, alm_prod_cab_presentacion, alm_prod_cab_moneda,(SELECT GRAL_PAR_INT_SIGLA FROM gral_param_super_int WHERE GRAL_PAR_INT_GRP=18 AND GRAL_PAR_INT_COD<>0 AND apc.alm_prod_cab_moneda=GRAL_PAR_INT_COD) AS alm_prod_cab_sigla, alm_prod_cab_img, 
                       alm_prod_cab_suc_origen,(SELECT GRAL_AGENCIA_NOMBRE FROM gral_agencia WHERE GRAL_AGENCIA_CODIGO = apc.alm_prod_cab_suc_origen) AS alm_prod_cab_suc_nombre, alm_prod_det_marca, alm_prod_det_cantidad, alm_prod_det_prec_compra, alm_prod_det_prec_venta, alm_prod_det_prec_max_venta, alm_prod_det_prec_min_venta
                FROM alm_prod_cabecera AS apc INNER JOIN alm_prod_detalle AS apd ON apc.alm_prod_cab_id_unico_prod=apd.alm_prod_cab_codigo 
                WHERE ISNULL(apc.alm_prod_cab_usr_baja) AND ISNULL(apd.alm_prod_det_usr_baja)';
      //print_r($query);
      return $this->mysql->query($query);

    }

    /**
     * Metodo que permite buscar un producto de la lista de productos
     */
    public function listarProductosStockPalabra($producto){
      $query = "SELECT apc.alm_prod_cab_id_unico_prod,apd.alm_prod_det_id_unico,apc.alm_prod_cab_codigo, alm_prod_cab_cod_ref, alm_prod_cab_prov,(SELECT alm_prov_nombre FROM alm_proveedor WHERE alm_prov_codigo_int=apc.alm_prod_cab_prov) AS alm_prod_cab_nom_prov, alm_prod_cab_nombre, alm_prod_cab_descripcion
                       alm_prod_cab_unidad, alm_prod_cab_presentacion, alm_prod_cab_moneda,(SELECT GRAL_PAR_INT_SIGLA FROM gral_param_super_int WHERE GRAL_PAR_INT_GRP=18 AND GRAL_PAR_INT_COD<>0 AND apc.alm_prod_cab_moneda=GRAL_PAR_INT_COD) AS alm_prod_cab_sigla, alm_prod_cab_img, 
                       alm_prod_cab_suc_origen,(SELECT GRAL_AGENCIA_NOMBRE FROM gral_agencia WHERE GRAL_AGENCIA_CODIGO = apc.alm_prod_cab_suc_origen) AS alm_prod_cab_suc_nombre, alm_prod_det_marca, alm_prod_det_cantidad, alm_prod_det_prec_compra, alm_prod_det_prec_venta, alm_prod_det_prec_max_venta, alm_prod_det_prec_min_venta
                FROM alm_prod_cabecera AS apc INNER JOIN alm_prod_detalle AS apd ON apc.alm_prod_cab_id_unico_prod=apd.alm_prod_cab_codigo 
                WHERE ISNULL(apc.alm_prod_cab_usr_baja) AND ISNULL(apd.alm_prod_det_usr_baja) AND (alm_prod_cab_nombre LIKE '%$producto%' OR 
                                                                                                                                 apc.alm_prod_cab_codigo LIKE '%$producto%' OR
                                                                                                                                 alm_prod_cab_cod_ref LIKE '%$producto%' OR
                                                                                                                                 alm_prod_det_marca LIKE '%$producto%')";
      return $this->mysql->query($query);
    }
     /**
     * Metodo que permite buscar un producto de la lista de productos
     */
    public function listarProductoEnfocadoStock($id_unico_producto){
      $query = "SELECT apc.alm_prod_cab_id_unico_prod,apd.alm_prod_det_id_unico,apc.alm_prod_cab_codigo, alm_prod_cab_cod_ref, alm_prod_cab_prov,(SELECT alm_prov_nombre FROM alm_proveedor WHERE alm_prov_codigo_int=apc.alm_prod_cab_prov) AS alm_prod_cab_nom_prov, alm_prod_cab_nombre, alm_prod_cab_descripcion
                       alm_prod_cab_unidad, alm_prod_cab_presentacion, alm_prod_cab_moneda,(SELECT GRAL_PAR_INT_SIGLA FROM gral_param_super_int WHERE GRAL_PAR_INT_GRP=18 AND GRAL_PAR_INT_COD<>0 AND apc.alm_prod_cab_moneda=GRAL_PAR_INT_COD) AS alm_prod_cab_sigla, alm_prod_cab_img, 
                       alm_prod_cab_suc_origen,(SELECT GRAL_AGENCIA_NOMBRE FROM gral_agencia WHERE GRAL_AGENCIA_CODIGO = apc.alm_prod_cab_suc_origen) AS alm_prod_cab_suc_nombre, alm_prod_det_marca, alm_prod_det_cantidad, alm_prod_det_prec_compra, alm_prod_det_prec_venta, alm_prod_det_prec_max_venta, alm_prod_det_prec_min_venta
                FROM alm_prod_cabecera AS apc INNER JOIN alm_prod_detalle AS apd ON apc.alm_prod_cab_id_unico_prod=apd.alm_prod_cab_codigo 
                WHERE ISNULL(apc.alm_prod_cab_usr_baja) AND ISNULL(apd.alm_prod_det_usr_baja) AND apd.alm_prod_det_id_unico='".$id_unico_producto."'";
      return $this->mysql->query($query);
    }

    /**
     * Metodo convertir normal las fechas
     */
   public function convertirNormal($fecha){
     $util = new Utilitarios();
     return $util->cambiaf_a_normal($fecha);
   }
   /**
    * Metodo que permite obtener la informacion del producto
    */
  public function getProductoInformation($codigo_cab, $codigo_det){
    $query = 'SELECT apc.alm_prod_cab_id_unico_prod, apd.alm_prod_det_id_unico, apc.alm_prod_cab_codigo, alm_prod_cab_cod_ref, alm_prod_cab_prov,(SELECT alm_prov_nombre FROM alm_proveedor WHERE alm_prov_codigo_int=alm_prod_cab_prov) AS alm_prod_cab_prov_nombre, alm_prod_cab_nombre, alm_prod_cab_descripcion
                     alm_prod_cab_unidad, alm_prod_cab_presentacion, alm_prod_cab_moneda,(SELECT GRAL_PAR_INT_SIGLA FROM gral_param_super_int WHERE GRAL_PAR_INT_GRP=18 AND GRAL_PAR_INT_COD<>0 AND apc.alm_prod_cab_moneda=GRAL_PAR_INT_COD) AS alm_prod_cab_sigla, alm_prod_cab_img, 
                     alm_prod_cab_suc_origen,(SELECT GRAL_AGENCIA_NOMBRE FROM gral_agencia WHERE GRAL_AGENCIA_CODIGO = apc.alm_prod_cab_suc_origen) AS alm_prod_cab_suc_nombre, alm_prod_det_marca, alm_prod_det_cantidad, alm_prod_det_prec_compra, alm_prod_det_prec_venta, alm_prod_det_prec_max_venta, alm_prod_det_prec_min_venta
              FROM alm_prod_cabecera AS apc INNER JOIN alm_prod_detalle AS apd ON apc.alm_prod_cab_id_unico_prod=apd.alm_prod_cab_codigo 
              WHERE ISNULL(apc.alm_prod_cab_usr_baja) AND ISNULL(apd.alm_prod_det_usr_baja)  AND apc.alm_prod_cab_id_unico_prod="'.$codigo_cab.'" AND apd.alm_prod_det_id_unico="'.$codigo_det.'"';
    //print_r($query);
    return $this->mysql->query($query);
  }
  /** Metodo que se encarga de devolver los servicios **/
  public function getServiciosProducto(){
    $query = 'SELECT GRAL_PAR_PRO_COD,GRAL_PAR_PRO_DESC, GRAL_PAR_PRO_CTA1 FROM gral_param_propios WHERE GRAL_PAR_PRO_GRP=2400 AND GRAL_PAR_PRO_COD <>0';
    return $this->mysql->query($query);
  }
  /** Metodo que se encarga de devolver el valor del un servicio especifico ID **/
  public function getServicesXID($id_service){
    $query = 'SELECT GRAL_PAR_PRO_CTA1 FROM gral_param_propios WHERE GRAL_PAR_PRO_GRP=2400 AND GRAL_PAR_PRO_COD ='.$id_service;
    return $this->mysql->query($query);
  }
  /** Metodo que se encarga de devolver a un tipo de producto en funcion a la inicial **/
  public function getTipoProductoXInicial($inicial){
    $query= 'SELECT GRAL_PAR_PRO_COD,GRAL_PAR_PRO_DESC FROM gral_param_propios WHERE GRAL_PAR_PRO_GRP=1000 AND GRAL_PAR_PRO_COD <>0 AND GRAL_PAR_PRO_SIGLA ="'.$inicial.'"';
    return $this->mysql->query($query);
  }
  /** Este es el metodo que permite registrar */
  public function registrarNuevoProducto($datos){
    $valor['vent_prof_cab_cod_unico'] = $datos['id_cab_prof_venta_codigo_unico'];
    $valor['vent_prof_det_cod_unico'] = uniqid('INTER_PROF_DET_');
    $valor['vent_prof_det_cod_proveedor'] = $datos['id_codigo_proveedor'];
    $valor['vent_prof_prod_cod_unico'] = $datos['txt_vent_codigo_unico'];
    $valor['vent_prof_det_tipo_prod'] = $datos['id_codigo_tipo_prod'];
    $valor['vent_prof_det_estado_prod'] = 1;
    $valor['vent_prof_det_cant_prod'] = $datos['txt_vent_item_cant_prod'];
    $valor['vent_prof_det_precio_venta'] = $datos['txt_vent_precio_venta_form_item'];
    $valor['vent_prof_det_tipo_mon'] = $datos['id_codigo_tipo_moneda'];
    $valor['vent_prof_det_marca_prod'] = $datos['id_marca_prod_item'];
    $valor['venta_prof_det_proced_prod'] = $datos['id_sucursal_origen_item'];
    $valor['vent_prof_det_tiempo_esp_prod'] = $datos['txt_vent_tiempo_espera'];
    $valor['vent_prof_det_serv_prof'] = $datos['select_vent_servicio_producto_item'];
    $valor['vent_prof_det_porc_serv_prof'] = $datos['input_vent_porcentaje_por_servicio'];
    $valor['vent_prof_det_esp_tecn'] = $datos['txt_area_vent_especificacion_tecnica'];
    $valor['vent_prof_det_conf_des'] = $datos['txt_area_vent_conf_deseada'];
    $valor['vent_prof_det_acces'] = $datos['txt_area_vent_detalle_accesorios'];
    $valor['vent_prof_det_usr_alta'] = $_SESSION['login'];
    if($this->mysql->insert('vent_prof_det', $valor)){
        $json_res['completo'] = true;
    }else{
        $json_res['completo'] = false;
    }
    print_r(json_encode($json_res));
  }
  /** Eliminar la prof de venta **/
  public function eliminarDetaProfVenta($datos){
    date_default_timezone_set('America/La_Paz');
    $fecha_actual  = date("y-m-d H:i:s");
    $val['vent_prof_det_usr_baja'] = $_SESSION['login'];
    $val['vent_prof_det_fech_hr_baja'] = $fecha_actual;
    $condicion = "vent_prof_det_cod_unico='".$datos['codigo_del_prof_det']."'";
    if($this->mysql->update('vent_prof_det', $val, $condicion)){
      $json_res['complet'] = true;
    }else{
      $json_res['complet'] = false;
    }
    print_r(json_encode($json_res));
<<<<<<< .mine
  }  
=======
  } 
  //new Home().nuevaCotDetPriv($('#cod_unico_cot_det').val());
  //listarDetalleCotizacionPrivada 
  public function getDetalleProductoEspecif($datos){
    $query = 'SELECT * 
              FROM vent_prof_det AS vpd INNER JOIN alm_prod_detalle AS apd ON vpd.vent_prof_prod_cod_unico=apd.alm_prod_det_id_unico 
              WHERE vent_prof_det_cod_unico="'.$datos['codigo_unico'].'"';
    //print_r($query);
    return $this->mysql->query($query);
  } 
  /** Este es el metodo que permite actualizar los precios y cantidad nuevas **/
  public function setNuevaCantidadPrecio($datos){
    date_default_timezone_set('America/La_Paz');
    $fecha_actual  = date("y-m-d H:i:s");
    $val['vent_prof_det_precio_venta'] = $datos['precio_nuevo'];
    $val['vent_prof_det_cant_prod'] = $datos['cantidad'];
    $val['vent_prof_det_usr_alta'] = $_SESSION['login'];
    $val['vent_prof_det_fech_hr_alta'] = $fecha_actual;
    $condicion = "vent_prof_det_cod_unico='".$datos['id_unico']."'";
    if($this->mysql->update('vent_prof_det', $val, $condicion)){
      $json_res['complet'] = true;
    }else{
      $json_res['complet'] = false;
    }
    print_r(json_encode($json_res));
  }
>>>>>>> .r1279
}

?>
