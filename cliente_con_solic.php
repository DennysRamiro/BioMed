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
<title>Consulta Clientes</title>
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script language="javascript" src="script/validarForm.js" type="text/javascript"> </script> 
<script type="text/javascript" src="js/mant_cuenta_ape_cta.js"></script> 
</head>
<body>
    <?php
        include("header.php");
      ?>
  <div id="pagina_sistema">
<!--Menu izquierdo de los modulos-->
     <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>
                 <li id="menu_modulo_general_fondo">
                    
                     <img src="img/open document_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. FONDO GARANTIA 
                    
                 </li>
                  <li id="menu_modulo_mant_cuenta">
                    
                     <img src="img/app folder_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD MANT. CUENTA
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/open_32x32.png" border="0" alt="Modulo" align="absmiddle"> APERTURA DE CUENTA
                    
                 </li>
              </ul> 
    <!--Cabecera del modulo con su alerta-->
     
     <div id="contenido_modulo">
                      <h2> <img src="img/open_64x64.png" border="0" alt="Modulo" align="absmiddle">APERTURA DE CUENTA</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/alert_32x32.png" align="absmiddle">
                     Ingrese los datos generales del cliente que desea incorporar
                     </div>            
<br>
<?php
 if(isset($datos['imp_sol'])){
$datos = $_SESSION['form_buffer'];
}
$_SESSION["tip_cta"] = 0;
 ?>
<!--<<form name="form2" method="post" action="cliente_retro_grup.php" target="_self" onSubmit="return ValidaCamposClientes(this)">-->
<form name="form2" method="post" action="incorp_cli_sol.php">
<table align="center">
<tr>
        <td><strong>  C.I. sin extension  </strong></td>
		<td> <?php echo encadenar(4);?></td>
  <td> <?php if(isset($datos['ci'])){?>
        <input class="txt_campo" type="text" name="ci" size="15" value="<?=$datos['ci'];?>" > 
  <?php }else{?>
        <input class="txt_campo" type="text" name="ci" size="15" value="" > 
  <?php }?></td>
  </tr>
  <tr>
        <td><strong>  Apellido Paterno   </strong></td>
		<td> <?php echo encadenar(4);?></td>
   <td><?php if(isset($datos['imp_sol'])){?>
        <input class="txt_campo" type="text" name="ap_pater" size="30" value="<?=$datos['ap_pater'];?>" > 
  <?php }else{?>
        <input class="txt_campo" type="text" name="ap_pater" size="30" value="" > 
  <?php }?> </td>
 
  <tr>
        <td><strong>  Apellido Materno   </strong></td>
		<td> <?php echo encadenar(4);?></td>
        <td><?php if(isset($datos['imp_sol'])){?>
        <input class="txt_campo" type="text" name="ap_mater" size="30" value="<?=$datos['ap_mater'];?>"  >
  <?php }else{?>
        <input class="txt_campo" type="text" name="ap_mater" size="30" value=""  >
  <?php }?> </td>
   <tr>
        <td><strong>  Apellido Esposo   </strong></td>
		<td> <?php echo encadenar(4);?></td>
        <td>  <?php if(isset($datos['imp_sol'])){?>
        <input class="txt_campo" type="text" name="ap_espos" size="30" value="<?=$datos['ap_espos'];?>"  >
        <?php }else{?>
	    <input class="txt_campo" type="text" name="ap_espos" size="30" value=""  >
        <?php }?> </td>
  <tr>
        <td> <strong>  Nombres   </strong>
		</td>
		<td> <?php echo encadenar(4);?></td>
        <td><?php if(isset($datos['imp_sol'])){?>
        <input class="txt_campo" type="text" name="nombres" size="30" value="<?=$datos['nombres'];?>"> 
  <?php }else{?>
        <input class="txt_campo" type="text" name="nombres" size="30" value=""> 
  <?php }?> </td>
  
  </table>
  <center>
  <br>
    <input class="btn_form" type="submit" name="accion" value="Consultar">
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