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
<title>Mayores de Cuenta</title>

<meta charset="UTF-8">
<link href="css/estilo.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script type="text/javascript" src="js/contabilidad_reportes.js"></script> 
 <link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
<script src="script/jquery-ui.js"></script>

</head> <?php
      include("header.php");
  ?>
<div id="pagina_sistema">
     <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS                 
				 </li>
                 <li id="menu_modulo_contabilidad">
                    
                     <img src="img/calculator_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. CONTABILIDAD                 
				 </li>

          <?php if($_SESSION['menu'] == 36){?>

                  <li id="menu_modulo_cont_reportes">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> CONTAB. REPORTES                 
				 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/my documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> MAYOR DE CUENTAS                 
				 </li>
				 
					 
  </ul>  
              <div id="menu_lista">

                      <h2> <img src="img/my documents_64x64.png" border="0" alt="Modulo" align="absmiddle"> MAYOR DE CUENTAS</h2>

                      <hr style="border:1px dashed #767676;">
                       <!--div id="error_login"> 
                          <img src="img/alert_32x32.png" align="absmiddle">
                          Mayor por Cuenta /  Mayor por Monedas / Mayor Rango de Cuentas
                      </div-->
          <?php } elseif($_SESSION['menu'] == 44){?>
           <li id="menu_modulo_gest">
                    
                     <img src="img/open document_24x24.png" border="0" alt="Modulo" align="absmiddle"> REP. GEST. PASADAS
                    
             </li>
                    <li id="menu_modulo_cont_reportesotro">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> CONTAB. REPORTES
                    
                </li>
                    <li id="menu_modulo_fecha">
                    
                     <img src="img/my documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> MAYOR DE CUENTAS                 
                </li>
         
           
           </ul>  
              <div id="menu_lista">

                      <h2> <img src="img/my documents_64x64.png" border="0" alt="Modulo" align="absmiddle"> MAYOR DE CUENTAS</h2>

                      <hr style="border:1px dashed #767676;">
                       <!--div id="error_login"> 
                          <img src="img/alert_32x32.png" align="absmiddle">
                          Mayor por Cuenta /  Mayor por Monedas / Mayor Rango de Cuentas
                      </div-->

                      <?php }?>

      <?php


 //$_SESSION['gestion'] = echo $_SESSION['gestion']; ?>
                      
                     <?php
                         $fec = $_SESSION['fec_proc'];//leer_param_gral();
                         $logi = $_SESSION['login'];
                    	   $_SESSION['egre_bs_sus'] = 0; 
                    	   $fec1 = cambiaf_a_mysql_2($fec);
                    	   if (isset( $_SESSION['anio'])){
                            $gestion = $_SESSION['anio'];
                    	   }else{
                          $gestion = 2011;
                        }
                     ?> 
<center>

<?php
    // echo "Gestion".encadenar(2).$gestion;
	?>

                     <?php if($_SESSION['menu'] == 36){?>
                          <div class="menu_item">
                                <a href="cont_rep_op.php?accion=7"> 
                                    <img src="img/user office_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                  Mayor por Cuenta 
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="cont_rep_op.php?accion=8"> 
                                    <img src="img/credit card_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                  Mayor por Monedas
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="cont_rep_op.php?accion=9"> 
                                    <img src="img/users group_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                  Mayor Rango de Cuentas
                                </a>
                         </div>

                    <?php } elseif($_SESSION['menu'] == 44){?>
                          <div class="menu_item">
                                <a href="cont_rep_op.php?accion=29"> 
                                    <img src="img/user office_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                  Mayor por Cuenta
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="cont_rep_op.php?accion=30"> 
                                    <img src="img/credit card_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                  Mayor por Monedas
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="cont_rep_op.php?accion=31"> 
                                    <img src="img/users group_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                  Mayor Rango de Cuentas
                                </a>
                         </div>
                   <?php }?>
             <!--ul>
    			<li><a href="cont_rep_op.php?accion=7">Mayor por Cuenta</a></li>
                <li><a href="cont_rep_op.php?accion=8">Mayor por Monedas </a></li>
				<li><a href="cont_rep_op.php?accion=9">Mayor Rango de Cuentas</a></li>
               
   		    </ul-->

          </center>
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