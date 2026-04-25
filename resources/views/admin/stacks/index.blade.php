@extends('layouts.app')

@section('title', 'Manage Tech Stack')

@section('content')
<div class="max-w-5xl mx-auto space-y-20">
    <section data-aos="fade-up" class="space-y-8 pt-8 text-left">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
            <h2 class="text-5xl sm:text-7xl font-bold tracking-tighter text-main text-left">Tech Stack</h2>
            <a href="{{ route('admin.stacks.create') }}" class="px-6 py-3 bg-black dark:bg-white text-white dark:text-black rounded-xl font-bold transition-transform hover:scale-[1.05] uppercase text-xs tracking-widest">Add Technology</a>
        </div>
    </section>

    @if(session('success'))
    <div class="glass-card p-6 border-green-500/20 bg-green-500/5 text-green-500 text-center font-bold uppercase text-xs tracking-widest">
        {{ session('success') }}
    </div>
    @endif

    <div class="space-y-16 text-left">
        @foreach($stacks as $category => $items)
        <div class="space-y-8 text-left">
            <h3 class="text-xs font-bold uppercase tracking-[0.3em] text-muted text-left">{{ $category }}</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 text-left">
                @foreach($items as $stack)
                <div class="glass-card p-6 flex justify-between items-center group text-left">
                    <div class="flex items-center gap-4 text-left">
                        <img src="{{ $stack->icon_url }}" class="w-10 h-10 object-contain" alt="{{ $stack->name }}">
                        <div class="text-left">
                            <h4 class="font-bold text-main">{{ $stack->name }}</h4>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 text-left">
                        <a href="{{ route('admin.stacks.edit', $stack) }}" class="p-2 border border-border-subtle rounded-lg hover:bg-zinc-50 dark:hover:bg-zinc-900 transition-colors text-main"><i data-lucide="edit-3" class="w-4 h-4"></i></a>
                        <form action="{{ route('admin.stacks.delete', $stack) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 border border-red-500/20 rounded-lg hover:bg-red-500/5 text-red-500 transition-colors"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
