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
<script type="text/javascript" src="script/jquery-1.9.0.js"></script>
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script> 

<link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
        <script src="script/jquery-ui.js"></script>
        <script type="text/javascript" src="js/calendario.js"></script> 
        <script type="text/javascript" src="js/ValidarFormulario.js"></script>


</head>
<body>	<?php
	   include("header.php");
 	 ?>
<ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>
                 <li id="menu_modulo_creditos">
                    
                     <img src="img/edit file_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CREDITOS
                    
                 </li>
                  <li id="menu_modulo_creditos_alta">
                    
                     <img src="img/clock_32x32.png" border="0" alt="Modulo" align="absmiddle"> SOLICITUD
                    
                 </li>
                   <li id="menu_modulo_fecha">
                    
                     <img src="img/add user_32x32.png" border="0" alt="Modulo" align="absmiddle"> ALTA
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/add user_32x32.png" border="0" alt="Modulo" align="absmiddle"> NORMAL
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
<h2> <img src="img/add user_64x64.png" border="0" alt="Modulo" align="absmiddle">

<?php
// $fec = leer_param_gral();
 $logi = $_SESSION['login']; 
 $mes = saca_mes($fec);
 $dia = saca_dia($fec);
 $anio = saca_anio($fec);
 //echo "  ", dia_semana($dia, $mes, $anio); 
?> 


<?php
// Se realiza una consulta SQL a tabla gral_param_propios
$_SESSION['nro_sol'] = 0;
$_SESSION['cod_sol'] = 0;
$produ = $_SESSION['producto'];
$con_dpro  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 806 and GRAL_PAR_PRO_COD = $produ";
$res_dpro = mysql_query($con_dpro);
while ($lin_dpro = mysql_fetch_array($res_dpro)) {
      $d_pro = $lin_dpro['GRAL_PAR_PRO_DESC']; 
	  }
$consulta  = "Select * From gral_agencia where GRAL_AGENCIA_USR_BAJA is null ";
$resultado = mysql_query($consulta);
$con_top = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 21 and GRAL_PAR_INT_COD <> 0 ";
$res_top = mysql_query($con_top);
$con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD <> 0 ";
$res_mon = mysql_query($con_mon);
$con_fpa = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 13 and GRAL_PAR_INT_COD <> 0";
$res_fpa = mysql_query($con_fpa);
$con_pro  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 806 and GRAL_PAR_PRO_COD <> 0 ";
$res_pro = mysql_query($con_pro);
$con_ofo  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 802 and GRAL_PAR_PRO_COD <> 0 ";
$res_ofo = mysql_query($con_ofo);
$con_zon  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 807 and GRAL_PAR_PRO_COD <> 0 ";
$res_zon = mysql_query($con_zon);
$con_com  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 913 and GRAL_PAR_PRO_COD <> 0 ";
$res_com = mysql_query($con_com);
$con_fco  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 911 and GRAL_PAR_PRO_COD <> 0 ";
$res_fco = mysql_query($con_fco);

$con_cai = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 10 and GRAL_PAR_INT_COD <> 0";
$res_cai = mysql_query($con_cai);

$con_pai = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 11 and GRAL_PAR_INT_COD <> 0";
$res_pai = mysql_query($con_pai);


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
		
   	    <td style="color:#3300CC"><?php echo $d_pro;?></td>
	
 </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
          Alta Solicitud Credito Normal
        </div>
     
		

 </font>
  </strong>
  
 <form name="form2" method="post" action="solic_retro_sol.php" onSubmit="return">
 <table align="center">
   
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
         <td align="left"><select name="cod_ope" size="1" >
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
            <td><strong>Pago de Interes </strong></td>
			<td><?php echo encadenar(5);?></td>
            <td align="left"><select name="cod_pin" size="1"  >
  	            <?php while ($linea = mysql_fetch_array($res_pai)) {?>
                <option value=<?php echo $linea['GRAL_PAR_INT_COD']; ?> >
				<?php echo $linea['GRAL_PAR_INT_DESC']; ?> </option>
	            <?php  }  ?> 
                </select></td>
		</tr> 
	    <tr>
		  <td><strong>Importe Solicitado  </strong></td>
		  <td><?php echo encadenar(5);?></td>
          <td align="rigth"><?php if(isset($datos['imp_sol'])){?>
              <input class="txt_campo" type="text" name="imp_sol" maxlength="12" size="12" value="<?=$datos['imp_sol'];?>" id="imp_sol" > 
              <td><div id="mensaje_imp_sol"></div></td>
              <?php }else{?>
  		      <input class="txt_campo" type="text" name="imp_sol" maxlength="12" size="12" value="" id="imp_sol" >
  		      <td><div id="mensaje_imp_sol"></div></td>
	          <?php }?></td>
		</tr>  
        <tr>
		  <td><strong>Int. Anual % </strong></td>
		  <td><?php echo encadenar(5);?></td>
          <td align="rigth"> <?php if(isset($datos['tas_int'])){?>
              <input class="txt_campo" type="text" name="tas_int" maxlength="8" size="8" value="<?=$datos['tas_int'];?>" id="tas_int" > 
              <td><div id="mensaje_tas_int"></div></td>
	          <?php }else{ ?>
	          <input class="txt_campo" type="text" name="tas_int" maxlength="8" size="8" value="" id="tas_int">
	          <td><div id="mensaje_tas_int"></div></td>
		      <?php } ?></td>
		</tr>   
	    <tr>
		  <td><strong>Plzo Meses</strong></td>
		  <td><?php echo encadenar(5);?></td>
          <td align="rigth"> <?php if(isset($datos['plz_mes'])){?>
              <input class="txt_campo" type="text" name="plz_mes" maxlength="12" size="12" value="<?=$datos['plz_mes'];?>" id="plz_mes"> 
              <td><div id="mensaje_plz_mes"></div></td>
	          <?php }else{ ?>
              <input class="txt_campo" type="text" name="plz_mes" maxlength="12" size="12" value="" id="plz_mes">
              <td><div id="mensaje_plz_mes"></div></td> 
		      <?php }?></td>
		</tr>   
	    <tr>
		  <td><strong>Nro. Cuotas </strong></td>
		  <td><?php echo encadenar(5);?></td>
          <td><?php if(isset($datos['nro_cta'])){?>
              <input class="txt_campo" type="text" name="nro_cta" maxlength="5" size="5" value="<?=$datos['nro_cta'];?>" id="nro_cta" >
              <td><div id="mensaje_nro_cta"></div></td>
		      <?php }else{ ?>
		      <input class="txt_campo" type="text" name="nro_cta" maxlength="5" size="5" value="" id="nro_cta">
		      <td><div id="mensaje_nro_cta"></div></td>
		      <?php }?></td>
		</tr>
		<tr>
		  <td><strong>Fondo Garantia Inicio % </strong></td>
		  <td><?php echo encadenar(5);?></td>
          <td><?php if(isset($datos['aho_ini'])){?>
              <input class="txt_campo" type="text" name="aho_ini" maxlength="8" size="8"  value="<?=$datos['aho_ini'];?>" id="aho_ini"> 
              <td><div id="mensaje_aho_ini"></div></td>
		      <?php }else{ ?>
		      <input class="txt_campo" type="text" name="aho_ini" maxlength="8" size="8"  value="" id="aho_ini">
		      <td><div id="mensaje_aho_ini"></div></td>
		      <?php } ?></td>
		</tr>
		<tr>
           <td><strong>Fondo Garantia Ciclo %  </strong></td>
		   <td><?php echo encadenar(5);?></td>
           <td><?php if(isset($datos['aho_dur'])){?>
               <input class="txt_campo" type="text" name="aho_dur" maxlength="8" size="8" value="<?=$datos['aho_dur'];?>" id="aho_dur"> 
               <td><div id="mensaje_aho_dur"></div></td>
		       <?php }else{ ?>
		       <input class="txt_campo" type="text" name="aho_dur" maxlength="8" size="8" value="" id="aho_dur">
		       <td><div id="mensaje_aho_dur"></div></td>
		       <?php }?></td>
		</tr>
		<tr>
           <td><strong>Fecha Desembolso (dd-mm-aaaa) </strong></td>
		   <td><?php echo encadenar(5);?></td>
		   <td><input class="txt_campo" id="datepicker" type="text" name="fec_des" maxlength="12"  size="12" > 
		   </td>
		</tr>
		<tr>	   
	        <td><strong>Fecha Primer Pago (dd-mm-aaaa) </strong></td>
			<td><?php echo encadenar(5);?></td>
            <td><input class="txt_campo" id="datepicker2" type="text" name="fec_uno" maxlength="12"  size="12" > 
            </td>
		</tr>
		<tr>	   
	      	<td><strong>Hra Reunion (hh:mm) </strong></td>
			<td><?php echo encadenar(5);?></td>
	        <td><?php if(isset($datos['hra_reu'])){?>
                <input class="txt_campo" type="text" name="hra_reu" maxlength="8" size="8" value="<?=$datos['hra_reu'];?>" id="hra_reu">
                <td><div id="mensaje_hra_reu"></div></td> 
	            <?php }else{ ?>
	            <input class="txt_campo" type="text" name="hra_reu" maxlength="8" size="8" value="" id="hra_reu">
	            <td><div id="mensaje_hra_reu"></div></td>
	            <?php } ?></td>
		</tr>
		<tr>	   
	        <td><strong>Dirección Reunion </strong></td>
			<td><?php echo encadenar(5);?></td>
	        <td><?php if(isset($datos['dir_reu'])){?>
                <input class="txt_campo" type="text" name="dir_reu" maxlength="50" size="50" value="<?=$datos['dir_reu'];?>" id="dir_reu"> 
                <td><div id="mensaje_dir_reu"></div></td> 
	            <?php }else{ ?>
	            <input class="txt_campo" type="text" name="dir_reu" maxlength="50" size="50" value="" id="dir_reu">
	            <td><div id="mensaje_dir_reu"></div></td>
	            <?php } ?></td>
		</tr>
	</table>
  <br><br>
	<center>
	
    <input class="btn_form" type="submit" name="accion" value="Grabar">
    <!--input class="btn_form" type="submit" name="accion" value="Salir">
</form>

   <?php
		 	include("footer_in.php");
		 ?> 
</body>
</html>
<?php
}
ob_end_flush();
 ?>