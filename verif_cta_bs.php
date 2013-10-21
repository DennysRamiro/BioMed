<?php
	  ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
}
	require('configuracion.php');
    require('funciones.php');
?>
<html>
<head>
<title>Cobro enviado por Creditos</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script>  
</head>
<body>	
	<div id="cuerpoModulo">
<?php
				include("header.php");
			?>
            
            <div id="UserData">
                 <img src="images/24x24/001_20.png" border="0" align="absmiddle" alt="Home" />
<?php
 $fec = leer_param_gral();
 $logi = $_SESSION['login']; 
?> 
</div>
            <div id="Salir">
            <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
            </div>
            <div id="TitleModulo">
            	 <img src="images/24x24/001_36.png" border="0" alt="Modulo">
                  Verificacion de Consistencia
            </div>
<div id="AtrasBoton">
 	<a href="modulo.php?modulo=<?php echo $_SESSION['modulo'];?>"><img src="images/24x24/001_23.png" border="0" alt= "Regresar" align="absmiddle">Atras</a>
</div>
<?php
//$_SESSION['form_buffer'] = $_POST;
$f_has ="";
$f_cal ="";
$t_cuo = 0;
$log_usr = $_SESSION['login']; 
$total = 0;
$nro = 0;
$nro_doc = 0;
$tot_deb = 0;
		 $tot_hab = 0; 
 ?>  
  
  <table border="1" width="300">
	
	<tr>
	    <th align="center">Nro</th>  
		 <th align="center">Nro. Doc.</th>  
		<th align="center">Fecha</th> 
		 <th align="center">Nro. Operacion</th>  
		  <th align="center">Cliente</th>  
		   <th align="center">Moneda Ope.</th>
		   <th align="center">Cuenta</th> 
	   	<th align="center">Importe</th>
		
  </tr>	
     
 <?php  
$con_car1 ="Select * From cart_det_tran where
	            (CART_DTRA_FECHA between '2011-04-01' and '2011-04-30') and 
	             (CART_DTRA_CTA_CBT = '51305202' or CART_DTRA_CTA_CBT = '51305203') and 
                 CART_DTRA_IMPO = CART_DTRA_IMPO_BS and
				 CART_DTRA_USR_BAJA is null order by CART_DTRA_CTA_CBT";
$res_car1 = mysql_query($con_car1);

   while ($lin_car1 = mysql_fetch_array($res_car1)) {
         $nro_doc = $lin_car1['CART_DTRA_NRO_TRAN']; 
		 $f_des = $lin_car1['CART_DTRA_FECHA'];
		 $cta = $lin_car1['CART_DTRA_CTA_CBT'];
         $ncre = $lin_car1['CART_DTRA_NCRE'];
		 $impo = $lin_car1['CART_DTRA_IMPO'];
		 		 $f_des2= cambiaf_a_normal($f_des); 
		 
	     $total = $total + $impo;	
	$con_car  = "Select * From cart_maestro, cart_deudor, cliente_general
             where CART_NRO_CRED = $ncre and CART_DEU_NCRED = CART_NRO_CRED
             and CLIENTE_COD_ID = CART_DEU_ID and CART_DEU_RELACION = 'C' 
			 and CART_DEU_USR_BAJA is null and  CART_MAE_USR_BAJA is null
			  and CLIENTE_USR_BAJA is null"; 
$res_car = mysql_query($con_car);
$nro = 0;
   while ($lin_car = mysql_fetch_array($res_car)) {
         $cod_cre = $lin_car['CART_NRO_CRED']; 
		 //$impo = $lin_car['CART_IMPORTE'];
		 $imp_c = $lin_car['CART_IMP_COM'];
		 $mon = $lin_car['CART_COD_MON'];
		 $t_oper = $lin_car['CART_TIPO_OPER'];
		 $tcred = $lin_car['CART_TIPO_CRED'];
		 $t_prod = $lin_car['CART_PRODUCTO'];
		 $cuotas = $lin_car['CART_NRO_CTAS'];
		 $f_pag = $lin_car['CART_FORM_PAG'];
		 $ahod = $lin_car['CART_AHO_DUR'];
		// $f_des = $lin_car['CART_FEC_DES'];
		 $f_uno = $lin_car['CART_FEC_UNO'];
		 $c_agen = $lin_car['CART_COD_AGEN'];
		 $c_grup = $lin_car['CART_COD_GRUPO'];
		 $estado = $lin_car['CART_ESTADO'];
		 $tasa = $lin_car['CART_TASA'];
		 $of_resp = $lin_car['CART_OFIC_RESP'];
		 $nom_grp = "";
		 $nom_ases = "";
		// $nom_ases = leer_nombre_usr($tcred,$of_resp);
		 //$f_des2= cambiaf_a_normal($f_des); 
		 $nom_cli = $lin_car['CLIENTE_AP_PATERNO'].encadenar(1).
					$lin_car['CLIENTE_AP_MATERNO'].encadenar(1).
					$lin_car['CLIENTE_AP_ESPOSO'].encadenar(1).
					$lin_car['CLIENTE_NOMBRES'].encadenar(1);
		 $ci = $lin_car['CLIENTE_COD_ID'];
				 $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD = $mon";
         $res_mon = mysql_query($con_mon);
	      while ($linea = mysql_fetch_array($res_mon)) {
	            $d_mon = $linea['GRAL_PAR_INT_DESC'];
			   } 
			}
		
//if ($tot_deb <> $tot_hab){		
	$nro = $nro + 1;
	if ($impo > 0){			
			?>
	<center>
	<tr>
	    <td align="right" ><?php echo number_format($nro, 0, '.',','); ?></td>
	 	<td align="left" ><?php echo $nro_doc; ?></td>
		<td align="left" ><?php echo $f_des2; ?></td>
		<td align="left" ><?php echo $ncre; ?></td>
		<td align="left" ><?php echo $nom_cli; ?></td>
		<td align="right" ><?php echo $d_mon; ?></td>
	   	<td align="right" ><?php echo $cta; ?></td>
		<td align="right" ><?php echo number_format($impo, 2, '.',','); ?></td>
	</tr>	
	<?php
      }
	  }
	  ?>
	  <tr>
	    <td align="right" ><?php echo encadenar(2); ?></td>
	 	<td align="left" ><?php echo encadenar(2); ?></td>
		<td align="left" ><?php echo encadenar(2); ?></td>
		<td align="left" ><?php echo encadenar(2); ?></td>
		<td align="left" ><?php echo "Total"; ?></td>
		<td align="right" ><?php echo encadenar(2); ?></td>
	   	<td align="right" ><?php echo encadenar(2); ?></td>
		<td align="right" ><?php echo number_format($total, 2, '.',','); ?></td>
	</tr>	
	<?php
	 // } 
    ?>	  
</table>		  
<br>
 

<div id="FooterTable">
<BR><B><FONT SIZE=+2><MARQUEE>Verificando Consistencia</MARQUEE></FONT></B>
</div>


<?php
		 	include("footer_in.php");
		 ?>

</div>
</body>
</html>



<?php
}
ob_end_flush();
 ?>

