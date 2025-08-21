<?php
/*
Template Name: Crónica – Corte Imperial
*/
get_header();

$img_conde_caniche = get_field('img_conde_caniche');
?>
<a class="cronica__pg-volver" href="<?php echo site_url('/cronicas-del-reino'); ?>">Volver a las crónicas</a>
<main class="cronica__pg">
    <div class="cronica__pg-papiro">
        <div class="container">
            <h1>✂️ El corte imperial del Conde Caniche</h1>
            <article class="cronica__pg-contenido">
                <p>
                    Aquella mañana, el castillo entero susurraba rumores: el <strong>Conde Caniche</strong> iba a someterse a un cambio de look. Las esteticistas reales afilaron sus tijeras de oro y prepararon las esencias florales más nobles del herbario de Lady Margarita.
                </p>

                <p>
                    Se colocaron cojines de terciopelo, se encendieron velas de romero, y el viento cesó su brisa para no perturbar la precisión del corte. La corte entera contuvo el aliento.
                </p>

                <figure class="cronica__pg-imagen">
                    <?php echo the_acf_image($img_conde_caniche, 'El Conde Caniche', 'cronica__pg-imagen--img'); ?>
                    <figcaption>El nuevo porte del Conde Caniche dejó a más de un noble sin habla.</figcaption>
                </figure>

                <h2>✨ El gran cambio</h2>
                <p>
                    La transformación fue mágica: rizos como nubes, orejas perfectamente perfiladas, y una cola digna de desfile imperial. Incluso el mismísimo Rey Timothy soltó un “¡guau!” de admiración.
                </p>

                <p>
                    Dicen los palafreneros que los pájaros entonaron melodías de júbilo, y que un unicornio se dejó ver brevemente en los jardines.
                </p>

                <h2>📜 Poema del trovador</h2>
                <p class="poema"><em>
                        “En rizos de espuma y seda,<br>
                        el Conde cambió su andar,<br>
                        que tiemble el baile de gala,<br>
                        pues ya se va a presentar.”
                    </em></p>

                <h2>👑 Declaración de la Corte</h2>
                <p>
                    Tras el éxito, se decretó el <strong>Día Nacional del Buen Peinado</strong>, con exhibiciones caninas, concursos de lazo y premios al "Rizo Más Real".
                </p>
                <p class="firma">— Sir Pelusín, trovador de la corte</p>
            </article>
        </div>
    </div>
</main>
<a class="cronica__pg-volver" href="<?php echo site_url('/cronicas-del-reino'); ?>">Volver a las crónicas</a>
<?php if (is_user_logged_in()) : ?>
    <div class="valoracion-formulario">
        <?php echo do_shortcode('[site_reviews_form assign_to="post_id"]'); ?>
    </div>
<?php else : ?>
    <p class="centrado">Por favor, <a href="/login">inicia sesión</a> o <a href="/registro">registrate</a> para dejar un comentario.</p>
<?php endif; ?>
<?php get_footer(); ?>