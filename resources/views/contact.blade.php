
@extends('layouts.app')

@section('title', "Contact | Faishal Anwar's Portfolio")

@section('content')
<section id="contact" class="content-section space-y-12">
    <div class="space-y-6 pt-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                 <h2 class="text-3xl font-bold text-primary">Let's Connect!</h2>
            </div>
        </div>
        <p class="text-lg leading-relaxed text-justify text-secondary">Whether it's brainstorming a new project, discussing design optimizations, or just sharing creative insights, I'm always excited to collaborate. Reach out to me and let's craft something exceptional — together!</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div data-aos="fade-up" data-aos-delay="100" class="card p-6 rounded-2xl flex justify-between items-center hover:-translate-y-1.5 transition-transform duration-300">
            <div class="flex items-center gap-4">
                <div class="bg-slate-700 dark:bg-slate-700 p-3 rounded-lg"><i data-lucide="mail" class="w-6 h-6 text-slate-300 dark:text-slate-300"></i></div>
                <span id="email-text" class="font-semibold text-base text-primary">{{ $siteSettings['contact_email'] ?? 'anwarfaishal86@gmail.com' }}</span>
            </div>
            <button id="copy-email-btn" class="p-2 rounded-lg hover:bg-slate-700 dark:hover:bg-slate-700 transition-colors">
                <i data-lucide="copy" class="w-5 h-5 text-secondary"></i>
            </button>
        </div>
        <a href="{{ $siteSettings['linkedin_url'] ?? '#' }}" target="_blank" data-aos="fade-up" data-aos-delay="200" class="card p-6 rounded-2xl flex justify-between items-center hover:-translate-y-1.5 transition-transform duration-300">
            <div class="flex items-center gap-4">
                <div class="bg-slate-700 dark:bg-slate-700 p-3 rounded-lg"><i data-lucide="linkedin" class="w-6 h-6 text-purple-400 dark:text-purple-400"></i></div>
                <span class="font-semibold text-base text-primary">LinkedIn</span>
            </div>
            <i data-lucide="arrow-up-right" class="w-6 h-6 text-secondary"></i>
        </a>
        <a href="{{ $siteSettings['instagram_url'] ?? '#' }}" target="_blank" data-aos="fade-up" data-aos-delay="300" class="card p-6 rounded-2xl flex justify-between items-center hover:-translate-y-1.5 transition-transform duration-300">
            <div class="flex items-center gap-4">
                <div class="bg-slate-700 dark:bg-slate-700 p-3 rounded-lg"><i data-lucide="instagram" class="w-6 h-6 text-green-400 dark:text-green-400"></i></div>
                <span class="font-semibold text-base text-primary">Instagram</span>
            </div>
            <i data-lucide="arrow-up-right" class="w-6 h-6 text-secondary"></i>
        </a>
        <a href="{{ $siteSettings['github_url'] ?? '#' }}" target="_blank" data-aos="fade-up" data-aos-delay="400" class="card p-6 rounded-2xl flex justify-between items-center hover:-translate-y-1.5 transition-transform duration-300">
            <div class="flex items-center gap-4">
                <div class="bg-slate-700 dark:bg-slate-700 p-3 rounded-lg"><i data-lucide="github" class="w-6 h-6 text-sky-400 dark:text-sky-400"></i></div>
                <span class="font-semibold text-base text-primary">GitHub</span>
            </div>
            <i data-lucide="arrow-up-right" class="w-6 h-6 text-secondary"></i>
        </a>
    </div>

    <div data-aos="fade-up" data-aos-delay="100">
        <h3 class="text-2xl font-bold mb-6 text-primary">Get in touch</h3>
        <div class="card p-8 lg:p-10 rounded-2xl">
            <form action="{{ route('contact.store') }}" method="POST">
                @csrf

                @if ($errors->any())
                    <div class="mb-4 rounded-lg bg-red-200 p-4 text-sm text-red-800 dark:bg-red-200 dark:text-red-800">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="mb-4 rounded-lg bg-green-200 p-4 text-sm text-green-800 dark:bg-green-200 dark:text-green-800">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-5">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-secondary">Name</label>
                        <input type="text" id="name" name="name" placeholder="Jane Smith" required class="form-input w-full px-4 py-2.5 rounded-lg text-base focus:ring-2 focus:border-transparent transition">
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-secondary">Email</label>
                        <input type="email" id="email" name="email" placeholder="jane@framer.com" required class="form-input w-full px-4 py-2.5 rounded-lg text-base focus:ring-2 focus:border-transparent transition">
                    </div>
                </div>
                <div class="mt-5">
                    <label for="message" class="block mb-2 text-sm font-medium text-secondary">Message</label>
                    <textarea id="message" name="message" rows="5" placeholder="Type something here..." required class="form-input w-full px-4 py-2.5 rounded-lg text-base focus:ring-2 focus:border-transparent transition"></textarea>
                </div>
                <div class="mt-6 text-right">
                    <button type="submit" class="bg-sky-600 text-white px-6 py-3 rounded-xl font-semibold text-base hover:bg-sky-700 dark:bg-sky-600 dark:hover:bg-sky-700 transition-all duration-300 transform hover:scale-105">
                        Send Message
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
