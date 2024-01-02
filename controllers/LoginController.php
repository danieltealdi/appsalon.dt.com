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
        $router->render('auth/olvide-password', []);
    }
    public static function recuperar(Router $router)
    {
        echo "Desde Recuperar";
    }
    public static function crear(Router $router)
    {
        $usuario = new Usuario;
        $alertas=[];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas=$usuario->validarNuevaCuenta();
            
            //var_dump($alertas);  die;        
        }
        $router->render('auth/crear-cuenta', [
            'usuario'=>$usuario,
            'alertas'=>$alertas
        ]);
        
    }
}
