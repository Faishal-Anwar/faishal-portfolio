@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="max-w-6xl mx-auto space-y-24 text-main">
                
    <div data-aos="fade-up">
        <section id="hero" class="space-y-12 py-12">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-8">
                <div class="space-y-3 text-left">
                    <h2 class="text-5xl font-bold tracking-tight text-main">Faishal Anwar</h2>
                    <p class="text-2xl text-muted font-medium min-h-[2rem]">
                        <span id="typed-text"></span>
                    </p>                </div>
                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-3 px-4 py-2 border border-border-subtle rounded-full text-xs font-bold uppercase tracking-widest text-muted bg-secondary/50">
                        <span class="relative flex h-2.5 w-2.5"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span><span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-green-500"></span></span>
                        Available for Project
                    </div>
                    <a href="{{ route('contact') }}" class="px-8 py-4 bg-black dark:bg-white text-white dark:text-black rounded-xl font-bold transition-transform hover:scale-[1.05] text-sm">Contact Me</a>
                </div>
            </div>
            <p class="text-2xl text-muted leading-relaxed font-light text-justify">
                Hey 👋, I'm Faishal. I specialize in building scalable AI solutions, robust data pipelines, and architecting secure cloud infrastructures. I am dedicated to transforming complex datasets into actionable intelligence and designing resilient systems that empower data-driven innovation at scale.
            </p>
        </section>
    </div>

    <section class="grid grid-cols-1 md:grid-cols-3 gap-10 text-left">
        @foreach($coreSkills as $skill)
        <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
            <div class="glass-card p-10 space-y-6 group h-full">
                <div class="w-14 h-14 bg-zinc-100 dark:bg-zinc-800 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i data-lucide="{{ $skill->icon }}" class="w-7 h-7 text-zinc-900 dark:text-zinc-100"></i>
                </div>
                <h3 class="text-2xl font-bold text-main">{{ $skill->title }}</h3>
                <p class="text-base text-muted leading-relaxed">{{ $skill->description }}</p>
            </div>
        </div>
        @endforeach
    </section>

    <div data-aos="fade-up">
        <section class="space-y-16">
            <h2 class="font-bold tracking-tight uppercase text-muted text-xs tracking-[0.3em] text-left">About Me</h2>
            <div class="glass-card p-12 elite-grid">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-16 text-left">
                    <div class="flex gap-8">
                        <div class="w-14 h-14 bg-zinc-100 dark:bg-zinc-800 rounded-2xl flex items-center justify-center shrink-0"><i data-lucide="graduation-cap" class="w-7 h-7 text-zinc-900 dark:text-zinc-100"></i></div>
                        <div>
                            <h4 class="font-bold text-xl text-main">Education</h4>
                            <p class="text-base text-muted mt-1">Undergraduate Student, Technical Informatics<br>UNISSULA • Present</p>
                        </div>
                    </div>
                    <div class="flex gap-8">
                        <div class="w-14 h-14 bg-zinc-100 dark:bg-zinc-800 rounded-2xl flex items-center justify-center shrink-0"><i data-lucide="briefcase" class="w-7 h-7 text-zinc-900 dark:text-zinc-100"></i></div>
                        <div>
                            <h4 class="font-bold text-xl text-main">Experience</h4>
                            <p class="text-base text-muted mt-1">Practicum Assistant (Algorithms & Basic Programming)<br>UNISSULA • Past</p>
                        </div>
                    </div>
                    <div class="flex gap-8">
                        <div class="w-14 h-14 bg-zinc-100 dark:bg-zinc-800 rounded-2xl flex items-center justify-center shrink-0"><i data-lucide="book-open" class="w-7 h-7 text-zinc-900 dark:text-zinc-100"></i></div>
                        <div>
                            <h4 class="font-bold text-xl text-main">Non-Formal Education</h4>
                            <p class="text-base text-muted mt-1">IDCamp Facilitator for Gen AI<br>IDCamp • 2026</p>
                        </div>
                    </div>
                    <div class="flex gap-8">
                        <div class="w-14 h-14 bg-zinc-100 dark:bg-zinc-800 rounded-2xl flex items-center justify-center shrink-0"><i data-lucide="award" class="w-7 h-7 text-zinc-900 dark:text-zinc-100"></i></div>
                        <div>
                            <h4 class="font-bold text-xl text-main">Certification</h4>
                            <p class="text-base text-muted mt-1">Google Student Ambassador<br>Google • 2026</p>
                        </div>
                    </div>
                </div>
                <div class="mt-12 pt-10 border-t border-border-subtle flex justify-end">
                    <a href="{{ route('about') }}" class="text-sm font-bold uppercase tracking-widest flex items-center gap-3 hover:opacity-60 transition-opacity text-main">View Full Profile <i data-lucide="arrow-right" class="w-5 h-5"></i></a>
                </div>
            </div>
        </section>
    </div>

    @if($featuredProject)
    <div data-aos="fade-up">
        <section class="space-y-16">
            <h2 class="font-bold tracking-tight uppercase text-muted text-xs tracking-[0.3em] text-left">Featured Project</h2>
            <div class="project-card group grid grid-cols-1 lg:grid-cols-2">
                <div class="aspect-square lg:aspect-auto bg-blue-50 dark:bg-blue-950/30 flex items-center justify-center overflow-hidden relative border-r border-border-subtle">
                     <div class="absolute inset-0 elite-grid opacity-10"></div>
                    @if($featuredProject->image)
                    @php $featImg = \App\Helpers\CloudinaryHelper::optimize($featuredProject->image, 800); @endphp
                    <img src="{{ strpos($featuredProject->image, 'http') === 0 ? $featImg : asset('storage/' . $featuredProject->image) }}" class="w-full h-full object-cover transition-transform group-hover:scale-110" alt="{{ $featuredProject->title }}" loading="lazy">
                    @else
                    <i data-lucide="{{ $featuredProject->icon }}" class="w-40 h-40 text-blue-600 dark:text-blue-400 transition-transform group-hover:scale-110"></i>
                    @endif                </div>
                <div class="p-16 space-y-10 flex flex-col justify-center text-left">
                    <div class="space-y-6">
                        <span class="text-xs font-bold text-muted uppercase tracking-[0.2em]">MOST RECENT</span>
                        <h4 class="text-5xl font-bold tracking-tight text-main uppercase">{{ $featuredProject->title }}</h4>
                        <p class="text-xl text-muted leading-relaxed font-light text-justify">{{ $featuredProject->description }}</p>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        @foreach($featuredProject->tags as $tag)
                        <span class="text-xs font-bold text-muted uppercase tracking-widest border border-border-subtle px-3 py-1.5 rounded-lg">{{ $tag }}</span>
                        @endforeach
                    </div>
                    <div class="pt-10 border-t border-border-subtle">
                        <a href="{{ route('project-detail', $featuredProject->slug) }}" class="px-10 py-5 bg-black dark:bg-white text-white dark:text-black rounded-full font-bold transition-transform hover:scale-[1.02] inline-block uppercase text-sm tracking-widest">View Project</a>
                    </div>
                </div>
            </div>
            <div class="mt-12 pt-10 border-t border-border-subtle flex justify-end">
                <a href="{{ route('projects') }}" class="text-sm font-bold uppercase tracking-widest flex items-center gap-3 hover:opacity-60 transition-opacity text-main">View All Projects <i data-lucide="arrow-right" class="w-5 h-5"></i></a>
            </div>
        </section>
    </div>
    @endif

    <div data-aos="fade-up">
        <section class="space-y-16">
            <h2 class="font-bold tracking-tight uppercase text-muted text-xs tracking-[0.3em] text-left">Top Tech Stack</h2>
            <div class="glass-card p-12 text-main">
                <div class="grid grid-cols-3 sm:grid-cols-6 gap-12 items-center justify-items-center">
                    @foreach($topStacks as $stack)
                    <div class="group flex flex-col items-center gap-4">
                        <img src="{{ $stack->icon_url }}" class="stack-icon-mini" alt="{{ $stack->name }}" loading="lazy">
                        <span class="text-xs font-bold text-muted uppercase tracking-widest opacity-0 group-hover:opacity-100 transition-opacity">{{ $stack->name }}</span>
                    </div>
                    @endforeach
                </div>
                <div class="mt-12 pt-10 border-t border-border-subtle flex justify-end">
                    <a href="{{ route('stack') }}" class="text-sm font-bold uppercase tracking-widest flex items-center gap-3 hover:opacity-60 transition-opacity text-main">Full Stack <i data-lucide="arrow-right" class="w-5 h-5"></i></a>
                </div>
            </div>
        </section>
    </div>

    <div data-aos="zoom-in">
        <section class="glass-card p-20 text-center space-y-10 elite-grid">
            <h2 class="text-5xl font-bold tracking-tight text-main uppercase">Do you have any project idea?</h2>
            <a href="{{ route('contact') }}" class="px-12 py-6 bg-black dark:bg-white text-white dark:text-black rounded-2xl font-bold transition-transform hover:scale-[1.05] inline-block uppercase text-sm tracking-widest text-main">Contact Me</a>
        </section>
    </div>

    <footer class="py-24 border-t border-border-subtle text-center text-xs font-bold tracking-[0.2em] text-muted opacity-50 uppercase text-main">© 2026 by {{ $profile->name }}. All rights reserved.</footer>
</div>
@endsection

