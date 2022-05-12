<?php 

namespace model;

class Propiedad extends ActiveRecord {

    protected static $tabla = 'propiedades';
    protected static $columnasDB= [ 'id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones',  'wc',  'estacionamiento', 'creado', 'vendedorId'];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones; 
    public $wc; 
    public $estacionamiento;
    public $creado;
    public $vendedorId; 

    
    public function __construct($arg=[])
    {
        $this->id = $arg['id'] ?? null;
        $this->titulo = $arg['titulo'] ?? '';
        $this->precio = $arg['precio'] ?? '';
        $this->imagen = $arg['imagen'] ?? '';
        $this->descripcion = $arg['descripcion'] ?? '';
        $this->habitaciones = $arg['habitaciones'] ?? '';
        $this->wc = $arg['wc'] ?? '';
        $this->estacionamiento = $arg['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $arg['vendedorId'] ?? '';
    
    }

    public function validar(){
        if(!$this->titulo){
            self::$errores[] = "Debes añadir un titulo";
        }

        if(!$this->precio){
            self::$errores[] = "Debes añadir un precio";
        }

        if( strlen($this->descripcion) < 50 ){
            self::$errores[] = "La descripcion es obligatoria y debe tener al menos 50 caracteres ";
        }

        if(!$this->habitaciones){
            self::$errores[] = "Debes añadir un numero de habitaciones";
        }
        
        if(!$this->wc){
            self::$errores[] = "Debes añadir un numero de baños";
        }

        if(!$this->estacionamiento){
            self::$errores[] = "Debes añadir un numero de lugares de estacionamiento";
        }

        if(!$this->vendedorId){
            self::$errores[] = " Elije un vendedor";
        } 

        if( !$this->id )  {
            $this->validarImagen();
        }
        return self::$errores;
    }

    public function validarImagen() {
        if(!$this->imagen ) {
            self::$errores[] = 'La Imagen es Obligatoria';
        }

    }
}