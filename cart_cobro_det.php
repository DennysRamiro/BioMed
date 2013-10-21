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
                  Aplicando cobro enviado por Creditos
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
if (isset($_SESSION['f_has'] )) {
    $f_has = $_SESSION['f_has'];
}
$total = 0;
if ( $_SESSION['continuar'] == 2) {
   $quecom = $_POST['cod_cre'];
   for ($i=0; $i < count($quecom); $i = $i + 1 ) {
       if (isset($quecom[$i]) ) {
          $cod_cre = $quecom[$i];
	      $_SESSION['nro_cre'] = $cod_cre;
       }
   } 
   }else{
   $cod_cre = $_SESSION['nro_cre'];
   }
 ?>  
  <form name="form2" method="post" action="cobro_retro_op.php" style="border:groove" onSubmit="return">  
 <?php  
$con_car  = "Select * From cart_maestro where CART_NRO_CRED = $cod_cre and CART_MAE_USR_BAJA is null"; 
$res_car = mysql_query($con_car);
   while ($lin_car = mysql_fetch_array($res_car)) {
         $cod_sol = $lin_car['CART_NRO_SOL']; 
		 $impo = $lin_car['CART_IMPORTE'];
		 $mon = $lin_car['CART_COD_MON'];
		 $tint = $lin_car['CART_TASA'];
		 $plzm = $lin_car['CART_PLZO_M'];
		 $plzd = $lin_car['CART_PLZO_D'];
		 $cuotas = $lin_car['CART_NRO_CTAS'];
		 $c_int = $lin_car['CART_CAL_INT'];
		 $f_pag = $lin_car['CART_FORM_PAG'];
		 $ahod = $lin_car['CART_AHO_DUR'];
		 $f_des = $lin_car['CART_FEC_DES'];
		 $f_uno = $lin_car['CART_FEC_UNO'];
		 $c_agen = $lin_car['CART_COD_AGEN'];
		 $c_grup = $lin_car['CART_COD_GRUPO'];
		 $t_cred = $lin_car['CART_TIPO_CRED'];
		 $f_des2= cambiaf_a_normal($f_des);
		  if ($t_cred == 1) {  
		     $f_uno2= cambiaf_a_normal($f_uno);
		 }
		 
		 
		// echo $cod_sol;
   }
    if ($t_cred == 1) { 
	   $con_cin = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 10 and GRAL_PAR_INT_COD = $c_int";
       $res_cin = mysql_query($con_cin);
	   while ($linea = mysql_fetch_array($res_cin)) {
	        $d_cin = $linea['GRAL_PAR_INT_DESC'];
	   }
	  }
   $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD = $mon";
       $res_mon = mysql_query($con_mon);
	   while ($linea = mysql_fetch_array($res_mon)) {
	        $d_mon = $linea['GRAL_PAR_INT_DESC'];
	   }
   
  $con_fpa = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 13 and GRAL_PAR_INT_COD = $f_pag";
          $res_fpa = mysql_query($con_fpa);
          while ($lin_fpa = mysql_fetch_array($res_fpa)) {
		        $nro_d = $lin_fpa['GRAL_PAR_INT_CTA1'];
				$fpag_d = $lin_fpa['GRAL_PAR_INT_DESC'];
				  }  
	$con_grp = "Select * From cred_grupo where CRED_GRP_CODIGO = $c_grup and CRED_GRP_USR_BAJA is null";
        $res_grp = mysql_query($con_grp);
	    while ($lin_grp = mysql_fetch_array($res_grp)) {
	        $nom_grp = $lin_grp['CRED_GRP_NOMBRE'];
			$_SESSION['grupo'] = $nom_grp;
			}
	$con_fon = "Select * From fond_maestro where FOND_NRO_CRED = $cod_cre and FOND_MAE_USR_BAJA is null";
        $res_fon = mysql_query($con_fon);
	    while ($lin_fon = mysql_fetch_array($res_fon)) {
	        $cod_fon = $lin_fon['FOND_NRO_CTA'];
			$_SESSION['fondo'] = $cod_fon;
			}	
					 
	
			
		  
	$credito = array ( "descrip"  => array ( 1 => "Nro. Credito",
                                             2 => "Grupo ",
                                             3 => "Fondo Garantia",
											 4 => "Importe",
											 5 => "Moneda"
                                            ),
                       "datos" => array ( 1 => $cod_cre,
                                          2 => $nom_grp,
                                          3 => $cod_fon,
                                          4 => number_format($impo, 2, '.',','),
                                          5 => $d_mon 
                                        )
                     );
		?>
	<center>
	<table border="1" width="600">
	
	<tr>
	<?php
       for( $i=1; $i < 6; $i = $i + 1 ) {
     ?>   	
	   	<th align="center"><?php echo $credito["descrip"][$i]; ?></th>            
	<?php
      }	
	?> 
	</tr>	
		
	
					 
	<tr>
	 	<?php
       for( $j=1; $j < 6; $j = $j + 1 ) {
     ?>  
	    <td align="center" ><?php echo $credito["datos"][$j]; ?></td>
	 <?php 
	  }	
    ?>   	
	</tr>	
		  
</table>		  
<br>
 <?php
$consulta  = "Select * from cart_cobro where CART_COB_NCRE = $cod_cre and CART_COB_USR_BAJA is null";
    $resultado = mysql_query($consulta);
	?>
	<table border="1" width="600">
	
	<tr>
	   	<th>Cuota</th>
		<th>Fecha Cuota</th>
		<th>Capital</th>
		<th>Interes</th>
		<th>Fondo Gar. Ciclo</th>
		<th>TOTAL A COBRAR</th>
		
		</tr>
<?php
	while ($linea = mysql_fetch_array($resultado)) {
	      $f_cta =   $linea['CART_COB_FEC_CTA'];    
		  $f_cta1 = cambiaf_a_normal($f_cta);
		  $t_cuota = ($linea['CART_COB_IMPO_C']+
		              $linea['CART_COB_IMPO_I']+
					 $linea['CART_COB_IMPO_F']);
		  $t_cuo = ($linea['CART_COB_IMPO_C']+
		            $linea['CART_COB_IMPO_I']);			 
		  $_SESSION['p_cap'] = $linea['CART_COB_IMPO_C']; 
		  $_SESSION['p_int'] = $linea['CART_COB_IMPO_I'];
		  $_SESSION['p_aho'] = $linea['CART_COB_IMPO_F'];
		  $_SESSION['f_cta'] = $linea['CART_COB_FEC_CTA'];
		  $_SESSION['n_cta'] = $linea['CART_COB_NRO'];
		  
 ?>
	 <tr>
	 	
	    <td align="center" ><?php echo number_format($linea['CART_COB_NRO'], 0, '.',',') ; ?></td>
		<td align="center"><?php echo $f_cta1; ?></td>
		<td align="right"><?php echo number_format($linea['CART_COB_IMPO_C'], 2, '.',','); ?></td>
		<td align="right"><?php echo number_format($linea['CART_COB_IMPO_I'], 2, '.',','); ?></td>
		<td align="right"><?php echo number_format($linea['CART_COB_IMPO_F'], 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format(($linea['CART_COB_IMPO_C']+
		                              $linea['CART_COB_IMPO_I']+
									  $linea['CART_COB_IMPO_F']), 2, '.',','); ?></td>
		
		
 <?php
      
	}	
	
?>   	
	</tr>	
</table>

</FONT> 

<font size="+1">
<br>
<?php

$itf = 0.0015;
 if ($mon == 1){
  $tc_ven = $_SESSION['TC_VENTA'];
  $pago = array ( "descri"  => array ( 1 => "Monto Cobrado",
                                       2 => "T.C. Venta"
									 ),
					  "montos" => array ( 1 => number_format($t_cuota, 2, '.',',') ,
                                          2 => number_format($tc_ven, 2, '.',',')                                        
								      )
						);
	?> 
 <table border="1" width="600">
	
	<tr>
	<?php
       for( $k=1; $k < 3; $k = $k + 1 ) {
     ?>   	
	   	<th align="center"><?php echo $pago["descri"][$k]; ?></th>            
	<?php
      }	
	?> 
	</tr>	
	<tr>
	 	<?php
      for( $l=1; $l < 3; $l = $l + 1 ) {
     ?>  
	    <td align="center" ><?php echo $pago["montos"][$l]; ?></td>
	 <?php 
	  }	
    ?>   	
	</tr>	
</table>		  					
 <?php
       	}
 if ($mon == 2){
  //   $t_cuo = $t_cuota;
	 $t_itf = ($t_cuo * 1.5)/1000;
	 //$t_cuota = $t_cuota + $t_itf;
	 $tc_ven = $_SESSION['TC_VENTA'];
	 $_SESSION['itf'] = $t_itf ;
      $pago = array ( "descri"  => array ( 1 => "Monto Cobrado",
                                             2 => "ITF ",
                                             3 => "Monto Total",
											 4 => "T.C. Venta"
									 ),
					  "montos" => array ( 1 => number_format($t_cuota, 2, '.',',') ,
                                         2 => number_format($t_itf, 2, '.',',') ,
                                         3 => number_format($t_cuota + $t_itf , 2, '.',',') ,
                                         4 => number_format($tc_ven, 2, '.',',')                                        
								      )
										 
           
                     );
	?> 
 <table border="1" width="600">
	
	<tr>
	<?php
       for( $k=1; $k < 5; $k = $k + 1 ) {
     ?>   	
	   	<th align="center"><?php echo $pago["descri"][$k]; ?></th>            
	<?php
      }	
	?> 
	</tr>	
	<tr>
	 	<?php
      for( $l=1; $l < 5; $l = $l + 1 ) {
     ?>  
	    <td align="center" ><?php echo $pago["montos"][$l]; ?></td>
	 <?php 
	  }	
    ?>   	
	</tr>	
</table>		  

	 <?php 
	  }	
     
$_SESSION['moneda']=$mon;
$_SESSION['total']=$t_cuota;	
	
 ?>
 <br>
  <?php 
 if ( $_SESSION["recal"] == 1) {
?> 
 
  <?php 
 if ($mon == 1){ 	
?> 
 
<strong> Importe Bolivianos </strong>
  <input type="text" name="tot_bol" maxlength="8" size="12" value=0 >  
  <BR><br> 
<strong> Importe en Dolares </strong>
  <input type="text" name="tot_sus" maxlength="8" size="12" value=0 > 
 <?php
   }	
  ?>  
 <?php
 if ($mon == 2){ 	
?>
<strong> Importe en Dolares </strong>
  <input type="text" name="tot_sus" maxlength="8" size="12" value=0 > 
<BR><br>    
<strong> Importe Bolivianos </strong>
  <input type="text" name="tot_bol" maxlength="8" size="12" value=0 > 
 <?php
   }	
  ?> 	
<BR><br>		
<center>
<input type="submit" name="accion" value="Recalcular" >

<input type="submit" name="accion" value="Salir">

</form>
<?php
   }	
  ?> 
	

<?php
if ( $_SESSION["recal"] == 2) {

echo "Detalle contable del Cobro";
	
$consulta  = "Select * From temp_ctable where (temp_debe_1+temp_haber_1+temp_debe_2+temp_haber_2) > 0";
    $resultado = mysql_query($consulta);
 ?>		
		<table border="1">
	<tr>
	   	<th>Cuenta</th>
		<th>Descripcion</th>
		<th>Importe Debe Bs</th>
		<th>Importe Haber Bs</th>
		<th>Importe Debe $us</th>
		<th>Importe Haber $us</th>
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
	  $tot_haber_2 = $tot_haber_2 +$linea['temp_haber_2'];
	 ?>
	 <tr>
	 	<td><?php echo $linea['temp_nro_cta']; ?></td>
		<td><?php echo $linea['temp_des_cta']; ?></td>
		<td align="right"><?php echo number_format($linea['temp_debe_1'], 2, '.',',') ; ?></td>
		<td align="right"><?php echo number_format($linea['temp_haber_1'], 2, '.',','); ?></td>
		<td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		<td align="right"><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
 <?php
}
?>
</table>
<?php
	//}
 echo encadenar(35),"Totales",encadenar(30) ;
 echo number_format($tot_debe_1, 2, '.',',');
 echo encadenar(9);
 echo number_format($tot_haber_1, 2, '.',',');
 echo encadenar(11);
 echo number_format($tot_debe_2, 2, '.',',');
 echo encadenar(11);
 echo number_format($tot_haber_2, 2, '.',',');
 echo encadenar(5);
?>
<center>
<input type="submit" name="accion" value="Aplicar" >

<input type="submit" name="accion" value="Salir">

</form>


 <?php

}

?>
<div id="FooterTable">
<BR><B><FONT SIZE=+2><MARQUEE>Aplicando Cobro</MARQUEE></FONT></B>
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

