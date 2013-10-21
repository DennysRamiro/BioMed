<?php
require_once "app/models/Cliente.php";
require_once 'app/views/HomeView.php';
/**
 * Description of HomeView
 *
 * @author Daniel
 */
class ClienteView {
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
        $cliente_model = new Cliente();
        $template = file_get_contents('app/site/home.html');
        $template = $home_view->configuracionHead($template);
        $header = file_get_contents('app/site/header.html');
        $header = $home_view->settingHeaders($header);
        $template = str_replace('{clasejs}', 'app/site/js/Home.js', $template);
        $template = str_replace('{clasesegunda}', 'app/site/js/Cliente.js', $template);
        $template = str_replace('{header}', $header, $template);
        $template = $home_view->setMigaPan($template);
        $template = $home_view->setHeadBotones($template);
        $template = str_replace('{titulo_modulo}', '<h2 style="margin:0px;"><img border="0" align="absmiddle" alt="GEST. VENTAS" src="../img/ventas_64x64.png">Gesti&oacute;n de Ventas</h2><hr style="border:1px dashed #767676;">', $template);
        $content_tab = file_get_contents('app/site/cliente_tpl/tab_clientes.html');
        $botones_cabecera = '<button class="btn_ventas" onclick="new Cliente().nuevoCliente()"> <img src="../img/user office_24x24.png" align="absmiddle"> Nuevo Cliente</button><div id="buscar_cliente"><span>Buscar Cliente:</span> <input type="text" name="palabra_cliente_buscar" id="palabra_cliente_buscar" class="txt_campo"><input type="button" value="Buscar" class="btn_form" onclick="new Cliente().buscarCliente();"><input type="hidden" name="id_unico_cliente_vent" id="id_unico_cliente_vent"></div>';
        $template = $this->setNuevoFormCliente($template);
        $content_tab = str_replace('{botones_documento}', $botones_cabecera, $content_tab);
        $content_tab = str_replace('{titulo_1}', 'Lista de Clientes', $content_tab);
        $cliente_tpl = '<div id="div_detalle_lista_cliente"><table id="tb_vent_lista_clientes" class="table_usuario">
                            <tr>
                                <th>N</th>
                                <th>CODIGO</th>
                                <th>NOMBRE</th>
                                <th>APELLIDO</th>
                                <th>EMPRESA</th>
                                <th>DIRECCION</th>
                                <th>REFERENCIA</th>
                                <th>TELEFONO</th>
                                <th>CELULAR</th>
                                <th>EMAIL</th>
                                <th>EDITAR</th>
                                <th>ELIMINAR</th>
                            </tr></table></div>';
        $content_tab = str_replace('{content_1}', $cliente_tpl, $content_tab);
        $template = str_replace('{content}', $content_tab, $template);
        $template = $home_view->setFooter($template);
        print($template);
    }
    /**
     * Metodo que permite crea la nueva vista
     */
    public function setNuevoFormCliente($template){
        $form_cliente = file_get_contents('app/site/cliente_tpl/nuevo_form_cliente_tpl.html');
        $form_edit_cleinte = file_get_contents('app/site/cliente_tpl/edit_form_cliente_tpl.html');
        $dialog_cliente = file_get_contents('app/site/cliente_tpl/dialog_confirm_tpl.html');
        $template = str_replace('{dialog_form}', $form_cliente.$form_edit_cleinte.$dialog_cliente, $template);
        return $template;   
    }

}

?>
