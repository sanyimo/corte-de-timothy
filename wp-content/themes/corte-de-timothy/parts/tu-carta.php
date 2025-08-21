<h1 class="contacto__titulo titulo-blanco">📜 Tu Carta Real</h1>
<section class="contacto-intro" aria-label="Introducción a la carta real">
    <p>
        Has llegado a las puertas de <strong>Corte de Timothy</strong>. Si deseas una audiencia con su majestad Timothy, rey del cepillo y defensor del buen peinado, este es el momento de escribir tu carta real. 📯
    </p>
    <p>
        Ya sea para concertar una cita, enviar saludos desde un reino lejano o proponer alianzas nobles, Timothy recibirá tu mensaje con orejas atentas y corona en alto.
    </p>
    <p>
        Redacta tu misiva con elegancia y pulsa “Enviar”. Un emisario real se pondrá en contacto contigo en menos de lo que canta un canario.
    </p>
</section>

<section class="resenas">
    <div class="valoraciones-corte">
        <h2>💬 Valoraciones del Reino</h2>
        <p>Los nobles han hablado:</p>
        <!-- Mostrar reseñas -->
        <?php echo do_shortcode('[site_reviews assigned_to="post_id"]'); ?>
    </div>
    <div class="valoracion-formulario">
        <h3>✒️ Escribe tu reseña</h3>

        <?php if (is_user_logged_in()) : ?>
            <?php echo do_shortcode('[site_reviews_form assign_to="post_id"]'); ?>
        <?php else : ?>
            <p class="centrado">Por favor, <a href="/login">inicia sesión</a> o <a href="/registro">registrate</a> para dejar un comentario.</p>
        <?php endif; ?>
    </div>
</section>

<section class="citas-reales">
    <h2>📅 Pedir Audiencia con Timothy</h2>
    
    <?php if (is_user_logged_in()) : ?>
        <p>Solicita tu cita real directamente aquí:</p>
        <?php echo do_shortcode('[ssa_booking]'); ?>
    <?php else : ?>
        <p class="centrado">Por favor, <a href="/login">inicia sesión</a> o <a href="/registro">registrate</a> para pedir cita</p>
    <?php endif; ?>

</section>

<section class="contacto-llamada" aria-label="Llamada al trono">
    <h2>📯 Una llamada al trono</h2>
    <p>
        Si tu mensaje es urgente, o simplemente prefieres anunciarte con trompetas, puedes llamar directamente al castillo.
        Mi noble secretaria atenderá con la elegancia que merece tu linaje.
    </p>
    <a href="tel:+34987654321" class="boton-llamada" aria-label="Llamar a la Corte de Timothy al número 987 654 321">
        📞 Llamar a la Corte: 987 654 321
    </a>
</section>

<section class="contacto-formulario" aria-label="Formulario para enviar carta real">
    <h2 id="titulo-formulario-contacto">Envía tu carta a la Corte de Timothy</h2>
    <?php if (isset($_GET['enviado']) && $_GET['enviado'] == 1): ?>
        <p class="form-success" role="status" tabindex="-1">✅ ¡Tu carta ha sido enviada con éxito! 👑</p>
    <?php endif; ?>
    <form action="<?= esc_url(admin_url('admin-post.php')); ?>" method="post" class="formulario">
        <input type="hidden" name="action" value="enviar_carta_timothy">
        <?php wp_nonce_field('enviar_carta_timothy_nonce', 'seguridad_carta_timothy'); ?>
        <div>
            <label for="nombre">Nombre del remitente</label>
            <input type="text" id="nombre" name="nombre" required aria-required="true" aria-describedby="nombreHelp" />
            <small id="nombreHelp" class="sr-only">Introduce tu nombre completo</small>
        </div>

        <div>
            <label for="email">Correo del reino</label>
            <input type="email" id="email" name="email" required aria-required="true" aria-describedby="emailHelp" />
            <small id="emailHelp" class="sr-only">Introduce una dirección de correo válida</small>
        </div>

        <div>
            <label for="mensaje">Tu carta a su majestad</label>
            <textarea id="mensaje" name="mensaje" rows="6" required aria-required="true" aria-describedby="mensajeHelp"></textarea>
            <small id="mensajeHelp" class="sr-only">Redacta aquí tu mensaje para Timothy</small>
        </div>

        <button type="submit" class="btn btn-servicios" aria-label="Enviar carta a la Corte de Timothy">📨 Enviar a la Corte</button>
    </form>
</section>