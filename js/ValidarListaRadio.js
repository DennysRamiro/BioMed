$(document).ready(function (){
/*$("#nro_tal").click(function(){
    if(this.checked){
        //is checked
       alert("1");
    } else {
        //not checked
         alert("2");
    }
});*/

});  

function validarBotonRadio(form) {
  var marcado = "no";
  //alert(marcado);
  with (document.form2){

        for ( var i = 0; i < nro_tal.length; i++ ) {
               if ( nro_tal[i].checked) {
                    return true;
                } 
          } 
  }     
    if ( marcado == "no" ){
		$("#dialog-message").dialog({
				height: 140,
             modal: true					
			});
        return false;  
    }
}

function validarBotonRadio2(form) {
  var marcado = "no";
  //alert(marcado);
  with (document.form2){

        for ( var i = 0; i < myradio.length; i++ ) {
               if ( myradio[i].checked) {
                    return true;
                } 
          } 
  }     
    if ( marcado == "no" ){
        $("#dialog-message").dialog({
                  modal: true,
                  buttons: {
                        Ok: function() {
                                $( this ).dialog( "close" );
                        }
                  }
        });
        return false;  
    }
}


