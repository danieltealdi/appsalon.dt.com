<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>App Salón</title>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="/build/css/app.css">
	<!--quitar en la versión de producción -->
	<meta http-equiv="Expires" content="0">
	<meta http-equiv="Last-Modified" content="0">
	<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
	<meta http-equiv="Pragma" content="no-cache">
</head>

<body>
	<div class='contenedor-app'>
		<div class='imagen'></div>
		<div class='app'>
			<?php echo $contenido; ?>
		</div>
	</div>



</body>
<?php
echo $script ?? '';
			?>

</html>