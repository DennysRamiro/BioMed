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
<?php
/***VARIABLES POR POST ***/
$numero2 = count($_POST);
$total = 0;
if(isset( $_POST['tot_bol'])){
   $f_cal = $_SESSION['fec_cal'];
   $f_cob = cambiaf_a_mysql_2($f_cal);
   }
//echo $numero2;
foreach($_POST as $nombre_campo => $valor){
   if(isset($_SESSION["cont_1"])){
      $nro =$_SESSION["cont_1"];
	  if(isset($_POST["imp_1"])){
         $monto = $_POST["imp_1"];
		 $act_cob  = "Update temp_cobro set TEMP_COB_IMPO_C = $monto where 
	               TEMP_COB_NRO = $nro "; 
         $res_cob = mysql_query($act_cob)or die('No pudo actualizar cart_cobro'); 
		 }else{
		 $monto = 0;
		}	 
    }
	 if(isset($_SESSION["cont_2"])){
      $nro =$_SESSION["cont_2"];
	  if(isset($_POST["imp_2"])){
         $monto = $_POST["imp_2"];
		$act_cob  = "Update temp_cobro set TEMP_COB_IMPO_C = $monto where 
	               TEMP_COB_NRO = $nro "; 
         $res_cob = mysql_query($act_cob)or die('No pudo actualizar cart_cobro'); 
		  }else{
		 $monto = 0;
	  }	 
    }
	 if(isset($_SESSION["cont_3"])){
      $nro =$_SESSION["cont_3"];
	  if(isset($_POST["imp_3"])){
         $monto = $_POST["imp_3"];
		 $act_cob  = "Update temp_cobro set TEMP_COB_IMPO_C = $monto where 
	               TEMP_COB_NRO = $nro "; 
         $res_cob = mysql_query($act_cob)or die('No pudo actualizar cart_cobro'); 
		  }else{
		 $monto = 0;
	  }	 
    }
	 if(isset($_SESSION["cont_4"])){
      $nro =$_SESSION["cont_4"];
	  if(isset($_POST["imp_4"])){
         $monto = $_POST["imp_4"];
		 $act_cob  = "Update temp_cobro set TEMP_COB_IMPO_C = $monto where 
	               TEMP_COB_NRO = $nro "; 
         $res_cob = mysql_query($act_cob)or die('No pudo actualizar cart_cobro'); 
		 }else{
		 $monto = 0;
	  }	 
    }
	 if(isset($_SESSION["cont_5"])){
      $nro =$_SESSION["cont_5"];
	  if(isset($_POST["imp_5"])){
         $monto = $_POST["imp_5"];
		 $act_cob  = "Update temp_cobro set TEMP_COB_IMPO_C = $monto where 
	               TEMP_COB_NRO = $nro "; 
         $res_cob = mysql_query($act_cob)or die('No pudo actualizar cart_cobro'); 
		}else{
		 $monto = 0; 
	  }	 
    }
	 if(isset($_SESSION["cont_6"])){
      $nro =$_SESSION["cont_6"];
	  if(isset($_POST["imp_6"])){
         $monto = $_POST["imp_6"];
		 $act_cob  = "Update temp_cobro set TEMP_COB_IMPO_C = $monto where 
	               TEMP_COB_NRO = $nro "; 
         $res_cob = mysql_query($act_cob)or die('No pudo actualizar cart_cobro'); 
		 }else{
		 $monto = 0;
	  }	 
    }
	 if(isset($_SESSION["cont_7"])){
      $nro =$_SESSION["cont_7"];
	  if(isset($_POST["imp_7"])){
         $monto = $_POST["imp_7"];
		 $act_cob  = "Update temp_cobro set TEMP_COB_IMPO_C = $monto where 
	               TEMP_COB_NRO = $nro "; 
         $res_cob = mysql_query($act_cob)or die('No pudo actualizar cart_cobro'); 
		 }else{
		 $monto = 0; 
	  }	 
    }
	if(isset($_SESSION["cont_8"])){
      $nro =$_SESSION["cont_8"];
	  if(isset($_POST["imp_8"])){
         $monto = $_POST["imp_8"];
		 $act_cob  = "Update temp_cobro set TEMP_COB_IMPO_C = $monto where 
	               TEMP_COB_NRO = $nro "; 
         $res_cob = mysql_query($act_cob)or die('No pudo actualizar cart_cobro'); 
		  }else{
		 $monto = 0;
	  }	 
    }
	if(isset($_SESSION["cont_9"])){
      $nro =$_SESSION["cont_9"];
	  if(isset($_POST["imp_9"])){
         $monto = $_POST["imp_9"];
		 $act_cob  = "Update temp_cobro set TEMP_COB_IMPO_C = $monto where 
	               TEMP_COB_NRO = $nro "; 
         $res_cob = mysql_query($act_cob)or die('No pudo actualizar cart_cobro'); 
		 }else{
		 $monto = 0; 
	  }	 
    }
	if(isset($_SESSION["cont_10"])){
      $nro =$_SESSION["cont_10"];
	  if(isset($_POST["imp_10"])){
         $monto = $_POST["imp_10"];
		 $act_cob  = "Update temp_cobro set TEMP_COB_IMPO_C = $monto where 
	               TEMP_COB_NRO = $nro "; 
         $res_cob = mysql_query($act_cob)or die('No pudo actualizar cart_cobro'); 
		 }else{
		 $monto = 0; 
	  }	 
    }
	if(isset($_SESSION["cont_11"])){
      $nro =$_SESSION["cont_11"];
	  if(isset($_POST["imp_11"])){
         $monto = $_POST["imp_11"];
		 $act_cob  = "Update temp_cobro set TEMP_COB_IMPO_C = $monto where 
	               TEMP_COB_NRO = $nro "; 
         $res_cob = mysql_query($act_cob)or die('No pudo actualizar cart_cobro'); 
		 }else{
		 $monto = 0;
	  }	 
    }
	if(isset($_SESSION["cont_12"])){
      $nro =$_SESSION["cont_12"];
	  if(isset($_POST["imp_12"])){
         $monto = $_POST["imp_12"];
		 $act_cob  = "Update temp_cobro set TEMP_COB_IMPO_C = $monto where 
	               TEMP_COB_NRO = $nro "; 
         $res_cob = mysql_query($act_cob)or die('No pudo actualizar cart_cobro'); 
		 }else{
		 $monto = 0;
	  }	 
    }
	if(isset($_SESSION["cont_13"])){
      $nro =$_SESSION["cont_13"];
	  if(isset($_POST["imp_13"])){
         $monto = $_POST["imp_13"];
		 $act_cob  = "Update cart_cobro set CART_COB_IMPO_C = $monto where 
	               CART_COB_NRO = $nro "; 
         $res_cob = mysql_query($act_cob)or die('No pudo actualizar cart_cobro'); 
		 }else{
		 $monto = 0;
	  }	 
    }
	if(isset($_SESSION["cont_14"])){
      $nro =$_SESSION["cont_14"];
	  if(isset($_POST["imp_14"])){
         $monto = $_POST["imp_14"];
		 $act_cob  = "Update temp_cobro set TEMP_COB_IMPO_C = $monto where 
	               TEMP_COB_NRO = $nro "; 
         $res_cob = mysql_query($act_cob)or die('No pudo actualizar cart_cobro'); 
		 }else{
		 $monto = 0;
	  }	 
    }
	
	if(isset($_SESSION["cont_15"])){
      $nro =$_SESSION["cont_15"];
	  if(isset($_POST["imp_15"])){
         $monto = $_POST["imp_15"];
		 $act_cob  = "Update temp_cobro set TEMP_COB_IMPO_C = $monto where 
	               TEMP_COB_NRO = $nro "; 
         $res_cob = mysql_query($act_cob)or die('No pudo actualizar cart_cobro'); 
	  }	 
    }
	if(isset($_SESSION["cont_16"])){
      $nro =$_SESSION["cont_16"];
	  if(isset($_POST["imp_16"])){
         $monto = $_POST["imp_16"];
		 $act_cob  = "Update temp_cobro set TEMP_COB_IMPO_C = $monto where 
	               TEMP_COB_NRO = $nro "; 
         $res_cob = mysql_query($act_cob)or die('No pudo actualizar cart_cobro'); 
		  }else{
		 $monto = 0;
	  }	 
    }
	if(isset($_SESSION["cont_17"])){
      $nro =$_SESSION["cont_17"];
	  if(isset($_POST["imp_17"])){
         $monto = $_POST["imp_17"];
		$act_cob  = "Update temp_cobro set TEMP_COB_IMPO_C = $monto where 
	               TEMP_COB_NRO = $nro "; 
         $res_cob = mysql_query($act_cob)or die('No pudo actualizar cart_cobro'); 
		 }else{
		 $monto = 0;
	  }	 
    }
	
	 if(isset($_SESSION["cont_18"])){
      $nro =$_SESSION["cont_18"];
	  if(isset($_POST["imp_18"])){
         $monto = $_POST["imp_18"];
		 $act_cob  = "Update temp_cobro set TEMP_COB_IMPO_C = $monto where 
	               TEMP_COB_NRO = $nro "; 
         $res_cob = mysql_query($act_cob)or die('No pudo actualizar cart_cobro'); 
	  }	 
    } 
	if(isset($_SESSION["cont_19"])){
      $nro =$_SESSION["cont_19"];
	  if(isset($_POST["imp_19"])){
         $monto = $_POST["imp_19"];
		 $act_cob  = "Update temp_cobro set TEMP_COB_IMPO_C = $monto where 
	               TEMP_COB_NRO = $nro "; 
         $res_cob = mysql_query($act_cob)or die('No pudo actualizar cart_cobro'); 
	  }	 
    }
	if(isset($_SESSION["cont_20"])){
      $nro =$_SESSION["cont_20"];
	  if(isset($_POST["imp_20"])){
         $monto = $_POST["imp_20"];
		$act_cob  = "Update temp_cobro set TEMP_COB_IMPO_C = $monto where 
	               TEMP_COB_NRO = $nro "; 
         $res_cob = mysql_query($act_cob)or die('No pudo actualizar cart_cobro'); 
	  }	 
    }
	if(isset($_SESSION["cont_21"])){
      $nro =$_SESSION["cont_21"];
	  if(isset($_POST["imp_21"])){
         $monto = $_POST["imp_21"];
		 $act_cob  = "Update temp_cobro set TEMP_COB_IMPO_C = $monto where 
	               TEMP_COB_NRO = $nro "; 
         $res_cob = mysql_query($act_cob)or die('No pudo actualizar cart_cobro'); 
	  }	 
    }
	if(isset($_SESSION["cont_22"])){
      $nro =$_SESSION["cont_22"];
	  if(isset($_POST["imp_22"])){
         $monto = $_POST["imp_22"];
		$act_cob  = "Update temp_cobro set TEMP_COB_IMPO_C = $monto where 
	               TEMP_COB_NRO = $nro "; 
         $res_cob = mysql_query($act_cob)or die('No pudo actualizar cart_cobro'); 
	  }	 
    }
	if(isset($_SESSION["cont_23"])){
      $nro =$_SESSION["cont_23"];
	  if(isset($_POST["imp_23"])){
         $monto = $_POST["imp_20"];
		$act_cob  = "Update temp_cobro set TEMP_COB_IMPO_C = $monto where 
	               TEMP_COB_NRO = $nro "; 
         $res_cob = mysql_query($act_cob)or die('No pudo actualizar cart_cobro'); 
	  }	 
    }
	if(isset($_SESSION["cont_24"])){
      $nro =$_SESSION["cont_24"];
	  if(isset($_POST["imp_24"])){
         $monto = $_POST["imp_24"];
		 $act_cob  = "Update temp_cobro set TEMP_COB_IMPO_C = $monto where 
	               TEMP_COB_NRO = $nro "; 
         $res_cob = mysql_query($act_cob)or die('No pudo actualizar cart_cobro'); 
	  }	 
    }
	if(isset($_SESSION["cont_25"])){
      $nro =$_SESSION["cont_25"];
	  if(isset($_POST["imp_25"])){
         $monto = $_POST["imp_25"];
		 $act_cob  = "Update temp_cobro set TEMP_COB_IMPO_C = $monto where 
	               TEMP_COB_NRO = $nro "; 
         $res_cob = mysql_query($act_cob)or die('No pudo actualizar cart_cobro'); 
	  }	 
    }
	if(isset($_SESSION["cont_26"])){
      $nro =$_SESSION["cont_26"];
	  if(isset($_POST["imp_26"])){
         $monto = $_POST["imp_26"];
		 $act_cob  = "Update temp_cobro set TEMP_COB_IMPO_C = $monto where 
	               TEMP_COB_NRO = $nro "; 
         $res_cob = mysql_query($act_cob)or die('No pudo actualizar cart_cobro'); 
	  }	 
    }
	if(isset($_SESSION["cont_27"])){
      $nro =$_SESSION["cont_27"];
	  if(isset($_POST["imp_27"])){
         $monto = $_POST["imp_27"];
		 $act_cob  = "Update temp_cobro set TEMP_COB_IMPO_C = $monto where 
	               TEMP_COB_NRO = $nro "; 
         $res_cob = mysql_query($act_cob)or die('No pudo actualizar cart_cobro'); 
	  }	 
    }
	if(isset($_SESSION["cont_28"])){
      $nro =$_SESSION["cont_28"];
	  if(isset($_POST["imp_28"])){
         $monto = $_POST["imp_28"];
		 $act_cob  = "Update temp_cobro set TEMP_COB_IMPO_C = $monto where 
	               TEMP_COB_NRO = $nro "; 
         $res_cob = mysql_query($act_cob)or die('No pudo actualizar cart_cobro'); 
	  }	 
    }
	if(isset($_SESSION["cont_29"])){
      $nro =$_SESSION["cont_29"];
	  if(isset($_POST["imp_29"])){
         $monto = $_POST["imp_29"];
		 $act_cob  = "Update temp_cobro set TEMP_COB_IMPO_C = $monto where 
	               TEMP_COB_NRO = $nro "; 
         $res_cob = mysql_query($act_cob)or die('No pudo actualizar cart_cobro'); 
	  }	 
    }
	if(isset($_SESSION["cont_30"])){
      $nro =$_SESSION["cont_30"];
	  if(isset($_POST["imp_30"])){
         $monto = $_POST["imp_30"];
		 $act_cob  = "Update temp_cobro set TEMP_COB_IMPO_C = $monto where 
	               TEMP_COB_NRO = $nro "; 
         $res_cob = mysql_query($act_cob)or die('No pudo actualizar cart_cobro'); 
	  }	 
    }
}
?>
<br>
   <?php if(isset($_SESSION['grupo'])){
      $nom_grp =$_SESSION['grupo'];
	  echo "Grupo ".encadenar(2).$nom_grp;
	  }
	  ?>
	<br>  
    <?php
   if(isset($_SESSION['nombre'])){
      $nom_com =$_SESSION['nombre'];
	  $ncre = $_SESSION['ncre'];
	  echo "Credito Nro. ".encadenar(2).$ncre;?>
	  <br>
	 <?php 
   }
echo "Fecha de Calculo   ".encadenar(2).$f_cal.encadenar(2).$f_cob."porque";
?>
<table width="50%"  border="1" cellspacing="1" cellpadding="1" align="center">
        <tr>
           <th width="22%" bgcolor="#66CCFF" scope="col"><border="0" alt="" align="absmiddle" />CREDITO</th>
           <th width="20%" bgcolor="#66CCFF" scope="col"><border="0" alt="" align="absmiddle" />NOMBRE COMPLETO</th>
           <th width="25%" bgcolor="#66CCFF" scope="col"><border="0" alt="" align="absmiddle" />IMPORTE PAGADO</th>
	    </tr>
<?php 
    $con_cob  = "Select * From temp_cobro, cliente_general where 
	            CLIENTE_COD = TEMP_COB_CLI and TEMP_COB_USR_BAJA is null and CLIENTE_USR_BAJA is null "; 
    $res_cob = mysql_query($con_cob)or die('No pudo seleccionarse temp_cobro');
	while ($lin_cob = mysql_fetch_array($res_cob)){
		     $nom_com = $lin_cob['CLIENTE_AP_PATERNO'].encadenar(1).$lin_cob['CLIENTE_AP_MATERNO']
			            .encadenar(1).$lin_cob['CLIENTE_NOMBRES'];
		  $total = $total + $lin_cob['TEMP_COB_IMPO_C'];				
			
?>
	
	       <tr>
			    <td bgcolor="" ><?php echo $lin_cob['TEMP_COB_NCRE']; ?></td>
				<td bgcolor="" ><?php echo $nom_com; ?></td>
				<td align="right" ><?php echo number_format($lin_cob['TEMP_COB_IMPO_C'], 2, '.',','); ?></td>
		 </tr> 
		 					
<?php						
     }
	 
?> 
</table>
<?php		 
	 echo "TOTAL   ". encadenar(54).number_format($total, 2, '.',','); 
?>
<br>
 <form name="form1" method="post" action="cobro_retro_op.php" style="border:groove" target="_self"  > <?php
  echo "APLICACION  DE  PAGO";
?>
	<table width="50%"  border="1" cellspacing="1" cellpadding="1" align="center">
	  <tr>
           <th width="22%" bgcolor="#66CCFF" scope="col"><border="0" alt="" align="absmiddle" />CREDITO</th>
		   <th width="20%" bgcolor="#66CCFF" scope="col"><border="0" alt="" align="absmiddle" />DEUDA ACTUAL</th>
           <th width="20%" bgcolor="#66CCFF" scope="col"><border="0" alt="" align="absmiddle" />IMPORTE PAGADO</th>
           <th width="20%" bgcolor="#66CCFF" scope="col"><border="0" alt="" align="absmiddle" />CAPITAL</th>
		   <th width="20%" bgcolor="#66CCFF" scope="col"><border="0" alt="" align="absmiddle" />INTERES</th>
		   <th width="20%" bgcolor="#66CCFF" scope="col"><border="0" alt="" align="absmiddle" />FONDO GARANTIA</th>
	    </tr>
	<?php

    $con_cobt  = "Select TEMP_COB_NCRE, sum(TEMP_COB_IMPO_C) From temp_cobro where 
	             TEMP_COB_USR_BAJA is null group by TEMP_COB_NCRE "; 
    $res_cobt = mysql_query($con_cobt)or die('No pudo sumar temp_cobro');
	$d_cap = 0;
	$d_int = 0;
	$d_aho = 0;
	$a_cap = 0;
	$a_int = 0;
	$a_aho = 0;
	$t_mon_p = 0;
/*	 $cap = montos_recuperados($cod_cre,$f_cal,13);
 if (empty($cap)) {
    $cap = 0;
	}
 $int = montos_recuperados($cod_cre,$f_cal,51);
 if (empty($int)) {
    $int = 0;
	}
 $fon = montos_dep_fgar($cod_cre,$f_cal,2);
 if (empty($fon)) {
    $fon = 0;
	}
 $deuk = monto_deuda_c($cod_cre,$f_has);
 $deui = monto_deuda_i($cod_cre,$f_has);
 $deua = monto_deuda_a($cod_cre,$f_has);*/
	while ($lin_cobt = mysql_fetch_array($res_cobt)){
	     $mon_p = $lin_cobt['sum(TEMP_COB_IMPO_C)'];
		 $monto_p = $mon_p;
		 $t_mon_p = $t_mon_p + $mon_p;
		 $ncre = $lin_cobt['TEMP_COB_NCRE'];
		 $d_cap = monto_deuda_c($ncre,$f_cal);
		 $d_int = monto_deuda_i($ncre,$f_cal);
		 $d_aho = monto_deuda_a($ncre,$f_cal);
		 $t_deuda = $d_cap + $d_int +  $d_aho;
		 if ($monto_p >= $d_int){
		    $a_int = $d_int;
			$monto_p = $monto_p - $d_int;
		    }else{
			$a_int = 0;
			
		   }
		 
		 if ($monto_p >= $d_cap){
		    $a_cap = $d_cap;
			$monto_p = $monto_p - $d_cap;
		    }else{
			$a_cap = $monto_p;
			$monto_p = $monto_p - $d_cap;
		  }  
		 if ($monto_p > 0){
		    $a_aho = $monto_p;
			}else{
			$a_aho =0;
		  }  	
		 ?> 
		  <tr>
			    <td bgcolor="" ><?php echo $lin_cobt['TEMP_COB_NCRE']; ?></td>
				<td align="right" ><?php echo number_format($t_deuda, 2, '.',','); ?></td>
				<td align="right" ><?php echo number_format($mon_p, 2, '.',','); ?></td>
				<td align="right" ><?php echo number_format($a_cap, 2, '.',','); ?></td>
				<td align="right" ><?php echo number_format($a_int, 2, '.',','); ?></td>
				<td align="right" ><?php echo number_format($a_aho, 2, '.',','); ?></td>
		 </tr> 
		 <br> 
	<?php
	 $con_car  = "Select * From cart_maestro where CART_NRO_CRED = $ncre and CART_ESTADO < 8 and CART_MAE_USR_BAJA is null"; 
     $res_car = mysql_query($con_car)or die('No pudo seleccionarse solicitud 2');
          while ($lin_car = mysql_fetch_array($res_car)) {
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
				 $f_des2= cambiaf_a_normal($f_des); 
		         $f_uno2= cambiaf_a_normal($f_uno);
	
	$f_cob = cambiaf_a_mysql_2($f_cal);
	echo $f_cob, $f_cal;
	$fec_p = cambiaf_a_mysql_2($fec);
	}
	
	 $consulta = "insert into cart_cobro (CART_COB_NCRE,
	                                    CART_COB_CLI,
										CART_COB_NRO,
										CART_COB_AGEN, 
										CART_COB_FECHA,
										CART_COB_FEC_CTA,
 										CART_COB_MON,
										CART_COB_IMPO_C,
										CART_COB_IMPO_I, 
										CART_COB_IMPO_F,
									    CART_COB_CTA,
										CART_COB_ESTCAR,
										CART_COB_ESTADO, 
										CART_COB_USR_ALTA,
									    CART_COB_FCH_HR_ALTA,
									    CART_COB_USR_BAJA,
									    CART_COB_FCH_HR_BAJA)
						         values ($ncre,
								         0,
										 0, 
								 		 $c_agen ,
								  		 '$fec_p',
								   		 '$f_cob',
										 $mon,
										 $a_cap,
								   		 $a_int,
								    	 $a_aho, 
										 0, 
										 $est,
										 1,
									 	 '$log_usr',
										 null,
										 null,
										 '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar : ' . mysql_error());	
	}
    ?> 
</table>

<?php		 
	 echo "TOTAL   ". encadenar(14).number_format($t_mon_p, 2, '.',',').encadenar(42); 
?>
 <br> <br>
<input type="submit" name="accion" value="Para Caja">
<input type="submit" name="accion" value="Salir">
</form>
<?php
		 	include("footer_in.php");
		 ?>	
<?php
}
    ob_end_flush();
 ?>