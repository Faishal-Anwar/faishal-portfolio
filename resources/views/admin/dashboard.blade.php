@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="max-w-5xl mx-auto space-y-20">
    <div data-aos="fade-up">
        <section class="space-y-8 pt-8 text-left">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
                <h2 class="text-5xl sm:text-7xl font-bold tracking-tighter text-main text-left">Dashboard</h2>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-6 py-3 bg-red-500/10 text-red-500 border border-red-500/20 rounded-xl font-bold transition-transform hover:scale-[1.05] uppercase text-xs tracking-widest">Logout</button>
                </form>
            </div>
            <p class="text-xl text-muted max-w-3xl font-light leading-relaxed">Welcome back, {{ explode(' ', $profile->name)[0] }}. Manage every part of your portfolio from this central hub.</p>
        </section>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 text-left">
        <!-- Manage Profile -->
        <div data-aos="fade-up" data-aos-delay="0">
            <a href="{{ route('admin.profile') }}" class="glass-card p-10 space-y-6 group hover:border-main transition-all text-left block h-full">
                <div class="w-14 h-14 bg-zinc-100 dark:bg-zinc-900 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i data-lucide="user-cog" class="w-7 h-7 text-main"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-main">Profile</h3>
                    <p class="text-xs text-muted mt-2">Update your info & links.</p>
                </div>
            </a>
        </div>

        <!-- Manage Projects -->
        <div data-aos="fade-up" data-aos-delay="100">
            <a href="{{ route('admin.projects') }}" class="glass-card p-10 space-y-6 group hover:border-main transition-all text-left block h-full">
                <div class="w-14 h-14 bg-zinc-100 dark:bg-zinc-900 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i data-lucide="folder-kanban" class="w-7 h-7 text-main"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-main">Projects</h3>
                    <p class="text-xs text-muted mt-2">Manage your featured work.</p>
                </div>
            </a>
        </div>

        <!-- Manage Tech Stack -->
        <div data-aos="fade-up" data-aos-delay="200">
            <a href="{{ route('admin.stacks') }}" class="glass-card p-10 space-y-6 group hover:border-main transition-all text-left block h-full">
                <div class="w-14 h-14 bg-zinc-100 dark:bg-zinc-900 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i data-lucide="layers" class="w-7 h-7 text-main"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-main">Tech Stack</h3>
                    <p class="text-xs text-muted mt-2">Update tools & platforms.</p>
                </div>
            </a>
        </div>

        <!-- Manage Experience -->
        <div data-aos="fade-up" data-aos-delay="300">
            <a href="{{ route('admin.experiences') }}" class="glass-card p-10 space-y-6 group hover:border-main transition-all text-left block h-full">
                <div class="w-14 h-14 bg-zinc-100 dark:bg-zinc-900 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i data-lucide="briefcase" class="w-7 h-7 text-main"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-main">Experience</h3>
                    <p class="text-xs text-muted mt-2">Professional timeline.</p>
                </div>
            </a>
        </div>

        <!-- Manage Education -->
        <div data-aos="fade-up" data-aos-delay="400">
            <a href="{{ route('admin.educations') }}" class="glass-card p-10 space-y-6 group hover:border-main transition-all text-left block h-full">
                <div class="w-14 h-14 bg-zinc-100 dark:bg-zinc-900 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i data-lucide="graduation-cap" class="w-7 h-7 text-main"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-main">Education</h3>
                    <p class="text-xs text-muted mt-2">Academic studies.</p>
                </div>
            </a>
        </div>

        <!-- Manage Certifications -->
        <div data-aos="fade-up" data-aos-delay="500">
            <a href="{{ route('admin.certifications') }}" class="glass-card p-10 space-y-6 group hover:border-main transition-all text-left block h-full">
                <div class="w-14 h-14 bg-zinc-100 dark:bg-zinc-900 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i data-lucide="award" class="w-7 h-7 text-main"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-main">Certifications</h3>
                    <p class="text-xs text-muted mt-2">Verified credentials.</p>
                </div>
            </a>
        </div>

        <!-- Manage Awards -->
        <div data-aos="fade-up" data-aos-delay="600">
            <a href="{{ route('admin.awards') }}" class="glass-card p-10 space-y-6 group hover:border-main transition-all text-left block h-full">
                <div class="w-14 h-14 bg-zinc-100 dark:bg-zinc-900 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i data-lucide="trophy" class="w-7 h-7 text-main"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-main">Awards</h3>
                    <p class="text-xs text-muted mt-2">Honors & achievements.</p>
                </div>
            </a>
        </div>

        <!-- Manage Skills -->
        <div data-aos="fade-up" data-aos-delay="700">
            <a href="{{ route('admin.skills') }}" class="glass-card p-10 space-y-6 group hover:border-main transition-all text-left block h-full">
                <div class="w-14 h-14 bg-zinc-100 dark:bg-zinc-900 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i data-lucide="brain" class="w-7 h-7 text-main"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-main">Home Cards</h3>
                    <p class="text-xs text-muted mt-2">Edit main service cards.</p>
                </div>
            </a>
        </div>

        <!-- View Inquiries -->
        <div data-aos="fade-up" data-aos-delay="800">
            <a href="{{ route('admin.inquiries') }}" class="glass-card p-10 space-y-6 group hover:border-main transition-all text-left block h-full">
                <div class="w-14 h-14 bg-zinc-100 dark:bg-zinc-900 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i data-lucide="mail" class="w-7 h-7 text-main"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-main">Inquiries</h3>
                    <p class="text-xs text-muted mt-2">View {{ $counts['inquiries'] }} messages.</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
