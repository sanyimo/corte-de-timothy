document.addEventListener('DOMContentLoaded', () => {
    const btn = document.querySelector('.menu-toggle');
    const menu = document.querySelector('.nav-menu');

    if (btn && menu) {
        btn.addEventListener('click', () => {
            menu.classList.toggle('active');
            const expanded = btn.getAttribute('aria-expanded') === 'true';
            btn.setAttribute('aria-expanded', !expanded);
        });
    }

    const btnGlsr = document.querySelector('.valoracion-formulario form .glsr-submit, .valoracion-formulario form .glsr-button');
    if (btnGlsr) {
        btnGlsr.style.backgroundColor = '#960018';
        btnGlsr.style.color = '#fdfdfb';
        btnGlsr.style.transition = 'all 0.3s ease';

        btnGlsr.addEventListener('mouseenter', () => {
            btnGlsr.style.background = 'linear-gradient(135deg, #7a0015, #960018)';
            btnGlsr.style.transform = 'scale(1.05)';
            btnGlsr.style.boxShadow = '0 3px 12px rgba(0, 0, 0, 0.2)';
        });

        btnGlsr.addEventListener('mouseleave', () => {
            btnGlsr.style.background = '#960018';
            btnGlsr.style.transform = 'scale(1)';
            btnGlsr.style.boxShadow = 'none';
        });
    }

    const countdownEl = document.getElementById('countdown');
    const countdownText = document.getElementById('countdown-text');
    const resendBtn = document.getElementById('resend-btn');

    if (!countdownEl || !resendBtn) return;

    let seconds = parseInt(countdownEl.textContent, 10);
    if (isNaN(seconds) || seconds <= 0) return;

    const interval = setInterval(() => {
        seconds--;
        if (seconds <= 0) {
            clearInterval(interval);
            resendBtn.disabled = false;
            countdownText.style.display = 'none';
        } else {
            countdownEl.textContent = seconds;
        }
    }, 1000);

});