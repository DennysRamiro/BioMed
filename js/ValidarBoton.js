
$(document).on('ready', function(){

	$('#Procesar').click(function(){

		if(($_POST['fec_nac']) == "" || ($_POST['s'])){

	          $(location).attr('href', 'tipo_rep_cont.php');
	   }else{
	          $(location).attr('href', 'cont_result_b.php'); 

	    }
	});

});
  
