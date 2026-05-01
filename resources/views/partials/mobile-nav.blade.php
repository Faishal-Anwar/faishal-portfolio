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
