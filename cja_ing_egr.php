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
<title>Mantenimiento Solicitudes</title>
</head>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
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
 $fec = leer_param_gral();
 $logi = $_SESSION['login']; 
 $mes = saca_mes($fec);
 $dia = saca_dia($fec);
 $anio = saca_anio($fec);
 //echo "  ", dia_semana($dia, $mes, $anio); 
?> 
</div>
<div id="Salir">
     <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
</div>
<center>
<div id="TitleModulo">
   	 <img src="images/24x24/001_36.png" border="0" alt="Modulo">	 
               Egresos por caja
</div>
<div id="AtrasBoton">
    <a href="solic_mante.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
</div>
<div id="GeneralManSolicaa">
<?php
// Se realiza una consulta SQL a tabla gral_param_propios
$produ = $_SESSION['producto'];
$con_dpro  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 806 and GRAL_PAR_PRO_COD = $produ";
$res_dpro = mysql_query($con_dpro);
while ($lin_dpro = mysql_fetch_array($res_dpro)) {
      $d_pro = $lin_dpro['GRAL_PAR_PRO_DESC']; 
	  }
$con_ctab = "Select * From contab_cuenta where CONTA_CTA_NRO[1,3] = '111' and CONTA_CTA_NIVEL = 'A'";
$res_ctab = mysql_query($con_ctab);
$con_ctao = "Select * From contab_cuenta where CONTA_CTA_NRO[1,3] = '445' and CONTA_CTA_NIVEL = 'A'";
$res_ctao = mysql_query($con_ctao);
$con_ctaa = "Select * From contab_cuenta where CONTA_CTA_NRO[1,3] = '459' and CONTA_CTA_NIVEL = 'A'";
$res_ctaa = mysql_query($con_ctaa);
$con_ctabt = "Select * From contab_cuenta where CONTA_CTA_NRO[1,3] = '111' and CONTA_CTA_NIVEL = '4'";
$res_ctabt = mysql_query($con_ctabt);
$con_ctaot = "Select * From contab_cuenta where CONTA_CTA_NRO[1,3] = '445' and CONTA_CTA_NIVEL = '3'";
$res_ctaot = mysql_query($con_ctaot);
$con_ctaat = "Select * From contab_cuenta where CONTA_CTA_NRO[1,3] = '459' and CONTA_CTA_NIVEL = '3'";
$res_ctaat = mysql_query($con_ctaat);
if(isset($_SESSION['form_buffer'])){
	$datos = $_SESSION['form_buffer'];
}
 ?>
 <strong>
 <?php
 if(isset($_SESSION['msg_err'])){
 ?> 
 <font color="#FF0000"> 
  <?php
	 echo $_SESSION['msg_err'];
	 $_SESSION['msg_err'] = "";
 } 
 ?>
 </font>
  </strong>
 <form name="form2" method="post" action="solic_retro_sol.php" onSubmit="return ValidarCamposSolicitud(this)">
 <table align="center">
    <tr>
        <td><strong>Producto  </strong></td>
		<td><?php echo encadenar(5);?></td>
   	    <td><?php echo $d_pro;?></td>
	</tr>
	<tr>
        <td><strong>Agencia   </strong> </td>
		<td><?php echo encadenar(5);?></td>
		<td align="left"><select name="cod_agencia" size="1"  >
   	        <?php while ($linea = mysql_fetch_array($resultado)) { ?>
            <option value=<?php echo $linea['GRAL_AGENCIA_CODIGO']; ?>>
			<?php echo $linea['GRAL_AGENCIA_NOMBRE']; ?> </option>
	  	    <?php  }  ?>
            </select></td>
     </tr>
	 <tr>
         <td><strong>Zona </strong></td>
		 <td><?php echo encadenar(5);?></td>
		 <td align="left"><select name="cod_zon" size="1"  >
  	         <?php while ($linea = mysql_fetch_array($res_zon)) { ?>
             <option value=<?php echo $linea['GRAL_PAR_PRO_COD']; ?>>
			 <?php echo $linea['GRAL_PAR_PRO_DESC']; ?> </option>
	  	     <?php } ?> 
            </select></td>
	 </tr> 
	 <tr>		 
         <td><strong>Tipo Operacion </strong></td>
		 <td><?php echo encadenar(5);?></td>
         <td align="left"><select name="tip_ope" size="1" >
   	         <?php while ($lin_top = mysql_fetch_array($res_top)) { ?>
             <option value=<?php echo $lin_top['GRAL_PAR_INT_COD']; ?>>
		     <?php echo $lin_top['GRAL_PAR_INT_DESC']; ?></option>
	         <?php } ?>
             </select></td>
	  </tr> 
	  <tr>
		 <td><strong>Moneda  </strong></td>
		 <td><?php echo encadenar(5);?></td>
         <td align="left"><select name="cod_mon" size="1"  >
   	         <?php while ($linea = mysql_fetch_array($res_mon)) {?>
             <option value=<?php echo $linea['GRAL_PAR_INT_COD']; ?>>
			 <?php echo $linea['GRAL_PAR_INT_DESC']; ?></option>
	         <?php } ?>
		     </select></td>
		</tr> 
	    <tr>
		   <td><strong>Comision  </strong></td>
		  <td><?php echo encadenar(5);?></td> 
		   <td align="left"><select name="cod_com" size="1"  >
  	           <?php while ($linea = mysql_fetch_array($res_com)) { ?>
               <option value=<?php echo $linea['GRAL_PAR_PRO_COD']; ?>>
			   <?php echo $linea['GRAL_PAR_PRO_DESC']; ?> </option>
	           <?php  } ?> 
               </select></td>
		</tr> 
	    <tr>
		   <td><strong>Cobro  Comision</strong></td>
		   <td><?php echo encadenar(5);?></td>
           <td align="left"> <select name="cod_ccom" size="1"  >
  	           <?php while ($linea = mysql_fetch_array($res_fco)) { ?>
               <option value=<?php echo $linea['GRAL_PAR_PRO_COD']; ?>>
			   <?php echo $linea['GRAL_PAR_PRO_DESC']; ?> </option>
	           <?php  }  ?> 
               </select></td>
		 </tr> 
	     <tr>   
            <td><strong>Origen de Fondos </strong></td>
			<td><?php echo encadenar(5);?></td>
            <td align="left"><select name="cod_ofo" size="1"  >
  	            <?php  while ($linea = mysql_fetch_array($res_ofo)) { ?>
                <option value=<?php echo $linea['GRAL_PAR_PRO_COD']; ?>>
				<?php echo $linea['GRAL_PAR_PRO_DESC']; ?> </option>
	            <?php  }  ?> 
                </select></td>
		 </tr> 
	     <tr>   
             <td><strong>Forma de Pago </strong></td>
			 <td><?php echo encadenar(5);?></td>
             <td align="left"><select name="cod_fpa" size="1"  >
  	             <?php while ($linea = mysql_fetch_array($res_fpa)) {?>
                 <option value=<?php echo $linea['GRAL_PAR_INT_COD']; ?>>
	             <?php echo $linea['GRAL_PAR_INT_DESC']; ?> </option>
	             <?php  }  ?> 
                 </select></td>
		 </tr> 
	     <tr>
            <td><strong>Calculo de Interes </strong></td>
			<td><?php echo encadenar(5);?></td>
            <td align="left"><select name="cod_cin" size="1"  >
  	            <?php while ($linea = mysql_fetch_array($res_cai)) {?>
                <option value=<?php echo $linea['GRAL_PAR_INT_COD']; ?> >
				<?php echo $linea['GRAL_PAR_INT_DESC']; ?> </option>
	            <?php  }  ?> 
                </select></td>
		</tr> 
	    <tr>
		  <td><strong>Importe Solicitado  </strong></td>
		  <td><?php echo encadenar(5);?></td>
          <td align="rigth"><?php if(isset($datos['imp_sol'])){?>
              <input type="text" name="imp_sol" maxlength="12" size="12" value="<?=$datos['imp_sol'];?>" > 
              <?php }else{?>
  		      <input type="text" name="imp_sol" maxlength="12" size="12" value="" >
	          <?php }?></td>
		</tr>  
        <tr>
		  <td><strong>Int. Anual % </strong></td>
		  <td><?php echo encadenar(5);?></td>
          <td align="rigth"> <?php if(isset($datos['tas_int'])){?>
              <input type= type="text" name="tas_int" maxlength="8" size="8" value="<?=$datos['tas_int'];?>" > 
	          <?php }else{ ?>
	          <input type= type="text" name="tas_int" maxlength="8" size="8" value="" >
		      <?php } ?></td>
		</tr>   
	    <tr>
		  <td><strong>Plzo Meses</strong></td>
		  <td><?php echo encadenar(5);?></td>
          <td align="rigth"> <?php if(isset($datos['plz_mes'])){?>
              <input type="text" name="plz_mes" maxlength="5" size="5" value="<?=$datos['plz_mes'];?>" > 
	          <?php }else{ ?>
              <input type="text" name="plz_mes" maxlength="5" size="5" value="" > 
		      <?php }?></td>
		</tr>   
	    <tr>
		  <td><strong>Nro. Cuotas </strong></td>
		  <td><?php echo encadenar(5);?></td>
          <td><?php if(isset($datos['nro_cta'])){?>
              <input type= type="text" name="nro_cta" maxlength="5" size="5" value="<?=$datos['nro_cta'];?>" >
		      <?php }else{ ?>
		      <input type= type="text" name="nro_cta" maxlength="5" size="5" value="" >
		      <?php }?></td>
		</tr>
		<tr>
		  <td><strong>Fondo Garantia Inicio % </strong></td>
		  <td><?php echo encadenar(5);?></td>
          <td><?php if(isset($datos['aho_ini'])){?>
              <input type= type="text" name="aho_ini" maxlength="8" size="8"  value="<?=$datos['aho_ini'];?>" > 
		      <?php }else{ ?>
		      <input type= type="text" name="aho_ini" maxlength="8" size="8"  value="" >
		      <?php } ?></td>
		</tr>
		<tr>
           <td><strong>Fondo Garantia Ciclo %  </strong></td>
		   <td><?php echo encadenar(5);?></td>
           <td><?php if(isset($datos['aho_dur'])){?>
               <input type= type="text" name="aho_dur" maxlength="8" size="8" value="<?=$datos['aho_dur'];?>" > 
		       <?php }else{ ?>
		       <input type= type="text" name="aho_dur" maxlength="8" size="8" value="" >
		       <?php }?></td>
		</tr>
		<tr>
           <td><strong>Fecha Desembolso (dd-mm-aaaa) </strong></td>
		   <td><?php echo encadenar(5);?></td>
		   <td><input type="text" name="fec_des" maxlength="12"  size="12" > <script language="JavaScript">
               new tcal ({
                // form name
               'formname': 'form2',
                // input name
               'controlname': 'fec_des'
               });
               </script></td>
		</tr>
		<tr>	   
	        <td><strong>Fecha Primer Pago (dd-mm-aaaa) </strong></td>
			<td><?php echo encadenar(5);?></td>
            <td><input type="text" name="fec_uno" maxlength="12"  size="12" > <script language="JavaScript">
                new tcal ({
                // form name
                'formname': 'form2',
                // input name
                'controlname': 'fec_uno'
                });
                </script></td>
		</tr>
		<tr>	   
	      	<td><strong>Hra Reunion (hh:mm) </strong></td>
			<td><?php echo encadenar(5);?></td>
	        <td><?php if(isset($datos['hra_reu'])){?>
                <input type= type="text" name="hra_reu" maxlength="8" size="8" value="<?=$datos['hra_reu'];?>" > 
	            <?php }else{ ?>
	            <input type= type="text" name="hra_reu" maxlength="8" size="8" value="" >
	            <?php } ?></td>
		</tr>
		<tr>	   
	        <td><strong>Dirección Reunion </strong></td>
			<td><?php echo encadenar(5);?></td>
	        <td><?php if(isset($datos['dir_reu'])){?>
                <input type= type="text" name="dir_reu" maxlength="50" size="50" value="<?=$datos['dir_reu'];?>" >  
	            <?php }else{ ?>
	            <input type= type="text" name="dir_reu" maxlength="50" size="50" value="" >
	            <?php } ?></td>
		</tr>
		
	</table>
  <br><br>
	<center>
	
    <input type="submit" name="accion" value="Grabar">
    <input type="submit" name="accion" value="Salir">
</form>

  <div id="FooterTable">
<BR><B><FONT SIZE=+2><MARQUEE>Alta Solicitud Credito Normal</MARQUEE></FONT></B>
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