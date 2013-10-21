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
<!--Titulo de la pesta�a de la pagina-->
<title>Ingrese Numero de Operaci�n</title>
<meta charset="UTF-8">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css"> 
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script>
<script type="text/javascript" src="js/Modulo_fondo.js"></script> 
<script type="text/javascript" src="js/mant_cuenta_rel_cred.js"></script>
<script type="text/javascript" src="js/cjas_cart_dir_num.js"></script>  
<meta charset="UTF-8">
</head>
<body>	

    <?php
                include("header.php");
            ?>

	            <?php
                // $fec = leer_param_gral();
                 $logi = $_SESSION['login']; 
				 $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD <> 0 ";
                 $res_mon = mysql_query($con_mon);

                ?> 
		
          
          
           <div id="pagina_sistema">
<!--Menu izquierdo de los modulos-->     
        <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>
                 <?php
                      if($_GET["menu"]==1){?> 
                      <li id="menu_modulo_general">
                    
                     <img src="img/windows folder_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CARTERA 
                    
                 </li>
                 
                          <li id="menu_modulo_fecha">
                    
                     <img src="img/search_32x32.png" border="0" alt="Modulo" align="absmiddle"> CONS. OPERACIONES
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/phone_32x32.png" border="0" alt="Modulo" align="absmiddle"> POR NUMERO OPE.
                    
                 </li>
                   </ul>  
                       <div id="contenido_modulo">
                        <h2> <img src="img/phone_64x64.png" border="0" alt="Modulo" align="absmiddle">POR NUMERO  OPERACION</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
                         <img src="img/alert_32x32.png" align="absmiddle">
                       Numero Operacion / Cuenta 
                      </div>

                     <?php }elseif ($_GET["menu"]==2) { ?>
                         
                         <li id="menu_modulo_general_fondo">
                    
                              <img src="img/open document_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD.FONDO GARANTIA
                    
                        </li>
                        <li id="menu_modulo_dep_ret">
                    
                             <img src="img/refresh_32x32.png" border="0" alt="Modulo" align="absmiddle"> DEPOSITO RETIROS
                    
                        </li>
                        <li id="menu_modulo_fondo_numero">
                    
                             <img src="img/phone_32x32.png" border="0" alt="Modulo" align="absmiddle"> NUMERO OPERACION
                    
                        </li>

                    </ul>  
                    <div id="contenido_modulo">
                          <h2> <img src="img/phone_64x64.png" border="0" alt="Modulo" align="absmiddle">POR NUMERO  OPERACION</h2>
                          <hr style="border:1px dashed #767676;">
                          <div id="error_login"> 
                              <img src="img/alert_32x32.png" align="absmiddle">
                                   Numero Operacion / Cuenta 
                          </div>
                          <?php }elseif ($_GET["menu"]==3) { ?>
                         
                         <li id="menu_modulo_general_fondo">
                    
                              <img src="img/open document_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD.FONDO GARANTIA
                    
                        </li>
                        <li id="menu_modulo_mant_cuenta">
                    
                             <img src="img/app folder_32x32.png" border="0" alt="Modulo" align="absmiddle"> MANT. CUENTA
                    
                        </li>
                        <li id="menu_modulo_fondo_numero">
                    
                             <img src="img/credit card_32x32.png" border="0" alt="Modulo" align="absmiddle"> REL. CON CREDITO
                    
                        </li>

                    </ul>  
                    <div id="contenido_modulo">
                          <h2> <img src="img/credit card_64x64.png" border="0" alt="Modulo" align="absmiddle">RELACIONAR CON CREDITO</h2>
                          <hr style="border:1px dashed #767676;">
                          <div id="error_login"> 
                              <img src="img/alert_32x32.png" align="absmiddle">
                                   Numero Operacion / Cuenta 
                          </div>
                           <?php }elseif ($_GET["menu"]==13) { ?>
                  <li id="menu_modulo_cjas">
                    
                     <img src="img/fax_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CAJAS
                    
                 </li>
                  <li id="menu_modulo_cjas_cartera">
                    
                     <img src="img/my documents_32x32.png" border="0" alt="Modulo" align="absmiddle"> COBROS CARTERA
                    
                 </li>
                 <li id="menu_modulo_cjas_cartera_directo">
                    
                     <img src="img/search_32x32.png" border="0" alt="Modulo" align="absmiddle"> DIRECTO
                    
                 </li>
                   <li id="menu_modulo_fecha">
                    
                     <img src="img/phone_32x32.png" border="0" alt="Modulo" align="absmiddle"> POR NUM. OPERACION
                    
                 </li>
              </ul>  
  
                <div id="contenido_modulo">

                      <h2> <img src="img/phone_64x64.png" border="0" alt="Modulo" align="absmiddle">POR NUMERO DE OPERACION</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
                              <img src="img/alert_32x32.png" align="absmiddle">
                                   Numero Operacion / Cuenta 
                          </div>


                     <?php } ?>
                  
                 
             

	<!--<form name="form2" method="post" action="grab_retro_cli.php" onSubmit="return ValidaCampos(this)">-->
	
	<br>
<?php if ($_SESSION["tip_cta"] == 1) {  ?>
    <form name="form2" method="post" action="cobro_pag_det.php" onSubmit="return ValidarCamposUsuario(this)">
	<strong>Numero Operacion</strong>
         <input class="txt_campo" type="text" name="nro_ope" maxlength="12"  size="12" >
            	
<?php	}  ?>
<?php if ($_SESSION["tip_cta"] == 2) {  ?>
    <form name="form2" method="post" action="fgar_imp_kar.php" onSubmit="return ValidarCamposUsuario(this)">
	     <strong>Numero Cuenta</strong>
         <input class="txt_campo" type="text" name="nro_cta" maxlength="12"  size="12" >
<?php	}  ?>

			 <BR><br>
	  <input class="btn_form" type="submit" name="accion" value="Buscar">
    </form>
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