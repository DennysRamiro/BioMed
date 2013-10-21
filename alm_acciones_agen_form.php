<?php
session_start();
if(!isset($_SESSION['login']) || !isset($_SESSION['clave'])){
    header("Location: index.php?error=1");
} 
require('configuracion.php');
require('funciones.php');
$log = $_SESSION['login'];
$fecha=$_POST['fec'];
$fech = cambiaf_a_mysql($fecha);

$unico= uniqid(); // genera codigo unico

if($_GET['tp'] == 'registrar'){
			$query = mysql_query("INSERT INTO alm_age_adu_tra (alm_age_adu_tra_id,alm_age_adu_tra_cod, alm_age_adu_tra_id_age, alm_age_adu_tra_nro_fac, alm_age_adu_tra_fecha, alm_age_adu_tra_cod_sidu,alm_age_adu_tra_est, alm_age_adu_tra_usr_alta, alm_age_adu_tra_fch_alta) 
VALUES (null,'$unico','".utf8_encode(strtoupper($_POST['age']))."',".utf8_encode(strtoupper($_POST['nro_fac'])).",'$fech','".utf8_encode(strtoupper($_POST['nro_sid']))."','1','".$_SESSION['login']."',CURRENT_TIMESTAMP); ") or die ('mallll 1');

        $item=$_POST['item'];
		$descrip=$_POST['des'];
		$monto=$_POST['monto'];
		$fact=$_POST['factura'];
		 $fact2=$_POST['item'];
		 
		 $total = count($fact2);
		 $n = count($fact);
		
		//los checkbox no tiqueados le ponemos  de vlaor "1"	
		for ($i = 0; $i < $total; $i++) {
			for ($j = 0; $j < $n; $j++) {
				if($fact2[$i]==$fact[$j]){
					$fact2[$i]='true';
					
				}
			}
		}
		//los checkbox no tiqueados le ponemos  de vlaor "0"
		 $total1 = count($fact2);
		for ($i = 0; $i < $total1; $i++) {
			if($fact2[$i]!='true'){
					$fact2[$i]='false';
					
				}
		}
				//print_r($fact2);?><br><?php
		/*valores de los checkbox se lo cambia a enteros True=1 y False=0
		* esto por que surgi prolemas con el codigo del item 
		*/
		for ($i = 0; $i < $total1; $i++) {
			if($fact2[$i]=='true'){
					$fact2[$i]=1;
				}else {
					$fact2[$i]=0;
					} 
		}
		//print_r($fact2);
        for ($i = 0; $i < $total; $i++) {
		
			 $sql=(" INSERT INTO alm_age_adu_tra_det(alm_age_adu_tra_det_id, alm_age_adu_tra_det_cod, alm_age_adu_tra_det_item, alm_age_adu_tra_det_descrip, alm_age_adu_tra_det_monto, alm_age_adu_tra_det_factura, alm_age_adu_det_usr_alta, alm_age_adu_det_fch_alta) VALUES (null,'$unico','$item[$i]','".utf8_encode(strtoupper($descrip[$i]))."','$monto[$i]','$fact2[$i]','".$_SESSION['login']."',CURRENT_TIMESTAMP);"); 
	
										
	
$query1 = mysql_query($sql) ;
				//echo $item[$i].'-'.$descrip[$i].'-'.$monto[$i];
				//echo $sql1; 
				
           } 


	if($query && $query1){
		header('Location: alm_agencia.php?msg=1');
	
	}else{
		//header('Location: alm_alta_agen.php.php?msg=0');
		echo 'no';
		}
}

ob_end_flush();
?>