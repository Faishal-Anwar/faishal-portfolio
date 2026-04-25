@extends('layouts.app')

@section('title', 'Add Project')

@section('content')
<div class="max-w-3xl mx-auto space-y-20">
    <section data-aos="fade-up" class="space-y-8 pt-8 text-left">
        <h2 class="text-4xl font-bold tracking-tight text-main uppercase text-left">Add New Project</h2>
        <div class="glass-card p-10 lg:p-12 text-left">
            <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8 text-left">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-left">
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold uppercase tracking-widest text-muted ml-1">Project Title</label>
                        <input type="text" name="title" required class="form-input" placeholder="e.g. AI Sentiment Analyzer">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold uppercase tracking-widest text-muted ml-1">Year</label>
                        <input type="text" name="year" required class="form-input" placeholder="e.g. 2024">
                    </div>
                </div>

                <div class="space-y-2 text-left">
                    <label class="text-[10px] font-bold uppercase tracking-widest text-muted ml-1">Description</label>
                    <textarea name="description" rows="3" required class="form-input" placeholder="Short summary of the project..."></textarea>
                </div>

                <div class="space-y-2 text-left">
                    <label class="text-[10px] font-bold uppercase tracking-widest text-muted ml-1">Project Thumbnail</label>
                    <input type="file" name="image" class="form-input bg-secondary" accept="image/*">
                    @error('image') <p class="text-red-500 text-[10px] mt-1 font-bold uppercase tracking-widest ml-1">{{ $message }}</p> @enderror
                    <p class="text-[9px] text-muted uppercase tracking-widest mt-1 ml-1 italic">Optional: Upload an image. <span class="text-red-400/80 font-bold">Max 1MB.</span> Auto-renamed for safety.</p>
                </div>

                <div class="space-y-2 text-left">
                    <label class="text-[10px] font-bold uppercase tracking-widest text-muted ml-1">Project Gallery (Multiple Images)</label>
                    <input type="file" name="gallery[]" multiple class="form-input bg-secondary" accept="image/*">
                    @error('gallery') <p class="text-red-500 text-[10px] mt-1 font-bold uppercase tracking-widest ml-1">{{ $message }}</p> @enderror
                    @error('gallery.*') <p class="text-red-500 text-[10px] mt-1 font-bold uppercase tracking-widest ml-1">{{ $message }}</p> @enderror
                    <p class="text-[9px] text-muted uppercase tracking-widest mt-1 ml-1 italic">Select multiple images for slider. <span class="text-red-400/80 font-bold">Max 1MB per file.</span></p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-left">
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold uppercase tracking-widest text-muted ml-1">Lucide Icon Name</label>
                        <input type="text" name="icon" required class="form-input" placeholder="e.g. brain, code, database">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold uppercase tracking-widest text-muted ml-1">Tags (Comma Separated)</label>
                        <input type="text" name="tags" required class="form-input" placeholder="e.g. Python, PyTorch, BERT">
                    </div>
                </div>

                <div class="space-y-2 text-left">
                    <label class="text-[10px] font-bold uppercase tracking-widest text-muted ml-1">GitHub URL</label>
                    <input type="url" name="github_url" class="form-input" placeholder="https://github.com/...">
                </div>

                <div class="space-y-2 text-left">
                    <label class="text-[10px] font-bold uppercase tracking-widest text-muted ml-1">Case Study (Markdown/Plain Text)</label>
                    <textarea name="case_study" rows="10" class="form-input" placeholder="Detailed case study content..."></textarea>
                </div>

                <div class="flex items-center text-left">
                    <input id="is_featured" name="is_featured" type="checkbox" value="1" 
                        class="h-4 w-4 text-black dark:text-white border-border-subtle rounded focus:ring-0 bg-secondary">
                    <label for="is_featured" class="ml-2 block text-xs text-muted font-bold uppercase tracking-widest">Feature on Home Page</label>
                </div>

                <div class="pt-4 flex gap-4 text-left">
                    <button type="submit" class="px-10 py-4 bg-black dark:bg-white text-white dark:text-black rounded-2xl font-bold hover:scale-[1.02] transition-all uppercase tracking-widest text-xs">Save Project</button>
                    <a href="{{ route('admin.projects') }}" class="px-10 py-4 border border-border-subtle rounded-2xl font-bold hover:bg-zinc-50 dark:hover:bg-zinc-900 transition-all uppercase tracking-widest text-xs text-main">Cancel</a>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
