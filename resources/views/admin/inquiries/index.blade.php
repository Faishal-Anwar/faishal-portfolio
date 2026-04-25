@extends('layouts.app')

@section('title', 'Manage Inquiries')

@section('content')
<div class="max-w-5xl mx-auto space-y-20">
    <section data-aos="fade-up" class="space-y-8 pt-8 text-left">
        <h2 class="text-5xl sm:text-7xl font-bold tracking-tighter text-main text-left">Inquiries</h2>
        <p class="text-xl text-muted max-w-3xl font-light leading-relaxed">View messages sent by visitors through your contact form.</p>
    </section>

    @if(session('success'))
    <div class="glass-card p-6 border-green-500/20 bg-green-500/5 text-green-500 text-center font-bold uppercase text-xs tracking-widest">
        {{ session('success') }}
    </div>
    @endif

    <div class="grid grid-cols-1 gap-8 text-left">
        @forelse($inquiries as $inquiry)
        <div class="glass-card p-10 space-y-6 text-left" data-aos="fade-up">
            <div class="flex justify-between items-start text-left">
                <div class="text-left">
                    <h3 class="text-2xl font-bold text-main">{{ $inquiry->name }}</h3>
                    <p class="text-sm text-muted">{{ $inquiry->email }} • {{ $inquiry->created_at->format('M d, Y H:i') }}</p>
                </div>
                <form action="{{ route('admin.inquiries.delete', $inquiry) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="p-3 border border-red-500/20 rounded-xl hover:bg-red-500/5 text-red-500 transition-colors"><i data-lucide="trash-2" class="w-5 h-5"></i></button>
                </form>
            </div>
            <div class="pt-6 border-t border-border-subtle text-left">
                <p class="text-muted leading-relaxed whitespace-pre-wrap">{{ $inquiry->message }}</p>
            </div>
        </div>
        @empty
        <div class="glass-card p-20 text-center space-y-4">
            <i data-lucide="mail-search" class="w-12 h-12 text-muted mx-auto"></i>
            <p class="text-muted font-bold uppercase tracking-widest text-xs">No inquiries yet</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
