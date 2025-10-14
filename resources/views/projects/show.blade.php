@extends('layouts.app')

@section('content')
<section id="project-detail" class="content-section space-y-10">
    <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-2 text-base text-blue-600 dark:text-sky-400 font-semibold hover:underline">
        <i data-lucide="arrow-left" class="w-4 h-4"></i>
        Back to Projects
    </a>
    <h2 class="text-3xl font-bold text-primary">{{ $project->title }}</h2>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <div class="lg:col-span-2 space-y-6 text-base text-secondary">
            @if($project->approach)
            <div>
                <h3 class="text-xl font-semibold mb-3 text-primary">My Approach</h3>
                <p class="text-justify">{{ $project->approach }}</p>
            </div>
            @endif
            @if($project->vision)
            <div>
                <h3 class="text-xl font-semibold mb-3 text-primary">Vision and Innovation</h3>
                <p class="text-justify">{{ $project->vision }}</p>
            </div>
            @endif
            @if($project->design)
             <div>
                <h3 class="text-xl font-semibold mb-3 text-primary">User-Centric Design</h3>
                <p class="text-justify">{{ $project->design }}</p>
            </div>
            @endif
            @if($project->overview)
            <div>
                <h3 class="text-xl font-semibold mb-3 text-primary">Project Overview</h3>
                <p class="text-justify">{{ $project->overview }}</p>
            </div>
            @endif
            @if($project->conclusion)
             <div>
                <h3 class="text-xl font-semibold mb-3 text-primary">Conclusion</h3>
                <p class="text-justify">{{ $project->conclusion }}</p>
            </div>
            @endif
        </div>
        <div class="lg:col-span-1 space-y-6">
            <div>
                <h4 class="text-base font-semibold mb-2 text-primary">Category</h4>
                <p class="text-base text-secondary">{{ $project->category }}</p>
            </div>
            <div>
                <h4 class="text-base font-semibold mb-2 text-primary">Client</h4>
                <p class="text-base text-secondary">{{ $project->client }}</p>
            </div>
            <div>
                <h4 class="text-base font-semibold mb-2 text-primary">Project Link</h4>
                <a href="{{ $project->link }}" target="_blank" class="text-base text-blue-600 dark:text-sky-400 hover:underline flex items-center gap-2">
                    <span>View Project</span>
                    <i data-lucide="external-link" class="w-4 h-4"></i>
                </a>
            </div>
            <div>
                <h4 class="text-base font-semibold mb-2 text-primary">Preview</h4>
                <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }} Preview" class="rounded-xl shadow-lg w-full">
            </div>
        </div>
    </div>
</section>
@endsection
