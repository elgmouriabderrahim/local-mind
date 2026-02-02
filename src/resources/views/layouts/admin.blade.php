<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> 
    <style>
        /* Custom scrollbar for a cleaner look */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    </style>
</head>
<body class="bg-slate-50 flex h-screen font-sans antialiased text-slate-900">

    <aside class="w-68 bg-slate-900 shadow-2xl flex-shrink-0 flex flex-col text-slate-300">
        <div class="p-6 flex items-center gap-3 border-b border-slate-800">
            <div class="bg-blue-600 p-2 rounded-lg">
                <i data-feather="command" class="text-white w-5 h-5"></i>
            </div>
            <span class="text-xl font-bold tracking-tight text-white">LocalMind</span>
        </div>

        <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
            <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider px-3 mb-2">Management</div>
            
            <a href="{{ route('admin.dashboard') }}" 
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 hover:bg-slate-800 hover:text-white {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600! text-white font-medium shadow-lg shadow-blue-900/20' : '' }}">
                <i data-feather="grid" class="w-5 h-5"></i> Dashboard
            </a>
            
            <a href="{{ route('admin.users.index') }}" 
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 hover:bg-slate-800 hover:text-white {{ request()->routeIs('admin.users.*') ? 'bg-blue-600! text-white font-medium shadow-lg shadow-blue-900/20' : '' }}">
                <i data-feather="users" class="w-5 h-5"></i> Users
            </a>

            <a href="{{ route('admin.questions.index') }}" 
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 hover:bg-slate-800 hover:text-white {{ request()->routeIs('admin.questions.*') ? 'bg-blue-600! text-white font-medium shadow-lg shadow-blue-900/20' : '' }}">
                <i data-feather="help-circle" class="w-5 h-5"></i> Questions
            </a>

            <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider px-3 mt-6 mb-2">Application</div>

            <a href="{{ route('home') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-slate-800 hover:text-white transition-all">
                <i data-feather="external-link" class="w-5 h-5"></i> Main Site
            </a>
            
            <a href="{{ route('favorites.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-slate-800 hover:text-white transition-all">
                <i data-feather="heart" class="w-5 h-5"></i> Favorites
            </a>
        </nav>

        <div class="p-4 border-t border-slate-800">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-red-400 hover:bg-red-500/10 transition-all cursor-pointer">
                    <i data-feather="log-out" class="w-5 h-5"></i> 
                    <span class="font-medium">Sign Out</span>
                </button>
            </form>
        </div>
    </aside>

    <div class="flex-1 flex flex-col min-w-0">
        <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-8">
            <h1 class="text-lg font-semibold text-slate-800">@yield('page_title', 'Overview')</h1>
            <div class="flex items-center gap-4">
                <button class="text-slate-500 hover:text-slate-800 transition-colors">
                    <i data-feather="bell" class="w-5 h-5"></i>
                </button>
                <div class="h-8 w-8 rounded-full bg-slate-200 border border-slate-300 flex items-center justify-center text-xs font-bold text-slate-600">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-8">
            <div class="max-w-7xl mx-auto">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        feather.replace()
    </script>
</body>
</html>