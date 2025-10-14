@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<section id="edit-profile" class="content-section flex items-center justify-center min-h-screen">
    <div class="card p-8 rounded-2xl w-full max-w-md mx-auto">
        <h2 class="text-3xl font-bold text-primary text-center mb-6">Edit Profile Photo</h2>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-6 text-center">
            <p class="block mb-2 text-sm font-medium text-secondary">Current Photo</p>
            <img src="{{ $user->profile_photo_url ?? asset('images/profile.png') }}" alt="Current Profile Photo" class="w-32 h-32 rounded-full object-cover mx-auto shadow-md">
        </div>

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div>
                <label for="profile_photo" class="block mb-2 text-sm font-medium text-secondary">Upload New Photo</label>
                <input id="profile_photo" type="file" name="profile_photo" required 
                       class="form-input w-full file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200">
            </div>

            <div class="mt-6">
                <button type="submit" class="w-full bg-slate-900 text-white px-6 py-3 rounded-xl font-semibold text-base hover:bg-slate-800 dark:bg-sky-600 dark:hover:bg-sky-700 transition-all duration-300 transform hover:scale-105">
                    Update Photo
                </button>
            </div>
        </form>
    </div>
</section>
@endsection
