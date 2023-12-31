<?php

namespace Controllers;

use MVC\Router;
use Model\Usuario;
//use Model\Admin;


class LoginController
{
    public static function login(Router $router)
    {
        $router->render('auth/login', []);
    }
    public static function logout(Router $router)
    {
        echo "Desde logout";
    }
    public static function olvide(Router $router)
    {
        echo "Desde Olvide";
    }
    public static function recuperar(Router $router)
    {
        echo "Desde Recuperar";
    }
    public static function crear(Router $router)
    {
        if ($_SERVER('REQUEST_METHOD') === 'post') {
            $usuario = new Usuario($_POST);
            var_dump($usuario);
            die;
        }
        $router->render('auth/crear_cuenta', []);
    }
}
