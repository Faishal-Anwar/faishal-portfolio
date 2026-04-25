<!DOCTYPE html>
<html lang="en" class="scroll-smooth text-main font-light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | {{ $profile->name }}</title>
    
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
            --border-subtle: #e4e4e7; --accent-glow: rgba(0, 0, 0, 0.05); --sidebar-w: 280px;
            --grid-dot: rgba(0, 0, 0, 0.08);
        }
        html.dark {
            --bg-primary: #09090b; --bg-secondary: #121214; --text-main: #fafafa; --text-muted: #a1a1aa;
            --border-subtle: #27272a; --accent-glow: rgba(255, 255, 255, 0.05);
            --grid-dot: rgba(255, 255, 255, 0.07);
        }
        html { overflow-y: scroll; scrollbar-gutter: stable; }
        body { 
            background: var(--bg-primary); 
            color: var(--text-main); 
            transition: background-color 0.4s ease-in-out, color 0.4s ease-in-out; 
        }
        button i { width: 1.25rem; height: 1.25rem; }
        h1, h2, h3, h4 { font-family: 'Instrument Sans', sans-serif; letter-spacing: -0.02em; }
        
        .sidebar { 
            width: var(--sidebar-w); 
            background: var(--bg-secondary); 
            border-right: 1px solid var(--border-subtle); 
            transition: background-color 0.4s ease-in-out, border-color 0.4s ease-in-out;
        }
        
        .glass-card { 
            background: var(--bg-primary); 
            border: 1px solid var(--border-subtle); 
            transition: all 0.5s cubic-bezier(0.2, 0.8, 0.2, 1), background-color 0.4s ease-in-out, border-color 0.4s ease-in-out; 
            border-radius: 1.5rem; 
        }
        .glass-card:hover { border-color: var(--text-main); transform: translateY(-6px) scale(1.01); box-shadow: 0 25px 50px -12px rgba(0,0,0,0.1); }
        html.dark .glass-card:hover { box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5); }

        .nav-link { color: var(--text-muted); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); font-weight: 500; font-size: 0.925rem; border-radius: 8px; padding: 0.625rem 1rem; display: flex; align-items: center; gap: 0.75rem; }
        .nav-link:hover { color: var(--text-main); background: var(--accent-glow); transform: translateX(4px); }
        .nav-link.active { font-weight: 600; color: var(--text-main); background: var(--accent-glow); }

        .elite-grid { background-image: radial-gradient(var(--grid-dot) 1.2px, transparent 1.2px); background-size: 32px 32px; }
        .main-content { opacity: 1; transition: opacity 0.6s ease; }
        .mobile-nav-overlay { background: var(--bg-primary); position: fixed; inset: 0; z-index: 100; transform: translateX(100%); transition: 0.4s ease; }
        .mobile-nav-overlay.open { transform: translateX(0); }

        .project-card { 
            border: 1px solid var(--border-subtle); 
            border-radius: 2rem; 
            overflow: hidden; 
            transition: all 0.6s cubic-bezier(0.2, 0.8, 0.2, 1), background-color 0.4s ease-in-out, border-color 0.4s ease-in-out; 
            background: var(--bg-primary); 
        }
        .project-card:hover { border-color: var(--text-main); transform: translateY(-8px) scale(1.01); box-shadow: 0 30px 60px -15px rgba(0,0,0,0.15); }
        html.dark .project-card:hover { box-shadow: 0 30px 60px -15px rgba(0,0,0,0.7); }

        .stack-icon-mini { width: 32px; height: 32px; transition: 0.4s cubic-bezier(0.4, 0, 0.2, 1); }
        .stack-icon-mini:hover { transform: scale(1.15) rotate(5deg); }
        
        .mobile-header { 
            background: var(--bg-primary); 
            border: 1px solid var(--border-subtle);
            box-shadow: 0 4px 20px -5px rgba(0,0,0,0.1);
            transition: background-color 0.4s ease-in-out, border-color 0.4s ease-in-out;
        }
        html.dark .mobile-header { border-color: rgba(255, 255, 255, 0.1); }
        
        #theme-toggle-mobile { transition: all 0.3s ease; }
        html.dark #theme-toggle-mobile { border-color: rgba(255, 255, 255, 0.15); background: rgba(255, 255, 255, 0.03); }
        .nav-link-mobile { display: flex; align-items: center; gap: 1.25rem; padding: 1.25rem 1.5rem; border-radius: 1rem; transition: all 0.3s ease; color: var(--text-muted); }
        .nav-link-mobile:hover { background: var(--accent-glow); transform: translateX(8px); }
        .nav-link-mobile.active { background: var(--accent-glow); color: var(--text-main); font-weight: 700; }
        
        .typed-cursor { opacity: 1; animation: blink 0.7s infinite; font-weight: 300; }
        @keyframes blink { 0% { opacity: 1; } 50% { opacity: 0; } 100% { opacity: 1; } }

        /* Timeline for About Page */
        .timeline-item { border-left: 1px solid var(--border-subtle); padding-left: 2rem; position: relative; padding-bottom: 4rem; transition: all 0.4s ease; cursor: default; }
        .timeline-item:hover { border-left-color: var(--text-main); background: var(--accent-glow); border-radius: 0 1rem 1rem 0; }
        .timeline-dot { width: 10px; height: 10px; background: var(--text-main); border-radius: 99px; position: absolute; left: -5px; top: 8px; transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .timeline-item:hover .timeline-dot { transform: scale(1.5); }

        /* Stack Page Specifics */
        .stack-card { border: 1px solid var(--border-subtle); border-radius: 1.5rem; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1), background-color 0.4s ease-in-out, border-color 0.4s ease-in-out; padding: 2rem; background: var(--bg-primary); }
        .stack-card:hover { border-color: var(--text-main); transform: translateY(-4px); box-shadow: 0 10px 25px -5px rgba(0,0,0,0.05); }
        .stack-icon { transition: 0.5s cubic-bezier(0.4, 0, 0.2, 1); width: 40px; height: 40px; }
        .stack-card:hover .stack-icon { transform: scale(1.2) rotate(8deg); }

        /* Form for Contact */
        .form-input { background: var(--bg-secondary); border: 1px solid var(--border-subtle); width: 100%; padding: 0.75rem 1rem; border-radius: 0.75rem; transition: 0.3s; color: var(--text-main); }
        .form-input:focus { border-color: var(--text-main); outline: none; }
    </style>
</head>
<body class="overflow-x-hidden">
    <div class="flex min-h-screen relative text-main font-light">
        
        <!-- Sidebar (Desktop) -->
        <aside class="sidebar fixed top-0 bottom-0 left-0 z-[60] hidden lg:flex flex-col p-10">
            <div class="mb-10 text-main">
                @if($profile->image)
                <img src="{{ strpos($profile->image, 'http') === 0 ? $profile->image : asset('storage/' . $profile->image) }}" alt="Profile" class="w-full aspect-square rounded-3xl object-cover mb-8 shadow-sm">
                @else
                <img src="{{ asset('images/profile.png') }}" alt="Profile" class="w-full aspect-square rounded-3xl object-cover mb-8 shadow-sm">
                @endif
                <h1 class="text-3xl font-bold tracking-tight">{{ $profile->name }}</h1>
            </div>
            <div class="mb-8 text-left">
                <a href="{{ route('download.cv') }}" download class="flex items-center gap-2 px-4 py-2 bg-zinc-100 dark:bg-zinc-900 border border-black border-border-subtle dark:border-white rounded-xl text-xs font-bold uppercase tracking-widest hover:bg-zinc-200 dark:hover:bg-zinc-800 transition-colors text-main">
                    <i data-lucide="download" class="w-3 h-3"></i> Download CV
                </a>
            </div>
            <nav class="flex flex-col gap-1.5 flex-1 text-main text-left">
                @auth
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.*') ? 'active' : '' }} border-b border-border-subtle/50 mb-2 pb-3"><i data-lucide="layout-dashboard" class="w-4 h-4"></i> Dashboard</a>
                @endauth
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"><i data-lucide="home" class="w-4 h-4"></i> Home</a>
                <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}"><i data-lucide="user-circle" class="w-4 h-4"></i> About Me</a>
                <a href="{{ route('projects') }}" class="nav-link {{ request()->routeIs('projects') ? 'active' : '' }}"><i data-lucide="folder-kanban" class="w-4 h-4"></i> Projects</a>
                <a href="{{ route('stack') }}" class="nav-link {{ request()->routeIs('stack') ? 'active' : '' }}"><i data-lucide="layers" class="w-4 h-4"></i> Stack</a>
                <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"><i data-lucide="mail" class="w-4 h-4"></i> Contact</a>
            </nav>
            <div class="mt-auto pt-10 border-t border-border-subtle space-y-8 text-main text-left">
                <!-- Social Links -->
                <div class="flex gap-5">
                    @if($profile->github_url) <a href="{{ $profile->github_url }}" target="_blank" class="text-muted hover:text-main transition-all duration-300 hover:-translate-y-1 hover:scale-110"><i data-lucide="github" class="w-5 h-5"></i></a> @endif
                    @if($profile->linkedin_url) <a href="{{ $profile->linkedin_url }}" target="_blank" class="text-muted hover:text-main transition-all duration-300 hover:-translate-y-1 hover:scale-110"><i data-lucide="linkedin" class="w-5 h-5"></i></a> @endif
                    @if($profile->instagram_url) <a href="{{ $profile->instagram_url }}" target="_blank" class="text-muted hover:text-main transition-all duration-300 hover:-translate-y-1 hover:scale-110"><i data-lucide="instagram" class="w-5 h-5"></i></a> @endif
                </div>

                <!-- Theme Toggle (Refined Premium Style) -->
                <button id="theme-toggle" class="flex items-center gap-3 group w-full text-left transition-all duration-300 hover:-translate-y-1">
                    <div class="w-10 h-10 bg-secondary border border-border-subtle rounded-xl flex items-center justify-center transition-all duration-300 group-hover:border-main group-hover:bg-main group-hover:text-primary">
                        <i data-lucide="sun" class="w-4 h-4 block dark:hidden transition-transform group-hover:rotate-12"></i>
                        <i data-lucide="moon" class="w-4 h-4 hidden dark:block transition-transform group-hover:-rotate-12"></i>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[10px] font-bold uppercase tracking-widest text-muted group-hover:text-main transition-colors duration-300">Theme</span>
                        <span class="text-[9px] font-medium uppercase tracking-widest text-muted/50 dark:hidden">Light Mode</span>
                        <span class="text-[9px] font-medium uppercase tracking-widest text-muted/50 hidden dark:block">Dark Mode</span>
                    </div>
                </button>
            </div>
        </aside>

        <!-- Header (Mobile) -->
        <header class="lg:hidden fixed top-6 left-6 right-6 z-[60] mobile-header rounded-2xl h-16 flex items-center px-4 backdrop-blur-md bg-white/70 dark:bg-black/70">
            <div class="flex justify-between items-center w-full font-bold">
                <div class="flex items-center gap-3 text-left">
                    @if($profile->image)
                    <img src="{{ strpos($profile->image, 'http') === 0 ? $profile->image : asset('storage/' . $profile->image) }}" alt="Profile" class="w-8 h-8 rounded-full object-cover">
                    @else
                    <img src="{{ asset('images/profile.png') }}" alt="Profile" class="w-8 h-8 rounded-full object-cover">
                    @endif
                    <span class="font-bold tracking-tight text-base text-main">{{ $profile->name }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <button id="theme-toggle-mobile" class="w-10 h-10 flex items-center justify-center text-main bg-secondary/50 rounded-xl border border-border-subtle/50 transition-all hover:scale-105 active:scale-95">
                        <i data-lucide="sun" class="w-5 h-5 block dark:hidden"></i>
                        <i data-lucide="moon" class="w-5 h-5 hidden dark:block"></i>
                    </button>
                    <button id="mobile-menu-open" class="p-2 text-main"><i data-lucide="menu" class="w-6 h-6"></i></button>
                </div>
            </div>
        </header>

        <!-- Mobile Nav Overlay -->
        <div id="mobile-nav" class="mobile-nav-overlay lg:hidden flex flex-col p-8 backdrop-blur-xl text-left">
            <div class="flex justify-between items-center mb-12 text-left">
                <div class="flex items-center gap-3">
                    @if($profile->image)
                    <img src="{{ strpos($profile->image, 'http') === 0 ? $profile->image : asset('storage/' . $profile->image) }}" alt="Profile" class="w-10 h-10 rounded-full object-cover">
                    @else
                    <img src="{{ asset('images/profile.png') }}" alt="Profile" class="w-10 h-10 rounded-full object-cover">
                    @endif
                    <span class="font-bold tracking-tight text-lg text-main">{{ $profile->name }}</span>
                </div>
                <button id="mobile-menu-close" class="p-2"><i data-lucide="x" class="w-7 h-7 text-main"></i></button>
            </div>
            <nav class="flex flex-col gap-4 text-left font-bold">
                @auth
                <a href="{{ route('admin.dashboard') }}" class="nav-link-mobile {{ request()->routeIs('admin.*') ? 'active' : '' }} border-b border-border-subtle/30 pb-4 mb-2"><i data-lucide="layout-dashboard" class="w-6 h-6"></i><span>Dashboard</span></a>
                @endauth
                <a href="{{ route('home') }}" class="nav-link-mobile {{ request()->routeIs('home') ? 'active' : '' }}"><i data-lucide="home" class="w-6 h-6"></i><span>Home</span></a>
                <a href="{{ route('about') }}" class="nav-link-mobile {{ request()->routeIs('about') ? 'active' : '' }}"><i data-lucide="user-circle" class="w-6 h-6"></i><span>About Me</span></a>
                <a href="{{ route('projects') }}" class="nav-link-mobile {{ request()->routeIs('projects') ? 'active' : '' }}"><i data-lucide="folder-kanban" class="w-6 h-6"></i><span>Projects</span></a>
                <a href="{{ route('stack') }}" class="nav-link-mobile {{ request()->routeIs('stack') ? 'active' : '' }}"><i data-lucide="layers" class="w-6 h-6"></i><span>Stack</span></a>
                <a href="{{ route('contact') }}" class="nav-link-mobile {{ request()->routeIs('contact') ? 'active' : '' }}"><i data-lucide="mail" class="w-6 h-6"></i><span>Contact</span></a>
            </nav>
            <div class="mt-auto pt-8 border-t border-border-subtle flex flex-col gap-8">
                <a href="{{ route('download.cv') }}" download class="nav-link-mobile"><i data-lucide="download" class="w-6 h-6"></i><span>Download CV</span></a>
                <div class="flex justify-center gap-8">
                    @if($profile->github_url) <a href="{{ $profile->github_url }}" target="_blank" class="text-muted hover:text-main transition-colors"><i data-lucide="github" class="w-6 h-6 text-main"></i></a> @endif
                    @if($profile->linkedin_url) <a href="{{ $profile->linkedin_url }}" target="_blank" class="text-muted hover:text-main transition-colors"><i data-lucide="linkedin" class="w-6 h-6 text-main"></i></a> @endif
                    @if($profile->instagram_url) <a href="{{ $profile->instagram_url }}" target="_blank" class="text-muted hover:text-main transition-colors"><i data-lucide="instagram" class="w-6 h-6 text-main"></i></a> @endif
                </div>
            </div>
        </div>

        <main class="main-content flex-1 lg:ml-[280px] p-6 pt-24 sm:p-12 lg:p-24 elite-grid">
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
                        setTimeout(() => lucide.createIcons(), 10); 
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