<?php
ob_start(); // Esta es por seguridad
session_start();
if(!isset($_SESSION['login']) || !isset($_SESSION['clave'])){
        header("Location: ../index.php?error=1");
} else {
	require_once 'cabecera.php';
	require_once 'clases/Productos.php';
	require_once 'clases/MenuDinamico.php';

?>
	<div id="pagina_sistema">
    <?php
		$menu = new MenuDinamico();
		$enlaces = array('modulo' => array('enlace' =>'../menu_s.php', 'imagen'=>'../img/app folder_32x32.png', 'titulo' => 'MODULOS'),
		                 'importacion' => array('enlace' =>'../modulo.php?modulo=20000', 'imagen'=>'../img/box_32x32.png', 'titulo' => 'ALMACENES'),
						         'gestion' => array('enlace' =>'#', 'imagen'=>'../img/almacen_32x32.png', 'titulo' => 'GESTION ALM.'));			 
		$menu->getMenuDinamico($enlaces);
	?>    
        <div id="contenido_modulo">
             <h2>   
                <img src="../img/almacen_64x64.png" border="0" alt="Modulo" align="absmiddle"> 
                 GESTION DE PRODUCTOS       
            </h2>
            <hr style="border:1px dashed #767676;">
<!-- codigo para un buscador-->
            <div id="content">

                  <!--form autocomplete="off"-->
                    <p>
                    <input type="button" value="Nuevo Producto" class="btn_form" onClick="new GestionProductos().nuevoProducto();">
                     <br>  <label>Buscar:</label>
                      <input class="txt_campo" type="text" name="producto_buscar" id="producto_buscar" style="width:300px;"/>
                      <input type="button" value="Buscar Producto" class="btn_form" onClick="new GestionProductos().buscarProductoBtn();">
                    </p>
                  <!--/form-->
            </div>        <!--hr style="border:1px dashed #767676;"-->
           <div id="tabla_datos_produstos">
               <table   class="table_usuario" >
                            <tr>
                                <th align="center">CODIGO</th>
                                <th align="center">NOMBRE</th>
                                <th align="center">TIPO</th>
                                <th align="center">CANTIDAD</th>
                                <!--th align="center">PRECIO DE COMPRA</th>
                                <th align="center">PRECIO DE VENTA</th-->
                                <th align="center">SUCURSAL ORIGEN</th>
                                <th align="center">ESTADO</th>
                                <th align="center">FECHA PROCESO</th>
                                <th align="center">EDITAR</th> 
                                 <th align="center">ELIMINAR</th> 
                            </tr> 
						  <?php
                        $productos = new Productos(); // Aqui se lo instancia
                        $util = new Utilitarios();

                          $lista_productos = $productos->listaProductosExistentes();
							             //print_r($lista_productos);
                              foreach($lista_productos as $key => $prod){ //print_r($prod);
                       ?>
                                <tr class="tr_usuario">
                                            <td align="center"><?php echo $prod['pc']['alm_prod_cab_codigo']; ?> </td>
                                            <td align="left"><?php echo $prod['pc']['alm_prod_cab_nombre']; ?></td>
                                            <td align="center"><?php echo $prod[0]['Tipo']; ?></td>
                                            <td align="center"><?php echo $prod[0]['cantidad']; ?> </td>
                                            <!--td align="center"><?php //echo $prod['pd']['alm_prod_det_prec_compra']; ?></td>
                                            <td align="center"><?php //echo $prod['pd']['alm_prod_det_prec_venta']; ?></td-->
                                            <td align="center"><?php echo $prod[0]['AGE_ORIG']; ?></td>
                                            <td align="center"><?php echo $prod[0]['ESTADO']; ?></td>
                                              <td align="center"><?php echo $util->cambiaf_a_normal($prod['pc']['alm_prod_cab_fecha_proceso']); ?></td>
                                            
                                            <td align="center"><div style="cursor:pointer"><a  onClick="new GestionProductos().ModificarProducto('<?php echo $prod['pc']['alm_prod_cab_id_unico_prod'];?>','<?php echo $prod['pc']['alm_prod_cab_nombre'];?>');" > <img src="../img/notepad_32x32.png" align="absmiddle"><br>Modificar</a></div></td>
                                            <td align="center"><div style="cursor:pointer"><a  onClick="new GestionProductos().EliminarProducto('<?php echo $prod['pc']['alm_prod_cab_id_unico_prod'];?>','<?php echo $prod['pc']['alm_prod_cab_nombre'];?>');" > <img src="../img/delete_32x32.png" align="absmiddle"><br>Eliminar</a></div></td> </tr>

                          <?php		
                           }
                      ?>
        </table>
		</div>
	</div>
 </div>
<?php

$productos->desabilitarProducto();
$productos->dialogoMensaje(); // Es de los mensajes 
$productos->modificarProducto();
$productos->eliminarDetProducto();
	require_once 'pie_pagina.php';
}
ob_end_flush(); // Por seguridad
?>