<?php
/*
 * Template Name: Página 404 Personalizada
 */

get_header();
?>

<main class="page-404">
    <h1>Grrrrh! Algo salió mal...</h1>
    <p>Lo siento, noble humano, pero no pudimos encontrar la página que buscas.</p>        
    <a class="volver" href="<?php echo esc_url(home_url('/')); ?>">Volver al inicio</a>
    <img class="trovador-img" src="<?php echo get_template_directory_uri(); ?>/assets/img/perro-trovador-480.webp" alt="Trovador perro" width="240" height="240">
</main>

<?php get_footer(); ?>