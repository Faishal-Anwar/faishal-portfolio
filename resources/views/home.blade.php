@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="max-w-6xl mx-auto space-y-16 sm:space-y-24 text-main">
                
    <div data-aos="fade-up">
        <section id="hero" class="space-y-8 sm:space-y-12 py-6 sm:py-12">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6 sm:gap-8">
                <div class="space-y-3 text-left w-full sm:w-auto">
                    <h2 class="text-4xl sm:text-5xl font-bold tracking-tight text-main">Faishal Anwar</h2>
                    <p class="text-xl sm:text-2xl text-muted font-medium min-h-[2rem]">
                        <span id="typed-text"></span>
                    </p>
                </div>
                <div class="flex flex-row items-center gap-3 sm:gap-6 w-full sm:w-auto">
                    <div class="flex-1 sm:flex-none flex items-center justify-center gap-2 px-3 sm:px-4 py-2.5 border border-border-subtle rounded-full text-[9px] sm:text-xs font-bold uppercase tracking-widest text-muted bg-secondary/50 whitespace-nowrap">
                        <span class="relative flex h-2 w-2 sm:h-2.5 sm:w-2.5"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span><span class="relative inline-flex rounded-full h-2 w-2 sm:h-2.5 sm:w-2.5 bg-green-500"></span></span>
                        Available
                    </div>
                    <a href="{{ route('contact') }}" class="flex-1 sm:flex-none text-center px-4 sm:px-8 py-3 sm:py-4 bg-black dark:bg-white text-white dark:text-black rounded-xl font-bold transition-transform hover:scale-[1.05] text-[10px] sm:text-sm whitespace-nowrap">Contact Me</a>
                </div>
            </div>
            <p class="text-lg sm:text-2xl text-muted leading-relaxed font-light text-justify">
                Hey 👋, I'm Faishal. I specialize in building scalable AI solutions, robust data pipelines, and architecting secure cloud infrastructures. I am dedicated to transforming complex datasets into actionable intelligence and designing resilient systems that empower data-driven innovation at scale.
            </p>
        </section>
    </div>

    <section class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-10 text-left">
        @foreach($coreSkills as $skill)
        <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
            <div class="glass-card p-6 sm:p-10 space-y-4 sm:space-y-6 group h-full">
                <div class="w-12 h-12 sm:w-14 sm:h-14 bg-zinc-100 dark:bg-zinc-900 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform text-main">
                    <i data-lucide="{{ $skill->icon }}" class="w-6 h-6 sm:w-7 sm:h-7 text-main"></i>
                </div>
                <h3 class="text-xl sm:text-2xl font-bold text-main">{{ $skill->title }}</h3>
                <p class="text-sm sm:text-base text-muted leading-relaxed">{{ $skill->description }}</p>
            </div>
        </div>
        @endforeach
    </section>

    <div data-aos="fade-up">
        <section class="space-y-12 sm:space-y-16">
            <h2 class="font-bold tracking-tight uppercase text-muted text-xs tracking-[0.3em] text-left">About Me</h2>
            <div class="glass-card p-6 sm:p-12 elite-grid">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 sm:gap-16 text-left">
                    <div class="flex gap-4 sm:gap-8">
                        <div class="w-12 h-12 sm:w-14 sm:h-14 bg-zinc-100 dark:bg-zinc-900 rounded-2xl flex items-center justify-center shrink-0"><i data-lucide="graduation-cap" class="w-6 h-6 sm:w-7 sm:h-7 text-main"></i></div>
                        <div>
                            <h4 class="font-bold text-lg sm:text-xl text-main">Education</h4>
                            <p class="text-sm sm:text-base text-muted mt-1">Undergraduate Student, Technical Informatics<br>UNISSULA • Present</p>
                        </div>
                    </div>
                    <div class="flex gap-4 sm:gap-8">
                        <div class="w-12 h-12 sm:w-14 sm:h-14 bg-zinc-100 dark:bg-zinc-900 rounded-2xl flex items-center justify-center shrink-0"><i data-lucide="briefcase" class="w-6 h-6 sm:w-7 sm:h-7 text-main"></i></div>
                        <div>
                            <h4 class="font-bold text-lg sm:text-xl text-main">Experience</h4>
                            <p class="text-sm sm:text-base text-muted mt-1">Practicum Assistant (Algorithms & Basic Programming)<br>UNISSULA • Past</p>
                        </div>
                    </div>
                    <div class="flex gap-4 sm:gap-8">
                        <div class="w-12 h-12 sm:w-14 sm:h-14 bg-zinc-100 dark:bg-zinc-900 rounded-2xl flex items-center justify-center shrink-0"><i data-lucide="book-open" class="w-6 h-6 sm:w-7 sm:h-7 text-main"></i></div>
                        <div>
                            <h4 class="font-bold text-lg sm:text-xl text-main">Non-Formal Education</h4>
                            <p class="text-sm sm:text-base text-muted mt-1">IDCamp Facilitator for Gen AI<br>IDCamp • 2026</p>
                        </div>
                    </div>
                    <div class="flex gap-4 sm:gap-8">
                        <div class="w-12 h-12 sm:w-14 sm:h-14 bg-zinc-100 dark:bg-zinc-900 rounded-2xl flex items-center justify-center shrink-0"><i data-lucide="award" class="w-6 h-6 sm:w-7 sm:h-7 text-main"></i></div>
                        <div>
                            <h4 class="font-bold text-lg sm:text-xl text-main">Certification</h4>
                            <p class="text-sm sm:text-base text-muted mt-1">Google Student Ambassador<br>Google • 2026</p>
                        </div>
                    </div>
                </div>
                <div class="mt-8 sm:mt-12 pt-6 sm:pt-10 border-t border-border-subtle flex justify-end">
                    <a href="{{ route('about') }}" class="text-[10px] sm:text-sm font-bold uppercase tracking-widest flex items-center gap-3 hover:opacity-60 transition-opacity text-main">View Full Profile <i data-lucide="arrow-right" class="w-4 h-4 sm:w-5 sm:h-5"></i></a>
                </div>
            </div>
        </section>
    </div>

    @if($featuredProject)
    <div data-aos="fade-up">
        <section class="space-y-8 sm:space-y-10">
            <h2 class="font-bold tracking-tight uppercase text-muted text-xs tracking-[0.3em] text-left">Featured Project</h2>
            <div class="project-card group grid grid-cols-1 lg:grid-cols-2 overflow-hidden border border-border-subtle rounded-3xl">
                <div class="aspect-video lg:aspect-auto bg-zinc-100 dark:bg-zinc-900 flex items-center justify-center overflow-hidden relative border-b lg:border-b-0 lg:border-r border-border-subtle">
                    @if($featuredProject->image)
                    <img src="{{ strpos($featuredProject->image, 'http') === 0 ? $featuredProject->image : asset('storage/' . $featuredProject->image) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="{{ $featuredProject->title }}">
                    @else
                    <div class="absolute inset-0 elite-grid opacity-10"></div>
                    <i data-lucide="{{ $featuredProject->icon }}" class="w-20 h-20 sm:w-32 sm:h-32 text-blue-600 dark:text-blue-400 transition-transform group-hover:scale-110"></i>
                    @endif
                </div>
                <div class="p-6 sm:p-10 lg:p-12 space-y-5 sm:space-y-6 flex flex-col justify-center text-left">
                    <div class="space-y-2 sm:space-y-3">
                        <h4 class="text-lg sm:text-xl font-bold text-main leading-tight">{{ $featuredProject->title }}</h4>
                        <p class="text-sm sm:text-base text-muted leading-relaxed font-light text-justify">{{ $featuredProject->description }}</p>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @foreach($featuredProject->tags as $tag)
                        <span class="text-[8px] sm:text-[9px] font-bold text-muted uppercase tracking-widest border border-border-subtle px-2 py-1 rounded-md">{{ $tag }}</span>
                        @endforeach
                    </div>
                    <div class="pt-5 sm:pt-6 border-t border-border-subtle">
                        <a href="{{ route('project-detail', $featuredProject->slug) }}" class="w-full sm:w-auto text-center px-8 py-3 bg-black dark:bg-white text-white dark:text-black rounded-xl font-bold transition-transform hover:scale-[1.02] inline-block uppercase text-[9px] sm:text-xs tracking-widest">View Project</a>
                    </div>
                </div>
            </div>
            <div class="mt-4 sm:mt-6 pt-6 sm:pt-8 border-t border-border-subtle flex justify-end">
                <a href="{{ route('projects') }}" class="text-[10px] sm:text-sm font-bold uppercase tracking-widest flex items-center gap-3 hover:opacity-60 transition-opacity text-main">View All Projects <i data-lucide="arrow-right" class="w-4 h-4 sm:w-5 sm:h-5"></i></a>
            </div>
        </section>
    </div>
    @endif

    <div data-aos="fade-up">
        <section class="space-y-12 sm:space-y-16">
            <h2 class="font-bold tracking-tight uppercase text-muted text-xs tracking-[0.3em] text-left">Top Tech Stack</h2>
            <div class="glass-card p-8 sm:p-12 text-main">
                <div class="grid grid-cols-3 sm:grid-cols-6 gap-8 sm:gap-12 items-center justify-items-center">
                    @foreach($topStacks as $stack)
                    <div class="group flex flex-col items-center gap-3 sm:gap-4">
                        <img src="{{ $stack->icon_url }}" class="w-8 h-8 sm:stack-icon-mini" alt="{{ $stack->name }}">
                        <span class="text-[10px] sm:text-xs font-bold text-muted uppercase tracking-widest opacity-0 group-hover:opacity-100 transition-opacity">{{ $stack->name }}</span>
                    </div>
                    @endforeach
                </div>
                <div class="mt-8 sm:mt-12 pt-6 sm:pt-10 border-t border-border-subtle flex justify-end">
                    <a href="{{ route('stack') }}" class="text-[10px] sm:text-sm font-bold uppercase tracking-widest flex items-center gap-3 hover:opacity-60 transition-opacity text-main">Full Stack <i data-lucide="arrow-right" class="w-4 h-4 sm:w-5 sm:h-5"></i></a>
                </div>
            </div>
        </section>
    </div>

    <div data-aos="zoom-in">
        <section class="glass-card p-10 sm:p-20 text-center space-y-6 sm:space-y-8 elite-grid">
            <h2 class="text-3xl sm:text-5xl font-bold tracking-tight text-main">Do you have any project idea?</h2>
            <a href="{{ route('contact') }}" class="px-8 py-4 sm:px-10 sm:py-5 bg-black dark:bg-white text-white dark:text-black rounded-2xl font-bold transition-transform hover:scale-105 inline-block uppercase text-[10px] sm:text-xs tracking-widest">Let's Talk</a>
        </section>
    </div>

    <footer class="py-12 sm:py-24 border-t border-border-subtle text-center text-[10px] sm:text-xs font-bold tracking-[0.2em] text-muted opacity-50 uppercase text-main">© 2026 by {{ $profile->name }}. All rights reserved.</footer>
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
