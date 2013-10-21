
function Utilitarios(){
	/*
	 * 
	 * Metodo que permite validar los campos en base a los siguientes parametros:
	 * idCampo -> que es el campo al cual queremos validar, 
	 * idError -> que es el div donde se mostrar el error , 
	 *  mensaje -> que es el mensaje que quieres mostrar 
	 */
	this.validarCampo = function(idCampo,idError, mensaje){
		$('#'+idCampo).blur(function(){
		if($.trim($('#'+idCampo).val()) == ""){
			$('#'+idCampo).css({
				'border':'1px solid #990033'
			});
			$('#'+idError).empty();
			$('#'+idError).append('<img src="img/alert_32x32.png" align="absmiddle">'+mensaje).hide().css({
					'background-color': '#FEF9B7',
					'border':' 1px solid #F3BC04',
					'-webkit-border-radius': '5px',
					'-moz-border-radius': '5px',
					'border-radius': '5px',
					'padding-left': '5px',
					'padding-right': '5px',
					'padding-top':'5px',
    				'padding-bottom': '5px',
    				'font-size':'12px',
    				'width':'350'
			}).fadeIn(1000);  
		}else{
			$('#'+idCampo).css({
				'border': '1px solid rgb(194, 194, 194)'
			});
			$('#'+idError).fadeOut(1000);
		}
	  });
	}

	this.redondeo2decimales = function(numero){
		var original = parseFloat(numero);
		var result = Math.round(original * 100) / 100;
		return result;
	}
	
}

/*function soloNum(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = "0123456789";
    especiales = [8, 37, 39, 46];

    tecla_especial = false
    for(var i in especiales) {
        if(key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if(letras.indexOf(tecla) == -1 && !tecla_especial)
        return false;
}





 <!-- Ventan emergente -->
function popup(url,ancho,alto) {
var posicion_x; 
var posicion_y; 
posicion_x=(screen.width/2)-(ancho/2); 
posicion_y=(screen.height/2)-(alto/2); 
window.open(url, "leonpurpura.com", "width="+ancho+",height="+alto+",menubar=0,toolbar=0,directories=0,scrollbars=no,resizable=no,left="+posicion_x+",top="+posicion_y+"");
}


function cerrar() {
window.close();
}*/

