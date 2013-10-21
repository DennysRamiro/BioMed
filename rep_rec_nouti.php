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
	    <a href='rec_reportes.php'>Salir</a>
	    
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
  if(isset($_POST['cod_mon'])){
      $mone = $_POST['cod_mon'];
      $_SESSION['mone'] = $mone;
  }
  $nro_tal = 0;
  if(isset($_SESSION['nro_tal'])){
     $nro_tal = $_SESSION['nro_tal'];
  
  }
    
?> 
<center>
<font size="+1"  style="" >
<?php
//if ($mone == 1){
    echo encadenar(35)."LISTADO DE RECIBOS NO UTILIZADOS ".encadenar(2);
//  }
// if ($mone == 2){
  //  echo encadenar(35)."LISTADO DE RECUPERACIONES DE CARTERA EN ".encadenar(2). "DOLARES";
  //} 
?>
<br>
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
	
	$con_rec = "Select * From recibo_cntrl where REC_CTRL_NRO = $nro_tal and
	 REC_CTRL_USR_BAJA is null order by REC_CTRL_DESDE ";
     $res_rec = mysql_query($con_rec);
	  while ($lin_res = mysql_fetch_array($res_rec)) {
	         $fec_ent = cambiaf_a_normal($lin_res['REC_CTRL_FECHA']);
	         $respon = $lin_res['REC_CTRL_FUNC'];
	         $rec_desde = $lin_res['REC_CTRL_DESDE'];
	         $rec_hasta = $lin_res['REC_CTRL_HASTA'];
			 
echo encadenar(40)."TALONARIO".encadenar(2).$nro_tal.encadenar(2).
"DEL".encadenar(2).$rec_desde.encadenar(2)."AL".encadenar(2).$rec_hasta;
      }	
?> 
<br>
<?php
    echo encadenar(40)."RESPONSABLE ".encadenar(2).$respon;
?>
</font>
<br><br>
<font size="0"  style="" >
	  
<table border="1" width="100">
	
	<tr>
	    <th align="center"><font size="-1">NRO. RECIBO</font></th>
	    
    </tr>		
<?php	  
	 for ($i=$rec_desde; $i < $rec_hasta + 1; $i = $i + 1 ) {
	      $hay = 0;
	      $con_reci = "Select count(*) From recibo_deta where  REC_DET_NRO = $i and
		             REC_DET_USR_BAJA is null ";
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

