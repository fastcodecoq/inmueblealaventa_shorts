<div class="pie">
<div class="pie_pagina">
	<div class="contenedor">
      
      <div style="width:100%">
        
   	  	<div class="menu">
        <ul>Oficinas inmueblealaventa.com
        	<li style="font-weight:100">Calle 53B No. 27-24 Of.508</li>
            <li style="font-weight:100">Inmueblealaventa.com, Bogot&aacute;, Colombia.</li>
            <li style="font-weight:100">Tel&eacute;fonos: Bogot&aacute;: (571) 226 7212 </li>
            <li style="font-weight:100">Celular: 311 868 9032</li>
            <li style="font-weight:100">Fax: 226 7212</li>
            <li style="font-weight:100">info@inmueblealaventa.com</li>
        </ul>
        </div>
        <!--
        <div class="menu">
        <ul>Inmuebles a la venta
        	<li><a href="#">Apartamentos</a></li>
            <li><a href="#">Casas</a></li>
            <li><a href="#">Oficinas</a></li>
            <li><a href="#">Locales</a></li>
            <li><a href="#">Finca</a></li>
        </ul>
        </div>-->
        
        <div class="menu">
        <ul>Encontrar inmueble
        	<li><a href="/inmobiliarias">Por inmobiliaria</a></li>
            <li><a href="/constructoras">Por cosntructora</a></li>
            <li><a href="/busqueda-mapa">En el mapa</a></li>
        </ul>
        </div>
        
        <div class="menu">
        <ul>Publicar inmueble
        <?php 
		if(@$_SESSION["idusuario"] == "")
		{
		?>
       	  	<li><a href="/registrar-inmueble">Ingresa y publica</a></li>
        <?php
		}
		else
		{
		?>
        	<li><a href="/planes">Ingresa y publica</a></li>
        <?php
		}
		?>
            <li><a href="/planes">Planes y tarifas</a></li>
            <li><a href="/planes">Basic</a></li>
            <li><a href="/planes">Silver</a></li>
            <li><a href="/planes">Gold</a></li>
        </ul>
        </div>
        
        <!--<div class="menu">
        <ul>Temas de Inter&eacute;s
       	  	<li><a href="decoracionNot.php">Decoraci&oacute;n</a></li>
            <li><a href="noticias.php">Noticias</a></li>
        </ul>
        </div>-->
        
        <!--<div class="menu">
        <ul>Turismo
       	  	<li><a href="alquileres.php">Imuebles para alquilar</a></li>
            <li><a href="guiaTurismo.php">Gu&iacute;a de turismo</a></li>
            <li><a href="hoteles.php">Hoteles</a></li>
        </ul>
        </div>-->
        
        <div class="menu">
        <ul>Ayuda
       	  	<li><a href="/faq">Preguntas frecuentes</a></li>
            <li><a href="/terminos-y-condiciones" target="_blank">T&eacute;rminos legales</a></li>
            <li><a href="/manual" target="_blank">Manual de publicaci&oacute;n</a></li>
        </ul>
        </div>
        
        
      <div style="width:100%; clear:left; text-align:center">&copy; <?php echo date(Y)?> Inmueble a la venta. Todos los derechos reservados
      </div> 
    </div>
</div>
</div>
</div>
