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
          
<?php //  }
	
			?>
            <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
       <?php if($_SESSION['menu'] == 48){?> 
	   <a href='cont_rep_op.php?accion=9'>Salir</a>
	    <?php } elseif($_SESSION['menu'] == 51){?> 
	    <a href='cont_rep_op.php?accion=31'>Salir</a>
	    <?php }?>
	  </center> 
	 <br> 
	   <?php
	
	?>
	<br>
	<center>
<?php	


      if ($_POST['cod_bco'] <> ""){ //4a  
	     $cod_bco = $_POST['cod_bco'];
		// $mon_cta = $cod_cta[5]; 
	     $_SESSION['cod_bco'] = $cod_bco;
		
	  }	//4b
	 if (isset ($_POST['fec_des'])){
	     $fec_des = $_POST['fec_des'];
		  $_SESSION['fec_des'] = $fec_des;
		 $fec_de2 = cambiaf_a_mysql_2($fec_des);
		 $_SESSION['fec_de2'] = $fec_de2;
	 }
     if (isset ($_POST['fec_has'])){
	     $fec_has = $_POST['fec_has'];
		 $_SESSION['fec_has'] = $fec_has;
		 $fec_ha2 = cambiaf_a_mysql_2($fec_has);
		 $_SESSION['fec_ha2'] = $fec_ha2;
	 }
	 echo encadenar(2).$_SESSION['fec_des'].encadenar(2).$_SESSION['fec_has'].
		 encadenar(2). $_SESSION['cod_bco'];
	//DAtos de la cuenta	   
	  $con_cta  = "Select * From gral_cta_banco where GRAL_CTA_BAN_CTA_CTE = '$cod_bco' and
	               GRAL_CTA_BAN_USR_BAJA IS NULL";
	  $res_cta = mysql_query($con_cta);
		   while ($lin_cta = mysql_fetch_array($res_cta)) { 
			 $cue_ctble = $lin_cta['GRAL_CTA_BAN_CTBL'];
			 $_SESSION['cue_ctble'] = $cue_ctble;
			 $nom_cuenta = $lin_cta['GRAL_CTA_BAN_DESC'];
			 $_SESSION['nom_cuenta'] = $nom_cuenta;
			}
header('Location:bco_conciliacion.php');	


?>
	
	
	 
</div>
  <?php
		// 	include("footer_in.php");
		 ?>
</div>
</body>
</html>
<?php
}
ob_end_flush();
 ?>