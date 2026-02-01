<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LocalMind')</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> 
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-white shadow-md px-6 py-4 flex justify-between items-center">
        <div class="flex space-x-4">
            <a href="{{ route('home') }}" class="text-gray-800 font-semibold hover:text-blue-600">Home</a>
            <a href="{{ route('favorites.index') }}" class="text-gray-800 font-semibold hover:text-blue-600">Favorites</a>
        </div>

        <div>
            <span class="text-gray-700 mr-4">Hello, {{ auth()->user()->name }}</span>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
               class="text-white bg-red-500 hover:bg-red-600 px-4 py-2 rounded">
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </nav>

    <!-- Main content -->
    <main class="flex-1 container mx-auto px-4 py-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white shadow-inner py-4 text-center text-gray-500">
        &copy; {{ date('Y') }} LocalMind
    </footer>

</body>
</html>
