<?php
require_once "app/models/Home.php";
require_once "app/models/Cliente.php";
/**
 * Description of HomeView
 *
 * @author Daniel
 */
class HomeView {
    // Este es el atributo que crea el template de la vista
    private $template;
    /*
     * Este es el metodo constructor de la clase HomeView
     */
    public function __construct() {
        // Aqui todo lo que se define para este constructor
    }
     /*
     * Metodo que permite establecer la cabecera de la pagina
     */
    public function settingHeaders($header){
      require('../configuracion.php');
      require('../funciones.php');
      $header_model = new Home();
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
     * Estos son las configuraciones del title de la pagina
     */
    public function configuracionHead($template){
      $library = Array('title'=>'.::INTERSANITAS SRL::.',
                       'keywords'=>'INSUMOS MEDICOS, MEDICINA, EQUIPOS HOSPITALARIOS, EQUIPO INDUSTRIAL',
                       'description'=>'Sistema de Ventas INTERSANITAS SRL');
      $template = str_replace('{title}', $library['title'], $template);
      $template = str_replace('{keywords}', $library['keywords'], $template);
      $template = str_replace('{description}', $library['description'], $template);

      return $template;

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
                         'ventas' => array('enlace' =>'../modulo.php?modulo=40000', 'imagen'=>'../img/order_32x32.png', 'titulo' => 'VENTAS'),
                         'gestion' => array('enlace' =>'#', 'imagen'=>'../img/ventas_32x32.png', 'titulo' => 'GEST. VENTAS')); 
        $menu = $this->setMenuDinamico($enlaces);
        $template = str_replace('{miga_pan}', $menu, $template);
        return $template;
    }

    /**
     * Este metodo que es el que establece los botones de la cabecera
     */
    public function setHeadBotones($template){
        $menu_header = file_get_contents('app/site/menu_header.html');
        $template = str_replace('{menu_principal}', $menu_header, $template);
        return $template;
    } 
    /*
     * Este es el metodo que ejecuta el template de la vista
     */
    public function runIndex(){
        $template = file_get_contents('app/site/home.html');
        $template = $this->configuracionHead($template);
        $header = file_get_contents('app/site/header.html');
        $header = $this->settingHeaders($header);
        $template = str_replace('{clasejs}', 'app/site/js/Home.js', $template);
        $template = str_replace('{header}', $header, $template);
        $template = str_replace('{clasesegunda}', 'app/site/js/Cliente.js', $template);
        $template = str_replace('{clasetercera}', 'app/site/js/Venta.js', $template);
        $template = $this->setMigaPan($template);
        $template = $this->setHeadBotones($template);
        $template = str_replace('{titulo_modulo}', '<h2 style="margin:0px;"><img border="0" align="absmiddle" alt="GEST. VENTAS" src="../img/ventas_64x64.png">Gesti&oacute;n de Ventas</h2><hr style="border:1px dashed #767676;">', $template);
        $content_tab = file_get_contents('app/site/tab_content.html');
        $botones_cabecera = '<button class="btn_ventas" onclick="new Home().nuevaCotizacionPriv()"> <img src="../img/cotizacion_priv_24x24.png" align="absmiddle"> Nueva Cotizaci&oacute;n Privada</button><button class="btn_ventas" onclick="new Home().nuevaCotizacionPubl()"> <img src="../img/cotizacion_publ_24x24.png" align="absmiddle"> Nueva Cotizaci&oacute;n Publica</button>';
       // $botones_busqueda = '<br><div id="buscar_cliente"><span>Buscar Cotizacion:</span> <input type="text" name="palabra_cliente_buscar" id="palabra_cliente_buscar" class="txt_campo"><input type="button" value="Buscar" class="btn_form" onclick="new Cliente().buscarCliente();"><input type="hidden" name="id_unico_cliente_vent" id="id_unico_cliente_vent">';
        $template = $this->setNuevaFormCotizacion($template);
        $content_tab = str_replace('{botones_documento}', $botones_cabecera, $content_tab);
        //$content_tab = str_replace('{botones_busqueda}', $botones_busqueda, $content_tab);
        $content_tab = str_replace('{titulo_1}', 'Nuevas Cotizaciones Priv.', $content_tab);
        $content_tab = str_replace('{titulo_2}', 'Cotizaciones Pendientes Priv.', $content_tab);
        $content_tab = str_replace('{titulo_3}', 'Nuevas Cotizaciones Publ.', $content_tab);
        $content_tab = str_replace('{titulo_4}', 'Cotizaciones Pendientes Publ.', $content_tab);
        $cotizacion_priv_tpl='<div id="div_lista_cotizaciones_nuevas_priv"><table id="tb_vent_lista_cotizaciones_priv" class="table_usuario">
                            <tr>
                                <th>NRO</th>
                                <th>C&Oacute;DIGO</th>
                                <th>CLIENTE</th>
                                <th>C&Oacute;DIGO CLIENTE</th>
                                <th>OPERADOR</th>
                                <th>FECHA COTIZACION</th>
                                <th>FECHA ENTREGA</th>
                                <th>TIPO COMPRA</th>
                                <th>FORMA DE PAGO</th>                                
                                <th>DETALLAR</th>
                                <th>EDITAR</th>
                                <th>ELIMINAR</th>
                            </tr></table></div>';
        $content_tab = str_replace('{content_1}', $cotizacion_priv_tpl, $content_tab);
        $cotizacion_priv_pend_tpl='<div id="div_lista_cotizaciones_pend_priv"><table id="tb_vent_lista_cotizaciones_priv_pend" class="table_usuario">
                            <tr>
                                <th>NRO</th>
                                <th>C&Oacute;DIGO</th>
                                <th>CLIENTE</th>
                                <th>C&Oacute;DIGO CLIENTE</th>
                                <th>OPERADOR</th>
                                <th>FECHA COTIZACION</th>
                                <th>FECHA ENTREGA</th>
                                <th>TIPO COMPRA</th>
                                <th>FORMA DE PAGO</th>                                
                                <th>DETALLAR</th>
                                <th>EDITAR</th>
                                <th>ELIMINAR</th>
                            </tr></table></div>';
        $content_tab = str_replace('{content_2}', $cotizacion_priv_pend_tpl, $content_tab);
        $cotizacion_publ_tpl='<div id="div_lista_cotizaciones_nuevas_publ"><table id="tb_vent_lista_cotizaciones_publ" class="table_usuario">
                            <tr>
                                <th>NRO</th>
                                <th>C&Oacute;DIGO</th>
                                <th>CLIENTE</th>
                                <th>C&Oacute;DIGO CLIENTE</th>
                                <th>OPERADOR</th>
                                <th>FECHA COTIZACION</th>
                                <th>FECHA ENTREGA</th>
                                <th>TIPO COMPRA</th>
                                <th>FORMA DE PAGO</th>                                
                                <th>DETALLAR</th>
                                <th>EDITAR</th>
                                <th>ELIMINAR</th>
                            </tr></table></div>';
        $content_tab = str_replace('{content_3}', $cotizacion_publ_tpl, $content_tab);
        $cotizacion_publ_pend_tpl='<div id="div_lista_cotizaciones_pend_publ"><table id="tb_vent_lista_cotizaciones_publ_pend" class="table_usuario">
                            <tr>
                                <th>NRO</th>
                                <th>C&Oacute;DIGO</th>
                                <th>CLIENTE</th>
                                <th>C&Oacute;DIGO CLIENTE</th>
                                <th>OPERADOR</th>
                                <th>FECHA COTIZACION</th>
                                <th>FECHA ENTREGA</th>
                                <th>TIPO COMPRA</th>
                                <th>FORMA DE PAGO</th>                                
                                <th>DETALLAR</th>
                                <th>EDITAR</th>
                                <th>ELIMINAR</th>
                            </tr></table></div>';
        $content_tab = str_replace('{content_4}', $cotizacion_publ_pend_tpl, $content_tab);
        $template = str_replace('{content}', $content_tab, $template);
        $template = $this->setFooter($template);
        print($template);
    }

    /**
     * Metodo que configura el footer de las ventas
     */
    public function setFooter($template){
        $footer = file_get_contents('app/site/footer.html');
        $marca = "&copy; ".date("Y")." ARGO <b>SI</b>";
        $footer = str_replace('{footer_log}', $marca, $footer);
        $template = str_replace('{footer}', $footer, $template);
        return $template;
    }

    /**
     * Metodo que permite crea la nueva vista
     */
    public function setNuevaFormCotizacion($template){
        $form_cotizacion_priv = file_get_contents('app/site/cotizacion_tpl/nueva_form_cotizacion_priv_tpl.html');
        $form_det_cot_priv = file_get_contents('app/site/cotizacion_tpl/nuevo_detalle_form_cotizacion_priv_tpl.html');
        $form_prod_det_cot_priv = file_get_contents('app/site/cotizacion_tpl/nuevo_prod_cotizacion_priv_tpl.html');
        $form_modif_cotizacion = file_get_contents('app/site/cotizacion_tpl/modif_form_cotizacion_priv_tpl.html');
        $form_cotizacion_publ = file_get_contents('app/site/cotizacion_tpl/nueva_form_cotizacion_publ_tpl.html');
        $form_modif_cotizacion_publ = file_get_contents('app/site/cotizacion_tpl/modif_form_cotizacion_publ_tpl.html');
        $form_cliente_priv = file_get_contents('app/site/cliente_tpl/nuevo_form_cliente_boton_tpl.html');
        $form_cliente_publ = file_get_contents('app/site/cliente_tpl/nuevo_form_cliente_boton_publ_tpl.html');
        $form_nuevo_item_tpl = file_get_contents('app/site/cotizacion_tpl/nuevo_prod_item_detalle_cotizacion_tpl.html');
        $form_dialog_tpl = file_get_contents('app/site/cotizacion_tpl/dialog_confirm_cot_tpl.html');
        $form_dialog_01_tpl = file_get_contents('app/site/cotizacion_tpl/dialog_confirm_cot_01_tpl.html');
        $form_dialog_confirm = file_get_contents('app/site/cotizacion_tpl/dialogo_confirm.html');
        $template = str_replace('{dialog_form}', $form_dialog_confirm.$form_dialog_01_tpl.$form_nuevo_item_tpl.$form_cotizacion_priv.$form_det_cot_priv.$form_prod_det_cot_priv.$form_modif_cotizacion.$form_cotizacion_publ.$form_cliente_publ.$form_cliente_priv.$form_modif_cotizacion_publ.$form_dialog_tpl, $template);
        $home= new Home();
        $tipo_compra=$home->getTipoCompra();
        //print_r($tipo_compra);
        $tcom = '<select name="tipo_compra" size="1" size="10" id="tipo_compra" style="height:30px">';
        $cont=0;
        foreach($tipo_compra as $key => $tipo_compra){
               $tcom = $tcom.'<option value="'.$tipo_compra['gral_param_propios']['GRAL_PAR_PRO_COD'].'" >'.$tipo_compra['gral_param_propios']['GRAL_PAR_PRO_DESC'].'</option>';
        }
        $tcom = $tcom.'</select>';
        $template = str_replace('{tipo_compra}', $tcom, $template);
        
        $forma_pago=$home->getFormaPago();
        //print_r($forma_pago);
        $fpago = '<select name="forma_pago" size="1" size="10" id="forma_pago" style="height:30px">';
        $cont=0;
        foreach($forma_pago as $key => $forma_pago){
               $fpago = $fpago.'<option value="'.$forma_pago['gral_param_propios']['GRAL_PAR_PRO_COD'].'" >'.$forma_pago['gral_param_propios']['GRAL_PAR_PRO_DESC'].'</option>';
        }
        $fpago = $fpago.'</select>';
        $template = str_replace('{form_pago}', $fpago, $template);

        $tipo_prod=$home->getTipoProd();
        //print_r($forma_pago);
        $tprod = '<select name="tipo_prod" size="1" size="10" id="tipo_prod" style="height:30px">';
        $cont=0;
        foreach($tipo_prod as $key => $tipo_prod){
               $tprod = $tprod.'<option value="'.$tipo_prod['gral_param_propios']['GRAL_PAR_PRO_COD'].'" >'.$tipo_prod['gral_param_propios']['GRAL_PAR_PRO_DESC'].'</option>';
        }
        $tprod = $tprod.'</select>';
        $template = str_replace('{tipo_prod}', $tprod, $template);

        $estado_prod=$home->getEstadoProd();
        //print_r($forma_pago);
        $eprod = '<select name="estado_prod" size="1" size="10" id="estado_prod" style="height:30px">';
        $cont=0;
        foreach($estado_prod as $key => $estado_prod){
               $eprod = $eprod.'<option value="'.$estado_prod['gral_param_propios']['GRAL_PAR_PRO_COD'].'" >'.$estado_prod['gral_param_propios']['GRAL_PAR_PRO_DESC'].'</option>';
        }
        $eprod = $eprod.'</select>';
        $template = str_replace('{estado_prod}', $eprod, $template);

         $serv_nec_prod=$home->getServiciosNec();
        //print_r($forma_pago);
        $sprod = '<select name="serv_nec_prod" size="1" size="10" id="serv_nec_prod" style="height:30px">';
        $cont=0;
        foreach($serv_nec_prod as $key => $serv_nec_prod){
               $sprod = $sprod.'<option value="'.$serv_nec_prod['gral_param_propios']['GRAL_PAR_PRO_COD'].'" >'.$serv_nec_prod['gral_param_propios']['GRAL_PAR_PRO_DESC'].'</option>';
        }
        $sprod = $sprod.'</select>';
        $template = str_replace('{serv_nec_prod}', $sprod, $template);

        /*$cliente= new Cliente();
        $lista_clientes=$cliente->listaTodosClientes();
        //print_r($lista_clientes);
        $client_list = '<select name="lista_clientes" size="1" size="10" id="lista_clientes" style="height:30px">';
        $cont=0;
        foreach($lista_clientes as $key => $lista_clientes){
                 $client_list = $client_list.'<option value="'.$lista_clientes['vent_cliente']['vent_cli_codigo_cliente'].'" >'.$lista_clientes['vent_cliente']['vent_cli_nombre'].'&nbsp;'.$lista_clientes['vent_cliente']['vent_cli_apellido_pat'].'&nbsp;'.$lista_clientes['vent_cliente']['vent_cli_apellido_mat'].'</option>';
        }
        $client_list = $client_list.'</select>';
        $template = str_replace('{cod_cliente}', $client_list, $template);*/

        return $template;
    }
   
}

?>
