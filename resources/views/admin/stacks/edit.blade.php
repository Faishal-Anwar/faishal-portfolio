@extends('layouts.app')

@section('title', 'Edit Technology')

@section('content')
<div class="max-w-3xl mx-auto space-y-20">
    <section data-aos="fade-up" class="space-y-8 pt-8 text-left">
        <h2 class="text-4xl font-bold tracking-tight text-main uppercase text-left">Edit Technology</h2>
        <div class="glass-card p-10 lg:p-12 text-left">
            <form action="{{ route('admin.stacks.update', $stack) }}" method="POST" class="space-y-8 text-left">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-left">
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold uppercase tracking-widest text-muted ml-1">Name</label>
                        <input type="text" name="name" value="{{ $stack->name }}" required class="form-input">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold uppercase tracking-widest text-muted ml-1">Category</label>
                        <select name="category" required class="form-input bg-secondary">
                            <option value="Programming Languages" {{ $stack->category == 'Programming Languages' ? 'selected' : '' }}>Programming Languages</option>
                            <option value="Frameworks & Libraries" {{ $stack->category == 'Frameworks & Libraries' ? 'selected' : '' }}>Frameworks & Libraries</option>
                            <option value="Tools & Platforms" {{ $stack->category == 'Tools & Platforms' ? 'selected' : '' }}>Tools & Platforms</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-2 text-left">
                    <label class="text-[10px] font-bold uppercase tracking-widest text-muted ml-1">Icon SVG URL (Devicon)</label>
                    <input type="url" name="icon_url" value="{{ $stack->icon_url }}" required class="form-input">
                </div>

                <div class="space-y-2 text-left">
                    <label class="text-[10px] font-bold uppercase tracking-widest text-muted ml-1">Short Description</label>
                    <input type="text" name="description" value="{{ $stack->description }}" required class="form-input">
                </div>

                <div class="pt-4 flex gap-4 text-left">
                    <button type="submit" class="px-10 py-4 bg-black dark:bg-white text-white dark:text-black rounded-2xl font-bold hover:scale-[1.02] transition-all uppercase tracking-widest text-xs">Update Technology</button>
                    <a href="{{ route('admin.stacks') }}" class="px-10 py-4 border border-border-subtle rounded-2xl font-bold hover:bg-zinc-50 dark:hover:bg-zinc-900 transition-all uppercase tracking-widest text-xs text-main">Cancel</a>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
