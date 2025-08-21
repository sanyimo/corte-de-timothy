const sliders = [
    {
        id: 'slider-tratamientos',
        next: '#next-tratamientos',
        prev: '#prev-tratamientos',
        pag: '#paginacion-tratamientos',
    },
    {
        id: 'slider-antes-despues',
        next: '#next-antes-despues',
        prev: '#prev-antes-despues',
        pag: '#paginacion-antes-despues',
    },
    {
        id: 'slider-looks',
        next: '#next-looks',
        prev: '#prev-looks',
        pag: '#paginacion-looks',
    },
];

sliders.forEach(s => {
    new Swiper(`#${s.id}`, {
        loop: true,
        slidesPerView: 1,
        spaceBetween: 20,
        navigation: {
            nextEl: s.next,
            prevEl: s.prev,
        },
        pagination: {
            el: s.pag,
            clickable: true,
        },
        breakpoints: {
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 3,
            },
        },
    });
});

(function () {
    const imgs = document.querySelectorAll('.retratos img');
    let overlay = null;
    let zoomImg = null;
    let originalRect = null;

    function toggleScroll(lock) {
        document.body.style.overflow = lock ? 'hidden' : '';
    }

    function closeZoom() {
        if (!overlay || !zoomImg || !originalRect) return;

        zoomImg.style.transform = 'translateX(0) scale(1)';
        zoomImg.style.top = `${originalRect.top + window.scrollY}px`;
        zoomImg.style.left = `${originalRect.left + window.scrollX}px`;
        zoomImg.style.width = `${originalRect.width}px`;
        zoomImg.style.height = `${originalRect.height}px`;

        zoomImg.addEventListener('transitionend', () => {
            if (overlay) {
                overlay.remove();
                overlay = null;
                zoomImg = null;
                originalRect = null;
                toggleScroll(false);
                window.removeEventListener('keydown', onEscPress);
            }
        }, { once: true });
    }

    function onEscPress(e) {
        if (e.key === 'Escape') closeZoom();
    }

    imgs.forEach(img => {
        img.style.cursor = 'zoom-in';
        img.addEventListener('click', () => {
            if (overlay) {
                closeZoom();
                return;
            }

            originalRect = img.getBoundingClientRect();

            const absoluteTop = originalRect.top + window.scrollY;
            const absoluteLeft = originalRect.left + window.scrollX;

            overlay = document.createElement('div');
            overlay.classList.add('zoom-overlay');

            zoomImg = img.cloneNode(true);
            zoomImg.classList.add('zoomed-image');

            // Estilos iniciales
            Object.assign(zoomImg.style, {
                position: 'absolute',
                top: `${absoluteTop}px`,
                left: `${absoluteLeft}px`,
                width: `${originalRect.width}px`,
                height: `${originalRect.height}px`,
                transition: 'all 0.3s ease',
                zIndex: '100',
                borderRadius: '8px',
                objectFit: 'contain',
                cursor: 'zoom-out',
            });

            overlay.appendChild(zoomImg);
            document.body.appendChild(overlay);

            // Animación: forzar reflow primero
            requestAnimationFrame(() => {
                zoomImg.style.top = `${absoluteTop + originalRect.height / 2 - window.innerHeight * 0.2}px`;
                zoomImg.style.left = '50%';
                zoomImg.style.transform = 'translateX(-50%) scale(2)';
            });

            toggleScroll(true);
            window.addEventListener('keydown', onEscPress);
            overlay.addEventListener('click', closeZoom);
            zoomImg.addEventListener('click', e => {
                e.stopPropagation();
                closeZoom();
            });
        });
    });
})();
