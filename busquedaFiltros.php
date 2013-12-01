<?php
include($_SERVER["DOCUMENT_ROOT"] .'/controlSesion.php');
require($_SERVER["DOCUMENT_ROOT"] .'/bd.php');
include($_SERVER["DOCUMENT_ROOT"] .'/includes/parametros.php');
include($_SERVER["DOCUMENT_ROOT"] . '/funciones/fechas.php');


     

 if(isset($_GET["filters"]))
      {      


        $filters = $_GET["filters"];      
        unset($_GET["filters"]);
        $filters = str_replace("[", "{", $filters);
        $filters = str_replace("]", "}", $filters);
        $filters = stripslashes($filters);
        $filters = json_decode($filters, true);

  
        $_GET["para"] = $filters["type"];
        $_GET["departamento"] = $filters["departamento"];
        $_GET["button"] = "Filtrar";

        if(!empty($filters["ciudad"]))
           $_GET["ciudad"] = $filters["ciudad"];

         if(!empty($filters["tipo_inmueble"]))
           $_GET["tipoInmueble"] = $filters["tipo_inmueble"];

         if(!empty($filters["area"]))
           $_GET["area"] = $filters["area"];

         if(!empty($filters["precioVenta"]))
              $_GET["precioVenta"] = $filters["precioVenta"];
 


        if(!empty($filters["precioArriendo"]))
              $_GET["precioArriendo"] = $filters["precioArriendo"];
    

         if(!empty($filters["habitaciones"]))
           $_GET["habitaciones"] = $filters["habitaciones"];
    

          if(!empty($filters["bano"]))
           $_GET["bano"] = $filters["bano"];


        if(!empty($filters["garaje"]))
           $_GET["garaje"] = $filters["garaje"];
 

        if(!empty($filters["antiguedad"]))
           $_GET["antiguedad"] = $filters["antiguedad"];

         if(!empty($filters["barrio"]))
            $_GET["barrio"] = $filters["barrio"];
    


      }




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: Inmueble a la Venta ::</title>
<link href="/css/general.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="/css/orbit-1.2.3.css">
<link rel="stylesheet" href="/css/slideOrbit.css">
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

<section>
	<?php include('cabezote.php')?>
    <div class="barraMenu">
    	<div class="contenedor" align="left"><?php include('menu.php')?></div>
    </div>
</section>

<section>
	<div class="contenedor">
    	<div>
    	  <h1>Inmuebles</h1></div>
        
        <!-- Inmuebles -->
        <div style=" float:left; width:702px; min-height:700px;">
            <!-- Filtros -->
            <div style="float:left; width:160px;">
                <div style="float:left; background:#FFF; border:#989898 1px solid; width:155px; min-height:300px;-moz-border-radius: 10px; -webkit-border-radius: 5px; border-radius: 5px;">
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
                        <option value="<?php echo $registro_dep["iddepartamento"]?>" <?php if($_GET["departamento"] == $registro_dep["iddepartamento"]) { echo "selected"; } ?>> <?php echo $registro_dep["nombre"]?> </option>
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
                    	<?php
						$consulta = "SELECT * FROM municipio WHERE departamento_iddepartamento = ".$_GET["departamento"]." ORDER BY nombreMunicipio ASC";
						
						$resultado_ciu = mysql_query($consulta, $conexion);
						
						while ($registro_ciu= mysql_fetch_array($resultado_ciu))
						{
						?>
							<option value="<?php echo $registro_ciu["idmunicipio"]?>" <?php if($_GET['ciudad'] == $registro_ciu["idmunicipio"]) { echo "selected"; } ?> ><?php echo $registro_ciu["nombreMunicipio"]?></option>
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
                    <td colspan="2" align="left" class="titulosFiltroNaranja">Tipo de inmueble</td>
                  </tr>
                  <tr>
                    <td colspan="2" align="left">
                    <select name="tipoInmueble" id="tipoInmueble" style="width:140px;" class="validate[required]" data-errormessage-value-missing="Campo obligatorio">
                        <option value="">- Escoja -</option>
                        <?php
                        $consulta = "SELECT * FROM tipo_in ORDER BY dest_tip ASC";	
                        $resultado = mysql_query($consulta, $conexion);
                        
                        while ($registro= mysql_fetch_array($resultado))
                        {
                        ?>
                        <option value="<?php echo $registro["tip_inm"]?>" <?php if($_GET['tipoInmueble'] == $registro["tip_inm"]){ echo 'selected';} ?>> <?php echo $registro["dest_tip"]?> </option>
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
                    <td colspan="2" align="left" class="titulosFiltroNaranja">Tipo de negociaci&oacute;n</td>
                  </tr>
                  <tr>
                    <td colspan="2" align="left" >
                    <select name="para" style="width:140px;" id="para" class="validate[required]">
                        <option value="">- Escoja -</option>
                        <option value="1" <?php //if($_GET['para'] == 1){ echo 'selected';} ?>>Compra</option>
                        <option value="2" <?php //if($_GET['para'] == 2){ echo 'selected';} ?>>Arriendo</option>
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
            </div>
            
            <!-- Inmuebles -->
                       
            <div style="float:left; width:530px; margin-left:7px;">
            <form action="" method="post" name="frm_propiedades" id="frm_propiedades">
            
			<?php				
      	
			$pagina = "busquedaFiltros.php"; 	//your file name  (the name of this file)
			$TAMANO_PAGINA = 12; 								//how many items to show per page
			$page = $_GET['page'];
			if($page) 
				$inicio = ($page - 1) * $TAMANO_PAGINA; 			//first item to display on this page
			else
				$inicio = 0;	

            
			$tipoBusqueda = $_GET['para']; //1 venta 2 Arriendo 3 Ambos
			$ciudad = $_GET['ciudad'];
			$tipoInmueble = $_GET['tipoInmueble'];
			$area = $_GET['area'];
			$preciosArriendos = $_GET['precioArriendo'];
			$preciosVenta = $_GET['precioVenta'];
			$habitaciones = $_GET['habitaciones'];
			$banos = $_GET['bano'];
			$garaje = $_GET['garaje'];
			$antiguedad = $_GET['antiguedad'];
			


			
			//Antiguedad
			if($antiguedad == 1)
			{
				$condAntiguedad = "AND inmueble.campo_4 = 1";
			}
			else if($antiguedad == 2)
					{
						$condAntiguedad = "AND inmueble.campo_4 = 2";
					}
					else if($antiguedad == 3)
							{
								$condAntiguedad = "AND inmueble.campo_4 = 3";
							}
							else if($antiguedad == 4)
									{
										$condAntiguedad = "AND inmueble.campo_4 =4";
									}
									else if($antiguedad == 5)
											{
												$condAntiguedad = "AND inmueble.campo_4 = 5";
											}
											else if($antiguedad == 5)
													{
														$condAntiguedad = "AND inmueble.campo_4 = 6";
													}
											
			//No. Baños
			if($banos == 1)
			{
				$condBanos = "AND inmueble.campo_9 = 1";
			}
			else if($banos == 2)
					{
						$condBanos = "AND inmueble.campo_9 = 2";
					}
					else if($banos == 3)
							{
								$condBanos = "AND inmueble.campo_9 = 3";
							}
							else if($banos == 4)
									{
										$condBanos = "AND inmueble.campo_9 = 4";
									}
									else if($banos == 5)
											{
												$condBanos = "AND inmueble.campo_9 >= 5";
											}
									
			
			//No. Habitaciones
			if($habitaciones == 1)
			{
				$condHabitaciones = "AND inmueble.campo_24 = 1";
			}
			else if($habitaciones == 2)
					{
						$condHabitaciones = "AND inmueble.campo_24 = 2";
					}
					else if($habitaciones == 3)
							{
								$condHabitaciones = "AND inmueble.campo_24 = 3";
							}
							else if($habitaciones == 4)
									{
										$condHabitaciones = "AND inmueble.campo_24 =4";
									}
									else if($habitaciones == 5)
											{
												$condHabitaciones = "AND inmueble.campo_24 >= 5";
											}
									
			//Precio Arrendamiento
			if($preciosArriendos == 1)
			{
				$condPrecio = "AND inmueble.campo_53 <= 300000";
			}
			else if($preciosArriendos == 2)
					{
						$condPrecio = "AND inmueble.campo_53 BETWEEN 300000 and 1000000";
					}
					else if($preciosArriendos == 3)
							{
								$condPrecio = "AND inmueble.campo_53 BETWEEN 1000000 and 1300000";
							}
							else if($preciosArriendos == 4)
									{
										$condPrecio = "AND inmueble.campo_53 BETWEEN 1300000 and 6000000";
									}
									else if($preciosArriendos == 5)
											{
												$condPrecio = "AND inmueble.campo_53 BETWEEN 6000000 and 9000000";
											}
											else if($preciosArriendos == 6)
													{
														$condPrecio = "AND inmueble.campo_53 >= 9000000";
													}			
			//Precios Venta
			if($preciosVenta == 1)
			{
				$condPrecioVenta = "AND inmueble.campo_5 <= 40000000";
			}
			else if($preciosVenta == 2)
					{
						$condPrecioVenta = "AND inmueble.campo_5 BETWEEN 40000000 and 70000000";
					}
					else if($preciosVenta == 3)
							{
								$condPrecioVenta = "AND inmueble.campo_5 BETWEEN 70000000 and 100000000";
							}
							else if($preciosVenta == 4)
									{
										$condPrecioVenta = "AND inmueble.campo_5 BETWEEN 100000000 and 200000000";
									}
									else if($preciosVenta == 5)
											{
												$condPrecioVenta = "AND inmueble.campo_5 >= 200000000";
											}
									
			//Area
			if($area == 1)
			{
				$condArea = "AND inmueble.campo_6 <= 60";
			}
			else if($area == 2)
					{
						$condArea = "AND inmueble.campo_6 BETWEEN 60 and 100";
					}
					else if($area == 3)
							{
								$condArea = "AND inmueble.campo_6 BETWEEN 100 and 200";
							}
							else if($area == 4)
									{
										$condArea = "AND inmueble.campo_6 BETWEEN 200 and 300";
									}
									else if($area == 5)
											{
												$condArea = "AND inmueble.campo_6 >= 300";
											}
			
			if($tipoInmueble != "")
			{
				$condTipInm = " AND inmueble.tipo_inm = $tipoInmueble";
			}
			
			
			$condicionOrdenar = "ORDER BY inmueble.plan DESC";
			$orden = $_GET['orden'];
			
			if($_POST['orden'] != 0)
			{
				$orden =$_POST['orden'];
			}

			// Para venta
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
			}
			
			
			//Consultar inmuebles
			 $consulta = "SELECT usuarios.banner1, usuarios.rol, CONCAT(usuarios.nombres,' ',usuarios.apellidos) AS nombre, tipo_in.dest_tip, municipio.nombreMunicipio, inmueble.* FROM inmueble 
JOIN tipo_in ON inmueble.tipo_inm = tipo_in.tip_inm 
JOIN municipio ON inmueble.ciudad = municipio.idmunicipio
JOIN usuarios ON inmueble.usuario = usuarios.identificacion
JOIN rol ON usuarios.rol = rol.idrol
WHERE inmueble.estado = 1 $condTipInm $condArea $condPrecio $condPrecioVenta $condHabitaciones $condBanos $condAntiguedad AND inmueble.tipo_neg = $tipoBusqueda AND inmueble.ciudad = $ciudad  
$condicionOrdenar";
            $resultado = mysql_query($consulta, $conexion);
            $num_registros = mysql_num_rows($resultado);
            $total_paginas = ceil($num_registros / $TAMANO_PAGINA); 
            $registro = mysql_fetch_array($resultado);
            
            $consulta = "SELECT usuarios.banner1, usuarios.rol, CONCAT(usuarios.nombres,' ',usuarios.apellidos) AS nombre, tipo_in.dest_tip, municipio.nombreMunicipio, inmueble.* FROM inmueble 
JOIN tipo_in ON inmueble.tipo_inm = tipo_in.tip_inm 
JOIN municipio ON inmueble.ciudad = municipio.idmunicipio
JOIN usuarios ON inmueble.usuario = usuarios.identificacion
JOIN rol ON usuarios.rol = rol.idrol
WHERE inmueble.estado = 1 $condTipInm $condArea $condPrecio $condPrecioVenta $condHabitaciones $condBanos $condAntiguedad AND inmueble.tipo_neg = $tipoBusqueda AND inmueble.ciudad = $ciudad
$condicionOrdenar LIMIT $inicio , $TAMANO_PAGINA  ";
            $resultado = mysql_query($consulta, $conexion);
			
			$anexo ="&tipoInmueble=".$_GET["tipoInmueble"]."&departamento=".$_GET["departamento"]."&ciudad=".$_GET["ciudad"]."&para=".$_GET["para"]."&precioVenta=".$_GET['precioVenta']."&precioArriendo=".$_GET['precioArriendo']."&area=".$_GET["area"]."&habitaciones=".$_GET['habitaciones']."&bano=".$_GET['bano']."&garaje=".$_GET['garaje']."&antiguedad=".$_GET['antiguedad']."&orden=$orden";
							
			//$ruta_busqueda="tipo=".$_GET["tipo"]."&cmb_ciudad_a=".$_GET["cmb_ciudad_a"]."&cmb_barrio_a=".$_GET["cmb_barrio_a"]."&cmb_tipo_a=".$_GET["cmb_tipo_a"]."&cmb_preciomin_a=".$_GET["cmb_preciomin_a"]."&cmb_preciomax_a=".$_GET["cmb_preciomax_a"]."&Submit=Consultar";
			?>
            
            <div>
              <div style="float:left; width:250px; padding-bottom:10px">Se han encontrado <?php echo $num_registros?> inmueble(s)</div>
                <div style="float:left; width:280px; text-align:right">
                  <select name="orden" id="orden"onchange="document.frm_propiedades.action = 'busquedaFiltros.php?<?php echo $anexo;?>';document.frm_propiedades.submit();">
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
            include_once("funciones/paginacion_pagina.php");
            
            if(mysql_num_rows($resultado) > 0)
            {
                while($registro = mysql_fetch_array($resultado))
                {
					$fecha_ini = $registro['fecha_activacion'];
					$fecha_final = date(Y.'-'.m.'-'.d);
					$dias_activacion = diferencia_en_dias($fecha_ini,$fecha_final);
                ?>
                <div class="contenedorInmuebles" <?php if($registro['plan'] == 3 && $dias_activacion <= 30) { echo 'style="clear:left; background:#FDF7A5;"';} { echo 'style="clear:left"'; }?>>
                <?php 
				if($registro['plan'] == 3 && $dias_activacion <= 30)
				{
					?>
               	  <div style="position:absolute; z-index:999; background:url(/imagenes/cinta.png) no-repeat; height:86px; width:86px; margin-left:-10px; margin-top:-15px"></div>
                <?php
                }
                ?>
                
                <table width="100%" border="0" cellspacing="2" cellpadding="2">
                <?php
				//Consultamos la primera imagen del inmueble
				$consulta = "SELECT * FROM fotos_inm WHERE cod_inm = '".$registro['codigo']."' LIMIT 0,1";
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
                  <tr>
                    <td width="33%" rowspan="6">
                    <a href="inmueble.php?cod=<?php echo $registro['codigo']?>" target="_blank">
                    <?php 
					if($nFotos > 0)
					{
					?>
                    <img src="/redimencionar.php?src=inmuebles/<?php echo $foto."&amp;w=150&h=120"?>" border="0" title="Ver informacion" />
                    <?php
					}
					else
					{
					?>
                    <img src="/imagenes/sinImagen150.jpg" width="150" height="120" title="Ver informacion" border="0" />
                    <?php
					}
					?>
                    </a>
                    </td>
                    <td width="43%" style="color:#336498; font-size:1.2em; font-weight:bold;"><?php echo tipo_negocio_imprimir($registro['tipo_neg'])." ".$registro['dest_tip']?></td>
                    <td width="24%" style="color:#336498; font-size:1.2em; font-weight:bold;">Cod: <?php echo $registro['codigo']?></td>
                  </tr>
                  <tr>
                    <td style="color:#336498; font-size:1.2em; font-weight:bold; text-transform:capitalize"><?php echo $registro['campo_1']?></td>
                    <td><span style="color:#336498; font-size:1.2em; font-weight:bold;">
                      <?php 
					if($tipoBusqueda == 1)
					{
						echo "$".number_format($registro['campo_5'],0,',','.');
					}
					else if($tipoBusqueda == 2)
							{
								echo "$".number_format($registro['campo_53'],0,',','.');
							}
					?>
                    </span></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2" style="font-size:1.2em"><strong><?php echo $registro['nombreMunicipio'].", "?></strong> Area <?php echo $registro['campo_6']?> m&sup2;, No. Habitaciones:<?php echo $registro['campo_24']?></td>
                  </tr>
                  <tr>
                    <td style="font-size:1.2em">
                    <?php 
					if($registro['rol'] == 1)
					{
						echo 'Directamente';
					}
					else
					{
						echo $registro['nombre'];
					}
					?>
                    </td>
                    <td style="font-size:1.2em">
                    <?php
                    if($registro['rol'] == 3 || $registro['rol'] == 4)
					{
						if($registro['banner1'] != '')
						{
                    	?>
                        <img src="/redimencionar.php?src=bannerInmobiliariaConstructora/<?php echo $registro['banner1']."&h=70"?>" border="0" title="Ver informacion" />
                    	<?php
						}
					}
					?><
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2"><a href="inmueble.php?cod=<?php echo $registro['codigo']?>" target="_blank" class="boton medium  naranja">Ver inmueble</a></td>
                  </tr>
                </table>
    
                </div>
            <?php
				}
			}
			else
			{
				echo "<div align='center' style='clear:left; padding-top:30px;'>No existen inmuebles en el momento</div>";
			}
			?>
            	<div><?php echo $paginacion?></div>
            </form>
            </div>
            
      	</div>
        
        
        
	  <div style="float:left; margin-left:10px; background:#FFF; border:#989898 1px solid; width:265px; min-height:300px;-moz-border-radius: 10px; -webkit-border-radius: 5px; border-radius: 5px;">
        	<h1 style="padding-left:15px;">Lo m&aacute;s leido</h1>
            <ul>
			<?php
            $consulta = "SELECT * FROM noticias ORDER BY n_visitas DESC LIMIT 0,5";	
            $resultado = mysql_query($consulta, $conexion); 
			$numRegistros = mysql_num_rows($resultado);
            while($registro= mysql_fetch_array($resultado))
			{
			?>
            	<li style="padding-left: 12px; padding-bottom:4px; background: url(/imagenes/bullet_black.png) 0em 0.5em no-repeat;    margin-bottom: 1em; margin-left:-25px; border-bottom:#CCC 1px dotted; margin-right:15px;"><a href="noticia.php?not=<?php echo $registro["id"]?>" class="lomasleido"><?php echo $registro['titulo']?></a></li>
            <?php
            }
			?>
            </ul>
            </div>
        
        <!-- Noticias -->
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
    		<div style="float:left; margin-left:10px; margin-top:20px; width:265px; height:495px"><a href="<?php echo $link?>" <?php if($link != '#') { echo "target='_blank'"; }?>><img src="/banner/<?php echo $archivo?>" width="265" height="495" /></a></div>
        <?php
		}
		else
		{
		?>
        	<div style="float:left; margin-left:10px; margin-top:20px; width:265px; height:495px"><img src="/imagenes/paute.jpg" width="265" height="495" /></div>
        <?php
		}
		?>
        
        
        <!-- Div en blanco-->
        <div style="clear:left; height:20px;"></div>
        
    </div>    
</section>


<footer>
<?php include('pie.php')?>
</footer>
</body>
</html>