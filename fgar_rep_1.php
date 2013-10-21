<?php
//ini_set('max_execution_time', 60); //240 segundos = 4 minutos
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
<title>Resumen de Fondo de Garantia</title>
<meta charset="UTF-8">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script> 

<script  type="text/javascript" src="js/reportes_fondo_res_mon.js"></script> 
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
                 <li id="menu_modulo_general">
                    
                     <img src="img/open document_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. FONDO GARANTIA 
                    
                 </li>
                  <li id="menu_modulo_reportes_fondo">
                    
                     <img src="img/documents_32x32.png" border="0" alt="Modulo" align="absmiddle"> REP. FONDO GARANTIA
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/my documents_32x32.png" border="0" alt="Modulo" align="absmiddle"> RES. POR MONEDA
                    
                 </li>
              </ul> 
    
     <div id="contenido_modulo">
                      <h2> <img src="img/my documents_64x64.png" border="0" alt="Modulo" align="absmiddle">RESUMEN POR MONEDA</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/alert_32x32.png" align="absmiddle">
                     Resumen de Formularios por moneda 
                     </div>                  
<?php
 //$fec = leer_param_gral();
 $f_pro = cambiaf_a_mysql($fec); 
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
  
  <table border="2" width="820">
	
	<tr>
	    <th align="center">Moneda</th> 
		<th align="center">Nro. Cuentas</th> 
	   	<th align="center">Deposito</th>
		<th align="center">Retiro</th>
		<th align="center">Saldo</th>
		
    </tr>	
     
 <?php  
 $nro1 = 0;
		 $nro2 = 0;
		 $cod_cre2 = "";
	     $mon_impo_1 = 0;
         $mon_impo_2 = 0;
		 $d_mon_1 = "Bolivianos";
		 $d_mon_2 = "Dolares";
		 $tot_tre1 = 0;
		 $tot_tde1 = 0;
		 $tot_tre2 = 0;
		 $tot_tde2 = 0;
		 $saldo = 0;
		 
$con_fon  = "Select DISTINCT FOND_NRO_CTA, FOND_COD_MON From fond_maestro where 
	              FOND_ESTADO = 3  and 
				  FOND_MAE_USR_BAJA is null order by FOND_NRO_CTA"; 
    $res_fon = mysql_query($con_fon);
    while ($lin_fon = mysql_fetch_array($res_fon)) { 
    	//para que el tiempo sea infinito en ejecucion
    	set_time_limit(0);
	     $tot_tre = 0;
		 $tot_tde = 0;
	  // 1a 
      //echo "entra";
		 $cta = $lin_fon['FOND_NRO_CTA'];
		 echo $cta;
		 //$tip = $lin_fon['FOND_TIPO_OPER'];
		 $mon = $lin_fon['FOND_COD_MON'];
		 
		 
		 
		 $con_dtra  = "Select sum(FOND_DTRA_IMPO) From fond_det_tran where FOND_DTRA_NCTA = $cta 
		               and FOND_DTRA_FECHA <= '$f_pro' and 
                       FOND_DTRA_TIP_TRAN = 1 and FOND_DTRA_CCON = 212 and FOND_DTRA_USR_BAJA is null ";
         $res_dtra = mysql_query($con_dtra);
         while ($lin_dtra = mysql_fetch_array($res_dtra)) { // 2a
                $tot_tde = $lin_dtra['sum(FOND_DTRA_IMPO)'];
	   	        } // 2c
				
	     $con_dtra  = "Select sum(FOND_DTRA_IMPO) From fond_det_tran where FOND_DTRA_NCTA = $cta 
		               and FOND_DTRA_FECHA <= '$f_pro' and FOND_DTRA_CCON = 212 and 
                       FOND_DTRA_TIP_TRAN = 2 and FOND_DTRA_USR_BAJA is null ";
         $res_dtra = mysql_query($con_dtra);
   	     while ($lin_dtra = mysql_fetch_array($res_dtra)) {   // 3a
	            $tot_tre = $lin_dtra['sum(FOND_DTRA_IMPO)'];
	        } // 3c
	//	 $saldo = $tot_tde - $tot_tre;		
	//	 $tot_sal = $tot_sal + ($tot_tde - $tot_tre);
	//	 $nro = $nro + 1;
	//	  echo $cta," ",$tot_tde - $tot_tre;
		if ($mon == 1){
		   $nro1 = $nro1 + 1;
		    $mon_impo_1 = $mon_impo_1 + ($tot_tde - $tot_tre);
			$tot_tre1 = $tot_tre1 + $tot_tre;
		    $tot_tde1 = $tot_tde1 + $tot_tde;
		  }	
	   if ($mon == 2){
		  $nro2 = $nro2 + 1;
		  $mon_impo_2 = $mon_impo_2 + ($tot_tde - $tot_tre);
		  $tot_tre2 = $tot_tre2 + $tot_tre;
		  $tot_tde2 = $tot_tde2 + $tot_tde;
		  }
		  
		  }
		  
		  
		  ?> 
		<tr>
	    <td align="left" ><?php echo $d_mon_1; ?></td>
		<td align="right" ><?php echo number_format($nro1, 0, '.',','); ?></td>
		<td align="right" ><?php echo number_format($tot_tde1, 2, '.',','); ?></td>
	 	<td align="right" ><?php echo number_format($tot_tre1, 2, '.',','); ?></td>
	    <td align="right" ><?php echo number_format($mon_impo_1, 2, '.',','); ?></td>
       	
	</tr>	
	<tr>
	    <td align="left" ><?php echo $d_mon_2; ?></td>
		<td align="right" ><?php echo number_format($nro2, 0, '.',','); ?></td>
		<td align="right" ><?php echo number_format($tot_tde2, 2, '.',','); ?></td>
	 	<td align="right" ><?php echo number_format($tot_tre2, 2, '.',','); ?></td>
	    <td align="right" ><?php echo number_format($mon_impo_2, 2, '.',','); ?></td>
       	
	</tr>
	<?php

	  
    ?>
	 
</table>
		  
 		  
</div>
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

