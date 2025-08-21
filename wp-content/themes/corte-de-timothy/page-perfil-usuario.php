<?php
/*
Template Name: Perfil Usuario
*/
get_header();

if (! is_user_logged_in()) {
    wp_redirect(get_custom_page_url_by_slug('login'));
    exit;
}

session_start();

$current_user = wp_get_current_user();

$errors = [
    'profile' => [],
    'pet' => [],
    'password' => [],
];
$success = [
    'profile' => false,
    'pet' => false,
    'password' => false,
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Perfil personal
    if (isset($_POST['update_profile'])) {
        $current_user = wp_get_current_user();
        if (!$current_user || $current_user->ID === 0) {
            $errors['not-logged-in'] = 'Debes iniciar sesión para editar tu perfil.';
        } else {
            $user_id = get_current_user_id();
            $full_name = trim($_POST['full_name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $phone = trim($_POST['phone'] ?? '');

            if (empty($display_name)) {
                $errors['profile']['display_name'] = 'El nombre mostrado no puede estar vacío.';
            }

            if (empty($email) || !is_email($email)) {
                $errors['email'] = 'Introduce un email válido.';
            }

            if ($phone !== '' && !preg_match('/^\+?[0-9\s\-]{6,20}$/', $phone)) {
                $errors['profile']['phone'] = 'El teléfono no es válido.';
            }

            if (empty($errors['profile'])) {
                $update_result = wp_update_user([
                    'ID' => $current_user->ID,
                    'user_email' => $email,
                ]);
                if (is_wp_error($update_result)) {
                    $errors['update-error'] = 'Error al actualizar el perfil.';
                } else {
                    // ✅ Guardar campos personalizados
                    update_user_meta($user_id, 'phone', $phone);
                    update_user_meta($user_id, 'full_name', $full_name); // opcional, si quieres mantenerlo por separado

                    update_user_meta($user_id, 'pet_name', $pet_name);
                    update_user_meta($user_id, 'pet_breed', $pet_breed);
                    update_user_meta($user_id, 'pet_age', $pet_age);
                    update_user_meta($user_id, 'pet_notes', $pet_notes);


                    $success['profile'] = true;
                    // Refrescar para mostrar datos actualizados
                    $current_user = wp_get_current_user();
                }
            }
        }
    }

    // Perfil mascota
    if (isset($_POST['update_pet'])) {
        $pet_name = trim($_POST['pet_name'] ?? '');
        $pet_breed = trim($_POST['pet_breed'] ?? '');
        $pet_sex = trim($_POST['pet_sex'] ?? '');
        $pet_age = trim($_POST['pet_age'] ?? '');

        if ($pet_name === '') $errors['pet']['pet_name'] = 'El nombre de la mascota es obligatorio.';
        if ($pet_breed === '') $errors['pet']['pet_breed'] = 'La raza es obligatoria.';
        if ($pet_sex !== 'macho' && $pet_sex !== 'hembra') $errors['pet']['pet_sex'] = 'Selecciona el sexo.';
        if ($pet_age === '' || !is_numeric($pet_age) || $pet_age < 0 || $pet_age > 50) $errors['pet']['pet_age'] = 'La edad debe ser un número válido entre 0 y 50.';

        if (empty($errors['pet'])) {
            update_user_meta($current_user->ID, 'pet_name', sanitize_text_field($pet_name));
            update_user_meta($current_user->ID, 'pet_breed', sanitize_text_field($pet_breed));
            update_user_meta($current_user->ID, 'pet_sex', sanitize_text_field($pet_sex));
            update_user_meta($current_user->ID, 'pet_age', intval($pet_age));

            $success['pet'] = true;
        }
    }

    // Cambio de contraseña
    if (isset($_POST['change_password'])) {
        $current_pass = $_POST['password_current'] ?? '';
        $new_pass = $_POST['password_new'] ?? '';
        $confirm_pass = $_POST['password_confirm'] ?? '';

        if (!wp_check_password($current_pass, $current_user->user_pass, $current_user->ID)) {
            $errors['password']['password_current'] = 'La contraseña actual no es correcta.';
        }
        if (strlen($new_pass) < 6) {
            $errors['password']['password_new'] = 'La nueva contraseña debe tener al menos 6 caracteres.';
        }
        if ($new_pass !== $confirm_pass) {
            $errors['password']['password_confirm'] = 'Las contraseñas no coinciden.';
        }

        if (empty($errors['password'])) {
            wp_set_password($new_pass, $current_user->ID);
            $success['password'] = true;
            // Después de cambiar la contraseña, se cierra sesión automáticamente
            wp_logout();
            wp_redirect(get_custom_page_url_by_slug('login'));
            exit;
        }
    }

    if (isset($_POST['delete_profile'])) {
        // Solo permitir eliminar si está logueado
        if (is_user_logged_in()) {
            $user_id = get_current_user_id();

            // Eliminar datos relacionados si tienes personalizados
            delete_user_meta($user_id, 'phone');
            delete_user_meta($user_id, 'full_name');
            delete_user_meta($user_id, 'pet_name');
            delete_user_meta($user_id, 'pet_breed');
            delete_user_meta($user_id, 'pet_sex');
            delete_user_meta($user_id, 'pet_age');
            delete_user_meta($user_id, 'pet_notes');

            // Eliminar el usuario de WordPress
            require_once(ABSPATH . 'wp-admin/includes/user.php');
            wp_delete_user($user_id);

            // Destruir sesión y redirigir
            wp_logout();
            wp_redirect(get_custom_page_url_by_slug('/'));
            exit;
        } else {
            $errors['profile'][] = 'Debes estar logueado para eliminar tu perfil.';
        }
    }
}

$active_panel = 'perfil'; // valor por defecto

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_profile'])) {
        // ... código perfil
        $active_panel = 'perfil';
    } elseif (isset($_POST['update_pet'])) {
        // ... código mascota
        $active_panel = 'mascota';
    } elseif (isset($_POST['change_password'])) {
        // ... código contraseña
        $active_panel = 'ajustes';
    }
} else {
    $active_panel = 'perfil'; // o lo que quieras por defecto
}


// Si necesitas datos mascota, tienes que obtenerlos de la base de datos, por ejemplo usando usermeta
$pet_name = get_user_meta($current_user->ID, 'pet_name', true);
$pet_breed = get_user_meta($current_user->ID, 'pet_breed', true);
$pet_sex = get_user_meta($current_user->ID, 'pet_sex', true);
$pet_age = get_user_meta($current_user->ID, 'pet_age', true);

// Aquí iría la lógica para guardar cambios al enviar formularios. Por claridad, no la incluyo ahora.

?>

<main class="perfil-usuario-container">
    <aside class="perfil-menu-lateral" role="navigation" aria-label="Menú de perfil de usuario">
        <ul>
            <li><button class="perfil-menu-btn <?php echo ($active_panel === 'perfil') ? 'active' : ''; ?>" data-panel="perfil">Mi perfil</button></li>
            <li><button class="perfil-menu-btn <?php echo ($active_panel === 'mascota') ? 'active' : ''; ?>" data-panel="mascota">Perfil mascota</button></li>
            <li><button class="perfil-menu-btn <?php echo ($active_panel === 'citas') ? 'active' : ''; ?>" data-panel="citas">Citas</button></li>
            <li><button class="perfil-menu-btn <?php echo ($active_panel === 'ajustes') ? 'active' : ''; ?>" data-panel="ajustes">Ajustes</button></li>
            <li><button type="button" id="cerrar-sesion" class="cerrar-sesion">Cerrar sesión</button></li>
        </ul>

    </aside>

    <section class="perfil-paneles">
        <section id="perfil" class="perfil-panel <?php echo ($active_panel === 'perfil') ? 'activo' : ''; ?>" aria-labelledby="perfil-title">
            <h2 id="perfil-title">Mi perfil</h2>
            <form method="post" novalidate>
                <div class="form-group">
                    <label for="display_name">Nombre completo</label>
                    <input type="text" id="display_name" name="display_name" value="<?php echo esc_attr($current_user->display_name); ?>" required>
                    <?php if (!empty($errors['profile']['display_name'])): ?>
                        <div class="form-errors"><?php echo esc_html($errors['profile']['display_name']); ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="display_name">Nombre de usuario</label>
                    <input type="text" id="username" name="username" value="<?php echo esc_attr($current_user->user_login); ?>" required>
                    <?php if (!empty($errors['profile']['username'])): ?>
                        <div class="form-errors"><?php echo esc_html($errors['profile']['username']); ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input type="email" id="email" name="email" value="<?php echo esc_attr($current_user->user_email); ?>" required>
                    <?php if (!empty($errors['profile']['email'])): ?>
                        <div class="form-errors"><?php echo esc_html($errors['profile']['email']); ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="phone">Teléfono</label>
                    <input type="text" id="phone" name="phone" value="<?php echo esc_attr(get_user_meta($current_user->ID, 'phone', true)); ?>" required>
                    <?php if (!empty($errors['profile']['phone'])): ?>
                        <div class="form-errors"><?php echo esc_html($errors['profile']['phone']); ?></div>
                    <?php endif; ?>
                </div>
                <button type="submit" name="update_profile">Guardar cambios</button>
                <?php if ($success['profile']): ?>
                    <div class="form-success">Datos actualizados correctamente.</div>
                <?php endif; ?>
            </form>
            <div id="form-message"></div>
        </section>

        <section id="mascota" class="perfil-panel <?php echo ($active_panel === 'mascota') ? 'activo' : ''; ?>" aria-labelledby="mascota-title">
            <h2 id="mascota-title">Perfil de tu mascota</h2>
            <form method="post" novalidate>
                <div class="form-group">
                    <label for="pet_name">Nombre mascota</label>
                    <input type="text" id="pet_name" name="pet_name"
                        value="<?php echo esc_attr($_POST['pet_name'] ?? get_user_meta($current_user->ID, 'pet_name', true)); ?>" required>
                    <?php if (!empty($errors['pet']['pet_name'])): ?>
                        <div class="form-errors"><?php echo esc_html($errors['pet']['pet_name']); ?></div>
                    <?php elseif ($success['pet']): ?>
                        <div class="form-success">Datos actualizados correctamente.</div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="pet_breed">Raza</label>
                    <input type="text" id="pet_breed" name="pet_breed"
                        value="<?php echo esc_attr($_POST['pet_breed'] ?? get_user_meta($current_user->ID, 'pet_breed', true)); ?>" required>
                    <?php if (!empty($errors['pet']['pet_breed'])): ?>
                        <div class="form-errors"><?php echo esc_html($errors['pet']['pet_breed']); ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="pet_sex">Sexo</label>
                    <select id="pet_sex" name="pet_sex" required>
                        <option value="">Selecciona</option>
                        <option value="macho" <?php selected($_POST['pet_sex'] ?? get_user_meta($current_user->ID, 'pet_sex', true), 'macho'); ?>>Macho</option>
                        <option value="hembra" <?php selected($_POST['pet_sex'] ?? get_user_meta($current_user->ID, 'pet_sex', true), 'hembra'); ?>>Hembra</option>
                    </select>
                    <?php if (!empty($errors['pet']['pet_sex'])): ?>
                        <div class="form-errors"><?php echo esc_html($errors['pet']['pet_sex']); ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="pet_age">Edad (años)</label>
                    <input type="number" id="pet_age" name="pet_age" min="0" max="50"
                        value="<?php echo esc_attr($_POST['pet_age'] ?? get_user_meta($current_user->ID, 'pet_age', true)); ?>" required>
                    <?php if (!empty($errors['pet']['pet_age'])): ?>
                        <div class="form-errors"><?php echo esc_html($errors['pet']['pet_age']); ?></div>
                    <?php endif; ?>
                </div>
                <button type="submit" name="update_pet">Guardar cambios</button>
            </form>
            <div id="form-message"></div>
        </section>

        <section id="citas" class="perfil-panel" <?php echo ($active_panel === 'citas') ? 'activo' : ''; ?>" aria-labelledby="citas-title">
            <h2 id="citas-title">Gestiona tus citas</h2>
            <?php
            // Aquí puedes poner el shortcode de SSA para mostrar citas
            echo do_shortcode('[ssa_booking]');
            ?>
            <p>Recuerda que para pedir una cita debes completar los datos del perfil y la mascota.</p>
        </section>

        <section id="ajustes" class="perfil-panel" <?php echo ($active_panel === 'ajustes') ? 'activo' : ''; ?>" aria-labelledby="ajustes-title">
            <h2 id="ajustes-title">Ajustes</h2>
            <form method="post" novalidate>
                <div class="form-group">
                    <label for="password_current">Contraseña actual</label>
                    <input type="password" id="password_current" name="password_current" required autocomplete="off">
                    <?php if (!empty($errors['password']['password_current'])): ?>
                        <div class="form-errors"><?php echo esc_html($errors['password']['password_current']); ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="password_new">Nueva contraseña</label>
                    <input type="password" id="password_new" name="password_new" required autocomplete="off">
                    <?php if (!empty($errors['password']['password_new'])): ?>
                        <div class="form-errors"><?php echo esc_html($errors['password']['password_new']); ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="password_confirm">Confirmar nueva contraseña</label>
                    <input type="password" id="password_confirm" name="password_confirm" required autocomplete="off">
                    <?php if (!empty($errors['password']['password_confirm'])): ?>
                        <div class="form-errors"><?php echo esc_html($errors['password']['password_confirm']); ?></div>
                    <?php endif; ?>
                </div>
                <button type="submit" name="change_password">Cambiar contraseña</button>
            </form>
            <p>
                <a class="olvide" href="<?php echo esc_url(get_custom_page_url_by_slug('olvide-mi-contrasena')); ?>" title="Recuperar contraseña">Olvidé mi contraseña</a>
            </p>

            <!-- Formulario para eliminar perfil -->
            <form method="post" onsubmit="return confirm('¿Estás seguro que quieres eliminar tu perfil? Esta acción es irreversible.');">
                <input type="hidden" name="delete_profile" value="1" />
                <button type="submit" class="btn-eliminar-perfil">Eliminar mi perfil</button>
            </form>
            <div id="form-message"></div>
        </section>
    </section>
    <div id="confirm-logout-popup" class="popup-logout hidden" role="dialog" aria-modal="true" aria-labelledby="logout-title">
        <div class="popup-content">
            <p id="logout-title">¿Estás seguro que quieres cerrar sesión?</p>
            <div class="popup-buttons">
                <form method="post" action="<?php echo esc_url(wp_logout_url(get_custom_page_url_by_slug('login'))); ?>"
                    style="display:inline;">
                    <button type="submit" class="btn-user btn-confirm" id="logout-confirm">Cerrar sesión</button>
                </form>
                <button class="btn-user btn-cancel" id="logout-cancel">Cancelar</button>
            </div>
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Panel switching (excluye botón logout)
        document.querySelectorAll('.perfil-menu-btn:not(.cerrar-sesion)').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.perfil-menu-btn').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                document.querySelectorAll('.perfil-panel').forEach(panel => panel.classList.remove('activo'));

                const panelId = btn.dataset.panel;
                const targetPanel = document.getElementById(panelId);
                if (targetPanel) targetPanel.classList.add('activo');
            });
        });

        // Activar panel si hay hash
        const hash = window.location.hash.substring(1);
        if (hash) {
            const botones = document.querySelectorAll('.perfil-menu-btn');
            const paneles = document.querySelectorAll('.perfil-panel');

            botones.forEach(btn => btn.classList.remove('active'));
            paneles.forEach(panel => panel.classList.remove('activo'));

            const btn = Array.from(botones).find(b => b.dataset.panel === hash);
            const panel = document.getElementById(hash);

            if (btn && panel) {
                btn.classList.add('active');
                panel.classList.add('activo');
            }
        }

        // Logout popup
        const logoutBtn = document.querySelector('.cerrar-sesion');
        const logoutPopup = document.getElementById('confirm-logout-popup');
        const cancelBtn = document.getElementById('logout-cancel');

        if (logoutBtn && logoutPopup && cancelBtn) {
            logoutBtn.addEventListener('click', e => {
                e.preventDefault();
                logoutPopup.classList.remove('hidden');
            });

            cancelBtn.addEventListener('click', () => {
                logoutPopup.classList.add('hidden');
            });
        }
    });
</script>

<?php get_footer(); ?>