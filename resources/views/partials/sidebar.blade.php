<!-- Sidebar (Desktop) -->
<aside class="sidebar fixed top-0 bottom-0 left-0 z-[60] hidden lg:flex flex-col p-10">
    <div class="mb-6 text-main text-left">
        @if($profile->image)
        @php $profileImg = \App\Helpers\CloudinaryHelper::optimize($profile->image, 400); @endphp
        <img src="{{ strpos($profile->image, 'http') === 0 ? $profileImg : asset('storage/' . $profile->image) }}" alt="Profile" class="w-full aspect-square rounded-2xl object-cover mb-6 shadow-sm" loading="lazy">
        @else
        <img src="{{ asset('images/profile.png') }}" alt="Profile" class="w-full aspect-square rounded-2xl object-cover mb-6 shadow-sm" loading="lazy">
        @endif
        <h1 class="text-2xl font-bold tracking-tight">{{ $profile->name }}</h1>
        <p class="text-xs text-muted font-bold uppercase tracking-widest mt-1">{{ $profile->title }}</p>
    </div>
    <div class="mb-4 text-left">
        <a href="{{ route('download.cv') }}" download class="flex items-center gap-2 px-4 py-2 bg-zinc-100 dark:bg-zinc-900 border border-border-subtle dark:border-zinc-700 rounded-xl text-[0.7rem] font-bold uppercase tracking-widest hover:bg-zinc-200 dark:hover:bg-zinc-800 transition-colors text-main">
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
    <div class="mt-auto pt-6 border-t border-border-subtle space-y-6 text-main text-left">

        <!-- Theme Toggle -->
        <button id="theme-toggle" aria-label="Toggle Dark Mode" class="flex items-center gap-3 group w-full text-left transition-all duration-300 hover:-translate-y-1">
            <div class="w-10 h-10 bg-secondary border border-border-subtle rounded-xl flex items-center justify-center transition-all duration-300 group-hover:border-main group-hover:bg-main group-hover:text-primary relative">
                <i data-lucide="sun" class="w-4 h-4 sun-icon dark:opacity-0 dark:invisible absolute transition-all duration-300 group-hover:rotate-12"></i>
                <i data-lucide="moon" class="w-4 h-4 moon-icon opacity-0 invisible dark:opacity-100 dark:visible absolute transition-all duration-300 group-hover:-rotate-12"></i>
            </div>
            <div class="flex flex-col">
                <span class="text-[0.6rem] font-bold uppercase tracking-widest text-muted group-hover:text-main transition-colors duration-300">Theme</span>
                <span class="text-[0.55rem] font-medium uppercase tracking-widest text-muted/50 dark:hidden">Light Mode</span>
                <span class="text-[0.55rem] font-medium uppercase tracking-widest text-muted/50 hidden dark:block">Dark Mode</span>
            </div>
        </button>
    </div>
</aside>
