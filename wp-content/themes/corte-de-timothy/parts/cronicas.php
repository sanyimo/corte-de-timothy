<?php $img_trovador = get_field('trovador_img'); ?>

<section class="cronicas__intro">
    <h1>📜 Crónicas del Reino</h1>
    <div class="cronicas__intro-texto">            
        <p>
            Desde la torre más perfumada del castillo, <strong>Sir Pelusín el Trovador</strong> relata las hazañas, secretos y consejos de belleza de los nobles caninos de la corte.
            Aquí hallarás relatos de <em>baños gloriosos</em>, <em>cortes majestuosos</em>, <em>galletas ancestrales</em> y todo cuanto acontece en los dominios de Timothy.
        </p>
    </div>
    <div class="cronicas__intro-imagen">
        <?php the_acf_image($img_trovador, 'Sir Pelusín, el trovador cantando', 'trovador_img') ?>
    </div>
</section>
<div class="container">    
    <section class="cronicas__grid">
        <article class="cronica">
            <a href="<?php echo get_permalink(get_page_by_path('cronicas-del-reino/cronica-banos-aromaticos')); ?>">
                <h2>🛁 Los baños aromáticos del Ala Oeste</h2>
                <p>
                    Aquel día, la Dama Lulú salió del baño envuelta en una nube de lavanda y con el pelaje más brillante que los vitrales de la capilla real.
                </p>
                <p class="firma">— Sir Pelusín</p>
            </a>
        </article>

        <article class="cronica">
            <a href="<?php echo get_permalink(get_page_by_path('cronicas-del-reino/cronica-corte-imperial')); ?>">
                <h2>✂️ El corte imperial del Conde Caniche</h2>
                <p>
                    Con un solo tijeretazo, la estilista real transformó la melena del Conde Caniche en una escultura digna de los salones de Versalles.
                </p>
                <p class="firma">— Sir Pelusín</p>
            </a>
        </article>

        <article class="cronica">
            <a href="<?php echo get_permalink(get_page_by_path('cronicas-del-reino/cronica-galletas-de-la-reina')); ?>">
                <h2>🍪 Las galletas de la Reina Pelusa</h2>
                <p>
                    Se dice que quien las prueba corre tres vueltas al jardín de la corte delirio de alegría. ¡Y no queda ni una miga!
                </p>
                <p class="firma">— Sir Pelusín</p>
            </a>
        </article>

        <article class="cronica">
            <a href="<?php echo get_permalink(get_page_by_path('cronicas-del-reino/cronica-accesorios-para-la-realeza')); ?>">
                <h2>👑 Accesorios para la realeza</h2>
                <p>
                    Diademas, capas y collares imperiales. Porque no basta con ser noble, hay que parecerlo.
                </p>
                <p class="firma">— Sir Pelusín</p>
            </a>
        </article>
    </section>
</div>
