<?php

namespace Controllers;

use Model\Cita;
use MVC\Router;
use Model\AdminCita;

//use Model\ActiveRecord;

class AdminController
{
    public static function index(Router $router)
    {
        session_start();
        isAdmin();

        //debuguear(_GET);
        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        //debuguear($fecha);
        $fechaExplode = explode('-', $fecha);
        if(!checkdate($fechaExplode[1], $fechaExplode[2], $fechaExplode[0])) {
            //debuguear($fecha);
            header('Location: /404');
        }

        //debuguear($router);

        //$fecha = date('Y-m-d');

        $consulta = "SELECT citas.id, citas.hora, CONCAT( usuarios.nombre, ' ', usuarios.apellido) as cliente, ";
        $consulta .= " usuarios.email, usuarios.telefono, servicios.nombre as servicio, servicios.precio  ";
        $consulta .= " FROM citas  ";
        $consulta .= " LEFT OUTER JOIN usuarios ";
        $consulta .= " ON citas.usuarioId=usuarioId  ";
        $consulta .= " LEFT OUTER JOIN citasServicios ";
        $consulta .= " ON citasServicios.citas=citas.id ";
        $consulta .= " LEFT OUTER JOIN servicios ";
        $consulta .= " ON servicios.id=citasServicios.servicios ";
        $consulta .= " WHERE fecha =  '${fecha}' ";
        //var_dump("index" . $consulta);
        $citas = AdminCita::SQL($consulta);
        //debuguear($citas);

        $router->render('admin/index', [
            'fecha' => $fecha,
            'nombre' => $_SESSION['nombre'],
            'citas' => $citas,

        ]);
    }
}
/*
SELECT citas.id, citas.hora, CONCAT( usuarios.nombre, ' ', usuarios.apellido) as cliente,
usuarios.email, usuarios.telefono, servicios.nombre as servicio, servicios.precio
FROM citas
LEFT OUTER JOIN usuarios
ON citas.usuarioId=usuarioId
LEFT OUTER JOIN citasServicios
ON citasServicios.citas=citas.id
LEFT OUTER JOIN servicios
ON servicios.id=citasServicios.servicios
*/
