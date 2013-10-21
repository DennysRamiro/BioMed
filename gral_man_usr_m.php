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
        <title>MODIFICAR USUARIO</title>
      <meta charset="UTF-8">
        <script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
        <script type="text/javascript" src="js/Utilitarios.js"></script>
        <link href="css/estilo.css" rel="stylesheet" type="text/css">
        <script language="javascript" src="script/validarForm.js" type="text/javascript"></script>
        <script type="text/javascript" src="js/MenuManUsuarioModificar.js"></script>
        <link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
        <script src="script/jquery-ui.js"></script>
        
    </head>
<body>
<div id="dialog-confirm1" title="Advertencia" style="display:none;">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Login no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm2" title="Advertencia" style="display:none;">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Documento Identidad no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm3" title="Advertencia" style="display:none;">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Nombres no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm4" title="Advertencia" style="display:none;">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Apellido Paterno no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm5" title="Advertencia" style="display:none;">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Apellido Materno no puede estar vacio.</font></p>
</div>
  <?php
        include("header.php");
  ?>
<div id="pagina_sistema"> 
            <ul id="lista_menu">
               <li id="menu_modulo">
                  <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
               </li>
               <li id="menu_modulo_general">
                  <img src="img/applications_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO GENERAL
              </li>
              <li id="menu_mant_usuario">
                     <img src="img/tools_24x24.png" border="0" alt="Modulo" align="absmiddle"> MANT. USUARIOS
              </li>
              <li id="menu_cambio_usuario">
                  <img src="img/edit user_24x24.png" border="0" alt="Modulo" align="absmiddle"> MODIFICAR
              </li>
               
           </ul>
        <?php
        // Se realiza una consulta SQL a tabla gral_param_propios
        $consulta  = "SELECT * 
                      FROM gral_agencia 
                      WHERE GRAL_AGENCIA_USR_BAJA is null ";
        $resultado = mysql_query($consulta);
        $con_sec  = "SELECT * 
                     FROM gral_param_propios 
                     WHERE GRAL_PAR_PRO_GRP = 200 AND GRAL_PAR_PRO_COD <> 0 ";
        $res_sec = mysql_query($con_sec);
        $con_car  = "SELECT * 
                     FROM gral_param_propios 
                     WHERE GRAL_PAR_PRO_GRP = 300 AND GRAL_PAR_PRO_COD <> 0 ";
        $res_car = mysql_query($con_car);
        $con_est  = "SELECT * 
                     FROM gral_param_propios 
                     WHERE GRAL_PAR_PRO_GRP = 400 AND GRAL_PAR_PRO_COD <> 0 ";
        $res_est = mysql_query($con_est);
      //  $datos = $_SESSION['form_buffer'];
         ?>
       <div id="contenido_modulo">
          <h2>
             <img src="img/edit user_64x64.png" border="0" alt="Modulo" align="absmiddle"> MODIFICAR
          </h2>
          <hr style="border:1px dashed #767676;">
               <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
            Ingrese los datos para buscar al usuario que desea modificar
        </div>
        <form name="form2" method="post" action="gral_con_m.php">
            <table align="center">

                <tr>
                  		<th align="left">Login : </th>
                      <td><input class="txt_campo" type="text" name="log" id="log">
                      <div id="error_log"></div></td>
                </tr>

                   <tr>
                      <th align="left">Documento Identidad :</th>
                      <td><input type="text" name="ci" width="10" class="txt_campo" id="ci"  onKeyPress="return soloNum(event)" onBlur="limpia()"> 
                      <div id="error_ci"></div></td>
                   <tr>
                   <tr>
    			            <th align="left">Nombres :</th>
                      <td><input type="text" name="nombres" class="txt_campo" id="nombres"> 
                      <div id="error_nombres"></div></td>
                   </tr>
                   <tr>
        		            <th align="left">Apellido Paterno :</th>
                        <td><input type="text" name="ap_pater" class="txt_campo" id="ap_pater"> 
                        <div id="error_ap_pater"></div></td>
                   </tr>
                   <tr>
                        <th align="left">Apellido Materno :</th>
                        <td> <input type="text" name="ap_mater" class="txt_campo" id="ap_mater">
                        <div id="error_ap_mater"></div></td>
                   </tr>
                   <tr>
    					<td></td><td><br><input type="submit" name="accion" value="Buscar Usuario" class="btn_form"></td>
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