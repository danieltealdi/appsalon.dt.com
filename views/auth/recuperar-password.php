<h1 class='nombre-pagina'>Reestablecer Password</h1>
<p class='descripcion-pagina'>Introduce a continuación tu nuevo password</p>
<?php
include_once __DIR__ . "/../templates/alertas.php";
if($error) {
    return;
}
?>
<form class='formulario' method='POST'>
	<div class='campo'>
		<label for="password">Password</label>
		<input id='password' name='password' placeholder='Tu Nuevo Password' type='password' />
	</div>
	<input type='submit' class='boton' value='Guardar nuevo password'>

</form>

<div class='acciones'>
	<a href="/">¿Ya tienes una cuenta? Inicia sesión</a>
	<a href="/crear-cuenta">¿Aun no tienes una cuenta? Crear una</a>
</div>