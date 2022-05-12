<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Blog;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController {
    public static function index (Router $router) {

        $propiedades = Propiedad::get(3);
        $inicio = true;
        $blogs = blog::get(2);
        
        $router->render('paginas/index',[
            'propiedades' => $propiedades,
            'inicio' => $inicio,
            'blogs' =>$blogs
        ]);
    }

    public static function nosotros (Router $router) {
       $router->render('paginas/nosotros');
    }
    
    public static function propiedades (Router $router) {
       
        $propiedades = Propiedad::all();

        $router->render('paginas/propiedades',[
            'propiedades' => $propiedades
        ]);
    }
    
    public static function propiedad (Router $router) {
        
        $id=validaroRedireccionar('/propiedades');

        $propiedad = Propiedad::find($id);

        $router->render('paginas/propiedad',[
            'propiedad'=> $propiedad
        ]);
    }
    
    public static function blog (Router $router) {
        
        $blogs = Blog::all();

        $router->render('paginas/blog', [
            'blogs'=>$blogs  
        ]);
    }
    
    public static function entrada (Router $router) {
      
        $id=validaroRedireccionar('/blog');

        $blog = blog::find($id);
       
        $router->render('paginas/entrada', [
            'blog'=> $blog
        ]);
    }
    
    public static function contacto (Router $router) {

        $mensaje = null;


        if ($_SERVER['REQUEST_METHOD']=== 'POST') {

            $respuesta = $_POST['contacto'];
            //Crear una nueva instancia de Phpmailer
            $mail = new PHPMailer();
            //configura SMTP
            $mail->isSMTP();

            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = 'da7956c7b738f2';
            $mail->Password = '403cbfaba00735';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;

            //configura el contenido del mail

            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com','BienesRaices.com');
            $mail->Subject = 'Tienes un Nuevo Mensaje';

            //Habilitar html

            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->CharSet = 'UTF-8';

            //DEFINIR CONTENIDO

            $contenido = '<html>';
            $contenido .= '<p> Tienes un Nuevo Mensaje</p>';
            $contenido .= '<p> Nombre: ' . $respuesta['nombre'] . ' </p>';
           
            //enviar de forma condicional datos al email , telefono o email
            if($respuesta['contacto'] === 'telefono') {
                $contenido .= '<p> Eligio ser Contactado por Telefono </p>';
                $contenido .= '<p> Telefono: ' . $respuesta['telefono'] . ' </p>';
                $contenido .= '<p> Fecha de contacto: ' . $respuesta['fecha'] . ' </p>';
                $contenido .= '<p> Hora de Contacto: ' . $respuesta['hora'] . ' </p>';

            } else {
                $contenido .= '<p> Eligio ser Contactado por Email </p>';
                $contenido .= '<p> Email: ' . $respuesta['email'] . ' </p>';
            }


            $contenido .= '<p> Mensaje: ' . $respuesta['mensaje'] . ' </p>';
            $contenido .= '<p> Vende o Compra: ' . $respuesta['tipo'] . ' </p>';
            $contenido .= '<p> Precio o Presupuesto: $' . $respuesta['precio'] . ' </p>';
            $contenido .= '</html>';
            

            $mail->Body = $contenido;
            $mail->AltBody = "esto es texto Alternativo sin html";

            //enviar Email

            if($mail->send()) {
                $mensaje = "Mensaje enviado correctamente";

            }else {
                $mensaje = "El mensaje no se pudo enviar";
            }


        }
      
        
        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);


    }
}