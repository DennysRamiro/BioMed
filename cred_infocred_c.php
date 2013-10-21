<?php
	  ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
	if(!isset($_SESSION['login']) || !isset($_SESSION['clave'])){
    header("Location: index.php?error=1");
} else {
	require_once('configuracion.php');
    require_once('funciones.php');
?>
<html>
<head>
<!--Titulo de la pestaña de la pagina-->
<title>Tipo Reporte</title>
<meta charset="UTF-8">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script> 
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script type="text/javascript" src="js/ModulosCreditosInfoCred.js"></script>
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
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
                    
                     <img src="img/edit file_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. CREDTOS
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/flag red_24x24.png" border="0" alt="Modulo" align="absmiddle"> DATOS INFOCRED CASTIGADOS
                    
                 </li>
              </ul>
    
<div id="contenido_modulo">

                      <h2> <img src="img/flag red_64x64.png" border="0" alt="Modulo" align="absmiddle"> DATOS INFOCRED CASTIGADOS</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
                             <img src="img/alert_32x32.png" align="absmiddle">
                            Numero Operacion para reasignación de Asesor 
                        </div>

<?php
// $fec = leer_param_gral();
 $logi = $_SESSION['login']; 
?>
  <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <a href='cred_infocre.php'>Salir</a>
  </div>

<br><br>
<?php
$f_des = "";
//ESTAS DOS VARIABLES LAS DESCOMENTE PARA QUE EL FORMULARIO NO TENGA ERROR
$f_has2 = "2011-02-26";
$f_has = "26-02-2011";
$mone = " ";
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
 if(isset($_POST['fec_has'])){
      $f_has = $_POST['fec_has'];
      $_SESSION['f_has'] = $f_has;
	  $f_has2 = cambiaf_a_mysql($f_has);
  } 
  if(isset($_POST['cod_mon'])){
      $mone = $_POST['cod_mon'];
      $_SESSION['mone'] = $mone;
  } 
 */  
?> 
<font size="+1"  style="" >
<?php
//if ($mone == 1){
    echo encadenar(45)."INFOCRED EN ".encadenar(2). "BOLIVIANOS";
//  }
 //if ($mone == 2){
  //  echo encadenar(45)."LISTADO DE DESEMBOLSOS DE CARTERA EN ".encadenar(2). "DOLARES";
  //} 
?>
</font>
<br>
<font size="+1"  style="" >
<?php
echo encadenar(70)."AL".encadenar(3).$f_has2;
?>
</font>
<center>
<br><br>
<font size="0"  style="" >
	 <table border="1" width="1000">
	
	<tr>
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
	$t_tot  = 0;
	$nom_cli = "";
	$ap_pater = "";
	$ap_mater = "";
	$ap_espo = "";

	$tc_contab = $tc_contab = leer_tipo_cam_2($f_has2);				
	$con_tpa = "Select CART_NRO_CRED,CART_COD_MON,CART_IMPORTE,CART_TIPO_CRED,CART_OFIC_RESP,
	            CART_TIPO_OPER,CART_FORM_PAG,CART_FEC_DES
	            From cart_maestro where
	            CART_ESTADO = 8";
    $res_tpa = mysql_query($con_tpa)or die('No pudo seleccionarse tabla cart_califica 1')  ;
	
	    while ($lin_tpa = mysql_fetch_array($res_tpa)) { // 1a
		    $vig = 0;
	        $ven = 0;
	        $eje = 0;
	        $cas = 0;
			$pag = 0;
			$saldo = 0;
		   //	$estado = $lin_tpa['cart_cal_est'];
			$impor = $lin_tpa['CART_IMPORTE'];
			$mon = $lin_tpa['CART_COD_MON'];
			$cod_cre = $lin_tpa['CART_NRO_CRED'];
			$f_des = $lin_tpa['CART_FEC_DES'];
			$fec_v = cta_venf($cod_cre);
			$t_cred = $lin_tpa['CART_TIPO_CRED'];
			$ases = $lin_tpa['CART_OFIC_RESP'];
			$nom_of  = leer_nombre_usr($t_cred,$ases);
			//$f_ven1 = "0000/00/00";
			$f_ve1 = cambiaf_a_normal($fec_v);
			$cali = "F";
			$f_pag = $lin_tpa['CART_FORM_PAG'];
			$f_des = $lin_tpa['CART_FEC_DES'];
					$f_de = cambiaf_a_normal($f_des);
					$f_vtof = vto_fin($cod_cre);
		            $f_vto= cambiaf_a_normal($f_vtof);
		//	$con_fven  = "Select * From cart_plandp where CART_PLD_NCRE=$cod_cre
		//	              and MONTH(CART_PLD_FECHA)= $mes and year(CART_PLD_FECHA)=$anio
		//				  and CART_PLD_USR_BAJA is null
		//				  ORDER BY CART_PLD_FECHA DESC LIMIT 0,1";
 
          //  $res_fven = mysql_query($con_fven)or die('No pudo leer : car_plandp ' . mysql_error()) ;
	      //  while ($lin_fven = mysql_fetch_array($res_fven)) {
	       //       $f_ven = $lin_fven['CART_PLD_FECHA'];
	//			  $f_ve = cambiaf_a_normal($f_ven);
	//	  }
		  
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
		  
		  
			//$con_ctat  = "Select CART_PLD_FECHA From cart_plandp where CART_PLD_NCRE = $cod_cre 
		     //             and CART_PLD_USR_BAJA is null ORDER BY CART_PLD_FECHA DESC LIMIT 0,1"; 
            // $res_ctat = mysql_query($con_ctat)or die('No pudo seleccionarse cred_plandp');
	        // $f_fin = "0000-00-00";
			// $fec_v = cambiaf_a_normal($fec_v);
		    // while ($lin_ctat = mysql_fetch_array($res_ctat)){
		     //       $f_fin = $lin_ctat['CART_PLD_FECHA'];          
			 // }
	                 		
			//$dias = $lin_tpa['cart_cal_dias'];
			$nom_grp = "";
//			echo $cod_cre,$f_has2;
			$pag = montos_recuperados($cod_cre,$f_has,1);
//			echo $pag." "."pagado";
					$f_pag = $lin_tpa['CART_FORM_PAG'];
					$f_des = $lin_tpa['CART_FEC_DES'];
					$impo = $lin_tpa['CART_IMPORTE'];
			$saldo = $impo - $pag;
			if ($mon == 2){
			    $mon_d = "ME";
			    $t_tot = $t_tot + round($saldo * $tc_contab,2);
				$saldo = round($saldo * $tc_contab,2);
				$impo = round($impo * $tc_contab,2);
			    }else{
				$t_tot = $t_tot + $saldo;
				$mon_d = "MN";
			}
			$monto = $saldo;
			$cas = $monto;
			$t_cas = $t_cas + $cas;
		/*	if ($dias < 0){
			    $vig = $saldo;
	            $ven = 0;
	            $eje = 0;
	            $cas = 0;
				$t_vig = $t_vig + $vig;
			}
			if (($dias > 0) && ($dias < 91)){
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
			} */
				//Consulta Cart_maestro
		
			$con_car  = "Select CART_NRO_CRED,CART_COD_GRUPO,CART_DEU_RELACION, CART_DEU_IMPORTE,
			                    CART_TIPO_OPER,CART_IMPORTE,
			                    CLIENTE_AP_PATERNO,CLIENTE_AP_MATERNO,CLIENTE_AP_ESPOSO,
								CLIENTE_NOMBRES,CLIENTE_COD_ID,
								CLIENTE_SEXO,CLIENTE_EST_CIVIL,CLIENTE_FCH_NAC,CLIENTE_DIRECCION
								From cart_maestro, cart_deudor, cliente_general
             where CART_NRO_CRED = $cod_cre and CART_DEU_NCRED = CART_NRO_CRED
             and CLIENTE_COD_ID = CART_DEU_ID and CART_ESTADO = 8 
			 and CART_DEU_USR_BAJA is null and  CART_MAE_USR_BAJA is null
			 and CLIENTE_USR_BAJA is null"; 
             $res_car = mysql_query($con_car)or die('No pudo seleccionarse cart_maestro, cart_deudor, cliente_general');
 
             while ($lin_car = mysql_fetch_array($res_car)) {
			       $cod_cre = $lin_car['CART_NRO_CRED'];
					$impo = $lin_car['CART_IMPORTE'];
			        $rel = $lin_car['CART_DEU_RELACION'];
					$imp_ind = $lin_car['CART_DEU_IMPORTE'];
					$tip_ope = $lin_car['CART_TIPO_OPER']; 
			        $c_grup = $lin_car['CART_COD_GRUPO']; 
					$cod_id = $lin_car['CLIENTE_COD_ID'];
					$cod_id = rtrim($cod_id);
					$nro_char = strlen($cod_id);
					$nro_ci = substr($cod_id,0,$nro_char-2);
					$ext_ci = substr($cod_id,$nro_char-2,2);
					$nom_cli = $lin_car['CLIENTE_NOMBRES'];
					$ap_pater = $lin_car['CLIENTE_AP_PATERNO'];
					$ap_mater = $lin_car['CLIENTE_AP_MATERNO'];
					$ap_espo = $lin_car['CLIENTE_AP_ESPOSO'];
					$nom = $lin_car['CLIENTE_NOMBRES'];
					$pat = $lin_car['CLIENTE_AP_PATERNO'];
					$mat = $lin_car['CLIENTE_AP_MATERNO'];
					$esp = $lin_car['CLIENTE_AP_ESPOSO'];
					$dir = $lin_car['CLIENTE_DIRECCION'];
					$sex = $lin_car['CLIENTE_SEXO'];
					$civ = $lin_car['CLIENTE_EST_CIVIL'];
					$refer = "";  
			        
					
					
					
			if ($c_grup <> ""){			
			$con_grp = "Select * From cred_grupo where CRED_GRP_CODIGO = $c_grup and CRED_GRP_USR_BAJA is null";
            $res_grp = mysql_query($con_grp)or die('No pudo seleccionarse tabla cred_grupo')  ;
	        while ($lin_grp = mysql_fetch_array($res_grp)) {
	              $nom_grp = $lin_grp['CRED_GRP_NOMBRE'];
	//		      $nom_cli = $lin_car['CLIENTE_AP_PATERNO'].encadenar(1)."/".encadenar(1).$nom_grp;		
				}	
			}	
			 $estado = 4;
			
			$con_civ  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 11 and GRAL_PAR_PRO_COD = $civ";
$res_civ = mysql_query($con_civ)or die('No pudo seleccionarse tabla 7')  ;
while ($linea = mysql_fetch_array($res_civ)) {
      $civ_r = $linea['GRAL_PAR_PRO_DESC'];
}	
						
					 
					$f_nac = $lin_car['CLIENTE_FCH_NAC'];
					$f_na = cambiaf_a_normal($f_nac);
                
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
			
			
			
			
			
			
			if ($f_pag == 4){	
			   $f_pag = 3; 
			}	
			if ($f_pag == 7){	
			   $f_pag = 6; 
			}
			 if ($tip_ope == 3){
		         $t_ope = "M0";	     
			 }  
			 if ($tip_ope == 1){
		         $t_ope = "M3";	     
			 } 
			 if (($tip_ope == 2) and ($c_grup <> "")){
		         $t_ope = "M3";	     
			 } 
			 if (($tip_ope == 2) and ($c_grup == "")){
		         $t_ope = "M0";	     
			 }  
			$f_de = cambiaf_a_normal($f_des);
			//$f_fi = cambiaf_a_normal($f_fin);
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
			
			$dias = 0;
            $fec_ven = cta_venf($cod_cre);
			$f_ve = cambiaf_a_normal($fec_ven);
		//	echo "fec_ven".$fec_ven;
			$fec_ve = cambiaf_a_normal($fec_ven);			
				$ano1 = substr($f_has, 6,4); 
                $mes1 = substr($f_has, 3, 2); 
                $dia1 = substr($f_has, 0, 2);
                $ano2 = substr($fec_ve, 6,4); 
                $mes2 = substr($fec_ve, 3, 2); 
                $dia2 = substr($fec_ve, 0, 2);
			//	$cap = round( $cap - $c_kap,2);
			//	}
        $timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1); 
        $timestamp2 = mktime(0,0,0,$mes2,$dia2,$ano2); 
        $segundos_diferencia = $timestamp1 - $timestamp2; 
		 $dias = round( ($segundos_diferencia / (60 * 60 * 24)),0); 
		 
			
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
												  0,
												  0,
												  0,
												  $cas,
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
		 <td align="left" style="font-size:10px" ><?php echo $f_ve1; ?></td>
		 <td align="center" ><?php echo number_format($dias, 0, '.',','); ?></td>
	 	<td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($cas, 2, '.',','); ?></td>
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
		}	 
				 
	      //     } // 1b
		
			   			
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
		<th align="right" ><?php echo number_format(0, 2, '.',','); ?></th>
		<th align="right" ><?php echo number_format(0, 2, '.',','); ?></th>
		<th align="right" ><?php echo number_format(0, 2, '.',','); ?></th>
		<th align="right" ><?php echo number_format($t_cas, 2, '.',','); ?></th>
		<th align="right" ><?php echo number_format(0, 2, '.',','); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>
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

