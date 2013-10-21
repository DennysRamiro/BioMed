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
<title>Cobro detalle desde Caja</title>
<meta charset="UTF-8">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script>
<!--script type="text/javascript" src="js/cajas_cobros_cart_dir_group_sel_kardex.js"></script-->  
<script type="text/javascript" src="js/cjas_cart_dir_nom_cons_modif_det.js"></script>  
</head>
<body>
<?php
				include("header.php");
			?>
<div id="pagina_sistema">
		     <ul id="lista_menu">      
		                 <li id="menu_modulo">
		                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
		                    
		                 </li>
		  		  <li id="menu_modulo_general_cajas">
                    
                     <img src="img/fax_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CAJAS
                    
                 </li>
                  <li id="menu_modulo_cajas_cob">
                    
                     <img src="img/my documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> COBROS CARTERA
                    
                 </li>
                 <li id="menu_modulo_cajas_cob_group">
                    
                     <img src="img/search_32x32.png" border="0" alt="Modulo" align="absmiddle"> DIRECTO
                    
                 </li>
                  <li id="menu_modulo_cajas_cob_group_sel">
                    
                     <img src="img/user_32x32.png" border="0" alt="Modulo" align="absmiddle"> NOMBRE DE GRUPO 
                    
                 </li>
                  <li id="menu_modulo_cajas_cob_group_sel_modif">
                    
                     <img src="img/find_32x32.png" border="0" alt="Modulo" align="absmiddle"> SELECCIONAR GRUPO
                    
                 </li>
                  <li id="menu_modulo_cajas_cob_group_sel_modificar">
                    
                     <img src="img/edit user_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODIFICAR GRUPO
                    
                 </li>
                    <li id="menu_modulo_fondogrupo">
                    
                     <img src="img/open document_32x32.png" border="0" alt="Modulo" align="absmiddle"> DETALLE CLIENTE
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
                      <h2> <img src="img/open document_64x64.png" border="0" alt="Modulo" align="absmiddle">DETALLE CLIENTE </h2>
                      <hr style="border:1px dashed #767676;">
                       <!--div id="error_login"> 
				          <img src="img/alert_32x32.png" align="absmiddle">
				          Elija el Grupo para modificar
				        </div-->


<!--div id="cuerpoModulo"-->
    	
           <div id="UserData">
                 <!--img src="images/24x24/001_20.png" border="0" align="absmiddle" alt="Home" /-->
	<?php
//fec = leer_param_gral();
 $fec1 = cambiaf_a_mysql_2($fec);
 $logi = $_SESSION['login']; 
 //echo md5('nela');
?> 
	</div>
            
            
            
<font size="+1">
<div id="TableModulo2" >
<form name="form2" method="post" action="cobro_retro_opd.php" onSubmit="return ValidarCamposUsuario(this)">
 
<?php

//$_SESSION['form_buffer'] = $_POST;
$log_usr = $_SESSION['login'];
$f_has ="";
$ag_usr = $_SESSION['COD_AGENCIA'];
$_SESSION['msg']="";
$_SESSION['nom_grp'] = "";

//$_SESSION['grupo'] = "";
//$_SESSION['cod_gru'] = ""; 
?>
<?php
 


//Calculo General
if ($_SESSION['continuar'] == 3){ //1 a
   if(isset($_POST['ncre'])){
     $ncre = $_POST['ncre'];
	 $_SESSION['ncre'] = $ncre;
	// echo $ncre;
	  }else{
	 $_SESSION['continuar'] = 1;
	 $_SESSION['calculo'] == 1; 
	 header('Location:cobro_pag_det_gd.php');
	 }
     if(isset($_SESSION['grupo'])){
       $nom_grp =$_SESSION['grupo'];
	   }
  }	// 1 b
  $_SESSION['DEVEN'] = 0; 
  //Borrar temp_cobro
  $cuantos = 0;
  $n_cre = $_SESSION['ncre'];
 // $borr_cob  = "Delete From temp_cobro where TEMP_COB_NCRE = $n_cre
 //                 and TEMP_COB_FECHA = '$fec1' "; 
 // $cob_borr = mysql_query($borr_cob)or die('No pudo borrar temp_cobro');
   
  
  if ( $_SESSION['calculo'] == 1){ //2a ?>  
	  <table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center">
	    <tr>
             <td style="font-size:18px"><B><?php echo "Credito Nro."; ?></B></td>
             <td style="font-size:18px"><?php echo $ncre; ?></td>
			 
	 	     <td style="font-size:18px"><B><?php echo "Grupo"; ?></B></td>
			<?php if (isset($nom_grp)){ ?>
             <td style="font-size:18px"><?php echo $nom_grp; ?></td>
			 <?php } ?>
	   </tr>
	   		 
      </table> 
<?php } // 2 b?> 
<?php
  if (isset($_SESSION['nombre'])){
     $nom_com =$_SESSION['nombre'];
	 $ncre = $_SESSION['ncre'];
     } ?>
 <?php
  if (isset($_SESSION['msg'])){?>
      <font color="#FF0000">
	  <?php echo $_SESSION['msg'];?>
	  </font color>
  <?php }?>
  <?php
  if ( $_SESSION['calculo'] == 1){ //3 a
           $_SESSION['cod_sol'] = 0;
           $_SESSION['capital'] = 0;
		   $_SESSION['interes'] = 0;
		   $_SESSION['intdev'] = 0;
		   $_SESSION['intmora'] = 0;
		   $_SESSION['ahorro'] = 0;
		   $_SESSION['cond_int'] = 0;
		   $_SESSION['penal'] = 0;
		   $_SESSION['cond_intm'] = 0;
		   $_SESSION['cond_pen'] = 0;
		   $_SESSION['cond_for'] = 0;
		   $_SESSION['itf'] = 0;
		   $_SESSION['monto_ven'] = 0;
		   $_SESSION['monto_com'] = 0;
		    $_SESSION['via_bs'] = 0;
		  	 $_SESSION['via_us'] = 0;
			 $_SESSION['via_ah'] = 0;
		   $_SESSION['nro_ctas'] = 0;
     echo $_SESSION['msg']; 
     $ncre =  $_SESSION['ncre'];
	 $con_pdp  = "Select * From cart_plandp where CART_PLD_NCRE = $ncre and CART_PLD_USR_BAJA is null order by 4 ";
     $res_pdp = mysql_query($con_pdp)or die('No pudo seleccionarse tabla 1')  ; ?>
 	 <br>
	   <table width="100%"  border="0" cellspacing="1" cellpadding="1" align="center">
	 <strong>
	  <tr>
	   <th style="font-size:14px">Nro. Cta.</th>
	   <th style="font-size:14px">Fecha</th>
	   <th style="font-size:14px">Capital</th> 
	   <th style="font-size:14px">Interes</th> 
	   <th style="font-size:14px">ITF</th>
	   <th style="font-size:14px">F.Gar.</th> 
	   <th style="font-size:14px" >Total</th> 
	   <th style="font-size:14px">Est.</th> 
    </tr>
	 <?php while ($lin_pdp = mysql_fetch_array($res_pdp)) {
	    $itf = 0;
	     if ($_SESSION['EMPRESA_TIPO'] == 2){
	       if ($_SESSION['mon'] == 2){
		       $itf = round(calculo_itf($lin_pdp['CART_PLD_CAPITAL']+$lin_pdp['CART_PLD_INTERES']),2);
		   
		 }		
			}  
		   
		        $f_pag = $lin_pdp['CART_PLD_FECHA'];
				$lin_pdp['CART_PLD_FECHA'] = cambiaf_a_normal($f_pag);
		 	
				  ?>
	  
	<?php if ($lin_pdp['CART_PLD_STAT'] == "C"){ ?>
	<tr style="color:#FF0000">
   	<td align="center"><?php echo $lin_pdp['CART_PLD_CTA'];?> </td>
	<td><?php echo $lin_pdp['CART_PLD_FECHA'];?> </td>
	<td><?php echo number_format($lin_pdp['CART_PLD_CAPITAL'], 2, '.',',') ;?> </td>
	<td><?php echo number_format($lin_pdp['CART_PLD_INTERES'], 2, '.',',') ;?> </td>
	<td><?php echo number_format($itf, 2, '.',',') ;?> </td>
	<td><?php echo number_format($lin_pdp['CART_PLD_AHORRO'], 2, '.',',') ;?> </td> 
	<td><?php echo number_format(($lin_pdp['CART_PLD_CAPITAL']+
							$lin_pdp['CART_PLD_INTERES']+$lin_pdp['CART_PLD_AHORRO']),2, '.',',') ;?> </td>
    <td>  <?php echo $lin_pdp['CART_PLD_STAT'] ;?> </td>
	                 
	</tr>						
	      <?php }else {?>
	 <tr>	  
     
	<td align="center"><?php echo $lin_pdp['CART_PLD_CTA'];?> </td>
	<td><?php echo $lin_pdp['CART_PLD_FECHA'];?> </td>
	<td><?php echo number_format($lin_pdp['CART_PLD_CAPITAL'], 2, '.',',') ;?> </td>
	<td><?php echo number_format($lin_pdp['CART_PLD_INTERES'], 2, '.',',') ;?> </td>
	<td><?php echo number_format($itf, 2, '.',',') ;?> </td>
	<td><?php echo number_format($lin_pdp['CART_PLD_AHORRO'], 2, '.',',') ;?> </td> 
	<td><?php echo number_format(($lin_pdp['CART_PLD_CAPITAL']+
							$lin_pdp['CART_PLD_INTERES']+$lin_pdp['CART_PLD_AHORRO']),2, '.',',') ;?> </td>
    <td>  <?php echo $lin_pdp['CART_PLD_STAT'] ;?> </td> 
	 <td ><INPUT NAME="fec_cal" TYPE=RADIO VALUE=<?php echo $lin_pdp['CART_PLD_FECHA'];?>></td>  

</tr>			
  	  <?php }
	  } 
  
  ?>
 
  </table>
   <br> <br>
   <center>

  <input type="submit" name="accion" value="Fecha de Calculo">
<!--input type="submit" name="accion" value="Salir"-->
 
  <?php
  } //3 b
  
  if ( $_SESSION['calculo'] == 2){ // 4 a 
     $f_has ="";
    
	 if(isset($_SESSION['fec_cal1'])){
      echo "Calculo al ".encadenar(2).$_SESSION['fec_cal1'].encadenar(2);
	  
	  $f_has1 = $_SESSION['fec_cal1'];
	  $f_has = cambiaf_a_mysql_2($f_has1);;
	 // $_SESSION['fec_cal'] = cambiaf_a_mysql_2($f_has);	  
	  }  
	 if(isset($_SESSION['cuota'])){
         $nro_cta = $_SESSION['cuota'];	  
	  }  
   } //4 b
    if(isset($_SESSION['cod_cli'])){
       $cod_cli = $_SESSION['cod_cli'];
	   $ncre = $_SESSION['ncre'];
      } 
	 	
  ?>
  <?php
   $cont = 0;
   $monto = 0;	
   $cta_pag = 0;
   $cta_ven = 0;
   $impo_p = 0;
   $impo_f = 0;
   $vto_fin = "";
   $f_ultp = "";
   $f_ult = "";
   $nom_grp = "";
    $f_tot = 0;
	$cta = 0;
	$ret = 0;
	$depos = 0;
	$tip_pagi = "";
   $con_car  = "Select * From cart_maestro where CART_NRO_CRED = $ncre and CART_ESTADO < 9 and CART_MAE_USR_BAJA is null"; 
   $res_car = mysql_query($con_car)or die('No pudo seleccionarse solicitud 2');
   while ($lin_car = mysql_fetch_array($res_car)) { // 5 a
          $cod_sol = $lin_car['CART_NRO_SOL']; 
		  $impo = $lin_car['CART_IMPORTE'];
		  $mon = $lin_car['CART_COD_MON'];
		  $tint = $lin_car['CART_TASA'];
		  $tope = $lin_car['CART_TIPO_OPER'];
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
		  $t_prod = $lin_car['CART_PRODUCTO'];
		  $est =  $lin_car['CART_ESTADO'];
		  $t_cred = $lin_car['CART_TIPO_CRED'];
		  $asesor = $lin_car['CART_OFIC_RESP'];
		  $p_int = $lin_car['CART_SECTOR'];
		  $f_des2= cambiaf_a_normal($f_des);
		  $nom_ase = leer_nombre_usr($t_cred,$asesor);
		  $_SESSION['cod_sol'] = $cod_sol;
		  $_SESSION['asesor'] = $nom_ase;
		  $_SESSION['cuotas'] = $cuotas;
		  $_SESSION['mon'] = $mon;
	//Cuotas pagadas			 
		  $cta_pag = cta_pag($ncre);
	//Cuotas vencidas			 
		  $cta_ven = cta_ven($ncre);
	//Cuotas vencidas			 
		  $cta_venf = cta_venf($ncre);
		  $cta_vef= cambiaf_a_normal($cta_venf);
	//Vencimiento Final			 
		  $f_vtof = vto_fin($ncre);
		  $f_vto= cambiaf_a_normal($f_vtof);
	//Ultimo Pago			 
		  $f_ultp = ult_pag($ncre);
		  if ($f_ultp > "01/01/2000"){
		 	 $f_ult= cambiaf_a_normal($f_ultp);			 
		    }
		  	 if ($p_int == 1) { 
			     $tip_pagi = "C/Cta";
			  }	
			if ($p_int == 4) { 
			     $tip_pagi = "Ant.";
			  }	    
		  if ($t_cred == 1) { 
		     $con_cin = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 10 and GRAL_PAR_INT_COD = $c_int";
             $res_cin = mysql_query($con_cin)or die('No pudo seleccionarse tabla 4')  ;
	         while ($linea = mysql_fetch_array($res_cin)) {
	               $d_cin = $linea['GRAL_PAR_INT_DESC'];
	          }
			 $f_uno2= cambiaf_a_normal($f_uno);
			 $con_ctat  = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sol 
		                   and CRED_PLD_NRO_CTA = 1 and CRED_PLD_USR_BAJA is null"; 
             $res_ctat = mysql_query($con_ctat)or die('No pudo seleccionarse cred_plandp');
	         $imp_ctat = 0;
		     while ($lin_ctat = mysql_fetch_array($res_ctat)){
		            $imp_ctat = $imp_ctat + ($lin_ctat['CRED_PLD_CAPITAL'] + $lin_ctat['CRED_PLD_INTERES'] 
			        + $lin_ctat['CRED_PLD_AHORRO']);          
			   } 			 	 
		   }
		 if  ($t_cred == 2) { 
		     $con_ctat  = "Select * From cart_plandp where CART_PLD_NCRE = $ncre 
		                    and CART_PLD_CTA = 1 and CART_PLD_USR_BAJA is null"; 
             $res_ctat = mysql_query($con_ctat)or die('No pudo seleccionarse cred_plandp');
	         $imp_ctat = 0;
		     while ($lin_ctat = mysql_fetch_array($res_ctat)){
		            $imp_ctat = $imp_ctat + ($lin_ctat['CART_PLD_CAPITAL'] + $lin_ctat['CART_PLD_INTERES'] 
		            + $lin_ctat['CART_PLD_AHORRO']);          
			  } 			
		  }
				  
		  $con_dpro  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 806 and GRAL_PAR_PRO_COD = $t_prod";
          $res_dpro = mysql_query($con_dpro)or die('No pudo seleccionarse tabla 2');
          while ($lin_dpro = mysql_fetch_array($res_dpro)) {
                $d_pro = $lin_dpro['GRAL_PAR_PRO_DESC'];
				$_SESSION['d_pro'] = $d_pro; 
	          }
		  $con_dope  = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 21 and GRAL_PAR_INT_COD = $tope";
          $res_dope = mysql_query($con_dope)or die('No pudo seleccionarse tabla 6');
          while ($lin_dope = mysql_fetch_array($res_dope)) {
                 $d_ope = $lin_dope['GRAL_PAR_INT_DESC']; 
				 $_SESSION['d_ope'] = $d_ope;
	            }
				
		if ($c_grup > 0){		
		  $con_grp = "Select * From cred_grupo where CRED_GRP_CODIGO = $c_grup and CRED_GRP_USR_BAJA is null";
          $res_grp = mysql_query($con_grp)or die('No pudo seleccionarse tabla cred_grupo')  ;
	      while ($lin_grp = mysql_fetch_array($res_grp)) {
	             $nom_grp = $lin_grp['CRED_GRP_NOMBRE'];
				 $_SESSION['nom_grp'] = $nom_grp;
		      }	
			}  
		//leer asesor
		
		
		/*  $con_ase = "Select * From gral_usuario where GRAL_USR_CODIGO = $asesor and GRAL_USR_USR_BAJA is null";
          $res_ase = mysql_query($con_ase)or die('No pudo seleccionarse tabla gral_usuario')  ;
	      while ($lin_ase = mysql_fetch_array($res_ase)) {
	             $nom_ase = $lin_ase['GRAL_USR_NOMBRES'].encadenar(1).$lin_ase['GRAL_USR_AP_PATERNO'];
				 $_SESSION['nom_asesor'] = $nom_ase;
				 //echo "ases".$nom_ase;
		      }
			*/  		 	 
          $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD = $mon";
          $res_mon = mysql_query($con_mon)or die('No pudo seleccionarse tabla 3')  ;
	      while ($linea = mysql_fetch_array($res_mon)) {
	             $d_mon = $linea['GRAL_PAR_INT_DESC'];
				 $s_mon = $linea['GRAL_PAR_INT_SIGLA'];
				 $_SESSION['des_mon'] = $d_mon;
				 
				 
	         }
   
          $con_fpa = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 13 and GRAL_PAR_INT_COD = $f_pag";
          $res_fpa = mysql_query($con_fpa)or die('No pudo seleccionarse tabla 5')  ;
          while ($lin_fpa = mysql_fetch_array($res_fpa)) {
		         $nro_d = $lin_fpa['GRAL_PAR_INT_CTA1'];
		 	     $fpag_d = $lin_fpa['GRAL_PAR_INT_DESC'];
				 $_SESSION['fpag_d'] = $fpag_d;
			  }
          $con_est  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 809 and GRAL_PAR_PRO_COD = $est";
          $res_est = mysql_query($con_est)or die('No pudo seleccionarse tabla 7');
	      while ($linea = mysql_fetch_array($res_est)) {
	             $d_est = $linea['GRAL_PAR_PRO_DESC'];
	             $s_est =  $linea['GRAL_PAR_PRO_SIGLA'];
				 $_SESSION['s_est'] = $d_est;
	         }  	

	//coordinadora o titular
	     $con_deu  = "Select * From cart_deudor, cliente_general where CART_DEU_NCRED = $ncre
		              and CLIENTE_COD = CART_DEU_INTERNO and  CART_DEU_RELACION = 'C'
					  and CART_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null "; 
         $res_deu = mysql_query($con_deu)or die('No pudo seleccionarse cart_deudor');
		 while ($lin_deu = mysql_fetch_array($res_deu)) {
	             $nom_tit = $lin_deu['CLIENTE_AP_PATERNO']."  ".
				            $lin_deu['CLIENTE_AP_MATERNO']."  ".
							$lin_deu['CLIENTE_NOMBRES'];
				$_SESSION['nom_cli'] = $nom_tit;
				$_SESSION['ci_cli'] = $lin_deu['CLIENTE_COD_ID'];
				$cod_id = $lin_deu['CLIENTE_COD_ID'];
				$cod_id = rtrim($cod_id);
					$nro_char = strlen($cod_id);
					$nro_ci = substr($cod_id,0,$nro_char-2);
				$_SESSION['nitci'] = $nro_ci;			
	            
	         } 
		 
		
		 $mon_deu = 0;
	     $mon_pag = 0;
	     $mon_cap = 0;
	     $mon_int = 0;
	     $mon_pcap = 0;
	     $mon_pint = 0;
	     $mon_apag = 0;
	     //deuda a la fecha de calculo
	     $mon_deu = 	monto_deuda_t($ncre,$f_has);
	     $mon_deu_f = 	monto_deuda_tf($ncre,$f_has);
	     //capital a la fecha de calculo
	     $mon_cap = monto_deuda_c($ncre,$f_has);
	     $mon_int = monto_deuda_i($ncre,$f_has);
	    // echo $mon_cap,$mon_int;
	     //pagos a la fecha
	     $mon_pcap = montos_recuperados($ncre,$fec,1);
	     $mon_pint = montos_recuperados($ncre,$fec,5);
	     $mon_paho = montos_recuperados($ncre,$fec,2);
	     $tmon_pag = $mon_pcap + $mon_pint ;
	    // echo "mon_paho",$mon_paho;
	     //monto a pagar
	     $mon_apag = $mon_deu_f - $tmon_pag;
		 
	} // 5 b
 	
    if ( $_SESSION['calculo'] == 2){ //6a  
	
       $_SESSION['cta_fdo']  = 0; 
	//   $_SESSION['intdev'] = 0;
   	   $con_fon  = "Select * From fond_maestro where FOND_NRO_CRED = $ncre and FOND_MAE_USR_BAJA is null"; 
       $res_fon = mysql_query($con_fon)or die('No pudo seleccionarse fond_maestro');
       while ($lin_fon = mysql_fetch_array($res_fon)) {
             $cod_cre2 = $lin_fon['FOND_NRO_CRED']; 
		     $cta = $lin_fon['FOND_NRO_CTA'];
			 $_SESSION['cta_fdo']  = $cta;
		     $tot_tre = 0;
		     $tot_tde = 0;
		 
       $con_dtra  = "Select sum(FOND_DTRA_IMPO) From fond_det_tran where FOND_DTRA_NCTA = $cta and 
                    FOND_DTRA_TIP_TRAN = 1 and FOND_DTRA_CCON = 212 and FOND_DTRA_USR_BAJA is null";
       $res_dtra = mysql_query($con_dtra)or die('No pudo leer : fond_det_tran  1' . mysql_error()) ;
	   while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	         $depos = round($lin_dtra['sum(FOND_DTRA_IMPO)'],2);
		     }
       $con_dtra  = "Select sum(FOND_DTRA_IMPO) From fond_det_tran where FOND_DTRA_NCTA = $cta and 
                     FOND_DTRA_TIP_TRAN = 2 and FOND_DTRA_CCON = 212 and FOND_DTRA_USR_BAJA is null";
       $res_dtra = mysql_query($con_dtra)or die('No pudo leer : fond_det_tran 2 ' . mysql_error()) ;
	   while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	         $ret = round($lin_dtra['sum(FOND_DTRA_IMPO)'],2);
		     }		  
  	  } 
	  
	 ?>
	
	<?php  echo "Coordinadora/Titular".encadenar(2).$nom_tit;?>
	 <br>
	<table width="40%"  border="0" cellspacing="1" cellpadding="1" align="left">
    <tr>
      <td scope="col"><border="0" alt="" align="absmiddle" />NUMERO CREDITO</th>
	  <td bgcolor="#66CCFF" ><?php echo $ncre; ?></td>
      <td width="15%" scope="col"><border="0" alt="" align="absmiddle" />GRUPO</th>
	  <td bgcolor="#66CCFF"><?php echo $nom_grp; ?></td>
	  <td width="20%" scope="col"><border="0" alt="" align="absmiddle" />FECHA DESEMBOLSO</th>
	  <td bgcolor="#66CCFF" align="center"><?php echo $f_des2;  ?></td>
	  <td width="20%" scope="col"><border="0" alt="" align="absmiddle" />DESEMBOLSO</th>
	  <td bgcolor="#66CCFF" align="right"><?php echo number_format($impo, 2, '.',',');  ?></td>
	  
	</tr>
	<tr>
	  <td width="20%" scope="col"><border="0" alt="" align="absmiddle" />MONEDA</th>
	  <td bgcolor="#66CCFF" ><?php echo $d_mon; ?></td>
	  <td width="15%" scope="col"><border="0" alt="" align="absmiddle" />T.OPERACION</th> 
      <td bgcolor="#66CCFF"><?php echo $d_ope; ?></td>
	  <td width="20%" scope="col"><border="0" alt="" align="absmiddle" />TASA INTERES ANUAL</th>
	  <td bgcolor="#66CCFF" align="center"><?php echo number_format($tint, 2, '.',',');  ?></td>
	  <td width="20%" scope="col"><border="0" alt="" align="absmiddle" />FRECUENCIA PAGOS</th>  
	  <td bgcolor="#66CCFF" align="center"><?php echo number_format($nro_d , 0, '.',',');  ?></td> 
	</tr>	
	<tr>
      <td width="20%" scope="col"><border="0" alt="" align="absmiddle" />PRODUCTO</th>
	  <td bgcolor="#66CCFF" ><?php echo $d_pro; ?></td>
	  <td width="15%" scope="col"><border="0" alt="" align="absmiddle" />ESTADO</th>
	  <td bgcolor="#66CCFF" ><?php echo $d_est; ?></td>
      <td width="20%" scope="col"><border="0" alt="" align="absmiddle" />PLAZO EN MESES</th>
	  <td bgcolor="#66CCFF" align="center"><?php echo number_format($plzm,0, '.',','); ?></td>
	  <td width="20%" scope="col"><border="0" alt="" align="absmiddle" />PLAZO EN DIAS</th>  
	  <td bgcolor="#66CCFF" align="center"><?php echo number_format($plzd,0, '.',',');  ?></td> 
	</tr>
	<tr>
	  <td width="20%" scope="col"><border="0" alt="" align="absmiddle" />NRO. CTAS PACTADAS</th>  
	  <td bgcolor="#66CCFF" align="center"><?php echo number_format($cuotas,0, '.',',');  ?></td>
	  <td width="20%" scope="col"><border="0" alt="" align="absmiddle" />NRO. CTAS PAGADAS</th>  
	  <td bgcolor="#66CCFF" align="center"><?php echo number_format($cta_pag,0, '.',',');  ?></td>
	   <td width="20%" scope="col"><border="0" alt="" align="absmiddle" />FECHA VENCIMIENTO FINAL</th>
	  <td bgcolor="#66CCFF" align="center"><?php echo $f_vto;  ?></td>
	  <td width="20%" scope="col"><border="0" alt="" align="absmiddle" />FECHA VENCIMIENTO</th>  
	  <td bgcolor="#66CCFF" align="right"><?php echo $cta_vef;  ?></td> 
	</tr>
	<tr>
	  <td width="20%" scope="col"><border="0" alt="" align="absmiddle" />NRO. FONDO GAR.</th>  
	  <td bgcolor="#66CCFF" align="center"><?php echo $cta; 
	                                         $_SESSION['cta_fdo'] = $cta;  ?></td>
	  <td width="20%" scope="col"><border="0" alt="" align="absmiddle" />SALDO FONDO GAR.</th>  
	  <td bgcolor="#66CCFF" align="right"><?php echo number_format($depos-$ret, 2, '.',',');  ?></td>
	  <td width="20%" scope="col"><border="0" alt="" align="absmiddle" />FECHA ULTIMO PAGO</th>
	  <td bgcolor="#66CCFF" align="center"><?php echo $f_ult;  ?></td>
	  <td width="20%" scope="col"><border="0" alt="" align="absmiddle" />SALDO ACTUAL</th>  
	  <td bgcolor="#66CCFF" align="right"><?php echo number_format($impo-$mon_pcap , 2, '.',','); 
	  $_SESSION['saldo'] = $impo-$mon_pcap; ?></td> 
	</tr>		
	<tr>
	  <td width="20%" scope="col"><border="0" alt="" align="absmiddle" />MONTO CUOTA</th>  
	  <td bgcolor="#66CCFF" align="right"><?php echo number_format($imp_ctat, 2, '.',',');  ?></td> 
	  <td width="20%" scope="col"><border="0" alt="" align="absmiddle" />CUOTAS EN MORA</th>  
	  <td bgcolor="#66CCFF" align="center"><?php echo number_format($cta_ven, 0, '.',',');  ?></td>
	  <td width="20%" scope="col"><border="0" alt="" align="absmiddle" />ASESOR</th>  
	  <td bgcolor="#66CCFF" align="right"><?php echo $nom_ase;?></th> 
	   <td width="20%" scope="col"><border="0" alt="" align="absmiddle" />TIPO INTERES</th> 
	  <td bgcolor="#66CCFF" align="center"><?php echo $tip_pagi;?></td> 
	</tr>	
	  </table> 
	
	 
	  <?php
	  if ($_SESSION['EMPRESA_TIPO'] == 2){
	/*   
				  
		
*/
	  
	    if ($mon == 2){ ?>
	 <table width="40%"  border="0" cellspacing="1" cellpadding="1" align="center">
	 <tr>
     <th scope="col"><border="0" alt="" align="absmiddle" />NRO CTA</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />FECHA</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />CAPITAL</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />INTERES</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />ITF</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />FORM.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />TOTAL</th>
	  
	  
	</tr>    
	  <?php }else{ ?>
	  <table width="40%"  border="0" cellspacing="1" cellpadding="1" align="center"> 
    <tr>
     <th scope="col"><border="0" alt="" align="absmiddle" />NRO CUOTA</th>
	  <th width="20%" scope="col"><border="0" alt="" align="absmiddle" />FECHA</th>
	  <th width="20%" scope="col"><border="0" alt="" align="absmiddle" />CAPITAL</th>
	  <th width="20%" scope="col"><border="0" alt="" align="absmiddle" />INTERES</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />FORM.</th>
	  <th width="20%" scope="col"><border="0" alt="" align="absmiddle" />TOTAL</th>
	  
	  
	</tr>
	 <?php }
	 } ?> 
	  <?php
	  if ($_SESSION['EMPRESA_TIPO'] == 1){  ?>
	
	  <table width="40%"  border="0" cellspacing="1" cellpadding="1" align="center"> 
    <tr>
     <th scope="col"><border="0" alt="" align="absmiddle" />NRO CUOTA</th>
	  <th width="20%" scope="col"><border="0" alt="" align="absmiddle" />FECHA</th>
	  <th width="20%" scope="col"><border="0" alt="" align="absmiddle" />CAPITAL</th>
	  <th width="20%" scope="col"><border="0" alt="" align="absmiddle" />INTERES</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />FORM.</th>
	  <th width="20%" scope="col"><border="0" alt="" align="absmiddle" />TOTAL</th>
	  
	  
	</tr>
	 <?php }  ?> 
	 
	 
	 
	 
	 
	 
	 
	  <?php
	 
	  $deuda = 0;
	  $t_f_cap_c = 0;
	  $t_f_int_c = 0;
	  $t_f_aho_c  = 0;
	  $t_itf = 0;
	  $f_int_c = 0;
	  $tipo_cta = "";
	  $dias_dif = 0;
	  $mon_dev = 0;
	  $mon_int_dev= 0;
	  $mon_dev_pag = 0;
	 $dias_dif = compararFechas($cta_vef,$fec);
	 
	 // if ($f_has > $fec1){ 
        //  
		if ($dias_dif == 0){
	        $tipo_cta = "PAGO EN LA FECHA VENCIMIENTO";
			$mora = 0;
			$_SESSION['mora'] = 0;
	       }
		 if ($dias_dif > 0){  	
			$tipo_cta = "PAGO ANTICIPADO";	
			$mora = 0;	
			$_SESSION['mora'] = 0;		
			}			
		 //}else{
		 if ($dias_dif < 0){ 
		    $mora = 1;
			$tipo_cta = "CUOTA(S) VENCIDAS";
			$_SESSION['mora'] = 1;
		 }
		 $con_ntra  = "Select count(*) From cart_plandp where CART_PLD_NCRE = $ncre and CART_PLD_STAT <> 'C'
	                  and CART_PLD_FECHA <= '$f_has' 
	                    and CART_PLD_USR_BAJA is null order by CART_PLD_FECHA";
	    $res_ntra = mysql_query($con_ntra)or die('No pudo leer : cart_plandp ' . mysql_error());
		  while ($lin_ntra = mysql_fetch_array($res_ntra)) {
          $_SESSION['nro_ctas'] =  $lin_ntra['count(*)'];
      }
		// echo $f_has, "f_has";
		$con_ptra  = "Select * From cart_plandp where CART_PLD_NCRE = $ncre and CART_PLD_STAT <> 'C'
	                  and CART_PLD_FECHA <= '$f_has' 
	                    and CART_PLD_USR_BAJA is null order by CART_PLD_FECHA";
	    $res_ptra = mysql_query($con_ptra)or die('No pudo leer : cart_plandp ' . mysql_error());
	  
	   echo encadenar(5).$tipo_cta;?>
	  
	  
	 <?php
	 if ($_SESSION['mora'] == 0){ 
	    $_SESSION['intmora'] = 0;
		$_SESSION['penal'] = 0;
	 }	
	 $cuantos = 0;
	  while ($lin_ptra = mysql_fetch_array($res_ptra)) {
	  
	        $mon_pcap_2 = 0;
	        $mon_pint_2 = 0;
	        $mon_cap_2 = 0;
	        $mon_int_2 = 0;
			$mon_cint_2 = 0;
			$mon_pen_2 = 0;
			$mon_aho_2 = 0;
			$mon_aho_p = 0;
			$mon_aho_c = 0;
			$mon_aho_cta = 0;
			$mon_dev_con = 0;
			
			$itf = 0;
			$cuantos = $cuantos + 1;
			 $_SESSION['cond_int'] = 0;
	        $f_cta = $lin_ptra['CART_PLD_CTA'];
			$f_fec = $lin_ptra['CART_PLD_FECHA'];
			$f_fecn= cambiaf_a_normal($f_fec);	
			$f_cap = $lin_ptra['CART_PLD_CAPITAL'];
			$f_int = $lin_ptra['CART_PLD_INTERES'];
			$f_stat = $lin_ptra['CART_PLD_STAT'];
		//deuda a la fecha de cobro
		    $mon_cap_fpag = monto_deuda_c($ncre,$f_has);
			$mon_int_fpag = monto_deuda_i($ncre,$f_has);
			//echo $mon_int_fpag, "Int. Tot";
			$mon_cap_2 = monto_deuda_c($ncre,$f_fec);
			$mon_int_2 = monto_deuda_i($ncre,$f_fec);
			
			//$mon_aho_2 = monto_aho_cta($ncre,$f_fec);
			
			$mon_aho_cta = monto_aho_cab($ncre,$f_cta);
			$mon_aho_c = monto_aho_cuota($ncre,$f_fec);
			if ($mon_aho_c == $mon_aho_cta){
			    $mon_aho_c = 0;
				}else{
			   $mon_aho_c = $mon_aho_c - $mon_aho_cta;
			  			   }
			   if ($mon_aho_c < 0){
			   $mon_aho_c = 0;
			   
			   }
			
	//pagos a la fecha 
	        $mon_pcap_2 = montos_recuperados($ncre,$fec,1);
	        $mon_pint_2 = montos_recuperados($ncre,$fec,5);
			$mon_pint_v = montos_recuperados($ncre,$fec,6);
	//interes devengado
	   
	        $f_dev = "01/02/2012";
			// echo $f_dev. "f_dev".$f_fecn."f_cta";
	        $ano1 = substr($f_fecn, 6,4); 
            $mes1 = substr($f_fecn, 3, 2); 
            $dia1 = substr($f_fecn, 0, 2);
            $ano2 = substr($f_dev, 6,4); 
            $mes2 = substr($f_dev, 3, 2); 
            $dia2 = substr($f_dev, 0, 2);
			//	$cap = round( $cap - $c_kap,2);
			//	}
        $timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1); 
        $timestamp2 = mktime(0,0,0,$mes2,$dia2,$ano2); 
        $segundos_diferencia = $timestamp1 - $timestamp2; 
		 $nro_dev = round( ($segundos_diferencia / (60 * 60 * 24)),0); 
		// echo $nro_dev. "dias dif";
	     if ($nro_dev > 0){
		    $mon_int_dev = montos_devengados($ncre,$fec,4);
			$mon_dev_pag = montos_recuperados($ncre,$fec,4);
			$mon_dev_con = montos_condonados($ncre,$fec,7);
		//	$mon_dev_pag = $mon_dev_pag + $mon_dev_con;
			
			}
		//	echo "--". $mon_int_dev."deven".$mon_dev_pag ."pag_deven".$mon_dev_con."mon_dev_con";		
			if ($mon_int_dev >= $mon_dev_pag){
			    $mon_int_dev = $mon_int_dev - $mon_dev_pag - $mon_dev_con;
			//echo $mon_int_dev."por pag dev";
				}else{
				$mon_int_dev = 0;
			}
	//	$_SESSION['intdev'] = $mon_int_dev;
	//montos condonados
	        $mon_cint_2 = montos_condonados($ncre,$fec,5);
			//echo $mon_cint_2. "Int. Cond";
		    $mon_cint_v = montos_condonados($ncre,$fec,6);
			$mon_pen_2 = montos_condonados($ncre,$fec,8);
			$_SESSION['mon_cint_v'] = $mon_cint_v;
	  	    $mon_int_efec =	$mon_int_fpag - ($mon_pint_2 + $mon_cint_2);
		//	echo $mon_cint_v. "--Cond Ven";	
		?>
	
	 <?php
	 
	 if ($cuantos == 1){ 
	   $int_cond = $mon_cint_2;
	    if ($mon_cap_2 > $impo) {
	       $f_cap_c = $impo - $mon_pcap_2;
		   $f_int_c = $mon_int_2 - ($mon_pint_2 + $mon_cint_2);
		 
		   if ($f_int_c < 0){	
			    $f_int_c = 0;
			}
		   }else{
		   $f_cap_c = $mon_cap_2 - $mon_pcap_2;
		   
		   $f_int_c = $mon_int_2 - ($mon_pint_2 + $mon_cint_2);

		   if ($_SESSION['cargo'] == 4){ 
		     if ($int_cond > 0){
		      if ($f_int_c <= $mon_int_efec){	
			     $f_int_c = $mon_int_efec;
				// echo $f_int_c;
			   }
			  }
			}   

		  }
	    }else{
	   	$f_cap_c = $f_cap;
		if (round($int_cond,2)  >= round($f_int,2)) {
		    $f_int_c = 0;
			$int_cond = $int_cond - $f_int;
			//echo $int_cond;
			}else{
			$f_int_c = $f_int;
			}
		}	
		 if ($nro_dev > 0){
		     if (round($mon_dev_con,2)  <= round($f_int_c,2)) {
		        $f_int_c = $f_int_c - $mon_dev_con;
				  
		     }
         }		
	   if ($f_cap_c < 0){	
		    $f_cap_c = 0;
			}
	
	 $f_tot = $f_cap_c + $f_int_c + $itf + $mon_aho_c;
	 $t_f_cap_c = $t_f_cap_c + $f_cap_c;
	$t_f_int_c = $t_f_int_c + $f_int_c;
	$t_f_aho_c = $t_f_aho_c + $mon_aho_c;
	if ($t_f_int_c < 0){
	    $t_f_int_c = 0;
		$f_int_c = 0;
		}	
	if ($_SESSION["detalle"] <> 4 and $_SESSION["detalle"] <> 7 
	    and $_SESSION["detalle"] <> 8 and $_SESSION["detalle"] <> 9 
		and $_SESSION["detalle"] <> 10 and $_SESSION["detalle"] <> 11){ 
	    $_SESSION['capital'] = $t_f_cap_c;
		$_SESSION['interes'] = $t_f_int_c;
		$_SESSION['intdev'] = $mon_int_dev;
		//echo  $_SESSION['interes']."***".$_SESSION['intdev']. "---".$mon_int_dev;
	//	echo $_SESSION['interes'] . $mon_int_dev."--";
		if ($mon_int_dev > 0){
		
		  // echo $_SESSION['interes'] . $mon_int_dev."--";
		    if ($_SESSION['interes'] >= $mon_int_dev ){
			    $_SESSION['intdev'] = $mon_int_dev;
	            if (($mon_dev_con > 0) and ($mon_int_dev <= $_SESSION['interes'] - $mon_dev_con)){
				    $_SESSION['interes'] = 0;
				}else{
			    $_SESSION['interes'] = $_SESSION['interes'] - $mon_int_dev;
				}
			}else{
			    if ($_SESSION['interes'] == 0 ){
				    $_SESSION['intdev'] = 0;
				}else{
				
				  if ($_SESSION['interes'] <= $_SESSION['intdev']){
				//  echo  $_SESSION['interes'] , $_SESSION['intdev'];
				      $_SESSION['intdev'] = $_SESSION['interes'];
					  $_SESSION['interes'] = 0;
				  }else{
				//  echo "Aqui entra". $_SESSION['interes'] .$_SESSION['intdev'];
		           $_SESSION['intdev'] = $mon_int_dev - $_SESSION['interes'];
			       $_SESSION['interes'] = 0;
				   }
				}   
				   
			}	
			
			?>
			<br>
			<font color="#0000FF">
		 <?php
		 
		  echo "Int. Devengado".encadenar(2).$_SESSION['intdev'] ;
		
				 //echo encadenar(2).$mon_int_dev.encadenar(2).
				   //    "Int. Dev Pagado".$mon_dev_pag.encadenar(2).
					//   "Saldo".encadenar(2).$mon_int_dev - $mon_dev_pag;
				   ?>
	    </font>
				  <?php
		
			
			
			
		}
		
		
		
		
		
	    $_SESSION['ahorro'] = $t_f_aho_c;
		
	if ($_SESSION['EMPRESA_TIPO'] == 2){
	    if ($mon == 2){
		    $itf = calculo_itf($f_cap_c+$f_int_c);
			$_SESSION['itf'] = $itf;
			$t_itf = $t_itf +  $_SESSION['itf']; 
	    }
	if ($mora == 1){
	   if ($_SESSION['nro_ctas'] > 1){
		   $f_fecn= $cta_vef;
	    }
	     
	       $dias_mor = (compararFechas($f_fecn,$fec) * -1);
	   	   $int_mora = round(($t_f_cap_c * $dias_mor * $tint)/36000,2);
		  // echo $int_mora. "---Total";
		   if ($mon_cint_v > 0){
		        $int_mora = $int_mora - $mon_cint_v;
				
		  } 
		 // echo $int_mora."intmora";
	       $_SESSION['intmora'] =  $int_mora;
		   //echo $int_mora. "---Menos Cond";
//echo "K",$t_f_cap_c,"Dia",$dias_mor,"Int",$tint,"cal",$int_mora;
		//   	   }
	}
	}else{
	    $_SESSION['intmora'] =  0 ;
	    $itf = 0;
	}
	//Interes penal
        $dias_mor = (compararFechas($f_fecn,$fec) * -1);
		//echo "dias mora !!!". $dias_mor."***";
		$saldo =  $_SESSION['saldo'];
		 if (($dias_mor > 0) and($dias_mor < 61))  {
	    $int_penal = round(($saldo * $dias_mor * 4)/36000,2);
		 }
		 if (($dias_mor > 60) and($dias_mor < 91))  {
	    $int_penal = round(($saldo * $dias_mor * 5)/36000,2);
		 }
		 if ($dias_mor > 90)  {
	    $int_penal = round(($saldo * $dias_mor * 7)/36000,2);
		 }
		 //   if ($mon_cint_v > 0){
		     //    $int_mora = $int_mora - $mon_cint_v;
				
		 //  } 
		 
		 if ($mon_pen_2 > 0) {
		      if ($mon_pen_2 >= $int_penal) {	 
	              $_SESSION['penal'] = 0;
				  }else{
				   $_SESSION['penal'] =  round($int_penal-$mon_pen_2,2);
				}   
		 //    echo "penal".$_SESSION['penal'];
		} else{
		  	    $_SESSION['penal'] =  round($int_penal,2);
				} 
					
	}
//echo $_SESSION['penal']."---";
	?>
	 <?php
	  if ($_SESSION['EMPRESA_TIPO'] == 2){
	    if ($mon == 2){ ?>  
	<tr>
	  <td align="center"><?php echo number_format($f_cta,0, '.',',');  ?></td>
	  <td align="center"><?php echo $f_fecn;  ?></td>
	  <td align="right"><?php echo number_format($f_cap_c,2, '.',',');  ?></td>
	  <td align="right"><?php echo number_format($f_int_c,2, '.',',');  ?></td>
	  <td align="right"><?php echo number_format($_SESSION['itf'],2, '.',',');  ?></td>
	  <td align="right"><?php echo number_format($mon_aho_c,2, '.',',');  ?></td>
	  <td align="right"><?php echo number_format($f_tot +  $_SESSION['itf'],2, '.',',');  ?></td>
	   
	</tr>
	<?php 
	}else{ ?>
	<tr>
	  <td align="center"><?php echo number_format($f_cta,0, '.',',');  ?></td>
	  <td align="center"><?php echo $f_fecn;  ?></td>
	  <td align="right"><?php echo number_format($f_cap_c,2, '.',',');  ?></td>
	  <td align="right"><?php echo number_format($f_int_c,2, '.',',');  ?></td>
	  <td align="right"><?php echo number_format($mon_aho_c,2, '.',',');  ?></td> 
	  <td align="right"><?php echo number_format($f_tot,2, '.',',');  ?></td>
	   
	</tr>
	<?php }
	 } ?> 
	  <?php
	  if ($_SESSION['EMPRESA_TIPO'] == 1){   ?>  
	
	<tr>
	  <td align="center"><?php echo number_format($f_cta,0, '.',',');  ?></td>
	  <td align="center"><?php echo $f_fecn;  ?></td>
	  <td align="right"><?php echo number_format($f_cap_c,2, '.',',');  ?></td>
	  <td align="right"><?php echo number_format($f_int_c,2, '.',',');  ?></td>
	  <td align="right"><?php echo number_format($mon_aho_c,2, '.',',');  ?></td>
	  <td align="right"><?php echo number_format($f_tot,2, '.',',');  ?></td>
	   
	</tr>
	<?php  } ?> 
	 
	
	   <?php
     }
		?> 
		
		
		
	 <?php
	  if ($_SESSION['EMPRESA_TIPO'] == 2){
	    if ($mon == 2){ ?>  	
		
		 <tr>
	  <td bgcolor="#FFFF99" align="center"><?php echo encadenar(5);  ?></th>
	  <td bgcolor="#FFFF99" align="center"><?php echo "Total";  ?></th>
	  <td bgcolor="#FFFF99" align="right"><?php echo number_format($t_f_cap_c,2, '.',',');  ?></th>
	  <td bgcolor="#FFFF99" align="right"><?php echo number_format($t_f_int_c,2, '.',',');  ?></th>
	  <td bgcolor="#FFFF99" align="right"><?php echo number_format($t_itf,2, '.',',');  ?></th>
	  <td bgcolor="#FFFF99" align="right"><?php echo number_format($t_f_aho_c,2, '.',',');  ?></td>
	  <td bgcolor="#FFFF99" align="right"><?php echo number_format($t_f_cap_c + $t_f_int_c 
	                                                               + $t_itf+$t_f_aho_c ,2, '.',',');  ?></th>
	  </tr>	 
	  	<?php  $_SESSION['itf'] = $t_itf;
		 }else{ ?>
	  <td bgcolor="#FFFF99" align="center"><?php echo encadenar(5);  ?></th>
	  <td bgcolor="#FFFF99" align="center"><?php echo "Total";  ?></th>
	  <td bgcolor="#FFFF99" align="right"><?php echo number_format($t_f_cap_c,2, '.',',');  ?></th>
	  <td bgcolor="#FFFF99" align="right"><?php echo number_format($t_f_int_c,2, '.',',');  ?></th>
	  <td bgcolor="#FFFF99" align="right"><?php echo number_format($t_f_aho_c,2, '.',',');  ?></td>
	  <td bgcolor="#FFFF99" align="right"><?php echo number_format($t_f_cap_c + $t_f_int_c 
	                                                             + $t_itf + $t_f_aho_c,2, '.',',');  ?></th>
	  <?php
	   }
	 } ?> 
	   <?php
	  if ($_SESSION['EMPRESA_TIPO'] == 1){   ?>  	
		  <td bgcolor="#FFFF99" align="center"><?php echo encadenar(5);  ?></th>
	      <td bgcolor="#FFFF99" align="center"><?php echo "Total";  ?></th>
	      <td bgcolor="#FFFF99" align="right"><?php echo number_format($t_f_cap_c,2, '.',',');  ?></th>
	      <td bgcolor="#FFFF99" align="right"><?php echo number_format($t_f_int_c,2, '.',',');  ?></th>
		  <td bgcolor="#FFFF99" align="right"><?php echo number_format($t_f_aho_c,2, '.',',');  ?></td>
	      <td bgcolor="#FFFF99" align="right"><?php echo number_format($t_f_cap_c + $t_f_int_c + $t_itf+$t_f_aho_c,2, '.',',');  ?></th>
	  <?php }  ?> 
	    
  </table> 
  
	<br>	
   <?php if ($_SESSION["detalle"] == 1){  
           if ($_SESSION['cargo'] == 4){   ?>
		 
		   <table width="80%"  align="center">
		    <tr>
	         <th align="left">Realiza el Pago :</th>
			 <td><input type= type="text" name="descrip" size="50" maxlength="70"
			  value = <?php echo $_SESSION['nom_cli'] ; ?>> </td>
		    </tr>
			 <tr>
	         <th align="left">Recibo Nro. :</th>
			 <td><input type= type="text" name="rec_nro" size="10" maxlength="10"
			  value = "0"> </td>
		    </tr>
	  </table>
		  <br> 
		  <?php
		  if ($_SESSION['cta_fdo'] > 0){ ?>
		 <input type="submit" name="accion" value="Monto Fijo C_FGar">
		  <?php } ?>
         <input type="submit" name="accion" value="Monto Fijo S_FGar">
		  <?php if ($_SESSION['cta_fdo'] > 0){ ?>
         <input type="submit" name="accion" value="Cuota con FGar">
		  <?php } ?>
		 <input type="submit" name="accion" value="Cuota sin FGar">
         <!--input type="submit" name="accion" value="Salir"-->
   <?php }else{ ?>
          <input type="submit" name="accion" value="Calculo_deuda">
         <input type="submit" name="accion" value="Terminar">
   
<?php } 
   }?>

  <?php if ($_SESSION["detalle"] == 2){
  
 // echo "Recibo  ". $_SESSION['nro_rec'];
if (isset ($_POST['descrip'])){
  if ($_POST['descrip'] <> ""){ 
   
	$descrip = $_POST['descrip'];
	$descrip = strtoupper ($descrip);
	$_SESSION['q_paga'] = $descrip;
	}
     }else{
  echo "Verifique Error en el Monto";
  }
           
		    //7 a ?>  
   
   </div id="TableModulo2">
   <?php if ($mon == 1){?>	
    <table width="75%"  border="1" cellspacing="1" cellpadding="1" align="center">
       <tr>
		 <th width="20%" scope="col"><border="0" alt="" align="center" />Monto Bolivianos</th>
		 <td align="right" ><input type="text" name="mon_bs" width="10"  size="12" value=0 ></td>   
         <th width="20%" scope="col"><border="0" alt="" align="center" />Monto Dolares</th>
         <td align="right" ><input type="text" name="mon_us" width="10"  size="12" value=0 ></td>   
		 <th width="20%" scope="col"><border="0" alt="" align="center" />Fondo Garan.</th>
         <td align="right" ><input type="text" name="mon_fg" width="10"  size="12" value=0 ></td>
      </tr> 
	<?php } //7 b?>	
	<?php if ($mon == 2){?>	
    <table width="75%"  border="1" cellspacing="1" cellpadding="1" align="center">
       <tr>
		 <th width="20%" scope="col"><border="0" alt="" align="center" />Monto Bs. en Dolares</th>
		 <td align="right" ><input type="text" name="mon_bs" width="10"  size="12" value=0 ></td>   
         <th width="20%" scope="col"><border="0" alt="" align="center" />Monto Dolares</th>
         <td align="right" ><input type="text" name="mon_us" width="10"  size="12" value=0 ></td>   
		 <th width="20%" scope="col"><border="0" alt="" align="center" />Fondo Garan.</th>
         <td align="right" ><input type="text" name="mon_fg" width="10"  size="12" value=0 ></td>
	    </tr> 
	<?php } //7 b?>	
	</table>
	<center>	
		<input type="submit" name="accion" value="Confirmar">
	    <!--input type="submit" name="accion" value="Salir"-->
      
</form>	
	<?php } //7 b?>	
	<?php if ($_SESSION["detalle"] == 7){
	         $n_cap = 0; 
			 $n_int = 0;
			 $n_intd = 0;
			 $n_intm = 0;
			 $n_gar = 0;
			 $n_pen = 0;
			 $_SESSION['cond_pen'] = 0;
			 $_SESSION['cond_for'] = 0;
			
			  if (isset($_POST['imp_p']))  {
			     $c_pen = $_POST['imp_p'];
			    }
			   if (isset($_POST['imp_f']))  {
			     $c_for = $_POST['imp_f'];
			   }
		if ($_SESSION['EMPRESA_TIPO'] == 2){
	       if ($mon == 2){
		       $itf = round(calculo_itf($_SESSION['capital']+$_SESSION['interes']+
			                            $_SESSION['intdev'] +$_SESSION['intmora']),2);
			   $_SESSION['itf'] = $itf; 
	           }	
	       }else{
	    }	 	  	 	
				 
		   $total_e = $_SESSION['capital'] +
		              $_SESSION['interes'] +
					  $_SESSION['intdev'] +
					  $_SESSION['intmora'] +
					   $_SESSION['itf'] +
					  $_SESSION['ahorro'] ;
		   $e_cap = $_SESSION['capital'];
		   $e_int = $_SESSION['interes'];
		   $e_intm = $_SESSION['intdev'];
		   $e_intm = $_SESSION['intmora'];
		   $e_aho =	$_SESSION['ahorro'];
		   $e_pen =	$_SESSION['intmora'];
		   $e_itf =	$_SESSION['itf'];
		   $n_cap = $_SESSION['capital'];
		   if ($c_int > 0){
		       $_SESSION['cond_int'] = $c_int;
		       $n_int = $_SESSION['interes'] - $c_int;
			   $n_cap = $n_cap + $c_int; }
		   if ($c_intm > 0){
		      // echo "Int.Cond".$c_intm;
		       $_SESSION['cond_intm'] = $c_intm;
		       $n_intm = $_SESSION['intmora'] - $c_intm;
			   
			   $n_cap = $n_cap + $c_intm; }
		   	 if ($c_pen > 0){
		       $_SESSION['cond_pen'] = $c_pen;
		       $n_pen = $_SESSION['intmora'] - $c_pen;
			   $n_cap = $n_cap + $c_pen; }   
			   
		   if ($c_gar > 0){
		       $_SESSION['cond_aho'] = $c_gar;
		       $n_gar = $_SESSION['ahorro'] - $c_gar;
			   $n_cap = $n_cap + $c_gar; }    
		   	$_SESSION['capital'] = $n_cap;
			$_SESSION['interes'] = $n_int;	
			$_SESSION['intmora'] = $n_intm;	
			$_SESSION['ahorro'] = $n_gar; 

		      ?>        		 
   
   </div id="TableModulo2">
   <?php  echo encadenar(10)."DETALLE DE COBRO RECALCULADO "; ?>  
    <table width="40%"  border="1" cellspacing="1" cellpadding="1" align="center">
        <tr>
		   <th width="20%" scope="col"><border="0" alt="" align="center" />Concepto</th>
		   <?php if ($mon == 1){ ?>	
           <th width="20%" scope="col"><border="0" alt="" align="center" />Monto Bolivianos</th>
          <?php } ?>
		    <?php if ($mon == 2){ ?>	
           <th width="20%" scope="col"><border="0" alt="" align="center" />Monto Dolares</th>
          <?php } ?>
        </tr>
        <tr>
		   <td >Capital 3</td>
	       <td align="right" ><?php echo number_format($_SESSION['capital'], 2, '.',','); ?></td> 
		</tr>
		 <tr>  
	       <td >Interes Deven</td>
	       <td align="right" ><?php echo number_format($_SESSION['intdev'], 2, '.',','); ?></td> 
		</tr>
        <tr>  
	       <td >Interes</td>
	       <td align="right" ><?php echo number_format($_SESSION['interes'], 2, '.',','); ?></td> 
		</tr>
		<tr>  
	       <td >Interes Vencido</td>
	       <td align="right" ><?php echo number_format($_SESSION['intmora'], 2, '.',','); ?></td>
		</tr>
        <tr>  
	       <td >Interes Penal</td>
	       <td align="right" ><?php echo number_format($_SESSION['penal'], 2, '.',','); ?></td>
		</tr>
        <tr>  
	       <td >Fondo Garan.</td>
	       <td align="right" ><?php echo number_format($_SESSION['ahorro'], 2, '.',','); ?></td>
		</tr>
		<?php
	  if ($_SESSION['EMPRESA_TIPO'] == 2){
	    if ($mon == 2){ ?>    
		<tr>  
	       <td >ITF</td>
	       <td align="right" ><?php echo number_format($_SESSION['itf'], 2, '.',','); ?></td>
		</tr> 
		 <?php } 
		         }?>  
				    
		<tr>  
	       <td style="background-color: #6699FF" align="center" >Importe Total</td>
	       <td style="background-color: #6699FF" align="right" >
		              <?php echo number_format($_SESSION['capital']+$_SESSION['interes']+$_SESSION['intdev']+
		              $_SESSION['intmora']+$_SESSION['penal']+$_SESSION['ahorro'], 2, '.',','); ?></td> 
		</tr>
  </table>
		<center>
		<input type="submit" name="accion" value="Aplicar">
	    <!--input type="submit" name="accion" value="Salir"-->
      
</form>	
	<?php } //7 b?>	
	<?php if ($_SESSION["detalle"] == 8){ 
?> 
	 
   
</div id="TableModulo2">
    <?php  echo encadenar(10)."DETALLE DE COBRO "; ?>
	  
    <table width="40%"  border="1" cellspacing="1" cellpadding="1" align="center">
        <tr>
		   <th width="20%" scope="col"><border="0" alt="" align="center" />Concepto</th>
		   <?php if ($mon == 1){ ?>	
           <th width="20%" scope="col"><border="0" alt="" align="center" />Monto Bolivianos</th>
          <?php } ?>
		    <?php if ($mon == 2){ ?>	
           <th width="20%" scope="col"><border="0" alt="" align="center" />Monto Dolares</th>
          <?php } ?>
        </tr>
        <tr>
		   <td >Capital 4</td>
	       <td align="right" ><?php echo number_format($_SESSION['capital'], 2, '.',','); ?></td> 
		</tr>
       
		 <tr>  
	       <td >Interes Deven.</td>
	       <td align="right" ><?php echo number_format($_SESSION['intdev'], 2, '.',','); ?></td> 
		</tr>
		 <tr>  
	       <td >Interes</td>
	       <td align="right" ><?php echo number_format($_SESSION['interes'], 2, '.',','); ?></td> 
		</tr>
		<tr>  
	       <td >Interes Vencido</td>
	       <td align="right" ><?php echo number_format($_SESSION['intmora'], 2, '.',','); ?></td>
		</tr>
        <tr>  
	       <td >Interes Penal</td>
	       <td align="right" ><?php echo number_format($_SESSION['penal'], 2, '.',','); ?></td>
		</tr>
        <tr>  
	       <td >Fondo Garan.</td>
	       <td align="right" ><?php echo number_format($_SESSION['ahorro'], 2, '.',','); ?></td>
		</tr>
		<?php
	  if ($_SESSION['EMPRESA_TIPO'] == 2){
	    if ($mon == 2){
		    $itf= round(calculo_itf($_SESSION['capital']+$_SESSION['intmora']+$_SESSION['interes']),2);
		   $_SESSION['itf'] = $itf;
		    ?>    
		<tr>  
	       <td >ITF</td>
	       <td align="right" ><?php echo number_format($_SESSION['itf'], 2, '.',','); ?></td>
		</tr> 
		 <?php } 
		         }?>  
		<tr>   
	       <td style="background-color: #6699FF" align="center" >Importe Total</td>
	       <td style="background-color: #6699FF" align="right" >
		              <?php echo number_format($_SESSION['capital']+$_SESSION['interes']+$_SESSION['intdev']+
		              $_SESSION['intmora']+$_SESSION['penal']+$_SESSION['ahorro']+$_SESSION['itf'], 2, '.',','); ?></td> 
		</tr>
		</table>
		   
    <?php      echo "Vias de Pago"; ?> 
    <table width="40%"  border="1" cellspacing="1" cellpadding="1" align="center">
	     <?php if ($mon == 1){ ?> 
		<tr>    
           <th scope="col"><border="0" alt="" align="center" />Monto Dolares</th>
           <td align="right" ><input type="text" name="mon_us8" width="10"  size="12" value=0 ></td>   
	    </tr> 
		 <tr>    
           <th scope="col"><border="0" alt="" align="center" />Fondo Garan.</th>
           <td align="right" ><input type="text" name="mon_ah8" width="10"  size="12" value=0 ></td>   
	    </tr>
		 <?php }else{ ?>
		 
		 <tr>
		   <th scope="col"><border="0" alt="" align="center" />Monto Bs. en Dolares</th>
		   <td align="right" ><input type="text" name="mon_bs8" width="10"  size="12" value=0 ></td> 
		 </tr>
		 <tr>    
           <th scope="col"><border="0" alt="" align="center" />Fondo Garan.</th>
           <td align="right" ><input type="text" name="mon_ah8" width="10"  size="12" value=0 ></td>   
	    </tr>
		  <?php } //}?>
	</table>
	
	
		
		
		<?php // } //7 b?>	
		<center>
		<input type="submit" name="accion" value="Validar">
	    <!--input type="submit" name="accion" value="Salir"-->
      

	<?php } // } //7 b?>	

	 	<?php if ($_SESSION["detalle"] == 9){
	         
	          $tot_via = 0;
			  $tot_cal = 0;
			  $error = 0;
			  $via_bs = 0;
			  $via_us = 0;
			  $equi_bs = 0;
			  $equi_us = 0;
			  $_SESSION['via_bs'] = 0;
			  $_SESSION['via_us'] = 0;
			   $_SESSION['via_ah'] = 0;
			   
			  $_SESSION['monto_com'] = 0;
			  $_SESSION['dif_tc'] = 0;
			 
	  if ($_SESSION['EMPRESA_TIPO'] == 2){
	    if ($mon == 2){
		    $itf = round(calculo_itf($_SESSION['capital']+$_SESSION['intmora']+$_SESSION['interes']),2);
		   $_SESSION['itf'] = $itf;
		    ?>    
		<tr>  
	       <td >ITF</td>
	       <td align="right" ><?php echo number_format($_SESSION['itf'], 2, '.',','); ?></td>
		</tr> 
		 <?php } 
		         }  
		  $tot_cal = $_SESSION['capital'] + $_SESSION['interes'] + $_SESSION['intdev']
			          +  $_SESSION['intmora'] + $_SESSION['ahorro'] + $_SESSION['itf'] + $_SESSION['penal'];
		   if ($mon == 1){ 
		      
			 $_SESSION['via_bs'] = $tot_cal;
			 
	        //  if (isset($_POST['mon_bs8'])){
			 //     $via_bs = $_POST['mon_bs8'];
			  //    $tot_via = $_POST['mon_bs8'];
			//	   $_SESSION['via_bs'] = $via_bs;
			      //echo $_POST['mon_bs8']."en el post";
	         //     }
			  if (isset($_POST['mon_us8'])){
			     $via_us = $_POST['mon_us8'];
				 $_SESSION['via_us'] = $via_us;
				  $_SESSION['via_bs'] = $_SESSION['via_bs'] - $_SESSION['via_us'];
				 $equi_bs = $via_us * $_SESSION['TC_COMPRA'];
			     $tot_via = $tot_via + $equi_bs;
				 $monto_com = $_POST['mon_us8']*$_SESSION['TC_COMPRA'];
				 $monto_ctb = $_POST['mon_us8']*$_SESSION['TC_CONTAB'];
				 $_SESSION['monto_com'] = $monto_com;
				 $_SESSION['dif_tc'] = $monto_ctb - $monto_com;
	              }	
			   if (isset($_POST['mon_ah8'])){
			      $via_ah = $_POST['mon_ah8'];
				   $_SESSION['via_ah'] = $via_ah; 
				   $_SESSION['via_bs'] = $_SESSION['via_bs'] - $_SESSION['via_ah'];
			      $tot_via = $tot_via + $_POST['mon_ah8'];
	              }	
			//	 echo $tot_via ."dentro";
				 
				if (round($tot_cal,2) < round($tot_via,2)){
				   $error = 1;
				   }else{
				   $via_bs = $tot_cal - $tot_via;
				   $tot_via = $tot_via + $via_bs; 
				   $_SESSION['via_bs'] = $via_bs;
		  	       }
			
			
				} 
		   if ($mon == 2){ 
	            $_SESSION['via_us'] = $tot_cal;
	        //  if (isset($_POST['mon_us8'])){
			//      $via_us = $_POST['mon_us8'];
			 //     $tot_via = $_POST['mon_us8'];
			//	  $_SESSION['via_us'] = $via_us;
	
	          //    }
				//  echo $_POST['mon_us8'],"--";
			  if (isset($_POST['mon_bs8'])){
			     $via_bs = $_POST['mon_bs8'];
				 $_SESSION['via_bs'] = $via_bs;
				 $_SESSION['via_us'] = $_SESSION['via_us'] - $_SESSION['via_bs'];
				 $equi_us = $via_bs * $_SESSION['TC_VENTA'];
			     $tot_via = $tot_via + $via_bs;
				 $monto_ven = $_POST['mon_bs8']*$_SESSION['TC_VENTA'];
				 $monto_ctb = $_POST['mon_bs8']*$_SESSION['TC_CONTAB'];
				 $_SESSION['monto_ven'] = $monto_ven;
				 $_SESSION['dif_tc'] = ($monto_ven - $monto_ctb);
	
	              }	
			   if (isset($_POST['mon_ah8'])){
			      $via_ah = $_POST['mon_ah8'];
				   $_SESSION['via_ah'] = $via_ah; 
			      $tot_via = $tot_via + $_POST['mon_ah8'];
				   $_SESSION['via_us'] = $_SESSION['via_us'] - $_SESSION['via_ah'];
	
	              }	
				$via_us = $tot_cal - $tot_via;
				$tot_via = $tot_via + $via_us; 
				} 
			 
/*		  	 	*/	  	
				  
			  if (round($tot_cal,2) == round($tot_via,2)){
				   $error = 0;
				   }else{
				   echo $tot_cal.encadenar(2).$tot_via.encadenar(2).
				   "Verifique no iguala el Monto calculado con el Monto de las vias";
				   $error = 1;
				   } 
				if ($_POST['mon_ah8'] > round(($depos-$ret),2)){
				   echo "Verifique Monto Fondo Garantia mayor al Saldo de la cuenta";
				   $error = 1;
				   }  
			/* */     	   
			//	echo "Error".$error;      	    
	 ?>     
	 
   
   </div id="TableModulo2">
    <?php  echo encadenar(8)."DETALLE DE COBRO VALIDADO "; ?>  
    <table width="40%"  border="1" cellspacing="1" cellpadding="1" align="center">
        <tr>
		   <th width="20%" scope="col"><border="0" alt="" align="center" />Concepto</th>
		   <?php if ($mon == 1){ ?>	
           <th width="20%" scope="col"><border="0" alt="" align="center" />Monto Bolivianos</th>
          <?php } ?>
		    <?php if ($mon == 2){ ?>	
           <th width="20%" scope="col"><border="0" alt="" align="center" />Monto Dolares</th>
          <?php } ?>
        </tr>
        <tr>
		   <td >Capital </td>
	       <td align="right" ><?php echo number_format($_SESSION['capital'], 2, '.',','); ?></td> 
		</tr>
		<tr>  
	       <td >Interes Deven</td>
	       <td align="right" ><?php echo number_format($_SESSION['intdev'], 2, '.',','); ?></td> 
		</tr>
        <tr>  
	       <td >Interes</td>
	       <td align="right" ><?php echo number_format($_SESSION['interes'], 2, '.',','); ?></td> 
		</tr>
		<tr>  
	       <td >Interes Vencido</td>
	       <td align="right" ><?php echo number_format($_SESSION['intmora'], 2, '.',','); ?></td>
		</tr>
        <tr>  
	       <td >Interes Penal</td>
	       <td align="right" ><?php echo number_format($_SESSION['penal'], 2, '.',','); ?></td>
		</tr>
        
		<tr>  
	       <td >Fondo Garantia</td>
	       <td align="right" ><?php echo number_format($_SESSION['ahorro'], 2, '.',','); ?></td>
		</tr> 
		<?php
	  if ($_SESSION['EMPRESA_TIPO'] == 2){
	    if ($mon == 2){ ?>    
		<tr>  
	       <td >ITF </td>
	       <td align="right" ><?php echo number_format($_SESSION['itf'], 2, '.',','); ?></td>
		</tr> 
		 <?php } 
		         }?>  
		<tr>   
	       <td style="background-color: #6699FF" align="center" >Importe Total</td>
	       <td style="background-color: #6699FF" align="right" >
		              <?php echo number_format($_SESSION['capital']+$_SESSION['interes']+$_SESSION['intdev']+
		              $_SESSION['intmora']+$_SESSION['penal']+$_SESSION['ahorro']+$_SESSION['itf'], 2, '.',','); ?></td> 
		</tr>
		</table>
		   
    <?php if ($error == 0){      
   	         echo "Vias de Pago Bien ";
		    ?> 
    <table width="50%"  border="1" cellspacing="1" cellpadding="1" align="center">
	  <?php if ($mon == 1){?> 
	      <tr>
		    <th width="25%" scope="col"><border="0" alt="" align="center" />Descrip.</th>
		    <th width="20%" scope="col"><border="0" alt="" align="center" />Bolivianos</th>
		    <th width="20%" scope="col"><border="0" alt="" align="center" />TC. Compra</th>
		    <th width="20%" scope="col"><border="0" alt="" align="center" />Dolares</th>
		   </tr>
		   <tr>
		   <td align="left" ><?php echo "Efectivo Bs."; ?></td> 
		   <td align="right" ><?php echo number_format($_SESSION['via_bs'], 2, '.',','); ?></td> 
		   <td align="right" ><?php echo encadenar(6); ?></td> 
		   <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td> 
		 </tr>
		 <tr>
		    <td align="left" ><?php echo "Efectivo Dol."; ?></td>
		   <td align="right" ><?php echo number_format($_SESSION['via_us']*$_SESSION['TC_COMPRA'], 2, '.',','); ?></td> 
		   <td align="right" ><?php echo number_format($_SESSION['TC_COMPRA'], 2, '.',','); ?></td> 
		   <td align="right" ><?php echo number_format($_SESSION['via_us'], 2, '.',','); ?></td> 
		 </tr>
		 <tr>
		    <td align="left" ><?php echo "Fondo Garantia"; ?></td>
		   <td align="right" ><?php echo number_format($_SESSION['via_ah'], 2, '.',','); ?></td> 
		   <td align="right" ><?php echo encadenar(6); ?></td> 
		   <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td> 
		 </tr>
	   	<?php } ?>    
	     <?php if ($mon == 2){?> 
	      <tr>
		     <th width="20%" scope="col"><border="0" alt="" align="center" />Descrip.</th>
		    <th width="20%" scope="col"><border="0" alt="" align="center" />Dolares</th>
		    <th width="20%" scope="col"><border="0" alt="" align="center" />TC. Venta</th>
		    <th width="20%" scope="col"><border="0" alt="" align="center" />Bolivianos</th>
		   </tr>
		   <tr>
		    <td align="left" ><?php echo "Efectivo Dol."; ?></td>
		   <td align="right" ><?php echo number_format($_SESSION['via_us'], 2, '.',','); ?></td> 
		   <td align="right" ><?php echo encadenar(6); ?></td> 
		   <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td> 
		 </tr>
		 <tr>
		   <td align="left" ><?php echo "Efectivo Bs."; ?></td>
		   <td align="right" ><?php echo number_format($_SESSION['via_bs'], 2, '.',','); ?></td> 
		   <td align="right" ><?php echo  number_format($_SESSION['TC_VENTA'], 2, '.',','); ?></td> 
		   <td align="right" ><?php echo number_format($_SESSION['via_bs']*$_SESSION['TC_VENTA'], 2, '.',','); ?></td> 
		 </tr>
		  <tr>
		    <td align="left" ><?php echo "Fdo. Garantia"; ?></td>
		   <td align="right" ><?php echo number_format($_SESSION['via_ah'], 2, '.',','); ?></td> 
		   <td align="right" ><?php echo encadenar(6); ?></td> 
		   <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td> 
		 </tr>
	   	<?php } ?>
			  
	  	
		
	  </table>	
	   <?php if ($_SESSION['cargo'] == 4){ 
		       if (($t_cred == 1)&& ($tope < 1)) {
		       $num_cli = 0;
			   $tot_cta_i = 0;
			   $cta_i = 0;
			    echo "Detalle Individual";
			   ?>
		<br>
			   
		
		
		  <table width="60%"  border="1" cellspacing="1" cellpadding="1" align="center">
		  
		 <tr>
		 <th align="center"><font size="-1">Nro.</th>
	    <th align="center"><font size="-1">CLIENTE</th>
		<th align="center"><font size="-1">TOTAL CUOTA</th>
		<th align="center"><font size="-1">MONTO PAGADO</th>
		
		</tr>
		 
		 
		<?php
		
		 $con_cpla = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sol
		             and CRED_PLD_NRO_CTA = $f_cta
		             and CRED_PLD_USR_BAJA is null ";
         $res_cpla = mysql_query($con_cpla)or die('No pudo leer : cred_plandp' . mysql_error());
		 
		 while ($lin_cpla = mysql_fetch_array($res_cpla)) {
		        $num_cli = $num_cli + 1;
                $cta_nro = $lin_cpla['CRED_PLD_NRO_CTA']; 
		        $cta_fec = $lin_cpla['CRED_PLD_FECHA']; 
				$cta_cap = $lin_cpla['CRED_PLD_CAPITAL'];
		        $cta_int = $lin_cpla['CRED_PLD_INTERES'];
		        $cta_aho = $lin_cpla['CRED_PLD_AHORRO'];
				$cta_cli = $lin_cpla['CRED_PLD_COD_CLI'];
				 if ($p_int == 1) { 
				     $cta_i = $cta_cap+$cta_int+$cta_aho;
				   }
				 if ($p_int == 4) { 
				     $cta_i = $cta_cap+$cta_aho;
				   }  
				 $tot_cta_i = $tot_cta_i + $cta_i;
			$con_pcli  = "Select * From cliente_general
             where CLIENTE_COD = $cta_cli and 
			       CLIENTE_USR_BAJA is null"; 
             $res_pcli = mysql_query($con_pcli)or die('No pudo seleccionarse cliente_general');
 
             while ($lin_pcli = mysql_fetch_array($res_pcli)) {
			 $nom_clip = $lin_pcli['CLIENTE_AP_PATERNO'].encadenar(1).
					$lin_pcli['CLIENTE_AP_MATERNO'].encadenar(1).
					$lin_pcli['CLIENTE_AP_ESPOSO'].encadenar(1).
					$lin_pcli['CLIENTE_NOMBRES'];
			 
			 }
				
		?>		
		<tr>
		<td align="center" ><?php echo number_format($num_cli,0, '.',','); ?></td>
	   	<td align="left" style="font-size:10px" ><?php echo $nom_clip; ?></td>
		<td align="right" ><?php echo number_format($cta_i, 2, '.',','); ?></td>
		<?php if(isset($num_cli)){
		if ($num_cli == 1){
		   $_SESSION["cli_1"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_1" width="10"  
		size="20" value="<?=$cta_i;?>" ></td>	
		
		 <?php } }?></td>  
		 <?php if(isset($num_cli)){
		if ($num_cli == 2){
		  $_SESSION["cli_2"] = $cta_cli; ?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_2" width="10"  
		size="20" value="<?=$cta_i;?>" ></td>
		
			 <?php } }?></td>  
		<?php if(isset($num_cli)){
		if ($num_cli == 3){
		    $_SESSION["cli_3"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_3" width="10"  
		size="20" value="<?=$cta_i;?>" ></td>	
			
			 <?php } }?></td> 	
		<?php if(isset($num_cli)){
		if ($num_cli == 4){
		    $_SESSION["cli_4"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_4" width="10"  
		size="20" value="<?=$cta_i;?>" ></td>
			
			 <?php } }?></td> 
		<?php if(isset($num_cli)){
		if ($num_cli == 5){
		    $_SESSION["cli_5"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_5" width="10"  
		size="20" value="<?=$cta_i;?>" ></td>
		
			 <?php } }?></td> 	
		<?php if(isset($num_cli)){
		if ($num_cli == 6){
		   $_SESSION["cli_6"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_6" width="10"  
		size="20" value="<?=$cta_i;?>" ></td>
			
			 <?php } }?></td> 	 	  	 	 	  
		<?php if(isset($num_cli)){
		if ($num_cli == 7){
		   $_SESSION["cli_7"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_7" width="10"  
		size="20" value="<?=$cta_i;?>" ></td>	
		
			 <?php } }?></td> 
		<?php if(isset($num_cli)){
		if ($num_cli == 8){
		   $_SESSION["cli_8"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_8" width="10"  
		size="20" value="<?=$cta_i;?>" ></td>
			
			 <?php } }?></td> 		 	 	 
		<?php if(isset($num_cli)){
		if ($num_cli == 9){
		   $_SESSION["cli_9"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_9" width="10"  
		size="20" value="<?=$cta_i;?>" ></td>	
			
			 <?php } }?></td> 
		<?php if(isset($num_cli)){
		if ($num_cli == 10){
		   $_SESSION["cli_10"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_10" width="10"  
		size="20" value="<?=$cta_i;?>" ></td>
			
			 <?php } }?></td> 	
		<?php if(isset($num_cli)){
		if ($num_cli == 11){
		   $_SESSION["cli_11"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_11" width="10"  
		size="20" value="<?=$cta_i;?>" ></td>	
		
			 <?php } }?></td> 	 	 		 
		<?php if(isset($num_cli)){
		if ($num_cli == 12){
		    $_SESSION["cli_12"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_12" width="10"  
		size="20" value="<?=$cta_i;?>" ></td>	
			
			 <?php } }?></td> 	 
		<?php if(isset($num_cli)){
		if ($num_cli == 13){
		   $_SESSION["cli_13"] = $cta_cli; ?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_13" width="10"  
		size="20" value="<?=$cta_i;?>" ></td>	
		
			 <?php } }?></td> 	 
		<?php if(isset($num_cli)){
		if ($num_cli == 14){
		   $_SESSION["cli_14"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_14" width="10"  
		size="20" value="<?=$cta_i;?>" ></td>	
		
			 <?php } }?></td> 	 
		<?php if(isset($num_cli)){
		if ($num_cli == 15){
		   $_SESSION["cli_15"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_15" width="10"  
		size="20" value="<?=$cta_i;?>" ></td>
			
			 <?php } }?></td> 	 
		<?php if(isset($num_cli)){
		if ($num_cli == 16){
		    $_SESSION["cli_16"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_16" width="10"  
		size="20" value="<?=$cta_i;?>" ></td>	
		
			 <?php } }?></td> 	 
		<?php if(isset($num_cli)){
		if ($num_cli == 17){
		   $_SESSION["cli_17"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_17" width="10"  
		size="20" value="<?=$cta_i;?>" ></td>	
			
			 <?php } }?></td> 	 
		<?php if(isset($num_cli)){
		if ($num_cli == 18){
		    $_SESSION["cli_18"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_18" width="10"  
		size="20" value="<?=$cta_i;?>" ></td>	
			
			 <?php } }?></td> 	 
		<?php if(isset($num_cli)){
		if ($num_cli == 19){
		   $_SESSION["cli_19"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_19" width="10"  
		size="20" value="<?=$cta_i;?>" ></td>
		
			 <?php } }?></td> 	 
		<?php if(isset($num_cli)){
		if ($num_cli == 20){?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_20" width="10"  
		size="20" value="<?=$cta_i;?>" ></td>
		
			 <?php } }?></td> 	 
				
				
	<?php }	?>
	<tr>
		<td align="center" ><?php echo encadenar(2); ?></td>
	   	<th align="left" ><?php echo "Total"; ?></td>
		<th align="right" ><?php echo number_format($tot_cta_i, 2, '.',','); ?></td>
	 	<td align="right" ><?php echo encadenar(2); ?></td>	
		
	</tr>		
	
	
	
		</table>
		<center>
		<input type="submit" name="accion" value="Valida_Ind">
	    <!--input type="submit" name="accion" value="Salir"-->
      
</form>	
         
	<br><br>	  
<?php    }else{?>
	  
	  
	  
	  	
		<input type="submit" name="accion" value="Imprimir">
	    <!--input type="submit" name="accion" value="Salir"-->
      
</form>	
 <?php } }?>  
    <?php }else{ //7 b
	   echo "Vias de Pago Mal"; ?> 
    <table width="40%"  border="1" cellspacing="1" cellpadding="1" align="center">
        <tr>
		   <th scope="col"><border="0" alt="" align="center" />Monto Bolivianos</th>
		   <td align="right" ><input type="text" name="mon_bs8" width="10"  size="12" value="<?=$_SESSION['via_bs'];?>" ></td> 
		 </tr>
		 <tr>    
           <th scope="col"><border="0" alt="" align="center" />Monto Dolares</th>
           <td align="right" ><input type="text" name="mon_us8" width="10"  size="12" value="<?=$_SESSION['via_us'];?>" ></td>   
	    </tr> 
		 <tr>    
           <th scope="col"><border="0" alt="" align="center" />Fondo Garantia</th>
           <td align="right" ><input type="text" name="mon_ah8" width="10"  size="12" value="<?=$_SESSION['via_ah'];?>" ></td>   
	    </tr>
	</table>
		
		<input type="submit" name="accion" value="Validar">
	    <!--input type="submit" name="accion" value="Salir"-->
      
</form>	
		<?php } //7 b?>	
	<?php } //7 b?>	
	
<?php  //Det-Contable detalle 10?>		
	<?php if ($_SESSION["detalle"] == 10){
	 $_SESSION['itf'] =0;
	 if ($_SESSION['EMPRESA_TIPO'] == 2){
	    if ($mon == 2){
		    $itf= calculo_itf($_SESSION['capital']+$_SESSION['intmora']+$_SESSION['interes']+$_SESSION['intdev']);
		   $_SESSION['itf'] = $itf;
	    }else{
		 $_SESSION['itf'] =0;
		} 
	}	
 //Iniciar variables contables
		  $_SESSION['nro_tran_cart'] = 0;
		  $_SESSION['nro_tran_fond'] = 0;
		  $_SESSION['pag_cap'] = 0;
		  $_SESSION['pag_int'] = 0;
		  $_SESSION['pag_dev'] = 0;
		  $_SESSION['cta_dev'] = 0;
		  $_SESSION['cta_int'] = 0;
		  $_SESSION['pag_pen'] = 0;
		  $_SESSION['cta_pen'] = 0;
		  $_SESSION['dep_aho'] = 0;
		  $_SESSION['ret_aho'] = 0; 
		  $_SESSION['m_itf'] = 0; 
		  $_SESSION['sal_ant'] = 0;
		  $_SESSION['sal_des'] = 0;
		  $_SESSION['fec_vto'] = "";
		  $_SESSION['nom_cli'] = "";
		  $_SESSION['des_mon'] = "";
		  
		  //Asigna los valores
		  $_SESSION['nom_cli'] = $nom_tit;
		  $_SESSION['nom_grp'] = $nom_grp;
		  $_SESSION['des_mon'] = $d_mon;
		  $_SESSION['sig_mon'] = $s_mon; 
		  $descr = $nom_grp." / ".$nom_tit;
		  $ncre = $_SESSION['ncre'];
		  echo $_SESSION['ncre']."s_ncre";
		  $_SESSION['sal_ant'] = $impo-$mon_pcap;
		  $_SESSION['sal_des'] = 0;
		  $_SESSION['nro_cta'] =  $f_cta;
	      //Nro Cuota
		  $sal_ant = $_SESSION['sal_ant'];
		  $sal_des = $_SESSION['sal_ant'] - $_SESSION['capital'];
		  $importe = 0;
		  $importe_e = 0;
		  $cta_ctb = 0;
		  $deb_hab = 0;
		  $apli = 10000;
		  $nro_tr_caj = 0;
		 $nro_tr_fond = 0; 
		 $tc_ctb = $_SESSION['TC_CONTAB'];
		  $nro_tr_cart = leer_nro_co_car(2,$log_usr);
		  $_SESSION['nro_tran_cart'] = $nro_tr_cart;
		  
	      if (($_SESSION['via_bs'] + $_SESSION['via_us'])  > 0){
		     $nro_tr_caj = leer_nro_co_cja($apli,$log_usr);
			 $_SESSION['nro_tr_caj'] = $nro_tr_caj;
			 $cod_ap = 2;
			// echo $nro_tr_caj."caja";
		  }
		  if ($_SESSION['via_ah'] > 0){
		     $cod_ap = 2;
		  }
		 if ($_SESSION['ahorro'] > 0){
		   	 $cod_ap = 2;
		  }
		  
	//Via Bolivianos	  
		  if ($_SESSION['via_bs'] > 0){
		     if ($mon == 1){
			     $importe = $_SESSION['via_bs'];
				 $importe_e = $_SESSION['via_bs'];
			}	
			if ($mon == 2){
			     $importe = $_SESSION['via_bs']*$_SESSION['TC_VENTA'];
				 $importe_e = $_SESSION['via_bs']*$_SESSION['TC_VENTA'];
			}	 
			  $cta_ctb = 11101101;
			  
			  $deb_hab = 1;
//  Graba temporal
			/*   */
//Graba Caja
$cod_ap = 2;
$consulta = "insert into caja_transac (CAJA_TRAN_NRO_COR, 
                                       CAJA_TRAN_AGE_CJRO,
									   CAJA_TRAN_AGE_ORG,
									   CAJA_TRAN_COD_SC,
									   CAJA_TRAN_FECHA,
					                   CAJA_TRAN_CAJERO1,
					                   CAJA_TRAN_APL_ORG,
   				                       CAJA_TRAN_TIPO_OPE,
					                   CAJA_TRAN_NRO_DOC, 
									   CAJA_TRAN_NRO_CAR, 
									   CAJA_TRAN_NRO_FON, 
									   CAJA_TRAN_CAJERO2,
                                       CAJA_TRAN_APL_DES,
                                       CAJA_TRAN_DOC_EQUIV,
                                       CAJA_TRAN_VIA_PAG,
                                       CAJA_TRAN_REL_FAC,
                                       CAJA_TRAN_DEB_CRED,
									   CAJA_TRAN_CTA_CONT,
                                       CAJA_TRAN_IMPORTE,
                                       CAJA_TRAN_IMP_EQUIV,
                                       CAJA_TRAN_MON,
                                       CAJA_TRAN_TIP_CAMB,
                                       CAJA_TRAN_DESCRIP,
                                       CAJA_TRAN_USR_ALTA,
                                       CAJA_TRAN_FCH_HR_ALTA,
									   CAJA_TRAN_USR_BAJA,
									   CAJA_TRAN_FCH_HR_BAJA
									   ) values ($nro_tr_caj,
									             $c_agen,
												 $c_agen,
												 $ncre,
												 '$fec1',
												 '$log_usr',
												 $cod_ap,
												 6,
												 $nro_tr_caj,
												 $nro_tr_cart,
												 $nro_tr_fond,
												 '$log_usr',
												 6000,
												 null,
												 null,
 											     null,
												 null,
												 $cta_ctb,
												 $importe,
										         $importe_e,
												 1,
												 $tc_ctb,
												 '$descr',				 
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_transac : ' . mysql_error());
$_SESSION['fechr_proc'] = leer_fechr_pro($nro_tr_caj);
//echo $ncre,"*",$c_agen,"*",$nro_tr_cart,"*",$f_cta,"*",$deb_hab,"*",$cta_ctb,"*",$importe,"*",$importe_e,"*",$fec1,"*",$tc_ctb,"*",$log_usr;




}



$consulta = "insert into cart_det_tran(CART_DTRA_NCRE, 
                                           CART_DTRA_AGEN,
									       CART_DTRA_NRO_TRAN,
										   CART_DTRA_NRO_CTA,
									       CART_DTRA_FECHA,
					                       CART_DTRA_TIP_TRAN,
   				                           CART_DTRA_CCON,
					                       CART_DTRA_DEB_CRE, 
									       CART_DTRA_CTA_CBT, 
									       CART_DTRA_IMPO, 
									       CART_DTRA_IMPO_BS,
                                           CART_DTRA_FEC_TRAN,
                                           CART_DTRA_FEC_INI2,
                                           CART_DTRA_FEC_FIN,
                                           CART_DTRA_TASA,
										   CART_DTRA_EST_ANT,
										   CART_DTRA_VIA,
										   CART_DTRA_TIP_CAM,
										   CART_DTRA_USR_ALTA,
										   CART_DTRA_FCH_HR_ALTA,
										   CART_DTRA_USR_BAJA,
										   CART_DTRA_FCH_HR_BAJA
									       ) values ($ncre,
									                 $c_agen,
												     $nro_tr_cart,
													 $f_cta,
													 '$fec1',
												     2,
												     111,
													 $deb_hab,
												     '$cta_ctb',
													 $importe,
													 $importe_e,
 											     	 '$fec1',
												     null,
													 null,
													 0,
													 null,
													 null,
												     $tc_ctb,
												    '$log_usr',
												     null,
												     null,
												    '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar cart_det_tran 1: ' . mysql_error()); 


    //        } 
			
	// Via Dolares		 
			if ($_SESSION['via_us'] > 0){
		      $cta_ctb = 11101201;
			  
			  $importe_e = $_SESSION['via_us'];
			  $importe =$_SESSION['via_us']*$_SESSION['TC_CONTAB'];
			 
			  $deb_hab = 1;
//Graba temporal			  
			/*  
*/
//Graba Caja
$cod_ap = 2;
$consulta = "insert into caja_transac (CAJA_TRAN_NRO_COR, 
                                       CAJA_TRAN_AGE_CJRO,
									   CAJA_TRAN_AGE_ORG,
									   CAJA_TRAN_COD_SC,
									   CAJA_TRAN_FECHA,
					                   CAJA_TRAN_CAJERO1,
					                   CAJA_TRAN_APL_ORG,
   				                       CAJA_TRAN_TIPO_OPE,
					                   CAJA_TRAN_NRO_DOC, 
									   CAJA_TRAN_NRO_CAR, 
									   CAJA_TRAN_NRO_FON, 
									   CAJA_TRAN_CAJERO2,
                                       CAJA_TRAN_APL_DES,
                                       CAJA_TRAN_DOC_EQUIV,
                                       CAJA_TRAN_VIA_PAG,
                                       CAJA_TRAN_REL_FAC,
                                       CAJA_TRAN_DEB_CRED,
									   CAJA_TRAN_CTA_CONT,
                                       CAJA_TRAN_IMPORTE,
                                       CAJA_TRAN_IMP_EQUIV,
                                       CAJA_TRAN_MON,
                                       CAJA_TRAN_TIP_CAMB,
                                       CAJA_TRAN_DESCRIP,
                                       CAJA_TRAN_USR_ALTA,
                                       CAJA_TRAN_FCH_HR_ALTA,
									   CAJA_TRAN_USR_BAJA,
									   CAJA_TRAN_FCH_HR_BAJA
									   ) values ($nro_tr_caj,
									             $c_agen,
												 $c_agen,
												 $ncre,
												 '$fec1',
												 '$log_usr',
												 $cod_ap,
												 6,
												 $nro_tr_caj,
												 $nro_tr_cart,
												 $nro_tr_fond,
												 '$log_usr',
												 6000,
												 null,
												 null,
 											     null,
												 null,
												 $cta_ctb,
												 $importe,
										         $importe_e,
												 2,
												 $tc_ctb,
												 '$descr',				 
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_transac : ' . mysql_error());
$_SESSION['fechr_proc'] = leer_fechr_pro($nro_tr_caj);


$mon_cta = substr($cta_ctb,5,1);
if ($mon_cta = 2){
    $imp = $importe;
	$importe = $importe_e;
	$importe_e = $imp;
}

$consulta = "insert into cart_det_tran(CART_DTRA_NCRE, 
                                           CART_DTRA_AGEN,
									       CART_DTRA_NRO_TRAN,
										   CART_DTRA_NRO_CTA,
									       CART_DTRA_FECHA,
					                       CART_DTRA_TIP_TRAN,
   				                           CART_DTRA_CCON,
					                       CART_DTRA_DEB_CRE, 
									       CART_DTRA_CTA_CBT, 
									       CART_DTRA_IMPO, 
									       CART_DTRA_IMPO_BS,
                                           CART_DTRA_FEC_TRAN,
                                           CART_DTRA_FEC_INI2,
                                           CART_DTRA_FEC_FIN,
                                           CART_DTRA_TASA,
										   CART_DTRA_EST_ANT,
										   CART_DTRA_VIA,
										   CART_DTRA_TIP_CAM,
										   CART_DTRA_USR_ALTA,
										   CART_DTRA_FCH_HR_ALTA,
										   CART_DTRA_USR_BAJA,
										   CART_DTRA_FCH_HR_BAJA
									       ) values ($ncre,
									                 $c_agen,
												     $nro_tr_cart,
													 $f_cta,
													 '$fec1',
												     2,
												     111,
													 $deb_hab,
												     '$cta_ctb',
													 $importe,
													 $importe_e,
 											     	 '$fec1',
												     null,
													 null,
													 0,
													 null,
													 null,
												     $tc_ctb,
												    '$log_usr',
												     null,
												     null,
												    '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar cart_det_tran 2 : ' . mysql_error()); 

            } 
			
	//Via Ahorro
			//echo "aqui 2".$_SESSION['via_ah']; 
	       if ($_SESSION['via_ah'] > 0){
		      $nro_tr_fond = leer_nro_co_fon(2,$log_usr); 
		      $cta_fong = leer_cta_car(2,$tope,3,$mon);
              $cta_tip =  leer_cta_tip(2,$tope,3,$mon);
		      $importe = $_SESSION['via_ah'];
			  if ($mon == 1){
				 $importe_e = $_SESSION['via_ah'];
			  }
			  if ($mon == 2){
			     $importe = $_SESSION['via_ah']; 
			     $importe_e = $_SESSION['via_ah'] * $_SESSION['TC_CONTAB'];
			  }
			  $deb_hab = 1;
	//Graba Temporal		  
		/*	  */
//Caja Retiro de Fondo de Garantia

$cod_ap = 2;
$consulta = "insert into caja_transac (CAJA_TRAN_NRO_COR, 
                                       CAJA_TRAN_AGE_CJRO,
									   CAJA_TRAN_AGE_ORG,
									   CAJA_TRAN_COD_SC,
									   CAJA_TRAN_FECHA,
					                   CAJA_TRAN_CAJERO1,
					                   CAJA_TRAN_APL_ORG,
   				                       CAJA_TRAN_TIPO_OPE,
					                   CAJA_TRAN_NRO_DOC, 
									   CAJA_TRAN_NRO_CAR, 
									   CAJA_TRAN_NRO_FON, 
									   CAJA_TRAN_CAJERO2,
                                       CAJA_TRAN_APL_DES,
                                       CAJA_TRAN_DOC_EQUIV,
                                       CAJA_TRAN_VIA_PAG,
                                       CAJA_TRAN_REL_FAC,
                                       CAJA_TRAN_DEB_CRED,
									   CAJA_TRAN_CTA_CONT,
                                       CAJA_TRAN_IMPORTE,
                                       CAJA_TRAN_IMP_EQUIV,
                                       CAJA_TRAN_MON,
                                       CAJA_TRAN_TIP_CAMB,
                                       CAJA_TRAN_DESCRIP,
                                       CAJA_TRAN_USR_ALTA,
                                       CAJA_TRAN_FCH_HR_ALTA,
									   CAJA_TRAN_USR_BAJA,
									   CAJA_TRAN_FCH_HR_BAJA
									   ) values ($nro_tr_caj,
									             $c_agen,
												 $c_agen,
												 $ncre,
												 '$fec1',
												 '$log_usr',
												 $cod_ap,
												 11,
												 $nro_tr_caj,
												 $nro_tr_cart,
												 $nro_tr_fond,
												 '$log_usr',
												 11000,
												 null,
												 null,
 											     null,
												 null,
												 $cta_ctb,
												 $importe_e * -1,
										         $importe * -1,
												 1,
												 $tc_ctb,
												 '$descr',				 
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_transac : ' . mysql_error());
$_SESSION['fechr_proc'] = leer_fechr_pro($nro_tr_caj);
//Caja Ingreso de Fondo de Garantia para aplicar al credito
$cod_ap = 2;
$consulta = "insert into caja_transac (CAJA_TRAN_NRO_COR, 
                                       CAJA_TRAN_AGE_CJRO,
									   CAJA_TRAN_AGE_ORG,
									   CAJA_TRAN_COD_SC,
									   CAJA_TRAN_FECHA,
					                   CAJA_TRAN_CAJERO1,
					                   CAJA_TRAN_APL_ORG,
   				                       CAJA_TRAN_TIPO_OPE,
					                   CAJA_TRAN_NRO_DOC, 
									   CAJA_TRAN_NRO_CAR, 
									   CAJA_TRAN_NRO_FON, 
									   CAJA_TRAN_CAJERO2,
                                       CAJA_TRAN_APL_DES,
                                       CAJA_TRAN_DOC_EQUIV,
                                       CAJA_TRAN_VIA_PAG,
                                       CAJA_TRAN_REL_FAC,
                                       CAJA_TRAN_DEB_CRED,
									   CAJA_TRAN_CTA_CONT,
                                       CAJA_TRAN_IMPORTE,
                                       CAJA_TRAN_IMP_EQUIV,
                                       CAJA_TRAN_MON,
                                       CAJA_TRAN_TIP_CAMB,
                                       CAJA_TRAN_DESCRIP,
                                       CAJA_TRAN_USR_ALTA,
                                       CAJA_TRAN_FCH_HR_ALTA,
									   CAJA_TRAN_USR_BAJA,
									   CAJA_TRAN_FCH_HR_BAJA
									   ) values ($nro_tr_caj,
									             $c_agen,
												 $c_agen,
												 $ncre,
												 '$fec1',
												 '$log_usr',
												 $cod_ap,
												 6,
												 $nro_tr_caj,
												 $nro_tr_cart,
												 $nro_tr_fond,
												 '$log_usr',
												 6000,
												 null,
												 null,
 											     null,
												 null,
												 $cta_ctb,
												 $importe_e,
										         $importe,
												 1,
												 $tc_ctb,
												 '$descr',				 
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_transac : ' . mysql_error());

//echo "Fondo cabecera";
//$nro_tr_fond = $_SESSION['nro_tran_fond2'];
$consulta = "insert into fond_cabecera (FOND_CAB_NCTA, 
                                         FOND_CAB_AGEN,
									     FOND_CAB_NRO_TRAN,
									     FOND_CAB_TRAN_CAJ,
										 FOND_CAB_TRAN_CAR,
									     FOND_CAB_FECHA,
					                     FOND_CAB_TIP_TRAN,
					                     FOND_CAB_EST_ANT,
   				                         FOND_CAB_EST_ACT,
					                     FOND_CAB_TIP_CAM, 
									     FOND_CAB_FEC_TRAN, 
									     FOND_CAB_FEC_VTO, 
									     FOND_CAB_FEC_SUS,
                                         FOND_CAB_USR_ALTA,
                                         FOND_CAB_FCH_HR_ALTA,
                                         FOND_CAB_USR_BAJA,
                                         FOND_CAB_FCH_HR_BAJA
									    ) values ($cta,
									             $c_agen,
												 $nro_tr_fond,
												 $nro_tr_caj,
												 $nro_tr_cart,
												 '$fec1',
												 2,
												 null,
												 null,
 											     $tc_ctb,
												 '$fec1',
												 null,
												 null,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar fon_cabecera : ' . mysql_error());
//echo "Fondo detalle";
$consulta = "insert into fond_det_tran(FOND_DTRA_NCTA, 
                                           FOND_DTRA_AGEN,
										   FOND_DTRA_NCRE,
									       FOND_DTRA_NRO_TRAN,
										   FOND_DTRA_NRO_CTA,
									       FOND_DTRA_FECHA,
					                       FOND_DTRA_TIP_TRAN,
   				                           FOND_DTRA_CCON,
					                       FOND_DTRA_DEB_CRE, 
									       FOND_DTRA_CTA_CBT, 
									       FOND_DTRA_IMPO, 
									       FOND_DTRA_IMPO_BS,
                                           FOND_DTRA_FEC_TRAN,
                                           FOND_DTRA_FEC_INI2,
                                           FOND_DTRA_FEC_FIN,
                                           FOND_DTRA_TASA,
										   FOND_DTRA_EST_ANT,
										   FOND_DTRA_VIA,
										   FOND_DTRA_TIP_CAM,
										   FOND_DTRA_USR_ALTA,
										   FOND_DTRA_FCH_HR_ALTA,
										   FOND_DTRA_USR_BAJA,
										   FOND_DTRA_FCH_HR_BAJA
									       ) values ($cta,
									                 $c_agen,
													 $ncre,
												     $nro_tr_fond,
													 1,
													 '$fec1',
												     2,
												     212,
													 2,
												     '$cta_fong',
													 $importe,
													 $importe_e,
 											     	 '$fec1',
												     null,
													 null,
													 0,
													 null,
													 null,
												     $tc_ctb,
												    '$log_usr',
												     null,
												     null,
												    '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar fon_det_tran : ' . mysql_error()); 
//Grabar en Cartera
$consulta = "insert into cart_det_tran(CART_DTRA_NCRE, 
                                           CART_DTRA_AGEN,
									       CART_DTRA_NRO_TRAN,
										   CART_DTRA_NRO_CTA,
									       CART_DTRA_FECHA,
					                       CART_DTRA_TIP_TRAN,
   				                           CART_DTRA_CCON,
					                       CART_DTRA_DEB_CRE, 
									       CART_DTRA_CTA_CBT, 
									       CART_DTRA_IMPO, 
									       CART_DTRA_IMPO_BS,
                                           CART_DTRA_FEC_TRAN,
                                           CART_DTRA_FEC_INI2,
                                           CART_DTRA_FEC_FIN,
                                           CART_DTRA_TASA,
										   CART_DTRA_EST_ANT,
										   CART_DTRA_VIA,
										   CART_DTRA_TIP_CAM,
										   CART_DTRA_USR_ALTA,
										   CART_DTRA_FCH_HR_ALTA,
										   CART_DTRA_USR_BAJA,
										   CART_DTRA_FCH_HR_BAJA
									       ) values ($ncre,
									                 $c_agen,
												     $nro_tr_cart,
													 $f_cta,
													 '$fec1',
												     2,
												     212,
													 1,
												     '$cta_fong',
													 $importe,
													 $importe_e,
 											     	 '$fec1',
												     null,
													 null,
													 0,
													 null,
													 null,
												     $tc_ctb,
												    '$log_usr',
												     null,
												     null,
												    '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar cart_det_tran : ' . mysql_error()); 




 
            }  
	echo $_SESSION['nro_rec']."nro recib";
		
			
//Cabecera Cartera
if (($_SESSION['capital'] +$_SESSION['interes'] + $_SESSION['intmora'] + $_SESSION['ahorro']+
     $_SESSION['penal']) > 0){
   $_SESSION['prox_ven'] = cta_venf($ncre);
	  $prox_ven =  $_SESSION['prox_ven'];	
   $cta_p = $_SESSION['cuota'];
   echo "cuota_d".$_SESSION['cuota_d']."--";
   if ($_SESSION['cuota_d'] <> '0'){
       $cta_p = $_SESSION['cuota_d']."-".$cta_p;
  	}
	$_SESSION['cuota'] =  $cta_p;		
	echo "Cuotas ".$cta_p;
   $consulta = "insert into cart_cabecera (CART_CAB_NCRE, 
                                         CART_CAB_AGEN,
									     CART_CAB_NRO_TRAN,
									     CART_CAB_TRAN_CAJ,
										 CART_CAB_TRAN_FON,
									     CART_CAB_FECHA,
										 CART_CAB_NRO_CTA,
					                     CART_CAB_TIP_TRAN,
										 CART_CAB_SAL_ANT,
										 CART_CAB_SAL_DES,
					                     CART_CAB_EST_ANT,
   				                         CART_CAB_EST_ACT,
					                     CART_CAB_TIP_CAM, 
									     CART_CAB_FEC_TRAN, 
									     CART_CAB_FEC_VTO, 
									     CART_CAB_FEC_SUS,
                                         CART_CAB_USR_ALTA,
                                         CART_CAB_FCH_HR_ALTA,
                                         CART_CAB_USR_BAJA,
                                         CART_CAB_FCH_HR_BAJA
									    ) values ($ncre,
									             $c_agen,
												 $nro_tr_cart,
												 $nro_tr_caj,
												 $nro_tr_fond,
												 '$fec1',
												 '$cta_p',
												 2,
												 $sal_ant,
												 $sal_des,
												 $est,
												 $est,
												 $tc_ctb,
												 '$fec1',
												 null,
												 '$prox_ven',
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar cart_cabecera : ' . mysql_error()); 
}
//Capital	
if ($_SESSION['capital'] > 0){
      $_SESSION['pag_cap'] = $_SESSION['capital'];
      $cta_cart = leer_cta_car(1,$tope,$est,$mon);
//echo "**".$tope."**".$est."**".$mon."+++";
      $cta_tip =  leer_cta_tip(1,$tope,$est,$mon);
	  $cap_pag =$_SESSION['capital'] + $mon_pcap_2;
        $importe = $_SESSION['capital'];
			  if ($mon == 1){
			  //   $cta_ctb = 13105102;
				 $importe_e = $_SESSION['capital'];
			  }
			  if ($mon == 2){
			  //   $cta_ctb = 13105202;
				 $importe = $_SESSION['capital'];
				 $importe_e = $_SESSION['capital'] * $_SESSION['TC_CONTAB'];
			  }
			  $deb_hab = 2;
           
		/*	  */

           
$consulta = "insert into cart_det_tran(CART_DTRA_NCRE, 
                                           CART_DTRA_AGEN,
									       CART_DTRA_NRO_TRAN,
										   CART_DTRA_NRO_CTA,
									       CART_DTRA_FECHA,
					                       CART_DTRA_TIP_TRAN,
   				                           CART_DTRA_CCON,
					                       CART_DTRA_DEB_CRE, 
									       CART_DTRA_CTA_CBT, 
									       CART_DTRA_IMPO, 
									       CART_DTRA_IMPO_BS,
                                           CART_DTRA_FEC_TRAN,
                                           CART_DTRA_FEC_INI2,
                                           CART_DTRA_FEC_FIN,
                                           CART_DTRA_TASA,
										   CART_DTRA_EST_ANT,
										   CART_DTRA_VIA,
										   CART_DTRA_TIP_CAM,
										   CART_DTRA_USR_ALTA,
										   CART_DTRA_FCH_HR_ALTA,
										   CART_DTRA_USR_BAJA,
										   CART_DTRA_FCH_HR_BAJA
									       ) values ($ncre,
									                 $c_agen,
												     $nro_tr_cart,
													 $f_cta,
													 '$fec1',
												     2,
												     $cta_tip,
													 2,
												     '$cta_cart',
													 $importe,
													 $importe_e,
 											     	 '$fec1',
												     null,
													 null,
													 0,
													 null,
													 null,
												     $tc_ctb,
												    '$log_usr',
												     null,
												     null,
												    '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar cart_det_tran : ' . mysql_error()); 
            }  			
// Ahorro			
 if ($_SESSION['ahorro'] > 0){
     $nro_tr_fond = leer_nro_co_fon(1,$log_usr);
     $_SESSION['dep_aho'] = $_SESSION['ahorro'];
	          $cta_fong = leer_cta_car(2,$tope,3,$mon);
              $cta_tip =  leer_cta_tip(2,$tope,3,$mon);
		      $importe = $_SESSION['ahorro'];
			  if ($mon == 1){
			   	 $importe_e = $_SESSION['ahorro'];
			  }
			  if ($mon == 2){
			   	 $importe = $_SESSION['ahorro'];
				 $importe_e = $_SESSION['ahorro'] * $_SESSION['TC_CONTAB'];
			  }
			  $deb_hab = 2;
			 /*  */
$consulta = "insert into fond_cabecera (FOND_CAB_NCTA, 
                                         FOND_CAB_AGEN,
									     FOND_CAB_NRO_TRAN,
									     FOND_CAB_TRAN_CAJ,
										 FOND_CAB_TRAN_CAR,
									     FOND_CAB_FECHA,
					                     FOND_CAB_TIP_TRAN,
					                     FOND_CAB_EST_ANT,
   				                         FOND_CAB_EST_ACT,
					                     FOND_CAB_TIP_CAM, 
									     FOND_CAB_FEC_TRAN, 
									     FOND_CAB_FEC_VTO, 
									     FOND_CAB_FEC_SUS,
                                         FOND_CAB_USR_ALTA,
                                         FOND_CAB_FCH_HR_ALTA,
                                         FOND_CAB_USR_BAJA,
                                         FOND_CAB_FCH_HR_BAJA
									    ) values ($cta,
									             $c_agen,
												 $nro_tr_fond,
												 $nro_tr_caj,
												 $nro_tr_cart,
												 '$fec1',
												 1,
												 null,
												 null,
 											     $tc_ctb,
												 '$fec1',
												 null,
												 null,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar fon_cabecera : ' . mysql_error());
echo "Fondo detalle";
$consulta = "insert into fond_det_tran(FOND_DTRA_NCTA, 
                                           FOND_DTRA_AGEN,
										   FOND_DTRA_NCRE,
									       FOND_DTRA_NRO_TRAN,
										   FOND_DTRA_NRO_CTA,
									       FOND_DTRA_FECHA,
					                       FOND_DTRA_TIP_TRAN,
   				                           FOND_DTRA_CCON,
					                       FOND_DTRA_DEB_CRE, 
									       FOND_DTRA_CTA_CBT, 
									       FOND_DTRA_IMPO, 
									       FOND_DTRA_IMPO_BS,
                                           FOND_DTRA_FEC_TRAN,
                                           FOND_DTRA_FEC_INI2,
                                           FOND_DTRA_FEC_FIN,
                                           FOND_DTRA_TASA,
										   FOND_DTRA_EST_ANT,
										   FOND_DTRA_VIA,
										   FOND_DTRA_TIP_CAM,
										   FOND_DTRA_USR_ALTA,
										   FOND_DTRA_FCH_HR_ALTA,
										   FOND_DTRA_USR_BAJA,
										   FOND_DTRA_FCH_HR_BAJA
									       ) values ($cta,
									                 $c_agen,
													 $ncre,
												     $nro_tr_fond,
													 1,
													 '$fec1',
												     1,
												     212,
													 1,
												     '$cta_fong',
													 $importe,
													 $importe_e,
 											     	 '$fec1',
												     null,
													 null,
													 0,
													 null,
													 null,
												     $tc_ctb,
												    '$log_usr',
												     null,
												     null,
												    '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar fon_det_tran : ' . mysql_error()); 
$consulta = "insert into cart_det_tran(CART_DTRA_NCRE, 
                                           CART_DTRA_AGEN,
									       CART_DTRA_NRO_TRAN,
										   CART_DTRA_NRO_CTA,
									       CART_DTRA_FECHA,
					                       CART_DTRA_TIP_TRAN,
   				                           CART_DTRA_CCON,
					                       CART_DTRA_DEB_CRE, 
									       CART_DTRA_CTA_CBT, 
									       CART_DTRA_IMPO, 
									       CART_DTRA_IMPO_BS,
                                           CART_DTRA_FEC_TRAN,
                                           CART_DTRA_FEC_INI2,
                                           CART_DTRA_FEC_FIN,
                                           CART_DTRA_TASA,
										   CART_DTRA_EST_ANT,
										   CART_DTRA_VIA,
										   CART_DTRA_TIP_CAM,
										   CART_DTRA_USR_ALTA,
										   CART_DTRA_FCH_HR_ALTA,
										   CART_DTRA_USR_BAJA,
										   CART_DTRA_FCH_HR_BAJA
									       ) values ($ncre,
									                 $c_agen,
												     $nro_tr_cart,
													 $f_cta,
													 '$fec1',
												     2,
												     212,
													 2,
												     '$cta_fong',
													 $importe,
													 $importe_e,
 											     	 '$fec1',
												     null,
													 null,
													 0,
													 null,
													 null,
												     $tc_ctb,
												    '$log_usr',
												     null,
												     null,
												    '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar cart_det_tran : ' . mysql_error()); 
                }  
// Interes			
 if (round($_SESSION['interes'],2) > 0){
     $_SESSION['pag_int'] = $_SESSION['interes'];
	 $cta_cint = leer_cta_car(7,$tope,$est,$mon);
     $cta_tip =  leer_cta_tip(7,$tope,$est,$mon);
	
	  $_SESSION['cta_int'] = $cta_cint;
	 $importe = $_SESSION['interes'];
			  if ($mon == 1){
				 $importe_e = $_SESSION['interes'];
			  }
			  if ($mon == 2){
			 	 $importe = $_SESSION['interes'];
				 $importe_e = $_SESSION['interes'] * $_SESSION['TC_CONTAB'];
			  }
			  $deb_hab = 2;
		/*	  */
$consulta = "insert into cart_det_tran(CART_DTRA_NCRE, 
                                           CART_DTRA_AGEN,
									       CART_DTRA_NRO_TRAN,
										   CART_DTRA_NRO_CTA,
									       CART_DTRA_FECHA,
					                       CART_DTRA_TIP_TRAN,
   				                           CART_DTRA_CCON,
					                       CART_DTRA_DEB_CRE, 
									       CART_DTRA_CTA_CBT, 
									       CART_DTRA_IMPO, 
									       CART_DTRA_IMPO_BS,
                                           CART_DTRA_FEC_TRAN,
                                           CART_DTRA_FEC_INI2,
                                           CART_DTRA_FEC_FIN,
                                           CART_DTRA_TASA,
										   CART_DTRA_EST_ANT,
										   CART_DTRA_VIA,
										   CART_DTRA_TIP_CAM,
										   CART_DTRA_USR_ALTA,
										   CART_DTRA_FCH_HR_ALTA,
										   CART_DTRA_USR_BAJA,
										   CART_DTRA_FCH_HR_BAJA
									       ) values ($ncre,
									                 $c_agen,
												     $nro_tr_cart,
													 $f_cta,
													 '$fec1',
												     2,
												     $cta_tip,
													 2,
												     '$cta_cint',
													 $importe,
													 $importe_e,
 											     	 '$fec1',
												     null,
													 null,
													 0,
													 null,
													 null,
												     $tc_ctb,
												    '$log_usr',
												     null,
												     null,
												    '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar cart_det_tran : ' . mysql_error()); 
            } 
// Interes Devengado			
 if (round($_SESSION['intdev'],2) > 0){
     $_SESSION['pag_dev'] = $_SESSION['intdev'];
	 $cta_cint = leer_cta_car(40,$tope,6,$mon);
     $cta_tip =  leer_cta_tip(40,$tope,6,$mon);
	 $_SESSION['cta_dev'] = $cta_cint;
	 $importe = $_SESSION['intdev'];
			  if ($mon == 1){
				 $importe_e = $_SESSION['intdev'];
			  }
			  if ($mon == 2){
			 	 $importe = $_SESSION['intdev'];
				 $importe_e = $_SESSION['intdev'] * $_SESSION['TC_CONTAB'];
			  }
			  $deb_hab = 2;
		/*	  */
$consulta = "insert into cart_det_tran(CART_DTRA_NCRE, 
                                           CART_DTRA_AGEN,
									       CART_DTRA_NRO_TRAN,
										   CART_DTRA_NRO_CTA,
									       CART_DTRA_FECHA,
					                       CART_DTRA_TIP_TRAN,
   				                           CART_DTRA_CCON,
					                       CART_DTRA_DEB_CRE, 
									       CART_DTRA_CTA_CBT, 
									       CART_DTRA_IMPO, 
									       CART_DTRA_IMPO_BS,
                                           CART_DTRA_FEC_TRAN,
                                           CART_DTRA_FEC_INI2,
                                           CART_DTRA_FEC_FIN,
                                           CART_DTRA_TASA,
										   CART_DTRA_EST_ANT,
										   CART_DTRA_VIA,
										   CART_DTRA_TIP_CAM,
										   CART_DTRA_USR_ALTA,
										   CART_DTRA_FCH_HR_ALTA,
										   CART_DTRA_USR_BAJA,
										   CART_DTRA_FCH_HR_BAJA
									       ) values ($ncre,
									                 $c_agen,
												     $nro_tr_cart,
													 $f_cta,
													 '$fec1',
												     2,
												     $cta_tip,
													 2,
												     '$cta_cint',
													 $importe,
													 $importe_e,
 											     	 '$fec1',
												     null,
													 null,
													 0,
													 null,
													 null,
												     $tc_ctb,
												    '$log_usr',
												     null,
												     null,
												    '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar cart_det_tran : ' . mysql_error()); 
            } 			
			
			
// Interes	Penal		
 if ($_SESSION['intmora'] > 0){
     $_SESSION['pag_pen'] = $_SESSION['intmora'];
     $cta_cint = leer_cta_car(10,$tope,6,$mon);
     $cta_tip =  leer_cta_tip(10,$tope,6,$mon);
	 $_SESSION['cta_pen'] = $cta_cint; 
		      $importe = $_SESSION['intmora'];
			  if ($mon == 1){
			  	 $importe_e = $_SESSION['intmora'];
			  }
			  if ($mon == 2){
			 	 $importe = $_SESSION['intmora'];
				 $importe_e = round($_SESSION['intmora'] * $_SESSION['TC_CONTAB'],2);
			  }
			  $deb_hab = 2;
		/*	  */
$consulta = "insert into cart_det_tran(CART_DTRA_NCRE, 
                                           CART_DTRA_AGEN,
									       CART_DTRA_NRO_TRAN,
										   CART_DTRA_NRO_CTA,
									       CART_DTRA_FECHA,
					                       CART_DTRA_TIP_TRAN,
   				                           CART_DTRA_CCON,
					                       CART_DTRA_DEB_CRE, 
									       CART_DTRA_CTA_CBT, 
									       CART_DTRA_IMPO, 
									       CART_DTRA_IMPO_BS,
                                           CART_DTRA_FEC_TRAN,
                                           CART_DTRA_FEC_INI2,
                                           CART_DTRA_FEC_FIN,
                                           CART_DTRA_TASA,
										   CART_DTRA_EST_ANT,
										   CART_DTRA_VIA,
										   CART_DTRA_TIP_CAM,
										   CART_DTRA_USR_ALTA,
										   CART_DTRA_FCH_HR_ALTA,
										   CART_DTRA_USR_BAJA,
										   CART_DTRA_FCH_HR_BAJA
									       ) values ($ncre,
									                 $c_agen,
												     $nro_tr_cart,
													 $f_cta,
													 '$fec1',
												     2,
												     $cta_tip,
													 2,
												     '$cta_cint',
													 $importe,
													 $importe_e,
 											     	 '$fec1',
												     null,
													 null,
													 0,
													 null,
													 null,
												     $tc_ctb,
												    '$log_usr',
												     null,
												     null,
												    '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar cart_det_tran : ' . mysql_error()); 
            } 	
			
// Interes	Penal
 if ($_SESSION['penal'] > 0){
 //    $_SESSION['pag_pen'] = $_SESSION['intmora'];
     $cta_cint = leer_cta_car(15,$tope,0,$mon);
     $cta_tip =  leer_cta_tip(15,$tope,0,$mon);
	 $_SESSION['cta_pen'] = $cta_cint; 
		      $importe = $_SESSION['penal'];
			  if ($mon == 1){
			  	 $importe_e = $_SESSION['penal'];
			  }
			  if ($mon == 2){
			 	 $importe = $_SESSION['penal'];
				 $importe_e = round($_SESSION['penal'] * $_SESSION['TC_CONTAB'],2);
			  }
			  $deb_hab = 2;
		/*	  */
$consulta = "insert into cart_det_tran(CART_DTRA_NCRE, 
                                           CART_DTRA_AGEN,
									       CART_DTRA_NRO_TRAN,
										   CART_DTRA_NRO_CTA,
									       CART_DTRA_FECHA,
					                       CART_DTRA_TIP_TRAN,
   				                           CART_DTRA_CCON,
					                       CART_DTRA_DEB_CRE, 
									       CART_DTRA_CTA_CBT, 
									       CART_DTRA_IMPO, 
									       CART_DTRA_IMPO_BS,
                                           CART_DTRA_FEC_TRAN,
                                           CART_DTRA_FEC_INI2,
                                           CART_DTRA_FEC_FIN,
                                           CART_DTRA_TASA,
										   CART_DTRA_EST_ANT,
										   CART_DTRA_VIA,
										   CART_DTRA_TIP_CAM,
										   CART_DTRA_USR_ALTA,
										   CART_DTRA_FCH_HR_ALTA,
										   CART_DTRA_USR_BAJA,
										   CART_DTRA_FCH_HR_BAJA
									       ) values ($ncre,
									                 $c_agen,
												     $nro_tr_cart,
													 $f_cta,
													 '$fec1',
												     2,
												     $cta_tip,
													 2,
												     '$cta_cint',
													 $importe,
													 $importe_e,
 											     	 '$fec1',
												     null,
													 null,
													 0,
													 null,
													 null,
												     $tc_ctb,
												    '$log_usr',
												     null,
												     null,
												    '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar cart_det_tran : ' . mysql_error()); 
            } 				
			
// ITF

echo $_SESSION['itf']."itf";	
 if ($_SESSION['itf'] > 0){
     $_SESSION['m_itf'] = $_SESSION['itf'];
     $cta_itf = leer_cta_car(8,0,0,2);
     $cta_tip =  leer_cta_tip(8,0,0,2);
		      $importe = $_SESSION['itf'];
			
			  if ($mon == 2){
			  
				 $importe = (round($_SESSION['itf'],2))* $_SESSION['TC_CONTAB'];
				 $importe_e = (round($_SESSION['itf'],2)) * $_SESSION['TC_CONTAB'];
			  }
			  $deb_hab = 2;
	/*		 */
$consulta = "insert into cart_det_tran(CART_DTRA_NCRE, 
                                           CART_DTRA_AGEN,
									       CART_DTRA_NRO_TRAN,
										   CART_DTRA_NRO_CTA,
									       CART_DTRA_FECHA,
					                       CART_DTRA_TIP_TRAN,
   				                           CART_DTRA_CCON,
					                       CART_DTRA_DEB_CRE, 
									       CART_DTRA_CTA_CBT, 
									       CART_DTRA_IMPO, 
									       CART_DTRA_IMPO_BS,
                                           CART_DTRA_FEC_TRAN,
                                           CART_DTRA_FEC_INI2,
                                           CART_DTRA_FEC_FIN,
                                           CART_DTRA_TASA,
										   CART_DTRA_EST_ANT,
										   CART_DTRA_VIA,
										   CART_DTRA_TIP_CAM,
										   CART_DTRA_USR_ALTA,
										   CART_DTRA_FCH_HR_ALTA,
										   CART_DTRA_USR_BAJA,
										   CART_DTRA_FCH_HR_BAJA
									       ) values ($ncre,
									                 $c_agen,
												     $nro_tr_cart,
													 $f_cta,
													 '$fec1',
												     2,
												     $cta_tip,
													 2,
												     '$cta_itf',
													 $importe,
													 $importe_e,
 											     	 '$fec1',
												     null,
													 null,
													 0,
													 null,
													 null,
												     $tc_ctb,
												    '$log_usr',
												     null,
												     null,
												    '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar cart_det_tran : ' . mysql_error()); 
            } 								
			
			
			
			
			
	//Montos Condonados 
	if ($_SESSION['cond_int'] > 0){
	   $i_cond = $_SESSION['cond_int'];
		 $consulta = "insert into cart_det_cond
					                   (CART_DET_CON_NCRE,
	                                    CART_DET_CON_TIP_TRAN,
										CART_DET_CON_CODIGO,
										CART_DET_CON_FCH_PRO,
										CART_DET_CON_IMP_O,
										CART_DET_CON_IMPO_N,
										CART_DET_CON_USR_ALTA,
										CART_DET_CON_CHR_FCH_ALTA,
										CART_DET_CON_USR_BAJA,
										CART_DET_CON_FCH_BAJA)
						         values ($ncre,
								         1,
										 513, 
										 '$fec1',
										 0, 
								 		  $i_cond,
										 '$log_usr',
										 null,
										 null,
										 '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar :condonacion ' . mysql_error());
}
//Montos Condonados penal
	if ($_SESSION['cond_intm'] > 0){
	   $i_cond = $_SESSION['cond_intm'];
		 $consulta = "insert into cart_det_cond
					                   (CART_DET_CON_NCRE,
	                                    CART_DET_CON_TIP_TRAN,
										CART_DET_CON_CODIGO,
										CART_DET_CON_FCH_PRO,
										CART_DET_CON_IMP_O,
										CART_DET_CON_IMPO_N,
										CART_DET_CON_USR_ALTA,
										CART_DET_CON_CHR_FCH_ALTA,
										CART_DET_CON_USR_BAJA,
										CART_DET_CON_FCH_BAJA)
						         values ($ncre,
								         1,
										 515, 
										 '$fec1',
										 0, 
								 		  $i_cond,
										 '$log_usr',
										 null,
										 null,
										 '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar :condonacion ' . mysql_error());
}







			
if ($_SESSION['dif_tc'] <> 0){
   if ($_SESSION['dif_tc'] < 0){
      $cta_dtc = "44201101";
      $cta_tdtc =  442;
	  $deb_hab = 1; 
	  $importe = ($_SESSION['dif_tc'] * -1);
      $importe_e = $importe;	 
       }
   	 if ($_SESSION['dif_tc'] > 0){
	    $cta_dtc = "54201101";
        $cta_tdtc =  542;
	    $deb_hab = 2; 
	    $importe = $_SESSION['dif_tc'];
		$importe_e = $importe;
		
       }   
  /* 		 */
//Cartera
$consulta = "insert into cart_det_tran(CART_DTRA_NCRE, 
                                           CART_DTRA_AGEN,
									       CART_DTRA_NRO_TRAN,
										   CART_DTRA_NRO_CTA,
									       CART_DTRA_FECHA,
					                       CART_DTRA_TIP_TRAN,
   				                           CART_DTRA_CCON,
					                       CART_DTRA_DEB_CRE, 
									       CART_DTRA_CTA_CBT, 
									       CART_DTRA_IMPO, 
									       CART_DTRA_IMPO_BS,
                                           CART_DTRA_FEC_TRAN,
                                           CART_DTRA_FEC_INI2,
                                           CART_DTRA_FEC_FIN,
                                           CART_DTRA_TASA,
										   CART_DTRA_EST_ANT,
										   CART_DTRA_VIA,
										   CART_DTRA_TIP_CAM,
										   CART_DTRA_USR_ALTA,
										   CART_DTRA_FCH_HR_ALTA,
										   CART_DTRA_USR_BAJA,
										   CART_DTRA_FCH_HR_BAJA
									       ) values ($ncre,
									                 $c_agen,
												     $nro_tr_cart,
													 $f_cta,
													 '$fec1',
												     2,
												     '$cta_tdtc',
													 $deb_hab,
												     '$cta_dtc',
													 $importe,
													 $importe_e,
 											     	 '$fec1',
												     null,
													 null,
													 0,
													 null,
													 null,
												     $tc_ctb,
												    '$log_usr',
												     null,
												     null,
												    '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar cart_det_tran : ' . mysql_error()); 
}	

//Marca la cuota(s) pagadas y si es cancelacion total
//$mon_cap = monto_deuda_c($ncre,$f_has);
$tot_plan =  monto_deuda_c($ncre,$f_has); 
$tot_pag = montos_recuperados($ncre,$fec,1);
$dif = $tot_plan - $tot_pag;
     $con_nro_cta = "select CART_PLD_CTA from cart_plandp  where
			              CART_PLD_NCRE = $ncre and CART_PLD_FECHA = '$f_has'";
	 $res_nro_cta = mysql_query($con_nro_cta)or die
			             ('No pudo actualizar leer cuota' . mysql_error());
     while ($lin_nro_cta = mysql_fetch_array($res_nro_cta)) {
      $cuota =  $lin_nro_cta['CART_PLD_CTA'];
       }


echo "dif---".$dif."cuota ---".$cuota;
 if ($dif <= 0){
     $con_actp = "update cart_plandp set CART_PLD_STAT = 'C' where
			              CART_PLD_NCRE = $ncre and CART_PLD_FECHA <= '$f_has'";
			 $res_actp = mysql_query($con_actp)or die
			             ('No pudo actualizar estado cuota ' . mysql_error());
	 $_SESSION['prox_ven'] = cta_venf($ncre);
	  $prox_ven =  $_SESSION['prox_ven'];					 
   }else{
     $cuota = $cuota -1;
	   $con_actp = "update cart_plandp set CART_PLD_STAT = 'C' where
			              CART_PLD_NCRE = $ncre and CART_PLD_CTA <= $cuota";
			 $res_actp = mysql_query($con_actp)or die
			             ('No pudo actualizar estado cuota 2 ' . mysql_error());
		$_SESSION['prox_ven'] = cta_venf($ncre);
	 $prox_ven =  $_SESSION['prox_ven'];
	 echo $prox_ven;
	 }
	 $_SESSION['prox_ven'] = cta_venf($ncre);
     $prox_ven =  $_SESSION['prox_ven'];     
 if ( $tot_pag >= $impo) {
      $con_maes = "update cart_maestro set CART_ESTADO = 9, CART_FCH_CAN = '$fec1'
			              where CART_NRO_CRED = $ncre ";
			 $res_maes = mysql_query($con_maes)or die
			            ('No pudo actualizar estado maestro ' . mysql_error());	
	$_SESSION['prox_ven'] = "-------";						
}









/*	

	*/	
// Graba en cred_plandp_pag		 
if (($t_cred == 1)&& ($tope < 1)) {
if(isset($_SESSION["imp_1"])){
   $impor_1 = $_SESSION["imp_1"];
   $_SESSION["imp_1"] = $impor_1;
   if(isset($_SESSION["cli_1"])){
      $clie_1 = $_SESSION["cli_1"];
   }
   $consulta = "insert into cred_plandp_pag (CRED_PLP_COD_SOL, 
                                             CRED_PLP_NRO_CRE,
									         CRED_PLP_COD_CLI,
									         CRED_PLP_NRO_CTA,
										     CRED_PLP_FECHA,
											 CRED_PLP_FCTA,
									         CRED_PLP_MONTO,
										     CRED_PLP_CAPITAL,
					                         CRED_PLP_INTERES,
										     CRED_PLP_AHORRO,
										     CRED_PLP_USR_ALTA,
                                             CRED_PLP_FCH_HR_ALTA,
                                             CRED_PLP_USR_BAJA,
                                             CRED_PLP_FCH_HR_BAJA
									         ) values ($cod_sol,
										               $ncre,
									                   $clie_1,
													   '$nro_tr_cart',
													   '$fec1',
													   '$f_has',
													   $impor_1,
												       $nro_tr_cart,
												       0,
												       0,
												       '$log_usr',
												        null,
												        null,
												       '0000-00-00 00:00:00')";
              $resultado = mysql_query($consulta)or die('No pudo insertar cred_plandp_pag 1: ' . mysql_error()); 
   
 }

 
if(isset($_SESSION["imp_2"])){
   $impor_2 = $_SESSION["imp_2"];
   if(isset($_SESSION["cli_2"])){
      $clie_2 = $_SESSION["cli_2"];
   }
   $consulta = "insert into cred_plandp_pag (CRED_PLP_COD_SOL, 
                                             CRED_PLP_NRO_CRE,
									         CRED_PLP_COD_CLI,
									         CRED_PLP_NRO_CTA,
										     CRED_PLP_FECHA,
											 CRED_PLP_FCTA,
									         CRED_PLP_MONTO,
										     CRED_PLP_CAPITAL,
					                         CRED_PLP_INTERES,
										     CRED_PLP_AHORRO,
										     CRED_PLP_USR_ALTA,
                                             CRED_PLP_FCH_HR_ALTA,
                                             CRED_PLP_USR_BAJA,
                                             CRED_PLP_FCH_HR_BAJA
									         ) values ($cod_sol,
										               $ncre,
									                   $clie_2,
													   '$nro_tr_cart',
													   '$fec1',
													   '$f_has',
													   $impor_2,
												       $nro_tr_cart,
												       0,
												       0,
												       '$log_usr',
												        null,
												        null,
												       '0000-00-00 00:00:00')";
              $resultado = mysql_query($consulta)or die('No pudo insertar cred_plandp_pag 2 : ' . mysql_error()); 
   
 }

if(isset($_SESSION["imp_3"])){
   $impor_3 = $_SESSION["imp_3"];
   if(isset($_SESSION["cli_3"])){
      $clie_3 = $_SESSION["cli_3"];
   }
   $consulta = "insert into cred_plandp_pag (CRED_PLP_COD_SOL, 
                                             CRED_PLP_NRO_CRE,
									         CRED_PLP_COD_CLI,
									         CRED_PLP_NRO_CTA,
										     CRED_PLP_FECHA,
											 CRED_PLP_FCTA,
									         CRED_PLP_MONTO,
										     CRED_PLP_CAPITAL,
					                         CRED_PLP_INTERES,
										     CRED_PLP_AHORRO,
										     CRED_PLP_USR_ALTA,
                                             CRED_PLP_FCH_HR_ALTA,
                                             CRED_PLP_USR_BAJA,
                                             CRED_PLP_FCH_HR_BAJA
									         ) values ($cod_sol,
										               $ncre,
									                   $clie_3,
													   '$nro_tr_cart',
													   '$fec1',
													   '$f_has',
													   $impor_3,
												       $nro_tr_cart,
												       0,
												       0,
												       '$log_usr',
												        null,
												        null,
												       '0000-00-00 00:00:00')";
              $resultado = mysql_query($consulta)or die('No pudo insertar cred_plandp_pag 3 : ' . mysql_error()); 
   
 }
if(isset($_SESSION["imp_4"])){
   $impor_4 = $_SESSION["imp_4"];
   if(isset($_SESSION["cli_4"])){
      $clie_4 = $_SESSION["cli_4"];
   }
   $consulta = "insert into cred_plandp_pag (CRED_PLP_COD_SOL, 
                                             CRED_PLP_NRO_CRE,
									         CRED_PLP_COD_CLI,
									         CRED_PLP_NRO_CTA,
										     CRED_PLP_FECHA,
											 CRED_PLP_FCTA,
									         CRED_PLP_MONTO,
										     CRED_PLP_CAPITAL,
					                         CRED_PLP_INTERES,
										     CRED_PLP_AHORRO,
										     CRED_PLP_USR_ALTA,
                                             CRED_PLP_FCH_HR_ALTA,
                                             CRED_PLP_USR_BAJA,
                                             CRED_PLP_FCH_HR_BAJA
									         ) values ($cod_sol,
										               $ncre,
									                   $clie_4,
													   '$nro_tr_cart',
													   '$fec1',
													   '$f_has',
													   $impor_4,
												       $nro_tr_cart,
												       0,
												       0,
												       '$log_usr',
												        null,
												        null,
												       '0000-00-00 00:00:00')";
              $resultado = mysql_query($consulta)or die('No pudo insertar cred_plandp_pag 4 : ' . mysql_error()); 
   
 }
if(isset($_SESSION["imp_5"])){
   $impor_5 = $_SESSION["imp_5"];
   if(isset($_SESSION["cli_5"])){
      $clie_5 = $_SESSION["cli_5"];
   }
   $consulta = "insert into cred_plandp_pag (CRED_PLP_COD_SOL, 
                                             CRED_PLP_NRO_CRE,
									         CRED_PLP_COD_CLI,
									         CRED_PLP_NRO_CTA,
										     CRED_PLP_FECHA,
											 CRED_PLP_FCTA,
									         CRED_PLP_MONTO,
										     CRED_PLP_CAPITAL,
					                         CRED_PLP_INTERES,
										     CRED_PLP_AHORRO,
										     CRED_PLP_USR_ALTA,
                                             CRED_PLP_FCH_HR_ALTA,
                                             CRED_PLP_USR_BAJA,
                                             CRED_PLP_FCH_HR_BAJA
									         ) values ($cod_sol,
										               $ncre,
									                   $clie_5,
													   '$nro_tr_cart',
													   '$fec1',
													   '$f_has',
													   $impor_5,
												       $nro_tr_cart,
												       0,
												       0,
												       '$log_usr',
												        null,
												        null,
												       '0000-00-00 00:00:00')";
              $resultado = mysql_query($consulta)or die('No pudo insertar cred_plandp_pag 5 : ' . mysql_error()); 
   
 }
if(isset($_SESSION["imp_6"])){
   $impor_6 = $_SESSION["imp_6"];
   if(isset($_SESSION["cli_6"])){
      $clie_6 = $_SESSION["cli_6"];
   }
   $consulta = "insert into cred_plandp_pag (CRED_PLP_COD_SOL, 
                                             CRED_PLP_NRO_CRE,
									         CRED_PLP_COD_CLI,
									         CRED_PLP_NRO_CTA,
										     CRED_PLP_FECHA,
											 CRED_PLP_FCTA, 
									         CRED_PLP_MONTO,
										     CRED_PLP_CAPITAL,
					                         CRED_PLP_INTERES,
										     CRED_PLP_AHORRO,
										     CRED_PLP_USR_ALTA,
                                             CRED_PLP_FCH_HR_ALTA,
                                             CRED_PLP_USR_BAJA,
                                             CRED_PLP_FCH_HR_BAJA
									         ) values ($cod_sol,
										               $ncre,
									                   $clie_6,
													   '$nro_tr_cart',
													   '$fec1',
													   '$f_has',
													   $impor_6,
												       $nro_tr_cart,
												       0,
												       0,
												       '$log_usr',
												        null,
												        null,
												       '0000-00-00 00:00:00')";
              $resultado = mysql_query($consulta)or die('No pudo insertar cred_plandp_pag 6 : ' . mysql_error()); 
   
 }
if(isset($_SESSION["imp_7"])){
   $impor_7 = $_SESSION["imp_7"];
   if(isset($_SESSION["cli_7"])){
      $clie_7 = $_SESSION["cli_7"];
   }
   $consulta = "insert into cred_plandp_pag (CRED_PLP_COD_SOL, 
                                             CRED_PLP_NRO_CRE,
									         CRED_PLP_COD_CLI,
									         CRED_PLP_NRO_CTA,
										     CRED_PLP_FECHA,
											 CRED_PLP_FCTA,
									         CRED_PLP_MONTO,
										     CRED_PLP_CAPITAL,
					                         CRED_PLP_INTERES,
										     CRED_PLP_AHORRO,
										     CRED_PLP_USR_ALTA,
                                             CRED_PLP_FCH_HR_ALTA,
                                             CRED_PLP_USR_BAJA,
                                             CRED_PLP_FCH_HR_BAJA
									         ) values ($cod_sol,
										               $ncre,
									                   $clie_7,
													   '$nro_tr_cart',
													   '$fec1',
													   '$f_has',
													   $impor_7,
												       $nro_tr_cart,
												       0,
												       0,
												       '$log_usr',
												        null,
												        null,
												       '0000-00-00 00:00:00')";
              $resultado = mysql_query($consulta)or die('No pudo insertar cred_plandp_pag 7 : ' . mysql_error()); 
   
 }
if(isset($_SESSION["imp_8"])){
   $impor_8 = $_SESSION["imp_8"];
   if(isset($_SESSION["cli_8"])){
      $clie_8 = $_SESSION["cli_8"];
   }
   $consulta = "insert into cred_plandp_pag (CRED_PLP_COD_SOL, 
                                             CRED_PLP_NRO_CRE,
									         CRED_PLP_COD_CLI,
									         CRED_PLP_NRO_CTA,
										     CRED_PLP_FECHA,
											 CRED_PLP_FCTA,
									         CRED_PLP_MONTO,
										     CRED_PLP_CAPITAL,
					                         CRED_PLP_INTERES,
										     CRED_PLP_AHORRO,
										     CRED_PLP_USR_ALTA,
                                             CRED_PLP_FCH_HR_ALTA,
                                             CRED_PLP_USR_BAJA,
                                             CRED_PLP_FCH_HR_BAJA
									         ) values ($cod_sol,
										               $ncre,
									                   $clie_8,
													   '$nro_tr_cart',
													   '$fec1',
													   '$f_has',
													   $impor_8,
												       $nro_tr_cart,
												       0,
												       0,
												       '$log_usr',
												        null,
												        null,
												       '0000-00-00 00:00:00')";
              $resultado = mysql_query($consulta)or die('No pudo insertar cred_plandp_pag 8 : ' . mysql_error()); 
   
 }
if(isset($_SESSION["imp_9"])){
   $impor_9 = $_SESSION["imp_9"];
   if(isset($_SESSION["cli_9"])){
      $clie_9 = $_SESSION["cli_9"];
   }
   $consulta = "insert into cred_plandp_pag (CRED_PLP_COD_SOL, 
                                             CRED_PLP_NRO_CRE,
									         CRED_PLP_COD_CLI,
									         CRED_PLP_NRO_CTA,
										     CRED_PLP_FECHA,
											 CRED_PLP_FCTA,
									         CRED_PLP_MONTO,
										     CRED_PLP_CAPITAL,
					                         CRED_PLP_INTERES,
										     CRED_PLP_AHORRO,
										     CRED_PLP_USR_ALTA,
                                             CRED_PLP_FCH_HR_ALTA,
                                             CRED_PLP_USR_BAJA,
                                             CRED_PLP_FCH_HR_BAJA
									         ) values ($cod_sol,
										               $ncre,
									                   $clie_9,
													   '$nro_tr_cart',
													   '$fec1',
													   '$f_has',
													   $impor_9,
												       $nro_tr_cart,
												       0,
												       0,
												       '$log_usr',
												        null,
												        null,
												       '0000-00-00 00:00:00')";
              $resultado = mysql_query($consulta)or die('No pudo insertar cart_cabecera : ' . mysql_error()); 
   
 }
if(isset($_SESSION["imp_10"])){
   $impor_10 = $_SESSION["imp_10"];
   if(isset($_SESSION["cli_10"])){
      $clie_10 = $_SESSION["cli_10"];
   }
   $consulta = "insert into cred_plandp_pag (CRED_PLP_COD_SOL, 
                                             CRED_PLP_NRO_CRE,
									         CRED_PLP_COD_CLI,
									         CRED_PLP_NRO_CTA,
										     CRED_PLP_FECHA,
											 CRED_PLP_FCTA,
									         CRED_PLP_MONTO,
										     CRED_PLP_CAPITAL,
					                         CRED_PLP_INTERES,
										     CRED_PLP_AHORRO,
										     CRED_PLP_USR_ALTA,
                                             CRED_PLP_FCH_HR_ALTA,
                                             CRED_PLP_USR_BAJA,
                                             CRED_PLP_FCH_HR_BAJA
									         ) values ($cod_sol,
										               $ncre,
									                   $clie_10,
													   '$nro_tr_cart',
													   '$fec1',
													   '$f_has',
													   $impor_10,
												       $nro_tr_cart,
												       0,
												       0,
												       '$log_usr',
												        null,
												        null,
												       '0000-00-00 00:00:00')";
              $resultado = mysql_query($consulta)or die('No pudo insertar cart_cabecera : ' . mysql_error()); 
   
 }
if(isset($_SESSION["imp_11"])){
   $impor_11 = $_SESSION["imp_11"];
   if(isset($_SESSION["cli_11"])){
      $clie_11 = $_SESSION["cli_11"];
   }
   $consulta = "insert into cred_plandp_pag (CRED_PLP_COD_SOL, 
                                             CRED_PLP_NRO_CRE,
									         CRED_PLP_COD_CLI,
									         CRED_PLP_NRO_CTA,
										     CRED_PLP_FECHA,
											 CRED_PLP_FCTA,
									         CRED_PLP_MONTO,
										     CRED_PLP_CAPITAL,
					                         CRED_PLP_INTERES,
										     CRED_PLP_AHORRO,
										     CRED_PLP_USR_ALTA,
                                             CRED_PLP_FCH_HR_ALTA,
                                             CRED_PLP_USR_BAJA,
                                             CRED_PLP_FCH_HR_BAJA
									         ) values ($cod_sol,
										               $ncre,
									                   $clie_11,
													   '$nro_tr_cart',
													   '$fec1',
													   '$f_has', 
													   $impor_11,
												       $nro_tr_cart,
												       0,
												       0,
												       '$log_usr',
												        null,
												        null,
												       '0000-00-00 00:00:00')";
              $resultado = mysql_query($consulta)or die('No pudo insertar cart_cabecera : ' . mysql_error()); 
   
 }
if(isset($_SESSION["imp_12"])){
   $impor_12 = $_SESSION["imp_12"];
   if(isset($_SESSION["cli_12"])){
      $clie_12 = $_SESSION["cli_12"];
   }
   $consulta = "insert into cred_plandp_pag (CRED_PLP_COD_SOL, 
                                             CRED_PLP_NRO_CRE,
									         CRED_PLP_COD_CLI,
									         CRED_PLP_NRO_CTA,
										     CRED_PLP_FECHA,
											 CRED_PLP_FCTA,
									         CRED_PLP_MONTO,
										     CRED_PLP_CAPITAL,
					                         CRED_PLP_INTERES,
										     CRED_PLP_AHORRO,
										     CRED_PLP_USR_ALTA,
                                             CRED_PLP_FCH_HR_ALTA,
                                             CRED_PLP_USR_BAJA,
                                             CRED_PLP_FCH_HR_BAJA
									         ) values ($cod_sol,
										               $ncre,
									                   $clie_12,
													   '$nro_tr_cart',
													   '$fec1',
													   '$f_has',
													   $impor_12,
												       $nro_tr_cart,
												       0,
												       0,
												       '$log_usr',
												        null,
												        null,
												       '0000-00-00 00:00:00')";
              $resultado = mysql_query($consulta)or die('No pudo insertar cart_cabecera : ' . mysql_error()); 
   
 }
if(isset($_SESSION["imp_13"])){
   $impor_13 = $_SESSION["imp_13"];
   if(isset($_SESSION["cli_13"])){
      $clie_13 = $_SESSION["cli_13"];
   }
   $consulta = "insert into cred_plandp_pag (CRED_PLP_COD_SOL, 
                                             CRED_PLP_NRO_CRE,
									         CRED_PLP_COD_CLI,
									         CRED_PLP_NRO_CTA,
										     CRED_PLP_FECHA,
											 CRED_PLP_FCTA,
									         CRED_PLP_MONTO,
										     CRED_PLP_CAPITAL,
					                         CRED_PLP_INTERES,
										     CRED_PLP_AHORRO,
										     CRED_PLP_USR_ALTA,
                                             CRED_PLP_FCH_HR_ALTA,
                                             CRED_PLP_USR_BAJA,
                                             CRED_PLP_FCH_HR_BAJA
									         ) values ($cod_sol,
										               $ncre,
									                   $clie_13,
													   '$nro_tr_cart',
													   '$fec1',
													   '$f_has',
													   $impor_13,
												       $nro_tr_cart,
												       0,
												       0,
												       '$log_usr',
												        null,
												        null,
												       '0000-00-00 00:00:00')";
              $resultado = mysql_query($consulta)or die('No pudo insertar cart_cabecera : ' . mysql_error()); 
   
 }
if(isset($_SESSION["imp_14"])){
   $impor_14 = $_SESSION["imp_14"];
   if(isset($_SESSION["cli_14"])){
      $clie_14 = $_SESSION["cli_14"];
   }
   $consulta = "insert into cred_plandp_pag (CRED_PLP_COD_SOL, 
                                             CRED_PLP_NRO_CRE,
									         CRED_PLP_COD_CLI,
									         CRED_PLP_NRO_CTA,
										     CRED_PLP_FECHA,
											 CRED_PLP_FCTA,
									         CRED_PLP_MONTO,
										     CRED_PLP_CAPITAL,
					                         CRED_PLP_INTERES,
										     CRED_PLP_AHORRO,
										     CRED_PLP_USR_ALTA,
                                             CRED_PLP_FCH_HR_ALTA,
                                             CRED_PLP_USR_BAJA,
                                             CRED_PLP_FCH_HR_BAJA
									         ) values ($cod_sol,
										               $ncre,
									                   $clie_14,
													   '$nro_tr_cart',
													   '$fec1',
													   '$f_has',
													   $impor_14,
												       $nro_tr_cart,
												       0,
												       0,
												       '$log_usr',
												        null,
												        null,
												       '0000-00-00 00:00:00')";
              $resultado = mysql_query($consulta)or die('No pudo insertar cart_cabecera : ' . mysql_error()); 
   
 }
if(isset($_SESSION["imp_15"])){
   $impor_15 = $_SESSION["imp_15"];
   if(isset($_SESSION["cli_15"])){
      $clie_15 = $_SESSION["cli_15"];
   }
   $consulta = "insert into cred_plandp_pag (CRED_PLP_COD_SOL, 
                                             CRED_PLP_NRO_CRE,
									         CRED_PLP_COD_CLI,
									         CRED_PLP_NRO_CTA,
										     CRED_PLP_FECHA,
											 CRED_PLP_FCTA,
									         CRED_PLP_MONTO,
										     CRED_PLP_CAPITAL,
					                         CRED_PLP_INTERES,
										     CRED_PLP_AHORRO,
										     CRED_PLP_USR_ALTA,
                                             CRED_PLP_FCH_HR_ALTA,
                                             CRED_PLP_USR_BAJA,
                                             CRED_PLP_FCH_HR_BAJA
									         ) values ($cod_sol,
										               $ncre,
									                   $clie_15,
													   '$nro_tr_cart',
													   '$fec1',
													   '$f_has',
													   $impor_15,
												       $nro_tr_cart,
												       0,
												       0,
												       '$log_usr',
												        null,
												        null,
												       '0000-00-00 00:00:00')";
              $resultado = mysql_query($consulta)or die('No pudo insertar cart_cabecera : ' . mysql_error()); 
   
 }
if(isset($_SESSION["imp_16"])){
   $impor_16 = $_SESSION["imp_16"];
   if(isset($_SESSION["cli_16"])){
      $clie_16 = $_SESSION["cli_16"];
   }
   $consulta = "insert into cred_plandp_pag (CRED_PLP_COD_SOL, 
                                             CRED_PLP_NRO_CRE,
									         CRED_PLP_COD_CLI,
									         CRED_PLP_NRO_CTA,
										     CRED_PLP_FECHA,
											 CRED_PLP_FCTA,
									         CRED_PLP_MONTO,
										     CRED_PLP_CAPITAL,
					                         CRED_PLP_INTERES,
										     CRED_PLP_AHORRO,
										     CRED_PLP_USR_ALTA,
                                             CRED_PLP_FCH_HR_ALTA,
                                             CRED_PLP_USR_BAJA,
                                             CRED_PLP_FCH_HR_BAJA
									         ) values ($cod_sol,
										               $ncre,
									                   $clie_16,
													   '$nro_tr_cart',
													   '$fec1',
													   '$f_has',
													   $impor_16,
												       $nro_tr_cart,
												       0,
												       0,
												       '$log_usr',
												        null,
												        null,
												       '0000-00-00 00:00:00')";
              $resultado = mysql_query($consulta)or die('No pudo insertar cart_cabecera : ' . mysql_error()); 
   
 }
if(isset($_SESSION["imp_17"])){
   $impor_17 = $_SESSION["imp_17"];
   if(isset($_SESSION["cli_17"])){
      $clie_17 = $_SESSION["cli_17"];
   }
   $consulta = "insert into cred_plandp_pag (CRED_PLP_COD_SOL, 
                                             CRED_PLP_NRO_CRE,
									         CRED_PLP_COD_CLI,
									         CRED_PLP_NRO_CTA,
										     CRED_PLP_FECHA,
											 CRED_PLP_FCTA,
									         CRED_PLP_MONTO,
										     CRED_PLP_CAPITAL,
					                         CRED_PLP_INTERES,
										     CRED_PLP_AHORRO,
										     CRED_PLP_USR_ALTA,
                                             CRED_PLP_FCH_HR_ALTA,
                                             CRED_PLP_USR_BAJA,
                                             CRED_PLP_FCH_HR_BAJA
									         ) values ($cod_sol,
										               $ncre,
									                   $clie_17,
													   '$nro_tr_cart',
													   '$fec1',
													   '$f_has',
													   $impor_17,
												       $nro_tr_cart,
												       0,
												       0,
												       '$log_usr',
												        null,
												        null,
												       '0000-00-00 00:00:00')";
              $resultado = mysql_query($consulta)or die('No pudo insertar cart_cabecera : ' . mysql_error()); 
   
 }
if(isset($_SESSION["imp_18"])){
   $impor_18 = $_SESSION["imp_18"];
   if(isset($_SESSION["cli_18"])){
      $clie_18 = $_SESSION["cli_18"];
   }
   $consulta = "insert into cred_plandp_pag (CRED_PLP_COD_SOL, 
                                             CRED_PLP_NRO_CRE,
									         CRED_PLP_COD_CLI,
									         CRED_PLP_NRO_CTA,
										     CRED_PLP_FECHA,
											 CRED_PLP_FCTA,
									         CRED_PLP_MONTO,
										     CRED_PLP_CAPITAL,
					                         CRED_PLP_INTERES,
										     CRED_PLP_AHORRO,
										     CRED_PLP_USR_ALTA,
                                             CRED_PLP_FCH_HR_ALTA,
                                             CRED_PLP_USR_BAJA,
                                             CRED_PLP_FCH_HR_BAJA
									         ) values ($cod_sol,
										               $ncre,
									                   $clie_18,
													   '$nro_tr_cart',
													   '$fec1',
													   '$f_has',
													   $impor_18,
												       $nro_tr_cart,
												       0,
												       0,
												       '$log_usr',
												        null,
												        null,
												       '0000-00-00 00:00:00')";
              $resultado = mysql_query($consulta)or die('No pudo insertar cart_cabecera : ' . mysql_error()); 
   
 }
if(isset($_SESSION["imp_19"])){
   $impor_19 = $_SESSION["imp_19"];
   if(isset($_SESSION["cli_19"])){
      $clie_19 = $_SESSION["cli_19"];
   }
   $consulta = "insert into cred_plandp_pag (CRED_PLP_COD_SOL, 
                                             CRED_PLP_NRO_CRE,
									         CRED_PLP_COD_CLI,
									         CRED_PLP_NRO_CTA,
										     CRED_PLP_FECHA,
											 CRED_PLP_FCTA,
									         CRED_PLP_MONTO,
										     CRED_PLP_CAPITAL,
					                         CRED_PLP_INTERES,
										     CRED_PLP_AHORRO,
										     CRED_PLP_USR_ALTA,
                                             CRED_PLP_FCH_HR_ALTA,
                                             CRED_PLP_USR_BAJA,
                                             CRED_PLP_FCH_HR_BAJA
									         ) values ($cod_sol,
										               $ncre,
									                   $clie_19,
													   '$nro_tr_cart',
													   '$fec1',
													   '$f_has',
													   $impor_19,
												       $nro_tr_cart,
												       0,
												       0,
												       '$log_usr',
												        null,
												        null,
												       '0000-00-00 00:00:00')";
              $resultado = mysql_query($consulta)or die('No pudo insertar cart_cabecera : ' . mysql_error()); 
   
 }
if(isset($_SESSION["imp_20"])){
   $impor_20 = $_SESSION["imp_20"];
   if(isset($_SESSION["cli_20"])){
      $clie_20 = $_SESSION["cli_20"];
   }
   $consulta = "insert into cred_plandp_pag (CRED_PLP_COD_SOL, 
                                             CRED_PLP_NRO_CRE,
									         CRED_PLP_COD_CLI,
									         CRED_PLP_NRO_CTA,
										     CRED_PLP_FECHA,
											 CRED_PLP_FCTA,
									         CRED_PLP_MONTO,
										     CRED_PLP_CAPITAL,
					                         CRED_PLP_INTERES,
										     CRED_PLP_AHORRO,
										     CRED_PLP_USR_ALTA,
                                             CRED_PLP_FCH_HR_ALTA,
                                             CRED_PLP_USR_BAJA,
                                             CRED_PLP_FCH_HR_BAJA
									         ) values ($cod_sol,
										               $ncre,
									                   $clie_20,
													   '$nro_tr_cart',
													   '$fec1',
													   '$f_has',
													   $impor_20,
												       $nro_tr_cart,
												       0,
												       0,
												       '$log_usr',
												        null,
												        null,
												       '0000-00-00 00:00:00')";
              $resultado = mysql_query($consulta)or die('No pudo insertar cart_cabecera : ' . mysql_error()); 
   
 }
}
  if ($_SESSION['nro_rec'] > 0){
    $nro_rec = $_SESSION['nro_rec'];
    $consulta = "insert into recibo_deta (REC_DET_AGEN,
	                                    REC_NRO_CRED,
                                       REC_DET_NRO,
									   REC_DET_NRO_CART,
									   REC_DET_NRO_CAJA,
									   REC_DET_IMPORTE,
					                   REC_DET_FECHA,
					                   REC_DET_ESTADO,
   				                       REC_DET_USR_ALTA,
					                   REC_DET_FCH_HR_ALTA, 
									   REC_DET_USR_BAJA, 
									   REC_DET_FCH_HR_BAJA 
									   ) values ($c_agen,
									             $ncre,
									             $nro_rec,
												 $nro_tr_cart,
												 $nro_tr_caj,
												 $importe,
												 '$fec1',
												 1,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_transac : ' . mysql_error());
}
  
 header('Location:cart_imp_cob.php');
 
  //require 'cart_imp_cob.php';
  ?>
  </div id="TableModulo2">
  <?php echo encadenar(10)."DETALLE CONTABLE ";?>
    <table width="80%"  border="1" cellspacing="1" cellpadding="1" align="center">
       <tr>
	    <th>Descripcion</th>
	   	<th>Cuenta</th>
		<th>Importe Debe Bs</th>
		<th>Importe Haber Bs</th>
		<th>Importe Debe $us</th>
		<th>Importe Haber $us</th>
	</tr>
	<?php
    while ($lin_temp = mysql_fetch_array($res_temp)) {
         $cta_cbte = $lin_temp['TEMP_COB_CTB']; 
		 
         $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_cbte'";
         $res_ctable = mysql_query($con_ctable);
		  while ($lin_ctable = mysql_fetch_array($res_ctable)) {
		      $des_ctable = $lin_ctable['CONTA_CTA_DESC'];
			 // echo $des_ctable.$cta_cbte;    
		       }?>
       <?php  if ($mon == 1){	?>
	         <?php  if ($lin_temp['TEMP_COB_DEHA'] == 1){
			 $tot_deb_1 = $tot_deb_1 + $lin_temp['TEMP_COB_IMPO'];	?>
        <tr>
		 <td align="left" ><?php echo $des_ctable; ?></td> 
		 <td align="left" ><?php echo $lin_temp['TEMP_COB_CTB']; ?></td> 
		 <td align="right" ><?php echo number_format($lin_temp['TEMP_COB_IMPO'], 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		</tr>
		   <?php  }	?> 
		    <?php  if ($lin_temp['TEMP_COB_DEHA'] == 2){
			$tot_hab_1 = $tot_hab_1 + $lin_temp['TEMP_COB_IMPO'];	?>
        <tr>
		 <td align="left" ><?php echo $des_ctable; ?></td> 
		 <td align="left" ><?php echo $lin_temp['TEMP_COB_CTB']; ?></td> 
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format($lin_temp['TEMP_COB_IMPO'], 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		</tr>
		   <?php  }	?> 
		 <?php  }	?>
		  <?php  if ($mon == 2){	?>
		         <?php  if ($lin_temp['TEMP_COB_DEHA'] == 1){	
				 $tot_deb_1 = $tot_deb_1 + $lin_temp['TEMP_COB_IMPO_E'];
				 $tot_deb_2 = $tot_deb_2 + $lin_temp['TEMP_COB_IMPO'];?>
        <tr>
		 <td align="left" ><?php echo $des_ctable; ?></td> 
		 <td align="left" ><?php echo $lin_temp['TEMP_COB_CTB']; ?></td> 
		 <td align="right" ><?php echo number_format($lin_temp['TEMP_COB_IMPO'], 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format($lin_temp['TEMP_COB_IMPO_E'], 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		</tr>
		   <?php  }	?> 
         <?php  if ($lin_temp['TEMP_COB_DEHA'] == 2){	
		     $tot_hab_1 = $tot_hab_1 + $lin_temp['TEMP_COB_IMPO'];
			 $tot_hab_2 = $tot_hab_2 + $lin_temp['TEMP_COB_IMPO_E'];?>
        <tr>
		 <td align="left" ><?php echo $des_ctable; ?></td> 
		 <td align="left" ><?php echo $lin_temp['TEMP_COB_CTB']; ?></td> 
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format($lin_temp['TEMP_COB_IMPO'], 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format($lin_temp['TEMP_COB_IMPO_E'], 2, '.',','); ?></td>
		</tr>
		   <?php  }	?> 
		 <?php  }	?>
		
	 <?php  }	?>
	 <?php  if ($mon == 2){	?>
	  <tr>
		 <th align="center" ><?php echo "Totales" ; ?></td> 
		 <th align="left" ><?php echo encadenar(5); ?></td> 
		 <th align="right" ><?php echo number_format($tot_deb_2, 2, '.',','); ?></td>
		 <th align="right" ><?php echo number_format($tot_hab_1, 2, '.',','); ?></td>
		 <th align="right" ><?php echo number_format($tot_deb_1, 2, '.',','); ?></td>
		 <th align="right" ><?php echo number_format($tot_hab_2, 2, '.',','); ?></td>
		</tr>
	<?php  }	?> 
	<?php  if ($mon == 1){	?>
	  <tr>
		 <th align="center" ><?php echo "Totales" ; ?></td> 
		 <th align="left" ><?php echo encadenar(5); ?></td> 
		 <th align="right" ><?php echo number_format($tot_deb_1, 2, '.',','); ?></td>
		 <th align="right" ><?php echo number_format($tot_hab_1, 2, '.',','); ?></td>
		 <th align="right" ><?php echo number_format($tot_deb_2, 2, '.',','); ?></td>
		 <th align="right" ><?php echo number_format($tot_hab_2, 2, '.',','); ?></td>
		</tr>
	<?php  }	?> 
	</table>
	<center>
	<input type="submit" name="accion" value="Imprimir">
	<!--input type="submit" name="accion" value="Salir"-->
      
</form>	
  <?php  } ?>	
 
   <?php if ($_SESSION["detalle"] == 5){
   
  if (isset($_POST['descrip'])){  
         if ($_POST['descrip'] <> ""){  
	$descrip = $_POST['descrip'];
	$descrip = strtoupper ($descrip);
	$_SESSION['q_paga'] = $descrip;
	}
	}
         $_SESSION['tipo_cob'] = 2; 
		// echo $_SESSION['intmora']." ----".$_SESSION['mon_cint_v']; 
		 if ($_SESSION['EMPRESA_TIPO'] == 2){
		     if ($_SESSION['mon_cint_v'] >  $_SESSION['intmora']){
		          $_SESSION['intmora'] = 0;
				  }else{
				  $_SESSION['intmora'] =  $_SESSION['intmora'];
				  
		       }
		  }
		
		 
		 
		 ?>  
   
   </div id="TableModulo2">
   <?php  echo encadenar(10)."DETALLE DE COBRO ";?>  
    <table width="40%"  border="1" cellspacing="1" cellpadding="1" align="center">
        <tr>
		   <th width="20%" scope="col"><border="0" alt="" align="center" />Concepto</th>
		   <?php if ($mon == 1){ ?>	
           <th width="20%" scope="col"><border="0" alt="" align="center" />Monto Bolivianos</th>
          <?php } ?>
		    <?php if ($mon == 2){ ?>	
           <th width="20%" scope="col"><border="0" alt="" align="center" />Monto Dolares</th>
          <?php } ?>
        </tr>
        <tr>
		   <td >Capital 4</td>
	       <td align="right" ><?php echo number_format($_SESSION['capital'], 2, '.',','); ?></td> 
		</tr>
		<tr>  
	       <td >Interes Deven.</td>
	       <td align="right" ><?php echo number_format($_SESSION['intdev'], 2, '.',','); ?></td> 
		</tr>`
        <tr>  
	       <td >Interes</td>
	       <td align="right" ><?php echo number_format($_SESSION['interes'], 2, '.',','); ?></td> 
		</tr>`
		<tr>  
	       <td >Interes Vencido</td>
	       <td align="right" ><?php echo number_format($_SESSION['intmora'], 2, '.',','); ?></td>
		</tr>
        <tr>  
	       <td >Interes Penal</td>
	       <td align="right" ><?php echo number_format($_SESSION['penal'], 2, '.',','); ?></td>
		</tr>
        
		<tr>  
	       <td >Fondo Garantia</td>
	       <td align="right" ><?php echo number_format($_SESSION['ahorro'], 2, '.',','); ?></td>
		</tr>
		<?php
	  if ($_SESSION['EMPRESA_TIPO'] == 2){
	    if ($mon == 2){
		    $itf = round(calculo_itf($_SESSION['capital']+$_SESSION['intmora']+$_SESSION['interes']),2);
		   $_SESSION['itf'] = $itf; ?>    
		<tr>  
	       <td >ITF</td>
	       <td align="right" ><?php echo number_format($_SESSION['itf'], 2, '.',','); ?></td>
		</tr> 
		 <?php } 
		         }?>  
		<tr>   
	       <td style="background-color: #6699FF" align="center" >Importe Total</td>
	       <td style="background-color: #6699FF" align="right" >
		              <?php echo number_format($_SESSION['capital']+$_SESSION['interes']+$_SESSION['intdev']+
		              $_SESSION['intmora']+$_SESSION['penal']+$_SESSION['ahorro']+$_SESSION['itf'], 2, '.',','); ?></td> 
		</tr>
		</table>
	
		
		<?php
		  if ($_SESSION['cargo'] == 4){
		 
		
		 
		 
		  if ($impo_p > 0) {
		      //9 b ?>
		  <input type="submit" name="accion" value="Aplicar">
	      <input type="submit" name="accion" value="Condonar">
          <!--input type="submit" name="accion" value="Salir"-->
          <?php } //7 b?>	
		  <?php if ($impo_p == 0) { //9 b ?>
		  <input type="submit" name="accion" value="Aplicar">
	      <!--input type="submit" name="accion" value="Salir"-->
          <?php }
		    }else{
			if ($_SESSION['cargo'] <> 2){
			 //7 b?>
			<input type="submit" name="accion" value="Condona_sup">
          <input type="submit" name="accion" value="Terminar">	
		  
</form>	
	<?php }
	 } 
	}//7 b?>	 
	
  <?php if ($_SESSION["detalle"] == 6){
           if ($_POST['descrip'] <> ""){  
	$descrip = $_POST['descrip'];
	$descrip = strtoupper ($descrip);
	$_SESSION['q_paga'] = $descrip;
	}
           $_SESSION['ahorro'] = 0;
		   $_SESSION['tipo_cob'] = 3;
		   $impo_g = 0;
		//   echo $_SESSION['intmora']." ----".$_SESSION['mon_cint_v']; 
		 if ($_SESSION['EMPRESA_TIPO'] == 2){
		     if ($_SESSION['mon_cint_v'] >  $_SESSION['intmora']){
		          $_SESSION['intmora'] = 0;
				  }else{
				  $_SESSION['intmora'] =  $_SESSION['intmora'];
				 
		       }
		  }
		   
		   
		   
		   ?>  
   
   </div id="TableModulo2">
   <?php  echo encadenar(10)."DETALLE DE COBRO "; ?>  
    <table width="40%"  border="1" cellspacing="1" cellpadding="1" align="center">
        <tr>
		   <th width="20%" scope="col"><border="0" alt="" align="center" />Concepto</th>
		   <?php if ($mon == 1){ ?>	
           <th width="20%" scope="col"><border="0" alt="" align="center" />Monto Bolivianos</th>
          <?php } ?>
		    <?php if ($mon == 2){ ?>	
           <th width="20%" scope="col"><border="0" alt="" align="center" />Monto Dolares</th>
          <?php } ?>
        </tr>
        <tr>
		   <td >Capital </td>
	       <td align="right" ><?php echo number_format($_SESSION['capital'], 2, '.',','); ?></td> 
		</tr>
		<tr>  
	       <td >Interes Deven.</td>
	       <td align="right" ><?php echo number_format($_SESSION['intdev'], 2, '.',','); ?></td> 
		</tr>
        <tr>  
	       <td >Interes</td>
	       <td align="right" ><?php echo number_format($_SESSION['interes'], 2, '.',','); ?></td> 
		</tr>
		<tr>  
	       <td >Interes Vencido</td>
	       <td align="right" ><?php echo number_format($_SESSION['intmora'], 2, '.',','); ?></td>
		</tr>
        <tr>  
	       <td >Interes Penal</td>
	       <td align="right" ><?php echo number_format($_SESSION['penal'], 2, '.',','); ?></td>
		</tr>
       
		<tr>  
	       <td >Fondo Garantia</td>
	       <td align="right" ><?php echo number_format($_SESSION['ahorro'], 2, '.',','); ?></td>
		</tr> 
		<?php
		  if ($_SESSION['EMPRESA_TIPO'] == 2){
	    if ($mon == 2){
		    $itf = calculo_itf($_SESSION['capital']+$_SESSION['intmora']+$_SESSION['interes']);
			//echo $itf."itf 1";
		   $_SESSION['itf'] = $itf;
		   
		   //echo $_SESSION['itf']."itf"; ?>    
		<tr>  
	       <td >ITF</td>
	       <td align="right" ><?php echo number_format($_SESSION['itf'], 2, '.',','); ?></td>
		</tr> 
		 <?php } 
		         }?>    
		<tr>  
	       <td style="background-color: #6699FF" align="center" >Importe Total</td>
	       <td style="background-color: #6699FF" align="right" >
		              <?php echo number_format($_SESSION['capital']+$_SESSION['interes']+$_SESSION['intmora']+
					                           $_SESSION['penal']+$_SESSION['intdev'] + $_SESSION['itf'], 2, '.',',');?></td> 
		</tr>
		</table>
 <?php if ($impo_p > 0) { //9 b ?>
		  <input type="submit" name="accion" value="Aplicar">
	      <input type="submit" name="accion" value="Condonar">
          <!--input type="submit" name="accion" value="Salir"-->
          <?php } //7 b?>	
		  <?php if ($impo_p == 0) { //9 b ?>
		  <input type="submit" name="accion" value="Aplicar">
	      <!--input type="submit" name="accion" value="Salir"-->
          <?php } //7 b?>	
      
</form>	
	<?php } //7 b?>	 	
 <?php if ($_SESSION["detalle"] == 3){ //8 a
          $_SESSION['dif_tc'] = 0;
		  $_SESSION['mon_bs'] = 0;
		  $_SESSION['mon_us'] = 0;
		  $_SESSION['mon_fg'] = 0;
          $monto_t = 0;
		  $monto_tot = 0;
		  
		  /*  */
		  
          if ($mon == 1){
	         if ($_POST['mon_bs'] > 0){
			     $_SESSION['mon_bs'] = $_POST['mon_bs'];
	            $monto_t = $monto_t + $_POST['mon_bs'];
	          }
		  if ($_POST['mon_us'] > 0){  
	            $monto_t = $monto_t + ($_POST['mon_us']*$_SESSION['TC_COMPRA']);
				 $_SESSION['mon_us'] = $_POST['mon_us'];
				$monto_tot = $monto_t;
				$monto_com = $_POST['mon_us']*$_SESSION['TC_COMPRA'];
				$monto_ctb = $_POST['mon_us']*$_SESSION['TC_CONTAB'];
				$_SESSION['monto_com'] = $monto_com;
				$_SESSION['dif_tc'] = $monto_ctb - $monto_com;
	          }
		  }
		  if ($mon == 2){
	         if ($_POST['mon_us'] > 0){ 
	            $monto_t = $monto_t + $_POST['mon_us'];
				$_SESSION['mon_us'] = $_POST['mon_us'];
	          }
		  if ($_POST['mon_bs'] > 0){ 
		        $monto_t = $monto_t + $_POST['mon_bs'];
				$_SESSION['mon_bs'] = $_POST['mon_bs'];
				$monto_ven = $_POST['mon_bs']*$_SESSION['TC_VENTA'];
				$monto_ctb = $_POST['mon_bs']*$_SESSION['TC_CONTAB'];
				$_SESSION['monto_ven'] = $monto_ven;
				$_SESSION['dif_tc'] = ($monto_ven - $monto_ctb);
				
	          }
		  }
		  if ($_POST['mon_fg'] > 0){  
		   $_SESSION['mon_fg'] = $_POST['mon_fg'];
		  if ($_POST['mon_fg'] > round(($depos-$ret),2)){
				   echo "Verifique Monto Fondo Garantia mayor al Saldo de la cuenta";
				     $_SESSION['calculo'] = 2;
		   $_SESSION['detalle'] = 2;
		   $_SESSION['continuar'] = 2;
				 header('Location: cobro_detalle_2.php');
				 
				   } 
		  
		  
		  
	echo "entra aqui a verificar";	  
		  
    $monto_t = $monto_t + $_POST['mon_fg'];
	          }
	if ($mon == 2){		  
		  $monto_tot = $_POST['mon_us']+$_POST['mon_bs']+$_POST['mon_fg'];
		  $monto_t = $monto_tot;
		}  
		   if ($_SESSION['EMPRESA_TIPO'] == 2){
	           if ($mon == 2){
			      $itf= round(calculo_itf($monto_t-$_SESSION['ahorro']),2);
		          $_SESSION['itf'] = $itf;
			      }
		     }
			 
		 if ($_SESSION['EMPRESA_TIPO'] == 2){
		     if ($_SESSION['mon_cint_v'] >  $_SESSION['intmora']){
		          $_SESSION['intmora'] = 0;
				  }else{
				  $_SESSION['intmora'] =  $_SESSION['intmora'];
		       }
		  }
		  if ($_SESSION['itf'] > 0){
		
		          $monto_t = $monto_t - $_SESSION['itf'];
			 
			}
	//Verificacion Monto Total
		
		
		
		//	Cobro sin fondo	
		//echo $_SESSION['COBRO_TIPO']."cobro tipo";
		
		 if ($_SESSION['COBRO_TIPO'] == 1){	
		     $_SESSION['ahorro'] = 0; 
		  if ($_SESSION['interes'] > 0){
		     if ($monto_t > $_SESSION['interes']){
		        $monto_t = $monto_t - ($_SESSION['interes']);
			   }else{
			    $_SESSION['interes'] = $monto_t;
			    $monto_t = 0;
			    $_SESSION['capital'] = 0;
			  }
		   }
	//echo $monto_t."  ".$_SESSION['intdev']."Aqui";
		   
		    if ($_SESSION['intdev'] > 0){
		     if ($monto_t > $_SESSION['intdev']){
		        $monto_t = $monto_t - ($_SESSION['intdev']);
				$_SESSION['capital'] = $monto_t;
			   }else{
			    $_SESSION['intdev'] = $monto_t;
			    $monto_t = 0;
			    $_SESSION['capital'] = 0;
			  }
		   }
		    if ($_SESSION['penal'] > 0){
		         if ($monto_t >= $_SESSION['penal']){
				// echo "penal".$monto_t ."---".$_SESSION['penal'];
				 
		             $monto_t = $monto_t - $_SESSION['penal'];
				     }else{
			         $_SESSION['penal'] = $monto_t;
			         $monto_t = 0;
			         $_SESSION['capital'] = 0;
			     }
		      }
		   if ($_SESSION['intmora'] > 0){
		     if ($monto_t > $_SESSION['intmora']){
		        $monto_t = $monto_t - $_SESSION['intmora'];
			   }else{
			    $_SESSION['intmora'] = $monto_t;
			    $monto_t = 0;
			    $_SESSION['capital'] = 0;
			  }
		   }
		 //Total pagado > Saldo  
		  if (($monto_t > $_SESSION['saldo'])&&($_SESSION['cta_fdo'] == 0)){
			       //echo "Error Capital mayor a Saldo del credito";
				   $_SESSION['calculo'] = 2;
		           $_SESSION['detalle'] = 2;
		 		   $_SESSION['continuar'] = 2;
		   		   header('Location: cobro_detalle_2.php');
		  }
			 
		   if ($_SESSION['capital'] > 0){
		       if ($monto_t >= $_SESSION['saldo']){
			      if ($monto_t > $_SESSION['capital']){ 
	                 $monto_t = $monto_t - $_SESSION['capital']; 
					 if ($_SESSION['COBRO_TIPO'] == 2){	
			         $_SESSION['ahorro'] = $_SESSION['ahorro'] + $monto_t;
					 }
				     }else{
				     $_SESSION['capital'] =  $monto_t;
					 $monto_t = 0;
				   }  
			   }else{
			      if ($monto_t > $_SESSION['capital']){ 
				    //  echo "aquiiii  2";
					 // $_SESSION['capital'] =  $monto_t; 
			         // $monto_t = 0; 
			          //}else{
					   if ($_SESSION['cta_fdo'] <> 0) {
					       $monto_t = $monto_t - $_SESSION['capital']; 
			               $_SESSION['ahorro'] = $_SESSION['ahorro'] + $monto_t;
						   $monto_t = 0;
                           }else{
						   $_SESSION['ahorro'] = 0;	
						   $_SESSION['capital'] =  $monto_t;
					       $monto_t = 0;
						//   }
						// }  
					  }
			      }else{
				  $_SESSION['capital'] =  $monto_t;
				     $monto_t = 0;
					//echo  $_SESSION['saldo']."saldo",$_SESSION['capital'],"capital",$monto_t;
					}	   
			  }  
			}
			//echo  $_SESSION['saldo']."saldo",$_SESSION['capital'],"capital",$monto_t;
			}
	// Cobro con Fondo		
			 if ($_SESSION['COBRO_TIPO'] == 2){
			    if ($_SESSION['ahorro'] > 0){
			       if ($monto_t < $_SESSION['ahorro']){
				      // echo $_SESSION['ahorro'],$monto_t,"???";
					   $_SESSION['ahorro'] = $monto_t;
			           $monto_t = 0;
				   	  }
				    if ($_SESSION['ahorro'] >= $monto_t){
				        $monto_t = 0;
				      }
				    if ($monto_t > $_SESSION['ahorro']){
				       $monto_t = $monto_t - $_SESSION['ahorro'];
					 }
			    }
				 if ($_SESSION['COBRO_TIPO'] == 1){
				      $_SESSION['ahorro'] = 0;
				}	  
			 if ($_SESSION['intmora'] > 0){
		        if ($monto_t > $_SESSION['intmora']){
		           $monto_t = $monto_t - $_SESSION['intmora'];
			       }else{
			       $_SESSION['intmora'] = $monto_t;
			       $monto_t = 0;
			       $_SESSION['capital'] = 0;
			     }
		      }
			   if ($_SESSION['penal'] > 0){
		         if ($monto_t >= $_SESSION['penal']){
				// echo "penal".$monto_t ."---".$_SESSION['penal'];
				 
		             $monto_t = $monto_t - $_SESSION['penal'];
				     }else{
			         $_SESSION['penal'] = $monto_t;
			         $monto_t = 0;
			         $_SESSION['capital'] = 0;
			     }
		      }
			  if ($_SESSION['intdev'] > 0){
			  //   echo "Aqui.....";
		         if ($monto_t >= $_SESSION['intdev']){
		             $monto_t = $monto_t - $_SESSION['intdev'];
				     }else{
			         $_SESSION['intdev'] = $monto_t;
			         $monto_t = 0;
			         $_SESSION['capital'] = 0;
			     }
		      }
			   if ($_SESSION['interes'] > 0){
		         if ($monto_t >= $_SESSION['interes']){
		             $monto_t = $monto_t - $_SESSION['interes'];
				     }else{
			         $_SESSION['interes'] = $monto_t;
			         $monto_t = 0;
			         $_SESSION['capital'] = 0;
			     }
		      }
		 // echo  $_SESSION['saldo']."saldo",$_SESSION['capital'],"capital",$monto_t;
		   if ($_SESSION['capital'] > 0){
		       if ($monto_t >= $_SESSION['saldo']){
			      if ($monto_t > $_SESSION['capital']){ 
				     $monto_t = $monto_t - $_SESSION['capital']; 
					 
			         $_SESSION['ahorro'] = $_SESSION['ahorro'] + $monto_t;
				     }else{
				     $_SESSION['capital'] =  $monto_t;
					 $monto_t = 0;
				   }  
			   }else{
			      if ($monto_t > $_SESSION['capital']){ 
				    //  echo "aquiiii  2";
			          $monto_t = $monto_t - $_SESSION['capital']; 
			          $_SESSION['ahorro'] = $_SESSION['ahorro'] + $monto_t;
					   if ($_SESSION['COBRO_TIPO'] == 1){
				      $_SESSION['ahorro'] = 0;
				}
				     }else{
					 if ($_SESSION['COBRO_TIPO'] == 1){
				      $_SESSION['ahorro'] = 0;
				}
				      $_SESSION['capital'] =  $monto_t;
					  $monto_t = 0;
			      }	
			  }  
			}
          }
	
			 
			if ($_SESSION['EMPRESA_TIPO'] == 2){
	           if ($mon == 2){ 
		          if (($_SESSION['capital'] + $_SESSION['interes'] + $_SESSION['intmora']) > 0){
				     $itf1 = $_SESSION['itf'];  
			         $itf2 = round(calculo_itf($_SESSION['capital'] + $_SESSION['interes'] + $_SESSION['intmora']),2);
					
					 if ($itf2 > $itf1){
					     $_SESSION['itf'] = $itf2;
						 if ($_SESSION['ahorro'] > ($itf2 - $itf1)){
						     $_SESSION['ahorro'] = $_SESSION['ahorro'] - ($itf2 - $itf1);
						  }else{
						  if ($_SESSION['capital'] > ($itf2 - $itf1)){
						     $_SESSION['capital'] = $_SESSION['capital'] - ($itf2 - $itf1);
						  }else{
						   if ($_SESSION['interes'] > 0){
					
						       $itf3 = round(calculo_itf($_SESSION['interes']),2);
							   $_SESSION['itf'] = $itf3;
						       $_SESSION['interes'] = $_SESSION['interes'] - $itf3;
							   	
					         }
									  
						  
						  }
						  }
					
					 }
				     }else{
				     $_SESSION['itf'] = 0;
				     $_SESSION['ahorro'] = $monto_tot;
					 if ($_SESSION['COBRO_TIPO'] == 1){
				      $_SESSION['ahorro'] = 0;
				}
				   } 
				}
			}
			
	if (isset($_POST['mon_bs'])){		 
			 $_SESSION['via_bs'] = $_POST['mon_bs'];
	}else{
	    	 $_SESSION['via_bs'] = 0; 
			 $_POST['mon_bs']= 0;
	}
	if (isset($_POST['mon_us'])){		 	 
		  	 $_SESSION['via_us'] = $_POST['mon_us'];
		}else{
		      $_SESSION['via_us'] =  0;
			  $_POST['mon_us'] = 0;
		}
		if (isset($_POST['mon_fg'])){	  
			 $_SESSION['via_ah'] = $_POST['mon_fg'];
		}else{
		    $_SESSION['via_ah'] = 0;
			$_POST['mon_fg'] = 0;
		}	
			 
			 
		?>
    <?php } // 8 b ?>
     
   </div id="TableModulo2">
   
   <?php   ?>
   </form>
	<form name="form2" method="post" action="cobro_retro_opd.php" onSubmit="return ValidarCamposUsuario(this)">
    <br>
  <?php 
   if ($_SESSION["detalle"] == 3){ //9 a
      echo encadenar(10)."DETALLE DE COBRO ";
	  ?>  
	  <table width="50%"  border="1" cellspacing="1" cellpadding="1" align="center">
	  <?php if ($mon == 1){
	            $monto_tot = $_POST['mon_bs']+ $_POST['mon_us']*$_SESSION['TC_COMPRA']+$_POST['mon_fg']; ?> 
	      <tr>
		    <th width="25%" scope="col"><border="0" alt="" align="center" />Descrip.</th>
		    <th width="20%" scope="col"><border="0" alt="" align="center" />Bolivianos</th>
		    <th width="20%" scope="col"><border="0" alt="" align="center" />TC. Compra</th>
		    <th width="20%" scope="col"><border="0" alt="" align="center" />Dolares</th>
		   </tr>
		   <tr>
		   <td align="right" ><?php echo "Efectivo Bs."; ?></td> 
		   <td align="right" ><?php echo number_format($_POST['mon_bs'], 2, '.',','); ?></td> 
		   <td align="right" ><?php echo encadenar(6); ?></td> 
		   <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td> 
		 </tr>
		 <tr>
		    <td align="right" ><?php echo "Efectivo Dol."; ?></td>
		   <td align="right" ><?php echo number_format($_POST['mon_us']*$_SESSION['TC_COMPRA'], 2, '.',','); ?></td> 
		   <td align="right" ><?php echo number_format($_SESSION['TC_COMPRA'], 2, '.',','); ?></td> 
		   <td align="right" ><?php echo number_format($_POST['mon_us'], 2, '.',','); ?></td> 
		 </tr>
		 <tr>
		    <td align="right" ><?php echo "Fondo Garantia"; ?></td>
		   <td align="right" ><?php echo number_format($_POST['mon_fg'], 2, '.',','); ?></td> 
		   <td align="right" ><?php echo encadenar(6); ?></td> 
		   <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td> 
		 </tr>
	   	<?php } ?>    
	     <?php if ($mon == 2){
		      $monto_tot = $_POST['mon_us']+ $_POST['mon_bs']+$_POST['mon_fg']?> 
	      <tr>
		     <th width="20%" scope="col"><border="0" alt="" align="center" />Descrip.</th>
		    <th width="20%" scope="col"><border="0" alt="" align="center" />Dolares</th>
		    <th width="20%" scope="col"><border="0" alt="" align="center" />TC. Venta</th>
		    <th width="20%" scope="col"><border="0" alt="" align="center" />Bolivianos</th>
		   </tr>
		   <tr>
		    <td align="right" ><?php echo "Efectivo Dol."; ?></td>
		   <td align="right" ><?php echo number_format($_POST['mon_us'], 2, '.',','); ?></td> 
		   <td align="right" ><?php echo encadenar(6); ?></td> 
		   <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td> 
		 </tr>
		 <tr>
		   <td align="right" ><?php echo "Efectivo Bs."; ?></td>
		   <td align="right" ><?php echo number_format($_POST['mon_bs'], 2, '.',','); ?></td> 
		   <td align="right" ><?php echo  number_format($_SESSION['TC_VENTA'], 2, '.',','); ?></td> 
		   <td align="right" ><?php echo number_format($_POST['mon_bs']*$_SESSION['TC_VENTA'], 2, '.',','); ?></td> 
		 </tr>
		  <tr>
		    <td align="right" ><?php echo "Fdo. Garantia"; ?></td>
		   <td align="right" ><?php echo number_format($_POST['mon_fg'], 2, '.',','); ?></td> 
		   <td align="right" ><?php echo encadenar(6); ?></td> 
		   <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td> 
		 </tr>
	   	<?php } ?> 
	  </table>	   
	  <font color="#0033CC">
	  Monto Total en la moneda del Cr&eacute;dito 
	        <?php echo encadenar(2).number_format($monto_tot, 2, '.',',');
			      $_SESSION['monto_tot'] = $monto_tot;  ?> 
  
  </font>
	<br>
	 <?php
	  if ($_SESSION['EMPRESA_TIPO'] == 2){
	    if ($mon == 2){ 
		    if (($_SESSION['capital'] + $_SESSION['interes'] + $_SESSION['intmora']) > 0){
			    $_SESSION['itf'] = calculo_itf($_SESSION['capital'] + $_SESSION['interes'] + $_SESSION['intmora']);
			//	
				}else{
				$_SESSION['itf'] = 0;
				} 
		   ?>    
		
		 <?php } 
		         }?>  
    <table width="40%"  border="1" cellspacing="1" cellpadding="1" align="center">
        <tr>
		   <th width="20%" scope="col"><border="0" alt="" align="center" />Concepto</th>
		   <?php if ($mon == 1){ ?>	
           <th width="20%" scope="col"><border="0" alt="" align="center" />Monto Bolivianos</th>
          <?php } ?>
		    <?php if ($mon == 2){ ?>	
           <th width="20%" scope="col"><border="0" alt="" align="center" />Monto Dolares</th>
          <?php } ?>
        </tr>
        <tr>
		   <td >Capital </td>
	       <td align="right" ><?php echo number_format($_SESSION['capital'], 2, '.',','); ?></td> 
		</tr>
		 <tr>  
	       <td >Interes Deven.</td>
	       <td align="right" ><?php echo number_format($_SESSION['intdev'], 2, '.',','); ?></td> 
		</tr>
        <tr>  
	       <td >Interes</td>
	       <td align="right" ><?php echo number_format($_SESSION['interes'], 2, '.',','); ?></td> 
		</tr>
		 <tr>  
	       <td >Interes Vencido</td>
	       <td align="right" ><?php echo number_format($_SESSION['intmora'], 2, '.',','); ?></td>
		</tr>
        <tr>  
	       <td >Interes Penal</td>
	       <td align="right" ><?php echo number_format($_SESSION['penal'], 2, '.',','); ?></td>
		</tr>
       
		<tr>  
	       <td >Fondo Garantia</td>
	       <td align="right" ><?php echo number_format($_SESSION['ahorro'], 2, '.',','); ?></td>
		</tr>  
		 <?php
	  if ($_SESSION['EMPRESA_TIPO'] == 2){
	    if ($mon == 2){ 
		
		   ?>    
		<tr>  
	       <td >ITF 2</td>
	       <td align="right" ><?php echo number_format($_SESSION['itf'], 2, '.',','); ?></td>
		</tr> 
		 <?php } 
		         }?>  
		<tr>  
	       <td style="background-color: #6699FF" align="center" >Importe Total</td>
	       <td style="background-color: #6699FF" align="right" >
		       <?php echo number_format($_SESSION['capital']+$_SESSION['interes']+$_SESSION['intmora']+$_SESSION['intdev']
			         +$_SESSION['penal']+$_SESSION['ahorro']+$_SESSION['itf'], 2, '.',','); ?></td> 
		</tr>
		</table>
		
		
		
		
		
	 <?php if ($_SESSION['cargo'] == 4){ 
		       if (($t_cred == 1)&& ($tope < 1)) {
		       $num_cli = 0;
			   $tot_cta_i = 0;
			   $cta_i = 0;
			    echo "Detalle Individual";
			   ?>
		<br>
			   
		
		
		  <table width="60%"  border="1" cellspacing="1" cellpadding="1" align="center">
		  
		 <tr>
		 <th align="center"><font size="-1">Nro.</th>
	    <th align="center"><font size="-1">CLIENTE</th>
		<th align="center"><font size="-1">TOTAL CUOTA</th>
		<th align="center"><font size="-1">MONTO PAGADO</th>
		
		</tr>
		 
		 
		<?php
		
		 $con_cpla = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sol
		             and CRED_PLD_NRO_CTA = $f_cta
		             and CRED_PLD_USR_BAJA is null ";
         $res_cpla = mysql_query($con_cpla)or die('No pudo leer : cred_plandp' . mysql_error());
		 
		 while ($lin_cpla = mysql_fetch_array($res_cpla)) {
		        $num_cli = $num_cli + 1;
                $cta_nro = $lin_cpla['CRED_PLD_NRO_CTA']; 
		        $cta_fec = $lin_cpla['CRED_PLD_FECHA']; 
				$cta_cap = $lin_cpla['CRED_PLD_CAPITAL'];
		        $cta_int = $lin_cpla['CRED_PLD_INTERES'];
		        $cta_aho = $lin_cpla['CRED_PLD_AHORRO'];
				$cta_cli = $lin_cpla['CRED_PLD_COD_CLI'];
				 if ($p_int == 1) { 
				     $cta_i = $cta_cap+$cta_int+$cta_aho;
				   }
				 if ($p_int == 4) { 
				     $cta_i = $cta_cap+$cta_aho;
				   }  
				 $tot_cta_i = $tot_cta_i + $cta_i;
			$con_pcli  = "Select * From cliente_general
             where CLIENTE_COD = $cta_cli and 
			       CLIENTE_USR_BAJA is null"; 
             $res_pcli = mysql_query($con_pcli)or die('No pudo seleccionarse cliente_general');
 
             while ($lin_pcli = mysql_fetch_array($res_pcli)) {
			 $nom_clip = $lin_pcli['CLIENTE_AP_PATERNO'].encadenar(1).
					$lin_pcli['CLIENTE_AP_MATERNO'].encadenar(1).
					$lin_pcli['CLIENTE_AP_ESPOSO'].encadenar(1).
					$lin_pcli['CLIENTE_NOMBRES'];
			 
			 }
				
		?>		
		<tr>
		<td align="center" ><?php echo number_format($num_cli,0, '.',','); ?></td>
	   	<td align="left" style="font-size:10px" ><?php echo $nom_clip; ?></td>
		<td align="right" ><?php echo number_format($cta_i, 2, '.',','); ?></td>
		<?php if(isset($num_cli)){
		if ($num_cli == 1){
		   $_SESSION["cli_1"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_1" width="10"  
		size="20" value=0 ></td>	
		
		 <?php } }?></td>  
		 <?php if(isset($num_cli)){
		if ($num_cli == 2){
		  $_SESSION["cli_2"] = $cta_cli; ?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_2" width="10"  
		size="20" value=0 ></td>
		
			 <?php } }?></td>  
		<?php if(isset($num_cli)){
		if ($num_cli == 3){
		    $_SESSION["cli_3"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_3" width="10"  
		size="20" value=0 ></td>	
			
			 <?php } }?></td> 	
		<?php if(isset($num_cli)){
		if ($num_cli == 4){
		    $_SESSION["cli_4"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_4" width="10"  
		size="20" value=0 ></td>
			
			 <?php } }?></td> 
		<?php if(isset($num_cli)){
		if ($num_cli == 5){
		    $_SESSION["cli_5"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_5" width="10"  
		size="20" value=0 ></td>
		
			 <?php } }?></td> 	
		<?php if(isset($num_cli)){
		if ($num_cli == 6){
		   $_SESSION["cli_6"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_6" width="10"  
		size="20" value=0></td>
			
			 <?php } }?></td> 	 	  	 	 	  
		<?php if(isset($num_cli)){
		if ($num_cli == 7){
		   $_SESSION["cli_7"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_7" width="10"  
		size="20" value=0 ></td>	
		
			 <?php } }?></td> 
		<?php if(isset($num_cli)){
		if ($num_cli == 8){
		   $_SESSION["cli_8"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_8" width="10"  
		size="20" value=0 ></td>
			
			 <?php } }?></td> 		 	 	 
		<?php if(isset($num_cli)){
		if ($num_cli == 9){
		   $_SESSION["cli_9"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_9" width="10"  
		size="20" value=0 ></td>	
			
			 <?php } }?></td> 
		<?php if(isset($num_cli)){
		if ($num_cli == 10){
		   $_SESSION["cli_10"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_10" width="10"  
		size="20" value=0 ></td>
			
			 <?php } }?></td> 	
		<?php if(isset($num_cli)){
		if ($num_cli == 11){
		   $_SESSION["cli_11"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_11" width="10"  
		size="20" value=0 ></td>	
		
			 <?php } }?></td> 	 	 		 
		<?php if(isset($num_cli)){
		if ($num_cli == 12){
		    $_SESSION["cli_12"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_12" width="10"  
		size="20" value=0 ></td>	
			
			 <?php } }?></td> 	 
		<?php if(isset($num_cli)){
		if ($num_cli == 13){
		   $_SESSION["cli_13"] = $cta_cli; ?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_13" width="10"  
		size="20" value=0 ></td>	
		
			 <?php } }?></td> 	 
		<?php if(isset($num_cli)){
		if ($num_cli == 14){
		   $_SESSION["cli_14"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_14" width="10"  
		size="20" value=0 ></td>	
		
			 <?php } }?></td> 	 
		<?php if(isset($num_cli)){
		if ($num_cli == 15){
		   $_SESSION["cli_15"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_15" width="10"  
		size="20" value=0 ></td>
			
			 <?php } }?></td> 	 
		<?php if(isset($num_cli)){
		if ($num_cli == 16){
		    $_SESSION["cli_16"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_16" width="10"  
		size="20" value=0 ></td>	
		
			 <?php } }?></td> 	 
		<?php if(isset($num_cli)){
		if ($num_cli == 17){
		   $_SESSION["cli_17"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_17" width="10"  
		size="20" value=0 ></td>	
			
			 <?php } }?></td> 	 
		<?php if(isset($num_cli)){
		if ($num_cli == 18){
		    $_SESSION["cli_18"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_18" width="10"  
		size="20" value=0 ></td>	
			
			 <?php } }?></td> 	 
		<?php if(isset($num_cli)){
		if ($num_cli == 19){
		   $_SESSION["cli_19"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_19" width="10"  
		size="20" value=0 ></td>
		
			 <?php } }?></td> 	 
		<?php if(isset($num_cli)){
		if ($num_cli == 20){?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_20" width="10"  
		size="20" value=0 ></td>
		
			 <?php } }?></td> 	 
				
				
	<?php }	?>
	<tr>
		<td align="center" ><?php echo encadenar(2); ?></td>
	   	<th align="left" ><?php echo "Total"; ?></td>
		<th align="right" ><?php echo number_format($tot_cta_i, 2, '.',','); ?></td>
	 	<td align="right" ><?php echo encadenar(2); ?></td>	
		
	</tr>		
	
	
	
		</table>
		<input type="submit" name="accion" value="Valida_Ind_2">
	    <!--input type="submit" name="accion" value="Salir"-->
      
</form>	
         
	<br><br>	  	
 <?php }
         }?>		
		<input type="submit" name="accion" value="Imprimir">
	    <!--input type="submit" name="accion" value="Salir"-->	
		 <?php if ($impo_p > 0) { //9 b ?>
		<input type="submit" name="accion" value="Imprimir">
	    <input type="submit" name="accion" value="Condonar">
        <!--input type="submit" name="accion" value="Salir"-->
       <?php } //9 b ?>
	    <?php if ($impo_p == 0) { //9 b ?>
		
       <?php } //9 b ?>
</form>	
	      
   <?php } //9 b ?>
   
 <?php if ($_SESSION["detalle"] == 4){ // 10 a
	       echo encadenar(10)."DETALLE DE COBRO MONTO A CONDONAR".encadenar(10); ?>
    
	<table width="60%"  border="1" cellspacing="1" cellpadding="1" align="center">
        <tr>
		   <th width="20%" scope="col"><border="0" alt="" align="center" />Concepto</th>
           <th width="20%" scope="col"><border="0" alt="" align="center" />Monto Calculado</th>
           <th width="20%" scope="col"><border="0" alt="" align="center" />Monto Condonado</th>
	       
        </tr>
        <tr>
		   <td >Capital 2</td>
	       <td align="right" ><?php echo number_format($_SESSION['capital'], 2, '.',','); ?></td> 
		   <td align="right" ><?php echo encadenar(3); ?></td> 
		 </tr>
		  <tr>  
	       <td >Interes Deven.</td>
	       <td align="right" ><?php echo number_format($_SESSION['intdev'], 2, '.',','); ?></td> 
		  
		 </tr>
        <tr>  
	       <td >Interes</td>
	       <td align="right" ><?php echo number_format($_SESSION['interes'], 2, '.',','); ?></td> 
		  
		 </tr>
		 <tr>  
	       <td >Interes Vencido</td>
	       <td align="right" ><?php echo number_format($_SESSION['intmora'], 2, '.',','); ?></td>
		 </tr>
        <tr>  
	       <td >Interes Penal</td>
	       <td align="right" ><?php echo number_format($_SESSION['penal'], 2, '.',','); ?></td> 
	       <td align="right" ><input type="text" name="imp_p" width="10"  size="12" value=0 ></td> 
		 </tr>
         <tr>  
	       <td >Fondo Garantia</td>
	       <td align="right" ><?php echo number_format($_SESSION['ahorro'], 2, '.',','); ?></td> 
	      
		</tr> 
		 <?php
	  if ($_SESSION['EMPRESA_TIPO'] == 2){
	    if ($mon == 2){ ?>    
		<tr>  
	       <td >ITF</td>
	       <td align="right" ><?php echo number_format($_SESSION['itf'], 2, '.',','); ?></td>
		</tr> 
		 <?php } 
		         }?>  
		
		  
		<tr>  
	       <td style="background-color: #6699FF" align="center" >Importe Total</td>
	       <td style="background-color: #6699FF" align="right" >
		   <?php echo number_format($_SESSION['capital']+$_SESSION['interes']+$_SESSION['intmora']+$_SESSION['intdev']
		                           +$_SESSION['ahorro']+$_SESSION['itf'], 2, '.',','); ?></td> 
	       <td align="right" ><?php echo encadenar(10); ?></td>
		</tr>       
	 
	 
	 
	 
	     </table>
            </div id="TableModulo2">
			<center>
			<br>
		<input type="submit" name="accion" value="Recalcular">
	    <!--input type="submit" name="accion" value="Salir"-->
      
</form>		    	
	
   <?php } //10 b?>	 
	 <?php // } //11 b?>  
  <?php if ($_SESSION["detalle"] == 14){ // 10 a
	       echo encadenar(10)."DETALLE DE COBRO MONTO A CONDONAR".encadenar(10); ?>
    
	<table width="60%"  border="1" cellspacing="1" cellpadding="1" align="center">
        <tr>
		   <th width="20%" scope="col"><border="0" alt="" align="center" />Concepto</th>
           <th width="20%" scope="col"><border="0" alt="" align="center" />Monto Calculado</th>
           <th width="20%" scope="col"><border="0" alt="" align="center" />Monto Condonado</th>
	       
        </tr>
        <tr>
		   <td >Capital 2</td>
	       <td align="right" ><?php echo number_format($_SESSION['capital'], 2, '.',','); ?></td> 
		   <td align="right" ><?php echo encadenar(3); ?></td> 
		 </tr>
		 <tr>  
	       <td >Interes Deven.</td>
	       <td align="right" ><?php echo number_format($_SESSION['intdev'], 2, '.',','); ?></td> 
		   <td align="right" ><input type="text" name="imp_id" width="10"  size="12" value=0 ></td> 
		 </tr>
        <tr>  
	       <td >Interes</td>
	       <td align="right" ><?php echo number_format($_SESSION['interes'], 2, '.',','); ?></td> 
		   <td align="right" ><input type="text" name="imp_i" width="10"  size="12" value=0 ></td> 
		 </tr>
		 <tr>  
	       <td >Interes Vencido</td>
	       <td align="right" ><?php echo number_format($_SESSION['intmora'], 2, '.',','); ?></td>
		   <td align="right" ><input type="text" name="imp_im" width="10"  size="12" value=0 ></td> 
		 </tr>
        <tr>  
	       <td >Interes Penal</td>
	       <td align="right" ><?php echo number_format($_SESSION['penal'], 2, '.',','); ?></td> 
	       <td align="right" ><input type="text" name="imp_p" width="10"  size="12" value=0 ></td> 
		 </tr>
         <tr>  
	       <td >Fondo Garantia</td>
	       <td align="right" ><?php echo number_format($_SESSION['ahorro'], 2, '.',','); ?></td> 
	      
		</tr> 
		 <?php
	  if ($_SESSION['EMPRESA_TIPO'] == 2){
	    if ($mon == 2){ ?>    
		<tr>  
	       <td >ITF</td>
	       <td align="right" ><?php echo number_format($_SESSION['itf'], 2, '.',','); ?></td>
		</tr> 
		 <?php } 
		         }?>  
		
		  
		<tr>  
	       <td style="background-color: #6699FF" align="center" >Importe Total</td>
	       <td style="background-color: #6699FF" align="right" >
		   <?php echo number_format($_SESSION['capital']+$_SESSION['interes']+$_SESSION['intmora']+$_SESSION['intdev']
		                           +$_SESSION['ahorro']+$_SESSION['itf'], 2, '.',','); ?></td> 
	       <td align="right" ><?php echo encadenar(10); ?></td>
		</tr>       
	 
	 
	 
	 
	     </table>
            </div id="TableModulo2">
			<center>
			<br>
		<input type="submit" name="accion" value="Registrar">
	    <!--input type="submit" name="accion" value="Salir"-->
      
</form>		    	
	
   <?php } //10 b?>	 
	 <?php } //11 b?>  
  	<?php if ($_SESSION["detalle"] == 20){ //8 a
             $monto_i = 0;
			 $monto_id = 0;
			 $monto_im = 0;
			 $monto_ip = 0;
			 echo $_POST['imp_id']. "Int Dev";
			 if (isset($_POST['imp_id'])){     
	         if ($_POST['imp_id'] > 0){  
	            $monto_id = $_POST['imp_id'];
								
	          }
			  }
			 
			if (isset($_POST['imp_i'])){     
	         if ($_POST['imp_i'] > 0){  
	            $monto_i = $_POST['imp_i'];
	          }
			  }
			if (isset($_POST['imp_im'])){  
		   if ($_POST['imp_im'] > 0){  
	            $monto_im = $_POST['imp_im'];
	          }
			  }
			if (isset($_POST['imp_p'])){  
		   if ($_POST['imp_p'] > 0){  
	            $monto_ip = $_POST['imp_p'];
	          }
			  }
			$int_org = $_SESSION['interes'];  
			$intm_org = $_SESSION['intmora'];  
			$intd_org = $_SESSION['intdev'];
			$intp_org = $_SESSION['penal'];
		if ($monto_i + $monto_im + $monto_ip + $monto_id > 0){
		    $nro_tra = leer_nro_condona();
			$_SESSION['cond_i'] = 0;
			$_SESSION['nro_tran'] = $nro_tra;
			$_SESSION['cond_im'] = 0;
			$_SESSION['cond_id'] = 0;			 
if ($monto_id > 0) {
$cta_p = $_SESSION['cuota'];
$tc_ctb = $_SESSION['TC_CONTAB'];
$_SESSION['cond_id'] = $monto_id;
		     $consulta = "insert into cart_det_cond
					                   (CART_DET_CON_NCRE,
	                                    CART_DET_CON_TIP_TRAN,
										CART_DET_CON_CODIGO,
										CART_DET_CON_FCH_PRO,
										CART_DET_CON_IMP_O,
										CART_DET_CON_IMPO_N,
										CART_DET_CON_USR_ALTA,
										CART_DET_CON_CHR_FCH_ALTA,
										CART_DET_CON_USR_BAJA,
										CART_DET_CON_FCH_BAJA)
						         values ($ncre,
								         $nro_tra,
										 138, 
										 '$fec1',
										 $intd_org, 
								 		 $monto_id,
										 '$log_usr',
										 null,
										 null,
										 '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar :condonacion ' . mysql_error());
$nro_tr_cart = leer_nro_co_car(5,$log_usr);
				$consulta = "insert into cart_cabecera (CART_CAB_NCRE, 
                                         CART_CAB_AGEN,
									     CART_CAB_NRO_TRAN,
									     CART_CAB_TRAN_CAJ,
										 CART_CAB_TRAN_FON,
									     CART_CAB_FECHA,
										 CART_CAB_NRO_CTA,
					                     CART_CAB_TIP_TRAN,
										 CART_CAB_SAL_ANT,
										 CART_CAB_SAL_DES,
					                     CART_CAB_EST_ANT,
   				                         CART_CAB_EST_ACT,
					                     CART_CAB_TIP_CAM, 
									     CART_CAB_FEC_TRAN, 
									     CART_CAB_FEC_VTO, 
									     CART_CAB_FEC_SUS,
                                         CART_CAB_USR_ALTA,
                                         CART_CAB_FCH_HR_ALTA,
                                         CART_CAB_USR_BAJA,
                                         CART_CAB_FCH_HR_BAJA
									    ) values ($ncre,
									             $c_agen,
												 $nro_tr_cart,
												 $nro_tra,
												 0,
												 '$fec1',
												 '$cta_p',
												 5,
												 $intd_org,
												 $monto_id,
												 6,
												 6,
												 $tc_ctb,
												 '$fec1',
												 null,
												 null,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar cart_cabecera : ' . mysql_error());
    $cta_cart = leer_cta_car(40,$tope,$est,$mon);
    
      $cta_tip =  leer_cta_tip(40,$tope,$est,$mon);
	 // $cap_pag =$_SESSION['capital'] + $mon_pcap_2;
        $importe = $monto_id;
			  if ($mon == 1){
			  //   $cta_ctb = 13105102;
				 $importe_e = $monto_id;
			  }
			  if ($mon == 2){
			  //   $cta_ctb = 13105202;
				 $importe = $monto_id;
				 $importe_e = $monto_id * $_SESSION['TC_CONTAB'];
			  }
			  $deb_hab = 2;
           
		/*	  */

           
$consulta = "insert into cart_det_tran(CART_DTRA_NCRE, 
                                           CART_DTRA_AGEN,
									       CART_DTRA_NRO_TRAN,
										   CART_DTRA_NRO_CTA,
									       CART_DTRA_FECHA,
					                       CART_DTRA_TIP_TRAN,
   				                           CART_DTRA_CCON,
					                       CART_DTRA_DEB_CRE, 
									       CART_DTRA_CTA_CBT, 
									       CART_DTRA_IMPO, 
									       CART_DTRA_IMPO_BS,
                                           CART_DTRA_FEC_TRAN,
                                           CART_DTRA_FEC_INI2,
                                           CART_DTRA_FEC_FIN,
                                           CART_DTRA_TASA,
										   CART_DTRA_EST_ANT,
										   CART_DTRA_VIA,
										   CART_DTRA_TIP_CAM,
										   CART_DTRA_USR_ALTA,
										   CART_DTRA_FCH_HR_ALTA,
										   CART_DTRA_USR_BAJA,
										   CART_DTRA_FCH_HR_BAJA
									       ) values ($ncre,
									                 $c_agen,
												     $nro_tr_cart,
													 $f_cta,
													 '$fec1',
												     5,
												     $cta_tip,
													 $deb_hab,
												     '$cta_cart',
													 $importe,
													 $importe_e,
 											     	 '$fec1',
												     null,
													 null,
													 0,
													 null,
													 null,
												     $tc_ctb,
												    '$log_usr',
												     null,
												     null,
												    '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar cart_det_tran : ' . mysql_error()); 
  
$cta_cart = leer_cta_car(50,$tope,$est,$mon);
$cta_tip =  leer_cta_tip(50,$tope,$est,$mon);
$deb_hab = 1;
$consulta = "insert into cart_det_tran(CART_DTRA_NCRE, 
                                           CART_DTRA_AGEN,
									       CART_DTRA_NRO_TRAN,
										   CART_DTRA_NRO_CTA,
									       CART_DTRA_FECHA,
					                       CART_DTRA_TIP_TRAN,
   				                           CART_DTRA_CCON,
					                       CART_DTRA_DEB_CRE, 
									       CART_DTRA_CTA_CBT, 
									       CART_DTRA_IMPO, 
									       CART_DTRA_IMPO_BS,
                                           CART_DTRA_FEC_TRAN,
                                           CART_DTRA_FEC_INI2,
                                           CART_DTRA_FEC_FIN,
                                           CART_DTRA_TASA,
										   CART_DTRA_EST_ANT,
										   CART_DTRA_VIA,
										   CART_DTRA_TIP_CAM,
										   CART_DTRA_USR_ALTA,
										   CART_DTRA_FCH_HR_ALTA,
										   CART_DTRA_USR_BAJA,
										   CART_DTRA_FCH_HR_BAJA
									       ) values ($ncre,
									                 $c_agen,
												     $nro_tr_cart,
													 $f_cta,
													 '$fec1',
												     5,
												     $cta_tip,
													 $deb_hab,
												     '$cta_cart',
													 $importe,
													 $importe_e,
 											     	 '$fec1',
												     null,
													 null,
													 0,
													 null,
													 null,
												     $tc_ctb,
												    '$log_usr',
												     null,
												     null,
												    '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar cart_det_tran : ' . mysql_error()); 
			 }
			
		
			
		    if ($monto_i > 0) {
			$_SESSION['cond_i'] = $monto_i;
		     $consulta = "insert into cart_det_cond
					                   (CART_DET_CON_NCRE,
	                                    CART_DET_CON_TIP_TRAN,
										CART_DET_CON_CODIGO,
										CART_DET_CON_FCH_PRO,
										CART_DET_CON_IMP_O,
										CART_DET_CON_IMPO_N,
										CART_DET_CON_USR_ALTA,
										CART_DET_CON_CHR_FCH_ALTA,
										CART_DET_CON_USR_BAJA,
										CART_DET_CON_FCH_BAJA)
						         values ($ncre,
								         $nro_tra,
										 513, 
										 '$fec1',
										 $int_org, 
								 		 $monto_i,
										 '$log_usr',
										 null,
										 null,
										 '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar :condonacion ' . mysql_error());
			 }
			 
$_SESSION['cond_im'] = 0;			 
if ($monto_im > 0) {
$_SESSION['cond_im'] = $monto_im;
		     $consulta = "insert into cart_det_cond
					                   (CART_DET_CON_NCRE,
	                                    CART_DET_CON_TIP_TRAN,
										CART_DET_CON_CODIGO,
										CART_DET_CON_FCH_PRO,
										CART_DET_CON_IMP_O,
										CART_DET_CON_IMPO_N,
										CART_DET_CON_USR_ALTA,
										CART_DET_CON_CHR_FCH_ALTA,
										CART_DET_CON_USR_BAJA,
										CART_DET_CON_FCH_BAJA)
						         values ($ncre,
								         $nro_tra,
										 515, 
										 '$fec1',
										 $intm_org, 
								 		 $monto_im,
										 '$log_usr',
										 null,
										 null,
										 '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar :condonacion ' . mysql_error());
			 }
		 if ($monto_ip > 0) {
			$_SESSION['cond_pe'] =  $monto_ip;
		     $consulta = "insert into cart_det_cond
					                   (CART_DET_CON_NCRE,
	                                    CART_DET_CON_TIP_TRAN,
										CART_DET_CON_CODIGO,
										CART_DET_CON_FCH_PRO,
										CART_DET_CON_IMP_O,
										CART_DET_CON_IMPO_N,
										CART_DET_CON_USR_ALTA,
										CART_DET_CON_CHR_FCH_ALTA,
										CART_DET_CON_USR_BAJA,
										CART_DET_CON_FCH_BAJA)
						         values ($ncre,
								         $nro_tra,
										 525, 
										 '$fec1',
										 $intp_org, 
								 		 $monto_ip,
										 '$log_usr',
										 null,
										 null,
										 '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar :condonacion ' . mysql_error());
			 }		 			 
$_SESSION['fechr_proc'] = leer_fechr_con($nro_tra);			 
			} 
header('Location:cart_imp_con.php');			 
		?>
    <?php } // 8 b ?>

   
 <?php
	   if ($t_cred == 5)	        { 
	  ?>  
	  <table width="50%"  border="1" cellspacing="1" cellpadding="1" align="center">
        <tr>
           <th width="22%" scope="col"><border="0" alt="" align="absmiddle" />CODIGO</th>
           <th width="20%" scope="col"><border="0" alt="" align="absmiddle" />NOMBRE COMPLETO</th>
           <th width="25%" scope="col"><border="0" alt="" align="absmiddle" />IMPORTE DESEMBOLSADO</th>
	       <th width="25%" scope="col"><border="0" alt="" align="absmiddle" />IMPORTE CUOTA</th>
		   <th width="25%" scope="col"><border="0" alt="" align="absmiddle" />DEUDA</th>
	       <th width="25%" scope="col"><border="0" alt="" align="absmiddle" />PAGOS</th>
	       <th width="25%" scope="col"><border="0" alt="" align="absmiddle" />MONTO A PAGAR</th> 
		   <th width="25%" scope="col"><border="0" alt="" align="absmiddle" />MONTO EFECTIVO</th> 
        </tr>
	  
	    <?php
	   	
	   while ($lin_deu = mysql_fetch_array($res_deu)){
	          
	   
	   	     $nom_com = $lin_deu['CLIENTE_AP_PATERNO'].encadenar(1).$lin_deu['CLIENTE_AP_MATERNO']
			            .encadenar(1).$lin_deu['CLIENTE_NOMBRES'];
			 $c_clie = $lin_deu['CART_DEU_INTERNO'];
			 
		     $con_sol  = "Select * From cred_deudor where CRED_SOL_CODIGO = $cod_sol and CRED_DEU_INTERNO = $c_clie
		               and CRED_DEU_USR_BAJA is null"; 
             $res_sol = mysql_query($con_sol)or die('No pudo seleccionarse cred_deudor');
		     while ($lin_csol = mysql_fetch_array($res_sol)){
		           $imp_ind = $lin_csol ['CRED_DEU_IMPORTE'];          
				   }
		    $con_cta  = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sol and CRED_PLD_COD_CLI = $c_clie
		                and CRED_PLD_NRO_CTA = 1 and CRED_PLD_USR_BAJA is null"; 
            $res_cta = mysql_query($con_cta)or die('No pudo seleccionarse cred_plandp');
		    while ($lin_cta = mysql_fetch_array($res_cta)){
		          $imp_cta = $lin_cta['CRED_PLD_CAPITAL'] + $lin_cta['CRED_PLD_INTERES'] + $lin_cta['CRED_PLD_AHORRO'];          
				 }
			  
		//calculo deuda por cliente
		$mon_deu_c = 0;		 
		$mon_deu_c = monto_deu_ts($cod_sol,$c_clie,$f_has);
		//calculo pagos por cliente
		$mon_pag_c = 0;
		$mon_pag_c = montos_recu_cli($cod_sol,$f_has,$c_clie,4); 
		//monto a pagar
		$mon_apag_c = 0;
	    $mon_apag_c = $mon_deu_c - $mon_pag_c;	
		
				
	?>
		     <tr>
			    <td bgcolor="" ><?php echo $lin_deu['CART_DEU_INTERNO']; ?></td>
				<td bgcolor="" ><?php echo $nom_com; ?></td>
				<td align="right" ><?php echo number_format($imp_ind, 2, '.',','); ?></td>
				<td align="right" ><?php echo number_format($imp_cta, 2, '.',','); ?></td>
				<td align="right" ><?php echo number_format($mon_deu_c, 2, '.',','); ?></td>
				<td align="right" ><?php echo number_format($mon_pag_c, 2, '.',','); ?></td>
				<td align="right" ><?php echo number_format($mon_apag_c, 2, '.',','); ?></td>
	
	
	<?php
		 	
	  if(isset($cont)){
	    $cont = $cont + 1;
	  } 
	?> 			
	<?php	
   if ($cont == 1) {
      $_SESSION["cont_1"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_1" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
  <?php
    if ($cont == 2) {
      $_SESSION["cont_2"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_2" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
    <?php
    if ($cont == 3) {
      $_SESSION["cont_3"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_3" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
    <?php
    if ($cont == 4) {
	//echo $cont, "  4";
      $_SESSION["cont_4"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_4" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
    <?php
    if ($cont == 5) {
      $_SESSION["cont_5"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_5" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
   <?php

    if ($cont == 6) {
      $_SESSION["cont_6"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_6" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
   <?php
    if ($cont == 7) {
      $_SESSION["cont_7"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_7" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
   <?php
    if ($cont == 8) {
      $_SESSION["cont_8"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_8" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
   <?php
    if ($cont == 9) {
      $_SESSION["cont_9"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_9" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
   <?php
    if ($cont == 10) {
      $_SESSION["cont_10"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_10" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
   <?php
    if ($cont == 11) {
      $_SESSION["cont_11"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_11" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
    <?php
    if ($cont == 12) {
      $_SESSION["cont_12"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_12" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
    <?php
    if ($cont == 13) {
      $_SESSION["cont_13"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_13" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
    <?php
    if ($cont == 14) {
      $_SESSION["cont_14"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_14" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
    <?php
    if ($cont == 15) {
      $_SESSION["cont_15"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_15" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
    <?php
    if ($cont == 16) {
      $_SESSION["cont_16"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_16" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
    <?php
    if ($cont == 17) {
      $_SESSION["cont_17"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_17" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
	 <?php
    if ($cont == 18) {
      $_SESSION["cont_18"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_18" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>	
    <?php
    if ($cont == 19) {
      $_SESSION["cont_19"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_19" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
    <?php
    if ($cont == 20) {
      $_SESSION["cont_20"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_20" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
    <?php
    if ($cont == 21) {
      $_SESSION["cont_21"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_21" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
    <?php
    if ($cont == 22) {
      $_SESSION["cont_22"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_22" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
    <?php
    if ($cont == 23) {
      $_SESSION["cont_23"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_23" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
    <?php
    if ($cont == 24) {
      $_SESSION["cont_24"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_24" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
    <?php
    if ($cont == 25) {
      $_SESSION["cont_25"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_25" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
    <?php
    if ($cont == 26) {
      $_SESSION["cont_26"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_26" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
    <?php
    if ($cont == 27) {
      $_SESSION["cont_27"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_27" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
    <?php
    if ($cont == 28) {
      $_SESSION["cont_28"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_28" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
    <?php
    if ($cont == 29) {
      $_SESSION["cont_29"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_29" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
    <?php
    if ($cont == 30) {
      $_SESSION["cont_30"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_30" width="10"  size="12" value=0 ></td>
   <?php
     }
	 }
	} 
   ?>
    <?php
	
	   if ($t_cred == 5) { 
	?>  
	  <table width="50%"  border="0" cellspacing="1" cellpadding="1" align="center">
        <tr>
           <th width="22%" scope="col"><border="0" alt="" align="absmiddle" />CODIGO</th>
           <th width="20%" scope="col"><border="0" alt="" align="absmiddle" />NOMBRE COMPLETO</th>
           <th width="25%" scope="col"><border="0" alt="" align="absmiddle" />IMPORTE DESEMBOLSADO</th>
	       
        </tr>
	  
	    <?php
		
	   while ($lin_deu = mysql_fetch_array($res_deu)){
	   
	   	     $nom_com = $lin_deu['CLIENTE_AP_PATERNO'].encadenar(1).$lin_deu['CLIENTE_AP_MATERNO']
			            .encadenar(1).$lin_deu['CLIENTE_NOMBRES'];
			 $c_clie = $lin_deu['CART_DEU_INTERNO'];
			 $impo_d = $lin_deu['CART_DEU_IMPORTE'];
		 ?>	
		   <tr>  
			    <td bgcolor="" ><?php echo $lin_deu['CART_DEU_INTERNO']; ?></td>
				<td bgcolor="" ><?php echo $nom_com; ?></td>
				<td align="right" ><?php echo number_format($impo_d, 2, '.',','); ?></td> 
			</tr> 
			
		<?php	 
				} 
		?> 		
		<?php
		 	
	  if(isset($cont)){
	    $cont = $cont + 1;
	  }
	   
	?> 
	</table>
	
	
				
	<?php	
   if ($cont == 1) {
      $_SESSION["cont_1"] = $cont;
	   }
   		
       }
   ?>




 			 <?php
	/*	              
		*/			
					
		 
				  ?>
<?php if ($_SESSION["detalle"] == 19){
	         
	        /* 
			  */
			 
			  if ($_SESSION['EMPRESA_TIPO'] == 2){
	    if ($mon == 2){
		    $itf = round(calculo_itf($_SESSION['capital']+$_SESSION['intmora']+$_SESSION['interes']),2);
		   $_SESSION['itf'] = $itf;
		    ?>    
		<tr>  
	       <td >ITF</td>
	       <td align="right" ><?php echo number_format($_SESSION['itf'], 2, '.',','); ?></td>
		</tr> 
		 <?php } 
		         }  
			 
		
			  $tot_cal = $_SESSION['capital'] + $_SESSION['interes'] + $_SESSION['intdev']
			          +  $_SESSION['intmora'] + $_SESSION['ahorro'] + $_SESSION['itf'] ;
			
			if(isset($_POST['imp_1'])){
$impor_1 = $_POST["imp_1"];
$_SESSION["imp_1"] = $impor_1;
}else{
$impor_1 = 0;
 }
 
if(isset($_SESSION["cli_1"])){
$clie_1 = $_SESSION["cli_1"];
}else{
$clie_1 = "";
 }
if(isset($_POST["imp_2"])){
$impor_2 = $_POST["imp_2"];
$_SESSION["imp_2"] = $impor_2;
}else{
$impor_2 = 0;
 }

if(isset($_SESSION["cli_2"])){
$clie_2 = $_SESSION["cli_2"];
}else{
$clie_2 = "";
 }
if(isset($_POST["imp_3"])){
$impor_3 = $_POST["imp_3"];
$_SESSION["imp_3"] = $impor_3;
}else{
$impor_3 = 0;
 }

if(isset($_SESSION["cli_3"])){
$clie_3 = $_SESSION["cli_3"];
}else{
$clie_3 = "";
 }
if(isset($_POST["imp_4"])){
$impor_4 = $_POST["imp_4"];
$_SESSION["imp_4"] = $impor_4;
}else{
$impor_4 = 0;
 }

if(isset($_SESSION["cli_4"])){
$clie_4 = $_SESSION["cli_4"];
}else{
$clie_4 = "";
 }
if(isset( $_POST["imp_5"])){
$impor_5 = $_POST["imp_5"];
$_SESSION["imp_5"] = $impor_5;
}else{
$impor_5 = 0;
 }

if(isset( $_SESSION["cli_5"])){
$clie_5 = $_SESSION["cli_5"];
}else{
$clie_5 = "";
 }
if(isset($_POST["imp_6"])){
$impor_6 = $_POST["imp_6"];
$_SESSION["imp_6"] = $impor_6;
}else{
$impor_6 = 0;
 }
 
if(isset($_SESSION["cli_6"])){
$clie_6 = $_SESSION["cli_6"];
}else{
$clie_6 = "";
 }
if(isset($_POST["imp_7"])){
$impor_7 = $_POST["imp_7"];
$_SESSION["imp_7"] = $impor_7;
}else{
$impor_7 = 0;
 }
 
if(isset( $_SESSION["cli_7"])){
$clie_7 = $_SESSION["cli_7"];
}else{
$clie_7 = "";
 }
if(isset($_POST["imp_8"])){
$impor_8 = $_POST["imp_8"];
$_SESSION["imp_8"] = $impor_8;
}else{
$impor_8 = 0;
 }
 
if(isset($_SESSION["cli_8"])){
$clie_8 = $_SESSION["cli_8"];
}else{
$clie_8 = "";
 }
if(isset($_POST["imp_9"])){
$impor_9 = $_POST["imp_9"];
$_SESSION["imp_9"] = $impor_9;
}else{
$impor_9 = 0;
 }

if(isset($_SESSION["cli_9"])){
$clie_9 = $_SESSION["cli_9"];
}else{
$clie_9 = "";
 }
if(isset($_POST["imp_10"])){
$impor_10 = $_POST["imp_10"];
$_SESSION["imp_10"] = $impor_10;
}else{
$impor_10 = 0;
 }

if(isset($_SESSION["cli_10"])){
$clie_10 = $_SESSION["cli_10"];
}else{
$clie_10 = "";
 }
if(isset($_POST["imp_11"])){
$impor_11 = $_POST["imp_11"];
$_SESSION["imp_11"] = $impor_11;
}else{
$impor_11 = 0;
 }
 
if(isset($_SESSION["cli_11"])){
$clie_11 = $_SESSION["cli_11"];
}else{
$clie_11 = "";
 }
if(isset($_POST["imp_12"])){
$impor_12 = $_POST["imp_12"];
$_SESSION["imp_12"] = $impor_12;
}else{
$impor_12 = 0;
 }
 
 
if(isset($_SESSION["cli_12"])){
$clie_12 = $_SESSION["cli_12"];
}else{
$clie_12 = "";
 }
if(isset($_POST["imp_13"])){
$impor_13 = $_POST["imp_13"];
$_SESSION["imp_13"] = $impor_13;
}else{
$impor_13 = 0;
 }

 
if(isset($_SESSION["cli_13"])){
$clie_13 = $_SESSION["cli_13"];
}else{
$clie_13 = "";
 }
if(isset( $_POST["imp_14"])){
$impor_14 = $_POST["imp_14"];
$_SESSION["imp_14"] = $impor_14;
}else{
$impor_14 = 0;
 }

if(isset($_SESSION["cli_14"])){
$clie_14 = $_SESSION["cli_14"];
}else{
$clie_14 = "";
 }
if(isset($_POST["imp_15"])){
$impor_15 = $_POST["imp_15"];
$_SESSION["imp_15"] = $impor_15;
}else{
$impor_15 = 0;
 }

if(isset( $_SESSION["cli_15"])){
$clie_15 = $_SESSION["cli_15"];
}else{
$clie_15 = "";
 }
if(isset($_POST["imp_16"])){
$impor_16 = $_POST["imp_16"];
$_SESSION["imp_16"] = $impor_16;
}else{
$impor_16 = 0;
 }

if(isset($_SESSION["cli_16"])){
$clie_16 = $_SESSION["cli_16"];
}else{
$clie_16 = "";
 }
if(isset( $_POST["imp_17"])){
$impor_17 = $_POST["imp_17"];
$_SESSION["imp_17"] = $impor_17;
}else{
$impor_17 = 0;
 }
 
if(isset($_SESSION["cli_17"])){
$clie_17 = $_SESSION["cli_17"];
}else{
$clie_17 = "";
 }
if(isset($_POST["imp_18"])){
$impor_18 = $_POST["imp_18"];
$_SESSION["imp_18"] = $impor_18;
}else{
$impor_18 = 0;
 }
 
if(isset($_SESSION["cli_18"])){
$clie_18 = $_SESSION["cli_18"];
}else{
$clie_18 = "";
 }
if(isset($_POST["imp_19"])){
$impor_19 = $_POST["imp_19"];
$_SESSION["imp_19"] = $impor_19;
}else{
$impor_19 = 0;
 }
 
if(isset($_SESSION["cli_19"])){
$clie_19 = $_SESSION["cli_19"];
}else{
$clie_19 = "";
 }
if(isset($_POST["imp_20"])){
$impor_20 = $_POST["imp_20"];
$_SESSION["imp_20"] = $impor_20;
}else{
$impor_20 = 0;
 }

if(isset($_SESSION["cli_20"])){
$clie_20 = $_SESSION["cli_20"];
}else{
$clie_20 = "";
 }

$total_i  = round($impor_1+$impor_2+$impor_3+$impor_4 +$impor_5+$impor_6+$impor_7+$impor_8+$impor_9+$impor_10+$impor_11+
          $impor_12+$impor_13+$impor_14+$impor_15+$impor_16+$impor_17+$impor_18+$impor_19+$impor_20,2);
$tot_cal = round($tot_cal,2);		  	
				  
			
				if ($tot_cal == $total_i){
				   $error = 0;
				   }else{
				   echo $tot_cal.encadenar(2).$total_i.encadenar(2).
				   "Verifique no iguala el Monto calculado con el Monto Individual";
				   $error = 1;
				   } 
		   	    
	 ?>     
	 
   
 
    <?php  echo encadenar(8)."DETALLE DE COBRO VALIDADO "; ?>  
    <table width="40%"  border="1" cellspacing="1" cellpadding="1" align="center">
        <tr>
		   <th width="20%" scope="col"><border="0" alt="" align="center" />Concepto</th>
		   <?php if ($mon == 1){ ?>	
           <th width="20%" scope="col"><border="0" alt="" align="center" />Monto Bolivianos</th>
          <?php } ?>
		    <?php if ($mon == 2){ ?>	
           <th width="20%" scope="col"><border="0" alt="" align="center" />Monto Dolares</th>
          <?php } ?>
        </tr>
        <tr>
		   <td >Capital </td>
	       <td align="right" ><?php echo number_format($_SESSION['capital'], 2, '.',','); ?></td> 
		</tr>
		<tr>  
	       <td >Interes Deven.</td>
	       <td align="right" ><?php echo number_format($_SESSION['intdev'], 2, '.',','); ?></td> 
		</tr>
        <tr>  
	       <td >Interes</td>
	       <td align="right" ><?php echo number_format($_SESSION['interes'], 2, '.',','); ?></td> 
		</tr>
		<tr>  
	       <td >Interes Vencido</td>
	       <td align="right" ><?php echo number_format($_SESSION['intmora'], 2, '.',','); ?></td>
		</tr>
        <tr>  
	       <td >Interes Penal</td>
	       <td align="right" ><?php echo number_format($impo_p, 2, '.',','); ?></td>
		</tr>
        
		<tr>  
	       <td >Fondo Garantia</td>
	       <td align="right" ><?php echo number_format($_SESSION['ahorro'], 2, '.',','); ?></td>
		</tr> 
		<?php
	  if ($_SESSION['EMPRESA_TIPO'] == 2){
	    if ($mon == 2){ ?>    
		<tr>  
	       <td >ITF </td>
	       <td align="right" ><?php echo number_format($_SESSION['itf'], 2, '.',','); ?></td>
		</tr> 
		 <?php } 
		         }?>  
		<tr>   
	       <td style="background-color: #6699FF" align="center" >Importe Total</td>
	       <td style="background-color: #6699FF" align="right" >
		              <?php echo number_format($_SESSION['capital']+$_SESSION['interes']+$_SESSION['intdev']+
		              $_SESSION['intmora']+$impo_f+$_SESSION['ahorro']+$_SESSION['itf'], 2, '.',','); ?></td> 
		</tr>
		</table>
		   
    <?php // if ($error == 0){      
   	         echo "Vias de Pago Bien ";
		    ?> 
    <table width="50%"  border="1" cellspacing="1" cellpadding="1" align="center">
	  <?php if ($mon == 1){?> 
	      <tr>
		    <th width="25%" scope="col"><border="0" alt="" align="center" />Descrip.</th>
		    <th width="20%" scope="col"><border="0" alt="" align="center" />Bolivianos</th>
		    <th width="20%" scope="col"><border="0" alt="" align="center" />TC. Compra</th>
		    <th width="20%" scope="col"><border="0" alt="" align="center" />Dolares</th>
		   </tr>
		   <tr>
		   <td align="left" ><?php echo "Efectivo Bs."; ?></td> 
		   <td align="right" ><?php echo number_format($_SESSION['via_bs'], 2, '.',','); ?></td> 
		   <td align="right" ><?php echo encadenar(6); ?></td> 
		   <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td> 
		 </tr>
		 <tr>
		    <td align="left" ><?php echo "Efectivo Dol."; ?></td>
		   <td align="right" ><?php echo number_format($_SESSION['via_us']*$_SESSION['TC_COMPRA'], 2, '.',','); ?></td> 
		   <td align="right" ><?php echo number_format($_SESSION['TC_COMPRA'], 2, '.',','); ?></td> 
		   <td align="right" ><?php echo number_format($_SESSION['via_us'], 2, '.',','); ?></td> 
		 </tr>
		 <tr>
		    <td align="left" ><?php echo "Fondo Garantia"; ?></td>
		   <td align="right" ><?php echo number_format($_SESSION['via_ah'], 2, '.',','); ?></td> 
		   <td align="right" ><?php echo encadenar(6); ?></td> 
		   <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td> 
		 </tr>
	   	<?php } ?>    
	     <?php if ($mon == 2){?> 
	      <tr>
		     <th width="20%" scope="col"><border="0" alt="" align="center" />Descrip.</th>
		    <th width="20%" scope="col"><border="0" alt="" align="center" />Dolares</th>
		    <th width="20%" scope="col"><border="0" alt="" align="center" />TC. Venta</th>
		    <th width="20%" scope="col"><border="0" alt="" align="center" />Bolivianos</th>
		   </tr>
		   <tr>
		    <td align="left" ><?php echo "Efectivo Dol."; ?></td>
		   <td align="right" ><?php echo number_format($_SESSION['via_us'], 2, '.',','); ?></td> 
		   <td align="right" ><?php echo encadenar(6); ?></td> 
		   <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td> 
		 </tr>
		 <tr>
		   <td align="left" ><?php echo "Efectivo Bs."; ?></td>
		   <td align="right" ><?php echo number_format($_SESSION['via_bs'], 2, '.',','); ?></td> 
		   <td align="right" ><?php echo  number_format($_SESSION['TC_VENTA'], 2, '.',','); ?></td> 
		   <td align="right" ><?php echo number_format($_SESSION['via_bs']*$_SESSION['TC_VENTA'], 2, '.',','); ?></td> 
		 </tr>
		  <tr>
		    <td align="left" ><?php echo "Fdo. Garantia"; ?></td>
		   <td align="right" ><?php echo number_format($_SESSION['via_ah'], 2, '.',','); ?></td> 
		   <td align="right" ><?php echo encadenar(6); ?></td> 
		   <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td> 
		 </tr>
	   	<?php } ?> 
	  </table>	
<?php  if ($error == 0){      
   	       echo "Detalle Individual Correcto"; ?>
		<br>   
		<input type="submit" name="accion" value="Imprimir">
	    <!--input type="submit" name="accion" value="Salir"-->
      </table>   
	</form>	   
		   
	 <?php  }else{  ?> 	  
	   <?php if ($_SESSION['cargo'] == 4){ 
		       if (($t_cred == 1)&& ($tope < 1)) {
		       $num_cli = 0;
			   $tot_cta_i = 0;
			   $cta_i = 0;
			    echo "Detalle Individual";
			   ?>
		<br>
			   
		
		
		  <table width="60%"  border="1" cellspacing="1" cellpadding="1" align="center">
		  
		 <tr>
		 <th align="center"><font size="-1">Nro.</th>
	    <th align="center"><font size="-1">CLIENTE</th>
		<th align="center"><font size="-1">TOTAL CUOTA</th>
		<th align="center"><font size="-1">MONTO PAGADO</th>
		
		</tr>
		 
		 
		<?php
		
		 $con_cpla = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sol
		             and CRED_PLD_NRO_CTA = $f_cta
		             and CRED_PLD_USR_BAJA is null ";
         $res_cpla = mysql_query($con_cpla)or die('No pudo leer : cred_plandp' . mysql_error());
		 
		 while ($lin_cpla = mysql_fetch_array($res_cpla)) {
		        $num_cli = $num_cli + 1;
                $cta_nro = $lin_cpla['CRED_PLD_NRO_CTA']; 
		        $cta_fec = $lin_cpla['CRED_PLD_FECHA']; 
				$cta_cap = $lin_cpla['CRED_PLD_CAPITAL'];
		        $cta_int = $lin_cpla['CRED_PLD_INTERES'];
		        $cta_aho = $lin_cpla['CRED_PLD_AHORRO'];
				$cta_cli = $lin_cpla['CRED_PLD_COD_CLI'];
				 if ($p_int == 1) { 
				     $cta_i = $cta_cap+$cta_int+$cta_aho;
				   }
				 if ($p_int == 4) { 
				     $cta_i = $cta_cap+$cta_aho;
				   }  
				 $tot_cta_i = $tot_cta_i + $cta_i;
			$con_pcli  = "Select * From cliente_general
             where CLIENTE_COD = $cta_cli and 
			       CLIENTE_USR_BAJA is null"; 
             $res_pcli = mysql_query($con_pcli)or die('No pudo seleccionarse cliente_general');
 
             while ($lin_pcli = mysql_fetch_array($res_pcli)) {
			 $nom_clip = $lin_pcli['CLIENTE_AP_PATERNO'].encadenar(1).
					$lin_pcli['CLIENTE_AP_MATERNO'].encadenar(1).
					$lin_pcli['CLIENTE_AP_ESPOSO'].encadenar(1).
					$lin_pcli['CLIENTE_NOMBRES'];
			 
			 }
				
		?>		
		<tr>
		<td align="center" ><?php echo number_format($num_cli,0, '.',','); ?></td>
	   	<td align="left" style="font-size:10px" ><?php echo $nom_clip; ?></td>
		<td align="right" ><?php echo number_format($cta_i, 2, '.',','); ?></td>
		<?php if(isset($num_cli)){
		if ($num_cli == 1){
		   $_SESSION["cli_1"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_1" width="10"  
		size="20" value="<?=$_SESSION["imp_1"];?>" ></td>	
		
		 <?php } }?></td>  
		 <?php if(isset($num_cli)){
		if ($num_cli == 2){
		  $_SESSION["cli_2"] = $cta_cli; ?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_2" width="10"  
		size="20" value="<?=$_SESSION["imp_2"];?>" ></td>
		
			 <?php } }?></td>  
		<?php if(isset($num_cli)){
		if ($num_cli == 3){
		    $_SESSION["cli_3"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_3" width="10"  
		size="20" value="<?=$_SESSION["imp_3"];?>" ></td>	
			
			 <?php } }?></td> 	
		<?php if(isset($num_cli)){
		if ($num_cli == 4){
		    $_SESSION["cli_4"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_4" width="10"  
		size="20" value="<?=$_SESSION["imp_4"];?>" ></td>
			
			 <?php } }?></td> 
		<?php if(isset($num_cli)){
		if ($num_cli == 5){
		    $_SESSION["cli_5"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_5" width="10"  
		size="20" value="<?=$_SESSION["imp_5"];?>" ></td>
		
			 <?php } }?></td> 	
		<?php if(isset($num_cli)){
		if ($num_cli == 6){
		   $_SESSION["cli_6"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_6" width="10"  
		size="20" value="<?=$_SESSION["imp_6"];?>" ></td>
			
			 <?php } }?></td> 	 	  	 	 	  
		<?php if(isset($num_cli)){
		if ($num_cli == 7){
		   $_SESSION["cli_7"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_7" width="10"  
		size="20" value="<?=$_SESSION["imp_7"];?>" ></td>	
		
			 <?php } }?></td> 
		<?php if(isset($num_cli)){
		if ($num_cli == 8){
		   $_SESSION["cli_8"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_8" width="10"  
		size="20" value="<?=$_SESSION["imp_8"];?>" ></td>
			
			 <?php } }?></td> 		 	 	 
		<?php if(isset($num_cli)){
		if ($num_cli == 9){
		   $_SESSION["cli_9"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_9" width="10"  
		size="20" value="<?=$_SESSION["imp_9"];?>" ></td>	
			
			 <?php } }?></td> 
		<?php if(isset($num_cli)){
		if ($num_cli == 10){
		   $_SESSION["cli_10"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_10" width="10"  
		size="20" value="<?=$_SESSION["imp_10"];?>" ></td>
			
			 <?php } }?></td> 	
		<?php if(isset($num_cli)){
		if ($num_cli == 11){
		   $_SESSION["cli_11"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_11" width="10"  
		size="20" value="<?=$_SESSION["imp_11"];?>" ></td>	
		
			 <?php } }?></td> 	 	 		 
		<?php if(isset($num_cli)){
		if ($num_cli == 12){
		    $_SESSION["cli_12"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_12" width="10"  
		size="20" value="<?=$_SESSION["imp_12"];?>" ></td>	
			
			 <?php } }?></td> 	 
		<?php if(isset($num_cli)){
		if ($num_cli == 13){
		   $_SESSION["cli_13"] = $cta_cli; ?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_13" width="10"  
		size="20" value="<?=$_SESSION["imp_13"];?>" ></td>	
		
			 <?php } }?></td> 	 
		<?php if(isset($num_cli)){
		if ($num_cli == 14){
		   $_SESSION["cli_14"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_14" width="10"  
		size="20" value="<?=$_SESSION["imp_14"];?>" ></td>	
		
			 <?php } }?></td> 	 
		<?php if(isset($num_cli)){
		if ($num_cli == 15){
		   $_SESSION["cli_15"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_15" width="10"  
		size="20" value="<?=$_SESSION["imp_15"];?>" ></td>
			
			 <?php } }?></td> 	 
		<?php if(isset($num_cli)){
		if ($num_cli == 16){
		    $_SESSION["cli_16"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_16" width="10"  
		size="20" value="<?=$_SESSION["imp_16"];?>" ></td>	
		
			 <?php } }?></td> 	 
		<?php if(isset($num_cli)){
		if ($num_cli == 17){
		   $_SESSION["cli_17"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_17" width="10"  
		size="20" value="<?=$_SESSION["imp_17"];?>" ></td>	
			
			 <?php } }?></td> 	 
		<?php if(isset($num_cli)){
		if ($num_cli == 18){
		    $_SESSION["cli_18"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_18" width="10"  
		size="20" value="<?=$_SESSION["imp_18"];?>" ></td>	
			
			 <?php } }?></td> 	 
		<?php if(isset($num_cli)){
		if ($num_cli == 19){
		   $_SESSION["cli_19"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_19" width="10"  
		size="20" value="<?=$_SESSION["imp_19"];?>" ></td>
		
			 <?php } }?></td> 	 
		<?php if(isset($num_cli)){
		if ($num_cli == 20){?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_20" width="10"  
		size="20" value="<?=$_SESSION["imp_20"];?>" ></td>
		
			 <?php } }?></td> 	 
				
				
	<?php }	?>
	<tr>
		<td align="center" ><?php echo encadenar(2); ?></td>
	   	<th align="left" ><?php echo "Total"; ?></td>
		<th align="right" ><?php echo number_format($tot_cta_i, 2, '.',','); ?></td>
	 	<td align="right" ><?php echo encadenar(2); ?></td>	
		
	</tr>		
	
	
	
		</table>
		<input type="submit" name="accion" value="Valida_Ind">
	    <!--input type="submit" name="accion" value="Salir"-->
      

         
	<br><br>	  
<?php    }else{?>
	  
	  
	  
	  	
		<input type="submit" name="accion" value="Imprimir">
	    <!--input type="submit" name="accion" value="Salir"-->
      

 <?php }  } }?> 
 </form>	 
	
		
		
      
	
		<?php //}  //7 b?>	
	<?php  } //7 b?>
	<?php if ($_SESSION["detalle"] == 29){
	         
	        /* 
			  */
			 
			  if ($_SESSION['EMPRESA_TIPO'] == 2){
	    if ($mon == 2){
		    $itf = round(calculo_itf($_SESSION['capital']+$_SESSION['intmora']+$_SESSION['interes']),2);
		   $_SESSION['itf'] = $itf;
		    ?>    
		<tr>  
	       <td >ITF</td>
	       <td align="right" ><?php echo number_format($_SESSION['itf'], 2, '.',','); ?></td>
		</tr> 
		 <?php } 
		         }  
			 
		
			  $tot_cal = $_SESSION['capital'] + $_SESSION['interes'] + $_SESSION['intdev']
			          +  $_SESSION['intmora'] + $_SESSION['ahorro'] + $_SESSION['itf'] ;
			
			if(isset($_POST['imp_1'])){
$impor_1 = $_POST["imp_1"];
$_SESSION["imp_1"] = $impor_1;
}else{
$impor_1 = 0;
 }
 
if(isset($_SESSION["cli_1"])){
$clie_1 = $_SESSION["cli_1"];
}else{
$clie_1 = "";
 }
if(isset($_POST["imp_2"])){
$impor_2 = $_POST["imp_2"];
$_SESSION["imp_2"] = $impor_2;
}else{
$impor_2 = 0;
 }

if(isset($_SESSION["cli_2"])){
$clie_2 = $_SESSION["cli_2"];
}else{
$clie_2 = "";
 }
if(isset($_POST["imp_3"])){
$impor_3 = $_POST["imp_3"];
$_SESSION["imp_3"] = $impor_3;
}else{
$impor_3 = 0;
 }

if(isset($_SESSION["cli_3"])){
$clie_3 = $_SESSION["cli_3"];
}else{
$clie_3 = "";
 }
if(isset($_POST["imp_4"])){
$impor_4 = $_POST["imp_4"];
$_SESSION["imp_4"] = $impor_4;
}else{
$impor_4 = 0;
 }

if(isset($_SESSION["cli_4"])){
$clie_4 = $_SESSION["cli_4"];
}else{
$clie_4 = "";
 }
if(isset($_POST["imp_5"])){
$impor_5 = $_POST["imp_5"];
$_SESSION["imp_5"] = $impor_5;
}else{
$impor_5 = 0;
 }

if(isset( $_SESSION["cli_5"])){
$clie_5 = $_SESSION["cli_5"];
}else{
$clie_5 = "";
 }
if(isset($_POST["imp_6"])){
$impor_6 = $_POST["imp_6"];
$_SESSION["imp_6"] = $impor_6;
}else{
$impor_6 = 0;
 }
 
if(isset($_SESSION["cli_6"])){
$clie_6 = $_SESSION["cli_6"];
}else{
$clie_6 = "";
 }
if(isset($_POST["imp_7"])){
$impor_7 = $_POST["imp_7"];
$_SESSION["imp_7"] = $impor_7;
}else{
$impor_7 = 0;
 }
 
if(isset( $_SESSION["cli_7"])){
$clie_7 = $_SESSION["cli_7"];
}else{
$clie_7 = "";
 }
if(isset($_POST["imp_8"])){
$impor_8 = $_POST["imp_8"];
$_SESSION["imp_8"] = $impor_8;
}else{
$impor_8 = 0;
 }
 
if(isset($_SESSION["cli_8"])){
$clie_8 = $_SESSION["cli_8"];
}else{
$clie_8 = "";
 }
if(isset($_POST["imp_9"])){
$impor_9 = $_POST["imp_9"];
$_SESSION["imp_9"] = $impor_9;
}else{
$impor_9 = 0;
 }

if(isset($_SESSION["cli_9"])){
$clie_9 = $_SESSION["cli_9"];
}else{
$clie_9 = "";
 }
if(isset($_POST["imp_10"])){
$impor_10 = $_POST["imp_10"];
$_SESSION["imp_10"] = $impor_10;
}else{
$impor_10 = 0;
 }

if(isset($_SESSION["cli_10"])){
$clie_10 = $_SESSION["cli_10"];
}else{
$clie_10 = "";
 }
if(isset($_POST["imp_11"])){
$impor_11 = $_POST["imp_11"];
$_SESSION["imp_11"] = $impor_11;
}else{
$impor_11 = 0;
 }
 
if(isset($_SESSION["cli_11"])){
$clie_11 = $_SESSION["cli_11"];
}else{
$clie_11 = "";
 }
if(isset($_POST["imp_12"])){
$impor_12 = $_POST["imp_12"];
$_SESSION["imp_12"] = $impor_12;
}else{
$impor_12 = 0;
 }
 
 
if(isset($_SESSION["cli_12"])){
$clie_12 = $_SESSION["cli_12"];
}else{
$clie_12 = "";
 }
if(isset($_POST["imp_13"])){
$impor_13 = $_POST["imp_13"];
$_SESSION["imp_13"] = $impor_13;
}else{
$impor_13 = 0;
 }

 
if(isset($_SESSION["cli_13"])){
$clie_13 = $_SESSION["cli_13"];
}else{
$clie_13 = "";
 }
if(isset($_POST["imp_14"])){
$impor_14 = $_POST["imp_14"];
$_SESSION["imp_14"] = $impor_14;
}else{
$impor_14 = 0;
 }

if(isset($_SESSION["cli_14"])){
$clie_14 = $_SESSION["cli_14"];
}else{
$clie_14 = "";
 }
if(isset($_POST["imp_15"])){
$impor_15 = $_POST["imp_15"];
$_SESSION["imp_15"] = $impor_15;
}else{
$impor_15 = 0;
 }

if(isset($_SESSION["cli_15"])){
$clie_15 = $_SESSION["cli_15"];
}else{
$clie_15 = "";
 }
if(isset($_POST["imp_16"])){
$impor_16 = $_POST["imp_16"];
$_SESSION["imp_16"] = $impor_16;
}else{
$impor_16 = 0;
 }

if(isset($_SESSION["cli_16"])){
$clie_16 = $_SESSION["cli_16"];
}else{
$clie_16 = "";
 }
if(isset($_POST["imp_17"])){
$impor_17 = $_POST["imp_17"];
$_SESSION["imp_17"] = $impor_17;
}else{
$impor_17 = 0;
 }
 
if(isset($_SESSION["cli_17"])){
$clie_17 = $_SESSION["cli_17"];
}else{
$clie_17 = "";
 }
if(isset($_POST["imp_18"])){
$impor_18 = $_POST["imp_18"];
$_SESSION["imp_18"] = $impor_18;
}else{
$impor_18 = 0;
 }
 
if(isset($_SESSION["cli_18"])){
$clie_18 = $_SESSION["cli_18"];
}else{
$clie_18 = "";
 }
if(isset($_POST["imp_19"])){
$impor_19 = $_POST["imp_19"];
$_SESSION["imp_19"] = $impor_19;
}else{
$impor_19 = 0;
 }
 
if(isset($_SESSION["cli_19"])){
$clie_19 = $_SESSION["cli_19"];
}else{
$clie_19 = "";
 }
if(isset($_POST["imp_20"])){
$impor_20 = $_POST["imp_20"];
$_SESSION["imp_20"] = $impor_20;
}else{
$impor_20 = 0;
 }

if(isset($_SESSION["cli_20"])){
$clie_20 = $_SESSION["cli_20"];
}else{
$clie_20 = "";
 }

$total_i  = round($impor_1+$impor_2+$impor_3+$impor_4 +$impor_5+$impor_6+$impor_7+$impor_8+$impor_9+$impor_10+$impor_11+
          $impor_12+$impor_13+$impor_14+$impor_15+$impor_16+$impor_17+$impor_18+$impor_19+$impor_20,2);
		  
		$monto_t = $_SESSION['monto_tot'];  
		  
	 if ($_SESSION['COBRO_TIPO'] == 1){	
		     $_SESSION['ahorro'] = 0; 
		  if ($_SESSION['interes'] > 0){
		     if ($monto_t > $_SESSION['interes']){
		        $monto_t = $monto_t - $_SESSION['interes'];
			   }else{
			    $_SESSION['interes'] = $monto_t;
			    $monto_t = 0;
			    $_SESSION['capital'] = 0;
			  }
		   }
		    if ($_SESSION['penal'] > 0){
		         if ($monto_t >= $_SESSION['penal']){
				// echo "penal".$monto_t ."---".$_SESSION['penal'];
				 
		             $monto_t = $monto_t - $_SESSION['penal'];
				     }else{
			         $_SESSION['penal'] = $monto_t;
			         $monto_t = 0;
			         $_SESSION['capital'] = 0;
			     }
		      }
		   if ($_SESSION['intmora'] > 0){
		     if ($monto_t > $_SESSION['intmora']){
		        $monto_t = $monto_t - $_SESSION['intmora'];
			   }else{
			    $_SESSION['intmora'] = $monto_t;
			    $monto_t = 0;
			    $_SESSION['capital'] = 0;
			  }
		   }
		 //Total pagado > Saldo  
		  if (($monto_t > $_SESSION['saldo'])&&($_SESSION['cta_fdo'] == 0)){
			       //echo "Error Capital mayor a Saldo del credito";
				   $_SESSION['calculo'] = 2;
		           $_SESSION['detalle'] = 2;
		 		   $_SESSION['continuar'] = 2;
		   		   header('Location: cobro_detalle_2.php');
		  }
			 
		   if ($_SESSION['capital'] > 0){
		       if ($monto_t >= $_SESSION['saldo']){
			      if ($monto_t > $_SESSION['capital']){ 
	                 $monto_t = $monto_t - $_SESSION['capital']; 
			         $_SESSION['ahorro'] = $_SESSION['ahorro'] + $monto_t;
				     }else{
				     $_SESSION['capital'] =  $monto_t;
					 $monto_t = 0;
				   }  
			   }else{
			      if ($monto_t > $_SESSION['capital']){ 
				    //  echo "aquiiii  2";
					 // $_SESSION['capital'] =  $monto_t; 
			         // $monto_t = 0; 
			          //}else{
					   if ($_SESSION['cta_fdo'] <> 0) {
					       $monto_t = $monto_t - $_SESSION['capital']; 
			               $_SESSION['ahorro'] = $_SESSION['ahorro'] + $monto_t;
						   $monto_t = 0;
                           }else{
						   $_SESSION['capital'] =  $monto_t;
					       $monto_t = 0;
						//   }
						// }  
					  }
			      }else{
				  $_SESSION['capital'] =  $monto_t;
				     $monto_t = 0;
					//echo  $_SESSION['saldo']."saldo",$_SESSION['capital'],"capital",$monto_t;
					}	   
			  }  
			}
			//echo  $_SESSION['saldo']."saldo",$_SESSION['capital'],"capital",$monto_t;
			}
		// Cobro con Fondo		
			 if ($_SESSION['COBRO_TIPO'] == 2){
			    if ($_SESSION['ahorro'] > 0){
			       if ($monto_t < $_SESSION['ahorro']){
				      // echo $_SESSION['ahorro'],$monto_t,"???";
					   $_SESSION['ahorro'] = $monto_t;
			           $monto_t = 0;
				   	  }
				    if ($_SESSION['ahorro'] >= $monto_t){
				        $monto_t = 0;
				      }
				    if ($monto_t > $_SESSION['ahorro']){
				       $monto_t = $monto_t - $_SESSION['ahorro'];
					 }
			    }
				 if ($_SESSION['penal'] > 0){
		         if ($monto_t >= $_SESSION['penal']){
				// echo "penal".$monto_t ."---".$_SESSION['penal'];
				 
		             $monto_t = $monto_t - $_SESSION['penal'];
				     }else{
			         $_SESSION['penal'] = $monto_t;
			         $monto_t = 0;
			         $_SESSION['capital'] = 0;
			     }
		      }
			 if ($_SESSION['intmora'] > 0){
		        if ($monto_t > $_SESSION['intmora']){
		           $monto_t = $monto_t - $_SESSION['intmora'];
			       }else{
			       $_SESSION['intmora'] = $monto_t;
			       $monto_t = 0;
			       $_SESSION['capital'] = 0;
			     }
		      }
			  if ($_SESSION['interes'] > 0){
		         if ($monto_t >= $_SESSION['interes']){
		             $monto_t = $monto_t - $_SESSION['interes'];
				     }else{
			         $_SESSION['interes'] = $monto_t;
			         $monto_t = 0;
			         $_SESSION['capital'] = 0;
			     }
		      }
		 // echo  $_SESSION['saldo']."saldo",$_SESSION['capital'],"capital",$monto_t;
		   if ($_SESSION['capital'] > 0){
		       if ($monto_t >= $_SESSION['saldo']){
			      if ($monto_t > $_SESSION['capital']){ 
				     $monto_t = $monto_t - $_SESSION['capital']; 
			         $_SESSION['ahorro'] = $_SESSION['ahorro'] + $monto_t;
				     }else{
				     $_SESSION['capital'] =  $monto_t;
					 $monto_t = 0;
				   }  
			   }else{
			      if ($monto_t > $_SESSION['capital']){ 
				    //  echo "aquiiii  2";
			          $monto_t = $monto_t - $_SESSION['capital']; 
			          $_SESSION['ahorro'] = $_SESSION['ahorro'] + $monto_t;
				     }else{
				      $_SESSION['capital'] =  $monto_t;
					  $monto_t = 0;
			      }	
			  }  
			}
          }
		
		
		
		
$_SESSION['monto_tot'] = round($_SESSION['monto_tot'],2);		
		
		  	
				  
			
				if ($_SESSION['monto_tot'] == $total_i){
				   $error = 0;
				   }else{
				   echo $_SESSION['monto_tot'].encadenar(2).$total_i.encadenar(2).
				   "Verifique no iguala el Monto pagado con el Monto Individual";
				   $error = 1;
				   } 
		   	    
	 ?>     
	 
   <?php
 
   echo encadenar(10)."DETALLE DE COBRO ";
	  ?>  
	  <table width="50%"  border="1" cellspacing="1" cellpadding="1" align="center">
	  <?php if ($mon == 1){
	            $monto_tot = $_SESSION['mon_bs']+ $_SESSION['mon_us']*$_SESSION['TC_COMPRA']+$_SESSION['mon_fg']; ?> 
	      <tr>
		    <th width="25%" scope="col"><border="0" alt="" align="center" />Descrip.</th>
		    <th width="20%" scope="col"><border="0" alt="" align="center" />Bolivianos</th>
		    <th width="20%" scope="col"><border="0" alt="" align="center" />TC. Compra</th>
		    <th width="20%" scope="col"><border="0" alt="" align="center" />Dolares</th>
		   </tr>
		   <tr>
		   <td align="right" ><?php echo "Efectivo Bs."; ?></td> 
		   <td align="right" ><?php echo number_format($_SESSION['mon_bs'], 2, '.',','); ?></td> 
		   <td align="right" ><?php echo encadenar(6); ?></td> 
		   <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td> 
		 </tr>
		 <tr>
		    <td align="right" ><?php echo "Efectivo Dol."; ?></td>
		   <td align="right" ><?php echo number_format($_SESSION['mon_us']*$_SESSION['TC_COMPRA'], 2, '.',','); ?></td> 
		   <td align="right" ><?php echo number_format($_SESSION['TC_COMPRA'], 2, '.',','); ?></td> 
		   <td align="right" ><?php echo number_format($_SESSION['mon_us'], 2, '.',','); ?></td> 
		 </tr>
		 <tr>
		    <td align="right" ><?php echo "Fondo Garantia"; ?></td>
		   <td align="right" ><?php echo number_format($_SESSION['mon_fg'], 2, '.',','); ?></td> 
		   <td align="right" ><?php echo encadenar(6); ?></td> 
		   <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td> 
		 </tr>
	   	<?php } ?>    
	     <?php if ($mon == 2){
		      $monto_tot = $_SESSION['mon_us']+ $_SESSION['mon_bs']+$_SESSION['mon_fg']?> 
	      <tr>
		     <th width="20%" scope="col"><border="0" alt="" align="center" />Descrip.</th>
		    <th width="20%" scope="col"><border="0" alt="" align="center" />Dolares</th>
		    <th width="20%" scope="col"><border="0" alt="" align="center" />TC. Venta</th>
		    <th width="20%" scope="col"><border="0" alt="" align="center" />Bolivianos</th>
		   </tr>
		   <tr>
		    <td align="right" ><?php echo "Efectivo Dol."; ?></td>
		   <td align="right" ><?php echo number_format($_SESSION['mon_us'], 2, '.',','); ?></td> 
		   <td align="right" ><?php echo encadenar(6); ?></td> 
		   <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td> 
		 </tr>
		 <tr>
		   <td align="right" ><?php echo "Efectivo Bs."; ?></td>
		   <td align="right" ><?php echo number_format($_SESSION['mon_bs'], 2, '.',','); ?></td> 
		   <td align="right" ><?php echo  number_format($_SESSION['TC_VENTA'], 2, '.',','); ?></td> 
		   <td align="right" ><?php echo number_format($_SESSION['mon_bs']*$_SESSION['TC_VENTA'], 2, '.',','); ?></td> 
		 </tr>
		  <tr>
		    <td align="right" ><?php echo "Fdo. Garantia"; ?></td>
		   <td align="right" ><?php echo number_format($_SESSION['mon_fg'], 2, '.',','); ?></td> 
		   <td align="right" ><?php echo encadenar(6); ?></td> 
		   <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td> 
		 </tr>
	   	<?php } ?> 
	  </table>	   
	  <font color="#0033CC">
	  Monto Total en la moneda del Cr&eacute;dito 
	        <?php echo encadenar(2).number_format($monto_tot, 2, '.',',');
			      $_SESSION['monto_tot'] = $monto_tot;  ?> 
  
  </font>
	<br>
	 <?php
	  if ($_SESSION['EMPRESA_TIPO'] == 2){
	    if ($mon == 2){ 
		    if (($_SESSION['capital'] + $_SESSION['interes'] + $_SESSION['intmora']) > 0){
			    $_SESSION['itf'] = calculo_itf($_SESSION['capital'] + $_SESSION['interes'] + $_SESSION['intmora']);
			//	
				}else{
				$_SESSION['itf'] = 0;
				} 
		   ?>    
		
		 <?php } 
		         }?>  
    <table width="40%"  border="1" cellspacing="1" cellpadding="1" align="center">
        <tr>
		   <th width="20%" scope="col"><border="0" alt="" align="center" />Concepto</th>
		   <?php if ($mon == 1){ ?>	
           <th width="20%" scope="col"><border="0" alt="" align="center" />Monto Bolivianos</th>
          <?php } ?>
		    <?php if ($mon == 2){ ?>	
           <th width="20%" scope="col"><border="0" alt="" align="center" />Monto Dolares</th>
          <?php } ?>
        </tr>
        <tr>
		   <td >Capital </td>
	       <td align="right" ><?php echo number_format($_SESSION['capital'], 2, '.',','); ?></td> 
		</tr>
		 <tr>  
	       <td >Interes Deven.</td>
	       <td align="right" ><?php echo number_format($_SESSION['intdev'], 2, '.',','); ?></td> 
		</tr>
        <tr>  
	       <td >Interes</td>
	       <td align="right" ><?php echo number_format($_SESSION['interes'], 2, '.',','); ?></td> 
		</tr>
		 <tr>  
	       <td >Interes Vencido</td>
	       <td align="right" ><?php echo number_format($_SESSION['intmora'], 2, '.',','); ?></td>
		</tr>
        <tr>  
	       <td >Interes Penal</td>
	       <td align="right" ><?php echo number_format($impo_p, 2, '.',','); ?></td>
		</tr>
       
		<tr>  
	       <td >Fondo Garantia</td>
	       <td align="right" ><?php echo number_format($_SESSION['ahorro'], 2, '.',','); ?></td>
		</tr>  
		 <?php
	  if ($_SESSION['EMPRESA_TIPO'] == 2){
	    if ($mon == 2){ 
		
		   ?>    
		<tr>  
	       <td >ITF 2</td>
	       <td align="right" ><?php echo number_format($_SESSION['itf'], 2, '.',','); ?></td>
		</tr> 
		 <?php } 
		         }?>  
		<tr>  
	       <td style="background-color: #6699FF" align="center" >Importe Total</td>
	       <td style="background-color: #6699FF" align="right" >
		       <?php echo number_format($_SESSION['capital']+$_SESSION['interes']+$_SESSION['intmora']
			         +$_SESSION['intdev']+$impo_f+$_SESSION['ahorro']+$_SESSION['itf'], 2, '.',','); ?></td> 
		</tr>
		</table>
		   
    	
<?php  if ($error == 0){      
   	       echo "Detalle Individual Correcto"; ?>
		<br>   
		<input type="submit" name="accion" value="Imprimir">
	    <!--input type="submit" name="accion" value="Salir"-->
      </table>   
	</form>	   
		   
	 <?php  }else{  ?> 	  
	   <?php if ($_SESSION['cargo'] == 4){ 
		       if (($t_cred == 1)&& ($tope < 1)) {
		       $num_cli = 0;
			   $tot_cta_i = 0;
			   $cta_i = 0;
			    echo "Detalle Individual";
			   ?>
		<br>
			   
		
		
		  <table width="60%"  border="1" cellspacing="1" cellpadding="1" align="center">
		  
		 <tr>
		 <th align="center"><font size="-1">Nro.</th>
	    <th align="center"><font size="-1">CLIENTE</th>
		<th align="center"><font size="-1">TOTAL CUOTA</th>
		<th align="center"><font size="-1">MONTO PAGADO</th>
		
		</tr>
		 
		 
		<?php
		
		 $con_cpla = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sol
		             and CRED_PLD_NRO_CTA = $f_cta
		             and CRED_PLD_USR_BAJA is null ";
         $res_cpla = mysql_query($con_cpla)or die('No pudo leer : cred_plandp' . mysql_error());
		 
		 while ($lin_cpla = mysql_fetch_array($res_cpla)) {
		        $num_cli = $num_cli + 1;
                $cta_nro = $lin_cpla['CRED_PLD_NRO_CTA']; 
		        $cta_fec = $lin_cpla['CRED_PLD_FECHA']; 
				$cta_cap = $lin_cpla['CRED_PLD_CAPITAL'];
		        $cta_int = $lin_cpla['CRED_PLD_INTERES'];
		        $cta_aho = $lin_cpla['CRED_PLD_AHORRO'];
				$cta_cli = $lin_cpla['CRED_PLD_COD_CLI'];
				 if ($p_int == 1) { 
				     $cta_i = $cta_cap+$cta_int+$cta_aho;
				   }
				 if ($p_int == 4) { 
				     $cta_i = $cta_cap+$cta_aho;
				   }  
				 $tot_cta_i = $tot_cta_i + $cta_i;
			$con_pcli  = "Select * From cliente_general
             where CLIENTE_COD = $cta_cli and 
			       CLIENTE_USR_BAJA is null"; 
             $res_pcli = mysql_query($con_pcli)or die('No pudo seleccionarse cliente_general');
 
             while ($lin_pcli = mysql_fetch_array($res_pcli)) {
			 $nom_clip = $lin_pcli['CLIENTE_AP_PATERNO'].encadenar(1).
					$lin_pcli['CLIENTE_AP_MATERNO'].encadenar(1).
					$lin_pcli['CLIENTE_AP_ESPOSO'].encadenar(1).
					$lin_pcli['CLIENTE_NOMBRES'];
			 
			 }
				
		?>		
		<tr>
		<td align="center" ><?php echo number_format($num_cli,0, '.',','); ?></td>
	   	<td align="left" style="font-size:10px" ><?php echo $nom_clip; ?></td>
		<td align="right" ><?php echo number_format($cta_i, 2, '.',','); ?></td>
		<?php if(isset($num_cli)){
		if ($num_cli == 1){
		   $_SESSION["cli_1"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_1" width="10"  
		size="20" value="<?=$_SESSION["imp_1"];?>" ></td>	
		
		 <?php } }?></td>  
		 <?php if(isset($num_cli)){
		if ($num_cli == 2){
		  $_SESSION["cli_2"] = $cta_cli; ?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_2" width="10"  
		size="20" value="<?=$_SESSION["imp_2"];?>" ></td>
		
			 <?php } }?></td>  
		<?php if(isset($num_cli)){
		if ($num_cli == 3){
		    $_SESSION["cli_3"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_3" width="10"  
		size="20" value="<?=$_SESSION["imp_3"];?>" ></td>	
			
			 <?php } }?></td> 	
		<?php if(isset($num_cli)){
		if ($num_cli == 4){
		    $_SESSION["cli_4"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_4" width="10"  
		size="20" value="<?=$_SESSION["imp_4"];?>" ></td>
			
			 <?php } }?></td> 
		<?php if(isset($num_cli)){
		if ($num_cli == 5){
		    $_SESSION["cli_5"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_5" width="10"  
		size="20" value="<?=$_SESSION["imp_5"];?>" ></td>
		
			 <?php } }?></td> 	
		<?php if(isset($num_cli)){
		if ($num_cli == 6){
		   $_SESSION["cli_6"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_6" width="10"  
		size="20" value="<?=$_SESSION["imp_6"];?>" ></td>
			
			 <?php } }?></td> 	 	  	 	 	  
		<?php if(isset($num_cli)){
		if ($num_cli == 7){
		   $_SESSION["cli_7"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_7" width="10"  
		size="20" value="<?=$_SESSION["imp_7"];?>" ></td>	
		
			 <?php } }?></td> 
		<?php if(isset($num_cli)){
		if ($num_cli == 8){
		   $_SESSION["cli_8"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_8" width="10"  
		size="20" value="<?=$_SESSION["imp_8"];?>" ></td>
			
			 <?php } }?></td> 		 	 	 
		<?php if(isset($num_cli)){
		if ($num_cli == 9){
		   $_SESSION["cli_9"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_9" width="10"  
		size="20" value="<?=$_SESSION["imp_9"];?>" ></td>	
			
			 <?php } }?></td> 
		<?php if(isset($num_cli)){
		if ($num_cli == 10){
		   $_SESSION["cli_10"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_10" width="10"  
		size="20" value="<?=$_SESSION["imp_10"];?>" ></td>
			
			 <?php } }?></td> 	
		<?php if(isset($num_cli)){
		if ($num_cli == 11){
		   $_SESSION["cli_11"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_11" width="10"  
		size="20" value="<?=$_SESSION["imp_11"];?>" ></td>	
		
			 <?php } }?></td> 	 	 		 
		<?php if(isset($num_cli)){
		if ($num_cli == 12){
		    $_SESSION["cli_12"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_12" width="10"  
		size="20" value="<?=$_SESSION["imp_12"];?>" ></td>	
			
			 <?php } }?></td> 	 
		<?php if(isset($num_cli)){
		if ($num_cli == 13){
		   $_SESSION["cli_13"] = $cta_cli; ?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_13" width="10"  
		size="20" value="<?=$_SESSION["imp_13"];?>" ></td>	
		
			 <?php } }?></td> 	 
		<?php if(isset($num_cli)){
		if ($num_cli == 14){
		   $_SESSION["cli_14"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_14" width="10"  
		size="20" value="<?=$_SESSION["imp_14"];?>" ></td>	
		
			 <?php } }?></td> 	 
		<?php if(isset($num_cli)){
		if ($num_cli == 15){
		   $_SESSION["cli_15"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_15" width="10"  
		size="20" value="<?=$_SESSION["imp_15"];?>" ></td>
			
			 <?php } }?></td> 	 
		<?php if(isset($num_cli)){
		if ($num_cli == 16){
		    $_SESSION["cli_16"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_16" width="10"  
		size="20" value="<?=$_SESSION["imp_16"];?>" ></td>	
		
			 <?php } }?></td> 	 
		<?php if(isset($num_cli)){
		if ($num_cli == 17){
		   $_SESSION["cli_17"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_17" width="10"  
		size="20" value="<?=$_SESSION["imp_17"];?>" ></td>	
			
			 <?php } }?></td> 	 
		<?php if(isset($num_cli)){
		if ($num_cli == 18){
		    $_SESSION["cli_18"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_18" width="10"  
		size="20" value="<?=$_SESSION["imp_18"];?>" ></td>	
			
			 <?php } }?></td> 	 
		<?php if(isset($num_cli)){
		if ($num_cli == 19){
		   $_SESSION["cli_19"] = $cta_cli;?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_19" width="10"  
		size="20" value="<?=$_SESSION["imp_19"];?>" ></td>
		
			 <?php } }?></td> 	 
		<?php if(isset($num_cli)){
		if ($num_cli == 20){?>
	 	<td align="right" ><input type="text"  style align="center" name="imp_20" width="10"  
		size="20" value="<?=$_SESSION["imp_20"];?>" ></td>
		
			 <?php } }?></td> 	 
				
				
	<?php }	?>
	<tr>
		<td align="center" ><?php echo encadenar(2); ?></td>
	   	<th align="left" ><?php echo "Total"; ?></td>
		<th align="right" ><?php echo number_format($tot_cta_i, 2, '.',','); ?></td>
	 	<td align="right" ><?php echo encadenar(2); ?></td>	
		
	</tr>		
	
	
	
		</table>
		<input type="submit" name="accion" value="Valida_Ind_2">
	    <!--input type="submit" name="accion" value="Salir"-->
      

         
	<br><br>	  
<?php    }else{?>
	  
	  
	  
	  	
		<input type="submit" name="accion" value="Imprimir">
	    <!--input type="submit" name="accion" value="Salir"-->
      

 <?php }  } }?> 
 </form>	 
 <?php }  ?> 	
		
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