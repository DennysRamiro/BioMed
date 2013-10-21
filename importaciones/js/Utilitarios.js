
function Utilitarios(){
	/*
	 * 
	 * Metodo que permite validar los campos en base a los siguientes parametros:
	 * idCampo -> que es el campo al cual queremos validar, 
	 * idError -> que es el div donde se mostrar el error , 
	 * mensaje -> que es el mensaje que quieres mostrar 
	 */
	this.validarCampo = function(idCampo,idError, mensaje){
		$('#'+idCampo).blur(function(){
		if($.trim($('#'+idCampo).val()) == ""){
			$('#'+idCampo).css({
				'border':'1px solid #990033'
			});
			$('#'+idError).empty();
			$('#'+idError).append('<img src="../img/alert_32x32.png" align="absmiddle">'+mensaje).hide().css({
					'background-color': '#FEF9B7',
					'border':' 1px solid #F3BC04',
					'-webkit-border-radius': '5px',
					'-moz-border-radius': '5px',
					'border-radius': '5px',
					'padding-left': '0px',
					'padding-right': '0px',
					'padding-top':'0px',
    				'padding-bottom': '0px',
    				'font-size':'12px',
    				'width':'250'
			}).fadeIn(1000);  
		}else{
			$('#'+idCampo).css({
				'border': '1px solid rgb(194, 194, 194)'
			});
			$('#'+idError).fadeOut(1000);
		}
	  });
	}
/**
 * Esta es la funcion que permite mostrar el mensaje de error
 */
 this.mostrarMensajeAlerta = function(tipo, msg, titulo){
		if(tipo == 0){    // Advertencia de error 
			$("#dialog-confirm" ).attr('title', titulo);// 
			$("#dialog-confirm").empty();
			$("#dialog-confirm").append('<p><div id="imagen_advertise" style="float:left;"><img src="../img/alert_48x48.png" align="absmiddle"></div></div id="detalle_advert">'+msg+'</div></p>');
			$("#dialog-confirm" ).dialog({
				resizable: false,
				height:150,
				width:420,
				modal: true,
				buttons: {
					"Aceptar": function() {
						$( this ).dialog( "close" );
					}
				}
			});
		}else if(tipo == 1){ // Mensaje de confirmacion
			$("#dialog-confirm" ).attr('title', titulo);
			$("#dialog-confirm").empty();
			$("#dialog-confirm").append('<p><img src="../img/checkmark_48x48.png" align="absmiddle">'+msg+'</p>');
			$("#dialog-confirm" ).dialog({
				resizable: false,
				height:200,
				width:400,
				modal: true,
				buttons: {
					"Aceptar": function() {
						$( this ).dialog( "close" );
					}
				}
			});
		}else if(tipo == 2){ // Mensaje de actulizacion correcto
			$("#dialog-confirm" ).attr('title', titulo);
			$("#dialog-confirm").empty();
			$("#dialog-confirm").append('<p><img src="../img/checkmark_48x48.png" align="absmiddle">'+msg+'</p>');
			$("#dialog-confirm" ).dialog({
				resizable: false,
				height:200,
				width:400,
				modal: true,
				buttons: {
					"Aceptar": function() {
						$( this ).dialog( "close" );
					}
				}
			});
		}else if(tipo == 3){ // Dado de baja correcto
			$( "#dialog-confirm" ).attr('title', titulo);
			$("#dialog-confirm").empty();
			$("#dialog-confirm").append('<p><img src="../img/checkmark_48x48.png" align="absmiddle">'+msg+'</p>');
			$( "#dialog-confirm" ).dialog({
				resizable: false,
				height:200,
				width:400,
				modal: true,
				buttons: {
					"Aceptar": function() {
						$( this ).dialog( "close" );
					}
				}
			});
		}

   }

	this.redondeo2decimales = function(numero){
		var original = parseFloat(numero);
		var result = Math.round(original * 100) / 100;
		return result;
	}

	 /** Este es el metodo que agrega el preloader */
	this.iniPreloaderStart = function(){
		$('body').append('<div id="loader_producto_precarga_bg" style="display:none;"></div>');
		$('#loader_producto_precarga_bg').append('<div id="div_loader_component_prod"><img src="../img/ajax-loader.gif"></div>');
	}
	/** Este es el metodo que permite comenzar el preloader */
	this.startPreloader = function(){
		$('#loader_producto_precarga_bg').fadeIn(1000);
		$("#loader_producto_precarga_bg").css({
	    	"position":"absolute",/*agregamos una posición absoluta para que nos permita mover la capa en el espacio del navegador*/
			"top":"0",/*posicionamiento en Y */
			"left":"0",/*pocisionamiento en X*/
			"z-index":"9999", /* Le asignamos la pocisión más alta en el DOM */
			"background-color":"rgba(0, 0, 0, 0.5)", /* le asignamos un color de fondo */
			"width":"100%", /* maximo ancho de la pantalla */
			"height":"100%", /* maxima altura de la pantalla */
			"display":"block",
			"text-align":"center"
	  	});
	  	var windowWidth = document.documentElement.clientWidth;
        var windowHeight = document.documentElement.clientHeight;
            //var popupHeight = $("#add_client").height();
        var popupHeight = 19;
            //var popupWidth = $("#add_client").width();
 		var popupWidth = 220;
 		$("#div_loader_component_prod").css({
            "height": popupHeight,
            "width": popupWidth,
            "position": "absolute",
            "top": windowHeight/2-popupHeight/2,
            "left": windowWidth/2-popupWidth/2
        });
	}
	/** Este es el metodo que permite detener la animacion del loader*/
	this.stopPreloader = function(){
		$('#loader_producto_precarga_bg').fadeOut(1000);
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
}*/

