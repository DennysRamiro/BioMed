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
<script type="text/javascript" src="js/cjas_chequeras.js"></script> 
<script type="text/javascript" src="js/cjas_depret_depbs.js"></script>  
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
                  <li id="menu_modulo_cjas">
                    
                     <img src="img/fax_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO TESORERIA
                    
                 </li>
                 <li id="menu_modulo_cjas_chequera">
                    
                     <img src="img/checkera_24x24.png" border="0" alt="Modulo" align="absmiddle"> MANT.CHEQUERA
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/compra_24x24.png" border="0" alt="Modulo" align="absmiddle"> REPORTES CHEQUERA
                    
                 </li>
              </ul>  
             
    			 <div id="contenido_modulo">
				 <?php if ($_SESSION["tipo_rep"] == 20) {  ?>
                      <h2> <img src="img/edit file_64x64.png" border="0" alt="Modulo" align="absmiddle">DETALLE DE MOVIMIENTOS CHEQUES</h2>
					  <?php	}  ?>	
					  <?php if ($_SESSION["tipo_rep"] == 21) {  ?>
                      <h2> <img src="img/edit file_64x64.png" border="0" alt="Modulo" align="absmiddle">CONCILIACION POR CUENTA</h2>
					  <?php	}  ?>
					   <?php if ($_SESSION["tipo_rep"] == 22) {  ?>
                      <h2> <img src="img/edit file_64x64.png" border="0" alt="Modulo" align="absmiddle">DETALLE DE CHEQUES NO UTILIZADOS</h2>
					  <?php	}  ?>		 
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/checkmark_32x32.png" align="absmiddle">
                     Ingrese rango de Fechas y Cuenta de Banco
                     </div> 
                 <!--CARTERA--> 
        
   
               
  
 
              

               
 
                 
         




 <center>
    <br>
		
	<?php if ($_SESSION["tipo_rep"] == 20) {  ?>
			
           	<!--a href="cart_reportes.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a-->
	          <form name="form2" method="post" action="cheq_utilizados.php" onSubmit="return ValidarRangoFechas(this)">
	<?php	}  ?>	
	<?php if ($_SESSION["tipo_rep"] == 21) {  ?>
			
           	<!--a href="cart_reportes.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a-->
	          <form name="form2" method="post" action="bco_concilia.php" onSubmit="return ValidarRangoFechas(this)">
	<?php	}  ?>	
	<?php if ($_SESSION["tipo_rep"] == 22) {  ?>
			
           	<!--a href="cart_reportes.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a-->
	          <form name="form2" method="post" action="cheq_no_utilizados.php" onSubmit="return ValidarRangoFechas(this)">
	<?php	}  ?>							
	<?php
	if(isset($_SESSION['msj_error'])){	
	   echo $_SESSION['msj_error']; 
	   }
	?>		
	<center>
	  <?php if ($_SESSION["tipo_rep"] <> 22) {  ?>
	      <strong>Fecha Desde:</strong>
         <input class="txt_campo" id="datepicker" type="text" name="fec_des" maxlength="10"  size="10" > 
        
			 <BR><br>
		 <strong>Fecha Hasta:</strong>
         <input class="txt_campo" id="datepicker2" type="text" name="fec_has" maxlength="10"  size="10" > 
        <?php	}  ?>	 	
	  <BR><br>
	  <?php if ($_SESSION["tipo_rep"] < 20) {  ?>
  <strong>Moneda: </strong>
		    <?php echo encadenar(6);?>
            <select  name="cod_mon" size="1"  >
   	         <?php while ($linea = mysql_fetch_array($res_mon)) {?>
             <option value=<?php echo $linea['GRAL_PAR_INT_COD']; ?>>
			 <?php echo $linea['GRAL_PAR_INT_DESC']; ?></option>
	         <?php } ?>
		     </select>
	<?php	}  ?>		
     <?php if ($_SESSION["tipo_rep"] <> 22) { 
	  $consulta  = "Select * From gral_cta_banco where 
	               GRAL_CTA_BAN_COD <> 0 and GRAL_CTA_BAN_USR_BAJA is null order by GRAL_CTA_BAN_CTA_CTE";
    $resultado = mysql_query($consulta);
	 	  ?>
   <tr>
        <th align="left">Cuenta Banco:</th>
	    <td> <select name="cod_bco" id="cod_bco" size="1"  style="width:500px;">
	    	
	        <?php while ($linea = mysql_fetch_array($resultado)) { ?>
            <option value=<?php echo $linea['GRAL_CTA_BAN_CTA_CTE']; ?>>
			              <?php echo $linea['GRAL_CTA_BAN_CTA_CTE'].encadenar(2); ?>
			              <?php echo $linea['GRAL_CTA_BAN_DESC']; ?></option>
            <?php }
			
			 ?>
		    </select></td>
       </tr>
	<?php	}  ?>	
	 <?php if ($_SESSION["tipo_rep"] == 22) { 
	 $con_ciudad  = "Select CONTA_CHRA_CTA, CONTA_CHRA_TALON 
                From contab_chequera order by CONTA_CHRA_TALON";
     $res_ciudad= mysql_query($con_ciudad);
	  $consulta  = "Select * From gral_cta_banco where 
	               GRAL_CTA_BAN_COD <> 0 and GRAL_CTA_BAN_USR_BAJA is null order by GRAL_CTA_BAN_CTA_CTE";
    $resultado = mysql_query($consulta);
	 	  ?>
   <tr>
         <td><strong>Cuenta Banco :</strong></td>
	    <td> <select name="cod_bco" id="cod_bco" size="1"  style="width:500px;">
	    	<option value=<?php echo "Vacio"; ?>>
			               <?php echo "----Seleccione Cuenta de Banco -----"; ?>
			             </option>
	        <?php while ($linea = mysql_fetch_array($resultado)) { ?>
            <option value=<?php echo $linea['GRAL_CTA_BAN_CTA_CTE']; ?>>
			              <?php echo $linea['GRAL_CTA_BAN_CTA_CTE'].encadenar(2); ?>
			              <?php echo $linea['GRAL_CTA_BAN_DESC']; ?></option>
            <?php }
			
			 ?>
		    </select></td>
       </tr>
	   <br>
	    <tr>
            <td><strong>Chequera :</strong></td>
        <td> 
		
		<select name="chequera" size="1" size="30" id="chequera">
               <?php
                 while ($linea = mysql_fetch_array($res_ciudad)) {
               ?>
               
             <option value=<?php echo $linea['CONTA_CHRA_TALON']; ?>>
           <?php echo $linea['CONTA_CHRA_TALON']; ?>
		    </option>
             <?php
                  } 
               ?>
          </select >
                </td>
                 </tr>
	<?php	}  ?>	
	<br><br>		 
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