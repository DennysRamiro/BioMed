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




<?php
        /*         //$fec = leer_param_gral();
				$fec = $_SESSION['fec_proc'];
				 $fec1 = cambiaf_a_mysql_2($fec);

				 $logi = $_SESSION['login']; */
                ?>
<?php
 //$fec = leer_param_gral();
$fec = $_SESSION['fec_proc'];
 $f_des = cambiaf_a_mysql($fec);
// echo $f_des;
 $logi = $_SESSION['login']; 
?>

<head>
<!--Titulo de la pestaña de la pagina-->
<title>Detalle de Transaccion Caja Chica a revertir</title>
<meta charset="UTF-8">
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
<link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
<script type="text/javascript" src="script/jquery-1.9.0.js"></script>
<link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
<script src="script/jquery-ui.js"></script>
<script type="text/javascript" src="script/jquery-ui.js"></script>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script>
<script type="text/javascript" src="js/cajas_rev_bco_det.js"></script> 
<script type="text/javascript" src="js/cajas_reim_bco_det.js"></script> 
<script type="text/javascript" src="js/Utilitarios.js"></script> 
<script type="text/javascript" src="js/ModulosCajaChica.js"></script> 
</head>
<body>	
<!--Div para la letra del campo Monto-->
<!--div id="dialog-confirm" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>Transaccion Revertida</p>
</div-->
<div id="dialog-confirm-reversion" title="Confirmacion"  style="display:none; ">
<p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">La Transaccion fue revertida con exito</font></p>
</div>
<?php 


				include("header.php");
			?>
<div id="pagina_sistema">
<!--Menu izquierdo de los modulos-->
    <div id="pagina_sistema">
          
        <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>
                 <li id="menu_modulo_cajachica">
                    
                     <img src="img/caja_chica_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. CAJA CHICA
                    
                 </li>
                  <li id="menu_modulo_cajachica_reversion">
                    
                     <img src="img/add box_24x24.png" border="0" alt="Modulo" align="absmiddle"> CJA CHI REVERSIONES
                    
                 </li>
                
              </ul>  

                  <?php
                      if($_SESSION['menu'] == 1){?> 
					  
            <!--     <li id="menu_modulo_cajas_rev">
                    
                     <img src="img/import_24x24.png" border="0" alt="Modulo" align="absmiddle"> REV. TRANSACCIONES
                    
                 </li>
                  <li id="menu_modulo_cajas_rev_bco">
                    
                     <img src="img/officer_24x24.png" border="0" alt="Modulo" align="absmiddle"> BANCOS
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> DETALLE BANCOS
                    
                 </li>
              </ul> -->
     <div id="contenido_modulo">
<!--Cabecera del modulo con su alerta-->
                      <h2> <img src="img/add box_64x64.png" border="0" alt="Modulo" align="absmiddle">DETALLE CAJA CHICA</h2>
                      <hr style="border:1px dashed #767676;">
                      <!--div id="error_login"> 
                     <img src="img/alert_32x32.png" align="absmiddle">
                    
                     </div--> 
                  <?php }elseif ($_SESSION['menu'] == 2) {?>
                  
                  <li id="menu_modulo_cajas_reim">
                    
                     <img src="img/print_24x24.png" border="0" alt="Modulo" align="absmiddle"> REIMPRESIONES
                    
                 </li>
                  <li id="menu_modulo_cajas_reim_bco">
                    
                     <img src="img/officer_24x24.png" border="0" alt="Modulo" align="absmiddle"> BANCOS
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> DETALLE BANCOS
                    
                 </li>
              </ul> 
     <div id="contenido_modulo">
<!--Cabecera del modulo con su alerta-->
                      <h2> <img src="img/documents_64x64.png" border="0" alt="Modulo" align="absmiddle">DETALLE CAJA CHICA</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/checkmark_32x32.png" align="absmiddle">
                     Revertir la transacci&oacute;n de Bancos
                     </div>  
                     <?php } ?>        
                  

            <div id="UserData">
                 <!--img src="images/24x24/001_20.png" border="0" align="absmiddle" alt="Home" /-->
				 
			</div>
 <center>
<!-- Para volverlo  como antes con el dialogo de reversion-->
<!--form name="form2" method="post" action="#" onSubmit="return Reversion(this)" -->
<form name="form2" method="post" action="con_retro_1_cjach.php">
<strong><font size="-1">
<?php
//$f_des = "";
//$f_has = "";
$mone = " ";
//
//echo "----".$_POST['nro_tra']."----";
if(isset($_POST['nro_tra'])){
   $quecom = $_POST['nro_tra'];
   //echo $quecom;
   for ($i=0; $i < count($quecom); $i = $i + 1 ) {
       if (isset($quecom[$i]) ) {
          $nro_tra = $_POST['nro_tra'];
		//  echo $nro_tra." --- ";
	      }
   }
    //  $n_des = $_POST['nro_desem'];
   //   $_SESSION['nro_desem'] = $n_des;
	 // $f_des2 = cambiaf_a_mysql($f_des);
  }

?> 
<font size="+1"  style="" >
<?php
//if ($mone == 1){
//echo $nro_tra;
$tipo = 0;
/*$tran = substr($nro_tra,1,3);
if ($tipo == 1){
    $desc = "DEPOSITO";
	}
if ($tipo == 2){
    $desc = "RETIRO";
	} */
	?>
    <center>
   <?php
    echo encadenar(0)."DETALLE TRANSACCION CAJA CHICA NRO.".encadenar(2). $nro_tra;
 // }
// if ($mone == 2){
 //   echo encadenar(45)."LISTADO DE DESEMBOLSOS DE CARTERA EN ".encadenar(2). "DOLARES";
 // } 
?>
</center>
</font>
<font size="+1"  style="" >
<?php
//echo encadenar(2).$desc;
?>
</font>
<center>
<br><br>
<font size="0"  style="" >
 <table border="1" width="600" class="table_usuario" class="table_usuario">
	<tr>
	    <th align="center"><font size="-1">DETALLE</th>
		<th align="center"><font size="-1"></th>
		<th align="center"><font size="-1"></th>
		<th align="center"><font size="-1"></th>
		
	</tr>
	
	<tr>
	    <th align="center"><font size="-1">CUENTA</th>
		<th align="center"><font size="-1">DESCRIPCION</th>
		<th align="center"><font size="-1">DEBE</th>
		<th align="center"><font size="-1">HABER</th>
		
	</tr>		 		

<?php 
  //Datos del cart_det_tran	
   // echo $f_des2.encadenar(2).$f_has2;
   	 $t_deb = 0;
	 $t_hab = 0;
	 $t_deb2 = 0;
	 $t_hab2 = 0;				
	//echo $tipo." ".$tran;
	$con_tpa = "Select *
	            From cjach_transac where
	            (CJCH_TRAN_FECHA between '$f_des' and '$f_des') and
				 CJCH_TRAN_NRO_COR = $nro_tra and
	             CJCH_TRAN_USR_BAJA is null";
    $res_tpa = mysql_query($con_tpa);
	
	    while ($lin_tpa = mysql_fetch_array($res_tpa)) { // 1a
		    $p_deb = 0;
			$p_hab = 0;
		    $p_deb2 = 0;
		    $p_hab2 = 0;
			$tip_d_h = 0;
		    $fec_pag = $lin_tpa['CJCH_TRAN_FECHA'];
			$f_pag = cambiaf_a_normal($fec_pag);
			$nro_tran = $lin_tpa['CJCH_TRAN_NRO_COR'];
			$impo =  $lin_tpa['CJCH_TRAN_IMPORTE'];
			$impo2 =  $lin_tpa['CJCH_TRAN_IMP_EQUIV'];
			$cta_ctb =  $lin_tpa['CJCH_TRAN_CTA_CONT'];
			$descri =  $lin_tpa['CJCH_TRAN_DESCRIP'];
			$tip_d_h = $lin_tpa['CJCH_TRAN_DEB_CRED'];
			$nro_fac = $lin_tpa['CJCH_TRAN_REL_FAC'];
			$des_cta = leer_cta_des($cta_ctb);
			$_SESSION['f_tra'] = $fec_pag;
			$_SESSION['nro_tran'] = $nro_tran;
			$_SESSION['nro_fac'] = $nro_fac;
			$_SESSION['tipo'] = $tipo;
			if ($impo < 0){
			  $impo = $impo * -1;
			 }
			 if ($tip_d_h == 1){ 
			    $p_deb = $impo;
				$p_hab = 0;
				$t_deb = $t_deb + $p_deb;
			  }else{
				$p_hab = $impo;
				$p_deb = 0;
				$t_hab = $t_hab + $p_hab;
			}	
			
		
	
		?>

		<?php	
	
	?>
	<tr>
	    <td align="center" ><?php echo $cta_ctb; ?></td>
	 	<td align="left" ><?php echo $des_cta; ?>
		                   <br>
						   <?php echo $descri; ?>
						   </td>
		<td align="right" ><?php echo number_format($p_deb, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($p_hab, 2, '.',','); ?></td>
		
		
	</tr>	
	
		<?php
		//}		 
			}	 
				 
	          // } // 1b
		
			   			
	?>
	<tr>
	    <th align="left" ><?php echo encadenar(5); ?></th>
	    <th align="center" ><?php echo "Total"; ?></th>
	    <th align="right" ><?php echo number_format($t_deb, 2, '.',','); ?></th>
	 	<th align="right" ><?php echo number_format($t_hab, 2, '.',','); ?></th>
		
	</tr>	
</table>
<br><br>
</center>
<center>


  

   <!--Para volverlo como antes con dialogo-->
   <!--input class="btn_form" type="submit" name="accion" value="Revertir Banco" onClick="dialog()"-->
   <input class="btn_form" type="submit" name="accion" value="Revertir Gasto">

   <!--input type="submit" name="accion" value="Salir"-->
  </form>
		

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

