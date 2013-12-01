<?php

  class db_controller_exception extends Exception{};

  class mysqlity{
      	
      	private $db;
      	protected $table;      	
        protected $compiled;

        function __construct($table = "inmueble"){

        			$this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        			$this->table = $table;

                    return $this;
        			
        }  


        public function exists($table_name){
            
            $rs = $this->db->query("SELECT * FROM {$table_name} LIMIT 1");   
            return $this->db->affected_rows > 0;

        }
   

        public function create($table_name, $vars, $primary_key = NULL, $force = NULL, $engine = "InnoDB"){

        	if($primary_key === NULL)
        		$primary_key = "";
        	else
        	   $primary_key = ", PRIMARY KEY ({$primary_key})";

        	$db = $this->db;

            $force = "IF NOT EXISTS";

        	$query = "CREATE TABLE {$force} `{$table_name}`  ({$vars} {{primary_key}}) engine={$engine}";
        	$query = str_replace("{{primary_key}}", $primary_key, $query);

        	return array("success" => $db->query($query), "table" => $table_name);

        }

        public function error(){

        	return $this->db->error;

        }


        public function save($varss, $table = "shorts"){

            $db = $this->db;
            $query = array();
            $query[] = "INSERT INTO";
            $query[] = "`{$table}`";

            $vars = array();
            $vals = array();



            foreach ($varss as $row => $val)
            {
                $vars[] = "`" . $row . "`";
                
                if(!$this->compile($val))
                 throw new db_controller_exception("Tipo de dato no soportado solo enteros y cadenas", 77);
                else
                    $vals[] = $this->compiled;
                    
                 
            }

            $query[] = "(" . implode(",", $vars) . ")";            
            $query[] = "VALUES";
            $query[] = "(" . implode(",", $vals) . ")";            

            $query = implode(" ", $query);
                

            return $db->query($query);

        }


        public function compile($val){

            if(preg_match("{{d}}", $val))
                { $this->compiled = (int) $val; return true;}
            if(preg_match("{{s}}", $val))
                { $this->compiled = "'" . addslashes(strip_tags(str_replace("{{s}}", "", $val))) . "'"; return true;}
            if(preg_match("{{c}}", $val))
                { $this->compiled = (strlen("'" . addslashes(strip_tags(str_replace("{{c}}", "", $val))) . "'") === 3) ? true : false; return true;}
            if(preg_match("{{f}}", $val))
                { $this->compiled = (float) $val; return true;}


            throw new db_controller_exception("Tipo de dato no soportado solo enteros y cadenas", 77);

        }


        public function find($params = NULL, $table = NULL, $pointer = NULL){

         	$db = $this->db;        	
        	$query = array();
        	$query[] = "SELECT";        	
        	$query[] = ( isset($params["vars"]) ) ? $params["vars"] : "*";        	
        	$query[] = ( $table  != NULL ) ? "FROM `" . TB_PREFIX . "{$table}`" : "FROM `" . TB_PREFIX . "{$this->table}`";  	        	 
        	$query[] = ( isset($params["where"]) ) ? "WHERE {$params["where"]}" : "";     
        	$query = implode(" ", $query );  



        	if($params === NULL)
        	 {

               if($query === NULL)
        	 	{
                    $rs = array();
                    $result = $db->query( $query );
            
                }
                else
                {
                    
                    $query .= $pointer;
                    $query = str_replace("?", $this->compiled , $query);                    
                    $result = $db->query($query);

                }

        
          

        	 	while($row = $result->fetch_array(MYSQLI_ASSOC))
        	 	  $rs[] = $row;

        	 	$result->close();
        	 	return $rs;

        	 }
        	else{

        		$stmt = $db->stmt_init();

        		if( $stmt->prepare( $query ) ){

        		
        		  		return $stmt;

        		}
        		else
        			throw new db_controller_exception("No se pudo preparar el query [{$db->error}]", 52);

        	 }	

        }





        public function findOne($params = NULL, $table = NULL){

         	$db = $this->db;        	
        	$query = array();
        	$query[] = "SELECT";        	
        	$query[] = ( isset($params["vars"]) ) ? $params["vars"] : "*";        	
        	$query[] = ( $table  != NULL ) ? "FROM `" . TB_PREFIX . " {$table}`" : "FROM `" . TB_PREFIX . "{$this->table}`";  	
        	$query[] = ( isset($params["where"]) ) ? "WHERE {$params["where"]}" : " LIMIT 1";     
        	$query = implode(" ", $query );  	


        	if($params === NULL){
                    
                      return $db->query($query);                   

            }
        	else{

        		if( $stmt = $db->prepare( $query ) ){

        		  $stmt->bind_param($params["flags"], $params["params"]);
        		  
        		  if($stmt->execute())
        		  	return $stmt->get_result();
        		  else
        		  	throw new db_controller_exception("No se pudo hacer remove [{$db->error}]", 58);


        		}
        		else
        			throw new db_controller_exception("No se pudo preparar el query [{$db->error}]", 52);

        	 }	

        }


          public function update($params = NULL, $table = NULL){

         	$db = $this->db;        	
        	$query = array();
        	$query[] = "UPDATE";        	
        	$query[] = ( $table  != NULL ) ? TB_PREFIX . "{$table}" : TB_PREFIX . "{$this->table}";        	
        	$query[] = ( isset($params["vars"]) ) ? $params["vars"] : "*";        	        	
        	$query[] = ( isset($params["where"]) ) ? "WHERE {$params["where"]}" : "";        	        	

        	if($params === NULL)
        	 return $db->query($query);
        	else{

        		if( $stmt = $db->prepare( implode(" ", $query )) ){

        		  $stmt->bind_param($params["flags"], $params["params"]);
        		  
        		  if($stmt->execute())
        		  	return $stmt->get_result();
        		  else
        		  	throw new db_controller_exception("No se pudo hacer update [{$db->error}]", 101);


        		}
        		else
        			throw new db_controller_exception("No se pudo preparar el query [{$db->error}]", 52);

        	 }	

        }


         public function remove($params = NULL, $table = NULL){

         	$db = $this->db;
        	$query = array();
        	$query[] = "DELETE";        	        	    
        	$query[] = ( $table  != NULL ) ? "FROM " . TB_PREFIX . " {$table}" : TB_PREFIX . "{$this->table}";        	
        	$query[] = ( isset($params["where"]) ) ? "WHERE {$params["where"]}" : "";        	        	

        	if($params === NULL)
        	 return $db->query(implode(" ", $query));
        	else{

        		 if( $stmt = $db->prepare( implode(" ", $query )) ) {

        		  $stmt->bind_param($params["flags"], $params["params"]);
        		  
        		  if(!$stmt->execute()) 
        		  	throw new db_controller_exception("No se pudo hacer remove [{$db->error}]", 132);


        		}
        		else
        			throw new db_controller_exception("No se pudo preparar el query [{$db->error}]", 52);

        	 }	

        }




  }