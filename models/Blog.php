<?php 

namespace Model;

class Blog extends ActiveRecord {

    protected static $tabla = 'blog';
    protected static $columnasDB= [ 'id', 'titulo', 'descripcion', 'imagen', 'escritor', 'creado'];

    public $id;
    public $titulo;
    public $descripcion;
    public $imagen;
    public $escritor;
    public $creado;

    public function __construct($arg=[])
    {
        $this->id = $arg['id'] ?? null;
        $this->titulo = $arg['titulo'] ?? '';
        $this->descripcion = $arg['descripcion'] ?? '';
        $this->imagen = $arg['imagen'] ?? '';
        $this->escritor = $arg['escritor'] ?? '';
        $this->creado = date('Y/m/d');
    
    }

    public function validar() {
        if(!$this->titulo){
            self::$errores[] = "Debes añadir un titulo";
        }

        if( strlen($this->descripcion) < 50 ){
            self::$errores[] = "La descripcion es obligatoria y debe tener al menos 50 caracteres ";
        }

        if( !$this->id )  {
            $this->validarImagen();
        }

        if(!$this->escritor){
            self::$errores[] = "Debes añadir un escritor";
        }
        return self::$errores;
    }

    public function validarImagen() {
        if(!$this->imagen ) {
            self::$errores[] = 'La Imagen es Obligatoria';
        }

    }
}

