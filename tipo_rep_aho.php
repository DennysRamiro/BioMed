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
<title>Tipo Reporte</title>
<meta charset="UTF-8">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script>
<script type="text/javascript" src="js/reportes_fondo_det_fon.js"></script>   
<script type="text/javascript" src="js/mant_cuenta_sal_min.js"></script>  

<link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
        <script src="script/jquery-ui.js"></script>
        <script type="text/javascript" src="js/calendario.js"></script>
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
                 <li id="menu_modulo_general_fondo">
                    
                     <img src="img/open document_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. FONDO GARANTIA 
                    
                 </li>
                  <?php
                if($_GET["menu"]==3){?> 
                 <li id="menu_modulo_reportes_fondo">
                    
                     <img src="img/documents_32x32.png" border="0" alt="Modulo" align="absmiddle"> REP. FONDO GARANTIA
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/copy_32x32.png" border="0" alt="Modulo" align="absmiddle"> DET. FONDO GARANTIA
                    
                 </li>
              </ul> 
             
     <div id="contenido_modulo">
                      <h2> <img src="img/copy_64x64.png" border="0" alt="Modulo" align="absmiddle">DETALLE FONDO DE GARANTIA</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/alert_32x32.png" align="absmiddle">
                     Ingrese la fecha de vencimiento
                     </div> 
              <?php } elseif($_GET["menu"]==4){?> 
                  <li id="menu_modulo_reportes_fondo">
                    
                     <img src="img/documents_32x32.png" border="0" alt="Modulo" align="absmiddle"> REP. FONDO GARANTIA
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/credit card_32x32.png" border="0" alt="Modulo" align="absmiddle"> FON. GAR. CRED. CAN.
                    
                 </li>
              </ul> 
             
     <div id="contenido_modulo">
                      <h2> <img src="img/credit card_64x64.png" border="0" alt="Modulo" align="absmiddle">DETALLE FONDO DE GARANTIA CON CREDITOS CANCELADOS</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/alert_32x32.png" align="absmiddle">
                     Ingrese la fecha de vencimiento
                     </div> 
              <?php } elseif($_GET["menu"]==5){?> 

              <li id="menu_modulo_mant_cuenta">
                    
                     <img src="img/app folder_32x32.png" border="0" alt="Modulo" align="absmiddle"> MANT. CUENTA
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/padlock closed_32x32.png" border="0" alt="Modulo" align="absmiddle"> CIERRE CTAS SAL. MIN.
                    
                 </li>
              </ul> 
             
     <div id="contenido_modulo">
                      <h2> <img src="img/padlock closed_64x64.png" border="0" alt="Modulo" align="absmiddle">CIERRE DE CUENTAS SALDOS MINIMOS</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/alert_32x32.png" align="absmiddle">
                     Ingrese la fecha de vencimiento
                     </div> 
                     <?php }?>       
  <br>

<?php
        //echo $_SESSION['vig_can']."tipo" ;
                 //$fec = leer_param_gral();
                 $logi = $_SESSION['login']; 
         $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD <> 0 ";
                 $res_mon = mysql_query($con_mon);
                ?> 





	<!--<form name="form2" method="post" action="grab_retro_cli.php" onSubmit="return ValidaCampos(this)">-->
<?php if ($_SESSION['vig_can'] == 1){?>
    <form name="form2" method="post" action="fgar_rep_det.php" onSubmit="return       ValidarCamposUsuario(this)">
	<?php } ?>
<?php if ($_SESSION['vig_can'] == 2){?>
    <form name="form2" method="post" action="fgar_rep_can.php?menu=2" onSubmit="return       ValidarCamposUsuario(this)">
	<?php } ?>
<?php if ($_SESSION['vig_can'] == 3){?>
    <form name="form2" method="post" action="fgar_retro_op.php" onSubmit="return       ValidarCamposUsuario(this)">
	<?php } ?>	
         <strong>Fecha Calculo</strong>
         <input class="txt_campo" id="datepicker" type="text" name="fec_nac" maxlength="10"  size="10" > 

			   <BR><br>
			   <strong>Moneda  </strong>
		      <?php echo encadenar(8);?>
            <select name="cod_mon" size="1"  >
   	          <?php while ($linea = mysql_fetch_array($res_mon)) {?>
                        <option value=<?php echo $linea['GRAL_PAR_INT_COD']; ?>>
			                   <?php echo $linea['GRAL_PAR_INT_DESC']; ?></option>
	             <?php } ?>
		        </select>
			  
        <BR><br>
			  <strong>Solo Castigados</strong>
			     <INPUT NAME="ccas" TYPE=RADIO VALUE="S">
			   <BR>
			
      <?php if ($_SESSION['vig_can'] > 1){ ?>
			         <strong>Importe Hasta  </strong>
		           <?php echo encadenar(5);?>
         	      <input class="txt_campo" type="text" name="imp_sol" maxlength="12" size="12" value="" >
			<?php }?>

      <br>
	   
      <?php if ($_SESSION['vig_can'] >= 1){?>
	             <input class="btn_form" type="submit" name="accion" value="Procesar">
	     <?php }?>

	    <?php if ($_SESSION['vig_can'] == 3){?>
	             <input class="btn_form" type="submit" name="accion" value="Reporte">
	             <input class="btn_form" type="submit" name="accion" value="Cerrar">
	     <?php }?>
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