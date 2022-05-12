<?php 

namespace Controllers;

use MVC\Router;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as image;

Class VendedoresController {

    public static function crear(Router $router) {
        
        $vendedor = new Vendedor();

        $errores = Vendedor::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {           
            $vendedor = new Vendedor($_POST['vendedor']);
        
            $nombreImagen = md5(uniqid(rand(), true)). ".jpg";
           
            if($_FILES['vendedor']['tmp_name']['imagen']) {
         
                $image = image::make($_FILES['vendedor']['tmp_name']['imagen'])->fit(800,600);
               
                $vendedor->setImagen($nombreImagen);
        
             
            }

            $errores = $vendedor->validar();

            if (empty($errores)) {  
            
                //CREA CARPETA PARA LA SUBIDA IMAGENES
                if(!is_dir(IMAGENES_VENDEDORES)) {
                    mkdir(IMAGENES_VENDEDORES);
                }
                //guarda en el servidor LA IMAGEN
                $image->save(IMAGENES_VENDEDORES.$nombreImagen);
                
                // GUARDA EN LA BASE DA DATOS
                $vendedor-> guardar(); 
            }
        }
    
       
        $router->render('vendedores/crear',[
            'vendedor' =>$vendedor,
            'errores'=>$errores
        ]);
    }

    public static function actualizar (Router $router) {
        $id = validaroRedireccionar('/admin');

        // Obtener los datos del vendedor a editar...
         $vendedor = Vendedor::find($id);

         // Arreglo con mensajes de errores
         $errores = Vendedor::getErrores();

         if($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Asignar los atributos
            $args = $_POST['vendedor'];
    
            $vendedor->sincronizar($args);
    
            
        $nombreImagen = md5(uniqid(rand(), true)). ".jpg";
       
        if($_FILES['vendedor']['tmp_name']['imagen']) {
     
            $image = image::make($_FILES['vendedor']['tmp_name']['imagen'])->fit(800,600);
           
           $vendedor->setImagen($nombreImagen);  
        }
    
            // Validación
            $errores = $vendedor->validar();
    
            if (empty($errores)) {
                //almacenar la imagen
                if($_FILES['propiedad']['tmp_name']['imagen']){
                $image->save(IMAGENES_VENDEDORES.$nombreImagen);
                }
                $vendedor->guardar();
            }   
    
       }
        

        $router->render('vendedores/actualizar',[
            'vendedor' =>$vendedor,
            'errores'=>$errores
        ]);
    }

    public static function eliminar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
            $id = $_POST['id'];
            $id = filter_var($id,FILTER_VALIDATE_INT);
            
            if ($id) {  
                $tipo = $_POST['tipo'];
        
                if(validarTipoContenido($tipo)) {
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
            
                }
            }      
        }

    }

}