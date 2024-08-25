<h1 class="nombre-pagina">Recuperar Clave</h1>
<p class="descripcion-pagina">Coloca tu nuevo password a continuación</p>

<?php 

  include_once __DIR__ . "/../templates/alertas.php";

?>

<?php  if($error) return ?>  


<form class="formualrio" method="Post">
  <div class="campo">
    <label for="password">Password</label>
    <input
         type="password"
         id="password"
         name="password"
         placeholder="Su nueva Clave"
    />


  </div>
  <input type="submit" class="boton" value="Cambiar Clave">
  
</form>

<div class="acciones">
    <a href="/">¿Ha recordado su contraseña? </a>
    <a href="/crear-cuenta">¿No tiene Cuenta? Cree Una</a>


</div>