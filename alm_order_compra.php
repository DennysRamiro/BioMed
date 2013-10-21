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
          <title>INTERSANITAS-ORDEN DE COMPRA</title>
          <script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
          <link href="css/estilo.css" rel="stylesheet" type="text/css">
          <script type="text/javascript" src="js/Alm_order_compra.js"></script>
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
                    <img src="img/import_32x32.png" border="0" alt="MOD. IMPORTACIONES" align="absmiddle"> MOD. IMPORTACIONES
                          
                 </li>
                  <li id="menu_modulo_general_importaciones_gestion">
                    <img src="img/ges_imp_32x32.png" border="0" alt="GEST. IMPORTACION" align="absmiddle"> GESTION IMP.
                 </li>
                  <li id="menu_modulo_form_orden_compra">
                    <img src="img/order_32x32.png" border="0" alt="ORDEN COMPRA" align="absmiddle"> ORDEN DE COMPRA
                 </li>
              </ul> 
              <div id="contenido_modulo">
                 <h2> 
                          <img src="img/order_64x64.png" border="0" alt="Modulo" align="absmiddle">  
                             FORMULARIO DE ORDEN DE COMPRA
                 </h2>
                 <hr style="border:1px dashed #767676;">
            <!--<form name="form2" method="post" action="grab_retro_cli.php" onSubmit="return ValidaCampos(this)">-->
                 Este es el formulario 
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