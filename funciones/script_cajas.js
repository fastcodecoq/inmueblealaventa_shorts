

function nuevoAjax(){
	var xmlhttp=false;
 	try {
 		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
 	} catch (e) {
 		try {
 			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
 		} catch (E) {
 			xmlhttp = false;
 		}
  	}

	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
 		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}


function enviarpagina(para,tipo,ciudad)
	{	
		
		location.href="propiedades.php?para="+para+"&tipoInmueble="+tipo+"&ciudad="+ciudad;			
	}
	
function parametrosgaleria(para,ciudad)
{	
	
location.href="propiedades.php?para="+para+"&ciudad="+ciudad;			
}
	
	
	
function menunuevo(para)
	{	
	
  var url = new Array("/inmuebles-a-la-venta","/inmuebles-para-arriendo");
 
	location.href= url[para-1];			

	}

function tipoproy(para)
	{	
	 
	 var url = new Array("/proyectos-nuevos","/proyectos-sobre-planos");
 
	location.href= url[para-1];	

	}
	
function fn_mostrar_frm_valor(){
	$("#div_oculto").load("ajax_form_agrega_valor.php", function(){
		$.blockUI({
			message: $('#div_oculto'),
			css:{
				top: '20%'
			}
		}); 
	});
};
	
	
function mostrar()
{
	$("#oculto").show()
}

function ocultar()
{
	$("#oculto").hide()
}
	