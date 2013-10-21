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
	require('funciones2.php');
?>
<html>
<head>
<title>Consulta Documento Contable</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script type="text/javascript" src="js/contabilidad_reg_cons_sel_cons.js"></script> 
</head>
<?php
      include("header.php");
	?>
	  <?php
     //$fec = leer_param_gral();
     $logi = $_SESSION['login'];
	 $_SESSION['egre_bs_sus'] = 0;
	 //$menu = $_SESSION['menu']; 
	 // echo $_POST["nro_doc"];



     ?> 
<div id="pagina_sistema">
          
        <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>

 					
        		<?php if($_SESSION['menu'] == 19){?> 
        		  <li id="menu_modulo_contabilidad">
                    
                     <img src="img/calculator_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. CONTABILIDAD
                    
                 </li>
                  <li id="menu_modulo_contabilidad_asientocontable">
                    
                     <img src="img/edit file_24x24.png" border="0" alt="Modulo" align="absmiddle"> REG. ASIENTO CONT.
                    
                 </li>
                  <li id="menu_modulo_contabilidad_asientocontable_consultar">
                    
                     <img src="img/search_24x24.png" border="0" alt="Modulo" align="absmiddle"> CONS. ASI. CONT.
                    
                 </li>
                  <li id="menu_modulo_contabilidad_asientocontable_consultar_sel">
                    
                     <img src="img/checkmark_24x24.png" border="0" alt="Modulo" align="absmiddle"> SEL. ASI. CONT.
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/back_24x24.png" border="0" alt="Modulo" align="absmiddle"> REV. ASIENTO CONT.
                    
                 </li>
              </ul> 
              <div id="contenido_modulo">
					<h2> <img src="img/back_64x64.png" border="0" alt="Modulo" align="absmiddle">REVERTIR ASIENTO CONTABLE </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
         				 <img src="img/checkmark_32x32.png" align="absmiddle">
           					Confirme la accion de reversion del asiento contable
        			   </div>	
        	<?php } elseif($_SESSION['menu'] == 10){?>

        		<li id="menu_modulo_contabilidad">
                    
                     <img src="img/calculator_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. CONTABILIDAD
                    
                 </li>
                  <li id="menu_modulo_contabilidad_asientocontable">
                    
                     <img src="img/edit file_24x24.png" border="0" alt="Modulo" align="absmiddle"> REG. ASIENTO CONT.
                    
                 </li>
                  <li id="menu_modulo_contabilidad_asientocontable_consultar">
                    
                     <img src="img/search_24x24.png" border="0" alt="Modulo" align="absmiddle"> CONS. ASI. CONT.
                    
                 </li>
                  <li id="menu_modulo_contabilidad_asientocontable_consultar_sel">
                    
                     <img src="img/checkmark_24x24.png" border="0" alt="Modulo" align="absmiddle"> SEL. ASI. CONT.
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/find2_24x24.png" border="0" alt="Modulo" align="absmiddle"> CONS. ASIENTO CONT.
                    
                 </li>
              </ul> 
              <div id="contenido_modulo">
					<h2> <img src="img/find2_64x64.png" border="0" alt="Modulo" align="absmiddle">CONSULTAR ASIENTO CONTABLE </h2>
                      <hr style="border:1px dashed #767676;">
                       <!--div id="error_login"> 
         				 <img src="img/alert_32x32.png" align="absmiddle">
           					Elija el Asiento para Adicionar
        			   </div-->

        	<?php } elseif($_SESSION['menu'] == 20){?>
        	 <li id="menu_modulo_contabilidad">
                    
                     <img src="img/calculator_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. CONTABILIDAD
                    
                 </li>
                  <li id="menu_modulo_contabilidad_asientocontable">
                    
                     <img src="img/edit file_24x24.png" border="0" alt="Modulo" align="absmiddle"> REG. ASIENTO CONT.
                    
                 </li>
                    <li id="menu_modulo_contabilidad_asientocontable_util_res">
                    
                     <img src="img/import_24x24.png" border="0" alt="Modulo" align="absmiddle"> UTILIZAR RESERVADOS
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/back_24x24.png" border="0" alt="Modulo" align="absmiddle"> REV. ASIENTO CONT.
                    
                 </li>
              </ul> 
              <div id="contenido_modulo">
					<h2> <img src="img/back_64x64.png" border="0" alt="Modulo" align="absmiddle">REVERTIR ASIENTO CONTABLE </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
         				 <img src="img/checkmark_32x32.png" align="absmiddle">
           					Confirme la accion de reversion del asiento contable
        			   </div>	
<?php }?>
        	


<?php
      if ($_SESSION['con_baj'] == 1){
	?>
    
     <strong></strong><br>
	<?php
      }
	?> 
   	 <?php
      if ($_SESSION['con_baj'] == 2){
	?>
     
     <strong>Reversion Documento Contable</strong><br>
	<?php
      }
	?> 
    	 <?php
      if ($_SESSION['con_baj'] == 3){
	?>
     
     <strong>Cambiar Fecha de Documento Contable</strong><br>
	<?php
      }
	?> 	
</h2>

                       <!--div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
           
        </div-->
   	

   

   

	        
<center>

<font  size="+2">
<?php
if ($_SESSION['con_baj'] == 1){
   echo "Consulta Asiento Contable";
   }
 if ($_SESSION['con_baj'] == 2){ 
   echo "Reversion Asiento Contable";
  } 
  if ($_SESSION['con_baj'] == 3){ 
   echo "Cambiar Fecha de Asiento Contable";
  }  
?>
</font>
<?php
$quecom = $_POST['nro_doc'];
for( $i=0; $i < count($quecom); $i = $i + 1 ) {
 if( isset($quecom[$i]) ) {
    $nro_doc = $quecom[$i];
 }
}


//echo $_POST['nro_doc'];
//echo $nro_doc;

$_SESSION['nro_doc'] = $nro_doc;
$con_cab  = "Select CONTA_CAB_GLOSA
	              From contab_cabec where CONTA_CAB_NRO = $nro_doc  
				  and CONTA_CAB_USR_BAJA is null";
    $res_cab = mysql_query($con_cab);
	while ($lin_cab = mysql_fetch_array($res_cab)) {
	 $glosa =  $lin_cab['CONTA_CAB_GLOSA'];
	}
$con_cbt  = "Select *
	              From contab_trans where CONTA_TRS_NRO = $nro_doc  
				  and CONTA_TRS_USR_BAJA is null 
				  order by 'CONTA_TRS_CTA'";
    $res_cbt = mysql_query($con_cbt);
	while ($lin_cbt = mysql_fetch_array($res_cbt)) {
	    
		  $fecha = $lin_cbt['CONTA_TRS_FEC_VAL'];
		  $fecha = cambiaf_a_normal($fecha);
		 // $glosa_ind = $lin_cbt['CONTA_TRS_GLOSA'];
	//aumentar mensaje de error	  
	if ($_SESSION['con_baj'] == 2){	  
	    if ($fecha <> $fec){
		   $_SESSION["tot_err"] = 1;
	      // header('Location: cons_asiento.php');
		 }
	 }	  
		  
	}
?>
<form name="form2" method="post" action="con_retro_1.php" onSubmit="return">

	<table width="85%"  border="1" cellspacing="1" cellpadding="1" align="center" class="table_usuario">
		<?php
			if ($_SESSION['con_baj'] == 3){
	 	?>
  		Nueva Fecha
  		 <input class="txt_campo" type="text" name="fec_nue" size="12" maxlength="12"  value="<?=$fecha;?>" > 
<br>
 <?php
}
	 ?>
    <tr>
      <th width="8%" scope="col"><border="0" alt="" align="absmiddle" />CUENTA  </th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
	  <th width="5%" scope="col"><border="0" alt="" align="absmiddle" />DEBE Bs.</th>
	  <th width="8%" scope="col"><border="0" alt="" align="absmiddle" />HABER Bs.</th>
	  <th width="8%" scope="col"><border="0" alt="" align="absmiddle" />DEBE $us.</th>
	  <th width="8%" scope="col"><border="0" alt="" align="absmiddle" />HABER $us.</th>
	</tr>  
	<?php
	 echo "Comprobante Nro.".encadenar(2).$nro_doc.encadenar(60)."Fecha".encadenar(2).$fecha;
	 ?>
	 <br>
	<?php
	 echo "Glosa ".encadenar(2).$glosa;
	 ?>
	 <br>
	 <?php 
	
	$impo_t1 = 0;
	$impoe_t1 = 0;
	$impo_t2 = 0;
	$impoe_t2 = 0;
	$con_cbt  = "Select *
	              From contab_trans where CONTA_TRS_NRO = $nro_doc  
				  and CONTA_TRS_USR_BAJA is null 
				  order by 'CONTA_TRS_CTA'";
    $res_cbt = mysql_query($con_cbt);
	while ($lin_cbt = mysql_fetch_array($res_cbt)) {
	      
	      $impo_1 = 0;
	      $impoe_1 = 0;
		  $impo_2 = 0;
	      $impoe_2 = 0;
		  $glosa_ind =  $lin_cbt['CONTA_TRS_GLOSA'];
	      $cuenta = $lin_cbt['CONTA_TRS_CTA'];
		  $desc = leer_cta_des($cuenta);
	      $deb_hab =  $lin_cbt['CONTA_TRS_DEB_CRED'];
	      
		  if ($deb_hab == 1){
		      $impo_1 = $lin_cbt['CONTA_TRS_IMPO'];
	          $impoe_1 = $lin_cbt['CONTA_TRS_IMPO_E'];
			}  
		  if ($deb_hab == 2){
		      $impo_2 = $lin_cbt['CONTA_TRS_IMPO'];
	          $impoe_2 = $lin_cbt['CONTA_TRS_IMPO_E'];
			}
			
		 
			
		  $impo_t1 = $impo_t1 +  $impo_1;
	      $impoe_t1 = $impoe_t1 + $impoe_1;
	      $impo_t2 = $impo_t2 + $impo_2  ;
	      $impoe_t2 = $impoe_t2 +  $impoe_2;  
	 
	?>
	
	
	
	
	
	
	 <tr>
	 	      <td align="left"><?php echo $cuenta; ?></td>
			  <td align="left"><?php echo $desc; ?>
			  <br><?php echo  $glosa_ind; ?> </td>
		      <td align="right"><?php echo number_format($impo_1, 2, '.',',') ; ?></td>
		      <td align="right"><?php echo number_format($impo_2, 2, '.',','); ?></td>
		      <td align="right"><?php echo number_format($impoe_1, 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($impoe_2, 2, '.',','); ?></td>
	     </tr>
	<?php }  ?>
	 <tr>
	 	      <th align="left"><?php echo encadenar(2); ?></td>
			  <th align="left"><?php echo "Totales"; ?></td>
		      <th align="right"><?php echo number_format($impo_t1, 2, '.',',') ; ?></td>
		      <th align="right"><?php echo number_format($impo_t2, 2, '.',','); ?></td>
		      <th align="right"><?php echo number_format($impoe_t1, 2, '.',',') ; ?></td>
		      <th align="right"  ><?php echo number_format($impoe_t2, 2, '.',','); ?></td>
	     </tr>
	
	
	
	
	</table>

	
	<center>
<?php
      if ($_SESSION['con_baj'] == 1){
	?>
	
<!--input class="btn_form" type="submit" name="accion" value="Salir"-->
<?php }?>
      
  <?php
      if ($_SESSION['con_baj'] == 2){
	?>
		<?php if($_SESSION['menu'] == 19){?> 
	<br><input class="btn_form" type="submit" name="accion" value="Confirma Reversion">
	    <?php } elseif($_SESSION['menu'] == 20){?>
	<br><input class="btn_form" type="submit" name="accion" value="Confirma Reversion Reservado">
	<!--input class="btn_form" type="submit" name="accion" value="Salir"-->
		<?php }?>

  <?php }?>
    <?php
      if ($_SESSION['con_baj'] == 3){
	?>
	<input class="btn_form" type="submit" name="accion" value="Cambiar">
	<!--input class="btn_form" type="submit" name="accion" value="Salir"-->
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