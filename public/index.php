<?php 
//echo "index"; die;

require_once __DIR__ . '/../includes/app.php';
use Controllers\LoginController;
use MVC\Router;

$router = new Router();
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

$router->get('/crear-cuenta', [LoginController::class, 'crear']);
$router->post('/crear-cuenta', [LoginController::class, 'crear']);

$router->get('/olvide', [LoginController::class, 'olvide']);
$router->post('/olvide', [LoginController::class, 'olvide']);
$router->get('/recuperar', [LoginController::class, 'recuperar']);
$router->post('/recuperar', [LoginController::class, 'recuperar']);
$router->get('/logout', [LoginController::class, 'logout']);
$router->get('/logout', [LoginController::class, 'logout']);
$router->get('/logout', [LoginController::class, 'logout']);
$router->get('/logout', [LoginController::class, 'logout']);
$router->get('/logout', [LoginController::class, 'logout']);




// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();