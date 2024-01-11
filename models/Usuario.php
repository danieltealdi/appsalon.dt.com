<?php
namespace Model;
class Usuario extends ActiveRecord{
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'password','telefono', 'admin', 'confirmado', 'token'];
    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;
        
    public function __construct($args=[]){
        $this->id=$args['id'] ?? null;
        $this->nombre=$args['nombre'] ?? '';
        $this->apellido=$args['apellido'] ?? '';
        $this->email=$args['email'] ?? '';
        $this->password=$args['password'] ?? '';
        $this->telefono=$args['telefono'] ?? '';
        $this->admin=$args['admin'] ?? 0;
        $this->confirmado=$args['confirmado'] ?? 0;
        $this->token=$args['token'] ?? '';
        }
        
    public function validarNuevaCuenta(){
        if(!$this->nombre){
            self::$alertas['error'][]='El nombre es obligatorio';
        }
        if(!$this->apellido){
            self::$alertas['error'][]='El apellido es obligatorio';
        }
        if(strlen($this->password)<6){
            self::$alertas['error'][]='El password debe tener al menos 6 caracteres';
        }
        if(!$this->email){
            self::$alertas['error'][]='El Email es obligatorio';
        }
        if(!$this->password){
            self::$alertas['error'][]='El password es obligatorio';
        }
        return self::$alertas;
    }
    public function validarLogin(){
        if(strlen($this->password)<6){
            self::$alertas['error'][]='El password debe tener al menos 6 caracteres';
        }
        if(!$this->email){
            self::$alertas['error'][]='El Email es obligatorio';
        }
        if(!$this->password){
            self::$alertas['error'][]='El password es obligatorio';
        }
        return self::$alertas;
    }
    public function validarEmail(){
        if(!$this->email){
            self::$alertas['error'][]='El Email es obligatorio';
        }
    }
    public function validarPassword(){
        if(!$this->password){
            self::$alertas['error'][]='El Password es obligatorio';
        }
        if(strlen($this->password)<6){
            self::$alertas['error'][]='El Password debe tener al menos 6 caracteres';
        }
        return self::$alertas;
    }
    public function existeUsuario(){
        $query="SELECT * FROM " . self::$tabla . " WHERE email='".$this->email . "' LIMIT 1";
        $resultado=self::$db->query($query);
        if($resultado->num_rows){
            self::$alertas['error'][]='el usuario ya está registrado';            
        }
        return $resultado;

        //debuguear($resultado);
    }
    public function hashPassword(){
        $this->password=password_hash($this->password, PASSWORD_BCRYPT);
    }
    public function crearToken(){
        $this->token=uniqid();
    }
    public function comprobarPasswdAndVerificado($passwd){
        $resultado= password_verify($passwd, $this->password);
        //var_dump($resultado);
        //var_dump($this->confirmado);
        if($resultado&&$this->confirmado){            
            return true;            
        }else{
            Usuario::setAlerta('error', 'Password incorrecto o la cuenta no ha sido confirmada');
        }
    }
}
