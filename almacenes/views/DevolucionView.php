<?php
  require_once "models/DevolucionModel.php";
  require_once "views/IndexView.php";

  /**
   *
   */
  class DevolucionView{
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
            $content_tab = file_get_contents('site/devolucion_tpl/tab_devoluciones.html');
            $botones_cabecera = '<button class="btn_ventas" onclick="new Devolucion().nuevoDevolucionAlmacenes();"> <img src="../img/devolucion_alm_24x24.png" align="absmiddle"> Nueva Devoluci&oacute;n Almacenes</button>';
            $template = $this->setNuevoFormDevolucion($template);
            $content_tab = str_replace('{botones_documento}', $botones_cabecera, $content_tab);
            $content_tab = str_replace('{titulo_3}', 'Nuevas Devoluciones', $content_tab);
            $ingresos='<div id="div_lista_devoluciones_almacenes"><table id="tabla_devolucion_almacenes" class="table_usuario">
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
            $content_tab = str_replace('{content_3}', $ingresos, $content_tab);
            $template = str_replace('{content}', $content_tab, $template);
            $template = $index_view->setFooter($template);
            
            print_r($template);
        }

        /**
         * Metodo que permite crea la nueva vista del ingreso 
         */
    public function setNuevoFormDevolucion($template){
        $form_traspaso = file_get_contents('site/devolucion_tpl/nuevo_form_devolucion_tpl.html');
        $template = str_replace('{dialog_form}', $form_traspaso, $template);
        /*$index_model = new IndexModel();
        $motivo = $index_model->getmotivo();

        $moti = '<select name="ing_motivo" size="1" size="10" id="ing_motivo" style="height:30px">';
        $cont=0;
        foreach($motivo as $key => $motivo){
               $moti = $moti.'<option value="'.$motivo['gral_param_propios']['GRAL_PAR_PRO_COD'].'" >'.$motivo['gral_param_propios']['GRAL_PAR_PRO_DESC'].'</option>';
        }
        $moti = $moti.'</select>';
        $template = str_replace('{tipo_motivo}', $moti, $template);
      
        $destino = $index_model->getDestino();

        $dest = '<select name="ing_destino" size="1" size="10" id="ing_destino" style="height:30px">';
        $cont=0;
        foreach($destino as $key => $destino){
               $dest = $dest.'<option value="'.$destino['gral_agencia']['GRAL_AGENCIA_CODIGO'].'" >'.$destino['gral_agencia']['GRAL_AGENCIA_NOMBRE'].'</option>';
        }
        $dest = $dest.'</select>';
        $template = str_replace('{destino}', $dest, $template);*/
        return $template;   
    }

     /**
         * Metodo que permite crea la nueva vista del ingreso de detalle
         */
    /*public function setNuevoFormIngresoDetalle($template){
        $form_ingreso_det = file_get_contents('site/ingreso_tpl/nuevo_form_ingreso_det_tpl.html');
        $template = str_replace('{dialog_form_1}', $form_ingreso_det, $template);

        
        $index_model = new IndexModel();
        $unidad = $index_model->getunidad();

        $unit = '<select name="ing_unidad" size="1" size="10" id="ing_unidad" style="height:30px">';
        $cont=0;
        foreach($unidad as $key => $unidad){
               $unit = $unit.'<option value="'.$unidad['gral_param_propios']['GRAL_PAR_PRO_COD'].'" >'.$unidad['gral_param_propios']['GRAL_PAR_PRO_DESC'].'</option>';
        }
        $unit = $unit.'</select>';
        $template = str_replace('{unidad}', $unit, $template);
        

        return $template;   
    }*/

    /**
         * Metodo que permite crea la nueva vista del ingreso de detalle
         */
    /*public function setModificarFormIngresoDetalle($template){
        $form_ingreso_det = file_get_contents('site/ingreso_tpl/nuevo_form_ingreso_detalle_tpl.html');
        $template = str_replace('{dialog_form_2}', $form_ingreso_det, $template);
        $index_model = new IndexModel();
        $motivo = $index_model->getmotivo();

        $moti = '<select name="ing_motivo_edit" size="1" size="10" id="ing_motivo_edit" style="height:30px">';
        $cont=0;
        foreach($motivo as $key => $motivo){
               $moti = $moti.'<option value="'.$motivo['gral_param_propios']['GRAL_PAR_PRO_COD'].'" >'.$motivo['gral_param_propios']['GRAL_PAR_PRO_DESC'].'</option>';
        }
        $moti = $moti.'</select>';
        $template = str_replace('{tipo_motivo}', $moti, $template);
      
        $destino = $index_model->getDestino();

        $dest = '<select name="ing_destino_edit" size="1" size="10" id="ing_destino_edit" style="height:30px">';
        $cont=0;
        foreach($destino as $key => $destino){
               $dest = $dest.'<option value="'.$destino['gral_agencia']['GRAL_AGENCIA_CODIGO'].'" >'.$destino['gral_agencia']['GRAL_AGENCIA_NOMBRE'].'</option>';
        }
        $dest = $dest.'</select>';
        $template = str_replace('{destino}', $dest, $template);
        return $template;   
    }*/


  /**
         * Metodo que permite crea la nueva vista del ingreso de detalle
         */
    /*public function setModificarFormIngresoDet($template){
        $form_ingreso_mod_det = file_get_contents('site/ingreso_tpl/nuevo_form_ingreso_mod_detalle_tpl.html');
        $template = str_replace('{dialog_form_3}', $form_ingreso_mod_det, $template);
        return $template;   
    }*/

}
?>