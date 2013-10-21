<?php
ob_start();
if (!isset ($_SESSION)){
  session_start();
  }
  if(!isset($_SESSION['login']) || !isset($_SESSION['clave'])){
    header("Location: index.php?error=1");
} else {
  require('configuracion.php');
  require('funciones.php');
?>
<html>
<head>
<!--Titulo de la pestaña de la pagina-->
<title>INTERSANITAS</title>
        <meta charset="UTF-8">
        <link href="css/estilo.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
        <script language="javascript" src="script/validarForm.js"></script> 
		<script type="text/javascript" src="script/jquery.numeric.js"></script>
        <link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
        <script src="script/jquery-ui.js"></script>
        <script type="text/javascript" src="js/calendario.js"></script>
        <script type="text/javascript" src="js/Alm_prod_alt.js"></script>
        <script type="text/javascript" src="js/Utilitarios.js"></script>
		<script type="text/javascript" src="js/ValidarNumero.js"></script>  
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
                    <img src="img/add_prod_32x32.png" border="0" alt="Modulo" align="absmiddle"> ALTA PRODUCTO
                </li>
              </ul> 
  <div id="contenido_modulo">
     <h2> 
      <img src="img/add_prod_64x64.png" border="0" alt="Modulo" align="absmiddle">  
                 ALTA PRODUCTO
      </h2>
            <hr style="border:1px dashed #767676;">
<!--<form name="form2" method="post" action="grab_retro_cli.php" onSubmit="return ValidaCampos(this)">-->
    <form name="form2" method="post" action="alm_registrar_prod.php?tp=registrar" enctype="multipart/form-data">
      <?php
	  if (isset ($_GET['msg'])){
        if($_GET['msg'] == 1){
        ?>
          <div id="error_fatal_mysql"> No se pudo registrar los datos del producto por que ocurrio un problema </div>
        <?php
        }
		}
      ?>
      <font  color="#990033" >Los titulos resaltados en este color son obligatorios</font> <br>
      <table>
          <tr>
              <td> <table align="center">
			  
			   <td>Codigo Referencial:</td><td> <input type="text" id="marca_producto" class="txt_campo" name="marca_producto">
              <div id="error_nombre_producto"></div>
               </td>
			  </tr> 
          <tr>
            <td><font  color="#990033" >Tipo Producto:</font>  </td>
            <td><?php
                   $consulta = "SELECT *
                                FROM gral_param_propios 
                                WHERE gral_par_pro_grp=1000 AND GRAL_PAR_PRO_COD >= 1";
                  $resultado = mysql_query($consulta);
              ?>
              <select name="tipo_producto" id="tipo_producto" size="1" size="10">
                  <?php
                   while ($linea = mysql_fetch_array($resultado)) {
                 ?>
                     <option value="<?php echo $linea['GRAL_PAR_PRO_COD']; ?>">
                           <?php echo $linea['GRAL_PAR_PRO_DESC']; ?>
                     </option>
               <?php  
                   } 
               ?>
               </select>
             </td>
           </tr>
           <tr>
                <td><font  color="#990033" >Proveedor:</font></td>
                <td> <select name="provedor_producto" id="provedor_producto" size="1" size="10">
                     <?php
                     $consulta = "SELECT alm_prov_codigo_int, alm_prov_nombre 
                                  FROM alm_proveedor 
                                  WHERE alm_prov_estado=1 and alm_prov_usr_baja is null
                                  ORDER BY  alm_prov_nombre";
                      $prov_res = mysql_query($consulta);
                      while ($linea = mysql_fetch_array($prov_res)) {
                     ?>
                         <option value=<?php echo $linea['alm_prov_codigo_int']; ?>>
                       <?php echo $linea['alm_prov_nombre']; ?></option>
                   <?php
                        } 
                     ?>
                   </select >
                </td>
           </tr>
           <tr>
              <td><font  color="#990033" >Nombre Producto:</font></td>
              <td> <input type="text" id="nombre_producto" name="nombre_producto" class="txt_campo" required> 
                   <div id="error_nombre_producto"></div>
              </td>
            </tr>
           <tr>
               <td><font  color="#990033" >Descripci&oacute;n:</font></td>
               <td> <textarea name="descripcion_producto" id="descripcion_producto"> </textarea>
                    <div id="error_descripcion_producto"></div>
               </td>
          </tr>
        <tr>
             <td>Marca:</td><td> <input type="text" id="marca_producto" class="txt_campo" name="marca_producto">
              <div id="error_nombre_producto"></div>
            </td>
         </tr>
         <tr>
            <td><font id="serie_color" color="#990033" >Serie:</font></td>
            <td id="id_serie_td"><input class="txt_campo" type="text" name="serie_cliente" width="10"  size="16" id="serie_cliente" required>
                <div id="error_serie_cliente"></div>
            </td>
         </tr>
         <tr>
            <td>Alternativo:</td>
            <td><input class="txt_campo" type="text" name="alternativo_producto" width="10"  size="16" id="alternativo_producto"></td>
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
                  ?>
                      <option value=<?php echo $linea['GRAL_PAR_PRO_COD']; ?>>
          <?php echo $linea['GRAL_PAR_PRO_DESC']; ?></option>
                <?php
                    } 
                  ?>
               </select>
           </td>
          </tr>

         <tr>
          <td><font color="#990033">Cantidad Stock:</font></td>
              <td><input class="txt_campo" type="text" name="cantidad_stock" maxlength="40" size="40" id="cantidad_stock" required>
                <div id="error_cantidad_stock"></div>
              </td> 
        </tr>
          <tr>   
            <td><font color="#990033">Presentaci&oacute;n:</font> </td>
            <td><textarea id="presentacion_producto" name="presentacion_producto" required> </textarea>
                <div id="error_presentacion"></div>
            </td>
        </tr>
        <tr>
           <td><font id="color_fecha_ven">Fecha Vencimiento:</font></td>
           <td id="fecha_vencimiento_td"><input class="txt_campo" type="text" name="fecha_vencimiento" id="fecha_vencimiento"><div id="error_fecha_vencimiento"></div></td>
		    </tr>
      
      </table>
      </td>
      <td valign='top'>
        <table align="center">
         
        <tr>
              <td><font color="#990033">Precio de Compra:</font> </td>
              <td><input class="txt_campo" type="text" name="precio_compra" maxlength="35" size="35" id="precio_compra" required><div id="error_precio_compra"></div></td>
            
         </tr>
         <tr>
             <td><font color="#990033">Precio de Venta:</font></td>
              <td><input class="txt_campo" type="text" name="precio_venta" maxlength="35" size="35" id="precio_venta" required>
              <div id="error_precio_venta"></div>
              </td>
         </tr>
         <tr>
             <td>Precio de Venta Maximo: </td>
              <td><input class="txt_campo" type="text" name="precio_venta_max" maxlength="35" size="35" id="precio_venta_max"></td>
        </tr>
        <tr>
              <td>Precio de Venta Minimo: </td>
              <td><input class="txt_campo" type="text" name="precio_venta_min" maxlength="35" size="35" id="precio_venta_min"></td>
        </tr>
        <tr>
           <td>Porcentaje: </td>
            <td><input class="txt_campo" type="text" name="porcentaje_venta" maxlength="35" size="35" id="porcentaje_venta"></td>
        </tr>
        <tr>
           <td><font color="#990033">Valor Contable:</font></td>
            <td><input class="txt_campo" type="text" name="valor_contable" maxlength="35" size="35" id="valor_contable" required>
            <div id="error_valor_contable"></div>
            </td>
        </tr>
        <tr>
           <td><font id="id_lote_color">Lote:</font> </td>
           <td id="campo_lote_td"><input class="txt_campo" type="text" name="lote_producto"id="lote_producto" >
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
                  ?>
                      <option value=<?php echo $linea['GRAL_PAR_INT_COD']; ?>>
          <?php echo $linea['GRAL_PAR_INT_DESC']; ?></option>
                <?php
                    } 
                  ?>
               </select>
          </td>
        </tr>
        <tr>
           <td><font  color="#990033" >Tipo de Cambio:</font></td>
           <td><input class="txt_campo" type="number" name="tipo_cambio"id="tipo_cambio">
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
                  ?>
                      <option value=<?php echo $linea['GRAL_AGENCIA_CODIGO']; ?>>
          <?php echo $linea['GRAL_AGENCIA_NOMBRE']; ?></option>
                <?php
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
                  ?>
                      <option value=<?php echo $linea['GRAL_PAR_PRO_COD']; ?>>
          <?php echo $linea['GRAL_PAR_PRO_DESC']; ?></option>
                <?php
                    } 
                  ?>
               </select>
           </td>
        </tr>
        <tr>
            <td><font>Detalle Tecnico (pdf):</font></td>
           <td> <input type="file" name="detalle_tecnico_prod" id="detalle_tecnico_prod" class="txt_campo"> 
           </td>
        </tr>
        <tr>
            <td><font>Imagen Producto:</font></td>
           <td> <input type="file" name="imagen_prod" id="imagen_prod" class="txt_campo">
           </td>
        </tr>
         <tr>
		    <td>Producto c/numero de Serie:</td>
		   <td >  <input type="checkbox" name="test" value="value1"> </td>
        </tr>
       </table>


         </td>
          </tr>
           <tr>
          <td></td>
           <td><input class="btn_form" type="submit" name="accion" value="Registrar Producto"></td>
        </tr>
      </table>

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