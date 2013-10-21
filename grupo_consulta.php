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
<title>Mantenimiento Solicitudes</title>
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
                   <li id="menu_modulo_banca_menu_consulta">
                    
                     <img src="img/search_32x32.png" border="0" alt="Modulo" align="absmiddle"> CONSULTAR
                    
                 </li>
              </ul>  
	

     
<center>
<?php
// Se realiza una consulta SQL
$consulta  = "Select CRED_GRP_CODIGO,CRED_GRP_NOMBRE  From cred_grupo where CRED_GRP_USR_BAJA is null order by 2";
$resultado = mysql_query($consulta);
?>
<div id="contenido_modulo">
 
<h2> <img src="img/search_64x64.png" border="0" alt="Modulo" align="absmiddle">CONSULTAR </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
           Elija el Grupo
        </div>

<table border="1">
	<tr>
	    <th>Codigo</th>
		<th>Nombre Grupo</th>
	</tr>
<?php
while ($linea = mysql_fetch_array($resultado)) {
	 ?>
	 <tr>
		<td><?php echo $linea['CRED_GRP_CODIGO']; ?></td>
		<td><?php echo $linea['CRED_GRP_NOMBRE']; ?></td>
		
	 <?php
}
?>
</table>


<img src="images/24x24/001_21.png" border="0" alt="" align="absmiddle"/> <a href='grupo_mante_a.php'>continuar</a>";
<img src="images/24x24/001_02.png" border="0" alt="" align="absmiddle"/><a href='menu_s.php'>terminar</a>";
 
<center>
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