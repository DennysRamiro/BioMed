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
 $fec = leer_param_gral();
 $logi = $_SESSION['login']; 
?>
  <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	   <a href='fgar_reportes.php'>Salir</a>
  </div>

<br><br>
<?php
$borr_tfon  = "delete from temp_fondo "; 
$borr_tfon = mysql_query($borr_tfon);
$f_has ="";
$f_cal ="";
$t_cuo = 0;
$saldo = 0;
$tot_des = 0;
$log_usr = $_SESSION['login']; 
$total = 0;
$tip = 0;
$est1 = 0;
$est2 = 0;
$tot_sal = 0;
$tot_dep = 0;
$tot_ret = 0;
$cas = "";
$nro = 0;
if(isset($_POST['ccas'])){
   $cas = $_POST['ccas'];
   }
   if ($cas == "S"){
      $est1 = 8;
	  $est2 = 8;
     }else{
	 $est1 = 3;
	 $est2 = 20;
      }
$cod_mon = 	$_POST['cod_mon'] ;
$fec_pro = $_POST['fec_nac'] ; 
$f_pro = cambiaf_a_mysql($fec_pro); 
?> 
 <font size="+2"  style="" >

<?php
echo encadenar(40)."Detalle de Fondo de Garantia  al ".encadenar(3).$fec_pro;
?>
</font>
<br><br>
<?php
if ($cod_mon == 1){
   echo "Moneda Bolivianos";
   }
 if ($cod_mon == 2){
   echo "Moneda Dolares Americanos";
   }   
 ?>  
 
  <table border="1" width="1000">
	
	<tr>
	    <th width="8%" align="center">Nro</th>
		<th width="8%" align="center">Nro. Cuenta</th>   
		<th width="8%" align="center">Asesor</th>   
	   	<th width="8%" align="center">Nro. Crédito(s)</th> 
		<th align="center">Grupo</th> 
		<th align="center">Cliente</th>           
	   	<th align="center">Monto Depositado</th>
		<th align="center">Monto Retirado</th>
		<th align="center">Saldo </th>
  </tr>	
     
 <?php
     $con_fon1  = "Select DISTINCT FOND_NRO_CTA From fond_maestro where FOND_COD_MON = $cod_mon 
	             and FOND_ESTADO = 3  and 
				  FOND_MAE_USR_BAJA is null order by FOND_NRO_CTA"; 
   $res_fon1 = mysql_query($con_fon1);
  while ($lin_fon1 = mysql_fetch_array($res_fon1)) {   // 1a 
      $cta = $lin_fon1['FOND_NRO_CTA'];
 
    $con_fon  = "Select * From fond_cliente, cliente_general
             where FOND_CLI_NCTA =  $cta
             and CLIENTE_COD_ID = FOND_CLI_ID and FOND_CLI_RELACION = 'T' 
			 and FOND_CLI_USR_BAJA is null and  CLIENTE_USR_BAJA is null";
	//  order by CLIENTE_AP_PATERNO,CLIENTE_AP_MATERNO, CLIENTE_AP_ESPOSO, CLIENTE_NOMBRES"; 
    $res_fon = mysql_query($con_fon);
  //  $con_fon  = "Select DISTINCT FOND_NRO_CTA, FOND_TIPO_OPER  From fond_maestro where FOND_COD_MON = $cod_mon 
//	             and FOND_ESTADO = 3  and 
//				  FOND_MAE_USR_BAJA is null order by FOND_NRO_CTA"; 
 //   $res_fon = mysql_query($con_fon)or die('No pudo seleccionarse fond_maestro');
    while ($lin_fon = mysql_fetch_array($res_fon)) {   // 1a 
      //echo "entra";
		$nom_grp = ""; 
	               $nom_cli = $lin_fon['CLIENTE_AP_PATERNO'].encadenar(1).
					          $lin_fon['CLIENTE_AP_MATERNO'].encadenar(1).
					          $lin_fon['CLIENTE_AP_ESPOSO'].encadenar(1).
					         $lin_fon['CLIENTE_NOMBRES'].encadenar(1);
		// $tip = $lin_fon['FOND_TIPO_OPER'];
		 //echo $cta;
		
		 $tot_tre = 0;
		 $tot_tde = 0;
		 $cuantos = 0;
		 $saldo = 0;
		// $nom_cli = "";
		 $cod_cre2 = "";
	   //  $nom_cli = ""; 
		 
		 $con_dtra  = "Select sum(FOND_DTRA_IMPO) From fond_det_tran where FOND_DTRA_NCTA = $cta 
		               and FOND_DTRA_FECHA <= '$f_pro' and 
                       FOND_DTRA_TIP_TRAN = 1 and FOND_DTRA_CCON = 212 and FOND_DTRA_USR_BAJA is null ";
         $res_dtra = mysql_query($con_dtra);
         while ($lin_dtra = mysql_fetch_array($res_dtra)) { // 2a
                $tot_tde = $lin_dtra['sum(FOND_DTRA_IMPO)'];
	   	        } // 2c
				
	     $con_dtra  = "Select sum(FOND_DTRA_IMPO) From fond_det_tran where FOND_DTRA_NCTA = $cta 
		               and FOND_DTRA_FECHA <= '$f_pro' and FOND_DTRA_CCON = 212 and 
                       FOND_DTRA_TIP_TRAN = 2 and FOND_DTRA_USR_BAJA is null ";
         $res_dtra = mysql_query($con_dtra);
   	     while ($lin_dtra = mysql_fetch_array($res_dtra)) {   // 3a
	            $tot_tre = $lin_dtra['sum(FOND_DTRA_IMPO)'];
	        } // 3c
		 $saldo = $tot_tde - $tot_tre;		
		 $tot_sal = $tot_sal + ($tot_tde - $tot_tre);
		
		 
		// if ($saldo <> 0 ){	 
		 
		 
		 
		 
		/* $consulta = "insert into temp_fondo (TEMP_CTA,
		                                      TEMP_CRED, 
		                                      TEMP_SAL
											  ) values
										      ($cta,
											   '$tip',
											   $saldo
											     )";
										   
         $resultado = mysql_query($consulta)or die('No pudo insertar temp_fondo : ' . mysql_error());
		 */
		 // echo $cta," ",$saldo;
		 // }
	//	  }
	/*   $con_temp  = "Select *  From temp_fondo ";
	       $res_temp = mysql_query($con_temp)or die('No pudo seleccionarse temp_fondo');
	       while ($lin_temp = mysql_fetch_array($res_temp)) {
		    $cod_cre3 = "";
		          $tipo = $lin_temp['TEMP_CRED'];
				  $cta_fon = $lin_temp['TEMP_CTA'];
				  $saldo =  $lin_temp['TEMP_SAL'];
		   $con_fon2  = "Select * From fond_cliente, cliente_general
             where FOND_CLI_NCTA = $cta_fon  
             and CLIENTE_COD_ID = FOND_CLI_ID and FOND_CLI_RELACION = 'T' 
			 and FOND_CLI_USR_BAJA is null and CLIENTE_USR_BAJA is null"; 
             $res_fon2 = mysql_query($con_fon2)or die('No pudo seleccionarse fond_cliente, cliente_general');
 
             while ($lin_fon2 = mysql_fetch_array($res_fon2)) {
			      $nom_grp = ""; 
	               $nom_cli = $lin_fon2['CLIENTE_AP_PATERNO'].encadenar(1).
					          $lin_fon2['CLIENTE_AP_MATERNO'].encadenar(1).
					          $lin_fon2['CLIENTE_AP_ESPOSO'].encadenar(1).
					         $lin_fon2['CLIENTE_NOMBRES'].encadenar(1);
	           }
	/*  if ($tipo == 1){
	   
	   echo $cta_fon, " cta";
          $con_car2  = "Select CART_NRO_CRED,CART_ESTADO 
		              From cart_maestro, fond_maestro 
                      where FOND_NRO_CTA = $cta_fon and  CART_NRO_CRED = FOND_NRO_CRED and CART_MAE_USR_BAJA is null ";
	     $res_car2 = mysql_query($con_car2)or die('No pudo seleccionarse cart_maestro 1');
	     while ($lin_car2 = mysql_fetch_array($res_car2)) {
		  // 4a
		        $nom_ases = "";
	            $cod_cre2 = $lin_car2['CART_NRO_CRED']; 
			    $cod_est = $lin_car2['CART_ESTADO'];
				
			    //$nom_ases = leer_nombre_usr($t_cred,$asesor);
				if ($cod_est < 9){				 
				       $cod_cre3 = $cod_cre3." ".$cod_cre3;
					}
		}			
		 $con_car3  = "Select DISTINCT FOND_NRO_CTA, CART_NRO_CRED, CART_FEC_DES 
		              From cart_maestro, fond_maestro 
                      where FOND_NRO_CTA = $cta_fon and  CART_NRO_CRED = FOND_NRO_CRED and CART_MAE_USR_BAJA is null
					  ORDER BY CART_FEC_DES DESC LIMIT 0,1 ";
	     $res_car3 = mysql_query($con_car3)or die('No pudo seleccionarse cart_maestro 1');
	     while ($lin_car3 = mysql_fetch_array($res_car3)) {
		  // 4a
		        $nom_ases = "";
	            $cod_cre3 = $lin_car3['CART_NRO_CRED']; 
			   //$cod_est = $lin_car1['CART_ESTADO'];
				
			    //$nom_ases = leer_nombre_usr($t_cred,$asesor);
				//if ($cod_est < 9){				 
				//       $cod_cre2 = $cod_cre2." ".$cod_cre1;
				//	   
				//	}
			    $con_car  = "Select CLIENTE_AP_PATERNO,CLIENTE_AP_MATERNO,CLIENTE_AP_ESPOSO,CLIENTE_NOMBRES
					         From cart_deudor, cliente_general where CART_DEU_NCRED = $cod_cre3 
                             and CLIENTE_COD_ID = CART_DEU_ID and CART_DEU_RELACION = 'C' 
			                 and CART_DEU_USR_BAJA is null "; 
                $res_car = mysql_query($con_car)or die('No pudo seleccionarse cart_deudor, cliente_general');
				
				while ($lin_car = mysql_fetch_array($res_car)) { // 5a
				       $nom_cli = $lin_car['CLIENTE_AP_PATERNO']." ".
				                  $lin_car['CLIENTE_AP_MATERNO']." ".
					              $lin_car['CLIENTE_AP_ESPOSO']." ".
					              $lin_car['CLIENTE_NOMBRES'];
				     }// 5c
				 } // 4c	 
		 	}
		  $_SESSION['grupo'] = "";
		  
		   if ($tipo == 2){
		   
		      }
		*/	
		if ($saldo <> 0 ){	
		
	//	echo $saldo, $tot_tde, $tot_tre;		
		 
		 $consulta = "insert into temp_fondo (TEMP_CTA,
	                                          TEMP_CRED, 
                                              TEMP_NOM,
						 	                  TEMP_DEP,
									          TEMP_RET,
										      TEMP_SAL
									          ) values
										      ($cta,
										       '-',
									          '$nom_cli',
										      $tot_tde,
										      0,
										      $saldo)";
										   
         $resultado = mysql_query($consulta);
		
		
		
		 $nro = $nro + 1;  
		  ?> 
	  <tr>
	    <td align="right" ><?php echo number_format($nro, 0, '.',','); ?></td>
		<td align="left" ><?php echo $cta; ?></td>
		<td align="left" style="font-size:10px" ><?php echo " "; ?></td>
		<td align="left" style="font-size:10px" style="text-align:justify" ><?php echo $cod_cre2; ?></td>
		<td align="left" style="font-size:10px"><?php echo $_SESSION['grupo'] ; ?></td>
	 	<td align="left" style="font-size:10px"><?php echo $nom_cli; ?></td>
	    <td align="right" ><?php echo number_format($tot_tde, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($tot_tre, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($saldo, 2, '.',','); ?></td>
	</tr>	
	<?php
  }
  }
  }
	  
	  
    ?>
	<tr>
	    <td align="right" ><?php echo encadenar(2); ?></td>
	 	<td align="left" ><?php echo encadenar(2); ?></td>
	    <td align="left" ><?php echo encadenar(2)."Total"; ?></td>
       	<td align="left" ><?php echo encadenar(2); ?></td>
		<td align="left" ><?php echo encadenar(2); ?></td>
		<td align="left" ><?php echo encadenar(2); ?></td>
		<td align="right" ><?php echo number_format($tot_dep, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($tot_ret, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($tot_sal, 2, '.',','); ?></td>
	</tr>  
</table>
		  
		  
		  
		  
		  
		  <?php
		  
	// echo $cta," ",$tip, $saldo;
/* if ($saldo <> 0) {		 
	if ($tip == 1){	
	    
    //    echo  $tot_sal.encadenar(2).$tot_tde.encadenar(2). $tot_tre.encadenar(2).$cta;
		 $cod_cre2 = "";
		 $cod_est = 0;
		 $nom_cli = "";
         $nom_ases = "";
	     $con_car1  = "Select CART_NRO_CRED,CART_ESTADO,FOND_NRO_CTA,CART_TIPO_CRED,CART_OFIC_RESP 
		              From cart_maestro, fond_maestro 
                      where FOND_NRO_CTA = $cta and  CART_NRO_CRED = FOND_NRO_CRED and CART_MAE_USR_BAJA is null ";
	     $res_car1 = mysql_query($con_car1)or die('No pudo seleccionarse cart_maestro 1');
	     while ($lin_car1 = mysql_fetch_array($res_car1)) {
		  // 4a
		        $nom_ases = "";
	            $cod_cre1 = $lin_car1['CART_NRO_CRED']; 
			    $cod_est = $lin_car1['CART_ESTADO'];
				
			    //$nom_ases = leer_nombre_usr($t_cred,$asesor);
				if ($cod_est < 9){				 
				       $cod_cre2 = $cod_cre2." ".$cod_cre1;
					   
					}
			    $con_car  = "Select CLIENTE_AP_PATERNO,CLIENTE_AP_MATERNO,CLIENTE_AP_ESPOSO,CLIENTE_NOMBRES
					         From cart_deudor, cliente_general where CART_DEU_NCRED = $cod_cre1 
                             and CLIENTE_COD_ID = CART_DEU_ID and CART_DEU_RELACION = 'C' 
			                 and CART_DEU_USR_BAJA is null "; 
                $res_car = mysql_query($con_car)or die('No pudo seleccionarse cart_deudor, cliente_general');
				
				while ($lin_car = mysql_fetch_array($res_car)) { // 5a
				       $nom_cli = $lin_car['CLIENTE_AP_PATERNO']." ".
				                  $lin_car['CLIENTE_AP_MATERNO']." ".
					              $lin_car['CLIENTE_AP_ESPOSO']." ".
					              $lin_car['CLIENTE_NOMBRES'];
				     }// 5c
				 } // 4c	 
			}
	
if ($tip == 2){	
     $cod_cre2 = "";
	 $nom_cli = ""; 
    
	$con_fonc  = "Select CLIENTE_AP_PATERNO,CLIENTE_AP_MATERNO,
	             CLIENTE_AP_ESPOSO,CLIENTE_NOMBRES	
				 From fond_cliente, cliente_general where FOND_CLI_NCTA = $cta 
                  and CLIENTE_COD_ID = FOND_CLI_ID and FOND_CLI_RELACION = 'T' 
			      and FOND_CLI_USR_BAJA is null "; 
                $res_fonc = mysql_query($con_fonc)or die('No pudo seleccionarse fond_cliente, cliente_general');
				
				while ($lin_fonc = mysql_fetch_array($res_fonc)) { // 5a
				       $nom_cli = $lin_fonc['CLIENTE_AP_PATERNO']." ".
				                  $lin_fonc['CLIENTE_AP_MATERNO']." ".
					              $lin_fonc['CLIENTE_AP_ESPOSO']." ".
					              $lin_fonc['CLIENTE_NOMBRES'];
				     }// 5c
				$cod_cre2 = "Particular";	 
}
					if ($cod_cre2 == ""){	
					   $cod_cre2 = "-";
					 } 
					  
					if ($tot_tre == ""){	
					   $tot_tre = 0;
					 } 
					if ($tot_tde == ""){	
					   $tot_tde = 0;
					 }         
					$saldo = ($tot_tde - $tot_tre);
					if ($saldo == ""){	
					   $saldo = 0;
					 }         
					
			 	  
			

$consulta = "insert into temp_fondo(TEMP_CTA,
                                     TEMP_CRED,
                                     TEMP_NOM,
									 TEMP_DEP,
									 TEMP_RET,
									 TEMP_SAL) 
									 values ($cta,
									        '$cod_cre2',
									        '$nom_cli',
											 $tot_tde,
											 $tot_tre,
											 $saldo)";


$resultado = mysql_query($consulta)or die('No pudo insertar : temp_fondo ' . mysql_error());
// $con_sal = "update fond_maestro set FOND_ESTADO = 5 where FOND_NRO_CTA = $cta";
// $res_sal = mysql_query($con_sal)or die('No pudo actualizar : fon_maestro ' . mysql_error());
 
 }// 1c
 }
// echo "A leer el temp_fondo";
	  $nro = 0;
	  $tot_dep = 0;
	  $tot_ret = 0;
	  $tot_sal = 0;
	  $_SESSION['grupo'] = 0;
      $con_tfon  = "Select * From temp_fondo where TEMP_SAL <> 0 order by 3";
      $res_tfon = mysql_query($con_tfon)or die('No pudo leer : tem_fondo ' . mysql_error()) ;
         while ($lin_tfon = mysql_fetch_array($res_tfon)){
		         $_SESSION['grupo'] = " ";
	    	   $nro = $nro + 1;	
		// echo $nro.encadenar(2).$lin_tfon['TEMP_CTA'];
		if (($lin_tfon['TEMP_CRED'] == "-") or ($lin_tfon['TEMP_CRED'] == "Particular")){
		    $lin_tfon['TEMP_CRED'] = encadenar(10);
			$nom_ases = "";
			}else{
			$ncre = $lin_tfon['TEMP_CRED'];
			$ncre = substr($ncre,0,11);
			//echo $ncre;
			
			//if ($tip ==1){	
			$con_ases = "Select CART_TIPO_CRED,CART_OFIC_RESP, CART_COD_GRUPO
		              From cart_maestro
                      where CART_NRO_CRED = $ncre and CART_MAE_USR_BAJA is null ";
	     $res_ases = mysql_query($con_ases)or die('No pudo seleccionarse cart_maestro 2');
	     while ($lin_ases = mysql_fetch_array($res_ases)) {
		  // 4a
		    $t_cred = $lin_ases['CART_TIPO_CRED'];
			$asesor = $lin_ases['CART_OFIC_RESP'];
			$c_grup =  $lin_ases['CART_COD_GRUPO'];
			$nom_ases = leer_nombre_usr($t_cred,$asesor);
			 if ($c_grup > 0){
	$con_grp = "Select * From cred_grupo where CRED_GRP_CODIGO = $c_grup and CRED_GRP_USR_BAJA is null";
        $res_grp = mysql_query($con_grp)or die('No pudo seleccionarse tabla cred_grupo')  ;
	    while ($lin_grp = mysql_fetch_array($res_grp)) {
	        $nom_grp = $lin_grp['CRED_GRP_NOMBRE'];
			$_SESSION['grupo'] = $nom_grp;
			
			}
}
			
			
			
			
			
			
			}
			
			 
			 }
			// }	
		$tot_dep = $tot_dep + $lin_tfon['TEMP_DEP'];
	    $tot_ret = $tot_ret + $lin_tfon['TEMP_RET'] ;
	    $tot_sal = $tot_sal + $lin_tfon['TEMP_SAL'];	 
			?>
	<center>
	<tr>
	    <td align="right" ><?php echo number_format($nro, 0, '.',','); ?></td>
		<td align="left" ><?php echo $lin_tfon['TEMP_CTA']; ?></td>
		<td align="left" style="font-size:10px" ><?php echo $nom_ases; ?></td>
		<td align="left" style="font-size:10px" style="text-align:justify" ><?php echo $lin_tfon['TEMP_CRED']; ?></td>
		<td align="left" style="font-size:10px"><?php echo $_SESSION['grupo'] ; ?></td>
	 	<td align="left" style="font-size:10px"><?php echo $lin_tfon['TEMP_NOM']; ?></td>
	    <td align="right" ><?php echo number_format($lin_tfon['TEMP_DEP'], 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($lin_tfon['TEMP_RET'], 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($lin_tfon['TEMP_SAL'], 2, '.',','); ?></td>
	</tr>	
	<?php
  }
	  
	  
    ?>
	<tr>
	    <td align="right" ><?php echo encadenar(2); ?></td>
	 	<td align="left" ><?php echo encadenar(2); ?></td>
	    <td align="left" ><?php echo encadenar(2)."Total"; ?></td>
       	<td align="left" ><?php echo encadenar(2); ?></td>
		<td align="left" ><?php echo encadenar(2); ?></td>
		<td align="left" ><?php echo encadenar(2); ?></td>
		<td align="right" ><?php echo number_format($tot_dep, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($tot_ret, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($tot_sal, 2, '.',','); ?></td>
	</tr>  
</table>		  
<br>
 
<?php
*/
		 	include("footer_in.php");
		 ?>

</div>
</body>
</html>



<?php
}
ob_end_flush();
 ?>

