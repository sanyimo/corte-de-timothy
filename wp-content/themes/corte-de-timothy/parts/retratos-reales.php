<?php
$alt = !empty($imagen['alt']) ? $imagen['alt'] : 'Retrato real de un noble canino en el salón de belleza de Timothy I';
?>
<h1 class="retratos__titulo">Retratos de la Corte Canina</h1>
<article class="retratos__seccion retratos__tratamientos">
    <div class="retratos__intro">
        
        <p class="retratos__descripcion">
            Desde las nobles bañeras del Palacio Estético hasta las pasarelas del Reino del Glamour, aquí yace el testimonio visual de la transformación real.
            ¡Contemplad, súbditos, la magnificencia peluda que solo la Casa de Timothy I puede otorgar!
        </p>
    </div>
    <div class="galeria galeria--tratamientos swiper" id="slider-tratamientos">
        <div class="swiper-wrapper">
            <?php for ($i = 1; $i <= 15; $i++): ?>
                <?php $imagen = get_field("imagen_tratamiento_$i"); ?>
                <?php if ($imagen):
                    $alt = !empty($imagen['alt']) ? $imagen['alt'] : 'Retrato de tratamiento canino ' . $i;
                    $img_url = esc_url($imagen['sizes']['large']);
                    $width = $imagen['width'] ?? '';
                    $height = $imagen['height'] ?? '';

                    $srcset = '';
                    if (!empty($imagen['sizes'])) {
                        foreach ($imagen['sizes'] as $size_name => $size_url) {
                            if (strpos($size_name, '-width') === false && strpos($size_name, '-height') === false) {
                                $w_key = $size_name . '-width';
                                $w = isset($imagen['sizes'][$w_key]) ? $imagen['sizes'][$w_key] : 0;
                                if ($w) {
                                    $srcset .= esc_url($size_url) . " {$w}w, ";
                                }
                            }
                        }
                        $srcset = rtrim($srcset, ', ');
                    }
                ?>
                    <div class="swiper-slide">
                        <figure class="marco-dorado">
                            <img
                                src="<?php echo $img_url; ?>"
                                <?php if ($srcset): ?>
                                srcset="<?php echo esc_attr($srcset); ?>"
                                sizes="(max-width: 768px) 100vw, 33vw"
                                <?php endif; ?>
                                alt="<?php echo esc_attr($alt); ?>"
                                loading="lazy"
                                decoding="async"
                                <?php if ($width) echo 'width="' . intval($width) . '"'; ?>
                                <?php if ($height) echo 'height="' . intval($height) . '"'; ?>>
                            <?php if (!empty($imagen['caption'])): ?>
                                <figcaption><?php echo esc_html($imagen['caption']); ?></figcaption>
                            <?php endif; ?>
                        </figure>
                    </div>
                <?php endif; ?>
            <?php endfor; ?>
        </div>

        <!-- Botones de navegación -->
        <div class="swiper-button-prev" id="prev-tratamientos"></div>
        <div class="swiper-button-next" id="next-tratamientos"></div>

        <!-- Paginación opcional -->
        <div class="swiper-pagination" id="paginacion-tratamientos"></div>
    </div>

</article>

<!-- Nueva sección: Antes y Después -->
<article class="retratos__seccion retratos__antes-despues">
    <h3 class="retratos__subtitulo">🌟 Metamorfosis Regia</h3>
    <p class="retratos__texto">¡Contemplad el prodigio! De humildes pelajes a majestuosas coronas de elegancia. Aquí yace el espejo encantado donde cada noble can transformó su esencia ante los ojos del reino.</p>
    <div class="galeria galeria--antes-despues swiper" id="slider-antes-despues">
        <div class="swiper-wrapper">
            <?php for ($i = 1; $i <= 12; $i++): ?>
                <?php
                $imagen = get_field("imagen_antes_despues_$i");
                if ($imagen):
                    $alt = !empty($imagen['alt']) ? $imagen['alt'] : 'Antes y después ' . $i;
                    $img_url = esc_url($imagen['sizes']['large']);
                    $width = $imagen['width'] ?? '';
                    $height = $imagen['height'] ?? '';
                    $srcset = '';
                    if (!empty($imagen['sizes'])) {
                        foreach ($imagen['sizes'] as $size_name => $size_url) {
                            if (strpos($size_name, '-width') === false && strpos($size_name, '-height') === false) {
                                $w_key = $size_name . '-width';
                                $w = $imagen['sizes'][$w_key] ?? 0;
                                if ($w) {
                                    $srcset .= esc_url($size_url) . " {$w}w, ";
                                }
                            }
                        }
                        $srcset = rtrim($srcset, ', ');
                    }
                ?>
                    <div class="swiper-slide">
                        <figure class="marco-dorado">
                            <img
                                src="<?php echo $img_url; ?>"
                                <?php if ($srcset): ?>
                                srcset="<?php echo esc_attr($srcset); ?>"
                                sizes="(max-width: 768px) 100vw, 33vw"
                                <?php endif; ?>
                                alt="<?php echo esc_attr($alt); ?>"
                                loading="lazy"
                                decoding="async"
                                <?php if ($width) echo 'width="' . intval($width) . '"'; ?>
                                <?php if ($height) echo 'height="' . intval($height) . '"'; ?>>
                            <?php if (!empty($imagen['caption'])): ?>
                                <figcaption><?php echo esc_html($imagen['caption']); ?></figcaption>
                            <?php endif; ?>
                        </figure>
                    </div>
                <?php endif; ?>
            <?php endfor; ?>
        </div>
        <div class="swiper-button-prev" id="prev-antes-despues"></div>
        <div class="swiper-button-next" id="next-antes-despues"></div>
        <div class="swiper-pagination" id="paginacion-antes-despues"></div>
    </div>
</article>

<article class="retratos__seccion retratos__resultados">
    <h3 class="retratos__subtitulo">✨ Nuevos Looks para Nobles Pelajes</h3>
    <p class="retratos__texto">He aquí el desfile de nuestros ilustres cortesanos tras su metamorfosis. Coronados por el estilo, perfumados con gloria, y listos para conquistar corazones en cada ladrido.</p>
    <div class="galeria galeria--looks swiper" id="slider-looks">
        <div class="swiper-wrapper">
            <?php for ($i = 1; $i <= 12; $i++): ?>
                <?php
                $imagen = get_field("imagen_look_$i");
                if ($imagen):
                    $alt = !empty($imagen['alt']) ? $imagen['alt'] : 'Look estético ' . $i;
                    $img_url = esc_url($imagen['sizes']['large']);
                    $width = $imagen['width'] ?? '';
                    $height = $imagen['height'] ?? '';
                    $srcset = '';
                    if (!empty($imagen['sizes'])) {
                        foreach ($imagen['sizes'] as $size_name => $size_url) {
                            if (strpos($size_name, '-width') === false && strpos($size_name, '-height') === false) {
                                $w_key = $size_name . '-width';
                                $w = $imagen['sizes'][$w_key] ?? 0;
                                if ($w) {
                                    $srcset .= esc_url($size_url) . " {$w}w, ";
                                }
                            }
                        }
                        $srcset = rtrim($srcset, ', ');
                    }
                ?>
                    <div class="swiper-slide">
                        <figure class="marco-dorado">
                            <img
                                src="<?php echo $img_url; ?>"
                                <?php if ($srcset): ?>
                                srcset="<?php echo esc_attr($srcset); ?>"
                                sizes="(max-width: 768px) 100vw, 33vw"
                                <?php endif; ?>
                                alt="<?php echo esc_attr($alt); ?>"
                                loading="lazy"
                                decoding="async"
                                <?php if ($width) echo 'width="' . intval($width) . '"'; ?>
                                <?php if ($height) echo 'height="' . intval($height) . '"'; ?>>
                            <?php if (!empty($imagen['caption'])): ?>
                                <figcaption><?php echo esc_html($imagen['caption']); ?></figcaption>
                            <?php endif; ?>
                        </figure>
                    </div>
                <?php endif; ?>
            <?php endfor; ?>
        </div>
        <div class="swiper-button-prev" id="prev-looks"></div>
        <div class="swiper-button-next" id="next-looks"></div>
        <div class="swiper-pagination" id="paginacion-looks"></div>
    </div>
</article>

<blockquote class="retratos__cierre" aria-label="Cita de Timothy I">
    “En mi Reino, la belleza no se negocia. Se honra, se perfuma y se retrata.”
    <span class="retratos__firma">— Su Majestad Timothy I</span>
</blockquote>
