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
                  <li id="menu_modulo_creditos_modificar">
                    
                     <img src="img/clock_32x32.png" border="0" alt="Modulo" align="absmiddle"> SOLICITUD
                    
                 </li>
                   <li id="menu_modulo_fecha">
                    
                     <img src="img/search_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODIFICAR
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
<h2> <img src="img/search_64x64.png" border="0" alt="Modulo" align="absmiddle">MODIFICAR </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
           Modificacion Solicitud Credito Normal
        </div>

		
<?php
 //$fec = leer_param_gral();
 $logi = $_SESSION['login']; 
?> 

<?php
// Se realiza una consulta SQL a tabla gral_param_propios
if (isset($_SESSION['continuar'])){  
   if ( $_SESSION['continuar'] == 2) {
    $cod_s = $_SESSION["cod_sol"];
    }
}

if (isset($_POST['cod_sol'])){  
    $quecom = $_POST['cod_sol'];
	}
if (isset($quecom)){  	
   for( $i=0; $i < count($quecom); $i = $i + 1 ) {
      if( isset($quecom[$i]) ) {
         $cod_s = $quecom[$i];
        }
      }
}
?>
<strong>
<?php
echo  "Solicitud  ". $cod_s. encadenar(2);
$_SESSION["cod_sol"] = $cod_s;
//$_SESSION['msg_err'] = " ";
?>
</strong>
<?php
$con_sol  = "Select * From cred_solicitud where CRED_SOL_CODIGO = $cod_s and CRED_SOL_USR_BAJA is null"; 
$res_sol = mysql_query($con_sol);
while ($lin_sol = mysql_fetch_array($res_sol)) {
      $i_sol = $lin_sol['CRED_SOL_IMPORTE'];
      $i_sol = $lin_sol['CRED_SOL_IMPORTE'];
      $t_op = $lin_sol['CRED_SOL_TIPO_OPER'];
	  $t_int = $lin_sol['CRED_SOL_TASA'];
	  $p_mes = $lin_sol['CRED_SOL_PLZO_M'];
	  $a_ini = $lin_sol['CRED_SOL_AHO_INI'];
	  $a_dur = $lin_sol['CRED_SOL_AHO_DUR'];
	  $n_cta = $lin_sol['CRED_SOL_NRO_CTA'];
	  $f_des = $lin_sol['CRED_SOL_FEC_DES'];
	  $f_uno = $lin_sol['CRED_SOL_FEC_UNO'];
	  $hra_r = $lin_sol['CRED_SOL_HRA_REU'];
	  $dia_r = $lin_sol['CRED_SOL_DIA_REU'];
	  $dir_r = $lin_sol['CRED_SOL_DIR_REU'];
	  $p_int = $lin_sol['CRED_SOL_AHO_F'];
	  $_SESSION['producto'] = $lin_sol['CRED_SOL_PRODUCTO']; 
	  $_SESSION['corre'] = $lin_sol['CRED_SOL_NUMERICO']; 
	  $f_des2= cambiaf_a_normal($f_des); 
	  $f_uno2= cambiaf_a_normal($f_uno);  
	//  echo $f_uno2."fecha uno";
	 //agencia
	  $agen = $lin_sol['CRED_SOL_COD_AGE'];
	  $con_age  = "Select * From gral_agencia where GRAL_AGENCIA_CODIGO = $agen and GRAL_AGENCIA_USR_BAJA is null ";
      $res_age = mysql_query($con_age);
	  while ($linea = mysql_fetch_array($res_age)) {
	  $d_age = $linea['GRAL_AGENCIA_NOMBRE'];
	  }
	//zona
	  $c_zon = $lin_sol['CRED_SOL_ZONA'];
	  $con_zon  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 807 and GRAL_PAR_PRO_COD = $c_zon";
      $res_zon = mysql_query($con_zon);
	  while ($linea = mysql_fetch_array($res_zon)) {
	  $d_zon = $linea['GRAL_PAR_PRO_DESC'];
	  }
	// Tipo Operacion
	  $t_ope = $lin_sol['CRED_SOL_TIPO_OPER'];
	  $con_top = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 21 and GRAL_PAR_INT_COD = $t_ope";
      $res_top = mysql_query($con_top);
	  while ($linea = mysql_fetch_array($res_top)) {
	  $d_top = $linea['GRAL_PAR_INT_DESC'];
	  }
	//Moneda
	  $c_mon = $lin_sol['CRED_SOL_COD_MON'];
	  $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD = $c_mon";
      $res_mon = mysql_query($con_mon);
	  while ($linea = mysql_fetch_array($res_mon)) {
	        $d_mon = $linea['GRAL_PAR_INT_DESC'];
	  }
	 //Producto
	   $c_pro = $lin_sol['CRED_SOL_PRODUCTO'];
	   $con_pro  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 806 and GRAL_PAR_PRO_COD = $c_pro";
       $res_pro = mysql_query($con_pro);
	   while ($linea = mysql_fetch_array($res_pro)) {
	         $d_pro = $linea['GRAL_PAR_PRO_DESC'];
	   }
	   echo "Producto ".$d_pro;
	 //Forma de Pago
	   $c_fpa = $lin_sol['CRED_SOL_FORM_PAG']; 
	   $con_fpa = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 13 and GRAL_PAR_INT_COD = $c_fpa";
       $res_fpa = mysql_query($con_fpa);
	   while ($linea = mysql_fetch_array($res_fpa)) {
	        $d_fpa = $linea['GRAL_PAR_INT_DESC'];
	   }
	   //Calculo Interes
	   $c_int = $lin_sol['CRED_SOL_CAL_INT'];
	   $con_cin = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 10 and GRAL_PAR_INT_COD = $c_int";
       $res_cin = mysql_query($con_cin);
	   while ($linea = mysql_fetch_array($res_cin)) {
	        $d_cin = $linea['GRAL_PAR_INT_DESC'];
	   }
	   
	   $p_int = $lin_sol['CRED_SOL_AHO_F'];
	   $con_pin = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 11 and GRAL_PAR_INT_COD = $p_int";
       $res_pin = mysql_query($con_pin);
	   while ($linea = mysql_fetch_array($res_pin)) {
	        $d_pin = $linea['GRAL_PAR_INT_DESC'];
	   }
	     
	   
	   	 //Origen de Fondos
	   $c_ofo = $lin_sol['CRED_SOL_ORG_FON']; 
	   $con_ofo  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 802 and GRAL_PAR_PRO_COD = $c_ofo";
       $res_ofo = mysql_query($con_ofo);
	   while ($linea = mysql_fetch_array($res_ofo)) {
	         $d_ofo = $linea['GRAL_PAR_PRO_DESC'];
	   }
    //Comision
	  $c_com = $lin_sol['CRED_SOL_TIP_COM']; 
	  $con_com  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 913 and GRAL_PAR_PRO_COD = $c_com";
      $res_com = mysql_query($con_com);
      while ($linea = mysql_fetch_array($res_com)) {
	         $d_com = $linea['GRAL_PAR_PRO_DESC'];
	   }
      //Comision forma de cobro
	  $c_fco = $lin_sol['CRED_SOL_COM_F']; 
	  $con_fco  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 911 and GRAL_PAR_PRO_COD = $c_fco";
      $res_fco = mysql_query($con_fco);
      while ($linea = mysql_fetch_array($res_fco)) {
	         $d_fco = $linea['GRAL_PAR_PRO_DESC'];
	   }
      $_SESSION['cod_sol'] = $cod_s;
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

if (isset($_SESSION['form_buffer'])){ 
    $datos = $_SESSION['form_buffer'];
	}
 ?>
<form name="form1" method="post" action="solic_retro_sol.php" style="border:groove" target="_self"  >
<table align="center">
<tr>
   <td><strong>Agencia   </strong></td>
   <td><font color= color="#FF0000">
    <?php echo $d_age;?> 
   </font color></td>
   <td> <select name="cod_agencia" size="1"  >
   	  <?php while ($linea = mysql_fetch_array($resultado)) {?>
            <option value=<?php echo $linea['GRAL_AGENCIA_CODIGO']; ?>>
			<?php echo $linea['GRAL_AGENCIA_NOMBRE']; ?> </option>
	  <?php } ?>
  </select></td>
</tr>
 <tr>
   <td><strong>Zona </strong></td>
   <td><font color= color="#FF0000">
       <?php echo $d_zon; ?> 
       </font color> </td>
  <td><select name="cod_zon" size="1"  >
  	  <?php while ($linea = mysql_fetch_array($res_zon)) { ?>
            <option value=<?php echo $linea['GRAL_PAR_PRO_COD']; ?>>
	  <?php echo $linea['GRAL_PAR_PRO_DESC']; ?> </option>
	  <?php } ?> 
      </select></td>
</tr>
 <tr>	  
    <td> <strong>Moneda </strong></td>
    <td> <font color= color="#FF0000">
		 <?php echo $d_mon; ?> 
		   </font color></td>
    <td><select name="cod_mon" size="1"  >
   	    <?php while ($linea = mysql_fetch_array($res_mon)) { ?>
        <option value=<?php echo $linea['GRAL_PAR_INT_COD']; ?>>
		<?php echo $linea['GRAL_PAR_INT_DESC']; ?></option>
	     <?php } ?>
		</select> </td>
</tr>		
 <tr> 
    <td><strong>Tipo Operacion </strong></td>
    <td><font color= color="#FF0000">
        <?php echo $d_top; ?> 
	    </font color></td> 
    <td><select name="tip_ope" size="1" accesskey="click">
   	    <?php while ($linea = mysql_fetch_array($res_top)) { ?>
        <option value=<?php echo $linea['GRAL_PAR_INT_COD']; ?>>
		<?php echo $linea['GRAL_PAR_INT_DESC']; ?></option>
	    <?php } ?>
         </select> </td>
</tr>
<tr>		 
	<td><strong>Origen de Fondos </strong></td>
    <td><font color= color="#FF0000">
        <?php echo $d_ofo; ?> 
        </font color></td>
    <td><select name="cod_ofo" size="1"  >
  	    <?php while ($linea = mysql_fetch_array($res_ofo)) { ?>
        <option value=<?php echo $linea['GRAL_PAR_PRO_COD']; ?>>
	    <?php echo $linea['GRAL_PAR_PRO_DESC']; ?> </option>
	    <?php  } ?> 
        </select></td>
</tr>		
<tr>	
	<td><strong>Comision  </strong></td>
	<td><font color= color="#FF0000">
	    <?php echo $d_com;?> 
	    </font color></td>
    <td><select name="cod_com" size="1"  >
  	    <?php while ($linea = mysql_fetch_array($res_com)) { ?>
        <option value=<?php echo $linea['GRAL_PAR_PRO_COD']; ?>>
	    <?php echo $linea['GRAL_PAR_PRO_DESC']; ?> </option>
	    <?php  }  ?> 
        </select> </td>
</tr>
<tr>
   <td><strong>Cobro Comision  </strong></td>
   <td><font color= color="#FF0000">
       <?php  echo $d_fco; ?> 
	   </font color></td>
   <td><select name="cod_ccom" size="1"  >
  	   <?php while ($linea = mysql_fetch_array($res_fco)) { ?>
       <option value=<?php echo $linea['GRAL_PAR_PRO_COD']; ?>>
	   <?php echo $linea['GRAL_PAR_PRO_DESC']; ?> </option>
	   <?php   }  ?> 
       </select> </td>
</tr>
<tr>	   
   <td><strong>Forma Pago </strong></td>
   <td><font color= color="#FF0000">
       <?php echo $d_fpa;?>
	   </font color></td>	   
   <td><select name="cod_fpa" size="1"  >
  	   <?php while ($linea = mysql_fetch_array($res_fpa)) { ?>
       <option value=<?php echo $linea['GRAL_PAR_INT_COD']; ?>>
	   <?php echo $linea['GRAL_PAR_INT_DESC']; ?> </option>
	   <?php } ?> 
       </select></td>
</tr>	   
<tr>
    <td><strong>Calculo Interes </strong></td>
	<td><font color= color="#FF0000">
        <?php echo $d_cin; ?>
	    </font color> </td>
    <td><select name="cod_cin" size="1"  >
  	    <?php while ($linea = mysql_fetch_array($res_cai)) {?>
        <option value=<?php echo $linea['GRAL_PAR_INT_COD']; ?>>
	    <?php echo $linea['GRAL_PAR_INT_DESC']; ?> </option>
	    <?php  }  ?> 
        </select> </td>
</tr>
<tr>
    <td><strong>Pago Interes </strong></td>
	<td><font color= color="#FF0000">
        <?php echo $d_pin; ?>
	    </font color> </td>
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
    <td><?php $datos['imp_sol'] = $i_sol;?>
        <input class="txt_campo" type="text" name="imp_sol" width="10" value="<?=$datos['imp_sol'];?>" > </td>
</tr>
<tr>		 
   <td><strong>Int. Anual % </strong></td>
   <td><?php echo encadenar(5);?></td>
   <td><?php $datos['tas_int'] =  $t_int; ?>
       <input class="txt_campo" type="text" name="tas_int"maxlength="8" size="8" 
	    value="<?=$datos['tas_int'];?>" > </td>
</tr>
<tr>		
   <td><strong>Plzo Meses</strong></td>
   <td><?php echo encadenar(5);?></td>
   <td><?php $datos['plz_mes'] = $p_mes; ?>
       <input class="txt_campo" type="text" name="plz_mes" maxlength="5" size="5" 
	   value="<?=$datos['plz_mes'];?>" > </td>
</tr>
<tr>
	<td><strong>Nro. Cuotas </strong></td>
	<td><?php echo encadenar(5);?></td>
    <td><?php $datos['nro_cta'] = $n_cta; ?>
        <input class="txt_campo" type="text" name="nro_cta" maxlength="5" size="5"
		value="<?=$datos['nro_cta'];?>" ></td>
</tr>		
<tr>    
    <td><strong>Formularios Inicio % </strong></td>
    <td><?php echo encadenar(5);?></td>
    <td><?php $datos['aho_ini'] =  number_format($a_ini, 2, '.',',');?>
         <input class="txt_campo" type="text" name="aho_ini" value="<?=$datos['aho_ini'];?>" > </td>
</tr>
<tr>	
    <td><strong>Formularios Ciclo %  </strong></td>
    <td><?php echo encadenar(5);?></td>
    <td><?php $datos['aho_dur'] = $a_dur; ?>	   
        <input class="txt_campo" type="text" name="aho_dur" value="<?=$datos['aho_dur'];?>" ></td>
</tr>		
<tr>	 
	<td><strong>Fecha Desembolso </strong></td>
	<td><?php echo encadenar(5);?></td>
	<td><?php $datos['fec_des'] = $f_des2; ?>	   
        <input class="txt_campo" type="text" name="fec_des" maxlength="12"
	    size="12" value="<?=$datos['fec_des'];?>" ></td>
</tr>		
<tr>
    <td><strong>Fecha Primer Pago </strong></td>
    <td><?php echo encadenar(5);?></td> 
	<td><?php $datos['fec_uno'] = $f_uno2; ?>	   
        <input class="txt_campo" type="text" name="fec_uno" maxlength="12"
	    size="12" value="<?=$datos['fec_uno'];?>" ></td>
</tr>		 
<tr>	 
	<td><strong>Hra Reunion (hh:mm) </strong></td>
	<td><?php echo encadenar(5);?></td>
	<td><?php $datos['hra_reu'] = $hra_r;
	     //    echo $datos['hra_reu']." ".$hra_r ?>	   
        <input class="txt_campo" type="text" name="hra_reu" maxlength="12"
	    size="12" value="<?=$datos['hra_reu'];?>" ></td>
</tr>
<tr>
    <td><strong>Dirección Reunion </strong></td>
	<td><?php echo encadenar(5);?></td>
	<td><?php $datos['dir_reu'] = $dir_r; ?>	   
        <input class="txt_campo" type="text" name="dir_reu" maxlength="50" size="50" value="
		<?=$datos['dir_reu'];?>" > </td>
</tr>
	</table> 
  <br><br>
	<center>  
    <input class="btn_form" type="submit" name="accion" value="Registrar Cambios">
    <input class="btn_form" type="submit" name="accion" value="Salir">
</form>
<strong>
 <?php
 if (isset($_SESSION['msg_err'])){ 
     echo $_SESSION['msg_err']; 
	 }
 ?>
 </strong>

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
