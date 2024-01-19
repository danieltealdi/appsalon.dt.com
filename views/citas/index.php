<h1 class='nombre-pagina'>Crear Nueva Cita</h1>
<p class='descripcion-pagina'>Elije tus servicios y coloca tus datos</p>
<div class="barra">
	<p>
		Hola: <?php echo $nombre ?? "";?>;
	</p>
	<a href="/logout" class="boton">Cerrar Sesion</a>
</div>
<div id='app'>
	<nav class='tabs'>
		<button class='actual' type='button' data-paso='1'>Servicios</button>
		<button type='button' data-paso='2'>Información cita</button>
		<button type='button' data-paso='3'>Resumen</button>
	</nav>
	<div id='paso-1' class='seccion'>
		<h2>Servicios</h2>
		<p class='text-center'>Elige tus servicios a continuación</p>
		<div id='servicios' class='listado-servicios'></div>

	</div>
	<div id='paso-2' class='seccion'>
		<h2>Tus datos y cita</h2>
		<p class='text-center'>Coloca tus datos y fecha de tu cita</p>
		<form class="formulario">
			<!-- si das enter vuelve al paso 1 en lugar de validar la entrada actual
			-->
			<div class='campo'>
				<label for="nombre">Nombre</label>
				<input id='nombre' value="<?php echo $nombre ?>"
					type="text" placeholder='tu nombre' disabled>

			</div>
			<div class='campo'>
				<label for="nofechambre">Fecha</label>
				<input id='fecha' type="date"
					min="<?php echo(date('Y-m-d', strtotime('+1 day'))) ?>">
			</div>
			<div class='campo'>
				<label for="hora">Hora</label>
				<input id='hora' type="time">
			</div>
			<input type="hidden" id="id" value="<?php echo $id; ?>">
		</form>


	</div>
	<div id='paso-3' class='seccion contenido-resumen'>
		<h2>Resumen</h2>
		<p class='text-center'>verifica que los datos son correctos</p>


	</div>
	<div class='paginacion'>
		<button id='anterior' class='boton'>
			&laquo; Anterior</button>

		<button id='siguiente' class='boton'>
			Siguiente &raquo; </button>
	</div>

</div>
<?php
//<script src='build/js/APP.js'></script>
$script = "
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
<script src='build/js/app.js'></script>
"?>

















<div class='acciones'>
	<a href="/">¿Ya tienes una cuenta? Inicia sesión</a>
	<a href="/olvide">¿Olvidaste tu contraseña?</a>
</div>