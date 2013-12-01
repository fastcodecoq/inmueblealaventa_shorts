<?php
extract($_GET);
include('controlSesion.php');
require('bd.php');
include('includes/parametros.php');
include('funciones/fechas.php');


if(isset($_GET["filters"])){

$filters = (isset($_GET["filters"])) ? $_GET["filters"] : null;
$filters = str_replace("[", "{", $filters);
$filters = str_replace("]", "}", $filters);
$filters = stripslashes($filters);
$filters = json_decode($filters, true);

  
  $_GET["para"] = $filters["type"];


if(!empty($filters["tipo_inmueble"]))
  $_GET["tipoInmueble"] = $filters["tipo_inmueble"];

if(!empty($filters["codigo"]))
  $_GET["codigo"] = $filters["codigo"];

if(!empty($filters["precio"]))
  $_GET["precio"] = $filters["precio"];

if(!empty($filters["area"]))
  $_GET["area"] = $filters["area"];

if(!empty($filters["ciudad"]))
  $_GET["ciudad"] = $filters["ciudad"];

$_GET['tipoporye'] = "";

}


if($_GET['para'] == 3)
{
	header("HTTP/1.1 301 Moved Permanently"); 
	header ("Location:".basename("/alquileres.php"));
}

if(!empty($_GET['codigo']))
{
	header("HTTP/1.1 301 Moved Permanently"); 
	header ("Location:".basename("/inmueble.php?cod=".$_GET['codigo']));
}


$idciu=intval($idciu);
$idciu = htmlspecialchars(trim($idciu)); 
$idciu = stripslashes($idciu);
$idciu = mysql_real_escape_string($idciu);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: Inmueble a la Venta ::</title>
<link href="/css/general.css" rel="stylesheet" type="text/css" />

<link href="/css/paginacion_pagina.css" rel="stylesheet" type="text/css" />
<link href="/css/botones.css" rel="stylesheet" type="text/css" />
<link href="/css/nuevos-estilos.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<!-- Estilo de los campos de error-->
<link rel="stylesheet" href="/validadorForm/css/validationEngine.jquery.css" type="text/css"/>

<!-- Script de los validadores-->
<script src="/validadorForm/js/languages/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8">
</script>
<script src="/validadorForm/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
</script>
<script type="text/javascript" src="/funciones/script_cajas.js"></script>
<script type="text/javascript" src="/sideFilters.js"></script>


<script type="text/javascript">

jQuery(document).ready(function() {

	// Formulario y tipo de datos para el validador
	jQuery("#filtros").validationEngine();
	jQuery('input').attr('data-prompt-position','topLeft');
	jQuery('select').attr('data-prompt-position','topLeft');
	
	//consultamos las ciudades del departamento seleccionado 
	$("#departamento").change(function () {
           $("#departamento option:selected").each(function () {
            elegido=$(this).val();
            $.post("/comboCiudades.php", { elegido: elegido }, function(data){
            $("#ciudad").html(data);
            });            
        });
   })
   
   $("#para").change(function(){          
		var value = $("#para option:selected").val();
		
		if(value == '')
		{
			$("#preciosVenta").hide(100);
			$("#preciosArriendo").hide(100);
		}
		
		if(value == 1)
		{
			$("#preciosVenta").show(100);
			$("#preciosArriendo").hide(100);
		}
		
		if(value == 2)
		{
			$("#preciosVenta").hide(100);
			$("#preciosArriendo").show(100);
		}
   });
   
   $("#tipoInmueble").change(function(){          
		var value = $("#tipoInmueble option:selected").val();
		if(value == '')
		{			
			$("#area").show(100);
			$("#habitaciones").show(100);
			$("#banos").show(100);
			$("#garajes").show(100);
			$("#antiguedad").show(100);	
		}
		
		if(value == 1)
		{
			$("#area").show(100);
			$("#habitaciones").show(100);
			$("#banos").show(100);
			$("#garajes").show(100);
			$("#antiguedad").show(100);
		}
		
		if(value == 2)
		{
			$("#area").show(100);
			$("#habitaciones").show(100);
			$("#banos").show(100);
			$("#garajes").show(100);
			$("#antiguedad").show(100);
		}
		
		if(value == 3)
		{
			$("#area").show(100);
			$("#habitaciones").hide(100);
			$("#banos").show(100);
			$("#garajes").hide(100);
			$("#antiguedad").show(100);
		}
		
		if(value == 4)
		{
			$("#area").show(100);
			$("#habitaciones").hide(100);
			$("#banos").show(100);
			$("#garajes").hide(100);
			$("#antiguedad").show(100);
		}
		
		if(value == 5)
		{
			$("#area").show(100);
			$("#habitaciones").hide(100);
			$("#banos").show(100);
			$("#garajes").hide(100);
			$("#antiguedad").show(100);
		}
		
		if(value == 6)
		{
			$("#area").show(100);
			$("#habitaciones").hide(100);
			$("#banos").hide(100);
			$("#garajes").hide(100);
			$("#antiguedad").hide(100);
		}
		
		if(value == 7)
		{
			$("#area").show(100);
			$("#habitaciones").show(100);
			$("#banos").show(100);
			$("#garajes").show(100);
			$("#antiguedad").hide(100);
		}
		
		if(value == 8)
		{
			$("#area").show(100);
			$("#habitaciones").hide(100);
			$("#banos").show(100);
			$("#garajes").show(100);
			$("#antiguedad").show(100);
		}
	
   });

});

</script>
    
</head>

<body>

<?php include_once("analyticstracking.php") ?>
<section>
	<?php include('cabezote.php')?>
    <div class="barraMenu">
    	<div class="contenedor" align="left"><?php include('menu.php')?></div>
    </div>
</section>
<section>
	<div class="contenedor">
    	<div class="lineatiempo"><h1>Apartamentos en Colombia > Venta y Arriendo de inmuebles en Colombia</h1></div>
        
        <!-- Inmuebles -->
        <div style=" min-height:700px;">
            <!-- Filtros -->
           
             <div style="float:left; background:#FFF; border:#989898 1px solid; width:200px; min-height:300px;-moz-border-radius: 10px; -webkit-border-radius: 5px; border-radius: 5px;">
                <div style="padding:10px; font-size:18px;">Filtros</div>
                <div style="margin-left:5px; margin-right:5px">
                <form name="filtros" id="filtros" method="get" action="busquedaFiltros.php">
                <table width="100%" border="0">
                  <tr>
                    <td colspan="2" align="left" class="titulosFiltroNaranja">Departamento</td>
                  </tr>
                  <tr>
                    <td colspan="2" align="left">
                    <select name="departamento" id="departamento" style="width:140px;" class="validate[required]" data-errormessage-value-missing="Seleccione un Departamento">
                        <option value="" selected="selected">- Escoja -</option>
                        <?php
                        $consulta = "SELECT * FROM departamento ORDER BY nombre ASC";	
                        $resultado_dep = mysql_query($consulta, $conexion);
                        
                        while ($registro_dep= mysql_fetch_array($resultado_dep))
                        {
                        ?>
                        <option value="<?php echo $registro_dep["iddepartamento"]?>"> <?php echo $registro_dep["nombre"]?> </option>
                        <?php
                        }
                        ?>
                    </select>
                    </td>
                  </tr>
				  <tr>
                    <td colspan="2"><hr style="border: 0; border-bottom: 1px dashed #F90;" size="1"/></td>
                  </tr>	
                  <tr>
                    <td colspan="2" align="left" class="titulosFiltroNaranja">Ciudad</td>
                  </tr>
                  <tr>
                    <td colspan="2" align="left">
                    <select name="ciudad" style="width:140px;" id="ciudad" class="validate[required]" data-errormessage-value-missing="Seleccione un Municipio">
                        <option value="">- Escoja -</option>
                    </select>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2"><hr style="border: 0; border-bottom: 1px dashed #F90;" size="1"/></td>
                  </tr> 
                  <tr>
                    <td colspan="2" align="left" class="titulosFiltroNaranja">Tipo de inmueble</td>
                  </tr>
                  <tr>
                    <td colspan="2" align="left">
                    <select name="tipoInmueble" id="tipoInmueble" style="width:140px;" class="validate[required]">
                        <option value="">- Escoja -</option>
                        <?php
                        $consulta = "SELECT * FROM tipo_in ORDER BY dest_tip ASC";	
                        $resultado = mysql_query($consulta, $conexion);
                        
                        while ($registro= mysql_fetch_array($resultado))
                        {
                        ?>
                        <option value="<?php echo $registro["tip_inm"]?>"> <?php echo $registro["dest_tip"]?> </option>
                        <?php
                        }
                        ?>
                    </select>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2"><hr style="border: 0; border-bottom: 1px dashed #F90;" size="1"/></td>
                  </tr>
                  <tr>
                    <td colspan="2" align="left" class="titulosFiltroNaranja">Tipo de negociaci&oacute;n </td>
                  </tr>
                  <tr>
                    <td colspan="2" align="left" >
                    <select name="para" style="width:140px;" id="para" class="validate[required]">
                        <option value="">- Escoja -</option>
                        <option value="1">Compra</option>
                        <option value="2">Arriendo</option>
                    </select>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2"><hr style="border: 0; border-bottom: 1px dashed #F90;" size="1"/></td>
                  </tr>
                  
                   <tr>
                    <td colspan="2">
                    <div id="preciosVenta" style="display:none">
                    <table width="100%" border="0">
                   	  <tr>
                        <td colspan="2" align="left" class="titulosFiltroNaranja">Precio (millones)</td>
                      </tr>
                      <tr>
                        <td width="81%">Hasta 40 millones</td>
                        <td width="19%"><input type="radio" name="precioVenta" id="precioVenta" value="1" /></td>
                      </tr>
                      <tr>
                        <td>40 a 70 millones</td>
                        <td><input type="radio" name="precioVenta" id="precioVenta" value="2" /></td>
                      </tr>
                      <tr>
                        <td>70 a 100 millones</td>
                        <td><input type="radio" name="precioVenta" id="precioVenta" value="3" /></td>
                      </tr>
                      <tr>
                        <td>100 a 200 millones</td>
                        <td><input type="radio" name="precioVenta" id="precioVenta" value="4" /></td>
                      </tr>
                      <tr>
                        <td>M&aacute;s de 200 >></td>
                        <td><input type="radio" name="precioVenta" id="precioVenta" value="5" /></td>
                      </tr>
                      <tr>
                        <td colspan="2"><hr style="border: 0; border-bottom: 1px dashed #F90;" size="1"/></td>
                      </tr>
                    </table>
                    </div>
                    </td>
                  </tr>
                  
                  
                  <tr>
                    <td colspan="2">
                    <div id="preciosArriendo" style="display:none">
                    <table width="100%" border="0">
                   	  <tr>
                        <td colspan="2" align="left" class="titulosFiltroNaranja">Precio (miles)</td>
                      </tr>
                      <tr>
                        <td width="81%">Hasta 300.000</td>
                        <td width="19%"><input type="radio" name="precioArriendo" id="precioArriendo" value="1" /></td>
                      </tr>
                      <tr>
                        <td>300.000-1.000.000</td>
                        <td><input type="radio" name="precioArriendo" id="precioArriendo" value="2" /></td>
                      </tr>
                      <tr>
                        <td>1.000.000-1.300.000</td>
                        <td><input type="radio" name="precioArriendo" id="precioArriendo" value="3" /></td>
                      </tr>
                      <tr>
                        <td>1.300.000-6.000.000</td>
                        <td><input type="radio" name="precioArriendo" id="precioArriendo" value="4" /></td>
                      </tr>
                      <tr>
                        <td>6.000.000-9.000.000</td>
                        <td><input type="radio" name="precioArriendo" id="precioArriendo" value="5" /></td>
                      </tr>
                      <tr>
                        <td>M&aacute;s de 9.000.000</td>
                        <td><input type="radio" name="precioArriendo" id="precioArriendo" value="6" /></td>
                      </tr>
                      <tr>
                        <td colspan="2"><hr style="border: 0; border-bottom: 1px dashed #F90;" size="1"/></td>
                      </tr>
                    </table>
                    </div>
                    </td>
                  </tr>
                  
                  
                  <tr>
                    <td colspan="2">
                    <div id="area">
                    <table width="100%" border="0">
                      <tr>
                        <td colspan="2" align="left" class="titulosFiltroNaranja">&Aacute;rea m&sup2;</td>
                      </tr>
                      <tr>
                        <td width="81%">Hasta 60</td>
                        <td width="19%"><input type="radio" name="area" id="radio" value="1" /></td>
                      </tr>
                      <tr>
                        <td>60 a 100</td>
                        <td><input type="radio" name="area" id="radio" value="2" /></td>
                      </tr>
                      <tr>
                        <td>100 a 200</td>
                        <td><input type="radio" name="area" id="radio" value="3" /></td>
                      </tr>
                      <tr>
                        <td>200 a 300</td>
                        <td><input type="radio" name="area" id="radio" value="4" /></td>
                      </tr>
                      <tr>
                        <td>M&aacute;s de 300</td>
                        <td><input type="radio" name="area" id="radio" value="5" /></td>
                      </tr>
                      <tr>
                        <td colspan="2"><hr style="border: 0; border-bottom: 1px dashed #F90;" size="1"/></td>
                      </tr>
                    </table>
                    </div>
                    </td>
                  </tr>
                                                  
                                 
				  <tr>
                    <td colspan="2">
                    <div id="habitaciones">
                    <table width="100%" border="0">
                      <tr>
                        <td colspan="2" align="left" class="titulosFiltroNaranja">Habitaciones</td>
                      </tr>
                      <tr>
                        <td width="81%">1 Habitaci&oacute;n</td>
                        <td width="19%"><input type="radio" name="habitaciones" id="habitaciones" value="1" /></td>
                      </tr>
                      <tr>
                        <td>2 Habitaciones</td>
                        <td><input type="radio" name="habitaciones" id="habitaciones" value="2" /></td>
                      </tr>
                      <tr>
                        <td>3 Habitaciones</td>
                        <td><input type="radio" name="habitaciones" id="habitaciones" value="3" /></td>
                      </tr>
                      <tr>
                        <td>4 Habitaciones</td>
                        <td><input type="radio" name="habitaciones" id="habitaciones" value="4" /></td>
                      </tr>
                      <tr>
                        <td>5 + habitaciones</td>
                        <td><input type="radio" name="habitaciones" id="habitaciones" value="5" /></td>
                      </tr>
                      <tr>
                        <td colspan="2"><hr style="border: 0; border-bottom: 1px dashed #F90;" size="1"/></td>
                      </tr>
                    </table>
                    </div>
                  	</td>
                  </tr>

				  
                  <tr>
                    <td colspan="2">
                    <div id="banos">
                    <table width="100%" border="0">
                      <tr>
                        <td colspan="2" align="left" class="titulosFiltroNaranja">Ba&ntilde;os</td>
                      </tr>
                      <tr>
                        <td width="81%">1 Ba&ntilde;o</td>
                        <td width="19%"><input type="radio" name="bano" id="bano" value="1" /></td>
                      </tr>
                      <tr>
                        <td>2 Ba&ntilde;os</td>
                        <td><input type="radio" name="bano" id="bano" value="2" /></td>
                      </tr>
                      <tr>
                        <td>3 Ba&ntilde;os</td>
                        <td><input type="radio" name="bano" id="bano" value="3" /></td>
                      </tr>
                      <tr>
                        <td>4 Ba&ntilde;os</td>
                        <td><input type="radio" name="bano" id="bano" value="4" /></td>
                      </tr>
                      <tr>
                        <td>5 + Ba&ntilde;os</td>
                        <td><input type="radio" name="bano" id="bano" value="5" /></td>
                      </tr>
                      <tr>
                        <td colspan="2"><hr style="border: 0; border-bottom: 1px dashed #F90;" size="1"/></td>
                      </tr>
                    </table>
                    </div>
                    </td>
                  </tr>
                  
                  
                  <tr>
                    <td colspan="2">
                    <div id="garajes">
                    <table width="100%" border="0">
                      <tr>
                        <td colspan="2" align="left" class="titulosFiltroNaranja">Garajes</td>
                      </tr>
                      <tr>
                        <td width="81%">1 Garaje</td>
                        <td width="19%"><input type="radio" name="garaje" id="garaje" value="1" /></td>
                      </tr>
                      <tr>
                        <td>2 Garajes</td>
                        <td><input type="radio" name="garaje" id="garaje" value="2" /></td>
                      </tr>
                      <tr>
                        <td>3 Garajes</td>
                        <td><input type="radio" name="garaje" id="garaje" value="3" /></td>
                      </tr>
                      <tr>
                        <td>4 Garajes</td>
                        <td><input type="radio" name="garaje" id="garaje" value="4" /></td>
                      </tr>
                      <tr>
                        <td>5 + Garajes</td>
                        <td><input type="radio" name="garaje" id="garaje" value="5" /></td>
                      </tr>
                      <tr>
                        <td colspan="2"><hr style="border: 0; border-bottom: 1px dashed #F90;" size="1"/></td>
                      </tr>
                    </table>
                    </div>
                    </td>
                  </tr>
                  
				  
                  <tr>
                    <td colspan="2">
                    <div id="antiguedad">
                    <table width="100%" border="0">
                      <tr>
                        <td colspan="2" align="left" class="titulosFiltroNaranja">Antig&uuml;edad</td>
                      </tr>
                      <tr>
                        <td width="81%">Sobre Plano</td>
                        <td width="19%"><input type="radio" name="antiguedad" id="antiguedad" value="1" /></td>
                      </tr>
                      <tr>
                        <td>En construcci&oacute;n</td>
                        <td><input type="radio" name="antiguedad" id="antiguedad" value="2" /></td>
                      </tr>
                      <tr>
                        <td>de 0 a 5 a&ntilde;os</td>
                        <td><input type="radio" name="antiguedad" id="antiguedad" value="3" /></td>
                      </tr>
                      <tr>
                        <td>de 5 a 10 a&ntilde;os</td>
                        <td><input type="radio" name="antiguedad" id="antiguedad" value="4" /></td>
                      </tr>
                      <tr>
                        <td>de 10 a 20 a&ntilde;os</td>
                        <td><input type="radio" name="antiguedad" id="antiguedad" value="5" /></td>
                      </tr>
                      <tr>
                        <td>M&aacute;s de 20 a&ntilde;os</td>
                        <td><input type="radio" name="antiguedad" id="antiguedad" value="6" /></td>
                      </tr>
                      <tr>
                        <td colspan="2"><hr style="border: 0; border-bottom: 1px dashed #F90;" size="1"/></td>
                      </tr>
                    </table>
                    </div>
                    </td>
                  </tr>
                  
                  	
				  <tr>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2" align="center"><input type="submit" name="button" id="button" value="Filtrar" class="boton bigrounded naranja" /></td>
                  </tr>
                  <tr>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                </table>
                </form>
                </div>
                </div>
            
            
            <!-- Inmuebles -->
            <?php
			
			$pagina = "propiedades.php"; 	//your file name  (the name of this file)
			$TAMANO_PAGINA = 12; 								//how many items to show per page
			$page = $_GET['page'];
			
			
			if($page) 
				$inicio = ($page - 1) * $TAMANO_PAGINA; 			//first item to display on this page
			else
				$inicio = 0;	
            
			$condarea="";
			$condprecio="";
			$condTipInm="";
			$tipoInmueble = $_GET['tipoInmueble']; //1 venta 2 Arriendo 3 Alquiler
			$ciudad = $_GET['ciudad'];
			$area = $_GET['area'];
			$precio = $_GET['precio'];
			$tipoBusqueda=$_GET['para'];
			$tipoporye=$_GET['tipoporye'];
			 //1 venta 2 Arriendo 3 Alquiler
			 
			 if($tipoInmueble == 0)
			{
				$condTipInm = "";
			}
			else
			{
				$condTipInm = " AND inmueble.tipo_inm = $tipoInmueble";
			}
			
			
			if($tipoporye == "")
			{
				$tipoporye = "";
			}
			else
			{
				$tipoporye = " AND inmueble.campo_4 = $tipoporye";
			}
			
			
			
			
			if($area == 0)
			{
				$condarea = "";
			}
			else
			{
				
				$traevalor="select * from area where idarea='".$area."'";
				$muestra=mysql_query($traevalor);
				$ejecutaarea=mysql_fetch_assoc($muestra);
				$areaini=$ejecutaarea['areaini'];
				$areafin=$ejecutaarea['areafin'];
				
				$condarea = " AND $areaini <= inmueble.campo_6 and $areafin >= inmueble.campo_6";
			}
			
			if($precio == 0)
			{
				$condprecio = "";
			}
			else
			{
				
				$traevalor="select * from precio where idpre='".$precio."'";
				$muestra=mysql_query($traevalor);
				$ejecutaarea=mysql_fetch_assoc($muestra);
				$preini=$ejecutaarea['preini'];
				$prefin=$ejecutaarea['prefin'];
				
				if($para == 1)
					{
					
							$condprecio = " AND $preini <= inmueble.campo_5 and $prefin >= inmueble.campo_5";
					}
					else if($para == 2)
							{
								
									$condprecio = " AND $preini <= inmueble.campo_53 and $prefin >= inmueble.campo_53";
								
							}
				//$condprecio = " AND $areaini <= inmueble.campo_6 and $areafin >= inmueble.campo_6";
			}
			
			
			
			
			if($codigo == "")
			{
				$condCodigo = "";
			}
			else
			{
				$condCodigo = " AND inmueble.codigo = $codigo";
			}
			
			if($ciudad != 0)
			{
				$condCiudad = " AND inmueble.ciudad = $ciudad";
			}
			else
			{
				$condCiudad = "";
			}
			
			$condicionOrdenar = "ORDER BY inmueble.plan = 3 DESC";
			$orden = $_GET['orden'];
			if($_POST['orden'] != 0)
			{
				$orden =$_POST['orden'];
			}
			
			//$tipoInmueble = $_GET['tipoInmueble'];
			//$codigo = $_GET['codigo'];
			//$palabraClave = $_GET['palabraClave'];
			
			/*if($palabraClave != "")
			{
				$condPalabraClave = " AND (inmueble.dir LIKE '%".$palabraClave."%' OR inmueble.campo_1 LIKE '%".$palabraClave."%' OR inmueble.comentarioUsuario LIKE '%".$palabraClave."%' )";
			}
			else
			{
				$condPalabraClave = "";
			}
			
			
			if($tipoInmueble == 0)
			{
				$condTipInm = "";
			}
			else
			{
				$condTipInm = " AND inmueble.tipo_inm = $tipoInmueble";
			}
			
			

			*/
			// Para venta
			
			
			if($tipoBusqueda == 4)
			{
				$tipo_negociacion = " AND inmueble.tipo_neg='".$_GET['para']."' ";
			}
			
			if($tipoBusqueda == 1)
			{
				if($orden == 1)
				{
					$condicionOrdenar = " ORDER BY fecha_activacion DESC";
				}
				else if($orden == 2)
					{
						$condicionOrdenar = " ORDER BY fecha_activacion ASC";
					}
					else if($orden == 3)
						{
						$condicionOrdenar = " ORDER BY CONCAT(REPEAT('0', 40 - LENGTH(campo_5)), campo_5) DESC ";
						}		
						else if($orden == 4)
							{
							$condicionOrdenar = " ORDER BY CONCAT(REPEAT('0', 40 - LENGTH(campo_5)), campo_5) ASC ";
							}
							else if($orden == 5)
								{
								$condicionOrdenar = " ORDER BY CONCAT(REPEAT('0', 40 - LENGTH(campo_6)), campo_6) DESC ";
								}
								else if($orden == 6)
									{
									$condicionOrdenar = " ORDER BY CONCAT(REPEAT('0', 40 - LENGTH(campo_6)), campo_6) ASC ";
									}
									
									$tipo_negociacion = " AND inmueble.tipo_neg IN ($tipoBusqueda,3) ";
			}
			
			// Para Arriendo
			if($tipoBusqueda == 2)
			{
				if($orden == 1)
				{
					$condicionOrdenar = " ORDER BY fecha_activacion DESC";
				}
				else if($orden == 2)
					{
						$condicionOrdenar = " ORDER BY fecha_activacion ASC";
					}
					else if($orden == 3)
						{
						$condicionOrdenar = " ORDER BY CONCAT(REPEAT('0', 40 - LENGTH(campo_53)), campo_53) DESC ";
						}		
						else if($orden == 4)
							{
							$condicionOrdenar = " ORDER BY CONCAT(REPEAT('0', 40 - LENGTH(campo_53)), campo_53) ASC ";
							}
							else if($orden == 5)
								{
								$condicionOrdenar = " ORDER BY CONCAT(REPEAT('0', 40 - LENGTH(campo_6)), campo_6) DESC ";
								}
								else if($orden == 6)
									{
									$condicionOrdenar = " ORDER BY CONCAT(REPEAT('0', 40 - LENGTH(campo_6)), campo_6) ASC ";
									}
									
									$tipo_negociacion = " AND inmueble.tipo_neg IN ($tipoBusqueda,3) ";
			}
			
				$consulta = "SELECT usuarios.banner1, usuarios.rol, 
			CONCAT(usuarios.nombres,' ',usuarios.apellidos) AS nombre, tipo_in.dest_tip, 
			municipio.nombreMunicipio, inmueble.* FROM inmueble,tipo_in,municipio, usuarios,rol where
			inmueble.tipo_inm = tipo_in.tip_inm 
			and inmueble.ciudad = municipio.idmunicipio
			and inmueble.usuario = usuarios.identificacion
			and usuarios.rol = rol.idrol
			and inmueble.estado = 1 $condTipInm $tipoporye  $condarea $condCiudad $condprecio $tipo_negociacion $condicionOrdenar "; // $condCodigo $tipo_negociacion $condCiudad $condPalabraClave $condicionOrdenar";
			//echo $consulta;
			
            $resultado = mysql_query($consulta, $conexion);
            $num_registros = mysql_num_rows($resultado);
            $total_paginas = ceil($num_registros / $TAMANO_PAGINA); 
            $registro = mysql_fetch_assoc($resultado);
			
			if ($num_registros >=3)
			{
				$alto="";
			}
			else
			{
				$alto="height:400px";
			}
			?>     
            <div style="float:left; width:530px; margin-left:30px; <?php echo $alto?>"  id="contenedor1">
            
            <form action="" method="post" name="frm_propiedades" id="frm_propiedades">
            <?php	
			
			
			
			
			
			
			
			
			
			
            $consulta = "SELECT usuarios.banner1, usuarios.rol, CONCAT(usuarios.nombres,' ',usuarios.apellidos) AS nombre,  
			tipo_in.dest_tip, municipio.nombreMunicipio, inmueble.* FROM inmueble ,tipo_in,municipio, usuarios,rol
			WHERE inmueble.estado = 1 
			and inmueble.tipo_inm = tipo_in.tip_inm 
			and inmueble.ciudad = municipio.idmunicipio
			and inmueble.usuario = usuarios.identificacion
			and  usuarios.rol = rol.idrol
			$tipoporye $condTipInm  $condarea $condCiudad $condprecio $tipo_negociacion $condicionOrdenar ";// $tipo_negociacion $condCiudad $condPalabraClave  LIMIT $inicio , $TAMANO_PAGINA  ";
			require 'funciones/paginador_header.php';
			
			
			//Consultar inmuebles
			//$consulta = "SELECT usuarios.banner1, usuarios.rol, CONCAT(usuarios.nombres,' ',usuarios.apellidos) AS nombre, tipo_in.dest_tip, municipio.nombreMunicipio, inmueble.* FROM inmueble 
//JOIN tipo_in ON inmueble.tipo_inm = tipo_in.tip_inm 
//JOIN municipio ON inmueble.ciudad = municipio.idmunicipio
//JOIN usuarios ON inmueble.usuario = usuarios.identificacion
//JOIN rol ON usuarios.rol = rol.idrol
//WHERE inmueble.estado = 1 $condTipInm $condCodigo $tipo_negociacion $condCiudad $condPalabraClave $condicionOrdenar";
//            $resultado = mysql_query($consulta, $conexion);
//            $num_registros = mysql_num_rows($resultado);
//            $total_paginas = ceil($num_registros / $TAMANO_PAGINA); 
//            $registro = mysql_fetch_array($resultado);
//            
//            $consulta = "SELECT usuarios.banner1, usuarios.rol, CONCAT(usuarios.nombres,' ',usuarios.apellidos) AS nombre,  tipo_in.dest_tip, municipio.nombreMunicipio, inmueble.* FROM inmueble 
//JOIN tipo_in ON inmueble.tipo_inm = tipo_in.tip_inm 
//JOIN municipio ON inmueble.ciudad = municipio.idmunicipio
//JOIN usuarios ON inmueble.usuario = usuarios.identificacion
//JOIN rol ON usuarios.rol = rol.idrol
//WHERE inmueble.estado = 1 $condTipInm $condCodigo $tipo_negociacion $condCiudad $condPalabraClave $condicionOrdenar LIMIT $inicio , $TAMANO_PAGINA  ";
            $resultado = mysql_query($consulta, $conexion);
			//."&tipoInmueble=".$_GET["tipoInmueble"]."&ciudad=".$_GET["ciudad"]."&codigo=".$_GET["codigo"]."&orden=$orden";
			$varia="";
			
			
			$anexo ="para=".$_GET["para"]."&tipoInmueble=".$_GET["tipoInmueble"]."&ciudad=".$_GET["ciudad"]."&codigo=".$_GET["codigo"]."&orden=$orden";
				
			$ruta_busqueda="cmb_ciudad_a=".$_GET["ciudad"]."&Submit=Consultar";
			
			
			
			?>
            <div style="overflow:hidden">
              <div style="float:left; width:250px; padding-bottom:10px">Se han encontrado <?php echo $num_registros?> inmueble(s)</div>
                <div style="float:left; width:280px; text-align:right">
                  <select name="orden" id="orden" onchange="document.frm_propiedades.action = 'propiedades.php?<?php echo $anexo;?>';document.frm_propiedades.submit();">
                  <optgroup label="Publicaci&oacute;n">
                  	<option  value="1" <?php if($orden == 1) { echo 'selected';}?>>Desde la m&aacute;s reciente</option>
                    <option  value="2" <?php if($orden == 2) { echo 'selected';}?>>Desde la m&aacute;s antigua</option>
                  </optgroup>
                  <optgroup label="Por precio">
                  	<option  value="3" <?php if($orden == 3) { echo 'selected';}?>>De mayor a menor</option>
                    <option  value="4" <?php if($orden == 4) { echo 'selected';}?>>De menor a mayor</option>
                  </optgroup>
                  <optgroup label="Por &aacute;rea">
                  	<option  value="5" <?php if($orden == 5) { echo 'selected';}?>>De mayor a menor</option>
                    <option  value="6" <?php if($orden == 6) { echo 'selected';}?>>De menor a mayor</option>
                  </optgroup>
                  </select>
                </div>
           </div>
            <?php
			
			//include_once("funciones/paginacion_pagina.php");
			
			 
            if(mysql_num_rows($resultado) > 0)
            {?>
				
                <ul class="resultados">
                
                <?php
                while($registro = mysql_fetch_array($resultado))
                {
					
					$fecha_ini = $registro['fecha_activacion'];
					$fecha_final = date(Y.'-'.m.'-'.d);
//					$dias_activacion = diferencia_en_dias($fecha_ini,$fecha_final);
                ?>
                
              
                <?php 
				//if($registro['plan'] == 3 && $dias_activacion <= 30)
				//{
					?>
                	
                <?php
                //}
                ?>
                <?php
				//Consultamos la primera imagen del inmueble
				$consulta = "SELECT foto FROM fotos_inm WHERE cod_inm = '".$registro['codigo']."' LIMIT 0,1";
            	$resultadoFoto = mysql_query($consulta, $conexion);
				$nFotos = mysql_num_rows($resultadoFoto);
				$registroFoto = mysql_fetch_array($resultadoFoto);
				
				if (file_exists("inmuebles/".$registroFoto["foto"]))
				{ 
				   $foto=$registroFoto["foto"];
				}else{ 
				$extension = explode(".", $registroFoto["foto"]);
				$nombre = $extension[0];
				$extension = $extension[sizeof($extension)-1];
				$foto = "";

					switch ($extension)
					{
						case 'JPG':		$foto = $nombre.".jpg";
										break;
						case 'JPGE':	$foto = $nombre.".jpg";
										break;
						default:		$foto = $nombre.".jpg";
										break;
					}
				}
				?>
                
                
	
   	  <li>
        	<div class="imagen">
             <?php 
					if($nFotos > 0)
					{
					?>
                    <img src="/redimencionar.php?src=inmuebles/<?php echo $foto."&w=150&h=120"?>" border="0" title="Ver informacion" />
                    <?php
					}
					else
					{
					?>
                    <img src="/imagenes/sinImagen150.jpg" width="150" height="120" title="Ver informacion" border="0" />
                    <?php
					}
					?>
            </div>
        <div class="detalles">
            	<h2><?php echo tipo_negocio_imprimir($registro['tipo_neg'])." ".$registro['dest_tip']?></h2>
                <p>&nbsp;</p>
          <p><?php echo $registro['campo_1']?> • <?php echo $registro['nombreMunicipio']?> • <?php echo $registro['nombre']?> </p>
            
            <p>&nbsp;</p>
                <p>&nbsp;</p>
                
               
                <p>Area <?php echo $registro['campo_6']?> m&sup2 • <?php echo $registro['campo_24']?> Habitaciones • <?php echo $registro['campo_9']?> Baños &nbsp; • <?php echo $registro['campo_17']?> Garaje</p>
          </div>
            <div class="contacto">
              	<p>                      <?php 
					if($tipoBusqueda == 1)
					{
						if ($registro['campo_5']!="")
						{
							echo "$".number_format($registro['campo_5'],0,',','.');
						}
					}
					else if($tipoBusqueda == 2)
							{
								if ($registro['campo_53']!="")
								{
									echo "$".number_format($registro['campo_53'],0,',','.');
								}
							}
					?>

				</p>
              <?php
                   
						if($registro['banner1'] != '')
						{
                    	?>
                        <img src="/redimencionar.php?src=bannerInmobiliariaConstructora/<?php echo $registro['banner1']."&h=70"?>" border="0" title="Ver informacion" />
                    	<?php
						}
						
						else
					{
					?>
                    <img src="/imagenes/personat.jpg" width="94px" height="56px" title="Ver informacion" border="0" />
                    <?php
					}
					?>
					
              <a href="inmueble.php?cod=<?php echo $registro['codigo']?>" class="boton">Ver inmueble</a>
            </div>
      </li>
                 
            <?php
				}
				?>
				</ul>
                
            <?php
			}
			else
			{
				echo "<div align='center' style='clear:left; padding-top:30px;'>No existen inmuebles en el momento</div>";
			}
			?>
            	<div>
                	<?php
                    	require 'funciones/paginador_footer.php';
                	?>
                </div>
            </form>
         
            </div>
            <div style="float:left; margin-left:30px;overflow:hidden; background:#FFF; border:#989898 1px solid; width:180px; min-height:211px;-moz-border-radius: 10px; -webkit-border-radius: 5px; border-radius: 5px;">
        	<h1  style="padding-left:15px; font-size:12px"><img src="/imagenes/flecha.png" width="19" height="18" />Enlaces recomendados</h1>

            <hr style="border: 0; border-bottom: 1px dashed #F90;" size="1">
			<?php /*?><?php
            $consulta = "SELECT * FROM noticias ORDER BY n_visitas DESC LIMIT 0,5";	
            $resultado = mysql_query($consulta, $conexion); 
			$numRegistros = mysql_num_rows($resultado);
            while($registro= mysql_fetch_array($resultado))
			{
			?>
            	<li style="padding-left: 12px; padding-bottom:4px; background: url(/imagenes/bullet_black.png) 0em 0.5em no-repeat;    margin-bottom: 1em; margin-left:-25px; border-bottom:#CCC 1px dotted; margin-right:15px;"><a href="noticia.php?not=<?php echo $registro["id"]?>" class="lomasleido"><?php echo $registro['titulo']?></a></li>
            <?php
            }
			?><?php */?>
            <?php
			
			$ciudad = $_GET['ciudad'];
			
			if($ciudad != 0)
			{
				$condCiudad = " AND inmueble.ciudad = $ciudad";
			}
			else
			{
				$condCiudad = "";
			}
			
             $sql="SELECT tipo_in.dest_tip, municipio.nombreMunicipio, tipo_in.tip_inm, tipo_neg, departamento.nombre, inmueble . *
FROM inmueble, municipio, departamento, tipo_in
WHERE inmueble.estado =1
AND municipio.idmunicipio = inmueble.ciudad and tipo_neg=1
AND municipio.departamento_iddepartamento = departamento.iddepartamento $condCiudad 
ORDER BY RAND( )
LIMIT 11 "; 

$ejecuta=mysql_query($sql);
while ($muestra=mysql_fetch_assoc($ejecuta))
{
	$tipoin="";
	if($muestra['tipo_neg']==1){		$tipoin="Venta";	}
	else if ($muestra['tipo_neg']==2){ 	$tipoin="Arriendo";	}
	
 echo '<a href="#" style="color:#000;"" onclick="enviarpagina('.$muestra['tipo_neg'].','.$muestra['tip_inm'].','.$muestra['ciudad'].')"><div  style="font-size:10px; margin-left:5px">'.$tipoin." ".$muestra['dest_tip']." ".$muestra['nombreMunicipio']."  &nbsp;".'</div></a><br />';

}
?>
           
           
           
            </div>
            
             <!-- Noticias -->
             <div style="float:left; margin-top: 10px; margin-left:30px;overflow:hidden; border:#989898 1px solid; width:180px; min-height:211px;-moz-border-radius: 10px; -webkit-border-radius: 5px; border-radius: 5px;" >
    	<?php
		$consulta_banner="SELECT * FROM banner WHERE posicion = 2 AND estado = 1 ORDER BY fecha DESC limit 0,1"; 
		$resultado_banner=mysql_query($consulta_banner,$conexion);
		$num_banner = mysql_num_rows($resultado_banner);
		$registro_banner=mysql_fetch_array($resultado_banner);
		$archivo = $registro_banner['archivo'];
		if($registro_banner['link'] != '')
			$link = $registro_banner['link'];
			else
				$link = '#';
		
		if($num_banner != 0)
		{
		?>
         
           <a href="<?php echo $link?>" <?php if($link != '#') {  }?>> <img  style=" " src="/banner/<?php echo $archivo?>" weight="201px" height="495px" border="0" title="Ver informacion" /></a>
        <?php
		}
		else
		{
		?>
        	<img  style=" " src="/imagenes/paute.jpg" weight="201px" height="495px" />
        <?php
		}
		?></div>
      	</div>
        
        
        
	  
        
       
        
        
        <!-- Div en blanco-->
        <div style="clear:left; height:20px;"></div>
        
    </div>    
</section>



<footer>
<?php include('pie.php')?>
</footer>
</body>
</html>