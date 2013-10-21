$(document).ready(function(){
	//parametros principales
	
	var contenidoHTML = 'prueba';
	
	var ancho = 600; 
	var alto = 250;


	$('#Rev-Val').click(function(){
	//function showModal(){
		// fondo transparente
		var bgdiv = $('<div>').attr({
					className: 'bgtransparent',
					id: 'bgtransparent'
					});


		$('body').append(bgdiv);
		
		var wscr = $(window).width();
		var hscr = $(window).height();
				
		$('#bgtransparent').css("width", wscr);
		$('#bgtransparent').css("height", hscr);
		
		
		// ventana flotante
		var moddiv = $('<div>').attr({
					className: 'bgmodal',
					id: 'bgmodal'
					});	
		
		$('body').append(moddiv);
		$('#bgmodal').append(contenidoHTML);
		
		$(window).resize();
	});


	$(window).resize(function(){
		// dimensiones de la ventana
		var wscr = $(window).width();
		var hscr = $(window).height();


		// estableciendo dimensiones de background
		$('#bgtransparent').css("width", wscr);
		$('#bgtransparent').css("height", hscr);
		
		// definiendo tamaño del contenedor
		$('#bgmodal').css("width", ancho+'px');
		$('#bgmodal').css("height", 'auto');
		
		// obtiendo tamaño de contenedor
		var wcnt = $('#bgmodal').width();
		var hcnt = $('#bgmodal').height();
		
		// obtener posicion central
		var mleft = ( wscr - wcnt ) / 2;
		var mtop = ( hscr - hcnt ) / 2;
		
		// estableciendo posicion
		$('#bgmodal').css("left", mleft+'px');
		$('#bgmodal').css("top", mtop+'px');
	});
	
	$(window).keyup(function(event){
   		if (event.keyCode == 27) {
        	//falta implementar
   		}
	});
	
 });
	
function closeModal(){
	$('#bgmodal').remove();
	$('#bgtransparent').remove();
}