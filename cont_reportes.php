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
<title>Reportes de Contabilidad</title>
<meta charset="UTF-8">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script type="text/javascript" src="js/contabilidad_reportes.js"></script> 
</head>
<body>
	<?php
				include("header.php");


			?>

 <?php
 //echo "---".$_POST['gestion']."---";
 //$_POST['gestion'];
if ($_GET["menu"]==1) {
      if (!isset($_POST['gestion'])) {
          $_POST['gestion']=$_SESSION['gestion'];
      //echo $_POST['gestion'];
          }
      else{
           $_SESSION['gestion']= $_POST['gestion'];
          }
}elseif ($_GET["menu"]==2) { 
$_SESSION['gestion'] = "correspondiente";
}
            ?>
<div id="pagina_sistema">
     <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>
                 <li id="menu_modulo_contabilidad">
                    
                     <img src="img/calculator_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. CONTABILIDAD
                    
                 </li>
                 <?php
                 if($_GET["menu"]==2){?> 
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> CONTAB. REPORTES
                    
                 </li>
              </ul>  
  


<div id="menu_lista">

                      <h2> <img src="img/documents_64x64.png" border="0" alt="Modulo" align="absmiddle"> CONTABILIDAD REPORTES</h2>
                      <hr style="border:1px dashed #767676;">
                       <!--div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
           Reportes de Contabilidad
        </div-->
                        <?php } elseif($_GET["menu"]==1){?> 

                 
                <li id="menu_modulo_gest">
                    
                     <img src="img/open document_24x24.png" border="0" alt="Modulo" align="absmiddle"> REP. GEST. PASADAS
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> CONTAB. REPORTES
                    
                 </li>
               </ul>  
  


<div id="menu_lista">

                      <h2> <img src="img/documents_64x64.png" border="0" alt="Modulo" align="absmiddle"> CONTABILIDAD REPORTES</h2>
                      <hr style="border:1px dashed #767676;">
                       <!--div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
           Reportes de Contabilidad
        </div-->


        <?php }?> 
                      <?php
                 if($_GET["menu"]==2){?> 
                        <div class="menu_item">
                                <a href="cont_rep_op.php?accion=1"> 
                                    <img src="img/shield1_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                  Estado de Situacion Bs.
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="cont_rep_op.php?accion=11"> 
                                    <img src="img/shield3_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                   Estado de Situacion Bs./$us.
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="cont_rep_op.php?accion=2"> 
                                    <img src="img/find_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                   Estado de Resultados
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="cont_rep_op.php?accion=12"> 
                                    <img src="img/edit user_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                   Estado de Sumas y Saldos
                                </a>
                         </div>
                          <div class="menu_item">
                                <a href="cont_rep_op.php?accion=13"> 
                                    <img src="img/edit_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                   Balance General
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="cont_rep_op.php?accion=14"> 
                                    <img src="img/edit file_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                   Estado de Resultados (Balance)
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="cont_rep_op.php?accion=3"> 
                                    <img src="img/my documents_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Mayor de Cuentas
                                </a>
                         </div>
                          <div class="menu_item">
                                <a href="cont_rep_op.php?accion=4"> 
                                    <img src="img/notepad_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Diario
                                </a>
                         </div>

                  <?php } elseif($_GET["menu"]==1){?> 

                         <div class="menu_item">
                                <a href="cont_rep_op.php?accion=21"> 
                                    <img src="img/shield1_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                  Estado de Situacion Bs.
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="cont_rep_op.php?accion=22"> 
                                    <img src="img/shield3_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                   Estado de Situacion Bs./$us.
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="cont_rep_op.php?accion=23"> 
                                    <img src="img/find_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                   Estado de Resultados
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="cont_rep_op.php?accion=24"> 
                                    <img src="img/edit user_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                   Estado de Sumas y Saldos
                                </a>
                         </div>
                          <div class="menu_item">
                                <a href="cont_rep_op.php?accion=25"> 
                                    <img src="img/edit_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                   Balance General
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="cont_rep_op.php?accion=26"> 
                                    <img src="img/edit file_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                   Estado de Resultados (Balance)
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="cont_rep_op.php?accion=27"> 
                                    <img src="img/my documents_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Mayor de Cuentas
                                </a>
                         </div>
                          <div class="menu_item">
                                <a href="cont_rep_op.php?accion=28"> 
                                    <img src="img/notepad_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Diario
                                </a>
                         </div>

                   <?php }?> 
            </div>



        

  <!--div id="ListaSeleccion">
             <ul>
			    <li><a href="cont_rep_op.php?accion=1">Estado de Situacion Bs.</a></li>
				<li><a href="cont_rep_op.php?accion=11">Estado de Situacion Bs./$us.</a></li>
    			<li><a href="cont_rep_op.php?accion=2">Estado de Resultados</a></li>
				<li><a href="cont_rep_op.php?accion=12">Estado de Sumas y Saldos</a></li>
				<li><a href="cont_rep_op.php?accion=13">Balance General</a></li>
				<li><a href="cont_rep_op.php?accion=14">Estado de Resultados (Balance)</a></li>
                <li><a href="cont_rep_op.php?accion=3">Mayor de Cuentas</a></li>
				<li><a href="cont_rep_op.php?accion=4">Diario</a></li>
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
ob_end_flush();
 ?>