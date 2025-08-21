<?php

$message = '';
$error = '';

if (!is_user_logged_in()) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password_reset_nonce']) && wp_verify_nonce($_POST['password_reset_nonce'], 'password_reset_action')) {
        $input = trim($_POST['user_login']);
        $user = false;

        if (empty($input)) {
            $error = 'Por favor, introduce tu nombre de usuario o correo electrónico.';
        } elseif (is_email($input)) {
            $user = get_user_by('email', $input);
        } else {
            $user = get_user_by('login', sanitize_user($input));
        }

        if ($user) {
            $reset = retrieve_password($user->user_login);
            if ($reset === true) {
                $message = 'Se ha enviado un enlace de restablecimiento a tu correo.';
            } else {
                $error = 'No se pudo enviar el correo. Inténtalo más tarde.';
            }
        } elseif (!$error) {
            $error = 'Usuario no encontrado.';
        }
    }
}
?>

<main>
        <section role="region" aria-labelledby="recovery-heading">
        <h1 id="recovery-heading" class="titulo">🔒 Recuperar contraseña</h1>
        <?php if (!is_user_logged_in()) { ?>
            <div class="password-reset-form">
                <form method="post" action="<?php echo esc_url(get_permalink()); ?>" aria-describedby="form-instructions" novalidate>
                    <p id="form-instructions" class="sr-only">Introduce tu nombre de usuario o correo electrónico. Te enviaremos un enlace para restablecer tu contraseña.</p>
                    <div class="form-group">
                        <label for="user_login">Introduce tu nombre de usuario o correo electrónico</label>
                        <input
                            type="text"
                            name="user_login"
                            id="user_login"
                            class="input"
                            required
                            aria-required="true"
                            aria-describedby="user-login-help"
                            autocomplete="username"
                            value="<?php echo ($message || !$error) ? '' : esc_attr($_POST['user_login'] ?? ''); ?>">
                        <?php wp_nonce_field('password_reset_action', 'password_reset_nonce'); ?>

                        <p class="submit">
                            <button type="submit" name="wp-submit" class="button button-primary">
                                Enviar enlace de restablecimiento
                            </button>
                        </p>
                    </div>
                </form>

                <?php if ($message) : ?>
                    <div class="form-success" role="alert" aria-live="polite">
                        <?php echo esc_html($message); ?>
                    </div>
                <?php elseif ($error) : ?>
                    <div class="form-error-general" role="alert" aria-live="assertive">
                        <?php echo esc_html($error); ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php } ?>
    </section>
</main>
