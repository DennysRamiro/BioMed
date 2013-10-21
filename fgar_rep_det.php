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
<!--Titulo de la pesta�a de la pagina-->
<title>Reporte Detalle Fondo Garantia</title>
<meta charset="UTF-8">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="js/reportes_fondo_det_fon_impr.js"></script>
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
                 <li id="menu_modulo_general_fondo">
                    
                     <img src="img/open document_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. FONDO GARANTIA 
                    
                 </li>
                 <li id="menu_modulo_reportes_fondo">
                    
                     <img src="img/documents_32x32.png" border="0" alt="Modulo" align="absmiddle"> REP. FONDO GARANTIA
                    
                 </li>
                  <li id="menu_modulo_reportes_fondo_det">
                    
                     <img src="img/copy_32x32.png" border="0" alt="Modulo" align="absmiddle"> DET. FONDO GARANTIA
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/print_32x32.png" border="0" alt="Modulo" align="absmiddle"> IMPR. DET. FON. GAR.
                    
                 </li>
              </ul> 
             
     <div id="contenido_modulo">
                      <h2> <img src="img/print_64x64.png" border="0" alt="Modulo" align="absmiddle">IMPRIMIR DETALLE FONDO DE GARANTIA</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/alert_32x32.png" align="absmiddle">
                     Ingrese la fecha de vencimiento
                     </div> 



<?php
 //$fec = leer_param_gral();
 $logi = $_SESSION['login']; 
?>
  <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	   <!--a href='fgar_reportes.php'>Salir</a-->
  </div>

<br><br>
<?php
$borr_tfon  = "delete from temp_fondo "; 
$borr_tfon = mysql_query($borr_tfon) ;
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
echo encadenar(40)."Detalle de Fondos de Garantia  al ".encadenar(3).$fec_pro;
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
		<th width="8%" align="center">Nro. Cr�dito(s)</th> 
		<th align="center">Cliente</th>           
	   	<th align="center">Monto Depositado</th>
		<th align="center">Monto Retirado</th>
		<th align="center">Saldo </th>
  </tr>	
     
 <?php
    $con_fon  = "Select DISTINCT FOND_NRO_CTA,FOND_TIPO_OPER From fond_maestro where FOND_COD_MON = $cod_mon 
	             and FOND_ESTADO = 3 and FOND_NRO_CTA > 1 and 
				  FOND_MAE_USR_BAJA is null order by FOND_NRO_CTA"; 
    $res_fon = mysql_query($con_fon);
    while ($lin_fon = mysql_fetch_array($res_fon)) {  
	      $tot_tre = 0;
		 $tot_tde = 0;
		 $cuantos = 0;
		 $saldo = 0;
		 $nom_cli = "";
		 $cod_cre2 = "";
	     $nom_cli = "";  
	 // 1a 
      //echo "entra";
		 $cta = $lin_fon['FOND_NRO_CTA'];
		 $tip = $lin_fon['FOND_TIPO_OPER'];
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
				if ( $tot_tre > 0){
				     }else{
					 $tot_tre = 0;
				}	  
	        } // 3c
		 $saldo = $tot_tde - $tot_tre;		
		 $tot_sal = $tot_sal + ($tot_tde - $tot_tre);
				
		if ($saldo <> 0) {
		if ($tip == 2){	
     $cod_cre2 = "";
	 $nom_cli = ""; 
    
	$con_fonc  = "Select CLIENTE_AP_PATERNO,CLIENTE_AP_MATERNO,
	             CLIENTE_AP_ESPOSO,CLIENTE_NOMBRES	
				 From fond_cliente, cliente_general where FOND_CLI_NCTA = $cta 
                  and CLIENTE_COD_ID = FOND_CLI_ID and FOND_CLI_RELACION = 'T' 
			      and FOND_CLI_USR_BAJA is null "; 
                $res_fonc = mysql_query($con_fonc);
				
				while ($lin_fonc = mysql_fetch_array($res_fonc)) { // 5a
				       $nom_cli = $lin_fonc['CLIENTE_AP_PATERNO']." ".
				                  $lin_fonc['CLIENTE_AP_MATERNO']." ".
					              $lin_fonc['CLIENTE_AP_ESPOSO']." ".
					              $lin_fonc['CLIENTE_NOMBRES'];
				     }// 5c
				$cod_cre2 = "Particular";	 
} 	
	 					
		$cuantos = 0;	 
		$con_car1  = "Select CART_NRO_CRED,CART_ESTADO,FOND_NRO_CTA,CART_TIPO_CRED,CART_OFIC_RESP 
		              From cart_maestro, fond_maestro 
                      where FOND_NRO_CTA = $cta and  CART_NRO_CRED = FOND_NRO_CRED and CART_MAE_USR_BAJA is null ";
	     $res_car1 = mysql_query($con_car1);
	     while ($lin_car1 = mysql_fetch_array($res_car1)) {
		  // 4a
		        
	            $cod_cre1 = $lin_car1['CART_NRO_CRED']; 
			    $cod_est = $lin_car1['CART_ESTADO'];
									
						
			    //$nom_ases = leer_nombre_usr($t_cred,$asesor);
				if ($cod_est < 9){				 
				    $cod_cre2 = $cod_cre2." ".$cod_cre1;
					}
					
	
					
					
	if ($cuantos == 0){				
		if ($tip == 1){	
	    
    //    echo  $tot_sal.encadenar(2).$tot_tde.encadenar(2). $tot_tre.encadenar(2).$cta;
		    $con_car  = "Select CLIENTE_AP_PATERNO,CLIENTE_AP_MATERNO,CLIENTE_AP_ESPOSO,CLIENTE_NOMBRES
					         From cart_deudor, cliente_general where CART_DEU_NCRED = $cod_cre1 
                             and CLIENTE_COD_ID = CART_DEU_ID and CART_DEU_RELACION = 'C' 
			                 and CART_DEU_USR_BAJA is null "; 
                $res_car = mysql_query($con_car);
				
				while ($lin_car = mysql_fetch_array($res_car)) { // 5a
				       $nom_cli = $lin_car['CLIENTE_AP_PATERNO']." ".
				                  $lin_car['CLIENTE_AP_MATERNO']." ".
					              $lin_car['CLIENTE_AP_ESPOSO']." ".
					              $lin_car['CLIENTE_NOMBRES'];
				     }// 5c
				 }

				 
				 
				 
				  
				 $cuantos = 1; 
		}	
				
					
					
					
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


$resultado = mysql_query($consulta);
}
		
		 	 
	/*	 $con_dtra  = "Select sum(FOND_DTRA_IMPO) From fond_det_tran where FOND_DTRA_NCTA = $cta 
		               and FOND_DTRA_FECHA <= '$f_pro' and 
                       FOND_DTRA_TIP_TRAN = 1 and FOND_DTRA_CCON = 212 and FOND_DTRA_USR_BAJA is null ";
         $res_dtra = mysql_query($con_dtra)or die('No pudo leer : fond_det_tran ' . mysql_error()) ;
         while ($lin_dtra = mysql_fetch_array($res_dtra)) { // 2a
                $tot_tde = $lin_dtra['sum(FOND_DTRA_IMPO)'];
	   	        } // 2c
				
	     $con_dtra  = "Select sum(FOND_DTRA_IMPO) From fond_det_tran where FOND_DTRA_NCTA = $cta 
		               and FOND_DTRA_FECHA <= '$f_pro' and FOND_DTRA_CCON = 212 and 
                       FOND_DTRA_TIP_TRAN = 2 and FOND_DTRA_USR_BAJA is null ";
         $res_dtra = mysql_query($con_dtra)or die('No pudo leer : fond_det_tran ' . mysql_error()) ;
   	     while ($lin_dtra = mysql_fetch_array($res_dtra)) {   // 3a
	            $tot_tre = $lin_dtra['sum(FOND_DTRA_IMPO)'];
	        } // 3c
		 $saldo = $tot_tde - $tot_tre;		
		 $tot_sal = $tot_sal + ($tot_tde - $tot_tre);
		 */
	// echo $cta," ",$tip, $saldo;
//if ($saldo <> 0) {	


	 
/*	if ($tip == 1){	
	    
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
					
			 	  
			


// $con_sal = "update fond_maestro set FOND_ESTADO = 5 where FOND_NRO_CTA = $cta";
// $res_sal = mysql_query($con_sal)or die('No pudo actualizar : fon_maestro ' . mysql_error());
 
 }// 1c
  */
// echo "A leer el temp_fondo";
}
	  $nro = 0;
	  $tot_dep = 0;
	  $tot_ret = 0;
	  $tot_sal = 0;
	  $_SESSION['grupo'] = 0;
      $con_tfon  = "Select * From temp_fondo order by 3";
      $res_tfon = mysql_query($con_tfon);
	  
         while ($lin_tfon = mysql_fetch_array($res_tfon)){
		       $tot_dep = 0;
	           $tot_ret = 0; 
		         $_SESSION['grupo'] = " ";
				$cta = $lin_tfon['TEMP_CTA'];
	    	   $nro = $nro + 1;	
			  
			   
			   
			   
		// echo $nro.encadenar(2).$lin_tfon['TEMP_CTA'];
	/*	if (($lin_tfon['TEMP_CRED'] == "-") or ($lin_tfon['TEMP_CRED'] == "Particular")){
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
			*/	
		$tot_dep = $tot_dep + $lin_tfon['TEMP_DEP'];
	    $tot_ret = $tot_ret + $lin_tfon['TEMP_RET'] ;
	    $tot_sal = $tot_sal + $lin_tfon['TEMP_SAL'];
		
		
		
			?>
	<center>
	<tr>
	    <td align="right" ><?php echo number_format($nro, 0, '.',','); ?></td>
		<td align="left" ><?php echo $lin_tfon['TEMP_CTA']; ?></td>
		<td align="left" style="text-align:justify" ><?php echo $lin_tfon['TEMP_CRED']; ?></td>
		<td align="left" style="font-size:10px"><?php echo $lin_tfon['TEMP_NOM']; ?></td>
	    <td align="right" ><?php echo number_format( $lin_tfon['TEMP_DEP'], 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($lin_tfon['TEMP_RET'], 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($lin_tfon['TEMP_SAL'], 2, '.',','); ?></td>
	</tr>	
	<?php
  }
//}	  
	  
    ?>
	<tr>
	    <td align="right" ><?php echo encadenar(2); ?></td>
	 	<td align="left" ><?php echo encadenar(2); ?></td>
	    <td align="left" ><?php echo encadenar(2)."Total"; ?></td>
       	<td align="left" ><?php echo encadenar(2); ?></td>
		<td align="right" ><?php echo number_format($tot_dep, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($tot_ret, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($tot_sal, 2, '.',','); ?></td>
	</tr>  
</table>		  
<br>
 


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

