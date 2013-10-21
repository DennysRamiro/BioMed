<?php
  require_once "models/EgresoModel.php";
  require_once "views/IndexView.php";


	/**
	 *
	 */
	class EgresoView{
		/**
		 * Comentarios del constructor
		 */
		public function __construct() {
        	// definir variables propias de la clase
    	}


        public function runIndex(){

          //print_r("expression");
        	 $index_view = new IndexView();
           //$egreso_model = new EgresoModel();
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
            $content_tab = file_get_contents('site/egreso_tpl/tab_egresos.html');
            $botones_cabecera = '<button class="btn_ventas" onclick="new Egreso().nuevaEgresoAlmacenes()"> <img src="../img/alm_egr_24x24.png" align="absmiddle"> Nuevo Egreso</button><button class="btn_ventas" onclick="new Egreso().nuevaReporteAlmacenes()"> <img src="../img/alm_egr_24x24.png" align="absmiddle"> Reportes</button>';
            $template = $this->setNuevoFormEgreso($template);
            $content_tab = str_replace('{botones_documento}', $botones_cabecera, $content_tab);
            $content_tab = str_replace('{titulo_1}', 'NUEVOS INGRESOS', $content_tab);
            $content_tab = str_replace('{titulo_2}', 'EGRESOS POR CONFIRMAR', $content_tab);
            $egresos='<div id="div_lista_egreso_almacenes"><table id="tabla_egreso_almacenes" class="table_usuario">
                            <tr>
                                <th>NRO</th>
                                <th>CODIGO</th>
                                <th>NOMBRE</th>
                                <th>MOTIVO</th>
                                <th>DESTINO</th>
                                <th>ORIGEN</th>
                                <th>FECHA</th>
                                <th>EDITAR</th>
                                <th>ELIMINAR</th>
                                <th>NOTA EGRESO</th>
                            </tr></table></div>';
            $content_tab = str_replace('{content_1}', $egresos, $content_tab);
             $egresos='<div id="div_lista_egresos_por_confirmar"><table id="tabla_egreso_no_confirmados_almacenes" class="table_usuario">
                            <tr >
                                <th>NRO</th>
                                <th>CODIGO</th>
                                <th>NOMBRE</th>
                                <th>MOTIVO</th>
                                <th>DESTINO</th>
                                <th>ORIGEN</th>
                                <th>FECHA</th>
                                <th>EDITAR</th>
                                <th>ELIMINAR</th>
                            </tr></table></div>';
            $content_tab = str_replace('{content_2}', $egresos, $content_tab);
            $template = str_replace('{content}', $content_tab, $template);
            $template = $index_view->setFooter($template);
            /**/   
            print_r($template);
         
        }

         /**
         * Metodo que permite crea la nueva vista del ingreso 
         */
        public function setNuevoFormEgreso($template){
            $form_ingreso = file_get_contents('site/egreso_tpl/nuevo_form_egreso_tpl.html');
            $dialogo_confirma = file_get_contents('site/egreso_tpl/dialogo_confirm.html');
            $dialogo_confirma_cantidad = file_get_contents('site/egreso_tpl/dialogo_confirm_cantidad_tpl.html');
            $dialogo_confirm = file_get_contents('site/egreso_tpl/dialogo_confirm_egreso.html');
            $dialogo_confirm_egreso_detalle = file_get_contents('site/egreso_tpl/dialogo_confirm_egreso_detalle.html');
            $dialogo_egreso_detalle = file_get_contents('site/egreso_tpl/nuevo_form_egreso_detalle_modificar_tpl.html');
            $dialogo_egreso_ingresa_detalle = file_get_contents('site/egreso_tpl/nuevo_form_egreso_ingresar_detalle_tpl.html');
            $dialogo_egreso_modifica_detalle = file_get_contents('site/egreso_tpl/nuevo_form_egreso_modificar_detalle_tpl.html');
            $form_seleccion_detalle_producto_egresar = file_get_contents('site/egreso_tpl/seleccion_productos_detalles_tpl.html');
            $dialogo_reporte_nota_egreso = file_get_contents('site/egreso_tpl/nuevo_form_reporte_egreso_tpl.html');


           
            $template = str_replace('{dialog_form}', $form_ingreso.$dialogo_confirma.$dialogo_confirma_cantidad.$dialogo_confirm.$dialogo_confirm_egreso_detalle.$dialogo_egreso_detalle.$dialogo_egreso_ingresa_detalle.$dialogo_egreso_modifica_detalle.$form_seleccion_detalle_producto_egresar.$dialogo_reporte_nota_egreso, $template);
            $index_model = new IndexModel();
            $origenes = $index_model->getDestino();
            
            $org = '<select name="egr_origen" size="1" size="10" id="egr_origen" style="height:30px">';
            $cont=0;
            foreach($origenes as $key => $origenes){
                $org = $org.'<option value="'.$origenes['gral_agencia']['GRAL_AGENCIA_CODIGO'].'" >'.$origenes['gral_agencia']['GRAL_AGENCIA_NOMBRE'].'</option>';
            }
            $org = $org.'</select>';
            $template = str_replace('{origen}', $org, $template);

            $destino = $index_model->getDestino();
            $dest = '<select name="egr_destino" size="1" size="10" id="egr_destino" style="height:30px">';
            $cont=0;
            foreach($destino as $key => $destino){
                $dest = $dest.'<option value="'.$destino['gral_agencia']['GRAL_AGENCIA_CODIGO'].'" >'.$destino['gral_agencia']['GRAL_AGENCIA_NOMBRE'].'</option>';
            }
            $dest = $dest.'</select>';
            $template = str_replace('{destino}', $dest, $template);
            $datos_usuario = $index_model->getUsuarioDatos($_SESSION['login']);
            $template = str_replace('{nombre_almacenero}', $datos_usuario[0]['gral_usuario']['GRAL_USR_NOMBRES']." ".$datos_usuario[0]['gral_usuario']['GRAL_USR_AP_PATERNO'], $template);
            return $template;   
        }
}
?>