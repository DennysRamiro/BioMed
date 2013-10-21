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
<title>Cobro Creditos (Caja)</title>
<script type="text/javascript" src="script/jquery-1.9.0.js"></script>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/cajas_cobros_cart.js"></script> 
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
                 <li id="menu_modulo_general_cajas">
                    
                     <img src="img/fax_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CAJAS
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/my documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> COBROS CARTERA
                    
                 </li>
              </ul>  


                <div id="contenido_modulo">

                      <h2> <img src="img/my documents_64x64.png" border="0" alt="Modulo" align="absmiddle"> COBROS CARTERA</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
                          <img src="img/alert_32x32.png" align="absmiddle">
                           Cobro de Creditos (Caja)
                      </div>
    	

                
				<?php
                // $fec = leer_param_gral();
                 $logi = $_SESSION['login']; 
				 $fec1 = cambiaf_a_mysql_2($fec);
                ?> 
          

<!--form name="form2" method="post" action="grab_retro_clim.php" -->
<?php
 $_SESSION['continuar'] = 0;
$caj_hab = 0;
$caj_hab = verif_cajero_hab($fec1,$logi);
if ($caj_hab == 0){
     echo "Usuario no Habilitado como cajero ".encadenar(2)." !!!!!";
	 $_SESSION['continuar'] = 1;
	 ?> 
   <br>
   <center>
 <!--input class="btn_form" type="submit" name="accion" value="Salir"-->

<!--/form-->
<?php } 

if ($_SESSION['continuar'] == 0){
 ?>
  
                    <div id="menu_lista">
 
                         <div class="menu_item">
                                <a href="cobros_op_c.php?accion=2"> 
                                    <img src="img/search_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Directo
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="cobros_op_c.php?accion=3"> 
                                    <img src="img/shield1_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Especiales
                                </a>
                         </div>
                    </div>
        <?php
		}
		 ?>
  
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