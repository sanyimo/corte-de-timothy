<?php
/*
Template Name: Crónica – Accesorios Reales
*/
get_header();

$img_accesorios = get_field('img_accesorios');
$img_flores = get_field('img_flores');
$img_sombrero = get_field('img_sombrero');
$img_capa = get_field('img_capa');
?>

<a class="cronica__pg-volver" href="<?php echo site_url('/cronicas-del-reino'); ?>">Volver a las crónicas</a>
<main class="cronica__pg">
    <div class="cronica__pg-papiro">
        <div class="container">
            <h1>👑 Accesorios para la realeza</h1>
            <article class="cronica__pg-contenido">
                <section>
                    <p>
                        En el <strong>salón de tocador real</strong>, bajo una lámpara de cristales encantados, Lady Canelle y sus damas de compañía inspeccionaban cuidadosamente los <strong>accesorios del día</strong>.
                    </p>
                    <p>
                        Sobre cojines de terciopelo se encontraban los tesoros: <strong>diademas de zafiro celeste</strong>, <strong>lazos bordados con hilos de luna</strong> y <strong>cascabeles traídos del mercado de los gnomos</strong>.
                    </p>
                </section>

                <figure class="cronica__pg-imagen">
                    <?php echo the_acf_image($img_accesorios, 'Accesorios reales: diademas, lazos y cascabeles sobre cojines', 'cronica__pg-imagen--img-gr'); ?>
                    <figcaption>Una mañana cualquiera en el tocador de Lady Canelle.</figcaption>
                </figure>

                <section>
                    <h2>🧺 El perchero encantado</h2>
                    <p>
                        Los accesorios no se eligen al azar. El <em>perchero encantado</em> gira al ritmo de la brisa y revela, cada día, el conjunto perfecto según el estado de ánimo de la realeza.
                    </p>

                    <ul>
                        <li>
                            Si elige flores: será un día de juegos en los jardines.
                            <?php echo the_acf_image($img_flores, 'Flores', 'cronica__pg-imagen--accesorio'); ?></li>
                        <li>
                            Si escoge sombreros: toca reunión con embajadores felinos.
                            <?php echo the_acf_image($img_sombrero, 'Sombrero', 'cronica__pg-imagen--accesorio'); ?></li>
                        <li>
                            Si se desliza una capa: aventuras por los pasadizos del castillo.
                            <?php echo the_acf_image($img_capa, 'Capa', 'cronica__pg-imagen--accesorio'); ?></li>
                    </ul>
                </section>

                <section>
                    <h2>📜 Estilo con propósito</h2>
                    <p>
                        Para la nobleza canina, cada accesorio no es solo adorno: es un emblema. Un lazo puede indicar rango; un cascabel, valentía. Incluso los colores obedecen códigos secretos.
                    </p>

                    <p>
                        Aquella mañana, la Lady Canelle eligió un collar celeste con estrella dorada. Cuando salió, todos sabían: hoy es día de decretos reales.
                    </p>
                </section>

                <section>
                    <h2>🎙 Palabras de Sir Pelusín</h2>
                    <p class="poema"><em>
                            “Entre lazos y joyas eligiendo al azar,<br>
                            la corte canina se prepara a brillar.<br>
                            Con estilo y honor, como dicta el manual,<br>
                            ¡qué viva la moda en el reino animal!”
                        </em></p>
                </section>
                <p class="firma">— Sir Pelusín</p>
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