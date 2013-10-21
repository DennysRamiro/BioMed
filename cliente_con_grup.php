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
<title>Mantenimiento Clientes</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script language="javascript" src="script/validarForm.js" type="text/javascript"> </script>  
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
               <li id="menu_modulo_clientes">
                    
                     <img src="img/user office_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CLIENTES
                    
                 </li>
                  <li id="menu_modulo_registro_clientes">
                    
                     <img src="img/directories_32x32.png" border="0" alt="Modulo" align="absmiddle"> REGISTRO CLIENTES
                    
                 </li>
              <li id="menu_modulo_fecha_cambio">
                  <img src="img/add user_32x32.png" border="0" alt="Modulo" align="absmiddle"> ALTA
              </li>
              <li id="menu_modulo_fecha_cambio">
                  <img src="img/add user_32x32.png" border="0" alt="Modulo" align="absmiddle"> ALTA DE GRUPOS
              </li>
           </ul> 
    
    <div id="contenido_modulo">

             <h2> <img src="img/tools_64x64.png" border="0" alt="Modulo" align="absmiddle"> ALTA DE GRUPOS</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
                            <img src="img/alert_32x32.png" align="absmiddle">
                                 Ingrese los datos generales del Cliente que desea agregar al Grupo.
                        </div>

	
				<?php
					 //$fec = leer_param_gral();
					 $logi = $_SESSION['login']; 
				?>
            
            <br>
<?php
$datos = $_SESSION['form_buffer'];
 ?>
 
<!--<<form name="form2" method="post" action="cliente_retro_grup.php" target="_self" onSubmit="return ValidaCamposClientes(this)">-->
<form name="form2" method="post" action="cliente_con_g.php">
  <strong>Codigo   </strong>
  <?php if(isset($datos['imp_sol'])){?>
        <input class="txt_campo" type="text" name="cod" size="8" value="<?=$datos['cod'];?>"> 
  <?php }else{?> 
        <input class="txt_campo" type="text" name="cod" size="8" value=""> 
  <?php }?> <br>
  <strong>Documento Identidad  </strong>
  <?php if(isset($datos['imp_sol'])){?>
        <input class="txt_campo" type="text" name="ci" size="8" value="<?=$datos['ci'];?>" >
   <?php }else{?>
        <input class="txt_campo" type="text" name="ci" size="8" value="" >
   <?php }?> 
   <BR>
  <strong>  Apellido Paterno   </strong>
  <?php if(isset($datos['imp_sol'])){?>
        <input class="txt_campo" type="text" name="ap_pater" size="10" value="<?=$datos['ap_pater'];?>" > 
  <?php }else{?>
        <input class="txt_campo" type="text" name="ap_pater" size="10" value="" > 
  <?php }?><br> 
  <strong>  Apellido Materno   </strong>
  <?php if(isset($datos['imp_sol'])){?>
        <input class="txt_campo" type="text" name="ap_mater" size="10" value="<?=$datos['ap_mater'];?>"  >
  <?php }else{?>
        <input class="txt_campo" type="text" name="ap_mater" size="10" value=""  >
  <?php }?> 
   <BR>
  <strong>  Apellido Esposo   </strong>
  <?php if(isset($datos['imp_sol'])){?>
        <input class="txt_campo" type="text" name="ap_espos" size="10" value="<?=$datos['ap_espos'];?>"  >
    <?php }else{?>
	    <input class="txt_campo" type="text" name="ap_espos" size="10" value=""  >
  <?php }?> <br>
  <strong>  Nombres   </strong>
  <?php if(isset($datos['imp_sol'])){?>
        <input class="txt_campo" type="text" name="nombres" size="10" value="<?=$datos['nombres'];?>"> 
  <?php }else{?>
        <input class="txt_campo" type="text" name="nombres" size="10" value=""> 
  <?php }?> 
  <BR><BR>
    <input class="btn_form" type="submit" name="accion" value="Consultar">
</form>
</div>
<div id="FooterTable">

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