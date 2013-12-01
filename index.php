<?php
   if ( strpos( $_SERVER['HTTP_USER_AGENT'], 'Googlebot' ) !== false ) {
  mail('jmtefa@hotmail.com','Google ha visitado tu web','Google ha visitado tu página web: http://www.inmueblealaventa.com'. $_SERVER['REQUEST_URI']);
   }
?>
<?php

include('controlSesion.php');
require('bd.php');


include('includes/parametros.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="es"/>
<title>Inmuebles a la venta y arriendo en colombia todo en finca raiz</title>
<meta property="og:url" content="http://www.inmueblealaventa.com/">
<meta property="og:title" content="inmueble a la venta apartamentos casas en venta y arriendo y finca raiz">
<meta property="og:description" content="inmuebles a la arriendo y venta en colombia encuentre apartamentos, casas, fincas y todo tipo de inmuebles en venta y arriendo en inmueble a la venta">
<meta property="og:type" content="website">
<meta property="og:image" content="http://www.inmueblealaventa.com/imagenes/logo.png">
<meta name="description" content="inmuebles a la venta y arriendo en colombia, encuentre la mayor oferta de apartamentos, casas, oficinas y todo tipo de inmuebles en inmueble a la venta, con informacion muy completa sobre cada inmueble">
<meta name="keywords" content="apartamentos en venta y arriendo en colombia, apartamentos en arriendo, venta de casas en colombia, inmuebles a la venta, arriendo de apartamentos y casas,venta y arriendo de finca raiz, apartamentos, casas, oficinas, venta de fincas en colombia, apartamentos en bogota">
<link rel="stylesheet" type="text/css" href="css/jqueryui/jquery-ui-1.8.18.custom.css"/>
<link href="css/general.css" rel="stylesheet" type="text/css" />
<link href="css/jflow.style.css" type="text/css" rel="stylesheet"/>
<link rel="stylesheet" type="text/css" href="css/nuevos-estilos.css"/>
<link rel="stylesheet" type="text/css" href="funciones/style.css"/>
<link rel="stylesheet" type="text/css" href="css/gomo_style.css"/>



<script type="text/javascript" src="js/jquery-1.7.2.js"></script>

<script type="text/javascript" src="js/pestanas/js/tabs.js"></script>
<script type="text/javascript" src="TABS.js"></script>

<script src="funciones/script_cajas.js" type="text/javascript"></script>
<script  type="text/javascript">

	/*function enviar()
	{
					var concatenar="";
					
					var tipoInmueble=$("#tipoInmueble").val();
					var ciudad=$("#idciudad").val();
					var precio=$("#precio").val();
					var area=$("#area").val();
					var codigo=$("#codigo").val();
					
					if (tipoinmueble=="")
					{
						concatenar=concatenar;
					}
					else
					{
						concatenar=concatenar+"&tipoInmueble="+tipoInmueble
					}
					
					
					if (ciudad=="")
					{
						concatenar=concatenar;
					}
					else
					{
						concatenar=concatenar+"&ciudad="+ciudad
					}
				
					
					
					
					//location.href="propiedades.php?para=1";
					location.href="propiedades.php?para=1&tipoInmueble="+tipoInmueble+"&ciudad="+ciudad+"&area="+area+"&precio="+precio+"&codigo="+codigo;

	}*/
$(document).ready(function(e) {

    new SEARCHER_TABS().init()
      // cargar_pestanas_sup();
		cargar_pestanas();

		
		
    });
    
    
    
    </script>



</head>

<body>
<?php include_once("analyticstracking.php") ?>

<section>
	<?php  include("cabezote.php")?>
    <div class="barraMenu">
    	<div class="contenedor" align="left"><?php include('menu.php')?></div>
    </div>
</section>
<div class="centrado" id="contenedor1">
    <div class="lineatiempo"><h1><a href="#">Apartamentos en Colombia</a> > <a href="#">Venta y Arriendo de inmuebles en Colombia</a></h1></div>

<div class="containerpestasupe">
        	<ul class="pestamenusupe">
            	<li id="venta" class="activesup" data-type="venta" data-tab>Venta </li>
                <li id="arriendo" data-type="arriendo" data-tab>Arriendo </li>
               
            </ul>
            <span class="clear"></span>
            <div class="contenidopestasup venta">
               <div class="buscador">
                <form name="buscarventa" id="buscarventa"  action="#">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="33%" align="center"><label for="select"></label>
              <span>
                <select name="tipoInmueble" id="tipoInmueble"  class="validate[required]" data-errormessage-value-missing="Campo obligatorio">
                  <option value="">- Tipo de inmueble -</option>
                <option value="0">Cualquiera</option>
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
              </span></td>
              <td width="33%" align="center"><label for="select2"></label>
                    <script type="text/javascript" src="js/jquery-1.7.2.js"></script>
    
              <script type="text/javascript" src="funciones/script.js"></script>
            <span> <input type="text"  name="ciudad" id="ciudad" placeholder="Ciudad"></span><img src="funciones/loading.gif" id="loading">
             <input type="hidden"  name="idciudad" id="idciudad" >
             <div id="ajax_response"></div>  
            
               
        
             </td>
              <td width="33%" align="center"><label for="precio"></label>
                         <span>
                <select name="precio" id="precio"  class="validate[required]" data-errormessage-value-missing="Campo obligatorio">
                  
                <option value="0">- Precio -</option>
                <?php
                $consulta = "SELECT idpre , preini,  preini , predesc  FROM precio ORDER BY preini ASC";	
                $resultado = mysql_query($consulta, $conexion);
               
                while ($registro= mysql_fetch_array($resultado))
                {
                ?>
                <option value="<?php echo $registro["idpre"]?>"> <?php echo $registro["predesc"]?> </option>
                <?php
                }
                ?>
              </select>
              </span></td>
            </tr>
            <tr>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
            </tr>
            <tr>
              <td align="center"><label for="select4"></label>
              <span>
                <select name="area" id="area"  class="validate[required]" data-errormessage-value-missing="Campo obligatorio">
                  
                <option value="0">- Area -</option>
                <?php
                $consulta = "SELECT idarea , areaini,  areafin , areadesc  FROM area ORDER BY areaini ASC";	
                $resultado = mysql_query($consulta, $conexion);
               
                while ($registro= mysql_fetch_array($resultado))
                {
                ?>
                <option value="<?php echo $registro["idarea"]?>"> <?php echo $registro["areadesc"]?> </option>
                <?php
                }
                ?>
              </select>
              </span></td>
              <td align="center"><label for="codigo"></label>
              <span>
                <input name="codigo" type="text" id="codigo" placeholder="C&oacute;digo"   />
              </span></td>
              <td align="center"><button class="submit_searcher"></button></td>
            </tr>
          </table>
        </form>
    
                
                </div>
    		</div>
            
            <div class="contenidopestasup arriendo"  style="display:none">
            <div class="buscador">
          		 <form name="buscararriendo" id="buscararriendo"  action="#">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="33%" align="center"><label for="select"></label>
          <span>
            <select name="tipoInmueble" id="tipoInmueble"  class="validate[required]" data-errormessage-value-missing="Campo obligatorio">
              <option value="">- Tipo de inmueble -</option>
            <option value="0">Cualquiera</option>
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
          </span></td>
          <td width="33%" align="center"><label for="select2"></label>
                <script type="text/javascript" src="js/jquery-1.7.2.js"></script>

          <script type="text/javascript" src="funciones/script.js"></script>
		<span> <input type="text"  name="ciudadarr" id="ciudadarr" placeholder="Ciudad"></span><img src="funciones/loading.gif" id="loading">
		 <input type="hidden"  name="idciudadarr" id="idciudadarr" >
		 <div id="ajax_responsearr" ></div>  
        
           
  	
         </td>
          <td width="33%" align="center"><label for="precio"></label>
                     <span>
            <select name="precio" id="precio"  class="validate[required]" data-errormessage-value-missing="Campo obligatorio">
              
            <option value="0">- Precio -</option>
            <?php
            $consulta = "SELECT idpre , preini,  preini , predesc  FROM precio ORDER BY preini ASC";	
            $resultado = mysql_query($consulta, $conexion);
           
            while ($registro= mysql_fetch_array($resultado))
            {
            ?>
            <option value="<?php echo $registro["idpre"]?>"> <?php echo $registro["predesc"]?> </option>
            <?php
            }
            ?>
          </select>
          </span></td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td align="center"><label for="select4"></label>
          <span>
            <select name="area" id="area"  class="validate[required]" data-errormessage-value-missing="Campo obligatorio">
              
            <option value="0">- Area -</option>
            <?php
            $consulta = "SELECT idarea , areaini,  areafin , areadesc  FROM area ORDER BY areaini ASC";	
            $resultado = mysql_query($consulta, $conexion);
         
            while ($registro= mysql_fetch_array($resultado))
            {
            ?>
            <option value="<?php echo $registro["idarea"]?>"> <?php echo $registro["areadesc"]?> </option>
            <?php
            }
            ?>
          </select>
          </span></td>
          <td align="center"><label for="codigo"></label>
          <span>
            <input name="codigo" type="text" id="codigo" placeholder="C&oacute;digo"   />
          </span></td>
          <td align="center"><img  name="button" onclick="enviar(2)" id="button" src="imagenes/btmBuscar.png" style="cursor:pointer"></td>
        </tr>
      </table>
   	</form>

            
			</div>
    		</div>
            
            
            
            
    	</div>

<section style="overflow:hidden">
  <div style="clear:left; padding-top:30px;" class="contenedor">
    	<!-- Div 1 -->
        <div style="float:left; margin-right:27px;"><iframe width="315" height="233" src="http://www.youtube.com/embed/ikkvemPCJTk?rel=0" frameborder="0" allowfullscreen></iframe></div>
        
        <!-- Div 2 -->
        <?php //include('bannerInferior.php')?>
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
   	<div style="float:left; margin-right:27px; width:315px; height:233px"><a href="<?php echo $link?>" <?php if($link != '#') { echo "target='_blank'"; }?>><img src="banner/<?php echo $archivo?>" width="315" height="233" border="0" /></a></div>
        <?php
		}
		else
		{
		?>
        	<div style="float:left; margin-right:20px; width:315px; height:233px"><a href="planes.php"><img src="imagenes/bannerCasa.jpg" width="315" height="233" /></a></div>
        <?php
		}
		?>
    <!-- Div 3 -->
        <div style="float:left; width:315px; margin:0px 0px;  background:#F1F1F1;  height:233px">
          
<div id="slidebox">

				    <ul>
    	
        				
                        <li>
							<a href="#"   onclick="parametrosgaleria(1,'524')" ><img class="portfolio_image" src="gallery/bogota.png" alt=""   /></a>
						
						<P class="flex-caption">Venta y Arriendo de inmuebles en Bogotá</p></li>
                        
                        <li>
							<a href="#"  onclick="parametrosgaleria(2,'145')"  ><img class="portfolio_image" src="gallery/barranquilla.png" alt="" /></a>
						
		  <P class="flex-caption">Venta de inmuebles en Barranquilla</p></li>
                        
                        

						<li>
							<a href="#"  onclick="parametrosgaleria(2,'1071')"><img class="portfolio_image" src="gallery/cali.png" alt="" /></a>
						
						<P class="flex-caption">Arriendo de inmuebles en Cali </p></li>

                        <li>
							<a href="#"  onclick="parametrosgaleria(1,'176')" ><img class="portfolio_image" src="gallery/cartagena.png" alt="" /></a>
						
						<P class="flex-caption">Venta y Arriendo de inmuebles en Cartagena </p></li>
                        
                         <li>
							<a href="#"   onclick="parametrosgaleria(1,'842')" ><img class="portfolio_image" src="gallery/medellin.png" alt="" /></a>
						
						<P class="flex-caption">Venta y Arriendo de inmuebles en Medellin </p></li>

											
					</li>

	</ul>
</div>
  
          
  		</div>
  </div>
</section>

<section>
  <div class="centrado">
  
  
    
   	  <ul class="cajas">
        <li>
        	<h2>Venta de inmuebles en Colombia</h2><p>
        <?php
		   $sql="SELECT tipo_in.dest_tip, municipio.nombreMunicipio, tipo_in.tip_inm, tipo_neg, departamento.nombre, inmueble . *
FROM inmueble, municipio, departamento, tipo_in
WHERE inmueble.estado =1
AND municipio.idmunicipio = inmueble.ciudad and tipo_neg=1
AND municipio.departamento_iddepartamento = departamento.iddepartamento
ORDER BY RAND( )
LIMIT 18 "; 

$ejecuta=mysql_query($sql);
while ($muestra=mysql_fetch_assoc($ejecuta))
{
	$tipoin="";
	if($muestra['tipo_neg']==1){		$tipoin="Venta";	}
	else if ($muestra['tipo_neg']==2){ 	$tipoin="Arriendo";	}
	
 echo '<a href="#" onclick="enviarpagina('.$muestra['tipo_neg'].','.$muestra['tip_inm'].','.$muestra['ciudad'].')">'.$tipoin." ".$muestra['dest_tip']." ".$muestra['nombreMunicipio']."  &nbsp;".'</a>';

}
?></p>
        </li>
        <li class="medio">
        	<h2 class="casa2">Arriendo de inmuebles en Colombia</h2>
            <p>
			<?php
		   $sql="SELECT tipo_in.dest_tip, municipio.nombreMunicipio, tipo_in.tip_inm, tipo_neg, departamento.nombre, inmueble . *
FROM inmueble, municipio, departamento, tipo_in
WHERE inmueble.estado =1
AND municipio.idmunicipio = inmueble.ciudad and tipo_neg=2
AND municipio.departamento_iddepartamento = departamento.iddepartamento
ORDER BY RAND( )
LIMIT 18 "; 

$ejecuta=mysql_query($sql);
while ($muestra=mysql_fetch_assoc($ejecuta))
{
	$tipoin="";
	if($muestra['tipo_neg']==1){	$tipoin="Venta";}
	else if ($muestra['tipo_neg']==2){	$tipoin="Arriendo";	}
	
 echo '<a href="#" onclick="enviarpagina('.$muestra['tipo_neg'].','.$muestra['tip_inm'].','.$muestra['ciudad'].')">'.$tipoin." ".$muestra['dest_tip']." ".$muestra['nombreMunicipio']."  &nbsp;".'</a>';

}
?></p>
        </li>
        <div style="float:left; width:315px;    height:233px; margin-top:-13px">
        <div class="containerpestainfe">
        	<ul class="menuinf">
            	<li id="bogota" class="activeinf">Bogotá </li>
                <li id="bucaramanga" >Bucaramanga </li>
                <li id="cali" >Cali </li>
                <li id="cartagena" >Cartagena </li>
            </ul>
            <span class="clear"></span>
            <div class="contentinf bogota">
            <div class="pestabuscador">
            	<table width="100%" border="0">
                  <tr>
                    <td><img src="gallery/bogota.png" width="80" height="80"></td>
                    <td><span >
										<?php
                                   $sql="SELECT tipo_in.dest_tip, municipio.nombreMunicipio, tipo_in.tip_inm, tipo_neg, departamento.nombre, inmueble . *
                        FROM inmueble, municipio, departamento, tipo_in
                        WHERE inmueble.estado =1
                        AND municipio.idmunicipio = 524 and tipo_neg=1
                        AND municipio.departamento_iddepartamento = departamento.iddepartamento
                        ORDER BY RAND( )
                        LIMIT 3 "; 
                        $ejecuta=mysql_query($sql);
                        while ($muestra=mysql_fetch_assoc($ejecuta))
                        {
                            $tipoin="";
                            if($muestra['tipo_neg']==1){	$tipoin="Venta";}
                            else if ($muestra['tipo_neg']==2){	$tipoin="Arriendo";	}
                            
                         echo '<a href="#" style="font-size:11px" onclick="enviarpagina('.$muestra['tipo_neg'].','.$muestra['tip_inm'].','.$muestra['ciudad'].')">'.$tipoin." ".$muestra['dest_tip']." ".$muestra['nombreMunicipio'].'</a><br>';          
                        }
                        ?></span></td>
                  </tr>
                  <tr>
                    <td><img src="gallery/bogota.png" width="80" height="80"></td>
                    <td> <span>
                                        <?php
                                   $sql2="SELECT tipo_in.dest_tip, municipio.nombreMunicipio, municipio.idmunicipio,tipo_in.tip_inm, tipo_neg, departamento.nombre, inmueble . *
                        FROM inmueble, municipio, departamento, tipo_in
                        WHERE inmueble.estado =1
                        AND municipio.idmunicipio = 524 and tipo_neg=2
                        AND municipio.departamento_iddepartamento = departamento.iddepartamento
                        ORDER BY RAND( )
                        LIMIT 3 "; 
                        
                        $ejecuta2=mysql_query($sql2);
                        while ($muestra2=mysql_fetch_assoc($ejecuta2))
                        {
                            $tipoin2="";
                            if($muestra2['tipo_neg']==1){	$tipoin2="Venta";}
                            else if ($muestra2['tipo_neg']==2){	$tipoin2="Arriendo";	}
                         	echo '<a href="#" style="font-size:11px" onclick="enviarpagina('.$muestra2['tipo_neg'].','.$muestra2['tip_inm'].','.$muestra2['ciudad'].')">'.$tipoin2." ".$muestra2['dest_tip']." ".$muestra2['nombreMunicipio'].'</a><br>';
                        }
                        ?></span></td>
                  </tr>
                </table>
                </div>
    		</div>
            
            <div class="contentinf bucaramanga"  style="display:none">
            <div class="pestabuscador">
            <table width="100%" border="0">
              <tr>
                <td><img src="gallery/bmanga02.png" width="80" height="80"></td>
                <td><span>
            	<?php
		   $sql1="SELECT tipo_in.dest_tip, municipio.idmunicipio,municipio.nombreMunicipio, tipo_in.tip_inm, tipo_neg, departamento.nombre, inmueble . *
FROM inmueble, municipio, departamento, tipo_in
WHERE inmueble.estado =1
AND municipio.idmunicipio = 912 and tipo_neg=2
AND municipio.departamento_iddepartamento = departamento.iddepartamento
ORDER BY RAND( )
LIMIT 3 "; 
$ejecuta1=mysql_query($sql1);
while ($muestra1=mysql_fetch_assoc($ejecuta1))
{
	$tipoin1="";
	if($muestra1['tipo_neg']==1){	$tipoin1="Venta";}
	else if ($muestra1['tipo_neg']==2){	$tipoin1="Arriendo";	}
	echo '<a href="#" style="font-size:11px" onclick="enviarpagina('.$muestra1['tipo_neg'].','.$muestra1['tip_inm'].','.$muestra1['idmunicipio'].')">'.$tipoin1." ".$muestra1['dest_tip']." ".$muestra1['nombreMunicipio'].'</a><br>';
}
?></span></td>
              </tr>
              <tr>
                <td><img src="gallery/bmanga02.png" width="80" height="80"></td>
                <td><span>
            	<?php
		   $sql3="SELECT tipo_in.dest_tip, municipio.nombreMunicipio, municipio.idmunicipio,tipo_in.tip_inm, tipo_neg, departamento.nombre, inmueble . *
FROM inmueble, municipio, departamento, tipo_in
WHERE inmueble.estado =1
AND municipio.idmunicipio = 912 and tipo_neg=1
AND municipio.departamento_iddepartamento = departamento.iddepartamento
ORDER BY RAND( )
LIMIT 3 "; 

$ejecuta3=mysql_query($sql3);
while ($muestra3=mysql_fetch_assoc($ejecuta3))
{
	$tipoin3="";
	if($muestra3['tipo_neg']==1){	$tipoin3="Venta";}
	else if ($muestra3['tipo_neg']==2){	$tipoin3="Arriendo";	}
 echo '<a href="#" style="font-size:11px" onclick="enviarpagina('.$muestra3['tipo_neg'].','.$muestra3['tip_inm'].','.$muestra3['idmunicipio'].')">'.$tipoin3." ".$muestra3['dest_tip']." ".$muestra3['nombreMunicipio'].'</a><br>';
}
?>
</span></td>
              </tr>
            </table>

            
			</div>
    		</div>
            
            <div class="contentinf cali"  style="display:none">
            
            <div class="pestabuscador">
            
            <table width="100%" border="0">
              <tr>
                <td><img src="gallery/cali.png" width="80" height="80"></td>
                <td> <span>
            	<?php
		   $sql4="SELECT tipo_in.dest_tip, municipio.nombreMunicipio, municipio.idmunicipio, municipio.idmunicipio,tipo_in.tip_inm, tipo_neg, departamento.nombre, inmueble . *
FROM inmueble, municipio, departamento, tipo_in
WHERE inmueble.estado =1
AND municipio.idmunicipio = 1071 and tipo_neg=2
AND municipio.departamento_iddepartamento = departamento.iddepartamento
ORDER BY RAND( )
LIMIT 3 "; 

$ejecuta4=mysql_query($sql4);
while ($muestra4=mysql_fetch_assoc($ejecuta4))
{
	$tipoin4="";
	if($muestra4['tipo_neg']==1){	$tipoin4="Venta";}
	else if ($muestra4['tipo_neg']==2){	$tipoin4="Arriendo";	}
 echo '<a href="#" style="font-size:11px" onclick="enviarpagina('.$muestra4['tipo_neg'].','.$muestra4['tip_inm'].','.$muestra4['idmunicipio'].')">'.$tipoin4." ".$muestra4['dest_tip']." ".$muestra4['nombreMunicipio'].'</a><br>';
}
?></span></td>
              </tr>
              <tr>
                <td><img src="gallery/cali.png" width="80" height="80"></td>
                <td><span>
            	<?php
		   $sql5="SELECT tipo_in.dest_tip, municipio.nombreMunicipio, municipio.idmunicipio,tipo_in.tip_inm, tipo_neg, departamento.nombre, inmueble . *
FROM inmueble, municipio, departamento, tipo_in
WHERE inmueble.estado =1
AND municipio.idmunicipio = 1071 and tipo_neg=1
AND municipio.departamento_iddepartamento = departamento.iddepartamento
ORDER BY RAND( )
LIMIT 3 "; 

$ejecuta5=mysql_query($sql5);
while ($muestra5=mysql_fetch_assoc($ejecuta5))
{
	$tipoin5="";
	if($muestra5['tipo_neg']==1){	$tipoin5="Venta";}
	else if ($muestra5['tipo_neg']==2){	$tipoin5="Arriendo";	}
 echo '<a href="#" style="font-size:11px" onclick="enviarpagina('.$muestra5['tipo_neg'].','.$muestra5['tip_inm'].','.$muestra5['idmunicipio'].')">'.$tipoin5." ".$muestra5['dest_tip']." ".$muestra5['nombreMunicipio'].'</a><br>';
}
?>
</span></td>
              </tr>
            </table>
				</div>
    		</div>
            
            <div class="contentinf cartagena"  style="display:none">
            <div class="pestabuscador">
            <table width="100%" border="0">
              <tr>
                <td><img src="gallery/cartagena.png" width="80" height="80"></td>
                <td> <span>
            	<?php
		   $sql6="SELECT tipo_in.dest_tip, municipio.nombreMunicipio,municipio.idmunicipio, tipo_in.tip_inm, tipo_neg, departamento.nombre, inmueble . *
FROM inmueble, municipio, departamento, tipo_in
WHERE inmueble.estado =1
AND municipio.idmunicipio = 176 and tipo_neg=2
AND municipio.departamento_iddepartamento = departamento.iddepartamento
ORDER BY RAND( )
LIMIT 3 "; 

$ejecuta6=mysql_query($sql6);
while ($muestra6=mysql_fetch_assoc($ejecuta6))
{
	$tipoin6="";
	if($muestra6['tipo_neg']==1){	$tipoin6="Venta";}
	else if ($muestra6['tipo_neg']==2){	$tipoin6="Arriendo";	}
	
 echo '<a href="#" style="font-size:11px" onclick="enviarpagina('.$muestra6['tipo_neg'].','.$muestra6['tip_inm'].','.$muestra6['idmunicipio'].')">'.$tipoin6." ".$muestra6['dest_tip']." ".$muestra6['nombreMunicipio'].'</a><br>';
 
  

}
?></span></td>
              </tr>
              <tr>
                <td><img src="gallery/cartagena.png" width="80" height="80"></td>
                <td><span>
            	<?php
		   $sql7="SELECT tipo_in.dest_tip, municipio.nombreMunicipio, municipio.idmunicipio, tipo_in.tip_inm, tipo_neg, departamento.nombre, inmueble . *
FROM inmueble, municipio, departamento, tipo_in
WHERE inmueble.estado =1
AND municipio.idmunicipio = 176 and tipo_neg=1
AND municipio.departamento_iddepartamento = departamento.iddepartamento
ORDER BY RAND( )
LIMIT 3 "; 

$ejecuta7=mysql_query($sql7);
while ($muestra7=mysql_fetch_assoc($ejecuta7))
{
	$tipoin7="";
	if($muestra7['tipo_neg']==1){	$tipoin7="Venta";}
	else if ($muestra7['tipo_neg']==2){	$tipoin7="Arriendo";	}
	
 echo '<a href="#"  style="font-size:11px" onclick="enviarpagina('.$muestra7['tipo_neg'].','.$muestra7['tip_inm'].','.$muestra7['idmunicipio'].')">'.$tipoin7." ".$muestra7['dest_tip']." ".$muestra7['nombreMunicipio'].'</a><br>';
 
  

}
?>
</span></td>
              </tr>
            </table>


            
			</div >
    		</div>
    	</div>
        </div>
    </ul>
        
        
       	
        
    </div>
</section>
</div>
<footer>
<?php include('pie.php')?>
</footer>

 <!-- jQuery -->
 




  <!-- Optional FlexSlider Additions -->


  <script src="slide/slidelibro/jcarousellite_1.0.1c5.js"></script>
<script type="text/javascript">

$(function() {
	$("#slidebox").jCarouselLite({
		vertical: false,
		hoverPause:true,
		btnPrev: ".previous",
		btnNext: ".next",
		visible: 1,
		start: 0,
		scroll: 1,
		circular: true,
		auto:1000,
		speed:1800,				
		btnGo:
		    [".1", ".2",
		    ".3", ".4", ".5"],
		
		afterEnd: function(a, to, btnGo) {
				if(btnGo.length <= to){
					to = 0;
				}
				$(".thumbActive").removeClass("thumbActive");
				$(btnGo[to]).addClass("thumbActive");
		    }
	});
});
</script>

</body>
</html>
