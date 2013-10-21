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
<!--Titulo de la pestaa de la pagina-->
<title>Saldo Final de Cajas</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
<script type="text/javascript" src="script/jquery-1.9.0.js"></script>
<script type="text/javascript" src="js/cajas_saldo_final_bs.js"></script> 
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="script/jquery.numeric.js"></script>
<script src="script/jquery-ui.js"></script>
<script language="javascript" src="script/validarForm.js" type="text/javascript"> </script>  
<script type="text/javascript" src="js/Utilitarios.js"></script> 
<script type="text/javascript" src="js/cajas_saldo_final_bs.js"></script> 
<script type="text/javascript" src="js/ValidarNumero.js"></script>  
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
                 <li id="menu_modulo_general_cajas">                   
                     <img src="img/fax_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CAJAS
                   
                 </li>
                  <li id="menu_modulo_cajas_salfin">                    
                     <img src="img/notepad_24x24.png" border="0" alt="Modulo" align="absmiddle"> SALDO FINAL CAJA
                    
                 </li>
          <?php if($_GET["menu"]==1){?> 
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/shield1_24x24.png" border="0" alt="Modulo" align="absmiddle"> SALDO FINAL BS
                    
                 </li>
                 </ul>
                 <!--Cabecera del modulo con su alerta-->
     				  <div id="contenido_modulo">
                      <h2> <img src="img/shield1_64x64.png" border="0" alt="Modulo" align="absmiddle">SALDO FINAL BS</h2>
                      <hr style="border:1px dashed #767676;">
                      <!--div id="error_login"> 
                     <img src="img/alert_32x32.png" align="absmiddle">
                     Elija la Transaccion
                     </div-->  
         <?php } elseif ($_GET["menu"]==2) { ?>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/shield3_24x24.png" border="0" alt="Modulo" align="absmiddle"> SALDO FINAL $US
                    
                 </li>
              </ul> 
					<!--Cabecera del modulo con su alerta-->
					     <div id="contenido_modulo">
		                      <h2> <img src="img/shield3_64x64.png" border="0" alt="Modulo" align="absmiddle">SALDO FINAL $US</h2>
		                      <hr style="border:1px dashed #767676;">
		                      <!--div id="error_login"> 
		                     <img src="img/alert_32x32.png" align="absmiddle">
		                     Elija la Transaccion
		                     </div-->   
		<?php } ?>
  

  <?php
     //$fec = leer_param_gral();
	 $fec1 = cambiaf_a_mysql_2($fec);
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
     $moneda ="";
	 if($_GET['menu']==1){ $moneda = "Bs.-";}elseif($_GET['menu']==2){  $moneda = "&#36;us.-";} 
     ?>

	<div id="dialog-message" title="Saldo Efectivo" style="display:none;">
			Su Saldo Efectivo no es suficiente
	</div>


<form name="form2" method="post" action="con_retro_1.php" onSubmit="return ValidaCamposEgresos(this)">
		<strong>
		<?php
		$mon = 0;
		$cod_mone = 0;
		$cantidad = 0;
		if (isset($_SESSION['caja_bs_sus'])){
		   		$mon = $_SESSION['caja_bs_sus'];
		 }
		
		$estado = 0; 
		$caj_hab = verif_cajero_hab($fec1,$log_usr);
		if ($caj_hab == 0){
			   echo "Usuario no Habilitado como cajero ".encadenar(2)." !!!!!";
			   $_SESSION['detalle'] = 0;
			   $_SESSION['continuar'] = 0;
			   ?> 
			   		<br> <center>
			 		<input class="btn_form" type="submit" name="accion" value="Salir Saldo">
				</form>
		<?php } ?>
		<strong>
	
		<?php
	   $estado = verif_cierre_cja($fec1,$log_usr,$mon);
	   if ($estado == 1){
	      	echo "YA ingreso saldos Final para fecha ".encadenar(2).$fec.encadenar(2)."Cajero".
	           encadenar(2).$log_usr."Moneda ".encadenar(2).$mon." !!!!!";
		      $_SESSION['detalle'] = 0;
			  $_SESSION['continuar'] = 0;
		    	?> 
			   <br><center>
			 <input class="btn_form" type="submit" name="accion" value="Salir">

			</form>
		<?php } ?>

		<strong>	
		<br><br>
 <?php 


	if ($estado == 0){
		if(isset($_SESSION['caja_bs_sus'])){
			$mon = $_SESSION['caja_bs_sus'];
		}
		if (isset($mon)){
			if ($mon == 1){
   				$des_mon = "Bolivianos";
   			}
			if ($mon == 2){
   				$des_mon = "Dolares Americanos";
   			}
  		}
 		if(isset($_SESSION['detalle'])){
			if ($_SESSION['detalle'] == 1){ //1a
    			$saldo = saldo_fin_cja2($fec1,$log_usr,$mon);
				$_SESSION['saldo'] = $saldo;
				$vales = saldo_fin_vale($fec1,$log_usr,$mon);
				$_SESSION['vales'] = $vales;
				//$banco = saldo_fin_banco($fec1,$log_usr,$mon);
				//$_SESSION['banco'] = $banco;
			}
	      if (isset($_SESSION['saldo'])){
	
	            }else{
	            $_SESSION['saldo'] = 0;
	        }
		?>
    	<table align="center" class="table_usuario">
    
      	<tr class="tr_usuario">
	    	<th align="left">Saldo Transacciones :</th>
			<!-- td align="center"><?php //echo encadenar(2); ?></td-->
			<?php if (isset ($_SESSION['saldo'])){?>
						<td align="right"><?php echo number_format($_SESSION['saldo'], 2, '.',','); ?> </td>
			<?php } ?> 
	  	</tr>
	 	 <tr class="tr_usuario">
		    <th align="left">Saldo Vales :</th>
			<!-- td align="center"><?php echo encadenar(2); ?></td-->
			<?php if (isset ($_SESSION['vales'])){?>
			<td align="right"><?php echo number_format($_SESSION['vales'], 2, '.',','); ?> </td>
			<?php } ?> 
	  	</tr>
	  	<tr class="tr_usuario">
	    <th align="left">Saldo Efectivo :</th>
		<!--td align="center"><?php //echo encadenar(2); ?></td-->
		<?php //echo $_SESSION['saldo']; echo $_SESSION['vales']; ?>
		<td align="right"><input type="text" name="saldo_efectivo" id="saldo_efectivo" class="txt_campo" readonly value="<?php echo number_format($_SESSION['saldo'] - $_SESSION['vales'], 2, '.',','); ?>">
			 <?php echo $moneda; ?> <input type="hidden" name="saldo_efectivo_oculto" id="saldo_efectivo_oculto" value="<?php echo ($_SESSION['saldo']-$_SESSION['vales']);?>"></td>
		</tr>							  
					  
									  
		<?php $_SESSION['efectivo'] = $_SESSION['saldo'] - $_SESSION['vales'] ;
		//echo $_SESSION['efectivo'];
		 
		    
	  }  //1b?>
	 </table>

     <br>


<?php
}
if(isset($_SESSION['continuar'])){
if ($_SESSION['continuar'] == 1){ //2a
    $_SESSION['cuantos'] = 0;
    $borr_cob  = "Delete From temp_ctable "; 
    $cob_borr = mysql_query($borr_cob);
     //2b
	





	$con_cortes  = "Select * 
					From caja_cortes 
					where CAJA_COR_FECHA = '$fec1' and 
	                 CAJA_COR_CAJERO = '$log_usr' and CAJA_COR_ESTADO = 1 and CAJA_COR_MON = $mon";
	$res_cortes = mysql_query($con_cortes);
	while ($lin_cortes = mysql_fetch_array($res_cortes)) { 
	// echo  $lin_cortes['CAJA_COR_CANTIDAD'];
	// while ($lin_temp = mysql_fetch_array($res_temp)) {
        $tipo = $lin_cortes['CAJA_COR_TIPO'];
		$cant = $lin_cortes['CAJA_COR_CANTIDAD'];
		$mont = $lin_cortes['CAJA_COR_MONTO'];
		$cod_cor = $lin_cortes['CAJA_COR_CODIGO'];
		$mon = $lin_cortes['CAJA_COR_MON'];
	//	echo $tipo, $cod_cor;
		
		$con_cor  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = $tipo and 
	              GRAL_PAR_PRO_COD = $cod_cor";
		$res_cor = mysql_query($con_cor);
		while ($lin_cor = mysql_fetch_array($res_cor)) { 
		       $sig = $lin_cor['GRAL_PAR_PRO_SIGLA'];
			   $des = $lin_cor['GRAL_PAR_PRO_DESC'];
			   $cort = $lin_cor['GRAL_PAR_PRO_CTA1'];
			}
		$consulta = "insert into temp_ctable (temp_tip_tra,
	                                      temp_nro_cta, 
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  ($tipo,
										   '$sig',
									       '$des',
										   $cant,
										   $mont,
										   $cod_cor,
										   $cort)";
										   
    $resultado = mysql_query($consulta);	
	$_SESSION['continuar'] = 2;	
	$_SESSION['prov'] = 1;	
		}
	}	
}
	/*	*/
//}  
	   
	   
if(isset($_SESSION['detalle'])){	
if ($_SESSION['detalle'] == 1){ //4a
    if ($mon == 1){
	   $con_cor  = "Select * 
	   				From gral_param_propios 
	   				where GRAL_PAR_PRO_GRP = 110 and 
	                GRAL_PAR_PRO_COD <> 0   order by 1,2";
	}	
	if ($mon == 2){
	 $con_cor  = "Select * 
	 			From gral_param_propios 
	 			where GRAL_PAR_PRO_GRP = 130  
	              and GRAL_PAR_PRO_COD <> 0   order by 1,2";
	}
	 $res_cor = mysql_query($con_cor);?>
    
    

<script>
function calculo(egr_monto, valor)
	{
		alert(egr_monto);
		alert(valor);
		var cantidad=f.txtcantidad.value;
		var precio=f.txtprecio.value;
		var subt=cantidad*precio;
		//var total_general=substring(total,total.length,-2);;
	}

</script>



<table class="table_usuario" align="center" border="1">
                    <tr>
                        <th>Monto <?php //echo $moneda; ?></th><th>Cantidad</th><th>Total</th>
                    </tr>
               <?php
               //$cont = 0;
               /*while ($linea = mysql_fetch_array($res_cor)) {
                     ?>
                     
                     <tr class="tr_usuario">
                        <td><input  class="txt_campo" type="text" name="egr_monto_1" id="A<?php //echo $cont; ?>" value="<?php //echo $linea['GRAL_PAR_PRO_CTA1']; ?>"  readonly><?php //echo $sigla[1];?></td>
                        <td ><input  class="txt_campo" type="text" name="egr_monto_2" id="B<?php //echo $cont; ?>" value="0" maxlength="4" size="5" onKeyPress="return soloNum(event)" onChange="calcularCantidad(this,<?php echo $cont; ?>);">
                         <div id="error_egr_monto"></div></td>
                        <td><input  class="txt_campo" type="text" name="egr_monto_2" id="C<?php //echo $cont; ?>" value="0" width="50"  readonly>&nbsp;</td>
                    </tr>	
               <?php 
               			//$cont++;
           			} */?>
           			<script type="text/javascript">
                     	//	alert('hshshhs');
                     	establecerNumero(<?php //echo $cont; ?>);
                     </script>
                   <!--tr >
    					<td></td>
    				    <th>Total :<input type="text" name="suma_total_cantidad" id="suma_total_cantidad" class="txt_campo" readonly value="0"></th>
    				    <td><input type="text" name="suma_total" id="suma_total" class="txt_campo" readonly value="0"></td>
    			  </tr-->

        <tr>
	       <th align="left"><?php echo $des_mon;?></th>
	    </tr>
		<tr>
	       <th align="left">Codigo Billete/ Moneda :</th>
	       <td> <select name="cod_cta" size="1"  >
	       
	       <?php while ($lin_cor = mysql_fetch_array($res_cor)) {  ?>
                 <option value=<?php echo $lin_cor['GRAL_PAR_PRO_COD']; ?>>
		                       <?php echo $lin_cor['GRAL_PAR_PRO_SIGLA'].encadenar(3).$lin_cor['GRAL_PAR_PRO_DESC']; ?>
				 </option>
           <?php } ?>
		        </select></td>
        </tr>
        <tr> 
           <th align="left" >Cantidad :</th>
		   <td><input  class="txt_campo" type="text" name="egr_monto" value="0" id="monto" onKeyPress="return soloNum(event)" > 
		 <div id="error_monto"></div></td>
        </tr>
   </table>

	 <center>
	  <br>
	 <input class="btn_form" type="submit" name="accion" value="Añadir">
	</form>
<?php } 
} //4b?> 
 <form name="form2" method="post" action="con_retro_1.php" onSubmit="return">
<?php
$apli = 10000;
$_SESSION['monto_t'] = 0;
$descrip = "";
$tc_ctb = $_SESSION['TC_CONTAB'];

$m_debe_1 = 0;
$m_haber_1 = 0;
$m_debe_2 = 0;
$m_haber_2 = 0;
$mon_cta = 0;
if(isset($_SESSION['continuar'])){
  if ($_SESSION['continuar'] == 2){ //5a
?>

<table align="center" border="1">
	  <tr>
       	<td align="center"><strong>Sigla  </strong></td>
		<td align="center"><strong>Corte  </strong> </td>
		<td align="center"><strong>Cantidad </strong></td>
		<td align="center"><strong>Monto </strong></td>
		<td align="center"><strong>Mod./Eli.</strong></td>
   </tr>

<?php
if ($_SESSION['prov'] == 0){
  if (isset($_POST['cod_cta'])){
     $cod_mone = $_POST['cod_cta'];
   $_SESSION['cod_mone'] = $cod_mone;
   }
   if (isset($_POST['egr_monto'])){ 
      $cantidad = $_POST['egr_monto'];
   }
 //  echo $cod_mone. $cantidad. "aqui....."; 
 //  $cantidad = $_POST['egr_monto'];
      
   if ($mon == 1){
       $cuantos = 110;
       $con_val  = "Select * 
       				From gral_param_propios 
       				where GRAL_PAR_PRO_GRP = 110 and 
	                GRAL_PAR_PRO_COD = $cod_mone";
	  }
   if ($mon == 2){
       $cuantos = 130;
	   $con_val  = "Select * 
	   				From gral_param_propios 
	   				where GRAL_PAR_PRO_GRP = 130 and 
	                GRAL_PAR_PRO_COD = $cod_mone";
	  }
   $res_val = mysql_query($con_val);
   while ($lin_val = mysql_fetch_array($res_val)) {
          $cod_por = $lin_val['GRAL_PAR_PRO_CTA1'];
		  $desc = $lin_val['GRAL_PAR_PRO_DESC']; 
		  $sigla = $lin_val['GRAL_PAR_PRO_SIGLA'];
		  $monto = $cantidad * $cod_por;
		  }
    $consulta = "insert into temp_ctable (temp_tip_tra,
	                                      temp_nro_cta, 
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  ($cuantos,
										   '$sigla',
									       '$desc',
										   $cantidad,
										   $monto,
										   $cod_mone,
										   $cod_por)";
										   
    $resultado = mysql_query($consulta);
	 }else{
	  $cod_mone = $_SESSION['cod_mone'];
  // $cod_mone = $_SESSION['caja_bs_sus'];
  $_SESSION['prov'] = 0;	 
   }
	$consulta  = "Select * From temp_ctable order by temp_debe_2";
    $resultado = mysql_query($consulta);
	
    $tot_debe_1 = 0;
    $tot_haber_1 = 0;
    $tot_debe_2 = 0;
    $tot_haber_2 = 0;
    while ($linea = mysql_fetch_array($resultado)) {
          $tot_debe_1 = $tot_debe_1 +$linea['temp_debe_1'];
	      $tot_haber_1 = $tot_haber_1 +$linea['temp_haber_1'];
	      $tot_debe_2 = $tot_debe_2 +$linea['temp_debe_2'];
	      $tot_haber_2 = $tot_haber_2 +$linea['temp_haber_2']; ?>
	      <tr>
	 	      <td align="left"><?php echo $linea['temp_nro_cta']; ?></td>
		      <td align="left"><?php echo $linea['temp_des_cta']; ?></td>
		      <td align="right"><?php echo number_format($linea['temp_debe_1'], 0, '.',',') ; ?></td>
		      <td align="right"><?php echo number_format($linea['temp_haber_1'], 2, '.',','); ?></td>
		      <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_debe_2']; ?>">	</td> 
	     </tr>
	 <?php }?>
         <tr>
	       	 <th><?php echo encadenar(3); ?></th>
		     <th align="center"><?php echo "Totales"; ?></th>
		     <th align="right"><?php echo encadenar(3); ?></th>
		     <th align="right"><?php echo number_format($tot_haber_1, 2, '.',','); ?></th>
		     
	     </tr>
		  <tr>
	       	 <th><?php echo encadenar(3); ?></th>
		     <?php if ($_SESSION['efectivo'] > $tot_haber_1){ ?>
		     <th align="center"><?php echo "Sobrante"; ?></th>
			  <?php } ?>
			  <?php if ($_SESSION['efectivo'] < $tot_haber_1){ ?>
		     <th align="center"><?php echo "Faltante"; ?></th>
			  <?php } ?>
			  <?php if ($_SESSION['efectivo'] == $tot_haber_1){ ?>
		     <th align="center"><?php echo "Diferencia"; ?></th>
			  <?php } ?>
		     <th align="right"><?php echo encadenar(3); ?></th>
		     <th align="right"><?php echo number_format($_SESSION['efectivo'] - $tot_haber_1, 2, '.',','); ?></th>
		     
	     </tr>
     </table>
     <center>
	 <input class="btn_form" type="submit" name="accion" value="Modificar Cantidad">  
	 <input class="btn_form" type="submit" name="accion" value="Eliminar">
	 <input class="btn_form" type="submit" name="accion" value="Grab. Cortes">
	 <input class="btn_form" type="submit" name="accion" value="Otra Transaccion">
    

</form>	
 <?php }
 } //5b?>
 
 <?php
 if(isset($_SESSION['eliminar'])){
 if ($_SESSION['eliminar'] == 1){
   // echo $_SESSION['entra'];
    if(isset($_POST['cmone'])){ //2a
       $cmone = $_POST['cmone'];
	   $_SESSION['cmone'] = $cmone;
	 echo $_SESSION['cmone'];?>
	 <form name="form2" method="post" action="con_retro_1.php" onSubmit="">
  <?php
	 $consulta  = "Delete From temp_ctable where temp_debe_2 = $cmone";
     $resultado = mysql_query($consulta);
	$consulta  = "Select * From temp_ctable order by temp_debe_2";
    $resultado = mysql_query($consulta);?>
	<table align="center" border="1">
	  <tr>
       	<td align="center"><strong>Sigla  </strong></td>
		<td align="center"><strong>Corte  </strong> </td>
		<td align="center"><strong>Cantidad </strong></td>
		<td align="center"><strong>Monto </strong></td>
		<td align="center"><strong>Mod./Eli.</strong></td>
   </tr>
   <?php
    $tot_debe_1 = 0;
    $tot_haber_1 = 0;
    $tot_debe_2 = 0;
    $tot_haber_2 = 0;
    while ($linea = mysql_fetch_array($resultado)) {
          $tot_debe_1 = $tot_debe_1 +$linea['temp_debe_1'];
	      $tot_haber_1 = $tot_haber_1 +$linea['temp_haber_1'];
	      $tot_debe_2 = $tot_debe_2 +$linea['temp_debe_2'];
	      $tot_haber_2 = $tot_haber_2 +$linea['temp_haber_2']; ?>
	      <tr>
	 	      <td align="left"><?php echo $linea['temp_nro_cta']; ?></td>
		      <td align="left"><?php echo $linea['temp_des_cta']; ?></td>
		      <td align="right"><?php echo number_format($linea['temp_debe_1'], 0, '.',',') ; ?></td>
		      <td align="right"><?php echo number_format($linea['temp_haber_1'], 2, '.',','); ?></td>
		      <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $cod_mone; ?>">	</td> 
	     </tr>
	 <?php }?>
         <tr>
	       	 <th><?php echo encadenar(3); ?></th>
		     <th align="center"><?php echo "Totales"; ?></th>
		     <th align="right"><?php echo encadenar(3); ?></th>
		     <th align="right"><?php echo number_format($tot_haber_1, 2, '.',','); ?></th>
		     
	     </tr>
		  <tr>
	       	 <th><?php echo encadenar(3); ?></th>
			 <?php if ($_SESSION['efectivo'] > $tot_haber_1){ ?>
		     <th align="center"><?php echo "Sobrante"; ?></th>
			  <?php } ?>
			  <?php if ($_SESSION['efectivo'] < $tot_haber_1){ ?>
		     <th align="center"><?php echo "Faltante"; ?></th>
			  <?php } ?>
			  <?php if ($_SESSION['efectivo'] == $tot_haber_1){ ?>
		     <th align="center"><?php echo "Diferencia"; ?></th>
			  <?php } ?>
		     <th align="right"><?php echo encadenar(3); ?></th>
		     <th align="right"><?php echo number_format($_SESSION['efectivo'] - $tot_haber_1, 2, '.',','); ?></th>
		     
	     </tr>
     </table>
	 <center>
	 <input class="btn_form" type="submit" name="accion" value="Modificar Cantidad">  
	 <input class="btn_form" type="submit" name="accion" value="Eliminar">
	 <input class="btn_form" type="submit" name="accion" value="Grab. Cortes">
	 <input class="btn_form" type="submit" name="accion" value="Otra Transaccion">
     

</form>	
 <?php
 //}
 }
 }
} 
 //modificar
 
if(isset($_SESSION['modificar'])){ 
 if ($_SESSION['modificar'] == 1){
   // echo $_SESSION['entra'];
    if(isset($_POST['cmone'])){ //2a
       $cmone = $_POST['cmone'];
	   $_SESSION['cmone'] = $cmone;
	 // echo $_SESSION['cmone'];?>
	 <form name="form2" method="post" action="con_retro_1.php" onSubmit="">
  <?php
	 $con_modi  = "Select * From temp_ctable where temp_debe_2 = $cmone";
     $res_modi = mysql_query($con_modi);
	   while ($lin_modi = mysql_fetch_array($res_modi)) { ?>
	<table align="center" border="1">
	  <tr>
       	<td align="center"><strong>Sigla  </strong></td>
		<td align="center"><strong>Corte  </strong> </td>
		<td align="center"><strong>Monto </strong></td>
		<td align="center"><strong>Cantidad </strong></td>
		<td align="center"><strong>Nueva Cant. </strong></td>
	  </tr>
	  <tr>
	 	      <td align="left"><?php echo $lin_modi['temp_nro_cta']; ?></td>
		      <td align="left"><?php echo $lin_modi['temp_des_cta']; ?></td>
		      <td align="right"><?php echo number_format($lin_modi['temp_haber_1'], 2, '.',','); ?></td>
		      <td align="right"><?php echo number_format($lin_modi['temp_debe_1'], 0, '.',','); ?></td>
		      <td><input  type="text" name="nue_cant" onKeyPress="return soloNum(event)" onBlur="limpia()" > </td>	
	     </tr>
	</table>
	<input class="btn_form" type="submit" name="accion" value="Grab. Modificado">

</form>		 
   <?php 
		 
	   }
	  
	 
	 
	 
	$consulta  = "Select * From temp_ctable order by temp_debe_2";
    $resultado = mysql_query($consulta);?>
	<table align="center" border="1">
	  <tr>
       	<td align="center"><strong>Sigla  </strong></td>
		<td align="center"><strong>Corte  </strong> </td>
		<td align="center"><strong>Cantidad </strong></td>
		<td align="center"><strong>Monto </strong></td>
		
   <?php
    $tot_debe_1 = 0;
    $tot_haber_1 = 0;
    $tot_debe_2 = 0;
    $tot_haber_2 = 0;
    while ($linea = mysql_fetch_array($resultado)) {
          $tot_debe_1 = $tot_debe_1 +$linea['temp_debe_1'];
	      $tot_haber_1 = $tot_haber_1 +$linea['temp_haber_1'];
	      $tot_debe_2 = $tot_debe_2 +$linea['temp_debe_2'];
	      $tot_haber_2 = $tot_haber_2 +$linea['temp_haber_2']; ?>
	      <tr>
	 	      <td align="left"><?php echo $linea['temp_nro_cta']; ?></td>
		      <td align="left"><?php echo $linea['temp_des_cta']; ?></td>
		      <td align="right"><?php echo number_format($linea['temp_debe_1'], 0, '.',',') ; ?></td>
		      <td align="right"><?php echo number_format($linea['temp_haber_1'], 2, '.',','); ?></td>
		      
	     </tr>
	 <?php }?>
         <tr>
	       	 <th><?php echo encadenar(3); ?></th>
		     <th align="center"><?php echo "Totales"; ?></th>
		     <th align="right"><?php echo encadenar(3); ?></th>
		     <th align="right"><?php echo number_format($tot_haber_1, 2, '.',','); ?></th>
		     
	     </tr>
		  <tr>
	       	 <th><?php echo encadenar(3); ?></th>
		      <?php if ($_SESSION['efectivo'] > $tot_haber_1){ ?>
		     <th align="center"><?php echo "Sobrante"; ?></th>
			  <?php } ?>
			  <?php if ($_SESSION['efectivo'] < $tot_haber_1){ ?>
		     <th align="center"><?php echo "Faltante"; ?></th>
			  <?php } ?>
			  <?php if ($_SESSION['efectivo'] == $tot_haber_1){ ?>
		     <th align="center"><?php echo "Diferencia"; ?></th>
			  <?php } ?>
		     <th align="right"><?php echo encadenar(3); ?></th>
		     <th align="right"><?php echo number_format($_SESSION['efectivo'] - $tot_haber_1, 2, '.',','); ?></th>
		     
	     </tr>
     </table>
	 <center>
 </form>	
 <?php
 //}
 }
 }
 }
 //graba modificacion
if(isset($_SESSION['grab_mod'])){  
 if ($_SESSION['grab_mod'] == 1){
   // echo $_SESSION['entra'];
    if(isset($_POST['nue_cant'])){ //2a
       $nue_cant = $_POST['nue_cant'];
	   $_SESSION['nue_cant'] = $nue_cant;
	 // echo $_SESSION['cmone'];?>
	 <form name="form2" method="post" action="con_retro_1.php" onSubmit="">
  <?php
     $cmone = $_SESSION['cmone']; 
	 $con_modi  = "update temp_ctable set temp_debe_1 = $nue_cant,
	                                      temp_haber_1 = temp_haber_2 * $nue_cant where temp_debe_2 = $cmone";
     $res_modi = mysql_query($con_modi);
	 //  while ($lin_modi = mysql_fetch_array($res_modi)) { ?>
	<input type="submit" name="accion" value="Modificar Cantidad">  
	 <input type="submit" name="accion" value="Eliminar">
	 <input type="submit" name="accion" value="Grab. Cortes">
	 <input type="submit" name="accion" value="Otra Transaccion">

</form>		 
   <?php 
		 
	   //}
	  
	 
	 
	 
	$consulta  = "Select * 
				  From temp_ctable order by temp_debe_2";
    $resultado = mysql_query($consulta);?>
	<table align="center" border="1">
	  <tr>
       	<td align="center"><strong>Sigla  </strong></td>
		<td align="center"><strong>Corte  </strong> </td>
		<td align="center"><strong>Cantidad </strong></td>
		<td align="center"><strong>Monto </strong></td>
		<td align="center"><strong>Mod./Eli.</strong></td>
   </tr>
   <?php
    $tot_debe_1 = 0;
    $tot_haber_1 = 0;
    $tot_debe_2 = 0;
    $tot_haber_2 = 0;
    while ($linea = mysql_fetch_array($resultado)) {
          $tot_debe_1 = $tot_debe_1 +$linea['temp_debe_1'];
	      $tot_haber_1 = $tot_haber_1 +$linea['temp_haber_1'];
	      $tot_debe_2 = $tot_debe_2 +$linea['temp_debe_2'];
	      $tot_haber_2 = $tot_haber_2 +$linea['temp_haber_2']; ?>
	      <tr>
	 	      <td align="left"><?php echo $linea['temp_nro_cta']; ?></td>
		      <td align="left"><?php echo $linea['temp_des_cta']; ?></td>
		      <td align="right"><?php echo number_format($linea['temp_debe_1'], 0, '.',',') ; ?></td>
		      <td align="right"><?php echo number_format($linea['temp_haber_1'], 2, '.',','); ?></td>
		      <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $cod_mone; ?>">	</td> 
	     </tr>
	 <?php }?>
         <tr>
	       	 <th><?php echo encadenar(3); ?></th>
		     <th align="center"><?php echo "Totales"; ?></th>
		     <th align="right"><?php echo encadenar(3); ?></th>
		     <th align="right"><?php echo number_format($tot_haber_1, 2, '.',','); ?></th>
		     
	     </tr>
		  <tr>
	       	 <th><?php echo encadenar(3); ?></th>
		      <?php if ($_SESSION['efectivo'] > $tot_haber_1){ ?>
		     <th align="center"><?php echo "Sobrante"; ?></th>
			  <?php } ?>
			  <?php if ($_SESSION['efectivo'] < $tot_haber_1){ ?>
		     <th align="center"><?php echo "Faltante"; ?></th>
			  <?php } ?>
			  <?php if ($_SESSION['efectivo'] == $tot_haber_1){ ?>
		     <th align="center"><?php echo "Diferencia"; ?></th>
			  <?php } ?>
		     <th align="right"><?php echo encadenar(3); ?></th>
		     <th align="right"><?php echo number_format($_SESSION['efectivo'] - $tot_haber_1, 2, '.',','); ?></th>
		     
	     </tr>
     </table>
	 <center>
 </form>	
 <?php
 //}
 }
 }
 }
 
 ?>


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