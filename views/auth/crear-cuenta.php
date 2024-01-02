<h1 class='nombre-pagina'>Crear cuenta</h1>
<p class='descripcion-pagina'>Llena el siguiente fornulario para crear una cuenta</p>
<?php
include_once __DIR__ . "/../templates/alertas.php"
?>
<form class='formulario' action='/crear-cuenta' method='POST'>
<div class='campo'>
        <label for="nombre">Nombre</label>
        <input value="<?php  echo s($usuario->nombre); ?>" id='nombre' name='nombre' placeholder='Tu Nombre' type='text' />
    </div>

    <div class='campo'>
        <label for="apellido">Apellido</label>
        <input value="<?php echo s($usuario->apellido); ?>" id='apellido' name='apellido' 
        placeholder='Tu Apellido' type='text' />
    </div>
    <div class='campo'>
        <label for="telefono">Telefono</label>
        <input value="<?php echo s($usuario->telefono) ?>" id='telefono' name='telefono' placeholder='Tu Telefono' type='tel' />
    </div>

    <div class='campo'>
        <label for="email">Email</label>
        <input value="<?php echo s($usuario->email) ?>" id='email' name='email' placeholder='Tu Email' type='email' />
    </div>

    <div class='campo'>
        <label for="password">Password</label>
        <input id='password' name='password' placeholder='Tu Password' type='password' />
    </div>
    <input type='submit' class='boton' value='crear cuenta'>

</form>

<div class='acciones'>
<a href="/">¿Ya tienes una cuenta? Inicia sesión</a>
<a href="/olvide">¿Olvidaste tu contraseña?</a>
</div>