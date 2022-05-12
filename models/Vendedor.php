<?php 

namespace Model;

class Vendedor extends ActiveRecord {
    protected static $tabla = 'vendedores';
    protected static $columnasDB= [ 'id', 'nombre','apellido','telefono', 'email','imagen'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;
    public $email;
    public $imagen;

    
    public function __construct($arg=[])
    {
        $this->id = $arg['id'] ?? null;
        $this->nombre = $arg['nombre'] ?? '';
        $this->apellido = $arg['apellido'] ?? '';
        $this->telefono = $arg['telefono'] ?? '';   
        $this->email = $arg['email'] ?? '';
        $this->imagen = $arg['imagen'] ?? '';
    }

    public function validar() {
        if(!$this->nombre){
            self::$errores[] = "Debes añadir un nombre";
        }

        if(!$this->apellido){
            self::$errores[] = "Debes añadir un apellido";
        } 

        if(!$this->telefono){
            self::$errores[] = "Debes añadir un telefono";
        } 

        if(!$this->email){
            self::$errores[] = "Debes añadir un email";
        }
        if( !$this->id )  {
            $this->validarImagen();
        }
  
        if(!preg_match('/[0-9]{10}/',$this->telefono)) {
            self::$errores[] = "Formato de telefono no Valido";
        }
        
        if(!preg_match('/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/', $this->email)) {
            self::$errores[] = "Formato de email no valido no Valido";
        }

        return self::$errores;  

    }
    public function validarImagen() {
        if(!$this->imagen ) {
            self::$errores[] = 'La Imagen es Obligatoria';
        }

    }
}