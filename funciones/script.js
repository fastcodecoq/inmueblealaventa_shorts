/*
 cc:scriptime.blogspot.in
 edited by :midhun.pottmmal
*/
$(document).ready(function(){
	$(document).click(function(){
		$("#ajax_response").fadeOut('slow');
	});
	$("#ciudad").focus();
	var offset = $("#ciudad").offset();
	var width = $("#ciudad").width()-2;
	$("#ajax_response").css("left",offset.left); 
	$("#ajax_response").css("width",width);
	$("#ciudad").keyup(function(event){
		 //alert(event.keyCode);
		 var keyword = $("#ciudad").val();
		 if(keyword.length)
		 {
			 if(event.keyCode != 40 && event.keyCode != 38 && event.keyCode != 13)
			 {
				 $("#loading").css("visibility","visible");
				 $.ajax({
				   type: "POST",
				   url: "funciones/busquedaauto.php",
				   data: "data="+keyword,
				   success: function(msg){	
					if(msg != 0)
					  $("#ajax_response").fadeIn("slow").html(msg);
					else
					{
					  $("#ajax_response").fadeIn("slow");	
					  $("#ajax_response").html('<div style="text-align:left;">No Matches Found</div>');
					}
					$("#loading").css("visibility","hidden");
				   }
				 });
			 }
			 else
			 {
				switch (event.keyCode)
				{
				 case 40:
				 {
					  found = 0;
					  $("li").each(function(){
						 if($(this).attr("class") == "selected")
							found = 1;
					  });
					  if(found == 1)
					  {
						var sel = $("li[class='selected']");
						sel.next().addClass("selected");
						sel.removeClass("selected");
					  }
					  else
						$("li:first").addClass("selected");
					 }
				 break;
				 case 38:
				 {
					  found = 0;
					  $("li").each(function(){
						 if($(this).attr("class") == "selected")
							found = 1;
					  });
					  if(found == 1)
					  {
						var sel = $("li[class='selected']");
						sel.prev().addClass("selected");
						sel.removeClass("selected");
					  }
					  else
						$("li:last").addClass("selected");
				 }
				 break;
				 case 13:
					$("#ajax_response").fadeOut("slow");
					$("#ciudad").val($("li[class='selected'] a").text());
				 break;
				}
			 }
		 }
		 else
			$("#ajax_response").fadeOut("slow");
	});
	$("#ajax_response").mouseover(function(){
		$(this).find("li a:first-child").mouseover(function () {
			  $(this).addClass("selected");
		});
		$(this).find("li a:first-child").mouseout(function () {
			  $(this).removeClass("selected");
		});
		$(this).find("li a:first-child").click(function () {
			  var valores =$(this).text()
				var exploded = valores.split('-');
			  $("#ciudad").val(exploded[0]+"-"+exploded[1]);
			  $("#idciudad").val(exploded[2]);
			  
			  $("#ajax_response").fadeOut("slow");
		});
	});
});



/*
 cc:scriptime.blogspot.in
 edited by :midhun.pottmmal
*/
$(document).ready(function(){
	$(document).click(function(){
		$("#ajax_responsearr").fadeOut('slow');
	});
	$("#ciudadarr").focus();
	var offset = $("#ciudadarr").offset();
	var width = $("#ciudadarr").width()-2;
	$("#ajax_responsearr").css("left",561); 
	$("#ajax_responsearr").css("width",width);
	$("#ciudadarr").keyup(function(event){
		 //alert(event.keyCode);
		 var keyword = $("#ciudadarr").val();
		 if(keyword.length)
		 {
			 if(event.keyCode != 40 && event.keyCode != 38 && event.keyCode != 13)
			 {
				 $("#loading").css("visibility","visible");
				 $.ajax({
				   type: "POST",
				   url: "funciones/busquedaautoarr.php",
				   data: "data="+keyword,
				   success: function(msg){	
					if(msg != 0)
					  $("#ajax_responsearr").fadeIn("slow").html(msg);
					else
					{
					  $("#ajax_responsearr").fadeIn("slow");	
					  $("#ajax_responsearr").html('<div style="text-align:left;">No Matches Found</div>');
					}
					$("#loading").css("visibility","hidden");
				   }
				 });
			 }
			 else
			 {
				switch (event.keyCode)
				{
				 case 40:
				 {
					  found = 0;
					  $("li").each(function(){
						 if($(this).attr("class") == "selected")
							found = 1;
					  });
					  if(found == 1)
					  {
						var sel = $("li[class='selected']");
						sel.next().addClass("selected");
						sel.removeClass("selected");
					  }
					  else
						$("li:first").addClass("selected");
					 }
				 break;
				 case 38:
				 {
					  found = 0;
					  $("li").each(function(){
						 if($(this).attr("class") == "selected")
							found = 1;
					  });
					  if(found == 1)
					  {
						var sel = $("li[class='selected']");
						sel.prev().addClass("selected");
						sel.removeClass("selected");
					  }
					  else
						$("li:last").addClass("selected");
				 }
				 break;
				 case 13:
					$("#ajax_responsearr").fadeOut("slow");
					$("#ciudadarr").val($("li[class='selected'] a").text());
				 break;
				}
			 }
		 }
		 else
			$("#ajax_responsearr").fadeOut("slow");
	});
	$("#ajax_responsearr").mouseover(function(){
		$(this).find("li a:first-child").mouseover(function () {
			  $(this).addClass("selected");
		});
		$(this).find("li a:first-child").mouseout(function () {
			  $(this).removeClass("selected");
		});
		$(this).find("li a:first-child").click(function () {
			  var valores =$(this).text()
				var exploded = valores.split('-');
			  $("#ciudadarr").val(exploded[0]+"-"+exploded[1]);
			  $("#idciudadarr").val(exploded[2]);
			  
			  $("#ajax_responsearr").fadeOut("slow");
		});
	});
});



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


function enviar(opc)
	{
					
					var para=opc;
					var concatenar="";
					
					
					var tipoInmueble=$("#tipoInmueble").val();
					
						var ciudad=$("#idciudad").val();
						var precio=$("#precio").val();
						var area=$("#area").val();
						var codigo=$("#codigo").val();
						

	
	contenedor1 = document.getElementById('contenedor1');
	
	contenedor1.innerHTML='<div align="center"><br><br><br><br><br><br><img src="imagenes/ico_ajax.gif" align="absmiddle" border="0" /></div>';

	
	
	
	location.href="propiedades.php?para="+opc+"&tipoInmueble="+tipoInmueble+"&ciudad="+ciudad+"&area="+area+"&precio="+precio+"&codigo="+codigo;
	// ajax4.send("para="+opc+"&tipoInmueble="+tipoInmueble+"&ciudad="+ciudad+"&area="+area+"&precio="+precio+"&codigo="+codigo);
	 
					/*var concatenar="";
					
					var tipoInmueble=$("#tipoInmueble").val();
					var ciudad=$("#idciudad").val();
					var precio=$("#precio").val();
					var area=$("#area").val();
					var codigo=$("#codigo").val();
					
					if (tipoinmueble=0)
					{
						concatenar=concatenar;
					}
					else
					{
						concatenar=concatenar+"&tipoInmueble="+tipoInmueble
					}
					
					
					if (ciudad=0)
					{
						concatenar=concatenar;
					}
					else
					{
						concatenar=concatenar+"&ciudad="+ciudad
					}
				
					
					
					
					//location.href="propiedades.php?para=1";
					location.href="propiedades.php?para=1"+concatenar;*/

	}
	
	
	
	function enviarinmoiv(opc)
	{
					
					
					
					
					

	
	contenedor1 = document.getElementById('contenedor1');
	
	contenedor1.innerHTML='<div align="center"><br><br><br><br><br><br><img src="imagenes/ico_ajax.gif" align="absmiddle" border="0" /></div>';
	ajax4=nuevoAjax();
	ajax4.open("POST",'resultado_inmoviliaria.php',true);
	ajax4.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	
	ajax4.onreadystatechange=function() {
		if (ajax4.readyState==4) 
		{
			contenedor1.innerHTML = ajax4.responseText
		}
	}
	//"
	 ajax4.send("inmovi="+opc);
	 
					/*var concatenar="";
					
					var tipoInmueble=$("#tipoInmueble").val();
					var ciudad=$("#idciudad").val();
					var precio=$("#precio").val();
					var area=$("#area").val();
					var codigo=$("#codigo").val();
					
					if (tipoinmueble=0)
					{
						concatenar=concatenar;
					}
					else
					{
						concatenar=concatenar+"&tipoInmueble="+tipoInmueble
					}
					
					
					if (ciudad=0)
					{
						concatenar=concatenar;
					}
					else
					{
						concatenar=concatenar+"&ciudad="+ciudad
					}
				
					
					
					
					//location.href="propiedades.php?para=1";
					location.href="propiedades.php?para=1"+concatenar;*/

	}
	
	
	
	function enviarfiltro() 
	{
					
					
					var concatenar="";
					
					
					var tipoInmueble=$("#tipoInmueble").val();
					var opc=$("#para").val();
						var ciudad=$("#idciudad").val();
						var precio=$("#precio").val();
						var area=$("#area").val();
						var codigo=$("#codigo").val();
						

	
	contenedor1 = document.getElementById('contenedor1');
	
	contenedor1.innerHTML='<div align="center"><br><br><br><br><br><br><img src="imagenes/ico_ajax.gif" align="absmiddle" border="0" /></div>';

	
	
	
	location.href="propiedades.php?para="+opc+"&tipoInmueble="+tipoInmueble+"&ciudad="+ciudad+"&area="+area;


	}
	