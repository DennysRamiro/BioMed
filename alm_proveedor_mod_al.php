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
<!--Titulo de la pestaa de la pagina-->
<title>PROVEEDOR</title>
<meta charset="UTF-8">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<!--link href="css/calendar.css" rel="stylesheet" type="text/css"-->
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<!--script language="JavaScript" src="script/calendar_us.js"></script-->
<script language="javascript" src="script/validarForm.js"></script> 
<script type="text/javascript" src="js/Alm_prov_alt.js"></script>   
<script type="text/javascript" src="script/jquery.numeric.js"></script>
<link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
<script src="script/jquery-ui.js"></script>
<script type="text/javascript" src="js/calendario.js"></script>
<!--script type="text/javascript" src="js/ValidarFormulario.js"></script-->
<script type="text/javascript" src="js/Utilitarios.js"></script>
<script type="text/javascript" src="js/ValidarNumero.js"></script>
</head>
<body>
<div id="dialog-confirm1" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Nombres no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm2" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo C&oacute;digo Externo no puede estar vacio.</font></p>
</div>
<!--div id="dialog-confirm3" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo C&oacute;digo Interno no puede estar vacio.</font></p>
</div-->
<div id="dialog-confirm4" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Direcci&oacute;n no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm5" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Tel&eacute;fono Fijo no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm6" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Tel&eacute;fono Celular no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm7" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Email no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm8" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Nombre Contacto no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm9" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Email Contacto no puede estar vacio.</font></p>
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
                  <li id="menu_modulo_almacen_prov">
                    
                     <img src="img/provider_24x24.png" border="0" alt="Modulo" align="absmiddle"> PROVEEDORES
                    
                 </li>
              <li id="menu_modulo_fecha_cambio">
                  <img src="img/provider_agregar_24x24.png" border="0" alt="Modulo" align="absmiddle"> ALTA PROVEEDOR
              </li>
           </ul> 
    
<?php
// Se realiza una consulta SQL a tabla gral_param_propios
//$consulta  = "Select * From gral_agencia where GRAL_AGENCIA_USR_BAJA is null ";
//$resultado = mysql_query($consulta) ;
$con_eprov  = "Select GRAL_PAR_PRO_ID, GRAL_PAR_PRO_DESC, GRAL_PAR_PRO_COD
               From gral_param_propios 
               where GRAL_PAR_PRO_GRP = 1200 and GRAL_PAR_PRO_COD <> 0 and GRAL_PAR_PRO_COD <> 2";
$res_eprov = mysql_query($con_eprov);
$con_tprov  = "Select * 
               From gral_param_propios 
               where GRAL_PAR_PRO_GRP = 1400 and GRAL_PAR_PRO_COD <> 0  ";
$res_tprov = mysql_query($con_tprov);
$con_pais  = "Select Code, Name 
              From country order by Name ";
$res_pais = mysql_query($con_pais);
$con_ciudad  = "Select ID, Name 
                From city order by Name";
$res_ciudad= mysql_query($con_ciudad);
$con_continente  = "Select Name, Cont_id 
                    From continent order by Name";
$res_continente= mysql_query($con_continente);
$con_mon  = "Select * 
             From gral_param_super_int 
             where GRAL_PAR_INT_GRP= 18 and GRAL_PAR_INT_COD <> 0";
$res_mon= mysql_query($con_mon);

if(isset($_SESSION['form_buffer'])){
	$datos = $_SESSION['form_buffer'];
}
//echo leer_nro_cliente();
 ?>
 <font color="#FF0000">
 <?php
//echo $_SESSION['error'];
$_SESSION['error'] = "";
//ValidaCamposClientes(this)
?>
 </font>
  <div id="contenido_modulo">

     <h2> 
              <img src="img/provider_agregar_64x64.png" border="0" alt="Modulo" align="absmiddle">  
                 ALTA PROVEEDOR
            </h2>
            <hr style="border:1px dashed #767676;">
<!--<form name="form2" method="post" action="grab_retro_cli.php" onSubmit="return ValidaCampos(this)">-->
    <form name="form2" method="post" action="grab_alm_prov.php" onSubmit="return ValidaCamposAltaAlmacen(this)">
         <table align="center">
            <tr>
              <td scope="col"></td>
              <td scope="col"></td>
              <td scope="col"></td>
            </tr> 
            <tr>
            <!-- Tipo persona-->
            <tr> 
              <td ><strong>Nombres :</strong></td>
              <td><input class="txt_campo" type="text" name="nombres" maxlength="60" size="40" id="nombres">
                  <div id="error_nombres"></div>
              </td>
            </tr>

           	 <!-- Tipo persona-->      
              <tr>
            <td><strong>Tipo :</strong></td> 
        <td> <select name="tipo" size="1" size="10" id="tipo">
               <?php
                 while ($linea = mysql_fetch_array($res_tprov)) {
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
             <td ><strong>C&oacute;digo Externo :</strong></td> 
               <td><input class="txt_campo" type="text" name="cod_ext" maxlength="60"id="cod_ext">
                   <div id="error_cod_ext"></div>
             </td>
            </tr>

            <!--tr>
             <td ><strong>C&oacute;digo Interno :</strong></td>
               <td><input class="txt_campo" type="text" name="cod_int" maxlength="60"id="cod_int">
                   <div id="error_cod_int"></div>
               </td>
            </tr-->
                 <tr>
            <td><strong>Moneda :</strong></td>
        <td> <select name="moneda" size="1" size="10" id="moneda">
               <?php
                 while ($linea = mysql_fetch_array($res_mon)) {
               ?>
               
             <option value=<?php echo utf8_encode($linea['GRAL_PAR_INT_COD']); ?>>
           <?php echo utf8_encode($linea['GRAL_PAR_INT_DESC']); ?></option>
             <?php
                  } 
               ?>
			   </select >
                </td>
         </tr>

            <td><strong>Continente :</strong></td>
        <td> <select name="continente" size="1" size="10" name="continente">
               <?php
                 while ($linea = mysql_fetch_array($res_continente)) {
               ?>
               
             <option value=<?php echo utf8_encode($linea['Cont_id']); ?>>
           <?php echo utf8_encode($linea['Name']); ?></option>
             <?php
                  } 
               ?>
          </select >
                </td>
                 </td>
            <tr>
            <td><strong>Pais :</strong></td>
			
        <td>
		<select name="pais" size="1" size="10" id="pais">
               <?php
                 while ($linea = mysql_fetch_array($res_pais)) {
               ?>
               
             <option value=<?php echo utf8_encode($linea['Code']); ?>>
           <?php echo utf8_encode($linea['Name']); ?></option>
             <?php
                  } 
               ?>
          </select >
                </td>
                 </td>

          <tr>
            <td><strong>Ciudad :</strong></td>
        <td> <select name="ciudad" size="1" size="10" id="ciudad">
               <?php
                 while ($linea = mysql_fetch_array($res_ciudad)) {
               ?>
               
             <option value=<?php echo utf8_encode($linea['ID']); ?>>
           <?php echo utf8_encode($linea['Name']); ?></option>
             <?php
                  } 
               ?>
          </select >
                </td>
                 </td>


            
             <tr>   
             <td ><strong>Direcci&oacute;n :</strong></td>
               <td><input class="txt_campo" type="text" name="direc" maxlength="250"size="80"  id="direc">
                   <div id="error_direc"></div>
               </td>
            </tr>

             <tr>
               <td><strong>Tel&eacute;fono Fijo :</strong></td>
               <td><input class="txt_campo" type="number" name="fono" id="fono">
                   <div id="error_fono"></div>
               </td>
            </tr>

            <tr>
               <td><strong>Tel&eacute;fono Celular :</strong></td>
               <td><input class="txt_campo" type="number" name="celu" id="celu">
                   <div id="error_celu"></div>
               </td>
            </tr>

            <tr>
              <td><strong>Email :</strong></td>
              <td><input class="txt_campo" type="email" name="email" maxlength="35" size="35" id="email">
                  <div id="error_email"></div>
              </td>
           </tr>

           <tr>
              <td><strong>Fax :</strong></td>
              <td><input class="txt_campo" type="number" name="fax" maxlength="35" size="35" id="fax">
                  <div id="error_fax"></div>
              </td>
           </tr>

           <tr>
              <td><strong>Nombre Contacto :</strong></td>
              <td><input class="txt_campo" type="text" name="contacto" maxlength="35" size="35" id="contacto">
                  <div id="error_contacto"></div>
              </td>
           </tr>

             <tr>
              <td><strong>Email Contacto :</strong></td>
              <td><input class="txt_campo" type="email" name="email_cont" maxlength="35" size="35" id="email_cont">
                  <div id="error_email_cont"></div>
              </td>
           </tr>
            <tr>
              <td><strong>Nombre Banco :</strong></td>
              <td><input class="txt_campo" type="text" name="nom_bco" maxlength="60" size="35" id="nom_bco">
           </td>
		    <tr>
              <td><strong>Nombre Cuenta Banco :</strong></td>
              <td><input class="txt_campo" type="text" name="nom_cta_bco" maxlength="60" size="35" id="nom_cta_bco">
           </td>
		   <tr>
              <td><strong>Numero Cuenta Banco :</strong></td>
              <td><input class="txt_campo" type="text" name="nro_cta_bco" maxlength="20" size="35" id="nro_cta_bco">
           </td>
           </tr>
             <tr>
            <td><strong>Estado :</strong></td>
        <td> <select name="estado" size="1" size="10" id="estado">
               <?php
                 while ($linea = mysql_fetch_array($res_eprov)) {
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
             <td></td>
			 <td> <br><input class="btn_form" type="submit" name="accion" value="Grabar" ></td>
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