<?php

namespace Model;

class CitaServicio extends ActiveRecord
{
    protected static $tabla = 'citasServicios';
    protected static $columnasDB = ['id', 'citas', 'servicios'];

    public $id;
    public $citas;
    public $servicios;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->citas = $args['citas'] ?? '';
        $this->servicios = $args['servicios'] ?? '';
    }
}
