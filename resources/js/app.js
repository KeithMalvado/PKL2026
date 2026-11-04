import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';

// daftarkn plugin Alpine
Alpine.plugin(collapse);

window.Alpine = Alpine;
Alpine.start();

/**
 * Animasi "scroll reveal" sederhana tanpa library berat.
 * Elemen dgn atribut [data-reveal] akn muncul saat masuk viewport.
 */
document.addEventListener('DOMContentLoaded', () => {
    const elReveal = document.querySelectorAll('[data-reveal]');

    if (!('IntersectionObserver' in window) || elReveal.length === 0) {
        // fallback: lgsng tampilkn bila browser tdk dukung
        elReveal.forEach((el) => el.classList.add('tampil'));
        return;
    }

    const pengamat = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('tampil');
                    pengamat.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.12 }
    );

    elReveal.forEach((el) => pengamat.observe(el));
});
