<?php get_header(); ?>

<main class="cronica-individual">
    <div class="container">
        <article <?php post_class(); ?>>

            <header class="cronica-titulo">
                <h1><?php the_title(); ?></h1>
                <p class="cronica-meta">
                    🐾 Escrito por <?php the_author(); ?> | 📅 <?php echo get_the_date(); ?>
                </p>
            </header>

            <?php if (has_post_thumbnail()) : ?>
                <div class="cronica-imagen">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?>

            <div class="cronica-contenido">
                <?php the_content(); ?>
            </div>

            <footer class="cronica-footer">
                <?php the_category(' • '); ?>
                <div class="volver-cronicas">
                    <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="btn">
                        ← Volver a las Crónicas
                    </a>
                </div>
            </footer>

        </article>
    </div>
</main>

<?php get_footer(); ?>