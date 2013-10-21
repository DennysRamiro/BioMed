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
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script language="javascript" src="script/validarForm.js"></script> 
</head>
<body>	
<div id="cuerpoModulo">
     <?php
	   include("header.php");
 	 ?>
<div id="UserData">
     <img src="images/24x24/001_20.png" border="0" align="absmiddle" alt="Home" />		
<center>
<?php
  if(isset($_SESSION['msg_err'])){
 ?> 
 <font color="#FF0000"> 
  <?php
	 echo $_SESSION['msg_err'];
	 $_SESSION['msg_err'] = "";
 } 
 

$_SESSION['form_buffer'] = $_POST;
$error_d = 0;
$_SESSION['msg_err'] = " ";
// Fecha

if(isset($datos['fec_1'])){
   $datos['fec_1'] = $datos['fec_1'];
}
if(isset($datos['fec_2'])){
   $datos['fec_2'] = number_format($datos['fec_2'], 2, '.',',');
}
if(isset($datos['fec_3'])){
   $datos['fec_3'] = number_format($datos['fec_3'], 2, '.',',');
}
if(isset($datos['fec_4'])){
   $datos['fec_4'] = number_format($datos['fec_4'], 2, '.',',');
}
if(isset($datos['fec_5'])){
   $datos['fec_5'] = number_format($datos['fec_5'], 2, '.',',');
}
if(isset($datos['fec_6'])){
   $datos['fec_6'] = number_format($datos['fec_6'], 2, '.',',');
}
if(isset($datos['fec_7'])){
   $datos['fec_7'] = number_format($datos['fec_7'], 2, '.',',');
}
if(isset($datos['fec_8'])){
   $datos['fec_8'] = number_format($datos['fec_8'], 2, '.',',');
}
if(isset($datos['fec_9'])){
  $datos['fec_9'] = number_format($datos['fec_9'], 2, '.',',');
}
if(isset($datos['fec_10'])){
   $datos['fec_10'] = number_format($datos['fec_10'], 2, '.',',');
 }
if(isset($datos['fec_11'])){ 
   $datos['fec_11'] = number_format($datos['fec_11'], 2, '.',',');
}
if(isset($datos['fec_12'])){
   $datos['fec_12'] = number_format($datos['fec_12'], 2, '.',',');
   }
if(isset($datos['fec_13'])){
   $datos['fec_13'] = number_format($datos['fec_13'], 2, '.',',');
}
if(isset($datos['fec_14'])){
   $datos['fec_14'] = number_format($datos['fec_14'], 2, '.',',');
}
if(isset($datos['fec_15'])){
   $datos['fec_15'] = number_format($datos['fec_15'], 2, '.',',');
 }
if(isset($datos['imp_16'])){
   $datos['fec_16'] = number_format($datos['fec_16'], 2, '.',',');
   }
if(isset($datos['fec_17'])){
   $datos['fec_17'] = number_format($datos['fec_17'], 2, '.',',');
 }
if(isset($datos['fec_18'])){
   $datos['fec_18'] = number_format($datos['fec_18'], 2, '.',',');
}
if(isset($datos['fec_19'])){
   $datos['fec_19'] = number_format($datos['fec_19'], 2, '.',',');
}
if(isset($datos['fec_20'])){
   $datos['fec_20'] = number_format($datos['fec_20'], 2, '.',',');
   }
if(isset($datos['fec_21'])){ 
   $datos['fec_21'] = number_format($datos['fec_21'], 2, '.',',');
   }
if(isset($datos['fec_22'])){ 
   $datos['fec_22'] = number_format($datos['fec_22'], 2, '.',',');
   }
if(isset($datos['fec_23'])){
   $datos['fec_23'] = number_format($datos['fec_23'], 2, '.',',');
   }
if(isset($datos['fec_24'])){   
   $datos['fec_24'] = number_format($datos['fec_24'], 2, '.',',');
   }



// Capital
if(isset($datos['imp_1'])){
   $datos['imp_1'] = number_format($datos['imp_1'], 2, '.',',');
}
if(isset($datos['imp_2'])){
   $datos['imp_2'] = number_format($datos['imp_2'], 2, '.',',');
}
if(isset($datos['imp_3'])){
   $datos['imp_3'] = number_format($datos['imp_3'], 2, '.',',');
}
if(isset($datos['imp_4'])){
   $datos['imp_4'] = number_format($datos['imp_4'], 2, '.',',');
}
if(isset($datos['imp_5'])){
   $datos['imp_5'] = number_format($datos['imp_5'], 2, '.',',');
}
if(isset($datos['imp_6'])){
   $datos['imp_6'] = number_format($datos['imp_6'], 2, '.',',');
}
if(isset($datos['imp_7'])){
   $datos['imp_7'] = number_format($datos['imp_7'], 2, '.',',');
}
if(isset($datos['imp_8'])){
   $datos['imp_8'] = number_format($datos['imp_8'], 2, '.',',');
}
if(isset($datos['imp_9'])){
  $datos['imp_9'] = number_format($datos['imp_9'], 2, '.',',');
}
if(isset($datos['imp_10'])){
   $datos['imp_10'] = number_format($datos['imp_10'], 2, '.',',');
 }
if(isset($datos['imp_11'])){ 
   $datos['imp_11'] = number_format($datos['imp_11'], 2, '.',',');
}
if(isset($datos['imp_12'])){
   $datos['imp_12'] = number_format($datos['imp_12'], 2, '.',',');
   }
if(isset($datos['imp_13'])){
   $datos['imp_13'] = number_format($datos['imp_13'], 2, '.',',');
}
if(isset($datos['imp_14'])){
   $datos['imp_14'] = number_format($datos['imp_14'], 2, '.',',');
}
if(isset($datos['imp_15'])){
   $datos['imp_15'] = number_format($datos['imp_15'], 2, '.',',');
 }
if(isset($datos['imp_16'])){
   $datos['imp_16'] = number_format($datos['imp_16'], 2, '.',',');
   }
if(isset($datos['imp_17'])){
   $datos['imp_17'] = number_format($datos['imp_17'], 2, '.',',');
 }
if(isset($datos['imp_18'])){
   $datos['imp_18'] = number_format($datos['imp_18'], 2, '.',',');
}
if(isset($datos['imp_19'])){
   $datos['imp_19'] = number_format($datos['imp_19'], 2, '.',',');
}
if(isset($datos['imp_20'])){
   $datos['imp_20'] = number_format($datos['imp_20'], 2, '.',',');
   }
if(isset($datos['imp_21'])){ 
   $datos['imp_21'] = number_format($datos['imp_21'], 2, '.',',');
   }
if(isset($datos['imp_22'])){ 
   $datos['imp_22'] = number_format($datos['imp_22'], 2, '.',',');
   }
if(isset($datos['imp_23'])){
   $datos['imp_23'] = number_format($datos['imp_23'], 2, '.',',');
   }
if(isset($datos['imp_24'])){   
   $datos['imp_24'] = number_format($datos['imp_24'], 2, '.',',');
   }
if(isset($datos['imp_25'])){   
   $datos['imp_25'] = number_format($datos['imp_25'], 2, '.',',');
   }
   
$log_usr = $_SESSION['login'];

$cod_fpa = $_SESSION['cod_fpa'];
$cod_cin = $_SESSION['cod_cin'];
//echo $cod_sol;
$log_usr =$_SESSION['login'];
//echo $log_usr;
$imp_s = $_SESSION['imp_sol'] ;
$aho_d = $_SESSION['aho_dur'];
$tas_i = $_SESSION['tas_int'];
$plz_m = $_SESSION['plz_mes'];
$fec_d = $_SESSION['fec_des'];
$fec_1 = $_SESSION['fec_uno'];
$nro_c = $_SESSION['nro_cta'];
$mes = saca_mes($fec_1);
$dia = saca_dia($fec_1);
$anio = saca_anio($fec_1);
$dia_l = dia_semana($dia, $mes, $anio);
$_SESSION['dia_l'] = $dia_l;
   $tint_m = $tas_i / $mes;                                                  
  $tint =  $tas_i/12 ;                     
 
$nro_d = 30;
$p_cap = $imp_s/$nro_c;
//if (empty($tas_i)) {
//    $error_d = 1;
//    $_SESSION['msg_err'] ="Error en Tasa Interes Anual no puede estar vacio";
//	}

//Valida nro cuotas
 $con_fpa = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 13 and GRAL_PAR_INT_COD = $cod_fpa";
          $res_fpa = mysql_query($con_fpa);
          while ($lin_fpa = mysql_fetch_array($res_fpa)) {
		        $nro_d = $lin_fpa['GRAL_PAR_INT_CTA1'];
				$fpag_d = $lin_fpa['GRAL_PAR_INT_DESC'];
		  }
 $con_cin = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 10 and GRAL_PAR_INT_COD = $cod_cin";
       $res_cin = mysql_query($con_cin);
	   while ($linea = mysql_fetch_array($res_cin)) {
	        $d_cin = $linea['GRAL_PAR_INT_DESC'];
	   }
   $f_des = cambiaf_a_mysql($fec_d);
   $f_pro = $_SESSION['fec_proc'];
   $ano1 = substr($f_des, 0,4); 
        $mes1 = substr($f_des, 5, 2); 
        $dia1 = substr($f_des, 8, 2);
        $ano2 = substr($f_pro, 6,4); 
        $mes2 = substr($f_pro, 3, 2); 
        $dia2 = substr($f_pro, 0, 2);
       $timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1); 
        $timestamp2 = mktime(0,0,0,$mes2,$dia2,$ano2); 
        $segundos_diferencia = $timestamp1 - $timestamp2; 
	 $dias = $segundos_diferencia / (60 * 60 * 24); 	

if (empty($fec_1)) {
	 $error_d = 1;
    $_SESSION['msg_err'] =$_SESSION['msg_err']." -- ". "Error en Fecha Primer Pago no puede estar vacio o cero";
	}				
    $f_uno = cambiaf_a_mysql($fec_1);
        $ano1 = substr($f_des, 0,4); 
        $mes1 = substr($f_des, 5, 2); 
        $dia1 = substr($f_des, 8, 2);
        $ano2 = substr($fec_1, 6,4); 
        $mes2 = substr($fec_1, 3, 2); 
        $dia2 = substr($fec_1, 0, 2);
       $timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1); 
        $timestamp2 = mktime(0,0,0,$mes2,$dia2,$ano2); 
        $segundos_diferencia = $timestamp2 - $timestamp1; 
	 $dias = $segundos_diferencia / (60 * 60 * 24); 	

if ($dias <= 0){
   $error_d = 1;
    $_SESSION['msg_err'] = $_SESSION['msg_err']." -- "."Error en Fecha Primer Pago no puede ser menor o igual a Fecha Desembolso".$f_uno.$f_des; 
}

if ($error_d == 1) {
    $error_d = 0;
    header('Location: solic_simulador.php');
    }else{
	
	//echo "Aquiiii 2";
    $mes = 12;
	 $nro_d =30;
    $tint_m = $tas_i / $mes;
    $fecha_d = date("d-m-Y", strtotime("$f_des"));
		
	$nro_d1 = $nro_d - 1;
    for ($i=1; $i < $nro_c + 1; $i = $i + 1 ) {
        if ($i == 1){
	       $fecha_nueva = date("d-m-Y", strtotime("$f_uno"));
		   $dia_f = substr($fecha_nueva,0,2);
		   $fec_pag [1] =$fecha_nueva; 
		   $pag_cap [1] =$p_cap;
		   $pag_int [1] =0;
		 }else{
		   $fecha_nueva = date("d-m-Y", strtotime("$fecha_nueva + $nro_d days"));
		   $fec_pag [$i] =$fecha_nueva;
		   $pag_cap [$i] =$p_cap;
		   $pag_int [$i] =0;
		}	
		
	  }
	  $aho = (($imp_s * $aho_d)/100)/ $nro_c;
		  for ($i=1; $i < $nro_c + 1; $i = $i + 1 ) {
	 	     $pag_aho[$i] = $aho;
	     }
	 $cap = $imp_s;
	} 
//Cuota Fija

	 

?>
 <form name="form2" method="post" action="sol_valsimula.php" onSubmit="return">
<table align="center" border="1">
 <tr>   
             <th ><?php echo "Monto Solicitado";?></td>
			 <td align="right"><?php echo number_format($imp_s, 2, '.',',');?></td>
			 <th><?php echo "Tasa Int. Anual";?></td>
			 <td align="right"><?php echo number_format($tint*12, 2, '.',',');?></td>
			  <th><?php echo "Tasa Int. Mensual";?></td>
			 <td align="right"><?php echo number_format($tint, 2, '.',',');?></td>
			 
		</tr>
		 <tr>   
             <th ><?php echo "Plazo Meses";?></td>
			 <td align="right"><?php echo number_format($plz_m, 2, '.',',');?></td>
			 <th><?php echo "Nro. Cuotas";?></td>
			 <td align="right"><?php echo number_format($nro_c, 2, '.',',');?></td>
			  <th><?php echo "% Ahorro";?></td>
			 <td align="right"><?php echo number_format($aho_d, 2, '.',',');?></td>
			 
		</tr>
		 <tr>   
             <th ><?php echo "Forma de Pago";?></td>
			 <td align="right"><?php echo $fpag_d;?></td>
			 <th><?php echo "Cal. Interes";?></td>
			 <td align="right"><?php echo $d_cin;?></td>
			  <th><?php echo encadenar(2);?></td>
			 <td align="right"><?php echo encadenar(2);?></td>
			 
		</tr>
		
		 <tr>   
             <th ><?php echo "Fec. Desembolso";?></td>
			 <td align="right"><?php echo $fec_d;?></td>
			 <th><?php echo "Fec. Primer Pago";?></td>
			 <td align="right"><?php echo $fec_1;?></td>
			  <th><?php echo "Fec. Ultimo Pago";?></td>
			 <td align="right"><?php echo  $fec_pag [$nro_c];?></td>
			 
		</tr>
</table>

<table align="center" border="1">
 <tr>   
             <th align="center"><?php echo "Nro. Cuota";?></td>
			 <th><?php echo "Fec.Pago";?></td>
			 <th><?php echo "Capital";?></td>
	 	   <th><?php echo "Ahorro";?></td>
			   
			   
		</tr>
<?php
$tot_cap = 0;
$tot_int = 0;
$tot_aho = 0;
for ($i=1; $i < $nro_c + 1; $i = $i + 1 ) {
     $tot_cap = $tot_cap+$pag_cap[$i];
     $tot_int = $tot_int +$pag_int[$i];
     $tot_aho = $tot_aho+ $pag_aho[$i];

if ($i == 1){
    $saldo = $imp_s - $pag_cap[$i];
	}else{
	$saldo = $saldo - $pag_cap[$i];
	}
?>
<tr> 
	 <?php if ($i == 1) { ?>
	    <td align="center"><strong><?php echo $i;?></strong></td>
        <td><?php if(isset($fec_pag [$i])){?>
            <input type="text"  style align="center" name="fec_1" width="10"  size="20" value="<?= $fec_pag [$i];?>" ></td> 
		<td><input type="text"  style align="center" name="imp_1" width="10"  size="20"
			  value="<?= number_format($pag_cap [$i], 2, '.',',');?>" ></td> 
		<td><input type="text"  style align="center" name="aho_1" width="10"  size="20"
			  value="<?= number_format($pag_aho [$i], 2, '.',',');?>" ></td> 
	   	    <?php }?> 
        <?php  } ?>

	 <?php if ($i == 2) { ?>
	    <td align="center"><strong><?php echo $i;?></strong></td>
        <td><?php if(isset($fec_pag [$i])){?>
            <input type="text"  style align="center" name="fec_2" width="10"  size="20" value="<?= $fec_pag [$i];?>" ></td> 
		<td><input type="text"  style align="center" name="imp_2" width="10"  size="20"
			  value="<?= number_format($pag_cap [$i], 2, '.',',');?>" ></td> 
		<td><input type="text"  style align="center" name="aho_2" width="10"  size="20"
			  value="<?= number_format($pag_aho [$i], 2, '.',',');?>" ></td> 
	   	    <?php }?>
        <?php  } ?>

	 <?php if ($i == 3) { ?>
	    <td align="center"><strong><?php echo $i;?></strong></td>
        <td><?php if(isset($fec_pag [$i])){?>
            <input type="text"  style align="center" name="fec_3" width="10"  size="20" value="<?= $fec_pag [$i];?>" ></td> 
		<td><input type="text"  style align="center" name="imp_3" width="10"  size="20"
			  value="<?= number_format($pag_cap [$i], 2, '.',',');?>" ></td> 
		<td><input type="text"  style align="center" name="aho_3" width="10"  size="20"
			  value="<?= number_format($pag_aho [$i], 2, '.',',');?>" ></td> 
	   	    <?php }?>
        <?php  } ?>

	 <?php if ($i == 4) { ?>
	    <td align="center"><strong><?php echo $i;?></strong>
        <td><?php if(isset($fec_pag [$i])){?>
            <input type="text"  style align="center" name="fec_4" width="10"  size="20" value="<?= $fec_pag [$i];?>" ></td> 
		<td><input type="text"  style align="center" name="imp_4" width="10"  size="20"
			  value="<?= number_format($pag_cap [$i], 2, '.',',');?>" >
		<td><input type="text"  style align="center" name="aho_4" width="10"  size="20"
			  value="<?= number_format($pag_aho [$i], 2, '.',',');?>" >
	   
	    <?php }?>  
        <?php  } ?>

	 <?php if ($i == 5) { ?>
	    <td align="center"><strong><?php echo $i;?></strong></td>
        <td><?php if(isset($fec_pag [$i])){?>
            <input type="text"  style align="center" name="fec_5" width="10"  size="20" value="<?= $fec_pag [$i];?>" ></td> 
		<td><input type="text"  style align="center" name="imp_5" width="10"  size="20"
			  value="<?= number_format($pag_cap [$i], 2, '.',',');?>" ></td> 
		<td><input type="text"  style align="center" name="aho_5" width="10"  size="20"
			  value="<?= number_format($pag_aho [$i], 2, '.',',');?>" ></td> 
	   <?php }?> 
        <?php  } ?>

	 <?php if ($i == 6) { ?>
	    <td align="center"><strong><?php echo $i;?></strong></td>
        <td><?php if(isset($fec_pag [$i])){?>
            <input type="text"  style align="center" name="fec_6" width="10"  size="20" value="<?= $fec_pag [$i];?>" ></td> 
		<td><input type="text"  style align="center" name="imp_6" width="10"  size="20"
			  value="<?= number_format($pag_cap [$i], 2, '.',',');?>" ></td> 
		<td><input type="text"  style align="center" name="aho_6" width="10"  size="20"
			  value="<?= number_format($pag_aho [$i], 2, '.',',');?>" ></td> 
	   <?php }?> 
        <?php  } ?>

	 <?php if ($i == 7) { ?>
	    <td align="center"><strong><?php echo $i;?></strong></td>
        <td><?php if(isset($fec_pag [$i])){?>
            <input type="text"  style align="center" name="fec_7" width="10"  size="20" value="<?= $fec_pag [$i];?>" ></td> 
		<td><input type="text"  style align="center" name="imp_7" width="10"  size="20"
			  value="<?= number_format($pag_cap [$i], 2, '.',',');?>" ></td> 
		<td><input type="text"  style align="center" name="aho_7" width="10"  size="20"
			  value="<?= number_format($pag_aho [$i], 2, '.',',');?>" ></td> 
	    <?php }?> 
        <?php  } ?>

	 <?php if ($i == 8) { ?>
	    <td align="center"><strong><?php echo $i;?></strong></td>
        <td><?php if(isset($fec_pag [$i])){?>
            <input type="text"  style align="center" name="fec_8" width="10"  size="20" value="<?= $fec_pag [$i];?>" ></td> 
		<td><input type="text"  style align="center" name="imp_8" width="10"  size="20"
			  value="<?= number_format($pag_cap [$i], 2, '.',',');?>" ></td> 
		<td><input type="text"  style align="center" name="aho_8" width="10"  size="20"
			  value="<?= number_format($pag_aho [$i], 2, '.',',');?>" ></td> 
	     <?php }?>
        <?php  } ?>
	 <?php if ($i == 9) { ?>
	    <td align="center"><strong><?php echo $i;?></strong></td>
        <td><?php if(isset($fec_pag [$i])){?>
            <input type="text"  style align="center" name="fec_9" width="10"  size="20" value="<?= $fec_pag [$i];?>" ></td> 
		<td><input type="text"  style align="center" name="imp_9" width="10"  size="20"
			  value="<?= number_format($pag_cap [$i], 2, '.',',');?>" ></td> 
		<td><input type="text"  style align="center" name="aho_9" width="10"  size="20"
			  value="<?= number_format($pag_aho [$i], 2, '.',',');?>" ></td> 
	   <?php }?>  
        <?php  } ?>

	 <?php if ($i == 10) { ?>
	    <td align="center"><strong><?php echo $i;?></strong></td>
        <td><?php if(isset($fec_pag [$i])){?>
            <input type="text"  style align="center" name="fec_10" width="10"  size="20" value="<?= $fec_pag [$i];?>" ></td> 
		<td><input type="text"  style align="center" name="imp_10" width="10"  size="20"
			  value="<?= number_format($pag_cap [$i], 2, '.',',');?>" ></td> 
		<td><input type="text"  style align="center" name="aho_10" width="10"  size="20"
			  value="<?= number_format($pag_aho [$i], 2, '.',',');?>" ></td> 
	 
	    <?php }?>  
        <?php  } ?>

	 <?php if ($i == 11) { ?>
	    <td align="center"><strong><?php echo $i;?></strong></td>
        <td><?php if(isset($fec_pag [$i])){?>
            <input type="text"  style align="center" name="fec_11" width="10"  size="20" value="<?= $fec_pag [$i];?>" ></td> 
		<td><input type="text"  style align="center" name="imp_11" width="10"  size="20"
			  value="<?= number_format($pag_cap [$i], 2, '.',',');?>" ></td> 
		<td><input type="text"  style align="center" name="aho_11" width="10"  size="20"
			  value="<?= number_format($pag_aho [$i], 2, '.',',');?>" ></td> 
	   <?php }?>
        <?php  } ?>

	 <?php if ($i == 12) { ?>
	    <td align="center"><strong><?php echo $i;?></strong></td>
        <td><?php if(isset($fec_pag [$i])){?>
            <input type="text"  style align="center" name="fec_12" width="10"  size="20" value="<?= $fec_pag [$i];?>" ></td> 
		<td><input type="text"  style align="center" name="imp_12" width="10"  size="20"
			  value="<?= number_format($pag_cap [$i], 2, '.',',');?>" ></td> 
		<td><input type="text"  style align="center" name="aho_12" width="10"  size="20"
			  value="<?= number_format($pag_aho [$i], 2, '.',',');?>" ></td> 
	   <?php }?>
        <?php  } ?>

	 <?php if ($i == 13) { ?>
	    <td align="center"><strong><?php echo $i;?></strong></td>
        <td><?php if(isset($fec_pag [$i])){?>
            <input type="text"  style align="center" name="fec_13" width="10"  size="20" value="<?= $fec_pag [$i];?>" ></td> 
		<td><input type="text"  style align="center" name="imp_13" width="10"  size="20"
			  value="<?= number_format($pag_cap [$i], 2, '.',',');?>" ></td> 
		<td><input type="text"  style align="center" name="aho_13" width="10"  size="20"
			  value="<?= number_format($pag_aho [$i], 2, '.',',');?>" ></td> 
	    <?php }?>  
        <?php  } ?>

	 <?php if ($i == 14) { ?>
	    <td align="center"><strong><?php echo $i;?></strong></td>
        <td><?php if(isset($fec_pag [$i])){?>
            <input type="text"  style align="center" name="fec_14" width="10"  size="20" value="<?= $fec_pag [$i];?>" ></td> 
		<td><input type="text"  style align="center" name="imp_14" width="10"  size="20"
			  value="<?= number_format($pag_cap [$i], 2, '.',',');?>" ></td> 
		<td><input type="text"  style align="center" name="aho_14" width="10"  size="20"
			  value="<?= number_format($pag_aho [$i], 2, '.',',');?>" ></td> 
	   
	    <?php }?>
        <?php  } ?>

	 <?php if ($i == 15) { ?>
	    <td align="center"><strong><?php echo $i;?></strong></td>
        <td><?php if(isset($fec_pag [$i])){?>
            <input type="text"  style align="center" name="fec_15" width="10"  size="20" value="<?= $fec_pag [$i];?>" ></td> 
		<td><input type="text"  style align="center" name="imp_15" width="10"  size="20"
			  value="<?= number_format($pag_cap [$i], 2, '.',',');?>" ></td> 
		<td><input type="text"  style align="center" name="aho_15" width="10"  size="20"
			  value="<?= number_format($pag_aho [$i], 2, '.',',');?>" ></td> 
	    
	    <?php }?>
        <?php  } ?>

	 <?php if ($i == 16) { ?>
	    <td align="center"><strong><?php echo $i;?></strong></td>
        <td><?php if(isset($fec_pag [$i])){?>
            <input type="text"  style align="center" name="fec_16" width="10"  size="20" value="<?= $fec_pag [$i];?>" ></td> 
		<td><input type="text"  style align="center" name="imp_16" width="10"  size="20"
			  value="<?= number_format($pag_cap [$i], 2, '.',',');?>" ></td> 
		<td><input type="text"  style align="center" name="aho_16" width="10"  size="20"
			  value="<?= number_format($pag_aho [$i], 2, '.',',');?>" ></td> 
	   
	    <?php }?> 
        <?php  } ?>

	 <?php if ($i == 17) { ?>
	    <td align="center"><strong><?php echo $i;?></strong></td>
        <td><?php if(isset($fec_pag [$i])){?>
            <input type="text"  style align="center" name="fec_17" width="10"  size="20" value="<?= $fec_pag [$i];?>" ></td> 
		<td><input type="text"  style align="center" name="imp_17" width="10"  size="20"
			  value="<?= number_format($pag_cap [$i], 2, '.',',');?>" ></td> 
		<td><input type="text"  style align="center" name="aho_17" width="10"  size="20"
			  value="<?= number_format($pag_aho [$i], 2, '.',',');?>" ></td> 
	   	    <?php }?> 
        <?php  } ?>

	 <?php if ($i == 18) { ?>
	    <td align="center"><strong><?php echo $i;?></strong></td>
        <td><?php if(isset($fec_pag [$i])){?>
            <input type="text"  style align="center" name="fec_18" width="10"  size="20" value="<?= $fec_pag [$i];?>" ></td> 
		<td><input type="text"  style align="center" name="imp_18" width="10"  size="20"
			  value="<?= number_format($pag_cap [$i], 2, '.',',');?>" ></td> 
		<td><input type="text"  style align="center" name="aho_18" width="10"  size="20"
			  value="<?= number_format($pag_aho [$i], 2, '.',',');?>" ></td> 
	     <?php }?>
        <?php  } ?>

	 <?php if ($i == 19) { ?>
	    <td align="center"><strong><?php echo $i;?></strong></td>
        <td><?php if(isset($fec_pag [$i])){?>
            <input type="text"  style align="center" name="fec_19" width="10"  size="20" value="<?= $fec_pag [$i];?>" ></td> 
		<td><input type="text"  style align="center" name="imp_19" width="10"  size="20"
			  value="<?= number_format($pag_cap [$i], 2, '.',',');?>" ></td> 
		<td><input type="text"  style align="center" name="aho_19" width="10"  size="20"
			  value="<?= number_format($pag_aho [$i], 2, '.',',');?>" ></td> 
	   <?php }?>
        <?php  } ?>

	 <?php if ($i == 20) { ?>
	    <td align="center"><strong><?php echo $i;?></strong></td>
        <td><?php if(isset($fec_pag [$i])){?>
            <input type="text"  style align="center" name="fec_20" width="10"  size="20" value="<?= $fec_pag [$i];?>" ></td> 
		<td><input type="text"  style align="center" name="imp_20" width="10"  size="20"
			  value="<?= number_format($pag_cap [$i], 2, '.',',');?>" ></td> 
		<td><input type="text"  style align="center" name="aho_20" width="10"  size="20"
			  value="<?= number_format($pag_aho [$i], 2, '.',',');?>" ></td> 
	    <?php }?>  
        <?php  } ?>

	 <?php if ($i == 21) { ?>
	    <td align="center"><strong><?php echo $i;?></strong></td>
        <td><?php if(isset($fec_pag [$i])){?>
            <input type="text"  style align="center" name="fec_21" width="10"  size="20" value="<?= $fec_pag [$i];?>" ></td> 
		<td><input type="text"  style align="center" name="imp_21" width="10"  size="20"
			  value="<?= number_format($pag_cap [$i], 2, '.',',');?>" ></td> 
		<td><input type="text"  style align="center" name="aho_21" width="10"  size="20"
			  value="<?= number_format($pag_aho [$i], 2, '.',',');?>" ></td> 
	    <?php }?>
        <?php  } ?>

	 <?php if ($i == 22) { ?>
	    <td align="center"><strong><?php echo $i;?></strong></td>
        <td><?php if(isset($fec_pag [$i])){?>
            <input type="text"  style align="center" name="fec_22" width="10"  size="20" value="<?= $fec_pag [$i];?>" ></td> 
		<td><input type="text"  style align="center" name="imp_22" width="10"  size="20"
			  value="<?= number_format($pag_cap [$i], 2, '.',',');?>" ></td> 
		<td><input type="text"  style align="center" name="aho_22" width="10"  size="20"
			  value="<?= number_format($pag_aho [$i], 2, '.',',');?>" ></td> 
	    <?php }?>
        <?php  } ?>

	 <?php if ($i == 23) { ?>
	    <td align="center"><strong><?php echo $i;?></strong></td>
        <td><?php if(isset($fec_pag [$i])){?>
            <input type="text"  style align="center" name="fec_22" width="10"  size="23" value="<?= $fec_pag [$i];?>" ></td> 
		<td><input type="text"  style align="center" name="imp_22" width="10"  size="23"
			  value="<?= number_format($pag_cap [$i], 2, '.',',');?>" ></td> 
		<td><input type="text"  style align="center" name="aho_22" width="10"  size="23"
			  value="<?= number_format($pag_aho [$i], 2, '.',',');?>" ></td> 
	    <?php }?>
        <?php  } ?>

	 <?php if ($i == 23) { ?>
	    <td align="center"><strong><?php echo $i;?></strong></td>
        <td><?php if(isset($fec_pag [$i])){?>
            <input type="text"  style align="center" name="fec_23" width="10"  size="23" value="<?= $fec_pag [$i];?>" ></td> 
		<td><input type="text"  style align="center" name="imp_23" width="10"  size="23"
			  value="<?= number_format($pag_cap [$i], 2, '.',',');?>" ></td> 
		<td><input type="text"  style align="center" name="aho_23" width="10"  size="23"
			  value="<?= number_format($pag_aho [$i], 2, '.',',');?>" ></td> 
	    <?php }?>
        <?php  } ?>

	 <?php if ($i == 24) { ?>
	    <td align="center"><strong><?php echo $i;?></strong></td>
        <td><?php if(isset($fec_pag [$i])){?>
            <input type="text"  style align="center" name="fec_24" width="10"  size="23" value="<?= $fec_pag [$i];?>" ></td> 
		<td><input type="text"  style align="center" name="imp_24" width="10"  size="23"
			  value="<?= number_format($pag_cap [$i], 2, '.',',');?>" ></td> 
		<td><input type="text"  style align="center" name="aho_24" width="10"  size="23"
			  value="<?= number_format($pag_aho [$i], 2, '.',',');?>" ></td> 
	    <?php }?>
        <?php  } ?>

	 <?php if ($i == 25) { ?>
	    <td align="center"><strong><?php echo $i;?></strong></td>
        <td><?php if(isset($fec_pag [$i])){?>
            <input type="text"  style align="center" name="fec_25" width="10"  size="23" value="<?= $fec_pag [$i];?>" ></td> 
		<td><input type="text"  style align="center" name="imp_25" width="10"  size="23"
			  value="<?= number_format($pag_cap [$i], 2, '.',',');?>" ></td> 
		<td><input type="text"  style align="center" name="aho_25" width="10"  size="23"
			  value="<?= number_format($pag_aho [$i], 2, '.',',');?>" ></td> 
	    <?php }?>
        <?php  } ?>
</tr>  					
<?php } ?>
 <tr>   
             <td align="center"><strong><?php echo "Totales";?></strong></td>
			 <td><?php echo encadenar(2);?></td>
			 <th align="right"><?php echo number_format($tot_cap, 2, '.',',');?></td>
			  <td><?php echo encadenar(2);?></td>
			 
		</tr>
</table>		

 <br>
	<center>
	 
	
    <input type="submit" name="accion" value="Recalcular">
    <input type="submit" name="accion" value="Salir">
</form>



<?php
}
    ob_end_flush();
 ?>