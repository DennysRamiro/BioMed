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
          <title>INTERSANITAS-IMPORTACIONES</title>
          <script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
          <link href="css/estilo.css" rel="stylesheet" type="text/css">
          <script type="text/javascript" src="js/Alm_gest_imp.js"></script>
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
                 <li id="menu_modulo_general_importaciones">
                    <img src="img/import_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. IMPORTACIONES
                          
                 </li>
                  <li id="menu_modulo_general_importaciones_gestion">
                    <img src="img/ges_imp_32x32.png" border="0" alt="Modulo" align="absmiddle"> GESTION IMP.
                 </li>
              </ul>    
                  <div id="menu_lista">
                      <h2> <img src="img/ges_imp_64x64.png" border="0" alt="Modulo" align="absmiddle"> GESTION IMPORTACIONES</h2>
                      <hr style="border:1px dashed #767676;">
                        
                        <div class="menu_item">
                                <a href="alm_gest_imp_form.php"> 
                                    <img src="img/contratos_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Contratos//Proformas
                              </div>
                         <div class="menu_item">
                                <a href="alm_gest_import.php"> 
                                    <img src="img/agencia_form_64x64.png">
                                    <hr style="border:1px dashed #767676;"> 
                                    Formulario Transacci&oacute;n Aduanera</a>
  
                         </div>
                          <div class="menu_item">
                                <a href="alm_order_compra.php"> 
                                    <img src="img/order_64x64.png">
                                    <hr style="border:1px dashed #767676;"> 
                                    Formulario Orden de Compra</a>
  
                         </div>
                        
                         
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