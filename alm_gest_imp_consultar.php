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
<html lang="es">
<head>
<!--Titulo de la pestaña de la pagina-->
<title>PROVEEDOR</title>
<meta charset="UTF-8">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script language="javascript" src="script/validarForm.js"></script> 
<script type="text/javascript" src="js/Alm_proyecto_alta.js"></script>   

<link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
<script src="script/jquery-ui.js"></script>
<script type="text/javascript" src="js/Utilitarios.js"></script>
<script type="text/javascript" src="js/calendario.js"></script>

</head>
<body>
<div id="dialog-confirm1" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Nombre Proyecto no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm2" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo C&oacute;digo Proyecto no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm3" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Fecha Inicio no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm4" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Fecha inicio no puede ser mayor que Fecha Fin</font></p>
</div>

  <?php
        include("header.php");
      ?>

	<div id="pagina_sistema">
         
           <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                 </li>
                 <li id="menu_modulo_general_importaciones">
                    <img src="img/import_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. IMPORTACIONES
                          
                 </li>
                  <li id="menu_modulo_general_importaciones_gestion">
                    <img src="img/ges_imp_32x32.png" border="0" alt="Modulo" align="absmiddle"> GESTION IMP.
                 </li>
                  <li id="menu_modulo_general_importaciones_gestion">
                    <img src="img/contratos_32x32.png" border="0" alt="Modulo" align="absmiddle"> CONTR PROFOR
                 </li>
                  <li id="menu_modulo_general_importaciones_gestion">
                    <img src="img/alta_contrato_32x32.png" border="0" alt="Modulo" align="absmiddle"> CONSUL. CONTRATO
                 </li>
                  <li id="menu_modulo_general_importaciones_gestion">
                    <img src="img/documents_32x32.png" border="0" alt="Modulo" align="absmiddle"> BUSCA CONTRATO
                 </li>
              </ul>    

 <font color="#FF0000">
 <?php
//echo $_SESSION['error'];
$_SESSION['error'] = "";
//ValidaCamposClientes(this)
?>
 </font>
  <div id="contenido_modulo">

     <h2> 
              <img src="img/documents_64x64.png" border="0" alt="Modulo" align="absmiddle">  
               BUSCAR EL CONTRATO O PEDIDO
            </h2>
            <hr style="border:1px dashed #767676;">
<!--<form name="form2" method="post" action="grab_retro_cli.php" onSubmit="return ValidaCampos(this)">-->
   <!-- codigo para un buscador-->

                  <div id="content">
              <!--form autocomplete="off"-->
                <p>
                   <label>Consultar Contrato :</label>
                  <input class="txt_campo" type="text" name="usuario_buscar" id="usuario_buscar" />
                  <input type="button" value="Buscar Ususario" class="btn_form" onclick="buscarUsuario();">
                </p>
              <!--/form-->
            </div>

<!-- buscador-->

            <hr style="border:1px dashed #767676;">


            <div id="tabla_datos_usuario">
                <table class="table_usuario">
                    <tr>
                        <th>CI</th>
                        <th>LOGIN</th>
                        <th>NOMBRES</th>
                        <th>APELLIDO PATERNO</th>
                        <th>APELLIDO MATERNO</th>
                        <th>DIRECCION</th>
                        <th>TELEFONO</th>
                        <th>CELULAR</th>
                        <th>EMALI</th>
                        <th>CARGO</th>
                        <th>ACCIONES</th>
                    </tr>
               <?php
               $consulta = "SELECT *
                            FROM gral_usuario, gral_param_propios 
                            WHERE (GRAL_USR_USR_BAJA = '' OR GRAL_USR_USR_BAJA is null)  AND gral_param_propios.GRAL_PAR_PRO_GRP=300 
                            AND gral_param_propios.GRAL_PAR_PRO_COD = gral_usuario.GRAL_USR_CARGO 
                            ORDER BY GRAL_USR_LOGIN";
               $resultado = mysql_query($consulta);
               while ($linea = mysql_fetch_array($resultado)) {
                     ?>
                     <tr class="tr_usuario">

                        <td><?php echo $linea['GRAL_USR_CI']; ?>&nbsp;</td>
                        <td><?php echo $linea['GRAL_USR_LOGIN']; ?>&nbsp;</td>
                        <td><?php echo $linea['GRAL_USR_NOMBRES']; ?>&nbsp;</td>
                        <td><?php echo $linea['GRAL_USR_AP_PATERNO']; ?> </td>
                        <td><?php echo $linea['GRAL_USR_AP_MATERNO']; ?> </td>
                        <td><?php echo $linea['GRAL_USR_DIRECCION']; ?>&nbsp;</td>
                        <td><?php echo $linea['GRAL_USR_TELEFONO']; ?>&nbsp;</td>
                         <td><?php echo $linea['GRAL_USR_CELULAR']; ?>&nbsp;</td>
                        <td><?php echo $linea['GRAL_USR_EMAIL']; ?> </td>
                        <td><?php echo $linea['GRAL_PAR_PRO_DESC']; ?>&nbsp;</td>
                        <td><div style="float:left;border:1px solid #999; width:45px; text-align:center; margin-left:0px; margin-right:2px;"><a href="gral_man_usr_cm.php?ci=<?php echo $linea['GRAL_USR_CI'];?>" ><img src="img/notepad_32x32.png" align="absmiddle"><br> Modificar</a></div><div style="float:left;border:1px solid #999; width:42px; text-align:center; margin-left:0px; margin-right:2px; cursor:pointer;"><a onclick="mostrarDialogo('<?php echo $linea['GRAL_USR_CI'];?>')" ><img src="img/delete user_32x32.png" align="absmiddle"><br> Dar de Baja</a></div> </td>
                    </tr> 
                     <?php
                }
                ?>
                </table>
            </div>

<!---->
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