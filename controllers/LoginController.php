<?php

namespace Controllers;

//require_once __DIR__ . '/../includes/app.php';

use Classes\Mailer;
use MVC\Router;
use Model\Usuario;

class LoginController
{
    public static function login(Router $router)
    {
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarLogin();
            if (empty($alertas)) {
                $usuario = Usuario::where('email', $auth->email);
                //debuguear($usuario);
                if ($usuario) {
                    if($usuario->comprobarPasswdAndVerificado($auth->password)) {
                        session_start();
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;
                        $_SESSION['admin'] = $usuario->admin ?? null;
                            
                        if($usuario->admin === '1') {
                            header('Location: /admin');
                        } else {
                            header('Location: /cita');
                        }
                        //debuguear($_SESSION);
                    }
                } else {
                    Usuario::setAlerta('error', 'Usuario no encontrado');
                }
            }
        }
        $alertas = Usuario::getAlertas();
        $router->render('auth/login', [
            'alertas' => $alertas,
        ]);
    }
    public static function logout(Router $router)
    {
        session_start();
        $_SESSION = [];
        //debuguear($_SESSION);
        header('Location: /');
    }
    public static function olvide(Router $router)
    {
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();
            if(empty($alertas)) {
                $usuario = Usuario::where('email', $auth->email);
                if($usuario && $usuario->confirmado === '1') {
                    $usuario->crearToken();
                    $usuario->guardar();
                    //enviar email
                    $mailer = new Mailer($usuario->email, $usuario->nombre, $usuario->token);
                    $mailer->enviarInstrucciones();
                    Usuario::setAlerta('exito', 'Revisa tu email');

                } else {
                    Usuario::setAlerta('error', 'No existe o no está confirmado');

                }


            }
        }
        $alertas = Usuario::getAlertas();

        $router->render('auth/olvide-password', [
            'alertas' => $alertas,
        ]);
    }
    public static function recuperar(Router $router)
    {
        $alertas = [];
        $error = false;
        $token = s($_GET['token']);
        $usuario = Usuario::where('token', $token);
        if(empty($usuario)) {
            Usuario::setAlerta('error', 'El token no es correcto');
            $error = true;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            //leer y guardar password
            $password = new Usuario($_POST);
            $alertas = $password->validarPassword();
            if(empty($alertas)) {
                $usuario->password = $password->password;
                $usuario->token = null;
                $usuario->hashPassword();
                $resultado = $usuario->guardar();
                if ($resultado) {
                    header('Location: /');
                }
            }

        }

        //debuguear($usuario);

        $alertas = Usuario::getAlertas();
        $router->render('auth/recuperar-password', [
            'alertas' => $alertas,
            'error' => $error,
        ]);
    }
    public static function crear(Router $router)
    {
        $usuario = new Usuario();
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();
            if (empty($alertas)) {
                $resultado = $usuario->existeUsuario();
                if ($resultado->num_rows) {
                    $alertas = $usuario::getAlertas();
                } else {
                    $usuario->hashPassword();
                    //var_dump($usuario->password);
                    $usuario->crearToken();
                    //var_dump($usuario->token);
                    $mailer = new Mailer($usuario->email, $usuario->nombre, $usuario->token);
                    $mailer->enviarConfirmacion();
                    $resultado = $usuario->guardar();
                    if ($resultado) {
                        header('Location: /mensaje');
                    }
                }
            }

            //var_dump($alertas);  die;
        }
        $router->render('auth/crear-cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }
    public static function confirmar(Router $router)
    {
        $alertas = [];
        $token = s($_GET['token']);
        $usuario = Usuario::where('token', $token);
        //debuguear($usuario);
        if (empty($usuario)) {
            Usuario::setAlerta('error', 'El usuario no existe');
        } else {
            //debuguear($usuario);
            $usuario->confirmado = "1";
            $usuario->token = null;
            //debuguear($usuario);
            $usuario->guardar();
            Usuario::setAlerta('exito', 'Cuenta comprobada correctamente');
        }
        $alertas = Usuario::getAlertas();
        $router->render('auth/confirmar-cuenta', [
            'alertas' => $alertas
        ]);
    }
    public static function mensaje(Router $router)
    {
        $router->render('auth/mensaje', []);
    }
}
