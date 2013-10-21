<?php
require_once '../lib/Mysql.php';

/**
 * Clase contrato gestiona todas las consultas y formulario de transferencia Bancaria
 * @author Ramiro Gutierrez 
 * @date 21/05/2013
 */
class ListaModificaciones{
	// Esta es la variable mysql
	private $mysql;
	/*
	 * Este es el constructor de la clase transferencia Bancaria
	 * @param  parm1 -> signigica esto
	 *         param2 -> significa esta otra cosa
	 * @return  variable, variable[] -> descripscion 
	 */
	public function __construct() {
		// Constructor
		$this->mysql = new Mysql();
	}
	
	/**
	*	Metodo donde se muestra el formulario de los contratos para su modificacion
	*/
	public function formularioListaModificaciones(){
		$template = file_get_contents('tpl/ListaModificaciones_form_tpl.html');
		print($template);
	}
	
}
?>