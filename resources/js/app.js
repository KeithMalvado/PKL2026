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
        { threshold: 0.12, rootMargin: '0px 0px -8% 0px' }
    );

    elReveal.forEach((el) => pengamat.observe(el));
});

// efek parallax halus utk elemen ber-atribut [data-parallax]
document.addEventListener('DOMContentLoaded', () => {
    const daftar = Array.from(document.querySelectorAll('[data-parallax]'));

    if (daftar.length === 0 || window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        return;
    }

    let minta = false;

    const perbarui = () => {
        const posisi = window.scrollY;

        daftar.forEach((el) => {
            const laju = parseFloat(el.dataset.parallax) || 0.12;
            el.style.transform = `translate3d(0, ${posisi * laju}px, 0)`;
        });

        minta = false;
    };

    window.addEventListener(
        'scroll',
        () => {
            if (!minta) {
                minta = true;
                window.requestAnimationFrame(perbarui);
            }
        },
        { passive: true }
    );
});
