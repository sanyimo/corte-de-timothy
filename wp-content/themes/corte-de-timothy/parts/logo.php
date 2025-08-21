<a href="<?php echo home_url(); ?>" class="logo">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 550 100" class="logo-svg" aria-label="Corte de Timothy" role="img" aria-labelledby="logoTitle logoDesc">
        <title id="logoTitle">Logo de Corte de Timothy</title>
        <desc id="logoDesc">Texto con tipografía elegante y una corona decorativa animada.</desc>
        <defs>
            <linearGradient id="textGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                <stop offset="0%" stop-color="#ffffff" />
                <stop offset="25%" stop-color="#fbeaea" />
                <stop offset="50%" stop-color="#fdf6e3" />
                <stop offset="75%" stop-color="#f0e2f8" />
                <stop offset="100%" stop-color="#ffffff" />
            </linearGradient>
        </defs>
        <g class="logo-text-group">
            <text x="0" y="70" font-family="'Cormorant Garamond', serif" font-weight="bold" font-size="64" fill="#960018" class="logo-text">
                <tspan>Corte de </tspan>
                <tspan class="span-timothy">Timothy</tspan>
            </text>
        </g>
    </svg>

    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" class="logo-icon" aria-hidden="true" role="img" aria-labelledby="crownTitle crownDesc">
        <title id="crownTitle">Corona decorativa</title>
        <desc id="crownDesc">Corona con sombras y rotación animada al hacer hover.</desc>

        <defs>
            <radialGradient id="gradient" cx="50%" cy="50%" r="50%">
                <stop offset="0%" stop-color="#ffffff" />
                <stop offset="30%" stop-color="#f8eaea" />
                <stop offset="75%" stop-color="#f5edd1" />
                <stop offset="100%" stop-color="#d59da7" />
            </radialGradient>
            <filter id="shadow" x="-20%" y="-20%" width="140%" height="140%">
                <feDropShadow dx="2" dy="2" stdDeviation="2" flood-color="rgba(0,0,0,0.4)" />
            </filter>
        </defs>
        <path
            d="M4 48L12 20l10 18 10-26 10 26 10-18 8 28zM4 52h56v4H4z"
            fill="url(#gradient)"
            filter="url(#shadow)" />
    </svg>
</a>