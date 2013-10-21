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
          <title>MANTENIMIENTO USUARIOS</title>
          <script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
          <link href="css/estilo.css" rel="stylesheet" type="text/css">
          <script type="text/javascript" src="js/MenuManUsuario.js"></script>
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
                 <li id="menu_modulo_general">
                    
                     <img src="img/applications_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO GENERAL
                    
                 </li>
                  <li id="menu_modulo_mante_usuarios">
                    
                     <img src="img/tools_24x24.png" border="0" alt="Modulo" align="absmiddle"> MANT. USUARIOS
                    
                 </li>
              </ul>    
                <?php
                        // Se realiza una consulta SQL a tabla gral_param_propios
                        $consulta  = "SELECT * 
                                      FROM gral_agencia 
                                      WHERE GRAL_AGENCIA_USR_BAJA is null ";
                        $resultado = mysql_query($consulta);
                 ?>
                  <div id="menu_lista">
                      <h2> <img src="img/tools_64x64.png" border="0" alt="Modulo" align="absmiddle"> MANTENIMIENTO DE USUARIOS</h2>
                      <hr style="border:1px dashed #767676;">
                        <div class="menu_item">
                                <a href="alta_con_mod.php?accion=1"> 
                                    <img src="img/add user_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Alta
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="alta_con_mod.php?accion=2"> 
                                    <img src="img/search_64x64.png">
                                    <hr style="border:1px dashed #767676;"> 
                                    Consultar
                                </a>
                         </div>
                         <!--div class="menu_item">
                                <a href="alta_con_mod.php?accion=3"> 
                                    <img src="img/edit user_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Modificar
                                </a>
                         </div-->
                        <div class="menu_item">
                                <a href="alta_con_mod.php?accion=5">
                                    <img src="img/tools_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Asigna Permisos
                                </a>
                        </div>
                        <!--div class="menu_item">
                                <a href="alta_con_mod.php?accion=4"> 
                                    <img src="img/delete user_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Salir
                                </a>
                        </div-->
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