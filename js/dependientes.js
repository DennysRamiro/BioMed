
 $(document).ready(function(){
// Creamos el evento change para detectar el elemento elegido
$("#pais").change(function () {
    $("#pais option:selected").each(function () {
                        // capturamos el valor elegido
            elegido=$(this).val();
            //$ValorElegido;
                        // Llamamos al archivo combo1.php
            //$.post("combo1.php", 
          { elegido: elegido }, function(data){
           $con_pais  = "Select Name, CountryCode
                         From city 
                         where CountryCode = '$ValorElegido' order by Name";
           $res_pais = mysql_query($con_pais);  

            $("#combo2").html(data);
                        // reseteamos el combo3
            $("#combo3").html("");
        });         
        });
   })
});

