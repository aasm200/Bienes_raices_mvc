<?php 

namespace MVC;

class Router {

    public $rutasGET = [];
    public $rutasPOST = [];


    public function get($url, $fn) {   //creamos un arreglo donde su llave es el sitio web y su valor es la funcion
        $this->rutasGET[$url] = $fn;
    }

    
    public function post($url, $fn) {   //creamos un arreglo donde su llave es el sitio web y su valor es la funcion
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobaRutas () {

        session_start();

        $auth = $_SESSION['login'] ?? null;
        //arreglo de rutas protegidas

        $rutas_protegidas = ['/admin','/propiedades/crear','/propiedades/actualizar','/propiedades/eliminar','/vendedores/crear','/vendedores/actualizar','/vendedores/eliminar','/blog/crear','/blog/actualizar','/blog/eliminar'];
        //Propiedades Crud

       $urlActual = $_SERVER['REQUEST_URI'] === '' ? '/' : $_SERVER['REQUEST_URI'] ;
       $metodo = $_SERVER['REQUEST_METHOD'];
      
       if($metodo === 'GET') {
            $fn = $this->rutasGET[$urlActual] ?? null;
       } else {  
            $fn = $this->rutasPOST[$urlActual] ?? null;
       }
       
       if(in_array($urlActual, $rutas_protegidas) && !$auth) {
        header('location: /');
        
       }

       if ($fn) {
            // La url existe y hay una funcion asociada 
            call_user_func($fn,$this);
       } else {
           echo " Pagina no Encontrada";
       }
    }
    //muestra una vista

    public function render($views, $datos = []) {

        foreach($datos as $key => $value) {
            $$key = $value;  // itera y genera variables con los nombres del arreglo asociativo que le demos hacia la vista
        }
        
        ob_start();  // inicia almacena en memoria
        include __DIR__. "/views/$views.php";

        $contenido  = ob_get_clean();

        include __DIR__.  "/views/layout.php";
    }

}