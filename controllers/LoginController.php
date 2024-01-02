<?php

namespace Controllers;

use Classes\Mailer;
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
            if(empty($alertas)){
                $resultado=$usuario->existeUsuario();
                if($resultado->num_rows){
                    $alertas=$usuario::getAlertas();
                }else{
                    $usuario->hashPassword();
                    //var_dump($usuario->password);
                    $usuario->crearToken();
                    //var_dump($usuario->token);
                    $mailer= new Mailer($usuario->email, $usuario->nombre, $usuario->token);
                    $mailer->enviarConfirmacion();
                    $resultado=$usuario->guardar();
                    if($resultado){
                        header('Location: /mensaje');
                    }
                }
            }
            
            //var_dump($alertas);  die;        
        }
        $router->render('auth/crear-cuenta', [
            'usuario'=>$usuario,
            'alertas'=>$alertas
        ]);
        
    }
    public static function confirmar(){

    }
    public static function mensaje(Router $router)
    {
        $router->render('auth/mensaje', []);
    }
}
