<?php
require('configuracion.php');
header("Expires: Tue, 01 Jul 2001 06:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
$consulta  = "SELECT GRAL_EMP_NOMBRE,GRAL_EMP_CENTRAL, GRAL_EMP_DIREC
              FROM gral_empresa ";
$resultado = mysql_query($consulta);
$linea = mysql_fetch_array($resultado);
$_SESSION['COD_EMPRESA']=$linea['GRAL_EMP_NOMBRE'];
$_SESSION['EMPRESA_TIPO']=$linea['GRAL_EMP_CENTRAL'];
$_SESSION['EMPRESA_DIREC']=$linea['GRAL_EMP_DIREC'];
?> 
<div id="cabecera_empresa">
	
<span id="liveclock" style="position:absolute;left:117;top:110;"></span><script language="JavaScript" type="text/javascript">
 <!--

function show5(){
if (!document.layers&&!document.all&&!document.getElementById)
return

 var Digital=new Date()
 var hours=Digital.getHours()
 var minutes=Digital.getMinutes()
 var seconds=Digital.getSeconds()  

var dn="PM"
if (hours<12)
dn="AM"
if (hours>12)
hours=hours-12
if (hours==0)
hours=12

 if (minutes<=9)
 minutes="0"+minutes
 if (seconds<=9)
 seconds="0"+seconds
//change font size here to your desire
myclock="<font size='2' face='Arial' ><b><font size='1'></font></br>"+hours+":"+minutes+":"
 +seconds+" "+dn+"</b></font>"
if (document.layers){

document.layers.liveclock.document.write(myclock)
document.layers.liveclock.document.close()
}
else if (document.all)
liveclock.innerHTML=myclock
else if (document.getElementById)
document.getElementById("liveclock").innerHTML=myclock
setTimeout("show5()",1000)
 }


window.onload=show5
 //-->
 </script>
 <strong>
 <br><font size="+2"> 
<?php
  //    echo encadenar(2).$linea['GRAL_EMP_NOMBRE'];
?>	

<br><font size="3"> 
 <?php
   //echo "Usuario:".encadenar(2).$_SESSION['nombres'];
?>	
<br> 

<font size="3"> 
 <?php
  // echo "TC Contable:".encadenar(2).number_format($_SESSION['TC_CONTAB'], 2, '.',',');
?>	
<br> 
 <?php
   echo encadenar(5)."Fecha Proceso:".encadenar(2).$_SESSION['fec_proc'];
?>	
<br> 
</font>
</strong>
       <?php
          //$fec = leer_param_gral();
          //$fec = mueveReloj();
        // echo $_SESSION['login'];
        ?> 
      
     </div>
   </div>
    
</div> 

 