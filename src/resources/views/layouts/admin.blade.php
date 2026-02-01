<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.3/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
</head>
<body class="bg-gray-100 flex h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md flex-shrink-0">
        <div class="p-6 text-2xl font-bold text-gray-800 border-b">Admin Panel</div>
        <nav class="p-6 space-y-2 text-gray-700">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-100 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-200 font-semibold' : '' }}">
                <i data-feather="home"></i> Dashboard
            </a>
            <a href="{{ route('admin.users.index') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-100 {{ request()->routeIs('admin.users.*') ? 'bg-gray-200 font-semibold' : '' }}">
                <i data-feather="users"></i> Users
            </a>
            <a href="{{ route('admin.questions.index') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-100 {{ request()->routeIs('admin.questions.*') ? 'bg-gray-200 font-semibold' : '' }}">
                <i data-feather="file-text"></i> Questions
            </a>
            <a href="{{ route('admin.responses.index') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-100 {{ request()->routeIs('admin.responses.*') ? 'bg-gray-200 font-semibold' : '' }}">
                <i data-feather="message-square"></i> Responses
            </a>
            <a href="{{ route('admin.favorites.index') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-100 {{ request()->routeIs('admin.favorites.*') ? 'bg-gray-200 font-semibold' : '' }}">
                <i data-feather="star"></i> Favorites
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto p-6">
        @yield('content')
    </main>

    <script>
        feather.replace()
    </script>
</body>
</html>
