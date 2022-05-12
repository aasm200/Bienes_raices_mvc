<main class="contenedor seccion contenido-centrado">
        <h1><?php echo $blog->titulo ?></h1>

   
        <picture>
            <!-- <source srcset="build/img/destacada2.webp" type="image/webp">
            <source srcset="build/img/destacada2.jpg" type="image/jpeg"> -->
            <img loading="lazy" src="/imagenesE/<?php echo $blog->imagen; ?>" alt="imagen entrada blog">
        </picture>

        <p class="informacion-meta">Escrito el: <span><?php echo $blog->creado; ?></span> por: <span><?php echo $blog->escritor; ?></span> </p>


        <div class="resumen-propiedad">
            <p> <?php echo $blog->descripcion; ?></p>
        </div>
    </main>