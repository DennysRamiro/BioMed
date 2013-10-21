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
        <script type="text/javascript" src="js/alm_consulta_agen_form.js"></script>
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
                <li id="menu_modulo_imp">
                    <img src="img/import_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. IMPORTACIONES
                          
                 </li>
                  <li id="menu_modulo_importacion">
                    <img src="img/ges_imp_32x32.png" border="0" alt="Modulo" align="absmiddle"> GESTION. IMPOR.
                 </li>
                 <li id="menu_alta_trans_adu">
                    <img src="img/agencia_form_32x32.png" border="0" alt="Modulo" align="absmiddle"> FORM. TRANSAC. ADU.
                </li>
                 <li id="menu_consul_agencia">
                    <img src="img/agencia_form_b_32x32.png" border="0" alt="Modulo" align="absmiddle"> CONSULTA FORM.AG. ADU.
                </li>
            </ul> 
              
           <div id="contenido_modulo">
              <h2> <img src="img/agencia_form_b_64x64.png" border="0" alt="Modulo" align="absmiddle"> CONSULTAR FORMULARIO AGENCIAS ADUANERAS</h2>
            <div id="dialog-confirm" title="Dar de baja producto" style="display:none;">
              <p><img src="img/alert_48x48.png" align="absmiddle">Realmente quiere dar de baja el producto?</p>
            </div>  
<!-- codigo para un buscador-->
         
            <div id="content">
              <!--form autocomplete="off"-->
                <p>
                   <label>Consultar Agencia Aduanera:</label>
                  <input class="txt_campo" type="text" name="age_adu_buscar" id="age_adu_buscar" />
                  <input type="button" value="Buscar Agen. Aduanera" class="btn_form" onclick="buscarProducto();">
                </p>
              <!--/form-->
            </div>
<!-- buscador-->
            <hr style="border:1px dashed #767676;">
            <div id="tabla_datos_agencia">
                <table class="table_usuario">
                    <tr>
                        <th>CODIGO</th>
                        <th>NOMBRE</th>
                        <th>FECHA</th>
                        <th>Nº FACTURA</th>
                        <th>Nº SIDUNEA</th>
                        <th>ACCIONES</th>
                    </tr>
               <?php
               $consulta = "SELECT f.alm_age_adu_tra_cod, f.alm_age_adu_tra_id_age, a.alm_age_adu_nom, f.alm_age_adu_tra_fecha, f.alm_age_adu_tra_nro_fac, f.alm_age_adu_tra_cod_sidu FROM alm_age_adu_tra AS f INNER JOIN alm_age_adu AS a ON f.alm_age_adu_tra_id_age=a.alm_age_adu_id WHERE f.alm_age_adu_tra_est='1'";
               $resultado = mysql_query($consulta);
               while ($linea = mysql_fetch_array($resultado)) {
                     ?>
                     <tr class="tr_usuario">
                        <td><?php echo $linea['alm_age_adu_tra_cod']; ?>&nbsp;</td>
                        <td><?php echo $linea['alm_age_adu_nom']; ?>&nbsp;</td>
                        <td><?php echo $linea['alm_age_adu_tra_fecha']; ?>&nbsp;</td>
                        <td><?php echo $linea['alm_age_adu_tra_nro_fac']; ?>&nbsp;</td>
                        <td><?php echo $linea['alm_age_adu_tra_cod_sidu']; ?>&nbsp;</td>
                        <td><div style="float:left;border:1px solid #999; width:45px; text-align:center; margin-left:0px; margin-right:3px;"><a href="alm_modificar_agen.php?id_age=<?php echo $linea['alm_age_adu_tra_cod'];?>" ><img src="img/notepad_32x32.png" align="absmiddle"><br> Detallar</a></div><div style="float:left;border:1px solid #999; width:45px; text-align:center; cursor:pointer;"> <a  onclick="mostrarDialogo(<?php echo $linea['alm_age_adu_id'];?>)"><img src="img/delete box_32x32.png"><br> Dar de Baja</a></div> </td>
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