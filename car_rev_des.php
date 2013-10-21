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
<title>Reversion Desembolso</title>
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
				 $fec1 = cambiaf_a_mysql_2($fec);
				 $logi = $_SESSION['login']; 
                ?> 
			</div>
            <div id="Salir">
            <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
            </div>
            <div id="TitleModulo">
            	 <img src="images/24x24/001_36.png" border="0" alt="Modulo">
                  Reimpresion Desembolso 
            </div>
<div id="AtrasBoton">
 	<a href="cja_reversion.php?modulo=<?php echo $_SESSION['modulo'];?>"><img src="images/24x24/001_23.png" border="0" alt= "Regresar" align="absmiddle">Atras</a>
</div>
 <center>

<?php
 $_SESSION['continuar'] = 0;
 //echo $_POST['nro_doc'],$_POST['fec_nac'];
if ($_POST['nro_doc'] > 0){
   $nro_doc = $_POST['nro_doc'];
 //  echo "nro_doc", $nro_doc;
   $consul = 1;
 }
 if (isset($_POST['fec_nac'])){
   $fech = $_POST['fec_nac'];
   $fecha = cambiaf_a_mysql_2($fech);
//echo $fecha. "DEntro";
   if ($fecha == "--"){
      $consul2 = 0;
	  }else{
	  $consul2 = 1;
	  }
 }
 
 // $consul2,"*",$consul,"*";
  ?> 
 <?php
/*
	*/
	   
?>
 <center>
 <div id="GeneralManUsuarioM">
<form name="form2" method="post" action="grab_retro_cja.php" >
<strong><font size="-1">
<?php
   echo "Trans.".encadenar(4)."Operacion".encadenar(22)."Cliente / Grupo";
 ?>
 </strong></font>
<select name="nro_desem" size="12" >


<?php
 	//Consulta Cart_maestro
			
	if (($consul + $consul2) == 2) {
	    echo "Aqui ",$fecha, $nro_doc;		
			$con_car  = "Select DISTINCT CART_DTRA_FECHA,CART_DTRA_NCRE, CART_DTRA_NRO_TRAN
			 from  cart_det_tran
             where CART_DTRA_FECHA = '$fecha'
			 and CART_DTRA_NRO_TRAN = $nro_doc
             and CART_DTRA_TIP_TRAN = 1 
			 and CART_DTRA_USR_BAJA is null"; 
             $res_car = mysql_query($con_car);
    }
	if ($consul == 1) {
	    echo "Aqui ",$fecha, $nro_doc;		
			$con_car  = "Select DISTINCT CART_DTRA_FECHA,CART_DTRA_NCRE, CART_DTRA_NRO_TRAN
			 from  cart_det_tran
             where CART_DTRA_NRO_TRAN = $nro_doc
             and CART_DTRA_TIP_TRAN = 1 
			 and CART_DTRA_USR_BAJA is null"; 
             $res_car = mysql_query($con_car);
    }
			
	if ($consul2 == 1) {
	    echo "Aqui ",$fecha, $nro_doc;		
			$con_car  = "Select DISTINCT CART_DTRA_FECHA,CART_DTRA_NCRE, CART_DTRA_NRO_TRAN
			 from  cart_det_tran
             where CART_DTRA_FECHA = '$fecha'
			 and CART_DTRA_TIP_TRAN = 1 
			 and CART_DTRA_USR_BAJA is null"; 
             $res_car = mysql_query($con_car);
    }
	
	
	
             while ($lin_car = mysql_fetch_array($res_car)) {
			        $ncre = $lin_car['CART_DTRA_NCRE'];
					$nro_tra = $lin_car['CART_DTRA_NRO_TRAN'];
					$fec_tra = $lin_car['CART_DTRA_FECHA'];
					$_SESSION['ncre']=$ncre;
			 $con_cli  = "Select * From  cart_deudor, cliente_general
             where  CART_DEU_NCRED = $ncre
             and CLIENTE_COD_ID = CART_DEU_ID and CART_DEU_RELACION = 'C' 
			 and CART_DEU_USR_BAJA is null "; 
             $res_cli = mysql_query($con_cli);
 
             while ($lin_cli = mysql_fetch_array($res_cli)) {
				 $nom_cli = $lin_cli['CLIENTE_AP_PATERNO'].encadenar(1).
					$lin_cli['CLIENTE_AP_MATERNO'].encadenar(1).
					$lin_cli['CLIENTE_AP_ESPOSO'].encadenar(1).
					$lin_cli['CLIENTE_NOMBRES'].encadenar(1); 
				}
		// maestro
		
		$con_cli  = "Select * From  cart_maestro
                     where  CART_NRO_CRED = $ncre
                     and CART_MAE_USR_BAJA is null "; 
        $res_cli = mysql_query($con_cli);
 
             while ($lin_cli = mysql_fetch_array($res_cli)) {
				 $c_grup = $lin_cli['CART_COD_GRUPO']; 
			}
				
				
			
		//	
		if ($c_grup <> ""){			
			$con_grp = "Select * From cred_grupo where CRED_GRP_CODIGO = $c_grup and CRED_GRP_USR_BAJA is null";
           $res_grp = mysql_query($con_grp);
	        while ($lin_grp = mysql_fetch_array($res_grp)) {
	              $nom_grp = $lin_grp['CRED_GRP_NOMBRE'];
	 		      $nom_cli = $nom_cli.encadenar(1)."/".encadenar(1).$nom_grp;		
				}	
			}	
			
?>

<option value=<?php echo $nro_tra;?>>
             <?php echo $nro_tra.encadenar(2); ?>  
	          <?php echo $ncre.encadenar(2); ?> 
			  <?php echo $fec_tra.encadenar(2); ?> 
		      <?php echo  $nom_cli; ?> 
			  
<?php 
}
//}
?>

</select><br><br>
<center>
   <input type="submit" name="accion" value="Reimpresion">
   <input type="submit" name="accion" value="Salir">
  </form>
<div id="FooterTable">
Elija la Transaccion 
</div>
<?php
//}
		 	include("footer_in.php");
		 ?>

</div>
</body>
</html>
<?php
}
    ob_end_flush();
 ?>