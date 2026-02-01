@extends('layouts.app')

@section('title', 'My Favorites')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-6 lg:px-8">

    <div class="flex items-center justify-between pb-6 border-b border-gray-200 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Saved Favorites</h1>
            <p class="text-sm text-gray-500 mt-1">Questions you have bookmarked for quick access.</p>
        </div>
        <div class="bg-gray-100 text-gray-600 text-xs font-bold px-3 py-1 rounded-full">
            {{ $favorites->count() }} Items
        </div>
    </div>

    @if($favorites->isEmpty())
        <div class="text-center py-12 border border-dashed border-gray-300 rounded-lg bg-gray-50">
            <p class="text-gray-500 font-medium">You haven't saved any favorites yet.</p>
        </div>
    @else
        <div class="space-y-4">
            @foreach($favorites as $favorite)
                @php $question = $favorite->question; @endphp
                <div class="bg-white border border-gray-200 hover:border-indigo-400 hover:shadow-md transition-all rounded-lg overflow-hidden flex flex-col md:flex-row">
                    
                    <div class="flex-grow p-6">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-[10px] font-bold text-pink-600 bg-pink-50 px-2 py-0.5 rounded uppercase tracking-wider">Favorite</span>
                            <span class="text-xs text-gray-400">{{ $question->created_at->diffForHumans() }}</span>
                        </div>

                        <a href="{{ route('questions.show', $question->id) }}" class="group">
                            <h2 class="text-lg font-bold text-gray-900 group-hover:underline decoration-indigo-500 underline-offset-4 decoration-2 transition-all mb-2">
                                {{ $question->title }}
                            </h2>
                            <p class="text-gray-600 text-sm line-clamp-2 leading-relaxed max-w-4xl">
                                {{ strip_tags($question->content) }}
                            </p>
                        </a>
                    </div>

                    <div class="md:w-72 bg-gray-50/50 p-6 border-t md:border-t-0 md:border-l border-gray-100 flex flex-col justify-center">
                        <div class="flex items-center justify-between gap-4">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="h-8 w-8 rounded bg-gray-800 flex items-center justify-center text-white text-xs font-bold shrink-0">
                                    {{ strtoupper(substr($question->user->name, 0, 1)) }}
                                </div>
                                <div class="min-w-0">
                                    <p class="text-xs font-bold text-gray-900 truncate">{{ $question->user->name }}</p>
                                    <a href="{{ route('questions.show', $question->id) }}" class="text-[11px] font-semibold text-indigo-600 hover:text-indigo-800 uppercase tracking-tighter transition">View Post</a>
                                </div>
                            </div>

                            <form action="{{ route('questions.favorite', $question->id) }}" method="POST" class="shrink-0">
                                @csrf
                                <button type="submit" 
                                        class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-md transition-all"
                                        title="Remove from favorites">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-10 flex justify-center">
        </div>
    @endif

</div>
@endsection