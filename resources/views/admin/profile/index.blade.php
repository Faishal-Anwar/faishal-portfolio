@extends('layouts.app')

@section('title', 'Manage Profile')

@section('content')
<div class="max-w-3xl mx-auto space-y-20">
    <section data-aos="fade-up" class="space-y-8 pt-8 text-left">
        <h2 class="text-4xl font-bold tracking-tight text-main uppercase text-left">Manage Profile</h2>
        
        @if(session('success'))
        <div class="glass-card p-6 border-green-500/20 bg-green-500/5 text-green-500 text-center font-bold uppercase text-xs tracking-widest">
            {{ session('success') }}
        </div>
        @endif

        <div class="glass-card p-10 lg:p-12 text-left">
            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8 text-left">
                @csrf
                @method('PUT')
                
                <div class="space-y-6 text-left border-b border-border-subtle pb-8">
                    <h3 class="text-xs font-bold uppercase tracking-[0.3em] text-muted">Personal Info</h3>
                    <div class="flex flex-col md:flex-row gap-8 items-start">
                        <div class="shrink-0">
                            @if($profile->image)
                            <img src="{{ strpos($profile->image, 'http') === 0 ? $profile->image : asset('storage/' . $profile->image) }}" class="w-32 h-32 rounded-2xl object-cover border border-border-subtle shadow-lg" alt="Profile">
                            @else
                            <div class="w-32 h-32 rounded-2xl bg-zinc-100 dark:bg-zinc-900 flex items-center justify-center border border-border-subtle border-dashed">
                                <i data-lucide="user" class="w-12 h-12 text-muted"></i>
                            </div>
                            @endif
                        </div>
                        <div class="flex-1 space-y-4 w-full">
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold uppercase tracking-widest text-muted ml-1">Profile Image</label>
                                <input type="file" name="image" class="form-input bg-secondary" accept="image/*">
                                <p class="text-[9px] text-muted uppercase tracking-widest mt-1 ml-1 italic">Max 1MB. Recommend 1:1 ratio.</p>
                                @error('image') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold uppercase tracking-widest text-muted ml-1">Downloadable CV (PDF)</label>
                                <input type="file" name="cv" class="form-input bg-secondary" accept="application/pdf">
                                @if($profile->cv_path)
                                <div class="flex items-center gap-2 mt-2 ml-1">
                                    <i data-lucide="file-text" class="w-3 h-3 text-muted"></i>
                                    <a href="{{ strpos($profile->cv_path, 'http') === 0 ? $profile->cv_path : asset('storage/' . $profile->cv_path) }}" target="_blank" class="text-[9px] text-main font-bold uppercase tracking-widest underline">View Current CV</a>
                                </div>
                                @endif
                                <p class="text-[9px] text-muted uppercase tracking-widest mt-1 ml-1 italic">Max 5MB. PDF format only.</p>
                                @error('cv') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-left">
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold uppercase tracking-widest text-muted ml-1">Full Name</label>
                            <input type="text" name="name" value="{{ old('name', $profile->name) }}" required class="form-input">
                            @error('name') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold uppercase tracking-widest text-muted ml-1">Professional Title</label>
                            <input type="text" name="title" value="{{ old('title', $profile->title) }}" required class="form-input" placeholder="e.g. ML Engineer">
                            @error('title') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="space-y-6 text-left">
                    <h3 class="text-xs font-bold uppercase tracking-[0.3em] text-muted">Contact & Social Links</h3>
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold uppercase tracking-widest text-muted ml-1">Email Address</label>
                        <input type="email" name="email" value="{{ old('email', $profile->email) }}" required class="form-input">
                        @error('email') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-left">
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold uppercase tracking-widest text-muted ml-1">GitHub URL</label>
                            <input type="url" name="github_url" value="{{ old('github_url', $profile->github_url) }}" class="form-input" placeholder="https://github.com/...">
                            @error('github_url') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold uppercase tracking-widest text-muted ml-1">LinkedIn URL</label>
                            <input type="url" name="linkedin_url" value="{{ old('linkedin_url', $profile->linkedin_url) }}" class="form-input" placeholder="https://linkedin.com/in/...">
                            @error('linkedin_url') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-bold uppercase tracking-widest text-muted ml-1">Instagram URL</label>
                        <input type="url" name="instagram_url" value="{{ old('instagram_url', $profile->instagram_url) }}" class="form-input" placeholder="https://instagram.com/...">
                        @error('instagram_url') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="pt-4 text-left">
                    <button type="submit" class="px-12 py-4 bg-black dark:bg-white text-white dark:text-black rounded-2xl font-bold hover:scale-[1.02] transition-all uppercase tracking-widest text-xs">Update Profile</button>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
