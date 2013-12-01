<?
/*  Informacion de base de datos  */
ini_set('mssql.charset','utf-8');

/* Definimos la zona horaria */
/*date_default_timezone_set("America/Bogota");*/
/*
// CASA
$host = 'localhost';
$bd_usuario = 'root';
$bd_clave = 'mysql';
$bd_nombre = 'inmaventa';
*/

$host = 'inmaventa.db.10365283.hostedresource.com';
$bd_usuario = 'inmaventa';
$bd_clave = 'Inm@venta2013';
$bd_nombre = 'inmaventa';

 
$nombre_sitio = "";
$adminemail = "";

$conexion = mysql_pconnect($host,$bd_usuario,$bd_clave)
	or die ("No se ha encontrado la base de datos.");

$bd = mysql_select_db($bd_nombre , $conexion)
	or die("No se ha encontrado la base de datos.");
	
// VARIABLES GLOBALES

$GLOBAL_nombre_pagina = "::..:: Inmueble a la Venta ::..::";
//$CORREO_mail = "info@estebanrios.com";
$Path_web = $_SERVER['HTTP_HOST'];

?>