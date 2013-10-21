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
<title>Consulta Cobro detalle</title>
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
 $_SESSION['calculo'] = 1; 
?> 
	</div>
            <div id="Salir">
            <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
            </div>
            <div id="TitleModulo">
            	 <img src="images/24x24/001_36.png" border="0" alt="Modulo">
                         Seleccionar Credito para calcular
			</div>
            <div id="AtrasBoton">
           		<a href="cred_cobros.php?modulo=<?php echo $_SESSION['modulo'];?>"><img src="images/24x24/001_23.png" border="0"  alt="Regresar" align="absmiddle">Atras</a>
            </div>
<font size="+1">
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
//$imp_sol = $_SESSION["impo_sol"];
//echo $_SESSION['nro_sol'], "codigo sol";
$total = 0;
if ( $_SESSION['continuar'] == 2) {
   $quecom = $_POST['cod_grupo'];
   for ($i=0; $i < count($quecom); $i = $i + 1 ) {
       if (isset($quecom[$i]) ) {
          $cod_gru = $quecom[$i];
	      $_SESSION['cod_gru'] = $cod_gru;
       }
   } 
   }else{
   $cod_gru = $_SESSION['cod_gru'];
   }
  
   $consulta  = "Select * from cred_grupo where CRED_GRP_CODIGO = $cod_gru and CRED_GRP_USR_BAJA is null ";
   $resultado = mysql_query($consulta);
   while ($linea = mysql_fetch_array($resultado)) {
	     $nom_com = $linea['CRED_GRP_NOMBRE'];
		  $_SESSION['nombre'] = $nom_com;
	    }
   
$con_cli  = "Select * From cart_maestro where CART_COD_GRUPO = $cod_gru 
             and CART_ESTADO  < 8 and CART_MAE_USR_BAJA is null"; 
$res_cli = mysql_query($con_cli)or die('No pudo seleccionarse cart_maestro 1');
 ?>
 <form name="form2" method="post" action="cobro_retro_op.php" style="border:groove" onSubmit="return ValidaCamposClientes(this)"> 
 <?php
   echo "Grupo".encadenar(3).$nom_com;
 ?>
 <div id="TableModulo">
 <table width="50%"  border="0" cellspacing="1" cellpadding="1" align="center">
   <tr>
      <th width="22%" scope="col"><border="0" alt="" align="absmiddle" />NUMERO CREDITO</th>
      <th width="20%" scope="col"><border="0" alt="" align="absmiddle" />GRUPO</th>
      <th width="25%" scope="col"><border="0" alt="" align="absmiddle" />IMPORTE TOTAL</th>
	  <th width="25%" scope="col"><border="0" alt="" align="absmiddle" />IMPORTE INDIVIDUAL</th>
	  <th width="25%" scope="col"><border="0" alt="" align="absmiddle" />IMPORTE CUOTA</th>
	  <th width="32%" scope="col"><border="0" alt="" align="absmiddle" />MONEDA</th>
	  <th width="32%" scope="col"><border="0" alt="" align="absmiddle" />TIPO OPERACION</th>
	  <th width="32%" scope="col"><border="0" alt="" align="absmiddle" />PRODUCTO</th>
	  <th width="20%" scope="col"><border="0" alt="" align="absmiddle" />CALCULAR</th>
	  </tr>
	
   <?php
   while ($lin_cli = mysql_fetch_array($res_cli)){
          $cod_ncre = $lin_cli['CART_NRO_CRED'];
		  
	  $con_car  = "Select * From cart_maestro where CART_NRO_CRED = $cod_ncre and CART_ESTADO  < 8 and
	               CART_MAE_USR_BAJA is null"; 
      $res_car = mysql_query($con_car)or die('No pudo seleccionarse cart_maestro 2');
          
	  while ($lin_car = mysql_fetch_array($res_car)) {
	        $nom_grp = " ";
	  
	        $cod_sol = $lin_car['CART_NRO_SOL']; 
		    $impo = $lin_car['CART_IMPORTE'];
		    $mon = $lin_car['CART_COD_MON'];
		    $tint = $lin_car['CART_TASA'];
			$tope = $lin_car['CART_TIPO_OPER'];
		    $plzm = $lin_car['CART_PLZO_M'];
		    $plzd = $lin_car['CART_PLZO_D'];
		    $cuotas = $lin_car['CART_NRO_CTAS'];
		    $c_int = $lin_car['CART_CAL_INT'];
		    $f_pag = $lin_car['CART_FORM_PAG'];
		    $ahod = $lin_car['CART_AHO_DUR'];
		    $f_des = $lin_car['CART_FEC_DES'];
		    $f_uno = $lin_car['CART_FEC_UNO'];
		    $c_agen = $lin_car['CART_COD_AGEN'];
			$c_grup = $lin_car['CART_COD_GRUPO'];
			$t_prod = $lin_car['CART_PRODUCTO'];
			$t_cred = $lin_car['CART_TIPO_CRED'];
			$f_des2= cambiaf_a_normal($f_des); 
		    
		   if ($t_cred == 1) { 
		      $cod_sold = $lin_cli['CART_DEU_SOL'];
		      $f_uno2= cambiaf_a_normal($f_uno);
			  
		      $con_sol  = "Select * From cred_deudor where CRED_SOL_CODIGO = $cod_sold and CRED_DEU_INTERNO = $cod_cli
		               and CRED_DEU_USR_BAJA is null"; 
              $res_sol = mysql_query($con_sol)or die('No pudo seleccionarse cred_deudor');
		      while ($lin_csol = mysql_fetch_array($res_sol)){
		         $imp_ind = $lin_csol ['CRED_DEU_IMPORTE'];          
				 }
		      $con_cta  = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sold and CRED_PLD_COD_CLI = $cod_cli
		               and CRED_PLD_NRO_CTA = 1 and CRED_PLD_USR_BAJA is null"; 
              $res_cta = mysql_query($con_cta)or die('No pudo seleccionarse cred_plandp');
		      while ($lin_cta = mysql_fetch_array($res_cta)){
		         $imp_cta = $lin_cta['CRED_PLD_CAPITAL'] + $lin_cta['CRED_PLD_INTERES'] + $lin_cta['CRED_PLD_AHORRO'];          		 } 
			 $con_cin = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 10 and GRAL_PAR_INT_COD = $c_int";
             $res_cin = mysql_query($con_cin)or die('No pudo seleccionarse tabla 4')  ;
	         while ($linea = mysql_fetch_array($res_cin)) {
	               $d_cin = $linea['GRAL_PAR_INT_DESC'];
	             }
		      }
                
				 
		$con_dpro  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 806 and GRAL_PAR_PRO_COD = $t_prod";
        $res_dpro = mysql_query($con_dpro)or die('No pudo seleccionarse tabla');
        while ($lin_dpro = mysql_fetch_array($res_dpro)) {
               $d_pro = $lin_dpro['GRAL_PAR_PRO_DESC']; 
	     }
		$con_dope  = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 21 and GRAL_PAR_INT_COD = $tope";
        $res_dope = mysql_query($con_dope)or die('No pudo seleccionarse tabla');
        while ($lin_dope = mysql_fetch_array($res_dope)) {
               $d_ope = $lin_dope['GRAL_PAR_INT_DESC']; 
	     }
		      
		$con_grp = "Select * From cred_grupo where CRED_GRP_CODIGO = $c_grup and CRED_GRP_USR_BAJA is null";
        $res_grp = mysql_query($con_grp)or die('No pudo seleccionarse tabla cred_grupo')  ;
	    while ($lin_grp = mysql_fetch_array($res_grp)) {
	        $nom_grp = $lin_grp['CRED_GRP_NOMBRE'];
			$_SESSION['grupo'] = $nom_grp;
			}		 
		}	
			 
       $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD = $mon";
       $res_mon = mysql_query($con_mon)or die('No pudo seleccionarse tabla 3')  ;
	   while ($linea = mysql_fetch_array($res_mon)) {
	        $d_mon = $linea['GRAL_PAR_INT_DESC'];
	   }
      
  $con_fpa = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 13 and GRAL_PAR_INT_COD = $f_pag";
          $res_fpa = mysql_query($con_fpa)or die('No pudo seleccionarse tabla 5')  ;
          while ($lin_fpa = mysql_fetch_array($res_fpa)) {
		        $nro_d = $lin_fpa['GRAL_PAR_INT_CTA1'];
				$fpag_d = $lin_fpa['GRAL_PAR_INT_DESC'];
				
		  }
	
	  	?>
		       <?php if ($t_prod == 1){ ?>
			        <td bgcolor="#66CCFF"><?php echo $cod_ncre; ?></td>
                    <td bgcolor="#66CCFF"><?php echo $nom_grp; ?></td>
                    <td bgcolor="#66CCFF"><?php echo number_format($impo, 2, '.',',');  ?></td>
					<td bgcolor="#66CCFF"><?php echo number_format($imp_ind, 2, '.',',');  ?></td>
					<td bgcolor="#66CCFF"><?php echo number_format($imp_cta, 2, '.',',');  ?></td>
	                <td bgcolor="#66CCFF"><?php echo $d_mon; ?></td>
                    <td bgcolor="#66CCFF"><?php echo $d_ope; ?></td>
					<td bgcolor="#66CCFF"><?php echo $d_pro; ?></td>
					<td><INPUT NAME="ncre" TYPE=RADIO VALUE="<?php echo $cod_ncre; ?>">	</td> 


					<?php }?>
				 <?php if ($t_prod == 2){ ?>
			        <td bgcolor="#FFFF33"><?php echo $cod_ncre; ?></td>
                    <td bgcolor="#FFFF33"><?php echo $nom_grp; ?></td>
                    <td bgcolor="#FFFF33"><?php echo number_format($impo, 2, '.',',');  ?></td>
					<td bgcolor="#FFFF33"><?php echo number_format($imp_ind, 2, '.',',');  ?></td>
					<td bgcolor="#FFFF33"><?php echo number_format($imp_cta, 2, '.',',');  ?></td>
	                <td bgcolor="#FFFF33" ><?php echo $d_mon; ?></td>
                    <td bgcolor="#FFFF33"><?php echo $d_ope; ?></td>
					<td bgcolor="#FFFF33" ><?php echo $d_pro; ?></td>
					<td><INPUT NAME="ncre" TYPE=RADIO VALUE="<?php echo $cod_ncre; ?>"></td>  
					<?php }?>
					<?php if ($t_prod == 3){ ?>
			        <td bgcolor="#66CC66"><?php echo $cod_ncre; ?></td>
                    <td bgcolor="#66CC66"><?php echo $nom_grp; ?></td>
                    <td bgcolor="#66CC66"><?php echo number_format($impo, 2, '.',',');  ?></td>
					<td bgcolor="#66CC66"><?php echo number_format($imp_ind, 2, '.',',');  ?></td>
					<td bgcolor="#66CC66"><?php echo number_format($imp_cta, 2, '.',',');  ?></td>
	                <td bgcolor="#66CC66" ><?php echo $d_mon; ?></td>
                    <td bgcolor="#66CC66"><?php echo $d_ope; ?></td>
					<td bgcolor="#66CC66" ><?php echo $d_pro; ?></td>
					<td><INPUT NAME="ncre" TYPE=RADIO VALUE="<?php echo $cod_ncre; ?>"></td> 
					<?php }?>		
					<br>
		</font>			
	 </tr>
                  <?php }?>
               
                </table>
            </div id="TableModulo2">
	<input type="submit" name="accion" value="Detalle">
	<input type="submit" name="accion" value="Kardex">
	<input type="submit" name="accion" value="Mov. Fondo Gar">
    <input type="submit" name="accion" value="Salir">
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