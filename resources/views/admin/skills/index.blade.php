@extends('layouts.app')

@section('title', 'Manage Skills')

@section('content')
<div class="max-w-5xl mx-auto space-y-20">
    <section data-aos="fade-up" class="space-y-8 pt-8 text-left">
        <h2 class="text-5xl sm:text-7xl font-bold tracking-tighter text-main text-left">Core Skills</h2>
        <p class="text-xl text-muted max-w-3xl font-light leading-relaxed">These are the three main service cards displayed on your home page.</p>
    </section>

    @if(session('success'))
    <div class="glass-card p-6 border-green-500/20 bg-green-500/5 text-green-500 text-center font-bold uppercase text-xs tracking-widest">
        {{ session('success') }}
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach($skills as $skill)
        <div class="glass-card p-10 space-y-6 text-left flex flex-col">
            <div class="w-14 h-14 bg-zinc-100 dark:bg-zinc-900 rounded-2xl flex items-center justify-center">
                <i data-lucide="{{ $skill->icon }}" class="w-7 h-7 text-main"></i>
            </div>
            <div class="flex-1">
                <h3 class="text-2xl font-bold text-main">{{ $skill->title }}</h3>
                <p class="text-sm text-muted mt-4 leading-relaxed">{{ $skill->description }}</p>
            </div>
            <div class="pt-6 border-t border-border-subtle text-left">
                <a href="{{ route('admin.skills.edit', $skill) }}" class="inline-flex items-center gap-2 font-bold text-xs uppercase tracking-widest text-main hover:opacity-60 transition-opacity">Edit Card <i data-lucide="edit-3" class="w-4 h-4"></i></a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
