@extends('layouts.app')

@section('title', 'About Me')

@section('content')
<div class="max-w-5xl mx-auto space-y-20">
    <div data-aos="fade-up">
        <section class="space-y-8 pt-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
                <h2 class="text-5xl sm:text-7xl font-bold tracking-tighter text-main text-left">About Me</h2>
                <div class="flex items-center gap-4 text-main">
                    <div class="flex items-center gap-2 px-3 py-1.5 border border-border-subtle rounded-full text-xs font-bold uppercase tracking-widest text-muted bg-secondary/50 text-main">
                        <span class="relative flex h-2 w-2"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span><span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span></span>
                        Available for Project
                    </div>
                    <a href="{{ route('contact') }}" class="px-6 py-3 bg-black dark:bg-white text-white dark:text-black rounded-xl font-bold transition-transform hover:scale-[1.05]">Contact Me</a>
                </div>
            </div>
            <div class="space-y-8 text-xl text-muted leading-relaxed font-light text-justify text-main">
                <p>My journey is driven by a passion for creating intelligent systems and robust data foundations. I specialize in developing advanced Machine Learning models, engineering high-performance Data Pipelines, and architecting scalable Cloud infrastructures that empower businesses to thrive in a data-driven world.</p>
            </div>        </section>
    </div>

    @if(count($experiences) > 0)
    <section class="space-y-16">
        <h3 class="text-xs font-bold uppercase tracking-[0.3em] text-muted text-left">Experience</h3>
        <div class="space-y-0 text-left">
            @foreach($experiences as $exp)
            <div data-aos="fade-left" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <p class="text-xs font-bold text-muted uppercase tracking-widest mb-2 text-main">{{ $exp->period }}</p>
                    <h4 class="text-2xl font-bold text-main">{{ $exp->title }}</h4>
                    <p class="text-muted mt-2 font-medium text-main">{{ $exp->company }}</p>
                    <p class="mt-4 text-muted text-sm leading-relaxed text-justify text-main">{{ $exp->description }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    @if(count($educations) > 0)
    <section class="space-y-16 text-left">
        <h3 class="text-xs font-bold uppercase tracking-[0.3em] text-muted text-left">Academic Education</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-main text-left">
            @foreach($educations as $edu)
            <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="glass-card p-10 space-y-4 bg-secondary/30 h-full">
                    <i data-lucide="graduation-cap" class="w-8 h-8 text-muted"></i>
                    <div>
                        <h4 class="text-xl font-bold text-main">{{ $edu->degree }}</h4>
                        <p class="text-sm text-muted">{{ $edu->institution }}, {{ $edu->period }}</p>
                        @if($edu->description)
                        <p class="text-xs text-muted mt-2 text-justify text-main">{{ $edu->description }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    @if(count($certifications) > 0)
    <section class="space-y-16 text-left">
        <h3 class="text-xs font-bold uppercase tracking-[0.3em] text-muted text-left">Certifications</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-main text-left">
            @foreach($certifications as $cert)
            <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="glass-card p-10 space-y-4 bg-secondary/30 h-full">
                    <i data-lucide="award" class="w-8 h-8 text-muted"></i>
                    <div>
                        <h4 class="text-xl font-bold text-main">{{ $cert->title }}</h4>
                        <p class="text-sm text-muted">{{ $cert->issuer }}, {{ $cert->year }}</p>
                        @if($cert->description)
                        <p class="text-xs text-muted mt-2 text-justify text-main">{{ $cert->description }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    @if(count($awards) > 0)
    <section class="space-y-16 text-left">
        <h3 class="text-xs font-bold uppercase tracking-[0.3em] text-muted text-left">Awards & Honors</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-main text-left">
            @foreach($awards as $award)
            <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="glass-card p-10 space-y-4 bg-secondary/30 h-full">
                    <i data-lucide="trophy" class="w-8 h-8 text-muted"></i>
                    <div>
                        <h4 class="text-xl font-bold text-main">{{ $award->title }}</h4>
                        <p class="text-sm text-muted">{{ $award->issuer }}, {{ $award->year }}</p>
                        @if($award->description)
                        <p class="text-xs text-muted mt-2 text-justify text-main">{{ $award->description }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    <!-- CTA Section -->
    <div data-aos="zoom-in">
        <section class="glass-card p-16 text-center space-y-8 elite-grid text-main">
            <h2 class="text-4xl font-bold tracking-tight text-main uppercase">Do you have any project idea?</h2>
            <a href="{{ route('contact') }}" class="px-10 py-5 bg-black dark:bg-white text-white dark:text-black rounded-2xl font-bold transition-transform hover:scale-[1.05] inline-block uppercase text-xs tracking-widest text-main">Contact Me</a>
        </section>
    </div>

    <footer class="py-20 border-t border-border-subtle text-center text-[10px] font-bold tracking-[0.2em] text-muted opacity-50 uppercase text-main">© 2025 by {{ $profile->name }}. All rights reserved.</footer>
</div>
@endsection
