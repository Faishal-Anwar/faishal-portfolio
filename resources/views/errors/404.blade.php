@extends('layouts.app')

@section('title', 'Page Not Found')

@section('content')
<div class="min-h-[70vh] flex flex-col items-center justify-center text-center space-y-12">
    <div data-aos="zoom-in" class="relative">
        <h1 class="text-[10rem] sm:text-[15rem] font-bold tracking-tighter text-main opacity-5 leading-none">404</h1>
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="glass-card p-12 space-y-6 backdrop-blur-xl bg-white/10 dark:bg-black/10">
                <i data-lucide="search-x" class="w-16 h-16 text-muted mx-auto mb-4"></i>
                <h2 class="text-4xl font-bold tracking-tight text-main uppercase">Page Not Found</h2>
                <p class="text-xl text-muted max-w-md mx-auto leading-relaxed">Oops! The page you are looking for doesn't exist or has been moved.</p>
                <div class="pt-6">
                    <a href="{{ route('home') }}" class="px-10 py-5 bg-black dark:bg-white text-white dark:text-black rounded-2xl font-bold transition-transform hover:scale-[1.05] inline-block uppercase text-xs tracking-widest">Back to Home</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
