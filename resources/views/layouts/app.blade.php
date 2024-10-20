<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    @if (session()->has('error'))
        <div class="alert alert-error">
            {{ session()->get('error') }}
        </div>
    @endif
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')
        <!-- Main Content with Sidebar -->
        <div class="flex">
            <!-- Sidebar -->
            <aside class="w-64 bg-white dark:bg-gray-800 min-h-screen p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Sidebar</h3>
                <ul class="mt-4">
                    <li>
                        <a href="{{ route('category.index') }}"
                            class="block py-2 text-gray-800 dark:text-gray-100 hover:text-blue-600">
                            Category
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('task.index') }}"
                            class="block py-2 text-gray-800 dark:text-gray-100 hover:text-blue-600">
                            Tasks
                        </a>
                    </li>
                    <!-- Add more sidebar links here -->
                </ul>
            </aside>
            <!-- Page Heading -->
            {{-- @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif --}}

            <!-- Page Content -->
            <main class="flex-1 p-6 bg-gray-100 dark:bg-gray-900 min-h-screen">
                @yield('content')
            </main>
        </div>
</body>

</html>
