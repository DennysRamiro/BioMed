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
<!--link href="css/calendar.css" rel="stylesheet" type="text/css"-->
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<!--script language="JavaScript" src="script/calendar_us.js"></script-->
<script language="javascript" src="script/validarForm.js"></script> 
<script type="text/javascript" src="js/Alm_proyecto_alta.js"></script>   

<link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
<script src="script/jquery-ui.js"></script>
<script type="text/javascript" src="js/calendario.js"></script>
<!--script type="text/javascript" src="js/ValidarFormulario.js"></script-->
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
               <li id="menu_modulo_almacen">
                    
                     <img src="img/box_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. ALMACENES
                    
                 </li>
                  <li id="menu_modulo_almacen_proy">
                    
                     <img src="img/proyecto_24x24.png" border="0" alt="Modulo" align="absmiddle"> PROYECTOS
                    
                 </li>
              <li id="menu_modulo_fecha_cambio">
                  <img src="img/proyecto_agregar_24x24.png" border="0" alt="Modulo" align="absmiddle"> ALTA PROYECTO
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
              <img src="img/proyecto_agregar_64x64.png" border="0" alt="Modulo" align="absmiddle">  
                 ALTA PROYECTO
            </h2>
            <hr style="border:1px dashed #767676;">
<!--<form name="form2" method="post" action="grab_retro_cli.php" onSubmit="return ValidaCampos(this)">-->
    <form name="form2" method="post" action="gral_grab_proy.php" onSubmit="return ValidaCamposAltaProyecto(this)">
         <table align="center">
            <tr>
              <td scope="col"></td>
              <td scope="col"></td>
              <td scope="col"></td>
            </tr> 
            <tr>
            <!-- Nombre Proyecto-->
            <tr> 
              <td ><strong>Nombre Proyecto :</strong></td>
              <td><input class="txt_campo" type="text" name="nombres" maxlength="60" size="40" id="nombres">
                  <div id="error_nombres"></div>
              </td>
            </tr>

             <!-- Codigo Proyecto-->
            <!--tr> 
              <td ><strong>C&oacute;digo Proyecto :</strong></td>
              <td><input class="txt_campo" type="text" name="cod_proy" maxlength="60" size="40" id="cod_proy">
                  <div id="error_cod_proy"></div>
              </td>
            </tr-->

           	 <!-- Tipo proyecto-->      
              <tr>
            <td><strong>Tipo :</strong></td> 
            <?php
                   $cons_tipo = "Select GRAL_PAR_PRO_ID, GRAL_PAR_PRO_DESC, GRAL_PAR_PRO_COD
               From gral_param_propios 
               where GRAL_PAR_PRO_GRP = 1500 and GRAL_PAR_PRO_COD <> 0 ";
                  $res_tipo = mysql_query($cons_tipo);
              ?>
            <td> <select name="tipo" size="1" size="10" id="tipo">
               <?php
                 while ($linea = mysql_fetch_array($res_tipo)) {
               ?>
               
             <option value=<?php echo utf8_encode($linea['GRAL_PAR_PRO_COD']); ?>>
           <?php echo utf8_encode($linea['GRAL_PAR_PRO_DESC']); ?></option>
             <?php
                  } 
               ?>
          </select >
                </td>
         </tr>

           <tr>
             <td ><strong>Fecha Inicio :</strong></td> 
               <td><input class="txt_campo" type="text" name="fec_ini" maxlength="60"id="datepicker">
                   <div id="error_fec_ini"></div>
             </td>
            </tr>

            <tr>
             <td ><strong>Fecha Fin :</strong></td>
               <td><input class="txt_campo" type="text" name="fec_fin" maxlength="60"id="datepicker2">
                   <div id="error_fec_fin"></div>
               </td>
            </tr>
             <tr>
             <td ><strong>Descripci&oacute;n :</strong></td>
               <td><textarea  name="desc" id="desc" cols="50" rows="2"></textarea>            
                   <div id="error_desc"></div>
               </td>
            </tr>
              
           <tr>
             <td></td>
			 <td> <br><input class="btn_form" type="submit" name="accion" value="Grabar"></td>
           </tr>
       </table>
    </form>
</div>
<?php	
echo $_SESSION['error'];
$_SESSION['error'] = "";
?>
	<div id="FooterTable">
		Ingrese los datos generales del Cliente
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