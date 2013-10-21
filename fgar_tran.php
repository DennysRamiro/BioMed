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
    echo "hola";
?>
<html>
<head>
<meta charset="UTF-8">
<!--Titulo de la pestaña de la pagina-->
<title>Busqueda de Cuenta para la Transaccion</title>
  
          <script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
          <link href="css/estilo.css" rel="stylesheet" type="text/css" />
          <script type="text/javascript" src="js/Modulo_fondo.js"></script>
</head>
<body>
  <?php
        include("header.php");
      ?>

<div id="pagina_sistema">
<!--Menu izquierdo de los modulos-->
     <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>
                 <!--Inicio Menu Fondo Garantia-->
               <?php
      //if($_GET["menu"]==0){?> 
                 <li id="menu_modulo_general_fondo">
                    
                     <img src="img/open document_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. FONDO GARANTIA
                    
                 </li>
                  <li id="menu_modulo_deposito_retiro">
                    
                     <img src="img/refresh_32x32.png" border="0" alt="Modulo" align="absmiddle"> DEPOSITOS RETIROS
                    
                 </li>
              </ul>      	
              <?php //}elseif ($_GET["menu"]==2) { ?>
           
<form name="form2" method="post" action="grab_retro_clim.php" >	
     <?php
    // $fec = leer_param_gral();
     $logi = $_SESSION['login'];
	 $_SESSION['egre_bs_sus'] = 0; 
	 $fec1 = cambiaf_a_mysql_2($fec);
     ?> 

<?php
 $_SESSION['continuar'] = 0;
  
$caj_hab = 0;
$caj_hab = verif_cajero_hab($fec1,$logi);
if ($caj_hab == 0){
     echo "Usuario no Habilitado como cajero ----".encadenar(2)." !!!!!";
	 $_SESSION['continuar'] = 1;
	 ?> 
   <br>
   <center>
 <input class="btn_form" type="submit" name="accion" value="Salir">

</form> 	
<?php 
}

if ($_SESSION['continuar'] == 0){

 ?>
  



<!--Cabecera del modulo con su alerta-->
<div id="menu_lista">
                      <h2> <img src="img/refresh_64x64.png" border="0" alt="Modulo" align="absmiddle"> DEPOSITOS RETIROS</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/alert_32x32.png" align="absmiddle">
                     Cobro de Creditos
                     </div>
                     <!--Creacion de los Submodulos-->
                        <div class="menu_item">
                                <a href="cobros_op_2.php?accion=61"> 
                                    <img src="img/users group_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Por Nombre Grupo
                                </a>
                         </div>
                          <div class="menu_item">
                                <a href="cobros_op_2.php?accion=71"> 
                                    <img src="img/user office_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Por Nombre Cliente
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="cobros_op_2.php?accion=91"> 
                                    <img src="img/phone_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Por Numero
                                </a>
                         </div>
                         <!--div class="menu_item">
                                <a href="cobros_op_2.php?accion=81"> 
                                    <img src="img/close_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Salir
                                </a>
                         </div-->

</div>
  <!--div id="ListaSeleccion">
             <ul>
			    <li><a href="cobros_op_2.php?accion=60">Por Nombre Grupo</a></li>
    			<li><a href="cobros_op_2.php?accion=70">Por Nombre Cliente</a></li>
				<li><a href="cobros_op_2.php?accion=90">Por Numero </a></li>
                <li><a href="cobros_op_2.php?accion=80">Salir</a></li>
    
		    </ul>
  </div-->

       
 </div>
  <?php
      include("footer_in.php");
     ?>
</body>
</html>
<?php
}
}
ob_end_flush();
 ?>