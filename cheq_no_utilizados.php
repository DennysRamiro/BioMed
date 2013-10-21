<?php
	  ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
	require('configuracion.php');
    require('funciones.php');
?>
<html>
<head>
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<?php
include('header_2.php');
 //$fec = leer_param_gral();
 $logi = $_SESSION['login']; 
?>
  <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <!--a href='rec_noutilizados.php'>Salir</a-->
	    <a href='chec_reportes.php'>Salir</a>
	    
  </div>

<br><br>
<?php
$f_des = "";
$f_has = "";
$mone = " ";
if(isset($_POST['fec_des'])){
      $f_des = $_POST['fec_des'];
      $_SESSION['f_des'] = $f_des;
	  $f_des2 = cambiaf_a_mysql($f_des);
  }
 if(isset($_POST['fec_has'])){
      $f_has = $_POST['fec_has'];
      $_SESSION['f_has'] = $f_has;
	  $f_has2 = cambiaf_a_mysql($f_has);
  } 
  if(isset($_POST['cod_bco'])){
      $cod_bco = $_POST['cod_bco'];
      $_SESSION['cod_bco'] = $cod_bco;
  }
   if(isset($_POST['chequera'])){
      $chequera = $_POST['chequera'];
      $_SESSION['chequera'] = $chequera;
  }
  $nro_tal = 0;
  if(isset($_SESSION['nro_tal'])){
     $nro_tal = $_SESSION['nro_tal'];
  
  }
   $con_cta  = "Select * From gral_cta_banco where GRAL_CTA_BAN_CTA_CTE = '$cod_bco' and
	               GRAL_CTA_BAN_USR_BAJA IS NULL";
	  $res_cta = mysql_query($con_cta);
		   while ($lin_cta = mysql_fetch_array($res_cta)) { 
			 $cue_ctble = $lin_cta['GRAL_CTA_BAN_CTBL'];
			 $_SESSION['cue_ctble'] = $cue_ctble;
			 $nom_cuenta = $lin_cta['GRAL_CTA_BAN_DESC'];
			 $_SESSION['nom_cuenta'] = $nom_cuenta;
			} 
	$con_cheq  = "SELECT * 
		 FROM contab_chequera
		 WHERE CONTA_CHRA_CTA= '$cod_bco' AND
		 CONTA_CHRA_TALON = '$chequera' AND
		 CONTA_CHRA_USR_BAJA is null";
	  $res_cheq = mysql_query($con_cheq);
		   while ($lin_cheq = mysql_fetch_array($res_cheq)) { 
			 $desde = $lin_cheq['CONTA_CHRA_INI'];
			 $hasta = $lin_cheq['CONTA_CHRA_FIN'];
		   } 		
   			
?> 
<center>
<font size="+1"  style="" >
<?php
    echo encadenar(35)."LISTADO DE CHEQUES NO UTILIZADOS ".encadenar(2);
?>
<br>
<?php
    echo encadenar(35)."CUENTA ".encadenar(2).$_SESSION['nom_cuenta'];
?>
<br><br>
</center>
<?php
    echo encadenar(10)."CHEQUERA ".encadenar(2).$_SESSION['chequera'].encadenar(2)."Cheque Desde nro.".encadenar(2).$desde.encadenar(2)."Hasta nro.".encadenar(2).$hasta;
?>
</font>

<font size="+1"  style="" >

	 
<?php 
  //Datos del cart_det_tran	
   // echo $f_des2.encadenar(2).$f_has2;
   	$t_cap = 0;
	$t_int = 0;
	$t_ifa = 0;
	$t_iven = 0;
	$t_aho = 0; 
	$t_otro = 0;
	$t_pen = 0;
	$t_ifa = 0;
	$t_tot  = 0;	
	$nro_rec  = 0;				
    $nro_tran = 0;
	/*
	$con_rec = "Select * From recibo_cntrl where REC_CTRL_NRO = '$nro_tal' and
	 REC_CTRL_USR_BAJA is null order by REC_CTRL_DESDE ";
     $res_rec = mysql_query($con_rec);
	  while ($lin_res = mysql_fetch_array($res_rec)) {
	         $fec_ent = cambiaf_a_normal($lin_res['REC_CTRL_FECHA']);
	         $respon = $lin_res['REC_CTRL_FUNC'];
	         $rec_desde = $lin_res['REC_CTRL_DESDE'];
	         $rec_hasta = $lin_res['REC_CTRL_HASTA'];
			 
//echo encadenar(40)."TALONARIO".encadenar(2).$nro_tal.encadenar(2).
//"DEL".encadenar(2).$rec_desde.encadenar(2)."AL".encadenar(2).$rec_hasta;
      }	*/
?> 
<br>

</font>
<br><br>
<font size="0"  style="" >
<center>	  
<table border="1" width="100">
	
	<tr>
	    <th align="center"><font size="-1">NRO. CHEQUE</font></th>
	    
    </tr>		
<?php	  
	 for ($i=$desde; $i < $hasta + 1; $i = $i + 1 ) {
	      $hay = 0;
	      $con_reci = "Select count(*) From contab_cheques where CONTA_CHEQ_NRO = $i and
		               CONTA_CHEQ_TALON = '$chequera' and
					   CONTA_CHEQ_CTA = '$cod_bco' and
		               CONTA_CHEQ_USR_BAJA is null ";
            $res_reci = mysql_query($con_reci);
	                while ($lin_reci = mysql_fetch_array($res_reci)) {
					      $hay =  $lin_reci['count(*)'];
	                         } 
		if ($hay == 0){					 
	  ?>
	     <tr>
		  <td align="center" ><?php echo $i; ?></td>
		  </tr>
	<?php
	   }
	 }
	  ?>
	  </table>
	  </center>
	<?php
 	include("footer_in.php");
 ?>

</div>
</body>
</html>



<?php
ob_end_flush();
 ?>

