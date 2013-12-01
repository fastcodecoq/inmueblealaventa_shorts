
// sidebar controller by gomosoft
// dependences jQuery 1.7 >


window.sideFilters = function(){
		
	  filters = {};
	
	  this.init = function(){

	  	if(!$)
	  	{
	  		console.log("jQuery 1.7 > is required");
	  		return false;
	  	}

	  	submitControllers();
	  	radioController();


	  	console.log("Woooohooooo sideFilters controller started. Code by gomosoft");

	  }





	function prevents(e)
	{
		e.preventDefault();
		e.stopPropagation();
	}


	function radioController(){

		$("#filtros input[type='radio'], #barrio").live("change", function(){		
				
				filters[$(this).attr("name")] = parseInt($(this).val());
				console.log(filters);

		});


	}


	function submitAction(e){

		prevents(e);
	
		filters.departamento = parseInt($("#departamento").val());
		filters.ciudad = parseInt($("#ciudad").val());
		filters.tipo_inmueble = parseInt($("#tipoInmueble").val());
		filters.type = parseInt($("#para").val());
		filters.cod = parseInt($("#cod").val());
		

		if(empty(filters.cod))
			return false;
			
			
		if(empty(filters.tipo_inmueble))
			return false;
			
		if(empty(filters.departamento))
			return false;

		if(empty(filters.ciudad))
			return false;

		if(empty(filters.tipo_inmueble))
			return false;

		if(empty(filters.type))
			return false;


		filters = JSON.stringify(filters)
						 .replace("{","[")		
					     .replace("}","]");
					     

		filters = stripslashes(filters);
		filters = filters.match(/\[.+\]/g)[0];

		document.location = "/filtrar-inmobiliaria/" + filters;

		return false;

	}


	function submitControllers(){

       $("#filtros").off("submit").on("submit", submitAction);

	  }


	  function empty(str){
	  	  return !/\w/.test(str);
	  }

}



//función tomada de phpjs

function stripslashes (str) {
  // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +   improved by: Ates Goral (http://magnetiq.com)
  // +      fixed by: Mick@el
  // +   improved by: marrtins
  // +   bugfixed by: Onno Marsman
  // +   improved by: rezna
  // +   input by: Rick Waldron
  // +   reimplemented by: Brett Zamir (http://brett-zamir.me)
  // +   input by: Brant Messenger (http://www.brantmessenger.com/)
  // +   bugfixed by: Brett Zamir (http://brett-zamir.me)
  // *     example 1: stripslashes('Kevin\'s code');
  // *     returns 1: "Kevin's code"
  // *     example 2: stripslashes('Kevin\\\'s code');
  // *     returns 2: "Kevin\'s code"
  return (str + '').replace(/\\(.?)/g, function (s, n1) {
    switch (n1) {
    case '\\':
      return '\\';
    case '0':
      return '\u0000';
    case '':
      return '';
    default:
      return n1;
    }
  });
}


function ini__(){ new sideFilters().init(); }

$(ini__);