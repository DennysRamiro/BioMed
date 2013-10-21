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
<title>Mantenimiento Solicitud</title>
<meta charset="UTF-8">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
 <script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
 <script type="text/javascript" src="js/ModulosCreditosSolicitud.js"></script>
</head> 
<?php
      include("header.php");
  ?>
   
<div id="pagina_sistema">
          
        <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>
                 <li id="menu_modulo_creditos">
                    
                     <img src="img/edit file_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CREDITOS
                    
                 </li>
                  <li id="menu_modulo_creditos_alta">
                    
                     <img src="img/clock_32x32.png" border="0" alt="Modulo" align="absmiddle"> SOLICITUD
                    
                 </li>
                   <li id="menu_modulo_fecha">
                    
                     <img src="img/add user_32x32.png" border="0" alt="Modulo" align="absmiddle"> ALTA
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
<h2> <img src="img/add user_64x64.png" border="0" alt="Modulo" align="absmiddle">ALTA </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
           Alta de Solicitudes
        </div>

<br><br>
<?php
 $consulta  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 806 and GRAL_PAR_PRO_COD <> 0 and GRAL_PAR_PRO_USR_BAJA is null order by 2";
   $resultado = mysql_query($consulta);
 ?>

<div class="menu_item">
<?php
  while ($linea = mysql_fetch_array($resultado)) {
   ?>
   <a href="solic_alta_2.php?accion=<?php echo $linea['GRAL_PAR_PRO_COD']; ?>"><img src="img/add user_64x64.png"><?php echo $linea['GRAL_PAR_PRO_DESC']; ?>
 </a>
      <?php
   }
 ?>                             
                         </div>

<div id="ListaSeleccion">
              <?php   
  while ($linea = mysql_fetch_array($resultado)) {
   ?>
             <ul>
   			<li><a href="solic_alta_2.php?accion=<?php echo $linea['GRAL_PAR_PRO_COD']; ?>"><?php echo $linea['GRAL_PAR_PRO_DESC']; ?></a></li>
              <?php
   }
 ?>	     
		    </ul>
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