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
<title>Cobro enviado por Creditos</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<!--script language="JavaScript" src="script/calendar_us.js"></script-->
<script language="javascript" src="script/validarForm.js"></script> 
<script language="JavaScript" src="script/jquery-1.9.0.js"></script>
<script type="text/javascript" src="js/MenuManUsuario.js"></script> 
<!--script type="text/javascript" src="js/verifica_modulo.js"></script--> 
</head>
<body>	<?php
				include("header.php");
			?>
	<div id="pagina_sistema">
     <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>
                 <li id="menu_modulo_general">
                    
                     <img src="img/applications_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO GENERAL
                    
                 </li>
                  <li id="menu_modulo_ver_debe_haber">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> VERIFICA DEBE HABER
                    
                 </li>
              
              </ul>  
  


<div id="contenido_modulo">

                      <h2> <img src="img/documents_64x64.png" border="0" alt="Modulo" align="absmiddle"> VERIFICA DEBE HABER</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
          Verificar Consistencia
        </div>

<?php
// $fec = leer_param_gral();
 $logi = $_SESSION['login']; 
?> 

<?php
//$_SESSION['form_buffer'] = $_POST;
$f_has ="";
$f_cal ="";
$t_cuo = 0;
$log_usr = $_SESSION['login']; 
$total = 0;
 ?>  
 <br>
  <center>
  <table border="1" width="300" class="table_usuario">
	
	<tr>
	    <th align="center">Nro</th>  
		 <th align="center">Nro. Doc.</th>  
		<th align="center">Fecha</th> 
	   	<th align="center">Debe</th>
		<th align="center">Haber </th>
  </tr>	
     
 <?php  
$con_car  = "Select DISTINCT CONTA_TRS_NRO, CONTA_TRS_FEC_VAL From contab_trans
             where CONTA_TRS_NRO > 1 and CONTA_TRS_USR_BAJA is null"; 
$res_car = mysql_query($con_car);
$nro = 0;
$nro_doc = 0;
   while ($lin_car = mysql_fetch_array($res_car)) {
   			set_time_limit(0);
         $nro_doc = $lin_car['CONTA_TRS_NRO']; 
		 $f_des = $lin_car['CONTA_TRS_FEC_VAL'];
		 $f_des2= cambiaf_a_normal($f_des); 
		 $tot_deb = 0;
		 $tot_hab = 0; 
		
		$con_pag = "Select CONTA_TRS_IMPO From contab_trans where CONTA_TRS_NRO = $nro_doc 
		            and CONTA_TRS_DEB_CRED = 1 and CONTA_TRS_USR_BAJA is null";
	    $res_pag = mysql_query($con_pag);
		    
		while ($lin_pag = mysql_fetch_array($res_pag)) {
		          $tot_deb = $tot_deb + $lin_pag['CONTA_TRS_IMPO'];
				//$tot_cta = $tot_cta + 1;
				}
		//Datos del cart_det_tran						
		$con_pag = "Select CONTA_TRS_IMPO From contab_trans where CONTA_TRS_NRO = $nro_doc 
		            and CONTA_TRS_DEB_CRED = 2 and CONTA_TRS_USR_BAJA is null";
	    $res_pag = mysql_query($con_pag);
		while ($lin_pag = mysql_fetch_array($res_pag)) {
		          $tot_hab = $tot_hab + $lin_pag['CONTA_TRS_IMPO'];
				//$tot_cta = $tot_cta + 1;
				}		
		$tot_deb = round($tot_deb,2);
		$tot_hab = round($tot_hab,2);	
	       
	    $dif = round(($tot_deb - $tot_hab),2);
	   // echo number_format($dif, 2, '.',',');
	   if ($dif < 0){	  
	      $dif = $dif * -1; 
	    }
	     if (($dif > 0.01) and ($dif < 0.05)){	
	         $con_pag1 = "Select CONTA_TRS_IMPO From contab_trans where CONTA_TRS_NRO = $nro_doc 
		            and  CONTA_TRS_CTA = '24204101' and CONTA_TRS_USR_BAJA is null";
	         $res_pag1 = mysql_query($con_pag1);
		     while ($lin_pag1 = mysql_fetch_array($res_pag1)) {
		            $monto = $lin_pag1['CONTA_TRS_IMPO'];
				echo $monto - $dif.$nro_doc;
	            $monto = $monto - $dif;
	            $con_pag2 = "update contab_trans set CONTA_TRS_IMPO = $monto
	                         where CONTA_TRS_NRO = $nro_doc 
		            and  CONTA_TRS_CTA = '24204101' and CONTA_TRS_USR_BAJA is null";
	         $res_pag2 = mysql_query($con_pag2);
	     
				}	
	         
	       // echo "Aqui"; 
         
     		}  
       
if ($dif > 0.01){	
    
	$nro = $nro + 1;			
			?>
	<center>
	<tr>
	    <td align="right" ><?php echo number_format($nro, 0, '.',','); ?></td>
	 	<td align="left" ><?php echo $nro_doc; ?></td>
		<td align="left" ><?php echo $f_des2; ?></td>
	   	<td align="right" ><?php echo number_format($tot_deb, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($tot_hab, 2, '.',','); ?></td>
	</tr>	
	<?php
       }
	  } 
    ?>	  
</table>
</center>		  
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

