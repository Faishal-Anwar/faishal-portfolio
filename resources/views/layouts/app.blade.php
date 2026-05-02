<!DOCTYPE html>
<html lang="en" class="scroll-smooth text-main font-light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | {{ $profile->name }}</title>
    <meta name="description" content="Portfolio of {{ $profile->name }} - {{ $profile->title }}. Specializing in Machine Learning, Data Engineering, and Cloud Architecture.">
    <meta name="keywords" content="Portfolio, {{ $profile->name }}, {{ $profile->title }}, Machine Learning Engineer, Data Engineer, Cloud Architect">
    <meta name="author" content="{{ $profile->name }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title') | {{ $profile->name }}">
    <meta property="og:description" content="Professional portfolio of {{ $profile->name }}, an expert in {{ $profile->title }}.">
    <meta property="og:image" content="{{ $profile->image ? (strpos($profile->image, 'http') === 0 ? $profile->image : asset('storage/' . $profile->image)) : asset('images/profile.png') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title') | {{ $profile->name }}">
    <meta property="twitter:description" content="Professional portfolio of {{ $profile->name }}, an expert in {{ $profile->title }}.">
    <meta property="twitter:image" content="{{ $profile->image ? (strpos($profile->image, 'http') === 0 ? $profile->image : asset('storage/' . $profile->image)) : asset('images/profile.png') }}">
    
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: { 
                        zinc: { 950: '#09090b' },
                        main: 'var(--text-main)',
                        muted: 'var(--text-muted)',
                        secondary: 'var(--bg-secondary)',
                        primary: 'var(--bg-primary)',
                        "border-subtle": 'var(--border-subtle)',
                    },
                    fontFamily: { sans: ['Inter', 'sans-serif'], display: ['Instrument Sans', 'sans-serif'] }
                }
            }
        }
    </script>
    
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/studio-freight/lenis@1.0.42/bundled/lenis.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.12/typed.min.js"></script>

    @yield('head')

    <style>
        :root {
            --bg-primary: #ffffff; --bg-secondary: #fafafa; --text-main: #09090b; --text-muted: #71717a;
            --border-subtle: #e4e4e7; --accent-glow: rgba(0, 0, 0, 0.05); --sidebar-w: 18rem;
            --grid-dot: rgba(0, 0, 0, 0.08);
        }
        html.dark {
            --bg-primary: #09090b; --bg-secondary: #121214; --text-main: #fafafa; --text-muted: #a1a1aa;
            --border-subtle: #27272a; --accent-glow: rgba(255, 255, 255, 0.05);
            --grid-dot: rgba(255, 255, 255, 0.07);
        }
        
        /* Global Scaling Logic */
        html { 
            overflow-y: scroll; 
            scrollbar-gutter: stable; 
            font-size: 16px; 
        }
        
        @media (min-width: 1024px) {
            html { font-size: 16px; } 
            :root { --sidebar-w: 18rem; }
        }

        body { 
            background: var(--bg-primary); 
            color: var(--text-main); 
            transition: background-color 0.4s ease-in-out, color 0.4s ease-in-out; 
            line-height: 1.6;
        }
        
        h1, h2, h3, h4 { font-family: 'Instrument Sans', sans-serif; letter-spacing: -0.02em; }
        
        .sidebar { 
            width: var(--sidebar-w); 
            background: var(--bg-secondary); 
            border-right: 1px solid var(--border-subtle); 
            transition: background-color 0.4s ease-in-out, border-color 0.4s ease-in-out, width 0.4s ease;
        }
        
        .glass-card { 
            background: var(--bg-primary); 
            border: 1px solid var(--border-subtle); 
            transition: all 0.5s cubic-bezier(0.2, 0.8, 0.2, 1), background-color 0.4s ease-in-out, border-color 0.4s ease-in-out; 
            border-radius: 1.25rem; 
        }
        .glass-card:hover { border-color: var(--text-main); transform: translateY(-0.4rem) scale(1.01); box-shadow: 0 1.5rem 3rem -0.75rem rgba(0,0,0,0.1); }
        html.dark .glass-card:hover { box-shadow: 0 1.5rem 3rem -0.75rem rgba(0,0,0,0.5); }

        .nav-link { color: var(--text-muted); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); font-weight: 500; font-size: 0.9rem; border-radius: 0.5rem; padding: 0.6rem 1rem; display: flex; align-items: center; gap: 0.75rem; }
        .nav-link:hover { color: var(--text-main); background: var(--accent-glow); transform: translateX(0.25rem); }
        .nav-link.active { font-weight: 600; color: var(--text-main); background: var(--accent-glow); }

        .elite-grid { background-image: radial-gradient(var(--grid-dot) 1.2px, transparent 1.2px); background-size: 2rem 2rem; }
        .main-content { opacity: 1; transition: opacity 0.6s ease; }
        
        .project-card { 
            border: 1px solid var(--border-subtle); 
            border-radius: 1.5rem; 
            overflow: hidden; 
            transition: all 0.6s cubic-bezier(0.2, 0.8, 0.2, 1), background-color 0.4s ease-in-out, border-color 0.4s ease-in-out; 
            background: var(--bg-primary); 
        }
        .project-card:hover { border-color: var(--text-main); transform: translateY(-0.5rem) scale(1.01); box-shadow: 0 2rem 4rem -1rem rgba(0,0,0,0.15); }
        html.dark .project-card:hover { box-shadow: 0 2rem 4rem -1rem rgba(0,0,0,0.7); }

        .stack-icon-mini { width: 2rem; height: 2rem; transition: 0.4s cubic-bezier(0.4, 0, 0.2, 1); }
        .stack-icon-mini:hover { transform: scale(1.15) rotate(5deg); }
        
        .mobile-header { 
            background: var(--bg-primary); 
            border: 1px solid var(--border-subtle);
            box-shadow: 0 0.25rem 1.25rem -0.3rem rgba(0,0,0,0.1);
            transition: background-color 0.4s ease-in-out, border-color 0.4s ease-in-out;
        }
        
        .nav-link-mobile { display: flex; align-items: center; gap: 1rem; padding: 1rem 1.25rem; border-radius: 0.75rem; transition: all 0.3s ease; color: var(--text-muted); }
        .nav-link-mobile:hover { background: var(--accent-glow); transform: translateX(0.5rem); }
        .nav-link-mobile.active { background: var(--accent-glow); color: var(--text-main); font-weight: 700; }
        
        .typed-cursor { opacity: 1; animation: blink 0.7s infinite; font-weight: 300; }
        @keyframes blink { 0% { opacity: 1; } 50% { opacity: 0; } 100% { opacity: 1; } }

        /* Mobile Nav Overlay Fix */
        .mobile-nav-overlay {
            position: fixed;
            inset: 0;
            z-index: 100;
            background: var(--bg-primary);
            transform: translateX(-100%);
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .mobile-nav-overlay.open {
            transform: translateX(0);
        }

        /* Timeline for About Page */
        .timeline-item { border-left: 1px solid var(--border-subtle); padding-left: 1.5rem; position: relative; padding-bottom: 3rem; transition: all 0.4s ease; cursor: default; }
        .timeline-item:hover { border-left-color: var(--text-main); background: var(--accent-glow); border-radius: 0 0.75rem 0.75rem 0; }
        .timeline-dot { width: 0.6rem; height: 0.6rem; background: var(--text-main); border-radius: 99px; position: absolute; left: -0.31rem; top: 0.5rem; transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .timeline-item:hover .timeline-dot { transform: scale(1.5); }

        /* Stack Page Specifics */
        .stack-card { border: 1px solid var(--border-subtle); border-radius: 1rem; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1), background-color 0.4s ease-in-out, border-color 0.4s ease-in-out; padding: 1.5rem; background: var(--bg-primary); }
        .stack-card:hover { border-color: var(--text-main); transform: translateY(-0.25rem); box-shadow: 0 0.6rem 1.5rem -0.3rem rgba(0,0,0,0.05); }
        .stack-icon { transition: 0.5s cubic-bezier(0.4, 0, 0.2, 1); width: 2.5rem; height: 2.5rem; }
        .stack-card:hover .stack-icon { transform: scale(1.2) rotate(8deg); }

        /* Form for Contact */
        .form-input { background: var(--bg-secondary); border: 1px solid var(--border-subtle); width: 100%; padding: 0.75rem 1rem; border-radius: 0.75rem; transition: 0.3s; color: var(--text-main); }
        .form-input:focus { border-color: var(--text-main); outline: none; }
    </style>
</head>
<body class="overflow-x-hidden">
    <div class="flex min-h-screen relative text-main font-light">
        
        @include('partials.sidebar')
        @include('partials.mobile-header')
        @include('partials.mobile-nav')

        <main class="main-content flex-1 lg:ml-[var(--sidebar-w)] p-6 pt-24 lg:pt-20 sm:p-12 lg:p-20 elite-grid">
            @yield('content')
        </main>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            try { lucide.createIcons(); } catch(e) { console.error(e); }
            try { AOS.init({ duration: 800, once: true, offset: 50 }); } catch(e) { console.error(e); }
            
            try {
                const html = document.documentElement;
                const themeToggles = [document.getElementById('theme-toggle'), document.getElementById('theme-toggle-mobile')];
                themeToggles.forEach(btn => { 
                    if(btn) btn.addEventListener('click', () => { 
                        const isDark = html.classList.toggle('dark'); 
                        localStorage.setItem('theme', isDark ? 'dark' : 'light'); 
                        
                        // Force Lucide to re-process icons to handle hidden/block state changes
                        if (window.lucide) {
                            setTimeout(() => {
                                lucide.createIcons();
                            }, 10);
                        }
                    }); 
                });
            } catch(e) { console.error(e); }
            
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
            } catch(e) { console.error(e); }
            
            try {
                if (typeof Lenis !== 'undefined') {
                    const lenis = new Lenis({ duration: 1.1, lerp: 0.1 });
                    function raf(time) { lenis.raf(time); requestAnimationFrame(raf); }
                    requestAnimationFrame(raf);
                }
            } catch(e) { console.error(e); }
        });
    </script>
    @yield('scripts')
</body>
</html>
