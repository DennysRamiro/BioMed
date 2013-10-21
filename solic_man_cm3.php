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
<title>Consulta Creditos </title>
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
           Alta de Solicitudes
        </div>
    	
<?php
 //$fec = leer_param_gral();
 $logi = $_SESSION['login']; 
 $_SESSION['calculo'] = 1; 
?> 
	
<font size="+1">
<div id="TableModulo">
 <table width="50%"  border="0" cellspacing="1" cellpadding="1" align="center">
   <tr>
      <th width="22%" scope="col" style="font-size:10px"><border="0" alt="" align="absmiddle" />NRO. CREDITO</th>
	  <th width="25%" scope="col" style="font-size:10px"><border="0" alt="" align="absmiddle" />TITULAR/COORDINADORA</th>
      <th width="20%" scope="col" style="font-size:10px"><border="0" alt="" align="absmiddle" />GRUPO</th>
      <th width="25%" scope="col" style="font-size:10px"><border="0" alt="" align="absmiddle" />IMP. DESEM.</th>
	  <th width="25%" scope="col" style="font-size:10px"><border="0" alt="" align="absmiddle" />SALDO</th>
	  <th width="32%" scope="col" style="font-size:10px"><border="0" alt="" align="absmiddle" />MONEDA</th>
	  <th width="32%" scope="col" style="font-size:10px"><border="0" alt="" align="absmiddle" />ESTADO</th>
	  <th width="32%" scope="col" style="font-size:10px" ><border="0" alt="" align="absmiddle" />TIPO OPERACION</th>
	  <th width="20%" scope="col"style="font-size:10px" ><border="0" alt="" align="absmiddle" />SELECCIONAR</th>
	 
	  </tr>
	<form name="form2" method="post" action="cobro_retro_opd.php" style="border:groove" onSubmit=""> 
<?php
//$_SESSION['form_buffer'] = $_POST;
$log_usr = $_SESSION['login']; 
$cod_cre = 0;
$f_cal = "";
$f_has ="";
$mon="";
$imp_ind = 0;
$imp_cta = 0;

$_SESSION['grupo'] = "";
if(isset($_SESSION['f_has'])){
  $f_has = $_SESSION['f_has'];
  }
 $cod_usr = $_SESSION['cod_usr'];
//$imp_sol = $_SESSION["impo_sol"];
echo  "Asesor ".encadenar(2).$_SESSION['nom_com'];
$total = 0;
/*
 */  
$con_cli  = "Select CART_NRO_CRED,CART_IMPORTE,CART_COD_MON, CART_TIPO_OPER, CART_ESTADO,
             CART_COD_GRUPO, CART_PRODUCTO,CART_TIPO_CRED,CART_OFIC_RESP
             From cart_maestro where 
             (CART_OFIC_RESP = '$log_usr' or CART_OFIC_RESP = '$cod_usr')
              and CART_ESTADO  < 7 and (CART_TIPO_OPER = 1 or CART_TIPO_OPER = 3) 
			  and CART_MAE_USR_BAJA is null"; 
$res_cli = mysql_query($con_cli);
   while ($lin_car = mysql_fetch_array($res_cli)){
          $mon_pag = 0;
		  $c_grup = 0;
		  $_SESSION['grupo'] = "";
		  $nom_grp = "";
          $cod_ncre = $lin_car['CART_NRO_CRED'];
		  $mon_pag = montos_recuperados($cod_ncre,$fec,1); 
		  $impo = $lin_car['CART_IMPORTE'];
		  $mon = $lin_car['CART_COD_MON'];
	      $tope = $lin_car['CART_TIPO_OPER'];
	      $est =  $lin_car['CART_ESTADO'];
	      $c_grup = $lin_car['CART_COD_GRUPO'];
		  $t_prod = $lin_car['CART_PRODUCTO'];
		  $t_cred = $lin_car['CART_TIPO_CRED'];
		  $asesor = $lin_car['CART_OFIC_RESP'];
		  $nom_ases = leer_nombre_usr($t_cred,$asesor);
			
			$con_deu  = "Select CLIENTE_AP_PATERNO, CLIENTE_AP_MATERNO,
			             CLIENTE_AP_ESPOSO,CLIENTE_NOMBRES
			  From cart_deudor, cliente_general
             where CART_DEU_NCRED = $cod_ncre
             and CLIENTE_COD_ID = CART_DEU_ID and CART_DEU_RELACION = 'C' 
			 and CART_DEU_USR_BAJA is null "; 
             $res_deu = mysql_query($con_deu);
             while ($lin_deu = mysql_fetch_array($res_deu)) {
			       // $c_grup = 0;
					//$nom_ases = "";
	                $nom_cli = $lin_deu['CLIENTE_AP_PATERNO'].encadenar(1).
					$lin_deu['CLIENTE_AP_MATERNO'].encadenar(1).
					$lin_deu['CLIENTE_AP_ESPOSO'].encadenar(1).
					$lin_deu['CLIENTE_NOMBRES'].encadenar(1); 
		
		      }
			 
	/*	    */      
				 
		$con_dpro  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 806 and GRAL_PAR_PRO_COD = $t_prod";
        $res_dpro = mysql_query($con_dpro);
        while ($lin_dpro = mysql_fetch_array($res_dpro)) {
               $d_pro = $lin_dpro['GRAL_PAR_PRO_DESC']; 
	     }
		$con_dope  = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 21 and GRAL_PAR_INT_COD = $tope";
        $res_dope = mysql_query($con_dope);
        while ($lin_dope = mysql_fetch_array($res_dope)) {
               $d_ope = $lin_dope['GRAL_PAR_INT_DESC']; 
	     }
if ($c_grup > 0){		      
		$con_grp = "Select * From cred_grupo where CRED_GRP_CODIGO = $c_grup and CRED_GRP_USR_BAJA is null";
        $res_grp = mysql_query($con_grp);
	    while ($lin_grp = mysql_fetch_array($res_grp)) {
	        $nom_grp = $lin_grp['CRED_GRP_NOMBRE'];
			$_SESSION['grupo'] = $nom_grp;
			}		 
		}	
		$con_est  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 809 and GRAL_PAR_PRO_COD = $est";
        $res_est = mysql_query($con_est);
	      while ($linea = mysql_fetch_array($res_est)) {
	             $d_est = $linea['GRAL_PAR_PRO_DESC'];
	             $s_est =  $linea['GRAL_PAR_PRO_SIGLA'];
	         }  
			 
       $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD = $mon";
       $res_mon = mysql_query($con_mon);
	   while ($linea = mysql_fetch_array($res_mon)) {
	        $d_mon = $linea['GRAL_PAR_INT_DESC'];
	   }
    	?>
		       <?php if ($tope == 1){ ?>
			       	<td bgcolor="#66CCFF"><?php echo $cod_ncre; ?></td>
					<td bgcolor="#66CCFF"><?php echo $nom_cli; ?></td>
                    <td bgcolor="#66CCFF"><?php echo $nom_grp; ?></td>
                    <td bgcolor="#66CCFF"><?php echo number_format($impo, 2, '.',',');  ?></td>
					<td bgcolor="#66CCFF"><?php echo number_format($impo - $mon_pag, 2, '.',',');                 ?></td>
					<td bgcolor="#66CCFF"><?php echo $d_mon; ?></td>
					<td bgcolor="#66CCFF"><?php echo $s_est;  ?></td>
                    <td bgcolor="#66CCFF"><?php echo $d_ope; ?></td>
					<td><INPUT NAME="ncre" TYPE=RADIO VALUE="<?php echo $cod_ncre; ?>">	</td> 


					<?php }?>
				 <?php if ($tope == 2){ ?>
				    <td bgcolor="#FFFF33"><?php echo $cod_ncre; ?></td>
					<td bgcolor="#66CCFF"><?php echo $nom_cli; ?></td>
                    <td bgcolor="#FFFF33"><?php echo $nom_grp; ?></td>
                    <td bgcolor="#FFFF33"><?php echo number_format($impo, 2, '.',',');  ?></td>
					<td bgcolor="#FFFF33"><?php echo number_format($impo - $mon_pag, 2, '.',',');  ?></td>
					<td bgcolor="#FFFF33" ><?php echo $d_mon; ?></td>
					<td bgcolor="#FFFF33"><?php echo $s_est;  ?></td>
                    <td bgcolor="#FFFF33"><?php echo $d_ope; ?></td>
					<td><INPUT NAME="ncre" TYPE=RADIO VALUE="<?php echo $cod_ncre; ?>"></td>  
					<?php }?>
					<?php if ($tope == 3){ ?>
					<td  bgcolor="#66CC66"><?php echo $cod_ncre; ?></td>
					 <td bgcolor="#66CC66"><?php echo $nom_cli; ?></td>
                    <td bgcolor="#66CC66"><?php echo $nom_grp; ?></td>
                    <td bgcolor="#66CC66"><?php echo number_format($impo, 2, '.',',');  ?></td>
					<td bgcolor="#66CC66"><?php echo number_format($impo - $mon_pag, 2, '.',',');  ?></td>
					<td bgcolor="#66CC66" ><?php echo $d_mon; ?></td>
					<td bgcolor="#66CC66"><?php echo $s_est;  ?></td>
                    <td bgcolor="#66CC66"><?php echo $d_ope; ?></td>
					<td><INPUT NAME="ncre" TYPE=RADIO VALUE="<?php echo $cod_ncre; ?>"></td> 
					<?php }?>		
					
		</font>			
	 </tr>
                  <?php }?>
               
                </table>
            </div id="TableModulo2">
	<input class="btn_form" type="submit" name="accion" value="Oportunidad">
	<input class="btn_form" type="submit" name="accion" value="Kardex">
	<input class="btn_form" type="submit" name="accion" value="Mov. Fondo Gar">
    <input class="btn_form" type="submit" name="accion" value="Salir">
</form>			
            <?php
		 	include("footer_in.php");
		 ?>
	</div>
</body>
</html>
<?php
}
    ob_end_flush();
 ?>