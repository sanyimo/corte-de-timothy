document.addEventListener("DOMContentLoaded", () => {
    const observer = new MutationObserver((mutations) => {
        for (const mutation of mutations) {
            for (const node of mutation.addedNodes) {
                // Si es un iframe y contiene la URL problemática
                if (
                    node.tagName === "IFRAME" &&
                    node.src.includes("wp-json/ssa/v1/embed-inner")
                ) {
                    console.warn("Iframe SSA detectado, corrigiendo...");

                    // Crear nuevo iframe limpio
                    const fixedIframe = document.createElement("iframe");

                    // Extraer y reconstruir los parámetros válidos
                    const url = new URL(node.src);
                    const booking_url = url.searchParams.get("booking_url") || "/";
                    const booking_post_id = url.searchParams.get("booking_post_id") || "0";
                    const booking_title = url.searchParams.get("booking_title") || "Reservar";

                    fixedIframe.src = `/wp-json/ssa/v1/embed-inner?booking_url=${encodeURIComponent(
                        booking_url
                    )}&booking_post_id=${booking_post_id}&booking_title=${encodeURIComponent(
                        booking_title
                    )}`;

                    fixedIframe.style.width = "100%";
                    fixedIframe.style.height = "600px";
                    fixedIframe.style.border = "none";

                    // Reemplaza el iframe viejo
                    node.replaceWith(fixedIframe);
                }

                // También eliminamos cualquier <link> mal hecho que apunte a esa URL
                if (
                    node.tagName === "LINK" &&
                    node.rel === "stylesheet" &&
                    node.href.includes("wp-json/ssa/v1/embed-inner")
                ) {
                    console.warn("Hoja de estilo SSA incorrecta eliminada:", node.href);
                    node.remove();
                }
            }
        }
    });

    observer.observe(document.body, { childList: true, subtree: true });
});
  