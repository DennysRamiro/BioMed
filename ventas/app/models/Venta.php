<?php
require_once '../lib/Mysql.php';
/**
 * Esta es la clase 
 */
class Venta{
	/**
	 * Atributo de mysql private para cargar el mysql
	 */
	private $mysql;
    /*
     * Este es el constructo de del modelo HomeModel
     */
    public function __construct() {
        $this->mysql = new Mysql();
    }



 /**
     * Metodo que elimina la cabecera de la cotizacion
     */
    public function  eliminarItemsVentas($id_unico){
        //echo($id_unico."---");
      
      date_default_timezone_set('America/La_Paz');
      $fecha_actual  = date("y-m-d H:i:s");
      $datos['vent_prof_det_usr_baja'] = $_SESSION['login'];
      $datos['vent_prof_det_fech_hr_baja'] = $fecha_actual;
      $condicion = "vent_prof_det_cod_unico='".$id_unico."'";
      return $this->mysql->update('vent_prof_det', $datos, $condicion);
      //$this->mysql->update('vent_prof_cab',$datos,'vent_prof_cab_cod_unico='.$id_unico.'');
    }

    /**
     * Metodo que elimina el item de la cabecera de la venta
     */
    public function eliminarVentas($id_unico){
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
     * Metodo que busca los datos del detaale de la venta
     */
    public function getDetalleItemsVentaPriv($id_unico){
        //echo($id_unico);
    /*$consulta  = 'SELECT *
                      FROM vent_prof_det 
                      WHERE ISNULL(vent_prof_det_usr_baja) AND vent_prof_det_cod_unico="'.$id_unico.'"';
*/
       $consulta  = 'SELECT *
                      FROM vent_prof_det as vpd INNER JOIN  alm_prod_cabecera as apc ON vpd.vent_prof_prod_cod_unico= apc.alm_prod_cab_id_unico_prod
                      WHERE ISNULL(vent_prof_det_usr_baja) AND vent_prof_det_cod_unico="'.$id_unico.'"';
                      
                      //print_r($consulta);
        return $this->mysql->query($consulta);
    }


 /**
     * Metodo que guarda los datos la cabecera de la cotizacion
     */
    public function guardarCotizacionesPriv($datos){
        //echo("consulta");
      $util = new Utilitarios();
      //$valores['vent_prof_cab_id']=NULL;
      //$login=$_SESSION['login'];
      print_r($datos);
      $datos['vent_prof_cab_usr_baja'] = $_SESSION['login'];
      $datos['vent_prof_cab_fech_hr_baja'] = $fecha_actual;
      $condicion = "vent_prof_cab_cod_unico='".$id_unico."'";
      return $this->mysql->update('vent_prof_cab', $datos, $condicion);


     /* if($this->mysql->insert('vent_prof_cab', $valores)){
          $json_res['completo'] = true;
          $json_res['id_prof'] = $valores['vent_prof_cab_cod_unico'];
      }else{
          $json_res['completo'] = false;
      }
      print_r(json_encode($json_res));
*/
      
      //return $this->mysql->insert('vent_prof_cab', $valores);

      //echo("cod".$valores['vent_prof_cab_cod_operador']);

    }

//*************************
}
?>