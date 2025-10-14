@extends('layouts.app')

@section('title', 'Edit Site Settings')

@section('content')
<section id="edit-settings" class="content-section flex items-center justify-center min-h-screen">
    <div class="card p-8 rounded-2xl w-full max-w-2xl mx-auto">
        <h2 class="text-3xl font-bold text-primary text-center mb-8">Site Settings</h2>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PATCH')

            {{-- Profile Photo --}}
            <div class="space-y-2">
                <label class="block text-sm font-medium text-secondary">Profile Photo</label>
                <div class="flex items-center gap-4">
                    <img src="{{ $settings['profile_photo_url'] ?? asset('images/profile.png') }}" alt="Current Profile Photo" class="w-20 h-20 rounded-full object-cover shadow-md">
                    <input id="profile_photo" type="file" name="profile_photo" 
                           class="form-input w-full file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200">
                </div>
            </div>

            {{-- CV File --}}
            <div class="space-y-2">
                <label for="cv_file" class="block text-sm font-medium text-secondary">CV (PDF)</label>
                @if(isset($settings['cv_url']))
                <p class="text-xs text-slate-500">Current CV: <a href="{{ route('cv.download') }}" target="_blank" class="text-blue-600 hover:underline">View PDF</a></p>
                @endif
                <input id="cv_file" type="file" name="cv_file" 
                       class="form-input w-full file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200">
            </div>

            <hr class="border-border-color">

            {{-- Text-based settings --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="contact_email" class="block text-sm font-medium text-secondary">Contact Email</label>
                    <input id="contact_email" type="email" name="contact_email" value="{{ old('contact_email', $settings['contact_email'] ?? '') }}" 
                           class="form-input w-full px-4 py-2.5 rounded-lg text-base focus:ring-2 focus:border-transparent transition">
                </div>
                <div>
                    <label for="linkedin_url" class="block text-sm font-medium text-secondary">LinkedIn URL</label>
                    <input id="linkedin_url" type="url" name="linkedin_url" value="{{ old('linkedin_url', $settings['linkedin_url'] ?? '') }}" 
                           class="form-input w-full px-4 py-2.5 rounded-lg text-base focus:ring-2 focus:border-transparent transition">
                </div>
                <div>
                    <label for="instagram_url" class="block text-sm font-medium text-secondary">Instagram URL</label>
                    <input id="instagram_url" type="url" name="instagram_url" value="{{ old('instagram_url', $settings['instagram_url'] ?? '') }}" 
                           class="form-input w-full px-4 py-2.5 rounded-lg text-base focus:ring-2 focus:border-transparent transition">
                </div>
                <div>
                    <label for="github_url" class="block text-sm font-medium text-secondary">GitHub URL</label>
                    <input id="github_url" type="url" name="github_url" value="{{ old('github_url', $settings['github_url'] ?? '') }}" 
                           class="form-input w-full px-4 py-2.5 rounded-lg text-base focus:ring-2 focus:border-transparent transition">
                </div>
            </div>

            <div class="text-right pt-4">
                <button type="submit" class="w-full sm:w-auto bg-slate-900 text-white px-8 py-3 rounded-xl font-semibold text-base hover:bg-slate-800 dark:bg-sky-600 dark:hover:bg-sky-700 transition-all duration-300 transform hover:scale-105">
                    Save All Settings
                </button>
            </div>
        </form>
    </div>
</section>
@endsection
