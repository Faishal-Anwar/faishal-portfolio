@extends('layouts.app')

@section('title', 'Add Technology')

@section('content')
<div class="max-w-3xl mx-auto space-y-20">
    <section data-aos="fade-up" class="space-y-8 pt-8 text-left">
        <h2 class="text-4xl font-bold tracking-tight text-main uppercase text-left">Add Technology</h2>
        <div class="glass-card p-10 lg:p-12 text-left">
            <form action="{{ route('admin.stacks.store') }}" method="POST" class="space-y-8 text-left">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-left">
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold uppercase tracking-widest text-muted ml-1">Name</label>
                        <input type="text" name="name" required class="form-input" placeholder="e.g. Python">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold uppercase tracking-widest text-muted ml-1">Category</label>
                        <select name="category" required class="form-input bg-secondary">
                            <option value="Programming Languages">Programming Languages</option>
                            <option value="Frameworks & Libraries">Frameworks & Libraries</option>
                            <option value="Tools & Platforms">Tools & Platforms</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-2 text-left">
                    <label class="text-[10px] font-bold uppercase tracking-widest text-muted ml-1">Icon SVG URL (Devicon)</label>
                    <input type="url" name="icon_url" required class="form-input" placeholder="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/...">
                </div>

                <div class="space-y-2 text-left">
                    <label class="text-[10px] font-bold uppercase tracking-widest text-muted ml-1">Short Description</label>
                    <input type="text" name="description" required class="form-input" placeholder="e.g. Primary language for ML & Data Science.">
                </div>

                <div class="pt-4 flex gap-4 text-left">
                    <button type="submit" class="px-10 py-4 bg-black dark:bg-white text-white dark:text-black rounded-2xl font-bold hover:scale-[1.02] transition-all uppercase tracking-widest text-xs">Save Technology</button>
                    <a href="{{ route('admin.stacks') }}" class="px-10 py-4 border border-border-subtle rounded-2xl font-bold hover:bg-zinc-50 dark:hover:bg-zinc-900 transition-all uppercase tracking-widest text-xs text-main">Cancel</a>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
