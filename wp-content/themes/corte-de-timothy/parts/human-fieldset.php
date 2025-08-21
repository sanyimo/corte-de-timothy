<!-- Fieldset info humano -->
<fieldset>
    <legend>Información personal</legend>

    <div class="form-group">
        <label for="full_name">Nombre completo</label>
        <input
            type="text"
            name="full_name"
            id="full_name"
            autocomplete="name"
            required
            placeholder="Ej: Timothy Smith"
            value="<?php echo isset($_POST['full_name']) ? esc_attr($_POST['full_name']) : ''; ?>" />
        <?php if (!empty($errors['full_name'])) : ?>
            <div class="form-errors" id="error-full-name" role="alert" aria-live="polite">
                <?php echo esc_html($errors['full_name']); ?>
            </div>
        <?php endif; ?>
    </div>
    <dix class="form-group">
        <label for="reg_username">Nombre de usuario</label>
        <input
            type="text"
            name="username"
            id="reg_username"
            required
            autocomplete="username"
            aria-required="true"
            placeholder="Ej: timothy123"
            value="<?php echo esc_attr($username); ?>"
            <?php if (!empty($errors['username'])) echo 'aria-describedby="error-username"'; ?> />
        <?php if (!empty($errors['username'])) : ?>
            <div class="form-errors" id="error-username" role="alert" aria-live="polite">
                <?php echo esc_html($errors['username']); ?>
            </div>
        <?php endif; ?>
    </dix>
    <div class="form-group">
        <label for="phone">Teléfono</label>
        <input
            type="tel"
            name="phone"
            id="phone"
            autocomplete="tel"
            placeholder="Ej: 600 123 456"
            required
            value="<?php echo isset($_POST['phone']) ? esc_attr($_POST['phone']) : ''; ?>" />
        <?php if (!empty($errors['phone'])) : ?>
            <div class="form-errors" id="error-phone" role="alert" aria-live="polite">
                <?php echo esc_html($errors['phone']); ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="form-group">
        <label for="reg_email">Correo electrónico</label>
        <input
            type="email"
            name="email"
            id="reg_email"
            required
            autocomplete="email"
            aria-required="true"
            placeholder="ejemplo@correo.com"
            value="<?php echo esc_attr($email); ?>"
            <?php if (!empty($errors['email'])) echo 'aria-describedby="error-email"'; ?> />
        <?php if (!empty($errors['email'])) : ?>
            <div class="form-errors" id="error-email" role="alert" aria-live="polite">
                <?php echo esc_html($errors['email']); ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="reg_password">Contraseña</label>
        <input
            type="password"
            name="password"
            id="reg_password"
            required
            autocomplete="new-password"
            aria-required="true"
            minlength="8"
            pattern=".{8,}"
            title="Mínimo 8 caracteres"
            placeholder="Introduce una contraseña fuerte (min 8 caracteres)"
            <?php if (!empty($errors['password'])) echo 'aria-describedby="error-password"'; ?> />
        <?php if (!empty($errors['password'])) : ?>
            <div class="form-errors" id="error-password" role="alert" aria-live="polite">
                <?php echo esc_html($errors['password']); ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="reg_password_repeat">Repite la contraseña</label>
        <input
            type="password"
            name="password_repeat"
            id="reg_password_repeat"
            required
            autocomplete="new-password"
            aria-required="true"
            placeholder="Repite la contraseña"
            <?php if (!empty($errors['password_repeat'])) echo 'aria-describedby="error-password-repeat"'; ?> />
        <?php if (!empty($errors['password_repeat'])) : ?>
            <div class="form-errors" id="error-password-repeat" role="alert" aria-live="polite">
                <?php echo esc_html($errors['password_repeat']); ?>
            </div>
        <?php endif; ?>
    </div>
</fieldset>