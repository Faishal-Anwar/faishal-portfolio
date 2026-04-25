@extends('layouts.app')

@section('title', 'Manage Experience')

@section('content')
<div class="max-w-5xl mx-auto space-y-20">
    <section data-aos="fade-up" class="space-y-8 pt-8 text-left">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
            <h2 class="text-5xl sm:text-7xl font-bold tracking-tighter text-main text-left">Experience</h2>
            <a href="{{ route('admin.experiences.create') }}" class="px-6 py-3 bg-black dark:bg-white text-white dark:text-black rounded-xl font-bold transition-transform hover:scale-[1.05] uppercase text-xs tracking-widest">Add Experience</a>
        </div>
    </section>

    @if(session('success'))
    <div class="glass-card p-6 border-green-500/20 bg-green-500/5 text-green-500 text-center font-bold uppercase text-xs tracking-widest">
        {{ session('success') }}
    </div>
    @endif

    <div class="grid grid-cols-1 gap-6 text-left">
        @foreach($experiences as $exp)
        <div class="glass-card p-8 flex flex-col md:flex-row justify-between items-center text-left">
            <div class="text-left">
                <p class="text-[10px] font-bold text-muted uppercase tracking-[0.2em] mb-2">{{ $exp->period }}</p>
                <h3 class="text-2xl font-bold text-main">{{ $exp->title }}</h3>
                <p class="text-muted font-medium">{{ $exp->company }}</p>
            </div>
            <div class="flex items-center gap-4 mt-6 md:mt-0 text-left">
                <a href="{{ route('admin.experiences.edit', $exp) }}" class="p-3 border border-border-subtle rounded-xl hover:bg-zinc-50 dark:hover:bg-zinc-900 transition-colors text-main"><i data-lucide="edit-3" class="w-5 h-5"></i></a>
                <form action="{{ route('admin.experiences.delete', $exp) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="p-3 border border-red-500/20 rounded-xl hover:bg-red-500/5 text-red-500 transition-colors"><i data-lucide="trash-2" class="w-5 h-5"></i></button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
