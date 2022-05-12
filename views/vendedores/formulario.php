<fieldset>
                <legend>Informacion General</legend>

                <label for="nombre">Nombre:</label>
                <input name="vendedor[nombre]" type="text" id="nombre" placeholder="Nombre del vendedor" value="<?php  echo s( $vendedor->nombre ); ?>">

                <label for="apellido">Apellido:</label>
                <input name="vendedor[apellido]" type="text" id="apellido" placeholder="Apellido del vendedor" value="<?php  echo s( $vendedor->apellido ); ?>">

              
</fieldset>


<fieldset>
    <legend>Informacion Extra</legend>

    <label for="telefono">Telefono:</label>
         <input name="vendedor[telefono]" type="text" id="telefono" placeholder="telefono del vendedor" value="<?php  echo s( $vendedor->telefono ); ?>">


         <label for="email">email:</label>
         <input name="vendedor[email]" type="text" id="email" placeholder="email del vendedor" value="<?php  echo s( $vendedor->email ); ?>">

         <label for="imagen">Imagen:</label>
        <input type="file" id="imagen" accept="image/jpeg, image/png" name="vendedor[imagen]">

        <?php if($vendedor->imagen): ?>
        <img src ="/imagenesV/<?php echo $vendedor->imagen; ?>" class="imagen-small">
                    
        <?php endif;?>



</fieldset>