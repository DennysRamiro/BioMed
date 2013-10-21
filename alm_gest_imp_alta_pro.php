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
                    <img src="img/alta_contrato_32x32.png" border="0" alt="Modulo" align="absmiddle"> ALTA CONTRATO
                 </li>
                  <li id="menu_modulo_general_importaciones_gestion">
                    <img src="img/documents_32x32.png" border="0" alt="Modulo" align="absmiddle"> REG. CONTRATO
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
                REGISTRO DEL CONTRATO O PEDIDO
            </h2>
            <hr style="border:1px dashed #767676;">
<!--<form name="form2" method="post" action="grab_retro_cli.php" onSubmit="return ValidaCampos(this)">-->
    <form name="form2" method="post" action="alm_gest_imp_grab.php" onSubmit="return ValidaCamposAltaProyecto(this)">
         <table align="center" BORDER="0">
            <tr>
              <td scope="col"></td>
              <td scope="col"></td>
              <td scope="col"></td>
            </tr> 
            <tr>

           	 <!-- Tipo proyecto--> 
              <tr>
                <td><strong>Proyecto:</strong></td> 
                        <?php
                             $cons_proy = "SELECT alm_proy_cod, alm_proy_nom FROM alm_proyecto ";
                              $res_proy = mysql_query($cons_proy);
                        ?>
                <td> <select name="proy" size="1" size="10" id="proy">
                       <?php
                             while ($linea = mysql_fetch_array($res_proy)) {
                        ?>
                              <option value=<?php echo utf8_encode($linea['alm_proy_cod']); ?>>
                              <?php echo utf8_encode($linea['alm_proy_nom']); ?></option>
                               <?php
                                    } 
                                 ?>
                     </select >
                </td>
            </tr>     
             
              <tr>
               <td ><strong>Numero de Proforma :</strong></td>
               <td><input  class="txt_campo" name="nro_pro" id="nro_pro" cols="50" rows="2"><div id="error_desc"></div>
               </td>
            </tr>
           <tr>
             <td ><strong>Fecha Documento :</strong></td> 
               <td><input class="txt_campo" type="text" name="fec_ini" maxlength="60"id="datepicker">
                   <div id="error_fec_ini"></div>
             </td>
            </tr>

             <tr>
             <td ><strong>Observaciones :</strong></td>
               <td><textarea  name="obs" cols="50" rows="2"></textarea>            
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