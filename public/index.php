<?php

//echo "index"; die;

require_once __DIR__ . '/../includes/app.php';
use Controllers\LoginController;
use Controllers\CitaController;
use Controllers\ApiController;
use Controllers\AdminController;
use MVC\Router;

$router = new Router();
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

$router->get('/crear-cuenta', [LoginController::class, 'crear']);
$router->post('/crear-cuenta', [LoginController::class, 'crear']);
$router->get('/confirmar-cuenta', [LoginController::class, 'confirmar']);
$router->get('/mensaje', [LoginController::class, 'mensaje']);

$router->get('/olvide', [LoginController::class, 'olvide']);
$router->post('/olvide', [LoginController::class, 'olvide']);
$router->get('/recuperar', [LoginController::class, 'recuperar']);
$router->post('/recuperar', [LoginController::class, 'recuperar']);
$router->get('/admin', [AdminController::class, 'index']);
$router->get('/logout', [LoginController::class, 'logout']);
$router->get('/logout', [LoginController::class, 'logout']);
$router->get('/logout', [LoginController::class, 'logout']);
$router->get('/logout', [LoginController::class, 'logout']);
//Area privada
$router->get('/cita', [CitaController::class, 'index']);
//API
//$router->get('/api/servicios', [ApiController::class, 'index']);
$router->get('/api/servicios', [ApiController::class, 'index']);
$router->post('/api/citas', [ApiController::class, 'guardar']);
$router->post('/api/eliminar', [ApiController::class, 'eliminar']);




// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
