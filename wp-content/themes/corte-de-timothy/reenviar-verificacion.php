<?php
/* Template Name: Reenviar Verificación */

get_header();

$user_id = isset($_GET['user']) ? intval($_GET['user']) : 0;

if (!$user_id) {
    echo '<p class="error">Usuario no válido.</p>';
    get_footer();
    exit;
}

$user = get_user_by('ID', $user_id);
if (!$user) {
    echo '<p class="error">Usuario no encontrado.</p>';
    get_footer();
    exit;
}

$message = '';
$error = '';

// Manejar envío del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['resend_verification'])) {
    $now = time();
    $last_sent = (int) get_user_meta($user_id, 'last_verification_email_sent', true);
    $wait_seconds = 60; // tiempo mínimo entre reenvíos
    $remaining = max(0, $wait_seconds - ($now - $last_sent));

    if (($now - $last_sent) < $wait_seconds) {
        $remaining = $wait_seconds - ($now - $last_sent);
        $error = "Por favor, espera {$remaining} segundos antes de reenviar el correo.";
    } else {
        $new_token = wp_generate_password(32, false);
        update_user_meta($user_id, 'email_verification_token', $new_token);
        update_user_meta($user_id, 'email_verification_token_created', $now);
        update_user_meta($user_id, 'email_verified', false);
        update_user_meta($user_id, 'last_verification_email_sent', $now);

        $verify_url = add_query_arg([
            'verificar_email' => '1',
            'token' => $new_token,
            'user' => $user_id,
        ], home_url('/verificar-email'));

        $subject = 'Reenvío: Confirma tu correo electrónico';
        $message_body = "Hola {$user->user_login},\n\nHas solicitado un nuevo enlace de verificación.\n\nHaz clic aquí para verificar tu correo:\n\n$verify_url";

        $headers = ['Content-Type: text/plain; charset=UTF-8'];

        if (wp_mail($user->user_email, $subject, $message_body, $headers)) {
            $message = 'Correo de verificación reenviado. Revisa tu bandeja de entrada.';
        } else {
            $error = 'Error al enviar el correo. Inténtalo más tarde.';
        }
    }
}
?>

<main class="main">
    <h1>📩 Reenviar correo de verificación</h1>

    <?php if ($message): ?>
        <div class="form-success" role="alert" aria-live="polite">
            <?php echo esc_html($message); ?>
        </div>
    <?php elseif ($error): ?>
        <div class="form-error-general" role="alert" aria-live="assertive">
            <?php echo esc_html($error); ?>
        </div>
    <?php endif; ?>

    <form method="post" aria-label="Formulario para reenviar correo de verificación">
        <p>¿Quieres que te enviemos otro correo para verificar tu cuenta?</p>
        <button
            type="submit"
            name="resend_verification"
            id="resend-button"
            <?php echo $remaining > 0 ? 'disabled' : ''; ?>>
            <?php echo $remaining > 0 ? "Reintentar en {$remaining}s" : 'Reenviar correo de verificación'; ?>
        </button>
    </form>

    <script>
        (function() {
            const button = document.getElementById('resend-button');
            let remaining = <?php echo $remaining; ?>;
            if (remaining <= 0) return;

            const interval = setInterval(() => {
                remaining--;
                if (remaining > 0) {
                    button.textContent = `Reintentar en ${remaining}s`;
                    button.disabled = true;
                } else {
                    button.textContent = 'Reenviar correo de verificación';
                    button.disabled = false;
                    clearInterval(interval);
                }
            }, 1000);
        })();
    </script>
</main>


<?php get_footer(); ?>