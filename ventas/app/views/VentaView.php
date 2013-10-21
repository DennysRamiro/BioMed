<?php
require_once "app/models/Venta.php";
require_once 'app/views/HomeView.php';
/**
 * Description of HomeView
 *
 * @author Daniel
 */
class VentaView {
    // Este es el atributo que crea el template de la vista
    private $template;
    /*
     * Este es el metodo constructor de la clase HomeView
     */
    public function __construct() {
        // Aqui todo lo que se define para este constructor
    }
    /*
     * Este es el metodo que ejecuta el template de la vista
     */
    public function runIndex(){
        $home_view = new HomeView();
        $template = file_get_contents('app/site/home.html');
        $template = $home_view->configuracionHead($template);
        $header = file_get_contents('app/site/header.html');
        $header = $home_view->settingHeaders($header);
        $template = str_replace('{clasejs}', 'app/site/js/Home.js', $template);
        $template = str_replace('{clasesegunda}', 'app/site/js/Cliente.js', $template);
         $template = str_replace('{clasetercera}', 'app/site/js/Venta.js', $template);
        $template = str_replace('{header}', $header, $template);
        $template = $home_view->setMigaPan($template);
        $template = $home_view->setHeadBotones($template);
        $template = str_replace('{titulo_modulo}', '<h2 style="margin:0px;"><img border="0" align="absmiddle" alt="GEST. VENTAS" src="../img/ventas_64x64.png">Gesti&oacute;n de Ventas</h2><hr style="border:1px dashed #767676;">', $template);
        $content_tab = file_get_contents('app/site/tab_content.html');
        $botones_cabecera = '<button class="btn_ventas" onclick="new Home().nuevaVentaPrivada()"> <img src="../img/paste_24x24.png" align="absmiddle"> Nueva Venta Privada</button><button class="btn_ventas" onclick="new Home().nuevaVentaPublica()"> <img src="../img/paste_24x24.png" align="absmiddle"> Nueva Venta Publica</button>';
        $template = $this->setNuevaFormVenta($template);
        $content_tab = str_replace('{botones_documento}', $botones_cabecera, $content_tab);
        $content_tab = str_replace('{titulo_1}', 'Ventas Privadas', $content_tab);
        $content_tab = str_replace('{titulo_2}', 'Ventas Publicas', $content_tab);
        $venta_priv_tpl='<div id="div_lista_venta_nuevas_priv"><table id="tb_ventas_lista_priv" class="table_usuario">
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
                                
                            </tr></table></div>';
        $content_tab = str_replace('{content_1}', $venta_priv_tpl, $content_tab);
        $template = str_replace('{content}', $content_tab, $template);
        $template = $home_view->setFooter($template);
        print($template);
    }

     /**
     * Metodo que permite crea la nueva vista
     */
    public function setNuevaFormVenta($template){
        $form_venta_privada = file_get_contents('app/site/venta_tpl/nuevo_detalle_form_ventas_priv_tpl.html');
        $form_dialog_vent_tpl = file_get_contents('app/site/venta_tpl/dialog_confirm_vent_tpl.html');
        $form_mod_ventas_tpl = file_get_contents('app/site/venta_tpl/modif_form_ventas_priv_tpl.html');
        
        $template = str_replace('{dialog_form}', $form_venta_privada.$form_dialog_vent_tpl.$form_mod_ventas_tpl, $template);
        return $template;
       
    }

}

?>
