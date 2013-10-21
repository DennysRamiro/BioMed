<?php
  require_once "models/TraspasoModel.php";
  require_once "views/IndexView.php";

	/**
	 *
	 */
	class TraspasoView{
		/**
		 * Comentarios del constructor
		 */
		public function __construct() {
        	// definir variables propias de la clase
    	}

        public function runIndex(){

        	  $index_view = new IndexView(); 
            $template = file_get_contents('site/home.html');
            $template = $index_view->configuracionHead($template);
            $header = file_get_contents('../ventas/app/site/header.html');
            $header = $index_view->settingHeaders($header);
            $template = str_replace('{clasejs}', 'site/js/Index.js', $template);
            $template = str_replace('{clasesegunda}', 'site/js/Egreso.js', $template);
            $template = str_replace('{clasetercera}', 'site/js/Traspaso.js', $template);
            $template = str_replace('{clasecuarta}', 'site/js/Devolucion.js', $template);
            $template = str_replace('{header}', $header, $template);
            $template = $index_view->setMigaPan($template);
            $template = $index_view->setHeadBotones($template);
            $template = str_replace('{titulo_modulo}', '<h2 style="margin:0px;"><img border="0" align="absmiddle" alt="GEST. ALMACENES" src="../img/almacen_64x64.png">Gesti&oacute;n de Almacenes</h2><hr style="border:1px dashed #767676;">', $template);
            $content_tab = file_get_contents('site/traspaso_tpl/tab_traspasos.html');
            $botones_cabecera = '<button class="btn_ventas" onclick="new Traspaso().nuevoTraspasoAlmacenes();"> <img src="../img/traspaso_alm_24x24.png" align="absmiddle"> Nuevo Traspaso Almacenes</button>';
            $template = $this->setNuevoFormTraspaso($template);
            $content_tab = str_replace('{botones_documento}', $botones_cabecera, $content_tab);
            $content_tab = str_replace('{titulo_2}', 'Nuevos Traspasos', $content_tab);
            $ingresos='<div id="div_lista_traspasos_almacenes"><table id="tabla_traspaso_almacenes" class="table_usuario">
                            <tr >
                                <th>NRO</th>
                                <th>CODIGO</th>
                                <th>NOMBRE</th>
                                <th>DESTINO</th>
                                <th>ORIGEN</th>
                                <th>FECHA</th>
                                <th>EDITAR</th>
                                <th>ELIMINAR</th>
                            </tr></table></div>';
            $content_tab = str_replace('{content_2}', $ingresos, $content_tab);
            $template = str_replace('{content}', $content_tab, $template);
            $template = $index_view->setFooter($template);
            
            print_r($template);
        }

        /**
         * Metodo que permite crea la nueva vista del ingreso 
         */
    public function setNuevoFormTraspaso($template){
        $form_traspaso = file_get_contents('site/traspaso_tpl/nuevo_form_traspaso_tpl.html');
        $form_traspaso_detalle = file_get_contents('site/traspaso_tpl/nuevo_form_traspaso_detalle_tpl.html');
        $form_traspaso_item_detalle = file_get_contents('site/traspaso_tpl/nuevo_form_traspaso_item_detalle_tpl.html');
        $template = str_replace('{dialog_form}', $form_traspaso.$form_traspaso_detalle.$form_traspaso_item_detalle, $template);
        $traspaso_model = new TraspasoModel();
        $origen = $traspaso_model->getDatosUsuario($_SESSION['login']);
        $org='<select name="org_trasp" size="1" size="10" id="org_trasp" style="height:30px">';
        //print_r($origen);
        $cont=0;
        foreach ($origen as $key => $value) {
            $or=$traspaso_model->getRegionOp($value['gral_usuario']['GRAL_AGENCIA_CODIGO']);
            $org = $org.'<option value="'.$value['gral_usuario']['GRAL_AGENCIA_CODIGO'].'" >'.$or[0]['gral_agencia']['GRAL_AGENCIA_NOMBRE'].'</option>';
        }
        $org = $org.'</select>';
        $template = str_replace('{origen_trasp}', $org, $template);

        $destino = $traspaso_model->getAgenciaDestino($origen[0]['gral_usuario']['GRAL_AGENCIA_CODIGO']);
        $dest='<select name="dest_trasp" size="1" size="10" id="dest_trasp" style="height:30px">';
        //print_r($origen);
        $cont=0;
        foreach ($destino as $key => $value1) {
            $dest = $dest.'<option value="'.$value1['gral_agencia']['GRAL_AGENCIA_CODIGO'].'" >'.$value1['gral_agencia']['GRAL_AGENCIA_NOMBRE'].'</option>';
        }
        $dest = $dest.'</select>';
        $template = str_replace('{destino_trasp}', $dest, $template);

        $almacenero=$traspaso_model->getDatosUsuario($_SESSION['login']);
        foreach ($almacenero as $key => $value2) {
             $alm='<input type="text" name="alm_trasp" id="alm_trasp" class="txt_campo" value="'.$value2['gral_usuario']['GRAL_USR_NOMBRES']." ".$value2['gral_usuario']['GRAL_USR_AP_PATERNO'].'" readonly>';
        }
       
        $template = str_replace('{nombre_almacenero_trasp}', $alm, $template);
        return $template;   
    }
}
?>