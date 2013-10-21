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
         <script type="text/javascript" src="js/ClienteManteDetalle.js"></script>  
        <link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
        <script src="script/jquery-ui.js"></script>
        <script type="text/javascript" src="js/Alm_agen_alt.js"></script>
        <script type="text/javascript" src="js/Utilitarios.js"></script>
</head>
<body> 
<div id="dialog-confirmAltaAduanera1" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo C&oacute;digo no puede estar vacio.</font></p>
</div>
<div id="dialog-confirmAltaAduanera2" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Nit no puede estar vacio.</font></p>
</div>
<div id="dialog-confirmAltaAduanera3" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Direcci&oacute;n no puede estar vacio.</font></p>
</div>
<div id="dialog-confirmAltaAduanera4" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Tel&eacute;fono no puede estar vacio.</font></p>
</div>


<?php
include("header.php");
$cod_agencia=$_GET['cod_age'];

        $consulta = "SELECT * 
                     FROM alm_age_adu
                     WHERE alm_age_adu_cod='$cod_agencia' AND alm_age_adu_usr_baja IS NULL AND alm_age_adu_est='1'" or die ('fallo');
        $res = mysql_query($consulta);
        $agencia = mysql_fetch_array($res);
		
		

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
                 <li id="menu_alta_prod">
                    <img src="img/agencia_add_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODIFICAR AG. ADUANERA
                </li>
              </ul> 
  <div id="contenido_modulo">
     <h2> 
      <img src="img/agencia_add_64x64.png" border="0" alt="Modulo" align="absmiddle">  
                 MODIFICAR AGENCIA ADUANERA
    </h2>
    <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
                        <img src="img/checkmark_32x32.png" align="absmiddle">
                         Modificar datos de la Agencia Aduanera</div>

    <form name="form2" method="POST" action="alm_acciones_agen.php?tp=modificar&cod_agencia=<?php echo $agencia['alm_age_adu_cod']?>"  onSubmit="return ValidaCampos_Alta_Aduanera(this)">

      <table align="center">
          <tr>
            <td align="left">C&oacute;digo:</td>
            <td><?php echo $agencia['alm_age_adu_cod'];?> <input type="hidden" id="cod" name="cod" class="txt_campo" value=""><input type="hidden" id="id" name="id" class="txt_campo" value="<?php echo $agencia['alm_age_adu_id'];?>"><input type="hidden" id="corr" name="corr" class="txt_campo" value="<?php echo $agencia['alm_correlativo'];?>"><div id="error_cod"></div></td>
           </tr>
           <tr>
                <td align="left">Nombre:</td>
                <td align="left"> <input type="text" id="nombre" name="nombre" class="txt_campo" value="<?php echo $agencia['alm_age_adu_nom'];?>"><div id="error_nombre"></div></td>
           </tr>
           <tr>
              <td align="left">Nit:</td>
              <td align="left"> <input type="text" id="nit" name="nit" class="txt_campo" value="<?php echo $agencia['alm_age_adu_nit'];?>"><div id="error_nit"></div></td>
            </tr>
           <tr>
               <td align="left">Departamento:</td>
               <td align="left"><?php 
			echo "<select name='dep' id='dep'>"; 
			$cod_ag=$agencia['alm_age_adu_dep'];
			$consulta=mysql_query ("SELECT * FROM city WHERE CountryCode='BOL'");
			while ($depar=mysql_fetch_array($consulta)) { 
			if ($depar['ID'] == $cod_ag){ 
			echo "<option selected value=".($depar['ID']).">".($depar['Name'])."</option>";
			}else{ 
			echo "<option value=".($depar['ID']).">".($depar['Name'])."</option>";
			} 
			}
			echo "</select>"; 
			?>
           </td>
          </tr>
        <tr>
             <td align="left">Direcci&oacute;n:</td>
             <td align="left"> <input type="text" id="dir" name="dir" class="txt_campo" value="<?php echo $agencia['alm_age_adu_dir'];?>"><div id="error_dir"></div></td>
         </tr>
         <tr>
            <td align="left">Tel&eacute;fono:</td>
            <td align="left"><input  type="text" id="tel" name="tel" class="txt_campo"  value="<?php echo $agencia['alm_age_adu_telf'];?>" onKeyPress="return soloNum(event)"> <div id="error_tel"></div>
            </td>
         </tr>
         <tr>
          <td align="left">Fax:</td>
              <td align="left"><input class="txt_campo" type="text" name="fax" maxlength="40" size="40" id="fax" value="<?php echo $agencia['alm_age_adu_fax'];?>"><input class="txt_campo" type="hidden" name="est" id="est" value="<?php echo $agencia['alm_age_adu_est'];?>"><div id="error_fax"></div>
              </td> 
        </tr>
         <tr>
            <td align="left">email:</td>
            <td align="left"><input class="txt_campo" type="text" name="email" width="10"  size="16" id="email" value="<?php echo $agencia['alm_age_adu_email'];?>"><div id="mensaje_email"></div></td>
         </tr>
      </table>
		<table align="center">
       <tr>
       <td align="center"><input class="btn_form" type="submit" name="accion2" value="Modificar Agencia"></td>
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