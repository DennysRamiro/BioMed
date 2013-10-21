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
<?php
//$_SESSION["total_s"] = 0;
 $fec = leer_param_gral();
 $logi = $_SESSION['login']; 
 $nro_sol = $_SESSION['nro_sol'];
 $datos = $_SESSION['form_buffer'];
// echo $nro_sol;
?> 
</div>
<div id="Salir">
     <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
</div>
<center>
<div id="TitleModulo">
   	 <img src="images/24x24/001_36.png" border="0" alt="Modulo">	
                Asignar Montos 
</div>
<div id="AtrasBoton">
    <a href="solic_mante.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
</div>
<center>
<div id="GeneralManSolicaa">
<?php
$_SESSION['form_buffer'] = $_POST;
$consul = 0;
$numero = 0;
if ($_SESSION["validar"] == 0 ) {
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
if(isset($datos['com_e'])){     
   $datos['com_e'] = number_format($datos['com_e'], 2, '.',',');
   }
}
//if ($_SESSION["continuar"] == 2 ) {
if(isset($_POST['cod_sol'])){   
   $quecom = $_POST['cod_sol'];
 
   for ($i=0; $i < count($quecom); $i = $i + 1 ) {
       if (isset($quecom[$i]) ) {
          $nro_sol = $quecom[$i];
	      $_SESSION['nro_sol'] = $nro_sol;
       }
   }
  }
  $consulta  = "Select count(*)  From cred_deudor 
 where CRED_SOL_CODIGO = $nro_sol and CRED_DEU_RELACION = 'C' and CRED_DEU_USR_BAJA is null ";
    $res_trc = mysql_query($consulta);
	while ($lin_trc = mysql_fetch_array($res_trc)) {
         $cuantos =  $lin_trc['count(*)'];
      }
	if ($cuantos == 0){  
	   echo $cuantos." res";
	    $_SESSION["tot_err"] = 1;
	    header('Location: cliente_con_opo.php');
	}
  
  
//  $con_comf  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 913 and GRAL_PAR_PRO_COD <> 0 ";
 //  $res_comf = mysql_query($con_comf)or die('No pudo seleccionarse tabla')  ;
 //  $con_ahof  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 914 and GRAL_PAR_PRO_COD <> 0 ";
 //  $res_ahof = mysql_query($con_ahof)or die('No pudo seleccionarse tabla')  ;
   $con_sol  = "Select * From cred_solicitud where CRED_SOL_CODIGO = $nro_sol and CRED_SOL_USR_BAJA is null"; 
   $res_sol = mysql_query($con_sol)or die('No pudo seleccionarse solicitud 2');
   while ($lin_sol = mysql_fetch_array($res_sol)) {
         $t_op = $lin_sol['CRED_SOL_TIPO_OPER']; 
		 $impo = $lin_sol['CRED_SOL_IMPORTE'];
		 $mon  = $lin_sol['CRED_SOL_COD_MON'];
		 $comi  = $lin_sol['CRED_SOL_TIP_COM'];
		 $comif = $lin_sol['CRED_SOL_COM_F'];
		 $ahod  = $lin_sol['CRED_SOL_AHO_DUR'];
		 $ahoi  = $lin_sol['CRED_SOL_AHO_INI'];
		 $con_mon = "Select GRAL_PAR_INT_DESC  From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and                     GRAL_PAR_INT_COD = $mon ";
         $res_mon = mysql_query($con_mon)or die('No pudo seleccionarse tabla')  ;
		  while ($lin_mon = mysql_fetch_array($res_mon)) {
		        $mon_d = $lin_mon['GRAL_PAR_INT_DESC'];
		  }
	 	 $con_com = "Select GRAL_PAR_PRO_DESC,GRAL_PAR_PRO_CTA1 From gral_param_propios where GRAL_PAR_PRO_GRP = 913 and GRAL_PAR_PRO_COD = $comi ";
         $res_com = mysql_query($con_com)or die('No pudo seleccionarse tabla')  ;
		  while ($lin_com = mysql_fetch_array($res_com)) {
		        $com_d = $lin_com['GRAL_PAR_PRO_DESC'];
				$com_f = $lin_com['GRAL_PAR_PRO_CTA1'];
		  }
		   $con_comf = "Select GRAL_PAR_PRO_DESC,GRAL_PAR_PRO_CTA1 From gral_param_propios where GRAL_PAR_PRO_GRP = 911                    and GRAL_PAR_PRO_COD = $comif ";
         $res_comf = mysql_query($con_comf)or die('No pudo seleccionarse tabla comif')  ;
		  while ($lin_comf = mysql_fetch_array($res_comf)) {
		        $comf_d = $lin_comf['GRAL_PAR_PRO_DESC'];
				}
		  
		  $con_ahod = "Select GRAL_PAR_PRO_DESC  From gral_param_propios where GRAL_PAR_PRO_GRP = 912 and                     GRAL_PAR_PRO_COD = $ahod ";
         $res_ahod = mysql_query($con_ahod)or die('No pudo seleccionarse tabla')  ;
		  while ($lin_ahod = mysql_fetch_array($res_ahod)) {
		        $aho_d = $lin_ahod['GRAL_PAR_PRO_DESC'];
		  }
	 	}
	$imp_c = $impo * $com_f;	
	if ($comif == 2){
	    $imp_sc = $impo + $imp_c;
		}else{
		$imp_sc = $impo;
		}	
?>  
<form name="form1" method="post" action="solic_retro_sol.php" style="border:groove" target="_self"  >
<table align="center" border="1">
	<tr>
	    <td> <strong> Solicitud </strong></td>
        <td> <?php  echo $nro_sol, "  "; ?></td>
        <td><strong> Importe Solicitado </strong></td>
        <td align="right"><?php $_SESSION["impo_sol"] = $impo;
	        $impo = number_format($impo, 2, '.',','); 
            echo $impo;?> </td>
		<td><strong> Moneda </strong></td>
        <td><?php $_SESSION["mon_d"] = $mon_d;
            echo $mon_d; ?></td>
  </tr>
  <tr>
	    <td><strong> Comision </strong></td>
        <td align="right"><?php echo $com_d;?></td>
        <td><strong> Calculo Comision </strong></td>
        <td><?php echo $comf_d; ?></td>
		<td><?php echo encadenar(5); ?></td>
		<td><?php echo encadenar(5); ?></td>
</tr>
<tr>		
    <td><strong> Fondo Garantia Ciclo </strong></td>
    <td><?php $_SESSION["aho_d"] =  $ahod; 
              echo $ahod. " %";?></td>
    <td><strong> Fondo Garantia  Inicio </strong></td>
    <td align="right"><?php $_SESSION["aho_i"] = $ahoi;  
        echo $ahoi. "%"; ?></td>
	<td><?php echo encadenar(5); ?></td>
	<td><?php echo encadenar(5); ?></td>
</tr>
</table>
	
    <?php
  if ($ahod == 1) {
  ?>
   <strong>Fondo Garantia Ciclo  </strong>
  <select name="aho_f" size="1"  >
  	  <?php
        while ($linea = mysql_fetch_array($res_ahof)) {
      ?>
    <option value=<?php echo $linea['GRAL_PAR_PRO_COD']; ?>><?php echo $linea['GRAL_PAR_PRO_DESC']; ?> </option>
	  <?php
  }
  }
  ?>
  </select> 
   <?php
   if ($ahod == 2) {
     ?>
    <strong>Ahorro Durante </strong>
    <input type= type="text" name="aho_fi" value="<?=$datos['aho_fi'];?>" > 
  	<?php
    }
$consulta  = "Select CRED_DEU_INTERNO, CLIENTE_COD_ID,CLIENTE_AP_PATERNO, CLIENTE_AP_MATERNO,CLIENTE_AP_ESPOSO,
 CLIENTE_NOMBRES, CRED_DEU_RELACION,CRED_DEU_IMPORTE  From cliente_general, cred_deudor 
 where CRED_SOL_CODIGO = $nro_sol and CRED_DEU_INTERNO = CLIENTE_COD and CRED_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null";
    $resultado = mysql_query($consulta);
    ?>
<br>
</center>
<font size="+0">
<table align="center">

<?php
$cont = 1;
while ($linea = mysql_fetch_array($resultado)) {
        
		$r = "";
	if ($linea['CLIENTE_AP_MATERNO'] == ""){
	    $linea['CLIENTE_AP_MATERNO'] = " ";
		}
	if (isset($linea['CLIENTE_AP_ESPOSO'])){
	    $s = $linea['CLIENTE_AP_PATERNO']." ". $linea['CLIENTE_AP_MATERNO']." ".
		     $linea['CLIENTE_AP_ESPOSO']." ".$linea['CLIENTE_NOMBRES'];
		}else{
		$s = $linea['CLIENTE_AP_PATERNO']." ". $linea['CLIENTE_AP_MATERNO']." ".
		     $linea['CLIENTE_NOMBRES'];	
		} 
		$nro = strlen($s);
		$nray2 = 50 - $nro;
		//$nray2 = ($nray - $nro)/2;
		//echo $nro, $nray2;
		//for ($i = 1; $i <= $nray; $i++) {
        //    $r = $r."-";
		 ?>
	<tr> 
	   
		<td align="center"><?php echo $linea['CRED_DEU_RELACION'];?></td>
		<td><?php echo $s;?></td>
            <?php		
              if ($cont == 1) {
                 $_SESSION["cli_1"] = $linea['CRED_DEU_INTERNO'];
	             // echo encadenar($nray2);
             ?>
	   <td><?php echo encadenar(5);?></td> 
    	 
        <td><?php if(isset($datos['imp_1'])){?>
            <input type="text"  style align="center" name="imp_1" width="10"  size="20" value="<?=$datos['imp_1'];?>" >
	        <?php }else{?>
	        <input type="text"  style align="center" name="imp_1" width="10"  size="20" value="" >
	        <?php }?></td>  
            <?php
             }
            ?>
			
          <?php		
           if ($cont == 2) {
              $_SESSION["cli_2"] = $linea['CRED_DEU_INTERNO'];
	  // echo encadenar($nray2);
           ?>
		<td><?php echo encadenar(5);?></td> 
        <td><?php if(isset($datos['imp_2'])){?>
            <input type="text" name="imp_2" width="10" value= "<?=$datos['imp_2'];?>" >
            <?php }else{?>
            <input type="text" name="imp_2" width="10" value= "" >
            <?php }?></td>
            <?php
             }
            ?>	
          <?php		
           if ($cont == 3) {
              $_SESSION["cli_3"] = $linea['CRED_DEU_INTERNO'];
	          // echo encadenar($nray2);
            ?>
			<td><?php echo encadenar(5);?></td> 
            <td><?php if(isset($datos['imp_3'])){?>
                <input type="text" name="imp_3" width="10" value= "<?=$datos['imp_3'];?>" >
                <?php }else{?>
                <input type="text" name="imp_3" width="10" value= "" >
	            <?php }?> </td>
             <?php
               }
             ?>	
           <?php		
           if ($cont == 4) {
              $_SESSION["cli_4"] = $linea['CRED_DEU_INTERNO'];
	          //  echo encadenar($nray2);
           ?>
		   <td><?php echo encadenar(5);?></td> 
           <td><?php if(isset($datos['imp_4'])){?>
               <input type="text" name="imp_4" width="10" value= "<?=$datos['imp_4'];?>" >
               <?php }else{?>
               <input type="text" name="imp_4" width="10" value= "" >
               <?php }?></td>
           <?php
             }
           ?>
           <?php		
           if ($cont == 5) {
              $_SESSION["cli_5"] = $linea['CRED_DEU_INTERNO'];
	          //  echo encadenar($nray2);
              ?>
			<td><?php echo encadenar(5);?></td>   
            <td><?php if(isset($datos['imp_5'])){?>
                <input type="text" name="imp_5" width="10" value= "<?=$datos['imp_5'];?>" >
                <?php }else{?>
                <input type="text" name="imp_5" width="10" value= "" > 
                <?php }?></td>
             <?php
               }
             ?>	
           <?php		
           if ($cont == 6) {
              $_SESSION["cli_6"] = $linea['CRED_DEU_INTERNO'];
	          //echo encadenar($nray2);
             ?>
			<td><?php echo encadenar(5);?></td>    
            <td><?php if(isset($datos['imp_6'])){?>
                <input type="text" name="imp_6" width="10" value= "<?=$datos['imp_6'];?>" >
                <?php }else{?>
                <input type="text" name="imp_6" width="10" value= "" >
                <?php }?></td>
             <?php
              }
             ?>	
             <?php		
             if ($cont == 7) {
                 $_SESSION["cli_7"] = $linea['CRED_DEU_INTERNO'];
	             //echo encadenar($nray2);
              ?>
			  <td><?php echo encadenar(5);?></td> 
              <td><?php if(isset($datos['imp_7'])){?>
                  <input type="text" name="imp_7" width="10" value= "<?=$datos['imp_7'];?>" >
                  <?php }else{?>
                  <input type="text" name="imp_7" width="10" value= "" >
                  <?php }?></td>
              <?php
                }
               ?>	
               <?php		
               if ($cont == 8) {
                  $_SESSION["cli_8"] = $linea['CRED_DEU_INTERNO'];
	              // echo encadenar($nray2);
                  ?>
				  <td><?php echo encadenar(5);?></td> 
                  <td><?php if(isset($datos['imp_8'])){?>
                  <input type="text" name="imp_8" width="10" value= "<?=$datos['imp_8'];?>" >
                  <?php }else{?>
                  <input type="text" name="imp_8" width="10" value= "" >
                  <?php }?></td>
                 <?php
                    }
                 ?>
                 <?php		
                 if ($cont == 9) {
                    $_SESSION["cli_9"] = $linea['CRED_DEU_INTERNO'];
	                //echo encadenar($nray2);
                 ?>
				 <td><?php echo encadenar(5);?></td>
                 <td><?php if(isset($datos['imp_9'])){?>
                 <input type="text" name="imp_9" width="10" value= "<?=$datos['imp_9'];?>" >
                 <?php }else{?>
                 <input type="text" name="imp_9" width="10" value= "" >
                 <?php }?></td>
                 <?php
                   }
                 ?>	
                 <?php		
                 if ($cont == 10) {
                     $_SESSION["cli_10"] = $linea['CRED_DEU_INTERNO'];
	                 // echo encadenar($nray2);
                     ?>
				  <td><?php echo encadenar(5);?></td> 
                  <td><?php if(isset($datos['imp_10'])){?>
                  <input type="text" name="imp_10" width="10" value= "<?=$datos['imp_10'];?>" >
                  <?php }else{?>
                   <input type="text" name="imp_10" width="10" value= "" >
                  <?php }?></td>
                  <?php
                    }
                   ?>	
                  <?php		
                   if ($cont == 11) {
                      $_SESSION["cli_11"] = $linea['CRED_DEU_INTERNO'];
	                  // echo encadenar($nray2);
                     ?>
					<td><?php echo encadenar(5);?></td> 
                    <td><?php if(isset($datos['imp_11'])){?>
                    <input type="text" name="imp_11" width="10" value= "<?=$datos['imp_11'];?>" >
                    <?php }else{?>
                    <input type="text" name="imp_11" width="10" value= "" >
                    <?php }?></td>
                    <?php
                      }
                    ?>	
                   <?php		
                   if ($cont == 12) {
                      $_SESSION["cli_12"] = $linea['CRED_DEU_INTERNO'];
	                  // echo encadenar($nray2);
                    ?>
					<td><?php echo encadenar(5);?></td> 
                    <td><?php if(isset($datos['imp_12'])){?>
                    <input type="text" name="imp_12" width="10" value= "<?=$datos['imp_12'];?>" >
                    <?php }else{?>
                     <input type="text" name="imp_12" width="10" value= "" >
                    <?php }?></td>
                    <?php
                      }
                    ?>	
                    <?php		
                     if ($cont == 13) {
                        $_SESSION["cli_13"] = $linea['CRED_DEU_INTERNO'];
	                    //echo encadenar($nray2);
                      ?>
					 <td><?php echo encadenar(5);?></td> 
                     <td><?php if(isset($datos['imp_13'])){?>
                     <input type="text" name="imp_13" width="10" value= "<?=$datos['imp_13'];?>" >
                     <?php }else{?>
                     <input type="text" name="imp_13" width="10" value= "" >
                     <?php }?></td>
                     <?php
                         }
                      ?>
                      <?php		
                      if ($cont == 14) {
                          $_SESSION["cli_14"] = $linea['CRED_DEU_INTERNO'];
	                      // echo encadenar($nray2);
                       ?>
					   <td><?php echo encadenar(5);?></td>
                       <td><?php if(isset($datos['imp_14'])){?>
                       <input type="text" name="imp_14" width="10" value= "<?=$datos['imp_14'];?>" >
                       <?php }else{?>
                       <input type="text" name="imp_14" width="10" value= "" >
                       <?php }?></td>
                       <?php
                          }
                       ?>	
                       <?php		
                       if ($cont == 15) {
                           $_SESSION["cli_15"] = $linea['CRED_DEU_INTERNO'];
	                        //echo encadenar($nray2);
                        ?>
						<td><?php echo encadenar(5);?></td>
                        <td><?php if(isset($datos['imp_15'])){?>
                        <input type="text" name="imp_15" width="10" value= "<?=$datos['imp_15'];?>" >
                        <?php }else{?>
                        <input type="text" name="imp_15" width="10" value= "" >
                        <?php }?></td>
                        <?php
                           }
                         ?>
                        <?php		
                        if ($cont == 16) {
                           $_SESSION["cli_16"] = $linea['CRED_DEU_INTERNO'];
	                       //echo encadenar($nray2);
                        ?>
						<td><?php echo encadenar(5);?></td>
                        <td><?php if(isset($datos['imp_16'])){?>
                        <input type="text" name="imp_16" width="10" value= "<?=$datos['imp_16'];?>" >
                        <?php }else{?>
                        <input type="text" name="imp_16" width="10" value= "" >
                        <?php }?></td>
                        <?php
                         }
                        ?>	
                        <?php		
                        if ($cont == 17) {
                           $_SESSION["cli_17"] = $linea['CRED_DEU_INTERNO'];
	                       // echo encadenar($nray2);
                        ?>
						<td><?php echo encadenar(5);?></td>
                        <td><?php if(isset($datos['imp_17'])){?>
                        <input type="text" name="imp_17" width="10" value= "<?=$datos['imp_17'];?>" >
                        <?php }else{?>
                        <input type="text" name="imp_17" width="10" value= "" > 
                        <?php }?></td>
                        <?php
                          }
                        ?>
                        <?php		
                        if ($cont == 18) {
                           $_SESSION["cli_18"] = $linea['CRED_DEU_INTERNO'];
	                       //  echo encadenar($nray2);
                        ?>
						<td><?php echo encadenar(5);?></td>
                        <td><?php if(isset($datos['imp_18'])){?>
                        <input type="text" name="imp_18" width="10" value= "<?=$datos['imp_18'];?>" >
                        <?php }else{?>
                        <input type="text" name="imp_18" width="10" value= "" >
                        <?php }?></td>
                        <?php
                           }
                        ?>	
                        <?php		
                        if ($cont == 19) {
                           $_SESSION["cli_19"] = $linea['CRED_DEU_INTERNO'];
	                       // echo encadenar($nray2);
                         ?>
						 <td><?php echo encadenar(5);?></td>
                         <td><?php if(isset($datos['imp_19'])){?>
                         <input type="text" name="imp_19" width="10" value= "<?=$datos['imp_19'];?>" >
                         <?php }else{?>
                         <input type="text" name="imp_19" width="10" value= "" > 
                         <?php }?></td>
                         <?php
                           }
                          ?>	
	                      <?php		
                          if ($cont == 20) {
                             $_SESSION["cli_20"] = $linea['CRED_DEU_INTERNO'];
	                          //echo encadenar($nray2);
                           ?>
						   <td><?php echo encadenar(5);?></td>
                           <td><?php if(isset($datos['imp_20'])){?>
                           <input type="text" name="imp_20" width="10" value= "<?=$datos['imp_20'];?>" >
                           <?php }else{?>
                           <input type="text" name="imp_20" width="10" value= "" >
                           <?php }?></td>
                           <?php
                             }
                           ?>
                         <?php		
                         if ($cont == 21) {
                            $_SESSION["cli_21"] = $linea['CRED_DEU_INTERNO'];
	                        //  echo encadenar($nray2);
                          ?>
						  <td><?php echo encadenar(5);?></td>
                          <td><?php if(isset($datos['imp_21'])){?>
                          <input type="text" name="imp_21" width="10" value= "<?=$datos['imp_21'];?>" >
                          <?php }else{?>
                          <input type="text" name="imp_21" width="10" value= "" >
                          <?php }?></td>
                          <?php
                             }
                           ?> 
                          <?php		
                          if ($cont == 22) {
                             $_SESSION["cli_22"] = $linea['CRED_DEU_INTERNO'];
	                         //echo encadenar($nray2);
                          ?>
                          <td><?php echo encadenar(5);?></td>
                          <td><?php if(isset($datos['imp_22'])){?>
                          <input type="text" name="imp_22" width="10" value= "<?=$datos['imp_22'];?>" > 
                          <?php }else{?>
                          <input type="text" name="imp_22" width="10" value= "" > 
                          <?php }?></td>
                          <?php
                             }
                          ?> 
                          <?php		
                          if ($cont == 23) {
                             $_SESSION["cli_23"] = $linea['CRED_DEU_INTERNO'];
	                         // echo encadenar($nray2);
                           ?>
                           <td><?php echo encadenar(5);?></td>
                           <td><?php if(isset($datos['imp_23'])){?>
                           <input type="text" name="imp_23" width="10" value= "<?=$datos['imp_23'];?>" >
                           <?php }else{?>
                           <input type="text" name="imp_23" width="10" value= "" >
                           <?php }?></td>
                           <?php
                            }
                           ?>
                           <?php		
                           if ($cont == 24) {
                               $_SESSION["cli_24"] = $linea['CRED_DEU_INTERNO'];
	                           //  echo encadenar($nray2);
                            ?>
                            <td><?php echo encadenar(5);?></td>
                            <td><?php if(isset($datos['imp_24'])){?>
                            <input type="text" name="imp_24" width="10" value= "<?=$datos['imp_24'];?>" >
                            <?php }else{?>
                            <input type="text" name="imp_24" width="10" value= "" >
                            <?php }?></td>
                            <?php
                              }
                             ?>
                             <?php		
                             if ($cont == 25) {
                                $_SESSION["cli_25"] = $linea['CRED_DEU_INTERNO'];
	                            //   echo encadenar($nray2);
                             ?>
                             <td><?php echo encadenar(5);?></td>
                             <td><?php if(isset($datos['imp_25'])){?>
                             <input type="text" name="imp_25" width="10" value= "<?=$datos['imp_25'];?>" >
                             <?php }else{?>
	                         <input type="text" name="imp_25" width="10" value= "" >
                             <?php }?></td>
                             <?php
                                }
                              ?>					

                             <?php	
                             $cont = $cont + 1;
                             }
                             ?>
                             </center>
                             <strong>
        </tr>
		   
									 
          <font color="#FF0000">
          <?php
          if ($_SESSION["tot_err"] == 1) {
		   ?>
		  <td bgcolor="#FF0000"><?php	echo "Total Diferente a Monto Solicitado";?></td>
		  <td><?php echo encadenar(5);?></td>
          <td align="right"><?php	echo number_format($_SESSION["total_s"], 2, '.',',');?></td>
          <?php $_SESSION['error'] = "";?>
          </font>
          <?php
          }else{?>
          <td><?php echo "Total Solicitado";?></td>
		  <td><?php echo encadenar(5);?></td>
          <td align="right"><?php echo number_format($_SESSION["total_s"], 2, '.',',');?></td>
          <?php
            }
          ?>
	</tr>	  
</strong>	
</font>
<center>	
<tr> 
<td><input type="submit" name="accion" value="Siguiente-Paso"></td>
<td><?php echo encadenar(5);?></td>
<td><input type="submit" name="accion" value="Salir"></td>
</tr>
 </table>	
</form>
 <div id="FooterTable">
<BR><B><FONT SIZE=+2><MARQUEE>Ingrese los Montos a cada Cliente</MARQUEE></FONT></B>
</div>
   <?php
		 	include("footer_in.php");
	 ?> 
<?php
}
    ob_end_flush();
 ?>	