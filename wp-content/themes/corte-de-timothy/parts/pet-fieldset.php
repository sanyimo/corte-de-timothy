<!-- Fieldset mascota, oculto por defecto -->
<fieldset id="fieldset_pet_info" style="display:none; margin-top:1em;">
    <legend>Información de la mascota (opcional)</legend>

    <div class="form-group">
        <label for="pet_name">Nombre de la mascota</label>
        <input
            type="text"
            name="pet_name"
            id="pet_name"
            placeholder="Ej: Rocky"
            value="<?php echo isset($_POST['pet_name']) ? esc_attr($_POST['pet_name']) : ''; ?>" />
        <?php if (!empty($errors['pet_name'])) : ?>
            <div class="form-errors" id="error-pet-name" role="alert" aria-live="polite">
                <?php echo esc_html($errors['pet_name']); ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="pet_breed">Raza</label>
        <input
            type="text"
            name="pet_breed"
            id="pet_breed"
            placeholder="Ej: Golden Retriever"
            value="<?php echo isset($_POST['pet_breed']) ? esc_attr($_POST['pet_breed']) : ''; ?>" />
        <?php if (!empty($errors['pet_breed'])) : ?>
            <div class="form-errors" id="error-pet-breed" role="alert" aria-live="polite">
                <?php echo esc_html($errors['pet_breed']); ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="pet_age">Edad (años)</label>
        <input
            type="number"
            name="pet_age"
            id="pet_age"
            min="0"
            max="50"
            step="1"
            placeholder="Ej: 3"
            value="<?php echo isset($_POST['pet_age']) ? intval($_POST['pet_age']) : ''; ?>" />
        <?php if (!empty($errors['pet_age'])) : ?>
            <div class="form-errors" id="error-pet-age" role="alert" aria-live="polite">
                <?php echo esc_html($errors['pet_age']); ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="pet_notes">Notas adicionales</label>
        <textarea
            name="pet_notes"
            id="pet_notes"
            rows="6"
            placeholder="Características o necesidades especiales">
            <?php echo isset($_POST['pet_notes']) ? esc_textarea($_POST['pet_notes']) : ''; ?>
        <?php if (!empty($errors['pet_notes'])) : ?>
            <div class="form-errors" id="error-pet-notes" role="alert" aria-live="polite">
                <?php echo esc_html($errors['pet_notes']); ?>
            </div>
        <?php endif; ?>
        </textarea>
    </div>
</fieldset>