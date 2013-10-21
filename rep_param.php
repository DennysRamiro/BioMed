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
<title>Tipo Reporte</title>
<meta charset="UTF-8">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script>  
<script type="text/javascript" src="js/reportes_fondo_det_mov.js"></script> 
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script type="text/javascript" src="js/ModulosCartera.js"></script>
<script type="text/javascript" src="js/ModulosContabilidad.js"></script>
<script type="text/javascript" src="js/Utilitarios.js"></script> 

<link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
        <script src="script/jquery-ui.js"></script>
        <script type="text/javascript" src="js/calendario.js"></script>
</head>
<body>	
<div id="dialog-confirm" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Fecha Desde no puede estar vacio.</font></p>
</div>

<div id="dialog-confirm2" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Fecha Hasta no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm3" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Fecha Desde no puede ser mayor que la Fecha Hasta.</font></p>
</div>
</div>
<div id="dialog-confirm4" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Fecha Desde no puede ser mayor a la Fecha Actual.</font></p>
</div>
<div id="dialog-confirm5" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Fecha Hasta no puede ser mayor a la Fecha Actual.</font></p>
</div>
	<?php
		include("header.php");
	?>
	<div id="pagina_sistema">
<!--Menu izquierdo de los modulos-->
      <ul id="lista_menu">      
                  <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>
                  <?php
					if($_GET["menu"]==5){?> 
					 <li id="menu_modulo_general_fondo">
                    
                     <img src="img/open document_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. FONDO GARANTIA 
                    
                 </li>
                  <li id="menu_modulo_reportes_fondo">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> REP. FONDO GARANTIA
                    
                 </li>
 				 <li id="menu_modulo_fecha">
                    
                     <img src="img/edit file_24x24.png" border="0" alt="Modulo" align="absmiddle"> DET. MOVIMIENTOS
                 </li>
              	  </ul> 
             
    			 <div id="contenido_modulo">
                      <h2> <img src="img/edit file_64x64.png" border="0" alt="Modulo" align="absmiddle">DETALLE DE MOVIMIENTOS</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/checkmark_32x32.png" align="absmiddle">
                     Ingrese la fecha de vencimiento
                     </div> 
                 <!--CARTERA--> 
        
    <?php } elseif($_GET["menu"]==1){?>  
                 <li id="menu_modulo_general">
                    
                     <img src="img/windows folder_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CARTERA
                    
                 </li>

                 <li id="menu_modulo_cartera_resumenCartera">
                    
                     <img src="img/notepad_24x24.png" border="0" alt="Modulo" align="absmiddle"> REPORTE CARTERA
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/close_24x24.png" border="0" alt="Modulo" align="absmiddle"> DETALLE RECUPERACIONES
                    
                 </li>
              </ul>  
 <div id="contenido_modulo">
     
                      <h2> <img src="img/close_64x64.png" border="0" alt="Modulo" align="absmiddle">DETALLE RECUPERACIONES</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/checkmark_32x32.png" align="absmiddle">
                     Ingrese la fecha de vencimiento
                     </div>
               
  <?php } elseif($_GET["menu"]==2){?>  
                 <li id="menu_modulo_general">
                    
                     <img src="img/windows folder_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CARTERA
                    
                 </li>

                 <li id="menu_modulo_cartera_resumenCartera">
                    
                     <img src="img/notepad_24x24.png" border="0" alt="Modulo" align="absmiddle"> REPORTE CARTERA
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/close_24x24.png" border="0" alt="Modulo" align="absmiddle"> DETALLE DESEMBOLSOS
                    
                 </li>
              </ul>  
 <div id="contenido_modulo">
     
                      <h2> <img src="img/close_64x64.png" border="0" alt="Modulo" align="absmiddle">DETALLE DESEMBOLSOS</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/checkmark_32x32.png" align="absmiddle">
                     Ingrese la fecha de vencimiento
                     </div>
 <?php } elseif($_GET["menu"]==3){?>  
                 <li id="menu_modulo_general">
                    
                     <img src="img/windows folder_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CARTERA
                    
                 </li>

                 <li id="menu_modulo_cartera_resumenCartera">
                    
                     <img src="img/notepad_24x24.png" border="0" alt="Modulo" align="absmiddle"> REPORTE CARTERA
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/close_24x24.png" border="0" alt="Modulo" align="absmiddle"> DETALLE CONDONACIONES
                    
                 </li>
              </ul>  
 <div id="contenido_modulo">
     
                      <h2> <img src="img/close_64x64.png" border="0" alt="Modulo" align="absmiddle">DETALLE DE CONDONACIONES</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/checkmark_32x32.png" align="absmiddle">
                     Ingrese la fecha de vencimiento
                     </div>
              
<?php } elseif($_GET["menu"]==4){?>  
                 <li id="menu_modulo_general">
                    
                     <img src="img/windows folder_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CARTERA
                    
                 </li>

                 <li id="menu_modulo_cartera_resumenCartera">
                    
                     <img src="img/notepad_24x24.png" border="0" alt="Modulo" align="absmiddle"> REPORTE CARTERA
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/close_24x24.png" border="0" alt="Modulo" align="absmiddle"> DET. INGRESOS FAC
                    
                 </li>
              </ul>  
 <div id="contenido_modulo">
     
                      <h2> <img src="img/close_64x64.png" border="0" alt="Modulo" align="absmiddle">DETALLE DE INGRESOS FACTURABLES</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/checkmark_32x32.png" align="absmiddle">
                     Ingrese la fecha de vencimiento
                     </div>
               
  <?php } elseif($_GET["menu"]==6){?>  
                 <li id="menu_modulo_general">
                    
                     <img src="img/windows folder_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CARTERA
                    
                 </li>

                 <li id="menu_modulo_cartera_resumenCartera">
                    
                     <img src="img/notepad_24x24.png" border="0" alt="Modulo" align="absmiddle"> REPORTE CARTERA
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/close_24x24.png" border="0" alt="Modulo" align="absmiddle"> DET. CRED. HISTORICOS
                    
                 </li>
              </ul>  
 <div id="contenido_modulo">
     
                      <h2> <img src="img/close_64x64.png" border="0" alt="Modulo" align="absmiddle">DETALLE DE CREDITOS HISTORICOS</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/checkmark_32x32.png" align="absmiddle">
                     Ingrese la fecha de vencimiento
                     </div>
                 
 <?php } elseif($_GET["menu"]==7){?>  
                 <li id="menu_modulo_general">
                    
                     <img src="img/windows folder_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CARTERA
                    
                 </li>

                 <li id="menu_modulo_cartera_resumenCartera">
                    
                     <img src="img/notepad_24x24.png" border="0" alt="Modulo" align="absmiddle"> REPORTE CARTERA
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/close_24x24.png" border="0" alt="Modulo" align="absmiddle"> DET. CRED. CANCELADOS
                    
                 </li>
              </ul>  
 <div id="contenido_modulo">
     
                      <h2> <img src="img/close_64x64.png" border="0" alt="Modulo" align="absmiddle">DETALLE DE CREDITOS CANCELADOS</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/checkmark_32x32.png" align="absmiddle">
                     Ingrese la fecha de vencimiento
                     </div>
                   
<?php } elseif($_GET["menu"]==8){?>  
                 <li id="menu_modulo_general">
                    
                     <img src="img/windows folder_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CARTERA
                    
                 </li>

                 <li id="menu_modulo_cartera_resumenCartera">
                    
                     <img src="img/notepad_24x24.png" border="0" alt="Modulo" align="absmiddle"> REPORTE CARTERA
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/close_24x24.png" border="0" alt="Modulo" align="absmiddle"> DET. INGRESO DEVENGADO
                    
                 </li>
              </ul>  
 <div id="contenido_modulo">
     
                      <h2> <img src="img/close_64x64.png" border="0" alt="Modulo" align="absmiddle">DETALLE INGRESO DEVENGADO</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/checkmark_32x32.png" align="absmiddle">
                     Ingrese la fecha de vencimiento
                     </div>

<?php } elseif($_GET["menu"]==9){?>  
                 <li id="menu_modulo_contabilidad">
                    
                     <img src="img/calculator_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. CONTABILIDAD
                    
                 </li>

                 <li id="menu_modulo_contabilidad_facturacion_recibos">
                    
                     <img src="img/notepad_24x24.png" border="0" alt="Modulo" align="absmiddle"> RECIBOS
                    
                 </li>
                 <li id="menu_modulo_contabilidad_recibos_reportes">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> REPORTES
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/directories_24x24.png" border="0" alt="Modulo" align="absmiddle"> REC. UTIL. FECHAS
                    
                 </li>
              </ul>  
 <div id="contenido_modulo">
     
                      <h2> <img src="img/directories_64x64.png" border="0" alt="Modulo" align="absmiddle">RECIBOS UTILIZADOS POR FECHAS</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/checkmark_32x32.png" align="absmiddle">
                     Ingrese las fechas de los recibos utilizados
                     </div>
                     <?php }?>

 <center>
    <br>
	<?php if ($_SESSION["tipo_rep"] == 1) {  ?>
		  
	          <form name="form2" method="post" action="cart_prox_vto.php" onSubmit="return ValidarRangoFechas(this)">
	<?php	}  ?>
	<?php if ($_SESSION["tipo_rep"] == 2) {  ?>
			 
           	<!--a href="cart_reportes.php"><img src="images/24mx24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a-->
           
		 
	          <form name="form2" method="post" action="cart_det_rec.php" onSubmit="return ValidarRangoFechas(this)">
	<?php	}  ?>			 
  <?php if ($_SESSION["tipo_rep"] == 3) {  ?>
		 
	          <form name="form2" method="post" action="cart_det_des.php" onSubmit="return ValidarRangoFechas(this)">
	<?php	}  ?>	
<?php if ($_SESSION["tipo_rep"] == 4) {  ?>
		 
	          <form name="form2" method="post" action="fgar_det_mov.php" onSubmit="return ValidarRangoFechas(this)">
	<?php	}  ?>	
<?php if ($_SESSION["tipo_rep"] == 5) {  ?>
			 
           	<!--a href="cart_reportes.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a-->
		 
	          <form name="form2" method="post" action="ingegr_mov_det.php" onSubmit="return ValidarRangoFechas(this)">
	<?php	}  ?>	
<?php if ($_SESSION["tipo_rep"] == 6) {  ?>
			 
           	<!--a href="cart_reportes.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a-->
	          <form name="form2" method="post" action="caja_mov_det.php" onSubmit="return ValidarRangoFechas(this)">
	<?php	}  ?>
	<?php if ($_SESSION["tipo_rep"] == 7) {  ?>
			 
          	<!--a href="cart_reportes.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a-->
	          <form name="form2" method="post" action="cart_det_con.php" onSubmit="return ValidarRangoFechas(this)">
	<?php	}  ?>		
	<?php if ($_SESSION["tipo_rep"] == 10) {  ?>
			
           	<!--a href="cart_reportes.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a-->
	          <form name="form2" method="post" action="cart_det_rec_f.php" onSubmit="return ValidarRangoFechas(this)">
	<?php	}  ?>
		<?php if ($_SESSION["tipo_rep"] == 11) {  ?>
			
           	<!--a href="cart_reportes.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a-->
	          <form name="form2" method="post" action="cart_det_his.php" onSubmit="return ValidarRangoFechas(this)">
	<?php	}  ?>	
	<?php if ($_SESSION["tipo_rep"] == 12) {  ?>
			 
           	<!--a href="cart_reportes.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a-->
	          <form name="form2" method="post" action="cart_rep_can.php" onSubmit="return ValidarRangoFechas(this)">
	<?php	}  ?>
	<?php if ($_SESSION["tipo_rep"] == 13) {  ?>
		
           		<!--a href="cart_reportes.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a-->
	          <form name="form2" method="post" action="cart_det_dev.php" onSubmit="return ValidarRangoFechas(this)">
	<?php	}  ?>
	<?php if ($_SESSION["tipo_rep"] == 20) {  ?>
			
           	<!--a href="cart_reportes.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a-->
	          <form name="form2" method="post" action="rec_utilizados.php" onSubmit="return ValidarRangoFechas(this)">
	<?php	}  ?>							
	<?php
	if(isset($_SESSION['msj_error'])){	
	   echo $_SESSION['msj_error']; 
	   }
	?>		
	<center>
	      <strong>Fecha Desde:</strong>
         <input class="txt_campo" id="datepicker" type="text" name="fec_des" maxlength="10"  size="10" > 
        
			 <BR><br>
		 <strong>Fecha Hasta:</strong>
         <input class="txt_campo" id="datepicker2" type="text" name="fec_has" maxlength="10"  size="10" > 
         	
	  <BR><br>
	  <?php if ($_SESSION["tipo_rep"] <> 20) {  ?>
  <strong>Moneda: </strong>
		    <?php echo encadenar(6);?>
            <select  name="cod_mon" size="1"  >
   	         <?php while ($linea = mysql_fetch_array($res_mon)) {?>
             <option value=<?php echo $linea['GRAL_PAR_INT_COD']; ?>>
			 <?php echo $linea['GRAL_PAR_INT_DESC']; ?></option>
	         <?php } ?>
		     </select>
	<?php	}  ?>		 
	  <input class="btn_form" type="submit" name="accion" value="Consultar">
	  </center>
    </form>
   </center>
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