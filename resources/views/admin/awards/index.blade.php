@extends('layouts.app')

@section('title', 'Manage Awards')

@section('content')
<div class="max-w-5xl mx-auto space-y-20 text-left">
    <section data-aos="fade-up" class="space-y-8 pt-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
            <h2 class="text-5xl sm:text-7xl font-bold tracking-tighter text-main">Awards & Honors</h2>
            <a href="{{ route('admin.awards.create') }}" class="px-6 py-3 bg-black dark:bg-white text-white dark:text-black rounded-xl font-bold transition-transform hover:scale-[1.05] uppercase text-xs tracking-widest">Add Award</a>
        </div>
    </section>

    @if(session('success'))
    <div class="glass-card p-6 border-green-500/20 bg-green-500/5 text-green-500 text-center font-bold uppercase text-xs tracking-widest">
        {{ session('success') }}
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-left">
        @foreach($awards as $award)
        <div class="glass-card p-10 space-y-6 flex flex-col text-left">
            <div class="w-14 h-14 bg-zinc-100 dark:bg-zinc-900 rounded-2xl flex items-center justify-center shrink-0">
                <i data-lucide="trophy" class="w-7 h-7 text-main"></i>
            </div>
            <div class="flex-1 text-left">
                <h3 class="text-2xl font-bold text-main">{{ $award->title }}</h3>
                <p class="text-muted font-medium mt-1">{{ $award->issuer }} • {{ $award->year }}</p>
                @if($award->description)
                <p class="text-xs text-muted mt-4 leading-relaxed">{{ $award->description }}</p>
                @endif
            </div>
            <div class="pt-6 border-t border-border-subtle flex items-center gap-4 text-left">
                <a href="{{ route('admin.awards.edit', $award) }}" class="p-2 border border-border-subtle rounded-lg hover:bg-zinc-50 dark:hover:bg-zinc-900 transition-colors text-main"><i data-lucide="edit-3" class="w-4 h-4"></i></a>
                <form action="{{ route('admin.awards.delete', $award) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="p-2 border border-red-500/20 rounded-lg hover:bg-red-500/5 text-red-500 transition-colors"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
