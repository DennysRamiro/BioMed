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
        <script type="text/javascript" src="js/Alm_agen_consul.js"></script>
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
                 <li id="menu_modulo_almacen">
                    <img src="img/import_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. IMPORTACIONES
                          
                 </li>
                  <li id="menu_modulo_agencia_aduanera">
                    <img src="img/agencia_32x32.png" border="0" alt="Modulo" align="absmiddle"> MANT. AG. ADUANERA
                 </li>
                 <li id="menu_consul_agencia">
                    <img src="img/agencia_bu_32x32.png" border="0" alt="Modulo" align="absmiddle"> CONSULTA AG. ADUANERA
                </li>
            </ul> 
              
           <div id="contenido_modulo">
              <h2> <img src="img/agencia_bu_64x64.png" border="0" alt="Modulo" align="absmiddle"> CONSULTAR LISTA DE AGENCIAS ADUANERAS</h2>
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
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Departamento</th>
                        <th>Nit</th>
                        <th>Direcci&oacute;n</th>
                        <th>Tel&eacute;fono</th>
                        <th>Fax</th>
                        <th>Email</th>
                        <th>Acciones</th>
                    </tr>
               <?php
               $consulta = "SELECT *
                            FROM alm_age_adu
                            WHERE alm_age_adu_usr_baja IS NULL AND alm_age_adu_est='1' ";
               $resultado = mysql_query($consulta);
               while ($linea = mysql_fetch_array($resultado)) {
                     ?>
                     <tr class="tr_usuario">
                        <td><?php echo $linea['alm_age_adu_cod']; ?>&nbsp;</td>
                        <td><?php echo $linea['alm_age_adu_nom']; ?>&nbsp;</td>
                        <td>
                         
                         <?php
                         $depa= $linea['alm_age_adu_dep'];
		 $res= mysql_query("SELECT ID,Name FROM city WHERE CountryCode='BOL' 
						  				AND ID='$depa' ")or die ("Fallo en la consulta");
		 $row=mysql_fetch_array($res);
		 echo $row['Name']; ?>
                         </td>
                        <td><?php echo $linea['alm_age_adu_nit']; ?>&nbsp;</td>
                        <td><?php echo $linea['alm_age_adu_dir']; ?>&nbsp;</td>
                        <td><?php echo $linea['alm_age_adu_telf']; ?>&nbsp;</td>
                        <td><?php echo $linea['alm_age_adu_fax']; ?>&nbsp;</td>
                        <td><?php echo $linea['alm_age_adu_email']; ?>&nbsp;</td>
                        <td><div style="float:left;border:1px solid #999; width:45px; text-align:center; margin-left:0px; margin-right:3px;"><a href="alm_modificar_agen.php?cod_age=<?php echo $linea['alm_age_adu_cod'];?>" ><img src="img/notepad_32x32.png" align="absmiddle"><br> Detallar</a></div><div style="float:left;border:1px solid #999; width:45px; text-align:center; cursor:pointer;"> <a  onclick="mostrarDialogo('<?php echo $linea['alm_age_adu_cod'];?>')"><img src="img/delete box_32x32.png"><br> Dar de Baja</a></div> </td>
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