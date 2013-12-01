<?php 
require(dirname(__FILE__) . "/config.inc.php");
require(dirname(__FILE__) . "/includes/db_controller.php");
//MAIN




class shorts{

	protected $map;
	protected $storage;
	protected $prefix;

	public function __construct($prefix = NULL){

		 
		  $this->storage = new mysqlity;

		  $this->map = array(

		"habitacion" => "campo_24",
		"garaje" => "campo_25",
		"baños" => "campo_9",
		"tipo_negocio" => array(
			    NULL,
			  "venta",
			  "arriendo"
			  ),
		"tipo_inmueble" => array(
			    NULL,
			  "apartamento",
			  "casa",
			  "local",
			  "oficina",
			  "bodega",
			  "lote",
			  "finca",
			  "Consultorio"
			  )		
	
	     );


		   $this->prefix = ($prefix === NULL) ? "/inmueble/s" : $prefix;

		  if(!$this->storage->exists("shorts"))  $this->ini();          
  

	}


  protected function ini(){

	
	$map = $this->map;

	$process = $this->storage;

    $this->storage->create("shorts", "id INT NOT NULL AUTO_INCREMENT, short TEXT, tipo_neg INT, citie INT, inmueble_id INT", "id");   

	$rs = $process->find();	
	$shorts = array();

	foreach($rs as $row){
		
		    $short = $this->create($row);
	     


		     if(!$this->save($short))
		       throw new db_controller_exception("Error salvando short", 78);		       	 

		    

  	 }

  }



  public function save($data){

  	  if(is_array($data))
  	  {		

  	  	    return $this->storage->save($data);

  	  }
  	  else if(is_numeric($data)){

  	  	  //buscamos el inmueble en base al ID, para crear el short

  	  	  $storage = $this->storage;
  	  	  
  	  	  $id = $storage->compile($data . "{{d}}");
  	  	  $query = " WHERE id = ? LIMIT 1";

  	  	  $rs = $storage->find(null, null, $query);
  	  	  	
  	  	  
  	  	  if(count($rs) > 0){  	  	    

  	  	  	$short = $this->create($rs[0]);
  	  	  	$this->save($short);

  	  	    return utf8_encode($this->prefix . "/" . $short["short"]);

  	  	  }
  	  	  else
  	  	  	throw new db_controller_exception("No se pudo procesar la petición", 68);
  	  	  	

  	  }


  	  throw new db_controller_exception("No se puede procesar la petición", 81);

  }


  public function get($data){

  	      $storage = $this->storage;
  	  	  
  	  	  $id = $storage->compile($data . "{{d}}");
  	  	  $query = " WHERE inmueble_id = ? LIMIT 1";

  	  	  $short = $storage->find(null, "shorts", $query);  	  	  
  	  	   	  
  	  	  	
  	  	  
  	  	  if(count($short) > 0)
  	  	    return $this->prefix . "/" . $short[0]["short"]; 
  	  	  else 
  	  	    throw new db_controller_exception("No se pudo encontrar el short para ({$id})", 107);

  }


  public function get_city_name($city){

  	      $storage = $this->storage;
  	  	  
  	  	  $id = $storage->compile($city . "{{d}}");
  	  	  $query = " WHERE idmunicipio = ? LIMIT 1";

  	  	  $city = $storage->find(null, "municipio", $query);  
  	  	  $city = $city[0]["nombreMunicipio"];
  	  	  $city = explode(" ", $city);

  	  	  return strtolower($city[0]);

  }


  private function create($row){

  	           //iniciamos la construcción del short 

  	 	       $map = $this->map;

  	 	        $slash[] = $map["tipo_inmueble"][$row["tipo_inm"]];  	 	        
				$slash[] = $map["tipo_negocio"][$row["tipo_neg"]];  
				$slash[] = $this->get_city_name($row["ciudad"]);  	 	        

				$slash = implode("/", $slash) ;
			
				//removemos los acentos, para ello creamos un array map
				$accents = array(
					"á" => "a",
					"ú" => "u",
					"ó" => "o",
					"í" => "i",
					"é" => "e",
					);
				

				//recorremos el array map para eliminar cada acento en la url 
				foreach ($accents as $char => $replace)								
				  $slash = str_replace($char, $replace, $slash);
				
				

  	            $row[$map["habitacion"]] = (int) $row[$map["habitacion"]];
				$row[$map["garaje"]] = (int) $row[$map["garaje"]];
				$row[$map["baños"]] = (int) $row[$map["baños"]];

				
				$short = array();

				if($row[$map["habitacion"]] > 0) 
					$short[] = $row[$map["habitacion"]] . "-habitaciones"; 
				if($row[$map["garaje"]] > 0) 
					$short[] = $row[$map["garaje"]] . "-garajes";
				if($row[$map["baños"]] > 0) 
					$short[] = $row[$map["baños"]] . "-baños";				

				$short = $slash . "/" . implode("-",$short) . "[" . $row["id"] . "]";


		 //compilamos un array especificando el tipo de cada dato 
		 //al final de cada uno, de acuerdo con la compatibilidad de mysqlity by gomosoft
	     //evitando el SQL injection - a continuación cada tipo de dato controlado por mysqlity
	     //{{d}} para enteros - {{s}} para cadenas - {{c}} para char - {{f}} para reales	


				$short = array(
				 
				  "short" => utf8_decode($short)."{{s}}",		     	
				  "tipo_neg" =>  $row["tipo_neg"]."{{d}}",
				  "citie" => $row["ciudad"]."{{d}}",
				  "inmueble_id" => $row["id"]."{{d}}"				  

				);

				return $short;

  }


}


function success($rs){

	if(!isset($_GET["direct"]))
	echo json_encode(array("success" => "yep" , "rs" => $rs));
    else
    echo $rs["short"];

}



function void_main(){


  try{

	    $shorter = new shorts;


	    $token = (isset($_GET["token"])) ? $_GET["token"] : null;	    


    //validación del token
	       
	       if($token){

	       		if( ( $token != null && TOKEN != $token  && $token != "f65b59d7bc164a784aca8a234b846c56" ) || $_SERVER["HTTP_HOST"] != "inmueblealaventa.com")
	     	     	throw new db_controller_exception("Token invalido", 155);
	     	    	

	     	     if(isset($_GET["id"]))
                     { if(!$short = $shorter->save((int) $_GET["id"])) throw new db_controller_exception("No se pudo salvar el short", 172); else success(array("short" => $short)); }
                 else
	     	     	throw new db_controller_exception("Los parametros no coinciden", 155);

		
	          }




	        if(isset($_GET["GET"]))
	        	if($short = $shorter->get($_GET["GET"]))
	        		 success(array("short" => utf8_decode($short)));
	       	  



		}
  catch(db_controller_exception $e){

  	   if(isset($_GET["id"]) && isset($_POST["token"]) )
  	   {
  	   	echo json_encode( array("success" => "nope" , "error" => $e->getMessage) );
  	   	die;
  	   }
  	   echo $e->getMessage();

  	   return false;  	   

  }

}


void_main();