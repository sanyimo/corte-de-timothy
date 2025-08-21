<?php
$img_mapa = get_field('dominios__mapa-img');
$img_corte = get_field('img_corte');
$img_bano = get_field('img_bano');
$img_unas = get_field('img_unas');
$img_belleza = get_field('img_belleza');
?>
<div>
    <h1 class="dominios__titulo titulo-blanco">🌟 Las Tierras del Reino 🐾</h1>
    <p class="dominios__intro">
        Recorre los dominios sagrados donde cada cola mueve historia y cada pata pisa con honra.
    </p>
</div>

<div class="dominios__zonas">
    <article class="dominio">
        <h2 class="dominio__titulo">🛁 Baños Reales</h2>
        <h3 class="dominio__subtitulo">Burbujas con secretos mágicos</h3>
        <p class="dominio__descripcion">
            Las aguas de este santuario han sido encantadas por generaciones de sabuesos sabios. Aquí los baños son rituales, las esencias relajan cuerpo y alma, y los masajes desatan los sueños más suaves de la realeza peluda.
        </p>
        <?php the_acf_image($img_bano, 'Baños Reales', 'dominio__imagen'); ?>
    </article>

    <article class="dominio">
        <h2 class="dominio__titulo">✂️ Salón de Corte Fino</h3>
        <h3 class="dominio__subtitulo">Donde nacen peinados legendarios</h3>
        <p class="dominio__descripcion">
            En este salón de élite, el arte del estilismo alcanza su punto más alto. Cada corte es una ceremonia, cada mechón cae con propósito. Solo las garras más diestras, bendecidas por Timothy, operan aquí.
        </p>
        <?php the_acf_image($img_corte, 'Salón de Corte Fino', 'dominio__imagen'); ?>
    </article>

    <article class="dominio">
        <h2 class="dominio__titulo">🎨 Torre del Esmalte</h2>
        <h3 class="dominio__subtitulo">Doncellas en embellecimiento</h3>
        <p class="dominio__descripcion">
            En lo alto de esta torre mística, los retoques son actos de nobleza. Las uñas relucen como joyas reales, los detalles brillan con encanto y cada toque de color es un hechizo visual para enamorar.
        </p>
        <?php the_acf_image($img_unas, 'Torre del Esmalte', 'dominio__imagen'); ?>
    </article>

    <article class="dominio">
        <h2 class="dominio__titulo">🌸 Jardín de Aromas</h2>
        <h3 class="dominio__subtitulo">Fragancias dignas de realeza</h3>
        <p class="dominio__descripcion">
            Este jardín florece con perfumes traídos de los confines del reino. Cada flor tiene un propósito, cada fragancia, una historia. Solo quien pisa con dignidad puede salir perfumado por su bendición.
        </p>
        <?php the_acf_image($img_belleza, 'Jardín de Aromas', 'dominio__imagen'); ?>
    </article>

</div>

<div class="dominios__mapa">
    <h2 class="titulo-blanco">📍 Mapa del Reino</h2>
    <p>Ubica los dominios encantados donde Timothy extiende su influencia:</p>
    <?php the_acf_image($img_mapa, 'Mapa del Reino', 'dominios__mapa-img'); ?>
</div>

<section class="reino__ubicacion">
    <h2>📍 El Palacio Terrenal de Timothy</h2>
    <p class="reino__ubicacion-texto">
        <em>
            “Muchos me preguntan dónde se encuentra mi Corte Real. Pues bien, nobles peluditos y humanos del reino: tras el Bosque del Champú y antes del Sendero del Secador, encontraréis mi Palacio Terrenal. Allí os recibiré con trono acolchado, caricias infinitas y chuches de la más alta nobleza.”
        </em>
    </p>

    <div class="reino__mapa">
        <iframe
            src=" https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3079.9793343542055!2d-0.37962812312569044!3d39.46979557160742!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd6048ad7bf45aab%3A0x2ba4baea5a36e1e2!2sAyuntamiento%20de%20Valencia!5e0!3m2!1ses!2ses!4v1750927123925!5m2!1ses!2ses"
            title="Mapa del saló Corte de Timothy" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
        </iframe>
        </iframe>
    </div>
</section>