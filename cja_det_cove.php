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
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<?php
  $fec = $_SESSION['fec_proc'];
  $fec1 = cambiaf_a_mysql_2($fec);
  $logi = $_SESSION['login']; 
?>
  <html>
<head>
<title>Detalle de Transaccion Compra/Venta a revertir</title>
<meta charset="UTF-8">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
<script src="script/jquery-ui.js"></script>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script> 
<script type="text/javascript" src="js/cajas_rev_cv_div_det.js"></script>  
<script type="text/javascript" src="js/cajas_reim_cv_div_det.js"></script>  
<body>
<div id="dialog-confirm-reversion" title="Confirmacion"  style="display:none; ">
<p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">La Transaccion fue revertida con exito</font></p>
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
                 <li id="menu_modulo_general_cajas">
                    
                     <img src="img/fax_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CAJAS
                    
                 </li>
                  <?php
                      if($_SESSION['menu']==3){?> 
                 <li id="menu_modulo_cajas_rev">
                    
                     <img src="img/import_24x24.png" border="0" alt="Modulo" align="absmiddle"> REV. TRANSACCIONES
                    
                 </li>
                  <li id="menu_modulo_cajas_rev_det">
                    
                     <img src="img/add box_24x24.png" border="0" alt="Modulo" align="absmiddle"> COM. VENTA DIVISAS 
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> DET. COM. VEN. DIVISAS 
                    
                 </li>
              </ul> 
<!--Cabecera del modulo con su alerta-->
     <div id="contenido_modulo">
                      <h2> <img src="img/documents_64x64.png" border="0" alt="Modulo" align="absmiddle">DETALLE COMPRA VENTA DE DIVISAS</h2>
                      <hr style="border:1px dashed #767676;">
                      <!--div id="error_login"> 
                     <img src="img/alert_32x32.png" align="absmiddle">
                     Elija la Transaccion
                     </div-->  
                   <?php }elseif ($_SESSION['menu']==4) { ?>
                      <li id="menu_modulo_cajas_reim">
                    
                     <img src="img/print_24x24.png" border="0" alt="Modulo" align="absmiddle"> REIMPRESIONES
                    
                 </li>
                  <li id="menu_modulo_cajas_reim_det">
                    
                     <img src="img/add box_24x24.png" border="0" alt="Modulo" align="absmiddle"> COM. VENTA DIVISAS 
                    
                 </li>
                   <li id="menu_modulo_fecha">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> DET. COM/VEN DIV.
                    
                 </li>
              </ul> 
<!--Cabecera del modulo con su alerta-->
     <div id="contenido_modulo">
                      <h2> <img src="img/documents_64x64.png" border="0" alt="Modulo" align="absmiddle">DETALLE COMPRA VENTA DE DIVISAS</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
                     <img src="img/checkmark_32x32.png" align="absmiddle">
                     Revertir la transacci&oacute;n Detalle Compra Divisas
                     </div> 
                     <?php } ?> 
	

            <div id="UserData">
                 <!--img src="images/24x24/001_20.png" border="0" align="absmiddle" alt="Home" /-->
				<?php
                // $fec = leer_param_gral();
				 $fec1 = cambiaf_a_mysql_2($fec);
				 $logi = $_SESSION['login']; 
                ?> 
			</div>
 <center>
<!--div id="GeneralManUsuarioM"-->
<!--form name="form2" method="post" action="#" onSubmit="return Reversion(this)" -->
<form name="form2" method="post" action="grab_retro_cja.php">
<strong><font size="-1">
<?php
//$f_des = "";
//$f_has = "";
$mone = " ";
//echo $_POST['nro_tra'];
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
$tipo = substr($nro_tra,0,1);
$tran = substr($nro_tra,1,3);
if ($tipo == 1){
    $desc = "COMPRA DIVISAS";
	}
if ($tipo == 2){
    $desc = "VENTA DIVISAS";
	}
   ?>
   <center>
   <?php
    echo encadenar(0)."DETALLE DE".encadenar(1).$desc.encadenar(2).
	" NRO.".encadenar(2). $tran;
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
 <table border="1" width="550" class="table_usuario">
	<tr>
	    <th align="center"><font size="-1">DETALLE</th>
		<td align="center"><font size="-1"></td>
		<td align="center"><font size="-1"></td>
		<td align="center"><font size="-1"></td>
		
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
	            From caja_com_ven where
	            (caja_comven_fecha between '$fec1' and '$fec1') and
				 caja_comven_tipo = $tipo and
				 caja_comven_corr = $tran  and
	             caja_comven_usr_baja is null
				 order by caja_comven_fecha, caja_comven_corr";
    $res_tpa = mysql_query($con_tpa);
	    while ($lin_tpa = mysql_fetch_array($res_tpa)) { // 1a
		    $p_deb = 0;
			$p_hab = 0;
		    $p_deb2 = 0;
		    $p_hab2 = 0;
		    $fec_pag = $lin_tpa['caja_comven_fecha'];
			$f_pag = cambiaf_a_normal($fec_pag);
			$nro_tran = $lin_tpa['caja_comven_corr'];
			$impo =  $lin_tpa['caja_comven_impo'];
			$impo2 =  $lin_tpa['caja_comven_impo_e'];
			$cta_ctb =  $lin_tpa['caja_comven_cta'];
			$descri =  $lin_tpa['caja_comven_descrip'];
			$deb_hab =  $lin_tpa['caja_comven_debhab'];
			$des_cta = leer_cta_des($cta_ctb);
			$_SESSION['f_tra'] = $fec_pag;
			$_SESSION['nro_tran'] = $nro_tran;
			$_SESSION['tipo'] = $tipo;
			if ($deb_hab == 2){
			  //  echo $impo;
			    $p_hab = $impo;
				$p_deb = 0;
				$t_hab = $t_hab + $p_hab;
			//	echo $p_hab." *** ";
				}else{
				$p_deb = $impo;
				$p_hab = 0;
				$t_deb = $t_deb + $p_deb;
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
	    <td align="left" ><?php echo encadenar(5); ?></td>
	    <th align="center" ><?php echo "Total"; ?></th>
	    <td align="right" ><?php echo number_format($t_deb, 2, '.',','); ?></td>
	 	<td align="right" ><?php echo number_format($t_hab, 2, '.',','); ?></td>
		
	</tr>	
</table>
<br><br>
</center>
<center>
   <input class="btn_form" type="submit" name="accion" value="Reversion Compra/Venta">
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

