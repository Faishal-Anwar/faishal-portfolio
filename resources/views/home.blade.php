
@extends('layouts.app')

@section('title', "Home | Faishal Anwar's Portfolio")

@section('content')
<section id="home" class="content-section space-y-12">
    <!-- Restructured Hero Section -->
    <div data-aos="fade-up" class="space-y-6 pt-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-4xl font-bold text-primary">Faishal Anwar</h1>
                <p class="text-xl text-secondary mt-1">Machine Learning Engineer & Data Scientist</p>
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
        <div>
            <p class="text-secondary text-lg leading-relaxed text-justify">
                Hey 👋, I'm Faishal. I focus on building scalable AI solutions and transforming data into actionable insights. I specialize in predictive modeling, recommendation systems, and data-driven algorithms to solve real-world problems and deliver impactful results.
            </p>
        </div>
    </div>

    <div data-aos="fade-up">
        <h2 class="text-2xl font-bold mb-6 text-primary">What I Do</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <!-- Card 1: Machine Learning -->
            <div data-aos="fade-up" data-aos-delay="100" class="service-card card p-6 rounded-2xl text-left transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-4">
                        <div class="p-3 rounded-lg bg-sky-100 dark:bg-slate-700">
                            <i data-lucide="brain-circuit" class="w-7 h-7 text-sky-600 dark:text-sky-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-primary">Machine Learning</h3>
                    </div>
                    <i data-lucide="chevron-down" class="arrow-icon w-5 h-5 text-secondary transition-transform"></i>
                </div>
                <div class="service-details">
                    <p class="text-secondary text-base text-justify pt-4">I develop intelligent models to recognize patterns, predict outcomes, and automate complex tasks, helping businesses make data-driven decisions with high accuracy.</p>
                </div>
            </div>

            <!-- Card 2: Data Scientist -->
            <div data-aos="fade-up" data-aos-delay="200" class="service-card card p-6 rounded-2xl text-left transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-4">
                        <div class="p-3 rounded-lg bg-indigo-100 dark:bg-slate-700">
                            <i data-lucide="database-zap" class="w-7 h-7 text-indigo-600 dark:text-indigo-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-primary">Data Scientist</h3>
                    </div>
                    <i data-lucide="chevron-down" class="arrow-icon w-5 h-5 text-secondary transition-transform"></i>
                </div>
                <div class="service-details">
                    <p class="text-secondary text-base text-justify pt-4">I transform raw data into strategic insights. My work involves data cleaning, exploratory analysis, and visualization to uncover trends that drive business growth.</p>
                </div>
            </div>

            <!-- Card 3: Data Analyst -->
            <div data-aos="fade-up" data-aos-delay="300" class="service-card card p-6 rounded-2xl text-left transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-4">
                        <div class="p-3 rounded-lg bg-emerald-100 dark:bg-slate-700">
                            <i data-lucide="bar-chart-3" class="w-7 h-7 text-emerald-600 dark:text-emerald-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-primary">Data Analyst</h3>
                    </div>
                    <i data-lucide="chevron-down" class="arrow-icon w-5 h-5 text-secondary transition-transform"></i>
                </div>
                <div class="service-details">
                    <p class="text-secondary text-base text-justify pt-4">I analyze complex datasets to extract actionable insights and support strategic decision-making.</p>
                </div>
            </div>

        </div>
    </div>

    <div data-aos="fade-up">
        <h2 class="text-2xl font-bold mb-6 text-primary">About Me</h2>
        <div class="card p-8 rounded-2xl">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-10">
                @php
                    $icons = [
                        'Academic Education' => 'graduation-cap',
                        'Experience' => 'briefcase',
                        'Non-Formal Education' => 'book-open',
                        'Certifications' => 'award',
                    ];
                @endphp

                @foreach ($abouts as $category => $items)
                    <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <h3 class="text-lg font-semibold mb-4 flex items-center gap-3 text-primary">
                            <i data-lucide="{{ $icons[$category] ?? 'circle' }}" class="w-6 h-6 text-primary"></i>
                            <span>{{ $category }}</span>
                        </h3>
                        <ul class="space-y-3 text-secondary text-base pl-9">
                            @foreach($items as $item)
                            <li>
                                {{ $item->title }}
                                <p class="text-xs text-slate-400 dark:text-slate-500">
                                    {{ \Carbon\Carbon::parse($item->start_date)->format('M Y') }} -
                                    {{ $item->end_date ? \Carbon\Carbon::parse($item->end_date)->format('M Y') : 'Present' }}
                                </p>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach

            </div>
             <div class="text-right mt-8">
                <a href="{{ route('about.index') }}" class="font-semibold text-blue-600 dark:text-sky-400 hover:underline text-base flex items-center justify-end gap-2">
                    <span>View Full Details</span>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>
        </div>
    </div>

    @php
        $colors = [
            'bg-sky-100 text-sky-800 dark:bg-sky-900 dark:text-sky-300',
            'bg-emerald-100 text-emerald-800 dark:bg-emerald-900 dark:text-emerald-300',
            'bg-rose-100 text-rose-800 dark:bg-rose-900 dark:text-rose-300',
            'bg-amber-100 text-amber-800 dark:bg-amber-900 dark:text-amber-300',
            'bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-300',
        ];
    @endphp

    <!-- Featured Projects Section -->
    @if($featuredProjects->count() > 0)
    <div data-aos="fade-up">
        <h2 class="text-2xl font-bold mb-6 text-primary">Featured Projects</h2>
        <div class="space-y-8">
            @foreach($featuredProjects as $project)
            <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}" class="card rounded-2xl overflow-hidden group hover:-translate-y-1.5 transition-transform duration-300">
                <div class="overflow-hidden"><img src="{{ $project->image }}" alt="{{ $project->title }}" class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out"></div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2 text-primary">{{ $project->title }}</h3>
                    <p class="text-secondary mb-4 text-base text-justify">{{ $project->overview }}</p>
                    <div class="flex flex-wrap gap-2 mb-4">
                        @if($project->tech_stack)
                            @foreach(explode(',', $project->tech_stack) as $index => $tech)
                                <span class="text-xs font-semibold px-2.5 py-1 rounded-full {{ $colors[$index % count($colors)] }}">{{ trim($tech) }}</span>
                            @endforeach
                        @endif
                    </div>
                    <a href="{{ route('projects.show', $project) }}" class="font-semibold text-blue-600 dark:text-sky-400 hover:underline text-base flex items-center gap-2"><span>View Details</span><i data-lucide="arrow-right" class="w-4 h-4"></i></a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Latest Projects Section -->
    <div data-aos="fade-up">
        <h2 class="text-2xl font-bold mb-6 text-primary">Latest Projects</h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            @foreach($latestProjects as $project)
            <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}" class="card rounded-2xl overflow-hidden group hover:-translate-y-1.5 transition-transform duration-300">
                <div class="overflow-hidden"><img src="{{ $project->image }}" alt="{{ $project->title }}" class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out"></div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2 text-primary">{{ $project->title }}</h3>
                    <p class="text-secondary mb-4 text-base text-justify">{{ $project->overview }}</p>
                    <div class="flex flex-wrap gap-2 mb-4">
                        @if($project->tech_stack)
                            @foreach(explode(',', $project->tech_stack) as $index => $tech)
                                <span class="text-xs font-semibold px-2.5 py-1 rounded-full {{ $colors[$index % count($colors)] }}">{{ trim($tech) }}</span>
                            @endforeach
                        @endif
                    </div>
                    <a href="{{ route('projects.show', $project) }}" class="font-semibold text-blue-600 dark:text-sky-400 hover:underline text-base flex items-center gap-2"><span>View Details</span><i data-lucide="arrow-right" class="w-4 h-4"></i></a>
                </div>
            </div>
            @endforeach
        </div>
         <div class="text-right mt-8">
            <a href="{{ route('projects.index') }}" class="font-semibold text-blue-600 dark:text-sky-400 hover:underline text-base flex items-center justify-end gap-2">
                <span>View All Projects</span>
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>
    </div>
    
    <div data-aos="fade-up">
        <h2 class="text-2xl font-bold mb-6 text-primary">Stack</h2>
        <div class="card p-8 rounded-2xl">
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6 items-center">
                @forelse ($stacks as $index => $stack)
                    <a href="{{ route('stack.index') }}" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}" class="flex items-center gap-3 transition-transform duration-300 hover:scale-110">
                        <img src="{{ $stack->image }}" alt="{{ $stack->name }}" class="h-10 w-10 object-contain">
                        <p class="font-medium text-base text-primary">{{ $stack->name }}</p>
                    </a>
                @empty
                    <p class="text-secondary col-span-full text-center">No stack items have been added yet.</p>
                @endforelse
            </div>
            <div class="text-right mt-8">
                <a href="{{ route('stack.index') }}" class="font-semibold text-blue-600 dark:text-sky-400 hover:underline text-base flex items-center justify-end gap-2">
                    <span>View Full Stack</span>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>
        </div>
    </div>

    <div data-aos="zoom-in" data-aos-delay="500" class="card p-10 rounded-2xl grid-background">
        <div class="text-center">
            <h2 class="text-2xl font-semibold mb-4 max-w-md mx-auto text-primary">Do you have any project idea?</h2>
            <a href="{{ route('contact') }}" class="mt-6 inline-block bg-slate-900 text-white px-8 py-3 rounded-xl font-semibold text-base hover:bg-slate-800 dark:bg-sky-600 dark:hover:bg-sky-700 transition-all duration-300 transform hover:scale-105">
                Contact Me
            </a>
        </div>
    </div>
</section>
@endsection
