<?php 

namespace Model;


class ActiveRecord {
   

        //base de datos
        protected static $db;
        protected static $columnasDB= [''];
        protected static $tabla = '';
        //errores
        protected static  $errores = [];
    
        //definir la conexion a la base datos
        public static function setDB($database){
            self::$db = $database;
        }
        public  function guardar () {
           if(!is_null($this->id)) {
               //actulizando
               $this->actualizar();
           } else {
               //creando un nuevo registro
               $this->crear();
    
           }
        }
        public function crear() {
    
            //sanitizar los datos
            $atributos = $this->sanitizarAtributos();
    
            $query = "INSERT INTO " . static::$tabla . " (";
            $query .= join(', ',array_keys($atributos));
            $query .=" ) VALUES (' ";
            $query .= join("', '",array_values($atributos));
            $query .= " ') ";

           $resultado = self::$db->query($query);
           
            if($resultado) {
                //redireccionar al usuario para evitar que dupliquen entradas a la DB
                header('location: /admin?resultado=1');
            }   
    
        }
    
        public function actualizar() {
              //sanitizar los datos
              $atributos = $this->sanitizarAtributos();
    
              $valores = [];
              foreach ($atributos as $key =>$value) {
                  $valores[] = "{$key} ='{$value}'"; 
    
              }
    
            $query = "UPDATE " . static::$tabla . " SET ";
            $query.= join(', ',$valores);
            $query.= " WHERE id ='" . self::$db->escape_string($this->id). "' ";
            $query.= "LIMIT 1 "; 
    
            $resultado = self::$db->query($query);
                
            if($resultado) {   
                //redireccionar al usuario para evitar que dupliquen entradas a la DB 
           header('location: /admin?resultado=2');
            }   
        }
    
        //eliminar un registro
    
        public function eliminar() {
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1 ";
        
    
        $resultado = self::$db->query($query);
           
        if($resultado) {
            $this->borrarImagen();   
            //redireccionar al usuario para evitar que dupliquen entradas a la DB 
             header('location: /admin?resultado=3');
        }   
    
        }
    
        //identificar y unir los atributos de la base datos
        public function atributos() {
            $atributos = [];
            foreach(static::$columnasDB as $columna) {
                if ($columna=== 'id') continue;
                $atributos[$columna] = $this->$columna;
            }
            return $atributos;
        }
    
        public function sanitizarAtributos() {
            $atributos = $this->atributos();
            $sanitizado =[];
           
    
            foreach ($atributos as $key => $value) {
                $sanitizado[$key] =self::$db-> escape_string($value);  
               
            }
            
            return $sanitizado; 
        }
    
        //subida de archivos
    
        public function setImagen($imagen) {
            //elimina imagen previa
            if(!is_null($this->id)) {
                $this->borrarImagen();
                
            }
    
           //asignar atrbuto imagen el nombre de la imagen
            if($imagen) {
                $this->imagen =$imagen;
            }
        }
    public function borrarImagen() {
         //comprobar si el archivo existe
         $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
         $existeVendedor = file_exists(IMAGENES_VENDEDORES . $this->imagen);
         $existeEntrada = file_exists(IMAGENES_ENTRADA . $this->imagen);
         
         if($existeArchivo) {
             unlink(CARPETA_IMAGENES . $this->imagen);
         } 
         if($existeVendedor) {
            
           unlink(IMAGENES_VENDEDORES . $this->imagen);
        } 
        if($existeEntrada) {
            
            unlink(IMAGENES_ENTRADA . $this->imagen);
         } 
         
    } 
        //validacion
    
        public static function getErrores() {

           
            return static::$errores;
        }
    
        public function validar(){
            
            static::$errores = [];
            return static::$errores;
    
        } 
       //lista toda las registro
    
       public static function all() {
            $query = "SELECT * FROM ". static::$tabla;  
            $resultado = self::consultaSql($query);
    
            return $resultado;
       
       }

       // obtiene un determinado numero de registro

       public static function get($cantidad) {
        $query = "SELECT * FROM ". static::$tabla  . " LIMIT " . $cantidad;
        $resultado = self::consultaSql($query);
        
        return $resultado;
   
   }

    
       public static function find($id) {
        $query = "SELECT * FROM ". static::$tabla . " WHERE id = ${id}";
        $resultado = self::consultaSql($query);
    
        return array_shift($resultado);
       }
    
       public static function consultaSql($query) {
           //consultar a la base de datos 
            $resultado = self::$db->query($query);
           //iterar resultadis
            $array = [];
            while ($registro =  $resultado->fetch_assoc()) {
                $array[] = static::crearObjeto($registro);
            }
           //liberar memoria
           $resultado->free();
           //retornar resultados
           return $array;
       
       }
       protected static function crearObjeto($registro) {
            $objeto = new static;  // crea un nuevo objeto vacio , nueva instancia de la clase .
    
             foreach($registro as $key => $value) {
                 if (property_exists($objeto, $key)) {
                    $objeto->$key =$value;
                 }
             }
             return $objeto;
       }
    
       //sincroniza el objeto en memoriia con los canbios actulizado del usuario
    
       public function sincronizar($args = []) {
            foreach ($args as $key => $value) { 
                if(property_exists($this, $key) && !is_null($value)) {
                    $this->$key = $value;
                }
              }
       }
    
}

