INMUEBLE A LA VENTA SHORT APPS
==============================


Desarrollado por Gomosoft


___________


USO
---


*Para obtener el short especifico de un inmueble, debemos hacer el request (GET) a la URL:*

```
GET /short/direct/id_inmueble
```

Ejemplo de uso

```html
<a href="/short/direct/70">Ver inmueble</a>
```

Retorna un String:

```javascript
   "/inmuebl/s/casa/venta/bogota/2-habitaciones-1-garajes-2-baños[70]"
```



lo anterior resultará con un href, al final de la carga del documento así:

```html
<a href="/inmuebl/s/casa/venta/bogota/2-habitaciones-1-garajes-2-baños[70]">Ver inmueble</a>
```




*Para salvar un short de un nuevo inmuble creado, debemos hacer un reques (GET) al la URL:*

```
GET  /short/post/id_inmuble
```

Retorna un JSON:


```json
{
  "success" : "yep | nope",
  "rs" : {
  	   "short" : "SHORT_CREADO"
      }	
}
```


Ejemplo de uso

Una vez se halla creado un nuevo inmueble, antes de finalizar el script (creador de inmueble, hacer el siguiente llamado)


```php
 $create_short =  file_get_content( "http://" . $_SERVER["HTTP_HOST"]  . "/short/post/CAMBIAR_ESTO_POR_EL_ID_DEL_INMUEBLE_CREADO");
```

Ese llamado nos retornará un JSON el cual parseamos así:


```php
$create_short = json_decode($create_short, true); //el true es para recibir el JSON en un array y no en un std_class

//validamos si efectivamente se salvo el short


if($create_short["success"] === "yep")
   //se ha creado 
else
  //no se ha creado 

```

*Llamdo desde AJAX usando jQuery*

Salvar short:

```javascript
  function on_success(rs){ if(rs.succcess === "yep") //creado else //no creado }
  function on_error(error){ console.log(error.response_text) }

  $.ajax({
     
      url : "/short/post/ID_DEL_INMUEBLE",
      type : "GET",
      dataType : "JSON",
      async : false,
      success : on_success,
      error : on_error

   });
```

Obetenr short de un inmueble especifico:


```javascript
  function on_success(rs){ if(rs.succcess === "yep") //obtenido else //no obtenido }
  function on_error(error){ console.log(error.response_text) }

  $.ajax({
     
      url : "/short/get/ID_DEL_INMUEBLE",
      type : "GET",
      dataType : "JSON",
      async : false,
      success : on_success,
      error : on_error

   });
```

*Algunas funcionalidades extras*


Obtener nombre de la ciudad a partir del id:

hacer un request GET, a la URL:

```
GET /city/AQUI_EL_CODIGO_DE_LA_CIUDAD
```

Retorna un String


```javascript
  "barranquilla"
```

Ejemplo desde javascript con Ajax + jQuery


```javascript
  function on_success(city_name){ if(city_name instanceof String) //obtenido  else //no obtenido }
  function on_error(error){ console.log(error.response_text) }

  $.ajax({
     
      url : "/city/ID_DE_LA_CIUDAD",
      type : "GET",
      async : false,
      success : on_success,
      error : on_error

   });
```





