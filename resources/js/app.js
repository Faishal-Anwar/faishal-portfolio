// Self-hosted libraries (bundled via Vite instead of CDN)
import { createIcons, icons } from 'lucide';
import AOS from 'aos';
import 'aos/dist/aos.css';
import Lenis from 'lenis';
import Typed from 'typed.js';

// Expose globally so inline scripts can use them
window.lucide = { createIcons: (opts) => createIcons({ icons, ...opts }) };
window.AOS = AOS;
window.Lenis = Lenis;
window.Typed = Typed;

// Initialize on DOMContentLoaded
document.addEventListener('DOMContentLoaded', function () {
    // Initialize Lucide Icons
    try { createIcons({ icons }); } catch (e) { console.error(e); }

    // Initialize AOS (Animate On Scroll)
    try { AOS.init({ duration: 800, once: true, offset: 50 }); } catch (e) { console.error(e); }

    // Theme Toggle
    try {
        const html = document.documentElement;
        const themeToggles = [document.getElementById('theme-toggle'), document.getElementById('theme-toggle-mobile')];
        themeToggles.forEach(btn => {
            if (btn) btn.addEventListener('click', () => {
                const isDark = html.classList.toggle('dark');
                localStorage.setItem('theme', isDark ? 'dark' : 'light');

                // Re-render Lucide icons after theme toggle
                setTimeout(() => {
                    createIcons({ icons });
                }, 10);
            });
        });
    } catch (e) { console.error(e); }

    // Mobile Navigation
    try {
        const mobileNav = document.getElementById('mobile-nav');
        const menuOpen = document.getElementById('mobile-menu-open');
        const menuClose = document.getElementById('mobile-menu-close');

        if (menuOpen && mobileNav) {
            menuOpen.addEventListener('click', () => {
                mobileNav.classList.add('open');
                document.body.style.overflow = 'hidden';
            });
        }
        if (menuClose && mobileNav) {
            menuClose.addEventListener('click', () => {
                mobileNav.classList.remove('open');
                document.body.style.overflow = 'auto';
            });
        }
    } catch (e) { console.error(e); }

    // Lenis Smooth Scroll
    try {
        const lenis = new Lenis({ duration: 1.1, lerp: 0.1 });
        function raf(time) { lenis.raf(time); requestAnimationFrame(raf); }
        requestAnimationFrame(raf);
    } catch (e) { console.error(e); }

    // Typed.js — Hero typing animation
    try {
        const typedEl = document.getElementById('typed-text');
        if (typedEl) {
            new Typed('#typed-text', {
                strings: ["Machine Learning Engineer", "Data Engineer", "Cloud Architect"],
                typeSpeed: 50,
                backSpeed: 30,
                backDelay: 1500,
                startDelay: 500,
                loop: true
            });
        }
    } catch (e) { console.error(e); }
});
