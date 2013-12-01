<?php
extract($_GET);
include('controlSesion.php');
require('bd.php');
include('includes/parametros.php');

$codigo = $_GET["cod"];


if(preg_match("/\[[0-9]+\]/", $codigo, $match)) $codigo = preg_replace("/\[|\]/", "", $match[0]);



$codigo = (int) $codigo;



//ACTUALIZO EL CONTADOR DE VISITAS

$consulta = "SELECT * FROM inmueble WHERE codigo = '$codigo'";
$resultado_con= mysql_query($consulta);
$registro_con = mysql_fetch_assoc($resultado_con);

$contador = $registro_con['numvisitas']+1;
$actualizar = "UPDATE inmueble SET numvisitas = $contador WHERE codigo = '".$codigo."'";
$si=mysql_query($actualizar);



$consulta = "SELECT usuarios.banner1,usuarios.nombreEmpresa,tipo_inm,usuarios.email,usuarios.identificacion,tipo_in.dest_tip, tipo_in.tip_inm , municipio.nombreMunicipio, inmueble.* FROM inmueble 
JOIN tipo_in ON inmueble.tipo_inm = tipo_in.tip_inm 
JOIN municipio ON municipio.idmunicipio = inmueble.ciudad
JOIN usuarios ON inmueble.usuario = usuarios.identificacion
WHERE codigo = $codigo AND estado = 1";	
$resultado = mysql_query($consulta, $conexion); 
$numRegistros = mysql_num_rows($resultado);
$registro= mysql_fetch_assoc($resultado);


 $consultafotos = "SELECT * FROM fotos_inm WHERE cod_inm = '".$codigo."'";
                
						$resultadoFoto = mysql_query($consultafotos);
                        $numFotos = mysql_num_rows($resultadoFoto);
                        $i=0;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: Inmueble a la Venta ::</title>
<link href="/css/general.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="/css/nuevos-estilos.css"/>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="/js/jquery.carouFredSel-6.0.4-packed.js" type="text/javascript"></script>
<script type="text/javascript" src="/funciones/script_cajas.js"></script>
<script type="text/javascript" src="/js/jquery.blockUI.js"></script>

<script type="text/javascript" src="/js/emergente.js"></script>
<script type="text/javascript" src="/js/pestanas/js/tabs.js"></script>
<script type="text/javascript" src="/js/jquery.youtubeplaylist.js"></script>


<script type="text/ecmascript">


		$(function() {
			$("ul.demo1").ytplaylist();
			$("ul.demo2").ytplaylist({addThumbs:true, autoPlay: false, holderId: 'ytvideo2'});
		});
	
</script>


<script type="text/javascript">
	$(function() {

		$div = null;
		$('#thumbs').children().each(function(i) {

			$(this).appendTo( $div );
			$(this).addClass( 'itm'+i );
			$(this).click(function() {
				$('#images').trigger( 'slideTo', [i, 0, true] );
			});
		});
		$('#thumbs img.itm').addClass( 'selected' );

		//	the big-image carousel
		$('#images').carouFredSel({
			direction: 'up',
			circular: false,
			infinite: false,
			width: 500,
			height: 376,
			
			items: 1,
			auto: false,
			prev: '#prev .images',
			next: '#next .images',
			scroll: {
				fx: 'directscroll',
				onBefore: function() {
					var pos = $(this).triggerHandler( 'currentPosition' );
					$('#thumbs img').removeClass( 'selected' );
					$('#thumbs img.itm'+pos).addClass( 'selected' );
					
					var page = Math.floor( pos / 1 );
					$('#thumbs').trigger( 'slideToPage', page );
				}
			}
		});

		//	the thumbnail-carousel
		$('#thumbs').carouFredSel({
			direction: 'up',
			circular: false,
			infinite: false,
			width: 140,
			height: 310,
			items: 1,
			align: true,
			auto: false,
			prev: '#prev .thumbs',
			next: '#next .thumbs'
		});
	});
	

$(document).ready(function(e) {
       
		cargar_pestanas();
		
		
    });
</script>

<?php 

	if ($registro['lat'] != "")
	{
?>
 <script type="text/javascript">
  $(document).ready(function() {
   initialize();
  });
  

    </script>
 <?php
	}
 ?>  
<script type="text/javascript"
  src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDJ211zCiS4g4nLtJI2dy0ntm4W6pa4DTk&sensor=false">
 </script>
 
<?php 

	if ($registro['lat'] != "")
	{
?>
 <script type="text/javascript">
   function initialize() {
  var posicion = new google.maps.LatLng( <?php echo $registro['lat']; ?>, <?php echo $registro['lon']; ?> );

  var mapOptions = {
    center: posicion,
    zoom: 15,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  
  var mapa = new google.maps.Map(document.getElementById("map_canvas"),
   mapOptions);
  
  var marker = new google.maps.Marker( {
   position:posicion,
   map:mapa,
   icon:"/imagenes/apuntador.png"
  });
   }
 </script>
<?php
	}
?>
<style type="text/css">
#wrapper {
	/*border: 1px solid #ddd;
	background-color: #fff;*/
	width:670px;
	height: 408px;
	/*padding: 10px 10px 10px 10px;
	position: absolute;
	top: 50%;
	left: 50%;
	box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);*/
}
#wrapper img {
	display: block;
	float: left;
}
#images, #thumbs {
	height: 480px;
	float: left;
	/*overflow: hidden;*/
}
#images {
	width: 500px;
}
#thumbs {
	width: 145px;
	margin-left: 0px;
	margin-top:40px;
}
#thumbs img {
	border: 1px solid #ccc;
	padding: 5px;
	margin: 0 1px 8px 25px;
	cursor: pointer;
}
#thumbs img.selected, #thumbs img:hover {
	border-color: #333;
}

#thumbs div {
	width: 145px;
	height: 550px;
	float: left;
	border:#060 2px solid;
}
#next{
	width:500px;
}

#prev a, #next a {
	text-decoration: none;
	font-size: 20px;
	color: #F05;
	position:absolute;
}
#prev a:hover, #next a:hover {
	color: #000;
}
#prev a.disabled, #next a.disabled {
	display: none !important;
}
#prev a {
	/*top: 150px;*/
	background: transparent url(jqueyCarrusel/skins/tango/prev-vertical.png) no-repeat 0 0;
	width: 46px;
    height: 32px;
}
#next a {
	background: transparent url(jqueyCarrusel/skins/tango/next-vertical.png) no-repeat 0 0;
	width: 46px;
    height: 32px;
	margin-top:350px;
	/*bottom: -130px;*/
}
a.images {
	left: 120px;
}
a.thumbs {
	/*left: 600px;*/
	margin-left:560px;
}

</style>

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

<div class="centrado">
    <div class="lineatiempo"><a href="#">Apartamentos en Colombia</a> > <a href="#">Venta y Arriendo de inmuebles en Colombia</a></div>
    <div class="inmueble">
    
    <div  class="columna1">
        
        <div class="containerpesinmue">
        	<ul class="menuinf">
            	<li id="fotos" class="activeinf">Fotos </li>
                <li id="video" >Video </li>
            </ul>
            <span class="clear"></span>
            <div class="contentinfinm fotos">
            	<div class="buscadorinmu">
            		<div id="wrapper">
                    
                    
                    <div id="prev">
                        <!--<a href="#" class="images">&uArr; </a>-->
                        <a href="#" class="thumbs"></a>
                    </div>
                  
                    <div id="images" style="right:2px; top:-10px; ">
                        <?php
                        //Consultamos la primera imagen del inmueble
                       
                        //Si las fotos son mas de 0 las muestra sino muestra una temporal
						
                        if($numFotos > 0)
                        {
                            while($registroFoto = mysql_fetch_array($resultadoFoto))
                            {
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
                                <!--<img src="/redimencionar.php?src=inmuebles/<?php echo $foto."&amp;w=530&h=550"?>" width="540" height="550" />-->
                                <?php
                                list($width, $height, $type, $attr) = getimagesize("inmuebles/".$foto);
                                //Calculo del nuevo alto
                                $ancho_deseado = "480";
                                
                                $calculoAltoNuevo = (($ancho_deseado*$height)/$width);
                                ?>
                                <img src="/redimencionar.php?src=inmuebles/<?php echo $foto."&w=480"?>"  height="<?php echo $calculoAltoNuevo; ?>" />
                            <?php
                            }
                        }
                        else
                        {
                            ?>
                            <img src="/imagenes/sinImagen540.jpg" width="500" height="376" />
                            <?php
                        }
                        ?>
                                
                    </div>
                    <div id="thumbs">
                        <?php
                        //Consultamos la primera imagen del inmueble
                        $consulta = "SELECT * FROM fotos_inm WHERE cod_inm = '".$codigo."'";
                        $resultadoFoto = mysql_query($consulta, $conexion);
                        $i=0;
                        while($registroFoto = mysql_fetch_array($resultadoFoto))
                        {
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
                            <img src="/redimencionar.php?src=inmuebles/<?php echo $foto."&w=100&h=76"?>" width="100" height="76" />
                        <?php
                        }
                        ?>
                        
                    </div>
                    <div id="next">
                        <!--<a href="#" class="images">&dArr; </a>-->
                        <a href="#" class="thumbs"></a>
                    </div>
                	</div>
                </div>
    		</div>
            
            <div class="contentinfinm video"  style="display:none">
            <div class="buscadorinmu">
            <div class="yt_holder1">
            <div id="ytvideo2"></div>
            <ul class="demo2">
			
              <li class="currentvideo"><a href="<?php echo $registro["videoinm"]?>"><?php echo $registro["videoinm"]?></a></li>
			
            </ul>
          </div>

            
			</div>
    		</div>
            
            
    	</div>
        
        
        
   		<h3><a href="recomendarInmueble.php?codigo=<?php echo $codigo?>" id="mail" class="colorazul"><strong>Recomendar a un amigo</strong></a> &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong  style="font-size:10px;color:#336498;"><?php echo $registro["numvisitas"]?> vistas</strong></h3>    		
        <div class="caja">
            	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="details">
                  <tr>
                    <td width="50%">Codigo Inmueble: <?php echo $registro["codigoinm"]?></td>
                    <td width="50%"></td>
                  </tr>
                  <tr>
                    <td width="50%">Barrio: <?php echo $registro["campo_1"]?></td>
                    <td width="50%">Valor admin.: <?php echo "$".number_format($registro["campo_19"],0,',','.')?></td>
                  </tr>
                  <tr>
                    <td>Valor de venta:<span class="mostrarDatosInmueblesResultados"> <?php echo "$".@number_format($registro["campo_5"],0,',','.')?></span></td>
                    <td>Garajes: <span class="mostrarDatosInmueblesResultados"><?php echo $registro["campo_25"]?></span></td>
                  </tr>
                  <tr>
                    <td>Área: <span class="mostrarDatosInmueblesResultados"><?php echo $registro["campo_6"]."m&sup2;"?></span></td>
                    <td>Estrato: <span class="mostrarDatosInmueblesResultados"><?php echo $registro["campo_7"]?></span></td>
                  </tr>
                  <tr>
                    <td>Habitaciones: <span class="mostrarDatosInmueblesResultados"><?php echo $registro["campo_24"]?></span></td>
                    <td>
                    
                    <?php 
						$tipo="";
						if ( $registro["campo_4"]==1)
						{
							echo $tipo="Tipo de construccion: Sobre plano";
						}
						
						else if ( $registro["campo_4"]==2)
						{
							echo $tipo="Tipo de construccion: En consutrucción";
						}
						
						else if ( $registro["campo_4"]==3)
						{
							echo $tipo="Antigüedad: Entre 0 y 5 años";
						}
					
						else if ( $registro["campo_4"]==4)
						{
							echo $tipo="Antigüedad: Entre 5 y 10 años";
						}
						
						else if ( $registro["campo_4"]==5)
						{
							echo $tipo="Antigüedad: Entre 10 y 20 años";
						}
						
						else if ( $registro["campo_4"]==6)
						{
							echo $tipo="Antigüedad: Más de 20 años";
						}
					?>
                    
                    
                    </td>
                  </tr>
                  <tr>
                    <td>Baños: <span class="mostrarDatosInmueblesResultados"><?php echo $registro["campo_9"]?></span></td>
                    <td><a href="javascript: fn_mostrar_frm_menuss(<?php echo $registro["tipo_inm"]?>,<?php echo $codigo?>);">Más detalles</a></td>
                  </tr>
          </table>
          
          <div style="clear:left;"></div>
        
        
            <div id="div_oculto" style="display: none;"></div>
            
            
        </div>
        <div class="caja">
   	  	  <p>Descripción</p>
           	<p><span style="padding:10px 10px 10px 0px; height:150px; overflow-y:scroll"><?php echo $registro["comentarioUsuario"]?></span></p>
        </div>
        
        <div class="caja">
   	  	  <div class="mapa" style="width:620px; height:200px" id="map_canvas"></div>
        </div>
         
        <div class="caja">
            	<h2>Inmuebles Similares</h2>
            	<ul class="similares">
  					<?php
$consultaotros = "SELECT tipo_in.dest_tip, municipio.nombreMunicipio, departamento.nombre,inmueble.* 
						FROM inmueble , municipio, departamento, tipo_in
						WHERE  inmueble.estado = 1 
AND tipo_in.tip_inm='".$registro["tip_inm"]."' AND inmueble.tipo_neg='".$registro["tipo_neg"]."'
AND municipio.idmunicipio = inmueble.ciudad and inmueble.codigo<>'$codigo'
AND municipio.departamento_iddepartamento = departamento.iddepartamento order by RAND() limit 4";
$resultadootros = mysql_query($consultaotros); 
while($registrotros= mysql_fetch_assoc($resultadootros))
						{
					?>
	
                    <li>
                    	<?php
						$consulta = "SELECT * FROM fotos_inm WHERE cod_inm = '".$registrotros['codigo']."' order by RAND() LIMIT 0,1";
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
                        
                        <?php 
					if($nFotos > 0)
					{
					?>
                    	 <a href="inmueble.php?cod=<?php echo $registrotros['codigo']?>" ><img src="/redimencionar.php?src=inmuebles/<?php echo $foto."&w=150&h=120"?>" border="0" title="Ver informacion" /></a>
                    <?php
					}
					else
					{
					?>
                    	<a href="inmueble.php?cod=<?php echo $registrotros['codigo']?>" ><img src="/imagenes/sinImagen150.jpg" width="150" height="120" title="Ver informacion" border="0" /></a>
                    <?php
					}
					?>
                        <p><?php echo tipo_negocio_imprimir($registrotros['tipo_neg'])." ".$registrotros['dest_tip']?></p>
                        <p><?php echo $registrotros['campo_6']?> m&sup2, <?php echo $registrotros['campo_24']?> Habitaciones, <?php echo $registrotros['campo_9']?> Baños, <?php echo $registrotros['campo_17']?> Garajes, 
                <?php        
    				if($registrotros['tipo_neg'] == 1)
					{
						if ($registrotros['campo_5']!="")
						{
							echo "$".number_format($registrotros['campo_5'],0,',','.');
						}
					}
					else if($registrotros['tipo_neg'] == 2)
						  {
							  if ($registrotros['campo_53']!="")
							  {
								  echo "$".number_format($registrotros['campo_53'],0,',','.');
							  }
						  }
    ?></p>
                        <p> <?php echo $registrotros['campo_1']?>, 
     <?php echo $registrotros['nombreMunicipio']?>, <?php echo $registrotros['nombre']?> </p>
                    </li>
                    <?php
						}
					?>
                </ul>
            </div>
      </div>
      
      
      <?php /*?><div class="containerpesinmue">
        	<ul class="menuinf">
            	<li id="bogota" class="activeinf">Bogotá </li>
                <li id="bucaramanga" >Bucaramanga </li>
                <li id="cali" >Cali </li>
                <li id="cartagena" >Cartagena </li>
            </ul>
            <span class="clear"></span>
            <div class="contentinf bogota">
            	<div id="wrapper">
			<div id="prev">
				<!--<a href="#" class="images">&uArr; </a>-->
				<a href="#" class="thumbs"></a>
			</div>
			<div id="images">
            	<?php
				//Consultamos la primera imagen del inmueble
				$consulta = "SELECT * FROM fotos_inm WHERE cod_inm = '".$codigo."'";
            	$resultadoFoto = mysql_query($consulta, $conexion);
				$numFotos = mysql_num_rows($resultadoFoto);
				$i=0;
				//Si las fotos son mas de 0 las muestra sino muestra una temporal
				if($numFotos > 0)
				{
					while($registroFoto = mysql_fetch_array($resultadoFoto))
					{
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
						<!--<img src="/redimencionar.php?src=inmuebles/<?php echo $foto."&amp;w=530&h=550"?>" width="540" height="550" />-->
                        <?php
						list($width, $height, $type, $attr) = getimagesize("inmuebles/".$foto);
						//Calculo del nuevo alto
						$ancho_deseado = "530";
						
						$calculoAltoNuevo = (($ancho_deseado*$height)/$width);
						?>
                        <img src="/redimencionar.php?src=inmuebles/<?php echo $foto."&w=530"?>" width="530" height="<?php echo $calculoAltoNuevo; ?>" />
					<?php
					}
				}
				else
				{
					?>
					<img src="/imagenes/sinImagen540.jpg" width="530" height="376" />
                    <?php
				}
				?>
						
			</div>
			<div id="thumbs">
            	<?php
				//Consultamos la primera imagen del inmueble
				$consulta = "SELECT * FROM fotos_inm WHERE cod_inm = '".$codigo."'";
            	$resultadoFoto = mysql_query($consulta, $conexion);
				$i=0;
				while($registroFoto = mysql_fetch_array($resultadoFoto))
				{
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
                    <img src="/redimencionar.php?src=inmuebles/<?php echo $foto."&w=100&h=76"?>" width="100" height="76" />
                <?php
				}
				?>
				
			</div>
			<div id="next">
				<!--<a href="#" class="images">&dArr; </a>-->
				<a href="#" class="thumbs"></a>
			</div>
		</div>
    		</div>
            
            <div class="contentinf bucaramanga"  style="display:none">
            
            
    		</div>
            
            <div class="contentinf cali"  style="display:none">
            
            
    		</div>
            
            <div class="contentinf cartagena"  style="display:none">
            
    		</div>
    	</div><?php */?>
        <div class="columna2">
        	<div class="formulario">
                <form action="process.php" method="post" >
                <input type="hidden" name="txtemailcontac" id="txtemailcontac" value="<?php echo $registro["email"]?>">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="center"><p>Contactar al anunciante</p></td>
                  </tr>
                  <tr>
                    <td align="center"><a href="#" onclick="mostrar()">Ver teléfono</a></td>
                   
        
        
          
                  </tr>
                  
                  <tr id="oculto" style=" display:none">
                    <td align="center">
                    
                    
        
        
            
            <?php echo $registro["telContacto"]?><br />
            <a href="#" onclick="ocultar()">Ocultar</a>
            </td>
                  </tr>
                  <tr>
                    <td align="center"><label for="txtnombre"></label>
                    <input type="text" name="txtnombre" id="txtnombre" placeholder="Nombre"></td>
                  </tr>
                  <tr>
                    <td align="center"><label for="txtcorreo"></label>
                    <input type="text" name="txtcorreo" id="txtcorreo" placeholder="Correo electrónico"></td>
                  </tr>
                  <tr>
                    <td align="center"><label for="txttelefono"></label>
                    <input type="text" name="txttelefono" id="txttelefono" placeholder="No. teléfonico"></td>
                  </tr>
                  <tr>
                    <td align="center"><label for="txtcoment"></label>
                    <textarea name="txtcoment" id="txtcoment" placeholder="Estoy interesado en recibir más información sobre este inmueble"></textarea></td>
                  </tr>
                  <tr>
                    <td align="center"><input type="image" name="imageField2" id="imageField2" src="/imagenes/enviar.png"></td>
                  </tr>
                  <tr>
                    <td align="center"><p class="peque">Al enviar este mensaje Ustede acepta los Términos de uso<br>
                    de Inmueblea la venta y su Política de Privacidad</p></td>
                  </tr>
                </table>
                </form>
            </div>
            
            <div class="caja" align="center">
            
            	<?php 
					 
					if($registro["banner1"] !="")
					{
					?>
                    <img src="/redimencionar.php?src=bannerInmobiliariaConstructora/<?php echo $registro["banner1"]."&w=115&h=120"?>" border="0" title="Ver informacion" />
                    <?php
					}
					else
					{
					?>
                    <img src="/imagenes/personat.jpg"   width="150" height="120" title="Ver informacion" border="0" />
                    <?php
					}
					?>
           	  
            	<h2>Otros inmuebles de <?php echo $registro["nombreEmpresa"]?></h2>
            </div>
            
          <div class="caja" align="center">
            	<h2>Otros inmuebles de <?php echo $registro["nombreEmpresa"]?></h2>
            	<ul class="otros">
                	<?php 
						$consultadatos = "SELECT tipo_in.dest_tip, municipio.nombreMunicipio, departamento.nombre,inmueble.* 
						FROM inmueble , municipio, departamento, tipo_in
						
						WHERE codigo = $codigo AND inmueble.estado = 1 AND inmueble.estado =1
AND inmueble.tipo_inm = tipo_in.tip_inm
AND municipio.idmunicipio = inmueble.ciudad
AND municipio.departamento_iddepartamento = departamento.iddepartamento order by RAND() limit 3";	
						
						$resultadodatos = mysql_query($consultadatos); 
						$registrodatos= mysql_fetch_assoc($resultadodatos);						
					
					
					
					$consulta = "SELECT * FROM fotos_inm WHERE cod_inm = '".$codigo."' order by RAND() LIMIT 0,1";
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
                    
                         <?php 
					if($nFotos > 0)
					{
					?>
                    	 <a href="inmueble.php?cod=<?php echo $registro['codigo']?>" ><img src="/redimencionar.php?src=inmuebles/<?php echo $foto."&w=150&h=120"?>" border="0" title="Ver informacion" /></a>
                    <?php
					}
					else
					{
					?>
                    	 <a href="inmueble.php?cod=<?php echo $registro['codigo']?>" ><img src="/imagenes/sinImagen150.jpg" width="150" height="120" title="Ver informacion" border="0" /></a>
                    <?php
					}
					?>
                        <p><?php echo tipo_negocio_imprimir($registrodatos['tipo_neg'])." ".$registrodatos['dest_tip']?>,
                        
                        <?php echo $registrodatos['campo_6']?> m&sup2, <?php echo $registrodatos['campo_24']?> Habitaciones, <?php echo $registrodatos['campo_9']?> Baños, <?php echo $registrodatos['campo_17']?> Garajes, 
                <?php        
    				if($registrodatos['tipo_neg'] == 1)
					{
						if ($registrodatos['campo_5']!="")
						{
							echo "$".number_format($registrodatos['campo_5'],0,',','.');
						}
					}
					else if($registrodatos['tipo_neg'] == 2)
						  {
							  if ($registrodatos['campo_53']!="")
							  {
								  echo "$".number_format($registrodatos['campo_53'],0,',','.');
							  }
						  }
    ?>
   <?php echo $registrodatos['campo_1']?>, 
     <?php echo $registrodatos['nombreMunicipio']?>, <?php echo $registrodatos['nombre']?> </p>
                    </li>
                    
                </ul>
            </div>
            
                    <?php
		$consulta_banner="SELECT * FROM banner WHERE posicion = 1 AND estado = 1 ORDER BY fecha DESC limit 0,1"; 
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
   	<div style="float:left; margin-right:27px; width:315px; height:233px"><a href="<?php echo $link?>" <?php if($link != '#') { echo "target='_blank'"; }?>><img src="/banner/<?php echo $archivo?>" width="315" height="233" border="0" /></a></div>
        <?php
		}
		else
		{
		?>
        	<div style="float:left; margin-right:20px; width:315px; height:233px"><a href="/planes-venta"><img src="/imagenes/bannerCasa.jpg" width="315" height="233" /></a></div>
        <?php
		}
		?>
        </div>
        
    	
    </div>
</div>
  <?php /*?><div style="clear:left; padding-top:30px;" class="contenedor">
    	<div style="float:left; width:682px;">
        <div id="wrapper">
			<div id="prev">
				<!--<a href="#" class="images">&uArr; </a>-->
				<a href="#" class="thumbs"></a>
			</div>
			<div id="images">
            	<?php
				//Consultamos la primera imagen del inmueble
				$consulta = "SELECT * FROM fotos_inm WHERE cod_inm = '".$codigo."'";
            	$resultadoFoto = mysql_query($consulta, $conexion);
				$numFotos = mysql_num_rows($resultadoFoto);
				$i=0;
				//Si las fotos son mas de 0 las muestra sino muestra una temporal
				if($numFotos > 0)
				{
					while($registroFoto = mysql_fetch_array($resultadoFoto))
					{
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
						<!--<img src="/redimencionar.php?src=inmuebles/<?php echo $foto."&amp;w=540&h=550"?>" width="540" height="550" />-->
                        <?php
						list($width, $height, $type, $attr) = getimagesize("inmuebles/".$foto);
						//Calculo del nuevo alto
						$ancho_deseado = "540";
						
						$calculoAltoNuevo = (($ancho_deseado*$height)/$width);
						?>
                        <img src="/redimencionar.php?src=inmuebles/<?php echo $foto."&amp;w=540"?>" width="540" height="<?php echo $calculoAltoNuevo; ?>" />
					<?php
					}
				}
				else
				{
					?>
					<img src="/imagenes/sinImagen540.jpg" width="540" height="550" />
                    <?php
				}
				?>
						
			</div>
			<div id="thumbs">
            	<?php
				//Consultamos la primera imagen del inmueble
				$consulta = "SELECT * FROM fotos_inm WHERE cod_inm = '".$codigo."'";
            	$resultadoFoto = mysql_query($consulta, $conexion);
				$i=0;
				while($registroFoto = mysql_fetch_array($resultadoFoto))
				{
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
                    <img src="/redimencionar.php?src=inmuebles/<?php echo $foto."&amp;w=100&h=100"?>" width="100" height="100" />
                <?php
				}
				?>
				
			</div>
			<div id="next">
				<!--<a href="#" class="images">&dArr; </a>-->
				<a href="#" class="thumbs"></a>
			</div>
		</div>
        
        </div>
        <!--<div style="float:left">
            
            <div style="float:left; width:270px; margin-left:10px; background:#FFF; border:#989898 1px solid; min-height:300px;-moz-border-radius: 10px; -webkit-border-radius: 5px; border-radius: 5px; padding:10px;">
                    <div align="left" class="titulosFiltroNaranja" style="font-size:1.2em; padding-bottom:10px"><strong>Datos del inmueble</strong></div>
                
                <div style="padding-bottom:10px" class="titulosFiltroNaranja"><?php echo $registro["dest_tip"]?></div>
                <div class="mostrarDatosInmueblesCampos">C&oacute;digo</div>	
                <div class="mostrarDatosInmueblesResultados"><?php echo $registro["codigo"]?></div>
                <div class="mostrarDatosInmueblesCampos">Municipio</div>	
                <div class="mostrarDatosInmueblesResultados"><?php echo $registro["nombreMunicipio"]?></div>
                
                <?php if($registro["campo_1"] != "") { ?> <div class="mostrarDatosInmueblesCampos">Barrio</div><div class="mostrarDatosInmueblesResultados"><?php echo $registro["campo_1"]?></div> <?php } ?> 
        
        <?php if($registro["campo_2"] != "") { ?> <div class="mostrarDatosInmueblesCampos">Tipo de Bodega</div><div class="mostrarDatosInmueblesResultados"><?php echo tipo_bodega($registro["campo_2"])?></div> <?php } ?> 
        
        <?php if($registro["campo_3"] != "") { ?> <div class="mostrarDatosInmueblesCampos">No. de Oficinas</div><div class="mostrarDatosInmueblesResultados"><?php echo $registro["campo_3"]?></div> <?php } ?> 
        
        <?php if($registro["campo_4"] != "") { ?> <div class="mostrarDatosInmueblesCampos">Tiempo de construcci&oacute;n</div><div class="mostrarDatosInmueblesResultados"><?php echo tiempoConstruccion($registro["campo_4"])?></div> <?php } ?> 
        
        <?php if($registro["campo_5"] != "") { ?> <div class="mostrarDatosInmueblesCampos">Valor de venta</div><div class="mostrarDatosInmueblesResultados"><?php echo "$".number_format($registro["campo_5"],0,',','.')?></div> <?php } ?> 
        
        <?php if($registro["campo_53"] != "") { ?> <div class="mostrarDatosInmueblesCampos">Valor arriendo</div><div class="mostrarDatosInmueblesResultados"><?php echo "$".number_format($registro["campo_53"],0,',','.')?></div> <?php } ?> 
        
        <?php if($registro["campo_23"] != "") { ?> <div class="mostrarDatosInmueblesCampos">Alquiler x Noche</div><div class="mostrarDatosInmueblesResultados"><?php echo "$".number_format($registro["campo_23"],0,',','.')?></div> <?php } ?>
        
        <?php if($registro["campo_6"] != "") { ?> <div class="mostrarDatosInmueblesCampos">&Aacute;rea</div><div class="mostrarDatosInmueblesResultados"><?php echo $registro["campo_6"]."m&sup2;"?></div> <?php } ?> 
        
        <?php if($registro["campo_7"] != "") { ?> <div class="mostrarDatosInmueblesCampos">Estrato</div><div class="mostrarDatosInmueblesResultados"><?php echo $registro["campo_7"]?></div> <?php } ?> 
        
        <?php if($registro["campo_8"] != "") { ?> <div class="mostrarDatosInmueblesCampos">Tipo de piso</div><div class="mostrarDatosInmueblesResultados"><?php echo tipoPiso($registro["campo_8"])?></div> <?php } ?> 
        
        <?php if($registro["campo_9"] != "") { ?> <div class="mostrarDatosInmueblesCampos">No. ba&ntilde;os</div><div class="mostrarDatosInmueblesResultados"><?php echo $registro["campo_9"]?></div> <?php } ?> 
        
        <?php if($registro["campo_10"] != "") { ?><div class="mostrarDatosInmueblesCampos">Puerta acceso para tracto mulas</div><div class="mostrarDatosInmueblesResultados" style="padding-bottom:18px;"><?php echo $registro["campo_10"]?></div> <?php } ?> 
        
        <?php if($registro["campo_11"] != "") { ?> <div class="mostrarDatosInmueblesCampos">Alarma de incendio</div><div class="mostrarDatosInmueblesResultados"><?php echo $registro["campo_11"]?></div> <?php } ?> 
        
        <?php if($registro["campo_12"] != "") { ?> <div class="mostrarDatosInmueblesCampos">Detecci&oacute;n de humo</div><div class="mostrarDatosInmueblesResultados"><?php echo $registro["campo_12"]?></div> <?php } ?> 
        
        <?php if($registro["campo_13"] != "") { ?> <div class="mostrarDatosInmueblesCampos">Gabinete de incendio</div><div class="mostrarDatosInmueblesResultados"><?php echo $registro["campo_13"]?></div> <?php } ?> 
        
        <?php if($registro["campo_14"] != "") { ?> <div class="mostrarDatosInmueblesCampos">Rociadores de agua</div><div class="mostrarDatosInmueblesResultados"><?php echo $registro["campo_14"]?></div> <?php } ?> 
        
        <?php if($registro["campo_15"] != "") { ?> <div class="mostrarDatosInmueblesCampos">Tanques de agua</div><div class="mostrarDatosInmueblesResultados"><?php echo $registro["campo_15"]?></div> <?php } ?> 
        
        <?php if($registro["campo_16"] != "") { ?> <div class="mostrarDatosInmueblesCampos">Planta el&eacute;ctrica</div><div class="mostrarDatosInmueblesResultados"><?php echo $registro["campo_16"]?></div> <?php } ?> 
        
        <?php if($registro["campo_17"] != "") { ?> <div class="mostrarDatosInmueblesCampos">Vigilancia</div><div class="mostrarDatosInmueblesResultados"><?php echo tipo_vigilancia($registro["campo_17"])?></div> <?php } ?> 
        
        <?php if($registro["campo_18"] != "") { ?> <div class="mostrarDatosInmueblesCampos">Tipo de consultorio</div><div class="mostrarDatosInmueblesResultados"><?php echo tipo_consultorio($registro["campo_18"])?></div> <?php } ?> 
        
        <?php if($registro["campo_19"] != "") { ?> <div class="mostrarDatosInmueblesCampos">Valor administraci&oacute;n</div><div class="mostrarDatosInmueblesResultados"><?php echo "$".number_format($registro["campo_19"],0,',','.')?></div> <?php } ?> 
        
        <?php if($registro["campo_20"] != "") { ?> <div class="mostrarDatosInmueblesCampos">Parqueadero visitante</div><div class="mostrarDatosInmueblesResultados"><?php echo $registro["campo_20"]?></div> <?php } ?> 
        
        <?php if($registro["campo_21"] != "") { ?> <div class="mostrarDatosInmueblesCampos">No. de l&iacute;neas telef&oacute;nicas</div><div class="mostrarDatosInmueblesResultados"><?php echo $registro["campo_21"]?></div> <?php } ?> 
        
        <?php if($registro["campo_22"] != "") { ?> <div class="mostrarDatosInmueblesCampos">Tipo de finca</div><div class="mostrarDatosInmueblesResultados"><?php echo tipo_finca($registro["campo_22"])?></div> <?php } ?> 
        
        <?php if($registro["campo_24"] != "") { ?> <div class="mostrarDatosInmueblesCampos">No. Habitaciones</div><div class="mostrarDatosInmueblesResultados"><?php echo $registro["campo_24"]?></div> <?php } ?>
        
        <?php if($registro["campo_25"] != "") { ?> <div class="mostrarDatosInmueblesCampos">No. Garajes</div><div class="mostrarDatosInmueblesResultados"><?php echo $registro["campo_25"]?></div> <?php } ?> 
        
        <?php if($registro["campo_26"] != "") { ?> <div class="mostrarDatosInmueblesCampos">Terreno construido</div><div class="mostrarDatosInmueblesResultados"><?php echo $registro["campo_26"]?></div> <?php } ?> 
        
        <?php if($registro["campo_27"] != "") { ?> <div class="mostrarDatosInmueblesCampos">Piscina</div><div class="mostrarDatosInmueblesResultados"><?php echo $registro["campo_27"]?></div> <?php } ?> 
        
        <?php if($registro["campo_28"] != "") { ?> <div class="mostrarDatosInmueblesCampos">Cancha(s) de Tenis</div><div class="mostrarDatosInmueblesResultados"><?php echo $registro["campo_28"]?></div> <?php } ?> 
        
        <?php if($registro["campo_29"] != "") { ?> <div class="mostrarDatosInmueblesCampos">Cancha(s) de Futbol</div><div class="mostrarDatosInmueblesResultados"><?php echo $registro["campo_29"]?></div> <?php } ?> 
        
        <?php if($registro["campo_30"] != "") { ?> <div class="mostrarDatosInmueblesCampos">Otros Deportes</div><div class="mostrarDatosInmueblesResultados"><?php echo $registro["campo_30"]?></div> <?php } ?> 
        
        <?php if($registro["campo_31"] != "") { ?> <div class="mostrarDatosInmueblesCampos">Tipo de Local</div><div class="mostrarDatosInmueblesResultados"><?php echo tipo_local($registro["campo_31"])?></div> <?php } ?> 
        
        <?php if($registro["campo_33"] != "") { ?> <div class="mostrarDatosInmueblesCampos">No. Dep&oacute;sitos</div><div class="mostrarDatosInmueblesResultados"><?php echo $registro["campo_33"]?></div> <?php } ?> 
        
        <?php if($registro["campo_34"] != "") { ?> <div class="mostrarDatosInmueblesCampos">Interior y/o bloque</div><div class="mostrarDatosInmueblesResultados">
		<?php 
		if($registro["campo_34"] == 1)
			echo 'Si ';
		else if($registro["campo_34"] == 2)
				echo 'No ';
			
		if($registro["campo_32"] != '')
			echo "Cual ".$registro["campo_32"];
		?> 
        </div><?php } ?> 
        
        <?php if($registro["campo_35"] != "") { ?> <div class="mostrarDatosInmueblesCampos">No. Apartamento</div><div class="mostrarDatosInmueblesResultados"><?php echo $registro["campo_35"]?></div> <?php } ?>
        
        <?php if($registro["campo_36"] != "") { ?> <div class="mostrarDatosInmueblesCampos">No. Piso</div><div class="mostrarDatosInmueblesResultados"><?php echo $registro["campo_36"]?></div> <?php } ?> 
        
        <?php if($registro["campo_37"] != "") { ?> <div class="mostrarDatosInmueblesCampos">Tipo de Instalaci&oacute;n de gas</div><div class="mostrarDatosInmueblesResultados"><?php echo tipo_instalacionGas($registro["campo_37"])?></div> <?php } ?> 
        
        <?php if($registro["campo_38"] != "") { ?> <div class="mostrarDatosInmueblesCampos">No. Casa</div><div class="mostrarDatosInmueblesResultados"><?php echo $registro["campo_38"]?></div> <?php } ?> 
        
        <?php if($registro["campo_39"] != "") { ?> <div class="mostrarDatosInmueblesCampos">No. de Pisos</div><div class="mostrarDatosInmueblesResultados"><?php echo $registro["campo_39"]?></div> <?php } ?> 
        
        <?php if($registro["campo_40"] != "") { ?> <div class="mostrarDatosInmueblesCampos">Tipo de Oficina</div><div class="mostrarDatosInmueblesResultados"><?php echo tipo_oficina($registro["campo_40"])?></div> <?php } ?> 
        
        <?php if($registro["campo_41"] != "") { ?> <div class="mostrarDatosInmueblesCampos">No. de Oficina</div><div class="mostrarDatosInmueblesResultados"><?php echo $registro["campo_41"]?></div> <?php } ?> 
        
        <?php if($registro["campo_42"] != "") { ?> <div class="mostrarDatosInmueblesCampos">Tipo de Techo</div><div class="mostrarDatosInmueblesResultados"><?php echo tipoTecho($registro["campo_42"])?></div> <?php } ?> 
        
        <?php if($registro["campo_43"] != "") { ?> <div class="mostrarDatosInmueblesCampos">Cocineta</div><div class="mostrarDatosInmueblesResultados"><?php echo $registro["campo_43"]?></div> <?php } ?> 
        
        <?php if($registro["campo_44"] != "") { ?> <div class="mostrarDatosInmueblesCampos">No. de Ascensores</div><div class="mostrarDatosInmueblesResultados"><?php echo $registro["campo_44"]?></div> <?php } ?> 
        
        <?php if($registro["campo_45"] != "") { ?> <div class="mostrarDatosInmueblesCampos">Escaleras</div><div class="mostrarDatosInmueblesResultados"><?php echo $registro["campo_45"]?></div> <?php } ?> 
        
        <?php if($registro["campo_46"] != "") { ?> <div class="mostrarDatosInmueblesCampos">Tipo Lote</div><div class="mostrarDatosInmueblesResultados"><?php echo tipo_lote($registro["campo_46"])?></div> <?php } ?> 
        
        <?php if($registro["campo_47"] != "") { ?> <div class="mostrarDatosInmueblesCampos">Esquinero</div><div class="mostrarDatosInmueblesResultados"><?php echo $registro["campo_47"]?></div> <?php } ?> 
        
        <?php if($registro["campo_48"] != "") { ?> <div class="mostrarDatosInmueblesCampos">Ubicaci&oacute;n de lote</div><div class="mostrarDatosInmueblesResultados"><?php echo ubicacion_lote($registro["campo_48"])?></div> <?php } ?> 
        
        <?php if($registro["campo_49"] != "") { ?> <div class="mostrarDatosInmueblesCampos">Con todos los servicios</div><div class="mostrarDatosInmueblesResultados"><?php echo $registro["campo_49"]?></div> <?php } ?> 
        
        <?php if($registro["campo_50"] != "") { ?> <div class="mostrarDatosInmueblesCampos">Sobre v&iacute;a principal</div><div class="mostrarDatosInmueblesResultados"><?php echo $registro["campo_50"]?></div> <?php } ?> 
        
        <?php if($registro["campo_51"] != "") { ?> <div class="mostrarDatosInmueblesCampos">V&iacute;a secundaria</div><div class="mostrarDatosInmueblesResultados"><?php echo $registro["campo_51"]?></div> <?php } ?> 
        
        <?php if($registro["campo_52"] != "") { ?> <div class="mostrarDatosInmueblesCampos">No. Ba&ntilde;os Interiores</div><div class="mostrarDatosInmueblesResultados"><?php echo $registro["campo_52"]?></div> <?php } ?> 
                
                        
                <div align="left" class="titulosFiltroNaranja" style="font-size:1.2em; padding-bottom:10px; padding-top:10px"><strong>Datos de contacto</strong></div>
                <?php if($registro["nomContacto"] != "") { ?> <div class="mostrarDatosInmueblesCampos">Nombre </div><div class="mostrarDatosInmueblesResultados"><?php echo $registro["nomContacto"]?></div> <?php } ?> 
        
        <?php if($registro["telContacto"] != "") { ?> <div class="mostrarDatosInmueblesCampos">Tel&eacute;fono fijo</div><div class="mostrarDatosInmueblesResultados"><?php echo $registro["telContacto"]?></div> <?php } ?> 
        
        <?php if($registro["celContacto"] != "") { ?> <div class="mostrarDatosInmueblesCampos">Tel&eacute;fono celular</div><div class="mostrarDatosInmueblesResultados"><?php echo $registro["celContacto"]?></div> <?php } ?> 
        
        <?php if($registro["mailContacto"] != "") { ?> <div class="mostrarDatosInmueblesCampos">Email</div><div class="mostrarDatosInmueblesResultados"><?php echo $registro["mailContacto"]?></div> <?php } ?>
                
                </div>
                
          <div style="clear:left; margin-left:10px; padding-top:15px;">
            	<div style="float:left; margin-right:10px;"><a href="recomendarInmueble.php?codigo=<?php echo $codigo?>" id="mail"><img src="/imagenes/mail.png" width="18" height="12" border="0" /></a></div>
                <div style="float:left"><a href="recomendarInmueble.php?codigo=<?php echo $codigo?>" id="mail" class="colorazul">Recomendar a un amigo</a></div>
                
                <div style="clear:left;float:left; margin-right:10px; padding-top:10px"><img src="/imagenes/imgContador.png" width="16" height="16" border="0" /></div>
            <div style="float:left; padding-top:10px"><?php echo $registro["numvisitas"]?> vistas</div>
            <!--<div style="clear:left;float:left; margin-right:10px; padding-top:10px"><a href="javascript:history.go(-1)"  class="colorazul"><img src="/imagenes/back.png" width="18" height="18" border="0" /></a></div>
            <div style="float:left; padding-top:10px"><a href="javascript:history.go(-1)"  class="colorazul">Regresar a la busqueda</a></div>
          </div>
        </div>-->
        
        <div style="clear:left; padding-top:20px">
            <!-- video -->
            <div style="float:left">
            <?php
			if($registro["video"] == '')
			{
            ?>
			<iframe width="310" height="233" src="http://www.youtube.com/embed/ikkvemPCJTk?rel=0" frameborder="0" allowfullscreen></iframe>
			<?php
			}
			else
			{
            ?>
            <iframe width="310" height="233" src="http://www.youtube.com/v/<?php echo $registro["video"]?>?rel=0" frameborder="0" allowfullscreen></iframe>
            <?php
			}
            ?>
            </div>
            <!-- Observaciones -->
            <div style="float:left; width:304px; margin:0px 10px 0 15px; background:#FFF; border:#989898 1px solid; -moz-border-radius: 10px; -webkit-border-radius: 5px; border-radius: 5px; padding:10px; height:210px">
                <div class="titulosFiltroNaranja" style="padding:10px 0; clear:lef; font-size:16px; border-bottom:#999 1PX solid;"><strong>Observaciones</strong></div>
                <div style="padding:10px 10px 10px 0px; height:150px; overflow-y:scroll"><?php echo $registro["comentarioUsuario"]?></div>
            </div> 
            
            <!-- Div 2 -->
            <div style="float:left; width:295px; margin:0px 0px 0 5px ; background:#F1F1F1; padding:10px; height:215px">
            <div class="titulosFiltroNaranja" style="padding:10px 0; clear:lef; font-size:16px; border-bottom:#999 1PX solid;"><strong>Decoraci&oacute;n</strong></div>
            <?php
			$consulta = "SELECT * FROM decoracion ORDER BY id DESC LIMIT 0,1";
            $resultado = mysql_query($consulta, $conexion);
            $num_registros = mysql_num_rows($resultado);

            $registro = mysql_fetch_array($resultado);
			
			if($num_registros > 0)
			{

			
				if (file_exists("imgDecoracion/".$registro["imagen"]))
				{ 
				   $foto=$registro["imagen"];
				}else{ 
				$extension = explode(".", $registro["imagen"]);
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
            <div style="float:left; width:150px; padding-top:10px;"><a href="decoracion.php?not=<?php echo $registro['id']?>"><img src="/redimencionar.php?src=imgDecoracion/<?php echo $foto."&amp;w=126&h=152"?>" border="0" title="Ver informacion"  style="border:#CCC 5px solid"/></a></div>
            <div style="float:left; width:120px; padding-top:10px;">
			
			  <div style="padding-bottom:10px; padding-top:20px; font-size:1.2em"><strong><?php echo $registro['titulo']?></strong></div>
    </div>
	<?php
			}
			else
			{
			?>
            <div style="padding-top:40px">No existen noticias de decoraci&oacute;n</div>
            <?php
			}
			?>
            <div style="background: url(/imagenes/btn_mas.png) no-repeat; width: 40px; height: 40px; position:relative; z-index: 99; left: 265px; top: 145px;"></div>
  </div>
 		</div>
  </div><?php */?>
  <div style="clear:left; padding-top:20px;"></div>
<!-- cargar enviar email -->
<?php /*?><script type="text/javascript" src="fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox-1.3.4.css" media="screen" /><?php */?>
<script type="text/javascript">
/*$(document).ready(function() {
	$("a#mail").fancybox({
		'padding'		: 0,
		'autoDimensions': false,
		'centerOnScroll' : true,
		'overlayOpacity' : 0.1,
		'hideOnOverlayClick' : false,
        'height': 360,
       	'width': 350,
		'transitionIn'	: 'elastic',
		'transitionOut'	: 'elastic',
		'type' : 'iframe'
	});
});*/
</script> 

</section>

<footer>
<?php include('pie.php')?>
</footer>
</body>
</html>
