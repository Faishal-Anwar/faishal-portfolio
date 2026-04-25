@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="max-w-5xl mx-auto space-y-20 text-main">
                
    <div data-aos="fade-up">
        <section id="hero" class="space-y-10 py-10">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
                <div class="space-y-2 text-left">
                    <h2 class="text-4xl font-bold tracking-tight text-main">Faishal Anwar</h2>
                    <p class="text-xl text-muted font-medium min-h-[1.75rem]">
                        <span id="typed-text"></span>
                    </p>                </div>
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-2 px-3 py-1.5 border border-border-subtle rounded-full text-xs font-bold uppercase tracking-widest text-muted bg-secondary/50">
                        <span class="relative flex h-2 w-2"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span><span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span></span>
                        Available for Project
                    </div>
                    <a href="{{ route('contact') }}" class="px-6 py-3 bg-black dark:bg-white text-white dark:text-black rounded-xl font-bold transition-transform hover:scale-[1.05]">Contact Me</a>
                </div>
            </div>
            <p class="text-xl text-muted leading-relaxed font-light text-justify">
                Hey 👋, I'm Faishal. I specialize in building scalable AI solutions, robust data pipelines, and architecting secure cloud infrastructures. I am dedicated to transforming complex datasets into actionable intelligence and designing resilient systems that empower data-driven innovation at scale.
            </p>
        </section>
    </div>

    <section class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
        @foreach($skills as $skill)
        <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
            <div class="glass-card p-8 space-y-4 group h-full">
                <div class="w-12 h-12 bg-zinc-100 dark:bg-zinc-900 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform text-main">
                    <i data-lucide="{{ $skill->icon }}" class="w-6 h-6 text-main"></i>
                </div>
                <h3 class="text-xl font-bold text-main">{{ $skill->title }}</h3>
                <p class="text-sm text-muted leading-relaxed">{{ $skill->description }}</p>
            </div>
        </div>
        @endforeach
    </section>

    <div data-aos="fade-up">
        <section class="space-y-12">
            <h2 class="text-2xl font-bold tracking-tight uppercase text-muted text-xs tracking-[0.3em] text-left">About Me</h2>
            <div class="glass-card p-10 elite-grid">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 text-left">
                    <div class="flex gap-6">
                        <div class="w-12 h-12 bg-zinc-100 dark:bg-zinc-900 rounded-2xl flex items-center justify-center shrink-0"><i data-lucide="graduation-cap" class="w-6 h-6 text-main"></i></div>
                        <div>
                            <h4 class="font-bold text-lg text-main">Education</h4>
                            <p class="text-sm text-muted mt-1">Undergraduate Student, Technical Informatics<br>UNISSULA • Present</p>
                        </div>
                    </div>
                    <div class="flex gap-6">
                        <div class="w-12 h-12 bg-zinc-100 dark:bg-zinc-900 rounded-2xl flex items-center justify-center shrink-0"><i data-lucide="briefcase" class="w-6 h-6 text-main"></i></div>
                        <div>
                            <h4 class="font-bold text-lg text-main">Experience</h4>
                            <p class="text-sm text-muted mt-1">Practicum Assistant (Algorithms & Basic Programming)<br>UNISSULA • Past</p>
                        </div>
                    </div>
                    <div class="flex gap-6">
                        <div class="w-12 h-12 bg-zinc-100 dark:bg-zinc-900 rounded-2xl flex items-center justify-center shrink-0"><i data-lucide="book-open" class="w-6 h-6 text-main"></i></div>
                        <div>
                            <h4 class="font-bold text-lg text-main">Non-Formal Education</h4>
                            <p class="text-sm text-muted mt-1">IDCamp Facilitator for Gen AI<br>IDCamp • 2026</p>
                        </div>
                    </div>
                    <div class="flex gap-6">
                        <div class="w-12 h-12 bg-zinc-100 dark:bg-zinc-900 rounded-2xl flex items-center justify-center shrink-0"><i data-lucide="award" class="w-6 h-6 text-main"></i></div>
                        <div>
                            <h4 class="font-bold text-lg text-main">Certification</h4>
                            <p class="text-sm text-muted mt-1">Google Student Ambassador<br>Google • 2026</p>
                        </div>
                    </div>
                </div>
                <div class="mt-12 pt-8 border-t border-border-subtle flex justify-end">
                    <a href="{{ route('about') }}" class="text-xs font-bold uppercase tracking-widest flex items-center gap-2 hover:opacity-60 transition-opacity text-main">View Full Profile <i data-lucide="arrow-right" class="w-4 h-4"></i></a>
                </div>
            </div>
        </section>
    </div>

    @if($featuredProject)
    <div data-aos="fade-up">
        <section class="space-y-12">
            <h2 class="text-2xl font-bold tracking-tight uppercase text-muted text-xs tracking-[0.3em] text-left">Featured Project</h2>
            <div class="project-card group grid grid-cols-1 lg:grid-cols-2">
                <div class="aspect-square lg:aspect-auto bg-blue-50 dark:bg-blue-950/30 flex items-center justify-center overflow-hidden relative border-r border-border-subtle">
                     <div class="absolute inset-0 elite-grid opacity-10"></div>
                    @if($featuredProject->image)
                    <img src="{{ strpos($featuredProject->image, 'http') === 0 ? $featuredProject->image : asset('storage/' . $featuredProject->image) }}" class="w-full h-full object-cover transition-transform group-hover:scale-110" alt="{{ $featuredProject->title }}">
                    @else
                    <i data-lucide="{{ $featuredProject->icon }}" class="w-32 h-32 text-blue-600 dark:text-blue-400 transition-transform group-hover:scale-110"></i>
                    @endif                </div>
                <div class="p-12 space-y-8 flex flex-col justify-center text-left">
                    <div class="space-y-4">
                        <span class="text-[10px] font-bold text-muted uppercase tracking-[0.2em]">MOST RECENT</span>
                        <h4 class="text-4xl font-bold tracking-tight text-main uppercase">{{ $featuredProject->title }}</h4>
                        <p class="text-muted leading-relaxed font-light text-justify">{{ $featuredProject->description }}</p>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @foreach($featuredProject->tags as $tag)
                        <span class="text-[9px] font-bold text-muted uppercase tracking-widest border border-border-subtle px-2 py-1 rounded-lg">{{ $tag }}</span>
                        @endforeach
                    </div>
                    <div class="pt-8 border-t border-border-subtle">
                        <a href="{{ route('project-detail', $featuredProject->slug) }}" class="px-8 py-4 bg-black dark:bg-white text-white dark:text-black rounded-full font-bold transition-transform hover:scale-[1.02] inline-block uppercase text-xs tracking-widest">View Case Study</a>
                    </div>
                </div>
            </div>
            <div class="mt-12 pt-8 border-t border-border-subtle flex justify-end">
                <a href="{{ route('projects') }}" class="text-xs font-bold uppercase tracking-widest flex items-center gap-2 hover:opacity-60 transition-opacity text-main">View All Projects <i data-lucide="arrow-right" class="w-4 h-4"></i></a>
            </div>
        </section>
    </div>
    @endif

    <div data-aos="fade-up">
        <section class="space-y-12">
            <h2 class="text-2xl font-bold tracking-tight uppercase text-muted text-xs tracking-[0.3em] text-left">Top Tech Stack</h2>
            <div class="glass-card p-10 text-main">
                <div class="grid grid-cols-3 sm:grid-cols-6 gap-8 items-center justify-items-center">
                    @foreach($topStacks as $stack)
                    <div class="group flex flex-col items-center gap-3">
                        <img src="{{ $stack->icon_url }}" class="stack-icon-mini" alt="{{ $stack->name }}">
                        <span class="text-[10px] font-bold text-muted uppercase tracking-widest opacity-0 group-hover:opacity-100 transition-opacity">{{ $stack->name }}</span>
                    </div>
                    @endforeach
                </div>
                <div class="mt-12 pt-8 border-t border-border-subtle flex justify-end">
                    <a href="{{ route('stack') }}" class="text-xs font-bold uppercase tracking-widest flex items-center gap-2 hover:opacity-60 transition-opacity text-main">Full Stack <i data-lucide="arrow-right" class="w-4 h-4"></i></a>
                </div>
            </div>
        </section>
    </div>

    <div data-aos="zoom-in">
        <section class="glass-card p-16 text-center space-y-8 elite-grid">
            <h2 class="text-4xl font-bold tracking-tight text-main uppercase">Do you have any project idea?</h2>
            <a href="{{ route('contact') }}" class="px-10 py-5 bg-black dark:bg-white text-white dark:text-black rounded-2xl font-bold transition-transform hover:scale-[1.05] inline-block uppercase text-xs tracking-widest text-main">Contact Me</a>
        </section>
    </div>

    <footer class="py-20 border-t border-border-subtle text-center text-[10px] font-bold tracking-[0.2em] text-muted opacity-50 uppercase text-main">© 2026 by {{ $profile->name }}. All rights reserved.</footer>
</div>
@endsection

@section('scripts')
<script>
    try {
        if (window.Typed && document.getElementById('typed-text')) {
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
</script>
@endsection
