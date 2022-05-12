<main class="contenedor seccion">
    <h1>Actualizar Entrada</h1>
    
    <a href="/admin" class="boton boton-verde"> Volver</a>
    <?php foreach($errores as $error):  ?>
            <div class="alerta error">
            <?php echo $error; ?>
            </div>   
        <?php endforeach; ?>

    <form class="formulario" method="post" enctype="multipart/form-data">
        <?php include __DIR__.'/formulario.php'; ?>
        <input type="submit" value="actualizar entrada" class="boton boton-verde">
    </form>

    


</main>