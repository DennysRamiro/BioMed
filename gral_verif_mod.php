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
        <title>Verificar cierre de Modulos</title>
        <script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
        <link href="css/estilo.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="js/CambiarFecha.js"></script>
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
         <li id="menu_modulo_general">
            <img src="img/applications_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO GENERAL
        </li>
        <li id="menu_modulo_fecha_cambio">
            <img src="img/calendar_24x24.png" border="0" alt="Modulo" align="absmiddle"> CAMBIO DE FECHA
        </li>
       </ul>  
    
      <div id="contenido_modulo">
    <h2> <img src="img/calendar_64x64.png" border="0" alt="Modulo" align="absmiddle"> CAMBIO DE FECHA
    </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
          Verificando cierre de Módulos
 </div>
		
        <!--strong> <center><font size="+2"> Verificando cierre de Módulos </font></center></strong--> 
	
				<?php
          $f_proc1 = cambiaf_a_mysql_2($fec);
		//  echo $fec."--".$f_proc1;
			   
		  $cuantos = 0;
          $cart = 0;
		  $cart_tras = 0;
          $caja = 0;
          $fgar = 0;
		  $comven = 0;
		  $ingegre = 0;
		  $bancos = 0;
		  $factura = 0;
		  $almacen = 0;
		  $ventas = 0;
		  $caja_ch = 0;
		  $_SESSION['cart'] = 0;
		  $_SESSION['cart_tras'] = 0;
		  $_SESSION['caja'] = 0;
		  $_SESSION['fgar'] = 0;
		  $_SESSION['comven'] = 0;
		  $_SESSION['ingegre'] = 0;
		  $_SESSION['bancos'] = 0;
		  $_SESSION['factura'] = 0;
		  $_SESSION['almacen'] = 0;
		  $_SESSION['ventas'] = 0;
		  $_SESSION['caja_ch'] = 0;
	        $con_trc = "SELECT count(*) 
                      FROM gral_cierre_mod 
                      WHERE GRAL_CIERR_MOD_FCH_CIERRE='$f_proc1'";
          $res_trc = mysql_query($con_trc);
          while ($lin_trc = mysql_fetch_array($res_trc)) {
                $cuantos =  $lin_trc['count(*)'];
           }
		    //echo $cuantos;	
			 $consulta  = "SELECT GRAL_PAR_PRO_COD 
                        FROM gral_param_propios 
                        WHERE GRAL_PAR_PRO_GRP=100 and GRAL_PAR_PRO_CTA2 = '1'";
          $resultado = mysql_query($consulta);
			    while ($linea = mysql_fetch_array($resultado)) {
                       $modulo = $linea ['GRAL_PAR_PRO_COD'];
				    //   echo $modulo;
					   
				  switch($modulo) {
                    case 6000:
					     $nro = 0;
						 $cuan = 0;
					     $con_trc = "SELECT count(*) 
                                     FROM cart_cabecera 
                                     WHERE CART_CAB_FECHA = '$f_proc1'
                                     and CART_CAB_USR_BAJA IS NULL";
                         $res_trc = mysql_query($con_trc);
                         while ($lin_trc = mysql_fetch_array($res_trc)) {
                                $nro =  $lin_trc['count(*)'];
								
                               }
						 if ($nro > 0) {
						   //   echo $nro."aquiii".$f_proc1;	  
					         $con_cie = "SELECT count(*) 
                                         FROM gral_cierre_mod 
                                         WHERE GRAL_CIERR_MOD_FCH_CIERRE='$f_proc1' 
										 AND GRAL_CIERR_MOD_APL = 6000";
                             $res_cie = mysql_query($con_cie);
                             while ($lin_cie = mysql_fetch_array($res_cie)) {
                                    $cuan =  $lin_cie['count(*)'];
                                    }
							 if ($cuan == 0) {
							     $cart = 1;
							     $_SESSION['cart'] = 1;
							 }
						 }
						 //echo $cart."-cart-".$nro."***";	 
                            break;
					case 16000:
					     $nro = 0;
						 $cuan = 0;
					     $con_trc = "SELECT count(*) 
                                     FROM factura 
                                     WHERE FACTURA_FECHA = '$f_proc1'
                                     and FACTURA_USR_BAJA IS NULL";
                         $res_trc = mysql_query($con_trc);
                         while ($lin_trc = mysql_fetch_array($res_trc)) {
                                $nro =  $lin_trc['count(*)'];
                               }
						 if ($nro > 0) {
						      $con_cie = "SELECT count(*) 
                                         FROM gral_cierre_mod 
                                         WHERE GRAL_CIERR_MOD_FCH_CIERRE='$f_proc1' 
										 AND GRAL_CIERR_MOD_APL = 16000";
                             $res_cie = mysql_query($con_cie);
                             while ($lin_cie = mysql_fetch_array($res_cie)) {
                                    $cuan =  $lin_cie['count(*)'];
                                    }
							 if ($cuan == 0) {
							     $factura = 1;
  						         $_SESSION['factura'] = 1;
							 }	   
					        
						 }
						 //echo $factura."-fac-".$nro."***";	 
                            break;	
                    case 13000:
					     $nro = 0;
						 $cuan = 0;
					     $con_trc = "SELECT count(*) 
                                     FROM caja_ing_egre 
                                     WHERE caja_ingegr_fecha = '$f_proc1'
                                     and caja_ingegr_usr_baja IS NULL";
                         $res_trc = mysql_query($con_trc);
                         while ($lin_trc = mysql_fetch_array($res_trc)) {
                                $nro =  $lin_trc['count(*)'];
                               }
						 
						     if ($nro > 0) {
						      $con_cie = "SELECT count(*) 
                                         FROM gral_cierre_mod 
                                         WHERE GRAL_CIERR_MOD_FCH_CIERRE='$f_proc1' 
										 AND GRAL_CIERR_MOD_APL = 13000";
                             $res_cie = mysql_query($con_cie);
                             while ($lin_cie = mysql_fetch_array($res_cie)) {
                                    $cuan =  $lin_cie['count(*)'];
                                    }
							 if ($cuan == 0) {
							      $ingegre = 1;
  						     $_SESSION['ingegre'] = 1;
							 }	   	   
					        
						 }
						 //echo $ingegre."-ing egr-".$nro."***";	 
                            break;
					case 14000:
					     $nro = 0;
						 $cuan = 0;
					     $con_trc = "SELECT count(*) 
                                     FROM caja_com_ven 
                                     WHERE caja_comven_fecha = '$f_proc1'
                                     and caja_comven_usr_baja IS NULL";
                         $res_trc = mysql_query($con_trc);
                         while ($lin_trc = mysql_fetch_array($res_trc)) {
                                $nro =  $lin_trc['count(*)'];
                               }
						 if ($nro > 0) {
						      $con_cie = "SELECT count(*) 
                                         FROM gral_cierre_mod 
                                         WHERE GRAL_CIERR_MOD_FCH_CIERRE='$f_proc1' 
										 AND GRAL_CIERR_MOD_APL = 14000";
                             $res_cie = mysql_query($con_cie);
                             while ($lin_cie = mysql_fetch_array($res_cie)) {
                                    $cuan =  $lin_cie['count(*)'];
                                    }
							 if ($cuan == 0) {
							     $comven = 1;
  						         $_SESSION['comven'] = 1;
							 }	   	   	   
					        
						 }
						 //echo $comven."-comven-".$nro."***";	 
                            break;		
                    case 15000:
					     $nro = 0;
						 $cuan = 0;
					     $con_trc = "SELECT count(*) 
                                     FROM caja_deposito
                                     WHERE CAJA_DEP_FECHA = '$f_proc1'
                                     and CAJA_DEP_USR_BAJA IS NULL";
                         $res_trc = mysql_query($con_trc);
                         while ($lin_trc = mysql_fetch_array($res_trc)) {
                                $nro =  $lin_trc['count(*)'];
                               }
						 if ($nro > 0) {
						     $con_cie = "SELECT count(*) 
                                         FROM gral_cierre_mod 
                                         WHERE GRAL_CIERR_MOD_FCH_CIERRE='$f_proc1' 
										 AND GRAL_CIERR_MOD_APL = 15000";
                             $res_cie = mysql_query($con_cie);
                             while ($lin_cie = mysql_fetch_array($res_cie)) {
                                    $cuan =  $lin_cie['count(*)'];
                                    }
							 if ($cuan == 0) {
							     $bancos = 1;
  						         $_SESSION['bancos'] = 1;
							 }	   	   	      
					         
						 }
						 //echo $bancos."-banco-".$nro."***";	 
                            break;		
                    case 20000:
					     $nro = 0;
						 $cuan = 0;
					     $con_trc = "SELECT count(*) 
                                     FROM alm_det_tran
                                     WHERE alm_det_tran_fech = '$f_proc1'
                                     and alm_det_tran_usr_baja IS NULL";
                         $res_trc = mysql_query($con_trc);
                         while ($lin_trc = mysql_fetch_array($res_trc)) {
                                $nro =  $lin_trc['count(*)'];
                               }
						 if ($nro > 0) {
						      $con_cie = "SELECT count(*) 
                                         FROM gral_cierre_mod 
                                         WHERE GRAL_CIERR_MOD_FCH_CIERRE='$f_proc1' 
										 AND GRAL_CIERR_MOD_APL = 20000";
                             $res_cie = mysql_query($con_cie);
                             while ($lin_cie = mysql_fetch_array($res_cie)) {
                                    $cuan =  $lin_cie['count(*)'];
                                    }
							 if ($cuan == 0) {
							     $almacen = 1;
  						         $_SESSION['almacen'] = 1;
							 }	   	  	   
					         
						 }
						// echo $almacen."-almacen-".$nro."***";	 
                            break;			    	  
                     }
          }
           $t_mod = $cart + $comven + $ingegre + $bancos + $factura + $almacen +  $ventas + $caja_ch;
		 //  echo "tmod--".$t_mod."--";
          if ($t_mod == 0) {
            // $va = 'gral_cam_fec.php'; 
            echo "<br />Cambiar Fecha <a href='gral_cam_fec.php'><img src='img/calendar_32x32.png' border='0' align='absmiddle'' alt=''/>Cambiar</a>";
            // include $va; 
          } else {
             //$va = 'gral_mod_sin.php';
           ?> <center> <?php echo "<br />Ver que Módulo(s) no cerraron        
			       <a href='gral_mod_sin.php'><img src='images/24x24/001_52.png' border='0' align='absmiddle'' alt='' />
				       Verificar</a>"; ?> </center> <?php
             //include $va;  
          }
          ?>
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