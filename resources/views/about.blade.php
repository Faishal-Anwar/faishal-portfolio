@extends('layouts.app')

@section('title', "About Me | Faishal Anwar's Portfolio")

@section('content')
<section id="about" class="content-section space-y-12">
    <div data-aos="fade-up" class="space-y-6 pt-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h2 class="text-3xl font-bold text-primary">About Me</h2>
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
        <p class="text-lg leading-relaxed text-justify text-secondary">My journey has been shaped by a strong academic foundation, industry-recognized certifications, and hands-on experience with companies like Google and Adobe. I’m dedicated to designing solutions that blend creativity, functionality, and user-centric thinking.</p>
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

    {{-- Add/Edit Form --}}
    @auth
    <div data-aos="fade-up" class="card p-8 rounded-2xl">
        <h3 class="text-2xl font-bold mb-6 text-primary">{{ isset($about_item) ? 'Edit Entry' : 'Add New Entry' }}</h3>
        <form action="{{ isset($about_item) ? route('about.update', $about_item->id) : route('about.store') }}" method="POST">
            @csrf
            @if(isset($about_item))
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="category" class="block mb-2 text-sm font-medium text-secondary">Category</label>
                    <select id="category" name="category" class="form-input w-full px-4 py-2.5 rounded-lg text-base focus:ring-2 focus:border-transparent transition" required>
                        @foreach($categories as $category)
                            <option value="{{ $category }}" {{ (isset($about_item) && $about_item->category == $category) || old('category') == $category ? 'selected' : '' }}>
                                {{ $category }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="title" class="block mb-2 text-sm font-medium text-secondary">Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $about_item->title ?? '') }}" class="form-input w-full px-4 py-2.5 rounded-lg text-base focus:ring-2 focus:border-transparent transition" required>
                </div>

                <div class="md:col-span-2">
                    <label for="description" class="block mb-2 text-sm font-medium text-secondary">Description</label>
                    <textarea id="description" name="description" rows="4" class="form-input w-full px-4 py-2.5 rounded-lg text-base focus:ring-2 focus:border-transparent transition" required>{{ old('description', $about_item->description ?? '') }}</textarea>
                </div>

                <div>
                    <label for="start_date" class="block mb-2 text-sm font-medium text-secondary">Start Date</label>
                    <input type="date" id="start_date" name="start_date" value="{{ old('start_date', isset($about_item) ? $about_item->start_date : '') }}" class="form-input w-full px-4 py-2.5 rounded-lg text-base focus:ring-2 focus:border-transparent transition" required>
                </div>

                <div>
                    <label for="end_date" class="block mb-2 text-sm font-medium text-secondary">End Date (Optional)</label>
                    <input type="date" id="end_date" name="end_date" value="{{ old('end_date', isset($about_item) ? $about_item->end_date : '') }}" class="form-input w-full px-4 py-2.5 rounded-lg text-base focus:ring-2 focus:border-transparent transition">
                </div>
                <div class="md:col-span-2">
                    <label for="is_showcased" class="flex items-center text-sm font-medium text-secondary">
                        <input type="checkbox" id="is_showcased" name="is_showcased" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500" {{ old('is_showcased', $about_item->is_showcased ?? false) ? 'checked' : '' }}>
                        <span class="ml-2">Showcase on Homepage</span>
                    </label>
                </div>
            </div>

            <div class="mt-6 text-right">
                <button type="submit" class="bg-slate-900 text-white px-6 py-3 rounded-xl font-semibold text-base hover:bg-slate-800 dark:bg-sky-600 dark:hover:bg-sky-700 transition-all duration-300 transform hover:scale-105">
                    {{ isset($about_item) ? 'Update Entry' : 'Add Entry' }}
                </button>
                 @if(isset($about_item))
                    <a href="{{ route('about.index') }}" class="text-gray-600 ml-4">Cancel</a>
                @endif
            </div>
        </form>
    </div>
    @endauth

    {{-- Display Timeline --}}
    <div data-aos="fade-up" data-aos-delay="100" class="card p-8 lg:p-10 rounded-2xl transition-all duration-300">
        @php
            $lucideIcons = [
                'Academic Education' => 'graduation-cap',
                'Experience' => 'briefcase',
                'Non-Formal Education' => 'book-open',
                'Certifications' => 'award',
            ];
            $greenCategories = ['Experience', 'Certifications'];
        @endphp
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-12">
            @foreach($categories as $category)
                <div data-aos="fade-right" data-aos-delay="100">
                    <div class="flex items-center gap-4 mb-6">
                        <i data-lucide="{{ $lucideIcons[$category] ?? 'circle' }}" class="w-7 h-7 text-secondary"></i>
                        <h3 class="text-xl font-semibold text-primary">{{ $category }}</h3>
                    </div>
                    <div class="timeline-container">
                        @forelse($abouts[$category] ?? [] as $item)
                            <div class="timeline-item">
                                <div class="timeline-icon h-9 w-9 justify-center">
                                    <span @class([
                                        'w-3 h-3 rounded-full z-10',
                                        'bg-green-500' => in_array($category, $greenCategories),
                                        'bg-blue-500' => !in_array($category, $greenCategories),
                                    ])></span>
                                </div>
                                <p class="text-sm text-secondary mb-1">{{ \Carbon\Carbon::parse($item->start_date)->format('M Y') }} - {{ $item->end_date ? \Carbon\Carbon::parse($item->end_date)->format('M Y') : 'Present' }}</p>
                                <h4 class="font-semibold text-primary text-base flex items-center">
                                    <span>{{ $item->title }}</span>
                                    @auth
                                        @if($item->is_showcased)
                                            <i data-lucide="star" class="w-4 h-4 text-amber-500 fill-amber-500 ml-2"></i>
                                        @endif
                                    @endauth
                                </h4>
                                <p class="text-sm text-secondary text-justify">{{ $item->description }}</p>
                                @auth
                                <div class="flex gap-2 mt-2">
                                    <a href="{{ route('about.edit', $item->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded-md text-sm hover:bg-blue-600 transition-colors">Edit</a>
                                    <form action="{{ route('about.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-md text-sm hover:bg-red-600 transition-colors">Delete</button>
                                    </form>
                                </div>
                                @endauth
                            </div>
                        @empty
                            <p class="text-secondary pl-12">No entries for this category yet.</p>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div data-aos="zoom-in" data-aos-delay="200" class="card p-10 rounded-2xl grid-background">
        <div class="text-center">
            <h2 class="text-2xl font-semibold mb-4 max-w-md mx-auto text-primary">Do you have any project idea?</h2>
            <a href="{{ route('contact') }}" class="mt-6 inline-block bg-slate-900 text-white px-8 py-3 rounded-xl font-semibold text-base hover:bg-slate-800 dark:bg-sky-600 dark:hover:bg-sky-700 transition-all duration-300 transform hover:scale-105">
                Contact Me
            </a>
        </div>
    </div>
</section>
@endsection