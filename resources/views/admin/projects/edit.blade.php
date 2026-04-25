@extends('layouts.app')

@section('title', 'Edit Project')

@section('content')
<div class="max-w-3xl mx-auto space-y-20">
    <section data-aos="fade-up" class="space-y-8 pt-8 text-left">
        <h2 class="text-4xl font-bold tracking-tight text-main uppercase text-left">Edit Project</h2>
        <div class="glass-card p-10 lg:p-12 text-left">
            <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data" class="space-y-8 text-left">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-left">
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold uppercase tracking-widest text-muted ml-1">Project Title</label>
                        <input type="text" name="title" value="{{ old('title', $project->title) }}" required class="form-input">
                        @error('title') <p class="text-red-500 text-[10px] mt-1 font-bold uppercase tracking-widest ml-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold uppercase tracking-widest text-muted ml-1">Year</label>
                        <input type="text" name="year" value="{{ old('year', $project->year) }}" required class="form-input">
                        @error('year') <p class="text-red-500 text-[10px] mt-1 font-bold uppercase tracking-widest ml-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="space-y-2 text-left">
                    <label class="text-[10px] font-bold uppercase tracking-widest text-muted ml-1">Description</label>
                    <textarea name="description" rows="3" required class="form-input">{{ old('description', $project->description) }}</textarea>
                    @error('description') <p class="text-red-500 text-[10px] mt-1 font-bold uppercase tracking-widest ml-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2 text-left">
                    <label class="text-[10px] font-bold uppercase tracking-widest text-muted ml-1">Project Thumbnail</label>
                    @if($project->image)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $project->image) }}" class="w-40 h-24 object-cover rounded-xl border border-border-subtle" alt="Current Thumbnail">
                        <p class="text-[9px] text-muted uppercase mt-2">Current Thumbnail</p>
                    </div>
                    @endif
                    <input type="file" name="image" class="form-input bg-secondary" accept="image/*">
                    @error('image') <p class="text-red-500 text-[10px] mt-1 font-bold uppercase tracking-widest ml-1">{{ $message }}</p> @enderror
                    <p class="text-[9px] text-muted uppercase tracking-widest mt-1 ml-1 italic">Optional: Upload a new image. <span class="text-red-400/80 font-bold">Max 1MB.</span> Files are auto-renamed for safety.</p>
                </div>

                <div class="space-y-2 text-left">
                    <label class="text-[10px] font-bold uppercase tracking-widest text-muted ml-1">Project Gallery (Multiple Images)</label>
                    @if($project->gallery)
                    <div class="flex gap-4 mb-4 overflow-x-auto pb-2">
                        @foreach($project->gallery as $img)
                        <img src="{{ asset('storage/' . $img) }}" class="w-24 h-16 object-cover rounded-lg border border-border-subtle shrink-0">
                        @endforeach
                    </div>
                    @endif
                    <input type="file" name="gallery[]" multiple class="form-input bg-secondary" accept="image/*">
                    @error('gallery') <p class="text-red-500 text-[10px] mt-1 font-bold uppercase tracking-widest ml-1">{{ $message }}</p> @enderror
                    @error('gallery.*') <p class="text-red-500 text-[10px] mt-1 font-bold uppercase tracking-widest ml-1">{{ $message }}</p> @enderror
                    <p class="text-[9px] text-muted uppercase tracking-widest mt-1 ml-1 italic">Note: Replacing gallery will delete old ones. <span class="text-red-400/80 font-bold">Max 1MB per file.</span></p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-left">
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold uppercase tracking-widest text-muted ml-1">Lucide Icon Name</label>
                        <input type="text" name="icon" value="{{ old('icon', $project->icon) }}" required class="form-input">
                        @error('icon') <p class="text-red-500 text-[10px] mt-1 font-bold uppercase tracking-widest ml-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold uppercase tracking-widest text-muted ml-1">Tags (Comma Separated)</label>
                        <input type="text" name="tags" value="{{ old('tags', implode(', ', $project->tags)) }}" required class="form-input">
                        @error('tags') <p class="text-red-500 text-[10px] mt-1 font-bold uppercase tracking-widest ml-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="space-y-2 text-left">
                    <label class="text-[10px] font-bold uppercase tracking-widest text-muted ml-1">GitHub URL</label>
                    <input type="url" name="github_url" value="{{ old('github_url', $project->github_url) }}" class="form-input">
                    @error('github_url') <p class="text-red-500 text-[10px] mt-1 font-bold uppercase tracking-widest ml-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2 text-left">
                    <label class="text-[10px] font-bold uppercase tracking-widest text-muted ml-1">Case Study (Markdown/Plain Text)</label>
                    <textarea name="case_study" rows="10" class="form-input">{{ old('case_study', $project->case_study) }}</textarea>
                    @error('case_study') <p class="text-red-500 text-[10px] mt-1 font-bold uppercase tracking-widest ml-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center text-left">
                    <input id="is_featured" name="is_featured" type="checkbox" value="1" {{ $project->is_featured ? 'checked' : '' }}
                        class="h-4 w-4 text-black dark:text-white border-border-subtle rounded focus:ring-0 bg-secondary">
                    <label for="is_featured" class="ml-2 block text-xs text-muted font-bold uppercase tracking-widest">Feature on Home Page</label>
                </div>

                <div class="pt-4 flex gap-4 text-left">
                    <button type="submit" class="px-10 py-4 bg-black dark:bg-white text-white dark:text-black rounded-2xl font-bold hover:scale-[1.02] transition-all uppercase tracking-widest text-xs">Update Project</button>
                    <a href="{{ route('admin.projects') }}" class="px-10 py-4 border border-border-subtle rounded-2xl font-bold hover:bg-zinc-50 dark:hover:bg-zinc-900 transition-all uppercase tracking-widest text-xs text-main">Cancel</a>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
