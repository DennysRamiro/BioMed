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
          <title>INTERSANITAS-ALMACENES</title>
          <script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
          <link href="css/estilo.css" rel="stylesheet" type="text/css">
          <script type="text/javascript" src="js/Alm_prod.js"></script>
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
                 <li id="menu_modulo_general_alamacen">
                    <img src="img/box_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. ALMACENES
                          
                 </li>
                  <li id="menu_modulo_mante_usuarios">
                    <img src="img/stuff_32x32.png" border="0" alt="Modulo" align="absmiddle"> MANT. PRODUCTOS
                 </li>
              </ul>    
                  <div id="menu_lista">
                      <h2> <img src="img/stuff_64x64.png" border="0" alt="Modulo" align="absmiddle"> MANTENIMIENTO DE PRODUCTOS</h2>
                      <hr style="border:1px dashed #767676;">
                        <div class="menu_item">
                                <a href="alm_alta_prod.php"> 
                                    <img src="img/add_prod_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Alta Producto
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="alm_consulta_prod.php"> 
                                    <img src="img/search_prod_64x64.png">
                                    <hr style="border:1px dashed #767676;"> 
                                    Consultar Producto
                                </a>
                         </div>
                         <!--div class="menu_item">
                                <a href="alta_con_mod.php?accion=3"> 
                                    <img src="img/edit_prod_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Modificar Producto
                                </a>
                         </div>
                          <div class="menu_item">
                                <a href="alta_con_mod.php?accion=3"> 
                                    <img src="img/del_prod_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Baja de Producto
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