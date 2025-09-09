@extends('layouts.app')

@section('content')
<section id="login" class="content-section flex items-center justify-center min-h-screen">
    <div class="card p-8 rounded-2xl w-full max-w-md mx-auto">
        <h2 class="text-3xl font-bold text-primary text-center mb-6">Login</h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ $errors->first() }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-secondary">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus 
                       class="form-input w-full px-4 py-2.5 rounded-lg text-base focus:ring-2 focus:border-transparent transition">
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password" class="block mb-2 text-sm font-medium text-secondary">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                       class="form-input w-full px-4 py-2.5 rounded-lg text-base focus:ring-2 focus:border-transparent transition">
            </div>

            <div class="flex items-center justify-end mt-6">
                <button type="submit" class="w-full bg-slate-900 text-white px-6 py-3 rounded-xl font-semibold text-base hover:bg-slate-800 dark:bg-sky-600 dark:hover:bg-sky-700 transition-all duration-300 transform hover:scale-105">
                    Log in
                </button>
            </div>
        </form>
    </div>
</section>
@endsection
