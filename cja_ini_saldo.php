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
<head>
<!--Titulo de la pestaña de la pagina-->
<title>Saldo Inicial Cajas</title>
<!--meta charset="UTF-8"-->

<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script language="javascript" src="script/validarForm.js"></script> 
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script type="text/javascript" src="js/cajas_sal_ini.js"></script> 
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
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/directories_24x24.png" border="0" alt="Modulo" align="absmiddle"> SALDO INICIAL CAJAS
                    
                 </li>
              </ul>  
 			<div id="contenido_modulo" >
                      <h2> <img src="img/directories_64x64.png" border="0" alt="Modulo" align="absmiddle">SALDO INICIAL CAJAS</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
		                     <img src="img/checkmark_32x32.png" align="absmiddle">
		                      Registro Saldos Iniciales Caja
                     </div>
					<?php
					 $fec = $_SESSION['fec_proc']; //leer_param_gral();

					 $_SESSION['fec_p'] = $fec;
					 $logi = $_SESSION['login']; 
					 $ag_usr = $_SESSION['COD_AGENCIA'];
					 ?> 
					<center>

					<center>
					<?php
					$consulta  = "Select * From gral_agencia where GRAL_AGENCIA_USR_BAJA is null ";
					$resultado = mysql_query($consulta);
					$con_sal  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 500 and GRAL_PAR_PRO_COD <> 0 ";
					$res_sal = mysql_query($con_sal);
					$con_trc = "SELECT CAJA_TRAN_FECHA FROM caja_transac where CAJA_TRAN_AGE_ORG = $ag_usr and CAJA_TRAN_TIPO_OPE = 1
					 ORDER BY CAJA_TRAN_FECHA DESC LIMIT 0,1";
					 $res_trc = mysql_query($con_trc);
					 $lin_trc = mysql_fetch_array($res_trc);
					 $fch_ini = $lin_trc['CAJA_TRAN_FECHA'];
					 //echo $fch_ini;
					 $con_trc = "SELECT CAJA_TRAN_FECHA FROM caja_transac where CAJA_TRAN_USR_ALTA = '$logi' and CAJA_TRAN_TIPO_OPE = 2
					 ORDER BY CAJA_TRAN_FECHA DESC LIMIT 0,1";
					 $res_trc = mysql_query($con_trc);
					 $lin_trc = mysql_fetch_array($res_trc);
					 $fch_fin = $lin_trc['CAJA_TRAN_FECHA'];
					 $_SESSION['fch_fin'] = $fch_fin;
					 //echo $fch_fin."--". $_SESSION['fch_fin'];
					 ?> 
					<form name="form2" method="post" action="grab_retro_cja.php">
					<?php
					//Verifica si ya hizo el inicio esa fecha
					$nro_tr = verif_saldo_ini_cja($fec,$logi,$ag_usr);
					//echo "entra ", $nro_tr;
					if ($nro_tr >= 2) {
					   $fec_a = cambiaf_a_mysql_2($fec);
					   //echo $fec_a;
					  $con_trc = "SELECT * FROM caja_transac where CAJA_TRAN_USR_ALTA = '$logi' and CAJA_TRAN_TIPO_OPE = 1
					  and CAJA_TRAN_FECHA = '$fec_a'";
					  $res_trc = mysql_query($con_trc);
					 // $nro_tra = 0;
					  while ($lin_trc = mysql_fetch_array($res_trc)) {
					     //   echo $lin_trc['CAJA_TRAN_MON'];
					        if ($lin_trc['CAJA_TRAN_MON'] == 1) {
					           $sal_bs = $lin_trc['CAJA_TRAN_IMPORTE'];
							   $_SESSION['sal_bs'] = $sal_bs;
					  		  }
						    if ($lin_trc ['CAJA_TRAN_MON'] == 2) {
					           $sal_us = $lin_trc['CAJA_TRAN_IMP_EQUIV'];
							   $_SESSION['sal_us'] = $sal_us;
					  		  } 
					       }
					    ?>
						
						 <strong>  LOS SALDOS INICIALES YA  <br><br>
						    <?php echo "FUERON INGRESADOS PARA HOY  .... ",  $fec; ?> <br>
						  </strong>
						  <BR>
						  <strong> Saldo Inicial Bolivianos .....  
						    <?php echo number_format($sal_bs, 2, '.',',');?>
							 </strong>  
							<br><br>
						  <strong>    Saldo Inicial Dolares .........
						   <?php echo number_format($sal_us, 2, '.',',');?>
						  </strong>	    
						  <br>
						  <br>
						  <BR><BR><br>
						 <center>
						 <!--input class="btn_form" type="submit" name="accion" value="Salir"-->
						<?php }?>
						<?php
						//echo "nro_tr",$nro_tr,"fch_fin",$fch_fin;
						 if ($nro_tr < 2) { 
						// Verifica si la fecha anterior cerro
						    $nro_t = verif_saldo_fin_cja($fch_fin,$logi);
							if ($nro_t < 2) { 
						        if ($nro_t == 0){
						        ?><br> <?php
						            echo "No registro el Saldo Final del día anterior!!!!!!!" ;
						        }
						        if ($nro_t == 1){
						            echo  $nro_t, "Registro el Saldo Final de una sola moneda, el día anterior!!!!!!!" ;
						        }
						   ?>
						  <BR><BR><br>
						 <center>
						 <!--input class="btn_form" type="submit" name="accion" value="Salir"-->
						<?php } 
						  }
						if(isset($nro_t)){  
						 if ($nro_t == 2){
						 //echo $fch_fin;
						    $con_sal = "SELECT * FROM caja_transac where CAJA_TRAN_CAJERO1 = '$logi' and CAJA_TRAN_TIPO_OPE = 2
						               and CAJA_TRAN_FECHA = '$fch_fin'";
						    $res_sal = mysql_query($con_sal);
							$sal_bs = 0; 
							$sal_us = 0;
						    while ($lin_sal = mysql_fetch_array($res_sal)) {
							$fec_cant = $lin_sal['CAJA_TRAN_FECHA'];
							$f_ultc = cambiaf_a_normal($fch_fin);
							      if ($lin_sal['CAJA_TRAN_MON'] == 1) {
						             $sal_bs  = $lin_sal['CAJA_TRAN_IMPORTE'];
								  }
								 if ($lin_sal['CAJA_TRAN_MON'] == 2) {
						             $sal_us  = $lin_sal['CAJA_TRAN_IMP_EQUIV'];
								  } 
						       }
						 
						//verif_cierre($fec);
							 ?>
							 <strong>  Fecha cierre anterior  </strong>
							    <?php echo $f_ultc; ?> <br>
							  <BR>
							  <strong>
							   <?php
							//  echo  "Saldos iniciales al .......", $fec,$sal_bs,$sal_us ;
							   ?>

							<div id="monedas" style="float:center;width:80%; border:5px double #ffffff   ">

							  <div id="bolivianos" style="float:left;width:40%; border:5px double #ffffff  ">

								   <strong>  BOLIVIANOS  </strong> <br>
								    <?php if ($nro_t == 2){

									 $saldo = saldo_fin_cja2($fch_fin,$logi,1);
									 
									$_SESSION['saldo'] = $saldo;
									$vales = saldo_fin_vale($fch_fin,$logi,1);
									$_SESSION['vales'] = $vales;
									$banco = saldo_fin_banco($fch_fin,$logi,1);
									$_SESSION['banco'] = $banco;
									?>
								    <table align="center" border="1" class="table_usuario">
								    
										      <tr>
											    <th align="left">Saldo Transacciones :</th>
												<td align="center"><?php echo encadenar(2); ?></td>
												<?php if (isset ($_SESSION['saldo'])){?>
												<th align="right"><?php echo number_format($_SESSION['saldo'], 2, '.',','); ?> </td>
												<?php } ?> 
											  </tr>
											  <tr>
											    <th align="left">Saldo Vales :</th>
												<td align="center"><?php echo encadenar(2); ?></td>
												<?php if (isset ($_SESSION['vales'])){?>
												<th align="right"><?php echo number_format($_SESSION['vales'], 2, '.',','); ?> </td>
												<?php } ?> 
											  </tr>
											  <tr>
											    <th align="left">Saldo Bancos :</th>
												<td align="center"><?php echo encadenar(2); ?></td>
												<?php if (isset ($_SESSION['bancos'])){?>
												<th align="right"><?php echo number_format($_SESSION['bancos'], 2, '.',','); ?> </td>
												<?php }else{
												    $_SESSION['bancos'] = 0; ?>
												<th align="right"><?php echo number_format(0, 2, '.',','); ?> </td>
												 <?php } ?> 
											  </tr>
											   <tr>
											    <th align="left">Saldo Efectivo :</th>
												<td align="center"><?php echo encadenar(2); ?></td>
												<?php if (isset ($_SESSION['bancos'])){?>
												<th align="right"><?php echo number_format($_SESSION['saldo'] - $_SESSION['vales'] - $_SESSION['bancos'] 
												                              , 2, '.',','); ?> </td>
												<?php $_SESSION['efectivo'] = $_SESSION['saldo'] - $_SESSION['vales'] - $_SESSION['bancos']; 
												 }
												    
											 // }  //1b?>
									 </table>
									 <br>
										<table align="center" border="1" width="300" class="table_usuario">
											<tr>
											    <th align="center">Corte</th>  
											   	<th align="center">Cantidad</th> 
												<th align="center">Monto</th>           
											</tr>	
											<?php
												$con_cor = "SELECT * FROM caja_cortes, gral_param_propios  where 
												            CAJA_COR_USR_ALTA =  '$logi' and CAJA_COR_MON = 1
															and CAJA_COR_INI_FIN = 2
											                and CAJA_COR_FECHA = '$fch_fin' and GRAL_PAR_PRO_GRP = CAJA_COR_TIPO
															and GRAL_PAR_PRO_COD = CAJA_COR_CODIGO";
											    $res_cor = mysql_query($con_cor);
												
												$tot_cortes1 = 0;
												
												
											    while ($lin_cor = mysql_fetch_array($res_cor)) { 
												       $tot_cortes1 = $tot_cortes1 + $lin_cor['CAJA_COR_MONTO'];
												
												?>
												     <tr>
												   	 	<td align="right" ><?php echo $lin_cor['GRAL_PAR_PRO_SIGLA']; ?></td>
												        <td align="right" ><?php echo number_format($lin_cor['CAJA_COR_CANTIDAD'], 0, '.',','); ?></td>
													    <td align="right" ><?php echo number_format($lin_cor['CAJA_COR_MONTO'], 2, '.',','); ?></td>
													 </tr> 
													<?php
												 }
												?>
												    <tr>
												   	 	<th align="center" ><?php echo 'Total'; ?></th>
												        <td align="right" ><?php echo encadenar(2); ?></td>
													    <th align="right" ><?php echo number_format($tot_cortes1, 2, '.',','); ?></th>
													 </tr> 
									</table>
									<br>
							  </div>

							<div id="dolares" style="float:right;width:40%; border:5px double #ffffff " >
								<strong>  DOLARES  </strong>
							  <?php
							   $saldo2 = saldo_fin_cja2($fch_fin,$logi,2);
								 
								$_SESSION['saldo2'] = $saldo2;
								$vales2 = saldo_fin_vale($fch_fin,$logi,2);
								$_SESSION['vales2'] = $vales2;
								$banco2 = saldo_fin_banco($fch_fin,$logi,2);
								$_SESSION['banco2'] = $banco2;
								?>
							    	<table align="center" border="1" class="table_usuario">
							    
									      <tr>
										    <th align="left">Saldo Transacciones :</th>
											<td align="center"><?php echo encadenar(2); ?></td>
											<?php if (isset ($_SESSION['saldo2'])){?>
											<th align="right"><?php echo number_format($_SESSION['saldo2'], 2, '.',','); ?> </td>
											<?php } ?> 
										  </tr>
										  <tr>
										    <th align="left">Saldo Vales :</th>
											<td align="center"><?php echo encadenar(2); ?></td>
											<?php if (isset ($_SESSION['vales2'])){?>
											<th align="right"><?php echo number_format($_SESSION['vales2'], 2, '.',','); ?> </td>
											<?php } ?> 
										  </tr>
										  <tr>
										    <th align="left">Saldo Bancos :</th>
											<td align="center"><?php echo encadenar(2); ?></td>
											<?php if (isset ($_SESSION['bancos2'])){?>
											<th align="right"><?php echo number_format($_SESSION['bancos2'], 2, '.',','); ?> </td>
											<?php }else{
											    $_SESSION['bancos2'] = 0; ?>
											<th align="right"><?php echo number_format(0, 2, '.',','); ?> </td>
											 <?php } ?> 
										  </tr>
								   		  <tr>
										    <th align="left">Saldo Efectivo :</th>
											<td align="center"><?php echo encadenar(2); ?></td>
											<?php if (isset ($_SESSION['bancos2'])){?>
											<td align="center"><?php echo number_format($_SESSION['saldo2'] - $_SESSION['vales2'] - $_SESSION['bancos2'] 
											                              , 2, '.',','); ?> </td>
											<?php $_SESSION['efectivo2'] = $_SESSION['saldo2'] - $_SESSION['vales2'] - $_SESSION['bancos2']; 
											 }

								 // }  //1b?>
								 	</table>
								 	<br><br>
									<table border="1" width="300" class="table_usuario">
										<tr>
										    <th align="center">Corte</th>  
										   	<th align="center">Cantidad</th> 
											<th align="center">Monto</th>           
										</tr>	
											<?php
												$con_cor = "SELECT * FROM caja_cortes, gral_param_propios  where 
												            CAJA_COR_USR_ALTA =  '$logi' and CAJA_COR_MON = 2
															and CAJA_COR_INI_FIN = 2
											                and CAJA_COR_FECHA = '$fch_fin' and GRAL_PAR_PRO_GRP = CAJA_COR_TIPO
															and GRAL_PAR_PRO_COD = CAJA_COR_CODIGO";
											    $res_cor = mysql_query($con_cor);
												//$sal_bs = 0; 
												$tot_cortes2 = 0;
											    while ($lin_cor = mysql_fetch_array($res_cor)) {
												       $tot_cortes2 = $tot_cortes2 + $lin_cor['CAJA_COR_MONTO'];
													   ?>
									     <tr>
									   	 	<td align="right" ><?php echo $lin_cor['GRAL_PAR_PRO_SIGLA']; ?></td>
									        <td align="right" ><?php echo number_format($lin_cor['CAJA_COR_CANTIDAD'], 0, '.',','); ?></td>
										    <td align="right" ><?php echo number_format($lin_cor['CAJA_COR_MONTO'], 2, '.',',');; ?></td>
										 </tr>  	 
											<?php
											 }
											?>
									    <tr>
									   	 	<th align="center" ><?php echo 'Total'; ?></th>
									        <td align="right" ><?php echo encadenar(2); ?></td>
										    <th align="right" ><?php echo number_format($tot_cortes2, 2, '.',','); ?></th>
										 </tr> 
									</table>
								
								</div>	


							</div>   <center>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	<input class="btn_form" type="submit" name="accion" value="Grabar"></center><br> 
								 <?php }else{?>
								<!-- class="btn_form" type="submit" name="accion" value="Salir"-->
								<?php }?>
								
							<?php }
							   }?>
							  
							</form>
			</div> 
			<!--div style="clear:both;"></div-->
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