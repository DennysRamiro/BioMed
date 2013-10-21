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
<title>Mantenimiento Grupos </title>
<meta charset="UTF-8">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js" type="text/javascript"> </script>
          <script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
          <script type="text/javascript" src="js/GrupobancaSolidarioAlta.js"></script>
          <script type="text/javascript" src="js/ValidarFormulario.js"></script>
</head>
</head>
<body><?php
    include("header.php");
  ?>
	
<?php
// Se realiza una consulta SQL a tabla gral_param_propios
$consulta  = "Select * From gral_agencia where GRAL_AGENCIA_USR_BAJA is null ";
$resultado = mysql_query($consulta);
$datos = $_SESSION['form_buffer'];
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
                   <li id="menu_modulo_banca_menu_alta">
                    
                     <img src="img/add user_32x32.png" border="0" alt="Modulo" align="absmiddle"> ALTA
                    
                 </li>
              </ul>  
	



<div id="contenido_modulo">



 <h2> <img src="img/add user_64x64.png" border="0" alt="Modulo" align="absmiddle">ALTA</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
           Ingrese los datos generales del Grupo Solidario/Banca
        </div>

<form name="form2" method="post" action="gral_grab_grup.php" onSubmit="return ValidarCamposGrupo(this)">
 <center>
<table align="center">
 <tr> <td>Agencia   </td> <td>
 <select name="cod_agencia" size="1"  >
		  <?php
           while ($linea = mysql_fetch_array($resultado)) {
          ?>
		      <option value=<?php echo $linea['GRAL_AGENCIA_CODIGO']; ?>><?php echo $linea['GRAL_AGENCIA_NOMBRE']; ?></option>
	 	  <?php	
		  } 
		  ?>
	      </select>
       </td>
   </tr>
   <tr>   
		<td> Nombre Grupo </td>
		 <td> <input class="txt_campo" type= "text" name="nom_grup" id="nom_grup"></td>
     <td><div id="mensaje_nom_grup"></div></td>
   </tr>
  <tr>
     <td></td>
     <td><input class="btn_form" type="submit" name="accion" value="Grabar"></td>
  </tr>
</table>
</form>
<?php	
echo $_SESSION['error'];
$_SESSION['error'] = "";
?>
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