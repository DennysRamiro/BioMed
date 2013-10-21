<?php
require_once '../lib/Mysql.php';
/**
 * Clase proveedor
 */
class Proveedor{
	// variable mysql para la conexion en la base de datos
	private $mysql;
	/*
	 * Este es el metodo constructor de la clase
	 */
	public function __construct() {
       // aqui el contructor de la clase 
	   $this->mysql = new Mysql(); // Instanciando la clase mysqlobtenerDatosProveedor
    }
	//public function optenerTipo($
	/**
	* Este es el metodo que que nos devuelve la lista de proveedores
	*/
	public function listaProveedores(){
		$query = 'SELECT alm_prov_codigo_int,alm_prov_codigo_ext, alm_prov_nombre
				  FROM alm_proveedor
				  WHERE ISNULL(alm_prov_usr_baja) AND alm_prov_estado=1';
	 	return $this->mysql->query($query);
	}
	/**
	 * Metodo que permite seleccionar el proveedor
	 * @param $id_proveedor  que es el id del proveedor que se va seleccionar
	 */
	public function obtenerDatosProveedor($id_proveedor){
		//print_r('SELECT alm_prov_codigo_int, alm_prov_nombre FROM alm_proveedor WHERE alm_prov_codigo_int="'.$id_proveedor.'"');
		return $this->mysql->query('SELECT alm_prov_codigo_int, alm_prov_nombre FROM alm_proveedor WHERE alm_prov_codigo_int="'.$id_proveedor.'" AND ISNULL(alm_prov_usr_baja)');
		
	}
	
}
?>