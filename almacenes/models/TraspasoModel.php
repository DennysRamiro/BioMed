<?php
	require_once "../lib/Mysql.php";
    require_once '../importaciones/clases/Utilitarios.php';
	/**
	 *
	 */
	class TraspasoModel{

		private $mysql;
		/**
		 * Comentarios del constructor
		 */
		public function __construct() {
        	// definir variables propias de la clase
        	$this->mysql = new Mysql();
    }

    /**
     * Metodo que lista Traspasos
     */
    public function listarTraspasos($start, $limit){
        //echo ($start."-".$limit."-".$valor);

        $query = 'SELECT * 
                  FROM alm_ing_egr_cab 
                  WHERE ISNULL(alm_cab_ing_egr_usr_baja) AND alm_cab_ing_egr_motivo=3 LIMIT '.$start.','.$limit;
        //print_r($query);
        return $this->mysql->query($query);
    }

    /**
     * Metodo que devuelve total de los traspasos
     */
    public function totalTraspasos(){
      //print_r($valor);
        $query = 'SELECT COUNT(*) AS total  
                  FROM alm_ing_egr_cab 
                  WHERE  ISNULL(alm_cab_ing_egr_usr_baja) AND alm_cab_ing_egr_motivo=3';
      //print_r($query);
        return $this->mysql->query($query);
    }

    /**
     * Metodo que buscar traspasos
     */
    public function buscarTraspasos($buscar_palabra){
      //echo ($start."-".$limit."-".$valor);

      $query = 'SELECT * 
                FROM alm_ing_egr_cab cab INNER JOIN gral_agencia orig ON cab.alm_cab_ing_egr_origen=orig.GRAL_AGENCIA_CODIGO 
                INNER JOIN gral_agencia dest ON cab.alm_cab_ing_egr_destino=dest.GRAL_AGENCIA_CODIGO 
                WHERE (cab.alm_cab_ing_egr_nro_nota LIKE "%'.$buscar_palabra.'%" OR 
                cab.alm_cab_ing_egr_nombre LIKE "%'.$buscar_palabra.'%" OR
                orig.GRAL_AGENCIA_NOMBRE LIKE "%'.$buscar_palabra.'%" OR
                dest.GRAL_AGENCIA_NOMBRE LIKE "%'.$buscar_palabra.'%") AND ISNULL(cab.alm_cab_ing_egr_usr_baja) AND ISNULL(orig.GRAL_AGENCIA_USR_BAJA) AND ISNULL(dest.GRAL_AGENCIA_USR_BAJA) AND cab.alm_cab_ing_egr_motivo=3
                ORDER BY cab.alm_cab_ing_egr_nro_nota ASC';
      //print_r($query);
      return $this->mysql->query($query);
    }

    /**
     * Este es el metodo que devuelve los datos de una nota de traspaso seleccionado desde la busqueda autocomplet
     */
    public function getDatosBusTrasp($id_unico){
      $consulta  = 'SELECT * 
                          FROM alm_ing_egr_cab cab 
                          WHERE alm_cab_ing_nro_unico="'.$id_unico.'" AND alm_cab_ing_egr_motivo=3';
      return $this->mysql->query($consulta);
    }

    /**
     * Metodo para buescar ingresos desde el boton
     */
    public function buscarTraspasosBoton($start, $limit, $buscar_palabra){
        //echo ($start."-".$limit."-".$valor);
        $query = 'SELECT *
                  FROM alm_ing_egr_cab cab INNER JOIN gral_agencia orig ON cab.alm_cab_ing_egr_origen=orig.GRAL_AGENCIA_CODIGO 
                  INNER JOIN gral_agencia dest ON cab.alm_cab_ing_egr_destino=dest.GRAL_AGENCIA_CODIGO 
                  WHERE (cab.alm_cab_ing_egr_nro_nota LIKE "%'.$buscar_palabra.'%" OR 
                  cab.alm_cab_ing_egr_nombre LIKE "%'.$buscar_palabra.'%" OR
                  orig.GRAL_AGENCIA_NOMBRE LIKE "%'.$buscar_palabra.'%" OR
                  dest.GRAL_AGENCIA_NOMBRE LIKE "%'.$buscar_palabra.'%") AND ISNULL(cab.alm_cab_ing_egr_usr_baja) AND ISNULL(orig.GRAL_AGENCIA_USR_BAJA) AND ISNULL(dest.GRAL_AGENCIA_USR_BAJA) AND cab.alm_cab_ing_egr_motivo=3
                  ORDER BY cab.alm_cab_ing_egr_nro_nota ASC
                  LIMIT '.$start.',10';
        //print_r($query);
        return $this->mysql->query($query);
    }

    /**
     * Metodo que devuelve total de los ingresos desde el boton
     */
    public function totalTraspasosBoton($buscar_palabra){
        //echo ($start."-".$limit."-".$valor);
        $query = 'SELECT COUNT(*) AS total  
                  FROM alm_ing_egr_cab cab INNER JOIN gral_agencia orig ON cab.alm_cab_ing_egr_origen=orig.GRAL_AGENCIA_CODIGO 
                  INNER JOIN gral_agencia dest ON cab.alm_cab_ing_egr_destino=dest.GRAL_AGENCIA_CODIGO 
                  WHERE (cab.alm_cab_ing_egr_nro_nota LIKE "%'.$buscar_palabra.'%" OR 
                  cab.alm_cab_ing_egr_nombre LIKE "%'.$buscar_palabra.'%" OR
                  orig.GRAL_AGENCIA_NOMBRE LIKE "%'.$buscar_palabra.'%" OR
                  dest.GRAL_AGENCIA_NOMBRE LIKE "%'.$buscar_palabra.'%") AND ISNULL(cab.alm_cab_ing_egr_usr_baja) AND ISNULL(orig.GRAL_AGENCIA_USR_BAJA) AND ISNULL(dest.GRAL_AGENCIA_USR_BAJA) AND cab.alm_cab_ing_egr_motivo=3
                  ORDER BY cab.alm_cab_ing_egr_nro_nota ASC';
                  //LIMIT '.$start.',10';
        //print_r($query);
        return $this->mysql->query($query);
    }

    /**
     * Metodo que obtiene la lista destino destino
     */
    public function getAgenciaDestino($origen){
        $query = 'SELECT * 
                  FROM gral_agencia 
                  WHERE GRAL_AGENCIA_USR_BAJA is null AND NOT GRAL_AGENCIA_CODIGO='.$origen.'';
        return $this->mysql->query($query);
    }

    /**
     * Metodo que obtiene datos de la session
     */
    public function getDatosUsuario($login){
        $query = 'SELECT * 
                  FROM gral_usuario 
                  WHERE GRAL_USR_LOGIN="'.$login.'"';
        return $this->mysql->query($query);
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

    /** 
     * Generar codigo unico de ingreso, egreso y traspaso 
     */
    private function getCodigoUnicoTrasp(){  
      $codigo = uniqid('INTER_ALM_TRAS_');
      return $codigo;
    }

    /**
    * Metodo que busca el maximo numero
    */
    private function getMaxNro(){
      //print_r("expression");
      $query='SELECT MAX(alm_cab_ing_egr_correlativo) as val FROM alm_ing_egr_cab WHERE alm_cab_ing_egr_motivo=3';
      $max = $this->mysql->query($query);
      return $max[0][0]['val'];
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
    }

    /*
     * Este es el metodo que graba el traspaso de almacenes
     */
    public function grabarNuevoTraspaso($datos){
      $util = new Utilitarios();
      $bu = $this->getMaxNro();
      $bul = $this->getNroNota($bu);
      $valores['alm_cab_ing_egr_correlativo']=$bu+1;
      $valores['alm_cab_ing_nro_unico']=$this->getCodigoUnicoTrasp();
      $valores['alm_cab_ing_egr_nombre']=$datos['alm_trasp']; 
      $valores['alm_cab_ing_egr_nro_nota']=$bul;
      $valores['alm_cab_ing_egr_fecha_ingreso']=$util->cambiaf_a_mysql($datos['alm_fec_trasp']);     
      $valores['alm_cab_ing_egr_motivo']=3; 
      $valores['alm_cab_ing_egr_origen']=$datos['org_trasp']; 
      $valores['alm_cab_ing_egr_destino']=$datos['dest_trasp']; 
      $valores['alm_cab_ing_egr_usr_alta']=$_SESSION['login'];
      $valores['alm_cab_ing_egr_fech_alta']=$util->cambiaf_a_mysql($_SESSION['fec_proc']);
      if($this->mysql->insert('alm_ing_egr_cab', $valores)){
        $json_res['completo'] = true;
        $json_res['cod_unico'] = $valores['alm_cab_ing_nro_unico'];
      }else{
          $json_res['completo'] = false;
      }
      print_r(json_encode($json_res));
    }

    /*
     * Este es el metodo que devuelve cab para el detalle
     */
    public function getCabTrasp($id_unico){
        $consulta  = 'SELECT * 
                      FROM alm_ing_egr_cab
                      WHERE ISNULL(alm_cab_ing_egr_usr_baja) AND alm_cab_ing_egr_motivo=3 AND alm_cab_ing_nro_unico="'.$id_unico.'"';
        return $this->mysql->query($consulta);
    }

    /**
     * Este es el metodo hace la busqueda de los productos para item traspaso det
     */
    public function buscarProductos($buscar_palabra){
      $consulta  = 'SELECT * 
                    FROM alm_prod_cabecera
                    WHERE (alm_prod_cab_codigo LIKE "%'.$buscar_palabra.'%" OR 
                    alm_prod_cab_nombre LIKE "%'.$buscar_palabra.'%") AND ISNULL(alm_prod_cab_usr_baja)';
      return $this->mysql->query($consulta);
    }

}
?>