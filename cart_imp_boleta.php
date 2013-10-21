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
	 $con_emp = "Select *  From gral_empresa ";
         $res_emp = mysql_query($con_emp);
 	     while ($lin_emp = mysql_fetch_array($res_emp)) {
		        $emp_nom = $lin_emp['GRAL_EMP_NOMBRE'];
				$emp_ger = $lin_emp['GRAL_EMP_GERENTE'];
				$emp_cig = $lin_emp['GRAL_EMP_GER_CI'];
				$emp_dir = $lin_emp['GRAL_EMP_DIREC'];
		  }
?>
<html>
<head>
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<?php
 //$fec = leer_param_gral();
 $logi = $_SESSION['login']; 
 $_SESSION['cont_imp'] = 1; 
?>
  <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	   <a href='solic_mante.php'>Salir</a>
  </div>


<?php
$ncre = " ";
if(isset($_POST['cod_sol'])){
   
     $quecom = $_POST['cod_sol'];
	//  $ncre1 = $ncre;
     // $_SESSION['cod_sol'] = $cod_sol;
      
   }
 if (isset($quecom)){  	
   for( $i=0; $i < count($quecom); $i = $i + 1 ) {
      if( isset($quecom[$i]) ) {
         $cod_s = $quecom[$i];
		 $_SESSION[" $cod_s"] = $cod_s;
		 $_SESSION["cod_sol"] = $cod_s;
        }
      }
    }  
   echo $ncre;
 if ($ncre  == 'GLOBAL'){   
  echo "Va a otro programa"; 
   header('Location:solic_impr_2.php');  
  } 
   
?> 
<font size="+1"  style="" >
<?php
   $con_plan = "Select DISTINCT CRED_PLD_NRO_CTA,CRED_PLD_FECHA From cred_plandp where CRED_PLD_COD_SOL = $cod_s and CRED_PLD_NRO_CTA = 1
		        and CRED_PLD_USR_BAJA is null order by CRED_PLD_FECHA";
     $res_plan = mysql_query($con_plan);
	 while ($lin_plan = mysql_fetch_array($res_plan)) {
	        $f_cta = $lin_plan['CRED_PLD_FECHA'];
			$fec_cta = cambiaf_a_normal($f_cta);
			$nro_cta =$lin_plan['CRED_PLD_NRO_CTA'];  
?>
<?php
echo encadenar(1).$emp_nom.encadenar(70).$emp_nom.encadenar(20);
?>

<br>
<font size="+2"  style="" >
<?php
echo encadenar(15)."BOLETA DE COBRO".encadenar(45)."BOLETA DE COBRO".encadenar(20);
?>
</font>
<br>
<font size="+1"  style="" >
<?php
//echo encadenar(100)."SOLICITUD  Nro. ".encadenar(3).$_SESSION["cod_sol"];
$cod_sol = $_SESSION["cod_sol"];
?>
</font>
<br>
<?php  
//if ($ncre  == 'TODO'){ 
     $con_deu = "Select * From cred_deudor where CRED_SOL_CODIGO = $cod_sol
		         and  CRED_DEU_RELACION = 'C' and CRED_DEU_USR_BAJA is null";
     $res_deu = mysql_query($con_deu);
	 while ($lin_deu = mysql_fetch_array($res_deu)) {
	        $ncre = $lin_deu['CRED_DEU_ID'];
    	  }
 //}
$con_sol  = "Select * From cred_solicitud,cred_deudor where cred_solicitud.CRED_SOL_CODIGO = $cod_sol
                 and  cred_deudor.CRED_SOL_CODIGO = cred_solicitud.CRED_SOL_CODIGO
				
			     and  CRED_SOL_USR_BAJA is null"; 
$res_sol = mysql_query($con_sol);

$nro = 0;
$t_des = 0;
   while ($lin_sol = mysql_fetch_array($res_sol)) {
         $cod_sol = $lin_sol['CRED_SOL_CODIGO']; 
		 $asesor = $lin_sol['CRED_SOL_OF_RESP']; 
		 $mon = $lin_sol['CRED_SOL_COD_MON']; 
		 $t_oper = $lin_sol['CRED_SOL_TIPO_OPER'];
		 $cuotas = $lin_sol['CRED_SOL_NRO_CTA'];
		 $f_pag = $lin_sol['CRED_SOL_FORM_PAG'];
		 $f_des = $lin_sol['CRED_SOL_FEC_DES'];
		 $c_grup = $lin_sol['CRED_SOL_COD_GRUPO'];
		 $pag_int = $lin_sol['CRED_SOL_AHO_F'];
	/*if ($ncre1  == 'TODO'){ 	
	      $impo = $lin_sol['CRED_SOL_IMPORTE']; 
		 $impo_c = $lin_sol['CRED_SOL_IMP_COM']; 
		 }else{ */
		 $impo = $lin_sol['CRED_SOL_IMPORTE']; 
		 $impo_c = $lin_sol['CRED_SOL_IMP_COM']; 
		 
//	}	 
		 
		 
		 
		 $nom_grp = "";
		 $nom_ases = "";
		 $nom_ases = leer_nombre_usr(1,$asesor);
		 $f_des2= cambiaf_a_normal($f_des); 
	
		  $con_cli = "Select * From cliente_general where CLIENTE_COD_ID = '$ncre' and CLIENTE_USR_BAJA is null";
         $res_cli = mysql_query($con_cli);
	      while ($lin_cli = mysql_fetch_array($res_cli)) {
	            $nom_cli = $lin_cli['CLIENTE_AP_PATERNO'].encadenar(1).
				$lin_cli['CLIENTE_AP_MATERNO'].encadenar(1).
				$lin_cli['CLIENTE_AP_ESPOSO'].encadenar(1).
				$lin_cli['CLIENTE_NOMBRES'].encadenar(1);
		        $ci = $lin_cli['CLIENTE_COD_ID'];
				$cod_cli =$lin_cli['CLIENTE_COD']; 
			}
	}	 
		 
		 $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD = $mon";
         $res_mon = mysql_query($con_mon);
	      while ($linea = mysql_fetch_array($res_mon)) {
	            $d_mon = $linea['GRAL_PAR_INT_DESC'];
			   }
		 $con_fpa = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 13 and GRAL_PAR_INT_COD = $f_pag";
       $res_fpa = mysql_query($con_fpa);
	   while ($linea = mysql_fetch_array($res_fpa)) {
	        $d_fpa = $linea['GRAL_PAR_INT_DESC'];
	   }	   
 				
		$con_dope  = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 21 and GRAL_PAR_INT_COD = $t_oper";
        $res_dope = mysql_query($con_dope);
        while ($lin_dope = mysql_fetch_array($res_dope)) {
               $d_ope = $lin_dope['GRAL_PAR_INT_DESC']; 
	     }
 if ($c_grup > 0){
	 	$con_grp = "Select * From cred_grupo where CRED_GRP_CODIGO = $c_grup and CRED_GRP_USR_BAJA is null";
        $res_grp = mysql_query($con_grp);
	    while ($lin_grp = mysql_fetch_array($res_grp)) {
	        $nom_grp = $lin_grp['CRED_GRP_NOMBRE'];
			$_SESSION['grupo'] = $nom_grp;
       }
	  }  
			
		//  $nom_cli = $lin_car['CLIENTE_AP_PATERNO'].encadenar(1).
		//			$lin_car['CLIENTE_AP_MATERNO'].encadenar(1).
		//			$lin_car['CLIENTE_AP_ESPOSO'].encadenar(1).
		//			$lin_car['CLIENTE_NOMBRES'].encadenar(1);
		// $ci = $lin_car['CLIENTE_COD_ID'];		
			
?>
<table border="0" width="900">
   <tr>
	    <th align="center"><?php echo encadenar(10); ?></th>  
	   	<th align="center"><?php echo encadenar(20); ?></th> 
		<th align="center"><?php  echo encadenar(30); ?></th>           
	    <th align="center"><?php echo encadenar(10); ?></th>
		<th align="center"><?php echo encadenar(20); ?></th>
		
   </tr>	
   <tr>
   	  <?php if($nom_grp <> ""){ ?>

	   <td align="left" <b><?php echo "Grupo:"; ?></b></td>
	    <td align="left" ><?php echo $nom_grp.encadenar(5); ?></td>
		<td align="left" <b><?php echo "Moneda:".encadenar(2); ?></td>
		<td align="left" ><?php echo $d_mon; ?></td>
		<td align="right" <b><?php echo encadenar(20); ?></td>
		 <td align="left" <b><?php echo "Grupo:"; ?></b></td>
	    <td align="left" ><?php echo $nom_grp.encadenar(5); ?></td>
		<td align="left" <b><?php echo "Moneda:".encadenar(2); ?></td>
		<td align="left" ><?php echo $d_mon; ?></td>
	</tr>
	<?php } ?>  
	
	
	
	  <tr>
	 <?php if($pag_int == 1){ ?>
	    <td align="left" <b><?php echo "I - V" ; ?></td>
	 <?php } ?> 
	  <?php if($pag_int == 4){ ?>
	    <td align="left" <b><?php echo "I - A" ; ?></td>
	 <?php } ?> 
	 	<td align="left" ><?php echo encadenar(15); ?></td>
		<td align="left" <b><?php echo "Asesor:".encadenar(2); ?></b></td>
		<td align="left" ><?php echo $nom_ases; ?></td>
		<td align="left" ><?php echo encadenar(15); ?></td>
		<?php if($pag_int == 1){ ?>
	    <td align="left" <b><?php echo "I - V" ; ?></td>
	 <?php } ?> 
	  <?php if($pag_int == 4){ ?>
	    <td align="left" <b><?php echo "I - A" ; ?></td>
	 <?php } ?> 
	 	<td align="left" ><?php echo encadenar(15); ?></td>
		<td align="left" <b><?php echo "Asesor:".encadenar(2); ?></b></td>
		<td align="left" ><?php echo $nom_ases; ?></td>
	</tr>
	
	<tr>
	    <td align="left" <b><?php echo "Cuota Nro.".encadenar(2); ?></b></td>
		<td align="left" style="border: ridge" ><?php echo encadenar(3); ?></td>
		<td align="left" ><?php echo "Fecha".encadenar(2); ?>; </td>	
		<td align="left"style="border: ridge" ><?php echo encadenar(3); ?></td>
		<td align="right" <b><?php echo encadenar(10); ?></td>
		 <td align="left" <b><?php echo "Cuota Nro.".encadenar(2); ?></b></td>
		<td align="left" style="border: ridge" ><?php echo encadenar(3); ?></td>
		<td align="left" ><?php echo "Fecha".encadenar(2); ?>; </td>	
		<td align="left"style="border: ridge" ><?php echo encadenar(3); ?></td>
		
	</tr>
	</table>
	<?php
$consulta  = "Select CRED_DEU_RELACION, CRED_DEU_ID,CRED_DEU_INTERNO,CRED_DEU_IMPORTE, CLIENTE_COD_ID,CLIENTE_AP_ESPOSO,
	CLIENTE_AP_PATERNO,
	 CLIENTE_AP_MATERNO, CLIENTE_NOMBRES From cliente_general, cred_deudor 
	 where CRED_SOL_CODIGO = $cod_s and CRED_DEU_INTERNO = CLIENTE_COD 
	 and CRED_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null  order by CRED_DEU_RELACION ";
    $resultado = mysql_query($consulta);
	
    ?>
<table border="1" width="900">
	<tr>
	   	<th style="font-size:11px">Cliente</th>
		<th style="font-size:11px">Monto Cuota</th>
		<th style="font-size:11px">Cobrado Bs.</th>
		<th style="font-size:11px">Cobrado $us</th>
		<th style="font-size:11px"> <?php echo encadenar(10); ?></th>
			<th style="font-size:11px">Cliente</th>
		<th style="font-size:11px">Monto Cuota</th>
		<th style="font-size:11px">Cobrado Bs.</th>
		<th style="font-size:11px">Cobrado $us</th>
	</tr>
<?php
$nro_sel = 0;
$t_cta = 0;
?>
                		
<?php
while ($linea = mysql_fetch_array($resultado)) {
       $nro_sel = $nro_sel + 1;
		//$r = "";
		$nom_cli = $linea['CLIENTE_AP_ESPOSO'].encadenar(1).$linea['CLIENTE_AP_PATERNO'].encadenar(1). $linea['CLIENTE_AP_MATERNO']
		.encadenar(1).$linea['CLIENTE_NOMBRES'];
		$cod_ncre = $linea['CRED_DEU_ID'];
		$cod_int = $linea['CRED_DEU_INTERNO'];
		$imp_sol = $linea['CRED_DEU_IMPORTE'];
		$con_cta  = "Select * From cred_plandp 
	 where CRED_PLD_COD_SOL = $cod_s and CRED_PLD_COD_CLI = $cod_int 
	 and CRED_PLD_USR_BAJA is null";
    $res_cta = mysql_query($con_cta);
	while ($lin_cta = mysql_fetch_array($res_cta)) {
	       $mon_cta = $lin_cta['CRED_PLD_CAPITAL'] +
		              $lin_cta['CRED_PLD_INTERES'] +
					  $lin_cta['CRED_PLD_AHORRO'];
				  
	
	}	
	$t_cta = $t_cta + $mon_cta;		
		//$nray = 60 - $nro;
	//	echo $cod_ncre;
		 ?>
		 <tr>
		 <td style="font-size:11px"><?php echo $nom_cli; ?></td>
		 <td style="font-size:11px" align="right"> <?php echo number_format($mon_cta, 2, '.',','); ?>	</td> 
		<td> <?php echo encadenar(10); ?>	</td>
		<td> <?php echo encadenar(10); ?>	</td>
		<td> <?php echo encadenar(10); ?>	</td>
		 <td style="font-size:11px"><?php echo $nom_cli; ?></td>
		 <td style="font-size:11px" align="right"> <?php echo number_format($mon_cta, 2, '.',','); ?>	</td> 
		<td> <?php echo encadenar(10); ?>	</td>
		<td> <?php echo encadenar(10); ?>	</td>
		 </tr>
	  <?php
	     
       }
       ?>

	
	 
	 
	 <tr>
	    
	    <th align="center" ><?php echo "TOTAL"; ?></td>
		<th align="right" ><?php echo number_format($t_cta, 2, '.',','); ?></td>
		<th align="right" ><?php echo encadenar(2); ?></td>							
	    <th align="right" ><?php echo encadenar(2); ?></td>
	 	 <th align="right" ><?php echo encadenar(10); ?></td>
		 <th align="center" ><?php echo "TOTAL"; ?></td>
		<th align="right" ><?php echo number_format($t_cta, 2, '.',','); ?></td>
		<th align="right" ><?php echo encadenar(2); ?></td>
		<th align="right" ><?php echo encadenar(2); ?></td>
		
	</tr>
</table>	
<br><br><br>
	<table border="0" width="900">	 
	  <tr>
	    <th align="left"><?php echo encadenar(5); ?></th>
        <th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(40); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
     </tr>
	 
	 <tr>
	     <th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(30); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		
	 </tr>
    	 <th align="left"><?php echo encadenar(5); ?></th>
        <th align="center" style="font-size:10px"><?php echo $_SESSION['nom_rec']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center" style="font-size:10px"><?php echo "Cliente"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(30); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="center" style="font-size:10px"><?php echo $_SESSION['nom_rec']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center" style="font-size:10px"><?php echo "Cliente"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
	 </tr>

  </table>		
	<?php	
	
 
 ?> 



		  
<br>
 </table>
 <br><br>
<?php
		// 	include("footer_in.php");
			}
		 ?>

</div>
</body>
</html>



<?php
}
ob_end_flush();
 ?>

