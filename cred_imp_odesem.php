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
//	$fec = leer_param_gral();
?>
<?php
 $fec = leer_param_gral();
 $logi = $_SESSION['login']; 
 $comi_f = 0;
?>
<html>
<head>
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <a href='solic_mante.php'>Salir</a>
  </div>

<center>
<?php
//$_SESSION['form_buffer'] = $_POST;
if(isset($_SESSION['login'])){
  $log_usr = $_SESSION['login']; 
  }
if(isset($_SESSION["impo_sol"])){  
  $imp_sol = $_SESSION["impo_sol"];
  }
//$cod_sol = $_SESSION['nro_sol'];
$total = 0;
$quecom = 0;
if ( $_SESSION['continuar'] == 2) {
  if(isset($_POST['cod_sol'])){   
     $quecom = $_POST['cod_sol'];
}	 
   for ($i=0; $i < count($quecom); $i = $i + 1 ) {
       if (isset($quecom[$i]) ) {
          $cod_sol = $quecom[$i];
	      $_SESSION['nro_sol'] = $cod_sol;
       }
   } 
   }else{
   $cod_sol = $_SESSION['nro_sol'];
   }
   $tot_int = 0;
//Seleccion solicitud
$grupo = 0;
$con_sol  = "Select * From cred_solicitud where CRED_SOL_CODIGO = $cod_sol and CRED_SOL_USR_BAJA is null"; 
$res_sol = mysql_query($con_sol)or die('No pudo seleccionarse solicitud 2');
   while ($lin_sol = mysql_fetch_array($res_sol)) {
         $t_op = $lin_sol['CRED_SOL_TIPO_OPER']; 
		 $impo = $lin_sol['CRED_SOL_IMPORTE'];
		 $imp_c = $lin_sol['CRED_SOL_IMP_COM'];
		 $comif = $lin_sol['CRED_SOL_COM_F'];
		 $imp_sc = $impo + $imp_c;
		 $mon  = $lin_sol['CRED_SOL_COD_MON'];
		 $comi  = $lin_sol['CRED_SOL_TIP_COM'];
		 $ahod  = $lin_sol['CRED_SOL_AHO_DUR'];
		 $ahoi  = $lin_sol['CRED_SOL_AHO_INI'];
		 $tint  = $lin_sol['CRED_SOL_TASA'];
		 $plzm  = $lin_sol['CRED_SOL_PLZO_M'];
		 $plzd  = $lin_sol['CRED_SOL_PLZO_D'];
		 $com_f  = $lin_sol['CRED_SOL_TIP_COM']; 
		 $aho_f  = $lin_sol['CRED_SOL_AHO_F'];
		 $aho_fm  = $lin_sol['CRED_SOL_AHO_DM'];
		 $f_pag  = $lin_sol['CRED_SOL_FORM_PAG']; 
		 $f_des  = $lin_sol['CRED_SOL_FEC_DES'];
		 $f_uno  = $lin_sol['CRED_SOL_FEC_UNO'];
		 $c_int = $lin_sol['CRED_SOL_CAL_INT'];
		 $p_int = $lin_sol['CRED_SOL_AHO_F'];  
		 $cuotas = $lin_sol['CRED_SOL_NRO_CTA'];
		 $grupo = $lin_sol['CRED_SOL_COD_GRUPO'];
		 $impo_aho = ($lin_sol['CRED_SOL_IMPORTE']*$ahoi)/100;
		 $of_resp  = $lin_sol['CRED_SOL_OF_RESP'];
		 $nom_ases = leer_nombre_usr(1,$of_resp);
		 $f_des2= cambiaf_a_normal($f_des); 
		 $f_uno2= cambiaf_a_normal($f_uno); 
   }
  //Calculo Interes
	   $con_cin = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 10 and GRAL_PAR_INT_COD = $c_int";
       $res_cin = mysql_query($con_cin)or die('No pudo seleccionarse tabla 1')  ;
	   while ($linea = mysql_fetch_array($res_cin)) {
	        $d_cin = $linea['GRAL_PAR_INT_DESC'];
	   }
$con_pin = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 11 and GRAL_PAR_INT_COD = $p_int";
       $res_pin = mysql_query($con_pin)or die('No pudo seleccionarse tabla 1')  ;
	   while ($linea = mysql_fetch_array($res_pin)) {
	        $d_pin = $linea['GRAL_PAR_INT_DESC'];
	   } 	   
	   
	   
       $con_top = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 21 and GRAL_PAR_INT_COD = $t_op";
       $res_top = mysql_query($con_top)or die('No pudo seleccionarse tabla 1')  ;
	   while ($linea = mysql_fetch_array($res_top)) {
	        $d_top = $linea['GRAL_PAR_INT_DESC'];
	   }
	   $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD = $mon";
       $res_mon = mysql_query($con_mon)or die('No pudo seleccionarse tabla 1')  ;
	   while ($linea = mysql_fetch_array($res_mon)) {
	        $d_mon = $linea['GRAL_PAR_INT_DESC'];
	   }
         $con_ahod = "Select GRAL_PAR_PRO_DESC  From gral_param_propios where GRAL_PAR_PRO_GRP = 912 and                     GRAL_PAR_PRO_COD = $ahod ";
         $res_ahod = mysql_query($con_ahod)or die('No pudo seleccionarse tabla 2')  ;
		  while ($lin_ahod = mysql_fetch_array($res_ahod)) {
		        $aho_d = $lin_ahod['GRAL_PAR_PRO_DESC'];
		  } 
          $con_fpa = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 13 and GRAL_PAR_INT_COD = $f_pag";
          $res_fpa = mysql_query($con_fpa)or die('No pudo seleccionarse tabla 3')  ;
          while ($lin_fpa = mysql_fetch_array($res_fpa)) {
		        $nro_d = $lin_fpa['GRAL_PAR_INT_CTA1'];
				$fpag_d = $lin_fpa['GRAL_PAR_INT_DESC'];
		  } 
if ($comi < 3){
    $con_comf  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 913 and GRAL_PAR_PRO_COD = $com_f ";
    $res_comf = mysql_query($con_comf)or die('No pudo seleccionarse tabla 4')  ;
	while ($lin_comf = mysql_fetch_array($res_comf)) {
	      $comi_f  = $lin_comf['GRAL_PAR_PRO_CTA1'];
		  $comi_p  = $lin_comf['GRAL_PAR_PRO_DESC'];
	}
  }
 if ($ahod == 1){
    $con_ahof  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 914 and GRAL_PAR_PRO_COD = $aho_f ";
    $res_ahof = mysql_query($con_ahof)or die('No pudo seleccionarse tabla 5')  ;
	while ($lin_ahof = mysql_fetch_array($res_ahof)) {
	      $aho_fa  = $lin_ahof['GRAL_PAR_PRO_CTA1'];
		  $aho_fd  = $lin_ahof['GRAL_PAR_PRO_DESC'];
	}
  }
	 ?>
	<br>
	<strong> DESEMBOLSO DE CREDITO
	<BR>
    </strong>
   <br><br>
  
  
   <table border="0" width="700">
	<tr>
	 	    <th align="left" style="font-size:14px" ><?php echo "Solicitud" ; ?></td>
		    <td align="left" style="font-size:12px"><?php echo $cod_sol; ?></td>
			<th align="left" style="font-size:14px"><?php echo encadenar(5); ?></td>
			<th align="left" style="font-size:14px" ><?php echo "Tipo Operacion" ; ?></td>
		    <td align="left" style="font-size:12px"><?php echo $d_top; ?></td>
		</tr>
		<?php 
/*  
      $con_g_nom  = "Select CRED_GRP_NOMBRE from cred_grupo where 
	                 CRED_GRP_CODIGO = $grupo and CRED_GRP_USR_BAJA is null ";
      $res_g_nom = mysql_query($con_g_nom);
      while ($lin_g_nom = mysql_fetch_array($res_g_nom)) {
            $nom_grp = $lin_g_nom ['CRED_GRP_NOMBRE'];
	        }
	 $con_grupo  = "Select CLIENTE_COD_ID,CLIENTE_AP_PATERNO, CLIENTE_AP_MATERNO, CLIENTE_NOMBRES, CRED_GRP_MES_REL
	                From cliente_general, cred_grupo, cred_grupo_mesa where CRED_GRP_CODIGO = $grupo and
					CRED_GRP_MES_COD = $grupo  and CRED_GRP_MES_CLI = CLIENTE_COD and  CRED_GRP_MES_REL = 1 and
					CRED_GRP_USR_BAJA is null and CLIENTE_USR_BAJA is null";
     $res_grupo = mysql_query($con_grupo);
	 
	 while ($lin_grp = mysql_fetch_array($res_grupo)) {
            $nom_coor = $lin_grp ['CLIENTE_NOMBRES'].encadenar(2).$lin_grp ['CLIENTE_AP_PATERNO'].
               encadenar(2).$lin_grp ['CLIENTE_AP_MATERNO'];
        } */	
			?>
	<tr>
	<?php      
//	if ($t_op < 3) {
        $con_grupo  = "Select CLIENTE_COD_ID,CLIENTE_AP_PATERNO, CLIENTE_AP_MATERNO, CLIENTE_NOMBRES
	                   From cliente_general, cred_deudor where CRED_SOL_CODIGO = $cod_sol
					   and CRED_DEU_INTERNO = CLIENTE_COD and  CRED_DEU_RELACION = 'C' and
					   CRED_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null";
     $res_grupo = mysql_query($con_grupo);
	 
	 while ($lin_grp = mysql_fetch_array($res_grupo)) {
            $nom_coor = $lin_grp ['CLIENTE_NOMBRES'].encadenar(2).$lin_grp ['CLIENTE_AP_PATERNO'].
               encadenar(2).$lin_grp ['CLIENTE_AP_MATERNO'];
       }	
	  
	    if ($grupo > 0){ 
		 $con_g_nom  = "Select CRED_GRP_NOMBRE from cred_grupo where 
	                 CRED_GRP_CODIGO = $grupo and CRED_GRP_USR_BAJA is null ";
      $res_g_nom = mysql_query($con_g_nom);
      while ($lin_g_nom = mysql_fetch_array($res_g_nom)) {
            $nom_grp = $lin_g_nom ['CRED_GRP_NOMBRE'];
	        }
		
		
		
		?>	
	 	    <th align="left" style="font-size:14px" ><?php echo "Grupo" ; ?></td>
			
		    <td align="left" style="font-size:12px"><?php echo  $nom_grp; ?></td>
			<th align="left" style="font-size:14px"><?php echo encadenar(5); ?></td>
			<th align="left" style="font-size:14px"><?php echo "Coordinador" ; ?></td>
			<?php if (isset($nom_coor)){ ?>	
		    <td align="left" style="font-size:12px"><?php echo $nom_coor; ?></td>
			<?php }else{ ?>
			 <td align="left" style="font-size:12px"><?php echo encadenar(2); ?></td>
			<?php } ?>	
		</tr>
		<?php //} 
	        }else{
	  
	  
	  
	  
			?>
	<tr>
	 	    <th align="left" style="font-size:14px" ><?php echo "Credito" ; ?></td>
		    <td align="left" style="font-size:12px"><?php echo  "Individual"; ?></td>
			<th align="left" style="font-size:14px"><?php echo encadenar(5); ?></td>
			<th align="left" style="font-size:14px"><?php echo "Deudor" ; ?></td>
		    <td align="left" style="font-size:12px"><?php echo $nom_coor; ?></td>
		</tr>
		<?php } //} ?>	
	<tr>
	 	    <th align="left" style="font-size:14px" ><?php echo "Imp. Solicitado" ; ?></td>
		    <td align="right" style="font-size:12px"><?php echo  number_format($impo, 2, '.',','); ?></td>
			<th align="left" style="font-size:14px"><?php echo encadenar(5); ?></td>
			<th align="left" style="font-size:14px"><?php echo "Comision" ; ?></td>
		    <td align="left" style="font-size:12px"><?php echo number_format($imp_c, 2, '.',',')
			                                              .encadenar(4).$comi_f*100 .encadenar(1)."%"; ?></td>
		</tr>	
		<tr>
	 	    <th align="left" style="font-size:14px" ><?php echo "Fgar.Inicio" ; ?></td>
		    <td align="right" style="font-size:12px"><?php echo  number_format($impo_aho , 2, '.',','); ?></td>
			<th align="left" style="font-size:14px"><?php echo encadenar(5); ?></td>
			<th align="left" style="font-size:14px"><?php echo "Asesor"; ?></td>
		    <td align="left" style="font-size:12px"><?php echo $nom_ases; ?></td>
		</tr>	
		<tr>
	 	    <th align="left" style="font-size:14px" ><?php echo "Fecha Desembolso" ; ?></td>
		    <td align="right" style="font-size:12px"><?php echo  $f_des2; ?></td>
			<th align="left" style="font-size:14px"><?php echo encadenar(5); ?></td>
			<th align="left" style="font-size:14px"><?php echo "Moneda"; ?></td>
		    <td align="left" style="font-size:12px"><?php echo $d_mon; ?></td>
		</tr>	
		
		
	</table>	
   
 <?php 
  ?>
 
<?php	
$consulta  = "Select CRED_DEU_INTERNO, CLIENTE_COD_ID,CLIENTE_AP_PATERNO, CLIENTE_AP_MATERNO, CLIENTE_NOMBRES, CRED_DEU_RELACION,CRED_DEU_IMPORTE, CRED_DEU_COMISION, CRED_DEU_AHO_INI, CRED_DEU_AHO_DUR, CRED_DEU_INT_CTA, CRED_DEU_USR_BAJA From cliente_general, cred_deudor where CRED_SOL_CODIGO = $cod_sol and CRED_DEU_INTERNO = CLIENTE_COD and CRED_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null";
    $resultado = mysql_query($consulta);
	
	
	
 ?>		
	<table border="1" cellpadding="10" cellspacing="4">
	<tr>
	 <?php if ($p_int <> 4){ ?>
	    <th> # </th>
	   	<th>Deudor</th>
		<th>Monto Solicitado</th>
		<th>Comisión</th>
		<th>Fondo Garantia</th>
		<th>Monto Entregado</th>
		<th>Firma Deudor</th>
		<?php }else{ ?>
		 <th> # </th>
	   	<th>Deudor</th>
		<th>Monto Solicitado</th>
		<th>Interes</th>
		<th>Comisión</th>
		<th>Monto Entregado</th>
		<th>Firma Deudor</th>
		<?php } ?>
	</tr>
<?php
$tot_sol = 0;
$tot_com = 0;
$tot_aho = 0;
$nro = 0;

while ($linea = mysql_fetch_array($resultado)) {
       $deudor = $linea['CLIENTE_AP_PATERNO'].encadenar(2).$linea['CLIENTE_AP_MATERNO'].
	             encadenar(2).$linea['CLIENTE_NOMBRES'];
	   $tot_sol = $tot_sol + $linea['CRED_DEU_IMPORTE'];
       $tot_com = $tot_com + $linea['CRED_DEU_COMISION'];
       $tot_aho = $tot_aho + $linea['CRED_DEU_AHO_INI'];
	    $tot_int = $tot_int + $linea['CRED_DEU_INT_CTA'];
	    $nro = $nro + 1;				 
				 
	 ?>
	 <tr>
	    <td align="center"><?php echo $nro; ?></td>
	 	<td style="font-size:12px"><?php echo $deudor; ?></td>
		
	        <?php if ($comif == 2){ ?>	
		<td align="right"><?php echo number_format($linea['CRED_DEU_IMPORTE'] + $linea['CRED_DEU_COMISION'], 2, '.',','); ?></td>
		
		    <?php } ?>
			<?php if ($comif == 1){ ?>	
		<td align="right"><?php echo number_format($linea['CRED_DEU_IMPORTE'], 2, '.',',') ; ?></td>
		    <?php } ?>
		 <?php if ($p_int <> 4){ ?>		
		<td align="right"><?php echo number_format($linea['CRED_DEU_COMISION'], 2, '.',',') ; ?></td>
		<td align="right"><?php echo number_format($linea['CRED_DEU_AHO_INI'], 2, '.',',') ; ?></td>
		<td align="right"><?php echo number_format($linea['CRED_DEU_IMPORTE'] -
		                                           $linea['CRED_DEU_COMISION'] -
												   $linea['CRED_DEU_AHO_INI'] , 2, '.',','); ?></td>
			<?php }else{ ?>
			<td align="right"><?php echo number_format($linea['CRED_DEU_INT_CTA'], 2, '.',',') ; ?></td>
		<td align="right"><?php echo number_format($linea['CRED_DEU_COMISION'], 2, '.',',') ; ?></td>
		<td align="right"><?php echo number_format($linea['CRED_DEU_IMPORTE'] -
		                                            $linea['CRED_DEU_COMISION'] -
		                                           $linea['CRED_DEU_INT_CTA'], 2, '.',','); ?></td>	
			 <?php } ?>									   														   
												   
		<th align="right"><?php echo encadenar(45); ?></th>										   
	</tr>	
 <?php
}
?>
<tr>
        <th align="left" style="font-size:14px"><?php echo encadenar(5); ?></td>
	 	<th align="center"><?php echo "Totales"; ?></th>
		
	        <?php if ($comif == 2){ ?>	
		<th align="right"><?php echo number_format($imp_sc, 2, '.',','); ?></th>
		    <?php } ?>
			<?php if ($comif == 1){ ?>	
		<th align="right"><?php echo number_format($tot_sol, 2, '.',',') ; ?></th>
		    <?php } ?>
		 <?php if ($p_int <> 4){ ?>	
		<th align="right"><?php echo number_format($tot_com, 2, '.',',') ; ?></th>
		<th align="right"><?php echo number_format($tot_aho, 2, '.',',') ; ?></th>
		<th align="right"><?php echo number_format($tot_sol - $tot_com - $tot_aho, 2, '.',','); ?></th>
		<?php }else{ ?>
		<th align="right"><?php echo number_format($tot_int, 2, '.',',') ; ?></th>
		<th align="right"><?php echo number_format($tot_com, 2, '.',',') ; ?></th>
		<th align="right"><?php echo number_format($tot_sol - $tot_com - $tot_aho - $tot_int , 2, '.',','); ?></th>
		<?php } ?>
		<th align="right"><?php echo encadenar(30); ?></th>
	</tr>	
</table>
  
 <br>
  <br>
 <br>
 <br>
 <br><br>
 <br><br>
 <?php  
    echo encadenar(5)."____________________________  ".encadenar(10). 
                    "   ____________________________  "; 
 ?>
                                                 
<br><br>
 <?php  
    echo encadenar(15)."      ASESOR  ".encadenar(30). 
                    " FIRMA AUTORIZADA "; 
 ?>
 <br><br>  
 </strong>	
</center>
<?php	
 	include("footer_in.php");
 ?>
 <?php
}
    ob_end_flush();
 ?>