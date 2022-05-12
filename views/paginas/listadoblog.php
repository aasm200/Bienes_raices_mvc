<?php foreach($blogs as $blog): ?>
    
    <article data-cy="entradas-blog" class="entrada-blog">
       
        <div class="imagen">
            <img loading="lazy" src="/imagenesE/<?php echo $blog->imagen; ?>" alt="imagen entrada blog">
        </div>

    <div class="texto-entrada">
        <a href="/entrada?id=<?php echo $blog->id; ?>">
                    <h4><?php echo $blog->titulo; ?></h4>
                    <p>Escrito el: <span><?php echo $blog->creado; ?></span> por: <span><?php echo $blog->escritor; ?></span> </p>

                    <p>
                       <?php echo $blog->descripcion; ?>
                    </p>
                </a>
            </div>
        </article>
<?php endforeach; ?>