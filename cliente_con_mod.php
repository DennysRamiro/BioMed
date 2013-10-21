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
<title>Mantenimiento Clientes</title>
<meta charset="UTF-8">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script language="javascript" src="script/validarForm.js" type="text/javascript"></script>
<script type="text/javascript" src="js/ClienteManteDetalle.js"></script>
</head>
<body><?php
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
                  <?php if (isset($_SESSION['con_mod'])){
            if ($_SESSION['con_mod'] == 1){
     ?>    
                   <img src="img/search_32x32.png" border="0" alt="Modulo" align="absmiddle"> CONSULTAR
                   
     <?php  }
            if ($_SESSION['con_mod'] == 2){
      ?> 
                   <img src="img/edit_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODIFICAR
                    
     <?php
            }
       if ($_SESSION['con_mod'] == 3){
      ?> 
                    <img src="img/go_32x32.png" border="0" alt="Modulo" align="absmiddle"> INHABILITAR/HABILITAR
     <?php
            }
  } 
 ?> 
                  
              </li>
           </ul> 
    	
           
            
          

  

<?php
//if(isset($_SESSION['form_buffer']))	{
//	$datos = $_SESSION['form_buffer'];
//}
 ?>
 <div id="contenido_modulo">
   
<h2> 

  <?php if (isset($_SESSION['con_mod'])){
            if ($_SESSION['con_mod'] == 1){
     ?>    
                   <img src="img/search_64x64.png" border="0" alt="Modulo" align="absmiddle"> 
                   CONSULTAR
     <?php  }
            if ($_SESSION['con_mod'] == 2){
      ?> 
                   <img src="img/edit_64x64.png" border="0" alt="Modulo" align="absmiddle">
                    MODIFICAR
     <?php
            }
       if ($_SESSION['con_mod'] == 3){
      ?> 
                    <img src="img/go_64x64.png" border="0" alt="Modulo" align="absmiddle">
                    INHABILITAR/HABILITAR
     <?php
            }
  } 
 ?> 
   
            </h2>
            <hr style="border:1px dashed #767676;">
<!--<form name="form2" method="post" action="cliente_con_m.php"   onSubmit="return ValidaCamposClientes(this)">
 Esta parte es igual que la anterior ya que no se quiere quu se quiere colsultar apesar de que no se ponga dato entonces se tiene que desabilitar el script para mas convenencia-->  
<form name="form2" method="post" action="cliente_con_m.php">
    <table align="center">
    <tr>
	<td>Codigo</td><td><?php if(isset($datos['cod'])){ ?><input class="txt_campo" type="text" name="cod" size="10" value="<?=$datos['cod'];?>"><?php }else{?><input class="txt_campo" type="text" name="cod" size="11" value=""><?php }?> </td>
    </tr>
    <tr>
		<td>Documento Identidad  </td>
		<td><?php if(isset($datos['ci']))	{ ?>
		<input class="txt_campo" type="text" name="ci" size="16" value="<?=$datos['ci'];?>" >
		<?php }else{?>
		<input class="txt_campo" type="text" name="ci" size="16" value="">
		<?php }?> </td>
    </tr>
	<tr>
    
	   <td>  Apellido Paterno   </td>
	   <td><?php if(isset($datos['ap_pater']))	{ ?>
	   <input class="txt_campo"  type="text" name="ap_pater" size="35" value="<?=$datos['ap_pater'];?>" >
	   <?php }else{?>
	   <input class="txt_campo" type="text" name="ap_pater" size="35" value="">
	   <?php }?> </td>
   </tr>
   <tr> 
	  <td>  Apellido Materno   </td>
	  <td> <?php if(isset($datos['ap_mater']))	{ ?>
	  <input class="txt_campo" type="text" name="ap_mater" size="35" value="<?=$datos['ap_mater'];?>"  >
	  <?php }else{?>
	  <input class="txt_campo" type="text" name="ap_mater" size="35" value=""><?php }?></td>
   </tr>
   <tr>
	   <td>  Apellido Esposo   </td>
	   <td> <?php if(isset($datos['ap_espos']))	{ ?>
	   <input class="txt_campo" type="text" name="ap_espos" size="35" value="<?=$datos['ap_espos'];?>"  >
	   <?php }else{?>
	   <input class="txt_campo" type="text" name="ap_espos" size="35" value=""><?php }?></td>
   </tr>
   <tr>
	   <td>  Nombres   </td>
	   <td><?php if(isset($datos['nombres']))	{ ?>
	   <input class="txt_campo"  type="text" name="nombres" size="40" value="<?=$datos['nombres'];?>">
	   <?php }else{?>
	   <input class="txt_campo" type="text" name="nombres" size="40" value=""><?php }?></td>
   </tr>
   <tr>
      <td></td>
	<?php if (isset($_SESSION['con_mod'])){
	if ($_SESSION['con_mod'] == 1){
 ?>   
	   <td><input class="btn_form" type="submit" name="accion" value="Consultar"></td>
 <?php
   }
   if ($_SESSION['con_mod'] == 2){
  ?> 
      <td><input class="btn_form" type="submit" name="accion" value="Modificar"></td>
   <?php
   }
   if ($_SESSION['con_mod'] == 3){
  ?> 
      <td><input class="btn_form" type="submit" name="accion" value="Inhabilita/Habilita"></td>
   <?php
   }
  } 
 ?>	   
   </tr>
  </table>
</form>
</div>
<div id="FooterTable"> 
Ingrese los datos generales del Cliente que desea modificar
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