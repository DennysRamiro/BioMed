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
<script language="javascript" src="script/validarFormulario.js"></script>  
<script type="text/javascript" src="js/cajas_reportes_det_mov.js"></script> 

 <link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
        <script src="script/jquery-ui.js"></script>
        <script type="text/javascript" src="js/calendario.js"></script>
</head>
<body>	
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
                    
                     <img src="img/fax_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CAJAS
                    
                 </li>
                  <li id="menu_modulo_caja_reportes">
                    
                     <img src="img/paste_32x32.png" border="0" alt="Modulo" align="absmiddle"> CAJA REPORTES
                    
                 </li>
                 <?php
                      if($_GET["menu"]==1){$parm=1?> 
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/edit file_32x32.png" border="0" alt="Modulo" align="absmiddle"> DET. MOVIMIENTO
                    
                 </li>
              </ul> 
<!--Cabecera del modulo con su alerta-->
     <div id="contenido_modulo">
                      <h2> <img src="img/edit file_64x64.png" border="0" alt="Modulo" align="absmiddle">DETALLE DE MOVIMIENTO</h2>
                      <hr style="border:1px dashed #767676;">
                      <!--div id="error_login"> 
                     <img src="img/alert_32x32.png" align="absmiddle">
                     Elija la Transaccion
                     </div-->   

                 <?php }elseif ($_GET["menu"]==2) {$parm=2 ?>
                  <li id="menu_modulo_fecha">
                     
                     <img src="img/fax_32x32.png" border="0" alt="Modulo" align="absmiddle"> RES. MOV. CAJA
                    
                 </li>
              </ul> 
<!--Cabecera del modulo con su alerta-->
     <div id="contenido_modulo">
                      <h2> <img src="img/fax_64x64.png" border="0" alt="Modulo" align="absmiddle">RESUMEN MOVIMIENTO CAJA</h2>
                      <hr style="border:1px dashed #767676;">
                      <!--div id="error_login"> 
                     <img src="img/alert_32x32.png" align="absmiddle">
                     Elija la Transaccion
                     </div-->   

				<?php }elseif ($_GET["menu"]==3) { $parm=3?>
                  <li id="menu_modulo_fecha">
                     
                     <img src="img/basket_32x32.png" border="0" alt="Modulo" align="absmiddle"> DET. INGR./EGRES.
                    
                 </li>
              </ul> 
<!--Cabecera del modulo con su alerta-->
     <div id="contenido_modulo">
                      <h2> <img src="img/basket_64x64.png" border="0" alt="Modulo" align="absmiddle">DETALLE INGRESOS/EGRESOS</h2>
                      <hr style="border:1px dashed #767676;">
                      <!--div id="error_login"> 
                     <img src="img/alert_32x32.png" align="absmiddle">
                     Elija la Transaccion
                     </div-->   
                <?php }elseif ($_GET["menu"]==4) {$parm=4?>
                  <li id="menu_modulo_fecha">
                     
                     <img src="img/open_32x32.png" border="0" alt="Modulo" align="absmiddle"> DET. INGR./EGRES. CTA
                    
                 </li>
              </ul> 
<!--Cabecera del modulo con su alerta-->
     <div id="contenido_modulo">
                      <h2> <img src="img/open_64x64.png" border="0" alt="Modulo" align="absmiddle">DETALLE INGRESOS/EGRESOS POR CUENTA</h2>
                      <hr style="border:1px dashed #767676;">
                      <!--div id="error_login"> 
                     <img src="img/alert_32x32.png" align="absmiddle">
                     Elija la Transaccion
                     </div-->  
                <?php }elseif ($_GET["menu"]==5) { $parm=5?>
                  <li id="menu_modulo_fecha">
                     
                     <img src="img/officer_32x32.png" border="0" alt="Modulo" align="absmiddle"> DET. MOV. BANCOS
                    
                 </li>
              </ul> 
<!--Cabecera del modulo con su alerta-->
     <div id="contenido_modulo">
                      <h2> <img src="img/officer_64x64.png" border="0" alt="Modulo" align="absmiddle">DETALLE MOVIMIENTOS BANCOS</h2>
                      <hr style="border:1px dashed #767676;">
                      <!--div id="error_login"> 
                     <img src="img/alert_32x32.png" align="absmiddle">
                     Elija la Transaccion
                     </div--> 
                <?php }elseif ($_GET["menu"]==6) {$parm=6 ?>
                  <li id="menu_modulo_fecha">
                     
                     <img src="img/label_32x32.png" border="0" alt="Modulo" align="absmiddle"> DET. MOV. VALES
                    
                 </li>
              </ul> 
<!--Cabecera del modulo con su alerta-->
     <div id="contenido_modulo">
                      <h2> <img src="img/label_64x64.png" border="0" alt="Modulo" align="absmiddle">DETALLE MOVIMIENTOS VALES</h2>
                      <hr style="border:1px dashed #767676;">
                      <!--div id="error_login"> 
                     <img src="img/alert_32x32.png" align="absmiddle">
                     Elija la Transaccion
                     </div--> 
                <?php }elseif ($_GET["menu"]==7) {$parm=7 ?>
                  <li id="menu_modulo_fecha">
                     
                     <img src="img/add box_32x32.png" border="0" alt="Modulo" align="absmiddle"> COMP/VENT DIVISAS
                    
                 </li>
              </ul> 
<!--Cabecera del modulo con su alerta-->
     <div id="contenido_modulo">
                      <h2> <img src="img/add box_64x64.png" border="0" alt="Modulo" align="absmiddle">COMPRAS/VENTAS DIVISAS</h2>
                      <hr style="border:1px dashed #767676;">
                      <!--div id="error_login"> 
                     <img src="img/alert_32x32.png" align="absmiddle">
                     Elija la Transaccion
                     </div-->   
                 <?php }elseif ($_GET["menu"]==8) { $parm=8?>
                  <li id="menu_modulo_fecha">
                     
                     <img src="img/export_32x32.png" border="0" alt="Modulo" align="absmiddle"> DET. TRANS. REV.
                    
                 </li>
              </ul> 
<!--Cabecera del modulo con su alerta-->
     <div id="contenido_modulo">
                      <h2> <img src="img/export_64x64.png" border="0" alt="Modulo" align="absmiddle">DETALLE TRANSACCIONES REVERTIDAS</h2>
                      <hr style="border:1px dashed #767676;">
                      <!--div id="error_login"> 
                     <img src="img/alert_32x32.png" align="absmiddle">
                     Elija la Transaccion
                     </div-->   
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
     
            <form name="form2" method="post" action="ingegr_mov_det.php" onSubmit="return ValidarRangoFechas(this)">
  <?php }  ?> 
<?php if ($_SESSION["tipo_rep"] == 17) {  ?>
    
            <form name="form2" method="post" action="ingegr_mov_det.php" onSubmit="return ValidarRangoFechas(this)">
  <?php }  ?>   

<?php if ($_SESSION["tipo_rep"] == 6) {  ?>

            <form name="form2" method="post" action="caja_mov_det.php" onSubmit="return ValidarRangoFechas(this)">
  <?php }  ?>
<?php if ($_SESSION["tipo_rep"] == 7) {  ?>
       
            <form name="form2" method="post" action="cja_det_banco.php" onSubmit="return ValidarRangoFechas(this)">
  <?php }  ?> 
  <?php if ($_SESSION["tipo_rep"] == 8) {  ?>
       
            <form name="form2" method="post" action="cja_det_vales.php" onSubmit="return ValidarRangoFechas(this)">
  <?php }  ?> 
  <?php if ($_SESSION["tipo_rep"] == 9) {  ?>
       
            <form name="form2" method="post" action="cja_det_comven.php" onSubmit="return ValidarRangoFechas(this)">
  <?php }  ?> 
  <?php if ($_SESSION["tipo_rep"] == 15) {  ?>
      
            <form name="form2" method="post" action="caja_mov_res.php" onSubmit="return ValidarRangoFechas(this)">
  <?php }  ?> 
<?php if ($_SESSION["tipo_rep"] == 12) {  ?>
   
            <form name="form2" method="post" action="caja_tran_rev.php?menu=9" onSubmit="return ValidarRangoFechas(this)">
  <?php }  ?>									
	
	<?php
	if(isset($_SESSION['msj_error'])){	
	   echo $_SESSION['msj_error']; 
	   }
	?>	
		
	<?php if ($_SESSION["tipo_rep"] <> 15 ) {  ?>
        <strong>Fecha Desde</strong>
         <input class="txt_campo" type="text" id="datepicker" name="fec_des" maxlength="10"  size="10" > 
         
			 <?php	}  ?>	
			 <BR><br>
		 <strong>Fecha Hasta</strong>
         <input class="txt_campo" type="text" id="datepicker2" name="fec_has" maxlength="10"  size="10" > 
        
			<br><br>	 
			 <?php  
			 
			  if ($_SESSION["tipo_rep"] == 17) {
			  
			  
			  $consulta  = "Select DISTINCT caja_ingegr_cta,CONTA_CTA_DESC  From caja_ing_egre,contab_cuenta where 
			                CONTA_CTA_NRO = caja_ingegr_cta and
	                        caja_ingegr_usr_baja is null order by caja_ingegr_cta ";
              $resultado = mysql_query($consulta);
			   ?>
			   
		<br>	   
      
      <strong>Cuenta Contable</strong>
	     <select name="cod_cta" size="1" style="width:500px"  >

       

         <!--option>Seleccione una Cuenta Contable......</option-->

	        <?php while ($linea = mysql_fetch_array($resultado)) { ?>
            <option value=<?php echo $linea['caja_ingegr_cta']; ?>>
			              <?php echo $linea['caja_ingegr_cta'].encadenar(2); ?>
			              <?php echo $linea['CONTA_CTA_DESC']; ?></option>
            <?php }
			//echo "Aqui....";
			 ?>
		    </select>
      
			 <?php	     }    ?> 	
			 <?php if ($_SESSION["tipo_rep"] == 6) {
			          if ($_SESSION['cargo'] <> 4){ 
					      $_SESSION['detalle'] = 1;  ?> 

			 <BR><br>
			  <table align="left">
			  <tr>
                 <th align="left" ><?php echo "Todos los Cajeros"; ?></th>
			     <td ><INPUT NAME="ctot" TYPE=RADIO VALUE="S"></td>
			  </tr>
			   <tr>
                 <th  align="left"><?php echo "Solo Un Cajero"; ?></th>
			     <td ><INPUT NAME="cvig" TYPE=RADIO VALUE="S"></td>
			  </tr>
			 
			</table>
			 <?php	}else{
			     $_SESSION['detalle'] = 2;
				 } ?>	
  
		  <?php	}  ?>	
	 
	  <?php if ($_SESSION["tipo_rep"] <> 9) {  ?>
	        <?php if ($_SESSION["tipo_rep"] <> 15) { 
			          if ($_SESSION["tipo_rep"] <> 12) {
					      if ($_SESSION["tipo_rep"] <> 6) {
						     if ($_SESSION["tipo_rep"] <>17) { ?>
            <strong>Moneda  </strong>
		    <?php echo encadenar(6);?>
          
		    <select name="cod_mon" size="1"  >

             <?php while ($linea = mysql_fetch_array($res_mon)) {?>

          <!--option>Seleccione una Moneda......</option-->
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
			  </select>  
		   
      
      <strong> Cuenta Banco: </strong>
	     <select name="cod_bco" size="1">

        

         <!--option>Seleccione una Cuenta de Banco......</option-->

	        <?php while ($linea = mysql_fetch_array($resultado)) { ?>
            <option value=<?php echo $linea['GRAL_CTA_BAN_COD']; ?>	>
			              <?php echo $linea['GRAL_CTA_BAN_CTA_CTE'].encadenar(2); ?>
			              <?php echo $linea['GRAL_CTA_BAN_DESC']; ?>
			      </option>
            <?php } ?>
		  </select>
      
			 <?php	  }   }    ?>
			 
			 <?php	     }    ?>
			 	
	       	 <?php	    }   
		                 } 
				       } ?>		 
	   
    <input class="btn_form" type="submit" name="accion" value="Procesar"></form>
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