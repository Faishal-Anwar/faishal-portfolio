@extends('layouts.app')

@section('title', 'Stack')

@section('content')
<div class="max-w-5xl mx-auto space-y-20">
    <div data-aos="fade-up">
        <section class="space-y-6 pt-8 text-main text-left">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
                <h2 class="text-5xl sm:text-7xl font-bold tracking-tighter text-main">My Tech Stack</h2>
                <div class="flex flex-row items-center gap-3 sm:gap-6 w-full sm:w-auto">
                    <div class="flex-1 sm:flex-none flex items-center justify-center gap-2 px-3 sm:px-4 py-2.5 border border-border-subtle rounded-full text-[9px] sm:text-xs font-bold uppercase tracking-widest text-muted bg-secondary/50 whitespace-nowrap">
                        <span class="relative flex h-2 w-2 sm:h-2.5 sm:w-2.5"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span><span class="relative inline-flex rounded-full h-2 w-2 sm:h-2.5 sm:w-2.5 bg-green-500"></span></span>
                        Available
                    </div>
                    <a href="{{ route('contact') }}" class="flex-1 sm:flex-none text-center px-4 sm:px-8 py-3 sm:py-4 bg-black dark:bg-white text-white dark:text-black rounded-xl font-bold transition-transform hover:scale-[1.05] text-[10px] sm:text-sm whitespace-nowrap">Contact Me</a>
                </div>
            </div>
            <p class="text-xl text-muted font-light text-justify leading-relaxed text-main">I leverage a specialized stack designed to handle complex datasets, train high-performance models, and deploy resilient cloud infrastructures.</p>
        </section>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-main text-left">
        @foreach($stacks as $category => $items)
        <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
            <div class="stack-card space-y-10 h-full">
                <h3 class="text-xs font-bold uppercase tracking-[0.3em] text-muted text-main">{{ $category }}</h3>
                <div class="space-y-8 text-main">
                    @foreach($items as $stack)
                    <div class="flex items-center gap-6 group">
                        <img src="{{ $stack->icon_url }}" class="stack-icon" alt="{{ $stack->name }}">
                        <div><p class="font-bold text-lg text-main">{{ $stack->name }}</p><p class="text-[10px] text-muted uppercase font-bold tracking-widest text-main">{{ $stack->description }}</p></div>
                    </div>
                    @endforeach
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

    <footer class="py-20 border-t border-border-subtle text-center text-[10px] font-bold tracking-[0.2em] text-muted opacity-50 uppercase text-main">
        © 2025 by {{ $profile->name }}. All rights reserved.
    </footer>
</div>
@endsection
