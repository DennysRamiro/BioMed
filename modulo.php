<?php
ob_start();
if (!isset ($_SESSION)){
	session_start();
}
if(!isset($_SESSION['login']) || !isset($_SESSION['clave'])){
    header("Location: index.php?error=1");
} else { 
require('configuracion.php');
require('funciones.php');?>
<html>
      <head>
<!--Titulo de la pestaña de la pagina-->
<title>MODULOS GENERAL</title>
<meta charset="UTF-8">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<link href="css/estilo.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/Modulo.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script language="javascript" src="script/validarForm.js"></script> 
<script language="javascript" src="js/xp_progress.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css" />

      </head>
      <body>
    
           <?php
              include("header.php");
            ?>
       	<div id="pagina_sistema">

      			<?php
      			 $log = $_SESSION['login'];
      			$cod_mod = 0;
      			if (isset ($_GET["modulo"])){
                     $cod_mod = $_GET["modulo"];
      			  $_SESSION['modulo'] = $_GET['modulo'];
      			}
                  $consulta  = "SELECT * 
                                FROM gral_param_propios 
                                WHERE GRAL_PAR_PRO_GRP = 100 and GRAL_PAR_PRO_COD = $cod_mod ";
                  $resultado = mysql_query($consulta);
                  $linea = mysql_fetch_array($resultado);
      			?>
              
      			        <ul id="lista_menu">
                       <li id="menu_modulo">
                          <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                          
                       </li>
                       <?php
                       if($_GET["modulo"]==2000){
                        ?>
                           <li id="menu_fecha">
                          
                            <img src="img/user office_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CLIENTES
                          
                          </li>
                        <?php
                       }elseif($_GET["modulo"]==3000){
                        ?>
                          <li id="menu_fecha">
                          
                            <img src="img/users group_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. BANCA/SOLIDARIO
                          
                          </li>
                        <?php
                       }elseif($_GET["modulo"]==4000){
                        ?>
                          <li id="menu_fecha">
                          
                            <img src="img/edit file_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CREDITOS
                          
                          </li>
                        <?php
                       }elseif($_GET["modulo"]==6000){
                        ?>
                          <li id="menu_fecha">
                          
                            <img src="img/windows folder_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CARTERA
                          
                          </li>
                        <?php
                       }elseif($_GET["modulo"]==8000){
                        ?>
                          <li id="menu_fecha">
                          
                            <img src="img/calculator_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. CONTABILIDAD
                          
                          </li>
                        <?php
                       }elseif($_GET["modulo"]==10000){
                        ?>
                          <li id="menu_fecha">
                          
                            <img src="img/fax_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO TESORERIA
                          
                          </li>
                        <?php
                       }elseif($_GET["modulo"]==11000){
                        ?>
						          <li id="menu_fecha">
                          
                            <img src="img/fax_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO TESORERIA
                          
                          </li>
                          <li id="menu_modulo_general_fondo">
                          
                            <img src="img/open document_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. FONDO GARANTIA
                          
                          </li>
                          <?php
                       }elseif($_GET["modulo"]==20000){
                        ?>
                          <li id="menu_fecha">
                          
                            <img src="img/box_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. ALMACENES
                          
                          </li>
						 <?php
                       }elseif($_GET["modulo"]==30000){
                        ?>
                          <li id="menu_fecha">
                          
                            <img src="img/import_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. IMPORTACIONES
                          
                          </li> 
						 <?php
                       }elseif($_GET["modulo"]==10100){
                        ?>
                          <li id="menu_fecha">
                          
                            <img src="img/caja_chica_32x32.png" border="0" alt="Modulo" align="absmiddle"> CAJA CHICA 
                          
                          </li>  
                        <?php
                       }elseif($_GET["modulo"]==40000){
                        ?>
                          <li id="menu_fecha">
                          
                            <img src="img/order_32x32.png" border="0" alt="Modulo" align="absmiddle"> VENTAS
                          
                          </li>  
                        <?php
                       }else{
                        ?>
						
                          <li id="menu_fecha">
                          
                            <img src="img/applications_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO GENERAL
                          
                          </li>
                        <?php
                       }
                        ?>
                       
                    </ul>
             	
                  <?php
                  // Se realiza una consulta SQL a tabla gral_param_propios
      			if ($log == "super"){
      			/* $consulta  = "SELECT DISTINCT gral_permiso_usuario.GRAL_OPC_PRG_COD, 
                                          GRAL_OPC_PRG_DESCRIPCION,GRAL_OPC_PRG_NOMBRE
      	                   FROM gral_permiso_usuario, gral_param_propios, gral_opciones_prg  
                           WHERE  GRAL_PER_COD_MOD = $cod_mod 
      						            AND GRAL_USR_ESTADO = 1 
      	                      AND GRAL_OPC_PRG_MOD = GRAL_PER_COD_MOD
      	                      AND gral_opciones_prg.GRAL_OPC_PRG_COD = gral_permiso_usuario.GRAL_OPC_PRG_COD 
      	                      ORDER BY GRAL_PER_COD_MOD,gral_permiso_usuario.GRAL_OPC_PRG_COD";*/
              $consulta ="SELECT DISTINCT gral_permiso_usuario.GRAL_OPC_PRG_COD, 
                                          GRAL_OPC_PRG_DESCRIPCION,GRAL_OPC_PRG_NOMBRE,gral_opciones_prg.GRAL_OPC_IMG
                           FROM gral_permiso_usuario, gral_param_propios, gral_opciones_prg  
                           WHERE  GRAL_PER_COD_MOD = $cod_mod
                              AND GRAL_USR_ESTADO = 1 
                              AND GRAL_OPC_PRG_MOD = GRAL_PER_COD_MOD
                              AND gral_opciones_prg.GRAL_OPC_PRG_COD = gral_permiso_usuario.GRAL_OPC_PRG_COD 
                              ORDER BY GRAL_PER_COD_MOD,gral_permiso_usuario.GRAL_OPC_PRG_COD";
      			
      			}else{
                  $consulta  = "SELECT DISTINCT GRAL_PER_COD_MOD,gral_permiso_usuario.GRAL_OPC_PRG_COD, 
				                GRAL_OPC_PRG_DESCRIPCION,GRAL_OPC_PRG_NOMBRE,gral_opciones_prg.GRAL_OPC_IMG
      	                        FROM gral_permiso_usuario, gral_param_propios, gral_opciones_prg  
                                WHERE  GRAL_PER_COD_MOD = $cod_mod 
              						            AND gral_permiso_usuario.GRAL_USR_LOGIN = '$log'
              	                      AND GRAL_USR_ESTADO = 1 
              	                      AND GRAL_OPC_PRG_MOD = GRAL_PER_COD_MOD
              	                      AND gral_opciones_prg.GRAL_OPC_PRG_COD = gral_permiso_usuario.GRAL_OPC_PRG_COD 
              	                      ORDER BY GRAL_PER_COD_MOD,gral_permiso_usuario.GRAL_OPC_PRG_COD";
      			}			  
                  $resultado = mysql_query($consulta);
                  ?>
                   <!--div id="TableModulo">
                      <table width="50%"  border="0" cellspacing="1" cellpadding="1" align="center">
                         <tr>
                          <th width="27%" scope="col"><img src="images/24x24/001_41.png" border="0" alt="" align="absmiddle" />CODIGO</th>
                          <th width="41%" scope="col"><img src="images/24x24/001_12.png" border="0" alt="" align="absmiddle" />DESCRIPCION</th>
                          <th width="32%" scope="col"><img src="images/24x24/001_38.png" border="0" alt="" align="absmiddle" />EJECUTAR</th>
                        </tr-->
                        <div id="menu_lista">

                            <h2> 
                              <?php
                                if($_GET['modulo'] == 2000){
                              ?>
                                <img src="img/user office_64x64.png" border="0" alt="Modulo" align="absmiddle"> 
                                 MODULO CLIENTE
                              <?php
                                }elseif ($_GET['modulo'] == 11000) {
                              ?>
                                <img src="img/open document_64x64.png" border="0" alt="Modulo" align="absmiddle"> 
                                 MODULO FONDO DE GARANTIA
                              <?php
                                }elseif ($_GET['modulo'] == 3000) {
                              ?>
                                <img src="img/users group_64x64.png" border="0" alt="Modulo" align="absmiddle"> 
                                 MODULO GRUPO BANCA/SOLIDARIO
                              <?php
                                }elseif ($_GET['modulo'] == 4000) {
                              ?>
                                <img src="img/edit file_64x64.png" border="0" alt="Modulo" align="absmiddle"> 
                                 MODULO CREDITOS
                              <?php
                                }elseif ($_GET['modulo'] == 6000) {
                              ?>
                                <img src="img/windows folder_64x64.png" border="0" alt="Modulo" align="absmiddle"> 
                                 MODULO CARTERA
                              <?php
                                }elseif ($_GET['modulo'] == 8000) {
                              ?>
                                <img src="img/calculator_64x64.png" border="0" alt="Modulo" align="absmiddle"> 
                                 MODULO CONTABILIDAD
                              <?php
                                }elseif ($_GET['modulo'] == 10000) {
                              ?>
                                <img src="img/fax_64x64.png" border="0" alt="Modulo" align="absmiddle"> 
                                 MODULO TESORERIA
								 <?php
                                }elseif ($_GET['modulo'] == 10100) {
                              ?>
                                <img src="img/caja_chica_64x64.png" border="0" alt="Modulo" align="absmiddle"> 
                                 MODULO CAJA CHICA
                               <?php
                                }elseif ($_GET['modulo'] == 20000) {
                              ?>
                                <img src="img/box_64x64.png" border="0" alt="Modulo" align="absmiddle"> 
                                 MODULO ALMACENES
							   <?php
                                }elseif ($_GET['modulo'] == 30000) {
                              ?>
                                <img src="img/import_64x64.png" border="0" alt="Modulo" align="absmiddle"> 
                                 MODULO IMPORTACIONES	 
                              <?php
                                }elseif ($_GET['modulo'] == 40000) {
                                ?>
                                <img src="img/order_64x64.png" border="0" alt="Modulo" align="absmiddle"> 
                                 MODULO VENTAS  
                              <?php

                                }else{
                              ?>
                                <img src="img/applications_64x64.png" border="0" alt="Modulo" align="absmiddle"> 
                                 MODULO GENERAL
                              <?php
                                }
                              ?>
                              
                             
                            </h2>
                          <hr style="border:1px dashed #767676;">

<!--div  muestra la barra  progreso  -->
 <div id="progressbar" align="center"><script language="javascript">
  var bar1 = createBar(340,15, '#FFFFFF', 1, '000', '#999999', 150,7,3, ""); 
  </script>
  </div>
                         <?php
                         while ($linea = mysql_fetch_array($resultado)) {
						    $_SESSION['apli'] = $linea['GRAL_OPC_IMG'];
                          if ($_GET['modulo']==2000) {
                          ?>
                             <div class="menu_item"> 
                                <a href="<?php echo $linea['GRAL_OPC_PRG_NOMBRE']; ?>">
                                <?php
                                  if($linea['GRAL_OPC_PRG_COD']==1){
                                ?>

                                    <img src="img/directories_64x64.png">
                                <?php
                                  }elseif ($linea['GRAL_OPC_PRG_COD']==2) {
                                ?>
                                    <img src="img/tools_64x64.png">
                                <?php
                                  }elseif($linea['GRAL_OPC_PRG_COD']==7){
                                ?>
                                    <img src="img/documents_64x64.png">
                                <?php
                                  }
                                ?>
                                 <hr style="border:1px dashed #767676;">             
                                  <!--Codigo : <?php //echo $linea['GRAL_OPC_PRG_COD']; ?>><br-->
                                  <?php echo $linea['GRAL_OPC_PRG_DESCRIPCION']; ?>
                                </a>
                             <!-- <td><a href="<?php //echo $linea['GRAL_OPC_PRG_NOMBRE']; ?>"><img src=<?php //echo $linea['GRAL_OPC_IMG']; ?>  width="50" height="25"></a></td>-->
                              <!--a href="<?php //echo $linea['GRAL_OPC_PRG_NOMBRE']; ?>"><center><img src="images/24x24/001_37.png"  width="25" height="25" border="0" alt=""/></center></a></td>   
                    </tr-->
                              </div>
                        <?php
                            
                          } elseif ($_GET['modulo']==10000) {

                        ?>
                             <div class="menu_item"> 
                                <a href="<?php echo $linea['GRAL_OPC_PRG_NOMBRE']; ?>">
                                <?php
                                  if($linea['GRAL_OPC_PRG_COD']==1){
                                ?>
                                    <img src="img/directories_64x64.png">
                                <?php
                                  }elseif ($linea['GRAL_OPC_PRG_COD']==2) {
                                ?>
                                    <img src="img/down_64x64.png">
                                <?php
                                  }elseif($linea['GRAL_OPC_PRG_COD']==3){
                                ?>
                                    <img src="img/my documents_64x64.png">
                                <?php
                                  }elseif($linea['GRAL_OPC_PRG_COD']==4){
                                ?>
                                    <img src="img/bancos_64x64.png">
                                <?php
                                  }elseif($linea['GRAL_OPC_PRG_COD']==5){
                                ?>

                                    <img src="img/tools_64x64.png">
                                <?php
                                  }elseif($linea['GRAL_OPC_PRG_COD']==6){
                                ?>
                                    <img src="img/credit card_64x64.png">
                                <?php
                                  }elseif($linea['GRAL_OPC_PRG_COD']==7){
                                ?>
                                    <img src="img/documents_64x64.png">
                                <?php
                                  }elseif($linea['GRAL_OPC_PRG_COD']==8){
                                ?>
                                    <img src="img/move_64x64.png">
                                <?php
                                  }elseif($linea['GRAL_OPC_PRG_COD']==9){
                                ?>
                                    <img src="img/paste_64x64.png">
                                <?php
                                  }elseif($linea['GRAL_OPC_PRG_COD']==10){
                                ?>
                                    <img src="img/import_64x64.png">
                                
                                <?php
                                  }elseif($linea['GRAL_OPC_PRG_COD']==11){
                                ?>
                                    <img src="img/notepad_64x64.png">
                                
                                <?php
                                  }elseif($linea['GRAL_OPC_PRG_COD']==12){
                                ?>
                                    <img src="img/print_64x64.png">
                               
								<?php
                                  }elseif($linea['GRAL_OPC_PRG_COD']==13){
                                ?>
                                    <img src="img/checkera_64x64.png">
                                <?php
                                  }

                                ?>
                                 <hr style="border:1px dashed #767676;">             
                                  <!--Codigo : <?php //echo $linea['GRAL_OPC_PRG_COD']; ?><br-->
                                  <?php echo $linea['GRAL_OPC_PRG_DESCRIPCION']; ?>
                                </a>
                             <!-- <td><a href="<?php //echo $linea['GRAL_OPC_PRG_NOMBRE']; ?>"><img src=<?php //echo $linea['GRAL_OPC_IMG']; ?>  width="50" height="25"></a></td>-->
                              <!--a href="<?php //echo $linea['GRAL_OPC_PRG_NOMBRE']; ?>"><center><img src="images/24x24/001_37.png"  width="25" height="25" border="0" alt=""/></center></a></td>   
                    </tr-->
                              </div>

                          <?php
                          } elseif ($_GET['modulo']==8000) {

                             ?>
                             <div class="menu_item"> 
                                <a href="<?php echo $linea['GRAL_OPC_PRG_NOMBRE']; ?>">
                                <?php
                                  if($linea['GRAL_OPC_PRG_COD']==1){
                                ?>
                                    <img src="img/edit file_64x64.png">
                                <?php
                                  }elseif ($linea['GRAL_OPC_PRG_COD']==3) {
                                ?>
                                    <img src="img/tools_64x64.png">
                                <?php
                                  }elseif($linea['GRAL_OPC_PRG_COD']==7){
                                ?>
                                    <img src="img/documents_64x64.png">
                                <?php
                                  }elseif($linea['GRAL_OPC_PRG_COD']==4){
                                ?>
                                    <img src="img/fax_64x64.png">
                                <?php
                                  }elseif($linea['GRAL_OPC_PRG_COD']==5){
                                ?>
                                    <img src="img/notepad_64x64.png">
                                <?php
                                  }elseif($linea['GRAL_OPC_PRG_COD']==8){
                                ?>
                                    <img src="img/mante_64x64.png">
                                <?php
                                  }elseif($linea['GRAL_OPC_PRG_COD']==9){
                                ?>
                                    <img src="img/my documents_64x64.png">
                                <?php
                                  }elseif($linea['GRAL_OPC_PRG_COD']==10){
                                ?>
                                    <img src="img/documents_64x64.png">
                                <?php
                                  }elseif($linea['GRAL_OPC_PRG_COD']==11){
                                ?>
                                    <img src="img/open document_64x64.png">
                                <?php
                                  }
                                ?>
                                 <hr style="border:1px dashed #767676;">             
                                  <!--Codigo : <?php //echo $linea['GRAL_OPC_PRG_COD']; ?><br-->
                                  <?php echo $linea['GRAL_OPC_PRG_DESCRIPCION']; ?>
                                </a>
                             <!-- <td><a href="<?php //echo $linea['GRAL_OPC_PRG_NOMBRE']; ?>"><img src=<?php //echo $linea['GRAL_OPC_IMG']; ?>  width="50" height="25"></a></td>-->
                              <!--a href="<?php //echo $linea['GRAL_OPC_PRG_NOMBRE']; ?>"><center><img src="images/24x24/001_37.png"  width="25" height="25" border="0" alt=""/></center></a></td>   
                    </tr-->
                          </div>
                        <?php
                            //modulo 6000 empezando a crear
                          }elseif($_GET['modulo']==6000) {

                             ?>
                             <div class="menu_item"> 
                                <a href="<?php echo $linea['GRAL_OPC_PRG_NOMBRE']; ?>">
                                <?php
                                  if($linea['GRAL_OPC_PRG_COD']==1){
                                ?>
                                    <img src="img/forward_64x64.png">
                                <?php
                                  }elseif ($linea['GRAL_OPC_PRG_COD']==2) {
                                ?>
                                    <img src="img/padlock closed_64x64.png">
                                <?php
                                  }elseif($linea['GRAL_OPC_PRG_COD']==3){
                                ?>
                                    <img src="img/search_64x64.png">
                                <?php
                                  }elseif($linea['GRAL_OPC_PRG_COD']==4){
                                ?>
                                    <img src="img/redo_64x64.png">
                                <?php
                                  }elseif($linea['GRAL_OPC_PRG_COD']==5){
                                ?>
                                    <img src="img/notepad_64x64.png">
                                <?php
                                  }elseif($linea['GRAL_OPC_PRG_COD']==6){
                                ?>
                                    <img src="img/directories_64x64.png">
                                <?php
                                  }
                                ?>
                                 <hr style="border:1px dashed #767676;">             
                                  <!--Codigo : <?php //echo $linea['GRAL_OPC_PRG_COD']; ?><br-->
                                  <?php echo $linea['GRAL_OPC_PRG_DESCRIPCION']; ?>
                                </a>
                             <!-- <td><a href="<?php //echo $linea['GRAL_OPC_PRG_NOMBRE']; ?>"><img src=<?php //echo $linea['GRAL_OPC_IMG']; ?>  width="50" height="25"></a></td>-->
                              <!--a href="<?php //echo $linea['GRAL_OPC_PRG_NOMBRE']; ?>"><center><img src="images/24x24/001_37.png"  width="25" height="25" border="0" alt=""/></center></a></td>   
                    </tr-->
                          </div>
                          <?php
                            //modulo 4000 empezando a crear
                          }elseif($_GET['modulo']==4000) {

                             ?>
                             <div class="menu_item"> 
                                <a href="<?php echo $linea['GRAL_OPC_PRG_NOMBRE']; ?>">
                                <?php
                                  if($linea['GRAL_OPC_PRG_COD']==1){
                                ?>
                                    <img src="img/clock_64x64.png">
                                <?php
                                  }elseif ($linea['GRAL_OPC_PRG_COD']==2) {
                                ?>
                                    <img src="img/bancos_64x64.png">
                                <?php
                                  }elseif($linea['GRAL_OPC_PRG_COD']==3){
                                ?>
                                    <img src="img/edit user_64x64.png">
                                <?php
                                  }elseif($linea['GRAL_OPC_PRG_COD']==4){
                                ?>
                                    <img src="img/documents_64x64.png">
                                <?php
                                  }elseif($linea['GRAL_OPC_PRG_COD']==5){
                                ?>
                                    <img src="img/flag red_64x64.png">
                                <?php
                                  }elseif($linea['GRAL_OPC_PRG_COD']==6){
                                ?>
                                    <img src="img/unknown_64x64.png">
                                <?php
                                  }elseif($linea['GRAL_OPC_PRG_COD']==7){
                                ?>
                                    <img src="img/favorites_64x64.png">
                                <?php
                                  }elseif($linea['GRAL_OPC_PRG_COD']==8){
                                ?>
                                    <img src="img/directories_64x64.png">
                                <?php
                                  }
                                ?>
                                 <hr style="border:1px dashed #767676;">             
                                  <!--Codigo : <?php //echo $linea['GRAL_OPC_PRG_COD']; ?><br-->
                                  <?php echo $linea['GRAL_OPC_PRG_DESCRIPCION']; ?>
                                </a>
                             <!-- <td><a href="<?php //echo $linea['GRAL_OPC_PRG_NOMBRE']; ?>"><img src=<?php //echo $linea['GRAL_OPC_IMG']; ?>  width="50" height="25"></a></td>-->
                              <!--a href="<?php //echo $linea['GRAL_OPC_PRG_NOMBRE']; ?>"><center><img src="images/24x24/001_37.png"  width="25" height="25" border="0" alt=""/></center></a></td>   
                    </tr-->
                          </div>
                    
                          <?php
                            //modulo 3000 empezando a crear
                          }elseif($_GET['modulo']==3000) {

                             ?>
                             <div class="menu_item"> 
                                <a href="<?php echo $linea['GRAL_OPC_PRG_NOMBRE']; ?>">
                                <?php
                                  if($linea['GRAL_OPC_PRG_COD']==1){
                                ?>
                                    <img src="img/users group_64x64.png">
                                <?php
                                  }elseif ($linea['GRAL_OPC_PRG_COD']==2) {
                                ?>
                                    <img src="img/user office_64x64.png">
                                <?php
                                  }elseif($linea['GRAL_OPC_PRG_COD']==3){
                                ?>
                                    <img src="img/documents_64x64.png">
                                <?php
                                  }
                                ?>
                                 <hr style="border:1px dashed #767676;">             
                                 <!-- Codigo : <?php //echo $linea['GRAL_OPC_PRG_COD']; ?><br-->
                                  <?php echo $linea['GRAL_OPC_PRG_DESCRIPCION']; ?>
                                </a>
                             <!-- <td><a href="<?php //echo $linea['GRAL_OPC_PRG_NOMBRE']; ?>"><img src=<?php //echo $linea['GRAL_OPC_IMG']; ?>  width="50" height="25"></a></td>-->
                              <!--a href="<?php //echo $linea['GRAL_OPC_PRG_NOMBRE']; ?>"><center><img src="images/24x24/001_37.png"  width="25" height="25" border="0" alt=""/></center></a></td>   
                    </tr-->
                          </div>



                          <?php
                            //modulo 11000 empezando a crear
                          }elseif($_GET['modulo']==11000) {

                             ?>
                             <div class="menu_item"> 
                                <a href="<?php echo $linea['GRAL_OPC_PRG_NOMBRE']; ?>">
                                <?php
                                  if($linea['GRAL_OPC_PRG_COD']==1){
                                ?>
                                    <img src="img/refresh_64x64.png">
                                <?php
                                  }elseif ($linea['GRAL_OPC_PRG_COD']==2) {
                                ?>
                                    <img src="img/documents_64x64.png">
                                <?php
                                  }elseif($linea['GRAL_OPC_PRG_COD']==3){
                                ?>
                                    <img src="img/app folder_64x64.png">
                                <?php
                                  }
                                ?>
                                 <hr style="border:1px dashed #767676;">             
                                  <!--Codigo : <?php //echo $linea['GRAL_OPC_PRG_COD']; ?><br-->
                                  <?php echo $linea['GRAL_OPC_PRG_DESCRIPCION']; ?>
                                </a>
                             <!-- <td><a href="<?php //echo $linea['GRAL_OPC_PRG_NOMBRE']; ?>"><img src=<?php //echo $linea['GRAL_OPC_IMG']; ?>  width="50" height="25"></a></td>-->
                              <!--a href="<?php //echo $linea['GRAL_OPC_PRG_NOMBRE']; ?>"><center><img src="images/24x24/001_37.png"  width="25" height="25" border="0" alt=""/></center></a></td>   
                             </tr-->
                             </div>
 <?php
                            //modulo 11000 empezando a crear Caja Chica
                          }elseif($_GET['modulo']==10100) {
                             ?>
                             <div class="menu_item"> 
                                <a href="<?php echo $linea['GRAL_OPC_PRG_NOMBRE']; ?>">
                                <?php
                                  if($linea['GRAL_OPC_PRG_COD']==1){
								  $_SESSION['detalle'] = 1;
                                ?>
                                    <img src="img/applications_64x64.png">
                                <?php
                                  }elseif ($linea['GRAL_OPC_PRG_COD']==2){
								   $_SESSION['detalle'] = 1;
								   $_SESSION['menu'] = 1 ;
                                ?>
                                    <img src="img/move_64x64.png">
                                <?php
                                  }elseif($linea['GRAL_OPC_PRG_COD']==3){
                                ?>
                                    <img src="img/open document_64x64.png">
                                 <?php
                                  }elseif($linea['GRAL_OPC_PRG_COD']==4){
                                ?>
                                    <img src="img/refresh_64x64.png">
									<?php
                                  }elseif ($linea['GRAL_OPC_PRG_COD']==5){
								   $_SESSION['detalle'] = 1;
								   $_SESSION['menu'] = 1 ;
                                ?>
								<img src="img/export_64x64.png">
								<?php
                                  }elseif($linea['GRAL_OPC_PRG_COD']==6){
                                ?>
                                    <img src="img/import_64x64.png">
                                
                                <?php
                                 }elseif($linea['GRAL_OPC_PRG_COD']==7){
                                ?>
                                    <img src="img/paste_64x64.png">
                                <?php
                                  }
                                ?>
                                 <hr style="border:1px dashed #767676;">             
                                  <!--Codigo : <?php //echo $linea['GRAL_OPC_PRG_COD']; ?><br-->
                                  <?php echo $linea['GRAL_OPC_PRG_DESCRIPCION']; ?>
                                </a>
                             <!-- <td><a href="<?php //echo $linea['GRAL_OPC_PRG_NOMBRE']; ?>"><img src=<?php //echo $linea['GRAL_OPC_IMG']; ?>  width="50" height="25"></a></td>-->
                              <!--a href="<?php //echo $linea['GRAL_OPC_PRG_NOMBRE']; ?>"><center><img src="images/24x24/001_37.png"  width="25" height="25" border="0" alt=""/></center></a></td>   
                             </tr-->
                             </div>
                        <?php
                          }elseif ($_GET['modulo']==20000) {
                          ?>
                             <div class="menu_item"> 
                                <a href="<?php echo $linea['GRAL_OPC_PRG_NOMBRE']; ?>">
                                <?php
                                  if($linea['GRAL_OPC_PRG_COD']==1){
                                ?>

                                    <img src="img/search_64x64.png"weftwetawertera>
                                <?php
                                  }elseif ($linea['GRAL_OPC_PRG_COD']==2) {
                                ?>
                                    <img src="img/provider_64x64.png">
                                <?php
                                  }elseif($linea['GRAL_OPC_PRG_COD']==3){
                                ?>
                                    <img src="img/stuff_64x64.png">
                                <?php
                                  }elseif($linea['GRAL_OPC_PRG_COD']==4){
                                ?>
                                    <img src="img/almacen_64x64.png">
                                <?php
                              }elseif($linea['GRAL_OPC_PRG_COD']==5){
                                ?>
                                    <img src="img/proyecto_64x64.png">
                                <?php
                                  }elseif($linea['GRAL_OPC_PRG_COD']==6){
                                ?>
                                    <img src="img/proyecto_64x64.png">
                                <?php
                                  }
                               
                                ?>
                                 <hr style="border:1px dashed #767676;">             
                                  <!--Codigo : <?php //echo $linea['GRAL_OPC_PRG_COD']; ?>><br-->
                                  <?php echo $linea['GRAL_OPC_PRG_DESCRIPCION']; ?>
                                </a>
                             <!-- <td><a href="<?php //echo $linea['GRAL_OPC_PRG_NOMBRE']; ?>"><img src=<?php //echo $linea['GRAL_OPC_IMG']; ?>  width="50" height="25"></a></td>-->
                              <!--a href="<?php //echo $linea['GRAL_OPC_PRG_NOMBRE']; ?>"><center><img src="images/24x24/001_37.png"  width="25" height="25" border="0" alt=""/></center></a></td>   
                    </tr-->
                              </div>
						 <?php
                          }elseif ($_GET['modulo']==30000) {
                          ?>
                             <div class="menu_item"> 
                                <a href="<?php echo $linea['GRAL_OPC_PRG_NOMBRE']; ?>">
                                <?php
                                  if($linea['GRAL_OPC_PRG_COD']==1){
                                ?>
                                    <img src="img/agencia_64x64.png">
                                <?php
                                  }elseif ($linea['GRAL_OPC_PRG_COD']==2) {
                                ?>
                                    <img src="img/provider_64x64.png">
                                <?php
                                  }elseif($linea['GRAL_OPC_PRG_COD']==3){
                                ?>
                                    <img src="img/ges_imp_64x64.png">

                                <?php
                                  }elseif($linea['GRAL_OPC_PRG_COD']==4){
                                ?>
                                    <img src="img/agencia_64x64.png">
                                <?php
                              }elseif($linea['GRAL_OPC_PRG_COD']==5){
                                ?>
                                    <img src="img/proyecto_64x64.png">
                                <?php
                                  }
                               
                                ?>
                                 <hr style="border:1px dashed #767676;">             
                                  <!--Codigo : <?php //echo $linea['GRAL_OPC_PRG_COD']; ?>><br-->
                                  <?php echo $linea['GRAL_OPC_PRG_DESCRIPCION']; ?>
                                </a>
                             <!-- <td><a href="<?php //echo $linea['GRAL_OPC_PRG_NOMBRE']; ?>"><img src=<?php //echo $linea['GRAL_OPC_IMG']; ?>  width="50" height="25"></a></td>-->
                              <!--a href="<?php //echo $linea['GRAL_OPC_PRG_NOMBRE']; ?>"><center><img src="images/24x24/001_37.png"  width="25" height="25" border="0" alt=""/></center></a></td>   
                    </tr-->
                              </div>	  
                        <?php
                            
                          }elseif($_GET['modulo']==40000) {
                          ?>
                             <div class="menu_item"> 
                                <a href="<?php echo $linea['GRAL_OPC_PRG_NOMBRE']; ?>">
                                <?php
                                  if($linea['GRAL_OPC_PRG_COD']==1){
                                ?>
                                    <img src="img/ventas_64x64.png">
                                <?php
                                  }
                               
                                ?>
                                 <hr style="border:1px dashed #767676;">             
                                  <!--Codigo : <?php //echo $linea['GRAL_OPC_PRG_COD']; ?>><br-->
                                  <?php echo $linea['GRAL_OPC_PRG_DESCRIPCION']; ?>
                                </a>
                             <!-- <td><a href="<?php //echo $linea['GRAL_OPC_PRG_NOMBRE']; ?>"><img src=<?php //echo $linea['GRAL_OPC_IMG']; ?>  width="50" height="25"></a></td>-->
                              <!--a href="<?php //echo $linea['GRAL_OPC_PRG_NOMBRE']; ?>"><center><img src="images/24x24/001_37.png"  width="25" height="25" border="0" alt=""/></center></a></td>   
                    </tr-->
                              </div>    
                        <?php
                          } else{
                        ?>
                             <div class="menu_item"> 
                             
                                <a href="<?php echo $linea['GRAL_OPC_PRG_NOMBRE']; ?>" onClick="return ValidarBarraProgreso(this)">
                                <?php
                                  if($linea['GRAL_OPC_PRG_COD']==1){
                                ?>
                                    <img src="img/calendar_64x64.png">
                                <?php
                                  }elseif ($linea['GRAL_OPC_PRG_COD']==2) {
                                ?>
                                    <img src="img/tools_64x64.png">
                                <?php
                                  }elseif($linea['GRAL_OPC_PRG_COD']==7){
                                ?>
                                    <img src="img/documents_64x64.png" onClick="return ValidarBarraProgreso(this)">
                                    
                                <?php
                                  }
                                ?>
                                 <hr style="border:1px dashed #767676;">             
                                  <!--Codigo : <?php //echo $linea['GRAL_OPC_PRG_COD']; ?><br-->
                                  <?php echo $linea['GRAL_OPC_PRG_DESCRIPCION']; ?>
                                </a>
                             <!-- <td><a href="<?php //echo $linea['GRAL_OPC_PRG_NOMBRE']; ?>"><img src=<?php //echo $linea['GRAL_OPC_IMG']; ?>  width="50" height="25"></a></td>-->
                              <!--a href="<?php //echo $linea['GRAL_OPC_PRG_NOMBRE']; ?>"><center><img src="images/24x24/001_37.png"  width="25" height="25" border="0" alt=""/></center></a></td>   
                    </tr-->
                          </div>



                        <?php
                          }

                        } 
                        ?>
                      <!--/table-->
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