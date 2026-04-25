@extends('layouts.app')

@section('title', $project->title)

@section('head')
<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<style>
    .swiper { width: 100%; height: 100%; border-radius: 2rem; }
    .swiper-slide img { width: 100%; height: 100%; object-cover: cover; }
    .swiper-button-next, .swiper-button-prev { color: var(--text-main); background: var(--bg-primary); width: 3rem; height: 3rem; border-radius: 99px; border: 1px solid var(--border-subtle); shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); }
    .swiper-button-next:after, .swiper-button-prev:after { font-size: 1.25rem; font-weight: bold; }
    .swiper-pagination-bullet-active { background: var(--text-main); }
</style>
@endsection

@section('content')
<div class="max-w-5xl mx-auto space-y-24">
    <section data-aos="fade-up" class="space-y-8 pt-8 text-main">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
            <a href="{{ route('projects') }}" class="flex items-center gap-2 text-muted hover:text-main transition-colors uppercase text-[10px] font-bold tracking-widest"><i data-lucide="arrow-left" class="w-4 h-4 text-main"></i> Back to Projects</a>
            <div class="flex items-center gap-4 text-main">
                <div class="flex items-center gap-2 px-3 py-1.5 border border-border-subtle rounded-full text-xs font-bold uppercase tracking-widest text-muted bg-secondary/50 text-main">
                    <span class="relative flex h-2 w-2"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span><span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span></span>
                    Case Study
                </div>
            </div>
        </div>
        
        <div class="space-y-4 text-left">
            <h2 class="text-5xl sm:text-7xl font-bold tracking-tighter text-main uppercase">{{ $project->title }}</h2>
            <p class="text-xl text-muted max-w-3xl font-light leading-relaxed">{{ $project->description }}</p>
        </div>

        <!-- Slider Section -->
        <div class="aspect-video relative border border-border-subtle rounded-[2rem] overflow-hidden bg-zinc-50 dark:bg-zinc-900/50">
            @if($project->gallery && count($project->gallery) > 0)
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        @foreach($project->gallery as $image)
                        <div class="swiper-slide">
                            <img src="{{ strpos($image, 'http') === 0 ? $image : asset('storage/' . $image) }}" alt="Project image" class="object-cover">
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

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-16 text-left">
        <div class="lg:col-span-2 space-y-12">
            <section class="space-y-6">
                <h3 class="text-2xl font-bold text-main">Case Study</h3>
                <div class="text-muted leading-relaxed text-justify text-main whitespace-pre-line">
                    {{ $project->case_study ?? 'Case study content coming soon...' }}
                </div>
            </section>
        </div>

        <aside class="space-y-12">
            <div class="space-y-6 text-left">
                <h4 class="text-xs font-bold uppercase tracking-widest text-muted">Year</h4>
                <p class="text-main font-bold text-lg">{{ $project->year }}</p>
            </div>
            <div class="space-y-6 text-left">
                <h4 class="text-xs font-bold uppercase tracking-widest text-muted">Stack</h4>
                <div class="flex flex-wrap gap-2 text-main">
                    @foreach($project->tags as $tag)
                    <span class="px-3 py-1 border border-border-subtle rounded-lg text-[10px] font-bold uppercase tracking-widest text-muted">{{ $tag }}</span>
                    @endforeach
                </div>
            </div>
            @if($project->github_url)
            <div class="space-y-6 text-left">
                <h4 class="text-xs font-bold uppercase tracking-widest text-muted">Links</h4>
                <a href="{{ $project->github_url }}" target="_blank" class="flex items-center gap-2 font-bold text-main hover:opacity-60 transition-all">
                    <i data-lucide="github" class="w-5 h-5"></i> GitHub Repository
                </a>
            </div>
            @endif
        </aside>
    </div>

    <!-- CTA Section -->
    <section data-aos="zoom-in" class="glass-card p-16 text-center space-y-8 elite-grid text-main">
        <h2 class="text-4xl font-bold tracking-tight max-w-2xl mx-auto text-main uppercase">Interested in this project?</h2>
        <a href="{{ route('contact') }}" class="px-10 py-5 bg-black dark:bg-white text-white dark:text-black rounded-2xl font-bold transition-transform hover:scale-[1.05] inline-block uppercase text-xs tracking-widest text-main">Let's Talk</a>
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
        if (typeof Swiper !== 'undefined') {
            const swiper = new Swiper(".mySwiper", {
                loop: true,
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
