document.addEventListener('DOMContentLoaded', () => {
    const animados = document.querySelectorAll('.animado');
    if (animados.length === 0) return;

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.2 });

    animados.forEach(el => observer.observe(el));

    const successMsg = document.querySelector('.form-success');
    if (successMsg) {
        setTimeout(() => {
            // Agregamos clase para iniciar la transición
            successMsg.classList.add('hidden');

            // Después de la transición, ponemos display:none para quitar del flujo
            successMsg.addEventListener('transitionend', () => {
                successMsg.style.display = 'none';
                successMsg.setAttribute('aria-hidden', 'true');
            }, { once: true }); // El listener se elimina luego de ejecutarse una vez
        }, 5000); // esperar 5 segundos antes de iniciar ocultación
    }
});