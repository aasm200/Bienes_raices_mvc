<fieldset>
    <legend>Informacion General</legend>

    <label for="titulo">Titulo:</label>
    <input name="blog[titulo]" type="text" id="titulo" placeholder="Titulo Propiedad" value="<?php  echo s( $blog->titulo ); ?>">

    
    <label for="decripcion">Decripcion:</label>
    <textarea name="blog[descripcion]" id="descripcion"><?php  echo s($blog->descripcion); ?></textarea>

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="blog[imagen]">


    <?php if($blog->imagen): ?>
        <img src ="/imagenesE/<?php echo $blog->imagen; ?>" class="imagen-small">
                    
        <?php endif;?>

    <label for="escritor">Escritor:</label>
    <input name="blog[escritor]" type="text" id="escritor" placeholder="Nombre Del Escritor" value="<?php  echo s( $blog->escritor ); ?>">


</fieldset>
