<!-- Header (Mobile) -->
<header class="lg:hidden fixed top-6 left-6 right-6 z-[60] mobile-header rounded-2xl h-16 flex items-center px-4 backdrop-blur-md">
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
            <!-- Theme Toggle -->
            <button id="theme-toggle-mobile" aria-label="Toggle Dark Mode" class="flex items-center justify-center w-10 h-10 bg-secondary border border-border-subtle rounded-xl transition-all duration-300 hover:border-main hover:bg-main group active:scale-95 shadow-sm relative">
                <i data-lucide="sun" class="w-4 h-4 sun-icon dark:opacity-0 dark:invisible absolute transition-all duration-300 group-hover:text-primary group-hover:rotate-12"></i>
                <i data-lucide="moon" class="w-4 h-4 moon-icon opacity-0 invisible dark:opacity-100 dark:visible absolute transition-all duration-300 group-hover:text-primary group-hover:-rotate-12"></i>
            </button>
            
            <!-- Mobile Menu Toggle -->
            <button id="mobile-menu-open" aria-label="Open Mobile Menu" class="flex items-center justify-center w-10 h-10 bg-secondary border border-border-subtle rounded-xl transition-all duration-300 hover:border-main hover:bg-main group active:scale-95 shadow-sm">
                <i data-lucide="menu" class="w-5 h-5 transition-all duration-300 group-hover:text-primary"></i>
            </button>
        </div>
    </div>
</header>
