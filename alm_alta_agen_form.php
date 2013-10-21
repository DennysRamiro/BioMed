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
<meta charset="UTF-8"><link href="css/estilo.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script language="javascript" src="script/validarForm.js"></script> 
<script type="text/javascript" src="js/ClienteManteDetalle.js"></script>  
<link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="js/calendario.js"></script>
<script src="script/jquery-ui.js"></script>
<script type="text/javascript" src="js/Alm_agen_form_alt.js"></script>
<script type="text/javascript" src="js/Utilitarios.js"></script>
</head>
<body> 
<div id="dialog-confirmAltaAduaForm1" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Nº de Factura no puede estar vacio.</font></p>
</div>
<div id="dialog-confirmAltaAduaForm2" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Fecha no puede estar vacio.</font></p>
</div>
<div id="dialog-confirmAltaAduaForm3" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Fecha no puede ser mayor a la fecha actual.</font></p>
</div>
<div id="dialog-confirmAltaAduaForm4" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Nº Sidunea  no puede estar vacio.</font></p>
</div>


 
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
                    <img src="img/ges_imp_32x32.png" border="0" alt="Modulo" align="absmiddle"> GESTION IMPOR.
                 </li>
                 <li id="menu_alta_trans_adu">
                    <img src="img/agencia_form_32x32.png" border="0" alt="Modulo" align="absmiddle"> FORM. TRANSAC. ADU.
                </li>
                <li id="menu_alta_agencia">
                    <img src="img/agencia_form_a_32x32.png" border="0" alt="Modulo" align="absmiddle"> ALTA TRANSAC. ADU.</li>
              </ul> 
  <div id="contenido_modulo">
     <h2> 
      <img src="img/agencia_form_a_64x64.png" border="0" alt="Modulo" align="absmiddle">  
                REGISTRO FORMULARIO AGENCIA ADUANERA
    </h2>
    <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
                        <img src="img/checkmark_32x32.png" align="absmiddle">
                         Registrar datos Formulario de Agencia Aduanera</div>

    <form name="form2" method="POST" action="alm_acciones_agen_form.php?tp=registrar" onSubmit="return ValidaCampos_Alta_Adu_Formulario(this)">
<br>
      <table align="center">
          <tr>
            <td align="left">Agencia Aduanera:</td>
            <td align="left">  <?php $consulta=mysql_query ("SELECT alm_age_adu_id, alm_age_adu_cod,alm_age_adu_nom FROM alm_age_adu WHERE alm_age_adu_usr_baja is null AND alm_age_adu_est='1';
"); ?>
			<select name="age"> 
			<?php 
			//Por cada registro encontrado en la tabla me genera un <option> 
			while ($agen = mysql_fetch_array($consulta)) 
			{ 
			?> 
			<option value="<?php echo $agen['alm_age_adu_cod']; ?>"><?php echo $agen['alm_age_adu_nom']; ?> 
			
			<?php 
			} 
			?>
		 </select></td>
             <td align="left">Nº de Factura:</td>
            <td align="left"> <input type="text" id="nro_fac" name="nro_fac" class="txt_campo" onKeyPress="return soloNum(event)"><div id="error_nro_fac"></div></td>
           
</tr>
<tr>
<td align="left">Fecha:</td>
                <td align="left"> <input type="text" id="datepicker" name="fec" class="txt_campo"></td>
              <td align="left">Nº Sidunea:</td>
              <td align="left"> <input type="text" id="nro_sid" name="nro_sid" class="txt_campo" ><div id="error_nro_sid"></div></td>
              
              
            </tr>
       </table>

      <table align="center" class="table_usuario">
           <tr>
                <td align="center"><b>ITEM</b></td><td align="center"> <b>DESCRIPCION</b></td><td align="center"><b>MONTO</b></td><td align="center"><b>FACTURA</b></td>
           </tr>
           <tr>
           <?php 
		   $consulta=mysql_query ("SELECT GRAL_PAR_PRO_ID, GRAL_PAR_PRO_GRP, GRAL_PAR_PRO_COD, GRAL_PAR_PRO_SIGLA, GRAL_PAR_PRO_DESC
			FROM gral_param_propios 
			WHERE GRAL_PAR_PRO_GRP='1600' AND GRAL_PAR_PRO_COD<>'0'"); 
		   while ($tran = mysql_fetch_array($consulta)) 
			{ 
			//$sql_id[] = $tran[0];
			?>
            <tr><td align="left"><?php echo $tran['GRAL_PAR_PRO_DESC'];?>:<input type="hidden" name="item[]"  id="item" value="<?php echo $tran['GRAL_PAR_PRO_COD'];?>" ></td>
            <td align="left"><input class="txt_campo" type="text" name="des[]" id="des"><div id="error_des"></div></td><td align="left"> <input type="text" name="monto[]" id="monto" class="txt_campo"><div id="error_monto"></div></td><td align="center"><input type="checkbox"  name="factura[]" id="factura" value="<?php  echo $tran['GRAL_PAR_PRO_COD'];?>">

            <div id="error_monto"></div></td>
               <?php 
			   }		   
			   ?>
         </tr>
      </table>
		<table align="center">
       <tr>
       <td align="center"><input class="btn_form" type="submit" name="accion" value="Registrar Transacci&oacute;n"></td>
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