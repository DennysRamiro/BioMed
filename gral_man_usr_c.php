<?php
	ob_start();
	session_start();

  if(!isset($_SESSION['login']) || !isset($_SESSION['clave'])){
    header("Location: index.php?error=1");
} else {
	  require('configuracion.php');
    require('funciones.php');
    
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">


<html>
    <head>
      <!--Titulo de la pestaña de la pagina-->
        <title>MANT. USUARIOS - LISTA  USUARIOS</title>

        <meta charset="UTF-8">
        <script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
        <link href="css/estilo.css" rel="stylesheet" type="text/css">
        <!--script type="text/javascript" src="script/jquery-auto.js"></script-->
        <script type='text/javascript' src='script/jquery.autocomplete.js'></script>
        <link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />
        <link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
        <script type="text/javascript" src="script/jquery-ui.js"></script>
        <script type="text/javascript" src="js/MantUsuarioAlta.js"></script> 
        <!--script type="text/javascript" src="js/gral_usuarios.js"></script--> 
        <!--script type="text/javascript" src="script/funcionautocomplete.js"></script-->

    </head>

<body>
  <?php
    include("header.php");
  ?>

  <div id="dialog-confirm" title="Advertencia" style="display:none; ">
      
  </div>
  <!--div id="dialog-confirm2" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Nombres no puede estar vacio.</font></p></div>
  <div id="dialog-confirm3" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Apellido Paterno  no puede estar vacio.</font></p></div>
  <div id="dialog-confirm4" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Apellido Materno no puede estar vacio.</font></p></div>
  <div id="dialog-confirm5" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Clave no puede estar vacio.</font></p></div-->
   
     <?php
           // include("header.php");
      ?>
    	<div id="pagina_sistema">
         
            <ul id="lista_menu">
             <li id="menu_modulo">
                <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
             </li>
             <li id="menu_modulo_general">
                <img src="img/applications_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO GENERAL
            </li>
            <li id="menu_modulo_mantUsuarios_alta">
                <img src="img/tools_24x24.png" border="0" alt="Modulo" align="absmiddle"> MANT. USUARIO
            </li>
              <li id="menu_modulo_fecha">
                    
                     <img src="img/search_24x24.png" border="0" alt="Modulo" align="absmiddle"> CONSULTAR
                 </li>
           </ul> 
              

           <div id="contenido_modulo">
                  <h2> <img src="img/search_64x64.png" border="0" alt="Modulo" align="absmiddle"> CONSULTAR USUARIOS </h2>
                  <?php if ($_SESSION['menu']==1) { ?>
                  <!--hr style="border:1px dashed #767676;"-->
                   <div id="error_login"> 
                   <img src="img/checkmark_32x32.png" align="absmiddle">
                   Ingrese los datos de busqueda del usuario que desea modificar
                   </div>
                <?php } elseif($_SESSION['menu']==2) { ?> 
                    <hr style="border:1px dashed #767676;">
                   <div id="error_login"> 
                   <img src="img/checkmark_32x32.png" align="absmiddle">
                   El usuario de alta fue creado correctamente
                   </div>
                 <?php }?> 
            
<!-- codigo para un buscador-->

                  <div id="content">
              <!--form autocomplete="off"-->
                <p>
                   <label>Consultar Usuario:</label>
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
                            WHERE gral_param_propios.GRAL_PAR_PRO_GRP=300 AND (GRAL_USR_USR_BAJA = '' OR GRAL_USR_USR_BAJA is null)    AND GRAL_USR_ESTADO=1 
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