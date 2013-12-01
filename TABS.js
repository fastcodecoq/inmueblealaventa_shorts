// searcher_tabs controller by gomosoft
// dependences jQuery 1.7 >

window.SEARCHER_TABS = function(){
	
	var _this = $(this);
	var filters = {};
	var keys = {
		"venta" : 1,
		"arriendo" : 2
	};
	var _data = {
		 form : "#buscarventa"
	};

	 this.init = function(data){


	  	if(!$)
	  	{
	  		console.log("jQuery 1.7 > is required");
	  		return false;
	  	}


	    if(data instanceof Object)
	       $.extend(_data, data);
	    
	    	filters.type = 1;

	    ini_snipets();
	    tab_controller();	    
	    submit_controller();

	    console.log("Whoooohooo TABS controller started. Code by Gomosoft");

	} 


	function ini_snipets(){
		$.fn.get_type = function(){ 
			return $(this).attr("data-type");
		 }
		$.fn.activate = function(){
			$(this).addClass("activesup");
		}

		$.fn.getAllFields = function(){

			var fields = new Array();

			$("input, select").each(function(e){
				fields.push($(this));
			});

			return fields;

		}		

	}



	function prevents(e)
	{
		e.preventDefault();
		e.stopPropagation();
	}


	function tab_controller(){

		 $("[data-tab]").off("click").on("click", function(e){

		 		prevents(e);
		 		var _this = $(this);
		 		 desactivate();
		 		_this.activate();
		 		filters.type = keys[_this.get_type()];

		 		console.log(filters.type)
		 		
				

		 });

	}

	function submit_controller(){

		$(_data.form).off("submit").on("submit", submit_action);

	}

	function submit_action(e){
		
		prevents(e);

		var _this = $(this);
		
		filters.tipo_inmueble = parseInt($("#tipoInmueble").val());
		filters.area =  parseInt($("#area").val());
		filters.ciudad = parseInt($("#idciudad").val());		
		filters.codigo = parseInt($("#codigo").val());
		filters.precio = parseInt($("#precio").val());
		filters = stripslashes(JSON.stringify(filters)
						 .replace("{","[")		
					     .replace("}","]"));

		document.location = "/busca/" + filters;
		

		return false;

	}

	function desactivate(){
	  
	 if(exists(".activesup"))
	  $(".activesup").removeClass("activesup");

	}


	function exists(query_selector){
		return ($(query_selector).length > 0) ? true : false;
	}
};


function ini_(){ new SEARCHER_TABS().init(); }

$(ini_);

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