<?php
	//session_start();
?>
<div class="centrado">
<div class="cabezote">
    <div class="logotipo"><a href="/inicio"><img src="/imagenes/logo.png" width="322" height="117" alt="Logo Inmueble a la Venta"></a></div>
    <div class="login">
    <?php 
    
    if(@$_SESSION["idusuario"] == "")
    {
        ?>
    <form action="autenticacion.php" method="post" name="login">
      <table width="180" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><strong>Ingresa y publica!</strong></td>
        </tr>
        <tr>
          <td><label for="textfield"></label>
          <input type="text" name="username" id="username" placeholder="Usuario">
          <?php
            if (@$_GET["error"] == 1)
            {
            ?>
              <div align="center" style="clear:left; color:#F00; font-size:12px;"><strong>Usuario &oacute; Contrase&ntilde;a incorrecta</strong></div>
                <?php
            }
            ?>
          </td>
        </tr>
        <tr>
          <td><label for="textfield2"></label>
          <input name="password" type="password" id="password" placeholder="Contraseña" autocomplete="off" size="20">
          <input type="image" name="imageField" id="imageField" src="/imagenes/btnIngresarLoginSmall.png"></td>
        </tr>
        <tr>
          <td><a href="/registrarse">Nuevo</a><a href="/recuperar-contraseña"> | ¿Olvidó su usuario o clave?</a></td>
        </tr>
      </table>
    </form>
    <?php
    }
    else
    {
    ?>
        <div style="padding-top:20px; height:40px; background:#FFF;">Hola,<br /> <strong><?php echo $_SESSION["nombre_usuario"].' '.$_SESSION["apellido_usuario"]?>.</strong></div>
        <div style="height:28px; border-top:#666 1px dotted; padding-top:10px">( <a href="cuenta.php" class="colorazul">Mi cuenta</a>&nbsp;&nbsp;   | &nbsp;&nbsp;<a href="salir.php" class="colorazul">Salir</a> )</div>
    <?php
    }
    ?>
  </div>
    <div class="redes">
    <img src="/imagenes/redes.png" width="205" height="29" usemap="#Map">
      <map name="Map">
        <area shape="circle" coords="190,15,15" href="enviarMail.php" id="mail" target="_blank" title="Correo">
        <area shape="circle" coords="146,15,15" href="https://twitter.com/Inmueblealavent" target="_blank" title="Twitter">
        <area shape="circle" coords="102,15,15" href="http://www.linkedin.com/profile/view?id=246676125&trk=tab_pro" target="_blank" title="in">
        <area shape="circle" coords="59,15,15" href="http://www.facebook.com/pages/inmueblealaventacom/151453635007598" target="_blank" title="Facebook">
        <area shape="circle" coords="14,15,15" href="http://www.youtube.com/user/inmueblealaventa" target="_blank" title="Youtube">
      </map>
  </div>
</div>
</div>

