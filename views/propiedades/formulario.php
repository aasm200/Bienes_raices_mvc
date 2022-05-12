<fieldset>
                <legend>Informacion General</legend>

                <label for="titulo">Titulo:</label>
                <input name="propiedad[titulo]" type="text" id="titulo" placeholder="Titulo Propiedad" value="<?php  echo s( $propiedad->titulo ); ?>">

                <label for="precio">Precio:</label>
                <input name="propiedad[precio]" type="number" id="precio" placeholder="precio Propiedad" value="<?php  echo s($propiedad->precio); ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="propiedad[imagen]">

                <?php if($propiedad->imagen): ?>
                    <img src ="/imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-small">
                    
                <?php endif;?>

                <label for="decripcion">Decripcion:</label>
               <textarea name="propiedad[descripcion]" id="descripcion"><?php  echo s($propiedad->descripcion); ?></textarea>

            </fieldset>

            <fieldset>
                <Legend>Informacion de la propiedad</Legend>

                <label for="habitaciones">Habitaciones:</label>
                <input name="propiedad[habitaciones]" type="number" id="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php  echo s($propiedad->habitaciones); ?>">
                     
                <label for="wc">Baños:</label>
                <input name="propiedad[wc]" type="number" id="wc" placeholder="Ej: 3" min="1" max="9" value="<?php  echo s($propiedad->wc); ?>">

                <label for="estacionamiento">Estacionamiento:</label>
                <input name="propiedad[estacionamiento]" type="number" id="estacionamiento" placeholder="Ej: 3" min="1" max="9"value="<?php  echo s($propiedad->estacionamiento); ?>">

            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>
                    <label for="vendedor">Vendedor</label>

                       <select name="propiedad[vendedorId]" id="nombre_vendedor">

                        <option selected value="" > -- Selecione --</option>
                    <?php foreach($vendedores as $vendedor) { ?>
                        <option <?php echo $propiedad->vendedorId === $vendedor->id ? 'selected' : '' ;?> 
                        value="<?php echo s($vendedor->id); ?>"><?php echo s($vendedor->nombre). " " . s($vendedor->apellido); ?> 
                  
                    <?php }; ?>
                    </select>
                        

            </fieldset>

