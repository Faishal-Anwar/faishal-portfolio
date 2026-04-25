@extends('layouts.app')

@section('title', 'Manage Projects')

@section('content')
<div class="max-w-5xl mx-auto space-y-20">
    <section data-aos="fade-up" class="space-y-8 pt-8 text-left">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6 text-left">
            <h2 class="text-5xl sm:text-7xl font-bold tracking-tighter text-main text-left">Manage Projects</h2>
            <a href="{{ route('admin.projects.create') }}" class="px-6 py-3 bg-black dark:bg-white text-white dark:text-black rounded-xl font-bold transition-transform hover:scale-[1.05] uppercase text-xs tracking-widest text-left">Add New Project</a>
        </div>
    </section>

    @if(session('success'))
    <div class="glass-card p-6 border-green-500/20 bg-green-500/5 text-green-500 text-center font-bold uppercase text-xs tracking-widest">
        {{ session('success') }}
    </div>
    @endif

    <div class="grid grid-cols-1 gap-6 text-left">
        @foreach($projects as $project)
        <div class="glass-card p-8 flex flex-col md:flex-row justify-between items-center group text-left">
            <div class="flex items-center gap-6 text-left">
                <div class="w-12 h-12 bg-zinc-100 dark:bg-zinc-900 rounded-2xl flex items-center justify-center">
                    <i data-lucide="{{ $project->icon }}" class="w-6 h-6 text-main"></i>
                </div>
                <div class="text-left">
                    <h3 class="font-bold text-lg text-main">{{ $project->title }}</h3>
                    <p class="text-xs text-muted uppercase tracking-widest">{{ $project->year }} • {{ implode(', ', $project->tags) }}</p>
                </div>
            </div>
            <div class="flex items-center gap-4 mt-6 md:mt-0 text-left">
                <a href="{{ route('admin.projects.edit', $project) }}" class="p-3 border border-border-subtle rounded-xl hover:bg-zinc-50 dark:hover:bg-zinc-900 transition-colors text-main"><i data-lucide="edit-3" class="w-5 h-5"></i></a>
                <form action="{{ route('admin.projects.delete', $project) }}" method="POST" onsubmit="return confirm('Are you sure?')">
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
