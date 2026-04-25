@extends('layouts.app')

@section('title', 'Contact')

@section('content')
<div class="max-w-5xl mx-auto space-y-20">
    <div data-aos="fade-up">
        <section class="space-y-6 pt-8 text-center lg:text-left text-main">
            <h2 class="text-5xl sm:text-7xl font-bold tracking-tighter text-main text-left">Let's Connect!</h2>
            <p class="text-xl text-muted font-light leading-relaxed text-justify text-left text-main">I’m always open to discussing advanced AI projects, complex data architecture, or cloud infrastructure optimizations. Let’s build something impactful together.</p>
        </section>
    </div>

    @if(session('success'))
    <div data-aos="fade-down" class="glass-card p-6 border-green-500/20 bg-green-500/5 text-green-500 text-center font-bold uppercase text-xs tracking-widest">
        {{ session('success') }}
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-main">
        <!-- Email Card -->
        <div data-aos="fade-up" data-aos-delay="0">
            <div id="email-card" class="glass-card p-6 sm:p-8 flex justify-between items-center group h-full cursor-pointer overflow-hidden">
                <div class="flex items-center gap-4 sm:gap-6 min-w-0">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-zinc-100 dark:bg-zinc-900 rounded-xl sm:rounded-2xl flex items-center justify-center shrink-0">
                        <i id="email-icon" data-lucide="mail" class="w-5 h-5 sm:w-6 sm:h-6 text-zinc-900 dark:text-zinc-100"></i>
                    </div>
                    <div class="flex flex-col text-left min-w-0">
                        <span id="email-text" class="font-bold text-base sm:text-lg text-main truncate">{{ $profile->email }}</span>
                    </div>
                </div>
                <div class="flex items-center justify-center shrink-0 ml-3 sm:ml-4">
                    <i data-lucide="copy" class="w-4 h-4 sm:w-5 sm:h-5 text-muted group-hover:text-zinc-900 dark:group-hover:text-zinc-100 transition-colors"></i>
                </div>
            </div>
        </div>
        
        <!-- LinkedIn Card -->
        @if($profile->linkedin_url)
        <div data-aos="fade-up" data-aos-delay="100">
            <a href="{{ $profile->linkedin_url }}" target="_blank" class="glass-card p-8 flex justify-between items-center group text-left block h-full">
                <div class="flex items-center gap-6">
                    <div class="w-12 h-12 bg-zinc-100 dark:bg-zinc-900 rounded-2xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 text-zinc-900 dark:text-zinc-100"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>
                    </div>
                    <span class="font-bold text-lg text-main">LinkedIn</span>
                </div>
                <i data-lucide="arrow-up-right" class="w-6 h-6 text-muted group-hover:text-zinc-900 dark:group-hover:text-zinc-100 transition-colors"></i>
            </a>
        </div>
        @endif

        <!-- GitHub Card -->
        @if($profile->github_url)
        <div data-aos="fade-up" data-aos-delay="200">
            <a href="{{ $profile->github_url }}" target="_blank" class="glass-card p-8 flex justify-between items-center group text-left block h-full">
                <div class="flex items-center gap-6">
                    <div class="w-12 h-12 bg-zinc-100 dark:bg-zinc-900 rounded-2xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 text-zinc-900 dark:text-zinc-100"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 3.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>
                    </div>
                    <span class="font-bold text-lg text-main">GitHub</span>
                </div>
                <i data-lucide="arrow-up-right" class="w-6 h-6 text-muted group-hover:text-zinc-900 dark:group-hover:text-zinc-100 transition-colors"></i>
            </a>
        </div>
        @endif

        <!-- Instagram Card -->
        @if($profile->instagram_url)
        <div data-aos="fade-up" data-aos-delay="300">
            <a href="{{ $profile->instagram_url }}" target="_blank" class="glass-card p-8 flex justify-between items-center group text-left block h-full">
                <div class="flex items-center gap-6">
                    <div class="w-12 h-12 bg-zinc-100 dark:bg-zinc-900 rounded-2xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 text-zinc-900 dark:text-zinc-100"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                    </div>
                    <span class="font-bold text-lg text-main">Instagram</span>
                </div>
                <i data-lucide="arrow-up-right" class="w-6 h-6 text-muted group-hover:text-zinc-900 dark:group-hover:text-zinc-100 transition-colors"></i>
            </a>
        </div>
        @endif
    </div>

    <div data-aos="fade-up" class="space-y-12 text-left">
        <h3 class="text-3xl font-bold tracking-tight uppercase text-muted text-xs tracking-[0.3em] text-left">Get in touch</h3>
        <div class="glass-card p-10 lg:p-12 text-left">
            <form action="{{ route('contact.store') }}" method="POST" class="space-y-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-left">
                    <div class="space-y-3">
                        <label class="text-[10px] font-bold uppercase tracking-widest text-muted ml-1">Name</label>
                        <input type="text" name="name" placeholder="Budi Santoso" required class="form-input">
                    </div>
                    <div class="space-y-3">
                        <label class="text-[10px] font-bold uppercase tracking-widest text-muted ml-1">Email</label>
                        <input type="email" name="email" placeholder="budi@gmail.com" required class="form-input">
                    </div>
                </div>
                <div class="space-y-3 text-left">
                    <label class="text-[10px] font-bold uppercase tracking-widest text-muted ml-1">Message</label>
                    <textarea name="message" rows="6" placeholder="Type something here..." required class="form-input"></textarea>
                </div>
                <div class="pt-4 text-left">
                    <button type="submit" class="w-full md:w-fit px-12 py-4 bg-black dark:bg-white text-white dark:text-black rounded-2xl font-bold hover:scale-[1.02] transition-all uppercase tracking-widest text-xs">Send Message</button>
                </div>
            </form>
        </div>
    </div>

    <footer class="py-20 border-t border-border-subtle text-center text-[10px] font-bold tracking-widest uppercase text-muted opacity-50 text-main">
        © 2025 by {{ $profile->name }}. All rights reserved.
    </footer>
</div>
@endsection

@section('scripts')
<script>
    // Ensure Lucide icons are rendered
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    const emailCard = document.getElementById('email-card');
    const emailIcon = document.getElementById('email-icon');
    
    if (emailCard) {
        emailCard.addEventListener('click', () => {
            navigator.clipboard.writeText("{{ $profile->email }}").then(() => {
                // Visual Feedback
                const originalIconName = emailIcon.getAttribute('data-lucide');
                
                // Temporary change to success state
                emailIcon.setAttribute('data-lucide', 'check');
                emailIcon.classList.remove('text-zinc-900', 'dark:text-zinc-100');
                emailIcon.classList.add('text-green-500');
                lucide.createIcons();
                
                setTimeout(() => {
                    emailIcon.setAttribute('data-lucide', 'mail');
                    emailIcon.classList.remove('text-green-500');
                    emailIcon.classList.add('text-zinc-900', 'dark:text-zinc-100');
                    lucide.createIcons();
                }, 2000);
            });
        });
    }
</script>
@endsection
