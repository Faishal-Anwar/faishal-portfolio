@extends('layouts.app')

@section('title', 'Projects')

@section('content')
<div class="max-w-5xl mx-auto space-y-20">
    <div data-aos="fade-up">
        <section class="space-y-6 pt-8 text-main">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
                <h2 class="text-5xl sm:text-7xl font-bold tracking-tighter text-main text-left">Projects</h2>
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-2 px-3 py-1.5 border border-border-subtle rounded-full text-xs font-bold uppercase tracking-widest text-muted bg-secondary/50 text-main">
                        <span class="relative flex h-2 w-2"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span><span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span></span>
                        Available for Project
                    </div>
                    <a href="{{ route('contact') }}" class="px-6 py-3 bg-black dark:bg-white text-white dark:text-black rounded-xl font-bold transition-transform hover:scale-[1.05]">Contact Me</a>
                </div>
            </div>
            <p class="text-xl text-muted font-light text-justify leading-relaxed text-main">My projects showcase the intersection of artificial intelligence, data engineering, and cloud architecture. Each case study represents a solution designed for scalability, accuracy, and real-world impact.</p>
        </section>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 text-main text-left">
        @foreach($projects as $project)
        <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
            <div class="project-card group h-full">
                <div class="aspect-video bg-blue-50 dark:bg-blue-950/30 flex items-center justify-center overflow-hidden relative border-b border-border-subtle">
                     <div class="absolute inset-0 elite-grid opacity-10"></div>
                    @if($project->image)
                    <img src="{{ strpos($project->image, 'http') === 0 ? $project->image : asset('storage/' . $project->image) }}" class="w-full h-full object-cover transition-transform group-hover:scale-110" alt="{{ $project->title }}">
                    @else
                    <i data-lucide="{{ $project->icon }}" class="w-16 h-16 text-blue-600 dark:text-blue-400 transition-transform group-hover:scale-110"></i>
                    @endif
                </div>
                <div class="p-8 space-y-4">
                    <div class="flex justify-between items-start text-main">
                        <h3 class="text-2xl font-bold text-main">{{ $project->title }}</h3>
                        <span class="text-[10px] font-bold border border-border-subtle px-2 py-1 rounded text-muted">{{ $project->year }}</span>
                    </div>
                    <p class="text-muted text-sm leading-relaxed text-justify text-main">{{ $project->description }}</p>
                    <div class="flex flex-wrap gap-2 pt-2 text-main">
                        @foreach($project->tags as $tag)
                        <span class="text-[9px] font-bold text-muted uppercase tracking-widest border border-border-subtle px-2 py-1 rounded-lg">{{ $tag }}</span>
                        @endforeach
                    </div>
                    <div class="pt-6 border-t border-border-subtle flex justify-between items-center text-main">
                        <a href="{{ route('project-detail', $project->slug) }}" class="font-bold text-sm flex items-center gap-2 hover:opacity-60 transition-opacity uppercase tracking-widest text-main">View Details <i data-lucide="arrow-right" class="w-4 h-4 text-main"></i></a>
                        @if($project->github_url)
                        <a href="{{ $project->github_url }}" class="text-muted hover:text-main" target="_blank"><i data-lucide="github" class="w-5 h-5 text-main"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- CTA Section -->
    <div data-aos="zoom-in">
        <section class="glass-card p-16 text-center space-y-8 elite-grid text-main">
            <h2 class="text-4xl font-bold tracking-tight max-w-2xl mx-auto text-main uppercase">Do you have any project idea?</h2>
            <a href="{{ route('contact') }}" class="px-10 py-5 bg-black dark:bg-white text-white dark:text-black rounded-2xl font-bold transition-transform hover:scale-[1.05] inline-block uppercase text-xs tracking-widest text-main">Contact Me</a>
        </section>
    </div>

    <footer class="py-20 border-t border-border-subtle text-center text-[10px] font-bold tracking-widest uppercase text-muted opacity-50 text-main">
        © 2025 by {{ $profile->name }}. All rights reserved.
    </footer>
</div>
@endsection
