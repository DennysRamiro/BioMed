<?php
	require_once "../lib/Mysql.php";
    require_once '../importaciones/clases/Utilitarios.php';
	/**
	 *
	 */
	class DevolucionModel{

		private $mysql;
		/**
		 * Comentarios del constructor
		 */
		public function __construct() {
        	// definir variables propias de la clase
        	$this->mysql = new Mysql();
    }

    /**
     * Metodo que lista Devoluciones
     */
    public function listarDevoluciones($start, $limit){
        //echo ($start."-".$limit."-".$valor);

        $query = 'SELECT * 
                  FROM alm_ing_egr_cab 
                  WHERE ISNULL(alm_cab_ing_egr_usr_baja) AND alm_cab_ing_egr_motivo=4 LIMIT '.$start.','.$limit;
        //print_r($query);
        return $this->mysql->query($query);
    }

    /**
     * Metodo que devuelve total de los traspasos
     */
    public function totalDevoluciones(){
      //print_r($valor);
        $query = 'SELECT COUNT(*) AS total  
                  FROM alm_ing_egr_cab 
                  WHERE  ISNULL(alm_cab_ing_egr_usr_baja) AND alm_cab_ing_egr_motivo=4';
      //print_r($query);
        return $this->mysql->query($query);
    }

    /**
     * Metodo que buscar traspasos
     */
    public function buscarDevoluciones($buscar_palabra){
      //echo ($start."-".$limit."-".$valor);

      $query = 'SELECT * 
                FROM alm_ing_egr_cab cab INNER JOIN gral_agencia orig ON cab.alm_cab_ing_egr_origen=orig.GRAL_AGENCIA_CODIGO 
                INNER JOIN gral_agencia dest ON cab.alm_cab_ing_egr_destino=dest.GRAL_AGENCIA_CODIGO 
                WHERE (cab.alm_cab_ing_egr_nro_nota LIKE "%'.$buscar_palabra.'%" OR 
                cab.alm_cab_ing_egr_nombre LIKE "%'.$buscar_palabra.'%" OR
                orig.GRAL_AGENCIA_NOMBRE LIKE "%'.$buscar_palabra.'%" OR
                dest.GRAL_AGENCIA_NOMBRE LIKE "%'.$buscar_palabra.'%") AND ISNULL(cab.alm_cab_ing_egr_usr_baja) AND ISNULL(orig.GRAL_AGENCIA_USR_BAJA) AND ISNULL(dest.GRAL_AGENCIA_USR_BAJA) AND cab.alm_cab_ing_egr_motivo=4
                ORDER BY cab.alm_cab_ing_egr_nro_nota ASC';
      //print_r($query);
      return $this->mysql->query($query);
    }

    /**
     * Este es el metodo que devuelve los datos de una nota de devolucion seleccionado desde la busqueda autocomplet
     */
    public function getDatosBusDev($id_unico){
      $consulta  = 'SELECT * 
                          FROM alm_ing_egr_cab cab 
                          WHERE alm_cab_ing_nro_unico="'.$id_unico.'" AND alm_cab_ing_egr_motivo=4';
      return $this->mysql->query($consulta);
    }

        /**
     * Metodo para buescar devolucion desde el boton
     */
    public function buscarDevolucionesBoton($start, $limit, $buscar_palabra){
        //echo ($start."-".$limit."-".$valor);
        $query = 'SELECT *
                  FROM alm_ing_egr_cab cab INNER JOIN gral_agencia orig ON cab.alm_cab_ing_egr_origen=orig.GRAL_AGENCIA_CODIGO 
                  INNER JOIN gral_agencia dest ON cab.alm_cab_ing_egr_destino=dest.GRAL_AGENCIA_CODIGO 
                  WHERE (cab.alm_cab_ing_egr_nro_nota LIKE "%'.$buscar_palabra.'%" OR 
                  cab.alm_cab_ing_egr_nombre LIKE "%'.$buscar_palabra.'%" OR
                  orig.GRAL_AGENCIA_NOMBRE LIKE "%'.$buscar_palabra.'%" OR
                  dest.GRAL_AGENCIA_NOMBRE LIKE "%'.$buscar_palabra.'%") AND ISNULL(cab.alm_cab_ing_egr_usr_baja) AND ISNULL(orig.GRAL_AGENCIA_USR_BAJA) AND ISNULL(dest.GRAL_AGENCIA_USR_BAJA) AND cab.alm_cab_ing_egr_motivo=4
                  ORDER BY cab.alm_cab_ing_egr_nro_nota ASC
                  LIMIT '.$start.',10';
        //print_r($query);
        return $this->mysql->query($query);
    }

    /**
     * Metodo que devuelve total de los ingresos desde el boton
     */
    public function totalDevolucionesBoton($buscar_palabra){
        //echo ($start."-".$limit."-".$valor);
        $query = 'SELECT COUNT(*) AS total  
                  FROM alm_ing_egr_cab cab INNER JOIN gral_agencia orig ON cab.alm_cab_ing_egr_origen=orig.GRAL_AGENCIA_CODIGO 
                  INNER JOIN gral_agencia dest ON cab.alm_cab_ing_egr_destino=dest.GRAL_AGENCIA_CODIGO 
                  WHERE (cab.alm_cab_ing_egr_nro_nota LIKE "%'.$buscar_palabra.'%" OR 
                  cab.alm_cab_ing_egr_nombre LIKE "%'.$buscar_palabra.'%" OR
                  orig.GRAL_AGENCIA_NOMBRE LIKE "%'.$buscar_palabra.'%" OR
                  dest.GRAL_AGENCIA_NOMBRE LIKE "%'.$buscar_palabra.'%") AND ISNULL(cab.alm_cab_ing_egr_usr_baja) AND ISNULL(orig.GRAL_AGENCIA_USR_BAJA) AND ISNULL(dest.GRAL_AGENCIA_USR_BAJA) AND cab.alm_cab_ing_egr_motivo=4
                  ORDER BY cab.alm_cab_ing_egr_nro_nota ASC';
                  //LIMIT '.$start.',10';
        //print_r($query);
        return $this->mysql->query($query);
      }

}
?>