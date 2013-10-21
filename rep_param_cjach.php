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
<script language="javascript" src="script/validarFormulario.js"></script>  
<script type="text/javascript" src="js/cajach_reportes_det_mov.js"></script> 

 <link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
        <script src="script/jquery-ui.js"></script>
		
<script language="javascript" src="script/validarForm.js" type="text/javascript"> </script> 
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
<div id="dialog-confirm4" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Fecha Desde no puede ser mayor a la fecha actual.</font></p>
</div>
<div id="dialog-confirm5" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Fecha Hasta no puede ser mayor a la fecha actual.</font></p>
</div>


	<?php
				include("header.php");

			?>

      <?php
                 //$fec = leer_param_gral();
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
                 <li id="menu_modulo_general_cajas">
                    
                     <img src="img/caja_chica_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CAJA CHICA
                    
                 </li>
                  <li id="menu_modulo_caja_reportes">
                    
                     <img src="img/paste_24x24.png" border="0" alt="Modulo" align="absmiddle"> CAJA CHICA REPORTES
                    
                 </li>
                 <?php
                      if($_GET["menu"]==1){$parm=1?> 
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/edit file_24x24.png" border="0" alt="Modulo" align="absmiddle"> DET. MOVIMIENTO
                    
                 </li>
              </ul> 
<!--Cabecera del modulo con su alerta-->
     <div id="contenido_modulo">
	                  <h2> <img src="img/edit file_64x64.png" border="0" alt="Modulo" align="absmiddle">DETALLE DE MOVIMIENTO CAJA CHICA</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/checkmark_32x32.png" align="absmiddle">
                     Ingrese las fechas para generar el reporte Detalle Movimiento.
</div>   

                 <?php }elseif ($_GET["menu"]==2) {$parm=2; ?>
                  <li id="menu_modulo_fecha">
                     
                     <img src="img/fax_24x24.png" border="0" alt="Modulo" align="absmiddle"> RES. MOV. CAJA
                    
                 </li>
              </ul> 
<!--Cabecera del modulo con su alerta-->
     <div id="contenido_modulo">
                      <h2> <img src="img/fax_64x64.png" border="0" alt="Modulo" align="absmiddle">RESUMEN MOVIMIENTO CAJA</h2>
                      <hr style="border:1px dashed #767676;">
                     <div id="error_login"> 
                     <img src="img/checkmark_32x32.png" align="absmiddle">
                     Ingrese la fecha para generar el reporte Mov. de Caja.
</div>    

				<?php }elseif ($_GET["menu"]==3) { $parm=3;?>
                  <li id="menu_modulo_fecha">
                     
                     <img src="img/basket_24x24.png" border="0" alt="Modulo" align="absmiddle"> DET. INGR./EGRES.
                    
                 </li>
              </ul> 
<!--Cabecera del modulo con su alerta-->
     <div id="contenido_modulo">
                      <h2> <img src="img/basket_64x64.png" border="0" alt="Modulo" align="absmiddle">DETALLE INGRESOS/EGRESOS</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/checkmark_32x32.png" align="absmiddle">
                     Ingrese los datos para generar el reporte Detalle Ingresos/Egresos.
</div>     
                <?php }elseif ($_GET["menu"]==4) {$parm=4;?>
                  <li id="menu_modulo_fecha">
                     
                     <img src="img/open_24x24.png" border="0" alt="Modulo" align="absmiddle"> DET. INGR./EGRES. CTA
                    
                 </li>
              </ul> 
<!--Cabecera del modulo con su alerta-->
     <div id="contenido_modulo">
                      <h2> <img src="img/open_64x64.png" border="0" alt="Modulo" align="absmiddle">DETALLE INGRESOS/EGRESOS POR CUENTA</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/checkmark_32x32.png" align="absmiddle">
                     Ingrese los datos para generar el reporte Detalle Ingresos/Egresos por Cta.
</div>  
                <?php }elseif ($_GET["menu"]==5) { $parm=5;?>
                  <li id="menu_modulo_fecha">
                     
                     <img src="img/officer_24x24.png" border="0" alt="Modulo" align="absmiddle"> DET. MOV. BANCOS
                    
                 </li>
              </ul> 
<!--Cabecera del modulo con su alerta-->
     <div id="contenido_modulo">
                      <h2> <img src="img/officer_64x64.png" border="0" alt="Modulo" align="absmiddle">DETALLE MOVIMIENTOS BANCOS</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/checkmark_32x32.png" align="absmiddle">
                     Ingrese los datos para generar el reporte Detalle Mov. Bancos.
</div>  
                <?php }elseif ($_GET["menu"]==6) {$parm=6; ?>
                  <li id="menu_modulo_fecha">
                     
                     <img src="img/export_24x24.png" border="0" alt="Modulo" align="absmiddle"> DET. ASIGNACIONES
                    
                 </li>
              </ul> 
<!--Cabecera del modulo con su alerta-->
     <div id="contenido_modulo">
                      <h2> <img src="img/export_64x64.png" border="0" alt="Modulo" align="absmiddle">DETALLE ASIGNACIONES</h2>
                      <hr style="border:1px dashed #767676;">
                     <div id="error_login"> 
                     <img src="img/checkmark_32x32.png" align="absmiddle">
                     Ingrese los datos para generar el reporte Detalle Asignaciones.
                     </div>  
                <?php }elseif ($_GET["menu"]==7) {$parm=7; ?>
                  <li id="menu_modulo_fecha">
                     
                     <img src="img/add box_24x24.png" border="0" alt="Modulo" align="absmiddle"> COMP/VENT DIVISAS
                    
                 </li>
              </ul> 
<!--Cabecera del modulo con su alerta-->
     <div id="contenido_modulo">
                      <h2> <img src="img/add box_64x64.png" border="0" alt="Modulo" align="absmiddle">COMPRAS/VENTAS DIVISAS</h2>
                      <hr style="border:1px dashed #767676;">
                     <div id="error_login"> 
                     <img src="img/checkmark_32x32.png" align="absmiddle">
                     Ingrese las fechas para generar el reporte Compra Venta Divisas.
</div>   
                 <?php }elseif ($_GET["menu"]==8) { $parm=8;?>
                  <li id="menu_modulo_fecha">
                     
                     <img src="img/export_24x24.png" border="0" alt="Modulo" align="absmiddle"> DET. TRANS. REV.
                    
                 </li>
              </ul> 
<!--Cabecera del modulo con su alerta-->
     <div id="contenido_modulo">
                      <h2> <img src="img/export_64x64.png" border="0" alt="Modulo" align="absmiddle">DETALLE TRANSACCIONES REVERTIDAS</h2>
                      <hr style="border:1px dashed #767676;">
                     <div id="error_login"> 
                     <img src="img/checkmark_32x32.png" align="absmiddle">
                     Ingrese las fechas para generar el reporte Detalle Trans. Revertidas.
       </div>  
<?php } ?>

                     
  <?php if ($_SESSION["tipo_rep"] == 1) {  ?>
     
            <form name="form2" method="post" action="cart_prox_vto.php" onSubmit="return ValidarRangoFechas(this)">
  <?php }  ?>
  <?php if ($_SESSION["tipo_rep"] == 2) {  ?>
      
            <form name="form2" method="post" action="cart_det_rec.php" onSubmit="return ValidarRangoFechas(this)">
  <?php }  ?>      
  <?php if ($_SESSION["tipo_rep"] == 3) {  ?>
      
            <form name="form2" method="post" action="cart_det_des.php" onSubmit="return ValidarRangoFechas(this)">
  <?php }  ?> 
<?php if ($_SESSION["tipo_rep"] == 4) {  ?>
       
            <form name="form2" method="post" action="fgar_det_mov.php" onSubmit="return ValidarRangoFechas(this)">
  <?php }  ?> 
<?php if ($_SESSION["tipo_rep"] == 5) {  ?>
     
            <form name="form2" method="post" action="ingegr_mov_det.php?menu=1" onSubmit="return ValidarRangoFechas(this)">
  <?php }  ?> 
<?php if ($_SESSION["tipo_rep"] == 17) {  ?>
    
            <form name="form2" method="post" action="ingegr_mov_det.php?menu=2" onSubmit="return ValidarRangoFechas(this)">
  <?php }  ?>   

<?php if ($_SESSION["tipo_rep"] == 6) {  ?>

            <form name="form2" method="post" action="cjach_mov_det.php" onSubmit="return ValidarRangoFechas(this)">
  <?php }  ?>
<?php if ($_SESSION["tipo_rep"] == 7) {  ?>
       
            <form name="form2" method="post" action="cja_det_banco.php" onSubmit="return ValidarRangoFechas(this)">
  <?php }  ?> 
  <?php if ($_SESSION["tipo_rep"] == 8) {  ?>
       
            <form name="form2" method="post" action="cjach_mov_asig.php" onSubmit="return ValidarRangoFechas(this)">
  <?php }  ?> 
  <?php if ($_SESSION["tipo_rep"] == 9) {  ?>
       
            <form name="form2" method="post" action="cja_det_comven.php" onSubmit="return ValidarRangoFechas(this)">
  <?php }  ?> 
  <?php if ($_SESSION["tipo_rep"] == 15) {  ?>
      
            <form name="form2" method="post" action="caja_mov_res.php" onSubmit="return ValidarRangoFecha_Hasta(this)">
  <?php }  ?> 
<?php if ($_SESSION["tipo_rep"] == 12) {  ?>
   
            <form name="form2" method="post" action="cjach_tran_rev.php?menu=9" onSubmit="return ValidarRangoFechas(this)">
  <?php }  ?>									
	
	<?php
	if(isset($_SESSION['msj_error'])){	
	   echo $_SESSION['msj_error']; 
	   }
	?>	
		<center>
	<?php if ($_SESSION["tipo_rep"] <> 15 ) {  ?>
       
	    
          <table align="center" BORDER="0"> 
            
		 <tr >			 
		  <th align="left">Fecha Desde: </th>
		  <th align="left"><input class="txt_campo" type="text" id="datepicker" name="fec_des" maxlength="10"  size="10" > </th>
         </tr>
			 <?php	}  ?>	
		 <tr>
      <br>
		 <th align="left"> Fecha Hasta:</th>
         <th align="left"><input class="txt_campo" type="text" id="datepicker2" name="fec_has" maxlength="10"  size="10" > </th>
       	 </tr>
	    	
			 <?php  
			 
			  if ($_SESSION["tipo_rep"] == 6) {
			  
			  
			  $consulta  = "Select * From cjach_cntrl where CJCH_CTRL_USR_BAJA is null ";
              $resultado = mysql_query($consulta);
			   ?>
			   
			   
      <center> 	
	  <tr> 
	  <th align="left"> Caja Chica:</th>
	  <th align="left">   <select name="cod_cta" size="1" style="width:500px"  >
         
	        <?php while ($linea = mysql_fetch_array($resultado)) { ?>
            <option value=<?php echo $linea['CJCH_CTRL_NRO']; ?>>
			              <?php echo $linea['CJCH_CTRL_NRO'].encadenar(2); ?>
			              <?php echo utf8_encode($linea['CJCH_CTRL_NOMB']); ?></option>
            <?php } ?>
		    </select></th>
		</tr>	
     	
			 <?php } ?> 	
				 
			 <?php  
			 
			  if ($_SESSION["tipo_rep"] == 17) {
			  
			  
			  $consulta  = "Select DISTINCT caja_ingegr_cta,CONTA_CTA_DESC  From caja_ing_egre,contab_cuenta where 
			                CONTA_CTA_NRO = caja_ingegr_cta and
	                        caja_ingegr_usr_baja is null order by caja_ingegr_cta ";
              $resultado = mysql_query($consulta);
			   ?>
			   
			   
      <center> 	
	  <tr> 
	  <th align="left"> Cuenta Contable:</th>
	  <th align="left">   <select name="cod_cta" size="1" style="width:500px"  >
         
	        <?php while ($linea = mysql_fetch_array($resultado)) { ?>
            <option value=<?php echo $linea['caja_ingegr_cta']; ?>>
			              <?php echo $linea['caja_ingegr_cta'].encadenar(2); ?>
			              <?php echo utf8_encode($linea['CONTA_CTA_DESC']); ?></option>
            <?php }
			//echo "Aqui....";
			 ?>
		    </select></th>
		</tr>	
     	
			 <?php	     }    ?> 	
			 <?php if ($_SESSION["tipo_rep"] == 6) {
			          if ($_SESSION['cargo'] <> 4){ 
					      $_SESSION['detalle'] = 1;  ?> 

			 
			  
			  <tr>
                 <th align="left" ><?php echo "Todos los Cajeros"; ?></th>
			     <td ><INPUT NAME="miradio" TYPE="RADIO" VALUE="ctot"></td>
			  </tr>
			   <tr>
                 <th  align="left"><?php echo "Solo Un Cajero"; ?></th>
			     <td ><INPUT NAME="miradio" TYPE="RADIO" VALUE="cvig"></td>
			  </tr>
			 
			
			 <?php	}else{
			     $_SESSION['detalle'] = 2;
				 } ?>	
  
		  <?php	}  ?>	
	 
	  <?php if ($_SESSION["tipo_rep"] <> 9) {  ?>
	        <?php if ($_SESSION["tipo_rep"] <> 15) { 
			          if ($_SESSION["tipo_rep"] <> 12) {
					      if ($_SESSION["tipo_rep"] <> 6) {
						     if ($_SESSION["tipo_rep"] <> 8) {
						     if ($_SESSION["tipo_rep"] <>17) { ?>
            <?php echo encadenar(6);?>
			<tr>
			<th align="left">  Moneda:</th>
		    <th align="left"> 
          
		    <select name="cod_mon" size="1"  >
          
   	         <?php while ($linea = mysql_fetch_array($res_mon)) {?>
             <option value=<?php echo $linea['GRAL_PAR_INT_COD']; ?>>
			 <?php echo $linea['GRAL_PAR_INT_DESC']; 
			       ?>
			 </option>
			 
	         <?php  }
			 
			  if ($_SESSION["tipo_rep"] == 7) {
			  $consulta  = "Select * 
			  			    From gral_cta_banco 
			  			    where GRAL_CTA_BAN_USR_BAJA is null order by GRAL_CTA_BAN_COD ";
              $resultado = mysql_query($consulta);
			   
			   ?>
			  </select>  </th>
			  </tr>
		      <tr> 
			  <th align="left">  Cuenta Banco: </th>
	     	  <th align="left"><select name="cod_bco" size="1">
         
	        <?php while ($linea = mysql_fetch_array($resultado)) { ?>
            <option value=<?php echo $linea['GRAL_CTA_BAN_CTA_CTE']; ?>	>
			              <?php echo $linea['GRAL_CTA_BAN_CTA_CTE'].encadenar(2); ?>
			              <?php echo $linea['GRAL_CTA_BAN_DESC']; ?>
			      </option>
            <?php } ?>
		  </select> </th>
      
			 <?php	  }    }  }  ?>
			 
			 <?php	     }    ?>
			 	
	       	 <?php	    }   
		                 } 
				       } ?>		 
	   </tr>
	    </table>
	  <table width="70%" align="center">
      <br>
	  <tr>
	  <th><input class="btn_form" type="submit" name="accion" value="Consultar"> </th>
	  </tr>
	  </table>
 

	</form>
</center>

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