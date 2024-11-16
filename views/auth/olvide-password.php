<h1 class="nombre-pagina">Olvidé mi Clave</h1>
<p class="descripcion-pagina">Reestablece tu clave escribiendo tu email a continuación</p>

<?php 

  include_once __DIR__ . "/../templates/alertas.php";

?>

<form class="formulario" action="/olvide"method="POST">
     <div class="campo">
       <label for="email">Email</label>
       <input
          type="email"
          id="email"
          placeholder="Su Email"
          name="email"
          />

     </div>

     <input type="submit" class="boton" value="Enviar">

</form>

<div class="acciones">
    <a href="/">¿Ya tiene una cuenta? Inicie Sesión</a>
    <a href="/crear-cuenta">¿No ha creado una cuenta? Crear Cuenta</a>

</div>