<?php
/* Template Name: Verificar Email */

get_header(); ?>

<main id="primary" class="main">

    <?php
    $token = $_GET['token'] ?? '';
    $user_id = $_GET['user'] ?? '';

    if ($token && $user_id) {
        $saved_token = get_user_meta($user_id, 'email_verification_token', true);
        $created = (int) get_user_meta($user_id, 'email_verification_token_created', true);
        $expiry_seconds = 172800; // 48 horas

        if ($saved_token === $token) {
            if ((time() - $created) <= $expiry_seconds) {
                update_user_meta($user_id, 'email_verified', true);
                delete_user_meta($user_id, 'email_verification_token');
                delete_user_meta($user_id, 'email_verification_token_created');
                echo '<p class="success">¡Tu correo ha sido verificado! Ya puedes iniciar sesión.</p>';
            } else {
                echo '<p class="error">El enlace de verificación ha expirado. Por favor, solicita uno nuevo.</p>';
                echo '<p><a href="' . esc_url(home_url('/reenviar-verificacion?user=' . $user_id)) . '">Reenviar correo de verificación</a></p>';
            }
        } else {
            echo '<p class="error">El enlace de verificación no es válido o ha expirado.</p>';
        }
    } else {
        echo '<p class="error">Faltan datos para la verificación.</p>';
    }
    ?>
</main>

<?php get_footer(); ?>