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
	<?php
	   include("header.php");
 	 ?>
<div id="pagina_sistema">
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
                    
                     <img src="img/add user_32x32.png" border="0" alt="Modulo" align="absmiddle"> OPORTUNIDAD
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
<h2> <img src="img/add user_64x64.png" border="0" alt="Modulo" align="absmiddle">OPORTUNIDAD</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
           Alta Solicitud Credito Oportunidad
        </div>
     
		
<?php
 //$fec = leer_param_gral();
 $logi = $_SESSION['login']; 
 $mes = saca_mes($fec);
 $dia = saca_dia($fec);
 $anio = saca_anio($fec);
 //echo "  ", dia_semana($dia, $mes, $anio); 
?> 

<?php
// Se realiza una consulta SQL a tabla gral_param_propios
  $ncre = $_POST['ncre'];
 //for( $i=0; $i < count($quecom); $i = $i + 1 ) {
  // if (isset($quecom[$i])) {
   //   $ncre = $quecom[$i];
  $_SESSION['ncre'] = $ncre;
    //  }
  // }
 $con_car  = "Select * From cart_maestro where CART_NRO_CRED = $ncre
             and  CART_MAE_USR_BAJA is null "; 
 $res_car = mysql_query($con_car);
 while ($lin_car = mysql_fetch_array($res_car)) {
       $c_grup = $lin_car['CART_COD_GRUPO'];
	   $t_op = $lin_car['CART_TIPO_OPER'];
	   $d_reu = $lin_car['CART_DIA_REU'];
	   $h_reu = $lin_car['CART_HR_REU'];
	   $l_reu = $lin_car['CAR_DIR_REU'];
	   if ($t_op < 3){
           $con_grup  = "Select * From cred_grupo where CRED_GRP_CODIGO = $c_grup
		                 and CRED_GRP_USR_BAJA is null";
           $res_grup = mysql_query($con_grup);
	       while ($lin_grup = mysql_fetch_array($res_grup)) {
	              $nom_grup  = $lin_grup['CRED_GRP_NOMBRE'];
				  $_SESSION['c_grup']= $c_grup;
	        }   			
	   }else{
	         $_SESSION['c_grup']= 0;
			 $nom_grup = "";
			 }					
	} 
  
$produ = $_SESSION['producto'];
$con_dpro  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 806 and GRAL_PAR_PRO_COD = $produ";
$res_dpro = mysql_query($con_dpro);
while ($lin_dpro = mysql_fetch_array($res_dpro)) {
      $d_pro = $lin_dpro['GRAL_PAR_PRO_DESC']; 
	  $_SESSION['d_pro'] = $d_pro;
	  }
$consulta  = "Select * From gral_agencia where GRAL_AGENCIA_USR_BAJA is null ";
$resultado = mysql_query($consulta);
$con_top = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 21 and GRAL_PAR_INT_COD <> 0 ";
$res_top = mysql_query($con_top);
$con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD <> 0 ";
$res_mon = mysql_query($con_mon);
$con_fpa = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 13 and GRAL_PAR_INT_COD = 8";
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

$con_pdp  = "Select * From cart_plandp where CART_PLD_NCRE = $ncre and CART_PLD_USR_BAJA is null order by 4 ";
$res_pdp = mysql_query($con_pdp);
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
        <td><strong>Tipo Operacion  </strong></td>
		<td><?php echo encadenar(5);?></td>
   	    <td style="color:#3300CC"><?php echo $d_pro;?></td>
	</tr>
	<tr>
        <td><strong>Relacionado a Credito  </strong></td>
		<td><?php echo encadenar(5);?></td>
   	    <td style="color:#3300CC"><?php echo $_SESSION['ncre'];?></td>
	</tr>
	<tr>
        <td><strong>Grupo  </strong></td>
		<td><?php echo encadenar(5);?></td>
   	    <td style="color:#3300CC"><?php echo $nom_grup;?></td>
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
		 <th align="left"><?php echo "Fecha Primer Pago";?></th>
		 <td><?php echo encadenar(5);?></td>
	     <td >  <select name="fec_uno" size="1"  >
  	      <?php
           while ($linea = mysql_fetch_array($res_pdp)) {
		        $f_pag = $linea['CART_PLD_FECHA'];
				$linea['CART_PLD_FECHA'] = cambiaf_a_normal($f_pag);
          ?>
          <option value=<?php echo $linea['CART_PLD_FECHA']; ?>><?php echo $linea['CART_PLD_FECHA']; ?> </option>
	      <?php
            }
          ?> 
      </select></td>
	</tr> 
		<tr>	   
	      	<td><strong>Hra Reunion (hh:mm) </strong></td>
			<td><?php echo encadenar(5);?></td>
	        <td><?php if(isset($datos['hra_reu'])){?>
                <input type="text" name="hra_reu" maxlength="8" size="8"
				 value="<?php echo $h_reu;?>" > 
	            <?php }else{ ?>
	            <input type="text" name="hra_reu" maxlength="8" size="8" 
				value= " <?php echo $h_reu; ?>" >
	            <?php } ?></td>
		</tr>
		<tr>	   
	        <td><strong>Dirección Reunion </strong></td>
			<td><?php echo encadenar(5);?></td>
	        <td><?php if(isset($datos['dir_reu'])){?>
                <input type="text" name="dir_reu" maxlength="50" size="50"
				       value="<?php echo $l_reu;?>" >  
	            <?php }else{ ?>
	            <input type="text" name="dir_reu" maxlength="50" size="50" 
				       value="<?php echo $l_reu;?>" >
	            <?php } ?></td>
		</tr>
		
	</table>
  <br><br>
	<center>
	
    <input class="btn_form" type="submit" name="accion" value="Grab-Oportunidad">
    <input class="btn_form" type="submit" name="accion" value="Salir">
</form>

  
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