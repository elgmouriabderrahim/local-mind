@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
        <h1 class="text-3xl font-bold text-gray-900">All Questions</h1>
        <a href="{{ route('questions.create') }}"
           class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-4 py-2 rounded-lg shadow-md transition-all duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Ask Question
        </a>
    </div>

    @if($questions->isEmpty())
        <p class="text-gray-500 text-center text-lg mt-12">No questions yet. Be the first to ask!</p>
    @else
        <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($questions as $question)
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-200 border border-gray-100 flex flex-col justify-between">
                    <div class="p-6 flex flex-col gap-3">
                        <h2 class="text-lg font-semibold text-gray-900 line-clamp-2">{{ $question->title }}</h2>
                        <p class="text-gray-600 text-sm line-clamp-3">{{ $question->content }}</p>
                    </div>

                    <div class="flex items-center justify-between p-4 border-t border-gray-100">
                        <div class="flex flex-col text-xs text-gray-500">
                            <span>By <span class="font-medium text-gray-800">{{ $question->user->name }}</span></span>
                            <span>{{ $question->created_at->diffForHumans() }}</span>
                        </div>

                        <a href="{{ route('questions.show', $question->id) }}"
                           class="inline-flex items-center gap-1 bg-gray-100 hover:bg-gray-200 text-gray-800 text-sm font-medium px-3 py-1 rounded-full transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Show
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-10 flex justify-center">
            {{ $questions->links() }}
        </div>
    @endif

</div>
@endsection
