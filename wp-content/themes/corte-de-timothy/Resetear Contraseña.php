<?php
/* Template Name: Resetear Contraseña */

get_header();

$login = isset($_GET['login']) ? sanitize_text_field($_GET['login']) : '';
$key   = isset($_GET['key']) ? sanitize_text_field($_GET['key']) : '';

$message = '';
$error = '';

// Validar enlace
if ($login && $key) {
    $user = check_password_reset_key($key, $login);

    if (is_wp_error($user)) {
        $error = 'Enlace de restablecimiento inválido o expirado.';
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_pass1'], $_POST['new_pass2'])) {
        $pass1 = $_POST['new_pass1'];
        $pass2 = $_POST['new_pass2'];

        if (empty($pass1) || empty($pass2)) {
            $error = 'Por favor, rellena ambos campos.';
        } elseif ($pass1 !== $pass2) {
            $error = 'Las contraseñas no coinciden.';
        } else {
            reset_password($user, $pass1);
            $message = 'Tu contraseña ha sido restablecida correctamente. Ya puedes <a class="" href="' . esc_url(home_url('/login')) . '">iniciar sesión</a>.';
        }
    }
} else {
    $error = 'Faltan parámetros en el enlace.';
}
?>

<section class="password-reset-form" role="region" aria-labelledby="reset-heading">
    <h1 id="reset-heading" class="titulo">🔑 Restablecer contraseña</h1>

    <?php if ($message): ?>
        <div class="form-success" role="alert"><?php echo $message; ?></div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="form-error-general" role="alert"><?php echo $error; ?></div>
    <?php endif; ?>

    <?php if ($user instanceof WP_User && !$message): ?>
        <form method="post" aria-label="Formulario para establecer nueva contraseña" novalidate>
            <div class="form-group">
                <label for="new_pass1">Nueva contraseña</label>
                <input type="password" name="new_pass1" id="new_pass1" required>
            </div>
            <div class="form-group">
                <label for="new_pass2">Repetir nueva contraseña</label>
                <input type="password" name="new_pass2" id="new_pass2" required>
            </div>
            <button type="submit">Cambiar contraseña</button>
        </form>
    <?php endif; ?>
</section>

<?php get_footer(); ?>