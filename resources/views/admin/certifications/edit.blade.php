@extends('layouts.app')

@section('title', 'Edit Certification')

@section('content')
<div class="max-w-3xl mx-auto space-y-20">
    <section data-aos="fade-up" class="space-y-8 pt-8 text-left">
        <h2 class="text-4xl font-bold tracking-tight text-main uppercase text-left">Edit Certification</h2>
        <div class="glass-card p-10 lg:p-12 text-left">
            <form action="{{ route('admin.certifications.update', $certification) }}" method="POST" class="space-y-8 text-left">
                @csrf
                @method('PUT')
                <div class="space-y-2 text-left">
                    <label class="text-[10px] font-bold uppercase tracking-widest text-muted ml-1">Certificate Title</label>
                    <input type="text" name="title" value="{{ $certification->title }}" required class="form-input">
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-left">
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold uppercase tracking-widest text-muted ml-1">Issuer</label>
                        <input type="text" name="issuer" value="{{ $certification->issuer }}" required class="form-input">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold uppercase tracking-widest text-muted ml-1">Year</label>
                        <input type="text" name="year" value="{{ $certification->year }}" required class="form-input">
                    </div>
                </div>

                <div class="space-y-2 text-left">
                    <label class="text-[10px] font-bold uppercase tracking-widest text-muted ml-1">Description (Optional)</label>
                    <textarea name="description" rows="3" class="form-input">{{ $certification->description }}</textarea>
                </div>

                <div class="pt-4 flex gap-4 text-left">
                    <button type="submit" class="px-10 py-4 bg-black dark:bg-white text-white dark:text-black rounded-2xl font-bold hover:scale-[1.02] transition-all uppercase tracking-widest text-xs">Update Certification</button>
                    <a href="{{ route('admin.certifications') }}" class="px-10 py-4 border border-border-subtle rounded-2xl font-bold hover:bg-zinc-50 dark:hover:bg-zinc-900 transition-all uppercase tracking-widest text-xs text-main">Cancel</a>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
