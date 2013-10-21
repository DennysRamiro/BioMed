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
          <script type="text/javascript" src="js/Alm_agen.js"></script>
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
                 <li id="menu_modulo_general_imp">
                    <img src="img/import_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. IMPORTACIONES
                          
                 </li>
                  <li id="menu_modulo_mante_usuarios">
                    <img src="img/agencia_32x32.png" border="0" alt="Modulo" align="absmiddle"> MANT. AG. ADUANERA
                 </li>
              </ul>    
                  <div id="menu_lista">
                      <h2> <img src="img/agencia_64x64.png" border="0" alt="Modulo" align="absmiddle"> MANTENIMIENTO DE AGENCIAS ADUANERAS</h2>
                      <hr style="border:1px dashed #767676;">
                        <div class="menu_item">
                                <a href="alm_alta_agen.php"> 
                                    <img src="img/agencia_add_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                Alta </a><a href="alm_consulta_prod.php">Ag. Aduanera</a><a href="alm_alta_prod.php"> </a>
                         </div>
                         <div class="menu_item">
                                <a href="alm_consulta_agen.php"> 
                                    <img src="img/agencia_bu_64x64.png">
                                    <hr style="border:1px dashed #767676;"> 
                                    Consultar Ag. Aduanera</a>
                         </div>
						<!--   Esta dentro de la Gestion Importaciones
                         <div class="menu_item">
                         		 <a href="alm_gest_import.php"> 
                                    <img src="img/agencia_form_64x64.png">
                                    <hr style="border:1px dashed #767676;"> 
                                    Consultar Ag. Aduanera</a>
                         </div>  -->
 
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