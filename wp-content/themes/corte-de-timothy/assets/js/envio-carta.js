const form = document.querySelector('.formulario');

form.addEventListener('submit', function (e) {
    // Limpiar errores previos
    form.querySelectorAll('.form-errors').forEach(el => el.remove());
    form.querySelector('.form-error-general')?.remove();

    let isValid = true;

    const nombre = form.nombre;
    const email = form.email;
    const mensaje = form.mensaje;

    // Validación del nombre
    if (!nombre.value.trim()) {
        mostrarError(nombre, '⚠️ El nombre es obligatorio.');
        isValid = false;
    }

    // Validación del email
    if (!email.value.trim()) {
        mostrarError(email, '⚠️ El correo es obligatorio.');
        isValid = false;
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
        mostrarError(email, '⚠️ El correo no es válido.');
        isValid = false;
    }

    // Validación del mensaje
    if (!mensaje.value.trim()) {
        mostrarError(mensaje, '⚠️ El mensaje no puede estar vacío.');
        isValid = false;
    }

    if (!isValid) {
        e.preventDefault(); // ❌ Cancela el envío si hay errores
        mostrarErrorGeneral('❌ No se pudo enviar la carta. Revisa los campos.');
    }

    function mostrarError(input, mensaje) {
      const p = document.createElement('p');
        p.className = 'form-errors';
        p.setAttribute('role', 'alert');
        p.textContent = mensaje;
        input.parentElement.appendChild(p);
    }

    function mostrarErrorGeneral(mensaje) {
      const p = document.createElement('p');
        p.className = 'form-error-general';
        p.setAttribute('role', 'alert');
        p.textContent = mensaje;
        form.querySelector('button[type="submit"]').before(p);
    }
});