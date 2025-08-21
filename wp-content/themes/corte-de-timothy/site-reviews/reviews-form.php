<?php defined('ABSPATH') || exit; ?>

<div class="glsr-form-wrap">
    <form class="{{ class }}" method="post" enctype="multipart/form-data">
        {{ fields }}
        {{ response }}
        <button type="submit" class=" btn glsr-submit ">
  <?php esc_html_e( 'Enviar comentario', 'site-reviews' ); ?>
</button>

    </form>
</div>
