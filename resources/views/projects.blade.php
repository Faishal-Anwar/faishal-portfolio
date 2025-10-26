@extends('layouts.app')

@section('title', "Projects | Faishal Anwar's Portfolio")

@section('content')
<section id="projects" class="content-section space-y-12">
    {{-- Header --}}
    <div data-aos="fade-up" class="space-y-6 pt-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h2 class="text-3xl font-bold text-primary">Projects</h2>
            <div class="flex items-center gap-4 flex-shrink-0">
                <div class="flex items-center gap-2 text-primary px-3 py-1.5 rounded-full text-sm font-semibold">
                    <span class="relative flex h-2.5 w-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-green-500"></span>
                    </span>
                    <span>Available for Project</span>
                </div>
                <a href="{{ route('contact') }}" class="bg-sky-600 text-white px-5 py-2.5 rounded-xl font-semibold text-base hover:bg-sky-700 dark:bg-sky-600 dark:hover:bg-sky-700 transition-all duration-300 transform hover:scale-105">Contact Me</a>
            </div>
        </div>
        <p class="text-lg leading-relaxed text-justify text-secondary">My projects reflect my commitment to solving complex challenges through design. Whether it’s building a travel platform or enhancing a real estate website, each project is a blend of innovation, strategy, and user-first design principles.</p>
    </div>

    {{-- Add New Project Form (for authenticated users) --}}
    @auth
    <div data-aos="fade-up" class="card p-8 rounded-2xl">
        <h3 class="text-2xl font-bold mb-6 text-primary">Add New Project</h3>

        @if ($errors->any())
            <div class="mb-4 rounded-lg bg-red-100 p-4 text-sm text-red-700 dark:bg-red-200 dark:text-red-800">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="title" class="block mb-2 text-sm font-medium text-secondary">Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" class="form-input w-full px-4 py-2.5 rounded-lg text-base focus:ring-2 focus:border-transparent transition" required>
                </div>
                <div>
                    <label for="category" class="block mb-2 text-sm font-medium text-secondary">Category</label>
                    <input type="text" id="category" name="category" value="{{ old('category') }}" class="form-input w-full px-4 py-2.5 rounded-lg text-base focus:ring-2 focus:border-transparent transition" required>
                </div>
                <div>
                    <label for="client" class="block mb-2 text-sm font-medium text-secondary">Client</label>
                    <input type="text" id="client" name="client" value="{{ old('client') }}" class="form-input w-full px-4 py-2.5 rounded-lg text-base focus:ring-2 focus:border-transparent transition" required>
                </div>
                <div>
                    <label for="link" class="block mb-2 text-sm font-medium text-secondary">Project Link</label>
                    <input type="text" id="link" name="link" value="{{ old('link') }}" class="form-input w-full px-4 py-2.5 rounded-lg text-base focus:ring-2 focus:border-transparent transition">
                </div>
                <div class="md:col-span-2">
                    <label for="tech-stack-input-create" class="block mb-2 text-sm font-medium text-secondary">Tech Stack</label>
                    <div id="tag-container-create" class="form-input w-full p-2.5 rounded-lg flex items-center flex-wrap gap-2">
                        <input type="text" id="tech-stack-input-create" placeholder="Add a tag and press Enter..." class="bg-transparent flex-grow focus:outline-none text-base">
                    </div>
                    <input type="hidden" name="tech_stack" id="tech_stack_create" value="{{ old('tech_stack') }}">
                </div>
                <div class="md:col-span-2">
                    <label for="is_featured" class="flex items-center text-sm font-medium text-secondary">
                        <input type="checkbox" id="is_featured" name="is_featured" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                        <span class="ml-2">Mark as Featured Project</span>
                    </label>
                </div>
                <div class="md:col-span-2">
                    <label for="image" class="block mb-2 text-sm font-medium text-secondary">Image</label>
                    <input type="file" id="image" name="image" class="form-input w-full px-4 py-2.5 rounded-lg text-base focus:ring-2 focus:border-transparent transition" required>
                </div>
                <div class="md:col-span-2">
                    <label for="overview" class="block mb-2 text-sm font-medium text-secondary">Overview</label>
                    <textarea id="overview" name="overview" rows="4" class="form-input w-full px-4 py-2.5 rounded-lg text-base focus:ring-2 focus:border-transparent transition">{{ old('overview') }}</textarea>
                </div>
                 <div class="md:col-span-2">
                    <label for="approach" class="block mb-2 text-sm font-medium text-secondary">Approach</label>
                    <textarea id="approach" name="approach" rows="4" class="form-input w-full px-4 py-2.5 rounded-lg text-base focus:ring-2 focus:border-transparent transition">{{ old('approach') }}</textarea>
                </div>
                 <div class="md:col-span-2">
                    <label for="vision" class="block mb-2 text-sm font-medium text-secondary">Vision</label>
                    <textarea id="vision" name="vision" rows="4" class="form-input w-full px-4 py-2.5 rounded-lg text-base focus:ring-2 focus:border-transparent transition">{{ old('vision') }}</textarea>
                </div>
                 <div class="md:col-span-2">
                    <label for="design" class="block mb-2 text-sm font-medium text-secondary">Design</label>
                    <textarea id="design" name="design" rows="4" class="form-input w-full px-4 py-2.5 rounded-lg text-base focus:ring-2 focus:border-transparent transition">{{ old('design') }}</textarea>
                </div>
                 <div class="md:col-span-2">
                    <label for="conclusion" class="block mb-2 text-sm font-medium text-secondary">Conclusion</label>
                    <textarea id="conclusion" name="conclusion" rows="4" class="form-input w-full px-4 py-2.5 rounded-lg text-base focus:ring-2 focus:border-transparent transition">{{ old('conclusion') }}</textarea>
                </div>
            </div>
            <div class="mt-6 text-right">
                <button type="submit" class="bg-slate-900 text-white px-6 py-3 rounded-xl font-semibold text-base hover:bg-slate-800 dark:bg-sky-600 dark:hover:bg-sky-700 transition-all duration-300 transform hover:scale-105">
                    Add Project
                </button>
            </div>
        </form>
    </div>
    @endauth

    {{-- Project List --}}
    @php
        $colors = [
            'bg-sky-900 text-sky-300 dark:bg-sky-900 dark:text-sky-300',
            'bg-emerald-900 text-emerald-300 dark:bg-emerald-900 dark:text-emerald-300',
            'bg-rose-900 text-rose-300 dark:bg-rose-900 dark:text-rose-300',
            'bg-amber-900 text-amber-300 dark:bg-amber-900 dark:text-amber-300',
            'bg-indigo-900 text-indigo-300 dark:bg-indigo-900 dark:text-indigo-300',
        ];
    @endphp
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        @foreach($projects as $project)
        <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}" class="card rounded-2xl overflow-hidden group hover:-translate-y-1.5 transition-transform duration-300">
            <div class="overflow-hidden"><img src="{{ $project->image }}" alt="{{ $project->title }}" class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out"></div>
            <div class="p-6">
                <h3 class="text-xl font-semibold mb-2 text-primary flex items-center gap-2">
                    <span>{{ $project->title }}</span>
                    @auth
                        @if($project->is_featured)
                            <i data-lucide="star" class="w-4 h-4 text-amber-500 fill-amber-500"></i>
                        @endif
                    @endauth
                </h3>
                <p class="text-secondary mb-4 text-base text-justify">{{ $project->overview }}</p>
                <div class="flex flex-wrap gap-2 mb-4">
                    @if($project->tech_stack)
                        @foreach(explode(',', $project->tech_stack) as $index => $tech)
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-full {{ $colors[$index % count($colors)] }}">{{ trim($tech) }}</span>
                        @endforeach
                    @endif
                </div>
                <div class="flex justify-between items-center">
                    <a href="{{ route('projects.show', $project) }}" class="font-semibold text-blue-600 dark:text-sky-400 hover:underline text-base flex items-center gap-2"><span>View Details</span><i data-lucide="arrow-right" class="w-4 h-4"></i></a>
                    @auth
                    <div class="flex items-center gap-2">
                        <a href="{{ route('projects.edit', $project) }}" class="bg-blue-500 text-white px-3 py-1 rounded-md text-sm hover:bg-blue-600 transition-colors">Edit</a>
                        <form action="{{ route('projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-md text-sm hover:bg-red-600 transition-colors">Delete</button>
                        </form>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- CTA --}}
     <div data-aos="zoom-in" class="card p-10 rounded-2xl grid-background">
        <div class="text-center">
            <h2 class="text-2xl font-semibold mb-4 max-w-md mx-auto text-primary">Do you have any project idea?</h2>
            <a href="{{ route('contact') }}" class="mt-6 inline-block bg-sky-600 text-white px-8 py-3 rounded-xl font-semibold text-base hover:bg-sky-700 dark:bg-sky-600 dark:hover:bg-sky-700 transition-all duration-300 transform hover:scale-105">
                Contact Me
            </a>
        </div>
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const tagContainer = document.getElementById('tag-container-create');
    const tagInput = document.getElementById('tech-stack-input-create');
    const hiddenInput = document.getElementById('tech_stack_create');
    let tags = [];

    const colors = [
        'bg-sky-900 text-sky-300 dark:bg-sky-900 dark:text-sky-300',
        'bg-emerald-900 text-emerald-300 dark:bg-emerald-900 dark:text-emerald-300',
        'bg-rose-900 text-rose-300 dark:bg-rose-900 dark:text-rose-300',
        'bbg-amber-900 text-amber-300 dark:bg-amber-900 dark:text-amber-300',
        'bg-indigo-900 text-indigo-300 dark:bg-indigo-900 dark:text-indigo-300',
    ];

    function renderTags() {
        // Clear container
        tagContainer.querySelectorAll('.tag').forEach(tagEl => tagEl.remove());
        // Re-add input at the end
        tagContainer.appendChild(tagInput);

        tags.forEach((tag, index) => {
            const tagEl = document.createElement('span');
            const colorClass = colors[index % colors.length];
            tagEl.className = `tag text-xs font-semibold px-2.5 py-1 rounded-full flex items-center gap-2 ${colorClass}`;
            tagEl.innerHTML = `
                <span>${tag}</span>
                <button type="button" data-tag="${tag}" class="remove-tag text-sm font-bold">&times;</button>
            `;
            tagContainer.insertBefore(tagEl, tagInput);
        });

        hiddenInput.value = tags.join(',');
    }

    tagInput.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' || e.key === ',') {
            e.preventDefault();
            const newTag = tagInput.value.trim();
            if (newTag && !tags.includes(newTag)) {
                tags.push(newTag);
                renderTags();
            }
            tagInput.value = '';
        }
    });

    tagContainer.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-tag')) {
            const tagToRemove = e.target.dataset.tag;
            tags = tags.filter(tag => tag !== tagToRemove);
            renderTags();
        }
    });

    // Initial load
    if (hiddenInput.value) {
        tags = hiddenInput.value.split(',').map(t => t.trim()).filter(t => t);
        renderTags();
    }
});
</script>
@endpush
@endsection
