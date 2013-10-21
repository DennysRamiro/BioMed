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
                  <li id="menu_modulo_agen_form">
                    <img src="img/ges_imp_32x32.png" border="0" alt="Modulo" align="absmiddle"> GESTION IMPOR.
                 </li>
                  <li id="menu_modulo_mante_agen_form">
                    <img src="img/agencia_form_32x32.png" border="0" alt="Modulo" align="absmiddle"> FORM. TRANSAC. ADU.
                 </li>
              </ul>    
                  <div id="menu_lista">
                      <h2> <img src="img/agencia_form_64x64.png" border="0" alt="Modulo" align="absmiddle">FORMULARIO TRANSACCION ADUANERA</h2>
                      <hr style="border:1px dashed #767676;">
                	  <div class="menu_item">
                                <a href="alm_alta_agen_form.php"> 
                                    <img src="img/agencia_form_a_64x64.png">
                                    <hr style="border:1px dashed #767676;"> 
                                    Alta Form. Transac. Adu.</a>
                         </div>
                         <div class="menu_item">
                                <a href="alm_consulta_agen_form.php"> 
                                    <img src="img/agencia_form_b_64x64.png">
                                    <hr style="border:1px dashed #767676;"> 
                                  Consulta Form. Transac. Adu.</a>
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