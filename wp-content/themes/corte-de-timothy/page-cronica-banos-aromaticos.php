<?php
/*
Template Name: Crónica – Baños Aromáticos
*/
get_header();

$img_dama_lulu = get_field('img_dama_lulu');
?>

<a class="cronica__pg-volver" href="<?php echo site_url('/cronicas-del-reino'); ?>">Volver a las crónicas</a>
<main class="cronica__pg">
    <div class="cronica__pg-papiro">
        <div class="container">
            <h1>🛁 Los baños aromáticos del Ala Oeste</h1>
            <article class="cronica__pg-contenido">
                <section>
                    <p>
                        Bajo la luz ámbar de los ventanales del ala oeste, la <strong>Dama Lulú</strong> fue sumergida en aguas infusionadas con pétalos de rosa, esencias de lavanda y aceites de manzanilla real.
                    </p>

                    <p>
                        Las fuentes cantaban a su alrededor, mientras las doncellas, con guantes de encaje y gran solemnidad, vertían elixir tras elixir sobre su regio pelaje. En la lejanía, los corceles se quedaban quietos para no interrumpir el momento sagrado.
                    </p>
                </section>


                <figure class="cronica__pg-imagen">
                    <?php echo the_acf_image($img_dama_lulu, 'Dama Lulú', 'cronica__pg-imagen--img'); ?>
                    <figcaption>La ceremonia del baño, tradición ancestral de la nobleza canina.</figcaption>
                </figure>

                <h2>✨ La transformación</h2>
                <p>
                    Las doncellas secaron su pelaje con plumas de grulla silvestre, mientras el aire se llenaba de notas de azahar y hierbabuena. Cuando emergió, resplandecía como una estrella de oriente, su melena ondeaba al viento con un brillo etéreo.
                </p>

                <p>
                    Los bardos entonaron cánticos de honor, los sirvientes lloraron de emoción, y hasta los ratones del torreón se asomaron con sus mejores galas a aplaudir.
                </p>

                <h2>📜 Fragmento del trovador</h2>
                <p class="poema"><em>
                        “Bajo espuma de luna y flor,<br>
                        Lulú brilló cual constelación,<br>
                        Que tiemble el baile en el torreón,<br>
                        la dama surge en resplandor.”
                    </em></p>

                <h2>🎖 Epílogo Real</h2>
                <p>
                    A raíz del evento, el Rey Timothy proclamó el <strong>Ritual del Brillo</strong> como patrimonio oficial del reino, y ordenó que todos los nobles caninos pudieran disfrutarlo una vez al mes en la fuente central.
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