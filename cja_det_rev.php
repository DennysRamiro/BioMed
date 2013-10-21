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
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<?php
 //$fec = leer_param_gral();
 $f_des = cambiaf_a_mysql($fec);
// echo $f_des;
 $logi = $_SESSION['login']; 
?>
  <html>
<head>
<title>Detalle de Desembolso a revertir</title>
<meta charset="UTF-8">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script>
<script type="text/javascript" src="js/cajas_rev_des_det.js"></script>   
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
                 <li id="menu_modulo_general_cajas">
                    
                     <img src="img/fax_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CAJAS
                    
                 </li>
                  <li id="menu_modulo_cajas_rev">
                    
                     <img src="img/import_32x32.png" border="0" alt="Modulo" align="absmiddle"> REV. TRANSACCIONES
                    
                 </li>
                  <li id="menu_modulo_cajas_rev_des">
                    
                     <img src="img/down_32x32.png" border="0" alt="Modulo" align="absmiddle"> DESEMBOLSOS
                    
                 </li>
                   <li id="menu_modulo_fecha">
                    
                     <img src="img/documents_32x32.png" border="0" alt="Modulo" align="absmiddle"> DET. DESEMBOLSOS
                    
                 </li>
              </ul> 
<!--Cabecera del modulo con su alerta-->
     <div id="contenido_modulo">
                      <h2> <img src="img/documents_64x64.png" border="0" alt="Modulo" align="absmiddle">DETALLE DESEMBOLOS</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/alert_32x32.png" align="absmiddle">
                     Elija la Transaccion
                     </div>   

        
                 <!--img src="images/24x24/001_20.png" border="0" align="absmiddle" alt="Home" /-->
				<?php
                 //$fec = leer_param_gral();
				 $fec1 = cambiaf_a_mysql_2($fec);
				 $logi = $_SESSION['login']; 
                ?> 
			
 <center>
<!--div id="GeneralManUsuarioM"-->
<form name="form2" method="post" action="grab_retro_cja.php" >
<strong><font size="-1">
<?php
//$f_des = "";
//$f_has = "";
$mone = " ";
if(isset($_POST['nro_desem'])){
   $quecom = $_POST['nro_desem'];
   //echo $quecom;
   for ($i=0; $i < count($quecom); $i = $i + 1 ) {
       if (isset($quecom[$i]) ) {
          $n_des = $_POST['nro_desem'];
	      }
   }
    //  $n_des = $_POST['nro_desem'];
   //   $_SESSION['nro_desem'] = $n_des;
	 // $f_des2 = cambiaf_a_mysql($f_des);
  }

?> 
<font size="+1"  style="" >
<?php
//if ($mone == 1){


    
    echo encadenar(35)."DETALLE DESEMBOLSOS NRO. ".encadenar(2). $n_des;
 // }
// if ($mone == 2){
 //   echo encadenar(45)."LISTADO DE DESEMBOLSOS DE CARTERA EN ".encadenar(2). "DOLARES";
 // } 
?>
</font>
<br>
<font size="+1"  style="" >
<?php
//echo encadenar(70)."DEL".encadenar(3).$f_des.encadenar(3)."AL".encadenar(3).$f_has;
?>
</font>
<center>
<br><br>
<font size="0"  style="" >
	 <table border="1" width="800">
	
	<tr>
	    <th align="center"><font size="-1">FECHA </th> 
	    <th align="center"><font size="-1">ASESOR</th> 
	   	<th align="center"><font size="-1">No.TRA.</th>  
	   	<th align="center"><font size="-1">NRO. CREDITO</th> 
		<th align="center"><font size="-1">CLIENTE</th>
		<th align="center"><font size="-1">GRUPO</th>
		<th align="center"><font size="-1">TIP.OPERA</th>
		<th align="center"><font size="-3">CAJERO</th>
	</tr>		

<?php 
  //Datos del cart_det_tran	
   // echo $f_des2.encadenar(2).$f_has2;
   	$t_cap = 0;
	$t_int = 0;
	$t_iven = 0;
	$t_aho = 0; 
	$t_otro = 0;
	$t_pen = 0;
	$t_com = 0;
	$t_tot  = 0;				
	//echo $f_des;
	$con_tpa = "Select DISTINCT CART_DTRA_FECHA, CART_DTRA_NRO_TRAN, CART_DTRA_NCRE
	            From cart_det_tran, cart_maestro where
	            (CART_DTRA_FECHA between '$f_des' and '$f_des') and
				 CART_DTRA_NRO_TRAN = $n_des and
	             CART_DTRA_TIP_TRAN = 1 and  CART_NRO_CRED = CART_DTRA_NCRE 
				 and CART_DTRA_USR_BAJA is null and CART_MAE_USR_BAJA is null
				 order by CART_DTRA_FECHA, CART_DTRA_NRO_TRAN, CART_DTRA_NCRE ";
    $res_tpa = mysql_query($con_tpa);
	
	    while ($lin_tpa = mysql_fetch_array($res_tpa)) { // 1a
		    $fec_pag = $lin_tpa['CART_DTRA_FECHA'];
			$f_pag = cambiaf_a_normal($fec_pag);
			$nro_tran = $lin_tpa['CART_DTRA_NRO_TRAN'];
			$cod_cre = $lin_tpa['CART_DTRA_NCRE'];
			$_SESSION['ncre'] = $cod_cre;
			$_SESSION['f_tra'] = $fec_pag;
			$_SESSION['nro_tran'] = $nro_tran;
			//echo $cod_cre ."-ncre-";
	//Consulta Cart_maestro
			
			$con_car  = "Select * From cart_maestro, cart_deudor, cliente_general
             where CART_NRO_CRED = $cod_cre and CART_DEU_NCRED = CART_NRO_CRED
             and CLIENTE_COD_ID = CART_DEU_ID and CART_DEU_RELACION = 'C' 
			 and CART_DEU_USR_BAJA is null and  CART_MAE_USR_BAJA is null"; 
             $res_car = mysql_query($con_car);
 
             while ($lin_car = mysql_fetch_array($res_car)) {
			        $mon = $lin_car['CART_COD_MON'];
			        $c_grup = $lin_car['CART_COD_GRUPO']; 
					$tcred = $lin_car['CART_TIPO_CRED'];
					$asesor = $lin_car['CART_OFIC_RESP'];
					$tip_ope = $lin_car['CART_TIPO_OPER'];
                    $nom_cli = $lin_car['CLIENTE_AP_PATERNO'].encadenar(1).
					$lin_car['CLIENTE_AP_MATERNO'].encadenar(1).
					$lin_car['CLIENTE_AP_ESPOSO'].encadenar(1).
					$lin_car['CLIENTE_NOMBRES'].encadenar(1);
					$caje = substr($lin_car['CART_MAE_USR_ALTA'],0,8); 
			
			$nom_ases = leer_nombre_usr($tcred,$asesor);
			$con_top = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 21 and GRAL_PAR_INT_COD = $tip_ope ";
            $res_top = mysql_query($con_top);
			 while ($lin_top = mysql_fetch_array($res_top)) {
			        $d_tipope =  $lin_top['GRAL_PAR_INT_DESC'];
			 
			    }
		$nom_grp = " ";		
		if ($c_grup <> ""){			
			$con_grp = "Select * From cred_grupo where CRED_GRP_CODIGO = $c_grup and CRED_GRP_USR_BAJA is null";
            $res_grp = mysql_query($con_grp);
	        while ($lin_grp = mysql_fetch_array($res_grp)) {
	              $nom_grp = $lin_grp['CRED_GRP_NOMBRE'];
	//		      $nom_cli = $lin_car['CLIENTE_AP_PATERNO'].encadenar(1)."/".encadenar(1).$nom_grp;		
				}	
			}	
		}	
		?>
		
		<tr>
	    <td align="left" ><?php echo $f_pag; ?></td>
	    <td align="left" style="font-size:10px"><?php echo $nom_ases; ?></td>
	   	<td align="center" ><?php echo number_format($nro_tran, 0, '.',''); ?></td>
		<td align="right" ><?php echo $cod_cre; ?></td>	
		<td align="left" style="font-size:10px" ><?php echo $nom_cli; ?></td>
		<td align="left" style="font-size:10px"><?php echo $nom_grp; ?></td>
		<td align="left" style="font-size:10px" ><?php echo $d_tipope; ?></td>
		<td align="left" style="font-size:10px" ><?php echo $caje; ?></td>
		</tr>
		</table>
		 <table border="1" width="800">
	<tr>
	    <th align="center"><font size="-1">DETALLE</th>
		<th align="center"><font size="-1"></th>
		<th align="center"><font size="-1"></th>
		<th align="center"><font size="-1"></th>
		
	</tr>
	
	<tr>
	    <th align="center"><font size="-1">CUENTA</th>
		<th align="center"><font size="-1">DESCRIPCION</th>
		<th align="center"><font size="-1">DEBE</th>
		<th align="center"><font size="-1">HABER</th>
		
	</tr>	
		
		
		
		
		<?php	
		//echo $f_des2.encadenar(2).$f_has2.encadenar(2).$nro_tran.encadenar(2).$cod_cre;	
			$p_cap = 0;
			$p_int = 0;
		    $p_iven = 0;
		    $p_aho = 0; 
		    $p_otro = 0;
		    $p_pen = 0;
			$p_com = 0;
		    $p_imp  = 0;
			
			$con_tra = "Select * From cart_det_tran where CART_DTRA_NCRE = $cod_cre and 
	            CART_DTRA_FECHA = '$fec_pag' and CART_DTRA_NRO_TRAN = $nro_tran and
				CART_DTRA_TIP_TRAN = 1 and CART_DTRA_USR_BAJA is null";
            $res_tra = mysql_query($con_tra);
			while ($lin_tra = mysql_fetch_array($res_tra)) { // 2 a
			      $t_ccon = $lin_tra['CART_DTRA_CCON'];
				  $p_imp = $lin_tra['CART_DTRA_IMPO'];
				  $p_impe = $lin_tra['CART_DTRA_IMPO_BS'];
				  $t_tran = $lin_tra['CART_DTRA_TIP_TRAN'];
				  $nro_cta = $lin_tra['CART_DTRA_CTA_CBT'];
				  $mon_cta = substr($lin_tra['CART_DTRA_CTA_CBT'],5,1);
				  $deb_hab = $lin_tra['CART_DTRA_DEB_CRE'];
				  $caje = substr($lin_tra['CART_DTRA_USR_ALTA'],0,8);
				  $des_cta = leer_cta_des($nro_cta);
				 // echo $mon_cta,"--Mon" ;
				 // if ($t_tran == 1){ // 3a
				 //     $saldo =  $p_imp;
				//	} // 3b
			/* if ($t_tran == 1){ //4a
			     if ($t_ccon > 110 and $t_ccon < 115){ //5a
				    //$deb_hab = 2;
				    $p_efe =  $p_imp;
					//$t_cap =  $t_cap + $p_cap;
					}
			     if ($t_ccon > 130 and $t_ccon < 135){ //5a
				    $p_cap =  $p_imp;
					//$t_cap =  $t_cap + $p_cap;
					} // 5b
				 if ($t_ccon > 512 and $t_ccon < 514){ //6a
				    //$p_int =  $p_imp;
					$t_int =  $t_int + $p_int;
					} //6b
				 if ($t_ccon > 518 and $t_ccon < 520){ //7a
				    $p_com =  $p_imp;
					$t_com =  $t_com + $p_com;
					} //7b
				 if ($t_ccon == 212){//8a
				    $p_aho =  $p_imp;
					$t_aho =  $t_aho + $p_aho;
					} //8b
				 if ($t_ccon == 242){ //9a
				    $p_otro =  $p_imp;
					$t_otro =  $t_otro + $p_otro;
					}	//9b
				}*/ // 4b	
			//	$p_tot  = $p_cap ;	
				
			// // 2b	
		//	$t_tot = $t_tot + $p_tot;
		
	
	if ($deb_hab == 1){
	   	$t_cap = $t_cap + $p_impe;
	?>
	<tr>
	    <td align="center" ><?php echo $nro_cta; ?></td>
	 	<td align="left" ><?php echo $des_cta; ?></td>
		<td align="right" ><?php echo number_format($p_impe, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		
		
	</tr>	
	
	<?php	}else{ 
	       $t_int = $t_int + $p_impe;  ?>
	
	<tr>
	    <td align="center" ><?php echo $nro_cta; ?></td>
	 	<td align="left" ><?php echo $des_cta; ?></td>
		<td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($p_impe, 2, '.',','); ?></td>
				
	</tr>				 
				    	
		
	
	             
	 
		<?php
		}		 
			}	 
				 
	           } // 1b
		
			   			
	?>
	<tr>
	    <th align="left" ><?php echo encadenar(5); ?></th>
	    <th align="center" ><?php echo "Total"; ?></th>
	    <th align="right" ><?php echo number_format($t_cap, 2, '.',','); ?></th>
	 	<th align="right" ><?php echo number_format($t_int, 2, '.',','); ?></th>
		
	</tr>	
</table>
<br><br>
</center>
<center>
   <input type="submit" name="accion" value="Revertir">
   <input type="submit" name="accion" value="Salir">
  </form>s		
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

