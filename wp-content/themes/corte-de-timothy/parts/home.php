<div class="main-wrapper">
    <h1>
        <?php echo get_field('hero_titulo') ? get_field('hero_titulo') : '<span class="blanco">¡Bienvenidos</span> <span class="blanco">al reino de la</span>  <span class="blanco">elegancia canina!</span>'; ?>
    </h1>
    <section class="hero">
        <picture>
            <source
                srcset="<?php echo get_template_directory_uri(); ?>/assets/img/Timothy-1024.webp"
                media="(min-width: 1024px)">
            <source
                srcset="<?php echo get_template_directory_uri(); ?>/assets/img/Timothy-768.webp"
                media="(min-width: 600px)">
            <img
                src="<?php echo get_template_directory_uri(); ?>/assets/img/Timothy-480.webp"
                alt="Retrato de Timothy"
                width="480"
                height="480"
                loading="lazy">
        </picture>
        <div class=" container hero-content">
            <p>
                <?php echo get_field('hero_linea_1') ? get_field('hero_linea_1') : 'Soy <strong>Timothy</strong>,'; ?>
            </p>
            <p>
                <?php echo get_field('hero_linea_2') ? get_field('hero_linea_2') : 'un pomerania de sangre real, y esta es mi'; ?>
            </p>
            <p>
                <span class="diamante">💎</span><strong><?php echo get_field('hero_linea_diamante') ? get_field('hero_linea_diamante') : 'CORTE'; ?></strong><span class="diamante">💎</span>:
            </p>
            <p>
                <?php echo get_field('hero_linea_3') ? get_field('hero_linea_3') : 'donde los perritos reciben tratamientos dignos de realeza.'; ?>
            </p>
            <br>
            <p>
                <?php echo get_field('hero_parrafo') ? get_field('hero_parrafo') : 'Los baños huelen a gloria, los cortes son dignos de la nobleza, y las galletitas... uh, las galletitas.'; ?>
            </p>
            <a href="<?php echo get_field('hero_boton_url') ? get_field('hero_boton_url') : '/servicios'; ?>" aria-label="Explora los servicios de Timothy" class="btn btn-servicios">
                <?php echo get_field('hero_boton_texto') ? get_field('hero_boton_texto') : 'Explora mis dominios'; ?>
            </a>
        </div>
    </section>

    <section class="servicios">
        <div class="container">
            <h2>
                <?php echo get_field('servicios_titulo') ? get_field('servicios_titulo') : 'Mis servicios reales'; ?>
            </h2>
            <div class="servicios-grid">
                <div class="servicio">
                    <h3>
                        <span>🐾</span>
                        <?php echo get_field('servicio_1_titulo') ? get_field('servicio_1_titulo') : 'Corte imperial'; ?>
                        <span>✂</span>
                    </h3>
                    <p>
                        <?php echo get_field('servicio_1_texto') ? get_field('servicio_1_texto') : 'Estilo personalizado digno de tu linaje. Cada mechón será tratado con la elegancia que mereces.'; ?>
                    </p>
                </div>
                <div class="servicio">
                    <h3>
                        <span>🛁</span>
                        <?php echo get_field('servicio_2_titulo') ? get_field('servicio_2_titulo') : 'Spa del trono'; ?>
                        <span>🫧</span>
                    </h3>
                    <p>
                        <?php echo get_field('servicio_2_texto') ? get_field('servicio_2_texto') : 'Sumérgete en baños de nobleza con esencias naturales. Saldrás relajado, perfumado y listo para tu cortejo.'; ?>
                    </p>
                </div>
                <div class="servicio">
                    <h3>
                        <span>💅</span>
                        <?php echo get_field('servicio_3_titulo') ? get_field('servicio_3_titulo') : 'Uñas de noble'; ?>
                        <span>🖌</span>
                    </h3>
                    <p>
                        <?php echo get_field('servicio_3_texto') ? get_field('servicio_3_texto') : 'Tus patas tocarán el suelo como un auténtico aristocánido. Corte preciso y trato regio garantizado.'; ?>
                    </p>
                </div>

                <div class="servicio">
                    <h3>
                        <span>🚐</span>
                        <?php echo get_field('servicio_4_titulo') ? get_field('servicio_4_titulo') : 'Trono móvil'; ?>
                        <span>👑</span>
                    </h3>
                    <p>
                        <?php echo get_field('servicio_4_texto') ? get_field('servicio_4_texto') : '¿Te cuesta venir a mi Corte, noble amig@? No te preocupes.Enviaré mi carruaje real a por ti.'; ?>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="mascota-del-mes">
        <div class="container">
            <h2>
                <?php echo get_field('mascota_mes_titulo') ? get_field('mascota_mes_titulo') : 'Los Marqueses del Mes'; ?>
            </h2>
            <p>
                <?php echo get_field('mascota_mes_parrafo_1') ? get_field('mascota_mes_parrafo_1') : 'Cada luna nueva, otorgo el título de <strong>Marqués</strong> y <strong>Marquesa</strong> a la pareja más elegante y distinguida que ha pasado por mi Corte.'; ?>
            </p>
            <p>
                <?php echo get_field('mascota_mes_parrafo_2') ? get_field('mascota_mes_parrafo_2') : 'Belleza, porte y una pizca de travesura real... ¡conócelos!'; ?>
            </p>
            <a href="<?php echo get_field('mascota_mes_boton_url') ? get_field('mascota_mes_boton_url') : '/retratos'; ?>" class="btn btn-marques">
                <?php echo get_field('mascota_mes_boton_texto') ? get_field('mascota_mes_boton_texto') : 'Ver retratos nobles'; ?>
            </a>
        </div>
    </section>

    <!-- Retratos del Corte -->
    <section class="galeria-corte">
        <div class="container">
            <h2>Retratos del Corte</h2>
            <p class="intro"><?php the_field('galeria_intro'); ?></p>
            <div class="galeria-grid">
                <?php
                $marques = get_field('marques_del_mes');
                $marquesa = get_field('marquesa_del_mes');

                for ($i = 1; $i <= 4; $i++) {
                    $img_field = get_field("galeria_{$i}_img");  // campo imagen ACF
                    $nombre = get_field("galeria_{$i}_nombre") ?: 'Retrato sin nombre';

                    if (is_array($img_field) && !empty($img_field['url'])) {
                        $alt = !empty($img_field['alt']) ? $img_field['alt'] : 'Retrato de ' . $nombre;
                        $img_url = $img_field['url'];
                        $img_width = $img_field['width'];
                        $img_height = $img_field['height'];

                        // Construimos el srcset usando todos los tamaños disponibles
                        $srcset = '';
                        if (!empty($img_field['sizes']) && is_array($img_field['sizes'])) {
                            foreach ($img_field['sizes'] as $size_name => $size_url) {
                                // Los nombres de clave terminan en -width o -height, los ignoramos
                                if (strpos($size_name, '-width') === false && strpos($size_name, '-height') === false) {
                                    // Obtenemos el ancho para este tamaño
                                    $width_key = $size_name . '-width';
                                    $width = isset($img_field['sizes'][$width_key]) ? $img_field['sizes'][$width_key] : 0;
                                    if ($width) {
                                        $srcset .= esc_url($size_url) . " {$width}w, ";
                                    }
                                }
                            }
                            $srcset = rtrim($srcset, ', ');
                        }
                    } else {
                        // Fallback a imagen local si no hay imagen en ACF
                        $fallback_imgs = [
                            1 => 'Canelle.webp',
                            2 => 'Rex-mancha.webp',
                            3 => 'Nube.webp',
                            4 => 'Trufon.webp'
                        ];
                        $img_url = get_template_directory_uri() . '/assets/img/' . ($fallback_imgs[$i] ?? 'default.webp');
                        $alt = 'Retrato de ' . $nombre;
                        $img_width = '';
                        $img_height = '';
                        $srcset = '';
                    }
                ?>
                    <figure class="animado">
                        <img
                            src="<?php echo esc_url($img_url); ?>"
                            <?php if ($srcset) : ?>
                            srcset="<?php echo $srcset; ?>"
                            sizes="(max-width: 768px) 100vw, 33vw"
                            <?php endif; ?>
                            alt="<?php echo esc_attr($alt); ?>"
                            loading="lazy"
                            decoding="async"
                            <?php if ($img_width) echo 'width="' . intval($img_width) . '"'; ?>
                            <?php if ($img_height) echo 'height="' . intval($img_height) . '"'; ?>>

                        <?php if ($i == $marques || $i == $marquesa) : ?>
                            <div class="insignia-marquesa">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/insignia-marqueses.webp" alt="Insignia de título noble"
                                    loading="lazy"
                                    decoding="async"
                                    width="100"
                                    height="100">
                            </div>
                        <?php endif; ?>

                        <figcaption><?php echo esc_html($nombre); ?></figcaption>
                    </figure>
                <?php } ?>
            </div>


            <div class="galeria-btn">
                <a href="<?php the_field('galeria_boton_url'); ?>" class="btn btn-explorar"><?php the_field('galeria_boton_texto'); ?></a>
            </div>
        </div>
    </section>

    <aside class="aside-home">
        <!-- Testimonios reales -->
        <section class="testimonios-reales">
            <div class="container">
                <h2>
                    <?php echo get_field('testimonios_titulo') ?: 'Testimonios reales de la nobleza canina'; ?>
                </h2>
                <div class="testimonios-grid">
                    <?php
                    $max_testimonios = 20;
                    $has_testimonios = false;

                    for ($i = 1; $i <= $max_testimonios; $i++) {
                        $texto = get_field("testimonio_{$i}_texto");
                        $autor = get_field("testimonio_{$i}_autor");

                        if ($texto) {
                            $has_testimonios = true;
                    ?>
                            <blockquote>
                                <p><?php echo esc_html($texto); ?></p>
                                <cite>— <?php echo esc_html($autor ?: 'Anónimo'); ?></cite>
                            </blockquote>
                        <?php
                        }
                    }

                    if (!$has_testimonios) {
                        // fallback fijo si no hay ninguno definido
                        $default_testimonios = [
                            ['texto' => '“Jamás imaginé que saldría oliendo a lavanda imperial. ¡Ladridos de aprobación!”', 'autor' => 'Lady Frambuesa, Caniche de la alta Provenza'],
                            ['texto' => '“Me lamí las patas durante horas. Tan suaves como terciopelo.”', 'autor' => 'Sir Pelusín III, Yorkshire distinguido'],
                            ['texto' => '“El carruaje llegó puntual. Servicio de primera, digno de un duque.”', 'autor' => 'Don Bigotes, Mestizo con linaje misterioso']
                        ];
                        foreach ($default_testimonios as $testimonio) : ?>
                            <blockquote>
                                <p><?php echo esc_html($testimonio['texto']); ?></p>
                                <cite>— <?php echo esc_html($testimonio['autor']); ?></cite>
                            </blockquote>
                    <?php endforeach;
                    }
                    ?>
                </div>
            </div>
        </section>

        <!-- ¿Sabías que...? -->
        <section class="sabias-que">
            <div class="container">
                <h2 class="sabias-que__titulo">
                    <?php echo get_field('sabias_que_titulo') ?: '¿Sabías que…?'; ?>
                </h2>
                <ul>
                    <?php
                    $max_items = 20;
                    $has_items = false;

                    for ($i = 1; $i <= $max_items; $i++) {
                        $icono = get_field("sabias_que_{$i}_icono");
                        $texto = get_field("sabias_que_{$i}_texto");

                        if ($texto) {
                            $has_items = true;
                    ?>
                            <li><span><?php echo esc_html($icono ?: '•'); ?></span> <?php echo esc_html($texto); ?></li>
                        <?php
                        }
                    }

                    if (!$has_items) {
                        // fallback fijo si no hay ninguno definido
                        $default_items = [
                            ['icono' => '✂', 'texto' => 'Un buen corte mejora el estado de ánimo (Timothy lo aprueba).'],
                            ['icono' => '💎', 'texto' => 'Las esencias naturales ayudan a repeler a plebeyos (y pulgas).'],
                            ['icono' => '👑', 'texto' => 'Un pero bien peinado recibe más caricias por minuto.'],
                        ];
                        foreach ($default_items as $item): ?>
                            <li><span><?php echo esc_html($item['icono']); ?></span> <?php echo esc_html($item['texto']); ?></li>
                    <?php endforeach;
                    }
                    ?>
                </ul>
            </div>
        </section>
    </aside>


    <section class="cta">
        <h2 class="cta__titulo">
            <?php echo get_field('cta_titulo') ? get_field('cta_titulo') : '¿List@ para una transformación?'; ?>
        </h2>
        <a href="<?php echo get_field('cta_boton_url') ? get_field('cta_boton_url') : '/contacto'; ?>" class="btn btn-reservar">
            <?php echo get_field('cta_boton_texto') ? get_field('cta_boton_texto') : 'Reserva tu cita ahora'; ?>
        </a>
    </section>
</div>