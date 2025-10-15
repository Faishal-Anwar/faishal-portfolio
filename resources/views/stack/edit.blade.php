@extends('layouts.app')

@section('content')
<section id="edit-stack" class="content-section space-y-12">
    {{-- Page Header --}}
    <div data-aos="fade-up" class="space-y-6 pt-8">
        <div class="flex items-center gap-4">
            <a href="{{ route('stack.index') }}" class="text-primary hover:text-blue-600">
                <i data-lucide="arrow-left" class="w-6 h-6"></i>
            </a>
            <h2 class="text-3xl font-bold text-primary">Edit Stack Item</h2>
        </div>
        <p class="text-lg leading-relaxed text-justify text-secondary">Update the details for the selected technology stack item. You can change its name, description, and upload a new logo.</p>
    </div>

    {{-- Error Messages --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
            <strong class="font-bold">Whoops!</strong>
            <span class="block sm:inline">There were some problems with your input.</span>
            <ul class="list-disc list-inside mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Edit Stack Form --}}
    <div data-aos="fade-up" class="card p-8 rounded-2xl">
        <form action="{{ route('stack.update', $stack->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-secondary">Stack Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $stack->name) }}" class="form-input w-full px-4 py-2.5 rounded-lg text-base focus:ring-2 focus:border-transparent transition" required>
                </div>
                <div class="md:col-span-2">
                    <label for="description" class="block mb-2 text-sm font-medium text-secondary">Description</label>
                    <textarea id="description" name="description" rows="3" class="form-input w-full px-4 py-2.5 rounded-lg text-base focus:ring-2 focus:border-transparent transition">{{ old('description', $stack->description) }}</textarea>
                </div>
                <div class="md:col-span-2">
                    <label for="is_showcased" class="flex items-center text-sm font-medium text-secondary">
                        <input type="checkbox" id="is_showcased" name="is_showcased" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500" {{ old('is_showcased', $stack->is_showcased) ? 'checked' : '' }}>
                        <span class="ml-2">Showcase on Homepage</span>
                    </label>
                </div>
                <div>
                    <label for="image" class="block mb-2 text-sm font-medium text-secondary">New Logo Image (Optional)</label>
                    <input type="file" id="image" name="image" class="form-input w-full file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200">
                    <p class="text-sm text-secondary mt-2">Leave blank to keep the current image.</p>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-secondary">Current Logo</label>
                    <img src="{{ $stack->image }}" alt="{{ $stack->name }}" class="h-20 w-20 rounded-lg object-cover">
                </div>
            </div>
            <div class="text-right mt-6">
                <a href="{{ route('stack.index') }}" class="btn-secondary px-6 py-3 rounded-xl font-semibold text-base transition-colors duration-300 mr-2">Cancel</a>
                <button type="submit" class="bg-slate-900 text-white px-6 py-3 rounded-xl font-semibold text-base hover:bg-slate-800 dark:bg-sky-600 dark:hover:bg-sky-700 transition-all duration-300 transform hover:scale-105">
                    Update Item
                </button>
            </div>
        </form>
    </div>
</section>
@endsection
