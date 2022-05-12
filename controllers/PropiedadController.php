<?php 

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Model\Blog;
use Intervention\Image\ImageManagerStatic as image;


class PropiedadController {
    public static function index(Router $router) {


        $propiedades = Propiedad::all();

        $vendedores = Vendedor::all();

        $blogs = Blog::all();

        $resultado = $_GET['resultado'] ?? null;

        $router->render('propiedades/admin',[
            'propiedades' => $propiedades,
            'resultado' => $resultado,
            'vendedores' =>$vendedores,
            'blogs'=>$blogs
        ]);
    }


    public static function crear (Router $router)  {

        $propiedad = new Propiedad();
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();

        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {           // CODIGO PARA PODER EXTRAER LA INFORMACION TIPO POST DEL USUARIO
        
        //genera una nueva instancia
            $propiedad = new Propiedad($_POST['propiedad']);     
            
        //generar un nombre unico 
           $nombreImagen = md5(uniqid(rand(), true)). ".jpg";
        //setear la imagen
        //realiza un rezise a la imagen con intervention/image
            if($_FILES['propiedad']['tmp_name']['imagen']) {
              
                $image = image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                $propiedad->setImagen($nombreImagen);
            }
            //validar informacion
            $errores = $propiedad->validar();     
            if (empty($errores)) {  
            
            //CREA CARPETA PARA LA SUBIDA IMAGENES
            if(!is_dir(CARPETA_IMAGENES)) {
                mkdir(CARPETA_IMAGENES);
            }
            //guarda en el servidor LA IMAGEN
            $image->save(CARPETA_IMAGENES.$nombreImagen);
            
            // GUARDA EN LA BASE DA DATOS
            $propiedad-> guardar(); 
            }
     }   

        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);

    }

    public static function actualizar (Router $router)  {
        

        $id = validaroRedireccionar('/admin');
    
        $propiedad = Propiedad::find($id); 
        $vendedores = Vendedor::all();

        $errores = Propiedad::getErrores();
       
     
        if($_SERVER['REQUEST_METHOD'] === 'POST') {           // CODIGO PARA PODER EXTRAER LA INFORMACION TIPO POST DEL USUARIO

            //asignar atributos
    
            $args = $_POST['propiedad'];
            
            $propiedad->sincronizar($args);
    
            $errores = $propiedad->validar();
    
            //generar un nombre unico 
            $nombreImagen = md5(uniqid(rand(), true)). ".jpg";
        
            //realiza un rezise a la imagen con intervention/image
                if($_FILES['propiedad']['tmp_name']['imagen']){
                    $image = image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                    $propiedad->setImagen($nombreImagen);
                }
    
    
            if (empty($errores)) {
                //almacenar la imagen
                if($_FILES['propiedad']['tmp_name']['imagen']){
                $image->save(CARPETA_IMAGENES.$nombreImagen);
                }
                $propiedad->guardar();
            }   
    
    
        }

         $router->render('propiedades/actualizar', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
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
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
            
                }
            }      
        }

    }
}
