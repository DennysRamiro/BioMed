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
<title>Registro de Depositos - Retiros Fondo de Garantia</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js" type="text/javascript"> </script>  
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
					 $fec1 = cambiaf_a_mysql_2($fec);
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
				?>
             </div>
             <div id="Salir">
            <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
            </div> 
				<div id="TitleModulo">
                	<img src="images/24x24/001_35.png" border="0" alt="" />
					<?php
if ($_SESSION['dep_ret'] == 1){
   ?>
   Registro de Depositos Fondo de Garantia
 <?php
 }  
   ?>
 <?php
if ($_SESSION['dep_ret'] == 2){
   ?>
   Registro de Retiro Fondo de Garantia
 <?php
 }  
   ?>  
					
          </div> 
              <div id="AtrasBoton">
           		<a href="fgar_tran.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
           </div>
<div id="GeneralManCliente">
<!-- <form name="form2" method="post" action="egre_retro_1.php" style="border:groove" onSubmit="return"> >-->
  <form name="form2" method="post" action="cobro_retro_opd.php" onSubmit="return ValidaCamposEgresos(this)">
<?php
// Se realiza una consulta SQL a tabla gral_param_propios

//echo $_SESSION['continuar']." ++++++";
 if (isset($_SESSION['cod_cli'])) {
    $cod_cli = $_SESSION['cod_cli'];
}	
if ($_SESSION['continuar'] == 2){
     $cod_cta = $_SESSION['cta_fon'];
	 $t_tra = "Retiro";
	 $q_depo = "Quien Saca";
	  echo "Saldo menor";
}
if ($_SESSION['continuar'] == 3){
     $cod_cta = $_SESSION['cta_fon'];
	 $t_tra = "Retiro";
	 $q_depo = "Quien Saca";
	  echo "No puede cerrar cuenta, tiene credito(s) asociados con Saldo";
}
if ($_SESSION['continuar'] == 1){
    if (isset($_POST['ncta'])) {
	    
        $cod_cta = $_POST['ncta'];
		//echo $cod_cta;
		$trozos = explode("*", $cod_cta);
		$cod_cta = $trozos[0];
		$ncre = $trozos[1];
		$_SESSION['ncre'] = $ncre;
     //  echo $trozos[0].encadenar(2); // trozo1
      //  echo $trozos[1]; // trozo2

        $_SESSION['cta_fon'] = $cod_cta;
        if ($_SESSION['dep_ret'] == 1){
        $t_tra = "Deposito";
	    $q_depo = "Quien realiza la tran";
	   }
    if ($_SESSION['dep_ret'] == 2){
        $t_tra = "Retiro";
	    $q_depo = "Quien realiza la tran";
		 $_SESSION['cta_fon'] = $cod_cta;
	   }
    }


	
//$ncre = 0;	
$con_ncre = "Select * From cart_maestro, fond_maestro where FOND_NRO_CTA = $cod_cta 
             and CART_NRO_CRED = FOND_NRO_CRED  and
			 CART_ESTADO < 9 and 
			 CART_MAE_USR_BAJA is null and FOND_MAE_USR_BAJA is null"; 
$res_ncre = mysql_query($con_ncre);
	while ($lin_ncre = mysql_fetch_array($res_ncre)) {
	       $ncre = $lin_ncre['CART_NRO_CRED'];
		   $t_cred = $lin_ncre['CART_TIPO_CRED'];
		   $asesor = $lin_ncre['CART_OFIC_RESP'];
		    $nom_ase = leer_nombre_usr($t_cred,$asesor);
		  $_SESSION['asesor'] = $nom_ase;
		//   $_SESSION['ncre'] = $ncre;
	}
		
$con_fga  = "Select * From  fond_maestro where  FOND_NRO_CTA = $cod_cta  and FOND_MAE_USR_BAJA is null"; 
$res_fga = mysql_query($con_fga);
   while ($lin_fga = mysql_fetch_array($res_fga)) {
     $mon = $lin_fga['FOND_COD_MON'];
	 $dep = 0;
	 $ret = 0;
	 $con_dtra  = "Select * From fond_det_tran where FOND_DTRA_NCTA = '$cod_cta'
	              and  FOND_DTRA_CCON = 212 
	              and FOND_DTRA_USR_BAJA is null ";
    $res_dtra = mysql_query($con_dtra);
   	        while ($lin_dtra = mysql_fetch_array($res_dtra)) {
			     
			      
	              $tot_imp = $lin_dtra['FOND_DTRA_IMPO'];
				  $t_tran = $lin_dtra['FOND_DTRA_TIP_TRAN'];
		          $nro_tran = $lin_dtra['FOND_DTRA_NRO_TRAN'];
				  $f_tran = $lin_dtra['FOND_DTRA_FECHA'];
				  $f_tra = cambiaf_a_normal($f_tran);
				  if ($t_tran == 1){
				      $dep =  $dep + $tot_imp;
					//  $saldo = $saldo + $dep;
					}
			      if ($t_tran == 2){
			         $ret =  $ret + $tot_imp;
				    // $saldo = $saldo - $ret;
				    }	
				}		  
	      $saldo = $dep - $ret;
		  $_SESSION['saldo_cta'] = round($saldo,2);
	 	 
	 $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD = $mon";
       $res_mon = mysql_query($con_mon);
	   while ($linea = mysql_fetch_array($res_mon)) {
	        $d_mon = $linea['GRAL_PAR_INT_DESC'];
			$_SESSION['cod_mon'] = $mon;
			$_SESSION['d_mon'] = $d_mon;
			$cod_mon = $mon;
	   }
     
  }

//if ($_SESSION['detalle'] == 1){
   $consulta  = "Select * From gral_agencia where GRAL_AGENCIA_USR_BAJA is null ";
   $resultado = mysql_query($consulta);
   //$cod_mon = $mon;
  // $des_mon = "";
   
 //  $saldo = $_SESSION['saldo_cta'];
   /*
    */
//cuenta fondos
$con_ctas  = "Select * From cart_via_cta, contab_cuenta  where CART_VIA_CTA_GRP = 2
                                                           and CART_VIA_MON = $cod_mon
														   and CART_VIA_TIP_OP = 1
														   and CONTA_CTA_NRO = CART_VIA_CTA_CTB";
$res_ctas = mysql_query($con_ctas);
while ($linea = mysql_fetch_array($res_ctas)) {
	   $c_cta2 = $linea['CART_VIA_CTA_CTB'];
	   $_SESSION['cod_cta2'] = $c_cta2;	
	   }

if ($mon == 1){
   $_SESSION['cod_cta1'] = "11101101";
   }
if ($mon == 2){
   $_SESSION['cod_cta1'] = "11101201";
   }   
}
 ?>
 <table align="center">
      
     <tr>
        <th align="left"><?php echo encadenar(2); ?> </th>
		<th align="center"><?php echo $t_tra; ?></td>
     </tr>
	 <tr>
        <th align="left"><?php echo "Cliente"; ?> </th>
		<th align="left"><?php echo $_SESSION['nombre']; ?></td>
     </tr>
	 <tr>
        <th align="left"><?php echo "Grupo"; ?> </th>
		<th align="left"><?php echo $_SESSION['grupo']; ?></td>
     </tr>
	 
    <tr>
        <th align="left">Cuenta Nro. </th>
		<td><?php echo $cod_cta; ?></td>
     </tr>
    <tr>
        <th align="left">Moneda  </th>
		<td><?php echo $_SESSION['d_mon']; ?></td>
     </tr>
	 <tr>
        <th align="left">Saldo  </th>
		<td align="left"><?php echo number_format( $_SESSION['saldo_cta'], 2, '.',','); ?></td>
     </tr>
     <tr>
     <tr> 
        <th align="left" >Monto </th>
	    <td><input type="text" name="monto"> </td>
      <tr> 
      <th align="left" ><?php echo $q_depo; ?></th>
	    <td><input  type="text" name="descrip"> </td>
      </tr>  </tr>
	   
     </table>
	 <center>
	    
	 <input type="submit" name="accion" value="Grabar">
     <input type="submit" name="accion" value="Salir">

</form>
    <?php //}
}
	?>


