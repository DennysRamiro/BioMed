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
<title>Tipo Reporte</title>
<meta charset="UTF-8">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script>
<script type="text/javascript" src="js/mant_cuenta_sal_min_cerrar.js"></script>  
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
   				 <li id="menu_modulo_mant_cuenta">
                    
                     <img src="img/app folder_32x32.png" border="0" alt="Modulo" align="absmiddle"> MANT. CUENTA
                    
                 </li>
                  <li id="menu_modulo_mant_cuenta_cerrar">
                    
                     <img src="img/padlock closed_32x32.png" border="0" alt="Modulo" align="absmiddle"> CIERRE CTAS SAL. MIN.
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/padlock closed_32x32.png" border="0" alt="Modulo" align="absmiddle"> CERRAR CUENTA.
                    
                 </li>
              </ul> 
             
     <div id="contenido_modulo">
                      <h2> <img src="img/padlock closed_64x64.png" border="0" alt="Modulo" align="absmiddle">CERRAR CUENTA</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/alert_32x32.png" align="absmiddle">
                     
                     </div> 

	<!--div id="cuerpoModulo"-->
	
            <div id="UserData">
                 <!-- src="images/24x24/001_20.png" border="0" align="absmiddle" alt="Home" /-->
				<?php
                // $fec = leer_param_gral();
                 $logi = $_SESSION['login']; 
				 $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD <> 0 ";
                 $res_mon = mysql_query($con_mon)or die('No pudo seleccionarse tabla')  ;
                ?> 
			</div>
 <!--div id="GeneralManCliente"-->
	<!--<form name="form2" method="post" action="grab_retro_cli.php" onSubmit="return ValidaCampos(this)">-->

    <form name="form2" method="post" action="fgar_retro_op.php" onSubmit="return">

<?php
$borr_tfon  = "delete from temp_fondo "; 
$borr_tfon = mysql_query($borr_tfon)or die('No pudo borrarse temp_fondo');
$f_has ="";
$f_cal ="";
$t_cuo = 0;
$saldo = 0;
$tot_des = 0;
$impo = 0; 
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
$impo = $_POST['imp_sol']; 	  
$cod_mon = 	$_POST['cod_mon'] ;
$fec_pro = $_POST['fec_nac'] ; 
$f_pro = cambiaf_a_mysql($fec_pro); 
?> 
 <font size="+2"  style="" >

<?php
echo encadenar(40)."Cierre de Cuentas Saldos Menores ".encadenar(3).$fec_pro;
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
 
  
     
 <?php
    $con_fon  = "Select DISTINCT FOND_NRO_CTA,FOND_TIPO_OPER From fond_maestro where FOND_COD_MON = $cod_mon 
	             and FOND_ESTADO = 3 and FOND_NRO_CTA > 1 and 
				  FOND_MAE_USR_BAJA is null order by FOND_NRO_CTA"; 
    $res_fon = mysql_query($con_fon)or die('No pudo seleccionarse fond_maestro');
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
                $res_fonc = mysql_query($con_fonc)or die('No pudo seleccionarse fond_cliente, cliente_general');
				
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
	     $res_car1 = mysql_query($con_car1)or die('No pudo seleccionarse cart_maestro 1');
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
                $res_car = mysql_query($con_car)or die('No pudo seleccionarse cart_deudor, cliente_general');
				
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


$resultado = mysql_query($consulta)or die('No pudo insertar : temp_fondo ' . mysql_error());
}
// echo "A leer el temp_fondo";
}
echo encadenar(3). "Detalle Contable";

?>
 
 <table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center">
    <tr>
      <th scope="col"><border="0" alt="" align="absmiddle" />CUENTA</th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER $us.</th>
	  
	</tr>
	
	
	
	
		           

<?php	
      $_SESSION['cod_cta1'] = "-";
	  $_SESSION['cod_cta2'] = "-";	
	  $_SESSION['impo1'] = 0;
      $_SESSION['impo2'] = 0;
	  $_SESSION['impo'] = $impo;
	  $nro = 0;
	  $tot_dep = 0;
	  $tot_ret = 0;
	  $tot_sal = 0;
	  $_SESSION['grupo'] = 0;
      $con_tfon  = "Select sum(TEMP_SAL) From temp_fondo where TEMP_SAL <= '$impo' and  TEMP_CRED = ' '";
      $res_tfon = mysql_query($con_tfon)or die('No pudo leer : tem_fondo ' . mysql_error()) ;
	  
         while ($lin_tfon = mysql_fetch_array($res_tfon)){
		       $tot_dep = 0;
	           $tot_ret = 0; 
		         $_SESSION['grupo'] = " ";
				$sal_fon  = $lin_tfon['sum(TEMP_SAL)'];;
	    	   $nro = $nro + 1;	
		 if ($cod_mon == 2){ 
		     $cod_cta1 = 21201201; 
			 $cod_cta2 = 57101201;
			 $hab1 = $sal_fon * $_SESSION['TC_CONTAB']; 
			 $hab2 = $sal_fon; 
			 $deb1 = $sal_fon * $_SESSION['TC_CONTAB']; 
			 $deb2 = $sal_fon; 
			 }else{  
			 $cod_cta1 = 21201101;
			 $cod_cta2 = 57101101;  
			 $hab1 = $sal_fon; 
			 $hab2 = 0; 
			 $deb1 = $sal_fon; 
			 $deb2 = 0;   
			} 
			$des_cta1 = leer_cta_des($cod_cta1);
			$des_cta2 = leer_cta_des($cod_cta2); 
			$_SESSION['cod_cta1'] = $cod_cta1;
			$_SESSION['cod_cta2'] = $cod_cta2;	
		    $_SESSION['impo1'] = $hab1;
			$_SESSION['impo2'] = $hab2;
			$_SESSION['cod_mon'] = $cod_mon;
			?>
	<center>
	<tr>
	    <td align="right" ><?php echo  $cod_cta2; ?></td>
		<td align="left" ><?php echo $des_cta2; ?></td>
		<td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($hab1, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($hab2, 2, '.',','); ?></td>
	</tr>
	<tr>
	    <td align="right" ><?php echo  $cod_cta1; ?></td>
		<td align="left" ><?php echo $des_cta1; ?></td>
		<td align="right" ><?php echo number_format($deb1, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($deb2, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
	</tr>		
	<?php
  }
//}	  
	  
    ?>
	<tr>
	    <td align="right" ><?php echo encadenar(2); ?></td>
	 	<td align="left" ><?php echo encadenar(2); ?></td>
	   <td align="right" ><?php echo number_format($deb1, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($hab1, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($deb2, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($hab2, 2, '.',','); ?></td>
	</tr>  
</table>
<center>		  
<br>
 <input type="submit" name="accion" value="Contab_cierre">
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

