

function switchImg(num,dir)
{

button0=new Image();
button1=new Image();
button0.src=dir+'/leftopcion';
button1.src=dir+'/leftopcionsobre';
 if (num=='0') document.grafico.src=button0.src;
 if (num=='1') document.grafico.src=button1.src;
 if (num=='2') document.grafico1.src=button0.src;
 if (num=='3') document.grafico1.src=button1.src;
 if (num=='4') document.grafico2.src=button0.src;
 if (num=='5') document.grafico2.src=button1.src;
 if (num=='6') document.grafico3.src=button0.src;
 if (num=='7') document.grafico3.src=button1.src;
 if (num=='8') document.grafico4.src=button0.src;
 if (num=='9') document.grafico4.src=button1.src;
 if (num=='10') document.grafico5.src=button0.src;
 if (num=='11') document.grafico5.src=button1.src;
 if (num=='12') document.grafico6.src=button0.src;
 if (num=='13') document.grafico6.src=button1.src;
 if (num=='14') document.grafico7.src=button0.src;
 if (num=='15') document.grafico7.src=button1.src;
 if (num=='16') document.grafico8.src=button0.src;
 if (num=='17') document.grafico8.src=button1.src;

}


function activarcampo(elem)
{
var dom = (document.getElementById) ? 1 : 0;
 if (dom)
 {
 elem.style.backgroundColor='#DEDEFF';
 elem.style.color='#000055';
 }
}
function desactivarcampo(elem)
{
var dom = (document.getElementById) ? 1 : 0;
 if (dom)
 {
 elem.style.backgroundColor='';
 elem.style.color='';
 }
}

//recibe el valor del select en ese momento =cual ,ademas del campo img donde mostrar la nueva imagen=nuevaimg
function generarimagen(cual,nuevaimg)
{
	var temp=nuevaimg
	temp.src=cual
}
//abre ventanas
function ventanaNews (URL){

   window.open(URL,"ventana1","width=400,height=250,scrollbars=YES")

}
function ventanaSecundaria (URL){

   window.open(URL)

}
//Esta funcion recive la direcion de la pagina  a la cual se redirigira
function redirigir(direccion)
{
  location = direccion ;
}
