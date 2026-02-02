<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LocalMind')</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    @if(!Route::is('login') && !Route::is('register'))
    <nav class="bg-white shadow-md px-6 py-4 flex justify-between items-center fixed w-full top-0">
        <div class="flex space-x-4">
            <a href="{{ route('home') }}" class="text-gray-800 font-semibold hover:text-blue-600">Home</a>
            <a href="{{ route('favorites.index') }}" class="text-gray-800 font-semibold hover:text-blue-600">Favorites</a>
        </div>

        <div>
            <span class="text-gray-700 mr-4">Hello, {{ auth()->user()->name ?? 'Guest' }}</span>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
               class="text-white bg-red-500 hover:bg-red-600 px-3 py-1 rounded">
                <i class="fa-solid fa-person-hiking"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </nav>
    <main class="container mx-auto mt-12">
        @yield('content')
    </main>
    @else
    <main class="container mx-auto">
        @yield('content')
    </main>
    @endif

    @if(!Route::is('login') && !Route::is('register'))
    <footer class="bg-white shadow-inner py-4 text-center text-gray-500">
        &copy; {{ date('Y') }} LocalMind
    </footer>
    @endif

</body>
</html>