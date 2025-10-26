@extends('layouts.app')

@section('content')
<section id="stack" class="content-section space-y-12">
    {{-- Page Header --}}
    <div data-aos="fade-up" class="space-y-6 pt-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                 <h2 class="text-3xl font-bold text-primary">My Tech Stack</h2>
            </div>
            <div class="flex items-center gap-4 flex-shrink-0">
                <div class="flex items-center gap-2 text-primary px-3 py-1.5 rounded-full text-sm font-semibold">
                    <span class="relative flex h-2.5 w-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-green-500"></span>
                    </span>
                    <span>Available for Project</span>
                </div>
                <a href="{{ route('contact') }}" class="bg-slate-900 text-white px-5 py-2.5 rounded-xl font-semibold text-base hover:bg-slate-800 dark:bg-sky-600 dark:hover:bg-sky-700 transition-all duration-300 transform hover:scale-105">Contact Me</a>
            </div>
        </div>
         <p class="text-lg leading-relaxed text-justify text-secondary">I work with a dynamic stack of tools to bring my ideas to life. My goal is to create designs that are not only visually appealing but also optimized for usability, accessibility, and performance.</p>
    </div>

    {{-- Success and Error Messages --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
            <strong class="font-bold">Whoops!</strong>
            <span class="block sm:inline">There were some problems with your input.</span>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Add New Stack Form --}}
    @auth
    <div data-aos="fade-up" class="card p-8 rounded-2xl">
        <h3 class="text-2xl font-bold mb-6 text-primary">Add New Stack Item</h3>
        <form action="{{ route('stack.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-secondary">Stack Name</label>
                    <input type="text" id="name" name="name" placeholder="e.g., Laravel" class="form-input w-full px-4 py-2.5 rounded-lg text-base focus:ring-2 focus:border-transparent transition" required>
                </div>
                <div>
                    <label for="image" class="block mb-2 text-sm font-medium text-secondary">Logo Image</label>
                    <input type="file" id="image" name="image" class="form-input w-full file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200" required>
                </div>
                <div class="md:col-span-2">
                    <label for="description" class="block mb-2 text-sm font-medium text-secondary">Description</label>
                    <textarea id="description" name="description" rows="3" placeholder="A short description of the technology." class="form-input w-full px-4 py-2.5 rounded-lg text-base focus:ring-2 focus:border-transparent transition"></textarea>
                </div>
                <div class="md:col-span-2">
                    <label for="is_showcased" class="flex items-center text-sm font-medium text-secondary">
                        <input type="checkbox" id="is_showcased" name="is_showcased" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                        <span class="ml-2">Showcase on Homepage</span>
                    </label>
                </div>
            </div>
            <div class="text-right mt-6">
                <button type="submit" class="bg-slate-900 text-white px-6 py-3 rounded-xl font-semibold text-base hover:bg-slate-800 dark:bg-sky-600 dark:hover:bg-sky-700 transition-all duration-300 transform hover:scale-105">
                    Add Item
                </button>
            </div>
        </form>
    </div>
    @endauth

    {{-- Display Stack Items --}}
    <div data-aos="fade-up" data-aos-delay="100" class="card p-8 lg:p-10 rounded-2xl">
        <h3 class="text-xl font-semibold mb-8 text-primary">Development & Prototyping Tools</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @forelse($stacks as $index => $stack)
                <div data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <div class="flex items-center gap-4">
                        <img src="{{ $stack->image }}" alt="{{ $stack->name }}" class="h-20 w-20 flex-shrink-0 rounded-lg object-cover">
                        <h4 class="text-lg font-semibold text-primary flex-grow flex items-center">
                            <span>{{ $stack->name }}</span>
                            @auth
                                @if($stack->is_showcased)
                                    <i data-lucide="star" class="w-4 h-4 text-amber-500 fill-amber-500 ml-2"></i>
                                @endif
                            @endauth
                        </h4>
                        @auth
                        <div class="flex items-center gap-2 flex-shrink-0">
                            <a href="{{ route('stack.edit', $stack->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded-md text-sm hover:bg-blue-600 transition-colors">Edit</a>
                            <form action="{{ route('stack.destroy', $stack->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-md text-sm hover:bg-red-600 transition-colors">Delete</button>
                            </form>
                        </div>
                        @endauth
                    </div>
                    @if($stack->description)
                        <div class="mt-3">
                            <p class="text-secondary text-sm text-justify">{{ $stack->description }}</p>
                        </div>
                    @endif
                </div>
            @empty
                <div class="text-center text-secondary py-8 md:col-span-2">
                    <p>No stack items have been added yet. Add one using the form above!</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Call to Action --}}
    <div data-aos="zoom-in" data-aos-delay="200" class="card p-10 rounded-2xl grid-background">
        <div class="text-center">
            <h2 class="text-2xl font-semibold mb-4 max-w-md mx-auto text-primary">Do you have any project idea?</h2>
            <a href="{{ route('contact') }}" class="mt-6 inline-block bg-sky-600 text-white px-8 py-3 rounded-xl font-semibold text-base hover:bg-sky-700 dark:bg-sky-600 dark:hover:bg-sky-700 transition-all duration-300 transform hover:scale-105">
                Contact Me
            </a>
        </div>
    </div>
</section>
@endsection
