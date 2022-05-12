<?php
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\PropiedadController;
use Controllers\VendedoresController;
use Controllers\PaginasController;
use Controllers\BlogController;
use Controllers\LoginController;

$router = new router();


//private zone
//main page admin
$router->get('/admin', [PropiedadController::class,'index']);

//Propiedades Crud
$router->get('/propiedades/crear', [PropiedadController::class,'crear']);
$router->post('/propiedades/crear', [PropiedadController::class,'crear']);
$router->get('/propiedades/actualizar', [PropiedadController::class,'actualizar']);
$router->post('/propiedades/actualizar', [PropiedadController::class,'actualizar']);
$router->post('/propiedades/eliminar', [PropiedadController::class,'eliminar']);

//Vendedores Crud
$router->get('/vendedores/crear', [VendedoresController::class,'crear']);
$router->post('/vendedores/crear', [VendedoresController::class,'crear']);
$router->get('/vendedores/actualizar', [VendedoresController::class,'actualizar']);
$router->post('/vendedores/actualizar', [VendedoresController::class,'actualizar']);
$router->post('/vendedores/eliminar', [VendedoresController::class,'eliminar']);

//blog entradas 

$router->get('/blog/crear', [BlogController::class,'crear']);
$router->post('/blog/crear', [BlogController::class,'crear']);
$router->get('/blog/actualizar', [BlogController::class,'actualizar']);
$router->post('/blog/actualizar', [BlogController::class,'actualizar']);
$router->post('/blog/eliminar', [BlogController::class,'eliminar']);


//public zone
//zona libre sin autenticacion

$router->get('/',[PaginasController::class, 'index']);
$router->get('/nosotros',[PaginasController::class, 'nosotros']);
$router->get('/propiedades',[PaginasController::class, 'propiedades']);
$router->get('/propiedad',[PaginasController::class, 'propiedad']);
$router->get('/blog',[PaginasController::class, 'blog']);
$router->get('/entrada',[PaginasController::class, 'entrada']);
$router->get('/contacto',[PaginasController::class, 'contacto']);
$router->post('/contacto',[PaginasController::class, 'contacto']);

//login autenticacion

$router->get('/login',[LoginController::class, 'login']);
$router->post('/login',[LoginController::class, 'login']);
$router->get('/logout',[LoginController::class, 'logout']);

//comprobar rutas
$router->comprobaRutas();   