<?php


define('TEMPLATES_URL', __DIR__ .'/templates'); // forma de definir URL 
define('FUNCIONES_URL',__DIR__.'funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] .'/imagenes/');
define('IMAGENES_VENDEDORES', $_SERVER['DOCUMENT_ROOT'] .'/imagenesV/');
define('IMAGENES_ENTRADA', $_SERVER['DOCUMENT_ROOT'] .'/imagenesE/');

function incluirTemplate  ( string $nombre, bool $inicio = false) {
    include TEMPLATES_URL."/${nombre}.php";
}


function truncate(string $texto, int $cantidad) : string
{
    if(strlen($texto) >= $cantidad) {
        return "<span title='$texto'>" . substr($texto, 0, $cantidad) . " ...</span>";
    } else {
        return $texto;
    }
}

function estaAutenticado() {
    session_start();
   
    if (!$_SESSION['login']) {
        header('Location: /');
    }  
    
}

function debuguear($variable) {
    echo "<pre>";
    var_dump($variable);
    echo "<pre>";
    exit;
}

//escapa / sanitizar el html

function s($html) : string { 
 $s = htmlspecialchars($html);
  return $s;
}

//validar tipo de contenido

function validarTipoContenido ($tipo)  {
    $tipos= ['vendedor','propiedad','blog'];

    return in_array($tipo, $tipos);

}

function mostrarNotificacion($codigo) {
    $mensaje = '';
    switch($codigo) {
        case 1: 
            $mensaje = 'Creado Correctamente';
            break;
        case 2: 
            $mensaje = 'Actulizado Correctamente';
            break;        
        case 3: 
            $mensaje = 'Eliminado Correctamente';
            break;
        default:
            $mensaje = false;
            break;
}
    return $mensaje;

}

function validaroRedireccionar (string $url) {
    $id = $_GET['id'];
    $id = filter_var($id,FILTER_VALIDATE_INT);

    if (!$id) {
        header("location ${url}");
    }
     // consulta los datos de la propiedades y vendedores

     return $id;

}