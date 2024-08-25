<h1 class="nombre-pagina"> Login</h1>
<p class="descripcion-pagina"> Inicia sesión con tus datos</p>

<?php

include_once __DIR__ . "/../templates/alertas.php";

?>

<form class="formulario" method="POST" action="/">
    <div class="campo">
       <label for="email">Email</label>
       <input
          type="email"
          id="email"
          placeholder="Su Email"
          name="email"
       />

    </div>

    <div class="campo">
        <label for="password"> Clave</label>
        <input 
           type="password"
           id="password"
           placeholder="Su Contraseña"
           name="password"
        />

    </div>
      
      <input type="submit" class="boton" value="Iniciar Sesión">


</form>

<div class="acciones">
    <a href="/crear-cuenta">Si aún no tiene cuenta, cree una</a>
    <a href="/olvide">¿Ha olvidado su contraseña?</a>

</div>