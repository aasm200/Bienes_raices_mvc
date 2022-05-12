<main class="contenedor seccion">
    <h1>Administrador de bienes y Raices</h1>
    <?php 

        if($resultado ) {
            $mensaje =mostrarNotificacion(intval ($resultado));
            if($mensaje) {?>
            <p class="alerta exito"><?php echo s($mensaje); ?> </p>
    
          <<?php  }
        }
    ?>
     

        <a href="/propiedades/crear" class="boton boton-verde"> Nueva Propiedad</a>
        <a href="/vendedores/crear" class="boton boton-amarillo"> Nuevo(a) Vendedor</a>
        <a href="/blog/crear" class="boton boton-amarillo"> Nueva Entrada</a>
        
    <h2>Propiedades</h2>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody> <!--. mostrar los resultados --->
        <?php  
            foreach($propiedades as $propiedad): ?>
                <tr>
                <td> <?php echo $propiedad->id; ?></td>
                <td> <?php echo $propiedad->titulo; ?></td>
                <td>  <img  loading="lazy" src="/imagenes/<?php echo $propiedad->imagen; ?>"  class="imagen-tabla" /> </td>
                <td>$ <?php echo $propiedad->precio; ?></td>
                <td>
                    <form method="POST"  class="w-100" action="/propiedades/eliminar">
                        <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                        <input type="hidden" name="tipo" value="propiedad">
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>
                    <a class="boton-amarillo-block" 
                    href="/propiedades/actualizar?id=<?php echo $propiedad->id; ?>"> Actualizar</a>
                </td>
                </tr>
        <?php 
            endforeach; ?>
        </tbody>
    </table>

    <h2>Vendedores</h2>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>email</th>
                    <th>imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> <!--. mostrar los resultados --->
            <?php  
                foreach($vendedores as $vendedor): ?>
                    <tr>
                    <td> <?php echo $vendedor->id ; ?></td>
                    <td> <?php echo $vendedor->nombre. " " . $vendedor->apellido; ?></td>
                    <td> <?php echo $vendedor->telefono; ?></td>
                    <td> <?php echo $vendedor->email; ?></td>
                    <td>  <img  loading="lazy" src="/imagenesV/<?php echo $vendedor->imagen; ?>"  class="imagen-tabla" /> </td>
                    <td>
                        <form method="POST" action="vendedores/eliminar"  class="w-100">
                            <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                            <input type="hidden" name="tipo" value="vendedor">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a class="boton-amarillo-block" 
                        href="/vendedores/actualizar?id=<?php echo $vendedor->id; ?>"> Actualizar</a>
                    </td>
                    </tr>
                 <?php 
                endforeach; ?>
            </tbody>
        </table>


    <h2>Entradas</h2>

<table class="propiedades">
    <thead>
        <tr>
            <th>ID</th>
            <th>titulo</th>
            <th>Imagen</th>
            <th>Escritor</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody> <!--. mostrar los resultados --->
    <?php  
        foreach($blogs as $blog): ?>
            <tr>
            <td> <?php echo $blog->id ; ?></td>
            <td> <?php echo $blog->titulo; ?></td>
            <td>  
                <img  loading="lazy" src="/imagenesE/<?php echo $blog->imagen; ?>"  class="imagen-tabla" /> 
            </td>
            <td> <?php echo $blog->escritor; ?></td>
            <td>
                <form method="POST" action="blog/eliminar"  class="w-100">
                    <input type="hidden" name="id" value="<?php echo $blog->id; ?>">
                    <input type="hidden" name="tipo" value="blog">
                    <input type="submit" class="boton-rojo-block" value="Eliminar">
                </form>
                <a class="boton-amarillo-block" 
                href="/blog/actualizar?id=<?php echo $blog->id; ?>"> Actualizar</a>
            </td>
            </tr>
         <?php 
        endforeach; ?>
    </tbody>
</table>

</main>

