<?php
	ob_start();
	session_start();
  if(!isset($_SESSION['login']) || !isset($_SESSION['clave'])){
    header("Location: index.php?error=1");
} else {
	require('configuracion.php');
    require('funciones.php');
?>
<!DOCTYPE HTML>


<html>
    <head>
      <!--Titulo de la pestaña de la pagina-->
        <title>CONSULTA DE PRODUCTOS</title>
        <meta charset="UTF-8">
        <link href="css/estilo.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
        <script language="javascript" src="script/validarForm.js"></script> 
         <script type="text/javascript" src="js/ClienteManteDetalle.js"></script>  
        <link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
        <script src="script/jquery-ui.js"></script>
        <script type="text/javascript" src="js/calendario.js"></script>
        <script type="text/javascript" src="js/Alm_prod_consul.js"></script>
        <script type="text/javascript" src="js/Utilitarios.js"></script>
    </head>
    <body>
        <?php
            include("header.php");
        ?>
    	<div id="pagina_sistema">
         
            <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                 </li>
                 <li id="menu_modulo_general_alamacen">
                    <img src="img/box_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. ALMACENES
                          
                 </li>
                  <li id="menu_modulo_mante_productos">
                    <img src="img/stuff_32x32.png" border="0" alt="Modulo" align="absmiddle"> MANT. PRODUCTOS
                 </li>
                 <li id="menu_consul_prod">
                    <img src="img/search_prod_32x32.png" border="0" alt="Modulo" align="absmiddle"> CONSULTA PRODUCTO
                </li>
            </ul> 
              
           <div id="contenido_modulo">
              <h2> <img src="img/search_prod_64x64.png" border="0" alt="Modulo" align="absmiddle"> CONSULTAR LISTA DE PRODUCTOS</h2>
              <hr style="border:1px dashed #767676;">
            <div id="dialog-confirm" title="Dar de baja producto" style="display:none;">
              <p><img src="img/alert_48x48.png" align="absmiddle">Realmente quiere dar de baja el producto?</p>
            </div>  
<!-- codigo para un buscador-->
         
            <div id="content">
              <!--form autocomplete="off"-->
                <p>
                   <label>Consultar Producto:</label>
                  <input class="txt_campo" type="text" name="producto_buscar" id="producto_buscar" />
                  <input type="button" value="Buscar Producto" class="btn_form" onClick="buscarProducto();">
                </p>
              <!--/form-->
            </div>
<!-- buscador-->

            <div id="tabla_datos_productos">
                <table class="table_usuario">
                    <tr>
                        <th>CODIGO</th>
                        <th>NOMBRE</th>
                        <th>TIPO</th>
                        <th>MARCA</th>
                        <th>CANTIDAD</th>
                        <th>PRECIO COMPRA</th>
                        <th>PRECIO VENTA</th>
                        <th>SUCURSAL ORG</th>
                        <th>ESTADO</th>
                        <th>ACCIONES</th>
                    </tr>
               <?php
               $consulta = "SELECT alm_prod_codigo,alm_prod_nombre,alm_prod_marca,alm_prod_tipo,
			                sum(alm_prod_cantidad_stock),alm_prod_suc_origen ,alm_prod_unidad ,
                            alm_prod_prec_compra,alm_prod_prec_venta,alm_prod_estado,alm_prod_id
                            FROM alm_producto
                            WHERE alm_prod_usr_baja is null and 
								alm_prod_estado <> 9  group by alm_prod_codigo order by alm_prod_nombre";
               $resultado = mysql_query($consulta);
               while ($linea = mysql_fetch_array($resultado)) {
                     ?>
                     <tr class="tr_usuario">
                        <td><?php echo $linea['alm_prod_codigo']; ?>&nbsp;</td>
                        <td><?php echo $linea['alm_prod_nombre']; ?>&nbsp;</td>
                        <td><?php 
                          $tipo_consul = "SELECT GRAL_PAR_PRO_COD, GRAL_PAR_PRO_DESC
                                          FROM gral_param_propios
                                          WHERE gral_par_pro_grp=1000 AND 
										  GRAL_PAR_PRO_COD = ".$linea['alm_prod_tipo'];
                          $res_tipo = mysql_query($tipo_consul);
                          $tipo = mysql_fetch_array($res_tipo);
                          echo $tipo[1]; ?>&nbsp;<input type="hidden" value="<?php echo $tipo[0];?>" id="id_tipo_producto"></td>
                        <td><?php echo $linea['alm_prod_marca']; ?>&nbsp;</td>
                        <td><?php echo $linea['sum(alm_prod_cantidad_stock)']; ?> (<?php 
                              $tipo_consul = "SELECT GRAL_PAR_PRO_COD, GRAL_PAR_PRO_DESC
                                              FROM gral_param_propios
                                              WHERE  gral_par_pro_grp=1100 AND 
											  GRAL_PAR_PRO_COD = ".$linea['alm_prod_unidad'];
                              $res_tipo = mysql_query($tipo_consul);
                              $unidad = mysql_fetch_array($res_tipo);
                              echo $unidad['GRAL_PAR_PRO_DESC']; ?>&nbsp;<input type="hidden" value="<?php echo $unidad[0];?>" id="id_unidad_prod" >)</td>
                        <td><?php echo $linea['alm_prod_prec_compra']; ?>&nbsp;</td>
                        <td><?php echo $linea['alm_prod_prec_venta']; ?>&nbsp;</td>
                        <td><?php 
                              $tipo_consul = "SELECT GRAL_AGENCIA_CODIGO, GRAL_AGENCIA_NOMBRE
                                              FROM gral_agencia
                                              WHERE GRAL_AGENCIA_CODIGO =".$linea['alm_prod_suc_origen'];
                              $res_tipo = mysql_query($tipo_consul);
                              $sucursal = mysql_fetch_array($res_tipo);
                              echo $sucursal['GRAL_AGENCIA_NOMBRE']; ?>&nbsp;<input type="hidden" value="<?php echo $sucursal[0];?>" id="id_agencia_org"></td>
                        <td>
                          <?php
                             $tipo_consul = "SELECT GRAL_PAR_PRO_DESC
                                              FROM gral_param_propios 
                                              WHERE gral_par_pro_grp=1200 AND GRAL_PAR_PRO_COD >= 1 AND                                              GRAL_PAR_PRO_COD=".$linea['alm_prod_estado'];

                              $res_estado = mysql_query($tipo_consul);
                              $estado  = mysql_fetch_array($res_estado);
                              echo $estado['GRAL_PAR_PRO_DESC'];
                          ?>
                        </td>
              <td><div style="float:left; width:42px; text-align:center; margin-left:0px; margin-right:2px;"><a href="alm_detallar_prod.php?id_producto=<?php echo $linea['alm_prod_id'];?>" ><img src="img/notepad_32x32.png" align="absmiddle"> Detallar</a></div><div style="float:left; width:40px; text-align:center; cursor:pointer;"> <a  onclick="mostrarDialogo(<?php echo $linea['alm_prod_id'];?>)"><img src="img/delete box_32x32.png"> Dar de Baja</a></div> </td>
                    </tr> 
                     <?php
                }
                ?>
                </table>
            </div>

            </div>
    	</div>
        <?php
            include("footer_in.php");
        ?>
    </body>
</html>
<?php
}
ob_end_flush();
 ?>