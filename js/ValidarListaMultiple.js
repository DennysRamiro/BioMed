$(document).ready(function (){
// Lista Multiples

});   

function check() {
if(document.form2["nro_doc[]"].value == ""){

//alert('Please choose a widget for Question #2!');
 $("#dialog-confirm").dialog({
        resizable: false,
          height:260,
          modal: true,
          buttons: {
          
          Cerrar: function() {
            $( this ).dialog( "close" );
          }
          }             
      });


return false; 
}



return true;
}

function checkCtass() {
if(document.form2["cod_cta[]"].value == ""){

//alert('Please choose a widget for Question #2!');
 $("#dialog-confirm").dialog({
        resizable: false,
          height:260,
          modal: true,
          buttons: {
          
          Cerrar: function() {
            $( this ).dialog( "close" );
          }
          }             
      });


return false; 
}



return true;
}
