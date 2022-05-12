<?php 

namespace Controllers;

use MVC\Router;
use Model\Admin;

class LoginController {
    public static function login( Router $router) {

        $errores = [];



        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Admin($_POST);
            $errores = $auth->validar();
        
            if(empty($errores)) {

               $resultado = $auth->existeUsuario();
               
               if(!$resultado) {

                //verificar si existe o no y da mensaje de error 

               } else {
                   //verificar el password
                $autenticado = $auth->comprobarPassword($resultado);

                if ($autenticado) {
                      //autenticar usuario
                    $auth->autenticar();

                } else {
                    //password incorrecto
                    $errores = Admin::getErrores();
                }
               }   
            }    
        }

        $router->render('auth/login',[
            'errores' => $errores
        ]);

    }

    public static function logout() {
            session_start();
            $_SESSION = [];

            header('Location: /');
    }

}