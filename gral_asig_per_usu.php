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
      <!--Titulo de la pestaña de la pagina-->
        <title>ASIGNACION DE PERMISOS</title>
        <meta charset="UTF-8">
        <script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
        <link href="css/estilo.css" rel="stylesheet" type="text/css">
        <script language="JavaScript" src="script/jquery-ui.js"></script>
        <script type="text/javascript" src="js/MantListaUsuario.js"></script>
    </head>
    <body>
        <?php
            include("header.php");
        ?>
		
    	<div id="pagina_sistema">
         	
            <ul id="lista_menu">
             <li id="menu_modulo">
                <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS             </li>
             <li id="menu_modulo_general">
                <img src="img/applications_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO GENERAL            </li>
            <li id="menu_modulo_fecha_cambio">
                <img src="img/tools_24x24.png" border="0" alt="Modulo" align="absmiddle"> MANT. USUARIO            </li>
            <li id="menu_modulo_mant_listausuarios">
                <img src="img/edit user_24x24.png" border="0" alt="Modulo" align="absmiddle"> ASIGNAR PERMISO            </li>
			<li id="menu_modulo_mant_listausuarios">
               <img src="img/redo_24x24.png" border="0" alt="Modulo" align="absmiddle"> ASIGNAR PERMISO MOD.           </li>
           </ul> 

           <?php 
		   $usu =$_SESSION['login'];
		   $fec = date('Y-m-d H:i:s');
		   
		   
		   $login =$_GET["log"];
            // Se realiza una consulta SQL
			$consulta ="SELECT p.GRAL_PAR_PRO_COD, p.GRAL_PAR_PRO_DESC, o.GRAL_OPC_PRG_COD,
			          	o.GRAL_OPC_PRG_DESCRIPCION,
			(SELECT u.GRAL_USR_LOGIN FROM gral_permiso_usuario AS u WHERE u.GRAL_OPC_PRG_COD=o.GRAL_OPC_PRG_COD 
			AND o.GRAL_OPC_STAT = 1
			AND u.GRAL_PER_COD_MOD=p.GRAL_PAR_PRO_COD AND u.GRAL_USR_LOGIN='$login') AS LOGIN,
			(SELECT u.GRAL_USR_ESTADO FROM gral_permiso_usuario AS u 
			WHERE u.GRAL_OPC_PRG_COD=o.GRAL_OPC_PRG_COD AND u.GRAL_PER_COD_MOD=p.GRAL_PAR_PRO_COD
			 AND u.GRAL_USR_LOGIN='$login') AS ESTADO 
			FROM gral_opciones_prg AS o, gral_param_propios AS p 
			WHERE o.GRAL_OPC_STAT='1' AND o.GRAL_OPC_PRG_MOD=p.GRAL_PAR_PRO_COD 
			ORDER BY o.GRAL_OPC_PRG_MOD, o.GRAL_OPC_PRG_COD;";
			
            $resultado = mysql_query($consulta);
            ?>
           <div id="contenido_modulo">
            <h2>
             <img src="img/redo_64x64.png" border="0" alt="Modulo" align="absmiddle"> ASIGNAR PERMISO
          </h2>
		
          <hr style="border:1px dashed #767676;">
			<strong>Usuario:<?php echo $login; ?></strong>   
			  <form name="form2" method="post" >
			  <center>
			    <table class="table_usuario" width="70%" align="left">
                    <tr>
                        <th>Principal</th>
                        <th>Modulo</th>
						<th>Seleccionar</th>
                    </tr>
               	   
			   <?php
               while ($linea = mysql_fetch_array($resultado)) {
                    
				$cod_mod = $linea['GRAL_PAR_PRO_COD'];
				$nom_mod = $linea['GRAL_PAR_PRO_DESC'];
				$cod_mod_s = $linea['GRAL_OPC_PRG_COD'];
				$nom_mod_s = $linea['GRAL_OPC_PRG_DESCRIPCION'];
				$estado = $linea['ESTADO'];	
		       ?>	
                     <tr class="tr_usuario">  
                        <td><?php echo $linea['GRAL_PAR_PRO_DESC']; ?>&nbsp;</td>
						<td><?php echo $linea['GRAL_OPC_PRG_DESCRIPCION']; ?>&nbsp;</td>
					    <td> <input <?php if($estado==1){?> checked <?php }?> name='asig[]' type="checkbox" value="<?php echo $linea['GRAL_PAR_PRO_COD'].'-'.$linea['GRAL_OPC_PRG_COD']; ?>"  id="asigna" /></td>
						
						<!--input name="checkbox[]" type="checkbox" id="checkbox" value="Enero" /><br-->
                    </tr>	
                     <?php 
                }
                ?>
				<br>
                </table>
				
				<table width="100%" align="center">
         			
					<tr>
                    <td>   <input type="submit" name="asignar" value="Guardar" class="btn_form"></td>
              		</tr>
					
                </table>
		   		
		   
		   
<?php
if(isset($_POST['asignar']))//Vallidamos que el formulario fue enviado
{   //verificamos que lo que se envio fue un array 
    if(isset($_POST['asig']))
    {
       // realizamos el ciclo
	   mysql_query("UPDATE gral_permiso_usuario SET GRAL_USR_ESTADO='0' 
	   				WHERE GRAL_USR_LOGIN= '$login' ") ;
		
	   while(list($key,$value) = each($_POST['asig'])) 
        {
            //imprimimos los valores del actual checkbox
			$codigos= explode("-", $value);
			$cod1= $codigos[0]; // Codigo menu
			$cod2= $codigos[1]; // Codgio submenu			
			$cod[]= $login.'-'.$cod1.'-'.$cod2; //
			//echo $login.'-'.$cod1.'-'.$cod2;
			
	 	} 
		$con_per= mysql_query("SELECT GRAL_USR_LOGIN, GRAL_PER_COD_MOD, GRAL_OPC_PRG_COD, GRAL_USR_ESTADO,GRAL_PER_USR_ALTA, 				
								GRAL_PER_USR_FEC_HR_ALTA, GRAL_PER_USR_BAJA, GRAL_PER_USR_FEC_HR_BAJA
								FROM gral_permiso_usuario	
								WHERE GRAL_USR_LOGIN='$login'");
		
		while($r = mysql_fetch_row($con_per)) {   
		$datos_sql[] = $r[0].'-'.$r[1].'-'.$r[2]; 
		/*$datos_sql = $r[0].$r[1].$r[2]; 
		echo '-'.$datos_sql; //imprime bien*/
		//echo $r[0].'x-'.$r[1].'x-'.$r[2];
		} 
		//ELEMENTOS QUE EXISTE EN LOS DOS ARREGLOS ($cod y $datos_sql)
		foreach ($cod as $value1) {
		foreach ($datos_sql as $value2) {
			if ($value1 == $value2){
		  $codigoo= explode("-", $value1);
		  $log1=$codigoo[0];    // login
		  $cod_m1=$codigoo[1];  // codigo menu
		  $cod_sm1=$codigoo[2]; // codgo sub menu
		//echo $log1.$cod_m1.$cod_sm1.'*'.'<br>';// 
		 mysql_query("UPDATE gral_permiso_usuario SET GRAL_USR_ESTADO='1' 
		 			  WHERE GRAL_USR_LOGIN= '$log1' AND GRAL_PER_COD_MOD='$cod_m1' AND GRAL_OPC_PRG_COD='$cod_sm1'") ;
				}
			}
		}
		//ELEMENTOS QUE NO EXISTE EN EL ARREGLO DE LA TABLA  gral_permiso_usuario(datos_sql)
			foreach ($cod as $value1) {
				$encontrado=false;
				foreach ($datos_sql as $value2) {
					if ($value1 == $value2){
						$encontrado=true;
						$break;
					}
				}
				if ($encontrado == false){
				  $codigos= explode("-", $value1);
				  $log2=$codigos[0];
				  $cod_m2=$codigos[1];
				  $cod_sm2=$codigos[2];
				//echo $log2.$cod_m2.$cod_sm2.'-'.'<br>';// 
				 mysql_query("INSERT INTO gral_permiso_usuario (GRAL_USR_LOGIN, GRAL_PER_COD_MOD, GRAL_OPC_PRG_COD, 		
				 			GRAL_USR_ESTADO,GRAL_PER_USR_ALTA, GRAL_PER_USR_FEC_HR_ALTA, GRAL_PER_USR_BAJA, GRAL_PER_USR_FEC_HR_BAJA) 
							VALUES ('$log2', '$cod_m2', '$cod_sm2', '1', '$usu', '$fec', NULL, NULL);") ;
				}
			}
		  //---------------------------------
		  
		}//if	
		else {
			mysql_query("UPDATE gral_permiso_usuario SET GRAL_USR_ESTADO='0' WHERE GRAL_USR_LOGIN= '$login' ") ;
			}
	?>
	<script languaje="JavaScript">
	location.href='gral_asig_per.php';
	</script>
	<?php
		
	}	// $_POST['asignar']
		  
?>
</form>
	<br>
		</div>

	</div>
        <?php
            include("footer_in.php");
        ?>
		</center>
    </body>
</html>
<?php
}
ob_end_flush();
 ?>