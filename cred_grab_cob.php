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
	
//	 $fec = leer_param_gral();
	$tc_ctb  = $_SESSION['TC_CONTAB'];	
?>
<html>
<head>
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <a href='menu_s.php'>Salir</a>
  </div>
  <strong> 
<?php	
	 $_SESSION['msg_err'] = "";	  
	/*	 $con_emp = "Select *  From gral_empresa ";
         $res_emp = mysql_query($con_emp)or die('No pudo seleccionarse tabla gral_empresa');
 	     while ($lin_emp = mysql_fetch_array($res_emp)) {
		        $emp_nom = $lin_emp['GRAL_EMP_NOMBRE'];
				$emp_ger = $lin_emp['GRAL_EMP_GERENTE'];
				$emp_cig = $lin_emp['GRAL_EMP_GER_CI'];
				$emp_dir = $lin_emp['GRAL_EMP_DIREC'];
		  }*/
//if(isset($_SESSION['fec_proc'])){ 
 // $fec_p = $_SESSION['fec_proc']; 
 // }	
 	  
//echo encadenar(2).$emp_nom.encadenar(41)."Cochabamba".encadenar(3).$_SESSION['fec_proc'];		  
?>
<strong> 
<?php
$nom_ases = "";
$comif = 0;
$impsc = 0;
$imp = 0;
$desc ="";
if(isset($_SESSION['login'])){   
   $log_usr = $_SESSION['login']; 
   }
if(isset($_SESSION['ncre'])){ 
   $ncre = $_SESSION['ncre'];
}
if(isset($_SESSION['nom_grp'])){ 
   $nom_grp = $_SESSION['nom_grp'];
}else{
   $nom_grp = "-";
}
//echo $_SESSION['ncre']."ncre";
if(isset($_SESSION['nom_cli'])){ 
   $nom_cli = $_SESSION['nom_cli'];
   }else{
   $nom_cli = "";
}
if(isset($_SESSION['total_s'])){ 
   $total_s= $_SESSION['total_s'];
   }else{
   $total_s = 0;
}
//$total = 0;

//$f_tra = cambiaf_a_mysql_2($fec_p);
//echo $fec_p, $f_tra;
$_SESSION['msg_err'] = " ";
//$log_usr = $_SESSION['login'];
if(isset($_POST['fec_nac'])){  
   $fec_p = $_POST['fec_nac'];
   $f_tra = cambiaf_a_mysql_2($fec_p);
   }
/* if(isset($_POST['descrip'])){  
   $desc = $_POST['descrip'];
   $desc = strtoupper($desc);
   
   } */  
  //if ($_SESSION['continuar'] == 2){

	
//	}
if (isset($_SESSION["total_s"])){
    $importe_1 = $_SESSION["total_s"];
    }else{
    $importe_1 = 0;
   }
 if (isset($_SESSION["importe_2"])){
    $importe_2 = $_SESSION["importe_2"];
    }else{
    $importe_2 = 0;
   }  
 $mon = 0;  
   
  // if ($_SESSION['dep_ret'] == 2){
    //  $imp = $_SESSION['imp'];
    //}   
  
 
// if($_SESSION['cod_mon'] == 1){ 
 //  $eqv = $imp;
//}  
//echo $imp,$eqv;
//if($_SESSION['cod_mon'] == 2){ 
  
 //  $eqv = $imp;
  // $imp = $imp * $tc_ctb;
//}     
//if(isset($_SESSION['cod_cta2'])){    
  // $cod_cta2 = $_SESSION['cod_cta2'];
  // }
//if(isset($_SESSION['cod_cta1'])){    
  // $cod_cta1 = $_SESSION['cod_cta1'];
   //}
$deb_hab1 = 0;
$deb_hab2 = 0; 
 echo  "Cta."." ".$ncre ." ".$_SESSION['nom_grp']." / ".$_SESSION['nom_cli']; 
/*if($_SESSION['dep_ret'] == 1){
    $des_tra = "Deposito";
    $tip_tra = 1;
	$tip_ope = 1;
	$deb_hab1 = 1;
	$deb_hab2 = 2; 
	$desc1 = "DEPOSITO FONDO GARANTIA";
	
	$desc2 = "Depositado por";
}

if ($_SESSION['dep_ret'] == 2){
   
  
    $eqv = $eqv * -1;
   $imp = $imp * -1;
    $des_tra = "Retiro";
    $tip_tra = 2;
	$tip_ope = 2;
	$deb_hab1 = 2;
	$deb_hab2 = 1;
	$desc1 = "RETIRO FONDO GARANTIA "; 
//	$desc3 = "RETIRO FONDO GARANTIA Cta."." ".$cta_fon; 
	$desc2 = "Retirado por";
	
}

 $apli = 11000;
 $nro_tr_caj = leer_nro_co_cja($apli,$log_usr);
 
 $agen = 32;
 $nro_tr_fond = leer_nro_co_fon($tip_tra,$log_usr);
 */ 
//echo $tip_tra, $nro_tr_fond;
 //Grabar Tablas
 //Caja
/* $con_fga  = "Select * From  fond_maestro where  FOND_NRO_CTA = $cta_fon and FOND_MAE_USR_BAJA is null"; 
$res_fga = mysql_query($con_fga)or die('No pudo seleccionarse fond_maestro');
   while ($lin_fga = mysql_fetch_array($res_fga)) {
          $top = $lin_fga['FOND_TIPO_OPER'];
		  if ($top == 1) {
		      $top_des = "Relacionada a Credito";
			 }
		   if ($top == 2) {
		      $top_des = "Particular";
			 }
   
   } */
  $consulta = "insert into cart_cobro (CART_COB_NCRE, 
                                       CART_COB_CLI,
									   CART_COB_GRP,
									   CART_COB_FECHA,
									   CART_COB_FEC_CTA,
					                   CART_COB_MON,
					                   CART_COB_IMPO_O,
   				                       CART_COB_IMPO_M,
					                   CART_COB_USR_ALTA,
                                       CART_COB_FCH_HR_ALTA,
									   CART_COB_USR_BAJA,
									   CART_COB_FCH_HR_BAJA
									   ) values ($ncre,
									             '$nom_cli',
									             '$nom_grp',
												 '$f_tra',
												 '$f_tra',
												 $mon,
												 $importe_1,
												 $importe_2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_transac : ' . mysql_error());
//$_SESSION['fechr_proc'] = leer_fechr_pro($nro_tr_caj);

//Fondo Garantia
 
  
 // echo encadenar(5)."_____________________", encadenar(15),"_____________________";
  ?>
  <br>
 <?php
  
 // echo encadenar(12)."INTERESADO", encadenar(40),"     CAJERO";
  ?>



 <?php
  
 // echo encadenar(10)."Antes de firmar verifique los datos";
  ?>
 
 <?php
 // Impresion Comprobante Fondo Garantia
 /*
 
  */
  ?>
  
<?php
}
ob_end_flush();
 ?>
 
                   