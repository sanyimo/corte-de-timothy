<?php

/**
 * Template Name: Login
 */

get_header();

$errors = [
    'log' => '',
    'pwd' => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login_nonce']) && wp_verify_nonce($_POST['login_nonce'], 'login_action')) {
    $log_input = trim($_POST['log']);
    $pwd_input = $_POST['pwd'];
    $creds = [
        'user_login'    => '',
        'user_password' => '',
        'remember'      => isset($_POST['login-remember']),
    ];

    // Validación del campo "log" (usuario o correo electrónico)
    if (empty($log_input)) {
        $errors['log'] = 'Debes escribir un usuario o correo.';
    } elseif (is_email($log_input)) {
        $user = get_user_by('email', $log_input);
        if ($user) {
            $creds['user_login'] = $user->user_login;
        } else {
            $errors['log'] = 'No se encontró un usuario con ese correo.';
        }
    } else {
        $creds['user_login'] = sanitize_user($log_input);
        if (!username_exists($creds['user_login'])) {
            $errors['log'] = 'El usuario no existe.';
        }
    }

    // Validación del campo "pwd"
    if (empty($pwd_input)) {
        $errors['pwd'] = 'Debes escribir tu contraseña.';
    } elseif (strlen($pwd_input) < 8) {
        $errors['pwd'] = 'La contraseña debe tener al menos 8 caracteres.';
    } else {
        $creds['user_password'] = $pwd_input;
    }

    // Si no hay errores, intentamos iniciar sesión
    if (!$errors['log'] && !$errors['pwd']) {
        $user = wp_signon($creds, is_ssl());

        if (is_wp_error($user)) {
            $errors['pwd'] = 'La contraseña es incorrecta.';
        } else {
            wp_safe_redirect(home_url('/'));
            exit;
        }
    }
}
?>

<main id="primary" class="main">
    <section role="region" aria-labelledby="login-heading">
        <h1 id="login-heading" class="titulo">👤 Iniciar sesión</h1>

        <?php if (!is_user_logged_in()) : ?>
            <div class="login-form-wrapper">
                <form name="loginform" id="loginform" action="<?php echo esc_url(get_permalink()); ?>" method="post" autocomplete="on" novalidate aria-describedby="form-instructions">
                    <p id="form-instructions" class="sr-only">
                        Todos los campos son obligatorios. Introduce tu usuario y contraseña para acceder.
                    </p>
                    <div class="form-group">
                        <label for="user_login">Nombre de usuario o correo electrónico</label><br>
                        <input
                            type="text"
                            name="log"
                            id="user_login"
                            class="input"
                            value="<?php echo isset($_POST['log']) ? esc_attr($_POST['log']) : ''; ?>"
                            required
                            autocomplete="username"
                            aria-required="true"
                            aria-describedby="user-login-error">
                        <?php if ($errors['log']) : ?>
                            <div id="user-login-error" class="form-errors" role="alert" aria-live="assertive">
                                <?php echo esc_html($errors['log']); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="user_pass">Contraseña</label><br>
                        <input
                            type="password"
                            name="pwd"
                            id="user_pass"
                            class="input"
                            pattern=".{8,}"
                            title="La contraseña debe tener al menos 8 caracteres"
                            autocomplete="current-username"
                            required
                            aria-required="true"
                            aria-describedby="user-pass-error">
                        <?php if ($errors['pwd']) : ?>
                            <div id="user-pass-error" class="form-errors" role="alert" aria-live="assertive">
                                <?php echo esc_html($errors['pwd']); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <p class="login-remember">
                        <label for="login-remember">
                            <input
                                name="login-remember"
                                type="checkbox"
                                id="login-remember"
                                class="checkbox"
                                value="forever"
                                autocomplete="current-password"
                                <?php if (isset($_POST['login-remember'])) echo 'checked'; ?>>
                            Recuérdame
                        </label>
                    </p>

                    <?php wp_nonce_field('login_action', 'login_nonce'); ?>

                    <p class="submit">
                        <input type="submit" name="wp-submit" id="wp-submit" class="button button-primary" value="Iniciar sesión" aria-label="Enviar formulario de inicio de sesión">
                    </p>
                </form>

                <div id="nav">
                    <p>
                        <a class="olvide" href="<?php echo esc_url(get_custom_page_url_by_slug('olvide-mi-contrasena')); ?>" title="Recuperar contraseña">Olvidé mi contraseña</a>
                    </p>
                    <p>
                        ¿No tienes cuenta?
                        <a href="<?php echo esc_url(get_custom_page_url_by_slug('registro')); ?>" title="Ir a la página de registro">Regístrate aquí</a>
                    </p>                   
                </div>
            </div>
        <?php else : ?>
            <p>Ya has iniciado sesión.</p>
        <?php endif; ?>
    </section>
</main>

<?php get_footer(); ?>