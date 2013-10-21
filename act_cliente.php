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
 
<?php
$nro = 1049;
$con_mcli  = "Select * From mig_cliente where tipo_ci > $nro"; 
 $res_mcli = mysql_query($con_mcli);
   while ($lin_mcli = mysql_fetch_array($res_mcli)) {
         $codigo = $lin_mcli['codigo'];
		 $ci = $lin_mcli['ci'];
		 $t_ci = $lin_mcli['tipo_ci'];
		 $nombres = $lin_mcli['nombres'];
		 $paterno = $lin_mcli['paterno'];
		 $materno = $lin_mcli['materno'];
		 $esposo = $lin_mcli['esposo'];
		 $fec_nac = $lin_mcli['fec_nac'];
		 $sexo = $lin_mcli['sexo'];
		 $est_civil = $lin_mcli['est_civil'];
		 $tip_viv = $lin_mcli['tip_viv'];
		 $direc = $lin_mcli['direc'];
		 $zona = $lin_mcli['zona'];
		 $fono_d = $lin_mcli['fono_d'];
		 $celu = $lin_mcli['celu'];
		 $vende = $lin_mcli['vende'];
		 $activ = $lin_mcli['activ'];
		 $conyuge = $lin_mcli['conyuge'];
		 $referencia = $lin_mcli['referencia'];
		 $nro = $nro + 1;
  
  $agen = 32;
  $usr = "super";
  if ($sexo == "F"){
    $sex = 1;
  }  
 if ($sexo == "T"){
    $sex = 2;
  }   
 if ($est_civil == "CASADO"){
    $est_c = 2;
  }  
 if ($est_civil == "CONCUBINO"){
    $est_c = 5;
  }  
 if ($est_civil == "DIVORCIADO"){
    $est_c = 4;
  }
  if ($est_civil == "SOLTERO"){
    $est_c = 1;
  }
  if ($est_civil == "VIUDO"){
    $est_c = 3;
  }
  
   if ($tip_viv == "AL"){
       $tip_v = 2;
  }  
  if ($tip_viv == "AN"){
       $tip_v = 3;
  }  
  if ($tip_viv == "FA"){
       $tip_v = 5;
  }  
  if ($tip_viv == "PR"){
       $tip_v = 1;
  } 
  if ($fono_d  == NULL){
       $fono_d = 0;
  } 
  if ($celu  == NULL){
       $celu = 0;
  } 
  
  echo $nro.encadenar(2).$codigo.encadenar(2).$ci.encadenar(2).$nombres.encadenar(2).
       $paterno.encadenar(2).$materno.encadenar(2).$esposo.encadenar(2). 
	 $fec_nac.encadenar(2).$sex.encadenar(2).$est_c.encadenar(2).$activ.
	 encadenar(2).$vende.encadenar(2).$tip_v.encadenar(2).$direc.encadenar(2)
	 .$zona.encadenar(2).$fono_d.encadenar(2).$celu.encadenar(2).$agen.encadenar(2).$conyuge.
	  encadenar(2).$usr ;	
 
// Maestro Cartera
  $consulta  = "Insert into cliente_general (CLIENTE_COD,
	                                           CLIENTE_NUMERICO,
	                                           CLIENTE_COD_ANT,
											   CLIENTE_TIP_PER,
                                               CLIENTE_TIP_ID,
											   CLIENTE_COD_ID,
											   CLIENTE_COD_EXP,
											   CLIENTE_NOMBRES,	
											   CLIENTE_AP_PATERNO,
											   CLIENTE_AP_MATERNO,
											   CLIENTE_AP_ESPOSO,
											   CLIENTE_FCH_NAC,
											   CLIENTE_LUG_NAC,
											   CLIENTE_SEXO,
											   CLIENTE_EST_CIVIL, 
											   CLIENTE_TRABAJO, 
											   CLIENTE_DIR_TRAB,
											   CLIENTE_ZON_TRAB,
											   CLIENTE_FONO_TRAB,
											   CLIENTE_PROFESION,
											   CLIENTE_ANT_ACT,
											   CLIENTE_CARGO,
											   CLIENTE_VIVIEN,
											   CLIENTE_ALFAB,
											   CLIENTE_CIIU,
											   CLIENTE_DIRECCION,
											   CLIENTE_ZONA,
											   CLIENTE_FONO,
											   CLIENTE_CELULAR,
											   CLIENTE_EMAIL,
											   CLIENTE_RUBRO,
											   CLIENTE_SECTOR1,
											   CLIENTE_SECTOR2,
											   CLIENTE_AGENCIA,
											   CLIENTE_CAL_INT,
											   CLIENTE_NOM_CONYUGE,
											   CLIENTE_CI_CONYUGE,
											   CLIENTE_NOM_REF,
											   CLIENTE_DIR_REF,
											   CLIENTE_FON_REF,
											   CLIENTE_USR_ALTA,
											   CLIENTE_FCH_HR_ALTA,
											   CLIENTE_USR_BAJA,
											   CLIENTE_FCH_HR_BAJA) values
											   ($nro,
											    $t_ci,
											    '$codigo',
											    1,
											    1,
											    '$ci',
											    null,
											    '$nombres',
											    '$paterno',
											   '$materno',
											    '$esposo',
											    '$fec_nac',
												null,
											    $sex,
											    $est_c,
											    '$vende',
												'$activ',
												null,
											    null,
											    null,
												null,
											    null,
											    $tip_v,
											    null,
											    null,
											    '$direc', 
											    '$zona',
											     $fono_d,
											    $celu,
											    null,
											    null,
											     null,
											     null,
											    $agen,
											    null,
											    '$conyuge',
											    null,
											    '$referencia',
											    null,
											    null,
											    null,
											     null,
											     null,
											     '0000-00-00 00:00:00')";

$resultado = mysql_query($consulta);

}
}
ob_end_flush();
 //Correlativos transaccion
/*($nro,
											    $nro,
											    '$codigo',
											    1,
											    1,
											    '$ci',
											    null,
											    '$nombres',
											    '$paterno',
											    '$materno',
											    '$esposo',
											    '$fec_nac',
												null,
											    $sex,
											    $est_c,
											    '$activ',
											    '$vende',
												null,
											    null,
											    null,
												null,
											    null,
											    $tip_v,
											    null,
											    null,
											    '$direc', 
											    '$zona',
											    $fono_d,
											    $celu,
											    null,
											    null,
											     null,
											     null,
											    $agen,
											    null,
											    '$conyuge',
											    null,
											    null,
											    null,
											    null,
											    '$usr',
											     null,
											     null,
											     '0000-00-00 00:00:00')";
*/	




 ?>
 
                      