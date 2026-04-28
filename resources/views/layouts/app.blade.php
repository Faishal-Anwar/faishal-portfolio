<!DOCTYPE html>
<html lang="en" class="scroll-smooth text-main font-light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | {{ $profile->name }}</title>
    <meta name="description" content="Portfolio of {{ $profile->name }} - {{ $profile->title }}. Specializing in Machine Learning, Data Engineering, and Cloud Architecture.">
    <meta name="keywords" content="Portfolio, {{ $profile->name }}, {{ $profile->title }}, Machine Learning Engineer, Data Engineer, Cloud Architect">
    <meta name="author" content="{{ $profile->name }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title') | {{ $profile->name }}">
    <meta property="og:description" content="Professional portfolio of {{ $profile->name }}, an expert in {{ $profile->title }}.">
    <meta property="og:image" content="{{ $profile->image ? (strpos($profile->image, 'http') === 0 ? $profile->image : asset('storage/' . $profile->image)) : asset('images/profile.png') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title') | {{ $profile->name }}">
    <meta property="twitter:description" content="Professional portfolio of {{ $profile->name }}, an expert in {{ $profile->title }}.">
    <meta property="twitter:image" content="{{ $profile->image ? (strpos($profile->image, 'http') === 0 ? $profile->image : asset('storage/' . $profile->image)) : asset('images/profile.png') }}">
    
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://res.cloudinary.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    


    @yield('head')



</head>
<body class="overflow-x-hidden">
    <div class="flex min-h-screen relative text-main font-light">
        
        @include('partials.sidebar')
        @include('partials.mobile-header')
        @include('partials.mobile-nav')

        <main class="main-content flex-1 lg:ml-[var(--sidebar-w)] p-6 pt-24 lg:pt-20 sm:p-12 lg:p-20 elite-grid overflow-x-hidden">
            @yield('content')
        </main>
    </div>
    

    @yield('scripts')
</body>
</html>
