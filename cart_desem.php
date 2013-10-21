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
<!--Titulo de la pestaña de la pagina-->
<title>Desembolso Cartera</title>
<meta charset="UTF-8">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script language="javascript" src="script/validarForm.js"></script> 
<script language="javascript" src="script/validarForm.js"></script> 
<script type="text/javascript" src="js/cajas_desembolso_des.js"></script>
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
                  <li id="menu_modulo_cajas_desembolsar">
                    
                     <img src="img/down_32x32.png" border="0" alt="Modulo" align="absmiddle"> DESEMBOLSO
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/redo_32x32.png" border="0" alt="Modulo" align="absmiddle"> DESEMBOLSAR
                    
                 </li>
              </ul>  
 <div id="contenido_modulo">
                      <h2> <img src="img/redo_64x64.png" border="0" alt="Modulo" align="absmiddle">DESEMBOLSAR</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/alert_32x32.png" align="absmiddle">
                     Verifique los datos del Desembolso
                     </div>
 
	
<?php
//$_SESSION['form_buffer'] = $_POST;
//$_SESSION['msg_err'] = " ";

//$fec = leer_param_gral();
if(isset($_SESSION['login'])){ 
  $log_usr = $_SESSION['login'];
  }
if(isset($_SESSION["impo_sol"])){  
  $imp_sol = $_SESSION["impo_sol"];
  }
if(isset($_SESSION['TC_CONTAB'])){ 
   $tc_ctb  = $_SESSION['TC_CONTAB'];
   }
$total = 0;
?>

<center>
<?php
//echo $_SESSION['EMPRESA_TIPO']."Empresa tipo";
$con_borra= "delete from temp_ctable";
$res_borra = mysql_query($con_borra);
if ( $_SESSION['continuar'] == 2) {
   $quecom = $_POST['cod_sol'];
   for ($i=0; $i < count($quecom); $i = $i + 1 ) {
       if (isset($quecom[$i]) ) {
          $cod_sol = $quecom[$i];
	      $_SESSION['nro_sol'] = $cod_sol;
       }
   } 
   }else{
   $cod_sol = $_SESSION['nro_sol'];
   }
//Seleccion solicitud
//echo $_SESSION['nro_sol'];
$con_sol  = "Select * From cred_solicitud where CRED_SOL_CODIGO = $cod_sol and CRED_SOL_USR_BAJA is null"; 
$res_sol = mysql_query($con_sol);
   while ($lin_sol = mysql_fetch_array($res_sol)) {
         $t_op = $lin_sol['CRED_SOL_TIPO_OPER']; 
		 $impo = $lin_sol['CRED_SOL_IMPORTE'];
		 $imp_c = $lin_sol['CRED_SOL_IMP_COM'];
		 $imp_sc = $impo + $imp_c;
		 $mon  = $lin_sol['CRED_SOL_COD_MON'];
		 $comi  = $lin_sol['CRED_SOL_TIP_COM'];
		 $comif = $lin_sol['CRED_SOL_COM_F'];
		 $ahod  = $lin_sol['CRED_SOL_AHO_DUR'];
		 $ahoi  = $lin_sol['CRED_SOL_AHO_INI'];
		 $tint  = $lin_sol['CRED_SOL_TASA'];
		 $plzm  = $lin_sol['CRED_SOL_PLZO_M'];
		 $plzd  = $lin_sol['CRED_SOL_PLZO_D'];
		 $com_f  = $lin_sol['CRED_SOL_COM_F']; 
		 $aho_f  = $lin_sol['CRED_SOL_AHO_F'];
		 $aho_fm  = $lin_sol['CRED_SOL_AHO_DM'];
		 $f_pag  = $lin_sol['CRED_SOL_FORM_PAG']; 
		 $f_des  = $lin_sol['CRED_SOL_FEC_DES'];
		 $f_uno  = $lin_sol['CRED_SOL_FEC_UNO'];
		 $produ = $lin_sol['CRED_SOL_PRODUCTO']; 
		 $c_int = $lin_sol['CRED_SOL_CAL_INT']; 
		 $p_int = $lin_sol['CRED_SOL_AHO_F'];
		 $cuotas = $lin_sol['CRED_SOL_NRO_CTA'];
		 $grupo = $lin_sol['CRED_SOL_COD_GRUPO'];
		 $dia_p = $lin_sol['CRED_SOL_DIA_REU']; 
		 $f_des2= cambiaf_a_normal($f_des); 
		 $f_uno2= cambiaf_a_normal($f_uno); 
		 $_SESSION['mon'] = $mon;
		 $_SESSION['comif'] = $imp_c;
		// $mes = saca_mes($f_uno2);
		// $ano = saca_anio($f_uno2);
		// $dia_p = dia_semana ($dia, $mes, $ano);
   }
  //echo $mon. "Moneda", $t_op, "tip Ope";
  //Leer parametros
	   $con_cin = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 10 and GRAL_PAR_INT_COD = $c_int";
       $res_cin = mysql_query($con_cin);
	   while ($linea = mysql_fetch_array($res_cin)) {
	        $d_cin = $linea['GRAL_PAR_INT_DESC'];
	   }
$con_pin = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 11 and GRAL_PAR_INT_COD = $p_int";
       $res_pin = mysql_query($con_pin);
	   while ($linea = mysql_fetch_array($res_pin)) {
	        $d_pin = $linea['GRAL_PAR_INT_DESC'];
	   }	   
	   
	   
	   
       $con_top = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 21 and GRAL_PAR_INT_COD = $t_op";
       $res_top = mysql_query($con_top);
	   while ($linea = mysql_fetch_array($res_top)) {
	        $d_top = $linea['GRAL_PAR_INT_DESC'];
	   }
	   $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD = $mon";
       $res_mon = mysql_query($con_mon);
	   while ($linea = mysql_fetch_array($res_mon)) {
	        $d_mon = $linea['GRAL_PAR_INT_DESC'];
	   }
         $con_ahod = "Select GRAL_PAR_PRO_DESC  From gral_param_propios where GRAL_PAR_PRO_GRP = 912 and                     GRAL_PAR_PRO_COD = $ahod ";
         $res_ahod = mysql_query($con_ahod);
		  while ($lin_ahod = mysql_fetch_array($res_ahod)) {
		        $aho_d = $lin_ahod['GRAL_PAR_PRO_DESC'];
		  } 
          $con_fpa = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 13 and GRAL_PAR_INT_COD = $f_pag";
          $res_fpa = mysql_query($con_fpa);
          while ($lin_fpa = mysql_fetch_array($res_fpa)) {
		        $nro_d = $lin_fpa['GRAL_PAR_INT_CTA1'];
				$fpag_d = $lin_fpa['GRAL_PAR_INT_DESC'];
		  } 
 if ($ahod == 1){
    $con_ahof  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 914 and GRAL_PAR_PRO_COD = $aho_f ";
    $res_ahof = mysql_query($con_ahof);
	while ($lin_ahof = mysql_fetch_array($res_ahof)) {
	      $aho_fa  = $lin_ahof['GRAL_PAR_PRO_CTA1'];
		  $aho_fd  = $lin_ahof['GRAL_PAR_PRO_DESC'];
	}
  }
 //Armar la parte contable
 //Cuenta contable cartera
 $cta_cart = leer_cta_car(1,$t_op,3,$mon);
 $cta_tip =  leer_cta_tip(1,$t_op,3,$mon);
 //leer_cta_car(1,$t_op,3,$mon) return $cta_cart, $cta_tip;
  $des_cta = leer_cta_des($cta_cart);
	if ($comif == 2){
	   $importe = $imp_sc; 
	   }
	if ($comif == 1){
	   $importe = $impo;
	   } 
//	echo $cta_cart, $des_cta, $importe; 
	if ($mon == 2){
		$impo_sus = $importe;
		$importe = $impo_sus * $_SESSION['TC_CONTAB'];
		}else{
		$impo_sus = 0;
	    }
//echo $cta_tip,$cta_cart,$des_cta.$importe,0,$impo_sus,0;	 	   		 
	$consulta = "insert into temp_ctable (temp_tip_tra,
	                                      temp_nro_cta, 
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  ($cta_tip,
										   $cta_cart,
									       '$des_cta',
										   $importe,
										   0,
										   $impo_sus,
										   0)";
										   
    $resultado = mysql_query($consulta);
//Cuenta Billetes Haber
    if ($mon == 1){
	    $cta_bill = 11101101;
		$impo_sus = 0;
		}
	if ($mon == 2){
	    $cta_bill = 11101201;
		}
//	echo "entra aqui ".$cta_bill;
    $con_ctad  = "Select * From contab_cuenta where CONTA_CTA_NRO = $cta_bill and CONTA_CTA_NIVEL = 'A' ";
    $res_ctad = mysql_query($con_ctad);
	while ($lin_ctab = mysql_fetch_array($res_ctad)) {
	      $des_ctab = $lin_ctab['CONTA_CTA_DESC'];
	}
	$consulta = "insert into temp_ctable (temp_tip_tra,
	                                      temp_nro_cta, 
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  ($cta_tip,
										   $cta_bill,
									       '$des_ctab',
										   0,
										   $importe,
										   0,
										   $impo_sus
										   )";
    $resultado = mysql_query($consulta);
//Contabilidad para fondo de garantia inicio
$consulta  = "Select * From cred_deudor where CRED_SOL_CODIGO = $cod_sol and CRED_DEU_USR_BAJA is null";
$resultado = mysql_query($consulta);
$imp_fg = 0;
while ($linea = mysql_fetch_array($resultado)) {
      $imp_fg = $imp_fg + $linea['CRED_DEU_AHO_INI'];
      }	
if ($imp_fg > 0){	  
if ($mon == 2){
		$impo_sus = $imp_fg;
		$imp_fg = $impo_sus * $_SESSION['TC_CONTAB'];
	}else{
		$impo_sus = 0;
	    }	  
 $cta_fong = leer_cta_car(2,$t_op,3,$mon);
 $cta_tip =  leer_cta_tip(2,$t_op,3,$mon);
 $des_cta = leer_cta_des($cta_fong);
        $consulta = "insert into temp_ctable (temp_tip_tra,
											  temp_nro_cta, 
                                              temp_des_cta,
									          temp_debe_1,
									          temp_haber_1,
										      temp_debe_2,
									          temp_haber_2
											  ) values
											  ($cta_tip,
											   $cta_fong,
									          '$des_cta',
											  0,
											  $imp_fg,
											  0,
											  $impo_sus
											  )";
       $resultado = mysql_query($consulta);
       $consulta = "insert into temp_ctable ( temp_tip_tra,
	                                          temp_nro_cta, 
                                              temp_des_cta,
									          temp_debe_1,
									          temp_haber_1,
										      temp_debe_2,
									          temp_haber_2
									    	  ) values
											  ($cta_tip,
											   $cta_bill,
									          '$des_ctab',
											   $imp_fg,
											   0,
											   $impo_sus,
											   0
											  )";
       $resultado = mysql_query($consulta);
	   }
//interes anticipado

if ($p_int == 4){
$consulta  = "Select * From cred_deudor where CRED_SOL_CODIGO = $cod_sol and CRED_DEU_USR_BAJA is null";
$resultado = mysql_query($consulta);
$imp_in = 0;
while ($linea = mysql_fetch_array($resultado)) {
      $imp_in = $imp_in + $linea['CRED_DEU_INT_CTA'];
      }	
if ($mon == 2){
		$impo_sus = $imp_in;
		$imp_in = $impo_sus * $_SESSION['TC_CONTAB'];
	}else{
		$impo_sus = 0;
	    }	  
 $cta_int = leer_cta_car(7,2,3,$mon);
 $cta_tip =  leer_cta_tip(7,2,3,$mon);
 $des_cta = leer_cta_des($cta_int);
        $consulta = "insert into temp_ctable (temp_tip_tra,
											  temp_nro_cta, 
                                              temp_des_cta,
									          temp_debe_1,
									          temp_haber_1,
										      temp_debe_2,
									          temp_haber_2
											  ) values
											  ($cta_tip,
											   $cta_int,
									          '$des_cta',
											  0,
											  $imp_in,
											  0,
											  $impo_sus
											  )";
       $resultado = mysql_query($consulta);
       $consulta = "insert into temp_ctable ( temp_tip_tra,
	                                          temp_nro_cta, 
                                              temp_des_cta,
									          temp_debe_1,
									          temp_haber_1,
										      temp_debe_2,
									          temp_haber_2
									    	  ) values
											  ($cta_tip,
											   $cta_bill,
									          '$des_ctab',
											   $imp_in,
											   0,
											   $impo_sus,
											   0
											  )";
       $resultado = mysql_query($consulta);	   
}	   
	   
	   
//Contabilidad Comision


    if ($imp_c > 0){
	   if ($mon == 2){
		$impo_sus = $imp_c;
		$imp_cc = $impo_sus * $_SESSION['TC_CONTAB'];
	   }else{
	    $imp_cc =  $imp_c;
	    $impo_sus = 0;
		}
		
	if ($_SESSION['EMPRESA_TIPO'] == 2){	
	    $com_13 = $imp_cc * .13;
		$com_1  = $imp_cc * .03;
	    $comision = $imp_cc - $com_13;
	}else{
	    $comision = $imp_cc;
	}		 
		 $cta_tip =  leer_cta_tip(3,$t_op,0,$mon); 
		 
	    //Billetes
		$consulta = "insert into temp_ctable (temp_tip_tra,
		                                      temp_nro_cta, 
                                              temp_des_cta,
									          temp_debe_1,
									          temp_haber_1,
										      temp_debe_2,
									          temp_haber_2
									    	  ) values
											  ($cta_tip,
											   $cta_bill,
									          '$des_ctab',
											   $imp_cc,
											   0,
											   $impo_sus,
											   0
											  )";
       $resultado = mysql_query($consulta);
	//Comision	
	$cta_com = leer_cta_car(3,$t_op,0,$mon);
    $des_cta = leer_cta_des($cta_com);
	if ($mon == 2){
		$impo_sus = $comision / $_SESSION['TC_CONTAB'];
	    }else{
	    $impo_sus = 0;
		}
	   $consulta = "insert into temp_ctable (temp_tip_tra, 
	                                         temp_nro_cta, 
                                             temp_des_cta,
								             temp_debe_1,
								             temp_haber_1,
									         temp_debe_2,
								             temp_haber_2
									    	  ) values
											  ($cta_tip,
											   $cta_com,
									          '$des_cta',
											   0,
											   $comision,
											   0,
											   $impo_sus
											   )";
       $resultado = mysql_query($consulta);		
		//13%
		
	if ($_SESSION['EMPRESA_TIPO'] == 2){		
	   $cta_com13 = leer_cta_car(4,0,0,1);
       $des_cta = leer_cta_des($cta_com13);
	   $consulta = "insert into temp_ctable (temp_tip_tra,
	                                         temp_nro_cta, 
                                             temp_des_cta,
								             temp_debe_1,
								             temp_haber_1,
								             temp_debe_2,
									         temp_haber_2
									    	  ) values
											  ($cta_tip,
											   $cta_com13,
									          '$des_cta',
											   0,
											   $com_13,
											   0,
											   $com_13
											   )";
       $resultado = mysql_query($consulta);	
	   //1%	Haber
	   $cta_com1 = leer_cta_car(5,0,0,1);
       $des_cta = leer_cta_des($cta_com1);
		   $consulta = "insert into temp_ctable (temp_tip_tra,
		                                         temp_nro_cta, 
                                                 temp_des_cta,
									             temp_debe_1,
									             temp_haber_1,
										         temp_debe_2,
									             temp_haber_2
									    	  ) values
											  ($cta_tip,
											   $cta_com1,
									          '$des_cta',
											   0,
											   $com_1,
											   0,
											   $com_1
											   )";
       $resultado = mysql_query($consulta);	
	   //1%	Debe
	   $cta_com1d = leer_cta_car(6,0,0,1);
       $des_cta = leer_cta_des($cta_com1d);
	   $consulta = "insert into temp_ctable (temp_tip_tra,
		                                         temp_nro_cta, 
                                                 temp_des_cta,
									             temp_debe_1,
									             temp_haber_1,
										         temp_debe_2,
									             temp_haber_2
									    	  ) values
											  ($cta_tip,
											   $cta_com1d,
									          '$des_cta',
											   $com_1,
											   0,
											   $com_1,
											   0
											   )";
       $resultado = mysql_query($consulta);	
	   }
	 }
	 ?>
	 <br>
	<form name="form1" method="post" action="solic_retro_sol.php" style="border:groove" target="_self"  > 
	<strong> Datos Basicos para Desembolso </strong>	
    <br>
	<strong>  Solicitud </strong>
	<strong>
   <?php  
     echo $cod_sol, "  ",  "  Tipo Operacion ", $d_top ;  
 ?>
 <?php 
  if ($t_op < 3) {
      if ($grupo > 0) {
      $con_g_nom  = "Select CRED_GRP_NOMBRE from cred_grupo where CRED_GRP_CODIGO = $grupo and CRED_GRP_USR_BAJA is null ";
  
  $res_g_nom = mysql_query($con_g_nom);
  while ($lin_g_nom = mysql_fetch_array($res_g_nom)) {
     $nom_grp = $lin_g_nom ['CRED_GRP_NOMBRE'];
	 }
  	 ?>
	 <strong> Grupo  </strong>
	 <?php 
     echo  "  " , $nom_grp; 
	} 
	}
	 ?>
 </strong>
 <br><br>
 <strong> Importe Solicitado </strong>
   <?php 
    //$impo = $_SESSION["impo_sol"] ;
	$impo = $impo ;
	$impo2 = number_format($impo, 2, '.',','); 
     echo $impo2;   
 ?>
 <strong> Comision </strong>
   <?php 
    //$impo = $_SESSION["impo_sol"] ;
	$impc = $imp_c ;
	$impoc = number_format($impc, 2, '.',','); 
     echo $impoc;   
 ?>
<strong> Importe Cartera </strong>
   <?php 
  if ($comif == 2){
    	$impsc = $imp_sc ;
		}
	if ($comif == 1){
    	$impsc = $impo ;
		}	
	$imposc = number_format($impsc, 2, '.',','); 
     echo $imposc; 
 
 ?> 
 <strong> Moneda </strong>
   <?php
    echo $d_mon;
 ?>
 <br>
  <strong> Tasa Interes  </strong>
   <?php
     $tint_f = number_format($tint, 2, '.',',');   
     echo $tint_f.  " % Anual"; 
	 echo "  ";
  ?>
 <strong> Plazo </strong>
   <?php  
     echo $plzm, "  Meses  ", $plzd , "  Días";   
 ?>
  <strong> Numero de Cuotas </strong>
   <?php  
	 echo ($cuotas);   
 ?>
 <strong> Calculo Interes  </strong>
   <?php  
     echo $d_cin; 
	 echo "  ";
  ?>
 <br>
 <strong> Forma de Pago </strong>
   <?php  
     //$cuotas = (round( $plzd/$nro_d));
	 echo $fpag_d . " cada ". $nro_d . " días";   
 ?>
<strong> Fondo Garantia Inicio </strong>
   <?php
     $_SESSION["aho_i"] =  $ahoi; 
     echo $ahoi. " %";   
   ?>
  <br> 
 <strong> Fecha Desembolso </strong>
   <?php 
      echo  $f_des2;   
 ?>  
   <strong> Fecha 1er. Pago </strong>
   <?php 
      echo  $f_uno2 , "  ", $dia_p;
 ?>  
   </FONT> 
<?php	
$consulta  = "Select * From temp_ctable";
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
	 	<td align="left"><?php echo $linea['temp_nro_cta']; ?></td>
		<td align="left"><?php echo $linea['temp_des_cta']; ?></td>
		<td align="right"><?php echo number_format($linea['temp_debe_1'], 2, '.',',') ; ?></td>
		<td align="right"><?php echo number_format($linea['temp_haber_1'], 2, '.',','); ?></td>
		<td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		<td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
	</tr>
	
 <?php
}
?>
<tr>
	 	<th><?php echo encadenar(3); ?></th>
		<th align="center"><?php echo "Totales"; ?></th>
		<th align="right"><?php echo number_format($tot_debe_1, 2, '.',',') ; ?></th>
		<th align="right"><?php echo number_format($tot_haber_1, 2, '.',','); ?></th>
		<th align="right"><?php echo number_format($tot_debe_2, 2, '.',',') ; ?></th>
		<th align="right" ><?php echo number_format($tot_haber_2, 2, '.',','); ?></th>
	</tr>
</table>
</center>
<strong>
<?php

?>
</strong>

<center>
   <?php
 if(isset($_SESSION['msg_err'])){  
   echo $_SESSION['msg_err']; 
   }
 ?>
<center>
<br>
  <table width="30%"  align="center">
		    <tr>
	         <th align="left">Recibo Nro:</th>
			 <td><input class="txt_campo" type="text" name="rec_nro" size="10" maxlength="10"
			  value = "0"> </td>
		    </tr>
			</table>


<input class="btn_form" type="submit" name="accion" value="Imp_Desembolso">
<!--input class="btn_form" type="submit" name="accion" value="Salir"-->

</form>	




</div>
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