<?php 

namespace Controllers;

use MVC\Router;
use Model\Blog;
use Intervention\Image\ImageManagerStatic as image;

class BlogController {

    public static function crear (Router $router) {
        
        $blog = new Blog();
        $errores = Blog::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {           // CODIGO PARA PODER EXTRAER LA INFORMACION TIPO POST DEL USUARIO
        
            //genera una nueva instancia
                $blog = new Blog($_POST['blog']);     
                
            //generar un nombre unico 
               $nombreImagen = md5(uniqid(rand(), true)). ".jpg";
            //setear la imagen
            //realiza un rezise a la imagen con intervention/image
                if($_FILES['blog']['tmp_name']['imagen']) {
                  
                    $image = image::make($_FILES['blog']['tmp_name']['imagen'])->fit(800,600);
                    $blog->setImagen($nombreImagen);
                }
                //validar informacion
                $errores = $blog->validar();     
                
                if (empty($errores)) {  
                
                //CREA CARPETA PARA LA SUBIDA IMAGENES
                if(!is_dir(IMAGENES_ENTRADA)) {
                    mkdir(IMAGENES_ENTRADA);
                }
                //guarda en el servidor LA IMAGEN
                $image->save(IMAGENES_ENTRADA.$nombreImagen);
                
                // GUARDA EN LA BASE DA DATOS
                $blog-> guardar(); 
                }
        
        
    }
         
        $router->render('blog/crear', [
        'errores'=>$errores,
        'blog'=>$blog
  
        ]);
    }

    public static function actualizar (Router $router) {
        $id = validaroRedireccionar('/admin');

       
        $blog = Blog::find($id); 
        $errores = Blog::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {           // CODIGO PARA PODER EXTRAER LA INFORMACION TIPO POST DEL USUARIO

            //asignar atributos
    
            $args = $_POST['blog'];
            
            $blog->sincronizar($args);
    
            $errores = $blog->validar();
    
            //generar un nombre unico 
            $nombreImagen = md5(uniqid(rand(), true)). ".jpg";
        
            //realiza un rezise a la imagen con intervention/image
                if($_FILES['blog']['tmp_name']['imagen']){
                    $image = image::make($_FILES['blog']['tmp_name']['imagen'])->fit(800,600);
                    $blog->setImagen($nombreImagen);
                }
    
    
            if (empty($errores)) {
                //almacenar la imagen
                if($_FILES['blog']['tmp_name']['imagen']){
                $image->save(IMAGENES_ENTRADA.$nombreImagen);
                }
                $blog->guardar();
            }   
    
    
        }

         $router->render('blog/actualizar', [
            'blog' => $blog,
            'errores' => $errores
        ]);


    }

    public static function eliminar () {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
            $id = $_POST['id'];
            $id = filter_var($id,FILTER_VALIDATE_INT);
            
            if ($id) {  
                $tipo = $_POST['tipo'];
        
                if(validarTipoContenido($tipo)) {
                    $blog = blog::find($id);
                    $blog->eliminar();
            
                }
            }      
        }

    }

}