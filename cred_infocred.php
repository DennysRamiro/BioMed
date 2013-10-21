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
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
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
                  <li id="menu_modulo_creditos_infocred">
                    
                     <img src="img/edit user_24x24.png" border="0" alt="Modulo" align="absmiddle"> DATOS INFOCRED
                    
                 </li>
					<li id="menu_modulo_fecha">
                     <img src="img/refresh_32x32.png" border="0" alt="Modulo" align="absmiddle"> VIG-VEN-EJ             
                 </li>
         </ul>  
              <div id="contenido_modulo">
						<h2> <img src="img/refresh_64x64.png" border="0" alt="Modulo" align="absmiddle">
INFOCRED EN BOLIVIANOS AL <?php $f_has2; ?>

			</h2>
                      <hr style="border:1px dashed #767676;">
                       <!--div id="error_login"> 
				          <img src="img/alert_32x32.png" align="absmiddle">
				           Ingrese la fecha 
				        </div-->

<?php
 //$fec = leer_param_gral();
 $logi = $_SESSION['login']; 
?>
  <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <a href='cred_infocre.php'>Salir</a>
  </div>

<?php
//$f_des = "";
//$f_has2 = "2011-02-26";
$mone = " ";
$borr_cob  = "Delete From cred_infocred"; 
$cob_borr = mysql_query($borr_cob)or die('No pudo borrar cred_infocred');
if(isset($_POST['fec_nac'])){
      $f_has = $_POST['fec_nac'];
	  $mes = substr($f_has,3,2);
	  $anio = substr($f_has,6,4);
      $_SESSION['f_has'] = $f_has;
	  $f_has2 = cambiaf_a_mysql($f_has);
  } 
/*if(isset($_POST['fec_des'])){
      $f_des = $_POST['fec_des'];
      $_SESSION['f_des'] = $f_des;
	  $f_des2 = cambiaf_a_mysql($f_des);
  }
 
  if(isset($_POST['cod_mon'])){
      $mone = $_POST['cod_mon'];
      $_SESSION['mone'] = $mone;
  } 
 */  
?> 

<br>

<center>
<br><br>
<font size="0"  style="" >
	 <table border="1" width="1500">
	
	<tr>
	   	<tr>
		 <th align="center"><font size="-1">TIPO DE DOCUMENTO</th> 
		 <th align="center"><font size="-1">NRO DOCUMENTO</th>  
	     <th align="center"><font size="-1">NOMBRE COMPLETO</th>
	   	 <th align="center"><font size="-1">EXTENSIÓN</th> 
		 <th align="center"><font size="-1">SIGLA ENTIDAD</th> 
		 <th align="center"><font size="-1">TIPO DE OBLIGADO</th>
		 <th align="center"><font size="-1">NUMERO DE OPERACIÓN</th>
		 <th align="center"><font size="-1">TIPO DE CREDITO</th>
		<th align="center"><font size="-1">OBJETO DEL CREDITO</th>
		<th align="center"><font size="-1">FEC INICIO OPERACIÓN</th>
		<th align="center"><font size="-1">MONTO ORIGINAL</th>
		<th align="center"><font size="-1">FEC. DE VENCIMIENTO</th>
		<th align="center"><font size="-1">DÍAS MORA</th>
		<th align="center"><font size="-1">SALDO VIGENTE</th>
		<th align="center"><font size="-1">SALDO VENCIDO</th>
		<th align="center"><font size="-1">SALDO EJECUCIÓN</th>
		<th align="center"><font size="-1">SALDO CASTIGO</th>
		<th align="center"><font size="-1">SALDO CONTINGENTE</th>
		<th align="center"><font size="-1">CALIFICACIÓN</th>
		<th align="center"><font size="-1">PERIODO DE LA CUOTA</th>
		<th align="center"><font size="-1">TIPO DE CANCELACION</th>
		<th align="center"><font size="-1">MONEDA</th>
		<th align="center"><font size="-1">NRO DOC ANTERIOR</th>
		<th align="center"><font size="-1">FECHA FIN</th>
		<th align="center"><font size="-1">GRUPO</th>
     </tr>		

<?php 
  //Datos del cart_det_tran	
   // echo $f_des2.encadenar(2).$f_has2;
   	$t_vig = 0;
	$t_ven = 0;
	$t_eje = 0;
	$t_cas = 0; 
	$tc_contab = leer_tipo_cam_2($f_has2);
	
	$t_tot  = 0;				
	$con_tpa = "Select *
	            From cart_califica where
	            cart_cal_fec = '$f_has2'";
    $res_tpa = mysql_query($con_tpa)or die('No pudo seleccionarse tabla cart_califica 1')  ;
	
	    while ($lin_tpa = mysql_fetch_array($res_tpa)) { // 1a
		    $estado = 0;
	        $ven = 0;
	        $eje = 0;
	        $cas = 0;
		   	$estado = $lin_tpa['cart_cal_est'];
			$saldo = $lin_tpa['cart_cal_saldo'];
			$mon = $lin_tpa['cart_cal_mon'];
			$cod_cre = $lin_tpa['cart_cal_ncre'];
			$dias = $lin_tpa['cart_cal_dias'];
			//$f_ven = "0000/00/00";
			$calif = $lin_tpa['cart_cal_cali'];
			//$f_ve = cambiaf_a_normal($f_ven);
			$nom_grp = "";
			$f_ven = $lin_tpa['cart_cal_fvto'];
			    $f_ve= cambiaf_a_normal($f_ven);
		/*	$con_fven  = "Select * From cart_plandp where CART_PLD_NCRE=$cod_cre
			              and MONTH(CART_PLD_FECHA)= $mes and year(CART_PLD_FECHA)=$anio
						  and CART_PLD_USR_BAJA is null
						  ORDER BY CART_PLD_FECHA DESC LIMIT 0,1";
 
            $res_fven = mysql_query($con_fven)or die('No pudo leer : car_plandp ' . mysql_error()) ;
	        while ($lin_fven = mysql_fetch_array($res_fven)) {
	              $f_ven = $lin_fven['CART_PLD_FECHA'];
				  $f_ve = cambiaf_a_normal($f_ven);
		  }
			if ($f_ven == "0000/00/00"){
			    $f_ven = cta_venf($cod_cre);
			    $f_ve= cambiaf_a_normal($f_ven);
			
			}
			*/
			if ($mon == 2){
			    $mon_d = "ME";
			    $t_tot = $t_tot + round($saldo * $tc_contab,2);
				$saldo = round($saldo * $tc_contab,2);
			    }else{
				$t_tot = $t_tot + $saldo;
				 $mon_d = "MN";
			}
			if ($calif == 1){
			   $cali = "A"; 
			}
			if ($calif == 2){
			   $cali = "B"; 
			}
			if ($calif == 3){
			   $cali = "C"; 
			}
			if ($calif == 4){
			   $cali = "D"; 
			}
			if ($calif == 5){
			   $cali = "E"; 
			}
			if ($calif == 6){
			   $cali = "F"; 
			}
			if ($dias <= 30){
			    $vig = $saldo;
	            $ven = 0;
	            $eje = 0;
	            $cas = 0;
				$t_vig = $t_vig + $vig;
			}
			if (($dias > 30) && ($dias < 91)){
			    $vig = 0;
	            $ven = $saldo;
	            $eje = 0;
	            $cas = 0;
				$t_ven = $t_ven + $ven;
			}	
			if ($dias > 90){
			    $vig = 0;
	            $ven = 0;
	            $eje = $saldo;
	            $cas = 0;
				$t_eje = $t_eje + $eje;
			}
			if ($dias < 0){
			    $dias = 0;
			}

				//Consulta Cart_maestro
			
   			$con_car  = "Select CART_COD_GRUPO,CART_DEU_RELACION,CART_DEU_IMPORTE,CART_TIPO_OPER,CART_TIPO_CRED,CART_OFIC_RESP,
			                    CART_FEC_DES,CART_IMPORTE,CART_FORM_PAG, 
								CLIENTE_AP_PATERNO,CLIENTE_AP_MATERNO,CLIENTE_AP_ESPOSO,
							CLIENTE_NOMBRES,CLIENTE_COD_ID, 
								CLIENTE_SEXO,CLIENTE_EST_CIVIL,CLIENTE_FCH_NAC,CLIENTE_DIRECCION
								From cart_maestro, cart_deudor, cliente_general
             where CART_NRO_CRED = $cod_cre and CART_DEU_NCRED = CART_NRO_CRED
             and CLIENTE_COD_ID = CART_DEU_ID  
			 and CART_DEU_USR_BAJA is null and  CART_MAE_USR_BAJA is null and
			 CLIENTE_USR_BAJA is null"; 
             $res_car = mysql_query($con_car)or die('No pudo seleccionarse cart_maestro, cart_deudor, cliente_general');
 
             while ($lin_car = mysql_fetch_array($res_car)) {
			        $rel = $lin_car['CART_DEU_RELACION'];
					$impor = $lin_car['CART_IMPORTE'];
					$imp_ind = $lin_car['CART_DEU_IMPORTE'];
					$tip_ope = $lin_car['CART_TIPO_OPER']; 
			        $c_grup = $lin_car['CART_COD_GRUPO']; 
					$cod_id = $lin_car['CLIENTE_COD_ID'];
					$t_cred = $lin_car['CART_TIPO_CRED'];
					$ases = $lin_car['CART_OFIC_RESP'];
					$f_pag = $lin_car['CART_FORM_PAG'];
					 $nom_of  = leer_nombre_usr($t_cred,$ases);
					$cod_id = rtrim($cod_id);
					$nro_char = strlen($cod_id);
					$nro_ci = substr($cod_id,0,$nro_char-2);
					$ext_ci = substr($cod_id,$nro_char-2,2);
					$nom = $lin_car['CLIENTE_NOMBRES'];
					$pat = $lin_car['CLIENTE_AP_PATERNO'];
					$mat = $lin_car['CLIENTE_AP_MATERNO'];
					$esp = $lin_car['CLIENTE_AP_ESPOSO'];
					$dir = $lin_car['CLIENTE_DIRECCION'];
					$sex = $lin_car['CLIENTE_SEXO'];
					$civ = $lin_car['CLIENTE_EST_CIVIL'];
					$f_des = $lin_car['CART_FEC_DES'];
					$f_de = cambiaf_a_normal($f_des);
					$f_vtof = vto_fin($cod_cre);
		            $f_vto= cambiaf_a_normal($f_vtof);
				$con_civ  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 11 and GRAL_PAR_PRO_COD = $civ";
$res_civ = mysql_query($con_civ)or die('No pudo seleccionarse tabla 7')  ;
while ($linea = mysql_fetch_array($res_civ)) {
      $civ_r = $linea['GRAL_PAR_PRO_DESC'];
}	
                    $for_pag = $f_pag;
	
	                if ($f_pag == 4){
					    $for_pag = 3;
						}
					if ($f_pag == 7){
					    $for_pag = 6;
						}	
					if ($f_pag == 6){
					    $for_pag = 8;
						}	
					if ($sex == 1){
					    $sexo = "F";
						}
					if ($sex == 2){
					    $sexo = "M";
						}
					$f_nac = $lin_car['CLIENTE_FCH_NAC'];
					$f_na = cambiaf_a_normal($f_nac);
					$nom_cli = $lin_car['CLIENTE_AP_PATERNO']." ".
					$lin_car['CLIENTE_AP_MATERNO']." ".
					$lin_car['CLIENTE_AP_ESPOSO']." ".
					$lin_car['CLIENTE_NOMBRES']." ";  
			        
			if ($c_grup <> ""){			
			$con_grp = "Select * From cred_grupo where CRED_GRP_CODIGO = $c_grup and CRED_GRP_USR_BAJA is null";
            $res_grp = mysql_query($con_grp)or die('No pudo seleccionarse tabla cred_grupo')  ;
	        while ($lin_grp = mysql_fetch_array($res_grp)) {
	              $nom_grp = $lin_grp['CRED_GRP_NOMBRE'];
	//		      $nom_cli = $lin_car['CLIENTE_AP_PATERNO'].encadenar(1)."/".encadenar(1).$nom_grp;		
				}	
			}	
			
			 if ($sex == 1){ 
				     if ($civ == 1){ 
					    $nom_cli = $lin_car['CLIENTE_AP_PATERNO']." ".
				 	    $lin_car['CLIENTE_AP_MATERNO']." ".
					    $lin_car['CLIENTE_NOMBRES']." ";  
					 }
					 if ($civ == 2){ 
					     $nom_cli = $lin_car['CLIENTE_AP_ESPOSO']." ".
					     $lin_car['CLIENTE_NOMBRES']." ".
					     $lin_car['CLIENTE_AP_PATERNO']." "."DE" ;  
					 }
					 if ($civ == 3){ 
					     $nom_cli = $lin_car['CLIENTE_AP_ESPOSO']." ".
					     $lin_car['CLIENTE_NOMBRES']." ".
					     $lin_car['CLIENTE_AP_PATERNO']." "."VDA DE" ;  
					 }
					 if ($civ > 3){ 
					    $nom_cli = $lin_car['CLIENTE_AP_PATERNO']." ".
				 	    $lin_car['CLIENTE_AP_MATERNO']." ".
					    $lin_car['CLIENTE_NOMBRES']." ";  
					 }
			       }
			      if ($sex == 2){ 
					$nom_cli = $lin_car['CLIENTE_AP_PATERNO']." ".
					$lin_car['CLIENTE_AP_MATERNO']." ".
					$lin_car['CLIENTE_NOMBRES']." ";  
			       }
			
			if ($tip_ope == 1){
			    $tipo_op =  "M3";
			}	
			if ($tip_ope > 1){
			    $tipo_op =  "M0";
			}	
			if (($tip_ope < 3) && ($imp_ind > 0) && ($c_grup <> "")){
		         $rela = "4A";
			}
			if (($rel == "C")&& ($tip_ope == 3) && ($imp_ind > 0)){
		         $rela = "1A";
			}	 
			if (($rel == "D")&& ($imp_ind == 0)){
		         $rela = "2";
			}

			$consulta = "insert into cred_infocred (IDDOCIDE, 
                                                    DI,
										            NOMBCOM,
										            EXTOBL,
									                SIGLA,
									                TIPOBLI,
										            OPERACION,
										            TIPO_CRED,
										            OBJ_CRED,
										            FEC_DES,
									                IMPORTE,
					                                FEC_VENC,
					                                DIAS_M,
   				                                    VIGENTE,
					                                VENCIDO,
										            EJECUCION,
										            CASTIGO,
										            CONTINGEN,
										            CALIFICA,
										            PERD_CTA,
										            TIP_CAN,
										            MONEDA,
										            DOC_ANT,
									                FEC_FIN, 
									                GRUPO)				     
									     values ('1001',
										          $nro_ci,
												  '$nom_cli',
												  '$ext_ci',
										          'PDES',
										          '$rela',
									              '$cod_cre',
												  '$tipo_op',
												  'ON3',
												  '$f_de',
												  $impor,
												  '$f_ve',
												  $dias,
												  $vig,
												  $ven,
												  $eje,
												  0,
												  0,
												 '$cali',
												 '$for_pag',
												 1,
												 '$mon_d',
												 '',
 											     '$f_vto',
												 '$nom_grp'
												  )";
$resultado = mysql_query($consulta)or die('No pudo insertar cred_infocred : ' . mysql_error());
//Castigados
/*	
			*/
		?>
	
		
	<tr>
	   <td align="left" ><?php echo "1001"; ?></td>
	    <td align="left" style="font-size:10px"><?php echo $nro_ci; ?></td>
	    <td align="left" style="font-size:10px" ><?php echo $nom_cli; ?></td>
	    <td align="left" style="font-size:10px"><?php echo $ext_ci; ?></td>
	    <td align="right" ><?php echo "PDES"; ?></td>
		 <td align="center" style="font-size:10px" ><?php echo $rela; ?></td>	
		 <td align="right" style="font-size:10px"><?php echo $cod_cre; ?></td>
		 <td align="left" style="font-size:10px" ><?php echo $tipo_op; ?></td>
		 <td align="left" style="font-size:10px" ><?php echo "ON3"; ?></td>
		 <td align="left" style="font-size:10px" ><?php echo $f_de; ?></td>
		 <td align="right" ><?php echo number_format($impor, 2, '.',','); ?></td>
		 <td align="left" style="font-size:10px" ><?php echo $f_ve; ?></td>
		 <td align="center" ><?php echo number_format($dias, 0, '.',','); ?></td>
	 	<td align="right" ><?php echo number_format($vig, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($ven, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($eje, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="center" ><?php echo $cali; ?></td>
		 <td align="center" ><?php echo $for_pag; ?></td>
		 <td align="center" ><?php echo "1"; ?></td>
		 <td align="center" ><?php echo $mon_d; ?></td>
		  <td align="center" ><?php echo ""; ?></td>
		  <td align="center" ><?php echo $f_vto; ?></td>
		<td align="left" style="font-size:10px"><?php echo $nom_grp; ?></td>
				
	</tr>	
	
	<?php					 	
	//$nro = $nro + 1;	 
		}	 	 
	           } // 1b	   			
	?>
	<tr>
	    <th align="left" ><?php echo encadenar(5); ?></th>
	    <th align="center" ><?php echo "Total"; ?></th>
	    <th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="right" ><?php echo number_format($t_vig, 2, '.',','); ?></th>
		<th align="right" ><?php echo number_format($t_ven, 2, '.',','); ?></th>
		<th align="right" ><?php echo number_format($t_eje, 2, '.',','); ?></th>
		<th align="right" ><?php echo number_format(0, 2, '.',','); ?></th>
		<th align="right" ><?php echo number_format(0, 2, '.',','); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>
	</tr>	
</table>
<br><br>
</center>		

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

