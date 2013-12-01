<?php
//funcion para devolver el valor correcto de los tipos de planes
function planes($valor)
{
	switch ($valor)
	{
		case 1: return "Basic";
		case 2: return "Silver";
		case 3: return "Gold";
		case 4: return "Personalizado";
		default: return "- Escoja -";
	}
}


//funcion para devolver el valor correcto de los tipos de negocio
function tipo_negocio($valor)
{
	switch ($valor)
	{
		case 1: return "Vender";
		case 2: return "Arriendo";
		case 3: return "Vender / Arrendar";
		case 4: return "Alquiler";
		default: return "- Escoja -";
	}
}

function tipo_negocio_imprimir($valor)
{
	switch ($valor)
	{
		case 1: return "Vendo";
		case 2: return "Arriendo";
		case 3: return "Vendo / Arriendo";
		case 4: return "Alquiler";
		default: return "- Escoja -";
	}
}

//funcion para devolver el valor del tiempo de construccion
function tiempoConstruccion($valor)
{
	switch ($valor)
	{
		case 1: return "Sobre plano";
		case 2: return "En construcci&oacute;n";
		case 3: return "Entre 0 y 5 a&ntilde;os";
		case 4: return "Entre 5 y 10 a&ntilde;os";
		case 5: return "Entre 10 y 20 a&ntilde;os";
		case 6: return "M&aacute;s de 20 a&ntilde;os";
		default: return "- Escoja -";
	}
}

//funcion para devolver el valor del tiempo de construccion
function tipoTecho($valor)
{
	switch ($valor)
	{
		case 1: return "Con espacio cielorraso";
		case 2: return "Sin espacio cielorraso";
		default: return "- Escoja -";
	}
}

//funcion para devolver el valor correcto de los tipos de instalaciones de gas
function tipo_instalacionGas($valor)
{
	switch ($valor)
	{
		case 1: return "Natural";
		case 2: return "Propano";
		case 3: return "Ninguna";
		default: return "- Escoja -";
	}
}

//funcion para devolver el valor correcto de los tipos de tipo_vigilancia
function tipo_vigilancia($valor)
{
	switch ($valor)
	{
		case 1: return "12 horas";
		case 2: return "24 horas";
		case 3: return "Ninguna";
		default: return "- Escoja -";
	}
}

//funcion para devolver el valor correcto de los tipos de bodegas
function tipo_bodega($valor)
{
	switch ($valor)
	{
		case 1: return "Industrial";
		case 2: return "De almacenamiento";
		case 3: return "Industrial/Almacenamiento";
		default: return "- Escoja -";
	}
}

//funcion para devolver el valor correcto de los tipos de lotes
function tipo_lote($valor)
{ 
	switch ($valor)
	{
		case 1: return "Sin construir";
		case 2: return "En construcci&oacute;n";
		default: return "- Escoja -";
	}
}
function ubicacion_lote($valor)
{ 
	switch ($valor)
	{
		case 1: return "Zona rural";
		case 2: return "Zona urbana";
		default: return "- Escoja -";
	}
}

//funcion para devolver el valor correcto de los tipos de oficinas
function tipo_oficina($valor)
{
	switch ($valor)
	{
		case 1: return "Casa";
		case 2: return "Edificio";
		default: return "- Escoja -";
	}
}

//funcion para devolver el valor correcto de los tipos de locales
function tipo_local($valor)
{
	switch ($valor)
	{
		case 1: return "Dentro de un centro comercial";
		case 2: return "Afuera de un centro comercial";
		default: return "- Escoja -";
	}
}

//funcion para devolver el valor correcto de los tipos de finca
function tipo_finca($valor)
{
	switch ($valor)
	{
		case 1: return "De recreo";
		case 2: return "De producci&oacute;n";
		case 3: return "Recreo/Producci&oacute;n";
		default: return "- Escoja -";
	}
}

//funcion para devolver el valor correcto de los tipos de consultorios
function tipo_consultorio($valor)
{
	switch ($valor)
	{
		case 1: return "Odontol&oacute;gico";
		case 2: return "Medico";
		case 3: return "Laboratorio";
		case 4: return "Veterinario";
		case 5: return "Otro";
		default: return "- Escoja -";
	}
}

//funcion para devolver el valor del tipo de piso
function tipoPiso($valor)
{
	switch ($valor)
	{
		case 1: return "Alfombrado";
		case 2: return "Madera";
		case 3: return "Mármol";
		case 4: return "Baldosa";
		case 5: return "Porcelanato";
		case 6: return "Cer&aacute;mica";
		case 7: return "Laminado";
		case 8: return "Otros";
		default: return "- Escoja -";
	}
}

?>