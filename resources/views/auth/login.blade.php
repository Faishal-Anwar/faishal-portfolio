@extends('layouts.app')

@section('title', 'Admin Login')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 glass-card p-10 lg:p-12 relative overflow-hidden" data-aos="zoom-in">
        <!-- Background Decorative Grid -->
        <div class="absolute inset-0 elite-grid opacity-10 pointer-events-none"></div>

        <div class="text-center relative z-10">
            <div class="mx-auto h-12 w-12 bg-zinc-100 dark:bg-zinc-900 rounded-2xl flex items-center justify-center mb-6">
                <i data-lucide="shield-lock" class="w-6 h-6 text-main"></i>
            </div>
            <h2 class="text-3xl font-bold tracking-tight text-main uppercase">Admin Access</h2>
            <p class="mt-2 text-sm text-muted">Please sign in to manage your portfolio</p>
        </div>

        <form class="mt-8 space-y-6 relative z-10" action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div class="space-y-2 text-left">
                    <label for="email" class="text-[10px] font-bold uppercase tracking-widest text-muted ml-1">Email Address</label>
                    <input id="email" name="email" type="email" autocomplete="email" required 
                        class="form-input" placeholder="faishal@admin.com" value="{{ old('email') }}">
                    @error('email')
                        <p class="text-red-500 text-[10px] mt-1 font-bold uppercase tracking-widest ml-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="space-y-2 text-left">
                    <label for="password" class="text-[10px] font-bold uppercase tracking-widest text-muted ml-1">Password</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required 
                        class="form-input" placeholder="••••••••">
                    @error('password')
                        <p class="text-red-500 text-[10px] mt-1 font-bold uppercase tracking-widest ml-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex items-center justify-between text-left">
                <div class="flex items-center">
                    <input id="remember-me" name="remember" type="checkbox" 
                        class="h-4 w-4 text-black dark:text-white border-border-subtle rounded focus:ring-0 bg-secondary">
                    <label for="remember-me" class="ml-2 block text-xs text-muted font-bold uppercase tracking-widest">Remember me</label>
                </div>
            </div>

            <div>
                <button type="submit" 
                    class="group relative w-full flex justify-center py-4 px-4 bg-black dark:bg-white text-white dark:text-black rounded-2xl font-bold hover:scale-[1.02] transition-all uppercase tracking-widest text-xs">
                    Sign in
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
