<?php
ob_start();
session_start();
  if(!isset($_SESSION['login']) || !isset($_SESSION['clave'])){
    header("Location: index.php?error=1");
} else {
  require('configuracion.php');
  require('funciones.php');
?>
<html>
<head>
<!--Titulo de la pestaña de la pagina-->
<title>.:INTERSANITAS:.</title>
        <meta charset="UTF-8">
        <link href="css/estilo.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
        <script language="javascript" src="script/validarForm.js"></script> 
         <!--script type="text/javascript" src="js/ClienteManteDetalle.js"></script-->  
        <link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
        <script src="script/jquery-ui.js"></script>
        <script type="text/javascript" src="js/calendario.js"></script>
        <script type="text/javascript" src="js/Alm_prod_alt.js"></script>
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
                 <li id="menu_alta_prod">
                    <img src="img/add_prod_32x32.png" border="0" alt="Modulo" align="absmiddle">DETALLAR PRODUCTO
                </li>
              </ul> 
  <div id="contenido_modulo">
    <?php
        $consulta = "SELECT * 
                     FROM alm_producto
                     WHERE alm_prod_id=".$_GET['id_producto']." AND 
					 (alm_prod_estado=(SELECT GRAL_PAR_PRO_COD 
                     FROM gral_param_propios WHERE GRAL_PAR_PRO_GRP = 1200 AND 
					 GRAL_PAR_PRO_SIGLA = 'HAB') OR alm_prod_estado=(SELECT 
					 GRAL_PAR_PRO_COD FROM gral_param_propios
					 WHERE GRAL_PAR_PRO_GRP = 1200 AND GRAL_PAR_PRO_SIGLA = 'DESHAB') OR
					 alm_prod_estado = (SELECT GRAL_PAR_PRO_COD 
					 FROM gral_param_propios WHERE GRAL_PAR_PRO_GRP = 1200 AND GRAL_PAR_PRO_SIGLA = 'DET'))";
        $res = mysql_query($consulta);
        $producto = mysql_fetch_array($res);
		$prod_numerico = $producto['alm_prod_numerico'];
		$_SESSION['alm_prod_codigo'] = $producto['alm_prod_codigo'];
		$_SESSION['alm_prod_numerico'] = $producto['alm_prod_numerico'];
      ?>
     <h2>
      <div id="dialog-confirm" title="Dar de baja producto" style="display:none;">
          <p><img src="img/alert_48x48.png" align="absmiddle">Realmente quiere dar de baja el producto?</p>
      </div>  
      <img src="img/add_prod_64x64.png" border="0" alt="Modulo" align="absmiddle">  
                Detallar producto <?php echo $producto['alm_prod_codigo'];?>&nbsp;
				<br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				
				<?php echo utf8_encode($producto['alm_prod_nombre']);?>
      </h2>
            <hr style="border:1px dashed #767676;">
<!--<form name="form2" method="post" action="grab_retro_cli.php" onSubmit="return ValidaCampos(this)">-->
    <form name="form2" method="post" action="alm_registrar_prod.php?tp=actualizar" enctype="multipart/form-data" >
      <table>
          <tr>
              <td valign="top"> <table align="center">
          <tr>
            <td>Tipo Producto:  </td>
            <td><?php
			     $cod_tipo = $producto['alm_prod_tipo'];
			      
                   $consulta = "SELECT *
                                FROM gral_param_propios 
                                WHERE gral_par_pro_grp=1000 AND GRAL_PAR_PRO_COD = $cod_tipo ";
                  $resultado = mysql_query($consulta);
				  $linea = mysql_fetch_array($resultado);
              ?>
              <strong><?php echo utf8_encode($linea['GRAL_PAR_PRO_DESC']); ?></strong>
			  <input type="hidden" name="tipo_producto" id="tipo_producto" value="<?php echo $linea['GRAL_PAR_PRO_COD']; ?>">
                  
             </td>
           </tr>
           <tr>
                <td><font  color="#990033" >Proveedor:</font></td>
                <td> 
                     <?php
					 $cod_prov = $producto['alm_prod_prov'];
                     $consulta = "SELECT alm_prov_codigo_int, alm_prov_nombre 
                                  FROM alm_proveedor 
                                  WHERE alm_prov_codigo_int= '$cod_prov'";
                     $prov_res = mysql_query($consulta);
					 $lin_prov = mysql_fetch_array($prov_res); ?>
	<strong><?php echo utf8_encode($lin_prov['alm_prov_nombre']); ?></strong>
				  <input type="hidden" name="provedor_producto" id="provedor_producto" value="<?php echo $lin_prov['alm_prov_codigo_int']; ?>">
					
                </td>
           </tr>
           <tr>
		      <td><font  color="#990033" >Nombre Producto:</font></td>
              <td> <input type="text" id="nombre_producto" name="nombre_producto" value="<?php echo utf8_encode($producto['alm_prod_nombre']);?>" class="txt_campo" required> <input type="hidden" value="<?php echo $producto['alm_prod_codigo'];?>" id="id_producto_almacen" name="id_producto_almacen"> 
                   <div id="error_nombre_producto"></div>
              </td>
            </tr>
           <tr>
               <td><font  color="#990033" >Descripci&oacute;n:</font></td>
               <td> <textarea name="descripcion_producto" id="descripcion_producto"><?php echo utf8_encode($producto['alm_prod_descripcion']);?></textarea>
                    <div id="error_descripcion_producto"></div>
               </td>
          </tr>
        <tr>
             <td>Marca:</td><td> <input type="text" id="marca_producto" class="txt_campo" name="marca_producto" value="<?php echo utf8_encode($producto['alm_prod_marca']);?>">
              <div id="error_nombre_producto"></div>
            </td>
         </tr>
         <tr>
            <td><font id="serie_color" color="#990033" >Serie:</font></td>
            <td id="id_serie_td"><input class="txt_campo" type="text" name="serie_cliente" width="10"  size="16" id="serie_cliente" value="<?php echo utf8_encode($producto['alm_prod_serie']);?>" required>
                <div id="error_serie_cliente"></div>
            </td>
         </tr>
         <tr>
            <td>Alternativo:</td>
            <td><input class="txt_campo" type="text" name="alternativo_producto" width="10"  size="16" id="alternativo_producto" value="<?php echo utf8_encode($producto['alm_prod_alternativo']);?>"></td>
            <td><div id="mensaje_serie"></div></td>
         </tr>
         <tr>
           <td><font  color="#990033" >Unidad de Medida:</font></td>
           <td> <select name="unidad_producto" id="unidad_producto" size="1"  >
                  <?php
                     $consulta = "SELECT *
                                  FROM gral_param_propios 
                                  WHERE gral_par_pro_grp=1100 AND GRAL_PAR_PRO_COD >= 1";
                      $prov_res = mysql_query($consulta);
                    while ($linea = mysql_fetch_array($prov_res)) {
                      if($linea['GRAL_PAR_PRO_COD'] == $producto['alm_prod_unidad']){
                  ?>
                      <option value=<?php echo $linea['GRAL_PAR_PRO_COD']; ?> selected>
          <?php echo $linea['GRAL_PAR_PRO_DESC']; ?></option>
                <?php
                      }else{
                    ?>
                        <option value=<?php echo $linea['GRAL_PAR_PRO_COD']; ?>>
          <?php echo $linea['GRAL_PAR_PRO_DESC']; ?></option> 
                  <?php
                      }
                    } 
                  ?>
               </select>
           </td>
          </tr>

         <tr>
          <td><font color="#990033">Cantidad Stock:</font></td>
              <td><input class="txt_campo" type="text" name="cantidad_stock" maxlength="40" size="40" id="cantidad_stock" value="<?php echo $producto['alm_prod_cantidad_stock'];?>" required>
                <div id="error_cantidad_stock"></div>
              </td> 
        </tr>
          <tr>   
            <td><font color="#990033">Presentaci&oacute;n:</font> </td>
            <td><textarea id="presentacion_producto" name="presentacion_producto" required><?php echo utf8_encode($producto['alm_prod_presentacion']);?> </textarea>
                <div id="error_presentacion"></div>
            </td>
        </tr>
        <tr>
           <td><font id="color_fecha_ven">Fecha Vencimiento:</font></td>
           <td id="fecha_vencimiento_td"><input class="txt_campo" type="text" name="fecha_vencimiento" id="fecha_vencimiento" value="<?php echo cambiaf_a_normal($producto['alm_prod_fecha_venc']);?>"><div id="error_fecha_vencimiento"></div></td>
        </tr>
      </table>
      </td>
      <td valign='top'>
        <table align="center">
         
        <tr>
              <td><font color="#990033">Precio de Compra:</font> </td>
              <td><input class="txt_campo" type="text" name="precio_compra" maxlength="35" size="35" id="precio_compra" value="<?php echo $producto['alm_prod_prec_compra'];?>" required><div id="error_precio_compra"></div></td>
            
         </tr>
         <tr>
             <td><font color="#990033">Precio de Venta:</font></td>
              <td><input class="txt_campo" type="text" name="precio_venta" maxlength="35" size="35" id="precio_venta" value="<?php echo $producto['alm_prod_prec_venta'];?>" required>
              <div id="error_precio_venta"></div>
              </td>
         </tr>
         <tr>
             <td>Precio de Venta Maximo: </td>
              <td><input class="txt_campo" type="text" name="precio_venta_max" maxlength="35" size="35" id="precio_venta_max" value="<?php echo $producto['alm_prod_prec_max_venta'];?>"></td>
        </tr>
        <tr>
              <td>Precio de Venta Minimo: </td>
              <td><input class="txt_campo" type="text" name="precio_venta_min" maxlength="35" size="35" id="precio_venta_min" value="<?php echo $producto['alm_prod_prec_min_venta'];?>"></td>
        </tr>
        <tr>
           <td>Porcentaje: </td>
            <td><input class="txt_campo" type="text" name="porcentaje_venta" maxlength="35" size="35" id="porcentaje_venta" value="<?php echo $producto['alm_prod_porcentaje'];?>"></td>
        </tr>
        <tr>
           <td><font color="#990033">Valor Contable:</font></td>
            <td><input class="txt_campo" type="text" name="valor_contable" maxlength="35" size="35" id="valor_contable" value="<?php echo $producto['alm_prod_valor_contable'];?>" required>
            <div id="error_valor_contable"></div>
            </td>
        </tr>
      
       
        
        <tr>
           <td><font id="id_lote_color">Lote:</font> </td>
           <td id="campo_lote_td"><input class="txt_campo" type="text" name="lote_producto" id="lote_producto" value="<?php echo utf8_encode($producto['alm_prod_lote']);?>">
          </td>
        </tr>
        <tr>
          <td><font  color="#990033" >Moneda:</font></td>
          <td> <select name="moneda_producto" id="moneda_producto" size="1"  >
                  <?php
                     $consulta = "SELECT *
                                  FROM gral_param_super_int
                                  WHERE  GRAL_PAR_INT_GRP = 18 AND GRAL_PAR_INT_COD >= 1";
                    $prov_res = mysql_query($consulta);
                    while ($linea = mysql_fetch_array($prov_res)) {
                      if($linea['GRAL_PAR_INT_ID'] == $producto['alm_prod_moneda']){
                    ?>
                      <option value=<?php echo $linea['GRAL_PAR_INT_COD']; ?> selected>
                       <?php echo $linea['GRAL_PAR_INT_DESC']; ?></option>
                <?php
                      }else{
                  ?>
                      <option value=<?php echo $linea['GRAL_PAR_INT_COD']; ?>>
                      <?php echo $linea['GRAL_PAR_INT_DESC']; ?></option>
                <?php 
                      }
                 
                    } 
                  ?>
               </select>
          </td>
        </tr>
        <tr>
           <td><font  color="#990033" >Tipo de Cambio:</font></td>
           <td><input class="txt_campo" type="number" name="tipo_cambio" id="tipo_cambio" value="<?php echo $producto['alm_prod_tc']; ?>">
           <div id="error_tipo_cambio"></div>
           </td>
        </tr>
        <tr>
           <td><font  color="#990033" >Sucursal Origen:</font></td>
          <td> <select name="sucursal_origen" id="sucursal_origen" size="1"  >
                  <?php
                   $consulta= "SELECT *
                                FROM gral_agencia 
                                ";
                    $res_eprod = mysql_query($consulta);
                    while ($linea = mysql_fetch_array($res_eprod)) {
                       if($linea['GRAL_AGENCIA_CODIGO'] == $producto['alm_prod_suc_origen']){
                  ?>
                      <option value=<?php echo $linea['GRAL_AGENCIA_CODIGO']; ?> selected>
          <?php echo $linea['GRAL_AGENCIA_NOMBRE']; ?></option>
                <?php
                       }else{
                        ?>
                          <option value=<?php echo $linea['GRAL_AGENCIA_CODIGO']; ?> >
                        <?php echo $linea['GRAL_AGENCIA_NOMBRE']; ?></option>
                       <?php
                       }
                    } 
                  ?>
               </select>
          </td>
        </tr>
           <tr>
            <td><font  color="#990033" >Estado:</font></td>
           <td> <select name="estado_producto" id="estado_producto" size="1"  >
                  <?php
                   $consulta= "SELECT *
                                FROM gral_param_propios 
                                WHERE gral_par_pro_grp=1200 AND GRAL_PAR_PRO_COD >= 1";
                    $res_eprod = mysql_query($consulta);
                    while ($linea = mysql_fetch_array($res_eprod)) {
                      if($linea['GRAL_PAR_PRO_COD'] == $producto['alm_prod_estado']){
                        ?>
                            <option value=<?php echo $linea['GRAL_PAR_PRO_COD']; ?> selected>
                            <?php echo $linea['GRAL_PAR_PRO_DESC']; ?></option>
                        <?php
                      }else{
                        ?>
                           <option value=<?php echo $linea['GRAL_PAR_PRO_COD']; ?>>
                           <?php echo $linea['GRAL_PAR_PRO_DESC']; ?></option>
                        <?php
                      }
                  
                    } 
                  ?>
               </select>
           </td>
        </tr>
         <tr>
            <td>Detalle Tecnico (PDF):</td>
           <td><input type="file" name="detalle_tecnico_prod" id="detalle_tecnico_prod" class="txt_campo"> <br> <a href="<?php echo $producto['alm_prod_pdf_descp'];?>" ><img src="img/notepad_32x32.png" align="absmiddle">Detalle Tecnico</a> <br>
            
           </td>
        </tr>
         <tr>
            <td valign="top">Imagen Producto:</td>
           <td> <input type="file" name="imagen_prod" id="imagen_prod" class="txt_campo"><br><img src="<?php echo $producto['alm_prod_img'];?>" >
           </td>
        </tr>
       
       </table>


         </td>
          </tr>
           <tr>
            <td >

            </td>
           <td>


           </td>
        </tr>
      </table>
      <center>  <input class="btn_form" type="submit" name="accion" value="Modificar Producto">
                <input class="btn_form" type="button"  name="accion" value="Dar de Baja Producto" onClick="mostrarDialogo()">
                <input class="btn_form" type="button"  name="accion" value="Cancelar" onClick="regresarLista()">
      </center>
    </form>
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