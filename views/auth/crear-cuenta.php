<h1 class="nombre-pagina">Crear Cuenta</h1>
<p class="descripcion-pagina">LLene el siguiente formulario para crear una cuenta </p>

<?php 

  include_once __DIR__ . "/../templates/alertas.php";

?>
<form class="formulario" method="POST" action="/crear-cuenta">
     <div class="campo">
      <label for="nombre">Nombre</label>
      <input
          type="text"
          id="nombre"
           name="nombre"
          placeholder="Su Nombre"
          value="<?php echo s($usuario->nombre);?>"


      />
     </div>

     <div class="campo">
      <label for="nombre">Apellido</label>
      <input
          type="text"
          id="apellido"
           name="apellido"
          placeholder="Su Apellido"
           value="<?php echo s($usuario->apellido);?>"

      />
     </div>

     <div class="campo">
      <label for="telefono">Teléfono</label>
      <input
          type="tel"
          id="telefono"
           name="telefono"
          placeholder="Su Teléfono"
           value="<?php echo s($usuario->telefono);?>"

      />
     </div>

     <div class="campo">
      <label for="email">Email</label>
      <input
          type="email"
          id="email"
           name="email"
          placeholder="Su Correo Electrónico"
           value="<?php echo s($usuario->email);?>"
      />
     </div>


     
     <div class="campo">
      <label for="password">Clave</label>
      <input
          type="password"
          id="password"
           name="password"
          placeholder="Su Clave (Mínimo 6 caracteres)"
      />
     </div>

    <input type="submit" value="Crear Cuenta" class="boton">
    
    <!-- class boton le da los estilos ya definidos, value hace que al recargar la pagina lo que se lleno se mantenga -->

</form>

<div class="acciones">
    <a href="/">¿Ya tiene una cuenta? Inicie Sesión</a>
    <a href="/olvide">¿Ha olvidado su contraseña?</a>

</div>