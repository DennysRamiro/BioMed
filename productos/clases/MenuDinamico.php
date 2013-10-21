<?php
/**
 * Clase que permite gestionar el menu de la cada archivo
 */
class MenuDinamico{
	/*
	 * Este es el metodo constructor de la clase
	 */
	public function __construct() {
       // aqui el contructor de la clase 
    }
	/*
	 * Metod  que ejcuta el menu de usuario
	 */
	public function getMenuDinamico($enlaces){
		$menu = '<ul id="lista_menu">';      
        foreach($enlaces as $key => $value){
			$menu  = $menu.'<li id="menu_dinamico">
                    			<a href="'.$value['enlace'].'"><img src="'.$value['imagen'].'" border="0" alt="'.$value['titulo'].'" align="absmiddle"> '.$value['titulo'].'</a>
                 			</li>';
		}
        $menu = $menu.'</ul>';
		print($menu); 
	}
	
}
?>