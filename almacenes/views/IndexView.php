<?php
  require_once "models/IndexModel.php";

	/**
	 *
	 */
	class IndexView{
		/**
		 * Comentarios del constructor
		 */
		public function __construct() {
        	// definir variables propias de la clase
    }
    /**
     * Estos son las configuraciones del title de la pagina
     */
    public function configuracionHead($template){
      $library = Array('title'=>'.::INTERSANITAS SRL::.',
                       'keywords'=>'INSUMOS MEDICOS, MEDICINA, EQUIPOS HOSPITALARIOS, EQUIPO INDUSTRIAL',
                       'description'=>'INTERSANITAS SRL');
      $template = str_replace('{title}', $library['title'], $template);
      $template = str_replace('{keywords}', $library['keywords'], $template);
      $template = str_replace('{description}', $library['description'], $template);
      return $template;
    }
    /*
     * Metodo que permite establecer la cabecera de la pagina
     */
    public function settingHeaders($header){
      require('../configuracion.php');
      require('../funciones.php');
      header("Expires: Tue, 01 Jul 2001 06:00:00 GMT");
      header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
      header("Cache-Control: no-store, no-cache, must-revalidate");
      header("Cache-Control: post-check=0, pre-check=0", false);
      header("Pragma: no-cache");
      $header_model = new IndexModel();
      $empresa = $header_model->getEmpresa();
      $_SESSION['COD_EMPRESA']=$empresa[0]['gral_empresa']['GRAL_EMP_NOMBRE'];
      $_SESSION['EMPRESA_TIPO']=$empresa[0]['gral_empresa']['GRAL_EMP_CENTRAL'];
      $cadena = '<b>USUARIO:  </b>';
      $cadena = $cadena.$_SESSION['nombres'];
        $log = $_SESSION['login']; 
        $cadena = $cadena.'<br><b> AGENCIA:  </b>'.leer_agencia_usr($log).'<br><b> FECHA PROCESO:  </b>';
        $ag_usr = $_SESSION['COD_AGENCIA'];
        $fecha = leer_fecha_proc($ag_usr);
        $_SESSION['fec_proc'] = $fecha;
        $tc_cont = leer_tipo_cam();
        $cadena = $cadena.$fecha.encadenar(2)."<br><b>TC CONTABLE:</b> ".number_format($_SESSION['TC_CONTAB'], 2, '.',',');
      $header = str_replace('{datos_header}',$cadena , $header);
      return $header;
    }
    /**
     * Este es el menu dinamico para que se pueda crear en la parte superior
     */
    public function setMenuDinamico($enlaces){
        $menu = '<ul id="lista_menu">';      
        foreach($enlaces as $key => $value){
            $menu  = $menu.'<li id="menu_dinamico">
                                <a href="'.$value['enlace'].'"><img src="'.$value['imagen'].'" border="0" alt="'.$value['titulo'].'" align="absmiddle"> '.$value['titulo'].'</a>
                            </li>';
        }
        $menu = $menu.'</ul>';
        return $menu; 
    }    
    /**
     * Metodo que permite  generar la miga de pan para el menu dinamico
     */
    public function setMigaPan($template){
        $enlaces = array('modulo' => array('enlace' =>'../menu_s.php', 'imagen'=>'../img/app folder_32x32.png', 'titulo' => 'MODULOS'),
                         'almacen' => array('enlace' =>'../modulo.php?modulo=20000', 'imagen'=>'../img/box_32x32.png', 'titulo' => 'ALMACENES'),
                         'gestion' => array('enlace' =>'#', 'imagen'=>'../img/almacen_32x32.png', 'titulo' => 'GEST. ALM')); 
        $menu = $this->setMenuDinamico($enlaces);
        $template = str_replace('{miga_pan}', $menu, $template);
        return $template;
    }
    /**
     * Este metodo que es el que establece los botones de la cabecera
     */
    public function setHeadBotones($template){
        $menu_header = file_get_contents('site/menu_header.html');
        $template = str_replace('{menu_principal}', $menu_header, $template);
        return $template;
    } 

    public function runIndex(){
    	 
        $template = file_get_contents('site/home.html');
        $template = $this->configuracionHead($template);
        $header = file_get_contents('../ventas/app/site/header.html');
        $header = $this->settingHeaders($header);
        $template = str_replace('{clasejs}', 'site/js/Index.js', $template);
        $template = str_replace('{header}', $header, $template);
        $template = str_replace('{clasesegunda}', 'site/js/Egreso.js', $template);
        $template = str_replace('{clasetercera}', 'site/js/Traspaso.js', $template);
        $template = str_replace('{clasecuarta}', 'site/js/Devolucion.js', $template);
        $template = $this->setMigaPan($template);
        $template = $this->setHeadBotones($template);
        $template = str_replace('{titulo_modulo}', '<h2 style="margin:0px;"><img border="0" align="absmiddle" alt="GEST. ALMACENES" src="../img/almacen_64x64.png">Gesti&oacute;n de Almacenes</h2><hr style="border:1px dashed #767676;">', $template);
        $content_tab = file_get_contents('site/tab_content.html');
        $botones_cabecera = '<button class="btn_ventas" onclick="new Index().nuevoIngresoAlmacenes();"> <img src="../img/alm_ing_24x24.png" align="absmiddle"> Nuevo Ingreso</button>'; //<button class="btn_ventas" onclick="new Egreso().nuevaEgresoAlmacenes()"> <img src="../img/alm_egr_24x24.png" align="absmiddle"> Nuevo Egreso</button><button class="btn_ventas" onclick="new Home().nuevaTraspasoAlmacenes()"> <img src="../img/alm_ing_24x24.png" align="absmiddle"> Nuevo Traspaso</button><button class="btn_ventas" onclick="new Home().nuevaDevolucionAlmacenes()"> <img src="../img/alm_ing_24x24.png" align="absmiddle"> nueva Devolución</button>
        $template = $this->setNuevoFormIngreso($template);
        $content_tab = str_replace('{botones_documento}', $botones_cabecera, $content_tab);
        $content_tab = str_replace('{titulo_1}', 'NUEVOS INGRESOS', $content_tab);
        $content_tab = str_replace('{titulo_2}', 'INGRESOS POR CONFIRMAR', $content_tab);
        $ingresos='<div id="div_lista_ingreso_almacenes"><table id="tabla_ingreso_almacenes" class="table_usuario">
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
                        </tr></table></div>';
        $content_tab = str_replace('{content_1}', $ingresos, $content_tab);
        $confirmar='<div id="div_lista_ingresos_por_confirmar">
                      <table id="ingresos_por_confirmar" class="table_usuario">
                        <tr><th>NRO</th>
                            <th>CODIGO</th>
                            <th>NOMBRE</th>
                            <th>MOTIVO</th>
                            <th>DESTINO</th>
                            <th>ORIGEN</th>
                            <th>FECHA</th>
                            <th>ESTADO</th>
                            <th>EDITAR</th>
                            <th>ELIMINAR</th>
                        </tr>
                      </table>
                    </div>';
        $content_tab = str_replace('{content_2}', $confirmar, $content_tab);
        $template = str_replace('{content}', $content_tab, $template);
        $template = $this->setFooter($template);
        print_r($template);
    }

	  /**
     * Metodo que configura el footer de las ventas
     */
    public function setFooter($template){
        $footer = file_get_contents('../ventas/app/site/footer.html');
        $marca = "&copy; ".date("Y")." ARGO <b>SI</b>";
        $footer = str_replace('{footer_log}', $marca, $footer);
        $template = str_replace('{footer}', $footer, $template);
        return $template;
    }

        /**
         * Metodo que permite crea la nueva vista del ingreso 
         */
    public function setNuevoFormIngreso($template){
        $form_ingreso = file_get_contents('site/ingreso_tpl/nuevo_form_ingreso_tpl.html');
        $form_dialog_tpl = file_get_contents('site/ingreso_tpl/dialog_confirm_cantidad_tpl.html');
        $form_dialog_ingreso_tpl = file_get_contents('site/ingreso_tpl/dialog_confirm_ingreso_tpl.html');
        $dialogo_confirm = file_get_contents('site/ingreso_tpl/dialogo_confirm.html');
        $form_dialog_ingreso_detalle_tpl = file_get_contents('site/ingreso_tpl/dialog_confirm_ingreso_detalle_tpl.html');
        $form_ingreso_det = file_get_contents('site/ingreso_tpl/nuevo_form_ingreso_det_tpl.html');
        $form_mod_det = file_get_contents('site/ingreso_tpl/nuevo_form_ingreso_mod_det_tpl.html');
        $form_ingreso_detalle = file_get_contents('site/ingreso_tpl/nuevo_form_ingreso_detalle_tpl.html');
        $form_seleccion_detalle_producto_ingresar = file_get_contents('site/ingreso_tpl/seleccion_prod_detalles_tpl.html');
        $template = str_replace('{dialog_form}', $form_ingreso.$dialogo_confirm.$form_dialog_tpl.$form_dialog_ingreso_tpl.$form_ingreso_det.$form_mod_det.$form_ingreso_detalle.$form_dialog_ingreso_detalle_tpl.$form_seleccion_detalle_producto_ingresar, $template);       
        $index_model = new IndexModel();
        
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
        $template = str_replace('{destino}', $dest, $template);
        
        $origen = $index_model->getDestino();

        $orig = '<select name="ing_origen" size="1" size="10" id="ing_origen" style="height:30px">';
        $cont=0;
        foreach($origen as $key => $origen){
               $orig = $orig.'<option value="'.$origen['gral_agencia']['GRAL_AGENCIA_CODIGO'].'" >'.$origen['gral_agencia']['GRAL_AGENCIA_NOMBRE'].'</option>';
        }
        $orig = $orig.'</select>';
        $template = str_replace('{origen}', $orig, $template);
        $dato_usuario = $index_model->getUsuarioDatos($_SESSION['login']);
        $template = str_replace('{nombre_almacenero}', $dato_usuario[0]['gral_usuario']['GRAL_USR_NOMBRES']." ".$dato_usuario[0]['gral_usuario']['GRAL_USR_AP_PATERNO'], $template);
        

        //$index_model = new IndexModel();
        $unidad = $index_model->getunidad();

        $unit = '<select name="ing_unidad" size="1" size="10" id="ing_unidad" style="height:30px">';
        $cont=0;
        foreach($unidad as $key => $unidad){
               $unit = $unit.'<option value="'.$unidad['gral_param_propios']['GRAL_PAR_PRO_COD'].'" >'.$unidad['gral_param_propios']['GRAL_PAR_PRO_DESC'].'</option>';
        }
        $unit = $unit.'</select>';
        $template = str_replace('{unidad}', $unit, $template);

        //$index_model = new IndexModel();

        $unidad = $index_model->getunidad();

        $unit = '<select name="ing_unidad_edit" size="1" size="10" id="ing_unidad_edit" style="height:30px">';
        $cont=0;
        foreach($unidad as $key => $unidad){
               $unit = $unit.'<option value="'.$unidad['gral_param_propios']['GRAL_PAR_PRO_COD'].'" >'.$unidad['gral_param_propios']['GRAL_PAR_PRO_DESC'].'</option>';
        }
        $unit = $unit.'</select>';
        $template = str_replace('{unidad_edit}', $unit, $template);



        //$index_model = new IndexModel();
        
        
          $origen_edit = $index_model->getDestino();


        $orig_edit = '<select name="ing_origen_edit" size="1" size="10" id="ing_origen_edit" style="height:30px">';
        $cont=0;
        foreach($origen_edit as $key => $origen_edit){
               $orig_edit = $orig_edit.'<option value="'.$origen_edit['gral_agencia']['GRAL_AGENCIA_CODIGO'].'" >'.$origen_edit['gral_agencia']['GRAL_AGENCIA_NOMBRE'].'</option>';
        }
        $orig_edit = $orig_edit.'</select>';
        $template = str_replace('{origen_edit}', $orig_edit, $template);
        
      
        $destino_edit = $index_model->getDestino();

        $dest_edit = '<select name="ing_destino_edit" size="1" size="10" id="ing_destino_edit" style="height:30px">';
        $cont=0;
        foreach($destino_edit as $key => $destino_edit){
               $dest_edit = $dest_edit.'<option value="'.$destino_edit['gral_agencia']['GRAL_AGENCIA_CODIGO'].'" >'.$destino_edit['gral_agencia']['GRAL_AGENCIA_NOMBRE'].'</option>';
        }
        $dest_edit = $dest_edit.'</select>';
        $template = str_replace('{destino_edit}', $dest_edit, $template);

        return $template;   
    }

     /**
         * Metodo que permite crea la nueva vista del ingreso de detalle
         */
  /*  public function setNuevoFormIngresoDetalle($template){
       // $form_ingreso_det = file_get_contents('site/ingreso_tpl/nuevo_form_ingreso_det_tpl.html');
        //$form_mod_det = file_get_contents('site/ingreso_tpl/nuevo_form_ingreso_mod_det_tpl.html');
        $template = str_replace('{dialog_form}', $form_ingreso_det, $template);

        
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
        $template = str_replace('{dialog_form}', $form_ingreso_det, $template);
        

        $index_model = new IndexModel();
        
        
          $origen = $index_model->getDestino();


        $orig = '<select name="ing_origen_edit" size="1" size="10" id="ing_origen_edit" style="height:30px">';
        $cont=0;
        foreach($origen as $key => $origen){
               $orig = $orig.'<option value="'.$origen['gral_agencia']['GRAL_AGENCIA_CODIGO'].'" >'.$origen['gral_agencia']['GRAL_AGENCIA_NOMBRE'].'</option>';
        }
        $orig = $orig.'</select>';
        $template = str_replace('{origen}', $orig, $template);
        
        /*$motivo = $index_model->getmotivo();

        $moti = '<select name="ing_motivo_edit" size="1" size="10" id="ing_motivo_edit" style="height:30px">';
        $cont=0;
        foreach($motivo as $key => $motivo){
               $moti = $moti.'<option value="'.$motivo['gral_param_propios']['GRAL_PAR_PRO_COD'].'" >'.$motivo['gral_param_propios']['GRAL_PAR_PRO_DESC'].'</option>';
        }
        $moti = $moti.'</select>';
        $template = str_replace('{tipo_motivo}', $moti, $template);*/
      
    /*    $destino = $index_model->getDestino();

        $dest = '<select name="ing_destino_edit" size="1" size="10" id="ing_destino_edit" style="height:30px">';
        $cont=0;
        foreach($destino as $key => $destino){
               $dest = $dest.'<option value="'.$destino['gral_agencia']['GRAL_AGENCIA_CODIGO'].'" >'.$destino['gral_agencia']['GRAL_AGENCIA_NOMBRE'].'</option>';
        }
        $dest = $dest.'</select>';
        $template = str_replace('{destino}', $dest, $template);
        return $template;   
    }*/

    
     /*   public function setModificarFormIngresoDet($template){
        $form_mod_det = file_get_contents('site/ingreso_tpl/nuevo_form_ingreso_mod_det_tpl.html');
        $template = str_replace('{dialog_form}', $form_mod_det, $template);

        $index_model = new IndexModel();
        $unidad = $index_model->getunidad();

        $unit = '<select name="ing_unidad_edit" size="1" size="10" id="ing_unidad_edit" style="height:30px">';
        $cont=0;
        foreach($unidad as $key => $unidad){
               $unit = $unit.'<option value="'.$unidad['gral_param_propios']['GRAL_PAR_PRO_COD'].'" >'.$unidad['gral_param_propios']['GRAL_PAR_PRO_DESC'].'</option>';
        }
        $unit = $unit.'</select>';
        $template = str_replace('{unidad_edit}', $unit, $template);

        return $template; 
      }*/


}
?>