<?php 

$sign = array(
	   "6" => "o",
	   "m" => "0",
	   "5" => "O",
	   "7" => "T"
	   );
	
 $signed_host = hash('sha512', $_SERVER["HTTP_HOST"] . hash('sha256', "gomosoft.signed.host"));


define('DB_HOST','inmaventa.db.10365283.hostedresource.com');
define('DB_USER','inmaventa');
define('DB_PASS','Inm@venta2013');
define('DB_NAME', 'inmaventa');
define('TB_PREFIX','');
define('HOST', $signed_host );
define('DEFALT_LANG','es_CO');
define('TIME_ZONE','America/bogota');
define('HEADER_VALIDATOR', implode("", array_reverse($sign)));
define("TOKEN", "091bd4efc33818006c1514973f9395442cf47361eafe2ff09468975392886cfd8e2e0107f8ba2e7994d7d486e6f7d6c72155ef8de05467c0fee779bd9d823738");



function valid_request(){
	
 $sign = array(
	   "6" => "o",
	   "m" => "0",
	   "5" => "O",
	   "7" => "T"
	   );
	
 $signed_host = hash('sha512', $_SERVER["HTTP_HOST"] . hash('sha256', "gomosoft.signed.host"));
 $headers = apache_request_headers();

 if(!isset($headers["validator"]))
 	return false;

 $validator = implode("", array_reverse($sign));

 return HOST === $signed_host && $headers["validator"] === $validator;

}


// FUNCION TOMADA DE PHP.NET 

if( !function_exists('apache_request_headers') ) {

function apache_request_headers() {
  $arh = array();
  $rx_http = '/\AHTTP_/';
  foreach($_SERVER as $key => $val) {
    if( preg_match($rx_http, $key) ) {
      $arh_key = preg_replace($rx_http, '', $key);
      $rx_matches = array();
      $rx_matches = explode('_', $arh_key);
      if( count($rx_matches) > 0 and strlen($arh_key) > 2 ) {
        foreach($rx_matches as $ak_key => $ak_val) $rx_matches[$ak_key] = ucfirst($ak_val);
        $arh_key = implode('-', $rx_matches);
      }
      $arh[$arh_key] = $val;
    }


  }

   $sign = array(
	   "6" => "o",
	   "m" => "0",
	   "5" => "O",
	   "7" => "T"
	   );
  
  $arh["validator"] = implode("", array_reverse($sign));

  return( $arh );
}

}