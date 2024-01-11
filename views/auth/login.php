<h1 class='nombre-pagina'>Login</h1>
<p class='descripcion-pagina'>Inicia sesión con tus datos</p>
<?php
include_once __DIR__ . "/../templates/alertas.php"
?>
<form class='formulario' action='/' method='POST'>
<div class='campo'>
        <label for="email">Email</label>
        <input
            id='email'
            name='email'
            placeholder='Tu Email'
            type='email'
        />
    </div>
    
    <div class='campo'>
        <label for="password">Password</label>
        <input
            id='password'
            name='password'
            placeholder='Tu Password'
            type='password'
        />
    </div>
    <input type='submit' class='boton' value='Iniciar sesión'>

</form>
<div class='acciones'>
<a href="/crear-cuenta">¿Aun no tienes una cuenta? Crear una</a>
<a href="/olvide">¿Olvidaste tu contraseña?</a>
</div>
