<?php

namespace Controllers;

use Model\Servicio;
use Model\Cita;
use Model\CitaServicio;

class ApiController
{
    public static function index()
    {

        $servicios = Servicio::all();
        //debuguear($servicios);
        echo json_encode($servicios);
    }
    public static function guardar()
    {

        // Almacena la Cita y devuelve el ID
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();

        $id = $resultado['id'];

        // Almacena la Cita y el Servicio

        // Almacena los Servicios con el ID de la Cita
        $idServicios = explode(",", $_POST['servicios']);
        //debuguear($idServicios);
        foreach($idServicios as $idServicio) {
            $args = [
                'citas' => $id,
                'servicios' => $idServicio
            ];
            //debuguear($args);
            $citaServicio = new CitaServicio($args);
            //debuguear($citaServicio);
            $citaServicio->guardar();
        }

        echo json_encode(['resultado' => $resultado]);
    }

    public static function eliminar()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $cita = Cita::find($id);
            $cita->eliminar();
            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
    }

}
