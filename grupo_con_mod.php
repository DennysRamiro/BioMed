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
<title>Mantenimiento Grupos</title>
<meta charset="UTF-8">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script> 
          <script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
          <script type="text/javascript" src="js/GrupobancaSolidarioAlta.js"></script>  
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
                  <li id="menu_modulo_banca">
                    
                     <img src="img/users group_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. BANCA/SOLIDARIO
                    
                 </li>
                  <li id="menu_modulo_banca_menu">
                    
                     <img src="img/users group_32x32.png" border="0" alt="Modulo" align="absmiddle"> GR. BANCA/SOLIDARIO
                    
                 </li>
                   <li id="menu_modulo_banca_menu_modificar">
                    
                     <img src="img/edit_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODIFICAR
                    
                 </li>
              </ul> 
           


<div id="contenido_modulo">
 <?php
if(isset($_SESSION['form_buffer'])){
  $datos = $_SESSION['form_buffer'];
  }
 ?>
<h2> <img src="img/edit_64x64.png" border="0" alt="Modulo" align="absmiddle">MODIFICAR </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
           Elija el Grupo para modificar
        </div>
 
<form name="form2" method="post" action="grupo_retro_um.php" style="border:groove" target="_self" >
<table align="center">

 <td> Codigo Grupo </td>
		 <td> <input class="txt_campo" type= "text" name="cod"></td>
  <tr>   
		<td> Nombre Grupo </td>
		 <td> <input class="txt_campo" type= "text" name="nomb_g"></td>
   </tr>
    <tr></tr>
 <tr>
     <br>
     <td><input class="btn_form" type="submit" name="accion" value="Consultar"></td>
	 <td></td>
	 <td><input class="btn_form" type="submit" name="accion" value="Salir"></td>
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