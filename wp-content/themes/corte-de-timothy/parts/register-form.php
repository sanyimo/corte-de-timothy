<h1>Registro</h1>

<?php
if (!is_user_logged_in()) {

    if (get_option('users_can_register')) {

        $errors = [];
        $message = '';
        $full_name = '';
        $username = '';
        $email = '';
        $show_resend_button = false;
        $resend_user_id = 0;

        // Manejo reenvío correo verificación
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['resend_verification_email'])) {
            $resend_user_id = intval($_POST['user_id']);
            if ($resend_user_id) {
                $user = get_user_by('ID', $resend_user_id);
                if ($user) {
                    $email_verified = get_user_meta($user->ID, 'email_verified', true);
                    if (!$email_verified) {
                        $now = time();
                        $last_sent = get_user_meta($user->ID, 'last_verification_email_sent', true);
                        $cooldown = 60; // 1 minuto en segundos

                        if ($last_sent && ($now - $last_sent) < $cooldown) {
                            $remaining = $cooldown - ($now - $last_sent);
                            $message = 'Ya has solicitado el correo de verificación recientemente.';
                            $cooldown_remaining = ceil($remaining);
                        } else {
                            $cooldown_remaining = 0;
                            // Reenviar correo
                            $token = wp_generate_password(32, false);
                            update_user_meta($user->ID, 'email_verification_token', $token);
                            update_user_meta($user->ID, 'email_verification_token_created', $now);
                            update_user_meta($user->ID, 'last_verification_email_sent', $now);


                            $verify_url = add_query_arg([
                                'verificar_email' => '1',
                                'token' => $token,
                                'user' => $user->ID,
                            ], home_url('/verificar-email'));

                            $subject = 'Confirma tu correo electrónico';
                            $message_body = "Hola {$user->user_login},\n\nEste correo es para verificar tu cuenta creada en Corte de Timothy.\n\nHaz clic aquí para verificar:\n\n$verify_url";

                            $headers = ['Content-Type: text/plain; charset=UTF-8'];
                            wp_mail($user->user_email, $subject, $message_body, $headers);

                            $message = 'Correo de verificación reenviado. Revisa tu bandeja de entrada y/o tu carpeta de spam.';
                        }
                        $show_resend_button = true;
                        $resend_user_id = $user->ID;
                    } else {
                        $message = 'La cuenta ya está verificada.';
                    }
                }
            }
        }

        // Manejo registro normal
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'])) {
            $username = sanitize_user($_POST['username']);
            $email = sanitize_email($_POST['email']);
            $password = $_POST['password'];
            $password_repeat = $_POST['password_repeat'];

            $full_name = isset($_POST['full_name']) ? sanitize_text_field($_POST['full_name']) : '';
            $phone = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
            // Nuevos campos info mascota (opcionales)
            $pet_name = isset($_POST['pet_name']) ? sanitize_text_field($_POST['pet_name']) : '';
            $pet_breed = isset($_POST['pet_breed']) ? sanitize_text_field($_POST['pet_breed']) : '';
            $pet_age = isset($_POST['pet_age']) ? intval($_POST['pet_age']) : 0;
            $pet_notes = isset($_POST['pet_notes']) ? sanitize_textarea_field($_POST['pet_notes']) : '';

            // Validar teléfono
            if (empty($_POST['phone'])) {
                $errors['phone'] = 'El teléfono es obligatorio.';
            } else {
                $phone = trim($_POST['phone']);
                // Solo números, espacios, paréntesis, guiones y + (por si es internacional)
                if (!preg_match('/^[0-9\s\-\+\(\)]+$/', $phone)) {
                    $errors['phone'] = 'El teléfono contiene caracteres inválidos.';
                } elseif (strlen(preg_replace('/\D/', '', $phone)) < 9) {
                    $errors['phone'] = 'El teléfono debe tener al menos 9 dígitos.';
                }
            }

            // Validar nombres
            if (empty($full_name)) {
                $errors['full_name'] = 'El nombre es obligatorio.';
            } else {
                $full_name = trim($full_name);
                if (!preg_match('/^[a-zA-Z\s]+$/', $full_name)) {
                    $errors['full_name'] = 'El nombre contiene caracteres inválidos.';
                }
            }

            // Validaciones
            if (empty($username)) {
                $errors['username'] = 'Debes introducir un nombre de usuario.';
            } elseif (!validate_username($username) || preg_match('/\s/', $username)) {
                $errors[] = 'El nombre de usuario no es válido.';
            } elseif (username_exists($username)) {
                $errors['username'] = 'Ese nombre de usuario ya está en uso.';
            }

            if (empty($email)) {
                $errors['email'] = 'Debes introducir un correo electrónico.';
            } elseif (!is_email($email)) {
                $errors[] = 'El formato del correo electrónico no es válido.';
            } else {
                $existing_user = get_user_by('email', $email);
                if ($existing_user) {
                    $email_verified = get_user_meta($existing_user->ID, 'email_verified', true);
                    if (!$email_verified) {
                        // No reenviar automáticamente
                        $message = 'Ya existe una cuenta con este correo, pero aún no está verificada. Puedes reenviar el correo de verificación más abajo.';
                        $show_resend_button = true;
                        $resend_user_id = $existing_user->ID;
                    } else {
                        $errors['email'] = 'Ese correo electrónico ya está registrado.';
                    }
                }
            }

            if (empty($password)) {
                $errors['password'] = 'Debes introducir una contraseña.';
            } elseif (strlen($password) < 8) {
                $errors['password'] = 'La contraseña debe tener al menos 8 caracteres.';
            }

            if (empty($password_repeat)) {
                $errors['password_repeat'] = 'Debes repetir la contraseña.';
            } elseif ($password !== $password_repeat) {
                $errors['password_repeat'] = 'Las contraseñas no coinciden.';
            }

            // Validar nombre completo (opcional, pero si está presente, que no sea vacío)
            if (empty($full_name)) {
                $errors['full_name'] = 'El nombre completo es obligatorio.';
            } elseif (strlen($full_name) > 50) {
                $errors['full_name'] = 'El nombre completo es demasiado largo.';
            }

            // Validar mascota (opcional)
            if (!empty($_POST['pet_name'])) {
                if (strlen(trim($_POST['pet_name'])) > 50) {
                    $errors['pet_name'] = 'El nombre de la mascota es demasiado largo.';
                }
            }

            if (!empty($_POST['pet_breed'])) {
                if (strlen(trim($_POST['pet_breed'])) > 50) {
                    $errors['pet_breed'] = 'La raza de la mascota es demasiado larga.';
                }
            }

            if (!empty($_POST['pet_age'])) {
                $age = intval($_POST['pet_age']);
                if ($age < 0 || $age > 50) {
                    $errors['pet_age'] = 'La edad de la mascota debe estar entre 0 y 50 años.';
                }
            }

            if (!empty($_POST['pet_notes'])) {
                if (strlen(trim($_POST['pet_notes'])) > 300) {
                    $errors['pet_notes'] = 'Las notas de la mascota son demasiado largas.';
                }
            }

            // Solo crear usuario si no hay errores y no se envió el mensaje de reenvío
            if (empty($errors) && empty($message)) {
                $user_id = wp_create_user($username, $password, $email);
                if (!is_wp_error($user_id)) {
                    // Guardar meta campos extra
                    if ($full_name) update_user_meta($user_id, 'full_name', $full_name);
                    if ($phone) update_user_meta($user_id, 'phone', $phone);

                    // Mascota
                    if ($pet_name) update_user_meta($user_id, 'pet_name', $pet_name);
                    if ($pet_breed) update_user_meta($user_id, 'pet_breed', $pet_breed);
                    if ($pet_age > 0) update_user_meta($user_id, 'pet_age', $pet_age);
                    if ($pet_notes) update_user_meta($user_id, 'pet_notes', $pet_notes);

                    // Crear token de verificación
                    $token = wp_generate_password(32, false);
                    update_user_meta($user_id, 'email_verification_token', $token);
                    update_user_meta($user_id, 'email_verified', false);
                    update_user_meta($user_id, 'email_verification_token_created', time());
                    update_user_meta($user_id, 'last_verification_email_sent', time());


                    // Enviar correo de verificación
                    $verify_url = add_query_arg([
                        'verificar_email' => '1',
                        'token' => $token,
                        'user' => $user_id,
                    ], home_url('/verificar-email'));

                    $subject = 'Confirma tu correo electrónico';
                    $message_body = "Hola $username,\n\nGracias por registrarte.\n\nHaz clic en el siguiente enlace para verificar tu correo electrónico:\n\n$verify_url\n\nSi no fuiste tú, ignora este mensaje.";

                    $headers = ['Content-Type: text/plain; charset=UTF-8'];
                    wp_mail($email, $subject, $message_body, $headers);

                    $message = '¡Registro exitoso! Revisa tu correo para verificar tu cuenta antes de iniciar sesión.';

                    // Reset valores para que no se mantengan en el form
                    $username = '';
                    $email = '';
                    $_POST = [];
                } else {
                    $errors['form-error-general'] = 'Error al crear el usuario.';
                }
            }
        }

        // Mostrar mensajes
        if (!empty($message)) {
            echo '<div class="form-success" role="alert" aria-live="polite">' . esc_html($message) . '</div>';
        }

        if (!empty($errors['form-error-general'])) {
            echo '<div class="form-error-general" role="alert" aria-live="assertive">' . esc_html($errors['form-error-general']) . '</div>';
        }

        if ($show_resend_button) : ?>
            <form method="post" class="resend-verification-form register-form" aria-label="Reenviar correo de verificación">
                <input type="hidden" name="user_id" value="<?php echo intval($resend_user_id); ?>" />
                <p>¿No recibiste el correo de verificación?</p>
                <button
                    type="submit"
                    name="resend_verification_email"
                    aria-label="Reenviar correo de verificación"
                    id="resend-btn"
                    <?php echo (!empty($cooldown_remaining) && $cooldown_remaining > 0) ? 'disabled' : ''; ?>>
                    Reenviar correo de verificación
                </button>
                <?php if (!empty($cooldown_remaining) && $cooldown_remaining > 0) : ?>
                    <p id="countdown-text">Puedes reenviar en <span id="countdown"><?php echo $cooldown_remaining; ?></span> segundos.</p>
                <?php else : ?>
                    <p id="countdown-text" style="display:none;"></p>
                <?php endif; ?>
            </form>
        <?php else : ?>
            <form name="registerform" class="register-form" id="registerform" method="post" autocomplete="on" novalidate role="form" aria-describedby="form-instructions">
                <p id="form-instructions" class="sr-only">
                    Es necesario rellenar todos los campos.
                </p>
                <?php get_template_part('parts/human-fieldset'); ?>
                <!-- Botón para mostrar info mascota -->
                <button type="button" id="toggle_pet_info" aria-expanded="false" aria-controls="fieldset_pet_info" class="toggle-button">
                    Mostrar información de la mascota (opcional)
                </button>
                <?php get_template_part('parts/pet-fieldset'); ?>
                <p class="submit">
                    <input type="submit" name="submit" value="Registrarse" aria-label="Enviar formulario de registro" />
                </p>
            </form>
            <script>
                (function() {
                    const toggleButton = document.getElementById('toggle_pet_info');
                    const petFieldset = document.getElementById('fieldset_pet_info');

                    toggleButton.addEventListener('click', function() {
                        const expanded = toggleButton.getAttribute('aria-expanded') === 'true';
                        if (expanded) {
                            petFieldset.style.display = 'none';
                            toggleButton.setAttribute('aria-expanded', 'false');
                            toggleButton.textContent = 'Mostrar información de la mascota (opcional)';
                        } else {
                            petFieldset.style.display = 'block';
                            toggleButton.setAttribute('aria-expanded', 'true');
                            toggleButton.textContent = 'Ocultar información de la mascota';
                        }
                    });

                    // Si hay datos en mascota, mostrar fieldset automáticamente
                    const petName = '<?php echo isset($_POST['pet_name']) ? esc_js($_POST['pet_name']) : ''; ?>';
                    if (petName.trim() !== '') {
                        petFieldset.style.display = 'block';
                        toggleButton.setAttribute('aria-expanded', 'true');
                        toggleButton.textContent = 'Ocultar información de la mascota';
                    }
                })();
            </script>
        <?php endif; ?>
        <p id="nav" class="nav">
            ¿Ya tienes cuenta?
            <a href="<?php echo esc_url(get_custom_page_url_by_slug('login')); ?>">Iniciar sesión</a>
        </p>
<?php
    } else {
        echo '<p>El registro está desactivado.</p>';
    }
}
?>