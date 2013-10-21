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
<title>Mantenimiento Solicitud Acople</title>
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
                    
                     <img src="img/add user_32x32.png" border="0" alt="Modulo" align="absmiddle"> ACOPLE
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
<h2> <img src="img/add user_64x64.png" border="0" alt="Modulo" align="absmiddle">ACOPLE </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
           Alta Solicitud Credito Adicional
        </div>
     
 <?php
       //$fec = leer_param_gral();
       $logi = $_SESSION['login']; 
     ?>

<?php
// Se realiza una consulta SQL a tabla gral_param_propios
if(isset($_SESSION['continuar'])){
   if ($_SESSION['continuar'] == 2) {
    $cod_c = $_SESSION["cod_cre"];
   }
 }
$datos['imp_sol'] = 0;
	$datos['plz_mes'] = 0;
	$datos['nro_cta'] =0;
$quecom = $_POST['cod_cre'];
for( $i=0; $i < count($quecom); $i = $i + 1 ) {
 if( isset($quecom[$i]) ) {
    $cod_c = $quecom[$i];
    $_SESSION["cod_cre"] = $cod_c; }
}
?>


	  <?php
// echo $cod_c;

//$_SESSION['msg_err'] = " ";
?>

</strong>
<?php
$con_sol  = "Select * From cred_solicitud where CRED_SOL_NRO_CRED = $cod_c and CRED_SOL_USR_BAJA is null"; 
$res_sol = mysql_query($con_sol);
while ($lin_sol = mysql_fetch_array($res_sol)) {
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
	  $grupo = $lin_sol['CRED_SOL_COD_GRUPO'];
	  $f_des2= cambiaf_a_normal($f_des); 
	  $f_uno2= cambiaf_a_normal($f_uno);  
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
	   $c_pro = $_SESSION['producto'];
	  // $c_pro = $lin_sol['CRED_SOL_PRODUCTO'];
	   $con_pro  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 806 and GRAL_PAR_PRO_COD = $c_pro";
       $res_pro = mysql_query($con_pro);
	   while ($linea = mysql_fetch_array($res_pro)) {
	         $d_pro = $linea['GRAL_PAR_PRO_DESC'];
	   }
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
	   //Grupo
	   $con_g_nom  = "Select CRED_GRP_NOMBRE from cred_grupo where CRED_GRP_CODIGO = $grupo and CRED_GRP_USR_BAJA is null ";
       $res_g_nom = mysql_query($con_g_nom);
       while ($lin_g_nom = mysql_fetch_array($res_g_nom)) {
             $nom_grp = $lin_g_nom ['CRED_GRP_NOMBRE'];
	   }
	    ?>
		<strong>
	   <?php
	  // echo "Grupo".encadenar(3).$nom_grp;
	   ?>

</strong>
<?php
		$con_car  = "Select * From cart_maestro, cart_deudor, cliente_general
             where CART_NRO_CRED = $cod_c and CART_DEU_NCRED = CART_NRO_CRED
             and CLIENTE_COD_ID = CART_DEU_ID and CART_DEU_RELACION = 'C' 
			 and CART_DEU_USR_BAJA is null and  CART_MAE_USR_BAJA is null"; 
             $res_car = mysql_query($con_car);
 
             while ($lin_car = mysql_fetch_array($res_car)) {
			        $mon = $lin_car['CART_COD_MON'];
			        $c_grup = $lin_car['CART_COD_GRUPO']; 
					$tcred = $lin_car['CART_TIPO_CRED'];
					$asesor = $lin_car['CART_OFIC_RESP'];
					$tip_ope = $lin_car['CART_TIPO_OPER'];
                    $nom_pres = $lin_car['CLIENTE_AP_PATERNO'].encadenar(1).
					$lin_car['CLIENTE_AP_MATERNO'].encadenar(1).
					$lin_car['CLIENTE_AP_ESPOSO'].encadenar(1).
					$lin_car['CLIENTE_NOMBRES'].encadenar(1);  
			
}
	 
	 ?>
	
	 <?php
	 //}
if(isset($cod_s)){	 
      $_SESSION['cod_sol'] = $cod_s;
	  }
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
//Plan de pagos credito
$con_pdp  = "Select * From cart_plandp where CART_PLD_NCRE = $cod_c and CART_PLD_USR_BAJA is null order by 4 ";
$res_pdp = mysql_query($con_pdp);

if(isset($_SESSION['form_buffer'])){
   $datos = $_SESSION['form_buffer'];
  }
 $produ = $_SESSION['producto'];
$con_dpro  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 806 and GRAL_PAR_PRO_COD = $produ";
$res_dpro = mysql_query($con_dpro);
while ($lin_dpro = mysql_fetch_array($res_dpro)) {
      $d_pro = $lin_dpro['GRAL_PAR_PRO_DESC']; 
	  $_SESSION['d_pro'] = $d_pro;
	  }
  
 ?>
 <center>
 <form name="form2" method="post" action="solic_retro_sol.php" onSubmit="return ValidarCamposAdicional(this)">
   <table align="center">
    <tr>
        <td><strong>Tipo Operacion  </strong></td>
		<td style="color:#3300CC"><?php echo $d_pro;?></td>
	</tr>
    <tr> 
      <th align="left"><?php echo  "Credito Nro.";?></th>
	  <td align="left"><?php echo $cod_c;?></td>
	</tr>
	<tr>   
	  <th align="left"><?php echo  "Grupo";?></th>
	  <td align="left"><?php echo $nom_grp;?></td>
	</tr> 
	<tr>   
	  <th align="left" ><?php echo "Coordinador";?></th>
	  <td align="left"><?php echo $nom_pres;?></td>
	</tr> 
	<tr>   
	  <th align="left"><?php echo "Zona";?></th>
	  <td align="left"><?php echo $d_zon;?></td>
	</tr> 
	 <tr>   
	  <th align="left"><?php echo "Tipo Operacion";?></th>
	  <td align="left"><?php echo $d_top;?></td>
	</tr> 
     <tr>   
	  <th align="left"><?php echo "Producto";?></th>
	  <td align="left"><?php echo $d_pro;?></td>
	</tr> 
    <tr>   
	  <th align="left"><?php echo "Moneda";?></th>
	  <td align="left"><?php echo $d_mon;?></td>
	</tr> 
	 <tr>   
	  <th align="left"><?php echo "Comision";?></th>
	  <td align="left"><?php echo $d_com;?></td>
	</tr> 
	<tr>   
	  <th align="left"><?php echo "Cobro Comision";?></th>
	  <td align="left"><?php echo $d_fco;?></td>
	</tr> 
    <tr>   
	  <th align="left"><?php echo "Origen Fondos";?></th>
	  <td align="left"><?php echo $d_ofo;?></td>
	</tr>  
 	 <tr>   
	  <th align="left"><?php echo "Forma Pago";?></th>
	  <td align="left"><?php echo $d_fpa;?></td>
	</tr>  
     <tr>   
	  <th align="left"><?php echo "Calculo Interes";?></th>
	  <td align="left"><?php echo $d_cin;?></td>
	</tr>  
 	<tr>   
	  <th align="left"><?php echo "Plazo en Meses ";?></th>
	  <td align="left"><?php echo $p_mes;?></td>
	</tr>  
	 <tr>   
	  <th align="left"><?php echo "Numero de Cuotas ";?></th>
	  <td align="left"><?php echo $n_cta;?></td>
	</tr>  
	 <tr>   
	 <?php
            $a_ini2 =  number_format($a_ini, 2, '.',',');
		      
          ?>
	  <th align="left"><?php echo "Fondo Garantia Inicio ";?></th>
	  <td align="left"><?php echo encadenar(3).$a_ini2.encadenar(2)."%".encadenar(3);;?></td>
	</tr>  
	  <tr>   
	 <?php
           $a_dur2 =  number_format($a_dur, 2, '.',',');
		      
          ?>
	  <th align="left"><?php echo "Fondo Garantia Ciclo";?></th>
	  <td align="left"><?php echo encadenar(3).$a_dur2.encadenar(2)."%".encadenar(3);;?></td>
	</tr>  
    <tr>   
	 <?php
           $t_int2 =  number_format($t_int, 2, '.',',');
		      
          ?>
	  <th align="left"><?php echo "Interes Anual";?></th>
	  <td align="left"><?php echo encadenar(3).$t_int2.encadenar(2)."%".encadenar(3);;?></td>
	</tr>  
	 <tr>   
	  <th align="left"><?php echo "Hra Reunion (hh:mm)";?></th>
	  <td align="left"><?php echo encadenar(3).$hra_r.encadenar(3); ?></td>
	</tr>  
      <tr>   
	  <th align="left"><?php echo "Dirección Reunion";?></th>
	  <td align="left"><?php echo encadenar(3).$dir_r.encadenar(3); ?></td>
	</tr> 
	<tr>   
	  <th align="left"><?php echo "Importe Solicitado";?></th>
	  <td align="left"><?php if(isset($datos['imp_sol'])){?>
                <input type="text" name="imp_sol" width="10" value="<?=$datos['imp_sol'];?>" > 
		   <?php }else{?>
		         <input type="text" name="imp_sol" width="10" value="" > 
		   <?php }?></td>
	</tr>    
	<tr>   
	  <th align="left"><?php echo "Plzo Meses";?></th>
	  <td  align="center"> <?php if(isset($datos['plz_mes'])){?>
                <input type= type="text" name="plz_mes" maxlength="5" size="5" value="<?=$datos['plz_mes'];?>" > 
		  <?php }else{?>
		        <input type= type="text" name="plz_mes" maxlength="5" size="5" value="" > 
		  <?php }?></td>
	</tr>    	 
     <tr>   
	  <th align="left"><?php echo "Nro. Cuotas";?></th>
	  <td align="center">  <?php if(isset($datos['nro_cta'])){?>
                <input type= type="text" name="nro_cta" maxlength="5" size="5" value="<?=$datos['nro_cta'];?>" >
				 <?php }else{?>
				 <input type= type="text" name="nro_cta" maxlength="5" size="5" value="" >
		   <?php }?></td>
	</tr>    
      <tr>   
	  <th align="left"><?php echo "Fecha Desembolso";?></th>
	  <td align="center">  <input type="text" name="fec_des" maxlength="10"  size="10" > <script language="JavaScript">
            new tcal ({
                // form name
                'formname': 'form2',
                // input name
                'controlname': 'fec_des'
            });
            </script></td>
	</tr>  
	<tr>     
     <th align="left"><?php echo "Fecha Primer Pago";?></th>
	  <td align="center">  <select name="fec_uno" size="1"  >
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
  </table>
<center>	  
   <input type="submit" name="accion" value="Registrar Acople">
    <input type="submit" name="accion" value="Salir">
</form>
</div>
<strong>
 <?php
 if(isset($_SESSION['msg_err'])){
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