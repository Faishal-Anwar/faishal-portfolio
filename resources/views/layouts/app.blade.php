<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', "Faishal Anwar's Portfolio")</title>

    <!-- SEO & Meta Tags -->
    <meta name="description" content="Portfolio Faishal Anwar, seorang Machine Learning Engineer & Data Scientist yang berfokus pada solusi AI, analisis data, dan algoritma berbasis data untuk memecahkan masalah dunia nyata.">
    <meta name="keywords" content="Faishal Anwar, Machine Learning Engineer, Data Scientist, AI, Portfolio, Web Developer, Laravel, Python">
    <meta name="author" content="Faishal Anwar">
    <link rel="canonical" href="{{ url()->current() }}" />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Faishal Anwar's Portfolio">
    <meta property="og:description" content="Portfolio Faishal Anwar, seorang Machine Learning Engineer & Data Scientist yang berfokus pada solusi AI, analisis data, dan algoritma berbasis data untuk memecahkan masalah dunia nyata.">
    <meta property="og:image" content="{{ $profilePhotoUrl ?? asset('images/profile.png') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="Faishal Anwar's Portfolio">
    <meta property="twitter:description" content="Portfolio Faishal Anwar, seorang Machine Learning Engineer & Data Scientist yang berfokus pada solusi AI, analisis data, dan algoritma berbasis data untuk memecahkan masalah dunia nyata.">
    <meta property="twitter:image" content="{{ $profilePhotoUrl ?? asset('images/profile.png') }}">


    <link rel="icon" href="https://placehold.co/32x32/0284c7/ffffff?text=FA" type="image/png">
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/gh/studio-freight/lenis@1.0.42/bundled/lenis.min.js"></script>

    
    <style>
        html { scroll-behavior: auto; }

        /* Color Variables for Light & Dark Mode */
        :root {
            --background: #f1f5f9; /* slate-100 */
            --text-primary: #1e293b; /* slate-800 */
            --text-secondary: #475569; /* slate-600 */
            --card-bg: #ffffff;
            --sidebar-bg: #ffffff;
            --nav-active-bg: #e0f2fe; /* sky-100 */
            --nav-active-text: #0284c7; /* sky-600 */
            --nav-hover-bg: #f1f5f9; /* slate-100 */
            --nav-mobile-active-bg: #e0f2fe; /* sky-100 */
            --nav-mobile-active-text: #0284c7; /* sky-100 */
            --border-color: #e2e8f0; /* slate-200 */
            --input-bg: #f8fafc; /* slate-50 */
            --button-secondary-bg: #e2e8f0; /* slate-200 */
            --button-secondary-hover-bg: #cbd5e1; /* slate-300 */
            --grid-line-color: #e2e8f0; /* slate-200 */
        }

        html.dark {
            --background: #0f172a; /* slate-900 */
            --text-primary: #f1f5f9; /* slate-100 */
            --text-secondary: #94a3b8; /* slate-400 */
            --card-bg: #1e293b; /* slate-800 */
            --sidebar-bg: #1e293b; /* slate-800 */
            --nav-active-bg: #0c4a6e; /* sky-900 */
            --nav-active-text: #e0f2fe; /* sky-100 */
            --nav-hover-bg: #334155; /* slate-700 */
            --nav-mobile-active-bg: #0c4a6e; /* sky-900 */
            --nav-mobile-active-text: #e0f2fe; /* sky-100 */
            --border-color: #334155; /* slate-700 */
            --input-bg: #334155; /* slate-700 */
            --button-secondary-bg: #334155; /* slate-700 */
            --button-secondary-hover-bg: #475569; /* slate-600 */
            --grid-line-color: #334155; /* slate-700 */
        }

        /* Base Styling - Font size adjusted */
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--background);
            font-size: 1rem; 
            line-height: 1.6;
            color: var(--text-primary);
            transition: background-color 0.3s, color 0.3s;
        }
        
        /* Sidebar & Navigation */
        .sidebar {
            background-color: var(--sidebar-bg);
        }
        .nav-link.active {
            background-color: var(--nav-active-bg);
            color: var(--nav-active-text);
            font-weight: 600;
        }
        .nav-link:hover {
            background-color: var(--nav-hover-bg);
        }
        .nav-link-mobile.active {
            background-color: var(--nav-mobile-active-bg);
            color: var(--nav-mobile-active-text);
            font-weight: 600;
        }
        .nav-link-mobile:hover {
            background-color: var(--nav-hover-bg);
        }
        .social-link {
            color: var(--text-secondary);
        }
        .social-link:hover {
            background-color: var(--nav-hover-bg);
            color: var(--text-primary);
        }
        
        /* Card & Shadow */
        .card {
            background-color: var(--card-bg);
            transition: background-color 0.3s, box-shadow 0.3s, transform 0.3s;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05), 0 2px 4px -2px rgb(0 0 0 / 0.05);
        }
        .card:hover {
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        }
        html.dark .card {
            box-shadow: 0 4px 6px -1px rgb(255 255 255 / 0.02), 0 2px 4px -2px rgb(255 255 255 / 0.02);
        }
        html.dark .card:hover {
            box-shadow: 0 10px 15px -3px rgb(255 255 255 / 0.05), 0 4px 6px -4px rgb(255 255 255 / 0.05);
        }
        
        /* Grid Background */
        .grid-background {
            background-image:
                linear-gradient(to right, var(--grid-line-color) 1px, transparent 1px),
                linear-gradient(to bottom, var(--grid-line-color) 1px, transparent 1px);
            background-size: 3rem 3rem;
        }

        /* Form & Input */
        .form-input {
            background-color: var(--input-bg);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
        }
        .form-input::placeholder {
            color: var(--text-secondary);
            opacity: 0.7;
        }
        .form-input:focus {
            --tw-ring-color: #2563eb; /* blue-600 */
        }
        
        /* Timeline */
        .timeline-container > .timeline-item:first-child::before {
            top: 18px; /* Start the line at the center of the first icon */
        }
        .timeline-item {
            position: relative;
            padding-left: 3.5rem; /* Space for icon and line */
            padding-bottom: 3rem;
        }
        .timeline-item:last-child {
            padding-bottom: 0;
        }
        .timeline-item::before {
            content: '';
            position: absolute;
            left: 18px; /* (Icon width 36px / 2) */
            top: 0;
            height: 100%;
            width: 2px;
            background-color: var(--border-color);
        }
        .timeline-item:last-child::before {
            height: 18px; /* Stop the line at the center of the last icon */
        }
        .timeline-icon {
            position: absolute;
            left: 0;
            top: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }


        /* Service Card Accordion */
        .service-card {
            cursor: pointer;
        }
        .service-details {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s ease-in-out, padding-top 0.5s ease-in-out;
            padding-top: 0;
        }
        .service-card.active .service-details {
            max-height: 20rem; /* Adjust this value based on content length */
            padding-top: 1rem;
        }
        .arrow-icon {
            transition: transform 0.3s ease-in-out;
        }
        .service-card.active .arrow-icon {
            transform: rotate(180deg);
        }
        
        /* Secondary Button (Theme Toggle) */
        .btn-secondary {
            background-color: var(--button-secondary-bg);
            color: var(--text-primary);
        }
        .btn-secondary:hover {
            background-color: var(--button-secondary-hover-bg);
        }

        /* Logo Animation */
        .profile-logo {
            transition: transform 0.3s ease-in-out;
        }
        .profile-logo:hover {
            transform: scale(1.1) rotate(5deg);
        }

        /* PERBAIKAN: CSS Kustom untuk background header & menu mobile */
        .mobile-header-bg {
            background-color: rgba(255, 255, 255, 0.9);
        }
        html.dark .mobile-header-bg {
            background-color: rgba(30, 41, 59, 0.9); /* slate-800 with 90% opacity */
        }
        .mobile-menu-bg {
            background-color: rgba(255, 255, 255, 0.95);
        }
        html.dark .mobile-menu-bg {
            background-color: rgba(15, 23, 42, 0.95); /* slate-900 with 95% opacity */
        }
        
        /* Utility */
        .main-content::-webkit-scrollbar { display: none; }
        .main-content { -ms-overflow-style: none; scrollbar-width: none; opacity: 0; transition: opacity 0.5s ease-in-out; }
        #back-to-top { transition: opacity 0.3s, transform 0.3s; }
    </style>
</head>
<body class="overflow-x-hidden">

    <div class="flex min-h-screen">
        <!-- Sidebar: Width reduced to w-64 -->
        <aside data-aos="fade-right" data-aos-duration="1000" class="sidebar hidden lg:flex w-64 flex-col p-6 shadow-xl rounded-3xl fixed top-8 bottom-8 left-8">
            @auth
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-4 mb-6 group">
                <img src="{{ $profilePhotoUrl ?? asset('images/profile.png') }}" alt="Profile Photo" class="w-12 h-12 rounded-full object-cover profile-logo group-hover:ring-2 group-hover:ring-blue-500 transition-all">
                <div>
                    <h1 class="font-bold text-xl text-primary">Faishal Anwar</h1>
                    <p class="text-sm text-secondary">ML Engineer</p>
                </div>
            </a>
            @else
            <div class="flex items-center gap-4 mb-6">
                <img src="{{ $profilePhotoUrl ?? asset('images/profile.png') }}" alt="Profile Photo" class="w-12 h-12 rounded-full object-cover profile-logo">
                <div>
                    <h1 class="font-bold text-xl text-primary">Faishal Anwar</h1>
                    <p class="text-sm text-secondary">ML Engineer</p>
                </div>
            </div>
            @endauth
            
            <div class="flex gap-3 mb-6">
                <a href="{{ asset('assets/CV-Faishal-Anwar.pdf') }}" download="CV-Faishal-Anwar.pdf" class="flex-1 text-center bg-blue-600 text-white px-4 py-2 rounded-xl font-semibold text-sm hover:bg-blue-700 transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2">
                    <i data-lucide="download" class="w-4 h-4"></i>
                    <span>Download CV</span>
                </a>
                <button id="theme-toggle-desktop" class="btn-secondary px-3 py-2 rounded-xl font-semibold text-base transition-colors duration-300">
                    <i data-lucide="sun" class="w-5 h-5 block dark:hidden"></i>
                    <i data-lucide="moon" class="w-5 h-5 hidden dark:block"></i>
                </button>
            </div>

            <nav id="desktop-nav" class="flex flex-col gap-2">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }} flex items-center gap-3 px-4 py-2 rounded-xl text-base transition-colors duration-300">
                    <i data-lucide="home" class="w-5 h-5"></i>
                    <span>Home</span>
                </a>
                <a href="{{ route('about.index') }}" class="nav-link {{ request()->routeIs('about.*') ? 'active' : '' }} flex items-center gap-3 px-4 py-2 rounded-xl text-base transition-colors duration-300">
                    <i data-lucide="user-circle" class="w-5 h-5"></i>
                    <span>About Me</span>
                </a>
                <a href="{{ route('projects.index') }}" class="nav-link {{ request()->routeIs('projects.*') ? 'active' : '' }} flex items-center gap-3 px-4 py-2 rounded-xl text-base transition-colors duration-300">
                    <i data-lucide="folder-kanban" class="w-5 h-5"></i>
                    <span>Projects</span>
                </a>
                                <a href="{{ route('stack.index') }}" class="nav-link {{ request()->routeIs('stack.*') ? 'active' : '' }} flex items-center gap-3 px-4 py-2 rounded-xl text-base transition-colors duration-300">
                                    <i data-lucide="layers" class="w-5 h-5"></i>
                                    <span>Stack</span>
                                </a>                <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }} flex items-center gap-3 px-4 py-2 rounded-xl text-base transition-colors duration-300">
                    <i data-lucide="mail" class="w-5 h-5"></i>
                    <span>Contact</span>
                </a>

                @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" 
                       onclick="event.preventDefault(); this.closest('form').submit();" 
                       class="nav-link flex items-center gap-3 px-4 py-2 rounded-xl text-base transition-colors duration-300 text-red-500 hover:bg-red-100">
                        <i data-lucide="log-out" class="w-5 h-5"></i>
                        <span>Logout</span>
                    </a>
                </form>
                @endauth
            </nav>

            <div class="mt-auto flex flex-col gap-1">
                <a href="https://x.com/Faishal49226275" target="_blank" class="social-link flex items-center gap-3 px-4 py-1.5 rounded-xl text-sm transition-colors duration-300">
                    <i data-lucide="twitter" class="w-5 h-5"></i>
                    <span>Twitter</span>
                </a>
                <a href="https://linkedin.com/in/faishal-anwar-hasyim-1391682a5/" target="_blank" class="social-link flex items-center gap-3 px-4 py-1.5 rounded-xl text-sm transition-colors duration-300">
                    <i data-lucide="linkedin" class="w-5 h-5"></i>
                    <span>LinkedIn</span>
                </a>
                <a href="https://www.instagram.com/faishalah97?igsh=azA0dGFjM3lkd2Jm" target="_blank" class="social-link flex items-center gap-3 px-4 py-1.5 rounded-xl text-sm transition-colors duration-300">
                    <i data-lucide="instagram" class="w-5 h-5"></i>
                    <span>Instagram</span>
                </a>
            </div>
        </aside>

        <header class="lg:hidden fixed top-6 left-6 right-6 shadow-md rounded-2xl z-50 backdrop-blur-sm mobile-header-bg">
            <div class="container mx-auto px-4">
                <div class="flex justify-between items-center h-16">
                    @auth
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 group">
                        <img src="{{ $profilePhotoUrl ?? asset('images/profile.png') }}" alt="Profile Photo" class="w-8 h-8 rounded-full object-cover profile-logo group-hover:ring-2 group-hover:ring-blue-500 transition-all">
                        <h1 class="font-bold text-md text-primary">Faishal Anwar</h1>
                    </a>
                    @else
                    <div class="flex items-center gap-3">
                        <img src="{{ $profilePhotoUrl ?? asset('images/profile.png') }}" alt="Profile Photo" class="w-8 h-8 rounded-full object-cover profile-logo">
                        <h1 class="font-bold text-md text-primary">Faishal Anwar</h1>
                    </div>
                    @endauth
                    <div class="flex items-center gap-2">
                        <button id="theme-toggle-mobile" class="p-2 rounded-md hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors text-slate-700 dark:text-slate-300">
                            <i data-lucide="sun" class="w-6 h-6 block dark:hidden"></i>
                            <i data-lucide="moon" class="w-6 h-6 hidden dark:block"></i>
                        </button>
                        <button id="menu-toggle" class="p-2 rounded-md hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors z-[60] text-slate-700 dark:text-slate-300">
                            <i data-lucide="menu" class="w-6 h-6" id="burger-icon"></i>
                            <i data-lucide="x" class="w-6 h-6 hidden" id="close-icon"></i>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <div id="mobile-menu" class="lg:hidden fixed inset-0 backdrop-blur-lg z-40 transform translate-x-full transition-transform duration-300 ease-in-out mobile-menu-bg">
             <div class="flex flex-col p-8 h-full">
                 <nav id="mobile-nav" class="flex flex-col gap-4 mt-20">
                     <a href="{{ route('home') }}" class="nav-link-mobile {{ request()->routeIs('home') ? 'active' : '' }} flex items-center gap-4 px-5 py-4 rounded-xl text-xl transition-colors">
                         <i data-lucide="home" class="w-7 h-7"></i>
                         <span>Home</span>
                     </a>
                     <a href="{{ route('about.index') }}" class="nav-link-mobile {{ request()->routeIs('about.*') ? 'active' : '' }} flex items-center gap-4 px-5 py-4 rounded-xl text-xl transition-colors">
                         <i data-lucide="user-circle" class="w-7 h-7"></i>
                         <span>About Me</span>
                     </a>
                     <a href="{{ route('projects.index') }}" class="nav-link-mobile {{ request()->routeIs('projects.*') ? 'active' : '' }} flex items-center gap-4 px-5 py-4 rounded-xl text-xl transition-colors">
                         <i data-lucide="folder-kanban" class="w-7 h-7"></i>
                         <span>Projects</span>
                     </a>
                     <a href="{{ route('stack.index') }}" class="nav-link-mobile {{ request()->routeIs('stack.*') ? 'active' : '' }} flex items-center gap-4 px-5 py-4 rounded-xl text-xl transition-colors">
                         <i data-lucide="layers" class="w-7 h-7"></i>
                         <span>Stack</span>
                     </a>
                     <a href="{{ route('contact') }}" class="nav-link-mobile {{ request()->routeIs('contact') ? 'active' : '' }} flex items-center gap-4 px-5 py-4 rounded-xl text-xl transition-colors">
                         <i data-lucide="mail" class="w-7 h-7"></i>
                         <span>Contact</span>
                     </a>
                    @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); this.closest('form').submit();"
                           class="nav-link-mobile flex items-center gap-4 px-5 py-4 rounded-xl text-xl transition-colors text-red-500 hover:bg-red-100 dark:hover:bg-red-900/20">
                            <i data-lucide="log-out" class="w-7 h-7"></i>
                            <span>Logout</span>
                        </a>
                    </form>
                    @endauth
                 </nav>
             </div>
        </div>

        <!-- Main Content: Margin and padding adjusted -->
        <main class="main-content flex-1 lg:ml-[288px] p-6 pt-24 sm:p-8 sm:pt-24 lg:p-10 lg:pt-8 overflow-y-auto scroll-smooth">
            @yield('content')

            <footer class="mt-12 text-center text-sm text-slate-600 dark:text-slate-400 py-6">
                <p>© 2025 by Faishal. All rights reserved.</p>
            </footer>
        </main>
    </div>
    
    <button id="back-to-top" class="fixed bottom-8 right-8 bg-blue-600 dark:bg-sky-600 text-white p-3 rounded-full shadow-md opacity-0 transform translate-y-4 z-50 hover:bg-blue-700 dark:hover:bg-sky-700 transition-all duration-300">
        <i data-lucide="arrow-up" class="w-6 h-6"></i>
    </button>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- DARK MODE TOGGLE ---
            const themeToggleDesktop = document.getElementById('theme-toggle-desktop');
            const themeToggleMobile = document.getElementById('theme-toggle-mobile');
            const htmlElement = document.documentElement;

            const applyTheme = () => {
                if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    htmlElement.classList.add('dark');
                } else {
                    htmlElement.classList.remove('dark');
                }
                setTimeout(() => lucide.createIcons(), 0);
            };

            const toggleTheme = () => {
                htmlElement.classList.toggle('dark');
                localStorage.setItem('theme', htmlElement.classList.contains('dark') ? 'dark' : 'light');
                lucide.createIcons();
            };

            themeToggleDesktop.addEventListener('click', toggleTheme);
            themeToggleMobile.addEventListener('click', toggleTheme);
            applyTheme();

            // --- NAVIGATION ---
            const menuToggle = document.getElementById('menu-toggle');
            const mobileMenu = document.getElementById('mobile-menu');
            const burgerIcon = document.getElementById('burger-icon');
            const closeIcon = document.getElementById('close-icon');
            
            if(menuToggle) {
                menuToggle.addEventListener('click', () => {
                    mobileMenu.classList.toggle('translate-x-full');
                    burgerIcon.classList.toggle('hidden');
                    closeIcon.classList.toggle('hidden');
                });
            }

            // --- BACK TO TOP BUTTON ---
            const backToTopButton = document.getElementById('back-to-top');
            const mainContent = document.querySelector('.main-content');
            mainContent.addEventListener('scroll', () => {
                if (mainContent.scrollTop > 300) {
                    backToTopButton.classList.remove('opacity-0', 'translate-y-4');
                } else {
                    backToTopButton.classList.add('opacity-0', 'translate-y-4');
                }
            });

            backToTopButton.addEventListener('click', () => {
                mainContent.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            // --- COPY EMAIL BUTTON ---
            const copyEmailBtn = document.getElementById('copy-email-btn');
            const emailTextEl = document.getElementById('email-text');
            
            if (copyEmailBtn && emailTextEl) {
                const emailText = "anwarfaishal86@gmail.com";
                copyEmailBtn.addEventListener('click', () => {
                    const textarea = document.createElement('textarea');
                    textarea.value = emailText;
                    document.body.appendChild(textarea);
                    textarea.select();
                    try {
                        document.execCommand('copy');
                        copyEmailBtn.innerHTML = '<i data-lucide="check" class="w-5 h-5 text-green-500"></i>';
                        lucide.createIcons();
                    } catch (err) {
                        console.error('Failed to copy email: ', err);
                        copyEmailBtn.innerHTML = '<i data-lucide="x" class="w-5 h-5 text-red-500"></i>';
                        lucide.createIcons();
                    }
                    document.body.removeChild(textarea);

                    setTimeout(() => {
                        copyEmailBtn.innerHTML = '<i data-lucide="copy" class="w-5 h-5 text-secondary"></i>';
                        lucide.createIcons();
                    }, 2000);
                });
            }

            // --- SERVICE CARD ACCORDION ---
            const serviceCards = document.querySelectorAll('.service-card');
            serviceCards.forEach(card => {
                card.addEventListener('click', (e) => {
                    if (e.target.closest('a')) return;
                    
                    const isAlreadyActive = card.classList.contains('active');

                    // Close all cards
                    serviceCards.forEach(c => c.classList.remove('active'));

                    // If the card was not already active, open it
                    if (!isAlreadyActive) {
                        card.classList.add('active');
                    }
                });
            });
        });

        // --- FINAL INITIALIZATION ON WINDOW LOAD ---
        window.onload = () => {
            const mainContent = document.querySelector('.main-content');
            // Ensure the page is at the top
            mainContent.scrollTo({ top: 0, behavior: 'instant' });

            // Initialize AOS
            AOS.init({
                duration: 800,
                once: true,
                offset: 100,
            });

            // Fade in the main content now that everything is truly ready
            mainContent.style.opacity = '1';
        };
    </script>
    <script>
        // Lenis Smooth Scroll
        const lenis = new Lenis({
            duration: 1.2,
            lerp: 0.08,
            easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
            smoothTouch: true,
        });

        function raf(time) {
            lenis.raf(time);
            requestAnimationFrame(raf);
        }

        requestAnimationFrame(raf);
    </script>

    @stack('scripts')
</body>
</html>