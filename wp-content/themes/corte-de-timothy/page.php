<?php get_header(); ?>

<main class="pagina">
    <?php
    if (is_page(['aviso-legal', 'politica-privacidad', 'politica-cookies'])) {
        get_template_part('parts/legal');
    } else {
        get_template_part('template-parts/default');
    }
    ?>
</main>

<?php get_footer(); ?>