@extends('layouts.app')

@section('title', $project->title . " | Faishal Anwar's Portfolio")

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
            @if($project->link)
            <div>
                <h4 class="text-base font-semibold mb-2 text-primary">Project Link</h4>
                <a href="{{ $project->link }}" target="_blank" class="text-base text-blue-600 dark:text-sky-400 hover:underline flex items-center gap-2">
                    <span>View Project</span>
                    <i data-lucide="external-link" class="w-4 h-4"></i>
                </a>
            </div>
            @endif
            <div>
                <h4 class="text-base font-semibold mb-2 text-primary">Preview</h4>
                <img src="{{ $project->image }}" alt="{{ $project->title }} Preview" class="rounded-xl shadow-lg w-full">
            </div>
        </div>
    </div>
    <div class="border-t border-border-color pt-10">
        <h3 class="text-xl font-semibold mb-6 text-primary">Other Projects</h3>
         <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($otherProjects as $otherProject)
             <a href="{{ route('projects.show', $otherProject) }}" class="card rounded-xl overflow-hidden group hover:-translate-y-1.5 transition-transform duration-300">
                 <div class="p-6">
                     <h4 class="text-lg font-semibold mb-2 text-primary">{{ $otherProject->title }}</h4>
                     <p class="font-semibold text-blue-600 dark:text-sky-400 hover:underline text-base flex items-center gap-2 mt-3"><span>View Project</span><i data-lucide="arrow-right" class="w-4 h-4"></i></p>
                 </div>
             </a>
             @endforeach
         </div>
    </div>
</section>
@endsection
