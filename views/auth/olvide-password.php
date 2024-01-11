<h1 class='nombre-pagina'>Recuperar contraseña</h1>
<p class='descripcion-pagina'>Danos tu E-mail para mandarte los datos de recuperación</p>
<?php
include_once __DIR__ . "/../templates/alertas.php"
?>
<form class='formulario' action='/olvide' method='POST'>
<div class='campo'>
        <label for="email">Email</label>
        <input
            id='email'
            name='email'
            placeholder='Tu Email'
            type='email'
        />
    </div>

    <input type='submit' class='boton' value='Enviar instrucciones'>

</form>
<div class='acciones'>
<a href="/crear-cuenta">¿Aun no tienes una cuenta? Crear una</a>
<a href="/">¿Ya tienes una cuenta? Inicia sesión</a>
</div>
