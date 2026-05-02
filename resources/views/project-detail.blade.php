@extends('layouts.app')

@section('title', $project->title)

@section('head')
<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<style>
    .swiper { width: 100%; height: 100%; }
    .swiper-slide { width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; }
    .swiper-slide img { width: 100%; height: 100%; object-fit: cover; }
    .swiper-button-next, .swiper-button-prev { color: var(--text-main); background: var(--bg-primary); width: 3rem; height: 3rem; border-radius: 99px; border: 1px solid var(--border-subtle); box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); z-index: 10; }
    .swiper-button-next:after, .swiper-button-prev:after { font-size: 1.25rem; font-weight: bold; }
    .swiper-pagination-bullet-active { background: var(--text-main); }
    
    @media (max-width: 640px) {
        .swiper-button-next, .swiper-button-prev { width: 2.25rem; height: 2.25rem; }
        .swiper-button-next:after, .swiper-button-prev:after { font-size: 1rem; }
    }
</style>
@endsection

@section('content')
<div class="max-w-5xl mx-auto space-y-16 sm:space-y-24">
    <section data-aos="fade-up" class="space-y-8 pt-6 sm:pt-8 text-main">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
            <a href="{{ route('projects') }}" class="flex items-center gap-2 text-muted hover:text-main transition-colors uppercase text-[9px] sm:text-[10px] font-bold tracking-widest"><i data-lucide="arrow-left" class="w-4 h-4 text-main"></i> Back to Projects</a>
            <div class="flex items-center gap-4 text-main">
                <div class="flex items-center gap-2 px-3 py-1.5 border border-border-subtle rounded-full text-[9px] sm:text-xs font-bold uppercase tracking-widest text-muted bg-secondary/50 text-main">
                    <span class="relative flex h-2 w-2"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span><span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span></span>
                    Case Study
                </div>
            </div>
        </div>
        
        <div class="space-y-4 text-left">
            <h2 class="text-3xl sm:text-5xl lg:text-7xl font-bold tracking-tighter text-main uppercase leading-tight">{{ $project->title }}</h2>
            <p class="text-lg sm:text-xl text-muted max-w-3xl font-light leading-relaxed text-justify sm:text-left">{{ $project->description }}</p>
        </div>

        <!-- Slider Section -->
        <div class="aspect-video relative border border-border-subtle rounded-2xl sm:rounded-[2rem] overflow-hidden bg-zinc-50 dark:bg-zinc-900/50">
            @if($project->gallery && count($project->gallery) > 0)
                <div class="swiper mySwiper absolute inset-0">
                    <div class="swiper-wrapper">
                        @foreach($project->gallery as $image)
                        <div class="swiper-slide">
                            <img src="{{ strpos($image, 'http') === 0 ? $image : asset('storage/' . $image) }}" alt="Project image" class="w-full h-full object-cover">
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>
            @elseif($project->image)
                <img src="{{ strpos($project->image, 'http') === 0 ? $project->image : asset('storage/' . $project->image) }}" class="w-full h-full object-cover" alt="{{ $project->title }}">
            @else
                <div class="w-full h-full flex items-center justify-center opacity-10">
                    <div class="absolute inset-0 elite-grid"></div>
                    <i data-lucide="{{ $project->icon }}" class="w-32 h-32 text-main"></i>
                </div>
            @endif
        </div>
    </section>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 sm:gap-16 text-left">
        <div class="lg:col-span-2 space-y-8 sm:space-y-12">
            <section class="space-y-4 sm:space-y-6">
                <h3 class="text-xl sm:text-2xl font-bold text-main">Case Study</h3>
                <div class="text-sm sm:text-base text-muted leading-relaxed text-justify text-main whitespace-pre-line">
                    {{ $project->case_study ?? 'Case study content coming soon...' }}
                </div>
            </section>
        </div>

        <aside class="space-y-8 sm:space-y-12">
            <div class="space-y-3 sm:space-y-6 text-left">
                <h4 class="text-[10px] sm:text-xs font-bold uppercase tracking-widest text-muted">Year</h4>
                <p class="text-main font-bold text-base sm:text-lg">{{ $project->year }}</p>
            </div>
            <div class="space-y-3 sm:space-y-6 text-left">
                <h4 class="text-[10px] sm:text-xs font-bold uppercase tracking-widest text-muted">Stack</h4>
                <div class="flex flex-wrap gap-2 text-main">
                    @foreach($project->tags as $tag)
                    <span class="px-2 sm:px-3 py-1 border border-border-subtle rounded-lg text-[9px] sm:text-[10px] font-bold uppercase tracking-widest text-muted">{{ $tag }}</span>
                    @endforeach
                </div>
            </div>
            @if($project->github_url)
            <div class="space-y-3 sm:space-y-6 text-left">
                <h4 class="text-[10px] sm:text-xs font-bold uppercase tracking-widest text-muted">Links</h4>
                <div class="flex flex-col gap-3">
                    <a href="{{ $project->github_url }}" target="_blank" class="glass-card p-4 flex justify-between items-center group transition-all duration-300">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 flex items-center justify-center bg-secondary dark:bg-zinc-900 border border-border-subtle rounded-xl shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-main"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 3.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>
                            </div>
                            <div class="flex flex-col text-left">
                                <span class="text-[9px] font-bold uppercase tracking-widest text-muted">Code</span>
                                <span class="text-sm font-bold text-main">GitHub Repository</span>
                            </div>
                        </div>
                        <i data-lucide="external-link" class="w-4 h-4 text-muted group-hover:text-main transition-colors"></i>
                    </a>
                </div>
            </div>
            @endif
        </aside>
    </div>

    <!-- CTA Section -->
    <section data-aos="zoom-in" class="glass-card p-8 sm:p-16 text-center space-y-6 sm:space-y-8 elite-grid text-main">
        <h2 class="text-2xl sm:text-4xl font-bold tracking-tight max-w-2xl mx-auto text-main uppercase">Interested in this project?</h2>
        <a href="{{ route('contact') }}" class="px-8 py-4 sm:px-10 sm:py-5 bg-black dark:bg-white text-white dark:text-black rounded-2xl font-bold transition-transform hover:scale-[1.05] inline-block uppercase text-[10px] sm:text-xs tracking-widest text-main">Let's Talk</a>
    </section>

    <footer class="py-20 border-t border-border-subtle text-center text-[10px] font-bold tracking-widest uppercase text-muted opacity-50 text-main">
        © 2025 by Faishal. All rights reserved.
    </footer>
</div>
@endsection

@section('scripts')
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Lucide Icons again for this page to ensure visibility
        if (window.lucide) {
            lucide.createIcons();
        }

        if (typeof Swiper !== 'undefined') {
            const swiper = new Swiper(".mySwiper", {
                loop: true,
                observer: true,
                observeParents: true,
                autoplay: {
                    delay: 3500,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
            });
        }
    });
</script>
@endsection
