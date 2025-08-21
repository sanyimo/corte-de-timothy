<?php
/*
Template Name: Crónica – Galletas de la Reina
*/
get_header();

$img_galletas = get_field('img_galletas');
$img_pelusa = get_field('img_reina_pelusa');
?>
<a class="cronica__pg-volver" href="<?php echo site_url('/cronicas-del-reino'); ?>">Volver a las crónicas</a>
<main class="cronica__pg">
    <div class="cronica__pg-papiro">
        <div class="container">
            <h1>🍪 Las galletas encantadas de la Reina Pelusa</h1>
            <article class="cronica__pg-contenido">
                <article>
                    <p>
                        En el corazón del ala dulce del Castillo de los Mil Ladridos, la <strong>Reina Pelusa</strong> ordenó hornear su receta más preciada: <em>las Galletas Encantadas</em>.
                    </p>
                    <p>
                        La cocina vibraba con el canto de cucharones danzantes, y los <strong>elfos pasteleros</strong> mezclaban miel ancestral, harina de nube y escamas de caramelo solar.
                    </p>
                </article>

                <?php if ($img_galletas): ?>
                    <figure class="cronica__pg-imagen">
                        <?php echo the_acf_image($img_galletas, 'Las Galletas Encantadas', 'cronica__pg-imagen--img-gr'); ?>
                        <figcaption>Las Galletas Encantadas recién salidas del horno mágico.</figcaption>
                    </figure>
                <?php endif; ?>

                <article>
                    <h2>✨ El secreto de su magia</h2>
                    <p>
                        Se decía que cada galleta contenía un susurro de hada y una mota de risa de cachorro. Su olor embriagador provocaba carreras espontáneas por los pasillos del castillo.
                    </p>
                    <p>
                        Los guardianes del torreón, al probar una, comenzaron a bailar sin música. Incluso el búho bibliotecario aplaudió con las alas.
                    </p>
                </article>

                <article>
                    <h2>👑 La Reina Pelusa</h2>
                    <p>
                        Dueña del recetario encantado y protectora de los postres del Reino, la Reina Pelusa velaba personalmente por la cocción de cada galleta.
                    </p>
                    <?php if ($img_pelusa): ?>
                        <figure class="cronica__pg-imagen">
                            <?php echo the_acf_image($img_pelusa, 'La Reina Pelusa', 'cronica__pg-imagen--img') ?>
                            <figcaption>Su majestad, supervisando con una cuchara de oro.</figcaption>
                        </figure>
                    <?php endif; ?>
                    <p>
                        Tras probar la primera hornada, sonrió con dulzura, y una lluvia de confetis mágicos cayó sobre la mesa.
                    </p>
                </article>

                <article>
                    <h2>🐾 Consecuencias deliciosas</h2>
                    <p>
                        Las crónicas relatan que todo aquel que probó una galleta pasó tres días soñando con tronos acolchados, cojines infinitos y ríos de caldo de hueso tibio. <br>
                        Al día siguiente, todos los perros de la corte exigieron una segunda hornada. No quedó ni una miga.
                    </p>
                </article>

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